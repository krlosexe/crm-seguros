@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Cotizaciones</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
											<th>Nombres</th>
											<th>Placa</th>
											<th>Correo</th>
											<th>Estado</th>
											<th>Fecha de Consulta</th>
											<th>Acciones</th>
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

			@include('cotizaciones.view')
			@include('cotizaciones.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				list();
				update();

				$("#collapse_Vehículos").addClass("show");
				$("#nav_li_Vehículos").addClass("open");
				$("#nav_people").addClass("active");

				$("#nav_users, #modulo_Vehículos").addClass("active");

				verifyPersmisos(id_user, tokens, "vehicles");

				$(".selectized").selectize({
					//sortField: 'text'
				});


			});


			function update(){
				enviarFormularioPut("#form-update", 'api/cotizaciones', '#cuadro4', false, "#avatar-edit");
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
						 "url":''+url+'/api/cotizaciones/paginate',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"nombre_completo"},
						{"data":"placa"},
						{"data":"correo"},
						{"data":"estado"}, 
						{"data":"fecha_consulta"}, 
						{"data": null,
							render : function(data, type, row) {
								var botones = "";
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
								if(actualizar == 1)
									botones += "<span class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
	
								if(borrar == 1)
									botones += "<span class='eliminar btn btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='ei-delete-alt' style='margin-bottom:5px'></i></span>";
								return botones;
							}
						}
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,
					"buttons":[
						'copy', 'csv', 'excel', 'pdf', 'print'
					]
				});


				ver("#table tbody", table)
				edit("#table tbody", table)

				eliminar("#table tbody", table)


			}


			
			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					var data = table.row( $(this).parents("tr") ).data();

				   $('.show-when-interesado').hide();


					$("#nombre_view").val(data.nombre).attr("disabled", "disabled")
					$("#apellido_view").val(data.apellido).attr("disabled", "disabled")
					$("#tipo_documento_view").val(data.tipo_documento).attr("disabled", "disabled")
					$("#documento_identidad_view").val(data.documento_identidad).attr("disabled", "disabled")
					$("#tipo_persona_view").val(data.tipo_persona).attr("disabled", "disabled")
					$("#correo_view").val(data.correo).attr("disabled", "disabled")
					$("#clase_vehiculo_view").val(data.clase_vehiculo).attr("disabled", "disabled")
					$("#marca_view").val(data.marca).attr("disabled", "disabled")
					$("#modelo_view").val(data.modelo).attr("disabled", "disabled")
					$("#referencia_view").val(data.referencia).attr("disabled", "disabled")
					$("#tipo_servicio_view").val(data.tipo_servicio).attr("disabled", "disabled")
					$("#estado_view").val(data.estado).attr("disabled", "disabled")

					if(data.estado == 'INTERESADO'){
						$('.show-when-interesado').show();
						$('#plan_view').val(data.plan).attr('disabled', 'disabled')
						$('#total_view').val(data.total).attr('disabled', 'disabled')
					}

					$("#created_at").html(data.fecha_consulta)

					cuadros('#cuadro1', '#cuadro5');
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
					
	
					$("#nombre_edit").val(data.nombre).attr('disabled', 'disabled')
					$("#apellido_edit").val(data.apellido).attr('disabled', 'disabled')
					$("#tipo_documento_edit").val(data.tipo_documento).attr('disabled', 'disabled')
					$("#documento_identidad_edit").val(data.documento_identidad).attr('disabled', 'disabled')
					$("#tipo_persona_edit").val(data.tipo_persona).attr('disabled', 'disabled')
					$("#correo_edit").val(data.correo).attr('disabled', 'disabled')
					$("#clase_vehiculo_edit").val(data.clase_vehiculo).attr('disabled', 'disabled')
					$("#marca_edit").val(data.marca).attr('disabled', 'disabled')
					$("#modelo_edit").val(data.modelo).attr('disabled', 'disabled')
					$("#referencia_edit").val(data.referencia).attr('disabled', 'disabled')
					$("#tipo_servicio_edit").val(data.tipo_servicio).attr('disabled', 'disabled')

					$("#created_at").html(data.fecha_consulta)

					$("#estado_edit").val(data.estado)
					$("#id_edit").val(data.id_vehiculo)

					if(data.estado == 'INTERESADO'){
						$('.show-when-interesado').show();
						$('#plan_edit').val(data.plan).attr('disabled', 'disabled')
						$('#total_edit').val(data.total).attr('disabled', 'disabled')
					}

					cuadros('#cuadro1', '#cuadro4');


				});
			}

	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/cotizaciones/status/'+data.id_vehiculo+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


