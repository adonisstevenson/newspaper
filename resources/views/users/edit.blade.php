@extends('main')
@section('title', 'Newspaper - edit profile')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<h1>Edit profile</h1>
			{!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'files'=>true, 'class'=>'form-group']) !!}

				<img src="{{ asset('storage/'.$user->photo) }}" width="120px"><br>
				{{ Form::label('Change profile photo', '') }}
				{{ Form::file('photo', []) }}

				{{ Form::label('Name', '') }}
				{{ Form::text('name', null, ['class'=>'form-control']) }}

				{{ Form::label('Email', '') }}
				{{ Form::email('email', null, ['class'=>'form-control']) }}

				{{ Form::submit('Update', array('class' => 'btn btn-success', 'style' => 'margin-top: 20px;')) }}

			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection