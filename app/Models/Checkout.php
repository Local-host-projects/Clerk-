<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        // add your checkout columns here
    ];

    public function order() { return $this->belongsTo(Orders::class); }
    public function transactionHistories() { return $this->hasMany(TransactionHistory::class); }
}
