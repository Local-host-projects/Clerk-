<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['user_id', 'name', 'description'];

    public function merchant() { return $this->belongsTo(MerchantProfile::class); }
    public function products() { return $this->hasMany(Products::class); }
}
