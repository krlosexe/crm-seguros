@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestion de Clientes - Personas</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<button onclick="nuevo()" id="btn-new" class="btn btn-primary" style="float: right;">
										<i class="ei-addthis"></i>
										<span>Nuevo</span>
									</button>
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
											<th>Acciones</th>
											<th>Nombre</th>
											<th>Descripcion</th>
											<th>Posicion</th>
											<th>Fecha de registro</th>
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

			@include('clients.people.store')
			@include('clients.people.view')
			@include('clients.people.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Clientes").addClass("show");
				$("#nav_li_Clientes").addClass("open");
				$("#nav_users, #modulo_Clientes").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/modulos', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/modulos', '#cuadro2');
			}




			function list(cuadro) {
				contarModulos("#posicion_modulo_vista_registrar");
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
						 "url":''+url+'/api/modulos',
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
									botones += "<span class='activar btn btn-warning waves-effect' data-toggle='tooltip' title='Activar'><i class='fa fa-lock' style='margin-bottom:5px'></i></span> ";
								if(borrar == 1)
									botones += "<span class='eliminar btn btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='ei-delete-alt' style='margin-bottom:5px'></i></span>";
								return botones;
							}
						},
						{"data":"nombre"},
						{"data":"descripcion"},
						{"data":"posicion"},
						{"data": "fec_regins"}
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"responsive": true,
					"buttons":[
						'copy', 'csv', 'excel', 'pdf', 'print'
					]
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
				cuadros("#cuadro1", "#cuadro2");
			}

			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();

					contarModulos("#posicion-view");

					$("#nombre-view").val(data.nombre).attr("disabled", "disabled")
					$("#descripcion-view").val(data.descripcion).attr("disabled", "disabled")
					$("#icono-view").val(data.icon).attr("disabled", "disabled")
					$("#posicion-view").val(data.posicion).attr("disabled", "disabled")
					
					
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

					contarModulos("#posicion-edit");

					$("#nombre-edit").val(data.nombre)
					$("#descripcion-edit").val(data.descripcion)
					$("#icono-edit").val(data.icon)
					$("#posicion-edit").val(data.posicion)
					$('#inicial').val(data.posicion)
					
					cuadros('#cuadro1', '#cuadro4');

					$("#id_edit").val(data.id_modulo)

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
					statusConfirmacion('api/status-modulo/'+data.id_modulo+"/"+2,"¿Esta seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-modulo/'+data.id_modulo+"/"+1,"¿Esta seguro de desactivar el registro?", 'activar');
				});
			}
		/* ------------------------------------------------------------------------------- */



			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-modulo/'+data.id_modulo+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}




		/* ------------------------------------------------------------------------------- */
		  /*
		    Funcion que hace un count de los modulos registrados y el resultado se 
		    despliega en un select para la seleccion de la posicion del modulo.
		  */
		  function contarModulos(select){
		    $(select).find('option').remove().end().append('<option value="">Seleccione</option>');
		    $.ajax({
		          url: ''+document.getElementById('ruta').value+'/api/modulos',
		          type:'GET',
		          data: {
		          	"id_user": id_user,
					"token"  : tokens,
				  },
				  dataType:'JSON',
				  async: false,
		          error: function() {
		       //contarModulos();
		          },
		          success: function(respuesta){
		              var selectRegistrar = Object.keys(respuesta).length +1;
		              var selectActualizar = Object.keys(respuesta).length;
		              for(var i = 1; i <= selectRegistrar; i++){
		              	console.log(selectRegistrar);
		                agregarOptions(select, i, i);
		              }
		              
		          }
		      });
		  }



					


		</script>
		



	@endsection


