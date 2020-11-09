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

Route::apiResource('/question', 'API\QuestionController');  
Route::apiResource('/tag', 'API\TagController');  
Route::apiResource('/question/{question}/reply', 'API\ReplyController');

Route::post('/like/{reply}', 'API\LikeController@likeIt')->name('like');
Route::delete('/like/{reply}', 'API\LikeController@unLikeIt')->name('unlike');

Route::post('user/{id}', 'API\UserController@show');

Route::post('notifications', 'API\NotificationController@index');
Route::post('markAsRead', 'API\NotificationController@markAsRead');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'API\AuthController@login')->name('login');
    Route::post('signup', 'API\AuthController@signup')->name('signup');
    Route::post('logout', 'API\AuthController@logout')->name('logout');
    Route::post('refresh', 'API\AuthController@refresh')->name('refresh');
    Route::post('me', 'API\AuthController@me')->name('me');

});