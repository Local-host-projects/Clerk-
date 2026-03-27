<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MerchantProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MerchantProfileController extends Controller
{
    
    
    public function dashboard(){
        $order = Orders::all();
        $page = 'dashboard';
        return view('dashboard.merchant.dashboard',compact(['page','order']));
    }
    public function showProduct($id){
        $product = Products::find($id);
        return view('dashboard.merchant.view-single-product',compact('product'));
    }
    public function store(Request $request){
        // dd($request);
       $data = $request->validate([
        'business_name'=>'required|max:255|string',
        'business_email'=>'required|email|unique:merchant_profiles,business_email',
        'business_phone'=>'required|max:11|string',
        'business_address'=>'required|string',
        'business_account_number'=>'required|max:10',
        'bank'=>'required|string|max:255'
       ]);
       $data['status'] = 'complete';
       $data['user_id'] = Auth::user()->id;
    //    dd($data);
       $merchant = MerchantProfile::create($data);
       if ($merchant) {
         return redirect()->route('merchant.dashboard');
       }
        return back()->with('error','error creating merchant profile, try again.');
    }
    public function products(){
        $page = 'products';
        $merchant = MerchantProfile::where('user_id',Auth::user()->id)->first('id');
        $products = Products::where('merchant',$merchant->id)->orderBy('created_at','desc')->get();
        return view('dashboard.merchant.products',compact(['page','products']));
    }

public function createOrder(Request $request)
{
    // Validate the incoming delivery data
    $validated = $request->validate([
        'product_id'      => 'required|exists:products,id',
        'quantity'        => 'required|integer|min:1',
        'customer_name'   => 'required|string|max:255',
        'customer_phone'  => 'required|string|max:20',
        'customer_email'  => 'nullable|email|max:255',
        'address'         => 'required|string|max:500',
        'city'            => 'required|string|max:100',
        'postal_code'     => 'nullable|string|max:20',
        'payment_method'  => 'required|string',
    ]);
    // dd($request->all());
    $product = Products::findOrFail($request->product_id);

    // Physical goods stock check
    if ($product->type === 'physical' && $product->stock < $request->quantity) {
        return back()->with('error', 'Not enough stock available for this item.');
    }

    // Ensure merchant exists (retrieving the ID specifically)
    $merchantId = $product->merchant;
    if (!$merchantId) {
        return back()->with('error', 'The merchant profile for this product is missing.');
    }

    // Calculate Total: (Price * Qty) + 1.5% Service Fee
    $subtotal = $product->price * $request->quantity;
    $serviceFee = $subtotal * 0.015;
    $finalTotal = $subtotal + $serviceFee;

    // Generate unique Clerk Order ID (CK + 6 Alphanumeric)
    do {
        $orderId = 'CK' . strtoupper(Str::random(10));
    } while (Orders::where('order_id', $orderId)->exists());
    do {
        $secret = strtoupper(Str::random(16));
    } while (Orders::where('secret', $secret)->exists());

    // Create the order record with delivery details
    $order = Orders::create([
        'product_id'      => $product->id,
        'merchant_id'     => $merchantId,
        'order_id'        => $orderId,
        'quantity'        => $request->quantity,
        'total_price'     => $finalTotal,
        'customer_name'   => $request->customer_name,
        'customer_phone'  => $request->customer_phone,
        'customer_email'  => $request->customer_email,
        'address'         => $request->address,
        'city'            => $request->city,
        'postal_code'     => $request->postal_code,
        'payment_method'  => $request->payment_method,
        'secret'          => $secret,
        'payment_status'  => 'pending', // Defaulting to pending until transaction is verified
    ]);

    // Inventory management
    if ($product->type === 'physical') {
        $product->decrement('stock', $request->quantity);
    }

    // Redirect to the order confirmation/payment page
    return redirect()->route('product.order', ['id' => $order->id]);
}
public function order($id){
    $order = Orders::find($id);
    $product = Products::find($order->product_id);
    return view('product.order',compact(['order','product']));
}
public function profile(){
    $page = 'profile';
    $merchant = MerchantProfile::where('user_id',Auth::user()->id)->first();
    return view('dashboard.merchant.profile',compact(['page','merchant']));
}
public function updateMerchantProfile(Request $request){
    $data = $request->validate([
        'business_name'=>'required|max:255|string',
        'business_email'=>'required|email|unique:merchant_profiles,business_email',
        'business_phone'=>'required|max:11|string',
        'business_address'=>'required|string',
        'business_account_number'=>'required|max:10',
        'bank'=>'required|string|max:255'
       ]);
    $merchant = MerchantProfile::where('user_id',Auth::user()->id)->get();
    $merchant->update($data);
    return back()->with('success','successfully updated profile');
}
    
}
