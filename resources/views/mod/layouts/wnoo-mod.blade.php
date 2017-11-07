<!DOCTYPE html>
<html lang="en">
	<head>
		<title>EDIISH - CMS</title>

		<!-- BEGIN META -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="keywords" content="your,keywords">
		<meta name="description" content="Short explanation about this website">
		<!-- END META -->

		<!-- BEGIN STYLESHEETS -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/bootstrap.css?1422792965" />
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/materialadmin.css?1425466319" />
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/font-awesome.min.css?1422529194" />
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/material-design-iconic-font.min.css?1421434286" />
    <link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/libs/DataTables/jquery.dataTables.css?1423553989" />
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/libs/DataTables/extensions/dataTables.colVis.css?1423553990" />
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/libs/rickshaw/rickshaw.css?1422792967" />
		<link type="text/css" rel="stylesheet" href="../cms_assets/css/theme-default/libs/morris/morris.core.css?1420463396" />
		<!-- END STYLESHEETS -->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script type="text/javascript" src="../cms_assets/js/libs/utils/html5shiv.js?1403934957"></script>
		<script type="text/javascript" src="../cms_assets/js/libs/utils/respond.min.js?1403934956"></script>
		<![endif]-->
	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN HEADER-->
		<header id="header" >
			<div class="headerbar">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="headerbar-left">
					<ul class="header-nav header-nav-options">
						<li class="header-nav-brand" >
							<div class="brand-holder">
								<a href="mod/dashboard">
									<span class="text-lg text-bold text-primary">EDIISH CMS</span>
								</a>
							</div>
						</li>
						<li>
							<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
								<i class="fa fa-bars"></i>
							</a>
						</li>
					</ul>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="headerbar-right">
					{{--  <ul class="header-nav header-nav-options">
						<li class="dropdown hidden-xs">
							<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
								<i class="fa fa-bell"></i><sup class="badge style-danger">!</sup>
							</a>
							<ul class="dropdown-menu animation-expand">
								<li class="dropdown-header">Today's messages</li>
								<li>
									<a class="alert alert-callout alert-warning" href="javascript:void(0);">
										<img class="pull-right img-circle dropdown-avatar" src="../cms_assets/img/avatar2.jpg?1404026449" alt="" />
										<strong>21 Users</strong><br/>
										<small>Waiting your approval..</small>
									</a>
								</li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-options -->  --}}
					<ul class="header-nav header-nav-profile">
						<li class="dropdown">
							<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
								<img src="../cms_assets/img/avatar1.jpg?1403934956" alt="" />
								<span class="profile-info">
									John Doe
									<small>Administrator</small>
								</span>
							</a>
							<ul class="dropdown-menu animation-dock">
								<li class="dropdown-header">Config</li>
								<li><a href="#">My profile</a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
							</ul><!--end .dropdown-menu -->
						</li><!--end .dropdown -->
					</ul><!--end .header-nav-profile -->
				</div><!--end #header-navbar-collapse -->
			</div>
		</header>
		<!-- END HEADER-->

    <div class="content-wrapper">
      @yield('content')

      <!-- BEGIN MENUBAR-->
      <div id="menubar" class="menubar-inverse ">
        <div class="menubar-scroll-panel">

          <!-- BEGIN MAIN MENU -->
          <ul id="main-menu" class="gui-controls">

            <!-- BEGIN DASHBOARD -->
            <li>
              <a href="/mod/dashboard">
                <div class="gui-icon"><i class="md md-home"></i></div>
                <span class="title">Dashboard</span>
              </a>
            </li><!--end /menu-li -->
            <!-- END DASHBOARD -->

						<!-- BEGIN FORMS -->
            <li class="gui-folder">
              <a>
                <div class="gui-icon"><span class="glyphicon glyphicon-user"></span></div>
                <span class="title">User Management</span>
              </a>
              <!--start submenu -->
              <ul>
                <li><a href="/mod/shuser" ><span class="title">Social Hub User</span></a></li>
                <li><a href="/mod/cmsuser" ><span class="title">CMS User</span></a></li>
              </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END FORMS -->

            <!-- BEGIN FORMS -->
            <li class="gui-folder">
              <a>
                <div class="gui-icon"><span class="glyphicon glyphicon-list-alt"></span></div>
                <span class="title">Application Management</span>
              </a>
              <!--start submenu -->
              <ul>
                <li><a href="/mod/apps" ><span class="title">Internal Apps</span></a></li>
              </ul><!--end /submenu -->
            </li><!--end /menu-li -->
            <!-- END FORMS -->

          </ul><!--end .main-menu -->
          <!-- END MAIN MENU -->

        </div><!--end .menubar-scroll-panel-->
      </div><!--end #menubar-->
      <!-- END MENUBAR -->

    </div><!--end #base-->
    <!-- END BASE -->
    </div>

		<!-- BEGIN MODAL -->
		@yield('modal');
		<!-- END MODAL -->

		<!-- BEGIN JAVASCRIPT -->
		<script src="../cms_assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
		<script src="../cms_assets/js/libs/jquery/jquery-migrate-1.2.1.min.js"></script>
		<script src="../cms_assets/js/libs/bootstrap/bootstrap.min.js"></script>
		<script src="../cms_assets/js/libs/spin.js/spin.min.js"></script>
		<script src="../cms_assets/js/libs/autosize/jquery.autosize.min.js"></script>
		<script src="../cms_assets/js/libs/moment/moment.min.js"></script>
		<script src="../cms_assets/js/core/source/App.js"></script>
		<script src="../cms_assets/js/core/source/AppNavigation.js"></script>
		<script src="../cms_assets/js/core/source/AppOffcanvas.js"></script>
		<script src="../cms_assets/js/core/source/AppCard.js"></script>
		<script src="../cms_assets/js/core/source/AppForm.js"></script>
		<script src="../cms_assets/js/core/source/AppNavSearch.js"></script>
		<script src="../cms_assets/js/core/source/AppVendor.js"></script>
    @yield('script')
		<!-- END JAVASCRIPT -->

	</body>
</html>
