<?php

namespace App\Http\Controllers\web;

use App\Models\Passport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PassportController extends Controller
{
    public function index()
    {
        $passports = Passport::with(['order.account'])->get();
        return view('passports-index', compact('passports'));
    }

    public function show($id)
    {
        $passport = Passport::with(['order.account'])->findOrFail($id);
        return view('passport-details', compact('passport'));
    }

    public function destroy($id)
    {
        $passport = Passport::findOrFail($id);
        
        if ($passport['الحالة'] == 'منتهي') {
            $passport->delete();
            return redirect()->route('passports-index')->with('success', 'Passport deleted successfully.');
        } else {
            return redirect()->route('passports-index')->with('error', 'Only completed passports can be deleted.');
        }
    }
    public function update(Request $request, $id)
    {
        $passport = Passport::findOrFail($id);
        
        $inputData = $request->except(['_token', '_method']);
        
        foreach ($inputData as $key => $value) {
            // Replace underscores with spaces in the key
            $dbKey = str_replace('_', ' ', $key);
            
            // Check if the column exists in the database table
            if (Schema::hasColumn('passports', $dbKey)) {
                $passport->$dbKey = $value;
            }
        }
    
        $passport->save();
    
        return redirect()->route('passport-details', $passport->id)->with('success', 'تم تحديث تفاصيل الجواز بنجاح.');
    }
}