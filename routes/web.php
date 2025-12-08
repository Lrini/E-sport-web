<?php

use Illuminate\Support\Facades\Route;
use App\Models\lomba;
use App\Models\acara;
use App\Models\grade;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PesertaPostController;
use App\Http\Controllers\PenontonPostController;
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
// route untuk halaman utama
Route::get('/', function () {
    return view('index');
});


// route untuk halaman participant
//$lombas, acaras, grades diambil dari database menggunakan model lomba, acara, grade dan dikirim ke view participant menggunakan compact
//tujuannya agar data dari database bisa ditampilkan di halaman participant
Route::get('/participant', function () {
    $lombas = lomba::all();
    $acaras = acara::all();
    $grades = grade::all();
    return view('participant', compact('lombas', 'acaras', 'grades'));
});

//route untuk mengirim data participant ke database menggunakan controller PesertaPostController
Route::post('/participant', [PesertaPostController::class, 'store']);

// route untuk halaman support
Route::get('/support', function () {
    $lombas = lomba::all();
    $acaras = acara::all();
    return view('support', compact('lombas', 'acaras'));
});

//route untuk mengirim data support ke database menggunakan controller PenontonPostController
Route::post('/support', [PenontonPostController::class, 'store']);

// Admin Authentication Routes
// Menambahkan route untuk menampilkan form login admin, proses login, dan logout
//showLoginForm, login, dan logout mengacu pada method di AdminLoginController
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('auth');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard')->middleware('auth');


// Resource routes for managing 'acara' in the admin dashboard
Route::get('admin/dashboard/acara/data', [App\Http\Controllers\AcaraPostController::class, 'getdata'])->name('acara.data')->middleware('auth');
Route::resource('admin/dashboard/acara', App\Http\Controllers\AcaraPostController::class)->middleware('auth');
