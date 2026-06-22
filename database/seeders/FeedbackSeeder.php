<?php

namespace Database\Seeders;

use App\Models\BalasFeedback;
use App\Models\Feedback;
use App\Models\FeedbackMessage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FeedbackSeeder extends Seeder
{
    public function run(): void
    {
        /*
         | Kosongkan data reply/chat dulu
         | supaya Feedback Reply dan Reply Masuk benar-benar kosong.
         */
        Schema::disableForeignKeyConstraints();

        FeedbackMessage::truncate();
        BalasFeedback::truncate();
        Feedback::truncate();

        Schema::enableForeignKeyConstraints();

        /*
         | Buat hanya data feedback awal.
         | Semua status = Belum Dibalas.
         */
        Feedback::factory()
            ->count(500)
            ->belumDibalas()
            ->create();
    }
}