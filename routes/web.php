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

Route::get('/', 'UsersController@index');

Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');


Route::resource('users', 'UsersController', ['only' => ['show']]);

Route::group(['prefix' => 'users/{id}'], function () {
    Route::get('followings', 'UsersController@followings')->name('followings');
    Route::get('followers', 'UsersController@followers')->name('followers');
    });

Route::group(['middleware' => 'auth'], function () {
    Route::put('users', 'UsersController@rename')->name('rename');
    // チャンネル名・ユーザ名を変更する「rename」というルーティング
    
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('unfollow');
    });
    
    Route::resource('movies', 'MoviesController', ['only' => ['create', 'store', 'destroy']]);
}); // ここでは、Route::groupでルーティングのグループを作成して、その時に['middleware' => 'auth']として、ログイン認証を通ったユーザのみが、その内部のルーティングにアクセスできるようにしています。

// Route::resource()で、７つのルーティングの短縮形となるが、
// あえて['only' => ['create', 'store', 'destroy']]と記述して、実際にルートとして設定するアクションを限定している。