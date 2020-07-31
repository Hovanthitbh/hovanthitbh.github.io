<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\TwoFA;

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
    return view('page.doashboard');
})->name('home');


Route::get('/page/register', function () {
    return view('login.register');
});
Route::get('/logout', 'HomeController@logout')->name('logout');

Route::get('verifyOTP', 'VerifyOTPController@showVerifyPage')->name('verify');
Route::post('verifyOTP', 'VerifyOTPController@verify')->name('postVerify');

Auth::routes(['verify'=>true]);
    Route::get('profile', function () {
})->middleware('verified');
Route::get('/doashboard', 'HomeController@doashboard')->name('doashboard');

Route::get('auth/facebook', 'SocialiteController@redirectToFacebook')->name('auth.facebook');
Route::get('auth/facebook/callback', 'SocialiteController@handleFacebookCallback');
Route::group(['middleware' => ['web']], function () {
    Route::get('/home', 'HomeController@doashboard');
});

