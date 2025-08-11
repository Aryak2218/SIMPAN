<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerArtikel extends Model
{
    protected $table = 'banner_artikel';

    protected $fillable = [
        'artikel_id',
        'judul_teks',
        'subjudul_teks',
        'gambar',
        'urutan',
        'aktif'
    ];

    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'artikel_id');
    }
}


