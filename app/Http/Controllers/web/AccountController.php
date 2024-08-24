<?php

namespace App\Http\Controllers\web;

use App\Models\Account;
use App\Models\AccountTypes;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AccountController extends Controller
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

    public function create(): View
    {
        $accountTypes = AccountTypes::all();
        return view('account-create', compact('accountTypes'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'الاسم' => 'required|string|max:255',
            'رقم الهاتف' => 'nullable|digits_between:1,15',
            'العنوان' => 'nullable|string|max:255',
            'account_types_id' => 'required|exists:account_types,id', // Validate this field
        ]);

        Account::create([
            'الاسم' => $request->الاسم,
            'رقم الهاتف' => $request->رقم_الهاتف,
            'العنوان' => $request->العنوان,
            'account_types_id' => $request->account_types_id, // Ensure this is saved
        ]);

        return redirect()->route('accounts')->with('success', 'Account created successfully.');
    }
    public function edit(string $id): View
    {
        $account = Account::findOrFail($id);
        $accountTypes = AccountTypes::all();
        return view('account-edit', compact('account', 'accountTypes'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $account = Account::findOrFail($id);

        $request->validate([
            'الاسم' => 'required|string|max:255',
            'رقم الهاتف' => 'nullable|digits_between:1,15',
            'العنوان' => 'nullable|string|max:255',
            'account_types_id' => 'required|exists:account_types,id', // Validate this field
        ]);

        $account->update([
            'الاسم' => $request->الاسم,
            'رقم الهاتف' => $request->رقم_الهاتف,
            'العنوان' => $request->العنوان,
            'account_types_id' => $request->account_types_id, // Ensure this is updated
        ]);
        return redirect()->route('account-profile', $account->id)->with('success', 'Account updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $account = Account::findOrFail($id);

        if ($account->isDeletable()) {
            $account->delete();
            return redirect()->route('accounts')->with('success', 'Account deleted successfully.');
        }

        return redirect()->route('accounts')->with('error', 'Account cannot be deleted because it has related records.');
    }
}