<!DOCTYPE html>
<html lang="en">
	<head>
   		@include('partials.head')
 	</head>
 	<body>
		@include('partials.top-bar')
		<div class="content-body">
			@yield('content')
		</div>
		@include('partials.footer')
	</body>
</html>