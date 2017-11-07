<!DOCTYPE html>
<html lang="en">
	<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Description" />
		<meta name="keywords" content="Social Network, Social Media, EDII" />
		<meta name="robots" content="index, follow" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{--  Title  --}}
		<title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="/css/bootstrap.min.css" />
		<link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/ionicons.min.css" />
    <link rel="stylesheet" href="/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/css/semantic.min.css" />
    <link rel="stylesheet" href="/css/emoji.css">
    <link rel="stylesheet" href="/css/wnoo-feed.css">
    <link rel="stylesheet" href="/css/wnoo-timeline.css">

    <!-- Angular Material -->
    <link rel="stylesheet" href="/css/angular-material.min.css">
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="/images/fav.png"/>
	</head>
  <body ng-app="wnoo">

    <!-- Header
    ================================================= -->
		<header id="header">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img style="max-height: 30px; max-width: 168px;" src="/images/logo.png" alt="logo" /></a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            {{--  <form class="navbar-form navbar-right hidden-sm">
              <div class="form-group">
                <i class="icon ion-android-search"></i>
                <input type="text" class="form-control" placeholder="Search people">
              </div>
            </form>  --}}
            <ul class="nav navbar-nav navbar-right main-menu">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="sidebar icon"></i></a>
                <ul class="dropdown-menu newsfeed-home">
                  <li><a href="/feed">Feed</a></li>
                  <li><a href="/timeline/{{ $user->id }}">My Timeline</a></li>
                  <li>
                    <a href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                    </form>
                  </li>
                </ul>
              </li>
            </ul>
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->

    <div id="wnoo-contents">
    	@yield('content')
    </div>
    
    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>
    
    <!-- Scripts
    ================================================= -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.sticky-kit.min.js"></script>
    <script src="/js/jquery.scrollbar.min.js"></script>
    <script src="/js/script.js"></script>
    {{--  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTMXfmDn0VlqWIyoOxK8997L-amWbUPiQ&callback=initMap"></script>  --}}
  

    <!--  Semantic  -->
    <script src="/js/semantic.min.js"></script>

     <!-- Angulars
    ================================================= -->
    <script src="/js/angular.min.js"></script>

    <!--  Infinite Scroll  -->
    <script src="/js/ng-infinite-scroll.min.js"></script>

    <!--  Angular Modules  -->
    <script src="/js/wnoo-app.js"></script>
    <script src="/js/ng-file-upload.min.js"></script>
    <script src="/js/wnoo-factory-post.js"></script>
    <script src="/js/wnoo-factory-media.js"></script>
    <script src="/js/wnoo-factory-comment.js"></script>
    <script src="/js/wnoo-factory-like.js"></script>
    @yield('script')
    
  </body>
</html>
