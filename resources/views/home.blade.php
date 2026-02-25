@extends('layouts.app')
@section('title', 'Damian Bakeshop — Freshly Baked in La Union')

@section('content')

{{-- ═══════════════════════════════════════════ HERO ══ --}}
<section class="relative min-h-screen flex items-center overflow-hidden" style="background: linear-gradient(135deg, #3d1f0a 0%, #6b3a1f 50%, #9a6508 100%);">

    <!-- Decorative blobs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full opacity-10 blur-3xl" style="background: var(--golden-light); transform: translate(30%, -30%);"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full opacity-10 blur-3xl" style="background: var(--rose); transform: translate(-30%, 30%);"></div>
        <!-- Floating pastries -->
        <div class="absolute top-20 right-20 text-8xl opacity-20 animate-float">🧁</div>
        <div class="absolute bottom-40 left-10 text-6xl opacity-15 animate-float stagger-3">🥐</div>
        <div class="absolute top-1/3 left-1/4 text-5xl opacity-10 animate-float stagger-5">🍩</div>
        <div class="absolute bottom-20 right-1/4 text-7xl opacity-15 animate-float stagger-2">🍰</div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        <!-- Text -->
        <div class="animate-slide-up">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold mb-6" style="background: rgba(200,134,10,0.2); color: var(--golden-light); border: 1px solid rgba(200,134,10,0.3);">
                <span class="w-2 h-2 rounded-full animate-shimmer" style="background: var(--golden-light);"></span>
                Fresh Baked Daily · La Union's Finest
            </div>

            <h1 class="font-display text-5xl lg:text-7xl font-bold text-white leading-tight mb-6">
                Baked with<br>
                <span class="script-font italic" style="color: var(--golden-light); font-size: 1.15em;">Love &amp; Tradition</span>
            </h1>

            <p class="text-white/70 text-lg leading-relaxed mb-10 max-w-lg">
                From soft pandesal at dawn to celebration cakes that steal the show — every bite from Damian Bakeshop is handcrafted with generations of Filipino baking mastery.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="{{ route('customer.products') }}" class="btn btn-primary text-base px-8 py-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                    Order Now
                </a>
                <a href="{{ route('about') }}" class="btn btn-white text-base px-8 py-4" style="color: var(--chocolate);">
                    Our Story
                </a>
            </div>

            <!-- Stats -->
            <div class="mt-14 flex gap-10">
                <div>
                    <p class="font-display text-3xl font-bold text-white">14+</p>
                    <p class="text-white/50 text-sm">Years Baking</p>
                </div>
                <div class="border-l border-white/10 pl-10">
                    <p class="font-display text-3xl font-bold text-white">50+</p>
                    <p class="text-white/50 text-sm">Menu Items</p>
                </div>
                <div class="border-l border-white/10 pl-10">
                    <p class="font-display text-3xl font-bold text-white">2k+</p>
                    <p class="text-white/50 text-sm">Happy Customers</p>
                </div>
            </div>
        </div>

        <!-- Hero image collage -->
        <div class="hidden lg:block relative animate-fade-in stagger-3">
            <div class="relative">
                <!-- Main circle display -->
                <div class="w-80 h-80 mx-auto rounded-full overflow-hidden border-8 border-golden-DEFAULT/30 shadow-2xl" style="background: linear-gradient(135deg, rgba(200,134,10,0.3), rgba(61,31,10,0.5));">
                    <div class="w-full h-full flex items-center justify-center">
                        <span class="text-[120px] animate-float">🎂</span>
                    </div>
                </div>
                <!-- Floating cards -->
                <div class="absolute -top-4 -left-8 bg-white rounded-2xl p-4 shadow-warm animate-float stagger-1">
                    <p class="text-xs font-bold mb-1" style="color: var(--golden);">Today's Special</p>
                    <p class="font-display font-bold text-sm" style="color: var(--chocolate);">Ube Ensaymada</p>
                    <p class="text-xs" style="color: var(--chocolate-light);">₱45 each</p>
                </div>
                <div class="absolute -bottom-4 -right-8 bg-white rounded-2xl p-4 shadow-warm animate-float stagger-4">
                    <div class="flex items-center gap-2">
                        <span class="text-2xl">⭐</span>
                        <div>
                            <p class="font-display font-bold text-sm" style="color: var(--chocolate);">4.9 / 5.0</p>
                            <p class="text-xs" style="color: var(--chocolate-light);">Customer Rating</p>
                        </div>
                    </div>
                </div>
                <div class="absolute top-1/2 -right-12 bg-white rounded-2xl p-4 shadow-warm animate-float stagger-2">
                    <p class="text-xs font-bold mb-1" style="color: var(--golden);">Fresh Every Morning</p>
                    <p class="text-2xl text-center">🥖</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave bottom -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 80" xmlns="http://www.w3.org/2000/svg" style="fill: var(--warm-cream);">
            <path d="M0,50 C400,100 1000,0 1440,50 L1440,80 L0,80 Z"/>
        </svg>
    </div>
