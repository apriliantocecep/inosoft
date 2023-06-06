<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KendaraanTest extends TestCase
{
    /**
     * Test create kendaraan
     *
     * @return void
     */
    public function test_create_kendaraan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $data = [
            "nama" => "Mobilio",
            "tahun_keluaran" => "2023",
            "warna" => "Hitam",
            "harga" => 200000000,
            "mesin" => "Mesin",
            "tipe_suspensi" => "Manual",
            "tipe_transmisi" => "CVT",
            "kapasitas_penumpang" => "4",
            "tipe" => "Mobilio",
            "jenis" => "motor"
        ];

        $this->json('POST', 'api/kendaraan', $data, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "error" => false,
                "data" => $data,
            ]);
    }

    /**
     * Test update kendaraan
     *
     * @return void
     */
    public function test_update_kendaraan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $kendaraan = \App\Models\Kendaraan::factory()->create();

        $payload = [
            "nama" => "Mobilio UPDATED",
            "tahun_keluaran" => "2023",
            "warna" => "Hitam",
            "harga" => 200000000,
            "mesin" => "Mesin",
            "tipe_suspensi" => "Manual",
            "tipe_transmisi" => "CVT",
            "kapasitas_penumpang" => "4",
            "tipe" => "Mobilio",
            "jenis" => "motor"
        ];

        $this->json('PUT', "api/kendaraan/{$kendaraan->_id}", $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "error" => false,
                "data" => [
                    "id" => $kendaraan->id,
                    "nama" => $payload['nama'],
                    "tahun_keluaran" => $payload['tahun_keluaran'],
                    "warna" => $payload['warna'],
                    "harga" => $payload['harga'],
                    "mesin" => $payload['mesin'],
                    "tipe_suspensi" => $payload['tipe_suspensi'],
                    "tipe_transmisi" => $payload['tipe_transmisi'],
                    "kapasitas_penumpang" => $payload['kapasitas_penumpang'],
                    "tipe" => $payload['tipe'],
                    "jenis" => $payload['jenis'],
                ],
            ]);
    }
    
    /**
     * Test delete kendaraan
     *
     * @return void
     */
    public function test_delete_kendaraan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $kendaraan = \App\Models\Kendaraan::factory()->create();

        $this->json('DELETE', "api/kendaraan/{$kendaraan->_id}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "error" => false,
                "data" => [
                    "message" => "Selected kendaraan has been deleted",
                ],
            ]);
    }
    
    /**
     * Test read kendaraan
     *
     * @return void
     */
    public function test_read_kendaraan()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $kendaraan = \App\Models\Kendaraan::factory()->create();

        $this->json('GET', "api/kendaraan/{$kendaraan->_id}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "error" => false,
                "data" => [
                    "id" => $kendaraan->id,
                    "nama" => $kendaraan->nama,
                    "tahun_keluaran" => $kendaraan->tahun_keluaran,
                    "warna" => $kendaraan->warna,
                    "harga" => $kendaraan->harga,
                    "mesin" => $kendaraan->mesin,
                    "tipe_suspensi" => $kendaraan->tipe_suspensi,
                    "tipe_transmisi" => $kendaraan->tipe_transmisi,
                    "kapasitas_penumpang" => $kendaraan->kapasitas_penumpang,
                    "tipe" => $kendaraan->tipe,
                    "jenis" => $kendaraan->jenis,
                ],
            ]);
    }
    
    /**
     * Test all kendaraan
     *
     * @return void
     */
    public function test_all_kendaraan_show()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $this->json('GET', 'api/kendaraan', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

}
