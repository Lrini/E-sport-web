<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Models\lomba;
use App\Models\acara;
use App\Models\grade;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\PesertaPostController;
use App\Http\Controllers\PenontonPostController;
use App\Http\Controllers\GradePostController;
use App\Http\Controllers\GoogleDriveController;
use Google\Client;
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
    $grades = grade::with('lomba')->get();
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
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('auth:admin');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard.index');
})->name('admin.dashboard')->middleware(['auth:admin', 'isadmin']);


// Resource routes for managing 'acara' in the admin dashboard
Route::get('admin/dashboard/acara/data', [App\Http\Controllers\AcaraPostController::class, 'getdata'])->name('acara.data')->middleware(['auth:admin', 'isadmin']);// route untuk mengambil data acara dalam bentuk json
Route::resource('admin/dashboard/acara', App\Http\Controllers\AcaraPostController::class)->middleware(['auth:admin', 'isadmin']);// route resource untuk mengelola data acara

// Resource routes for managing 'lomba' in the admin dashboard
Route::get('admin/dashboard/lomba/data', [App\Http\Controllers\LombaPostController::class, 'getdata'])->name('lomba.data')->middleware(['auth:admin', 'isadmin']);// route untuk mengambil data lomba dalam bentuk json
Route::resource('admin/dashboard/lomba', App\Http\Controllers\LombaPostController::class)->middleware(['auth:admin', 'isadmin']);// route resource untuk mengelola data lomba

// Resource routes for managing 'grade' in the admin dashboard
Route::get('admin/dashboard/grade/data', [App\Http\Controllers\GradePostController::class, 'getdata'])->name('grade.data')->middleware(['auth:admin', 'isadmin']);// route untuk mengambil data grade dalam bentuk json
Route::resource('admin/dashboard/grade', App\Http\Controllers\GradePostController::class)->middleware(['auth:admin', 'isadmin']);// route resource untuk mengelola data grade

// Resource routes for managing 'penonton' in the admin dashboard
Route::get('admin/dashboard/penonton/data', [App\Http\Controllers\PenontonPostController::class, 'getdata'])->name('penonton.data')->middleware(['auth:admin', 'isadmin']);// route untuk mengambil data penonton dalam bentuk json
Route::resource('admin/dashboard/penonton', App\Http\Controllers\PenontonPostController::class)->middleware(['auth:admin', 'isadmin']);// route resource untuk mengelola data penonton

// Resource routes for managing 'peserta' in the admin dashboard
Route::get('admin/dashboard/peserta/data', [App\Http\Controllers\PesertaPostController::class, 'getdata'])->name('peserta.data')->middleware(['auth:admin', 'isadmin']);// route untuk mengambil data peserta dalam bentuk json
Route::resource('admin/dashboard/peserta', App\Http\Controllers\PesertaPostController::class)->middleware(['auth:admin', 'isadmin']);// route resource untuk mengelola data peserta

// Resource routes for managing 'admin' in the admin dashboard
Route::get('admin/dashboard/admin/data', [App\Http\Controllers\adminPostController::class, 'getdata'])->name('admin.data')->middleware(['auth:admin', 'isadmin']);// route untuk mengambil data admin dalam bentuk json
Route::resource('admin/dashboard/admin', App\Http\Controllers\adminPostController::class)->middleware(['auth:admin', 'isadmin']);// route resource untuk mengelola data admin

// untuk testing google drive upload
Route::get('/auth/google', [GoogleDriveController::class, 'redirect']);
Route::get('/auth/google/redirect', [GoogleDriveController::class, 'redirect']);
Route::get('/auth/google/callback', [GoogleDriveController::class, 'callback']);

//coba upload file ke google drive
// Route::get('/test-upload', function () {
//     $fileName = 'test_'.time().'.txt';
//     Storage::disk('google')->put($fileName, 'Upload pertama dari Laravel!');
//     return 'Upload berhasil ke Google Drive!';
// });


