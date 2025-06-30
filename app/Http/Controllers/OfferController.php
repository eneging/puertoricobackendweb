<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    

    public function index()
{
    return Offer::with('product')->get();
}

public function store(Request $request)
{
    $data = $request->validate([
        'product_id' => 'required|exists:products,id',
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'starts_at' => 'nullable|date',
        'ends_at' => 'nullable|date',
    ]);

    $offer = Offer::create($data);
    return response()->json($offer, 201);
}

public function show($id)
{
    return Offer::with('product')->findOrFail($id);
}

public function update(Request $request, $id)
{
    $offer = Offer::findOrFail($id);
    $data = $request->validate([
        'title' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'starts_at' => 'nullable|date',
        'ends_at' => 'nullable|date',
    ]);
    $offer->update($data);
    return response()->json($offer);
}

public function destroy($id)
{
    Offer::destroy($id);
    return response()->json(null, 204);
}
}