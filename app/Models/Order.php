<?php

namespace App\Models;

use Akaunting\Money\Casts\MoneyCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity',
        'unit_cost',
        'profit_margin_percentage',
        'delivery_charge',
        'total_charge',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => MoneyCast::class,
        'profit_margin_percentage' => 'integer',
        'delivery_charge' => MoneyCast::class,
        'total_charge' => MoneyCast::class,
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
