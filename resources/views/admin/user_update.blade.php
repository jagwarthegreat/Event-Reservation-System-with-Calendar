@extends('admin.template')

@section('styles')
	
	
	<script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
	<link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
@endsection

@section('contents')
	<h3 class="text-center">Create User</h3>
	
	<div class="container">
		<form action="{{route('admin_record_update_user',$user)}}" method="POST">
			<div class="form-group">
				<label>First Name</label>
				<input type="text" name="first_name" class="form-control" required="" value="{{$user->first_name}}">
			</div>
			<div class="form-group">
				<label>Last Name</label>
				<input type="text" name="last_name" class="form-control" required="" value="{{$user->last_name}}">
			</div>
			<div class="form-group">
				<label>User Type</label>
				<select name="role_id" class="form-control">
					<option value="2">Faculty</option>
					<option value="3">Student</option>
				</select>
			</div>
			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control" required="" value="{{$user->username}}">
			</div>
			
			<div class="form-group">
				@csrf
				<button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
			</div>
		</form>
	</div>
@endsection

@section('scripts')

<script src="{{URL::to('calendar/sweet.js')}}"></script>
<script>
	 
	@if(Session::has('suc'))
          swal("Huray!", "User has been Updated Successfully!", "success");
     @endif
    
  $(document).ready(function() {
    $('#table').DataTable();
    
     

} );
 </script>
@endsection