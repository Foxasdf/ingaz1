<?php

namespace App\Http\Controllers\web;

use App\Models\Coin;
use Illuminate\Http\Request;

class CoinController extends Controller
{
    public function index()
    {
        $coins = Coin::all();
        return view('coins.index', compact('coins'));
    }

    public function create()
    {
        return view('coins.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'coin' => 'required|string|max:255',
            'coin_price' => 'required|numeric',
        ]);

        Coin::create($validatedData);

        return redirect()->route('coins.index')->with('success', 'تمت إضافة العملة بنجاح.');
    }

    public function show($id)
    {
        $coin = Coin::findOrFail($id);
        return view('coins.show', compact('coin'));
    }

    public function edit($id)
    {
        $coin = Coin::findOrFail($id);
        return view('coins.edit', compact('coin'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'coin' => 'required|string|max:255',
            'coin_price' => 'required|numeric',
        ]);

        $coin = Coin::findOrFail($id);
        $coin->update($validatedData);

        return redirect()->route('coins.index')->with('success', 'تم تحديث العملة بنجاح.');
    }

    public function destroy($id)
    {
        $coin = Coin::findOrFail($id);
        $coin->delete();

        return redirect()->route('coins.index')->with('success', 'تم حذف العملة بنجاح.');
    }
}