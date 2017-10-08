@extends('main')
@section('title', 'Newspaper - Home')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<div class="newsBox">
				<a href="{{ route('news.show', $newsMain->id) }}">
					<img src="{{ asset('storage/news_photo/'.$newsMain->photo) }}" width="100%">
				</a>
				<div class="topBox">
					@foreach($newsMain->categories as $category)
					<span class="label label-default">{{ $category->name }}</span>
					@endforeach
				</div>
				<div class="titleBox">
					<span class="newsTitle">{{ $newsMain->title }}</span>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		@foreach($news as $n)
		<div class="col-md-4">
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
					<span class="newsTitle newsSmall">{{ $n->title }}</span>
				</div>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection