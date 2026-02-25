{{-- ════════════════ ABOUT PAGE: resources/views/about.blade.php ════════════════ --}}
@extends('layouts.app')
@section('title', 'About Us — Damian Bakeshop')

@section('content')

<!-- Hero -->
<section class="py-24 text-center relative overflow-hidden bg-gradient-to-br from-[#3d1f0a] to-[#6b3a1f]">
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
        <span class="text-[400px]">🍞</span>
    </div>
    <div class="relative z-10 max-w-3xl mx-auto px-4 animate-slide-up">
        <p class="script-font text-2xl mb-2 text-[#FFD97D]">Our Story</p>
        <h1 class="font-display text-5xl font-bold text-white mb-6">About Damian Bakeshop</h1>
        <p class="text-white/70 text-lg leading-relaxed">A family bakery born from passion, tradition, and the irresistible aroma of fresh-baked bread.</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" class="w-full" style="fill: var(--warm-cream);">
            <path d="M0,40 C360,80 1080,0 1440,40 L1440,60 L0,60 Z"/>
        </svg>
    </div>
</section>

<!-- Story Section -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
        <div class="animate-slide-up">
            <p class="script-font text-2xl mb-2 text-[#FFD97D]">The Beginning</p>
            <h2 class="font-display text-4xl font-bold mb-4 text-[#4B2E2A]">One Oven, One Dream</h2>
            <span class="gold-line-left"></span>
            <p class="leading-relaxed mb-4 text-[#7C5A52]">In 2010, Manong Damian Cruz had one small oven, a handful of cherished family recipes, and an unshakeable belief that good bread could bring people together. Every morning at 4am, he would knead dough by hand, watching the sun rise over San Fernando, La Union as his neighborhood slowly woke to the intoxicating scent of freshly baked pandesal.</p>
            <p class="leading-relaxed text-[#7C5A52]">Word spread quickly — first the neighbors, then the whole barangay, then the entire city. What started as 50 pieces of pandesal a day grew into hundreds of products baked fresh every morning.</p>
        </div>
        <div class="card overflow-hidden animate-slide-up stagger-2 aspect-square flex items-center justify-center bg-[#FFF4E1] text-[160px]">
            🥖
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
        <div class="card overflow-hidden animate-slide-up aspect-square flex items-center justify-center bg-[#FFF4E1] text-[160px] lg:order-first">
            👨‍👩‍👧‍👦
        </div>
        <div class="animate-slide-up stagger-2">
            <p class="script-font text-2xl mb-2 text-[#FFD97D]">Family at Heart</p>
            <h2 class="font-display text-4xl font-bold mb-4 text-[#4B2E2A]">A Family Affair</h2>
            <span class="gold-line-left"></span>
            <p class="leading-relaxed mb-4 text-[#7C5A52]">Damian Bakeshop has always been a family business. Manong Damian's wife, Aling Rosa, manages the front of house and the custom cake orders with an eye for detail that has made our celebration cakes legendary across La Union.</p>
            <p class="leading-relaxed text-[#7C5A52]">Their children grew up behind the counter, learning every recipe, every technique, and every smile that makes a customer feel at home. Today, the next generation carries on the tradition — with new recipes and modern touches that honor the classics.</p>
        </div>
    </div>
</section>

<!-- Values -->
<section class="py-20 bg-[#FFF4E1]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <p class="script-font text-2xl mb-2 text-[#FFD97D]">What We Believe</p>
            <h2 class="font-display text-4xl font-bold text-[#4B2E2A]">Our Values</h2>
            <span class="gold-line"></span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['icon'=>'🌿','title'=>'Quality Always','desc'=>'We never compromise on ingredients. Only the freshest eggs, finest butter, and premium flour make it into our recipes.'],
                ['icon'=>'❤️','title'=>'Baked with Love','desc'=>'Every loaf, every pastry, every custom cake is made with genuine care. We treat each product as if it were for our own family.'],
                ['icon'=>'🤝','title'=>'Community First','desc'=>'We are proudly La Union. We support local farmers, hire from the community, and give back through every sale.'],
            ] as $val)
            <div class="card-hover p-10 text-center hover:shadow-xl transition transform hover:-translate-y-1 animate-slide-up">
                <div class="text-5xl mb-5">{{ $val['icon'] }}</div>
                <h3 class="font-display font-bold text-2xl mb-4 text-[#4B2E2A]">{{ $val['title'] }}</h3>
                <p class="leading-relaxed text-[#7C5A52]">{{ $val['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Team -->
<section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center mb-14">
        <p class="script-font text-2xl mb-2 text-[#FFD97D]">The People Behind the Bread</p>
        <h2 class="font-display text-4xl font-bold text-[#4B2E2A]">Meet Our Team</h2>
        <span class="gold-line"></span>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach([
            ['emoji'=>'👨‍🍳','name'=>'Manong Damian Cruz','role'=>'Founder & Head Baker','desc'=>'29 years of baking experience. Master of traditional Filipino bread and pastry.'],
            ['emoji'=>'👩‍🍳','name'=>'Aling Rosa Cruz','role'=>'Co-Founder & Cake Artist','desc'=>'Transforms every celebration cake into a work of art. Custom orders are her specialty.'],
            ['emoji'=>'🧑‍🍳','name'=>'Carlo Cruz','role'=>'Junior Baker','desc'=>'The next generation, blending modern techniques with family tradition since 2019.'],
        ] as $member)
        <div class="card-hover text-center animate-slide-up hover:shadow-xl transition transform hover:-translate-y-1">
            <div class="aspect-square flex items-center justify-center text-8xl rounded-2xl bg-[#FFF4E1] mb-4">{{ $member['emoji'] }}</div>
            <div class="px-4">
                <h3 class="font-display font-bold text-xl mb-1 text-[#4B2E2A]">{{ $member['name'] }}</h3>
                <p class="text-sm font-semibold mb-3 text-[#FFD97D]">{{ $member['role'] }}</p>
                <p class="text-sm leading-relaxed text-[#7C5A52]">{{ $member['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection