<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Shirt;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
class ShirtController extends Controller
{
    public function index()
    {
        $shirts = Shirt::all();
        return response()->json($shirts);
    }

    public function show($id)
    {
        $shirt = Shirt::findOrFail($id);
        return response()->json($shirt);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'ImageUrl' => 'required|string',
            'ImageUrl1' => 'nullable|string',
            'ImageUrl2' => 'nullable|string',
        ]);

        $shirt = Shirt::create($validatedData);

        return response()->json(['message' => 'Shirt created successfully!', 'shirt' => $shirt], 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'ImageUrl' => 'nullable|url',
            'ImageUrl1' => 'nullable|url',
            'ImageUrl2' => 'nullable|url',
        ]);

        $shirt = Shirt::findOrFail($id);
        $shirt->update($validatedData);

        return response()->json(['message' => 'Shirt updated successfully!', 'shirt' => $shirt]);
    }

    public function destroy($id)
    {
        $shirt = Shirt::findOrFail($id);
        $shirt->delete();

        return response()->json(['message' => 'Shirt deleted successfully!']);
    }

    public function showShirtInfo($id)
    {
        $shirt = Shirt::findOrFail($id);
        return response()->json($shirt);
    }
}

