@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('customer.orders.index') }}" class="text-primary-600 hover:text-primary-700 font-semibold mb-4 inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Back to Orders
        </a>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mt-4">
            <div>
                <h1 class="text-4xl font-display font-bold text-gray-900 mb-2">{{ $order->order_number }}</h1>
                <p class="text-gray-600">Placed on {{ $order->created_at->format('F d, Y \a\t h:i A') }}</p>
            </div>
            <span class="badge {{ $order->status_badge }} text-lg px-4 py-2">
                {{ ucfirst($order->status) }}
            </span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Items -->
        <div class="lg:col-span-2">
            <div class="card">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Items</h2>
                    
                    <div class="space-y-4">
                        @foreach($order->items as $item)
                            <div class="flex gap-4 pb-4 border-b last:border-0 last:pb-0">
                                <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden shrink-0">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between mb-1">
                                        <h3 class="font-bold text-gray-900">{{ $item->product_name }}</h3>
                                        <p class="font-bold text-gray-900">₱{{ number_format($item->subtotal, 2) }}</p>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">SKU: {{ $item->product_sku }}</p>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600">₱{{ number_format($item->price, 2) }} × {{ $item->quantity }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card mt-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Timeline</h2>
                    
                    <div class="space-y-4">
                        <!-- Placed -->
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                @if($order->confirmed_at || $order->shipped_at || $order->delivered_at)
                                    <div class="w-0.5 h-12 bg-emerald-500"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-semibold text-gray-900">Order Placed</p>
                                <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>

                        <!-- Confirmed -->
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 {{ $order->confirmed_at ? 'bg-emerald-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center text-white">
                                    @if($order->confirmed_at)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                                @if($order->shipped_at || $order->delivered_at)
                                    <div class="w-0.5 h-12 {{ $order->confirmed_at ? 'bg-emerald-500' : 'bg-gray-300' }}"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-semibold text-gray-900">Order Confirmed</p>
                                @if($order->confirmed_at)
                                    <p class="text-sm text-gray-600">{{ $order->confirmed_at->format('M d, Y h:i A') }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Pending confirmation</p>
                                @endif
                            </div>
                        </div>

                        <!-- Shipped -->
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 {{ $order->shipped_at ? 'bg-emerald-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center text-white">
                                    @if($order->shipped_at)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                        </svg>
                                    @endif
                                </div>
                                @if($order->delivered_at)
                                    <div class="w-0.5 h-12 {{ $order->shipped_at ? 'bg-emerald-500' : 'bg-gray-300' }}"></div>
                                @endif
                            </div>
                            <div class="flex-1 pb-4">
                                <p class="font-semibold text-gray-900">Order Shipped</p>
                                @if($order->shipped_at)
                                    <p class="text-sm text-gray-600">{{ $order->shipped_at->format('M d, Y h:i A') }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Not yet shipped</p>
                                @endif
                            </div>
                        </div>

                        <!-- Delivered -->
                        <div class="flex gap-4">
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 {{ $order->delivered_at ? 'bg-emerald-500' : 'bg-gray-300' }} rounded-full flex items-center justify-center text-white">
                                    @if($order->delivered_at)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-gray-900">Delivered</p>
                                @if($order->delivered_at)
                                    <p class="text-sm text-gray-600">{{ $order->delivered_at->format('M d, Y h:i A') }}</p>
                                @else
                                    <p class="text-sm text-gray-500">Not yet delivered</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Summary Sidebar -->
        <div class="lg:col-span-1">
            <!-- Order Summary -->
            <div class="card mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary</h2>
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-semibold">₱{{ number_format($order->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Shipping Fee</span>
                            <span class="font-semibold">₱{{ number_format($order->shipping_fee, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Tax</span>
                            <span class="font-semibold">₱{{ number_format($order->tax, 2) }}</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="flex justify-between text-emerald-600">
                                <span>Discount</span>
                                <span class="font-semibold">-₱{{ number_format($order->discount, 2) }}</span>
                            </div>
                        @endif
                        <div class="border-t pt-3">
                            <div class="flex justify-between">
                                <span class="font-bold text-gray-900 text-lg">Total</span>
                                <span class="font-bold text-gray-900 text-lg">₱{{ number_format($order->total, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Method:</span>
                                <span class="font-semibold text-gray-900">{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Payment Status:</span>
                                <span class="badge {{ $order->payment_status == 'paid' ? 'badge-success' : 'badge-warning' }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="card mb-6">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Shipping Address</h2>
                    <div class="text-gray-600 space-y-1">
                        <p class="font-semibold text-gray-900">{{ $order->shipping_name }}</p>
                        <p>{{ $order->shipping_address }}</p>
                        <p>{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</p>
                        <p>{{ $order->shipping_phone }}</p>
                        <p>{{ $order->shipping_email }}</p>
                    </div>
                </div>
            </div>

            @if($order->notes)
                <div class="card">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Order Notes</h2>
                        <p class="text-gray-600">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif

            @if($order->status === 'pending')
                <form action="{{ route('customer.orders.cancel', $order) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?')" class="mt-6">
                    @csrf
                    <button type="submit" class="btn-secondary w-full text-red-600 border-red-600 hover:bg-red-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel Order
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection