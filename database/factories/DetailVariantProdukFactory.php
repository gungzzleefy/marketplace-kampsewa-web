<?php

namespace Database\Factories;

use App\Models\VariantProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailVariantProduk>
 */
class DetailVariantProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_variant_produk' => VariantProduk::inRandomOrder()->first()?->id ?? VariantProduk::factory(),
            'ukuran' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'stok' => $this->faker->numberBetween(1, 300),
            'harga_sewa' => $this->faker->numberBetween(10000, 100000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
