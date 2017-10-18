@extends('main')
@section('title', 'Newspaper - Create News')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="news">
				<img src="{{ asset('storage/'.$news->photo) }}" width="100%">
				<small class="left">{{ $news->user->name }}</small>
				<small class="right">{{ $news->created_at }}</small>
				<h1>{{ $news->title }}</h1>
				<p>{{ $news->body }}</p>
			</div>
		</div>
		@role('writer')
		<div class="col-md-4">
			<div class="well">
				<center>
					<i class="fa fa-cog fa-3x"></i>
					<br><br>
					{{ Form::open(['method' => 'DELETE', 'route' => ['news.destroy', $news->id], 'class'=>'inline']) }}
					    {{ Form::submit('Delete', ['class' => 'btn btn-primary']) }}
					{{ Form::close() }}
					<a href="{{ route('news.edit', $news->id) }}" class="btn btn-primary">Update</a>
				</center>
			</div>
		</div>
		@endrole
	</div>
	@include('comments._create')
	@include('comments._list')
</div>
@endsection