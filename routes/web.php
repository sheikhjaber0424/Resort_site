<?php

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

Route::get('/',[ResortController::class,'index']);

//To show Resort detail
Route::get('/detail/{id}',[ResortController::class,'detail']);

//Admin Add Resort
Route::get('/admin/addResort',[ResortController::class,'addResort']);

// Booking page
Route::get('/booking/{id}',[ResortController::class,'booking']);

// Show all resort data to admin
Route::get('/admin/resortData',[ResortController::class,'resortData']);

// Show all booking data to admin
Route::get('/admin/bookingList',[ResortController::class,'bookingList']);

// to store resort data
Route::post('/resorts',[ResortController::class,'store']);

//To Edit resort in admin panel
Route::get('/admin/edit/{id}',[ResortController::class,'edit']);

// Edit resort in admin panel
Route::put('/update/{id}',[ResortController::class,'update']);

// To delete resort in admin panel
Route::delete('/delete/{id}',[ResortController::class,'destroy']);

//admin page
Route::get('/admin',[ResortController::class,'resortData']);

// To create new admin in admin panel
Route::post('/createAdmin',[ResortController::class,'createAdmin']);
Route::get('/createAdmin', function () {  
    return view('createAdmin');
});

// To save the booking info
Route::post('/save',[ResortController::class,'save']);


// for search in admin panel
Route::get('/admin/searchData',[ResortController::class,'searchData']);
Route::get('/admin/searchBooking',[ResortController::class,'searchBooking']);
Auth::routes();


