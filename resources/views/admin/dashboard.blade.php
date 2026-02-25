@extends('layouts.admin')
@section('title', 'Admin Dashboard')

@section('content')
<div class="p-8 space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-4xl font-display font-bold mb-2 text-[#4B2E2A]">Dashboard Overview</h1>
        <p class="text-[#7C5A52]">Welcome back, {{ auth()->user()->name }}! Here's what's happening in your bakeshop.</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down bg-emerald-50 border-emerald-500 text-emerald-700 flex items-center gap-2">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $statCards = [
                ['title'=>'Total Orders','value'=>$stats['total_orders'],'icon'=>'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z','iconColor'=>'#FFD97D','link'=>route('admin.orders.index')],
                ['title'=>'Revenue','value'=>'₱'.number_format($stats['total_revenue'],2),'icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z','iconColor'=>'#7CAF7E','link'=>'#'],
                ['title'=>'Customers','value'=>$stats['total_customers'],'icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','iconColor'=>'#F28D82','link'=>route('admin.customers.index')],
                ['title'=>'Pending Orders','value'=>$stats['pending_orders'],'icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z','iconColor'=>'#FFD97D','link'=>route('admin.orders.index',['status'=>'pending'])]
            ];
        @endphp

        @foreach($statCards as $card)
        <div class="card-hover p-6 animate-slide-up hover:shadow-xl transition transform hover:-translate-y-1">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center" style="background: {{ $card['iconColor'] }}20;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: {{ $card['iconColor'] }}">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $card['icon'] }}"></path>
                    </svg>
                </div>
                <a href="{{ $card['link'] }}" class="text-xs font-bold hover:underline" style="color: #FFD97D;">View →</a>
            </div>
            <p class="text-3xl font-bold mb-1 text-[#4B2E2A]">{{ $card['value'] }}</p>
            <p class="text-sm text-[#7C5A52]">{{ $card['title'] }}</p>
        </div>
        @endforeach
    </div>

<!-- Orders Overview Pills (replace status breakdown grid) -->
<div class="flex flex-wrap gap-2 mb-8">
    @foreach([
        ['status'=>'confirmed','label'=>'Confirmed','count'=>$stats['confirmed_orders'],'color'=>'#3b82f6'],
        ['status'=>'processing','label'=>'Processing','count'=>$stats['processing_orders'],'color'=>'#8b5cf6'],
        ['status'=>'shipped','label'=>'Shipped','count'=>$stats['shipped_orders'],'color'=>'#6366f1'],
        ['status'=>'delivered','label'=>'Delivered','count'=>$stats['delivered_orders'],'color'=>'#7CAF7E'],
        ['status'=>'cancelled','label'=>'Cancelled','count'=>$stats['cancelled_orders'],'color'=>'#F28D82'],
        ['status'=>'pending','label'=>'Pending','count'=>$stats['pending_orders'],'color'=>'#FFD97D'],
    ] as $stat)
    <a href="{{ route('admin.orders.index', ['status'=>$stat['status']]) }}" class="px-4 py-2 rounded-full text-sm font-semibold transition hover:scale-105 flex items-center gap-2" style="background: {{ $stat['color'] }}20; color: {{ $stat['color'] }}">
        <span>{{ $stat['label'] }}</span>
        <span class="font-bold">{{ $stat['count'] }}</span>
    </a>
    @endforeach
