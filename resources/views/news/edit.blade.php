@extends('main')
@section('title', 'Newspaper - Create News')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
		<h1>Edit news</h1>
			{!! Form::model($news, ['route' => ['news.update', $news->id], 'method' => 'PUT', 'files'=>true]) !!}
				{{ Form::label('News title', '') }}
				{{ Form::text('title', null, ['class'=>'form-control']) }}

				{{ Form::label('Content', '') }}
				{{ Form::textarea('body', null, ['class'=>'form-control']) }}

				{{ Form::label('Categories', 'Categories:', ['class' => 'form-spacing-top']) }}
				{{ Form::select('categories[]', $cats, $news->categories, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}

				{{ Form::label('Photo - select new if you want to replace old one', '') }}
				{{ Form::file('photo', []) }}


				{{ Form::submit('Update', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection