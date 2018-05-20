<?php

use Illuminate\Http\Request;
use Kolekta\Answer;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api', 'throttle:500,1')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'middleware' => ['requiredParameterJson']], function () {
    Route::group(['prefix' => 'question'], function () {
        Route::get('/{id}', 'Api\QuestionController@getDetail');
        Route::post('/{id}/delete', 'Api\QuestionController@removeQuestion');
        Route::post('/{id}/update', 'Api\QuestionController@updateQuestion');
        Route::post('/{id}/update/required', 'Api\QuestionController@updateQuestionRequired');
        Route::post('/{id}/update/position', 'Api\QuestionController@updateQuestionPosition');
        Route::post('/store', 'Api\QuestionController@storeDetail');
    });

    Route::group(['prefix' => 'survey'], function () {
        Route::post('/{id}/update/option/{option}', 'Api\SurveyController@updateOption');
        Route::post('/{id}/delete', 'Api\SurveyController@removeSurvey');
        Route::post('/store', 'Api\SurveyController@updateSurvey');
        Route::post('/create', 'Api\SurveyController@createSurvey');
    });

    Route::group(['prefix' => 'page'], function () {
        Route::post('/store', 'Api\PageController@store');
        Route::get('/{id}', 'Api\PageController@getDetail');
        Route::post('/{id}/update', 'Api\PageController@updateDetail');
        Route::post('/{id}/update/position', 'Api\PageController@updatePosition');
        Route::post('/{id}/delete', 'Api\PageController@removePage');
    });

    Route::group(['prefix' => 'answer'], function () {
        Route::post('/{id}/delete', 'Api\AnswerController@removeAnswer');
        Route::post('/{unique}/store', 'Api\AnswerController@storeAnswer');
        Route::post('/{id}/update', 'Api\AnswerController@updateAnswer');
        Route::post('/{id}/update/location', 'Api\AnswerController@updateAnswerLocation');
        Route::post('/{id}/update/logic', 'Api\AnswerController@updateAnswerLogic');
        Route::post('/{id}/update/logic/question', 'Api\AnswerController@updateAnswerLogicQuestion');
    });

});