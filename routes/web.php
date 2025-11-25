<?php

use Illuminate\Support\Facades\Route;
use App\Models\lomba;
use App\Models\acara;
use App\Models\grade;
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

Route::get('/', function () {
    return view('index');
});

Route::get('/participant', function () {
    $lombas = lomba::all();
    $acaras = acara::all();
    $grades = grade::all();
    return view('participant', compact('lombas', 'acaras', 'grades'));
});

Route::post('/participant', [PesertaPostController::class, 'store']);

Route::get('/support', function () {
    $lombas = lomba::all();
    $acaras = acara::all();
    return view('support', compact('lombas', 'acaras'));
});

Route::post('/support', [PenontonPostController::class, 'store']);

use App\Http\Controllers\AdminLoginController;

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
