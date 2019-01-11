<?php 
namespace App\Event\Auth;
use Illuminate\Http\Request;
use Auth;
class LoginCheck{

	private $request;

	public function __construct(Request $request){
		$this->request = $request;
	}

	public function loginvalidate(){
		$data = [
			'username'=> $this->request['username'],
			'password'=> $this->request['password']
		];
		if(Auth::attempt($data)){
			if(Auth::user()->role_id == 1){
				return redirect()->route('admin_home');
			}
			if(Auth::user()->role_id == 2){
				return redirect()->route('faculty_home');
			}
			if(Auth::user()->role_id == 3){
				
				return redirect()->route('student_home');
			}
		}else{
			return redirect()->back()->with('error','Invalid Username/Password');
		}
	}
}