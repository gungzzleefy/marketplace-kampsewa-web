<?php

namespace Database\Factories;

use App\Models\Iklan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PembayaranIklan>
 */
class PembayaranIklanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_iklan' => Iklan::inRandomOrder()->first()?->id ?? Iklan::factory(),
            'id_user' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'metode_bayar' => 'Transfer',
            'total_bayar' => $this->faker->numberBetween(100000, 1000000),
            'status_bayar' => 'Lunas',
        ];
    }
}
