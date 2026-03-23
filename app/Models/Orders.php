<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
     protected $fillable = [
        'product_id', 'merchant_id', 'quantity',
        'total_price', 'status', 'order_id',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function product() { return $this->belongsTo(Products::class); }
    public function merchant() { return $this->belongsTo(MerchantProfile::class, 'merchant_id'); }
    public function checkouts() { return $this->hasMany(Checkout::class); }
}
