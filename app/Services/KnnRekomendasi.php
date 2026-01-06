<?php

namespace App\Services;

use Illuminate\Support\Collection;

class KnnRekomendasi
{
    public function hitungRekomendasi(int $penggunaId, Collection $dataPeminjaman, int $k = 3): array
    {
        // 1. Bentuk vektor fitur: [pengguna_id => [buku_id => frekuensi]]
        $vektor = [];
        foreach ($dataPeminjaman as $row) {
            $vektor[$row->pengguna_id][$row->buku_id] =
                ($vektor[$row->pengguna_id][$row->buku_id] ?? 0) + 1;
        }

        // Jika pengguna tidak punya data
        if (!isset($vektor[$penggunaId])) {
            return ['buku_id' => null, 'skor' => 0];
        }

        $userVektor = $vektor[$penggunaId];

        // 2. Hitung jarak Euclidean ke pengguna lain
        $jarak = [];
        foreach ($vektor as $uid => $vektorLain) {
            if ($uid === $penggunaId) continue;

            $semuaBuku = array_unique(
                array_merge(array_keys($userVektor), array_keys($vektorLain))
            );

            $sum = 0;
            foreach ($semuaBuku as $bukuId) {
                $a = $userVektor[$bukuId] ?? 0;
                $b = $vektorLain[$bukuId] ?? 0;
                $sum += pow($a - $b, 2);
            }

            $jarak[$uid] = sqrt($sum);
        }

        if (empty($jarak)) {
            return ['buku_id' => null, 'skor' => 0];
        }

        // 3. Ambil K pengguna terdekat (jarak terkecil)
        asort($jarak);
        $tetangga = array_slice($jarak, 0, $k, true);

        // 4. Ambil buku dari tetangga yang belum dipinjam user
        $bukuUser = array_keys($userVektor);
        $rekomendasi = [];

        foreach (array_keys($tetangga) as $uid) {
            foreach ($vektor[$uid] as $bukuId => $freq) {
                if (!in_array($bukuId, $bukuUser)) {
                    $rekomendasi[$bukuId] = ($rekomendasi[$bukuId] ?? 0) + $freq;
                }
            }
        }

        if (empty($rekomendasi)) {
            return ['buku_id' => null, 'skor' => 0];
        }

        arsort($rekomendasi);

        return [
            'buku_id' => array_key_first($rekomendasi),
            'skor' => min($tetangga) // jarak terdekat
        ];
    }
}
