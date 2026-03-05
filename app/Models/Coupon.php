<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'type', 'value',
        'min_order', 'max_discount',
        'usage_limit', 'used_count',
        'is_active', 'start_date', 'end_date',
    ];

    protected $casts = [
        'value' => 'decimal:0',
        'min_order' => 'decimal:0',
        'max_discount' => 'decimal:0',
        'is_active' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->where(function ($q) {
                $q->whereNull('usage_limit')->orWhereColumn('used_count', '<', 'usage_limit');
            });
    }

    public function calculateDiscount(float $orderTotal): float
    {
        if ($this->min_order && $orderTotal < $this->min_order) {
            return 0;
        }

        $discount = $this->type === 'percent'
            ? $orderTotal * ($this->value / 100)
            : $this->value;

        if ($this->max_discount && $discount > $this->max_discount) {
            $discount = $this->max_discount;
        }

        return min($discount, $orderTotal);
    }
}
