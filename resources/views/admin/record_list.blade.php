@extends('admin.template')

@section('styles')
	
	
	<script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
	<script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
	<link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
@endsection

@section('contents')
	<h3 class="text-center">Record List</h3>
	
	<table class="table" id="table">
		<thead>
			<tr>
				<th>Jan</th>
				<th>Feb</th>
				<th>March</th>
				<th>April</th>
				<th>May</th>
				<th>June</th>
				<th>July</th>
				<th>August</th>
				<th>Sep</th>
				<th>Oct</th>
				<th>Nov</th>
				<th>Dec</th>
				<th>Year</th>
			</tr>
		</thead>
		<tbody>
			@foreach($records as $rec)
				<tr>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 1)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>	
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 2)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 3)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 4)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 5)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 6)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 7)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 8)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 9)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 10)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 11)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					<td>
						@if(Carbon\Carbon::parse($rec->created_at)->format('m') == 12)
							{{$rec->department->name}} - {{$rec->room->room}}
						@endif	
					</td>
					
					<td>{{Carbon\Carbon::parse($rec->created_at)->format('Y')}}</td>
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