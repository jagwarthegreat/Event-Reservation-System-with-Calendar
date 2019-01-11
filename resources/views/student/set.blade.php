@extends('student.template')

@section('styles')
	<link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
  <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>
   <style>
    .wak{
      color:  red;
    }
    .wek{
      color:  green;
    }
  </style>
@endsection
@section('contents')
	<div class="col-md-12">
		
		
		<div class="col-md-4">
      <h3 class="text-center">Booking Details</h3>
     
      <form action="{{route('student_insert_event')}}" method="POST">

        <div class="form-group">
          <label>Booking Date</label>
          <input type="date" name="date" class="form-control" required="" value="{{old('date')}}" id="date">
        </div>

        <div class="form-group">
           <label>College / Building</label>

            <select class="form-control" name="building" required="" id="building">
                <option value="">None</option>
                @foreach($departments as $dept)
                  <option value="{{$dept->id}}">{{$dept->name}}</option>
                @endforeach
            </select>

        </div>

         <div class="form-group">
              <label>ROOMS</label>
              <select class="form-control" name="rooms" required="" id="roomzero2">
               <option value="" id="roomzero">None</option>
              </select>
          </div>
          
          <div class="form-group">
            <label>Start Time</label>
             <select class="form-control" name="start_time" required="" id="start">
                @foreach($times as $time)
                   <option value="{{$time->time}}">{{Carbon\Carbon::parse($time->time)->format('h:i a')}}</option>
                @endforeach
               
              </select>
          </div>

          <div class="form-group">
            <label>End Time</label>
             <select class="form-control" name="end_time" required="" id="end">
               @foreach($times as $time)
                   <option value="{{$time->time}}">{{Carbon\Carbon::parse($time->time)->format('h:i a')}}</option>
                @endforeach
              </select>
          </div>

             <div class="form-group" >
              <label>Event Title</label>
              <input type="text" name="event_title" class="form-control" required="" value="{{ old('event_title') }}">
            </div>

            <div class="form-group">
              <label>Event Organizer</label>
              <input type="text" name="event_organizer" class="form-control" required="" value="{{old('event_organizer')}}">
            </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required="" value="{{old('email')}}">
          </div>

          <div class="form-group">
            <label>Contact#</label>
            <input type="text" name="contact" class="form-control" required="" value="{{old("contact")}}">
          </div>

            <button type="submit" class="btn btn-primary btn-lg">DONE</button>
            @csrf
      </form>
    </div>
    <div class="col-md-8">
      <div id="calendar" >
                
      </div>
    </div>

	</div>	
		

	
	
@endsection

@section('scripts')
<script src='{{URL::to('calendar/moment.min.js')}}'></script>
<script src='{{URL::to('calendar/fullcalendar.min.js')}}'></script>
<script src="{{URL::to('calendar/sweet.js')}}"></script>
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
    $(document).ready(function() {
        // page is now ready, initialize the calendar...
        

        @if(Session::has('err1'))
          swal("Oopps!", "Start time had conflict. Kindly choose another one.", "error");
        @endif

        @if(Session::has('err2'))
          swal("Oopps!", "Start time had conflict. Kindly choose another one.", "error");
        @endif

        @if(Session::has('err3'))
          swal("Oopps!", "End time had conflict. Kindly choose another one.", "error");
        @endif

        @if(Session::has('suc'))
          swal("Huray!", "Reservation has been successfully added!.", "success");
        @endif

        var token = '{{Session::token()}}';
        var url = '{{ route('student_get_rooms') }}';
        var url2 = '{{ route('admin_start_verify') }}';
        var url3 = '{{ route('admin_end_start_verify') }}';

        $("#building").change(function(e){
         $(".awroom").remove();
          e.preventDefault();
          var bldgId = $("#building").val();
        
          $.ajax({
              method: 'POST',
              url: url,
              data: { bldgId: bldgId, _token : token},
              success: function( msg ){
                console.log(msg);
                 $.each(msg, function( aw,ew ) {
                  
                   $('#roomzero2').append("<option value="+ew.id+" class='awroom'>"+ew.room+"</option>");
                    console.log(ew.room);
                 });
                
              }
          });

        });

        $("#start").change(function(){
        var start = $("#start").val();
        var date = $("#date").val();
        var room = $("#roomzero2").val();
        $("#start").parent().removeClass("has-error has-feedback has-success");
        $(".tae").remove();
         $(".tae").removeClass("wak wek");
         
         $.ajax({
              method: 'POST',
              url: url2,
              data: { start: start,date : date,room : room, _token : token},
              success: function( msg ){
                console.log(msg);
                if(msg == 0){
                  $("#start").parent().addClass("has-error has-feedback").append('<span class="fa fa-times form-control-feedback tae wak">Time Conflict</span>');
                
                  }else{
                    $("#start").parent().addClass("has-success has-feedback").append('<span class="fa fa-check form-control-feedback tae wek">Time Available</span>');
                  }
              }
          });
      });  

       $("#end").change(function(){
        var end = $("#end").val();
        var date = $("#date").val();
        var room = $("#roomzero2").val();
        $("#end").parent().removeClass("has-error has-feedback has-success");
        $(".tae2").remove();
         $(".tae2").removeClass("wak wek");
         
         $.ajax({
              method: 'POST',
              url: url3,
              data: { end: end,date : date,room : room, _token : token},
              success: function( msg ){
                console.log(msg);
                if(msg == 0){
                  $("#end").parent().addClass("has-error has-feedback").append('<span class="fa fa-times form-control-feedback tae2 wak">Time Conflict</span>');
                
                  }else{
                    $("#end").parent().addClass("has-success has-feedback").append('<span class="fa fa-check form-control-feedback tae2 wek">Time Available</span>');
                  }
              }
          });
      }); 
    });
</script>
@endsection