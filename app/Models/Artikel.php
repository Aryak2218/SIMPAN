<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';

    protected $fillable = [
        'kategori_id',
        'user_id',
        'judul',
        'slug',
        'excerpt',
        'isi',
        'thumbnail',
        'status',
        'is_featured',
        'published_at',
        'view_count',
        'spbe_id'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
    ];

    // Relasi ke kategori artikel
    public function kategori()
    {
        return $this->belongsTo(KategoriArtikel::class, 'kategori_id');
    }

    public function category()
    {
        return $this->hasMany(KategoriArtikel::class, 'id');
    }

    // Relasi ke user (penulis)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi ke SPBE (One to One)
    public function spbe()
    {
        return $this->belongsTo(SPBE::class, 'spbe_id'); 
    }


    // Relasi ke tag (many-to-many)
    public function tags()
    {
        return $this->belongsToMany(TagArtikel::class, 'artikel_tag', 'artikel_id', 'tag_id');
    }
}