<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalOrders     = $user->orders()->count();
        $pendingOrders   = $user->orders()
                               ->whereIn('status', ['pending', 'confirmed', 'processing'])
                               ->count();
        $shippedOrders   = $user->orders()
                               ->where('status', 'shipped')
                               ->count();
        $completedOrders = $user->orders()
                               ->where('status', 'delivered')
                               ->count();
        $cancelledOrders = $user->orders()
                               ->where('status', 'cancelled')
                               ->count();

        // Total spent = sum of all DELIVERED orders
        $totalSpent = $user->orders()
                          ->where('status', 'delivered')
                          ->sum('total');

        $recentOrders = $user->orders()
            ->with('items.product')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'shippedOrders',
            'completedOrders',
            'cancelledOrders',
            'totalSpent',
            'recentOrders'
        ));
    }
}