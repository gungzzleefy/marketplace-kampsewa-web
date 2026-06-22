<?php

namespace Database\Factories;

use App\Models\Penyewaan;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailPenyewaan>
 */
class DetailPenyewaanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_penyewaan'=>Penyewaan::inRandomOrder()->first()?->id ?? Penyewaan::factory(),
            'id_produk'=>Produk::inRandomOrder()->first()?->id ?? Produk::factory(),
            'warna_produk'=>$this->faker->colorName(),
            'ukuran' => $this->faker->randomElement(['XS','S','M','L','XL','XXL','XXL']),
            'qty'=>$this->faker->numberBetween(1,200),
            'subtotal'=>$this->faker->numberBetween(10000,100000),
            'created_at'=>$this->faker->dateTimeBetween('-1 year','now'),
        ];
    }
}
