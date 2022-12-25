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
    Route::get('/user/create','App\Http\Controllers\UserController@create')->name('dashboard.user.create');
    Route::post('/users/create','App\Http\Controllers\UserController@store')->name('dashboard.users.create');
    Route::get('/user/show/{id}','App\Http\Controllers\UserController@show')->name('dashboard.user.show');
    Route::post('/users/edit','App\Http\Controllers\UserController@edit')->name('dashboard.users.edit');
    Route::post('/users/update','App\Http\Controllers\UserController@update')->name('dashboard.users.update');
    Route::post('/users/delete','App\Http\Controllers\UserController@destroy')->name('dashboard.users.delete');
    Route::post('users/editpassword','App\Http\Controllers\UserController@editPassword')->name('dashboard.users.editpassword');
    Route::post('/users/updatepassword','App\Http\Controllers\UserController@updatePassword')->name('dashboard.users.updatepassword');
    Route::post('/users/upload', 'App\Http\Controllers\UserController@uploadUsers')->name('dashboard.users.upload');

    // Route::get('dropdown', [DropdownController::class, 'index']);
    Route::post('api/fetch-cities',[DropdownController::class, 'fetchCities']);

    Route::get('/jabatan','App\Http\Controllers\JabatanController@index')->name('Jabatan.index');
    Route::post('/jabatan/create','App\Http\Controllers\JabatanController@store')->name('Jabatan.create');
    Route::post('/jabatan/edit','App\Http\Controllers\JabatanController@edit')->name('Jabatan.edit');
    Route::post('/jabatan/update','App\Http\Controllers\JabatanController@update')->name('Jabatan.update');
    Route::post('/jabatan/delete','App\Http\Controllers\JabatanController@destroy')->name('Jabatan.delete');

   Route::get('/kpi','App\Http\Controllers\KpiController@create')->name('kpi.postkpi'); 
   
   Route::get('/bobot','App\Http\Controllers\BobotController@index')->name('bobot.index');
    Route::post('/bobot/create','App\Http\Controllers\BobotController@store')->name('bobot.create');
    Route::post('/bobot/edit','App\Http\Controllers\BobotController@edit')->name('bobot.edit');
    Route::post('/bobot/update','App\Http\Controllers\BobotController@update')->name('bobot.update');
    Route::post('/bobot/delete','App\Http\Controllers\BobotController@destroy')->name('bobot.delete');

    Route::get('/kategori','App\Http\Controllers\KatPertanyaanController@index')->name('kategori.index');
    Route::post('/kategori/create','App\Http\Controllers\KatPertanyaanController@store')->name('kategori.create');
    Route::post('/kategori/edit','App\Http\Controllers\KatPertanyaanController@edit')->name('kategori.edit');
    Route::post('/kategori/update','App\Http\Controllers\KatPertanyaanController@update')->name('kategori.update');
    Route::post('/kategori/delete','App\Http\Controllers\KatPertanyaanController@destroy')->name('kategori.delete');

    Route::get('/department','App\Http\Controllers\DepartmentController@index')->name('department.index');
    Route::post('/department/create','App\Http\Controllers\DepartmentController@store')->name('department.create');
    Route::post('/department/edit','App\Http\Controllers\DepartmentController@edit')->name('department.edit');
    Route::post('/department/update','App\Http\Controllers\DepartmentController@update')->name('department.update');
    Route::post('/department/delete','App\Http\Controllers\DepartmentController@destroy')->name('department.delete');

    Route::get('/division','App\Http\Controllers\DivisionController@index')->name('division.index');
    Route::post('/division/create','App\Http\Controllers\DivisionController@store')->name('division.create');
    Route::post('/division/edit','App\Http\Controllers\DivisionController@edit')->name('division.edit');
    Route::post('/division/update','App\Http\Controllers\DivisionController@update')->name('division.update');
    Route::post('/division/delete','App\Http\Controllers\DivisionController@destroy')->name('division.delete');

    Route::get('/indonesia_province','App\Http\Controllers\indonesia_provinceController@index')->name('indonesia_province.index');
    Route::post('/indonesia_province/create','App\Http\Controllers\indonesia_provinceController@store')->name('Indonesia_province.create');
    Route::post('/indonesia_province/edit','App\Http\Controllers\indonesia_provinceController@edit')->name('Indonesia_province.edit');
    Route::post('/indonesia_province/update','App\Http\Controllers\indonesia_provinceController@update')->name('Indonesia_province.update');
    Route::post('/indonesia_province/delete','App\Http\Controllers\indonesia_provinceController@destroy')->name('Indonesia_province.delete');
    
    Route::get('/indonesia_cities','App\Http\Controllers\indonesia_citiesController@index')->name('indonesia_cities.index');
    Route::post('/indonesia_cities/create','App\Http\Controllers\indonesia_citiesController@store')->name('indonesia_cities.create');
    Route::post('/indonesia_cities/edit','App\Http\Controllers\indonesia_citiesController@edit')->name('indonesia_cities.edit');
    Route::post('/indonesia_cities/update','App\Http\Controllers\indonesia_citiesController@update')->name('indonesia_cities.update');
    Route::post('/indonesia_cities/delete','App\Http\Controllers\indonesia_citiesController@destroy')->name('indonesia_cities.delete');

    Route::get('/indonesia_districts','App\Http\Controllers\indonesia_districtsController@index')->name('indonesia_districts.index');
    Route::post('/indonesia_districts/create','App\Http\Controllers\indonesia_districtsController@store')->name('indonesia_districts.create');
    Route::post('/indonesia_districts/edit','App\Http\Controllers\indonesia_districtsController@edit')->name('indonesia_districts.edit');
    Route::post('/indonesia_districts/update','App\Http\Controllers\indonesia_districtsController@update')->name('indonesia_districts.update');
    Route::post('/indonesia_districts/delete','App\Http\Controllers\indonesia_districtsController@destroy')->name('indonesia_districts.delete');

    Route::get('/indonesia_villages','App\Http\Controllers\indonesia_villagesController@index')->name('indonesia_villages.index');
    Route::post('/indonesia_villages/create','App\Http\Controllers\indonesia_villagesController@store')->name('indonesia_villages.create');
    Route::post('/indonesia_villages/edit','App\Http\Controllers\indonesia_villagesController@edit')->name('indonesia_villages.edit');
    Route::post('/indonesia_villages/update','App\Http\Controllers\indonesia_villagesController@update')->name('indonesia_villages.update');
    Route::post('/indonesia_villages/delete','App\Http\Controllers\indonesia_villagesController@destroy')->name('indonesia_villages.delete');

    Route::get('/level','App\Http\Controllers\LevelController@index')->name('Level.index');
    Route::post('/level/create','App\Http\Controllers\LevelController@store')->name('Level.create');
    Route::post('/level/edit','App\Http\Controllers\LevelController@edit')->name('Level.edit');
    Route::post('/level/update','App\Http\Controllers\LevelController@update')->name('Level.update');
    Route::post('/level/delete','App\Http\Controllers\LevelController@destroy')->name('Level.delete');

    Route::get('/grade_category','App\Http\Controllers\GradeCategoryController@index')->name('Grade_category.index');
    Route::post('/grade_category/create','App\Http\Controllers\GradeCategoryController@store')->name('Grade_category.create');
    Route::post('/grade_category/edit','App\Http\Controllers\GradeCategoryController@edit')->name('Grade_category.edit');
    Route::post('/grade_category/update','App\Http\Controllers\GradeCategoryController@update')->name('Grade_category.update');
    Route::post('/grade_category/delete','App\Http\Controllers\GradeCategoryController@destroy')->name('Grade_category.delete');

    Route::get('/emp_status','App\Http\Controllers\EmpStatusController@index')->name('emp_status.index');
    Route::post('/emp_status/create','App\Http\Controllers\EmpStatusController@store')->name('emp_status.create');
    Route::post('/emp_status/edit','App\Http\Controllers\EmpStatusController@edit')->name('emp_status.edit');
    Route::post('/emp_status/update','App\Http\Controllers\EmpStatusController@update')->name('emp_status.update');
    Route::post('/emp_status/delete','App\Http\Controllers\EmpStatusController@destroy')->name('emp_status.delete');

    Route::get('/terminate_reason','App\Http\Controllers\TerminateReasonController@index')->name('terminate_reason.index');
    Route::post('/terminate_reason/create','App\Http\Controllers\TerminateReasonController@store')->name('terminate_reason.create');
    Route::post('/terminate_reason/edit','App\Http\Controllers\TerminateReasonController@edit')->name('terminate_reason.edit');
    Route::post('/terminate_reason/update','App\Http\Controllers\TerminateReasonController@update')->name('terminate_reason.update');
    Route::post('/terminate_reason/delete','App\Http\Controllers\TerminateReasonController@destroy')->name('terminate_reason.delete');

});

