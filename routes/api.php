<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Petugas@register');
Route::post('login', 'Petugas@login');
Route::post('edit/{id}', 'Petugas@edit')->middleware('jwt.verify');

Route::post('register_pelanggan', 'Pelanggan@register')->middleware('jwt.verify');
Route::post('edit_pelanggan/{id}', 'Pelanggan@edit')->middleware('jwt.verify');
Route::delete('hapus_pelanggan/{id}', 'Pelanggan@hapus')->middleware('jwt.verify');

Route::post('register_transaksi', 'Transaksi@register')->middleware('jwt.verify');
Route::post('edit_transaksi/{id}', 'Transaksi@edit')->middleware('jwt.verify');
Route::delete('hapus_transaksi/{id}', 'Transaksi@hapus')->middleware('jwt.verify');

Route::post('register_detail', 'DetailTransaksi@register')->middleware('jwt.verify');
Route::post('edit_detail/{id}', 'DetailTransaksi@edit')->middleware('jwt.verify');
Route::post('detail_transaksi', 'Transaksi@tampil')->middleware('jwt.verify');
Route::delete('hapus_detail/{id}', 'DetailTransaksi@hapus')->middleware('jwt.verify');

Route::post('edit_jenis/{id}', 'JenisCuci@edit')->middleware('jwt.verify');
