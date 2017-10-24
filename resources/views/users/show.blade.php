@extends('main')
@section('title', 'Newspaper - '.$user->name)

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-4">
			<center>
				<img src="{{ asset('storage/'.$user->photo) }}" class="img-circle" width="100px">
				<h2>{{ $user->name }}</h2>
				Joined: {{ $user->created_at }}
				<br>
				@if(Auth::check() && $user->id == Auth::user()->id)
					<a href="{{ route('users.edit', $user->id) }}" class="btn btn-default">Edit profile</a>
				@endif
				@role('admin')
					<hr>
					{{ Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) }}
					    {{ Form::submit('Delete profile', ['class' => 'btn btn-danger']) }}
					{{ Form::close() }}
				@endrole
			</center>
		</div>
		<div class="col-md-8">
			<h2>Last comments</h2>
			@if($user->comments->count() > 0)
				@foreach($user->comments as $comment)
				<div class="commentBox">
					<div class="commentRow">
						<p class="commentUser left">{{ $user->name }}</p>
						<p class="left"> <small>{{ $comment->created_at }}</small> </p>
						<hr>
						<p>{{ $comment->content }}</p>
					</div>	
					<a href="{{ route('news.show', $comment->news->slug) }}" class="btn btn-default right"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>
				@endforeach
			@else
				<i>{{ $user->name }} has no comments yet</i>
			@endif
		</div>
	</div>
</div>
@endsection