<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tier 1: Tabel utama tanpa foreign key
        $this->call(UserSeeder::class);

        // Tier 2: Tabel yang hanya bergantung pada users
        $this->call([
            ResetPasswordSeeder::class,
            StatusNotifikasiUserSeeder::class,
            BankSeeder::class,
            FeedbackSeeder::class,
            PemasukanSeeder::class,
            PengeluaranSeeder::class,
            AlamatSeeder::class,
            RiwayatPencarianSeeder::class,
        ]);

        // Tier 3: Tabel yang bergantung pada users (produk & iklan)
        $this->call([
            ProdukSeeder::class,
            IklanSeeder::class,
        ]);

        // Tier 4: Tabel yang bergantung pada produk atau iklan
        $this->call([
            RatingSeeder::class,           // FK: produk, users
            VariantProdukSeeder::class,    // FK: produk
            DetailIklanSeeder::class,      // FK: iklan
            PembayaranIklanSeeder::class,  // FK: iklan, users
            PenyewaanSeeder::class,        // FK: users
        ]);

        // Tier 5: Tabel yang bergantung pada variant_produk atau penyewaan
        $this->call([
            DetailVariantProdukSeeder::class,  // FK: variant_produk
            DetailPenyewaanSeeder::class,      // FK: penyewaan, produk
            PembayaranPenyewaanSeeder::class,  // FK: penyewaan
        ]);
    }
}
