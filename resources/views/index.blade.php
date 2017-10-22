<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="This is social network html5 template available in themeforest......" />
		<meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
		<meta name="robots" content="index, follow" />
		<title>Wis Noo | A Social Network</title>

    <!-- Stylesheets
    ================================================= -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="css/ionicons.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/wnoo-login.css" />
    <link rel="stylesheet" href="css/semantic.min.css" />
    
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    
    <!--Favicon-->
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
	</head>
	<body ng-app="wnoo-login">

    <!-- Header
    ================================================= -->
		<header id="header-inverse">
      <nav class="navbar navbar-default navbar-fixed-top menu">
        <div class="container">

          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <img src="images/logo.png" alt="logo" />
          </div>

        </div><!-- /.container -->
      </nav>
    </header>
    <!--Header End-->
    
    <!-- Landing Page Contents
    ================================================= -->
    <div id="lp-register" ng-controller="LoginController">
    	<div class="container wrapper">
        <div class="row">
        	<div class="col-sm-5">
            <div class="intro-texts">
            	<h1 class="text-white">Make Cool Friends !!!</h1>
            	<p>Wis Noo is a social network that can be used to connect people. This has Landing pages, News Feed, Image/Video Feed, Timeline and lot more. <br /> <br />Why are you waiting for? Register Now.</p>
              <button class="btn btn-primary">Learn More</button>
            </div>
          </div>
        	<div class="col-sm-6 col-sm-offset-1">
            <div class="reg-form-container ui segment">

              <!--  Loader  -->
              <div id="loader" class="ui inverted dimmer">
                <div class="ui text loader">Loading</div>
              </div>
            
              <!-- Register/Login Tabs-->
              <div class="reg-options">
                <ul class="nav nav-tabs">
                  <li><a href="#register" data-toggle="tab">Register</a></li>
                  <li class="active"><a href="#login" data-toggle="tab">Login</a></li>
                </ul><!--Tabs End-->
              </div>
              
              <!--Registration Form Contents-->
              <div class="tab-content">
                <div class="tab-pane" id="register">
                  <h3>Register</h3>
                  <p class="text-muted">Be cool and join today.</p>
                  <div class="ui divider"></div>
                  
                  <!--Register Form-->
                  <form name="registration_form" id='registration_form' ng-submit="register()"  class="form-inline">
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="fullname" class="sr-only">Full Name</label>
                        <input ng-model="regName" id="fullname" class="form-control input-group-lg" type="text" name="fullname" title="Enter full name" placeholder="Full Name"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="email" class="sr-only">Email</label>
                        <input ng-model="regEmail" id="email" class="form-control input-group-lg" type="email" name="Email" title="Enter Email" placeholder="Your Email" required />
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="password" class="sr-only">Password</label>
                        <input ng-model="regPass" id="password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password" required/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="password-confirm" class="sr-only">Confirm Password</label>
                        <input ng-model="regConfirm" id="password-confirm" class="form-control input-group-lg" type="password" name="password_confirmation" title="Confirm password" placeholder="Confirm Password" required/>
                      </div>
                    </div>
                    <div class="row">
                      <p class="sub header"><strong>Gender</strong></p>
                      <div class="form-group gender col-xs-12">
                        <label class="radio-inline">
                          <input ng-model="regGender" type="radio" name="optradio" value="m">Male
                        </label>
                        <label class="radio-inline">
                          <input ng-model="regGender" type="radio" name="optradio" value="f">Female
                        </label>
                      </div>
                    </div> 
                    <div class="row">
                      <p class="sub header"><strong>Date of Birth</strong></p>
                      <div class="form-group col-sm-3 col-xs-6">
                        <label for="month" class="sr-only"></label>
                        <select ng-model="regBirthDate" class="form-control" id="day">
                          <option value="Day" disabled selected>Day</option>
                          <option ng-repeat="date in dates" value="@{{date}}">@{{ date }}</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-6 col-xs-12">
                        <label for="month" class="sr-only"></label>
                        <select ng-model="regBirthMonth" class="form-control" id="month">
                          <option value="month" disabled selected>Month</option>
                          <option ng-repeat="month in months" value="@{{month}}">@{{ month }}</option>
                        </select>
                      </div>
                      <div class="form-group col-sm-3 col-xs-6">
                        <label for="year" class="sr-only"></label>
                        <select ng-model="regBirthYear" class="form-control" id="year">
                          <option value="year" disabled selected>Year</option>
                          <option ng-repeat="year in years()" value="@{{year}}">@{{ year }}</option>
                        </select>
                      </div>
                    </div>

                    <div ng-show="registerError" class="ui negative message">@{{ registerErrorMessage }}</div>
                    <button type="submit" class="btn btn-primary" hidefocus="hidefocus">Register</button>
                  </form><!--Register Now Form Ends-->
                </div><!--Registration Form Contents Ends-->
                
                <!--Login-->
                <div class="tab-pane active" id="login">
                  <h3>Login</h3>
                  <p class="text-muted">Log into your account</p>
                  
                  <!--Login Form-->
                  <form name="Login_form" id='Login_form' ng-submit="login()">
                     <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-email" class="sr-only">Email</label>
                        <input ng-model="logEmail" id="my-email" class="form-control input-group-lg" type="text" name="Email" title="Enter Email" placeholder="Your Email"/>
                      </div>
                    </div>
                    <div class="row">
                      <div class="form-group col-xs-12">
                        <label for="my-password" class="sr-only">Password</label>
                        <input ng-model="logPass" id="my-password" class="form-control input-group-lg" type="password" name="password" title="Enter password" placeholder="Password"/>
                      </div>
                    </div>

                    <div ng-show="loginError" class="ui negative message">Invalid email or password</div>
                    <button type="submit" class="btn btn-primary" hidefocus="hidefocus">Login</button>
                  </form><!--Login Form Ends-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--preloader-->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!-- Scripts
    ================================================= -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.appear.min.js"></script>
		<script src="js/jquery.incremental-counter.js"></script>
    <script src="js/script.js"></script>

    <!--  Semantic  -->
    <script src="js/semantic.min.js"></script>

     <!-- Angulars
    ================================================= -->
    <script src="js/angular.min.js"></script>
    <script src="js/wnoo-controller-login.js"></script>
    
	</body>
</html>
