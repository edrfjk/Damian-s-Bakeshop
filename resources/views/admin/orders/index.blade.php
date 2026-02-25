@extends('layouts.admin')
@section('title', 'Orders Management')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold mb-2" style="color: var(--chocolate);">Orders Management</h1>
        <p style="color: var(--chocolate-light);">Manage customer orders and update status</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down" style="background: #f0fdf4; border-color: var(--sage); color: #4a7a4e;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="grid grid-cols-2 md:grid-cols-6 gap-4 mb-6">
        @php
            $statusCounts = \App\Models\Order::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status');
        @endphp
        @foreach([
            ['status'=>'pending','label'=>'Pending','color'=>'var(--golden-light)'],
            ['status'=>'confirmed','label'=>'Confirmed','color'=>'#3b82f6'],
            ['status'=>'processing','label'=>'Processing','color'=>'#8b5cf6'],
            ['status'=>'shipped','label'=>'Shipped','color'=>'#6366f1'],
            ['status'=>'delivered','label'=>'Delivered','color'=>'var(--sage)'],
            ['status'=>'cancelled','label'=>'Cancelled','color'=>'var(--rose)'],
        ] as $stat)
        <a href="{{ route('admin.orders.index', ['status'=>$stat['status']]) }}" class="card p-4 text-center hover:shadow-warm-lg transition {{ request('status') == $stat['status'] ? 'ring-2' : '' }}" style="{{ request('status') == $stat['status'] ? 'ring-color: '.$stat['color'].';' : '' }}">
            <p class="text-2xl font-bold mb-1" style="color: {{ $stat['color'] }};">{{ $statusCounts[$stat['status']] ?? 0 }}</p>
            <p class="text-xs font-semibold" style="color: var(--chocolate-light);">{{ $stat['label'] }}</p>
        </a>
        @endforeach
    </div>

    <!-- Filters -->
    <div class="card p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Order # or customer name..." class="input">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Status</label>
                <select name="status" class="input">
                    <option value="">All Statuses</option>
                    @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Date Range</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="input">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn btn-primary flex-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Filter
                </button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost px-4">Reset</a>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b" style="background: var(--parchment); border-color: var(--cream-parchment);">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Order Details</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Items</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: var(--cream-parchment);">
                    @forelse($orders as $order)
                        <tr class="hover:bg-cream-soft transition">
                            <td class="px-6 py-4">
                                <div>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="font-bold text-lg hover:underline" style="color: var(--chocolate);">{{ $order->order_number }}</a>
                                    <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->created_at->format('M d, Y g:i A') }}</p>
                                    <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->created_at->diffForHumans() }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $order->user->avatar_url }}" alt="" class="w-10 h-10 rounded-full border-2" style="border-color: var(--golden-light);">
                                    <div>
                                        <p class="font-bold text-sm" style="color: var(--chocolate);">{{ $order->user->name }}</p>
                                        <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="flex -space-x-2">
                                        @foreach($order->items->take(3) as $item)
                                            <img src="{{ $item->product->image_url }}" alt="" class="w-8 h-8 rounded-lg object-cover border-2 border-white shadow-sm" title="{{ $item->product->name }}">
                                        @endforeach
                                    </div>
                                    <span class="text-sm font-semibold" style="color: var(--chocolate);">{{ $order->items->count() }} item(s)</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-lg font-bold" style="color: var(--golden);">₱{{ number_format($order->total, 2) }}</p>
                                <p class="text-xs" style="color: var(--chocolate-light);">{{ $order->payment_method === 'cod' ? 'Cash on Delivery' : ucfirst($order->payment_method) }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge {{ $order->status_badge }}">{{ $order->status_label }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary text-xs py-2 px-4">
                                        View Details
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="text-6xl mb-4">📦</div>
                                <p class="font-bold text-lg mb-2" style="color: var(--chocolate);">No orders found</p>
                                <p style="color: var(--chocolate-light);">Orders will appear here when customers place them</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-6 border-t" style="border-color: var(--cream-parchment);">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection