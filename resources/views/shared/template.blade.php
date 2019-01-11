<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{URL::to('calendar/bootstrap.min.css')}}">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <title>Reservation</title>
        
       @yield('styles')
    </head>
    <body>
        @if(Auth::check())

        @else
            @include('shared.nav')
        @endif
       
        <div class="container">
            @yield('contents')
        </div>
    </body>
    <script src="{{URL::to('calendar/jquery-1.11.3.min.js')}}"></script>
    <script src="{{URL::to('calendar/popper.min.js')}}"></script>
  <script src="{{URL::to('calendar/bootstrap.min.js')}}"></script>
  

</html>
