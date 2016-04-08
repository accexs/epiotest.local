<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Epiotest</title>
	<!--bootstrap styles-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<!--font awesome-->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
	<!--datepicker for bootsrap-->
	<link rel="stylesheet" href="/css/bootstrap-datepicker3.min.css">
	<!--loading bar-->
	<link rel="stylesheet" type="text/css" href="css/loading-bar.css">
</head>
<body ng-app="epioTest" ng-controller="userController">
<div  ng-controller="userController">
	
</div>
	<nav class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<div class="collapse navbar-collapse" id="app-navbar-collapse">
				<!--left side-->
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}" title="">Home</a></li>
				</ul>

				<!--right side-->
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="#" ng-click="modalUser('login')">Login</a></li>
						<li><a href="#" ng-click="modalUser('register')">Register</a></li>
					@else
						<li class="dropdown">
						    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
						        {{ Auth::user()->name }} <span class="caret"></span>
						    </a>

						    <ul class="dropdown-menu" role="menu">
						        <li><a href="#" ng-click="logout()"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
						    </ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	
	@yield('content')

	<!-- JavaScripts -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<!--AngularJS-->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.0/angular.min.js"></script>
	<script src="js/app.js"></script>
	<!-- all angular resources will be loaded from the /public folder -->
	<script src="js/ng-file-upload.js"></script>
    <script src="js/tinymce.js"></script>
    <script src="js/loading-bar.js"></script>
    <script src="js/controllers/userCtrl.js"></script>
    <script src="js/services/userService.js"></script>
    <script src="js/controllers/recipeCtrl.js"></script>
    <script src="js/services/recipeService.js"></script>

    @yield('scripts')

    

    
</body>
</html>