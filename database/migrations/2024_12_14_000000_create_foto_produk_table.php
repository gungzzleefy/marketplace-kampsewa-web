<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('foto_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_produk')->nullable(false);
            $table->foreign('id_produk')->references('id')->on('produk')->onDelete('cascade');
            $table->string('url_foto', 500)->nullable(false); // Bisa internal path atau external URL
            $table->enum('tipe_sumber', ['internal', 'external'])->default('internal'); // Deteksi tipe sumber
            $table->integer('urutan')->default(0); // Untuk mengatur urutan foto
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foto_produk');
    }
};
