<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentProfile;
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
            ]);
            $data['user_id'] = Auth::user()->id;
            $data['status'] = 'complete';
        // dd($data);
        $agent = AgentProfile::create($data);
        if ($agent) {
            return redirect()->route('agent.payment.register');
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
        return view('dashboard.agent.panel');
    }
    public function paymentRegister(){
        return view('dashboard.agent.payment.registerPaymentDetails');
    }

    
}
