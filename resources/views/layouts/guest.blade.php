<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Welcome') — Damian Bakeshop</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased min-h-screen flex items-center justify-center py-12 px-4" style="background: linear-gradient(135deg, #3d1f0a 0%, #6b3a1f 40%, #9a6508 100%);">

    <!-- Background decorative circles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #e8a020, transparent);"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 rounded-full opacity-10" style="background: radial-gradient(circle, #d4847a, transparent);"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-5" style="background: radial-gradient(circle, #fdf6ec, transparent);"></div>
        <!-- Floating pastry icons -->
        <div class="absolute top-20 right-20 text-6xl opacity-10 animate-float">🧁</div>
        <div class="absolute bottom-32 left-16 text-5xl opacity-10 animate-float stagger-2">🍰</div>
        <div class="absolute top-1/2 right-10 text-4xl opacity-10 animate-float stagger-4">🥐</div>
    </div>

    <!-- Brand top -->
    <div class="w-full max-w-md relative z-10">
        <div class="text-center mb-8 animate-slide-up">
<div class="inline-flex items-center justify-center w-20 h-20 rounded-full mb-4 shadow-2xl overflow-hidden bg-white">
    <img src="{{ asset('images/logo.jpg') }}" alt="Damian Bakeshop Logo" class="w-16 h-16 object-contain">
</div>
            <h1 class="text-3xl font-display font-bold text-white mb-1">Damian Bakeshop</h1>
            <p class="script-font text-golden-light text-lg">Handcrafted with Love</p>
        </div>

        @yield('content')

        <p class="text-center text-white/40 text-xs mt-6">© {{ date('Y') }} Damian Bakeshop · La Union, Philippines</p>
    </div>
</body>
</html>