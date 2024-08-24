<?php

namespace App\Http\Controllers\web;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController 
{
    public function index(): View
    {
        $orders = Order::with('account')->get();
        return view('orders', compact('orders'));
    }

    public function show($id): View
    {
        $order = Order::with(['account', 'passports'])->findOrFail($id);
        
        return view('order-details', compact('order'));
    }

    public function delete($id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        
        if ($order['الحالة'] == 'منتهي') {
            $order->delete();
            return redirect()->route('orders')->with('success', 'Order deleted successfully.');
        } else {
            return redirect()->route('orders')->with('error', 'Only completed orders can be deleted.');
        }
    }
    public function edit($id): View
    {
        $order = Order::with(['account', 'passports'])->findOrFail($id);
        return view('order-edit', compact('order'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $order = Order::findOrFail($id);
        
        // Update order details
        $order->update($request->only([
            'اسم الزبون',
            'وجهة السفر',
            'نوع التأشير',
            'عدد مرات الدخول',
            'الحالة',
        ]));

        // Update passport details
        foreach ($request->passports as $passportData) {
            $passport = Passport::findOrFail($passportData['id']);
            $passport->update($passportData);
        }

        return redirect()->route('orders', $id)->with('success', 'Order updated successfully.');
    }
    

    public function create(): View
    {
        $accounts = Account::all(); // Fetch all accounts
        return view('order-create', compact('accounts'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'اسم الزبون' => 'required|string|max:255',
            'وجهة السفر' => 'required|string|max:255',
            'نوع التأشير' => 'required|string|max:255',
            'عدد مرات الدخول' => 'required|string|max:255',
            'الحالة' => 'required|string|max:255',
            'account_id' => 'required|exists:accounts,id',
        ]);
    
        Order::create($validatedData);
    
        return redirect()->route('orders')->with('success', 'Order created successfully.');
    }

}