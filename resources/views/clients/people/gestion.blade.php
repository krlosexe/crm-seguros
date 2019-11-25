@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Clientes - Personas.</h4>
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
											
											<th>Nombre</th>
											<th>Descripción</th>
											<th>Posición</th>
											<th>Fecha de registro</th>
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
				enviarFormularioPut("#form-update", 'api/people', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/people', '#cuadro2');
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
						 "url":''+url+'/api/modulos',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"nombre"},
						{"data":"descripcion"},
						{"data":"posicion"},
						{"data": "fec_regins"},
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
						}
						
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


				showCasa("#own_house", "#number_house")

				showHijos("#children", ".container-datos-adicionales-hijo")
				AddChildren("#add-children", "#dato-extra-hijo-container")

				showVehicle("#vehicle", ".container-datos-adicionales-vehicle")
				AddVehicle("#add-vehicle", "#dato-extra-vehicle-container")

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


			function showCasa(check, input){
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(input).removeAttr("disabled");
					}else{
						$(input).attr("disabled", "disabled");
					}
					
				});
			}



			function showHijos(check, table){

				$(table).css("display", "none");

				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(table).css("display", "block");
					}else{
						$(table).css("display", "none");
					}
					
				});
			}
	
			var count_children = 0
			function AddChildren(btn, table){
				$(btn).click(function (e) { 
					e.preventDefault();
					var input_name      = "<input type='text' name=name_children[]   class='form-control' required placeholder='Nombres'>"
					var input_phone     = "<input type='text' name=phone_children[]  class='form-control' required placeholder='Telefono'>"
					var input_birthdate = "<input type='date' name=birthdate_children[] class='form-control' required placeholder='Birthdate'>"
					var btn_delete      = "<button type='button' onclick='DeleteTr(\"" + "#tr_childred_" + count_children +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					
					var html = ""
					html += "<tr id='tr_childred_"+count_children+"'>"
						html +="<td>"+input_name+"</td>"
						html +="<td>"+input_phone+"</td>"
						html +="<td>"+input_birthdate+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"

					$(table).append(html)
				});
			}


			




			function showVehicle(check, table){
				$(table).css("display", "none");

				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(table).css("display", "block");
					}else{
						$(table).css("display", "none");
					}
					
				});
			}

			
			var count_vehicle = 0
			function AddVehicle(btn, table){
				$(btn).click(function (e) { 
					e.preventDefault();
					var input_placa     = "<input type='text' name=placa_vehicle[]  class='form-control' placeholder='Placa'>"
					var date_soat       = "<input type='date' name=date_soat[]      class='form-control' placeholder='Fecha vencimiento SOAT'>"
					var date_impuestos  = "<input type='date' name=date_taxes[]     class='form-control' placeholder='Fecha pago de impuestos'>"
					var date_tecno      = "<input type='date' name=date_tecno[]     class='form-control' placeholder='Fecha vencimiento tecnomecánica'>"
					var btn_delete      = "<button type='button' onclick='DeleteTr(\"" + "#tr_vehicle" + count_vehicle +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					
					var html = ""
					html += "<tr id='tr_vehicle"+count_vehicle+"'>"
						html +="<td>"+input_placa+"</td>"
						html +="<td>"+date_soat+"</td>"
						html +="<td>"+date_impuestos+"</td>"
						html +="<td>"+date_tecno+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"

					$(table).append(html)
				});
			}



			$("#birthdate").change(function (e) { 
			  $("#age").val(calcularEdad($(this).val()))
		  });






		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-modulo/'+data.id_modulo+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-modulo/'+data.id_modulo+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-modulo/'+data.id_modulo+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


