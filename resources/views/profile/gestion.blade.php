@extends('layouts.app')


@section('CustomCss')

<style>
    .kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
        margin: 0;
        padding: 0;
        border: none;
        box-shadow: none;
        text-align: center;
    }
    .kv-avatar {
        display: inline-block;
    }
    .kv-avatar .file-input {
        display: table-cell;
        width: 213px;
    }
    .kv-reqd {
        color: red;
        font-family: monospace;
        font-weight: normal;
    }
</style>


@endsection




	@section('content')
		<div class="main-content">
                    <div class="container-fluid">
                        <div class="page-title">
                            <h4>Configuración de Perfil</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="widget-profile-1 card">
                                            <div class="profile border bottom">



                                               <div class="row">
                                                    <form action="" id="form-foto" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="_method" value="put">
                                                        <div class="col-sm-12 text-center">
                                                            <div class="kv-avatar">
                                                                <div class="file-loading">
                                                                    <input id="avatar-1" name="img-profile" type="file" >
                                                                </div>
                                                            </div>
                                                            <div class="kv-avatar-hintss">
                                                                <small>Actualiza tu foto de Perfil</small>
                                                            </div>
                                                        </div>


                                                        <input type="hidden" name="id_user" class="id_user">
                                                        <input type="hidden" name="token" class="token">


                                                        <button type="submit" class="btn btn-success btn-sm" href="">Guardar cambios</button>


                                                    </form>
                                                </div>



                                                <h4 id="name_avatar" class="mrg-top-20 no-mrg-btm text-semibold">Juan Rivera</h4>
                                                <p>Administrador</p>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">

                                            <form action="" method="post" id="form-store" enctype="multipart/form-data">
                                                 <input type="hidden" name="_method" value="put">
                                                <div class="card-heading border bottom">
                                                    <h4 class="card-title">Información general</h4>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Nombres</b></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="nombres" id="name" class="form-control" value="Juan Rivera">
                                                        </div>
                                                    </div>
                                                    <hr>


                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Apellidos</b></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="apellido_p" id="apellido_p" class="form-control" value="Juan Rivera">
                                                        </div>
                                                    </div>
                                                    <hr>



                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Email</b></p>
                                                        </div>
                                                    <div class="col-md-6">
                                                            <input type="email" name="email" id="email" class="form-control" value="juanriverarq@gmail.com">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Teléfono</b></p>
                                                        </div>
                                                    <div class="col-md-6">
                                                            <input type="number" name="telefono" id="telefono" class="form-control" value="3227697874">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Firma</b></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div>
                                                                <label for="img-upload" class="pointer">
                                                                    <img src="https://upload.wikimedia.org/wikipedia/commons/1/14/Firma_Ildefonso_Leal.jpg" width="117" alt="" id="img-firm">
                                                                    <span class="btn btn-default display-block no-mrg-btm">Elige una firma</span>
                                                                    <input type="file" name="firm" id="firm">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Estado</b></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <p class="mrg-top-10">
                                                                <span class="status online mrg-top-10"></span>
                                                                <span class="mrg-left-10">Activo</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                
                                                    <div class="card-footer border top"><div class="text-right">

                                                        <input type="hidden" name="id_user" class="id_user">
                                                        <input type="hidden" name="token" class="token">


                                                        <button type="submit" class="btn btn-success" href="">Guardar cambios</button>
                                                    </div></div>
                                                
                                                </div>

                                            </form>
                                        </div>
                                        
                                        <div class="card">

                                            <form id="form-password" method="post">

                                            <input type="hidden" name="_method" value="put">
                                                <div class="card-heading border bottom">
                                                    <h4 class="card-title">Cambiar contraseña</h4>
                                                </div>
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Nueva contraseña</b></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="password" name="password" id="password" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <p class="mrg-top-10 text-dark"> <b>Repite contraseña</b></p>
                                                        </div>
                                                    <div class="col-md-6">
                                                            <input type="password" name="repeat-password" class="form-control" >
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>

                                                    <input type="hidden" name="id_user" class="id_user">
                                                        <input type="hidden" name="token" class="token">



                                                     <div class="card-footer border top"><div class="text-right"><button  type="submit" class="btn btn-success" href="">Cambiar contraseña</button></div></div>
                                                
                                                    
                                                </div>

                                            </form>
                                        </div>
                                                                           
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
	@endsection




	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();

                UpdatePass()
                UpdatePhoto()   

                getData()

				$("#collapse_Perfiles").addClass("show");
				$("#nav_li_Perfiles").addClass("open");
				$("#nav_users, #modulo_Perfiles").addClass("active");
				$("#nav_profile").addClass("active");
				verifyPersmisos(id_user, tokens, "modules");
			});

			function store(){
				enviarFormularioProfile("#form-store", 'api/user/'+id_user, '#cuadro2');
            }


            function UpdatePass(){
				enviarFormularioProfile("#form-password", 'api/user/'+id_user, '#cuadro2');
            }



            function UpdatePhoto(){
				enviarFormularioProfilePhoto("#form-foto", 'api/user/'+id_user, '#cuadro2');
            }

           

            function enviarFormularioProfile(form, controlador, cuadro, auth = false){
                $(form).submit(function(e){
                    e.preventDefault(); //previene el comportamiento por defecto del formulario al darle click al input submit
                    var url=document.getElementById('ruta').value;
                    var formData=new FormData($(form)[0]); //obtiene todos los datos de los inputs del formulario pasado por parametros
                    var method = $(this).attr('method'); //obtiene el method del formulario
                    $('input[type="submit"]').attr('disabled','disabled'); //desactiva el input submit
                    $.ajax({
                        url:''+url+'/'+controlador+'',
                        type:method,
                        dataType:'JSON',
                        data:formData,
                        cache:false,
                        contentType:false,
                        processData:false,
                        beforeSend: function(){
                        showNoty('info', "topLeft",'<span>Espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>', 1000);
                        },
                        error: function (repuesta) {
                            $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                            var errores=repuesta.responseText;
                            if(errores!="")
                                showNoty("error", "topRight", errores, 3000)
                            else
                                showNoty("error", "topRight","<span>Ha ocurrido un error, por favor intentelo de nuevo.</span>", 3000)
                        },
                        success: function(respuesta){
                            if (respuesta.success == false) {
                                showNoty('error', "topRight", respuesta.message, 3000);
                                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                            }else{
                                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                                showNoty('success', "topRight", respuesta.mensagge, 3000);

                                if (auth) {
                                localStorage.setItem('token', respuesta.token);  
                                localStorage.setItem('email', respuesta.email);
                                localStorage.setItem('user_id', respuesta.user_id);  
                                window.location.href = url+"/dashboard";
                                }else{

                                    getData()
                                }
                            
                            }

                        }

                    });
                });
            }



            function enviarFormularioProfilePhoto(form, controlador, cuadro, auth = false){
                $(form).submit(function(e){
                    e.preventDefault(); //previene el comportamiento por defecto del formulario al darle click al input submit
                    var url=document.getElementById('ruta').value;
                    var formData=new FormData($(form)[0]); //obtiene todos los datos de los inputs del formulario pasado por parametros
                    var method = $(this).attr('method'); //obtiene el method del formulario
                    $('input[type="submit"]').attr('disabled','disabled'); //desactiva el input submit
                    $.ajax({
                        url:''+url+'/'+controlador+'',
                        type:method,
                        dataType:'JSON',
                        data:formData,
                        cache:false,
                        contentType:false,
                        processData:false,
                        beforeSend: function(){
                        showNoty('info', "topLeft",'<span>Espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>', 1000);
                        },
                        error: function (repuesta) {
                            $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                            var errores=repuesta.responseText;
                            if(errores!="")
                                showNoty("error", "topRight", errores, 3000)
                            else
                                showNoty("error", "topRight","<span>Ha ocurrido un error, por favor intentelo de nuevo.</span>", 3000)
                        },
                        success: function(respuesta){
                            if (respuesta.success == false) {
                                showNoty('error', "topRight", respuesta.message, 3000);
                                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                            }else{
                                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                                showNoty('success', "topRight", respuesta.mensagge, 3000);

                                if (auth) {
                                localStorage.setItem('token', respuesta.token);  
                                localStorage.setItem('email', respuesta.email);
                                localStorage.setItem('user_id', respuesta.user_id);  
                                window.location.href = url+"/dashboard";
                                }else{

                                    location.reload(true);
                                }
                            
                            }

                        }

                    });
                });
            }








            function getData(){

				var url=document.getElementById('ruta').value; 
				$.ajax({
					url:''+url+'/api/user/'+id_user,
					type:"GET",
					dataType:'JSON',
					async: false,
					beforeSend: function(){
					
					},
					error: function (repuesta) {
						
					},
					success: function(data){

						$("#name").val(data.nombres);
						$("#apellido_p").val(data.apellido_p);
						$("#phone").val(data.phone);
						$("#email").val(data.email);
                        $("#telefono").val(data.telefono);

                        $("#name_avatar").val(data.nombres+" "+data.apellido_p)


                        $("#img-firm").attr("src", "/img/usuarios/firms/"+data.firm)


						


					

					url_imagen = '/img/usuarios/profile/'

					if(data.img_profile != ""){
						img = '<img src="'+url_imagen+data.img_profile+'" class="file-preview-image kv-preview-data">'
					}else{rfc2c = ""}
                    

                    $('#avatar-1').fileinput('destroy');

                    
					$("#avatar-1").fileinput({
						theme: "fas",
						overwriteInitial: true,
						maxFileSize: 10000,
						showClose: false,
						showCaption: false,
						browseLabel: '',
						removeLabel: '',
						browseIcon: '<i class="fa fa-folder-open"></i>',
						removeIcon: '<i class="fas fa-trash-alt"></i>',
						previewFileIcon: '<i class="fas fa-file"></i>',
						removeTitle: 'Cancel or reset changes',
						elErrorContainer: '#kv-avatar-errors-1',
						msgErrorClass: 'alert alert-block alert-danger',
						defaultPreviewContent: '<img src="img/default-user.png" width="150" alt="Your Avatar">',
						layoutTemplates: {main2: '{preview}  {remove} {browse}'},
						allowedFileExtensions: ["jpg", "png", "gif"],
						initialPreview: [ 
							img
						],
						initialPreviewConfig: [
								
							{caption: data.img_profile , downloadUrl: url_imagen+data.img_profile  ,url: url+"uploads/delete", key: data.img_profile}
					
						],

					});



					}
				});

			}









		</script>
	@endsection
