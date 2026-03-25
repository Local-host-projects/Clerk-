<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MerchantProfile extends Model
{
     protected $fillable = [
        'user_id', 'business_name', 'business_email',
        'business_phone', 'business_address',
        'business_account_number', 'bank', 'status'
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function projects() { return $this->hasMany(Projects::class, 'user_id', 'user_id'); }
    public function orders() { return $this->hasMany(Orders::class, 'merchant_id'); }
    public function customerIds() { return $this->hasMany(CustomerId::class, 'merchant_id'); }
}
