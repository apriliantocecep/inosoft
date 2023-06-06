<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * Tes order kendaraan id
     *
     * @return void
     */
    public function test_kendaraan_id_required()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $this->json('POST', 'api/order', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "error" => true,
                "data" => [
                    "message" => "The kendaraan id field is required."
                ]
            ]);
    }
    
    /**
     * Tes order Out of Stock
     *
     * @return void
     */
    public function test_kendaraan_out_of_stock()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $kendaraan = \App\Models\Kendaraan::factory()->create([
            'stok' => 0,
        ]);

        $payload = [
            'kendaraan_id' => $kendaraan->id,
            'qty' => 1,
        ];

        $this->json('POST', 'api/order', $payload,  ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                "error" => true,
                "data" => [
                    "message" => "Kendaraan out of stock!"
                ]
            ]);
    }

    /**
     * Tes order success
     *
     * @return void
     */
    public function test_order_has_been_created()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $kendaraan = \App\Models\Kendaraan::factory()->create();

        $payload = [
            'kendaraan_id' => $kendaraan->id,
            'qty' => 1,
        ];

        $this->json('POST', 'api/order', $payload,  ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "error",
                "data" => [
                    "id",
                    "qty",
                    "price",
                    "status",
                    "kendaraan",
                    "user",
                    "created_at",
                    "updated_at",
                ],
            ]);
    }

    /**
     * Tes order paid
     * 
     * @return void
     */
    public function test_order_has_been_paid()
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user, 'api');

        $order = \App\Models\Order::factory()->create();

        $this->json('POST', "api/order/{$order->id}/paid", [],  ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "error",
                "data" => [
                    "message",
                    "order" => [
                        "id",
                        "qty",
                        "price",
                        "status",
                        "kendaraan",
                        "user",
                        "created_at",
                        "updated_at",
                    ]
                ],
            ]);
    }
}
