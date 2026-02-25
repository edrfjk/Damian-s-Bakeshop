<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
        'subtotal',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
    ];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Update cart subtotal
     */
    public function updateSubtotal()
    {
        $this->subtotal = $this->items()->sum('subtotal');
        $this->save();
    }

    /**
     * Check if cart is empty
     */
    public function isEmpty()
    {
        return $this->items()->count() === 0;
    }

    /**
     * Get total items count
     */
    public function getTotalItemsAttribute()
    {
        return $this->items()->sum('quantity');
    }
}