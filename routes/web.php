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

    Route::get('/authuser','UserController@userAuth')->name('users.auth');
    Route::get('/users','UserController@index')->name('users.index');
    Route::get('/users/all','UserController@showAll')->name('users.showAll');
    Route::get('/users/editar/{id}','UserController@edit')->name('users.edit');
    Route::apiResource('users', 'UserController');
    Route::get('/dashboard','DashBoardController@index')->name('dashboard.index');
    Route::resource('/dashboard', 'DashBoardController');

    Route::get('/usuarioscdu/agregar/','UsersCduController@create')->name('usuario.create');
    Route::get('/usuarioscdu/{id}','UsersCduController@show')->name('usuario.details');
    Route::get('/usuarioscdu/editar/{id}','UsersCduController@edit')->name('usuario.edit');
    Route::resource('/usuarioscdu','UsersCduController');
    Route::get('/dashboard','DashBoardController@index')->name('dashboard.index');
    Route::resource('/dashboard', 'DashBoardController');

    //    Route::get('/instructors','InstrutorController@index')->name('instructors.index');
    Route::get('/instructors/all','InstructorController@showAll')->name('instructors.showAll');
    Route::get('/instructors/editar/{id}','InstructorController@edit')->name('instructors.edit');
    Route::get('/instructors/schedules/{id}','InstructorController@showShedules')->name('instructors.showSchedules');
    //    Route::get('/instructors/{id}','InstructorController@show')->name('instructors.details');
    Route::get('/instructors/create','InstructorController@create')->name('instructors.create');
    Route::apiResource('instructors', 'InstructorController');

    Route::get('/areas/agregar/','AreaController@create')->name('area.create');
    Route::get('/areas/{id}','AreaController@show')->name('area.details');
    Route::get('/areas/editar/{id}','AreaController@edit')->name('area.edit');
    Route::resource('/areas','AreaController');

    Route::get('/disciplinas/agregar/','DisciplineController@create')->name('disciplinas.create');
    Route::get('/disciplinas/{id}','DisciplineController@show')->name('disciplinas.details');
    Route::get('/disciplinas/editar/{id}','DisciplineController@edit')->name('disciplinas.edit');
    Route::resource('/disciplinas','DisciplineController');

    Route::get('/niveles/agregar/','LevelController@create')->name('levels.create');
    Route::get('/niveles/{id}','LevelController@show')->name('levels.details');
    Route::get('/niveles/editar/{id}','LevelController@edit')->name('levels.edit');
    Route::apiResource('/niveles','LevelController');

    Route::get('/cursos/agregar/','CourseController@create')->name('courses.create');
    Route::get('/cursos/{id}','CourseController@show')->name('courses.details');
    Route::get('/cursos/editar/{id}','CourseController@edit')->name('courses.edit');
    Route::apiResource('/cursos','CourseController');

    Route::get('/horarios/agregar/','ScheduleController@create')->name('schedules.create');
    Route::get('/horarios/{id}','ScheduleController@show')->name('schedules.details');
    Route::get('/horarios/editar/{id}','ScheduleController@edit')->name('schedules.edit');
    Route::apiResource('/horarios','ScheduleController');

    Route::get('/roles','RoleController@index')->name('roles.index');
    Route::get('/roles/all','RoleController@showAll')->name('roles.showAll');
    Route::get('/roles/editar/{id}','UserController@update')->name('roles.update');
    Route::apiResource('roles', 'RoleController');

    Route::get('/','AdminController@index')->name('dashboard');

    Route::resource('/asignar','AssignedSchedulesController');
    Route::post('/asignar/{id}','AssignedSchedulesController@store')->name('asignar.store');;
    Route::resource('/tarjetas','CardController');
    Auth::routes();

    Auth::routes();
});

//Route::get('/linkstorage', function () {}
//Run rm public/storage and php artisan storage:link for get access to storage
Route::group(['prefix' => 'root'], function () {
    Voyager::routes();
});
