@extends('admin.template')

@section('styles')
	<link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
  <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>
@endsection
@section('contents')
	<div class="col-md-12">
			
		<a href="{{route('admin_create_event')}}" class="btn btn-danger btn-lg">Reserve Event</a>
		<br>
		<div id="calendar" >
                
   	</div>

	</div>	
		

	
	
@endsection

@section('scripts')

<script src='{{URL::to('calendar/moment.min.js')}}'></script>
<script src='{{URL::to('calendar/fullcalendar.min.js')}}'></script>
<script>
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        $(document).ready(function() {

    $('#calendar').fullCalendar({
       allDaySlot: true,
  dayClick: function(date, jsEvent, view) {
    var day = date.format("YYYY-MM-DD");
      window.location.href = "{{route('view_calendar_day_schedules')}}?date="+day;
  } ,
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
     
      //navLinks: true, // can click day/week names to navigate views
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