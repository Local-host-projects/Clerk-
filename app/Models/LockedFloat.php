<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockedFloat extends Model
{
    protected $fillable = ['customer_id', 'amount'];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function customer() { return $this->belongsTo(CustomerId::class, 'customer_id'); }
}
