@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <!-- Welcome -->
    <div class="mb-10">
        <h1 class="text-4xl font-bold gradient-text mb-2">
            Welcome back, {{ auth()->user()->name }} 👋
        </h1>
        <p class="text-gray-500 text-lg">
            Here's a snapshot of your recent shopping activity.
        </p>
    </div>

    <!-- ===================== -->
    <!-- Stats Cards -->
    <!-- ===================== -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <!-- Total Orders -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 p-6 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 3h18l-2 13H5L3 3zm0 0L2 1m7 19a2 2 0 11-4 0m12 0a2 2 0 11-4 0"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
            <p class="text-sm text-gray-500 mt-1">Total Orders</p>
        </div>

        <!-- Active Orders -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 p-6 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $pendingOrders }}</p>
            <p class="text-sm text-gray-500 mt-1">Active Orders</p>
        </div>

        <!-- Delivered -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 p-6 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-emerald-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-gray-900">{{ $completedOrders }}</p>
            <p class="text-sm text-gray-500 mt-1">Delivered</p>
        </div>

        <!-- Total Spent -->
        <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 p-6 group">
            <div class="flex items-center justify-between mb-6">
                <div class="w-14 h-14 bg-secondary-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                    <svg class="w-7 h-7 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2
                                 3 .895 3 2-1.343 2-3 2m0-8V7m0 1v8m0 0v1m0-1
                                 c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-gray-900">
                ₱{{ number_format($totalSpent, 2) }}
            </p>
            <p class="text-sm text-gray-500 mt-1">Total Spent</p>
        </div>

    </div>

    <!-- ===================== -->
    <!-- Quick Actions -->
    <!-- ===================== -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">
            Quick Actions
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Browse -->
            <a href="{{ route('customer.products') }}"
               class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="text-3xl">🛍</div>
                    <span class="opacity-70 group-hover:translate-x-1 transition">→</span>
                </div>
                <h3 class="text-lg font-semibold mb-1">Browse Products</h3>
                <p class="text-sm opacity-80">Discover new arrivals & deals</p>
            </a>

            <!-- Cart -->
            <a href="{{ route('customer.cart.index') }}"
               class="bg-gradient-to-br from-amber-400 to-amber-500 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="text-3xl">🛒</div>
                    <span class="opacity-70 group-hover:translate-x-1 transition">→</span>
                </div>
                <h3 class="text-lg font-semibold mb-1">View Cart</h3>
                <p class="text-sm opacity-80">Review items before checkout</p>
            </a>

            <!-- Orders -->
            <a href="{{ route('customer.orders.index') }}"
               class="bg-gradient-to-br from-emerald-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300 group">
                <div class="flex items-center justify-between mb-6">
                    <div class="text-3xl">📦</div>
                    <span class="opacity-70 group-hover:translate-x-1 transition">→</span>
                </div>
                <h3 class="text-lg font-semibold mb-1">Track Orders</h3>
                <p class="text-sm opacity-80">Check your order status</p>
            </a>

        </div>
    </div>

    <!-- Keep your Recent Orders section as is -->

</div>
@endsection