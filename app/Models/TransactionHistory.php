<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
    protected $fillable = ['checkout_id', 'agent_id', 'amount'];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function checkout() { return $this->belongsTo(Checkout::class); }
    public function agent() { return $this->belongsTo(AgentProfile::class, 'agent_id'); }
}
