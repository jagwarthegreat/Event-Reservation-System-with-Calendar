<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\ReservationEvent;
use App\Department;
use App\Time;
use App\Room;
class StudentController extends Controller
{
    public function home(){
        $approve = ReservationEvent::where('status_id',1)->where('user_id',Auth::user()->id)->count(); 
        $pending = ReservationEvent::where('status_id',2)->where('user_id',Auth::user()->id)->count();
        $calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
    	return view('student.home', compact('calendars','approve','pending'));
    }

    public function logout(){
    	Auth::logout();
    	return redirect()->route('login');
    }

    public function student_list(){
    	$datas = ReservationEvent::where('user_id',Auth()->user()->id)->get();
    	return view('student.list', compact('datas'));
    }

    public function student_set(){
        $calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
        $departments = Department::all();
        $times = Time::all();
    	return view('student.set',compact('calendars','departments','times'));
    }

    public function student_get_rooms(Request $request){
        $rooms = Room::where('department_id', $request['bldgId'])->get();
        return response()->json($rooms);
    }

    public function student_insert_event(Request $request){

        
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

        return redirect()->route('student_review_details',$res->id)->with('suc', 'You have Successfully Added an Event');
    }

    public function student_review_details($id){
        $find = ReservationEvent::findOrFail($id);
        $calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
        return view('student.review-details', compact('find','calendars'));
    }

    public function student_approve_details($id){
        $reserve = ReservationEvent::findOrFail($id);
        $reserve->status_id = 2;
        $reserve->save();
        return redirect()->route('student_set')->with('suc', 'You have Successfully Added an Event');
    }
}
