@extends('faculty.template')

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
					</td>
					<td>
						@if($data->status_id == 1)
							Accepted
						@else
							Pending
						@endif
					</td>
					
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection

@section('scripts')

<script>
  $(document).ready(function() {
    $('#table').DataTable();
} );
 </script>
@endsection