<?php

use App\User;

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */




Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'events'], function () {
    Route::get('/', "EventController@index");
    Route::get('/new', "EventController@create");
    Route::post('/new', "EventController@store");

    Route::get('/{id}', "EventController@show")->where('id', '[0-9]+');
    Route::get('/{id}/edit', 'EventController@edit')->where('id', '[0-9]+');
    Route::put('/{id}', 'EventController@update')->where('id', '[0-9]+');
    Route::delete('/{id}', 'EventController@destroy')->where('id', '[0-9]+');
});

Route::group(['prefix' => '/events/{id}/occurrences'], function () {
    Route::get('/{occId}', "EventOccurrenceController@show")->where('occId', '[0-9]+');
    Route::get('/{occId}/edit', "EventOccurrenceController@edit")->where('occId', '[0-9]+');

    Route::put('/{occId}', 'EventOccurrenceController@update')->where('occId', '[0-9]+');

    Route::get('/{occId}/activities', 'OccurrenceActivityController@index')->where('occId', '[0-9]+');
    Route::post('/{occId}/activities', 'OccurrenceActivityController@add')->where('occId', '[0-9]+');
    Route::delete('/{occId}/activities', 'OccurrenceActivityController@remove')->where('occId', '[0-9]+');
    
    Route::post('/{occId}', 'UserActivityController@addMany');
});

 Route::get('/event-occurrences',"EventOccurrenceController@index");

Route::post('/login', function() {
    $user = User::where('username', 'admin')->first();
    Auth::login($user);
    return Redirect::to('/groups');
});

Route::post('/logout', function() {
    Auth::logout();
    return Redirect::to('/groups');
});



Route::group(['prefix' => 'users'], function () {
    Route::get('/{id}/activities', 'UserActivityController@index')->where('id', '[0-9]+');
    Route::post('/{id}/activities', 'UserActivityController@add')->where('id', '[0-9]+');
    Route::delete('/{id}/activities', 'UserActivityController@remove')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'groups'], function () {
    Route::get('/', "GroupController@index");
    Route::get('/new', "GroupController@create");
    Route::post('/new', "GroupController@store");

    Route::get('/{id}', "GroupController@show")->where('id', '[0-9]+');
    Route::get('/{id}/edit', 'GroupController@edit')->where('id', '[0-9]+');
    Route::put('/{id}', 'GroupController@update')->where('id', '[0-9]+');
    Route::delete('/{id}', 'GroupController@destroy')->where('id', '[0-9]+');

    Route::get('/{id}/users', 'GroupUserController@index')->where('id', '[0-9]+');
    Route::post('/{id}/users', 'GroupUserController@add')->where('id', '[0-9]+');
    Route::delete('/{id}/users', 'GroupUserController@remove')->where('id', '[0-9]+');

    Route::get('/{id}/newEvent', 'EventController@createForGroup')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'activities'], function () {
    Route::get('/', "ActivityController@index");
    Route::get('/new', "ActivityController@create");

    Route::post('/sync', "ActivityController@sync");
});

Route::group(['prefix' => 'api/dev'], function () {
    Route::resource('events', 'EventRestController', ['only' => ['index', 'show']]);
});
