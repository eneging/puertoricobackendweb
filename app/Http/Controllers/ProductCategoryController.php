<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    
   
     public function index()
    {
        // 1. Obtener todas las categorías
        $categories = ProductCategory::all();

        // 2. Formatear la respuesta para incluir solo 'id' y 'name' (o lo que necesites)
        // Esto es útil si tu modelo de Categoría tiene muchos campos que no necesitas en el frontend
        $formattedCategories = $categories->map(function($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                // Puedes añadir más campos de categoría si los necesitas en el frontend,
                // por ejemplo, 'description' si quieres mostrarla en algún lugar.
                // 'description' => $category->description,
            ];
        });

        // 3. Devolver la respuesta JSON
        return response()->json($formattedCategories);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = ProductCategory::create($validated);
        return response()->json($category, 201);
    }

    public function show(ProductCategory $productCategory)
    {
        return $productCategory;
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        $productCategory->update($validated);
        return response()->json($productCategory);
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();
        return response()->json(['message' => 'Categoría eliminada']);
    }
        
}