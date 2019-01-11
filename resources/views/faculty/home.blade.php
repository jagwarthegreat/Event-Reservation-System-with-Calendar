@extends('faculty.template')

@section('styles')
	<link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
  <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>
@endsection

@section('contents')
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="panel panel-warning">
				<div class="panel-heading">
					<span class="badge bg-warning">{{$pending}}</span>
				</div>
				<div class="panel-body">
					<h3 class="text-center">Pending Reservation</h3>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<span class="badge bg-primary">{{$approve}}</span>
				</div>
				<div class="panel-body">
					<h3 class="text-center">Approved Reservation</h3>
				</div>
			</div>
		</div>
		

		<div class="col-md-8 col-md-offset-2">
			<div id="calendar" >
                
   			</div>
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