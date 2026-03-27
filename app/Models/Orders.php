<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
     protected $fillable = [
        'product_id',
        'merchant_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'address',
        'city',
        'postal_code',
        'quantity',
        'total_price',
        'order_id',
        'payment_method',
        'payment_status',
        'secret'
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function product() { return $this->belongsTo(Products::class); }
    public function merchant() { return $this->belongsTo(MerchantProfile::class, 'merchant_id'); }
    public function checkouts() { return $this->hasMany(Checkout::class); }
}
