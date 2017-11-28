<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="EDII Soscial   Hub" />
		<meta name="keywords" content="Social Network, Social Media, EDII" />
		<meta name="robots" content="index, follow" />
		<title>EDIISH | Social Hub</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/css/style.css" />
		<link rel="stylesheet" href="/css/ionicons.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/wnoo-login.css" />
    <link rel="stylesheet" href="/css/semantic.min.css" />
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="/images/fav.png"/>
	</head>
	<body ng-app="wnoo-redirect">

    <div class="row" ng-controller="RedirectController">
      <input id="token" type="hidden" value="{{ $token }}">
      <input id="appsID" type="hidden" value="{{ $appsID }}">

      <div class="col-xs-12 text-center">
        <div class="ui icon message positive">
          <i class="notched circle loading icon"></i>
          <div class="content">
            <div class="header">
              Just one second
            </div>
            <p>We're redirecting you to an external application.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.appear.min.js"></script>
		<script src="/js/jquery.incremental-counter.js"></script>
    <script src="/js/script.js"></script>

    <!--  Semantic  -->
    <script src="/js/semantic.min.js"></script>

     <!-- Angulars
    ================================================= -->
    <script src="/js/angular.min.js"></script>
    <script src="/js/wnoo-controller-redirect.js"></script>
    
	</body>
</html>
