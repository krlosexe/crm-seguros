@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Polizas Agrupadas.</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<button onclick="nuevo()" id="btn-new" class="btn btn-success" style="float: left;">
										<i class="ti-user"></i>
										<span>Nuevo</span>
									</button>
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Numero de Poliza</th>
												<th>Aseguradora</th>
												<th>Ramo</th>
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

			@include('policies.grouped.store')
			@include('policies.grouped.view')
			@include('policies.grouped.edit')


                <!-- Content Wrapper END ------->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Pólizas").addClass("show");
				$("#nav_li_Pólizas").addClass("open");
				$("#nav_users, #modulo_Pólizas").addClass("active");
				$("#nav_policies-grouped").addClass("active");
				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/policies-grouped', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/policies-grouped', '#cuadro2');
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
						 "url":''+url+'/api/policies-grouped',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_policies"},
						
						{"data":"name_insurers"},
						{"data":"name_branchs"},
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
					"ordering": false,
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
				$(".container-datos-adicionales-hijo").css("display", "none");
				$(".container-datos-adicionales-vehicle").css("display", "none");

				GetInsurers("#insurers")

				GetBranchByInsurers("#insurers", "#branch")

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")

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

					$("#insurers_view").attr("disabled", "disabled")
					$("#branch_view").attr("disabled", "disabled")

					GetInsurers("#insurers_view", data.insurers)
					GetBranchByInsurers("#insurers_view", "#branch_view", data.branch+"|"+data.percentage_vat_cousin+"|"+data.commission_percentage, data.branch, "Collective")
					
					$("#number_policies_view").val(data.number_policies).attr("disabled", "disabled")
					$("#reception_date_view").val(data.reception_date).attr("disabled", "disabled")
					$("#start_date_view").val(data.start_date).attr("disabled", "disabled")
					$("#end_date_view").val(data.end_date).attr("disabled", "disabled")

					$("#name_taker_view").val(data.name_taker).attr("disabled", "disabled")
					$("#identification_taker_view").val(data.identification_taker).attr("disabled", "disabled")
					
					var url = "policies-childs/"+data.id_policies_grouped+"/0"
					$('#iframeView').attr('src', url);
					
					$("#insurers_view").trigger("change");

					data.is_renewable == 1 ? $("#is_renewable_view").prop("checked", true) : $("#is_renewable_view").prop("checked", false) 
					

					cuadros('#cuadro1', '#cuadro3');


					var url = "policies/grouped/files/"+data.id_policies_grouped+"/0"
					$('#iframeDigitalesView').attr('src', url);


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
					
					GetInsurers("#insurers_edit", data.insurers)
					GetBranchByInsurers("#insurers_edit", "#branch_edit", data.branch+"|"+data.percentage_vat_cousin+"|"+data.commission_percentage, data.branch, "Collective")
					
					$("#number_policies_edit").val(data.number_policies)
					$("#reception_date_edit").val(data.reception_date)
					$("#start_date_edit").val(data.start_date)
					$("#end_date_edit").val(data.end_date)

					$("#name_taker_edit").val(data.name_taker)
					$("#identification_taker_edit").val(data.identification_taker)
					
					
					$("#insurers_edit").trigger("change");


					var url = "policies-childs/"+data.id_policies_grouped+"/1"
					$('#iframeEdit').attr('src', url);



					data.is_renewable == 1 ? $("#is_renewable_edit").prop("checked", true) : $("#is_renewable_edit").prop("checked", false) 
					
					$("#id_edit").val(data.id_policies_grouped)


					
					var url = "policies/grouped/files/"+data.id_policies_grouped+"/1"
					$('#iframeDigitalesEdit').attr('src', url);

					cuadros('#cuadro1', '#cuadro4');
				});
			}
			

			function GetBranchByInsurers(select_insurers, select_branch, value_default = false, branch = false, type_poliza = false){

				$(select_branch).selectize({
					sortField: 'text'
				});

				$(select_insurers).change(function (e) { 
				
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/insurers/'+$(this).val(),
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
							$(select_branch)[0].selectize.destroy()
							$(select_branch+" option").remove();
							$(select_branch).append($('<option>',
							{
								value: "null",
								text : "Seleccione"
							}));

							if(type_poliza == "Collective"){

								$.each(data.branchs, function (key, item) { 
								
								$(select_branch).append($('<option>',
								{
									value: item.id_branch,
									text : item.name,
									selected: branch == item.id_branch ? true : false
								}));
								});

							}else{
								$.each(data.branchs, function (key, item) { 
								
								$(select_branch).append($('<option>',
								{
									value: item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage,
									text : item.name,
									selected: value_default == item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage ? true : false
								}));
							});
							}
							
							

							$(select_branch).selectize({
								//sortField: 'text'
							});
						}
					});
				});
			}


			$("#branch").change(function (e) { 
				var array = $(this).val().split("|")

				var id_branch = array[0]

				$("#branch_value").val(id_branch)

			});

		

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies-grouped/'+data.id_policies_grouped+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-policies-grouped/'+data.id_policies_grouped+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies-grouped/'+data.id_policies_grouped+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>
	@endsection


