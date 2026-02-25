<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'status',
        'payment_method',
        'payment_status',
        'subtotal',
        'tax',
        'shipping_fee',
        'discount',
        'total',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
        'notes',
        'confirmed_at',
        'shipped_at',
        'delivered_at',
        'cancelled_at',
    ];

    protected $casts = [
        'subtotal'     => 'decimal:2',
        'tax'          => 'decimal:2',
        'shipping_fee' => 'decimal:2',
        'discount'     => 'decimal:2',
        'total'        => 'decimal:2',
        'confirmed_at' => 'datetime',
        'shipped_at'   => 'datetime',
        'delivered_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // ── Boot ──────────────────────────────────────────────
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
            }
        });
    }

    // ── Relationships ──────────────────────────────────────
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ── Scopes ─────────────────────────────────────────────
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // ── Status Methods ─────────────────────────────────────
    public function markAsConfirmed()
    {
        $this->update([
            'status'       => 'confirmed',
            'confirmed_at' => now(),
        ]);
    }

    public function markAsProcessing()
    {
        $this->update([
            'status' => 'processing',
        ]);
    }

    public function markAsShipped()
    {
        $this->update([
            'status'     => 'shipped',
            'shipped_at' => now(),
        ]);
    }

    public function markAsDelivered()
    {
        $this->update([
            'status'       => 'delivered',
            'delivered_at' => now(),
            'payment_status' => 'paid',   // auto-mark as paid on delivery
        ]);
    }

    public function markAsCancelled()
    {
        $this->update([
            'status'       => 'cancelled',
            'cancelled_at' => now(),
        ]);

        // Restore stock
        foreach ($this->items as $item) {
            if ($item->product) {
                $item->product->increment('stock', $item->quantity);
            }
        }
    }

    // ── Accessors ──────────────────────────────────────────
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'delivered'  => 'badge-success',
            'cancelled'  => 'badge-danger',
            'pending'    => 'badge-warning',
            default      => 'badge-primary',
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'pending'    => 'Pending',
            'confirmed'  => 'Confirmed',
            'processing' => 'Processing',
            'shipped'    => 'Shipped',
            'delivered'  => 'Delivered',
            'cancelled'  => 'Cancelled',
            default      => ucfirst($this->status),
        };
    }
}