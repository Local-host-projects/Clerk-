<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerId extends Model
{
    protected $fillable = ['merchant_id', 'customer_id', 'face_embeddings'];

    protected $casts = [
        'face_embeddings' => 'array',
    ];

    public function merchant() { return $this->belongsTo(MerchantProfile::class, 'merchant_id'); }
    public function lockedFloat() { return $this->hasOne(LockedFloat::class, 'customer_id'); }
}
