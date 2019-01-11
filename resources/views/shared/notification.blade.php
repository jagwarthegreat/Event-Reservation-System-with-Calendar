@if(Session::has('error'))
	<div class="alert alert-danger">
		{{Session::get('error')}}
	</div>
@endif

@if(Session::has('suc'))
	<div class="alert alert-success">
		{{Session::get('suc')}}
	</div>
@endif

