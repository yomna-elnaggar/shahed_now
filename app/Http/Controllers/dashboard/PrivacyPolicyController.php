<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Resources\PrivacyPolicyResource;

class PrivacyPolicyController extends Controller
{
    //privacyPolicy
    public function __construct()
    {
        $this->middleware('admin')->except('PrivacyPolicy');
    }

    public function index()
    {
        $privacyPolicy =PrivacyPolicy::first();

        return view('backend.privacyPolicy.index',compact('privacyPolicy'));
    }

    public function edit()
    {
        $privacyPolicy = PrivacyPolicy::first();
        return view('backend.privacyPolicy.edit', compact('privacyPolicy'));
    }

    public function update(Request $request)
    {
    
        PrivacyPolicy::first()->update([
            'privacy_policy'=>$request->privacy_policy,

        ]);

        return redirect()->route('privacyPolicy.all')->with('msg', 'تم تحديث المعلومات');
    }

  /////api get PrivacyPolicy

  
     public function PrivacyPolicy()
    {
        try {
            
            $data = PrivacyPolicy::first();
            $success['success'] = true;
            $success['data'] =$data;
            $success['message'] = __('message.success');
            return response()->json($success, 200);
        }catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