</div>

    <!-- Middle Row -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Orders -->
        <div class="lg:col-span-2 card">
            <div class="p-6 border-b flex items-center justify-between border-[#FFF4E1]">
                <h2 class="font-display text-2xl font-bold text-[#4B2E2A]">Recent Orders</h2>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-bold hover:underline text-[#FFD97D]">View All →</a>
            </div>
            @if($recentOrders->count() > 0)
                <div class="divide-y border-[#FFF4E1]">
                    @foreach($recentOrders as $order)
                        <div class="p-6 hover:bg-[#FFF4E1] transition">
                            <div class="flex items-center justify-between gap-4 mb-3">
                                <div class="flex-1 min-w-0">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-lg hover:underline text-[#4B2E2A]">{{ $order->order_number }}</a>
                                    <p class="text-sm text-[#7C5A52]">{{ $order->user->name }} · {{ $order->created_at->diffForHumans() }}</p>
                                </div>
                                <span class="badge {{ $order->status_badge }}">{{ $order->status_label }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="text-sm text-[#7C5A52]">{{ $order->items->count() }} item(s)</p>
                                <p class="text-xl font-bold text-[#FFD97D]">₱{{ number_format($order->total, 2) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="p-20 text-center">
                    <p class="text-5xl mb-4">📦</p>
                    <p class="text-[#7C5A52]">No orders yet</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions & Inventory -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="card p-6 space-y-3">
                <h3 class="font-display text-xl font-bold mb-5 text-[#4B2E2A]">Quick Actions</h3>
                @php
                    $actions = [
                        ['label'=>'Add New Product','icon'=>'M12 4v16m8-8H4','link'=>route('admin.products.create'),'bg'=>'#FFD97D20','color'=>'#FFD97D'],
                        ['label'=>'Process Pending Orders','icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2','link'=>route('admin.orders.index', ['status'=>'pending']),'bg'=>'#FFF4E1','color'=>'#4B2E2A'],
                        ['label'=>'View All Customers','icon'=>'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z','link'=>route('admin.customers.index'),'bg'=>'#FFF4E1','color'=>'#4B2E2A'],
                        ['label'=>'Manage Categories','icon'=>'M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z','link'=>route('admin.categories.index'),'bg'=>'#FFF4E1','color'=>'#4B2E2A']
                    ];
                @endphp
                @foreach($actions as $action)
                    <a href="{{ $action['link'] }}" class="flex items-center gap-3 p-3 rounded-xl hover:shadow hover:translate-x-1 transition font-semibold text-sm" style="background: {{ $action['bg'] }}; color: {{ $action['color'] }};">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $action['icon'] }}"></path>
                        </svg>
                        {{ $action['label'] }}
                    </a>
                @endforeach
            </div>

            <!-- Inventory -->
            <div class="card p-6 space-y-3">
                <h3 class="font-display text-xl font-bold mb-5 text-[#4B2E2A]">Inventory Status</h3>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between text-[#7C5A52]"><span>Total Products</span><span class="font-bold text-[#4B2E2A]">{{ $stats['total_products'] }}</span></div>
                    <div class="flex justify-between text-[#7C5A52]"><span>Active</span><span class="font-bold text-[#7CAF7E]">{{ $stats['active_products'] }}</span></div>
                    @if($stats['low_stock_products'] > 0)
                        <div class="flex justify-between text-[#FFD97D]"><span>Low Stock (≤10)</span><a href="{{ route('admin.products.index') }}" class="font-bold hover:underline">{{ $stats['low_stock_products'] }}</a></div>
                    @endif
                    @if($stats['out_of_stock_products'] > 0)
                        <div class="flex justify-between text-[#F28D82]"><span>Out of Stock</span><a href="{{ route('admin.products.index') }}" class="font-bold hover:underline">{{ $stats['out_of_stock_products'] }}</a></div>
                    @endif
                    <div class="pt-3 border-t border-[#FFF4E1] flex justify-between text-[#7C5A52]">
                        <span>Pending Revenue</span>
                        <span class="font-bold text-[#FFD97D]">₱{{ number_format($stats['pending_revenue'],2) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Products -->
    <div class="card">
        <div class="p-6 border-b flex items-center justify-between border-[#FFF4E1]">
            <h2 class="font-display text-2xl font-bold text-[#4B2E2A]">Top Selling Products</h2>
            <a href="{{ route('admin.products.index') }}" class="text-sm font-bold hover:underline text-[#FFD97D]">View All →</a>
        </div>

        @if($topProducts->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b" style="background: var(--parchment); border-color: var(--cream-parchment);">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#7C5A52]">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#7C5A52]">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#7C5A52]">Stock</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-[#7C5A52]">Sold</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-[#FFF4E1]">
                    @foreach($topProducts as $product)
                    <tr class="hover:bg-[#FFF4E1] transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-xl object-cover">
                                <div>
                                    <p class="font-bold text-[#4B2E2A]">{{ $product->name }}</p>
                                    <p class="text-xs text-[#7C5A52]">SKU: {{ $product->sku }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-bold text-[#4B2E2A]">₱{{ number_format($product->price,2) }}</td>
                        <td class="px-6 py-4">
                            <span class="badge {{ $product->stock > 10 ? 'badge-success' : ($product->stock > 0 ? 'badge-warning' : 'badge-danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-6 py-4 font-bold text-[#FFD97D]">{{ $product->total_sold ?? 0 }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="p-20 text-center">
            <p class="text-5xl mb-4">📊</p>
            <p class="text-[#7C5A52]">No sales data yet</p>
        </div>
        @endif
    </div>
</div>
@endsection