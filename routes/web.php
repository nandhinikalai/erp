<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'],function(){
    Route::resource('users', 'App\Http\Controllers\UsersController');
    Route::resource('courses', 'App\Http\Controllers\CourseController');
    Route::resource('settings', 'App\Http\Controllers\SettingsController');
    Route::resource('enquiry', 'App\Http\Controllers\EnquiryController');
    Route::resource('enquiry_followup', 'App\Http\Controllers\EnquiryFollowupController');
    Route::resource('admission', 'App\Http\Controllers\AdmissionController');
    Route::resource('fees', 'App\Http\Controllers\FeesController');
    Route::get('/admission/enquiry/{search}/{value}','App\Http\Controllers\AdmissionController@enquiry')->name('admission.enquiry');
});
