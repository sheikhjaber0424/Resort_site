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

Route::get('/detail/{id}',[ResortController::class,'detail']);

Auth::routes();

Route::get('/admin/addResort',[ResortController::class,'addResort']);

Route::get('/booking/{id}',[ResortController::class,'booking']);


Route::get('/admin/resortData',[ResortController::class,'resortData']);

Route::get('/admin/bookingList',[ResortController::class,'bookingList']);


Route::post('/resorts',[ResortController::class,'store']);

Route::get('/admin/resortData',[ResortController::class,'resortData']);

Route::get('/admin/edit/{id}',[ResortController::class,'edit']);

Route::put('/update/{id}',[ResortController::class,'update']);

Route::delete('/delete/{id}',[ResortController::class,'destroy']);

Route::get('/admin',[ResortController::class,'resortData']);

Route::post('/createAdmin',[ResortController::class,'createAdmin']);
Route::get('/createAdmin', function () {  
    return view('createAdmin');
});

Route::post('/save',[ResortController::class,'save']);


Route::get('/email',[ResortController::class,'email']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
