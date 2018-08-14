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

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:api');

Route::post('/service/transeforce','Service@OrderTf')->name('service');
Route::post('/psychological', 'Psychological@OrderPsy')->name('psychological');
Route::post('/volunteer','Online@MailToOnline')->name('volunteer');
Route::get('/admin/deletephoto/{id}/{name}', 'Admin@deletePhoto')->name('admin');
Route::get('/admin/deleteStudioPhoto/{shortname}/{name}', 'Admin@deleteStudioPhoto')->name('admin');
