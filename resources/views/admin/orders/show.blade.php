@extends('layouts.admin')
@section('title', 'Order Details')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4">
            <a href="{{ route('admin.orders.index') }}" class="p-2 rounded-lg hover:bg-cream-parchment transition">
                <svg class="w-5 h-5" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="text-3xl font-display font-bold" style="color: var(--chocolate);">{{ $order->order_number }}</h1>
                <p style="color: var(--chocolate-light);">Placed {{ $order->created_at->format('M d, Y g:i A') }}</p>
            </div>
        </div>
        <span class="badge {{ $order->status_badge }} text-sm py-2 px-4">{{ $order->status_label }}</span>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down" style="background: #f0fdf4; border-color: var(--sage); color: #4a7a4e;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Customer Info -->
            <div class="card p-6">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Customer Information</h3>
                <div class="flex items-start gap-4">
                    <img src="{{ $order->user->avatar_url }}" alt="" class="w-16 h-16 rounded-full border-2" style="border-color: var(--golden);">
                    <div class="grid grid-cols-2 gap-4 flex-1">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider mb-1" style="color: var(--chocolate-light);">Name</p>
                            <p class="font-bold" style="color: var(--chocolate);">{{ $order->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider mb-1" style="color: var(--chocolate-light);">Email</p>
                            <p style="color: var(--chocolate);">{{ $order->user->email }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider mb-1" style="color: var(--chocolate-light);">Phone</p>
                            <p style="color: var(--chocolate);">{{ $order->shipping_phone }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider mb-1" style="color: var(--chocolate-light);">Customer Since</p>
                            <p style="color: var(--chocolate);">{{ $order->user->created_at->format('M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card">
                <div class="p-6 border-b" style="border-color: var(--cream-parchment);">
                    <h3 class="font-display text-xl font-bold" style="color: var(--chocolate);">Order Items ({{ $order->items->count() }})</h3>
                </div>
                <div class="divide-y" style="border-color: var(--cream-parchment);">
                    @foreach($order->items as $item)
                        <div class="p-6 flex gap-4">
                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-20 h-20 rounded-xl object-cover shadow-sm">
                            <div class="flex-1">
                                <p class="font-bold text-lg mb-1" style="color: var(--chocolate);">{{ $item->product->name }}</p>
                                <p class="text-xs mb-2" style="color: var(--golden);">{{ $item->product->category->name }}</p>
                                <div class="flex items-center gap-4 text-sm">
                                    <span style="color: var(--chocolate-light);">Qty: <strong>{{ $item->quantity }}</strong></span>
                                    <span style="color: var(--chocolate-light);">Price: <strong>₱{{ number_format($item->price, 2) }}</strong></span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold" style="color: var(--chocolate);">₱{{ number_format($item->subtotal, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card p-6">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Shipping Address</h3>
                <div class="p-4 rounded-xl" style="background: var(--parchment);">
                    <p class="font-bold mb-1" style="color: var(--chocolate);">{{ $order->shipping_name }}</p>
                    <p style="color: var(--chocolate-light);">{{ $order->shipping_address }}</p>
                    <p style="color: var(--chocolate-light);">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                    <p class="mt-2" style="color: var(--chocolate-light);">📞 {{ $order->shipping_phone }}</p>
                    <p style="color: var(--chocolate-light);">✉️ {{ $order->shipping_email }}</p>
                    @if($order->notes)
                        <div class="mt-3 pt-3 border-t" style="border-color: var(--cream-parchment);">
                            <p class="text-xs font-bold uppercase mb-1" style="color: var(--chocolate-light);">Delivery Notes:</p>
                            <p class="text-sm italic" style="color: var(--chocolate);">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="space-y-6">

            <!-- Order Summary -->
            <div class="card p-6">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Order Summary</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span style="color: var(--chocolate-light);">Subtotal</span>
                        <span class="font-bold" style="color: var(--chocolate);">₱{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span style="color: var(--chocolate-light);">Shipping Fee</span>
                        <span class="font-bold" style="color: var(--chocolate);">₱{{ number_format($order->shipping_fee, 2) }}</span>
                    </div>
                    @if($order->tax > 0)
                        <div class="flex justify-between">
                            <span style="color: var(--chocolate-light);">Tax</span>
                            <span class="font-bold" style="color: var(--chocolate);">₱{{ number_format($order->tax, 2) }}</span>
                        </div>
                    @endif
                    @if($order->discount > 0)
                        <div class="flex justify-between">
                            <span style="color: var(--rose);">Discount</span>
                            <span class="font-bold" style="color: var(--rose);">-₱{{ number_format($order->discount, 2) }}</span>
                        </div>
                    @endif
                    <div class="pt-3 border-t flex justify-between" style="border-color: var(--cream-parchment);">
                        <span class="font-bold" style="color: var(--chocolate);">Total</span>
                        <span class="text-2xl font-bold" style="color: var(--golden);">₱{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Info -->
            <div class="card p-6">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Payment Information</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <span style="color: var(--chocolate-light);">Method</span>
                        <span class="font-bold" style="color: var(--chocolate);">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span style="color: var(--chocolate-light);">Status</span>
                        <span class="badge {{ $order->payment_status === 'paid' ? 'badge-success' : 'badge-warning' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Update Status -->
            <div class="card p-6">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Update Status</h3>
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Order Status</label>
                        <select name="status" class="input" required>
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-full" onclick="return confirm('Are you sure you want to update this order status?')">
                        Update Status
                    </button>
                </form>

                <!-- Quick Actions -->
                <div class="mt-4 pt-4 border-t space-y-2" style="border-color: var(--cream-parchment);">
                    @if($order->status === 'pending')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="confirmed">
                            <button type="submit" class="btn btn-secondary w-full text-sm">✅ Confirm Order</button>
                        </form>
                    @endif
                    @if(in_array($order->status, ['confirmed', 'processing']))
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="shipped">
                            <button type="submit" class="btn btn-secondary w-full text-sm">🚚 Mark as Shipped</button>
                        </form>
                    @endif
                    @if($order->status === 'shipped')
                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                            @csrf
                            <input type="hidden" name="status" value="delivered">
                            <button type="submit" class="btn btn-secondary w-full text-sm">✅ Mark as Delivered</button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card p-6">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Order Timeline</h3>
                <div class="space-y-4">
                    <div class="flex gap-3">
                        <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: var(--golden);"></div>
                        <div>
                            <p class="font-bold text-sm" style="color: var(--chocolate);">Order Placed</p>
                            <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                        </div>
                    </div>
                    @if($order->confirmed_at)
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: #3b82f6;"></div>
                            <div>
                                <p class="font-bold text-sm" style="color: var(--chocolate);">Confirmed</p>
                                <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->confirmed_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                    @if($order->shipped_at)
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: #6366f1;"></div>
                            <div>
                                <p class="font-bold text-sm" style="color: var(--chocolate);">Shipped</p>
                                <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->shipped_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                    @if($order->delivered_at)
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: var(--sage);"></div>
                            <div>
                                <p class="font-bold text-sm" style="color: var(--chocolate);">Delivered</p>
                                <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->delivered_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                    @if($order->cancelled_at)
                        <div class="flex gap-3">
                            <div class="w-2 h-2 rounded-full mt-2 shrink-0" style="background: var(--rose);"></div>
                            <div>
                                <p class="font-bold text-sm" style="color: var(--chocolate);">Cancelled</p>
                                <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->cancelled_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection