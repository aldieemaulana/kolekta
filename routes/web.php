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

Route::get('/', function () {return redirect('/user/sign-in');});

Route::get('/survey/create', function () {
    $builders = ["Multiple Choice", "Checkboxes", "Dropdown", "Star Rating", "Matrix / Rating Scale", "File Upload", "Rangking", "Image Choice", "Slider", "Single Textbox", "Multiple Textboxes", "Comment Box", "Date / Time", "Text", "Image"];
    $options = ["Required Asterisks", "Question Numbers", "Logo", "Quiz", "One Question at a Time", "Survey Title", "Footer"];
    return view('templates.admin.pages.survey.create', compact('builders', 'options'));
});

Route::get('/user/sign-in', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/user/sign-in/do', 'Auth\LoginController@login')->name('login');
Route::get('/user/sign-up', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/user/sign-up/do', 'Auth\RegisterController@register')->name('register');
Route::get('/user/sign-out/do', 'Auth\LoginController@logout')->name('logout');

Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/user/account', 'UserController@index')->name('user.account');
Route::get('/user/account/detail/edit', 'UserController@detailEdit')->name('user.account.login.edit');
Route::patch('/user/account/detail/edit', 'UserController@detailEditStore')->name('user.account.login.edit.store');

Route::get('/survey', 'SurveyController@index')->name('survey.index');
Route::post('/survey/create/store', 'SurveyController@store')->name('survey.store');
Route::get('/survey/{id}/edit', 'SurveyController@edit')->name('survey.edit');

Route::get('/request-service', 'RequestServiceController@index')->name('request-service.index');
Route::get('/request-service/create', 'RequestServiceController@create')->name('request-service.create');
Route::post('/request-service/store', 'RequestServiceController@store');

Route::get('/consultant', 'ConsultantController@index')->name('consultant.index');