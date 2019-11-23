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
    <link rel="stylesheet" href="vendors/selectize/dist/css/selectize.default.css" />

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


  <!-- Page Wrapper -->
  <div id="wrapper" class="app">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="layout">
      @include('layouts.sidebar')
       <!-- Page Container START -->
       <div class="page-container">
         <!-- Page Container START -->
         @include('layouts.topBar') 


         @yield('content')


         <!-- Footer START -->
         <footer class="content-footer">
              <div class="footer">
                  <div class="copyright">
                      <span>Con la tecnología de <b class="text-dark"></b>SkySeguros.</span>
                      <span class="go-right">
          
          </span>
                  </div>
              </div>
          </footer>
          <!-- Footer END -->




      </div>
      
      
      

    </div>
    <!-- End of Content Wrapper -->

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
    <script src="vendors/selectize/dist/js/standalone/selectize.min.js"></script>

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
    var user_id = localStorage.getItem('user_id');
    $("#logout").attr("href", "logout/"+user_id)
  </script>


  
  @yield('CustomJs')

  

  

</body>

</html>
