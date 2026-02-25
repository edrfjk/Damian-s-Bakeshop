@extends('layouts.app')
@section('title', $product->name . ' — Damian Bakeshop')

@section('content')

<!-- Breadcrumb -->
<div style="background: var(--parchment); border-bottom: 1px solid rgba(200,134,10,0.12);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex items-center gap-2 text-sm" style="color: var(--chocolate-light);">
            <a href="{{ route('home') }}" class="hover:text-golden-DEFAULT transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('customer.products') }}" class="hover:text-golden-DEFAULT transition">Menu</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('customer.products.category', $product->category->slug) }}" class="hover:text-golden-DEFAULT transition">{{ $product->category->name }}</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span style="color: var(--chocolate);" class="font-semibold">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

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

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">

        <!-- Product Image -->
        <div class="animate-slide-up">
            <div class="card overflow-hidden relative" style="aspect-ratio: 1/1; background: var(--parchment);">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">

                @if($product->compare_price && $product->compare_price > $product->price)
                    <div class="absolute top-5 left-5 px-4 py-2 rounded-full text-sm font-bold text-white shadow-lg" style="background: var(--rose);">
                        SALE — {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF
                    </div>
                @endif

                @if($product->is_featured)
                    <div class="absolute top-5 right-5 px-4 py-2 rounded-full text-sm font-bold text-white shadow-lg" style="background: var(--golden);">
                        ⭐ Bestseller
                    </div>
                @endif

                @if($product->stock <= 0)
                    <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                        <span class="px-6 py-3 rounded-xl font-bold text-white text-lg" style="background: var(--rose);">Out of Stock</span>
                    </div>
                @elseif($product->stock <= 5)
                    <div class="absolute bottom-5 left-5 px-4 py-2 rounded-full text-sm font-bold text-white" style="background: var(--rose);">
                        🔥 Only {{ $product->stock }} left!
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="animate-slide-up stagger-2">
            <p class="text-sm font-bold uppercase tracking-widest mb-2" style="color: var(--golden);">{{ $product->category->name }}</p>
            <h1 class="font-display text-4xl lg:text-5xl font-bold mb-4 leading-tight" style="color: var(--chocolate);">{{ $product->name }}</h1>

            @if($product->short_description)
                <p class="text-lg mb-6 leading-relaxed" style="color: var(--chocolate-light);">{{ $product->short_description }}</p>
            @endif

            <!-- Price -->
            <div class="mb-6 p-5 rounded-2xl" style="background: var(--parchment);">
                <div class="flex items-baseline gap-3">
                    <span class="font-display text-4xl font-bold" style="color: var(--chocolate);">₱{{ number_format($product->price, 2) }}</span>
                    @if($product->compare_price && $product->compare_price > $product->price)
                        <span class="text-xl line-through" style="color: #bbb;">₱{{ number_format($product->compare_price, 2) }}</span>
                        <span class="px-3 py-1 rounded-full text-sm font-bold text-white" style="background: var(--rose);">
                            Save ₱{{ number_format($product->compare_price - $product->price, 2) }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Stock Status -->
            <div class="mb-6">
                @if($product->stock > 10)
                    <span class="badge-success text-sm px-4 py-2">✅ In Stock — Ready to Order</span>
                @elseif($product->stock > 0)
                    <span class="badge-warning text-sm px-4 py-2">⚠️ Low Stock — Only {{ $product->stock }} remaining</span>
                @else
                    <span class="badge-danger text-sm px-4 py-2">❌ Out of Stock</span>
                @endif
            </div>

            <!-- Add to Cart -->
            @if($product->stock > 0)
                @auth
                    @if(auth()->user()->isCustomer())
                        <form action="{{ route('customer.cart.add', $product) }}" method="POST" class="mb-6">
                            @csrf
                            <div class="flex gap-3 mb-4">
                                <!-- Quantity picker -->
                                <div class="flex items-center rounded-xl overflow-hidden border-2" style="border-color: rgba(200,134,10,0.3);">
                                    <button type="button" id="qty-minus"
                                            class="px-4 py-3 font-bold text-xl transition hover:text-white"
                                            style="color: var(--golden);"
                                            onclick="changeQty(-1)">−</button>
                                    <input type="number" name="quantity" id="qty-input"
                                           value="1" min="1" max="{{ $product->stock }}"
                                           class="w-16 text-center text-lg font-bold border-0 outline-none"
                                           style="color: var(--chocolate);">
                                    <button type="button" id="qty-plus"
                                            class="px-4 py-3 font-bold text-xl transition hover:text-white"
                                            style="color: var(--golden);"
                                            onclick="changeQty(1)">+</button>
                                </div>

                                <button type="submit" class="btn btn-primary flex-1 py-4 text-base">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    Add to Cart
                                </button>
                            </div>
                        </form>
                    @endif
                @else
                    <div class="mb-6">
                        <a href="{{ route('login') }}" class="btn btn-primary w-full py-4 text-base">
                            🔑 Login to Order
                        </a>
                        <p class="text-center text-sm mt-3" style="color: var(--chocolate-light);">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold hover:underline" style="color: var(--golden);">Sign up free</a>
                        </p>
                    </div>
                @endauth
            @endif

            <!-- Product Details -->
            <div class="border-t pt-6 space-y-3" style="border-color: rgba(200,134,10,0.15);">
                <div class="flex gap-3 text-sm">
                    <span class="font-bold w-24" style="color: var(--chocolate);">SKU</span>
                    <span style="color: var(--chocolate-light);">{{ $product->sku ?? 'N/A' }}</span>
                </div>
                <div class="flex gap-3 text-sm">
                    <span class="font-bold w-24" style="color: var(--chocolate);">Category</span>
                    <a href="{{ route('customer.products.category', $product->category->slug) }}"
                       class="hover:underline font-semibold" style="color: var(--golden);">{{ $product->category->name }}</a>
                </div>
                <div class="flex gap-3 text-sm">
                    <span class="font-bold w-24" style="color: var(--chocolate);">Freshness</span>
                    <span style="color: var(--chocolate-light);">Baked fresh daily 🌅</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    @if($product->description)
        <div class="card p-8 mb-12 animate-slide-up">
            <h2 class="font-display text-2xl font-bold mb-2" style="color: var(--chocolate);">About this Product</h2>
            <span class="gold-line-left mb-4"></span>
            <p class="leading-relaxed text-base" style="color: var(--chocolate-light);">{{ $product->description }}</p>
        </div>
    @endif

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
        <div class="animate-slide-up">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="script-font text-xl mb-1" style="color: var(--golden);">More from the Bakeshop</p>
                    <h2 class="font-display text-3xl font-bold" style="color: var(--chocolate);">You Might Also Like</h2>
                </div>
                <a href="{{ route('customer.products.category', $product->category->slug) }}" class="btn btn-secondary text-sm py-2 px-5">
                    View All
                </a>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($relatedProducts as $related)
                    <a href="{{ route('customer.products.show', $related->slug) }}" class="card-hover">
                        <div class="img-zoom" style="aspect-ratio: 1/1; background: var(--parchment);">
                            <img src="{{ $related->image_url }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                        </div>
                        <div class="p-4">
                            <h3 class="font-display font-bold text-sm mb-1 leading-tight" style="color: var(--chocolate);">{{ $related->name }}</h3>
                            <span class="font-bold text-lg" style="color: var(--golden-dark);">₱{{ number_format($related->price, 2) }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script>
function changeQty(delta) {
    const input = document.getElementById('qty-input');
    const max   = parseInt(input.max) || 99;
    let val = parseInt(input.value) + delta;
    if (val < 1)   val = 1;
    if (val > max) val = max;
    input.value = val;
}
</script>
@endpush
@endsection