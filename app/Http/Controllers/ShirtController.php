<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shirt;

class ShirtController extends Controller
{
    public function index()
    {
        $shirts = Shirt::all();
        return view('shirtsList', ['shirts' => $shirts]);
    }

    public function show($id)
    {
        $shirt = Shirt::findOrFail($id);
        return view('showShirt', compact('shirt'));
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

      
        $shirt = Shirt::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null,
            'price' => $validatedData['price'],
            'category_id' => $validatedData['category_id'],
            'brand_id' => $validatedData['brand_id'],
            'ImageUrl' => $validatedData['ImageUrl'] ?? null,
            'ImageUrl1' => $validatedData['ImageUrl1'] ?? null,
            'ImageUrl2' => $validatedData['ImageUrl2'] ?? null,
        ]);

       
        return redirect()->back()->with('success', 'Shirt created successfully!');
    }

    public function edit($id)
    {
        $shirt = Shirt::findOrFail($id);
        return view('editShirt', compact('shirt'));
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

        return redirect()->route('shirts.index')->with('success', 'Shirt updated successfully!');
    }

    public function destroy($id)
    {
        $shirt = Shirt::findOrFail($id);
        $shirt->delete();

        return redirect()->route('shirts.index')->with('success', 'Shirt deleted successfully!');
    }

    public function showShirtInfo($id)
    {
        $shirt = Shirt::findOrFail($id);
        return view('info', compact('shirt'));
    }
    
}


