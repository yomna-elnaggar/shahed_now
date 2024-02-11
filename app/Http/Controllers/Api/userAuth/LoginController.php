<?php

namespace App\Http\Controllers\Api\userAuth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
       // dd($request);
        $credentials =[ 'mobile_number'=>$request->mobile_number, 'password'=>$request->password ];
        $user = User::where('mobile_number', $request->mobile_number)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            $user->tokens()->delete();
            $success['success'] = true;
            $success['token'] = $user->createToken(request()->userAgent())->plainTextToken;
            $success['id'] = $user->id;
            $success['name'] = $user->name;
            $success['message'] = __('message.success');
    
            return response()->json($success, 200);
        }else{
            return response()->json(['error'=>('Unauthorised')], 401);
        }
       
    }
    
   
}
