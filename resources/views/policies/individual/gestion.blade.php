@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Polizas - Individual.</h4>
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
											
											<th>Nombres</th>
											<th>Apellidos</th>
											<th>Tipo de Documento</th>
											<th>Numero de Documento</th>
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

			@include('policies.individual.store')
			@include('policies.individual.view')
			@include('policies.individual.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Polizas").addClass("show");
				$("#nav_li_Polizas").addClass("open");
				$("#nav_users, #modulo_Polizas").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/policies', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/policies', '#cuadro2');
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
						 "url":''+url+'/api/policies',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"names"},
						{"data":"last_names"},
						{"data":"type_document"},
						{"data":"number_document"},
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
				GetClients("#clients_select");

				ChangeSelectBranch("#branch")


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

					$("#names_view").val(data.names).attr("disabled", "disabled")
					$("#last_names_view").val(data.last_names).attr("disabled", "disabled")
					$("#type_document_view").val(data.type_document).attr("disabled", "disabled")
					$("#number_document_view").val(data.number_document).attr("disabled", "disabled")
					$("#expedition_date_view").val(data.expedition_date).attr("disabled", "disabled")
					$("#gender_view").val(data.gender).attr("disabled", "disabled")
					$("#birthdate_view").val(data.birthdate).attr("disabled", "disabled")
					$("#stratum_view").val(data.stratum).attr("disabled", "disabled")

					$("#age_view").val(calcularEdad(data.birthdate)).attr("disabled", "disabled")

					data.data_treatment == 1 ? $("#data_treatment_view").prop("checked", true) : $("#data_treatment_view").prop("checked", false) 
					$("#observations_view").val(data.observations).attr("disabled", "disabled")


					$("#department_view").val(data.department).attr("disabled", "disabled")
					$("#city_view").val(data.city).attr("disabled", "disabled")

					$("#address1_view").val(data.address1).attr("disabled", "disabled")
					$("#type_address1_view").val(data.type_address1).attr("disabled", "disabled")
					$("#address2_view").val(data.address2).attr("disabled", "disabled")
					$("#type_address2_view").val(data.type_address2).attr("disabled", "disabled")

					$("#phone1_view").val(data.phone1).attr("disabled", "disabled")
					$("#type_phone1_view").val(data.type_phone1).attr("disabled", "disabled")
					$("#phone2_view").val(data.phone2).attr("disabled", "disabled")
					$("#type_phone2_view").val(data.type_phone2).attr("disabled", "disabled")

					$("#email_view").val(data.email).attr("disabled", "disabled")

					$("#marital_status_view").val(data.marital_status).attr("disabled", "disabled")
					$("#monthly_income_view").val(data.monthly_income).attr("disabled", "disabled")
					$("#heritage_view").val(data.heritage).attr("disabled", "disabled")

					data.own_house == 1 ? $("#own_house_view").prop("checked", true) : $("#own_house_view").prop("checked", false) 
					$("#number_house_view").val(data.number_house).attr("disabled", "disabled")

					if(data.childrens.length > 0){
						$("#children_view").prop("checked", true)
						$(".container-datos-adicionales-hijo-view").css("display", "block");
						ShowChildren("#dato-extra-hijo-container-view", data.childrens, "view")
					}else{
						$(".container-datos-adicionales-hijo-view").css("display", "none");
						$("#children_view").prop("checked", false)
					}

					if(data.vehicle.length > 0){
						$("#vehicle_view").prop("checked", true)
						$(".container-datos-adicionales-vehicle-view").css("display", "block");
						ShowVehicle("#dato-extra-vehicle-container-view", data.vehicle, "view")
					}else{
						$(".container-datos-adicionales-vehicle-view").css("display", "none");
						$("#vehicle_view").prop("checked", false)
					}



					data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_view").prop("checked", true)  : $("#send_policies_for_expire_email_view").prop("checked", false) 
					data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_view").prop("checked", true) : $("#send_portfolio_for_expire_email_view").prop("checked", false) 
					data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_view").prop("checked", true)    : $("#send_policies_for_expire_sms_view").prop("checked", false) 
					data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_view").prop("checked", true)   : $("#send_portfolio_for_expire_sms_view").prop("checked", false) 
					data.send_birthday_card              == 1 ? $("#send_birthday_card_view").prop("checked", true)              : $("#send_birthday_card_view").prop("checked", false) 

					$("#occupation_view").val(data.occupation).attr("disabled", "disabled")
					$("#company_view").val(data.company).attr("disabled", "disabled")

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
					
					$("#names_edit").val(data.names)
					$("#last_names_edit").val(data.last_names)
					$("#type_document_edit").val(data.type_document)
					$("#number_document_edit").val(data.number_document)
					$("#expedition_date_edit").val(data.expedition_date)
					$("#gender_edit").val(data.gender)
					$("#birthdate_edit").val(data.birthdate)
					$("#stratum_edit").val(data.stratum)

					$("#age_edit").val(calcularEdad(data.birthdate))

					data.data_treatment == 1 ? $("#data_treatment_edit").prop("checked", true) : $("#data_treatment_edit").prop("checked", false) 
					$("#observations_edit").val(data.observations)


					$("#department_edit").val(data.department)
					$("#city_edit").val(data.city)

					$("#address1_edit").val(data.address1)
					$("#type_address1_edit").val(data.type_address1)
					$("#address2_edit").val(data.address2)
					$("#type_address2_edit").val(data.type_address2)

					$("#phone1_edit").val(data.phone1)
					$("#type_phone1_edit").val(data.type_phone1)
					$("#phone2_edit").val(data.phone2)
					$("#type_phone2_edit").val(data.type_phone2)

					$("#email_edit").val(data.email)

					$("#marital_status_edit").val(data.marital_status)
					$("#monthly_income_edit").val(data.monthly_income)
					$("#heritage_edit").val(data.heritage)

					data.own_house == 1 ? $("#own_house_edit").prop("checked", true) : $("#own_house_edit").prop("checked", false) 
					$("#number_house_edit").val(data.number_house)

					if(data.childrens.length > 0){
						$("#children_edit").prop("checked", true)
						$(".container-datos-adicionales-hijo-edit").css("display", "block");
						ShowChildren("#dato-extra-hijo-container-edit", data.childrens, "edit")
					}else{
						$(".container-datos-adicionales-hijo-edit").css("display", "none");
						$("#children_edit").prop("checked", false)
					}

					if(data.vehicle.length > 0){
						$("#vehicle_edit").prop("checked", true)
						$(".container-datos-adicionales-vehicle-edit").css("display", "block");
						ShowVehicle("#dato-extra-vehicle-container-edit", data.vehicle, "edit")
					}else{
						$(".container-datos-adicionales-vehicle-edit").css("display", "none");
						$("#vehicle_edit").prop("checked", false)
					}



					data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_edit").prop("checked", true)  : $("#send_policies_for_expire_email_edit").prop("checked", false) 
					data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_edit").prop("checked", true) : $("#send_portfolio_for_expire_email_edit").prop("checked", false) 
					data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_edit").prop("checked", true)    : $("#send_policies_for_expire_sms_edit").prop("checked", false) 
					data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_edit").prop("checked", true)   : $("#send_portfolio_for_expire_sms_edit").prop("checked", false) 
					data.send_birthday_card              == 1 ? $("#send_birthday_card_edit").prop("checked", true)              : $("#send_birthday_card_edit").prop("checked", false) 

					$("#occupation_edit").val(data.occupation)
					$("#company_edit").val(data.company)

					$("#id_edit").val(data.id_clients_policies)

					showCasa("#own_house_edit", "#number_house_edit")
					showHijos("#children_edit", ".container-datos-adicionales-hijo-edit")
					showVehicle("#vehicle_edit", ".container-datos-adicionales-vehicle-edit")

					AddChildren("#add-children-edit", "#dato-extra-hijo-container-edit")
					AddVehicle("#add-vehicle-edit", "#dato-extra-vehicle-container-edit")





					cuadros('#cuadro1', '#cuadro4');
				});
			}


			

			function GetBranchByInsurers(select_insurers, select_branch){

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
							
							$.each(data.branchs, function (key, item) { 
								$(select_branch).append($('<option>',
								{
									value: item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage,
									text : item.name
								}));
							});

							
							$(select_branch).selectize({
								//sortField: 'text'
							});
						}
					});
				});
			}



			function ChangeSelectBranch(select){
				$(select).change(function (e) { 
					var array = $(this).val().split("|")

					var percentage_vat_cousin = array[1]
					var commission_percentage = array[2]

					$("#percentage_vat_cousin").val(percentage_vat_cousin)
					$("#commission_percentage").val(commission_percentage)
					
					calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission")

				});
			}


			$("#cousin, #xpenses, #participation").keyup(function (e) { 
				calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission", "#participation")
			});


			function calc(input_cousin, input_xpenses, input_total, input_percentage_vat_cousin, input_vat, input_commission_percentage, agency_commission, participation){
				
				var value_cousin                      = inNum($(input_cousin).val())
				var value_xpenses                     = inNum($(input_xpenses).val())
				var value_percentage_vat_cousin       = inNum($(input_percentage_vat_cousin).val())
				var value_input_commission_percentage = inNum($(input_commission_percentage).val())
				var participation                     = inNum($(participation).val())

				var result_percentage_vat_cousin = inNum(((value_cousin + value_xpenses)/100) * value_percentage_vat_cousin)
				var result_commission_percentage = inNum((value_cousin/100) * value_input_commission_percentage)
				
				var comission_total =  inNum(((result_commission_percentage / 100) * participation))

				var total = result_percentage_vat_cousin + value_cousin + value_xpenses

				$(input_vat).val(number_format(result_percentage_vat_cousin, 2))
				$(agency_commission).val(number_format(comission_total ,2))
				$(input_total).val(number_format(total, 2))
			}


			$("#clients_select").change(function (e) { 
				var arrayClient = $(this).val().split("|")
				$("#clients").val(arrayClient[0])
				$("#type_clients").val(arrayClient[1])
			});


		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_clients_policies+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-policies/'+data.id_clients_policies+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_clients_policies+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