</section>

{{-- ═══════════════════════════════════════════ WHY US ══ --}}
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14 animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden);">Why Choose Us</p>
        <h2 class="font-display text-4xl font-bold" style="color: var(--chocolate);">Baked Different</h2>
        <span class="gold-line"></span>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            ['emoji'=>'🌅','title'=>'Baked Fresh Daily','desc'=>'Every product is freshly baked from scratch every single morning — no day-old reheating here.'],
            ['emoji'=>'🥚','title'=>'Premium Ingredients','desc'=>'We source only the finest local eggs, butter, and flour to ensure the best taste in every bite.'],
            ['emoji'=>'🎂','title'=>'Custom Orders','desc'=>'Birthday, wedding, or any celebration — our team crafts custom cakes made just for you.'],
            ['emoji'=>'🛵','title'=>'Free Delivery','desc'=>'Orders over ₱500 get FREE delivery within San Fernando, La Union. Same-day available!'],
        ] as $feature)
        <div class="card-hover p-8 text-center animate-slide-up">
            <div class="text-5xl mb-4">{{ $feature['emoji'] }}</div>
            <h3 class="font-display font-bold text-xl mb-3" style="color: var(--chocolate);">{{ $feature['title'] }}</h3>
            <p class="text-sm leading-relaxed" style="color: var(--chocolate-light);">{{ $feature['desc'] }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- ═══════════════════════════════════════════ FEATURED PRODUCTS ══ --}}
<section class="py-20" style="background: var(--parchment);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14 animate-slide-up">
            <p class="script-font text-2xl mb-2" style="color: var(--golden);">Our Bestsellers</p>
            <h2 class="font-display text-4xl font-bold" style="color: var(--chocolate);">Customer Favorites</h2>
            <span class="gold-line"></span>
        </div>

        @if($featuredProducts->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            @foreach($featuredProducts as $product)
            <div class="card-hover animate-slide-up">
                <!-- FIXED: Added proper product link -->
                <a href="{{ route('customer.products.show', $product->slug) }}">
                    <div class="img-zoom relative aspect-square bg-cream-parchment">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @if($product->compare_price && $product->compare_price > $product->price)
                            <div class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold text-white" style="background: var(--rose);">
                                SALE {{ round((($product->compare_price - $product->price) / $product->compare_price) * 100) }}% OFF
                            </div>
                        @endif
                        <div class="absolute top-4 right-4 px-3 py-1 rounded-full text-xs font-bold text-white" style="background: var(--golden);">
                            ⭐ Featured
                        </div>
                    </div>
                </a>
                <div class="p-6">
                    <p class="text-xs font-semibold uppercase tracking-wider mb-2" style="color: var(--golden);">{{ $product->category->name }}</p>
                    <a href="{{ route('customer.products.show', $product->slug) }}">
                        <h3 class="font-display font-bold text-xl mb-2 hover:text-golden-DEFAULT transition" style="color: var(--chocolate);">{{ $product->name }}</h3>
                    </a>
                    @if($product->short_description)
                        <p class="text-sm mb-4 line-clamp-2" style="color: var(--chocolate-light);">{{ $product->short_description }}</p>
                    @endif
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-bold" style="color: var(--chocolate);">₱{{ number_format($product->price, 2) }}</span>
                            @if($product->compare_price)
                                <span class="text-sm line-through ml-2" style="color: #aaa;">₱{{ number_format($product->compare_price, 2) }}</span>
                            @endif
                        </div>
                        @auth
                            @if(auth()->user()->isCustomer() && $product->stock > 0)
                                <form action="{{ route('customer.cart.add', $product) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary text-sm py-2 px-5">Add to Cart</button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary text-sm py-2 px-5">Order Now</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif

        <div class="text-center">
            <a href="{{ route('customer.products') }}" class="btn btn-secondary text-base px-10 py-4">View Full Menu</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════ ABOUT / OWNER ══ --}}
