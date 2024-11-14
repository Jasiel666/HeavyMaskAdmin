<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shirt;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

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
    // Validate the incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|integer',
        'brand_id' => 'required|integer',
        'ImageUrl' => 'required|file|image|max:10240', 
        'ImageUrl1' => 'nullable|file|image|max:10240',  // Optional image
        'ImageUrl2' => 'nullable|file|image|max:10240',  // Optional image
    ]);

    try {
        // Retrieve the API token from session
        $token = session('admin_api_token');
        
        if (!$token) {
            return redirect()->route('login')->withErrors('Session expired. Please login again.');
        }

 
        $imageUrl = $this->uploadImage($request->file('ImageUrl'));
        $imageUrl1 = $request->hasFile('ImageUrl1') ? $this->uploadImage($request->file('ImageUrl1')) : null;
        $imageUrl2 = $request->hasFile('ImageUrl2') ? $this->uploadImage($request->file('ImageUrl2')) : null;

        $validatedData['ImageUrl'] = $imageUrl;
        $validatedData['ImageUrl1'] = $imageUrl1;
        $validatedData['ImageUrl2'] = $imageUrl2;


        $response = Http::withToken($token)->post('http://127.0.0.1:8000/api/shirts', $validatedData);
        
        if ($response->successful()) {
            return redirect()->route('shirts.index')->with('success', 'Shirt created successfully!');
        }


        Log::error('Failed to create shirt', ['status' => $response->status(), 'body' => $response->body()]);
        return redirect()->back()->withErrors('Failed to create shirt.');

    } catch (\Exception $e) {
        Log::error('Error creating shirt: ' . $e->getMessage());
        return redirect()->back()->withErrors('Error creating shirt.');
    }
}


private function uploadImage($image)
{
   
    if (!$image->isValid()) {
        throw new \Exception("Uploaded file is not valid.");
    }

 
    $imagePath = $image->store('shirt_images', 'public'); 
    $imageUrl = asset('storage/' . $imagePath); 

   
    $apiKey = '4fc4da50f6b0774cbbedec6b4a7dd61f';  
    $response = Http::attach('image', file_get_contents($image), $image->getClientOriginalName())
                   ->post('https://api.imgbb.com/1/upload?key=' . $apiKey);

    if ($response->successful()) {
    
        $imageData = $response->json();
        if (isset($imageData['data']['url'])) {
            return $imageData['data']['url']; 
        }
    }

   
    return $imageUrl;  
}
    public function edit($id)
    {
        $shirt = Shirt::findOrFail($id);
        return view('editShirt', compact('shirt'));
    }

    public function update(Request $request, $id)
{
    // Validate the incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'category_id' => 'required|integer',
        'brand_id' => 'required|integer',
        'ImageUrl' => 'nullable|string',
        'ImageUrl1' => 'nullable|string',
        'ImageUrl2' => 'nullable|string',
    ]);

    try {
        
        $token = session('admin_api_token');
        
        if (!$token) {
            return redirect()->route('login')->withErrors('Session expired. Please login again.');
        }

        // Send the PUT request to update the shirt
        $response = Http::withToken($token)->put("http://127.0.0.1:8000/api/shirts/{$id}", $validatedData);
        
        if ($response->successful()) {
            return redirect()->route('shirts.index')->with('success', 'Shirt updated successfully!');
        }

        // Handle error responses
        Log::error('Failed to update shirt', ['status' => $response->status(), 'body' => $response->body()]);
        return redirect()->back()->withErrors('Failed to update shirt.');

    } catch (\Exception $e) {
        Log::error('Error updating shirt: ' . $e->getMessage());
        return redirect()->back()->withErrors('Error updating shirt.');
    }
}


public function destroy($id)
{
    try {
        // Retrieve the API token from session
        $token = session('admin_api_token');
        
        if (!$token) {
            return redirect()->route('login')->withErrors('Session expired. Please login again.');
        }

        // Send the DELETE request to remove the shirt
        $response = Http::withToken($token)->delete("http://127.0.0.1:8000/api/shirts/{$id}");
        
        if ($response->successful()) {
            return redirect()->route('shirts.index')->with('success', 'Shirt deleted successfully!');
        }

        // Handle error responses
        Log::error('Failed to delete shirt', ['status' => $response->status(), 'body' => $response->body()]);
        return redirect()->back()->withErrors('Failed to delete shirt.');

    } catch (\Exception $e) {
        Log::error('Error deleting shirt: ' . $e->getMessage());
        return redirect()->back()->withErrors('Error deleting shirt.');
    }
}
    public function showShirtInfo($id)
    {
        $shirt = Shirt::findOrFail($id);
        return view('info', compact('shirt'));
    }
    
}


