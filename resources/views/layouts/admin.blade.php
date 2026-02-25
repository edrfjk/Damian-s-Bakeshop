<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — Damian Bakeshop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bakery-bg antialiased">

    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar -->
        <aside class="w-64 shrink-0 hidden lg:block border-r" style="background: white; border-color: var(--cream-parchment);" x-data="{ open: '' }">
            <div class="h-full flex flex-col">
                
                <!-- Logo -->
                <div class="p-6 border-b" style="border-color: var(--cream-parchment);">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center shadow-md transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, #c8860a, #e8a020);">
                            <span class="text-2xl">🍞</span>
                        </div>
                        <div>
                            <span class="font-display font-bold text-lg leading-tight block" style="color: var(--chocolate);">Damian Bakeshop</span>
                            <span class="text-xs font-bold uppercase tracking-wider" style="color: var(--golden);">Admin Panel</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'hover:bg-cream-parchment' }}" style="{{ request()->routeIs('admin.dashboard') ? 'background: linear-gradient(135deg, #c8860a, #e8a020);' : 'color: var(--chocolate-light);' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>

                    <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition {{ request()->routeIs('admin.orders.*') ? 'text-white' : 'hover:bg-cream-parchment' }}" style="{{ request()->routeIs('admin.orders.*') ? 'background: linear-gradient(135deg, #c8860a, #e8a020);' : 'color: var(--chocolate-light);' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Orders
                        @php
                            $pendingCount = \App\Models\Order::where('status', 'pending')->count();
                        @endphp
                        @if($pendingCount > 0)
                            <span class="ml-auto px-2 py-0.5 rounded-full text-xs font-bold text-white" style="background: var(--rose);">{{ $pendingCount }}</span>
                        @endif
                    </a>

                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition {{ request()->routeIs('admin.products.*') ? 'text-white' : 'hover:bg-cream-parchment' }}" style="{{ request()->routeIs('admin.products.*') ? 'background: linear-gradient(135deg, #c8860a, #e8a020);' : 'color: var(--chocolate-light);' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                        Products
                    </a>

                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition {{ request()->routeIs('admin.categories.*') ? 'text-white' : 'hover:bg-cream-parchment' }}" style="{{ request()->routeIs('admin.categories.*') ? 'background: linear-gradient(135deg, #c8860a, #e8a020);' : 'color: var(--chocolate-light);' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Categories
                    </a>

                    <a href="{{ route('admin.customers.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition {{ request()->routeIs('admin.customers.*') ? 'text-white' : 'hover:bg-cream-parchment' }}" style="{{ request()->routeIs('admin.customers.*') ? 'background: linear-gradient(135deg, #c8860a, #e8a020);' : 'color: var(--chocolate-light);' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Customers
                    </a>

                    <hr class="my-4" style="border-color: var(--cream-parchment);">

                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition hover:bg-cream-parchment" style="color: var(--chocolate-light);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        View Store
                    </a>
                </nav>

                <!-- User Profile at Bottom -->
                <div class="p-4 border-t" style="border-color: var(--cream-parchment);">
                    <div class="flex items-center gap-3 p-3 rounded-xl" style="background: var(--parchment);">
                        <img src="{{ auth()->user()->avatar_url }}" class="w-10 h-10 rounded-full border-2" style="border-color: var(--golden);" alt="">
                        <div class="flex-1 min-w-0">
                            <p class="font-bold text-sm truncate" style="color: var(--chocolate);">{{ auth()->user()->name }}</p>
                            <p class="text-xs" style="color: var(--golden);">Administrator</p>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-xl font-semibold text-sm transition hover:bg-rose-light/20" style="color: var(--rose);">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Sign Out
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Bar (Mobile) -->
            <header class="lg:hidden flex items-center justify-between p-4 border-b bg-white" style="border-color: var(--cream-parchment);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #c8860a, #e8a020);">
                        <span class="text-xl">🍞</span>
                    </div>
                    <span class="font-display font-bold" style="color: var(--chocolate);">Admin Panel</span>
                </div>
                <button class="p-2 rounded-lg hover:bg-cream-parchment">
                    <svg class="w-6 h-6" style="color: var(--chocolate);" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </header>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>