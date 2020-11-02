<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('/question', 'QuestionController');  
Route::apiResource('/category', 'CategoryController');  
Route::apiResource('/question/{question}/reply', 'ReplyController');

Route::post('/like/{reply}', 'LikeController@likeIt')->name('like');
Route::delete('/like/{reply}', 'LikeController@unLikeIt')->name('unlike');

Route::post('notifications', 'NotificationController@index');
Route::post('markAsRead', 'NotificationController@markAsRead');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login')->name('login');
    Route::post('signup', 'AuthController@signup')->name('signup');
    Route::post('logout', 'AuthController@logout')->name('logout');
    Route::post('refresh', 'AuthController@refresh')->name('refresh');
    Route::post('me', 'AuthController@me')->name('me');

});