@extends('admin.template')

@section('styles')
	
	
	<script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
	<link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
@endsection

@section('contents')
	<h3 class="text-center">Users List</h3>
	<a href="{{route('admin_record_create_user')}}" class="btn btn-primary btn-xs">Create User</a>
	<table class="table" id="table">
		<thead>
			<tr>
				<th>Name</th>
				<th>Username</th>
				<th>Roles</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{$user->first_name}} {{$user->last_name}}</td>
					<td>{{$user->username}}</td>
					<td>
						@if($user->role_id == 1)
							<strong>Admin</strong>
						@elseif($user->role_id == 2)
							<strong>Faculty</strong>
						@elseif($user->role_id == 3)
							<strong>Student</strong>
						@endif
					</td>
					<td>
						<a href="{{route('admin_record_get_user',$user)}}" class="btn btn-info btn-sm">Edit</a>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('scripts')

<script src="{{URL::to('calendar/sweet.js')}}"></script>
<script>
	 
	@if(Session::has('suc'))
          swal("Huray!", "Event has been approve Successfully!", "success");
     @endif
     @if(Session::has('error'))
          swal("Huray!", "Event has been Decline Successfully!", "error");
     @endif
     @if(Session::has('Finished'))
          swal("Finished", "Event has been Finished Successfully!", "success");
     @endif
  $(document).ready(function() {
    $('#table').DataTable();
    
     

} );
 </script>
@endsection