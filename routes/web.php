<?php
   Route::get('/', 'Index@renderIndexPage')->name('index');
   Route::get('/start', 'Index@renderStartPage')->name('index');
   Route::get('/test', 'Index@renderIndexPage2')->name('index2');

   Route::get('/about', 'PagesController@about')->name('about');
      Route::get('/about/info', 'PagesController@info')->name('about');
      Route::get('/about/team', 'PagesController@teamInfo')->name('about');
         Route::get('/about/teachers', 'PagesController@aboutTeachers')->name('about');
         Route::get('/about/specialists', 'PagesController@aboutSpecialists')->name('about');
         Route::get('/about/administration', 'PagesController@aboutAdministration')->name('about');
         Route::get('/about/people/{id}', 'PagesController@currentPeople')->name('about');
      Route::get('/about/halls', 'PagesController@halls')->name('about');
      Route::get('/about/studio', 'PagesController@studio')->name('about');
      Route::get('/about/history', 'PagesController@history')->name('about');
      Route::get('/about/volunteer', 'PagesController@volunteer')->name('about');
      Route::get('/about/board', 'PagesController@board')->name('about');
      Route::get('/about/massmedia', 'PagesController@massMedia')->name('massmedia');
      Route::get('/about/massmedia/{id}', 'PagesController@massMediaCurrent')->name('massmedia');

   Route::get('/events', 'Events@renderEventsPage')->name('events');
      Route::get('/events/past', 'Events@renderPastEventsPage')->name('events');
      Route::get('/events/search={eventTitle}', 'Events@searchEventsPage')->name('events');
      Route::get('/events/{id}', 'Events@renderCurrentEventPage')->name('events');

   Route::get('/studio', 'Studios@renderStudioPage')->name('studio');
      Route::get('/studio/direction={studioDirection}&price={studioPrice}&age={studioAge}', 'Studios@searchStudioPage')->name('studio');
      Route::get('/studio/{shortname}', 'Studios@renderCurrentStudioPage')->name('studio');

   Route::get('/service', 'Service@renderServicePage')->name('service');
   Route::get('/service/columnhall', 'Service@renderColumnhallPage')->name('service');
   Route::get('/service/bluehall', 'Service@renderBluehallPage')->name('service');
   Route::get('/service/transeforce', 'Service@renderTransforcePage')->name('service');
   Route::post('/service/transeforce','Service@OrderTf')->name('service');

   Route::get('/psychological', 'Psychological@renderPsychologicalPage')->name('psychological');
      Route::get('/psychological/consult', 'Psychological@renderConsultPage')->name('psychological');
      Route::get('/psychological/group', 'Psychological@renderGroupPage')->name('psychological');
      Route::get('/psychological/proforientation', 'Psychological@renderProforientationPage')->name('psychological');
      Route::get('/psychological/training', 'Psychological@renderTrainingPage')->name('psychological');
      Route::post('/psychological', 'Psychological@OrderPsy')->name('psychological');

   Route::get('/volunteer', 'Online@renderOnlinePage')->name('volunteer');
   Route::post('/volunteer','Online@MailToOnline')->name('volunteer');

   Route::get('/family', 'Family@renderFamilyPage')->name('family');

   Route::get('/contact', 'PagesController@contacts')->name('contact');

   Auth::routes();

   Route::get('/logout', 'Admin@getLogout');
   Route::get('/admin', 'Admin@index')->name('admin');

   Route::get('/admin/editpage', 'Admin@editPage')->name('admin');
   Route::get('/admin/editpage/{id}', 'Admin@getEditCurrentPage')->name('admin');
   Route::post('/admin/editpage/{id}', 'Admin@postEditCurrentPage')->name('admin');
   Route::post('/admin/add_attachement', 'Attachments@add');

   Route::get('/admin/editevent', 'Admin@EditEvents')->name('admin');
   Route::get('/admin/addevent', 'Admin@getAddEvent')->name('admin');
   Route::post('/admin/addevent', 'Admin@postAddEvent')->name('admin');
   Route::get('/admin/editevent/{id}', 'Admin@getEditCurrentEvent')->name('admin');
   Route::post('/admin/editevent/{id}', 'Admin@postEditCurrentEvent')->name('admin');
   Route::get('/admin/deleteevent/{id}', 'Admin@deleteCurrentEvent')->name('admin');

   Route::get('/admin/editstudio', 'Admin@EditStudios')->name('admin');
   Route::get('/admin/addstudio', 'Admin@getAddStudio')->name('admin');
   Route::post('/admin/addstudio', 'Admin@postAddStudio')->name('admin');
   Route::get('/admin/editstudio/{shortname}', 'Admin@getEditCurrentStudio')->name('admin');
   Route::post('/admin/editstudio/{shortname}', 'Admin@postEditCurrentStudio')->name('admin');

   Route::get('/profile', 'Profile@index')->name('profile');
   Route::get('/profile/edit', 'Profile@edit')->name('profile');
   Route::post('/profile/edit', 'Profile@postEdit')->name('profile');
   Route::post('/profile', 'Profile@postTimetable')->name('profile');
   Route::post('/profile/timetableupdate', 'Profile@updateTimetable')->name('profile');

   Route::get('/admin/addmassmedia', 'Admin@getAddMassMedia')->name('admin');
   Route::post('/admin/addmassmedia', 'Admin@postAddMassMedia')->name('admin');
   Route::get('/admin/editmassmedia/{id}', 'Admin@getEditMassMedia')->name('admin');
   Route::post('/admin/editmassmedia/{id}', 'Admin@postEditMassMedia')->name('admin');

   Route::get('/downloadExcel/{type}', 'Profile@downloadExcel');
   Route::get('/downloadExcel/xls/{id}', 'Profile@downloadExcelId');

   Route::get('/admin/deletephoto/{id}/{name}', 'Admin@deletePhoto')->name('admin');
   Route::get('/admin/deleteStudioPhoto/{shortname}/{name}', 'Admin@deleteStudioPhoto')->name('admin');

   // Журнал «»Васька»
   Route::get('/journalpages/{name}', 'JournalPages@getPage');
   Route::get('/articleslist/{name}', 'JournalArticles@getList');
   Route::get('/article/{id}', 'JournalArticles@getArticle');
