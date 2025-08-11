<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';

    protected $fillable = [
       'jenis_dokumen',
        'topik',
        'fungsi',
        'tanggal_periode',
        'nama_file',
        'kategori',
        'status_dokumen',
    ];
}
