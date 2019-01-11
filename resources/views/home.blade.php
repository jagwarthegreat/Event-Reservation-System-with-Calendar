<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
        <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>

        <title>Reservation</title>
        
        <style type="text/css">
            #calendar{
                margin-top: 5%;
            }
            .fc-day-number{
              color: #e84118 !important;
            }
            
            body{
               background-image: url("{{URL::to('image/bg.jpg')}}");  
               background-attachment: fixed;
              background-size: auto 100%;
              background-position: center;

            }
          
            .bg-dark{
              background: #800000 !important;
            }


        </style>
    </head>
    <body>
        @include('shared.nav')
        <div class="container">
            <div id="calendar" class="col-md-10 offset-md-1" >
                
            </div>
        </div>
    </body>
    <script src="{{URL::to('calendar/jquery-1.11.3.min.js')}}"></script>
    <script src="{{URL::to('calendar/popper.min.js')}}"></script>
  <script src="{{URL::to('calendar/bootstrap.min.js')}}"></script>
  
<script src='{{URL::to('calendar/moment.min.js')}}'></script>
<script src='{{URL::to('calendar/fullcalendar.min.js')}}'></script>
<script>
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
      
      
     
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      eventLimit: true, // allow "more" link when too many events

      events: [
        @foreach($calendars as $cal)
        {

          title: '{{$cal->event_title}} ',
          url: '{{route('view_event_info', $cal->id)}}',
          date: '{{$cal->date}}',
         description: 'This is a cool event',
          @if($cal->status_id == 3)
          color: '#ff00ac'
          @endif

        },
        @endforeach  

      ],



    });

      




    });
</script>
</html>
