@if(Auth::check())
<div class="row">
	<div class="col-md-8">
		<h2>Share your opinion</h2>
		{{ Form::open(['method' => 'POST', 'route' => 'comments.store', 'class'=>'form-group']) }}
			{{ Form::hidden('newsID', $news->id) }}
			{{ Form::textarea('content', '', ['class'=>'form-control']) }}

			{{ Form::submit('Comment', ['class' => 'btn btn-primary']) }}
		{{ Form::close() }}
	</div>
</div>
@endif