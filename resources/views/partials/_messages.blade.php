@if ($errors->any())
    <div class="container">
    	<div class="alert alert-danger">
	        <ul>
	        	<strong>We got an error(s)!</strong>
	        	<br><br>
	            @foreach ($errors->all() as $error)
	                <li>{{ $error }}</li>
	            @endforeach
	        </ul>
	    </div>
    </div>
@endif
@if (Session::has('message'))
    <div class="container">
    	<div class="alert alert-info">
	        <ul>
	        	<strong>Message!</strong>
	        	<br><br>
	            {{ Session::get('message') }}
	        </ul>
	    </div>
    </div>
@endif