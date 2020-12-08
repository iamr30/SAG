<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use function foo\func;

Route::get('/', function () {
    return view('index');
});


Route::group(['prefix' => 'admin'], function () {
    //Voyager::routes();

    //    Route::get('/instructors','InstrutorController@index')->name('instructors.index');
   Route::get('/instructors/all','InstructorController@showAll')->name('instructors.showAll');
   Route::get('/instructors/editar/{id}','InstructorController@edit')->name('instructors.edit');
   Route::get('/instructors/schedules/{id}','InstructorController@showShedules')->name('instructors.showSchedules');
    //    Route::get('/instructors/{id}','InstructorController@show')->name('instructors.details');
    Route::get('/instructors/create','InstructorController@create')->name('instructors.create');
    Route::apiResource('instructors', 'InstructorController');

    Auth::routes();
});

//Route::get('/linkstorage', function () {}
//Run rm public/storage and php artisan storage:link for get access to storage
Route::group(['prefix' => 'root'], function () {
    Voyager::routes();
});
