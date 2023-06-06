<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KendaraanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nama" => $this->faker->name(),
            "tahun_keluaran" => $this->faker->randomNumber(4, true),
            "warna" => "Hitam",
            "harga" => 200000000,
            "mesin" => "Mesin",
            "tipe_suspensi" => "Manual",
            "tipe_transmisi" => "CVT",
            "kapasitas_penumpang" => "4",
            "tipe" => "Mobilio",
            "jenis" => "mobil"
        ];
    }
}
