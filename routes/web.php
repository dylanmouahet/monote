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


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/project', 'ProjectsController');
Route::post('/project/add-step', 'ProjectsController@addStep')->name('project.step.store');
Route::put('/project/edit-step/{id}', 'ProjectsController@updateStep')->name('project.step.update');
Route::delete('/project/delete-step/{id}', 'ProjectsController@deleteStep')->name('project.step.delete');

Route::resource('/learning', 'LearningsController');
Route::post('/learning/add-chapter', 'LearningsController@addChapter')->name('learning.chapter.store');
Route::put('/learning/edit-chapter/{id}', 'LearningsController@updateChapter')->name('learning.chapter.update');
Route::delete('/learning/delete-chapter/{id}', 'LearningsController@deleteChapter')->name('learning.chapter.delete');

Route::resource('/expertise', 'ExpertisesController')->except(['show', 'create', 'edit']);
//Route::resource('/skill', 'SkillsController');

Route::get('/notification', 'NotificationController@index')->name('notification');
Route::delete('/notification/{id}', 'NotificationController@destroy')->name('notification.destroy');
Route::get('/notification/delete', 'NotificationController@destroyAll')->name('notification.destroy.all');


Route::get('/profil', 'UserController@index')->name('profil');
Route::get('/profil/edit', 'UserController@edit')->name('profil.edit');
Route::post('/profil/edit', 'UserController@update')->name('profil.update');


Route::get('/setting', 'SettingController@index')->name('setting');
Route::post('/setting/change-password', 'SettingController@changePassword')->name('setting.changePassword');
Route::delete('/setting/delete-account', 'SettingController@deleteAccount')->name('setting.deleteAccount');
Route::put('/setting/update-preference', 'SettingController@updatePreference')->name('setting.updatePreference');

Route::post('/contact', 'ContactController@send')->name('contact');
