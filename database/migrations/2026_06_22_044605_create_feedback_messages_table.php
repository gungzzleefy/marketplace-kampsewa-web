<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('feedback_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feedback_id')
                ->constrained('feedback')
                ->cascadeOnDelete();
            $table->foreignId('sender_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->enum('sender_type', ['admin', 'customer']);
            $table->text('message');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();
            $table->index(['feedback_id', 'created_at']);
            $table->index(['sender_type', 'read_at']);
        });

        /*
         | Copy data lama dari tabel balas_feedback ke feedback_messages.
         | Jadi balasan lama tetap bisa muncul di modal chat.
         */
        if (Schema::hasTable('balas_feedback')) {
            DB::table('balas_feedback')
                ->orderBy('id')
                ->chunkById(100, function ($replies) {
                    foreach ($replies as $reply) {
                        DB::table('feedback_messages')->insert([
                            'feedback_id' => $reply->id_feedback,
                            'sender_id' => $reply->id_user,
                            'sender_type' => 'admin',
                            'message' => $reply->balasan,
                            'read_at' => now(),
                            'created_at' => $reply->created_at ?? now(),
                            'updated_at' => $reply->updated_at ?? now(),
                        ]);
                    }
                });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_messages');
    }
};
