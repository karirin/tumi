<?php

use App\Http\Middleware\HelloMiddleware;
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

Route::post('upload', 'ImageController@upload');
Route::get('image', 'ImageController@index');

Route::get('/', 'TopController@index');
Route::get('privacy_poricy', 'TopController@privacy_poricy');
Route::get('terms_of_service', 'TopController@terms_of_service');
Route::get('join', 'JoinController@index');
Route::get('tmpRegist', 'TmpRegistController@index');

Route::get('chart', 'UserController@chart');

Route::get('markdown', 'TumiController@index');

Route::get('tumi/tumi', 'TumiController@disp');
Route::post('tumi/add', 'TumiController@add');
Route::get('tumi/add', 'TumiController@add');
Route::post('/ajax_edit_tittle', 'TumiController@ajax_edit_tittle');
Route::post('/ajax_edit_text', 'TumiController@ajax_edit_text');
Route::post('/ajax_edit_done', 'TumiController@ajax_edit_done');
Route::post('goal/add', 'GoalController@add');

Route::get('user/login', 'UserController@login');

Route::post('user/login', 'UserController@auth');
Route::get('user/auth2', 'UserController@auth2');
Route::post('user/test_login', 'UserController@test_login');
Route::get('user/add', 'UserController@add');
Route::post('user/edit', 'UserController@edit');
Route::get('user/profile', 'UserController@profile');

Route::post('user/add', 'UserController@create');

Route::post('user/edit_detail', 'UserController@edit_detail');

Route::get('user/logout', 'UserController@logout')->name('logout');

Route::get('user/skip', 'UserController@skip');

Route::get('user/register', 'UserController@register');

Route::get('user/add_match', 'UserController@add_match');

Route::get('match/match', 'MatchController@index');

Route::get('message/message', 'MessageController@index');
Route::get('message/add', 'MessageController@index');
Route::post('message/add', 'MessageController@add');

Route::get('message/message_top', 'Message_relationController@index');

Route::post('/ajax_message_process', 'MessageController@ajax_message_process');

Route::post('/ajax_match_process', 'MatchController@ajax_match_process');

Route::post('/ajax_flg', 'UserController@ajax_flg');

Route::post('/ajax_m_flg', 'UserController@ajax_m_flg');

Route::post('/ajax_unmatch_process', 'MatchController@ajax_unmatch_process');

Route::prefix('auth')->group(function () {
    Route::get('twitter', 'AuthController@login');
    Route::get('twitter/callback', 'AuthController@callback');
});
