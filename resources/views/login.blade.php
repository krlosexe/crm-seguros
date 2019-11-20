		
	<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>App</title>

  <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="vendors/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />


    <!-- page plugins css -->
    <link rel="stylesheet" href="vendors/selectize/dist/css/selectize.default.css" />
    <link rel="stylesheet" href="vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="vendors/nvd3/build/nv.d3.min.css" />

    <!-- page plugins css -->
    <link rel="stylesheet" href="vendors/datatables/media/css/jquery.dataTables.css" />


    <link href="vendors/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="vendors/bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>

    <link href="vendors/sweetalert/sweetalert.css" rel="stylesheet">


    <!-- core css -->
    <link href="css/ei-icon.css" rel="stylesheet">
    <link href="css/themify-icons.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">


    <script src=" vendors/jquery/dist/jquery.min.js"></script>

   @yield('CustomCss')
  
  @if(Request::path() != '/')

    <script>
      $(document).ready(function(){

        var url = $(location).attr('href').split("/").splice(-1);
         validAuth(false, url[0]);
      });
    </script>

  @endif

</head>

<body class="{{ Request::path() != '/' ? 'dasboard-body' : ''}} bg-gradient-primary">
  <div id="page-loader"  ><span class="preloader-interior"></span></div>
		<div class="app">
			<div class="authentication">
				<div class="sign-in">
					<div class="row no-mrg-horizon">
						<div class="col-md-8 no-pdd-horizon d-none d-md-block">
							<div class="full-height bg" style="background-image: url('images/others/img-29.jpg')">
								<div class="img-caption">
									<h1 class="caption-title">We make spectacular</h1>
									<p class="caption-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
								</div>
							</div>
						</div>
						<div class="col-md-4 no-pdd-horizon">
							<div class="full-height bg-white height-100">
								<div class="vertical-align full-height pdd-horizon-70">
									<div class="table-cell">
										<div class="pdd-horizon-15">
											<h2>Iniciar sesión</h2>
											<p class="mrg-btm-15 font-size-13">Por favor, ingrese su nombre de usuario y contraseña para iniciar sesión</p>
											<form class="user" id="login" method="post" action="">
												@csrf
												<div class="form-group">
													<input type="email" name="email" class="form-control" placeholder="User name">
												</div>
												<div class="form-group">
													<input type="password" name="password" class="form-control" placeholder="Password">
												</div>
												<div class="checkbox font-size-12">
													<input id="agreement" name="agreement" type="checkbox">
													<label for="agreement">Mantener Sesión</label>
												</div>
												<input type="hidden" id="ruta" value="<?= url('/') ?>">
												<button type="submit" class="btn btn-info">Login</button>
											</form>
										</div>
									</div>
								</div>
								<div class="login-footer">
									<img class="img-responsive inline-block" src="assets/images/logo/logo.png" width="100" alt="">
									<span class="font-size-13 pull-right pdd-top-10">Don't have an account? <a href="">Sign Up Now</a></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	

		<input type="hidden" id="ruta" value="<?= url('/') ?>">
 

 <!-- build:js assets/js/vendor.js -->
	 <!-- plugins js -->
	 
	 <script src=" vendors/popper.js/dist/umd/popper.min.js"></script>
	 <script src=" vendors/bootstrap/dist/js/bootstrap.js"></script>
	 <script src=" vendors/PACE/pace.min.js"></script>
	 <script src=" vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
	 <!-- endbuild -->
 
 
	   <!-- page plugins js -->
	   <script src="vendors/bower-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	   <script src="js/maps/jquery-jvectormap-us-aea.js"></script>
	   <script src="vendors/d3/d3.min.js"></script>
	   <script src="vendors/nvd3/build/nv.d3.min.js"></script>
	   <script src="vendors/jquery.sparkline/index.js"></script>
	   <script src="vendors/chart.js/dist/Chart.min.js"></script>
	   <script src="vendors/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
	   <script src="vendors/selectize/dist/js/standalone/selectize.min.js"></script>
 
		   <!-- page plugins js -->
	 <script src="vendors/datatables/media/js/jquery.dataTables.js"></script>
 
 
	 
	 
	 <script src="vendors/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
	 <script src="vendors/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
	 <script src="vendors/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
	 <script src="vendors/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
	 <script src="vendors/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
	 <script src="vendors/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
	 <script src="vendors/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>
 
	 <script src="vendors/sweetalert/sweetalert.min.js" type="text/javascript"></script>
	 <script src="vendors/sweetalert/sweetalert-dev.js" type="text/javascript"></script>
 
 
 <!-- page js -->
 
	 <!-- build:js   js/app.min.js -->
	 <!-- core js -->
	 <script src=" js/app.js"></script>
	 <!-- endbuild -->
 
 
	 <!-- page js -->
	 <script src="js/dashboard/dashboard.js"></script>
	 <script src="js/funciones.js"></script>
 
	 <script src="js/table/data-table.js"></script>


		<script>
			$(document).ready(function(){
				validAuth(true);
				login();
			});

			function login(){
				enviarFormulario("#login", 'auth', '#cuadro2', true);
			}


		</script>

