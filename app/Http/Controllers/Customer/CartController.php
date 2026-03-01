<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display the shopping cart
     */
    public function index()
    {
        $cart = $this->getOrCreateCart();
        
        // Load cart items with product and category relationships
        $cart->load(['items.product.category']);

        return view('customer.cart.index', compact('cart'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check stock
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock. Only ' . $product->stock . ' available.');
        }

        $cart = $this->getOrCreateCart();

        // Check if product already in cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update quantity
            $newQuantity = $cartItem->quantity + $request->quantity;
            
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Cannot add more. Only ' . $product->stock . ' available.');
            }

            $cartItem->update([
                'quantity' => $newQuantity,
                'price' => $product->price,
                'subtotal' => $newQuantity * $product->price,
            ]);
        } else {
            // Add new item
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'subtotal' => $product->price * $request->quantity,
            ]);
        }

        // Update cart subtotal
        $cart->load('items');
        $cart->updateSubtotal();

        return redirect()->route('customer.cart.index')->with('success', $product->name . ' added to cart!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check if cart item belongs to current user
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        // Check stock
        if ($cartItem->product->stock < $request->quantity) {
            return back()->with('error', 'Insufficient stock. Only ' . $cartItem->product->stock . ' available.');
        }

        // Update quantity
        $cartItem->update([
            'quantity' => $request->quantity,
            'subtotal' => $request->quantity * $cartItem->price,
        ]);

        // Update cart subtotal
        $cartItem->cart->updateSubtotal();

        return back()->with('success', 'Cart updated!');
    }

    /**
     * Remove item from cart
     */
    public function remove(CartItem $cartItem)
    {
        // Check if cart item belongs to current user
        if ($cartItem->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $productName = $cartItem->product->name;
        $cartItem->delete();

        // Update cart subtotal
        $cartItem->cart->updateSubtotal();

        return back()->with('success', $productName . ' removed from cart.');
    }

    /**
     * Process checkout
     */
    public function checkout(Request $request)
    {
        $cart = $this->getOrCreateCart();

        // Check if cart is empty
        if ($cart->items->count() === 0) {
            return back()->with('error', 'Your cart is empty!');
        }

        $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:100',
            'shipping_postal_code' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check stock for all items
        foreach ($cart->items as $item) {
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', $item->product->name . ' is out of stock or has insufficient quantity.');
            }
        }

        // Calculate shipping fee
        $shippingFee = $cart->subtotal >= 500 ? 0 : 50;

        DB::beginTransaction();
        try {
            // Create order
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'payment_method' => 'cod',
                'payment_status' => 'pending',
                'subtotal' => $cart->subtotal,
                'shipping_fee' => $shippingFee,
                'tax' => 0,
                'discount' => 0,
                'total' => $cart->subtotal + $shippingFee,
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_postal_code' => $request->shipping_postal_code,
                'notes' => $request->notes,
            ]);

            // Create order items and decrease stock
            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'subtotal' => $item->subtotal,
                ]);

                // Decrease product stock
                $item->product->decrement('stock', $item->quantity);
            }

            // Clear cart
            $cart->items()->delete();
            $cart->update(['subtotal' => 0]);

            DB::commit();

            return redirect()->route('customer.orders.show', $order)->with('success', 'Order placed successfully! Order #' . $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to process order. Please try again.');
        }
    }

    /**
     * Get or create cart for current user
     */
    private function getOrCreateCart()
    {
        $cart = Cart::firstOrCreate(
            ['user_id' => auth()->id()],
            ['subtotal' => 0]
        );

        return $cart;
    }
}