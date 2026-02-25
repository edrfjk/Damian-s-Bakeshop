@extends('layouts.app')
@section('title', 'Our Menu — Damian Bakeshop')

@section('content')

<!-- Page Header -->
<section class="py-16 text-center relative overflow-hidden" style="background: linear-gradient(135deg, #3d1f0a, #6b3a1f);">
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
        <span class="text-[300px]">🥐</span>
    </div>
    <div class="relative z-10 animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden-light);">Freshly Baked Daily</p>
        <h1 class="font-display text-5xl font-bold text-white mb-4">Our Bakery Menu</h1>
        <p class="text-white/60">Order online, pick up fresh or get it delivered to your door.</p>
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

    @if(session('error'))
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm font-semibold animate-slide-down" style="background: #fff5f5; border-color: var(--rose); color: #a03028;">
            ⚠️ {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-8">

        <!-- Sidebar: Categories -->
        <div class="w-full lg:w-64 shrink-0">
            <div class="card p-6 sticky top-24">
                <h3 class="font-display font-bold text-xl mb-5" style="color: var(--chocolate);">Categories</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('customer.products') }}"
                           class="flex items-center justify-between py-2.5 px-4 rounded-xl font-semibold text-sm transition {{ !request()->is('*/category/*') && !request('search') ? 'text-white' : '' }}"
                           style="{{ !request()->is('*/category/*') && !request('search') ? 'background: linear-gradient(135deg, #c8860a, #e8a020); color: white;' : 'color: var(--chocolate-light);' }}">
                            <span>🍞 All Products</span>
                        </a>
                    </li>
                    @foreach($categories as $category)
                        <li>
                            <a href="{{ route('customer.products.category', $category->slug) }}"
                               class="flex items-center justify-between py-2.5 px-4 rounded-xl font-semibold text-sm transition hover:bg-cream-parchment"
                               style="color: var(--chocolate-light);">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs font-bold px-2 py-0.5 rounded-full" style="background: rgba(200,134,10,0.1); color: var(--golden);">
                                    {{ $category->products_count ?? '' }}
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Delivery info reminder -->
                <div class="mt-6 p-4 rounded-xl" style="background: rgba(200,134,10,0.08); border: 1px solid rgba(200,134,10,0.2);">
                    <p class="text-xs font-bold mb-1" style="color: var(--golden-dark);">🛵 Free Delivery</p>
                    <p class="text-xs" style="color: var(--chocolate-light);">On orders over ₱500 within San Fernando</p>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-1">
            <!-- Search & Sort bar -->
            <div class="card p-5 mb-6">
                <div class="flex flex-col sm:flex-row gap-4">
                    <form action="{{ route('customer.products.search') }}" method="GET" class="flex-1">
                        <div class="relative">
                            <input type="text" name="q" placeholder="Search our menu..." value="{{ request('q') }}" class="input pl-11">
                            <svg class="w-5 h-5 absolute left-3.5 top-1/2 -translate-y-1/2" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </form>

                    <select class="input w-full sm:w-48" onchange="window.location.href=this.value">
                        <option value="{{ route('customer.products') }}">Sort: Latest</option>
                        <option value="{{ route('customer.products', ['sort'=>'price_low']) }}" {{ request('sort')=='price_low'?'selected':'' }}>Price: Low → High</option>
                        <option value="{{ route('customer.products', ['sort'=>'price_high']) }}" {{ request('sort')=='price_high'?'selected':'' }}>Price: High → Low</option>
                        <option value="{{ route('customer.products', ['sort'=>'popular']) }}" {{ request('sort')=='popular'?'selected':'' }}>Most Popular</option>
                    </select>
                </div>
            </div>

            <!-- Product count -->
            <p class="text-sm mb-5 font-semibold" style="color: var(--chocolate-light);">
                Showing {{ $products->total() }} fresh baked product(s)
            </p>

            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="card-hover animate-slide-up" style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <a href="{{ route('customer.products.show', $product->slug) }}">
                                <div class="img-zoom relative" style="aspect-ratio: 4/3; background: var(--parchment);">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @if($product->compare_price && $product->compare_price > $product->price)
                                        <div class="absolute top-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background: var(--rose);">
                                            SALE {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF
                                        </div>
                                    @endif
                                    @if($product->is_featured)
                                        <div class="absolute top-3 right-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background: var(--golden);">
                                            ⭐ Popular
                                        </div>
                                    @endif
                                    @if($product->stock <= 0)
                                        <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                            <span class="px-4 py-2 rounded-xl font-bold text-white" style="background: var(--rose);">Out of Stock</span>
                                        </div>
                                    @elseif($product->stock <= 5)
                                        <div class="absolute bottom-3 left-3 px-3 py-1 rounded-full text-xs font-bold text-white" style="background: var(--rose);">
                                            Only {{ $product->stock }} left!
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-5">
                                <p class="text-xs font-bold uppercase tracking-wider mb-1" style="color: var(--golden);">{{ $product->category->name }}</p>
                                <h3 class="font-display font-bold text-lg mb-2 leading-tight" style="color: var(--chocolate);">{{ $product->name }}</h3>
                                @if($product->short_description)
                                    <p class="text-sm mb-3 line-clamp-2" style="color: var(--chocolate-light);">{{ $product->short_description }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <div>
                                        <span class="text-xl font-bold" style="color: var(--chocolate);">₱{{ number_format($product->price, 2) }}</span>
                                        @if($product->compare_price)
                                            <span class="text-sm line-through ml-2" style="color: #bbb;">₱{{ number_format($product->compare_price, 2) }}</span>
                                        @endif
                                    </div>
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
                    <h3 class="font-display text-2xl font-bold mb-2" style="color: var(--chocolate);">Nothing here yet!</h3>
                    <p class="mb-6" style="color: var(--chocolate-light);">Try a different category or search term.</p>
                    <a href="{{ route('customer.products') }}" class="btn btn-primary">View All Products</a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection