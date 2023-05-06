<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Http\Request;

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
    return view('welcome');
});

Route::get('mahasiswas/nilai/{nim}', [MahasiswaController::class, 'nilai']);
Route::get('mahasiswas/nilai/{nim}/cetak_khs', [MahasiswaController::class, 'cetak_khs'])->name('cetak_khs');
Route::resource('mahasiswas', MahasiswaController::class);
