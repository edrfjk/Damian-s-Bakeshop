<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with('user', 'items');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by order number or customer name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($q2) use ($search) {
                      $q2->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        // Stats for filter bar
        $statusCounts = Order::select('status', \DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('admin.orders.index', compact('orders', 'statusCounts'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,processing,shipped,delivered,cancelled'],
        ]);

        $newStatus = $request->status;

        // Load items for stock restore if cancelling
        $order->load('items.product');

        switch ($newStatus) {
            case 'confirmed':
                $order->markAsConfirmed();
                break;
            case 'processing':
                $order->markAsProcessing();
                break;
            case 'shipped':
                $order->markAsShipped();
                break;
            case 'delivered':
                $order->markAsDelivered();
                break;
            case 'cancelled':
                // Only restore stock if not already cancelled
                if ($order->status !== 'cancelled') {
                    $order->markAsCancelled();
                }
                break;
            default:
                $order->update(['status' => $newStatus]);
        }

        return back()->with('success', 'Order status updated to ' . ucfirst($newStatus) . ' successfully!');
    }
}