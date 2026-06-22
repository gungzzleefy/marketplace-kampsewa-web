<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FotoProduk>
 */
class FotoProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url_foto' => $this->faker->imageUrl(),
            'tipe_sumber' => 'external',
            'urutan' => $this->faker->numberBetween(0, 10),
        ];
    }
}
