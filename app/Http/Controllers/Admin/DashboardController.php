<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stats ──────────────────────────────────────────
        $stats = [
            'total_orders'          => Order::count(),
            'pending_orders'        => Order::where('status', 'pending')->count(),
            'confirmed_orders'      => Order::where('status', 'confirmed')->count(),
            'processing_orders'     => Order::where('status', 'processing')->count(),
            'shipped_orders'        => Order::where('status', 'shipped')->count(),
            'delivered_orders'      => Order::where('status', 'delivered')->count(),
            'cancelled_orders'      => Order::where('status', 'cancelled')->count(),
            'total_customers'       => User::where('role', 'customer')->count(),
            'total_revenue'         => Order::where('status', 'delivered')->sum('total'),
            'pending_revenue'       => Order::whereIn('status', ['pending','confirmed','processing','shipped'])->sum('total'),
            'total_products'        => Product::count(),
            'active_products'       => Product::where('is_active', true)->count(),
            'low_stock_products'    => Product::where('stock', '<=', 10)->where('stock', '>', 0)->count(),
            'out_of_stock_products' => Product::where('stock', 0)->count(),
        ];

        // ── Recent Orders ──────────────────────────────────
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // ── Top Selling Products ───────────────────────────
        $topProducts = Product::select(
                'products.id',
                'products.name',
                'products.price',
                'products.image',
                'products.stock',
                DB::raw('COALESCE(SUM(order_items.quantity), 0) as total_sold')
            )
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy(
                'products.id',
                'products.name',
                'products.price',
                'products.image',
                'products.stock'
            )
            ->orderBy('total_sold', 'desc')
            ->limit(5)
            ->get();

        // ── Orders By Status ───────────────────────────────
        $ordersByStatus = Order::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        // ── Revenue last 7 days ────────────────────────────
        $revenueData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenueData[] = [
                'date'    => $date->format('M d'),
                'revenue' => Order::where('status', 'delivered')
                    ->whereDate('created_at', $date->toDateString())
                    ->sum('total'),
            ];
        }

        return view('admin.dashboard', compact(
            'stats',
            'recentOrders',
            'topProducts',
            'ordersByStatus',
            'revenueData'
        ));
    }
}