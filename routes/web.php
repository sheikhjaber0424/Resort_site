<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResortController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



//To show Resort detail


//Admin Add Resort
// Route::get('/admin/addResort',[ResortController::class,'addResort']);

// Booking page


// Show all resort data to admin
// Route::get('/admin/resortData',[ResortController::class,'resortData']);


// Show all booking data to admin


// to store resort data
// Route::post('/resorts',[ResortController::class,'store']);

//To Edit resort in admin panel
// Route::get('/admin/edit/{id}',[ResortController::class,'edit']);

// Edit resort in admin panel
// Route::put('/update/{id}',[ResortController::class,'update']);

// To delete resort in admin panel
// Route::delete('/delete/{id}',[ResortController::class,'destroy']);



Route::get('/',[ResortController::class,'index']);

Route::get('/detail/{id}',[ResortController::class,'detail']);

Route::get('/booking/{id}',[ResortController::class,'booking']);

Route::get('/admin/bookingList',[ResortController::class,'bookingList']);

// To create new admin in admin panel
Route::post('/createAdmin',[ResortController::class,'createAdmin']);
Route::get('/createAdmin', function () {  
    return view('admin.create_admin');
});

// To save the booking info
Route::post('/save',[ResortController::class,'save']);


// for search in admin panel
Route::get('/admin/searchData',[ResortController::class,'searchData']);
Route::get('/admin/searchBooking',[ResortController::class,'searchBooking']);

Route::resource('resorts', AdminController::class);

Auth::routes();


