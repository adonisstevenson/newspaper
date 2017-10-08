@extends('main')
@section('title', 'Newspaper - Create News')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
		<h1>Create news</h1>
			{!! Form::open(['route' => 'news.store', 'files'=>true]) !!}
				{{ Form::label('News title', '') }}
				{{ Form::text('title', '', ['class'=>'form-control']) }}

				{{ Form::label('Content', '') }}
				{{ Form::textarea('body', '', ['class'=>'form-control']) }}

				{{ Form::label('Categories', '') }}
				<select multiple class="form-control" name="categories[]">
				  @foreach($categories as $category)
				  	<option value="{{ $category->id }}">{{ $category->name }}</option>
				  @endforeach
				</select>

				{{ Form::label('Photo', '') }}
				{{ Form::file('photo', []) }}

				{{ Form::submit('Create News', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection