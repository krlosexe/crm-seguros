<!DOCTYPE html>
<html lang="es">

<head>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <link rel="shortcut icon" href="https://chseguros.com.co/wp-content/uploads/2020/01/cropped-Captura-de-pantalla-2020-01-16-a-las-4.11.15-p.-m.-32x32.png">

  <title>App</title>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

  <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/bootstrap/dist/css/bootstrap.css" />
    <!-- <link rel="stylesheet" href="<?= url('/') ?>/vendors/PACE/themes/blue/pace-theme-minimal.css" /> -->
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/selectize/dist/css/selectize.default.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/vectorMap/jquery-jvectormap-2.0.5.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/nvd3/build/nv.d3.min.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/datatables/media/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/fullcalendar_old/dist/fullcalendar.min.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
        <link href="<?= url('/') ?>/vendors/select2/select2.min.css" rel="stylesheet">
        <link href="<?= url('/') ?>/vendors/select2/select2-bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/multiple-select/css/bootstrap-multiselect.css" />
    <!-- page plugins css -->
    <!-- <link rel="stylesheet" href="<?= url('/') ?>/vendors/dragula-master/dist/dragula.min.css" /> -->

    <link href="<?= url('/') ?>/vendors/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?= url('/') ?>/vendors/bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?= url('/') ?>/vendors/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/selectize/dist/css/selectize.default.css" />
    <link href="<?= url('/') ?>/css/ei-icon.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/themify-icons.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/animate.min.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/app.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/custom.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">

    <script src="<?= url('/') ?>/vendors/jquery/dist/jquery.min.js"></script>

   @yield('CustomCss')

      @php
        $validarUrl = true
      @endphp

   @isset ($__env->getSections()['validarUrl'])
      @php
         $validarUrl = false
      @endphp
   @endisset


   @if(Request::path() != '/' && $validarUrl)

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

  <div id="wrapper" class="app">
    <div id="content-wrapper" class="layout">
      @include('layouts.sidebar')
       <div class="page-container">
         @include('layouts.topBar') 


         @yield('content')


         <!-- Footer START -->
        
          <!-- Footer END -->




      </div>
    </div>
    <!-- End of Content Wrapper -->

  </div>
<input type="hidden" id="ruta" value="<?= url('/') ?>">
<script src="<?= url('/') ?>/js/app.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
      <script src="<?= url('/') ?>/vendors/popper.js/dist/umd/popper.min.js"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap/dist/js/bootstrap.js"></script>
      <script src="<?= url('/') ?>/vendors/PACE/pace.min.js"></script>
      <script src="<?= url('/') ?>/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
      <script src="<?= url('/') ?>/vendors/vectorMap/jquery-jvectormap-2.0.5.min.js"></script>
      <script src="<?= url('/') ?>/js/maps/jquery-jvectormap-us-aea.js"></script>
      <script src="<?= url('/') ?>/vendors/d3/d3.min.js"></script>
      <script src="<?= url('/') ?>/vendors/nvd3/build/nv.d3.min.js"></script>
      <script src="<?= url('/') ?>/vendors/jquery.sparkline/index.js"></script>
      <script src="<?= url('/') ?>/vendors/chart.js/dist/Chart.min.js"></script>
      <script src="<?= url('/') ?>/vendors/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
      <script src="<?= url('/') ?>/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
      <script src="<?= url('/') ?>/vendors/datatables/media/js/jquery.dataTables.js"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>

        <script type="text/javascript" src="<?= url('/') ?>/vendors/select2/select2.min.js"></script>

      <script src="<?= url('/') ?>/vendors/sweetalert/sweetalert.min.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/sweetalert/sweetalert-dev.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
      <script src="<?= url('/') ?>/vendors/numeral/min/numeral.min.js"></script>
      <script src="<?= url('/') ?>/vendors/multiple-select/js/bootstrap-multiselect.js"></script>

      <script src="<?= url('/') ?>/js/dashboard/dashboard.js"></script>
      <script src="<?= url('/') ?>/js/funciones.js"></script>
      <script src="<?= url('/') ?>/js/table/data-table.js"></script>
      <script src="<?= url('/') ?>/vendors/moment/min/moment.min.js"></script>
      <script src="<?= url('/') ?>/vendors/fullcalendar_old/dist/fullcalendar.min.js"></script>
      <script src="<?= url('/') ?>/vendors/fullcalendar_old/dist/gcal.js"></script>
      <script src="<?= url('/') ?>/vendors/fullCalendar_old/dist/lang/es.js"></script>
    <script src="<?= url('/') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?= url('/') ?>/vendors/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="<?= url('/') ?>/vendors/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
        


    <script src="https://jvectormap.com/js/jquery-jvectormap-co-merc.js"></script>
        <!-- <link href='<?= url('/') ?>/vendors/fullcalendar/packages/core/main.css' rel='stylesheet' />
        <link href='<?= url('/') ?>/vendors/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
        <link href='<?= url('/') ?>/vendors/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
        <link href='<?= url('/') ?>/vendors/fullcalendar/packages/list/main.css' rel='stylesheet' />
        <script src='<?= url('/') ?>/vendors/fullcalendar/packages/core/main.js'></script>
        <script src='<?= url('/') ?>/vendors/fullcalendar/packages/core/locales-all.js'></script>
        <script src='<?= url('/') ?>/vendors/fullcalendar/packages/interaction/main.js'></script>
        <script src='<?= url('/') ?>/vendors/fullcalendar/packages/daygrid/main.js'></script>
        <script src='<?= url('/') ?>/vendors/fullcalendar/packages/timegrid/main.js'></script>
        <script src='<?= url('/') ?>/vendors/fullcalendar/packages/list/main.js'></script> -->
      <!-- page plugins js -->
    <!-- <script src="<?= url('/') ?>/vendors/dragula-master/dist/dragula.js"></script> -->
 
      <!-- page js -->
      <!-- <script src="<?= url('/') ?>/js/apps/task.js"></script> -->

  <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>    


  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>


  <script>
    var user_id = localStorage.getItem('user_id');
    $("#logout").attr("href", "logout/"+user_id)

    var socket = io.connect('http://chseguros.com.co:3000', {secure: true});
    
    socket.on('askForUserId', function () {
        console.log("sender user")

        socket.emit("userIdReceived", user_id);  

    });



    window.onbeforeunload = function () {
      alert("No te vallas")
  };




  </script>

  @yield('CustomJs')

</body>

</html>
