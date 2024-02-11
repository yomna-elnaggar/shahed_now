<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutUs;
use App\Http\Resources\TermsConditionsResource;


class AboutUsController extends Controller
{
    //termsConditions
    public function __construct()
    {
        $this->middleware('admin')->except('AboutUs');
    }

    public function index()
    {
        $aboutUs =AboutUs::first();
       //dd($termsConditions);
        return view('backend.aboutUs.index',compact('aboutUs'));
    }

    public function edit()
    {
        $aboutUs = AboutUs::first();
        return view('backend.aboutUs.edit', compact('aboutUs'));
    }

    public function update(Request $request)
    {
        AboutUs::first()->update([
            'about_us'=>$request->about_us,
        ]);

        return redirect()->route('aboutUs.all')->with('msg', 'تم تحديث عنا ]');
    }

  /////api get TermsConditions

  
     public function AboutUs()
    {
        try {
            
            $data = AboutUs::first();
           
            $success['success'] = true;
            $success['data'] = $data;
            $success['message'] = __('message.success');
            return response()->json($success, 200);
        }catch (\Exception $e) {
            
            return response()->json(['error' => $e->getMessage()], 500);
        }
  
       
    }
}
