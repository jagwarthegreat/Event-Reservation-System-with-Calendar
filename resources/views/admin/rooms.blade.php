@extends('admin.template')

@section('contents')
	<div class="col-md-12">
		<div class="col-md-6">
			<h3 class="text-center">New Room</h3>
			@if(Session::has('suc'))
				<div class="alert alert-success">
					{{Session::get('suc')}}
				</div>
			@endif
			<form action="{{route('admin_insert_room')}}" method="POST">
				<div class="form-group">
					<label>Select Department</label>
					<select class="form-control" name="department">
		                @foreach($departments as $dept)
		                  <option value="{{$dept->id}}">{{$dept->name}}</option>
		                @endforeach
	            	</select>
				</div>
				<div class="form-group">
					<label>Enter Room Number</label>
					<input type="text" name="room" class="form-control" required="">
				</div>
				@csrf
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
		<div class="col-md-6">
			<h3 class="text-center">New Time</h3>
			@if(Session::has('timesuc'))
				<div class="alert alert-success">
					{{Session::get('timesuc')}}
				</div>
			@endif
			<form action="{{route('admin_insert_time')}}" method="POST">
				<div class="form-group">
					<label>Enter Time</label>
					<input type="time" name="time" class="form-control" required="">
				</div>
				@csrf
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
		</div>
	</div>
@endsection

@section('scripts')

@endsection