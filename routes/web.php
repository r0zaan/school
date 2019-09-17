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


Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'FrontendController@indexPage');
    Route::get('/products', 'FrontendController@productsPage');
    Route::get('/product/{slug}', 'FrontendController@singleProduct');
});

Route::get('/admin', 'AuthsController@showLoginPage');
Route::view('/home', 'backend.home')->name('home');
Route::post('/admin', 'AuthsController@login')->name('login');
Route::post('/logout', 'AuthsController@logout');

Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'middleware' => 'admin'], function () {

    Route::resource('/brands', 'BrandController');
    Route::resource('/groups', 'GroupController');
    Route::resource('/products', 'ProductController');
    Route::delete('/products/image/{id}', 'ProductController@destroyColorImage')->name('products.colorImageDestroy');

    //studentManagement
    Route::resource('/classrooms', 'ClassroomController');

    Route::resource('/sections', 'SectionController');

    Route::resource('/sessions', 'SessionController');

    Route::resource('/studentCategories', 'StudentCategoryController');

    Route::resource('/subjects', 'SubjectController');

    Route::resource('/periods', 'PeriodController');
    Route::get('/periods/sections/{classroom}', 'PeriodController@getSections');

    Route::resource('/students', 'StudentController');
    Route::get('/students/changeStatus/{student}', 'StudentController@changeStatus');

    Route::get('/classPromotion', 'ClassPromotionController@index')->name('classPromotion.index');
    Route::post('/classPromotion', 'ClassPromotionController@store');
    Route::get('/classPromotion/students/{section}', 'ClassPromotionController@getStudents');

    Route::get('/studentStrength', 'StudentStrengthController@index')->name('studentStrength.index');
    Route::get('/studentInactive', 'StudentInactiveController@index')->name('studentInactive.index');

//    Attendance
    Route::get('/attendance/show', 'AttendanceController@index')->name('attendance.index');
    Route::post('/attendance/entry', 'AttendanceController@store')->name('attendance.store');

//    Attendance Report
    Route::get('/attendance/report', 'AttendanceController@reportIndex')->name('attendance.reportIndex');


    //HRMS

    //Department
    Route::resource('/departments', 'DepartmentController');

    Route::resource('/designations', 'DesignationController');

});
