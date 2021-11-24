<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\ProyekController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('auth', [AuthController::class,  'login'])->name('auth');

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [HomeController::class, 'index'])->name('home');
	Route::get('cuti', [CutiController::class, 'index'])->name('cuti');
	Route::get('proyek', [ProyekController::class, 'index'])->name('proyek');
	Route::post('karyawan/store', [HomeController::class,  'store'])->name('karyawan.store');
	Route::post('karyawan/update/{id}', [HomeController::class,  'update'])->name('karyawan.update');
	Route::post('karyawan/destroy/{id}', [HomeController::class,  'destroy'])->name('karyawan.destroy');
	Route::get('karyawan/search', [HomeController::class,  'search'])->name('karyawan.search');
	Route::post('karyawancuti/store', [CutiController::class,  'store'])->name('karyawancuti.store');
	Route::post('karyawancuti/update/{id}', [CutiController::class,  'update'])->name('karyawancuti.update');
	Route::post('karyawancuti/destroy/{id}', [CutiController::class,  'destroy'])->name('karyawancuti.destroy');
	Route::get('karyawancuti/search', [CutiController::class,  'search'])->name('karyawancuti.search');
	Route::post('karyawanproyek/store', [ProyekController::class,  'store'])->name('karyawanproyek.store');
	Route::post('karyawanproyek/update/{id}', [ProyekController::class,  'update'])->name('karyawanproyek.update');
	Route::post('karyawanproyek/destroy/{id}', [ProyekController::class,  'destroy'])->name('karyawanproyek.destroy');
	Route::get('karyawanproyek/search', [ProyekController::class,  'search'])->name('karyawanproyek.search');
 	Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});