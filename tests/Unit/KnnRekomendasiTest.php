<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\KnnRekomendasi;
use Illuminate\Support\Collection;

class KnnRekomendasiTest extends TestCase
{
    public function test_knn_rekomendasi_dengan_euclidean_distance(): void
    {
        $svc = new KnnRekomendasi();

        $data = new Collection([
            (object)['pengguna_id' => 1, 'buku_id' => 10],
            (object)['pengguna_id' => 1, 'buku_id' => 20],

            (object)['pengguna_id' => 2, 'buku_id' => 10],
            (object)['pengguna_id' => 2, 'buku_id' => 30],

            (object)['pengguna_id' => 3, 'buku_id' => 40],
        ]);

        $hasil = $svc->hitungRekomendasi(1, $data, 1);

        $this->assertIsArray($hasil);
        $this->assertArrayHasKey('buku_id', $hasil);
        $this->assertArrayHasKey('skor', $hasil);

        // User 2 paling dekat → rekomendasi buku 30
        $this->assertEquals(30, $hasil['buku_id']);
        $this->assertEquals(1.4142135623730951, $hasil['skor']);
    }
}
