<?php

use Illuminate\Http\Request;
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
Route::post('/send-message', 'ChatController@send');
Route::post('friends','ChatController@friends');
Route::get('friendsList/{id}','ChatController@friendsList');
Route::post('singleChat','ChatController@singleChat');
Route::get('messsageCount','ChatController@messsageCount');
Route::post('seenMessage','ChatController@seenMessage');
Route::get('allChats','ChatController@allChats');
Route::post('singleChatAll','ChatController@singleChatAll');
Route::post('deleteUserChat','ChatController@deleteChat');
Route::post('deleteAllChats','ChatController@deleteAll');

Route::post('updateMessage','ChatController@updateMessage');
Route::get('deleteMsg/{id}','ChatController@deleteMessage');
Route::post('starChat','ChatController@starChat');
Route::post('unstarChat','ChatController@unstarChat');
Route::post('archiveChat','ChatController@archiveChat');
Route::post('unArchiveChat','ChatController@unArchiveChat');
Route::post('deleteConv','ChatController@deleteConv');
Route::post('unreadConv','ChatController@unreadConv');
Route::post('readChat','ChatController@readChat');

// Chat Filters
Route::post('getArchiveChats','ChatController@getArchiveChats');
Route::post('getStarChats','ChatController@getStarChats');
Route::post('getUnreadChats','ChatController@getUnreadChats');

Route::post('fileShare','ChatController@fileSend');
Route::post('fileShares','DemoChatController@fileSend');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
