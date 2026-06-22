<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    protected $fillable = [
        'id_user',
        'nama',
        'deskripsi',
        'status',
        'kategori',
        'foto_depan',
        'foto_belakang',
        'foto_kiri',
        'foto_kanan',
    ];

    /**
     * Get all photos for the product
     */
    public function foto()
    {
        return $this->hasMany(FotoProduk::class, 'id_produk')->orderBy('urutan', 'asc');
    }

    /**
     * Get the first photo (thumbnail)
     */
    public function photoThumbnail()
    {
        return $this->hasOne(FotoProduk::class, 'id_produk')
            ->orderBy('urutan', 'asc');
    }

    /**
     * Get user that owns this product
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
