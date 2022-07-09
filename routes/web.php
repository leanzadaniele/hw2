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


/* Rotta principale */
Route::get('/', function(){
    return redirect()->route('login');
})->middleware('auth');

/* Rotte Registrazione */
Route::get('/signup', 'App\Http\Controllers\SignupController@showSignup')->name('registration');
Route::post('/signup/save', 'App\Http\Controllers\SignupController@saveRegistration')->name('registration_save');

/* Rotte Login */
Route::get('/login', 'App\Http\Controllers\LoginController@showLogin')->name('login');
Route::post('/login/controllaLogin', 'App\Http\Controllers\LoginController@controllaLogin')->name('controllaLogin');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');

/* Rotta Home */
Route::get('/home', 'App\Http\Controllers\HomeController@showHome')->name('home');

/* Route Profile */
Route::get('/profile', 'App\Http\Controllers\ProfileController@showProfile')->name('profile');

/* Route postFetch.js */
Route::get('/postFetch', 'App\Http\Controllers\PostFetchController@getPosts')->name('postFetch');
Route::get('/isLiked', 'App\Http\Controllers\PostFetchController@isLiked')->name('isLiked');
Route::get('/getComments/{id}', 'App\Http\Controllers\PostFetchController@getComments')->name('getComments');
Route::get('/getLikes/{id}', 'App\Http\Controllers\PostFetchController@getLikes')->name('getLikes');
Route::get('/setLike/{post_id}/{user_id}', 'App\Http\Controllers\PostFetchController@setLike')->name('setLike');
Route::get('/getMyComments', 'App\Http\Controllers\PostFetchController@getMyComments')->name('getMyComments');
Route::get('/deleteMyComment/{post_id}', 'App\Http\Controllers\PostFetchController@deleteMyComment')->name('deleteMyComment');
Route::get('/phpProfilePicture/{q}', 'App\Http\Controllers\PostFetchController@phpProfilePicture')->name('phpProfilePicture');
Route::get('/changeProfilePicture/{id}', 'App\Http\Controllers\PostFetchController@changeProfilePicture')->name('changeProfilePicture');
Route::get('/deleteMe', 'App\Http\Controllers\PostFetchController@deleteMe')->name('deleteMe');
Route::get('/myPosts', 'App\Http\Controllers\PostFetchController@myPosts')->name('myPosts');
Route::get('/deletePost/{post_id}', 'App\Http\Controllers\PostFetchController@deletePost')->name('deletePost');
Route::get('/new_post', 'App\Http\Controllers\PostController@showNewPost')->name('new_post');
Route::post('/save_post', 'App\Http\Controllers\PostController@savePost')->name('save_post');
Route::get('/admin_home', 'App\Http\Controllers\AdminHomeController@showHome')->name('admin_home');
Route::post('/saveNewAdmin', 'App\Http\Controllers\AdminHomeController@saveAdmin')->name('save_new_admin');
Route::get('/removeAdmin', 'App\Http\Controllers\AdminHomeController@removeAdmin')->name('remove_admin');
Route::get('/comment/{com}/{user_id}/{post_id}', 'App\Http\Controllers\PostFetchController@comment')->name('comment');
/* For Testing */
Route::get('/test', 'App\Http\Controllers\PostFetchController@test')->name('test');
/* Restituisce l'utente loggato */
Route::get('/getUserLogged', 'App\Http\Controllers\PostFetchController@getUserLogged')->name('getUserLogged');