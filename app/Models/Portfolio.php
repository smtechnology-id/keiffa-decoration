<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $table = 'portfolios';
    protected $fillable = [
        'image',
        'package_name',
        'venue_name',
        'bride_name',
        'groom_name',
        'total_price',
        'code_order',
        'location',
    ];
}
