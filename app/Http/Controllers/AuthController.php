<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event\Auth\LoginCheck;
use App\ReservationEvent;
use DB;
class AuthController extends Controller
{
    public function login(){
    	return view('auth.login');
    }

    public function login_check(LoginCheck $validate){
    	return $validate->loginvalidate();
    }

    public function view_event_info($id){
    	$find = ReservationEvent::findOrFail($id);
    	$calendars = ReservationEvent::where('status_id',1)->orWhere('status_id',3)->get();
    	return view('shared.reserve-info', compact('find','calendars'));
    }

    public function view_calendar_day_schedules(){
        $date = $_GET['date'];
        $datas = ReservationEvent::where('date', $date)->where('status_id','!=',0)->where('status_id','!=',2)->get();
        return view('shared.view-today-schedules', compact('datas'));
    }

    public function admin_start_verify(Request $request){
       
        $check = DB::table('reservation_events')
                        ->where('date','=',$request->input('date'))
                        ->where('room_id', $request->input('room'))
                        ->where('start_time', $request->input('start'))
                        ->get();


          $check2 = DB::table('reservation_events')
                        ->where('date','=',$request->input('date'))
                        ->where('room_id', $request->input('room'))
                       ->where('start_time','<',$request->input('start'))
                       ->where('end_time','>',$request->input('start'))
                        ->get();  
        
        if(count($check) > 0){
            return response()->json(0);
        }else if(count($check2) > 0){
            return response()->json(0);
        }else{
            return response()->json(1);
        }
    }

    public function admin_end_start_verify(Request $request){
        $check3 = DB::table('reservation_events')
                        ->where('date','=',$request->input('date'))
                        ->where('room_id', $request->input('room'))
                        
                       ->where('start_time','<',$request->input('end'))
                       ->where('end_time','>',$request->input('end'))
                        ->get();  
        if(count($check3) > 0){
             return response()->json(0);
        }else{
            return response()->json(1);
        }             
       
    }
}

