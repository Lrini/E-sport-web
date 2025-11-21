<?php

use Illuminate\Support\Facades\Route;

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
    $lombas = \App\Models\lomba::all();
    return view('participant', compact('lombas'));
});

Route::post('/participant', 'App\Http\Controllers\PesertaPostController@store');

Route::get('/support', function () {
    return view('support');
});
