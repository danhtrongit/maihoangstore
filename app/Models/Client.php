<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['name', 'logo', 'website', 'is_active', 'is_featured', 'sort_order'];
    protected $casts = ['is_active' => 'boolean', 'is_featured' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
