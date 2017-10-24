@extends('main')
@section('title', 'Newspaper - Dashboard')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<h2>Latest users</h2>
			<ul class="list-group">
			  @foreach($users as $user)
			  	<li class="list-group-item">
			  		<img src="{{ asset('storage/'.$user->photo) }}" width="40px">
			  		<a href="{{ route('users.show', $user->id) }}">{{$user->name}}</a>
			  		<div style="clear: both;"></div>
			  	</li>
			  @endforeach
			</ul>
		</div>
		<div class="col-sm-8">
			<h2>Latest news</h2>
			<ul class="list-group">
			  @foreach($news as $n)
			  	<li class="list-group-item">
			  		<img src="{{ asset('storage/'.$n->photo) }}" width="100px">
			  		<a href="{{ route('news.show', $n->slug) }}">{{$n->title}}</a>
			  		<div style="clear: both;"></div>
			  	</li>
			  @endforeach
			</ul>
		</div>
	</div>
</div>
@endsection