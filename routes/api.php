<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:api');
Route::get('/get_last_articles/{current_cat}/{current_id}', 'JournalArticles@get_last_articles');

// Заявки в студии
Route::post('/send_request_to_studio', 'Studios@sendRequestToStudio');
Route::put('/finish_request_to_studio', 'Studios@finishRequestToStudio');

// Новое апи
Route::get('/ping', 'ApiEvents@ping');
Route::get('/get_index', 'ApiEvents@get_index');
Route::get('/get_carousel', 'ApiEvents@get_carousel');
Route::get('/get_closest_events', 'ApiEvents@get_closest_events');
Route::get('/get_closest_exhibitions', 'ApiEvents@get_closest_exhibitions');
Route::get('/get_news/{offset}', 'ApiEvents@get_news');
// Мероприятия
Route::get('/get_event/{id}', 'ApiEvents@get_event');
Route::get('/get_past_events/{year}', 'ApiEvents@get_past_events');
// Студии
Route::get('/get_studios_by_directions', 'ApiStudio@get_studios_by_directions');
// Страницы
Route::get('/get_page/{id}', 'ApiPages@get_page');
Route::get('/get_psychological', 'ApiPages@get_psychological_page');
Route::get('/get_volunteer', 'ApiPages@get_volunteer_page');
Route::get('/get_family', 'ApiPages@get_family_page');
Route::get('/get_service', 'ApiPages@get_service_page');
