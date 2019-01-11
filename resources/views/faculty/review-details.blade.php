@extends('faculty.template')

@section('styles')
	<link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
    <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>
@endsection
@section('contents')
	<div class="col-md-12">

		 <div class="col-md-5">
      <div id="calendar" >
                
      </div>
    </div>
		
     <div class="col-md-7">
       <div class="card">
       <div class="card-header">
          <h3 class="text-center">Review Details Below</h3>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item active">Booking Date: {{$find->date}}</li>
            <li class="list-group-item">Booking Time: {{Carbon\Carbon::parse($find->start_time)->format('h:i a')}} - {{Carbon\Carbon::parse($find->end_time)->format('h:i a')}} </li>
            <li class="list-group-item">College Building: {{$find->department->name}}</li>
            <li class="list-group-item">Room: {{$find->room->room}}</li>
            <li class="list-group-item">Event Name: {{$find->event_title}}</li>
            <li class="list-group-item">Event Organizer: {{$find->event_organizer}}</li>
            <li class="list-group-item">Email Address: {{$find->email}}</li>
            <li class="list-group-item">Phone Number: {{$find->contact}}</li>
          </ul>
        </div>
        <div class="card-footer">
          <p>If you think all details are correct? Click submit</p>
          <a href="{{route('faculty_approve_details', $find->id)}}" class="btn btn-success btn-block">SUBMIT</a>
        </div>
      </div>

     </div> 
   

	</div>	
		

	
	
@endsection

@section('scripts')
<script src="{{URL::to('dashboard/js/jquery.js')}}"></script>
<script src='{{URL::to('calendar/moment.min.js')}}'></script>
<script src='{{URL::to('calendar/fullcalendar.min.js')}}'></script>
<script src="{{URL::to('calendar/sweet.js')}}"></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
     
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        @foreach($calendars as $cal)
        {
          title: '{{$cal->event_title}}',
          url: '{{route('view_event_info', $cal->id)}}',
          date: '{{$cal->date}}',
           @if($cal->status_id == 3)
            color: '#ff00ac'
            @endif
        },
        @endforeach 

            ]
          });

        });


    });
</script>
@endsection