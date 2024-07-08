<?php

use App\Http\Controllers\DrugsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseController;
use App\Http\Middleware\myauth;
use Illuminate\Support\Facades\Route;

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


Route::group(['middleware' => 'Myauth'], function () {

    // Home
    Route::get('/', function () {
        return redirect()->route('home');
    });

    Route::get('/home', function () {
        return view('home');
    })->name("home");

    Route::get('/Something Went wrong', function () {
        return view('subviews.wentWrong');
    })->name('gonwrong');


    //! --------------------------------------------------------
    //? Profile
    //! --------------------------------------------------------

    Route::get('/profile', [SettingsController::class, 'showProfile'])->name('showProfile');
    Route::any('/profile/delete', [SettingsController::class, 'deleteImg'])->name('deleteImg');
    Route::post('/update', [SettingsController::class, 'handleProfileUpdate'])->name('updateProfile');

    //! --------------------------------------------------------
    //? Manage Staff 
    //! --------------------------------------------------------
    Route::get('/Manage staff', [UserController::class, 'showAllStaff'])->name('showAllStaff');

    Route::view('/Register', 'user_settings.Register')->name('Register');
    Route::post('/handleRegister', [UserController::class, 'handleRegister'])->name('handleRegister');

    // Search
    Route::post('/staffSearch', [UserController::class, 'staffSearch'])->name('staffSearch');

    //Delete
    Route::post('/staffDelete', [UserController::class, 'staffDelete'])->name('staffDelete');
    //! ---------------------------------------------------------
    //? purchase
    //! ---------------------------------------------------------
    Route::get('/purchase', [PurchaseController::class, 'showPurchase'])->name('showPurchase');
    Route::post('/purchase', [PurchaseController::class, 'handlePurchase'])->name('handlePurchase')->middleware('no-back');
    Route::get('purchases', [PurchaseController::class, 'showallPurchases'])->name('showallPurchase');

    Route::post('delete/purchase/{purchaseId}/{prodId}', [PurchaseController::class, 'deletePurchase'])->name('deletePurchase');
    Route::get('search/purchase', [PurchaseController::class, 'PurchaseSearch'])->name('PurchaseSearch');



    //! ---------------------------------------------------------
    //? drugs
    //! ---------------------------------------------------------

    Route::get('add/add Drug', [DrugsController::class, 'showAddDrug'])->name('showAddDrug');
    Route::post('add/drug', [DrugsController::class, 'handleAddDrug'])->name('handleAddDrug');

    Route::get('all/drugs', [DrugsController::class, 'showAllDrugs'])->name('showAllDrugs');

    Route::get('search/drugs', [DrugsController::class, 'DrugsSearch'])->name('DrugsSearch');

    Route::post('delete/drug/{id}', [DrugsController::class, 'deleteDrug'])->name('deleteDrug');
    Route::get('update/drug/{id}', [DrugsController::class, 'showUpdateDrug'])->name('showUpdateDrug');
    Route::post('update/drug/{id}', [DrugsController::class, 'handleUpdateDrug'])->name('handleUpdateDrug');

    Route::get('drug/{id}/{name}', [DrugsController::class, 'showDrug'])->name('showDrug');


    //! --------------------------------------------------------
    //? Logout
    //! --------------------------------------------------------
    Route::get("/logout", function () {
        session()->invalidate();
        return redirect()->route('home');
    })->name('logout');
});




use Illuminate\Support\Facades\DB;

Route::get('/login', function () {    
    return view('login');
})->name("showlogin");


Route::get('/login/{param}', function ($username) {
    return view(
        'login',
        [
            'username' => $username,
            'Error' => "<span class='error'>Username or Password is incorrect </span>",
        ]
    );
})->name("slogin_param");



Route::post('/login', [UserController::class, 'login'])->name('login');


Route::fallback(function () {
    return view('subviews.wentWrong');
});
