@extends('layouts.admin')
@section('title', 'Products Management')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold mb-2" style="color: var(--chocolate);">Products Management</h1>
            <p style="color: var(--chocolate-light);">Manage your bakeshop menu items</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary px-6 py-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down" style="background: #f0fdf4; border-color: var(--sage); color: #4a7a4e;">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down" style="background: #fff5f5; border-color: var(--rose); color: #a03028;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="card p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Product name or SKU..." class="input">
            </div>
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Category</label>
                <select name="category" class="input">
                    <option value="">All Categories</option>
                    @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Status</label>
                <select name="status" class="input">
                    <option value="">All</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn btn-primary flex-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Filter
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost px-4">Reset</a>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="border-b" style="background: var(--parchment); border-color: var(--cream-parchment);">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Category</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Stock</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-wider" style="color: var(--chocolate-light);">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y" style="border-color: var(--cream-parchment);">
                    @forelse($products as $product)
                        <tr class="hover:bg-cream-soft transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-xl object-cover shadow-sm">
                                    <div>
                                        <p class="font-bold" style="color: var(--chocolate);">{{ $product->name }}</p>
                                        <p class="text-xs" style="color: var(--chocolate-light);">SKU: {{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge badge-primary">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-bold" style="color: var(--chocolate);">₱{{ number_format($product->price, 2) }}</p>
                                @if($product->compare_price)
                                    <p class="text-xs line-through" style="color: #aaa;">₱{{ number_format($product->compare_price, 2) }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="badge {{ $product->stock > 10 ? 'badge-success' : ($product->stock > 0 ? 'badge-warning' : 'badge-danger') }}">
                                    {{ $product->stock }} units
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($product->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="p-2 rounded-lg hover:bg-golden-light/10 transition" title="Edit">
                                        <svg class="w-5 h-5" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg hover:bg-rose-light/20 transition" title="Delete">
                                            <svg class="w-5 h-5" style="color: var(--rose);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-20 text-center">
                                <div class="text-6xl mb-4">🥐</div>
                                <p class="font-bold text-lg mb-2" style="color: var(--chocolate);">No products found</p>
                                <p class="mb-6" style="color: var(--chocolate-light);">Start by adding your first product</p>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="p-6 border-t" style="border-color: var(--cream-parchment);">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection