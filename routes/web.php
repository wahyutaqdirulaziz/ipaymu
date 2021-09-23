<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KariawanController;
use App\Http\Controllers\PaymentController;

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

Route::get('/', function () {
    return view('kariawan/index');
})->name('home');


Route::resource('kariawan',KariawanController::class);
Route::get('kariawan',[KariawanController::class,'datakariawan'])->name('data-ajax');
Route::post('payment-send',[PaymentController::class,'sendPayment'])->name('send-payment');
Route::get('product',[PaymentController::class,'index'])->name('product');
Route::get('payment/{id}',[PaymentController::class,'Buyproduct'])->name('payment');

