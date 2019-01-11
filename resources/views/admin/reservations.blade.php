@extends('admin.template')

@section('styles')
	
	
	<script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
	<link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
@endsection

@section('contents')
	<h3 class="text-center">Reservations List</h3>
	
	<table class="table" id="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Event Name</th>
				<th>Organizer</th>
				<th>Date</th>
				<th>Building</th>
				<th>Room</th>
				<th>Time</th>
				<th>Status</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
			@foreach($datas as $data)
				<tr>
					<td>{{$data->id}}</td>
					<td>{{$data->event_title}}</td>
					<td>{{$data->event_organizer}}</td>
					<td>{{$data->date}}</td>
					<td>{{$data->department->name}}</td>
					<td>{{$data->room->room}}</td>
					<td>
						{{Carbon\Carbon::parse($data->start_time)->format('h:i a')}} to 
						{{Carbon\Carbon::parse($data->end_time)->format('h:i a')}}	
						
					<td>
						@if($data->status_id == 1)
							Accepted
						@elseif($data->status_id == 2)
							Pending
						@elseif($data->status_id == 3)
							Finished	
						@endif
					</td>
					<td>
						@if($data->status_id == 1)
							<a href="{{route('view_event_info', $data->id)}}" class="btn btn-info btn-xs">View</a>
							<a href="{{route('admin_finished_event', $data->id)}}" class="btn btn-warning btn-xs">Finished</a>
						@elseif($data->status_id == 2)
							<a href="{{route('admin_approve_event', $data->id)}}" class="btn btn-success btn-xs">Accept</a>
							<a href="{{route('admin_decline_event', $data->id)}}" class="btn btn-danger btn-xs">Decline</a>
							<a href="{{route('view_event_info', $data->id)}}" class="btn btn-info btn-xs">View</a>
						@elseif($data->status_id == 3)
							<a href="{{route('view_event_info', $data->id)}}" class="btn btn-info btn-xs">View</a>
						@endif
						
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