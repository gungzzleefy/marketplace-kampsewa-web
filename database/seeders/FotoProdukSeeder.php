<?php

namespace Database\Seeders;

use App\Models\FotoProduk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FotoProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seeder akan dipanggil dari ProdukSeeder
        // Ini adalah seeder independen jika diperlukan
        // FotoProduk::factory(100)->create();
    }
}
