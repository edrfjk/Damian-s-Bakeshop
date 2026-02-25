@extends('layouts.app')
@section('title', 'My Orders — Damian Bakeshop')

@section('content')

<!-- Page Header -->
<section class="py-16 text-center relative overflow-hidden" style="background: linear-gradient(135deg, #3d1f0a, #6b3a1f);">
    <div class="absolute inset-0 flex items-center justify-center opacity-5 pointer-events-none">
        <span class="text-[250px]">🧾</span>
    </div>
    <div class="relative z-10 animate-slide-up">
        <p class="script-font text-2xl mb-2" style="color: var(--golden-light);">Freshly Baked Happiness</p>
        <h1 class="font-display text-5xl font-bold text-white mb-4">My Orders</h1>
        <p class="text-white/60">Track your delicious moments with us.</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 50" xmlns="http://www.w3.org/2000/svg" style="fill: var(--warm-cream);">
            <path d="M0,30 C360,60 1080,0 1440,30 L1440,50 L0,50 Z"/>
        </svg>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    @if($orders->count() > 0)

        <div class="space-y-8">

            @foreach($orders as $order)
            <div class="card-hover animate-slide-up p-6"
                 style="background: var(--parchment); border: 1px solid rgba(61,31,10,0.1); border-radius: 1.5rem;">

                <!-- Top Section -->
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

                    <!-- Order Info -->
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h3 class="font-display text-2xl font-bold" style="color: var(--chocolate);">
                                Order #{{ $order->order_number }}
                            </h3>

                            <span class="px-3 py-1 text-xs font-bold rounded-full"
                                style="
                                    @if($order->status === 'pending')
                                        background: rgba(200,134,10,0.15); color: var(--golden-dark);
                                    @elseif($order->status === 'processing')
                                        background: rgba(107,58,31,0.15); color: var(--chocolate);
                                    @elseif($order->status === 'completed')
                                        background: rgba(74,122,78,0.15); color: var(--sage);
                                    @elseif($order->status === 'cancelled')
                                        background: rgba(160,48,40,0.15); color: var(--rose);
                                    @endif
                                ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>

                        <p class="text-sm" style="color: var(--chocolate-light);">
                            Placed on {{ $order->created_at->format('F d, Y • h:i A') }}
                        </p>
                    </div>

                    <!-- Total -->
                    <div class="text-left lg:text-right">
                        <p class="text-3xl font-bold" style="color: var(--chocolate);">
                            ₱{{ number_format($order->total, 2) }}
                        </p>
                        <p class="text-sm font-semibold" style="color: var(--chocolate-light);">
                            {{ $order->items->count() }} item(s)
                        </p>
                    </div>
                </div>

                <!-- Divider -->
                <div class="my-6 border-t" style="border-color: rgba(61,31,10,0.1);"></div>

                <!-- Items Preview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

                    @foreach($order->items->take(4) as $item)
                        <div class="flex items-center gap-4 p-3 rounded-xl"
                             style="background: rgba(255,255,255,0.6);">
                            <div class="w-16 h-16 rounded-xl overflow-hidden shrink-0"
                                 style="background: var(--warm-cream);">
                                <img src="{{ $item->product->image_url }}"
                                     alt="{{ $item->product_name }}"
                                     class="w-full h-full object-cover">
                            </div>
                            <div>
                                <p class="font-semibold text-sm" style="color: var(--chocolate);">
                                    {{ $item->product_name }}
                                </p>
                                <p class="text-xs" style="color: var(--chocolate-light);">
                                    Qty: {{ $item->quantity }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                    @if($order->items->count() > 4)
                        <div class="flex items-center justify-center text-sm font-semibold"
                             style="color: var(--golden-dark);">
                            +{{ $order->items->count() - 4 }} more delicious items
                        </div>
                    @endif
                </div>

                <!-- Actions -->
                <div class="mt-6 flex flex-wrap gap-3">

                    <a href="{{ route('customer.orders.show', $order) }}"
                       class="btn btn-primary px-6 py-2">
                        View Details
                    </a>

                    @if($order->status === 'pending')
                        <form action="{{ route('customer.orders.cancel', $order) }}"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to cancel this order?')">
                            @csrf
                            <button type="submit"
                                class="px-6 py-2 rounded-xl text-sm font-semibold border transition"
                                style="border-color: var(--rose); color: var(--rose);"
                                onmouseover="this.style.background='rgba(160,48,40,0.08)'"
                                onmouseout="this.style.background='transparent'">
                                Cancel Order
                            </button>
                        </form>
                    @endif

                </div>
            </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $orders->links() }}
        </div>

    @else

        <!-- Empty State -->
        <div class="text-center py-20">
            <div class="text-7xl mb-4">🥐</div>
            <h3 class="font-display text-3xl font-bold mb-3" style="color: var(--chocolate);">
                No orders yet!
            </h3>
            <p class="mb-6" style="color: var(--chocolate-light);">
                Your basket is waiting for something sweet.
            </p>
            <a href="{{ route('customer.products') }}" class="btn btn-primary px-6 py-3">
                Browse Our Menu
            </a>
        </div>

    @endif

</div>

@endsection