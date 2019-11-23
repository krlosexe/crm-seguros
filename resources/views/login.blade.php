<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" type="text/css" href="css/login/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login/iofrm-style.css">
     <link href="css/app.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login/iofrm-theme4.css">
   @yield('CustomCss')
  @if(Request::path() != '/')

    <script>
      $(document).ready(function(){

        var url = $(location).attr('href').split("/").splice(-1);
         validAuth(false, url[0]);
      });
    </script>
      @endif
      <style type="text/css">
          @media (max-width: 992px){
.form-holder .form-content {
    padding: 0px 40px 70px; 
}
}
      </style>
</head>
<body class="{{ Request::path() != '/' ? 'dasboard-body' : ''}} bg-gradient-primary">
    <div class="form-body">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <img class="" src="images/login/logo.png" alt="">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="images/login/graphic1.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Inicio de sesión</h3>
                        <p style="font-size: 16px;">Ingresa correctamente los campos requeridos.</p>
                        <div class="page-links">
                            <a href="login4.html" class="active">Ingresar</a><a href="register4.html">Registrar</a>
                        </div>
                            <form class="user" id="login" method="post" action="">
                            @csrf
                            <input class="form-control" type="email" name="email" placeholder="Correo o Usuario" required>

                            <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
                            <div class="form-button">
                                <input type="hidden" id="ruta" value="<?= url('/') ?>">
                                <button id="submit" type="submit" class="ibtn">Ingresar</button> <a href="forget4.html">Recuperar contraseña</a>
                                 
                            </div>

                        
                        </form>
                        <div class="other-links">
                            <span>Iniciar sesión con:</span><a href="#">Facebook</a><a href="#">Google</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" id="ruta" value="<?= url('/') ?>">
<script src="js/login/jquery.min.js"></script>
<script src="js/login/popper.min.js"></script>
<script src="js/login/bootstrap.min.js"></script>
<script src="js/login/main.js"></script>


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
<script src="vendors/sweetalert/sweetalert.min.js" type="text/javascript"></script>
<script src="vendors/sweetalert/sweetalert-dev.js" type="text/javascript"></script>
<script>
            $(document).ready(function(){
                validAuth(true);
                login();
            });

            function login(){
                enviarFormulario("#login", 'auth', '#cuadro2', true);
            }


        </script>


</body>
</html>


