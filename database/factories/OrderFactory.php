<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = \App\Models\User::factory()->create();
        $kendaraan = \App\Models\Kendaraan::factory()->create();

        return [
            'user_id' => $user->id,
            'kendaraan_id' => $kendaraan->id,
            'qty' => 1,
            'price' => 100000000,
            'status' => 'unpaid',
        ];
    }
}
