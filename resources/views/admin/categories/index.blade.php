@extends('layouts.admin')
@section('title', 'Categories Management')

@section('content')
<div class="p-8">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold mb-2" style="color: var(--chocolate);">Categories Management</h1>
            <p style="color: var(--chocolate-light);">Organize your bakeshop menu</p>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary px-6 py-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add New Category
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

    @if($categories->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($categories as $category)
                <div class="card-hover animate-slide-up" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                    @if($category->image)
                        <div class="aspect-video bg-cream-parchment overflow-hidden">
                            <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="aspect-video flex items-center justify-center text-6xl" style="background: var(--parchment);">
                            {{ ['🥖','🥐','🍰','🎂','🧁','🍩'][$loop->index % 6] }}
                        </div>
                    @endif

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-3 mb-3">
                            <div class="flex-1">
                                <h3 class="font-display text-xl font-bold mb-1" style="color: var(--chocolate);">{{ $category->name }}</h3>
                                @if($category->description)
                                    <p class="text-sm line-clamp-2" style="color: var(--chocolate-light);">{{ $category->description }}</p>
                                @endif
                            </div>
                            @if($category->is_active)
                                <span class="badge badge-success shrink-0">Active</span>
                            @else
                                <span class="badge badge-danger shrink-0">Inactive</span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t mb-4" style="border-color: var(--cream-parchment);">
                            <div class="flex items-center gap-4 text-sm">
                                <div>
                                    <p class="text-xs" style="color: var(--chocolate-light);">Products</p>
                                    <p class="font-bold" style="color: var(--golden);">{{ $category->products_count }}</p>
                                </div>
                                <div>
                                    <p class="text-xs" style="color: var(--chocolate-light);">Sort Order</p>
                                    <p class="font-bold" style="color: var(--chocolate);">{{ $category->sort_order }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary flex-1 text-sm py-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Delete this category? Products in this category will NOT be deleted.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-ghost px-4 py-2">
                                    <svg class="w-5 h-5" style="color: var(--rose);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="card p-20 text-center">
            <div class="text-8xl mb-6">🏷️</div>
            <h2 class="text-3xl font-display font-bold mb-3" style="color: var(--chocolate);">No Categories Yet</h2>
            <p class="mb-8 max-w-md mx-auto" style="color: var(--chocolate-light);">Categories help organize your bakeshop menu. Create your first category to get started!</p>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary text-lg px-10 py-4">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Create First Category
            </a>
        </div>
    @endif
</div>
@endsection