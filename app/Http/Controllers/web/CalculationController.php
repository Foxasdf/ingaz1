<?php

namespace App\Http\Controllers\web;

use App\Models\Account;
use App\Models\AccountTypes;
use App\Models\calculation;
use App\Models\Coin;
use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
class CalculationController extends Controller
{

    //
    public function index()
    {
        $calculations = Calculation::with([
            'accountDain', 
            'accountMadin', 
            'accountTypeDain', 
            'accountTypeMadin', 
            'passport', 
            'coin'
        ])->get();

        return view('calculations.index', compact('calculations'));
    }
    
    // Show the form for creating a new calculation
    public function create()
    {
        $accounts = Account::all();
        $coins = Coin::all();
        $accountTypes = AccountTypes::all();
        $passports = Passport::all();
    
        return view('calculations.create', compact('accounts', 'coins', 'accountTypes', 'passports'));
    }

    // Store a newly created calculation in the database

    // Display the specified calculation
    public function show($id): View
    {
        $calculation = Calculation::with(['accountDain', 'accountMadin', 'accountTypeDain', 'accountTypeMadin', 'passport', 'coin'])->findOrFail($id);

        return view('calculations.show', compact('calculation'));
    }

    // Show the form for editing the specified calculation
    public function edit($id)
    {
        $calculation = Calculation::findOrFail($id);
        $accountTypes = AccountTypes::all();
        $accountsDain = Account::where('account_types_id', $calculation->نوع_الحساب_دائن)->get();
        $accountsMadin = Account::where('account_types_id', $calculation->نوع_الحساب_مدين)->get();
        $coins = Coin::all();
        $passports = Passport::all();

        return view('calculations.edit', compact('calculation', 'accountTypes', 'accountsDain', 'accountsMadin', 'coins', 'passports'));
    }



    // Update the specified calculation in the database
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'نوع_الحساب_دائن' => 'required|exists:account_types,id',
            'دائن' => 'required|exists:accounts,id',
            'نوع_الحساب_مدين' => 'required|exists:account_types,id',
            'مدين' => 'required|exists:accounts,id',
            'coin_id' => 'required|exists:coins,id',
            'رصيد_الدائن' => 'required|numeric',
            'رصيد_المدين' => 'required|numeric',
            'البيان' => 'nullable|string|max:255',
            'main_record_id' => 'nullable|numeric',
            'passport_id' => 'nullable|exists:passports,id',
            'created_at' => 'nullable|date',  // Validate the created_at field
        ]);
    
        // If the created_at is not set, default it to the current date
        $validatedData['created_at'] = $validatedData['created_at'] ?? now();
    
        // Create the calculation
        Calculation::create($validatedData);
    
        return redirect()->route('calculations.index')->with('success', 'Calculation created successfully!');
    }
    
    public function update(Request $request, $id)
    {
        $calculation = Calculation::findOrFail($id);
    
        // Validate the request data
        $validatedData = $request->validate([
            'دائن' => 'required|exists:accounts,id',
            'مدين' => 'required|exists:accounts,id',
            'رصيد_الدائن' => 'required|numeric',
            'رصيد_المدين' => 'required|numeric',
            'البيان' => 'nullable|string|max:255',
            'main_record_id' => 'nullable|numeric',
            'نوع_الحساب_دائن' => 'required|exists:account_types,id',
            'نوع_الحساب_مدين' => 'required|exists:account_types,id',
            'passport_id' => 'nullable|exists:passports,id',
            'coin_id' => 'required|exists:coins,id',
            'created_at' => 'nullable|date', // Allow setting the creation date
        ]);
    
        // Set the creation date to now if not provided
        $validatedData['created_at'] = $validatedData['created_at'] ?? $calculation->created_at;
    
        // Update the original calculation
        $calculation->update($validatedData);
    
        // Handle the counterpart update without breaking the relationship
        $counterpart = $calculation->counterpart;
    
        if ($counterpart) {
            $counterpartData = [
                'رصيد_الدائن' => $validatedData['رصيد_المدين'], // Swap رصيد values
                'رصيد_المدين' => $validatedData['رصيد_الدائن'],
                'البيان' => $validatedData['البيان'],
                'نوع_الحساب_دائن' => $validatedData['نوع_الحساب_مدين'], // Swap account types
                'نوع_الحساب_مدين' => $validatedData['نوع_الحساب_دائن'],
                'passport_id' => $validatedData['passport_id'],
                'coin_id' => $validatedData['coin_id'],
                'created_at' => $validatedData['created_at'], // Ensure the counterpart has the same creation date
            ];
    
            // Update the counterpart
            $counterpart->update($counterpartData);
        } else {
            Log::warning('Counterpart not found for Calculation ID: ' . $calculation->id);
        }
    
        return redirect()->route('calculations.index')->with('success', 'Calculation and its counterpart updated successfully.');
    }

    // Remove the specified calculation from the database
    public function destroy($id)
    {
        $calculation = Calculation::findOrFail($id);
        $calculation->delete();
    
        return redirect()->route('calculations.index')->with('success', 'Calculation and its counterpart deleted successfully.');
    }

    public function getAccountsByType($accountTypeId)
    {
        // Fetch accounts based on account type
        $accounts = Account::where('account_types_id', $accountTypeId)->get();
    
        // Return the accounts as JSON
        return response()->json($accounts);
    }
}
