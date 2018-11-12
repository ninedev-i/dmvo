<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:api');
Route::get('/get_last_articles/{current_cat}/{current_id}', 'JournalArticles@get_last_articles');
Route::post('/sendRequestToStudio', 'Studios@sendRequestToStudio');
