<?php

use Illuminate\Support\Facades\Route;
Route::get('/','HomeController@HomeIndex');
Route::post('/contactSend','HomeController@ContactSend');




Route::get('/Course','CoursesController@CoursePage');
Route::get('/Policy','PolicyConroller@PolicyPage');
Route::get('/Project','ProjectsController@ProjectPage');
Route::get('/Contact','ContactController@ContactPage');
Route::get('/Terms','TermsController@TermsPage');
