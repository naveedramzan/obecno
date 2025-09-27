<!DOCTYPE html>
<html lang="en">
	<head>
   		@include('partials.admin.head')
 	</head>
 	<body>
		@include('partials.admin.header')
		
		@yield('content')
		
		@include('partials.admin.footer')
		@include('partials.admin.footer-scripts')
	</body>
</html>