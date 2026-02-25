<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->withCount('orders')
            ->with('orders')
            ->latest()
            ->paginate(20);

        return view('admin.customers.index', compact('customers'));
    }

public function show($id)
{
    $user = User::findOrFail($id);

    return view('admin.customers.show', compact('user'));
}
}