<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Services\StringMatching;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class SearchController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'q'        => 'required|string|min:1|max:255',
            'algo'     => ['string', Rule::in(['bm', 'kmp', 'bf'])],
            'case'     => 'boolean',
            'per_page' => 'integer|min:1|max:100',
            'page'     => 'integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors'  => $validator->errors(),
            ], 422);
        }

        try {
            $validated        = $validator->validated();
            $searchQuery      = $validated['q'];
            $algorithm        = $validated['algo'] ?? 'bm';
            $caseInsensitive  = filter_var($validated['case'] ?? true, FILTER_VALIDATE_BOOL);
            $perPage          = (int) ($validated['per_page'] ?? 10);
            $currentPage      = (int) ($validated['page'] ?? 1);

            // Pre-filter menggunakan SQL LIKE untuk memperkecil dataset
            $books = Buku::query()
                ->select(['id', 'judul', 'penulis', 'genre', 'tahun_terbit', 'deskripsi'])
                ->where(function ($q) use ($searchQuery) {
                    $q->where('judul', 'LIKE', "%$searchQuery%")
                      ->orWhere('penulis', 'LIKE', "%$searchQuery%")
                      ->orWhere('deskripsi', 'LIKE', "%$searchQuery%");
                })
                ->get();

            $results = [];

            foreach ($books as $book) {
                $fields = [
                    'judul'    => $book->judul ?? '',
                    'penulis'  => $book->penulis ?? '',
                    'deskripsi'=> $book->deskripsi ?? '',
                ];

                $matches = [];

                foreach ($fields as $fieldName => $fieldValue) {
                    $positions = StringMatching::matchPositions(
                        $fieldValue,
                        $searchQuery,
                        $algorithm,
                        $caseInsensitive
                    );

                    if (!empty($positions)) {
                        $matches[$fieldName] = [
                            'positions' => $positions,
                            'snippet'   => $this->getSnippet($fieldValue, $searchQuery, $caseInsensitive)
                        ];
                    }
                }

                if (!empty($matches)) {
                    $results[] = [
                        'id'           => $book->id,
                        'judul'        => $book->judul,
                        'penulis'      => $book->penulis,
                        'genre'        => $book->genre,
                        'tahun_terbit' => $book->tahun_terbit,
                        'matches'      => $matches,
                    ];
                }
            }

            // Manual pagination
            $total = count($results);
            $results = array_slice($results, ($currentPage - 1) * $perPage, $perPage);

            return response()->json([
                'success' => true,
                'data' => [
                    'query'            => $searchQuery,
                    'algorithm'        => $algorithm,
                    'case_insensitive' => $caseInsensitive,
                    'pagination' => [
                        'total'        => $total,
                        'per_page'     => $perPage,
                        'current_page' => $currentPage,
                        'last_page'    => ceil($total / $perPage),
                    ],
                    'results' => $results
                ]
            ]);

        } catch (\Exception $e) {
            \Log::error('Search error: ' . $e->getMessage(), [
                'query' => $request->query('q'),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat melakukan pencarian',
                'error'   => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Membuat snippet teks di sekitar kata yang cocok
     */
    private function getSnippet(string $text, string $query, bool $caseInsensitive): string
    {
        $length = 100;

        $pos = $caseInsensitive
            ? mb_stripos($text, $query)
            : mb_strpos($text, $query);

        if ($pos === false) {
            return mb_substr($text, 0, $length) . (mb_strlen($text) > $length ? '...' : '');
        }

        $start = max(0, $pos - ($length / 2));
        $snippet = mb_substr($text, $start, $length);

        if ($start > 0) {
            $snippet = '...' . ltrim($snippet);
        }

        if ($start + $length < mb_strlen($text)) {
            $snippet = rtrim($snippet) . '...';
        }

        return $snippet;
    }
}
