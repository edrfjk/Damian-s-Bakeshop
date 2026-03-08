{{-- ════════════════ LOGIN: resources/views/auth/login.blade.php ════════════════ --}}
@extends('layouts.guest')
@section('title', 'Sign In')

@section('content')
<div class="card animate-scale-in" style="box-shadow: 0 32px 80px rgba(0,0,0,0.4);">
    <div class="p-8">
        <h2 class="font-display text-3xl font-bold text-center mb-1" style="color: var(--chocolate);">Welcome Back!</h2>
        <p class="text-center text-sm mb-8" style="color: var(--chocolate-light);">Sign in to your Damian Bakeshop account</p>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl border-l-4 text-sm" style="background: #fff5f5; border-color: var(--rose); color: #a03028;">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl border-l-4 text-sm" style="background: #f0fdf4; border-color: var(--sage); color: #4a7a4e;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="your@email.com" required autofocus>
            </div>
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Password</label>
                <input type="password" name="password" class="input" placeholder="••••••••" required>
            </div>
            <div class="flex items-center justify-between">
            </div>
            <button type="submit" class="btn btn-primary w-full py-4 text-base">
                Sign In to My Account
            </button>
        </form>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t" style="border-color: #e8d5b7;"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white" style="color: var(--chocolate-light);">New here?</span>
            </div>
        </div>

        <a href="{{ route('register') }}" class="btn btn-secondary w-full py-4 text-base">
            Create Free Account
        </a>
    </div>
</div>
@endsection


{{-- ════════════════ REGISTER: resources/views/auth/register.blade.php ════════════════ --}}
{{-- NOTE: Save this in a separate file --}}