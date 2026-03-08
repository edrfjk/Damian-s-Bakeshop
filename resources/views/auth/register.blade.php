@extends('layouts.guest')
@section('title', 'Create Account')

@section('content')
<div class="card animate-scale-in" style="box-shadow: 0 32px 80px rgba(0,0,0,0.4);">
    <div class="p-8">
        <h2 class="font-display text-3xl font-bold text-center mb-1" style="color: var(--chocolate);">Join the Family!</h2>
        <p class="text-center text-sm mb-8" style="color: var(--chocolate-light);">Create your account and start ordering fresh baked goods</p>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl border-l-4 text-sm" style="background: #fff5f5; border-color: var(--rose); color: #a03028;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input" placeholder="Juan dela Cruz" required autofocus>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="input" placeholder="your@email.com" required>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Phone Number</label>
                <input type="tel" name="phone" value="{{ old('phone') }}" class="input" placeholder="+63 912 345 6789">
            </div>

            <!-- PASSWORD -->
            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Password</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="input"
                    placeholder="At least 8 characters"
                    required
                    onkeyup="checkPasswordStrength()"
                >

                <!-- Strength Indicator -->
                <div class="mt-2 text-sm font-semibold" id="password-strength"></div>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2" style="color: var(--chocolate);">Confirm Password</label>
                <input type="password" name="password_confirmation" class="input" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary w-full py-4 text-base mt-2">
                🎉 Create My Account
            </button>
        </form>

        <div class="relative my-6">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t" style="border-color: #e8d5b7;"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white" style="color: var(--chocolate-light);">Already have an account?</span>
            </div>
        </div>

        <a href="{{ route('login') }}" class="btn btn-secondary w-full py-4 text-base">
            Sign In Instead
        </a>
    </div>
</div>


<!-- PASSWORD STRENGTH SCRIPT -->
<script>
function checkPasswordStrength() {

    const password = document.getElementById("password").value;
    const strengthText = document.getElementById("password-strength");

    let strength = 0;

    if (password.length >= 8) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^A-Za-z0-9]/)) strength++;

    if (password.length === 0) {
        strengthText.innerHTML = "";
        return;
    }

    if (strength <= 1) {
        strengthText.innerHTML = "Weak Password";
        strengthText.style.color = "#dc2626";
    }
    else if (strength === 2 || strength === 3) {
        strengthText.innerHTML = "Medium Strength";
        strengthText.style.color = "#d97706";
    }
    else {
        strengthText.innerHTML = "Strong Password";
        strengthText.style.color = "#16a34a";
    }
}
</script>

@endsection