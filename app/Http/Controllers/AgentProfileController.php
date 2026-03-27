<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentProfile;
use App\Models\Products;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AgentProfileController extends Controller
{
    public function store(Request $request){
        $data = $request->validate([
            'full_name'=>'required|max:255',
            'phone'=>'required|max:11',
            'address'=>'required|string',
            'connected_bank_accounts'=>'required',
            'google_map_link'=>'string'
            ]);
            $data['user_id'] = Auth::user()->id;
            $data['status'] = 'complete';
        // dd($data);
        $agent = AgentProfile::create($data);
        if ($agent) {
            return redirect()->route('agent.panel');
        }
        return back()->with('error','error creating merchant profile, try again.');
    }
    public function getAccessToken()
{
    $clientId = config('services.interswitch.client_id');
    $clientSecret = config('services.interswitch.client_secret');

    $credentials = base64_encode("$clientId:$clientSecret");

    $response = Http::withHeaders([
        'Authorization' => "Basic $credentials",
        'Content-Type' => 'application/x-www-form-urlencoded'
    ])->asForm()->post('https://passport.interswitchng.com/passport/oauth/token', [
        'grant_type' => 'client_credentials'
    ]);

    if (!$response->successful()) {
        return response()->json(['error' => 'Unable to fetch token'], 500);
    }

    return response()->json($response->json());
}
    public function panel(){
        $page = 'panel';
        return view('dashboard.agent.panel',compact('page'));
    }
    public function orderIdLookup(){
            $id = $_GET['order_id'];
            $order = Orders::where('order_id',$id)->where('payment_status','pending')->first();
            if ($order->exists()) {
                $product = Products::find($order->id);
                return view('dashboard.agent.payment.confirm',compact(['order','product']));
            }
    }
    public function orderIdLookupPage(){
        return view('dashboard.agent.payment.orderID-lookup');
    }

    
}
