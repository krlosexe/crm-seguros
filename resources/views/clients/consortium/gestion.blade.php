@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Clientes - Consorcios.</h4>
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
											
											<th>Razon Social</th>
											<th>NIT</th>
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

			@include('clients.consortium.store')
			@include('clients.consortium.view')
			@include('clients.consortium.edit')

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
				enviarFormularioPut("#form-update", 'api/company', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/company', '#cuadro2');
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
						 "url":''+url+'/api/company',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"business_name"},
						{"data":"nit"},
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
				
				GetClients("#clients-store");
				AddPartner("#add-partner", "#table-partner", "#clients-store")

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

					$("#business_name_view").val(data.business_name).attr("disabled", "disabled")
					$("#nit_view").val(data.nit).attr("disabled", "disabled")
					$("#expedition_date_view").val(data.expedition_date).attr("disabled", "disabled")
					$("#constitution_date_view").val(data.constitution_date).attr("disabled", "disabled")
					

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



					data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_view").prop("checked", true)  : $("#send_policies_for_expire_email_view").prop("checked", false) 
					data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_view").prop("checked", true) : $("#send_portfolio_for_expire_email_view").prop("checked", false) 
					data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_view").prop("checked", true)    : $("#send_policies_for_expire_sms_view").prop("checked", false) 
					data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_view").prop("checked", true)   : $("#send_portfolio_for_expire_sms_view").prop("checked", false) 
					data.send_birthday_card              == 1 ? $("#send_birthday_card_view").prop("checked", true)              : $("#send_birthday_card_view").prop("checked", false) 
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
					
					$("#business_name_edit").val(data.business_name)
					$("#nit_edit").val(data.nit)
					$("#expedition_date_edit").val(data.expedition_date)
					$("#constitution_date_edit").val(data.constitution_date)
					

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



					data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_edit").prop("checked", true)  : $("#send_policies_for_expire_email_edit").prop("checked", false) 
					data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_edit").prop("checked", true) : $("#send_portfolio_for_expire_email_edit").prop("checked", false) 
					data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_edit").prop("checked", true)    : $("#send_policies_for_expire_sms_edit").prop("checked", false) 
					data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_edit").prop("checked", true)   : $("#send_portfolio_for_expire_sms_edit").prop("checked", false) 
					data.send_birthday_card              == 1 ? $("#send_birthday_card_edit").prop("checked", true)              : $("#send_birthday_card_edit").prop("checked", false) 
					
					$("#id_edit").val(data.id_clients_company)
					cuadros('#cuadro1', '#cuadro4');
				});
			}



			function AddPartner(btn, table, select){
				var count_children = 0
				
				$(btn).unbind().click(function (e) { 
					e.preventDefault();

					var name_client = $(select+" option:selected").text()

					var btn_delete      = "<button type='button' onclick='DeleteTr(\"" + "#tr_partner_" + count_children +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					
					var html = ""
					html += "<tr id='tr_partner_"+count_children+"'>"
						html +="<td>"+name_client+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"
					count_children++
					$(table).append(html)
				});
			}



		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-company/'+data.id_clients_company+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-company/'+data.id_clients_company+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-company/'+data.id_clients_company+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


