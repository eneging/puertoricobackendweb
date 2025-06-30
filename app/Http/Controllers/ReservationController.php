<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    
   public function index()
    {
        $reservations = Reservation::all();
        return response()->json($reservations);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'reservable_item_id' => 'required|exists:reservable_items,id',
            'reservation_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'number_of_people' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $reservation = Reservation::create($validated);
        return response()->json($reservation, 201);
    }

    public function show($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        return response()->json($reservation);
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $validated = $request->validate([
            'reservation_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable|after:start_time',
            'number_of_people' => 'nullable|integer|min:1',
            'total_price' => 'nullable|numeric|min:0',
            'status' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
        ]);

        $reservation->update($validated);
        return response()->json($reservation);
    }

    public function destroy($id)
    {
        $reservation = Reservation::find($id);

        if (!$reservation) {
            return response()->json(['message' => 'Reservation not found'], 404);
        }

        $reservation->delete();
        return response()->json(['message' => 'Reservation deleted successfully']);
    }
    
}