<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TermsConditions;
use App\Http\Resources\TermsConditionsResource;


class TermsConditionsController extends Controller
{
    //termsConditions
    public function __construct()
    {
        $this->middleware('admin')->except('TermsConditions');
    }

    public function index()
    {
        $termsConditions =TermsConditions::first();
       //dd($termsConditions);
        return view('backend.termsConditions.index',compact('termsConditions'));
    }

    public function edit()
    {
        $termsConditions = TermsConditions::first();
        return view('backend.termsConditions.edit', compact('termsConditions'));
    }

    public function update(Request $request)
    {
        TermsConditions::first()->update([
            'term_condition'=>$request->term_condition,
        ]);

        return redirect()->route('termsConditions.all')->with('msg', 'تم تحديث شروط واحكام');
    }

  /////api get TermsConditions

  
     public function TermsConditions()
    {
        try {
            
            $data = TermsConditions::first();
            $success['success'] = true;
            $success['data'] = $data;
            $success['message'] = __('message.success');
            return response()->json($success, 200);
        }catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
  
       
    }
}
