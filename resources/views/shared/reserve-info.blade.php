@extends('shared.template')

@section('styles')
<link href="{{URL::to('dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('dashboard/css/bootstrap-theme.css')}}" rel="stylesheet">
 
  <link href="{{URL::to('dashboard/css/elegant-icons-style.css')}}" rel="stylesheet" />
  <link href="{{URL::to('dashboard/css/font-awesome.min.css')}}" rel="stylesheet" />
  <link href="{{URL::to('dashboard/css/widgets.css')}}" rel="stylesheet">
  <link href="{{URL::to('dashboard/css/style.css')}}" rel="stylesheet">
  <link href="{{URL::to('dashboard/css/style-responsive.css')}}" rel="stylesheet" />
  <script src="{{URL::to('tables/jquery-1.12.3.js')}}"></script>

	<link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
    <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>
    <style>
      .card{
        margin-top: 10%;
      }
    </style>
@endsection
@section('contents')
	<div class="col-md-12">

     <div class="col-md-12">
        
       <div class="card">
       <div class="card-header">
          
          <h3 class="text-center">Event Details Below</h3>
        </div>
        <div class="card-body">
          <ul class="list-group">
            <li class="list-group-item active">Booking Date: {{$find->date}}</li>
            <li class="list-group-item">Booking Time: {{Carbon\Carbon::parse($find->start_time)->format('h:i a')}} to 
            {{Carbon\Carbon::parse($find->end_time)->format('h:i a')}}</li>
            <li class="list-group-item">College Building: {{$find->department->name}}</li>
            <li class="list-group-item">Room: {{$find->room->room}}</li>
            <li class="list-group-item">Event Name: {{$find->event_title}}</li>
            <li class="list-group-item">Event Organizer: {{$find->event_organizer}}</li>
            <li class="list-group-item">Email Address: {{$find->email}}</li>
            <li class="list-group-item">Phone Number: {{$find->contact}}</li>
          </ul>
        </div>
        <div class="card-footer">
          @if(Auth::check())
             @if(Auth::user()->role_id == 1)
              <p>Do you want to edit the details?</p>
              <a href="{{route('admin_edit_info', $find->id)}}" class="btn btn-info btn-block btn-lg">EDIT</a>
            @endif
          @else

          @endif
         
          
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
          url: 'http://google.com/',
          date: '{{$cal->date}}'
        },
        @endforeach 

            ]
          });

        });


    });
</script>
@endsection