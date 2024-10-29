<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;
    protected $table = 'additionals';
    protected $fillable = ['image', 'nama', 'slug', 'additional_number', 'harga', 'deskripsi'];
}
