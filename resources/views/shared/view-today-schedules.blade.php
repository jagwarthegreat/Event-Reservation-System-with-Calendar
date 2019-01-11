<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Reservation</title>


  <link href="{{URL::to('dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
  
  
  <script src="{{URL::to('tables/jquery-1.12.3.js')}}"></script>
  <script src="{{URL::to('tables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::to('tables/dataTables.bootstrap.min.js')}}"></script>   
  <link rel="stylesheet" href="{{URL::to('tables/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{URL::to('tables/dataTables.bootstrap.min.css')}}">
   @yield('styles') 
 
</head>

<body>
 
  <section id="container" class="">
  
    
    <section id="main-content">
      <section class="wrapper">
       
        <div class="container">
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
                    {{Carbon\Carbon::parse($data->start_time)->format('h:i a')}}
                    to 
                    {{Carbon\Carbon::parse($data->end_time)->format('h:i a')}}
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </section>
    </section>
  

 

</body>
  
  <script>
   
 
  $(document).ready(function() {
    $('#table').DataTable();
    
     

} );
 </script>
</html>
