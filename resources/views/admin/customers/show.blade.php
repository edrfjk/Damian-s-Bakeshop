@extends('layouts.admin')
@section('title', 'Customer Profile')

@section('content')
<div class="p-8 space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.customers.index') }}" class="p-2 rounded-lg hover:bg-cream-parchment transition">
                <svg class="w-5 h-5" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-display font-bold" style="color: var(--chocolate);">Customer Profile</h1>
                <p class="text-sm text-chocolate-light">{{ $user->name }}</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column -->
        <div class="space-y-6">
            <!-- Profile Card -->
            <div class="card p-6 text-center shadow-sm hover:shadow-md transition">
                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mx-auto mb-4 border-4" style="border-color: var(--golden);">
                <h2 class="text-2xl font-display font-bold mb-1" style="color: var(--chocolate);">{{ $user->name }}</h2>
                <p class="text-sm mb-2 text-chocolate-light">Customer #{{ $user->id }}</p>
                <span class="badge badge-success">Active Customer</span>
            </div>

            <!-- Contact Info -->
            <div class="card p-6 shadow-sm">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Contact Information</h3>
                <div class="space-y-4 text-sm">
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider mb-1 text-chocolate-light">Email</p>
                        <p style="color: var(--chocolate);">{{ $user->email }}</p>
                    </div>
                    @if($user->phone)
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider mb-1 text-chocolate-light">Phone</p>
                        <p style="color: var(--chocolate);">{{ $user->phone }}</p>
                    </div>
                    @endif
                    @if($user->address)
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider mb-1 text-chocolate-light">Address</p>
                        <p style="color: var(--chocolate);">{{ $user->address }}</p>
                        @if($user->city)
                            <p style="color: var(--chocolate);">{{ $user->city }}{{ $user->postal_code ? ', '.$user->postal_code : '' }}</p>
                        @endif
                    </div>
                    @endif
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider mb-1 text-chocolate-light">Member Since</p>
                        <p style="color: var(--chocolate);">{{ $user->created_at->format('F d, Y') }}</p>
                        <p class="text-xs text-chocolate-light">{{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Statistics Card -->
            <div class="card p-6 shadow-sm">
                <h3 class="font-display text-xl font-bold mb-5" style="color: var(--chocolate);">Statistics</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex justify-between items-center p-3 rounded-lg bg-cream-parchment">
                        <span class="text-sm text-chocolate-light">Total Orders</span>
                        <span class="text-2xl font-bold text-chocolate">{{ $user->orders->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-cream-parchment">
                        <span class="text-sm text-chocolate-light">Total Spent</span>
                        <span class="text-2xl font-bold text-golden">₱{{ number_format($user->orders()->where('status', 'delivered')->sum('total'), 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-cream-parchment">
                        <span class="text-sm text-chocolate-light">Average Order</span>
                        @php
                            $deliveredOrders = $user->orders()->where('status', 'delivered')->count();
                            $totalSpent = $user->orders()->where('status', 'delivered')->sum('total');
                            $average = $deliveredOrders > 0 ? $totalSpent / $deliveredOrders : 0;
                        @endphp
                        <span class="text-2xl font-bold text-chocolate">₱{{ number_format($average, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-cream-parchment">
                        <span class="text-sm text-chocolate-light">Pending Orders</span>
                        <span class="badge badge-warning">{{ $user->orders()->whereIn('status', ['pending','confirmed','processing','shipped'])->count() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column: Orders -->
        <div class="lg:col-span-2 space-y-6">
            <div class="card shadow-sm">
                <div class="p-6 border-b" style="border-color: var(--cream-parchment);">
                    <h2 class="text-2xl font-display font-bold text-chocolate">Order History</h2>
                </div>

                @if($user->orders->count() > 0)
                    <div class="divide-y" style="border-color: var(--cream-parchment);">
                        @foreach($user->orders as $order)
                        <div class="p-6 hover:bg-cream-soft transition rounded-lg mb-3">
                            <div class="flex flex-col sm:flex-row justify-between gap-4 mb-3">
                                <div>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-lg hover:underline text-chocolate">{{ $order->order_number }}</a>
                                    <p class="text-sm text-chocolate-light">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xl font-bold text-golden mb-1">₱{{ number_format($order->total, 2) }}</p>
                                    <span class="badge {{ $order->status_badge }}">{{ $order->status_label }}</span>
                                </div>
                            </div>

                            <!-- Order Items Preview -->
                            <div class="flex items-center gap-2 mb-3">
                                <div class="flex -space-x-2">
                                    @foreach($order->items->take(5) as $item)
                                        <img src="{{ $item->product->image_url }}" alt="" class="w-10 h-10 rounded-lg object-cover border-2 border-white shadow-sm" title="{{ $item->product->name }}">
                                    @endforeach
                                </div>
                                <span class="text-sm font-semibold text-chocolate">
                                    {{ $order->items->count() }} item(s)
                                    @if($order->items->count() > 5)
                                        <span class="text-chocolate-light">+ {{ $order->items->count() - 5 }} more</span>
                                    @endif
                                </span>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary text-xs py-2 px-4">View Details</a>
                                @if(in_array($order->status, ['pending', 'confirmed']))
                                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="inline">
                                    @csrf
                                    <input type="hidden" name="status" value="processing">
                                    <button type="submit" class="btn btn-secondary text-xs py-2 px-4">Mark Processing</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-20 text-center">
                        <div class="text-6xl mb-4">📦</div>
                        <p class="font-bold text-lg mb-2 text-chocolate">No Orders Yet</p>
                        <p class="text-chocolate-light">This customer hasn't placed any orders</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection