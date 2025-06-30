<?php

namespace App\Http\Controllers;

use App\Models\ReservableItem;
use Illuminate\Http\Request;

class ReservableItemController extends Controller
{
     /**
     * Display a listing of reservable items.
     */
    public function index()
    {
        $reservableItems = ReservableItem::all();
        return response()->json($reservableItems);
    }

    /**
     * Store a new reservable item.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_type_id' => 'required|exists:service_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'capacity' => 'required|integer|min:1',
        ]);

        $reservableItem = ReservableItem::create($validated);
        return response()->json($reservableItem, 201);
    }

    /**
     * Display the specified reservable item.
     */
    public function show($id)
    {
        $reservableItem = ReservableItem::find($id);

        if (!$reservableItem) {
            return response()->json(['message' => 'Reservable item not found'], 404);
        }

        return response()->json($reservableItem);
    }

    /**
     * Update the specified reservable item.
     */
    public function update(Request $request, $id)
    {
        $reservableItem = ReservableItem::find($id);

        if (!$reservableItem) {
            return response()->json(['message' => 'Reservable item not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'capacity' => 'nullable|integer|min:1',
        ]);

        $reservableItem->update($validated);
        return response()->json($reservableItem);
    }

    /**
     * Remove the specified reservable item.
     */
    public function destroy($id)
    {
        $reservableItem = ReservableItem::find($id);

        if (!$reservableItem) {
            return response()->json(['message' => 'Reservable item not found'], 404);
        }

        $reservableItem->delete();
        return response()->json(['message' => 'Reservable item deleted successfully']);
    }
}