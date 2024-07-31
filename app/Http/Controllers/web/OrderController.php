<?php

namespace App\Http\Controllers\web;

use App\Models\Order;
use App\Http\Controllers\Controller;
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
}