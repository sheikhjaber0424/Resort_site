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

Auth::routes();

Route::get('/admin/addResort',[ResortController::class,'addResort']);

Route::get('/admin/resortData',[ResortController::class,'resortData']);

Route::post('/resorts',[ResortController::class,'store']);

Route::get('/admin/edit/{id}',[ResortController::class,'edit']);

Route::put('/update/{id}',[ResortController::class,'update']);

Route::delete('/delete/{id}',[ResortController::class,'destroy']);

Route::get('/admin',[ResortController::class,'resortData']);

Route::post('/createAdmin',[ResortController::class,'createAdmin']);
Route::get('/createAdmin', function () {  
    return view('createAdmin');
});


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
