<!doctype html>
<html lang="en" dir="rtl">
	<head>
	<!-- META DATA -->
	<meta charset="UTF-8">
	<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Flaira - Bootstrap HTML Admin Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="admin dashboard template,admin panel template,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin panel,admin template,bootstrap admin template,dashboard template,	bootstrap admin template,premium admin templates,html admin template,ecommerce dashboard,admin panel template,bootstrap admin theme,bootstrap admin panel">

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

	</head>

	<body class="login-img bg-success" >

	   <!-- GLOBAL-LOADER -->
		<div id="global-loader">
			<img src="{{asset('public/assets/images/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /GLOBAL-LOADER -->

		<!-- PAGE -->
		<div class="page h-100">
		   <!-- PAGE-CONTENT OPEN -->
			<div class="page-content error-page">
				
				<div class="container text-center">
					<div class="">
						<img src="{{asset('public/assets/images/svgs/email.svg')}}" alt="image" class="image" style="width:200px !important">
					</div>

					<div class="error-template">
						<h1 class="display-2 text-white mb-2">Successful</h1>
						<h5 class="error-details text-white">
							Thank You For your Payment!
						</h5>
						<div class="text-center">
							<a class="btn btn-danger mt-5 mb-5" href="https://sarey.co/" style="background:#E30613 !important;border-color:#E30613 !important;"> <i class="fa fa-long-arrow-left"></i> Back to Home </a>
						</div>
                    </div>
				</div>
			</div>
			<!-- PAGE-CONTENT OPEN CLOSED -->
		</div>
		<!-- End PAGE -->

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

	</body>
</html>