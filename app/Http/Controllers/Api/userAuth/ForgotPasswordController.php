<?php

namespace App\Http\Controllers\Api\userAuth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Notifications\ResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'Email not found'], 404);
        }

        $token = Password::createToken($user);

        $user->update([
            'reset_token' => $token,
            'reset_token_expiry' => now()->addMinutes(60), 
        ]);

        $user->notify(new ResetPasswordNotification($token));

        return response()->json(['message' => 'Reset password link sent']);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)
            ->where('reset_token', $request->token)
            ->where('reset_token_expiry', '>=', now())
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Invalid email or token'], 400);
        }

        $user->update([
            'password' => bcrypt($request->password),
            'reset_token' => null,
            'reset_token_expiry' => null,
        ]);

        return response()->json(['message' => 'Password reset successfully']);
    }
}
