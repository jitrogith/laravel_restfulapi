<?php

use App\Http\Controllers\BukuFEController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('buku', [BukuFEController::class, 'index']);
Route::post('buku', [BukuFEController::class, 'store']);
Route::get('buku/{id}', [BukuFEController::class, 'edit']);
Route::put('buku/{id}', [BukuFEController::class, 'update']);
Route::delete('buku/{id}', [BukuFEController::class, 'destroy']);
