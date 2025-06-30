<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
     public function index(Request $request)
    {
         $query = Product::with('category');

    if ($request->has('category')) {
        $query->where('product_category_id', $request->category);
    }

    return $query->get();
    }

   public function store(Request $request)
{
    $data = $request->validate([
    'name' => 'required|string|max:255',
    'description' => 'nullable|string',
    'price' => 'required|numeric',
    'stock' => 'required|integer',
    'image_url' => 'nullable|string|max:255',
    'product_category_id' => 'required|exists:product_categories,id',
    'is_offer' => 'required|boolean',
    'offer_price' => 'nullable|numeric|min:0',
]);

    $product = Product::create($data);

    return response()->json($product, 201);
}

    public function show(Product $product)
    {
        return $product->load('category');
    }

public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'product_category_id' => 'required|exists:product_categories,id',
        'is_offer' => 'boolean',
        'offer_price' => 'nullable|numeric|lt:price',
        'image' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('products', 'public');
        $data['image_url'] = asset('storage/' . $path);
    }

    $product->update($data);

    return response()->json(['message' => 'Producto actualizado']);
}

    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Producto eliminado']);
    }
}