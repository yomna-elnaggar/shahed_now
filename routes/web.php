<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\dashboard\TeamController;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\AboutUsController;
use App\Http\Controllers\dashboard\PackageController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ProductsController;
use App\Http\Controllers\dashboard\SubCategoryController;
use App\Http\Controllers\dashboard\AdminProfileController;
use App\Http\Controllers\dashboard\FootballMatchController;
use App\Http\Controllers\dashboard\PrivacyPolicyController;
use App\Http\Controllers\dashboard\TermsConditionsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/' , [AdminController::class, 'Dashboard'])->name('admin.dashboard')
    ->middleware('admin');
Route::prefix('admin')->group(function (){
    // for Login and Dashboard
    Route::get('/login' , [AdminController::class, 'index'])->name('login_form');
    Route::post('/login/owner' , [AdminController::class, 'Login'])->name('admin.login');
    Route::get('/logout' , [AdminController::class, 'AdminLogout'])->name('admin.logout')
    ->middleware('admin');
    // Route::get('/register' , [AdminController::class, 'AdminRegister'])->name('admin.register');
    Route::post('/register/create' , [AdminController::class, 'AdminRegisterCreate'])->name('admin.register.create');
    /* =================================
    packages
    ===================================*/
    Route::get('package/', [PackageController::class, 'index'])->name('package.all');
    Route::get('package/create', [PackageController::class, 'create'])->name('package.create');
    Route::post('package/store', [PackageController::class, 'store'])->name('package.store');
    Route::get('package/edit/{id}', [PackageController::class, 'edit'])->name('package.edit');
    Route::post('package/update/{id}', [PackageController::class, 'update'])->name('package.update');
    Route::get('package/destroy/{id}', [PackageController::class, 'destroy'])->name('package.destroy');
    /* =================================
    admin profile
    ===================================*/
    Route::get('admin', [AdminProfileController::class, 'show'])->name('admin.show');
    Route::get('admin/edit', [AdminProfileController::class, 'edit'])->name('admin.edit');
    Route::post('admin/update/{id}', [AdminProfileController::class, 'update'])->name('admin.update');
    /* =================================
    category
    ===================================*/
    Route::get('category/', [CategoryController::class, 'index'])->name('category.all');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    /* =================================
    FootballMatch
    ===================================*/
    Route::get('FootballMatch/', [FootballMatchController::class, 'index'])->name('FootballMatch.all');
    Route::get('FootballMatch/create', [FootballMatchController::class, 'create'])->name('FootballMatch.create');
    Route::post('FootballMatch/store', [FootballMatchController::class, 'store'])->name('FootballMatch.store');
    Route::get('FootballMatch/edit/{id}', [FootballMatchController::class, 'edit'])->name('FootballMatch.edit');
    Route::post('FootballMatch/update/{id}', [FootballMatchController::class, 'update'])->name('FootballMatch.update');
    Route::get('FootballMatch/destroy/{id}', [FootballMatchController::class, 'destroy'])->name('FootballMatch.destroy');
    /* =================================
    team
    ===================================*/
    Route::get('team/', [TeamController::class, 'index'])->name('team.all');
    Route::get('team/create', [TeamController::class, 'create'])->name('team.create');
    Route::post('team/store', [TeamController::class, 'store'])->name('team.store');
    Route::get('team/edit/{id}', [TeamController::class, 'edit'])->name('team.edit');
    Route::post('team/update/{id}', [TeamController::class, 'update'])->name('team.update');
    Route::get('team/destroy/{id}', [TeamController::class, 'destroy'])->name('team.destroy');
    /* =================================
    about us
    ===================================*/
    Route::get('aboutUs/', [AboutUsController::class, 'index'])->name('aboutUs.all');
    Route::get('aboutUs/create', [AboutUsController::class, 'create'])->name('aboutUs.create');
    Route::post('aboutUs/store', [AboutUsController::class, 'store'])->name('aboutUs.store');
    Route::get('aboutUs/edit', [AboutUsController::class, 'edit'])->name('aboutUs.edit');
    Route::post('aboutUs/update', [AboutUsController::class, 'update'])->name('aboutUs.update');
    //Route::get('aboutUs/destroy/{id}', [AboutUsController::class, 'destroy'])->name('aboutUs.destroy');
  
  	/* =================================
    Terms and conditions
    ===================================*/
    Route::get('termsConditions/', [TermsConditionsController::class, 'index'])->name('termsConditions.all');
    Route::get('termsConditions/create', [TermsConditionsController::class, 'create'])->name('termsConditions.create');
    Route::post('termsConditions/store', [TermsConditionsController::class, 'store'])->name('termsConditions.store');
    Route::get('termsConditions/edit', [TermsConditionsController::class, 'edit'])->name('termsConditions.edit');
    Route::post('termsConditions/update', [TermsConditionsController::class, 'update'])->name('termsConditions.update');
   // Route::get('termsConditions/destroy', [TermsConditionsController::class, 'destroy'])->name('termsConditions.destroy');
  
   /* =================================
    privacy policy
    ===================================*/
    Route::get('privacyPolicy/', [PrivacyPolicyController::class, 'index'])->name('privacyPolicy.all');
    Route::get('privacyPolicy/create', [PrivacyPolicyController::class, 'create'])->name('privacyPolicy.create');
    Route::post('privacyPolicy/store', [PrivacyPolicyController::class, 'store'])->name('privacyPolicy.store');
    Route::get('privacyPolicy/edit', [PrivacyPolicyController::class, 'edit'])->name('privacyPolicy.edit');
    Route::post('privacyPolicy/update', [PrivacyPolicyController::class, 'update'])->name('privacyPolicy.update');
   // Route::get('privacyPolicy/destroy/{id}', [PrivacyPolicyController::class, 'destroy'])->name('privacyPolicy.destroy');

    /* =================================
    Contact Us
    ===================================*/
    Route::get('ContactUs/', [ContactUsController::class, 'index'])->name('ContactUs.all');
    Route::get('ContactUs/destroy/{id}', [ContactUsController::class, 'destroy'])->name('ContactUs.destroy');
  

})->middleware('admin');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
