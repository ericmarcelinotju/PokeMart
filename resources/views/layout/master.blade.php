<!DOCTYPE html>
<html>
<head>
	@include('layout.meta')
	<title>PokeMart - @yield('title')</title>
	@include('layout.head')
</head>
<body>
	@include('layout.header')
	<section>
		@yield('content')
	</section>
	@include('layout.footer')
</body>
@include('layout.script')
</html>