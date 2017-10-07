<!DOCTYPE html>
<html lang="en">
<head>
	@include('partials._head')
</head>
<body>
@include('partials._navbar')
@include('partials._messages')

@yield('content')

@include('partials._js')
</body>
</html>