<?php

namespace App\Http\Controllers;

use App\Models\ServiceType;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
     public function index()
    {
        $serviceTypes = ServiceType::all();
        return response()->json($serviceTypes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $serviceType = ServiceType::create($validated);
        return response()->json($serviceType, 201);
    }

    public function show($id)
    {
        $serviceType = ServiceType::find($id);

        if (!$serviceType) {
            return response()->json(['message' => 'Service type not found'], 404);
        }

        return response()->json($serviceType);
    }

    public function update(Request $request, $id)
    {
        $serviceType = ServiceType::find($id);

        if (!$serviceType) {
            return response()->json(['message' => 'Service type not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $serviceType->update($validated);
        return response()->json($serviceType);
    }

    public function destroy($id)
    {
        $serviceType = ServiceType::find($id);

        if (!$serviceType) {
            return response()->json(['message' => 'Service type not found'], 404);
        }

        $serviceType->delete();
        return response()->json(['message' => 'Service type deleted successfully']);
    }
}