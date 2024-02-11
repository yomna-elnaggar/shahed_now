<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\dashboard\TeamController;
use App\Http\Controllers\dashboard\AboutUsController;
use App\Http\Controllers\dashboard\PackageController;
use App\Http\Controllers\Api\userAuth\LoginController;
use App\Http\Controllers\Api\Paymob\ChackoutController;
use App\Http\Controllers\Api\userAuth\LogoutController;
use App\Http\Controllers\Api\userAuth\ProfileController;
use App\Http\Controllers\Api\userAuth\PasswordController;
use App\Http\Controllers\Api\userAuth\RegisterController;
use App\Http\Controllers\dashboard\FootballMatchController;
use App\Http\Controllers\dashboard\PrivacyPolicyController;
use App\Http\Controllers\dashboard\TermsConditionsController;
use App\Http\Controllers\Api\userAuth\ForgotPasswordController;
use App\Http\Controllers\Api\Paymob\PaymobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

 ////user authentication
 Route::post('register', [RegisterController::class,'register']);
 Route::post('login', [LoginController::class,'login']);
 Route::get('/login/{provider}', [RegisterController::class,'redirectToProvider']);
 Route::get('/login/{provider}/callback', [RegisterController::class,'handleProviderCallback']);
////user forget password by email
 Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
 Route::post('resetPassword', [ForgotPasswordController::class, 'completeResetPassword']);

////Package
 Route::get('/package',[PackageController::class,'Package']);
////teams
 Route::get('/teams',[TeamController::class,'Team']);
////FootballMatch
Route::get('FootballMatch/{date}', [FootballMatchController::class,'FootballMatch']);

Route::middleware('auth:sanctum')->group(function() {
    ////user
    Route::post('logout', [LogoutController::class, 'logout']);
    Route::get('/profile',[ProfileController::class,'profile']);
    Route::post('updateProfile', [ProfileController::class,'update']);
    Route::post('destroy', [ProfileController::class, 'destroy']);
    Route::post('change-password',[PasswordController::class,'changePassword']);
    ////Terms Conditions
    Route::get('TermsConditions', [TermsConditionsController::class,'TermsConditions']);
    ////PrivacyPolicy
    Route::get('PrivacyPolicy', [PrivacyPolicyController::class,'PrivacyPolicy']);
    ////AboutUs
    Route::get('AboutUs', [AboutUsController::class,'AboutUs']);
    ////contactUs
  	Route::post('contactUs', [ContactUsController::class,'contactUs']);
    ////FootballMatch
   // Route::get('FootballMatch/{date}', [FootballMatchController::class,'FootballMatch']);
   ////
   Route::post('chackout', [ChackoutController::class,'chackout']);
   Route::get('callback', [PaymobController::class,'callback']);
   
});


