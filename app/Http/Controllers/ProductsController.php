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
                $path = $request->file('image')->store('products', 'public');
                $data['image_url'] = Storage::url($path);
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
            dd($data);

        $data['type']     = 'physical';
        $data['filepath'] = null; // physical goods don’t have digital files

        // Upload image to storage/app/public/products
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image_url'] = Storage::url($path);
        }
        $merchant = MerchantProfile::where('id',Auth::user()->id)->first('id');
        $data['merchant'] = $merchant->id;
        Products::create($data);

        return redirect()->back()->with('success', 'Physical product created successfully!');
    }
}
