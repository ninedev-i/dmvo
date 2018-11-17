<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:api');
Route::get('/get_last_articles/{current_cat}/{current_id}', 'JournalArticles@get_last_articles');

// Заявки в студии
Route::post('/send_request_to_studio', 'Studios@sendRequestToStudio');
Route::put('/finish_request_to_studio', 'Studios@finishRequestToStudio');
