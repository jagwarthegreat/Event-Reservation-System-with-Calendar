@extends('shared.template')

@section('styles')
 <style type="text/css">
            .col-md-6{
                margin-top: 10%;
            }

            .bg-dark{
              background: #800000 !important;
            }
            .btn{
            	background: #800000 !important;
            }

        </style>
        <style>
    .valid-feedback.feedback-icon,
.invalid-feedback.feedback-icon {
    position: absolute;
    width: auto;
    bottom: 10px;
    right: 10px;
    margin-top: 0;
}
  </style>
@endsection
@section('contents')
	<div class="col-md-6 offset-md-3">
		@include('shared.notification')
		<p class="text-center">
			<img src="{{URL::to('image/logo.png')}}" width="120px" height="120px">
		</p>
		<div class="card">
		  <div class="card-header">
		    <h3 class="text-center">Login Form</h3>
		    
		  </div>
		  <div class="card-body">
		    <form action="{{route('login_check')}}" method="POST">
		    	<div class="form-group">
		    		<label>Username</label>
		    		<input type="text" name="username" class="form-control" placeholder="Enter Username" required="">
		    	</div>
		    	<div class="form-group">
		    		<label>Password</label>
		    		<input type="password" name="password" class="form-control" placeholder="Enter Username" required="">
		    	</div>
		    	@csrf
		    	<button type="submit" class="btn btn-secondary btn-block">Submit</button>
		    </form>
		    
		  </div>
		</div>
	</div>

@endsection