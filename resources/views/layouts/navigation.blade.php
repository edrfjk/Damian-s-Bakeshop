<nav class="navbar" x-data="{ mobileOpen: false, userOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-md transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, #c8860a, #e8a020);">
                    <span class="text-2xl">🍞</span>
                </div>
                <div>
                    <span class="font-display font-bold text-xl text-chocolate-DEFAULT leading-tight block" style="color: var(--chocolate);">Damian Bakeshop</span>
                    <span class="script-font text-xs leading-none" style="color: var(--golden);">Handcrafted with Love</span>
                </div>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="font-semibold text-sm uppercase tracking-wider transition-colors hover:text-golden-DEFAULT" style="color: var(--chocolate-light);">Home</a>
                <a href="{{ route('customer.products') }}" class="font-semibold text-sm uppercase tracking-wider transition-colors hover:text-golden-DEFAULT" style="color: var(--chocolate-light);">Menu</a>
                <a href="{{ route('about') }}" class="font-semibold text-sm uppercase tracking-wider transition-colors hover:text-golden-DEFAULT" style="color: var(--chocolate-light);">About</a>
                <a href="{{ route('contact') }}" class="font-semibold text-sm uppercase tracking-wider transition-colors hover:text-golden-DEFAULT" style="color: var(--chocolate-light);">Contact</a>

                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="font-semibold text-sm uppercase tracking-wider transition-colors hover:text-golden-DEFAULT" style="color: var(--chocolate-light);">Admin Panel</a>
                    @endif
                @endauth
            </div>

            <!-- Right side -->
            <div class="hidden md:flex items-center gap-4">
                @auth
                    @if(auth()->user()->isCustomer())
                        <!-- Cart -->
                        <a href="{{ route('customer.cart.index') }}" class="relative p-2 rounded-full hover:bg-golden-light/10 transition">
                            <svg class="w-6 h-6" style="color: var(--chocolate-light);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <span class="cart-count hidden absolute -top-1 -right-1 w-5 h-5 rounded-full text-white text-xs font-bold flex items-center justify-center" style="background: var(--golden);">0</span>
                        </a>
                    @endif

                    <!-- User dropdown -->
                    <div class="relative">
                        <button @click="userOpen = !userOpen" @click.away="userOpen = false" class="flex items-center gap-2 px-4 py-2 rounded-full hover:bg-golden-light/10 transition">
                            <img src="{{ auth()->user()->avatar_url }}" class="w-8 h-8 rounded-full border-2" style="border-color: var(--golden);" alt="">
                            <span class="font-semibold text-sm" style="color: var(--chocolate);">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" style="color: var(--golden);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="userOpen"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-52 bg-white rounded-2xl shadow-warm-lg py-2 z-50 border border-cream-parchment"
                             style="display:none;">
                            @if(auth()->user()->isCustomer())
                                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                    Dashboard
                                </a>
                                <a href="{{ route('customer.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    My Orders
                                </a>
                                <a href="{{ route('customer.profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    My Profile
                                </a>
                            @endif
                            <hr class="my-2 border-cream-parchment">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-rose-DEFAULT hover:bg-rose-light/20 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-ghost text-sm py-2 px-5">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary text-sm py-2 px-5">Order Now</a>
                @endauth
            </div>

            <!-- Mobile hamburger -->
            <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-xl hover:bg-cream-parchment transition">
                <svg class="w-6 h-6" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="md:hidden border-t py-4 space-y-2"
             style="border-color: rgba(200,134,10,0.15); display:none;">
            <a href="{{ route('home') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">Home</a>
            <a href="{{ route('customer.products') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">Menu</a>
            <a href="{{ route('about') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">About</a>
            <a href="{{ route('contact') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">Contact</a>
            @auth
                @if(auth()->user()->isCustomer())
                    <a href="{{ route('customer.cart.index') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">Cart</a>
                    <a href="{{ route('customer.dashboard') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">My Account</a>
                @endif
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 font-semibold rounded-xl hover:bg-cream-parchment transition" style="color: var(--chocolate-light);">Admin Panel</a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left py-2 px-4 font-semibold text-rose-DEFAULT rounded-xl hover:bg-rose-light/20 transition">Sign Out</button>
                </form>
            @else
                <div class="pt-2 flex flex-col gap-2 px-4">
                    <a href="{{ route('login') }}" class="btn btn-secondary w-full">Sign In</a>
                    <a href="{{ route('register') }}" class="btn btn-primary w-full">Order Now</a>
                </div>
            @endauth
        </div>
    </div>
</nav>

@auth
    @if(auth()->user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" class="...">Admin Panel</a>
    @endif
@endauth