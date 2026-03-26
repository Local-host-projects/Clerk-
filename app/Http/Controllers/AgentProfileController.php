<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AgentProfile;
use Illuminate\Support\Facades\Auth;

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
        // dd($data);
        $agent = AgentProfile::create($data);
        if ($agent) {
            return redirect()->route('agent.payment.register');
        }
        return back()->with('error','error creating merchant profile, try again.');
    }
    public function panel(){
        return view('dashboard.agent.panel');
    }
    public function paymentRegister(){
        return view('dashboard.agent.payment.registerPaymentDetails');
    }
    
}
