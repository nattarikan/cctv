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
    return view('auth/login');
});

Route::resource('admin/camera','CameraController');

Route::get('admin/camera/{camera_id}/Ready/','CameraController@GetReady'); //ถ้าพังเข้าอันนี้








//cctv แจ้งเสีย
Route::get('admin/camera/{camera_id}/Declare/','CameraController@GetDeclare');


//หลังจากกดส่งปัญหาที่เสีย
Route::get('admin/camera/{camera_id}/PostDeclare',[
	'uses' => 'CameraController@PostDeclare',
	'as' => 'admin.camera.declare'
]);




Route::get('admin/camera/{camera_id}/Select/','CameraController@GetSelect');

Route::get('admin/camera/{camera_id}/PostSelect',[
	'uses' => 'CameraController@PostSelect',
	'as' => 'admin.camera.select'
]);






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('admin/showall','ShowallController');

Route::get('admin/camera/{camera_id}/history',[
	'uses' => 'CameraController@history',
	'as' => 'admin.camera.history_by_id'
]);

//news
Route::resource('admin/home','NewsController');

Route::get('admin/report','CameraController@report');










//------------User------------------

Route::get('/user/home', function () {
    return view('HomeUser');
});

Route::resource('user/showall_user','ShowallUserController');

Route::get('user/camera/{camera_id}/declare_user/','ShowallUserController@GetDeclare');

Route::get('user/camera/{camera_id}/PostDeclare',[
	'uses' => 'ShowallUserController@PostDeclare',
	'as' => 'user.camera.declare_uaer' ////////////////////////////////////////ลองเทสดู
]);

Route::resource('user/home','NewsUserController');

Route::get('user/camera/{camera_id}/history',[
	'uses' => 'CameraController@historyUser',
	'as' => 'user.camera.history_ByID_User'
]);

Route::get('user/work_user','CameraController@work_user');

Route::get('user/work_user/{work_id}/work_report',[
	'uses' => 'CameraController@work_report',
	'as' => 'user.work_user.work_report'
]);


Route::get('user/work_user/{work_id}/get_work_report',[
	'uses' => 'CameraController@get_work_report',
	'as' => 'user.work_user.get_work_report'
]);

Route::get('user/work_user/{work_id}/work_1',[
	'uses' => 'CameraController@work_1',
]);