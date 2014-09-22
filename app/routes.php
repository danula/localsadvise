<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//set the index route 
Route::get('/','HomeController@getIndex');

//set the routes for the login
Route::get('login', 'UserController@viewLogin');
Route::post('login','UserController@login');

//set the route for the register
Route::post('register','UserController@register');

//set the route for logout
Route::get('logout','UserController@logout');

//set the route for adding questions
Route::post('question/add','QuestionsController@add');
Route::get('question/add','QuestionsController@add');

//set the route for adding answers
Route::post('answer/add','AnswersController@add');

//set the route for the page to add questions
Route::get('map/add', 'MapController@getAdd');

//set the route for the page to answer questions
Route::get('map/{defaultLocation?}', 'MapController@getIndex');

Route::get('test','MapController@findCloseLocations');