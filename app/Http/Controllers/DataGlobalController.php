<?php

namespace App\Http\Controllers;

use App\Models\DataGlobal;
use Illuminate\Http\Request;

class DataGlobalController extends Controller
{
    public function index()
    {
        return response()->json(DataGlobal::all());
    }

    public function show($name)
    {
        $item = DataGlobal::where('name', $name)->first();
        return $item ? response()->json($item) : response()->json(['error' => 'No encontrado'], 404);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:data_globals',
            'value' => 'required',
            'description' => 'nullable'
        ]);

        return response()->json(DataGlobal::create($data));
    }

    public function update(Request $request, $id)
    {
        $item = DataGlobal::findOrFail($id);

        $item->update($request->only(['value', 'description']));

        return response()->json($item);
    }

    public function destroy($id)
    {
        $item = DataGlobal::findOrFail($id);
        $item->delete();
        return response()->json(['success' => true]);
    }
}