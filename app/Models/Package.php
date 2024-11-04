<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $table = 'packages';
    protected $fillable = [
        'image',
        'nama',
        'packageSlug',
        'harga',
        'deskripsi',
        'properti',
        'jenis_bunga',
        'hand_bouquet',
        'dekorasi',
        'luas_dekorasi',
        'meja_angpao',
        'kotak_angpao',
        'isAvailable'
    ];
}
