<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['title', 'image', 'issuer', 'issued_at', 'is_active', 'sort_order'];
    protected $casts = ['is_active' => 'boolean', 'issued_at' => 'date'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
