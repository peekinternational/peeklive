<?php

use Illuminate\Support\Facades\Route;

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

// Route::post('/send-message', 'ChatController@send');
// Route::post('singleChat','ChatController@singleChat');
// Route::get('/', function () {
//     return view('chat');
// });
Route::get('/chat-history', function () {
    return view('chat-history');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('usersList/{id}','DemoChatController@usersList');
Route::post('send-message-chat', 'DemoChatController@sendMessage');
Route::post('add-friend','DemoChatController@addFriends');
Route::post('single-chat','DemoChatController@single_chat');
Route::get('/', 'DemoChatController@index');
Route::get('allChats','DemoChatController@allChats');
Route::post('singleChatAll','DemoChatController@singleChatAll');
Route::post('deleteUserChat','DemoChatController@deleteChat');
Route::post('deleteAllChats','DemoChatController@deleteAll');

Route::post('updateMessage','DemoChatController@updateMessage');
Route::get('deleteMsg/{id}','DemoChatController@deleteMessage');
Route::post('starChat','DemoChatController@starChat');
Route::post('unstarChat','DemoChatController@unstarChat');
Route::post('archiveChat','DemoChatController@archiveChat');
Route::post('unArchiveChat','DemoChatController@unArchiveChat');
Route::post('deleteConv','DemoChatController@deleteConv');
Route::post('unreadConv','DemoChatController@unreadConv');
Route::post('readChat','DemoChatController@readChat');

// Chat Filters
Route::post('getArchiveChats','DemoChatController@getArchiveChats');
Route::post('getStarChats','DemoChatController@getStarChats');
Route::post('getUnreadChats','DemoChatController@getUnreadChats');

Route::post('fileShare','DemoChatController@fileSend');

Route::get('logout','DemoChatController@logout')->name('logout');
