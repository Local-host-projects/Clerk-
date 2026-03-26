<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\MerchantProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function show($id){
        $product = Products::find($id);
        // dd($product);
        return view('product.product-page',compact('product'));
    }
    public function createDigitalGood(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'filepath'    => 'required|url|max:1000', // Dropbox/Drive link
            'variants'    => 'nullable|array',
            ]);
            
            $data['type']  = 'digital';
            $data['stock'] = 0;
            if ($request->hasFile('image')) {
                    $file = Upload($request->file('image'));
                    $data['image_url'] = $file;
            }
            $merchant = MerchantProfile::where('id',Auth::user()->id)->first('id');
            $data['merchant'] = $merchant->id; // optional thumbnail
        Products::create($data);

        return redirect()->back()->with('success', 'Digital product created successfully!');
    }

    /**
     * Create a physical product.
     */
    public function createPhysicalGood(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'variants'    => 'nullable|array',
            'image'       => 'required|image|max:5120', // max 5MB
            ]);
            // dd($data);

        $data['type']     = 'physical';
        $data['filepath'] = null; // physical goods don’t have digital files

        // Upload image to storage/app/public/products
        if ($request->hasFile('image')) {
            $file = Upload($request->file('image'));
            $data['image_url'] = $file;
        }
        $merchant = MerchantProfile::where('id',Auth::user()->id)->first('id');
        $data['merchant'] = $merchant->id;
        Products::create($data);

        return redirect()->back()->with('success', 'Physical product created successfully!');
    }
    public function updateProduct(Request $request, $id)
{
    $product = Products::findOrFail($id);

    $data = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'stock' => 'nullable|integer',
        'filepath' => 'nullable|string',
    ]);

    // handle image upload (only if provided)
    if ($request->hasFile('image')) {
        $data['image_url'] = Upload($request->file('image'));
    }

    // handle product type logic
    if ($product->type === 'digital') {
        $data['stock'] = 0; // digital goods don’t use stock
    }

    if ($product->type === 'physical') {
        $data['filepath'] = null; // physical goods don’t need file
    }

    $product->update($data);

    return redirect()
        ->route('merchant.showProduct', ['id' => $product->id])
        ->with('success', 'Product updated successfully.');
}

}
