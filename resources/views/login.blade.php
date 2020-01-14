<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" type="text/css" href="css/login/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/login/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="css/login/iofrm-theme22.css">
  @if(Request::path() != '/')

    <script>
      $(document).ready(function(){

        var url = $(location).attr('href').split("/").splice(-1);
         validAuth(false, url[0]);
      });
    </script>
      @endif
      <style type="text/css">
          @import url("https://fonts.googleapis.com/css?family=Lato:300,400,700|Roboto:300,400,500,700");
            html, html a, body { -webkit-font-smoothing: antialiased; }

            body { font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif; font-size: 14px; background-color: #f6f7fb; color: #888da8; line-height: 1.5; letter-spacing: 0.2px; overflow-x: hidden; }

            h1, h2, h3, h4, h5, h6 { color: #515365; font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif; letter-spacing: 0.5px; font-weight: normal; line-height: 1.5; }

            h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif; }
            p { font-family: Roboto, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", "Helvetica Neue", Arial, sans-serif; color: #888da8; line-height: 1.9; }
      </style>
</head>
<body>
  <div class="form-body without-side">
        <div class="website-logo">
            <a href="https://chseguros.com.co/">
                <div class="logo">
                    <img class="logo-size" src="https://chseguros.com.co/wp-content/uploads/2020/01/logoch2020.svg" alt="logo ch">
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <img src="images/login/graphic3.svg" alt="">
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Inicio de sesión</h3>
                        <p style="font-size: 15px;">Ingresa correctamente los campos requeridos.</p>
                         <form class="user" id="login" method="post" action="">
                            @csrf
                            <input class="form-control" type="email" name="email" placeholder="Email" required>
                            <input class="form-control" type="password" name="password" placeholder="Contraseña" required>
                            <div class="form-button">
                                 <input type="hidden" id="ruta" value="<?= url('/') ?>">
                                <button id="submit" type="submit" class="ibtn">Ingresar</button> <a href="forget22.html">Olvidaste tu contraseña?</a>
                            </div>
                        </form>
                        <div class="other-links">
                            <div class="text">O ingresa sesión con: </div>
                            <a href="#"><i class="fa fa-facebook"></i>Facebook</a><a href="#"><i class="fa fa-google"></i>Google</a>
                        </div>
                        <!---
                        <div class="page-links">
                            <a href="register22.html">Registrarme</a>
                        </div>
                        --->
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
<script src="vendors/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
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


