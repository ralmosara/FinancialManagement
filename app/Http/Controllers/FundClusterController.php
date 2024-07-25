<?php

namespace App\Http\Controllers;

use App\Models\FundCluster;
use Illuminate\Http\Request;

class FundClusterController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        $fundClusters = FundCluster::where('name', 'like', "%{$query}%")
            ->orWhere('code', 'like', "%{$query}%")
            ->get();

        return response()->json($fundClusters);
    }

    // Add other methods as needed (index, store, update, destroy, etc.)
}