@extends('layouts.admin')
@section('title', 'Customers Management')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-display font-bold mb-2" style="color: var(--chocolate);">Customers Management</h1>
        <p style="color: var(--chocolate-light);">View and manage customer accounts</p>
    </div>

    <!-- Filters -->
    <div class="card p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2">
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name, email, or phone..." class="input">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn btn-primary flex-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Search
                </button>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-ghost px-4">Reset</a>
            </div>
        </form>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="card p-6 text-center">
            <p class="text-3xl font-bold mb-1" style="color: var(--golden);">{{ $customers->total() }}</p>
            <p class="text-sm" style="color: var(--chocolate-light);">Total Customers</p>
        </div>
        <div class="card p-6 text-center">
            <p class="text-3xl font-bold mb-1" style="color: var(--sage);">{{ \App\Models\User::where('role', 'customer')->whereHas('orders')->count() }}</p>
            <p class="text-sm" style="color: var(--chocolate-light);">With Orders</p>
        </div>
        <div class="card p-6 text-center">
            <p class="text-3xl font-bold mb-1" style="color: var(--rose);">{{ \App\Models\User::where('role', 'customer')->where('created_at', '>=', now()->subDays(30))->count() }}</p>
            <p class="text-sm" style="color: var(--chocolate-light);">New (30 days)</p>
        </div>
        <div class="card p-6 text-center">
            <p class="text-3xl font-bold mb-1" style="color: var(--chocolate);">₱{{ number_format(\App\Models\Order::where('status', 'delivered')->sum('total'), 2) }}</p>
            <p class="text-sm" style="color: var(--chocolate-light);">Total Revenue</p>
        </div>
    </div>

    <!-- Customers Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b" style="background: var(--parchment); border-color: var(--cream-parchment);">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Customer</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Contact</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Orders</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Total Spent</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Joined</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: var(--cream-parchment);">
                    @forelse($customers as $customer)
                        <tr class="hover:bg-cream-soft transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $customer->avatar_url }}" alt="{{ $customer->name }}" class="w-12 h-12 rounded-full border-2" style="border-color: var(--golden-light);">
                                    <div>
                                        <p class="font-bold" style="color: var(--chocolate);">{{ $customer->name }}</p>
                                        <p class="text-xs" style="color: var(--chocolate-light);">ID: #{{ $customer->id }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm" style="color: var(--chocolate);">{{ $customer->email }}</p>
                                    @if($customer->phone)
                                        <p class="text-xs" style="color: var(--chocolate-light);">{{ $customer->phone }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge badge-primary">{{ $customer->orders_count }} orders</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold text-lg" style="color: var(--golden);">
                                    ₱{{ number_format($customer->orders()->where('status', 'delivered')->sum('total'), 2) }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm" style="color: var(--chocolate);">{{ $customer->created_at->format('M d, Y') }}</p>
                                <p class="text-xs" style="color: var(--chocolate-light);">{{ $customer->created_at->diffForHumans() }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('admin.customers.show', $customer) }}" class="btn btn-primary text-xs py-2 px-4">
                                    View Profile
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="text-6xl mb-4">👥</div>
                                <p class="font-bold text-lg mb-2" style="color: var(--chocolate);">No customers found</p>
                                <p style="color: var(--chocolate-light);">Customers will appear here when they register</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($customers->hasPages())
            <div class="p-6 border-t" style="border-color: var(--cream-parchment);">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
</div>
@endsection