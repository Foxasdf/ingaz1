<?php

namespace App\Http\Controllers\web;

use App\Models\AccountTypes;
use Illuminate\Http\Request;

class AccountTypesController
{
    //
    public function index()
    {
        // Retrieve all account types
        $accountTypes = AccountTypes::all();

        // Pass the data to the view
        return view('account_types.index', compact('accountTypes'));
    }
    public function show($id)
{
    $accountType = AccountTypes::findOrFail($id);
    return view('account_types.show', compact('accountType'));
}
 /**
     * Show the form for creating a new account type.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $accountTypes = AccountTypes::all(); // Retrieve all account types
        return view('account_types.create', compact('accountTypes'));
    }

    /**
     * Store a newly created account type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'النوع' => 'required|string|max:255',
        ]);

        AccountTypes::create($request->all());

        return redirect()->route('account-types.index')->with('success', 'Account type created successfully.');
    }


    /**
     * Show the form for editing the specified account type.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $accountType = AccountTypes::findOrFail($id);
        return view('account_types.edit', compact('accountType'));
    }

    /**
     * Update the specified account type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'النوع' => 'required|string|max:255',
        ]);

        $accountType = AccountTypes::findOrFail($id);
        $accountType->update($request->all());

        return redirect()->route('account-types.show', $accountType->id)->with('success', 'Account type updated successfully.');
    }

public function destroy($id)
{
    $accountType = AccountTypes::findOrFail($id);
    $accountType->delete();
    return redirect()->route('account-types.index')->with('success', 'Account Type deleted successfully');
}
}
