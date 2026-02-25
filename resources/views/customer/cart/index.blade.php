@extends('layouts.app')
@section('title', 'Shopping Cart — Damian Bakeshop')

@section('content')

<section class="py-16 text-center" style="background: var(--parchment);">
    <div class="animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden);">Your Cart</p>
        <h1 class="font-display text-4xl font-bold" style="color: var(--chocolate);">Shopping Cart</h1>
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

    @if($errors->any())
        <div class="mb-6 p-4 rounded-xl border-l-4 text-sm" style="background: #fff5f5; border-color: var(--rose); color: #a03028;">
            <p class="font-bold mb-2">Please fix the following errors:</p>
            <ul class="list-disc pl-5 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($cart && $cart->items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="card">
                    <div class="p-6 border-b" style="border-color: var(--cream-parchment);">
                        <h2 class="font-display text-2xl font-bold" style="color: var(--chocolate);">Your Items ({{ $cart->items->count() }})</h2>
                    </div>

                    <div class="divide-y" style="border-color: var(--cream-parchment);">
                        @foreach($cart->items as $item)
                            <div class="p-6 flex gap-6 animate-fade-in">
                                <a href="{{ route('customer.products.show', $item->product->slug) }}" class="w-28 h-28 rounded-xl overflow-hidden shrink-0 bg-cream-parchment">
                                    <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover hover:scale-105 transition-transform">
                                </a>

                                <div class="flex-1 min-w-0">
                                    <div class="flex items-start justify-between gap-4 mb-2">
                                        <div class="flex-1">
                                            <a href="{{ route('customer.products.show', $item->product->slug) }}" class="font-display font-bold text-lg hover:underline leading-tight block mb-1" style="color: var(--chocolate);">
                                                {{ $item->product->name }}
                                            </a>
                                            <p class="text-xs font-bold uppercase tracking-wider" style="color: var(--golden);">{{ $item->product->category->name }}</p>
                                            <p class="text-sm mt-1" style="color: var(--chocolate-light);">₱{{ number_format($item->price, 2) }} each</p>
                                        </div>
                                        <!-- FIXED: Added item ID to route -->
                                        <form action="{{ route('customer.cart.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg hover:bg-rose-light/20 transition" title="Remove" onclick="return confirm('Remove this item from cart?')">
                                                <svg class="w-5 h-5" style="color: var(--rose);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="flex items-center justify-between gap-4 mt-4">
                                        <!-- FIXED: Added item ID to route -->
                                        <form action="{{ route('customer.cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <label class="text-sm font-semibold" style="color: var(--chocolate-light);">Qty:</label>
                                            <div class="flex items-center border-2 rounded-lg overflow-hidden" style="border-color: var(--golden-light);">
                                                <button type="button" onclick="let input = this.nextElementSibling; if(input.value > 1) { input.value--; this.closest('form').submit(); }" class="px-3 py-1 font-bold hover:bg-cream-parchment transition" style="color: var(--golden);">−</button>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-16 text-center border-0 font-bold py-1" style="color: var(--chocolate);" onchange="this.form.submit()">
                                                <button type="button" onclick="let input = this.previousElementSibling; if(input.value < {{ $item->product->stock }}) { input.value++; this.closest('form').submit(); }" class="px-3 py-1 font-bold hover:bg-cream-parchment transition" style="color: var(--golden);">+</button>
                                            </div>
                                            <p class="text-xs ml-2" style="color: var(--chocolate-light);">{{ $item->product->stock }} available</p>
                                        </form>

                                        <div class="text-right">
                                            <p class="text-2xl font-bold" style="color: var(--chocolate);">₱{{ number_format($item->price * $item->quantity, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('customer.products') }}" class="inline-flex items-center gap-2 mt-6 text-sm font-semibold hover:underline" style="color: var(--golden);">
                    ← Continue Shopping
                </a>
            </div>

            <!-- Order Summary & Checkout -->
            <div class="lg:col-span-1">
                <div class="card sticky top-24">
                    <div class="p-6 border-b" style="border-color: var(--cream-parchment);">
                        <h3 class="font-display text-xl font-bold" style="color: var(--chocolate);">Order Summary</h3>
                    </div>

                    <div class="p-6 space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span style="color: var(--chocolate-light);">Subtotal ({{ $cart->items->sum('quantity') }} items)</span>
                            <span class="font-bold" style="color: var(--chocolate);">₱{{ number_format($cart->subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span style="color: var(--chocolate-light);">Shipping Fee</span>
                            <span class="font-bold" style="color: var(--chocolate);">
                                @if($cart->subtotal >= 500)
                                    <span class="text-sage-DEFAULT">FREE</span>
                                @else
                                    ₱50.00
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between pt-3 border-t" style="border-color: var(--cream-parchment);">
                            <span class="font-bold" style="color: var(--chocolate);">Total</span>
                            <span class="text-2xl font-bold" style="color: var(--golden);">
                                ₱{{ number_format($cart->subtotal >= 500 ? $cart->subtotal : $cart->subtotal + 50, 2) }}
                            </span>
                        </div>

                        @if($cart->subtotal < 500)
                            <div class="p-3 rounded-xl text-xs" style="background: rgba(200,134,10,0.1); color: var(--golden-dark);">
                                <strong>💡 Tip:</strong> Add ₱{{ number_format(500 - $cart->subtotal, 2) }} more to get FREE shipping!
                            </div>
                        @else
                            <div class="p-3 rounded-xl text-xs" style="background: rgba(122,158,126,0.1); color: var(--sage);">
                                <strong>🎉 Congrats!</strong> You qualify for FREE shipping!
                            </div>
                        @endif
                    </div>

                    <div class="p-6 pt-0">
                        <button onclick="document.getElementById('checkoutModal').classList.remove('hidden')" class="btn btn-primary w-full text-lg py-4">
                            Proceed to Checkout
                        </button>
                        <p class="text-xs text-center mt-3" style="color: var(--chocolate-light);">Secure checkout • Cash on Delivery</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Modal -->
        <div id="checkoutModal" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
            <div class="card max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-scale-in">
                <div class="p-6 border-b flex items-center justify-between sticky top-0 bg-white z-10" style="border-color: var(--cream-parchment);">
                    <h3 class="font-display text-2xl font-bold" style="color: var(--chocolate);">Shipping Details</h3>
                    <button onclick="document.getElementById('checkoutModal').classList.add('hidden')" class="p-2 hover:bg-cream-parchment rounded-lg transition">
                        <svg class="w-6 h-6" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form action="{{ route('customer.cart.checkout') }}" method="POST" class="p-6">
                    @csrf
                    <div class="space-y-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Full Name *</label>
                                <input type="text" name="shipping_name" value="{{ old('shipping_name', auth()->user()->name) }}" class="input" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Phone *</label>
                                <input type="tel" name="shipping_phone" value="{{ old('shipping_phone', auth()->user()->phone) }}" class="input" placeholder="+63 912 345 6789" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Email *</label>
                            <input type="email" name="shipping_email" value="{{ old('shipping_email', auth()->user()->email) }}" class="input" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Complete Address *</label>
                            <input type="text" name="shipping_address" value="{{ old('shipping_address', auth()->user()->address) }}" class="input" placeholder="House #, Street, Barangay" required>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">City *</label>
                                <input type="text" name="shipping_city" value="{{ old('shipping_city', auth()->user()->city) }}" class="input" placeholder="San Fernando" required>
                            </div>
                            <div>
                                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Postal Code *</label>
                                <input type="text" name="shipping_postal_code" value="{{ old('shipping_postal_code', auth()->user()->postal_code) }}" class="input" placeholder="2500" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Delivery Notes (optional)</label>
                            <textarea name="notes" rows="3" class="input" placeholder="Special instructions, landmarks, preferred delivery time...">{{ old('notes') }}</textarea>
                        </div>

                        <div class="p-4 rounded-xl" style="background: rgba(200,134,10,0.08); border: 1px solid rgba(200,134,10,0.2);">
                            <p class="text-sm font-bold mb-2" style="color: var(--golden-dark);">Payment Method</p>
                            <div class="flex items-center gap-3">
                                <input type="radio" name="payment_method" value="cod" id="cod" checked class="w-4 h-4" style="accent-color: var(--golden);">
                                <label for="cod" class="text-sm font-semibold" style="color: var(--chocolate);">💵 Cash on Delivery</label>
                            </div>
                            <p class="text-xs mt-2" style="color: var(--chocolate-light);">Pay when you receive your order. No upfront payment required!</p>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <button type="button" onclick="document.getElementById('checkoutModal').classList.add('hidden')" class="btn btn-ghost flex-1 py-3">Cancel</button>
                        <button type="submit" class="btn btn-primary flex-1 py-3">
                            Place Order ₱{{ number_format($cart->subtotal >= 500 ? $cart->subtotal : $cart->subtotal + 50, 2) }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    @else
        <div class="card p-20 text-center">
            <div class="text-8xl mb-6">🛒</div>
            <h2 class="font-display text-3xl font-bold mb-3" style="color: var(--chocolate);">Your Cart is Empty</h2>
            <p class="mb-8 max-w-md mx-auto" style="color: var(--chocolate-light);">Looks like you haven't added any delicious items yet. Browse our fresh baked goods and start your order!</p>
            <a href="{{ route('customer.products') }}" class="btn btn-primary text-lg px-10 py-4">Start Shopping</a>
        </div>
    @endif
</div>

@endsection