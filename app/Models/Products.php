<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'project_id', 'name', 'description', 'price',
        'stock', 'image_url', 'type', 'variants', 'filepath',
    ];

    protected $casts = [
        'variants' => 'array',
        'price'    => 'decimal:2',
    ];

    public function project() { return $this->belongsTo(Projects::class); }
    public function orders() { return $this->hasMany(Orders::class); }
}
