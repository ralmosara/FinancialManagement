<?php

namespace App\Http\Controllers;

use App\Models\ResponsibilityCenter;
use Illuminate\Http\Request;

class ResponsibilityCenterController extends Controller
{
    public function index()
    {
        $centers = ResponsibilityCenter::all();
        return response()->json($centers);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $center = ResponsibilityCenter::create($validatedData);
        return response()->json($center, 201);
    }

    public function show($id)
    {
        $center = ResponsibilityCenter::findOrFail($id);
        return response()->json($center);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $center = ResponsibilityCenter::findOrFail($id);
        $center->update($validatedData);
        return response()->json($center);
    }

    public function destroy($id)
    {
        ResponsibilityCenter::destroy($id);
        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $responsibilityCenters = ResponsibilityCenter::where('name', 'like', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($responsibilityCenters);
    }
}
