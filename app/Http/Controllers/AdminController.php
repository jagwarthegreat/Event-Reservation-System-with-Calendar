<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Department;
use App\Room;
use App\Time;
use App\ReservationEvent;
use DB;
use App\User;
class AdminController extends Controller
{
    public function home(){
    	$calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
    	return view('admin.home', compact('calendars'));
    }

    public function logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function reservations(){
    	$datas = ReservationEvent::all();	
    	return view('admin.reservations', compact('datas'));
    }

    public function rooms(){
    	$departments = Department::all();
    	return view('admin.rooms', compact('departments'));
    }

    public function admin_create_event(){
    	$calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
    	$departments = Department::all();
    	$times = Time::all();
    	$rooms = Room::all();
    	return view('admin.create_event', compact('departments','times','rooms','calendars'));
    }

    public function admin_insert_room(Request $request){
    	$room = new Room;
    	$room->department_id = $request['department'];
    	$room->room = $request['room'];
    	$room->save();
    	return redirect()->back()->with('suc', 'Room Successfully Added!');
    }

    public function admin_insert_time(Request $request){
    	$time = new Time;
    	$time->time = $request['time'];
    	$time->save();
    	return redirect()->back()->with('timesuc', 'Time Successfully Added!');
    }

    public function admin_insert_event(Request $request){

    	
         $check = DB::table('reservation_events')
                        ->where('date','=',$request['date'])
                        ->where('room_id', $request['rooms'])
                        ->where('start_time', $request['start_time'])
                       
                        ->get();


          $check2 = DB::table('reservation_events')
                        ->where('date','=',$request['date'])
                        ->where('room_id', $request['rooms'])
                        
                       ->where('start_time','<',$request['start_time'])
                       ->where('end_time','>',$request['start_time'])
                        ->get();  

           $check3 = DB::table('reservation_events')
                        ->where('date','=',$request['date'])
                        ->where('room_id', $request['rooms'])
                        
                       ->where('start_time','<',$request['end_time'])
                       ->where('end_time','>',$request['end_time'])
                        ->get();                            

          if(count($check) > 0){
                return redirect()->back()->with('err1', 'Invalid1')->withInput($request->all());
          }    

           if(count($check2) > 0){
                 return redirect()->back()->with('err2', 'Invalid1')->withInput($request->all());
          }   

           if(count($check3) > 0){
                 return redirect()->back()->with('err3', 'Invalid1')->withInput($request->all());
          }  

               
    	$res = new ReservationEvent;
    	$res->date = $request['date'];
        $res->user_id = Auth::user()->id;
    	$res->department_id = $request['building'];
    	$res->room_id = $request['rooms'];
    	$res->event_title = $request['event_title'];
    	$res->event_organizer = $request['event_organizer']; 
    	$res->start_time = $request['start_time'];
    	$res->end_time = $request['end_time'];
    	$res->email = $request['email'];
    	$res->contact = $request['contact'];
    	$res->status_id = 0;
    	$res->save();

    	return redirect()->route('admin_review_details',$res->id)->with('suc', 'You have Successfully Added an Event');
    }

    public function admin_review_details($id){
        $find = ReservationEvent::findOrFail($id);
        $calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
        return view('admin.review-details', compact('find','calendars'));
    }

    public function admin_approve_details($id){
        $reserve = ReservationEvent::findOrFail($id);
        $reserve->status_id = 1;
        $reserve->save();
        return redirect()->route('admin_create_event')->with('suc', 'You have Successfully Added an Event');
    }

    public function admin_get_rooms(Request $request){
        $rooms = Room::where('department_id', $request['bldgId'])->get();
        return response()->json($rooms);
    }

    public function admin_approve_event($id){
        $find = ReservationEvent::findOrFail($id);
        $find->status_id = 1;
        $find->save();
        return redirect()->back()->with('suc','Event has been approve Successfully!');
    }

    // public function admin_view_event($id){
    //     return $id;
    // }

    public function admin_decline_event($id){
         $find = ReservationEvent::findOrFail($id);
         $find->delete();
        return redirect()->back()->with('error','Event has been Decline Successfully!');
    }

    public function admin_edit_info($id){
        $calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
        $find = ReservationEvent::findOrFail($id);
        $departments = Department::all();
        $times = Time::all();
        return view('admin.event-edit', compact('find','calendars','departments','times'));
    }

    public function admin_edit_check(Request $request, $id){
        $res = ReservationEvent::findOrFail($id);
        $res->date = $request['date'];
        $res->department_id = $request['building'];
        $res->room_id = $request['rooms'];
        $res->event_title = $request['event_title'];
        $res->event_organizer = $request['event_organizer']; 
        $res->start_time = $request['start_time'];
        $res->end_time = $request['end_time'];
        $res->email = $request['email'];
        $res->contact = $request['contact'];
        $res->status_id = $res->status_id;
        $res->save();
        return redirect()->back()->with('update','updated');
    }

    public function admin_finished_event($id){

         $find = ReservationEvent::findOrFail($id);
         $find->status_id = 3;
         $find->save();
        return redirect()->back()->with('Finished','finished na!');
    }

    

    public function admin_user_lists(){
        $users = User::all();
        return view('admin.user_list',compact('users'));
    }

    public function admin_record_lists(){
        $records = ReservationEvent::where('status_id',3)->get();
        return view('admin.record_list', compact('records'));
    }
    public function admin_record_create_user(){
        return view('admin.user_create');
    }
    public function admin_record_create_user_check(Request $request){
        $user = new User;
        $user->username =  $request->username;
        $user->password = bcrypt($request->password);
        $user->first_name = $request->first_name;
        $user->last_name= $request->last_name;
        $user->role_id= $request->role_id;
        $user->save();
        return back()->with('suc','ok');
    }

    public function admin_record_get_user($user){
        $user = User::findOrFail($user);
        return view('admin.user_update',compact('user'));
    }

    public function admin_record_update_user(Request $request,$user){
        $find = User::findOrFail($user);
        $find->first_name = $request->first_name;
        $find->last_name = $request->last_name;
        $find->role_id = $request->role_id;
        $find->username = $request->username;
        $find->save();
        return back()->with('suc','ok');
    }
}
