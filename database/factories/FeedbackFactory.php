<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;

    public function definition(): array
    {
        $customerId = User::where('type', 0)->inRandomOrder()->value('id');

        return [
            'id_user' => $customerId ?? User::factory()->create([
                'type' => 0,
            ])->id,

            'deskripsi' => $this->faker->randomElement([
                'Aplikasi sangat membantu untuk mencari tempat sewa dengan lebih mudah.',
                'Tampilan website sudah bagus, tetapi beberapa bagian masih terasa lambat saat dibuka.',
                'Fitur pencarian tempat sewa sangat berguna, semoga bisa ditambahkan filter harga.',
                'Saya merasa informasi tempat sewa cukup lengkap dan mudah dipahami.',
                'Proses melihat detail tempat sewa sudah mudah, namun tampilan mobile bisa dibuat lebih rapi.',
                'Website ini memudahkan saya menemukan tempat kamp dengan cepat.',
                'Saya berharap ada fitur chat langsung dengan pemilik tempat sewa.',
                'Desain website menarik dan warna yang digunakan nyaman dilihat.',
                'Beberapa foto tempat sewa perlu dibuat lebih jelas agar customer lebih yakin.',
                'Secara keseluruhan website sudah baik dan mudah digunakan.',
            ]),

            'kriteria' => $this->faker->randomElement([
                'Sangat Baik',
                'Baik',
                'Cukup',
                'Kurang',
                'Sangat Kurang',
            ]),

            /*
             | Dibuat Belum Dibalas semua
             | supaya hanya masuk ke card Data Feedback.
             | Feedback Reply dan Reply Masuk tetap kosong.
             */
            'status' => 'Belum Dibalas',

            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => now(),
        ];
    }

    public function belumDibalas(): static
    {
        return $this->state(fn () => [
            'status' => 'Belum Dibalas',
        ]);
    }

    public function dibalas(): static
    {
        return $this->state(fn () => [
            'status' => 'Dibalas',
        ]);
    }
}