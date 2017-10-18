<div class="row">
	<div class="col-md-8">
		<h2>Comments</h2>
		@if($comments->count() > 0)
			@foreach($comments as $comment)
				<div class="commentBox">
					<img src="{{ asset('storage/'.$comment->user->photo) }}" class="img-circle" width="80px">
					<div class="commentRow">
						<p class="commentUser left"><a href="{{ route('users.show', $comment->user->id) }}">{{ $comment->user->name }}</a></p>
						<p class="left"> <small>{{ $comment->created_at }}</small> </p>
						<hr>
						<p>{{ $comment->content }}</p>
					</div>
					@role('admin')
						{{ Form::open(['method' => 'DELETE', 'route' => ['comments.destroy', $comment->id], 'class'=>'inline right']) }}
									 {{ Form::submit('Delete', ['class' => 'btn btn-primary']) }}
						{{ Form::close() }}
					@endrole
				</div>
			@endforeach
		@else
		<i>There's no comments for this article yet.
		@endif
	</div>
</div>