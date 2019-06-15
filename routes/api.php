<?php

use Illuminate\Http\Request;

Route::get('/user', function (Request $request) { return $request->user(); })->middleware('auth:api');
Route::get('/get_last_articles/{current_cat}/{current_id}', 'JournalArticles@get_last_articles');

// Заявки в студии
Route::post('/send_request_to_studio', 'Studios@sendRequestToStudio');
Route::put('/finish_request_to_studio', 'Studios@finishRequestToStudio');

// Новое апи
Route::get('/ping', 'Api\Events@ping');
Route::get('/get_index', 'Api\Events@get_index');
Route::get('/get_carousel', 'Api\Events@get_carousel');
Route::get('/get_closest_events', 'Api\Events@get_closest_events');
Route::get('/get_all_closest_events', 'Api\Events@get_all_closest_events');
Route::get('/get_closest_exhibitions', 'Api\Events@get_closest_exhibitions');
Route::get('/get_news/{offset}', 'Api\Events@get_news');
Route::get('/get_news/{offset}/{tag}', 'Api\Events@get_news');
// Мероприятия
Route::get('/get_event/{id}', 'Api\Events@get_event');
Route::get('/get_past_events/{year}', 'Api\Events@get_past_events');
// Студии
Route::get('/get_studios_by_directions', 'Api\Studios@get_studios_by_directions');
Route::get('/get_studio/{shortname}', 'Api\Studios@get_studio');
// Страницы
Route::get('/get_page/{id}', 'Api\Pages@get_page');
Route::get('/get_psychological', 'Api\Pages@get_psychological_page');
Route::get('/get_volunteer', 'Api\Pages@get_volunteer_page');
Route::get('/get_family', 'Api\Pages@get_family_page');
Route::get('/get_service', 'Api\Pages@get_service_page');
Route::get('/get_transforce', 'Api\Pages@get_transforce_page');
Route::get('/get_contacts', 'Api\Pages@get_contacts');
Route::get('/get_people', 'Api\Pages@get_people');
// Отправка форм
Route::post('/mail_psy', 'Api\Mails@mail_psy');
