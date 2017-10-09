@extends('main')
@section('title', 'Newspaper - Create News')

@section('content')
<div class="container">
	<div class="row">
		@foreach($news as $n)
		<div class="col-md-6">
			<div class="newsBox">
				<a href="{{ route('news.show', $n->id) }}">
					<img src="{{ asset('storage/news_photo/'.$n->photo) }}" width="100%">
				</a>
				<div class="topBox">
					@foreach($n->categories as $category)
					<span class="label label-default">{{ $category->name }}</span>
					@endforeach
				</div>
				<div class="titleBox">
					<span class="newsTitle">{{ $n->title }}</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection