<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MerchantProfile;
use App\Models\Products;

class MerchantProfileController extends Controller
{
    
    
    public function projects(){
        $page = 'projects';
        return view('dashboard.merchant.projects',compact('page'));
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
         return redirect()->route('merchant.projects');
       }
        return back()->with('error','error creating merchant profile, try again.');
    }
    public function products(){
        $page = 'products';
        $merchant = MerchantProfile::where('id',Auth::user()->id)->first('id');
        $products = Products::where('merchant',$merchant->id)->get();
        return view('dashboard.merchant.products',compact(['page','products']));
    }
    
}
