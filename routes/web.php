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





Route::get('/datatable', function () {
    return view('datatable');
});


Route::resource('kasie/unitkerja', 'Kasie\UnitKerjaController');
Route::resource('kasie/pekerjaan', 'Kasie\PekerjaanController');
Route::resource('kasie/aktifitas', 'Kasie\AktifitasController');
Route::get('kasie/intruksi/beri_intruksi', 'Kasie\IntruksiController@beri_intruksi');
Route::get('kasie/intruksi/izin_bantuan', 'Kasie\IntruksiController@izin_bantuan');
Route::get('kasie/intruksi/detail_izin/{id}', 'Kasie\IntruksiController@detail_izin');
Route::get('kasie/intruksi/data_intruksi', 'Kasie\IntruksiController@data_intruksi');
Route::get('kasie/intruksi/edit/{id}', 'Kasie\IntruksiController@edit');
Route::get('kasie/intruksi/get_aktifitas', 'Kasie\IntruksiController@get_aktifitas_ajax');
Route::get('kasie/intruksi/get_bawahan_bantuan', 'Kasie\IntruksiController@get_bawahan_bantuan_ajax');
Route::post('kasie/intruksi/create_intruksi', 'Kasie\IntruksiController@create_intruksi');
Route::get('helpdesk/login', 'AuthController@index');
Route::post('helpdesk/ceklogin', 'AuthController@ceklogin');\
Route::put('kasie/intruksi/penilaian/{id}', 'Kasie\IntruksiController@penilaian');
Route::put('kasie/intruksi/edit_izin/{id}', 'Kasie\IntruksiController@edit_izin');
Route::get('logout', 'AuthController@logout');
Route::get('kasie/intruksi/perintah_intruksi', 'Kasie\IntruksiController@perintah_intruksi');
Route::get('kasie/intruksi/perintah_intruksi/edit/{idb}', 'Kasie\IntruksiController@detail_perintah_intruksi');
Route::put('kasie/intruksi/kumpulkan/{id}', 'Kasie\IntruksiController@kumpulkan');
Route::get('kasie/dashboard', 'Kasie\DashboardController@index');

Route::get('staf/intruksi', 'Staf\IntruksiController@index');
Route::get('staf/dashboard', 'Staf\DashboardController@index');
Route::get('staf/intruksi/edit/{idb}', 'Staf\IntruksiController@edit');
Route::put('staf/intruksi/kumpulkan/{id}', 'Staf\IntruksiController@kumpulkan');

Route::get('kasubdit/dashboard', 'Kasubdit\DashboardController@index');
Route::get('kasubdit/intruksi/beri_intruksi', 'Kasubdit\IntruksiController@beri_intruksi');
Route::post('kasubdit/intruksi/create_intruksi', 'Kasubdit\IntruksiController@create_intruksi');
Route::get('kasubdit/intruksi/data_intruksi', 'Kasubdit\IntruksiController@data_intruksi');
Route::get('kasubdit/intruksi/edit/{id}', 'Kasubdit\IntruksiController@edit');
Route::put('kasubdit/intruksi/penilaian/{id}', 'Kasubdit\IntruksiController@penilaian');
Route::get('kasubdit/intruksi/izin_bantuan', 'Kasubdit\IntruksiController@izin_bantuan');
Route::get('kasubdit/intruksi/detail_izin/{id}', 'Kasubdit\IntruksiController@detail_izin');
Route::put('kasubdit/intruksi/edit_izin/{id}', 'Kasubdit\IntruksiController@edit_izin');


