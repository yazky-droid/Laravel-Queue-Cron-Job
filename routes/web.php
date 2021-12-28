<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\TransactionController;

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
    return Inertia::render('Index',[
        'auth'=>auth()->user()
    ]);
})->middleware('auth');
Route::get('/tambah-transaksi', function () {
    return Inertia::render('AddTransactions',[
        'auth'=>auth()->user()
    ]);
})->middleware('auth');
Route::get('/lihat-transaksi', function () {
    return Inertia::render('ShowTransactions',[
        'auth'=>auth()->user()
    ]);
})->middleware('auth');
Auth::routes();


Route::get('/transaction/{id}',[TransactionController::class,'index']);
Route::post('/transaction',[TransactionController::class,'store']);
Route::put('/transaction/{transaction}',[TransactionController::class,'update']);

Route::get('/test',[MailController::class,'test']);
