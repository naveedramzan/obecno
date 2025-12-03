<!DOCTYPE html>
<html lang="en">
	<head>
   		@include('partials.company-admin.head')
 	</head>
 	<body>
		@include('partials.company-admin.top-bar')
		
		@yield('content')
		
		@include('partials.company-admin.footer')
	</body>
</html>