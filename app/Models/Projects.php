<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['user_id', 'name', 'description'];

    public function user() { return $this->belongsTo(User::class); }
    public function products() { return $this->hasMany(Products::class); }
}