<section class="py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="about">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        <!-- Image side -->
        <div class="relative animate-slide-up">
            <div class="rounded-3xl overflow-hidden shadow-warm-lg aspect-[4/5] relative" style="background: linear-gradient(135deg, var(--parchment), var(--cream-soft));">
                <div class="absolute inset-0 flex items-center justify-center">
                    <span class="text-[180px] opacity-30">👨‍🍳</span>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-end pb-12">
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-6 mx-6 text-center shadow-warm">
                        <p class="script-font text-3xl mb-1" style="color: var(--golden);">Manong Damian</p>
                        <p class="font-semibold text-sm" style="color: var(--chocolate-light);">Founder & Head Baker</p>
                        <p class="text-xs mt-2" style="color: var(--chocolate-light);">Baking since 1995 · La Union Native</p>
                    </div>
                </div>
            </div>
            <!-- Floating badge -->
            <div class="absolute -top-6 -right-6 w-28 h-28 rounded-full flex items-center justify-center text-center shadow-warm animate-float" style="background: linear-gradient(135deg, #c8860a, #e8a020);">
                <div>
                    <p class="font-display font-bold text-2xl text-white leading-none">14+</p>
                    <p class="text-white/80 text-xs leading-tight">Years of<br>Excellence</p>
                </div>
            </div>
        </div>

        <!-- Text side -->
        <div class="animate-slide-up stagger-2">
            <p class="script-font text-2xl mb-2" style="color: var(--golden);">Our Story</p>
            <h2 class="font-display text-4xl font-bold mb-4" style="color: var(--chocolate);">From a Small Oven to La Union's Beloved Bakeshop</h2>
            <span class="gold-line-left"></span>

            <p class="leading-relaxed mb-4" style="color: var(--chocolate-light);">
                Damian Bakeshop started as a dream — Manong Damian would wake before the sun, fire up a small wood-burning oven, and fill the neighborhood with the warm scent of freshly baked pandesal.
            </p>
            <p class="leading-relaxed mb-4" style="color: var(--chocolate-light);">
                What began as a humble home bakery in 2010 has grown into San Fernando's most loved neighborhood bakeshop, serving hundreds of families daily with freshly baked breads, pastries, and celebration cakes.
            </p>
            <p class="leading-relaxed mb-8" style="color: var(--chocolate-light);">
                Every recipe carries the soul of Filipino tradition — from the soft, buttery ensaymada to the rich, layered brazo de mercedes — crafted with love, skill, and the finest local ingredients.
            </p>

            <div class="grid grid-cols-2 gap-4 mb-8">
                @foreach(['Handcrafted daily','Local ingredients','Zero preservatives','Family recipes'] as $tag)
                <div class="flex items-center gap-2">
                    <span class="w-5 h-5 rounded-full flex items-center justify-center shrink-0" style="background: rgba(200,134,10,0.15);">
                        <svg class="w-3 h-3" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                    </span>
                    <span class="text-sm font-semibold" style="color: var(--chocolate-light);">{{ $tag }}</span>
                </div>
                @endforeach
            </div>

            <a href="{{ route('about') }}" class="btn btn-primary px-8 py-4">Read Our Full Story</a>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════ TESTIMONIALS ══ --}}
