<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgentProfile extends Model
{
     protected $fillable = [
        'user_id', 'full_name', 'phone',
        'address', 'credit_cards', 'connected_bank_accounts',
    ];

    protected $casts = [
        'credit_cards' => 'array',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function transactionHistories() { return $this->hasMany(TransactionHistory::class, 'agent_id'); }
}
