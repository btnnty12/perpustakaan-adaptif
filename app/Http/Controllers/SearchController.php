<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Services\StringMatching;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = (string) $request->query('q', '');
        $algo = (string) $request->query('algo', 'bm');
        $caseInsensitive = (bool) $request->boolean('case', true);
        if ($q === '') {
            return response()->json(['error' => 'Parameter q wajib'], 422);
        }
        $results = [];
        $books = Buku::all();
        foreach ($books as $b) {
            $fields = [
                'judul' => $b->judul ?? '',
                'penulis' => $b->penulis ?? '',
                'deskripsi' => $b->deskripsi ?? '',
            ];
            $matches = [];
            foreach ($fields as $name => $text) {
                $pos = StringMatching::matchPositions($text, $q, $algo, $caseInsensitive);
                if (!empty($pos)) {
                    $matches[$name] = $pos;
                }
            }
            if (!empty($matches)) {
                $results[] = [
                    'id' => $b->id,
                    'judul' => $b->judul,
                    'penulis' => $b->penulis,
                    'genre' => $b->genre,
                    'tahun_terbit' => $b->tahun_terbit,
                    'deskripsi' => $b->deskripsi,
                    'matches' => $matches,
                ];
            }
        }
        return response()->json([
            'query' => $q,
            'algo' => $algo,
            'case_insensitive' => $caseInsensitive,
            'count' => count($results),
            'results' => $results,
        ]);
    }
}

