<?php

namespace App\Http\Controllers\web;

use App\Models\Account;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class AccountController 
{
    public function index(): View
    {
        $accounts = Account::with('accountTypes')->get();

        return view('accounts', compact('accounts'));
    }

    public function show(string $id): View
    {
        $account = Account::findOrFail($id);
        return view('account-profile', compact('account'));
    }
}