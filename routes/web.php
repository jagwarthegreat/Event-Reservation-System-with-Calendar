<?php
use App\ReservationEvent;
// use App\User;

// Route::get('/add', function(){
// 	$user = new User;
// 	$user->username = 'jspalquiran';
// 	$user->password = bcrypt('201412345');
// 	$user->first_name  = 'jspalquiran';
// 	$user->last_name = 'jspalquiran';
// 	$user->role_id =  3;
// 	$user->save();

// });

/*
USERS
1 - admin
2 - faculty
3 - student

Status Name for Event
0 - not yet submit
2 - pending 
1 - Approve
3 - Finished
*/

Route::get('/', function () {
	$calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->orderBy('created_at','asc')->get();
    return view('home', compact('calendars'));
});

Route::group(['prefix'=> 'auth'], function(){

	Route::get('/login', [
		'as'=> 'login',
		'uses'=> 'AuthController@login'
	]);

	Route::post('/login', [
		'as'=> 'login_check',
		'uses'=> 'AuthController@login_check'
	]);

	Route::get('/view-reserve-infomation-details/{id}', [
		'as'=> 'view_event_info',
		'uses'=> 'AuthController@view_event_info'
	]);

	Route::get('/view-calendar-day-schedules',[
		'as'=> 'view_calendar_day_schedules',
		'uses'=> 'AuthController@view_calendar_day_schedules'
	]);

	Route::post('/start-verified',[
		'as'=> 'admin_start_verify',
		'uses'=> 'AuthController@admin_start_verify'
	]);

	Route::post('/end_start-verified',[
		'as'=> 'admin_end_start_verify',
		'uses'=> 'AuthController@admin_end_start_verify'
	]);



});

Route::group(['prefix'=> 'admin', 'middleware'=> 'admincheck'], function(){
	Route::get('/home', [
		'as'=> 'admin_home',
		'uses'=> 'AdminController@home'
	]);
	Route::get('/logout', [
		'as'=> 'admin_logout',
		'uses'=> 'AdminController@logout'
	]);

	Route::get('/reservations', [
		'as'=> 'admin_reservations',
		'uses'=> 'AdminController@reservations'
	]);

	Route::get('/rooms', [
		'as'=> 'admin_rooms',
		'uses'=> 'AdminController@rooms'
	]);

	Route::get('/create-event', [
		'as'=> 'admin_create_event',
		'uses'=> 'AdminController@admin_create_event'
	]);

	Route::post('/create-room-number', [
		'as'=> 'admin_insert_room',
		'uses'=> 'AdminController@admin_insert_room'
	]);

	Route::post('/create-time', [
		'as'=> 'admin_insert_time',
		'uses'=> 'AdminController@admin_insert_time'
	]);

	Route::post('/create-event', [
		'as'=> 'admin_insert_event',
		'uses'=> 'AdminController@admin_insert_event'
	]);

	Route::get('/review-details-reservation/{id}', [
		'as'=> 'admin_review_details',
		'uses'=> 'AdminController@admin_review_details'
	]);

	Route::get('/approve-details/{id}', [
		'as'=> 'admin_approve_details',
		'uses'=> 'AdminController@admin_approve_details'
	]);

	
	Route::post('/get-rooms}', [
		'as'=> 'admin_get_rooms',
		'uses'=> 'AdminController@admin_get_rooms'
	]);

	Route::get('/approve-event/{id}', [
		'as'=> 'admin_approve_event',
		'uses'=> 'AdminController@admin_approve_event'
	]);

	Route::get('/view-event/{id}', [
		'as'=> 'admin_view_event',
		'uses'=> 'AdminController@admin_view_event'
	]);

	Route::get('/decline-event/{id}', [
		'as'=> 'admin_decline_event',
		'uses'=> 'AdminController@admin_decline_event'
	]);

	Route::get('/event-edit-info/{id}', [
		'as'=> 'admin_edit_info',
		'uses'=> 'AdminController@admin_edit_info'
	]);

	Route::post('/event-edit-check/{id}', [
		'as'=> 'admin_edit_check',
		'uses'=> 'AdminController@admin_edit_check'
	]);

	Route::get('/event-finised/{id}', [
		'as'=> 'admin_finished_event',
		'uses'=> 'AdminController@admin_finished_event'
	]);

	
	Route::get('/user-lists', [
		'as'=> 'admin_user_lists',
		'uses'=> 'AdminController@admin_user_lists'
	]);

	Route::get('/record-lists', [
		'as'=> 'admin_record_lists',
		'uses'=> 'AdminController@admin_record_lists'
	]);
	Route::get('/user-create', [
		'as'=> 'admin_record_create_user',
		'uses'=> 'AdminController@admin_record_create_user'
	]);
	Route::post('/user-create', [
		'as'=> 'admin_record_create_user_check',
		'uses'=> 'AdminController@admin_record_create_user_check'
	]);
	Route::get('/get-user/{user}', [
		'as'=> 'admin_record_get_user',
		'uses'=> 'AdminController@admin_record_get_user'
	]);
	Route::post('/update-user/{user}', [
		'as'=> 'admin_record_update_user',
		'uses'=> 'AdminController@admin_record_update_user'
	]);
});

Route::group(['prefix'=> 'faculty', 'middleware'=> 'facultycheck'], function(){
	Route::get('/home', [
		'as'=> 'faculty_home',
		'uses'=> 'FacultyController@home'
	]);
	Route::get('/logout', [
		'as'=> 'faculty_logout',
		'uses'=> 'FacultyController@logout'
	]);

	Route::get('/list', [
		'as'=> 'faculty_list',
		'uses'=> 'FacultyController@faculty_list'
	]);
	Route::get('/set', [
		'as'=> 'faculty_set',
		'uses'=> 'FacultyController@faculty_set'
	]);
	Route::post('/get-rooms}', [
		'as'=> 'faculty_get_rooms',
		'uses'=> 'FacultyController@faculty_get_rooms'
	]);

	Route::post('/create-event', [
		'as'=> 'faculty_insert_event',
		'uses'=> 'FacultyController@faculty_insert_event'
	]);

	Route::get('/review-details-reservation/{id}', [
		'as'=> 'faculty_review_details',
		'uses'=> 'FacultyController@faculty_review_details'
	]);

	Route::get('/approve-details/{id}', [
		'as'=> 'faculty_approve_details',
		'uses'=> 'FacultyController@faculty_approve_details'
	]);

});

Route::group(['prefix'=> 'student', 'middleware'=> 'studentcheck'], function(){
	Route::get('/home', [
		'as'=> 'student_home',
		'uses'=> 'StudentController@home'
	]);
	Route::get('/logout', [
		'as'=> 'student_logout',
		'uses'=> 'StudentController@logout'
	]);
	Route::get('/list', [
		'as'=> 'student_list',
		'uses'=> 'StudentController@student_list'
	]);
	Route::get('/set', [
		'as'=> 'student_set',
		'uses'=> 'StudentController@student_set'
	]);
	Route::post('/get-rooms}', [
		'as'=> 'student_get_rooms',
		'uses'=> 'StudentController@student_get_rooms'
	]);

	Route::post('/create-event', [
		'as'=> 'student_insert_event',
		'uses'=> 'StudentController@student_insert_event'
	]);

	Route::get('/review-details-reservation/{id}', [
		'as'=> 'student_review_details',
		'uses'=> 'StudentController@student_review_details'
	]);

	Route::get('/approve-details/{id}', [
		'as'=> 'student_approve_details',
		'uses'=> 'StudentController@student_approve_details'
	]);

});
