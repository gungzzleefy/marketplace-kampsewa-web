<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    use HasFactory;

    protected $table = 'foto_produk';

    protected $fillable = [
        'id_produk',
        'url_foto',
        'tipe_sumber',
        'urutan',
    ];

    protected $casts = [
        'urutan' => 'integer',
    ];

    /**
     * Get the product that owns the photo
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
