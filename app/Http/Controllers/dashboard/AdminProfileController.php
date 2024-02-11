<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
  
    public function show()
    {
        $admin = Auth::guard('admin')->user();
        //dd($admin->email);
        return view('backend.admin.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $admin = Auth::guard('admin')->user();
        return view('backend.admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password != null){
            $admin->password = Hash::make($request->password);
        }

        $admin->update();

        return redirect()->route('admin.dashboard');
    }

}
