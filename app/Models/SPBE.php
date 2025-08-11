<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SPBE extends Model
{
    use HasFactory;

    protected $table = 'pengetahuan_spbe';

    protected $fillable = [
        'nomor_id',
        'judul',
        'slug',
        'deskripsi',
        'excerpt',
        'artikel_id',
        'kategori_id',
        'penulis_id',
        'instansi',
        'waktu',
        'format',
        'lingkup',
        'label',
        'kontributor',
        'status_publikasi',
        'url',
        'file_path',
    ];

        public function kategori() {
            return $this->belongsTo(KategoriArtikel::class, 'kategori_id');
        }

        // Relasi ke Artikel
        public function artikel()
        {
            return $this->hasMany(Artikel::class, 'spbe_id');
        }

        public function penulis() {
            return $this->belongsTo(User::class, 'penulis_id');
        }
}
