<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RatingProduk>
 */
class RatingProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_produk' => Produk::inRandomOrder()->first()?->id ?? Produk::factory(),
            'id_user' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'rating' => $this->faker->numberBetween(1, 10),
            'ulasan' => $this->faker->sentence,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
