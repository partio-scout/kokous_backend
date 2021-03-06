<?php

use App\User;
use App\Activity;

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

Route::group(['prefix' => 'dev'], function() {
    Route::post('/login', 'DevLoginController@login');
    Route::post('logout', 'DevLoginController@logout');
});

Route::group(['prefix' => 'api/dev'], function () {
    Route::resource('group', 'GroupRestController', ['only' => ['index', 'show']]);
    Route::resource('events', 'EventRestController', ['only' => ['index', 'show', 'store']]);
    Route::resource('activities', 'ActivityRestController', ['only' => ['index', 'show']]);
    Route::get('userActivities', 'ActivityRestController@userActivities');
});

 Route::get('/share/{userId}/{id}', "UserActivityController@show");

Route::group(['middleware' => 'auth'], function() {

    Route::group(['prefix' => 'events'], function () {
        Route::get('/', "EventController@index");

        Route::post('/new', "EventController@store");
        Route::post('/new2', "EventController@storeNoRedirect");
        Route::get('/{id}', "EventController@show")->where('id', '[0-9]+');
        Route::get('/{id}/edit', 'EventController@edit')->where('id', '[0-9]+');
        Route::put('/{id}', 'EventController@update')->where('id', '[0-9]+');
        Route::delete('/{id}', 'EventController@destroy')->where('id', '[0-9]+');

        Route::group(['middleware' => 'admin'], function() {
            Route::get('/new', "EventController@create");
        });
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

    Route::get('/event-occurrences', "EventOccurrenceController@index");



    Route::group(['prefix' => 'users'], function () {
        Route::get('/{id}/activities', 'UserActivityController@index')->where('id', '[0-9]+');
        Route::post('/{id}/activities', 'UserActivityController@add')->where('id', '[0-9]+');
        Route::delete('/{id}/activities', 'UserActivityController@remove')->where('id', '[0-9]+');
        
    });

    Route::group(['prefix' => 'groups'], function () {
        Route::get('/', "GroupController@index");
        Route::get('/{id}', "GroupController@show")->where('id', '[0-9]+');
        Route::get('/{id}/users', 'GroupUserController@index')->where('id', '[0-9]+');
        Route::get('/{id}/newEvent', 'EventController@createForGroup')->where('id', '[0-9]+');
        Route::post('/{id}/users', 'GroupUserController@add')->where('id', '[0-9]+');
        Route::delete('/{id}/users', 'GroupUserController@remove')->where('id', '[0-9]+');

        Route::group(['middleware' => 'admin'], function() {
            Route::get('/new', "GroupController@create");
            Route::post('/new', "GroupController@store");
            Route::get('/{id}/edit', 'GroupController@edit')->where('id', '[0-9]+');
            Route::put('/{id}', 'GroupController@update')->where('id', '[0-9]+');
            Route::delete('/{id}', 'GroupController@destroy')->where('id', '[0-9]+');
        });
    });
    Route::group(['prefix' => 'activities'], function () {
        Route::get('/', "ActivityController@index");
        Route::get('/new', "ActivityController@create");
        Route::get('/{id}', "ActivityController@show")->where('id', '[0-9]+');
        Route::post('/sync', ['uses' => "ActivityController@sync", 'middleware' => "admin"]);
    });

    Route::group(['prefix' => 'event_patterns', 'middleware' => 'admin'], function () {
        Route::get('/new', "EventPatternController@create");
        Route::get('/', "EventPatternController@index");
        Route::post('/new', "EventPatternController@store");
    });


    Route::group(['prefix' => '/activities/{id}'], function () {
        Route::post('/newComment', "CommentController@storeActComment");
    });

    Route::group(['prefix' => '/events/{id}/occurrences/{occId}'], function () {
        Route::post('/newComment', "CommentController@storeOccComment");
    });

    Route::delete('/comment', "CommentController@destroy");

    Route::group(['prefix' => 'admin'], function () {
        Route::post('/login', 'AdminController@login');
        Route::post('/logout', 'AdminController@logout');
    });

    Route::group(['prefix' => 'activity_planning'], function () {
        Route::get('/activities', 'ActivityPlanningController@showActivitySelectView');
        Route::get('/events', 'ActivityPlanningController@showEventSelectView');
        Route::get('/planner', 'ActivityPlanningController@showActivityEventPlannerView');
        Route::post('/activities', 'ActivityPlanningController@selectActivities');
        Route::post('/events', 'ActivityPlanningController@selectEvents');
        Route::post('/planner', 'ActivityPlanningController@handleActivityPlan');
    });
});
