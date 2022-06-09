
<!doctype html>
<html lang="en" dir="ltr">
	<head>

		<!-- META DATA -->
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Sarey.co">
		<meta name="author" content="sarey.co">
		<meta name="keywords" content="software,company,developement,software developement,sarey solution,sarey.co">

		<!-- FAVICON -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/images/brand/favi.png')}}" />

		<!-- TITLE -->
		<title>Sarey.co - Dashboard</title>

		<!-- BOOTSTRAP CSS -->
		<link href="{{asset('public/assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" />

		<!-- STYLE CSS -->
		<link href="{{asset('public/assets/css/style.css')}}" rel="stylesheet"/>
		<link href="{{asset('public/assets/css/skin-modes.css')}}" rel="stylesheet"/>

		<!-- SIDE-MENU CSS -->
		<link href="{{asset('public/assets/css/sidemenu.css')}}" rel="stylesheet">

	
		<!--- FONT-ICONS CSS -->
		<link href="{{asset('public/assets/css/icons.css')}}" rel="stylesheet"/>

		<!-- COLOR SKIN CSS -->
		<link id="theme" rel="stylesheet" type="text/css" media="all" href="{{asset('public/assets/colors/color1.css')}}" />
		

		{{-- sidebar code  --}}
		<style>
			.app-sidebar .slide-menu .slide-item:hover, .app-sidebar .side-menu__item:hover{
				background:#fd4967  !important;
			}
			
			.app-sidebar .slide-menu .slide-item:hover, .app-sidebar .side-menu__item:hover .side-menu__icon {
				color:white !important;
			}

			.app-sidebar .slide-menu .slide-item:hover, .app-sidebar .side-menu__item:hover .side-menu__label {
				color:white !important;
			}
			
			.app-sidebar .side-menu__item.active{
				background:#fd4967  !important;
				color:white !important
			}
			.app-sidebar .side-menu__item.active{
				background:#fd4967  !important;
			}
			.side-menu__item.active .side-menu__icon{
				color:white !important;
			}
			.side-menu__item.active .side-menu__label{
				color:white !important;
				
			}
		</style>


		@yield('css')
	</head>
	<body class="app sidebar-mini Left-menu-Default  Sidemenu-left-icons">

		<!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('public/assets/images/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page">
			<div class="page-main">

				<!--APP-SIDEBAR-->
				<div class="app-header header-search-icon">
					<div class="header-style1">
						<a class="header-brand" href="{{url('/')}}">
							<img src="{{asset('public/assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo" style="width: 130px">
							<img src="{{asset('public/assets/images/brand/logo-1.png')}}" class="header-brand-img mobile-logo" alt="logo">
						</a><!-- LOGO -->
					</div>
					<div class="app-sidebar__toggle" data-toggle="sidebar">
						<a class="open-toggle" href="#"><i class="fe fe-align-left"></i></a>
						<a class="close-toggle" href="#"><i class="fe fe-x"></i></a>
					</div>
					<div class="d-flex  ml-auto header-right-icons">
						<div class="dropdown d-md-flex">
							<a class="nav-link icon full-screen-link nav-link-bg">
								<i class="fe fe-minimize fullscreen-button"></i>
							</a>
						</div><!-- FULL-SCREEN -->
						 <div class="dropdown d-md-flex notifications">
							<a class="nav-link icon" data-toggle="dropdown">
								<i class="fe fe-bell"></i>
								
								@php
									$count_unread=DB::table('notifications')->Where('status','noview')->count();
								@endphp
								@if ($count_unread!=0)
									<span class="nav-unread badge badge-success badge-pill d-flex" >
										{{$count_unread}}
									</span>
								@endif
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<a href="#" class="dropdown-item text-center">Notifications</a>
								@php
									$noti=DB::table('notifications')->Where('status','noview')->orderby('created_at','desc')->limit(3)->get();
									$note_count=0;
								@endphp
								
								<div class="dropdown-divider"></div>
								<div class="notifications-menu">
									@foreach ($noti as $item)
										<a class="dropdown-item d-flex pb-3" href="{{url('notifications')}}">
											<div>
												<small>
													@php
														$disc=$item->description;
														$disc=substr($disc,0,40);
														echo $disc . ' ...';
													@endphp
												</small>
												<div class="small text-muted">
													@php
														$date=date_create($item->created_at);
														echo date_format($date,"h:i:s a");
														$note_count=1;
													@endphp
												</div>
											</div>
										</a>
									@endforeach
								</div>
								@if ($note_count==1)
									<div class="dropdown-divider"></div>
								@endif
								
								<a href="{{url('notifications')}}" class="dropdown-item text-center">View all Notification</a>
							</div>
						</div><!-- NOTIFICATIONS --> 

					
						<div class="dropdown profile-1">
							<a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
								<span>
									@if (empty(Auth()->user()->profile_photo_path))
										<img src="{{asset('public/assets/images/users/user-1.png')}}" alt="profile-user" class="avatar  profile-user brround cover-image">
									@else
										<img src="{{asset('storage/app')}}/{{Auth()->user()->profile_photo_path}}" alt="profile-user" class="avatar  profile-user brround cover-image">
									@endif
									
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
								<div class="drop-heading">
									<div class="text-center">
										<h5 class="text-dark mb-0">
											{{Auth()->user()->name}}
										</h5>
										<small class="text-muted">
											{{Auth()->user()->role}}
										</small>
									</div>
								</div>
								<div class="dropdown-divider m-0"></div>
								<a class="dropdown-item" href="{{url('profile')}}">
									<i class="dropdown-icon mdi mdi-account-outline"></i> Profile
								</a>
							
								
								<div class="dropdown-divider mt-0"></div>
					
								<form action="{{url('logout')}}" method="POST">
									@csrf
									<button class="dropdown-item"  type="submit">
										<i class="dropdown-icon mdi  mdi-logout-variant"></i> Log out
									</button>
								</form>
							</div>
						</div>
	
					</div>
				</div>
				<!--APP-SIDEBAR-->

				<!--APP-SIDEBAR-->
				<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
				<aside class="app-sidebar">
			
					@if (Auth()->user()->role!="user")
						<ul class="side-menu">
							<li><h3>Menu</h3></li>
							<li>
								<a class="side-menu__item" href="{{url('/')}}">
								<span class="side-menu__label">Dashboard</span><i class="side-menu__icon icon icon-home"></i></a>
							</li>
							<li>
								<a class="side-menu__item" href="{{url('clients')}}">
								<span class="side-menu__label">Clients</span><i class="side-menu__icon icon icon-badge"></i></a>
							</li>
							<li>
								<a class="side-menu__item " href="{{url('projects')}}">
								<span class="side-menu__label">Projects</span><i class="side-menu__icon icon icon-layers"></i></a>
							</li>
							<li>
								<a class="side-menu__item " href="{{url('incomes')}}">
								<span class="side-menu__label">Incomes</span><i class="side-menu__icon icon icon-credit-card"></i></a>
							</li>
							<li><h3>Settings</h3></li>
							@if (Auth()->user()->role=="Admin")
								<li>
									<a class="side-menu__item" href="{{url('users')}}">
									<span class="side-menu__label">Users</span><i class="side-menu__icon icon icon-people"></i></a>
								</li>
							@endif
						
							<li>
								<a class="side-menu__item " href="{{url('profile')}}">
								<span class="side-menu__label">Profile</span><i class="side-menu__icon icon icon-user"></i></a>
							</li>
						</ul>
					@endif
				</aside>
				<!--/APP-SIDEBAR-->

				<!-- Mobile Header -->
				<div class="mobile-header">
					<div class="container-fluid">
						<div class="d-flex">
							<div class="app-sidebar__toggle" data-toggle="sidebar">
								<a class="open-toggle" href="#"><i class="fe fe-align-left"></i></a>
								<a class="close-toggle" href="#"><i class="fe fe-x"></i></a>
							</div>
							<a class="header-brand" href="index.html">
								<img src="{{asset('public/assets/images/brand/logo.png')}}" class="header-brand-img desktop-logo" alt="logo">
							</a>
							<a class="header-brand header-brand1" href="index.html">
								<img src="{{asset('public/assets/images/brand/logo-white.png')}}" class="header-brand-img desktop-logo" alt="logo">
							</a><!-- LOGO -->
							<div class="d-flex order-lg-2 ml-auto header-right-icons">
								<button class="navbar-toggler navresponsive-toggler d-md-none" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
									aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon fe fe-more-vertical text-white"></span>
								</button>
								<div class="dropdown profile-1">
									<a href="#" data-toggle="dropdown" class="nav-link pr-2 leading-none d-flex">
										<span>
											<img src="{{asset('public/assets/images/users/15.jpg')}}" alt="profile-user" class="avatar  profile-user brround cover-image">
										</span>
									</a>
									<div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
										<div class="drop-heading">
											<div class="text-center">
												<h5 class="text-dark mb-0">Devid Antoni</h5>
												<small class="text-muted">Administrator</small>
											</div>
										</div>
										<div class="dropdown-divider m-0"></div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-account-outline"></i> Profile
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon  mdi mdi-settings"></i> Settings
										</a>
										<a class="dropdown-item" href="#">
											<span class="float-right"></span>
											<i class="dropdown-icon mdi  mdi-message-outline"></i> Inbox
										</a>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-comment-check-outline"></i> Message
										</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">
											<i class="dropdown-icon mdi mdi-compass-outline"></i> Need help?
										</a>
										<a class="dropdown-item" href="login.html">
											<i class="dropdown-icon mdi  mdi-logout-variant"></i> Sign out
										</a>
									</div>
								</div>
								<div class="dropdown d-md-flex header-settings">
									<a href="#" class="nav-link icon " data-toggle="sidebar-right" data-target=".sidebar-right">
										<i class="fe fe-align-right"></i>
									</a>
								</div><!-- SIDE-MENU -->
							</div>
						</div>
					</div>
				</div>
				<div class="mb-1 navbar navbar-expand-lg  responsive-navbar navbar-dark d-md-none bg-white">
					<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
						<div class="d-flex order-lg-2 ml-auto">
							<div class="d-sm-flex">
								<a href="#" class="nav-link icon search-btn">
									<i class="fe fe-search"></i>
								</a>
								<div class="search-area">
									<div class="close-btn pull-right"><button class="btn"><i class="fe fe-x"></i></button></div>
									<form>
										<div class="row">
											<div class="input-group form-btn">
												<div class="input-group-append">
													<button class="btn" type="button"><i class="fa fa-search"></i></button>
												</div>
												<input type="text" class="form-control" placeholder="Search here..." aria-label="Recipient's username" aria-describedby="button-addon2">
											</div>
										</div>
									</form>
								</div>
							</div><!-- SEARCH -->
							<div class="dropdown d-md-flex">
								<a class="nav-link icon full-screen-link nav-link-bg">
									<i class="fe fe-maximize fullscreen-button"></i>
								</a>
							</div><!-- FULL-SCREEN -->
							<div class="dropdown d-md-flex notifications">
								<a class="nav-link icon" data-toggle="dropdown">
									<i class="fe fe-bell"></i>
								</a>
							
							</div><!-- NOTIFICATIONS -->
							<div class="dropdown d-md-flex message">
								<a class="nav-link icon text-center" data-toggle="dropdown">
									<i class="fe fe-mail"></i>
								</a>
						
							</div><!-- MESSAGE-BOX -->
						</div>
					</div>
				</div>
				<!-- /Mobile Header -->

                <!--app-content open-->
				<div class="app-content">
					<div class="side-app">

						<!-- PAGE-HEADER -->
						<div class="page-header">
							<ol class="breadcrumb"><!-- breadcrumb -->
								<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
								@yield('directory')
							</ol><!-- End breadcrumb -->
					
						</div>
						<!-- PAGE-HEADER END -->

						<!-- ROW-1 OPEN -->
						<div>@yield('content')</div>
					</div>
					<!-- CONTAINER CLOSED -->
				</div>
			</div>

			<!-- SIDE-BAR CLOSED -->

			<!-- FOOTER -->
			<footer class="footer">
				<div class="container">
					<div class="row align-items-center flex-row-reverse">
						<div class="col-md-12 col-sm-12 text-center">
							Copyright © @php echo date('Y') @endphp . Designed by <a href="https://sarey.co/"> Sarey.co </a> All rights reserved.
						</div>
					</div>
				</div>
			</footer>
			<!-- FOOTER CLOSED -->
		</div>

		<!-- BACK-TO-TOP -->
		<a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

		<!-- JQUERY JS -->
		<script src="{{asset('public/assets/js/jquery-3.4.1.min.js')}}"></script>
		<!-- BOOTSTRAP JS -->
		<script src="{{asset('public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
		<script src="{{asset('public/assets/plugins/bootstrap/js/popper.min.js')}}"></script>
		<!-- SPARKLINE JS-->
		<script src="{{asset('public/assets/js/jquery.sparkline.min.js')}}"></script>
		<!-- Moment js-->
		<script src="{{asset('public/assets/plugins/moment/moment.min.js')}}"></script>
		<!-- CHART-CIRCLE JS-->
		<script src="{{asset('public/assets/js/circle-progress.min.js')}}"></script>
		<!-- SIDE-MENU JS-->
		<script src="{{asset('public/assets/plugins/sidemenu/sidemenu.js')}}"></script>
		<script src="{{asset('public/assets/plugins/sidebar/sidebar.js')}}"></script>
		<!-- CUSTOM JS -->
		<script src="{{asset('public/assets/js/custom.js')}}"></script>
		@yield('jquery')

	</body>
</html>