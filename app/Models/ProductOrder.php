<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;

    protected $table = 'product_orders';
    protected $fillable = ['order_id', 'user_id', 'package_id', 'additional_id', 'code_order', 'quantity', 'total_price', 'jenis'];

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    public function additional()
    {
        return $this->belongsTo(Additional::class);
    }
}
