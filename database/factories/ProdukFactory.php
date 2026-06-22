<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'nama' => $this->faker->word,
            'deskripsi' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['Tersedia', 'Tidak Tersedia']),
            'kategori' => $this->faker->randomElement(['Tenda', 'Tas', 'Sepatu', 'Perlengkapan']),
            // Kolom foto lama masih disimpan untuk backward compatibility
            'foto_depan' => $this->faker->imageUrl(),
            'foto_belakang' => 'Belum di isi',
            'foto_kiri' => 'Belum di isi',
            'foto_kanan' => 'Belum di isi',
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
