<?php

use Illuminate\Support\Facades\DB;
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


Route::group(['prefix' => 'admin', 'middleware' => 'checkrole:0'], function () {
    Route::get('/dashboard', 'DashboardController@index');
    Route::resource('ruang', 'RuangController')->except(['create', 'update', 'show']);
    Route::resource('fakultas', 'FakultasController')->except(['create', 'update']);
    Route::resource('prodi', 'ProdiController')->except(['create', 'update', 'show']);
    Route::resource('matkul', 'MataKuliahController')->except(['create', 'update', 'show']);
    Route::resource('kelas', 'KelasController')->except(['create', 'update', 'show']);
    Route::resource('jadwal', 'JadwalController')->except(['create', 'update', 'show']);
    Route::resource('jabatan', 'JabatanController')->except(['create', 'update', 'show']);
    Route::resource('user', 'UserController')->except(['create', 'update', 'show']);
    Route::resource('barang', 'BarangController')->except(['create', 'update', 'show']);
    Route::resource('dosen', 'DosenController')->except(['create', 'update', 'show']);
 
});


Route::group(['prefix' => 'peminjam', 'middleware' => 'checkrole:2'], function () {
    Route::get('/dashboard', 'DashboardController@peminjam');
    Route::get('/pengajuan', 'PengajuanController@index');
    Route::post('/pengajuan', 'PengajuanController@store');
    Route::get('/ruang/{id}', 'RuangController@user_detail');
    Route::get('arsip-data', 'ArsipController@index');
    Route::get('arsip-data/{id}', 'ArsipController@detail');
    Route::get('arsip-data/{id}/surat', 'ArsipController@surat');
});

Route::group(['prefix' => 'akademik', 'middleware' => 'checkrole:1'], function () {
    Route::get('dashboard', 'DashboardController@akademik');
    Route::get('pengajuan', 'PengajuanController@akademik');
    Route::post('pengajuan/ubah_status', 'PengajuanController@ubah_status');
    Route::get('pengajuan/{id}', 'PengajuanController@detail');
    Route::get('pengajuan/{id}/surat', 'PengajuanController@surat');
    Route::get('pengajuan/{id}/lampiran', 'PengajuanController@lampiran');
});


Route::prefix('ajax')->group(function() {
    Route::get('search_kelas/{id}', 'AjaxController@searchKelas');
    Route::get('search_matkul/{id}', 'AjaxController@searchMatkul');
    Route::get('search_barang_id/{id}', 'AjaxController@searchBarangId');
});


Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'AuthController@index');
    Route::post('/', 'AuthController@login');
});

Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'AuthController@register');
    Route::post('/', 'AuthController@register_post');
});

Route::group(['prefix' => 'profile'], function () {
    Route::get('ganti-password', 'ProfileController@index');
    Route::post('ganti-password', 'ProfileController@store');
});

Route::post('logout', 'AuthController@logout');

Route::get('/', 'HomeController@index');
Route::get('detail/{id}', 'HomeController@detail');
Route::get('jadwal', 'HomeController@ruang');
// Route::view('tes', 'tes');
