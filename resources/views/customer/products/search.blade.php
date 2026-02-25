@extends('layouts.app')
@section('title', 'Search Results — Damian Bakeshop')

@section('content')

<section class="py-16 text-center" style="background: var(--parchment);">
    <div class="animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden);">Search Results</p>
        <h1 class="font-display text-4xl font-bold mb-4" style="color: var(--chocolate);">
            @if(request('q'))
                "{{ request('q') }}"
            @else
                Browse Our Menu
            @endif
        </h1>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    
    <!-- Search Bar -->
    <form action="{{ route('customer.products.search') }}" method="GET" class="mb-8">
        <div class="card p-6">
            <div class="flex gap-4">
                <div class="flex-1 relative">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search for breads, cakes, pastries..." class="input pl-11 text-lg" autofocus>
                    <svg class="w-6 h-6 absolute left-3.5 top-1/2 -translate-y-1/2" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <button type="submit" class="btn btn-primary px-8">Search</button>
            </div>
        </div>
    </form>

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Sidebar -->
        <div class="w-full lg:w-64 shrink-0">
            <div class="card p-6">
                <h3 class="font-display font-bold text-xl mb-5" style="color: var(--chocolate);">Filter by Category</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('customer.products') }}" class="flex items-center justify-between py-2.5 px-4 rounded-xl font-semibold text-sm transition hover:bg-cream-parchment" style="color: var(--chocolate-light);">
                            <span>🍞 All Products</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('customer.products.category', $category->slug) }}" class="flex items-center justify-between py-2.5 px-4 rounded-xl font-semibold text-sm transition hover:bg-cream-parchment" style="color: var(--chocolate-light);">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background: rgba(200,134,10,0.1); color: var(--golden);">
                                    {{ $category->products_count ?? '' }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Results -->
        <div class="flex-1">
            <p class="text-sm mb-6 font-semibold" style="color: var(--chocolate-light);">
                @if(request('q'))
                    Found {{ $products->total() }} result(s) for "{{ request('q') }}"
                @else
                    Showing all products
                @endif
            </p>

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
                                    @if($product->stock <= 0)
                                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                            <span class="px-4 py-2 rounded-xl font-bold text-white" style="background: var(--rose);">Out of Stock</span>
                                        </div>
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

                <div class="mt-8">{{ $products->appends(['q' => request('q')])->links() }}</div>
            @else
                <div class="card p-20 text-center">
                    <div class="text-7xl mb-6">🔍</div>
                    <h3 class="font-display text-2xl font-bold mb-3" style="color: var(--chocolate);">No Results Found</h3>
                    <p class="mb-6 max-w-md mx-auto" style="color: var(--chocolate-light);">
                        We couldn't find any products matching "{{ request('q') }}". Try different keywords or browse all products.
                    </p>
                    <div class="flex gap-3 justify-center">
                        <a href="{{ route('customer.products') }}" class="btn btn-primary">View All Products</a>
                        <a href="{{ route('customer.products.search') }}" class="btn btn-secondary">Try Another Search</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection