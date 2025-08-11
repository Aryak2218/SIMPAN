<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagArtikel extends Model
{
    protected $table = 'tag_artikel';

    protected $fillable = ['nama_tag', 'slug'];

    public function artikels()
    {
        return $this->belongsToMany(Artikel::class, 'artikel_tag', 'tag_id', 'artikel_id');
    }
}
