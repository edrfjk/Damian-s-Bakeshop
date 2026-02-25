@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    <!-- Page Header -->
    <div class="mb-10">
        <h1 class="text-4xl font-bold gradient-text mb-2">My Profile</h1>
        <p class="text-gray-500 text-lg">Manage your personal information and account settings.</p>
    </div>

    @if(session('success'))
        <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-sm text-emerald-700 font-medium">
                    {{ session('success') }}
                </p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <!-- ===================== -->
        <!-- Profile Card -->
        <!-- ===================== -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center lg:sticky lg:top-24">

                <img src="{{ auth()->user()->avatar_url }}"
                     alt="{{ auth()->user()->name }}"
                     class="w-32 h-32 rounded-full mx-auto mb-6 border-4 border-primary-100 shadow-sm">

                <h3 class="font-bold text-gray-900 text-xl mb-1">
                    {{ auth()->user()->name }}
                </h3>

                <p class="text-gray-500 text-sm mb-6">
                    {{ auth()->user()->email }}
                </p>

                <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-xs font-semibold rounded-full">
                    Customer Account
                </span>
            </div>
        </div>

        <!-- ===================== -->
        <!-- Form Card -->
        <!-- ===================== -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

                <h2 class="text-2xl font-bold text-gray-900 mb-8">
                    Personal Information
                </h2>

                <form action="{{ route('customer.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="space-y-8">

                        <!-- Basic Info Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Name -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Full Name
                                </label>
                                <input type="text"
                                       name="name"
                                       value="{{ old('name', auth()->user()->name) }}"
                                       class="input @error('name') input-error @enderror"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Email Address
                                </label>
                                <input type="email"
                                       name="email"
                                       value="{{ old('email', auth()->user()->email) }}"
                                       class="input @error('email') input-error @enderror"
                                       required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    Phone Number
                                </label>
                                <input type="tel"
                                       name="phone"
                                       value="{{ old('phone', auth()->user()->phone) }}"
                                       class="input @error('phone') input-error @enderror">
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    City
                                </label>
                                <input type="text"
                                       name="city"
                                       value="{{ old('city', auth()->user()->city) }}"
                                       class="input @error('city') input-error @enderror">
                                @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Address Full Width -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Address
                            </label>
                            <textarea name="address"
                                      rows="3"
                                      class="input @error('address') input-error @enderror">{{ old('address', auth()->user()->address) }}</textarea>
                            @error('address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Postal -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Postal Code
                            </label>
                            <input type="text"
                                   name="postal_code"
                                   value="{{ old('postal_code', auth()->user()->postal_code) }}"
                                   class="input @error('postal_code') input-error @enderror">
                        </div>

                        <!-- ===================== -->
                        <!-- Password Section -->
                        <!-- ===================== -->
                        <div class="border-t pt-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Change Password
                            </h3>
                            <p class="text-sm text-gray-500 mb-6">
                                Leave blank if you don't want to update your password.
                            </p>

                            <div class="space-y-6">

                                <input type="password"
                                       name="current_password"
                                       placeholder="Current Password"
                                       class="input @error('current_password') input-error @enderror">

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <input type="password"
                                           name="password"
                                           placeholder="New Password"
                                           class="input @error('password') input-error @enderror">

                                    <input type="password"
                                           name="password_confirmation"
                                           placeholder="Confirm Password"
                                           class="input">
                                </div>

                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit"
                                class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-xl font-semibold shadow-md hover:shadow-lg transition">
                                Save Changes
                            </button>

                            <a href="{{ route('customer.dashboard') }}"
                               class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl font-semibold transition text-center">
                                Cancel
                            </a>
                        </div>

                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection