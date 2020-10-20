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

Route::get('/vouchers/{email}', ['as' => 'api.vouchers', 'uses' => 'VoucherCodeController@list'])->where('email', "[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}");
Route::post('/voucher/', ['as' => 'api.voucher', 'uses' => 'VoucherCodeController@use']);