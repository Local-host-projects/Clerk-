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
            'connected_bank_account'=>'required',
        ]);
        $data['user_id'] = Auth::user()->id; 
        $agent = AgentProfile::create($data);
        if ($agent) {
            return redirect()->route('merchant.projects');
        }
        return back()->with('error','error creating merchant profile, try again.');
    }
    
}
