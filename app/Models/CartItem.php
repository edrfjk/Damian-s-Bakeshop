<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'subtotal',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    /**
     * Boot method to auto-calculate subtotal
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($cartItem) {
            // Auto-calculate subtotal
            $cartItem->subtotal = $cartItem->quantity * $cartItem->price;
        });

        static::saved(function ($cartItem) {
            // Update cart subtotal after saving
            $cartItem->cart->updateSubtotal();
        });

        static::deleted(function ($cartItem) {
            // Update cart subtotal after deleting
            if ($cartItem->cart) {
                $cartItem->cart->updateSubtotal();
            }
        });
    }

    /**
     * Relationships
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}