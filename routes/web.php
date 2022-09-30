<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DropdownController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Providers\RouteServiceProvider;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\MarketingAttController;
use App\Http\Controllers\DateTimeController;
use APp\Http\Controllers\AttendanceReportController;

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
Route::get('phpmyinfo', function () {
    phpinfo(); 
})->name('phpmyinfo');

Route::get('/symbolic-link', function () {
    Artisan::call('storage:link');
});

//clear cache
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});

Route::fallback(function() {
    return view('errors.404');
});

Route::get('/login','App\Http\Controllers\LoginController@formlogin')->name('login')->middleware('guest');
Route::post('/login','App\Http\Controllers\LoginController@actionLogin')->name('action.login');

Route::group(['middleware'=>'auth'], function() {
    Route::get('/','App\Http\Controllers\DashboardController@index')->name('dashboard.index');
    Route::get('/logout','App\Http\Controllers\DashboardController@logout')->name('logout');
    
    Route::get('/users','App\Http\Controllers\UserController@index')->name('dashboard.users.index');
    Route::post('/users/create','App\Http\Controllers\UserController@store')->name('dashboard.users.create');
    Route::post('/users/edit','App\Http\Controllers\UserController@edit')->name('dashboard.users.edit');
    Route::post('/users/update','App\Http\Controllers\UserController@update')->name('dashboard.users.update');
    Route::post('/users/delete','App\Http\Controllers\UserController@destroy')->name('dashboard.users.delete');
    Route::post('users/editpassword','App\Http\Controllers\UserController@editPassword')->name('dashboard.users.editpassword');
    Route::post('/users/updatepassword','App\Http\Controllers\UserController@updatePassword')->name('dashboard.users.updatepassword');
    Route::post('/users/upload', 'App\Http\Controllers\UserController@uploadUsers')->name('dashboard.users.upload');

    // Route::get('dropdown', [DropdownController::class, 'index']);
    Route::post('api/fetch-useroutlet',[DropdownController::class, 'fetchUserOutlet']);

    Route::get('/jabatan','App\Http\Controllers\JabatanController@index')->name('jabatan.index');
    Route::post('/jabatan/create','App\Http\Controllers\JabatanController@store')->name('jabatan.create');
    Route::post('/jabatan/edit','App\Http\Controllers\JabatanController@edit')->name('jabatan.edit');
    Route::post('/jabatan/update','App\Http\Controllers\JabatanController@update')->name('jabatan.update');
    Route::post('/jabatan/delete','App\Http\Controllers\JabatanController@destroy')->name('jabatan.delete');

   Route::get('/kpi','App\Http\Controllers\KpiController@create')->name('kpi.postkpi'); 

});

