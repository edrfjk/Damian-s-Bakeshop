{{-- ════════════════ CATEGORY VIEW ════════════════ --}}
{{-- Save as: resources/views/customer/products/category.blade.php --}}
@extends('layouts.app')
@section('title', $category->name . ' — Damian Bakeshop')

@section('content')

<section class="py-16 text-center relative overflow-hidden" style="background: linear-gradient(135deg, #3d1f0a, #6b3a1f);">
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
        <span class="text-[300px]">{{ $category->name === 'Breads' ? '🥖' : ($category->name === 'Cakes' ? '🎂' : ($category->name === 'Pastries' ? '🥐' : '🍰')) }}</span>
    </div>
    <div class="relative z-10 animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden-light);">Browse Category</p>
        <h1 class="font-display text-5xl font-bold text-white mb-4">{{ $category->name }}</h1>
        @if($category->description)
            <p class="text-white/60 max-w-2xl mx-auto px-4">{{ $category->description }}</p>
        @endif
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 50" xmlns="http://www.w3.org/2000/svg" style="fill: var(--warm-cream);"><path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z"/></svg>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down" style="background: #f0fdf4; border-color: var(--sage); color: #4a7a4e;">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar -->
        <div class="w-full lg:w-64 shrink-0">
            <div class="card p-6 sticky top-24">
                <h3 class="font-display font-bold text-xl mb-5" style="color: var(--chocolate);">Categories</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('customer.products') }}" class="flex items-center justify-between py-2.5 px-4 rounded-xl font-semibold text-sm transition hover:bg-cream-parchment" style="color: var(--chocolate-light);">
                            <span>🍞 All Products</span>
                        </a>
                    </li>
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('customer.products.category', $cat->slug) }}"
                               class="flex items-center justify-between py-2.5 px-4 rounded-xl font-semibold text-sm transition {{ $cat->id === $category->id ? 'text-white' : 'hover:bg-cream-parchment' }}"
                               style="{{ $cat->id === $category->id ? 'background: linear-gradient(135deg, #c8860a, #e8a020);' : 'color: var(--chocolate-light);' }}">
                                <span>{{ $cat->name }}</span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background: {{ $cat->id === $category->id ? 'rgba(255,255,255,0.2)' : 'rgba(200,134,10,0.1)' }}; color: {{ $cat->id === $category->id ? 'white' : 'var(--golden)' }};">
                                    {{ $cat->products_count ?? '' }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Products -->
        <div class="flex-1">
            <div class="flex items-center justify-between mb-6">
                <p class="text-sm font-semibold" style="color: var(--chocolate-light);">{{ $products->total() }} product(s) found</p>
                <a href="{{ route('customer.products') }}" class="text-sm font-semibold hover:underline" style="color: var(--golden);">← Back to All Products</a>
            </div>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="card-hover animate-slide-up">
                            <a href="{{ route('customer.products.show', $product->slug) }}">
                                <div class="img-zoom relative" style="aspect-ratio: 4/3; background: var(--parchment);">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @if($product->is_featured)
                                        <div class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background: var(--golden);">⭐</div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-5">
                                <p class="text-xs font-bold uppercase tracking-wider mb-1" style="color: var(--golden);">{{ $product->category->name }}</p>
                                <h3 class="font-display font-bold text-lg mb-2 leading-tight" style="color: var(--chocolate);">{{ $product->name }}</h3>
                                <div class="flex items-center justify-between">
                                    <span class="text-xl font-bold" style="color: var(--chocolate);">₱{{ number_format($product->price, 2) }}</span>
                                    @if($product->stock > 0)
                                        @auth
                                            @if(auth()->user()->isCustomer())
                                                <form action="{{ route('customer.cart.add', $product) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-primary text-xs py-2 px-4">+ Cart</button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-primary text-xs py-2 px-4">Order</a>
                                        @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">{{ $products->links() }}</div>
            @else
                <div class="text-center py-20">
                    <div class="text-7xl mb-4">🥐</div>
                    <h3 class="font-display text-2xl font-bold mb-2" style="color: var(--chocolate);">No products in this category yet</h3>
                    <p class="mb-6" style="color: var(--chocolate-light);">Check back soon or browse all products!</p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary">View All Products</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


{{-- ════════════════ SEARCH VIEW ════════════════ --}}
{{-- Save as: resources/views/customer/products/search.blade.php --}}