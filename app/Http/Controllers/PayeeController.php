<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payee;

class PayeeController extends Controller
{
public function search(Request $request)
{
    $query = $request->input('query');
    
    $payees = Payee::where('name', 'like', "%{$query}%")
                   ->limit(10)
                   ->get(['id', 'name']);
    
    return response()->json($payees);
}
}
