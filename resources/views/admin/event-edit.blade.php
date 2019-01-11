@extends('admin.template')

@section('styles')
  <link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
    <link rel='stylesheet' href='{{URL::to('calendar/fullcalendar.min.css')}}'/>
@endsection
@section('contents')
  <div class="col-md-12">

     <div class="col-md-5">
     <form action="{{route('admin_edit_check',$find->id)}}" method="POST">

        <div class="form-group">
          <label>Booking Date</label>
          <input type="date" name="date" class="form-control" required="" value="{{$find->date}}">
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
            <label>Event Title</label>
            <input type="text" name="event_title" class="form-control" required="" value="{{$find->event_title}}">
          </div>

          <div class="form-group">
            <label>Event Organizer</label>
            <input type="text" name="event_organizer" class="form-control" required="" value="{{$find->event_organizer}}">
          </div>
          
          <div class="form-group">
            <label>Start Time</label>
             <select class="form-control" name="start_time" required="">
                @foreach($times as $time)
                   <option value="{{$time->time}}">{{Carbon\Carbon::parse($time->time)->format('h:i a')}}</option>
                @endforeach
               
              </select>
          </div>

          <div class="form-group">
            <label>End Time</label>
             <select class="form-control" name="end_time" required="">
               @foreach($times as $time)
                   <option value="{{$time->time}}">{{Carbon\Carbon::parse($time->time)->format('h:i a')}}</option>
                @endforeach
              </select>
          </div>

          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required="" value="{{$find->email}}">
          </div>

          <div class="form-group">
            <label>Contact#</label>
            <input type="text" name="contact" class="form-control" required="" value="{{$find->contact}}">
          </div>

            <button type="submit" class="btn btn-info btn-lg btn-block">UPDATE</button>
            @csrf
      </form>
    </div>
    
     <div class="col-md-7">
       <div class="card">
       <div class="card-header">
          <h3 class="text-center">Event Details</h3>
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
          <p><<< If you want to update the details. Kindly fill-up the form from the left.</p>
            
        </div>

       </div> 

     

    </div>  
    <div class="col-md-7 offset-md-5">
      <div id="calendar">
                
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
  var token = '{{Session::token()}}';
        var url = '{{ route('admin_get_rooms') }}';

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

    $(document).ready(function() {
        // page is now ready, initialize the calendar...
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

        @if(Session::has('update'))
          swal("Huray!", "Event has been updated successfully!!", "success");
        @endif


    });
</script>
@endsection