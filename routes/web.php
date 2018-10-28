<?php

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

Route::get('/kasie/dashboard', function () {
    return view('kasie.dashboard.index');
});


Route::resource('kasie/unitkerja', 'Kasie\UnitKerjaController');
Route::resource('kasie/pekerjaan', 'Kasie\PekerjaanController');
Route::resource('kasie/aktifitas', 'Kasie\AktifitasController');



