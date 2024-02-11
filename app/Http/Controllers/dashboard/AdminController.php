<?php

namespace App\Http\Controllers\dashboard;

use Carbon\Carbon;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        return view('backend.login.admin_login');
    }

    public function Dashboard(){
       $users = DB::table('users')->count();
        //$product= DB::table('products')->count();
        //$verifayRequests= DB::table('verifay_requests')->count();
        $contact_us= DB::table('contact_us')->count();
        $teams= DB::table('teams')->count();
          return view('backend.index',compact('contact_us','teams','users'));
      }

    public function Login(Request $request){
        // dd($request->all());
        $check =  $request->all();
        if(Auth::guard('admin')->attempt(['email' => $check['email'] , 'password'=>$check['password']])){
            return redirect()->route('admin.dashboard')->with('error' , 'تم تسجيل الدخول المشرف');
        }else{
            return back()->with('error' , 'خطأ في تسجيل دخول بريد الالكتروني او كلمة المرور');
        }
    }

    public function AdminLogout(){
        Auth::guard('admin')->logout();
        return redirect()->route('login_form')->with('error' , 'تم تسجيل الخروج المشرف');
    }

    // public function AdminRegister(){

    //     return view('admin.admin_register');
    // }

    public function AdminRegisterCreate(Request $request){
        // dd($request->all());
        // $request->validate([
        //     'name'      => ['required', 'string', 'max:255'],
        //     'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password'  => ['required', 'confirmed']
        // ]);
        Admin::insert([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->route('login_form')->with('error' , 'تم انشاء حساب مشرف');
    }
}
