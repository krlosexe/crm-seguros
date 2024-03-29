@extends('layouts.app')

	@section('content')
	    <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Funciones</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<button onclick="nuevo()" id="btn-new" class="btn btn-success" style="float: left;">
										<i class="ti-plus"></i>
										<span>Nuevo</span>
									</button>
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
											<th>Acciones</th>
											<th>Nombre</th>
											<th>Descripción</th>
											<th>Nombre Módulo</th>
											<th>Posición</th>
											<th>Fecha de registro</th>
											<th>Registrado por</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			@include('perfiles.Funciones.store')
			@include('perfiles.Funciones.view')
			@include('perfiles.Funciones.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				update();
				list();

				$("#collapse_Perfiles").addClass("show");
				$("#nav_li_Perfiles").addClass("open");
				$("#nav_users, #modulo_Perfiles").addClass("active");
				$("#nav_funciones").addClass("active");
				verifyPersmisos(id_user, tokens, "funciones");

			});


			function store(){
				enviarFormulario("#store", 'api/funciones', '#cuadro2');
			}

			function update(){
				enviarFormularioPut("#form-update", 'api/funciones', '#cuadro4', false);
			}

			function list(cuadro) {
				var data = {
					"id_user": id_user,
					"token"  : tokens,
				};
				$('#table tbody').off('click');
				var url=document.getElementById('ruta').value; 
				cuadros(cuadro, "#cuadro1");

				var table=$("#table").DataTable({
					"destroy":true,
					
					"stateSave": true,
					"serverSide":false,
					"ajax":{
						"method":"GET",
						 "url":''+url+'/api/funciones',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						{"data": null,
							render : function(data, type, row) {
								var botones = "";
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
								if(actualizar == 1)
									botones += "<span class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
								if(data.status == 1 && actualizar == 1)
									botones += "<span class='desactivar btn btn-warning waves-effect' data-toggle='tooltip' title='Desactivar'><i class='fa fa-unlock' style='margin-bottom:5px'></i></span> ";
								else if(data.status == 2 && actualizar == 1)
									botones += "<span class='activar btn btn-success waves-effect' data-toggle='tooltip' title='Activar'><i class='fa fa-lock' style='margin-bottom:5px'></i></span> ";
								if(borrar == 1)
									botones += "<span class='eliminar btn btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='ei-delete-alt' style='margin-bottom:5px'></i></span>";
								return botones;
							}
						},

						{"data":"nombre"},
						{"data":"descripcion"},
						{"data":"nombre_modulo"},
						{"data":"posicion"},
						{"data": "fec_regins"},
						{"data": "email"}
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"responsive": true,
					"buttons": buttonsDatatable({
						title: 'Funciones',
						filename: 'funciones',
						columns: [1,2,3,4,5,6],
					}),
					initComplete(){
						$('.dt-button').removeClass('dt-button buttons-copy buttons-html5')
					}
				});


				ver("#table tbody", table)
				edit("#table tbody", table)
				activar("#table tbody", table)
				desactivar("#table tbody", table)
				eliminar("#table tbody", table)



			}



			function nuevo() {
				$("#alertas").css("display", "none");
				$("#store")[0].reset();

				listModulos("#modulos_store");
				cuadros("#cuadro1", "#cuadro2");
			}


			function listModulos(select) {
				var url=document.getElementById('ruta').value;
			    $.ajax({
			        url:''+url+'/api/modulos',
			        type:'GET',
			        data: {
							"id_user": id_user,
							"token"  : tokens,
						},
			        dataType:'JSON',
			        async: false,
			        beforeSend: function(){
			           // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
			        },
			        error: function (data) {
			            //mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
			        },
			        success: function(data){
			            $(select+" option").remove();
			            $(select).append($('<option>',
			            {
			                value: "null",
			                text : "Todos"
			            }));
			            $.each(data, function(i, item){
			                if (item.status == 1) {
			                    $(select).append($('<option>',
			                     {
			                        value: item.id_modulo,
			                        text : item.nombre
			                    }));
			                }
			            });

			        }
			    });
			}





			$("#modulos_store").change(function(){
				contadorFunciones($(this).val(), "registrar", 0);
			});


			$("#modulos_store-view").change(function(){
				contadorFunciones($(this).val(), "view", 0);
			});

			$("#modulos_store-edit").change(function(){
				contadorFunciones($(this).val(), "edit", 0);
			});








			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();

				//	contarModulos("#posicion-view");


					listModulos("#modulos_store-view");

					$("#nombre-view").val(data.nombre).attr("disabled", "disabled")
					$("#descripcion-view").val(data.descripcion).attr("disabled", "disabled")
					$("#route-view").val(data.route).attr("disabled", "disabled")

					$("#modulos_store-view").val(data.id_modulo)
					$("#modulos_store-view").val(data.id_modulo).trigger("change")
					$("#modulos_store-view").val(data.id_modulo).attr("disabled", "disabled")

					$("#posicion_view").val(data.posicion).attr("disabled", "disabled")
					$("#visible-view").val(data.visibilidad).attr("disabled", "disabled")
					
					cuadros('#cuadro1', '#cuadro3');
				});
			}






			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();

					listModulos("#modulos_store-edit");

					$("#nombre-edit").val(data.nombre)
					$("#descripcion-edit").val(data.descripcion)
					$("#route-edit").val(data.route)

					$("#modulos_store-edit").val(data.id_modulo).trigger("change")

					$("#posicion_edit").val(data.posicion)
					$("#visible-edit").val(data.visibilidad)

					$("#id_edit").val(data.id_funciones)

					cuadros('#cuadro1', '#cuadro4');
				});
			}



					
		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-funciones/'+data.id_funciones+"/"+2,"¿Esta seguro de desactivar el registro?", 'desactivar');
				});
			}
		/* ------------------------------------------------------------------------------- */

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function activar(tbody, table){
				$(tbody).on("click", "span.activar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-funciones/'+data.id_funciones+"/"+1,"¿Esta seguro de desactivar el registro?", 'activar');
				});
			}
		/* ------------------------------------------------------------------------------- */



			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-funciones/'+data.id_funciones+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}







			function contadorFunciones(value, select, selected){
				eliminarOptions("posicion_"+select);
				if (value != "") {
					$.ajax({
				        url: ''+document.getElementById('ruta').value+'/api/list-funciones',
				        type:'GET',
						dataType:'JSON',
						async: false,
				        data:{
				        	"id"      : value,
				        	"id_user" : id_user,
							"token"   : tokens,
				        },
				        error: function () {
		                    //contador_listaVista(value, select);
		                },
				        success: function (respuesta) {
				            var contador = Object.keys(respuesta).length;

				            console.log(contador)
				            if (select == 'registrar' || (selected == 0 && value != document.getElementById('id_modulo_vista_hidden').value)){
								contador++;
							}

				            for (var i = 1; i <= contador; i++)
				            	agregarOptions("#posicion_" + select, i, i);
				            
				        }
				    });
				} else {
					warning('¡Debe seleccionar un modulo!');
				}
			}



			

		</script>
		



	@endsection


