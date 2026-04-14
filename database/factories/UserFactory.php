<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Cache daftar URL foto profil dari profile-images.json.
     */
    protected static ?array $profileImages = null;

    /**
     * Ambil array URL foto profil dari public/profile-images.json (lazy load).
     */
    protected static function getProfileImages(): array
    {
        if (static::$profileImages === null) {
            $path = public_path('profile-images.json');
            static::$profileImages = file_exists($path)
                ? json_decode(file_get_contents($path), true)
                : [];
        }

        return static::$profileImages;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = static::getProfileImages();
        $foto   = !empty($images)
            ? $images[array_rand($images)]
            : 'man.png';

        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => bcrypt('password'),
            'type'              => 0,
            'nomor_telephone'   => $this->faker->phoneNumber(),
            'tanggal_lahir'     => $this->faker->date(),
            'foto'              => $foto,
            'status'            => $this->faker->randomElement(['Online', 'Offline']),
            'background'        => $this->faker->sentence(),
            'jenis_kelamin'     => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'time_login'        => null,
            'last_login'        => $this->faker->dateTime(),
            'name_store'        => $this->faker->name(),
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
