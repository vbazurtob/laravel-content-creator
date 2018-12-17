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

Route::get('/', function () {
    return view('main');
});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/create-entry', 'EntryController@create')->name('create-entry');
Route::post('/create-entry', 'EntryController@store')->name('create-entry');

Route::get('/user/{id}', 'UserProfileController@show')->name('user.id');


Route::get('/entry/{id}', 'EntryController@edit')->name('entry.id');
Route::post('/entry/{id}', 'EntryController@update')->name('entry.id');

//Twitter package
Route::get('twitterUserTimeLine', 'TwitterController@twitterUserTimeLine');

Route::get('/tweets/{id}', 'TwitterController@getUserRecentTweets');
Route::get('/hide-tweet/{id}', 'TwitterController@markTweetAsHidden');
Route::get('/unhide-tweet/{id}', 'TwitterController@unhideTweet');