<section class="py-20" style="background: linear-gradient(135deg, #3d1f0a, #6b3a1f);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="script-font text-2xl mb-2" style="color: var(--golden-light);">What They Say</p>
            <h2 class="font-display text-4xl font-bold text-white">Customer Love</h2>
            <span class="gold-line"></span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['name'=>'Maria Santos','location'=>'San Fernando, La Union','stars'=>5,'text'=>'The ube ensaymada is absolutely heavenly! I order every weekend and my family fights over the last piece. Best bakeshop in La Union, hands down!'],
                ['name'=>'Jose Reyes','location'=>'Bauang, La Union','stars'=>5,'text'=>'Ordered a custom birthday cake for my daughter — it was stunning AND delicious. Manong Damian really poured his heart into it. Will order again!'],
                ['name'=>'Anna Dela Cruz','location'=>'San Fernando, La Union','stars'=>5,'text'=>'The online ordering system made it so easy. Ordered at night, picked up fresh pastries in the morning. Pandesal is perfectly soft every time!'],
            ] as $review)
            <div class="card p-8 animate-slide-up">
                <div class="flex gap-1 mb-4">
                    @for($i = 0; $i < $review['stars']; $i++)
                        <span class="text-xl" style="color: var(--golden);">★</span>
                    @endfor
                </div>
                <p class="leading-relaxed mb-6 italic" style="color: var(--chocolate-light);">"{{ $review['text'] }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold text-sm" style="background: linear-gradient(135deg, var(--golden), var(--golden-light));">
                        {{ substr($review['name'], 0, 1) }}
                    </div>
                    <div>
                        <p class="font-bold text-sm" style="color: var(--chocolate);">{{ $review['name'] }}</p>
                        <p class="text-xs" style="color: var(--chocolate-light);">{{ $review['location'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════ MAP / LOCATION ══ --}}
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" id="contact">
    <div class="text-center mb-14 animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden);">Find Us</p>
        <h2 class="font-display text-4xl font-bold" style="color: var(--chocolate);">Visit Our Bakeshop</h2>
        <span class="gold-line"></span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-stretch">

        <!-- Info cards -->
        <div class="space-y-5 animate-slide-up">
            <div class="card p-6 flex gap-5 items-start">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0" style="background: rgba(200,134,10,0.12);">
                    <svg class="w-7 h-7" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-display font-bold text-lg mb-1" style="color: var(--chocolate);">Our Address</h4>
                    <p style="color: var(--chocolate-light);">123 Quezon Ave, San Fernando<br>La Union, Philippines 2500</p>
                    <a href="https://maps.google.com/?q=San+Fernando+La+Union+Philippines" target="_blank" class="inline-flex items-center gap-1 text-sm font-semibold mt-2 hover:underline" style="color: var(--golden);">
                        Open in Google Maps
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>

            <div class="card p-6 flex gap-5 items-start">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0" style="background: rgba(200,134,10,0.12);">
                    <svg class="w-7 h-7" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <h4 class="font-display font-bold text-lg mb-1" style="color: var(--chocolate);">Opening Hours</h4>
                    <div class="space-y-1 text-sm" style="color: var(--chocolate-light);">
                        <div class="flex justify-between gap-8"><span>Mon – Fri</span><span class="font-semibold" style="color: var(--chocolate);">6:00 AM – 8:00 PM</span></div>
                        <div class="flex justify-between gap-8"><span>Saturday</span><span class="font-semibold" style="color: var(--chocolate);">6:00 AM – 9:00 PM</span></div>
                        <div class="flex justify-between gap-8"><span>Sunday</span><span class="font-semibold" style="color: var(--chocolate);">7:00 AM – 6:00 PM</span></div>
                    </div>
                </div>
            </div>

            <div class="card p-6 flex gap-5 items-start">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0" style="background: rgba(200,134,10,0.12);">
                    <svg class="w-7 h-7" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                </div>
                <div>
                    <h4 class="font-display font-bold text-lg mb-1" style="color: var(--chocolate);">Get in Touch</h4>
                    <p style="color: var(--chocolate-light);">+63 912 345 6789</p>
                    <p style="color: var(--chocolate-light);">hello@damianbakeshop.com</p>
                    <p class="text-xs mt-2" style="color: var(--golden);">Custom orders: 3 days advance notice required</p>
                </div>
            </div>
        </div>

        <!-- Google Maps embed -->
        <div class="card overflow-hidden animate-slide-up stagger-2 min-h-[400px]">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30729.31!2d120.3170!3d16.6158!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3391a4af95b5d28b%3A0x6b2fc7dea8b25c9b!2sSan%20Fernando%2C%20La%20Union!5e0!3m2!1sen!2sph!4v1700000000000"
                width="100%"
                height="100%"
                style="border:0; min-height: 400px;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════ CTA BANNER ══ --}}
<section class="py-20 mx-4 sm:mx-8 mb-20 rounded-3xl overflow-hidden relative" style="background: linear-gradient(135deg, #c8860a 0%, #e8a020 50%, #9a6508 100%);">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-10 -right-10 text-[200px] opacity-10">🎂</div>
        <div class="absolute -bottom-10 -left-10 text-[150px] opacity-10">🍞</div>
    </div>
    <div class="relative z-10 text-center px-4">
        <p class="script-font text-2xl text-white/80 mb-2">Don't wait!</p>
        <h2 class="font-display text-4xl lg:text-5xl font-bold text-white mb-4">Order Fresh Today</h2>
        <p class="text-white/80 text-lg mb-8 max-w-xl mx-auto">Sign up and place your first order in minutes. Fresh pastries delivered to your door or ready for pickup.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('register') }}" class="btn btn-white text-base px-10 py-4" style="color: var(--golden-dark);">
                Create Free Account
            </a>
            <a href="{{ route('customer.products') }}" class="btn text-base px-10 py-4 text-white" style="background: rgba(255,255,255,0.15); border: 2px solid rgba(255,255,255,0.4);">
                Browse Menu
            </a>
        </div>
    </div>
</section>

@endsection