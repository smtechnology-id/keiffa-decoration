<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = ['user_id', 'code_order', 'bride_name', 'groom_name', 'wedding_date', 'wedding_location', 'wedding_theme', 'total_price', 'payment_total', 'status_pembayaran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
