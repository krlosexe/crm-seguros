@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Pólizas.</h4>
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
												<th>Número de Póliza</th>
												<th>Cliente</th>
												<th>Aseguradora</th>
												<th>Ramo</th>
												<th>Tipo</th>
												<th>Estatus</th>
												<th>Fecha Inicio</th>
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



			<div class="modal fade" id="modal-lg" aria-hidden="true" style="display: none;">
			
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Vinculados</h3>
						</div>
						<div class="modal-body">
							<form action="" id="form-bind">
								<div class="row">
									 
									 <input id="count_fila" hidden value="nuevo">

									<div class="col-md-6">
										<label for=""><b>No. Anexo</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="number_anexo_bind">
										</div>
									</div>


									<div class="col-md-6">
										<label for=""><b>Numero afiliado*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="number_affiliate_bind" required>
										</div>
									</div>

								</div>


								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Fecha de Inicio *</b></label>
										<div class="form-group valid-required">
											<input type="date" class="form-control" id="date_init_bind" required>
										</div>
									</div>


									<div class="col-md-4">
										<label for=""><b>Objeto asegurado*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="insured_object_bind" placeholder="Codigo Objeto Asegurado" required>
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Prima (Mensual, semestral, anual)*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control monto_formato_decimales" id="cousin_bind" required style="text-align: right">
										</div>
									</div>

								</div>


								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Nombre del Afiliado *</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="name_affiliate_bind" required>
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Documento del Afiliado*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="document_affiliate_bind" placeholder="Documento del Afiliado" required>
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Parentesco</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="relationship_bind">
										</div>
									</div>

								</div>



								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Fecha de nacimiento</b></label>
										<div class="form-group valid-required">
											<input type="date" class="form-control" id="birthdate_bind" >
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Edad</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="age_bind" disabled>
										</div>
									</div>

									<div class="col-sm-4">
										<label for=""><b>Genero*</b></label>
										<select  class="form-control selectize-input items has-options full has-items" id="gender_bind" required>
										<option value="">Seleccione</option>
										<option value="Masculino">Masculino</option>
										<option value="Femenino">Femenino</option>
										</select>
									</div>

								</div>




								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Celular</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="phone_bind">
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Correo</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="email_bind">
										</div>
									</div>

									<div class="col-sm-4">
										<label for=""><b>Dirección*</b></label>
										<input type="text" class="form-control" id="address_bind">
									</div>

								</div>





								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Plan Afiliado</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="plan_bind">
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Tipo Tarifa</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="type_rate_bind">
										</div>
									</div>

									<div class="col-sm-4">
										<label for=""><b>Tipo de Afiliación</b></label>
										<input type="text" class="form-control" id="type_membership_bind">
									</div>

								</div>



								<div class="row">

									<div class="col-md-2">
										<label for=""><b>% IVA</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="percentage_vat_bind">
										</div>
									</div>

									<div class="col-md-3">
										<label for=""><b>Gastos de expedicion</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control monto_formato_decimales" id="expenses_bind" style="text-align: right">
										</div>
									</div>

									<div class="col-sm-3">
										<label for=""><b>IVA</b></label>
										<input type="text" class="form-control" id="vat_bind" readonly style="text-align: right">
									</div>


									<div class="col-sm-4">
										<label for=""><b>Total</b></label>
										<input type="text" class="form-control" id="total_bind" style="text-align: right" readonly>
									</div>

								</div>



								<div class="row">

									<div class="col-md-6">
										<label for=""><b>Empresa</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="company_bind">
										</div>
									</div>


									<div class="col-md-6">
										<label for=""><b>Empleado</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="employee_bind">
										</div>
									</div>

								</div>



								<div class="row">
									<div class="col-md-6">
										<label for=""><b>Observaciones Internas</b></label>
										<div class="form-group valid-required">
											<textarea class="form-control" id="internal_observations_bind" cols="30" rows="10"></textarea>
										</div>
									</div>

									<div class="col-md-6">
										<label for=""><b>Observaciones</b></label>
										<div class="form-group valid-required">
											<textarea  id="observations_bind" class="form-control" cols="30" rows="10"></textarea>
										</div>
									</div>
								</div>



								<div class="row">

									<div class="col-md-12">
										<h6 class="m-0 font-weight-bold text-primary">Beneficiarios</h6>
									</div> <br> <br>


									<div class="col-md-6">
										<label for="beneficairy_onerous_bind"><b>Beneficiario Oneroso</b><br></label><br>
										<div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
											<input type="checkbox" name="beneficairy_onerous_bind" id="beneficairy_onerous_bind" checked="checked">
											<label for="beneficairy_onerous_bind"></label>

											<input type="hidden" id="beneficairy_onerous_input_bind" value="1">
										</div>
									</div>



									<div class="col-md-12">
										<table class="table table-bordered">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Documento</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>
													<input type="text" name="beneficairy_name" class="form-control" id="beneficairy_name_bind" placeholder="Nombre del Beneficiario">
													</td>

													<td>
													<input type="text" name="beneficairy_identification" class="form-control" id="beneficairy_identification_bind" placeholder="Documento del Beneficiario">
													</td>
												</tr>
											</tbody>
										</table>
									</div>


									<div class="col-md-12">
										<button type="submit" id="btn-add-bind" class="btn btn-success" style="float: left;">
										<i class="ti-user"></i>
										<span>Agregar  </span>
										</button>
									</div>

								</div>

							</form>

						</div>
					</div>

				</div>
			</div>

		</div>
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
				$("#nav_policies").addClass("active");
				verifyPersmisos(id_user, tokens, "policies");
				
				// ocultar comision y participacion cuando es diferente de administrador

				if(name_rol != 'Administrador'){
					$('.row-participacion').hide()
				}

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
					"serverSide":true,
          			"processing": true,
					"ajax":{
						"method":"POST",
						 "url":''+url+'/api/policies/paginate',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
					},
					"columnDefs":[
						
						{targets: 0, "data":"number_policies"},
						{targets: 1, "data":null,
							render : function(data, type, row) {
								if(row.type_clients == 0){
									return row.fullname
								}else{
									return row.business_name
								}
									
							}
						},
						{targets: 2, "data":"name_insurers"},
						{targets: 3, "data":"name_branchs"},
						{targets: 4, "data":"type_poliza"},
						{targets: 5, "data":"state_policies"},
						{targets: 6, "data": "start_date"},
						{targets: 7, "data": null,
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

				methodsPays("#payment_method", "#payment_period", "#payment_terms", "#payment_date")

				StartSimulation(".start_simulation", "#payment_method", "#payment_period", "#payment_terms","#payment_date", "#total", "#table-simulation")

				GetPlacas("#placa")

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")

				cuadros("#cuadro1", "#cuadro2");
			}	




			


			function GetPlacas(select){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/vehicle',
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
			  		console.log(data)
					$(select).each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });

				   
					$(select+" option").remove();

					$(select).append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));

			  
					$.each(data, function(i, item){
					  
					  if (item.status == 1) {
						$(select).append($('<option>',
						{
						  value: item.placa,
						  text : item.placa
						}));

					  }
					});
			  
					$(select).selectize({
					  //sortField: 'text'
					});

				  }
				});
			}

			  



			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){

				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var info = table.row( $(this).parents("tr") ).data();

					var url=document.getElementById('ruta').value;

					$.ajax({
					  url:''+url+'/api/policies/'+info.id_policies,
					  type:'GET',
					  data: {
						  "id_user": id_user,
						  "token"  : tokens,
					  },
					  dataType:'JSON',
					  beforeSend: function(){
					  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					  },
					  error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					  },
					  success: function(data){


							$("#insurers_view").attr("disabled", "disabled")
							$("#branch_view").attr("disabled", "disabled")
							$("#clients_select_view").attr("disabled", "disabled")
							GetInsurers("#insurers_view", data.insurers)

							GetBranchByInsurers("#insurers_view", "#branch_view", data.branch+"|"+data.percentage_vat_cousin+"|"+data.commission_percentage, data.branch, data.type_poliza)
							GetClients("#clients_select_view", data.clients+"|"+data.type_clients);

							ChangeSelectBranch("#branch_view")

							if(data.type_poliza == "Collective"){
								$(".remove").css("display", "none")
								$(".remove-pay").css("display", "block")


								var url = "binds/"+data.id_policies+"/0"
								$('#iframeVinculadosView').attr('src', url);

							}else{
								$(".remove").css("display", "block")
								$(".remove-pay").css("display", "none")
							}


							$("#type_poliza_view").val(data.type_poliza).attr("disabled", "disabled")
							$("#number_policies_view").val(data.number_policies).attr("disabled", "disabled")
							$("#state_policies_view").val(data.state_policies).attr("disabled", "disabled")
							$("#expedition_date_view").val(data.expedition_date).attr("disabled", "disabled")
							$("#reception_date_view").val(data.reception_date).attr("disabled", "disabled")
							$("#start_date_view").val(data.start_date).attr("disabled", "disabled")
							$("#end_date_view").val(data.end_date).attr("disabled", "disabled")
							$("#risk_view").val(data.risk).attr("disabled", "disabled")

							$("#name_taker_view").val(data.name_taker).attr("disabled", "disabled")
							$("#identification_taker_view").val(data.identification_taker).attr("disabled", "disabled")
							$("#name_insured_view").val(data.name_insured).attr("disabled", "disabled")
							$("#identification_insured_view").val(data.identification_insured).attr("disabled", "disabled")
							$("#beneficairy_name_view").val(data.beneficairy_name).attr("disabled", "disabled")
							$("#beneficairy_identification_view").val(data.beneficairy_identification).attr("disabled", "disabled")

							$("#internal_observations_view").val(data.internal_observations).attr("disabled", "disabled")
							$("#observations_view").val(data.observations).attr("disabled", "disabled")


							$("#cousin_view").val(number_format(data.cousin, 2)).attr("disabled", "disabled")
							$("#xpenses_view").val(number_format(data.xpenses, 2)).attr("disabled", "disabled")
							$("#vat_view").val(number_format(data.vat, 2)).attr("disabled", "disabled")
							$("#percentage_vat_cousin_view").val(data.percentage_vat_cousin).attr("disabled", "disabled")
							$("#commission_percentage_view").val(data.commission_percentage).attr("disabled", "disabled")
							$("#participation_view").val(data.participation).attr("disabled", "disabled")
							$("#agency_commission_view").val(number_format(data.agency_commission, 2)).attr("disabled", "disabled")
							$("#total_view").val(number_format(data.total, 2)).attr("disabled", "disabled")

							$("#payment_period_view").val(data.payment_period).attr("disabled", "disabled")
							$("#payment_method_view").val(data.payment_method).attr("disabled", "disabled")
							$("#payment_terms_view").val(data.payment_terms).attr("disabled", "disabled")

							
							$("#insurers_view").trigger("change");
							data.is_renewable == 1 ? $("#is_renewable_view").prop("checked", true) : $("#is_renewable_view").prop("checked", false) 
							data.beneficiary_remission == 1 ? $("#beneficiary_remission_view").prop("checked", true) : $("#beneficiary_remission_view").prop("checked", false)
							data.beneficairy_onerous == 1 ? $("#beneficairy_onerous_view").prop("checked", true) : $("#beneficairy_onerous_view").prop("checked", false)

							data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_view").prop("checked", true)  : $("#send_policies_for_expire_email_view").prop("checked", false) 
							data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_view").prop("checked", true) : $("#send_portfolio_for_expire_email_view").prop("checked", false) 
							data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_view").prop("checked", true)    : $("#send_policies_for_expire_sms_view").prop("checked", false) 
							data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_view").prop("checked", true)   : $("#send_portfolio_for_expire_sms_view").prop("checked", false) 
							
							showPays(data.id_policies, "#table-simulation-view")

							var html = ""
							$.map(data.vehicules, function (item, key) {
								html += "<tr>"
									html +="<td><a target='_blank' href='vehicles/"+item.placa+"'>"+item.placa+"</a><input type='hidden' name='placas[]' value='"+item.placa+"'></td>"
									html +="<td></td>"
								html += "</tr>"
							});

							$("#table-placas-view").html(html)


							var url = "policies/annexes/"+data.id_policies+"/0"
							$('#iframeAnnexesView').attr('src', url);


							var url = "policies/files/"+data.id_policies+"/0"
							$('#iframeDigitalesView').attr('src', url);


							var url = "policies/wallet/"+data.id_policies+"/0"
							$('#iframeCarteraView').attr('src', url);



							cuadros('#cuadro1', '#cuadro3');


					  }
					});


				});

			}



			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");

					var info = table.row( $(this).parents("tr") ).data();

					var url=document.getElementById('ruta').value;

					$.ajax({
					  url:''+url+'/api/policies/'+info.id_policies,
					  type:'GET',
					  data: {
						  "id_user": id_user,
						  "token"  : tokens,
					  },
					  dataType:'JSON',
					  beforeSend: function(){
					  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					  },
					  error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					  },
					  success: function(data){
					
							GetInsurers("#insurers_edit", data.insurers)

							GetBranchByInsurers("#insurers_edit", "#branch_edit", data.branch+"|"+data.percentage_vat_cousin+"|"+data.commission_percentage,  data.branch, data.type_poliza)
							GetClients("#clients_select_edit", data.clients+"|"+data.type_clients);

							GetPlacas("#placa-edit")

							ChangeSelectBranch("#branch_edit", "_edit")

							$("#clients_edit").val(data.clients)
							$("#type_poliza_edit").val(data.type_poliza).attr("readonly", "readonly")
							$("#number_policies_edit").val(data.number_policies)
							$("#state_policies_edit").val(data.state_policies)
							$("#expedition_date_edit").val(data.expedition_date)
							$("#reception_date_edit").val(data.reception_date)
							$("#start_date_edit").val(data.start_date)
							$("#end_date_edit").val(data.end_date)
							$("#risk_edit").val(data.risk)

							if(data.type_poliza == "Collective"){
								$(".remove").css("display", "none")
								$(".remove-pay").css("display", "block")

								var url = "binds/"+data.id_policies+"/1"
								$('#iframeVinculadosEdit').attr('src', url);

							}else{
								$(".remove").css("display", "block")
								$(".remove-pay").css("display", "none")
							}



							$("#name_taker_edit").val(data.name_taker)
							$("#identification_taker_edit").val(data.identification_taker)
							$("#name_insured_edit").val(data.name_insured)
							$("#identification_insured_edit").val(data.identification_insured)
							$("#beneficairy_name_edit").val(data.beneficairy_name)
							$("#beneficairy_identification_edit").val(data.beneficairy_identification)

							$("#internal_observations_edit").val(data.internal_observations)
							$("#observations_edit").val(data.observations)


							$("#cousin_edit").val(number_format(data.cousin, 2))
							$("#xpenses_edit").val(number_format(data.xpenses, 2))
							$("#vat_edit").val(number_format(data.vat, 2))
							$("#percentage_vat_cousin_edit").val(data.percentage_vat_cousin)
							$("#commission_percentage_edit").val(data.commission_percentage)
							$("#participation_edit").val(data.participation)
							$("#agency_commission_edit").val(number_format(data.agency_commission, 2))
							$("#total_edit").val(number_format(data.total, 2))

							$("#payment_period_edit").val(data.payment_period)
							$("#payment_method_edit").val(data.payment_method)
							$("#payment_terms_edit").val(data.payment_terms)
							
							$("#insurers_edit").trigger("change");

							data.is_renewable          == 1 ? $("#is_renewable_edit").prop("checked", true)          : $("#is_renewable_edit").prop("checked", false) 
							data.beneficiary_remission == 1 ? $("#beneficiary_remission_edit").prop("checked", true) : $("#beneficiary_remission_edit").prop("checked", false)
							data.beneficairy_onerous   == 1 ? $("#beneficairy_onerous_edit").prop("checked", true)   : $("#beneficairy_onerous_edit").prop("checked", false)

							data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_edit").prop("checked", true)  : $("#send_policies_for_expire_email_edit").prop("checked", false) 
							data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_edit").prop("checked", true) : $("#send_portfolio_for_expire_email_edit").prop("checked", false) 
							data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_edit").prop("checked", true)    : $("#send_policies_for_expire_sms_edit").prop("checked", false) 
							data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_edit").prop("checked", true)   : $("#send_portfolio_for_expire_sms_edit").prop("checked", false) 
							

							showPays(data.id_policies, "#table-simulation-edit")


							var html = ""
							$.map(data.vehicules, function (item, key) {
								html += "<tr>"
									html +="<td><a target='_blank' href='vehicles/"+item.placa+"'>"+item.placa+"</a><input type='hidden' name='placas[]' value='"+item.placa+"'></td>"
									html +="<td></td>"
								html += "</tr>"
							});

							$("#table-placas-edit").html(html)




							var url = "policies/annexes/"+data.id_policies+"/1"
							$('#iframeAnnexesEdit').attr('src', url);
							

							var url = "policies/files/"+data.id_policies+"/1"
							$('#iframeDigitalesEdit').attr('src', url);


							var url = "policies/wallet/"+data.id_policies+"/1"
							$('#iframeCarteraEdit').attr('src', url);

							$("#id_edit").val(data.id_policies)

							cuadros('#cuadro1', '#cuadro4');


					  }
					});

				});
			}



			function StartSimulation(start_simulation, payment_method, payment_period, payment_terms, payment_date, amount, table){

				$(start_simulation).change(function (e) { 

					if((($(payment_method).val() == "Contado") && $(payment_date).val() != "") || (($(payment_period).val() != "") && ($(payment_terms).val() != "") && ($(payment_date).val() != ""))){


						$(table+' tbody').off('click');
						var url=document.getElementById('ruta').value; 
						
						$(table).DataTable({
							"destroy":true,
							"searching": false,
							"stateSave": true,
							"serverSide":false,
							"ajax":{
								"method":"POST",
								"url":''+url+'/api/policies/simulation/pay',
								"data": {
									"id_user"        : id_user,
									"token"          : tokens,
									"payment_method" : $(payment_method).val(),
									"payment_period" : $(payment_period).val(),
									"payment_terms"  : $(payment_terms).val(),
									"payment_date"   : $(payment_date).val(),
									"amount"         : $(amount).val()
								},
								"dataSrc":""
							},
							"columns":[
								
								{"data":"monthly_fee"},
								{"data":"payment_date"},
								{"data":"amount", 
									render:  function(data, type, row){
										return number_format(data, 2)
									}
								},
								
							],
							"language": idioma_espanol,
							"dom": 'Bfrtip',
							"ordering": false,
							"responsive": true,
							"buttons":[
								'copy', 'csv', 'excel', 'pdf', 'print'
							]
						});
					}
				});
			}




			function showPays(id_policie, table){

				$(table+' tbody').off('click');
				var url=document.getElementById('ruta').value; 
				
				$(table).DataTable({
					"destroy":true,
					"searching": false,
					"stateSave": true,
					"serverSide":false,
					"ajax":{
						"method":"GET",
						"url":''+url+'/api/policies/simulation/pay/'+id_policie,
						"data": {
							"id_user"        : id_user,
							"token"          : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"monthly_fee"},
						{"data":"payment_date"},
						{"data":"amount", 
							render:  function(data, type, row){
								return number_format(data, 2)
							}
						},
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,
					"buttons":[
						'copy', 'csv', 'excel', 'pdf', 'print'
					]
				});
			}


			function methodsPays(method_payment, payment_period, payment_terms, payment_date){
				
				$(method_payment).change(function (e) { 
					
					if($(this).val() == "Contado"){
						$(payment_period).attr("disabled", "disabled")
						$(payment_terms).attr("disabled", "disabled")
					}else{
						$(payment_period).removeAttr("disabled")
						$(payment_terms).removeAttr("disabled")
					}
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
									value: item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage,
									text : item.name,
									selected: branch == item.id_branch ? true : false
								}));
								});

							}else{
								console.log(data.branchs, value_default)
								console.log("sleected")

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


			function ChangeSelectBranch(select, option = ""){
				$(select).change(function (e) { 
					var array = $(this).val().split("|")

					var percentage_vat_cousin = array[1]
					var commission_percentage = array[2]

					$("#percentage_vat_cousin"+option).val(percentage_vat_cousin)
					$("#commission_percentage"+option).val(commission_percentage)
					
					calc("#cousin"+option, "#xpenses"+option, "#total"+option, "#percentage_vat_cousin"+option, "#vat"+option, "#commission_percentage"+option, "#agency_commission"+option, "#participation"+option)

				});
			}



			$("#cousin, #xpenses, #participation").keyup(function (e) { 
				calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission", "#participation")
			});


			$("#cousin_edit, #xpenses_edit, #participation_edit").keyup(function (e) { 
				calc("#cousin_edit", "#xpenses_edit", "#total_edit", "#percentage_vat_cousin_edit", "#vat_edit", "#commission_percentage_edit", "#agency_commission_edit", "#participation_edit")
			});


			$("#cousin_bind, #expenses_bind, #percentage_vat_bind, #total_bind").keyup(function (e) { 
				calc_bind("#cousin_bind",  "#expenses_bind", "#total_bind", "#percentage_vat_bind","#vat_bind")
			});


			function calc(input_cousin, input_xpenses, input_total, input_percentage_vat_cousin, input_vat, input_commission_percentage, agency_commission, participation){
				var value_cousin                      = inNum($(input_cousin).val())
				var value_xpenses                     = inNum($(input_xpenses).val())
				var value_percentage_vat_cousin       = inNum($(input_percentage_vat_cousin).val())
				var value_input_commission_percentage = inNum($(input_commission_percentage).val())
				var participation                     = inNum($(participation).val())
				
				var result_percentage_vat_cousin = inNum(((value_cousin + value_xpenses)/100) * value_percentage_vat_cousin)
				var result_commission_percentage = inNum(((value_cousin - (value_cousin*value_percentage_vat_cousin/100)) /100) * value_input_commission_percentage)
				
				var comission_total =  inNum(((result_commission_percentage / 100) * participation))

				
				var total = result_percentage_vat_cousin + value_cousin + value_xpenses

				$(input_vat).val(number_format(result_percentage_vat_cousin, 2))
				$(agency_commission).val(number_format(comission_total ,2))
				$(input_total).val(number_format(total, 2))
			}





			function calc_bind(input_cousin, input_xpenses, input_total, input_percentage_vat_cousin, input_vat){
				var value_cousin                      = inNum($(input_cousin).val())
				var value_xpenses                     = inNum($(input_xpenses).val())
				var value_percentage_vat_cousin       = inNum($(input_percentage_vat_cousin).val())
				
				var result_percentage_vat_cousin = inNum(((value_cousin + value_xpenses)/100) * value_percentage_vat_cousin)
				
				
				var total = result_percentage_vat_cousin + value_cousin + value_xpenses
				$(input_vat).val(number_format(result_percentage_vat_cousin, 2))
				$(input_total).val(number_format(total, 2))
			}



			function ShowBinds(data, table, option){
				
				var html = ""
				$.each(data, function (key, item) { 

					var btn_delete = "<button type='button' onclick='DeleteTr(\"" + "#tr_bind_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					var btn_view   = "<button type='button' onclick='ShowBind(this)' data='"+JSON.stringify(item)+"' class='btn btn-info btn-sm waves-effect waves-light '> <i class='fa fa-eye'  aria-hidden='true'></i></button>"

					html += "<tr>"
						html += "<td>"+item.name_affiliate+"</td>"
						html += "<td>"+item.document_affiliate+"</td>"
						html += "<td>"+btn_view+"</td>"
					html += "</tr>"
				});

				$(table+" tbody").html(html)
			}



			function ShowBind(input){
				$("#modal-lg").modal("show")
			}

			$("#btn-bind-policies").click(function (e) { 
				$('#count_fila').val('nuevo');
				$('#modal-lg input').removeAttr('disabled')
				$('#modal-lg select').removeAttr('disabled')
				$("#form-bind")[0].reset()
				$('#modal-lg #btn-add-bind').show();
			});


			$("#beneficairy_onerous_bind").change(function (e) { 
				if ($("#beneficairy_onerous_bind").is(':checked')){
					$("#beneficairy_onerous_input_bind").val(1)
				}else{
					$("#beneficairy_onerous_input_bind").val(0)
				}
				
			});

			var count = 0
			$("#form-bind").submit(function(e){
				e.preventDefault();

				var count_fila                  = $("#count_fila").val()
					var number_annexed                  = $("#number_anexo_bind").val()
					var number_affiliate_bind           = $("#number_affiliate_bind").val()
					var date_init_bind                  = $("#date_init_bind").val()
					var insured_object_bind             = $("#insured_object_bind").val()
					var cousin_bind                     = $("#cousin_bind").val()
					var name_affiliate_bind             = $("#name_affiliate_bind").val()
					var document_affiliate_bind         = $("#document_affiliate_bind").val()
					var relationship_bind               = $("#relationship_bind").val()
					var birthdate_bind                  = $("#birthdate_bind").val()
					var gender_bind                     = $("#gender_bind").val()
					var phone_bind                      = $("#phone_bind").val()
					var email_bind                      = $("#email_bind").val()
					var address_bind                    = $("#address_bind").val()
					var plan_bind                       = $("#plan_bind").val()
					var type_rate_bind                  = $("#type_rate_bind").val()
					var type_membership_bind            = $("#type_membership_bind").val()
					var percentage_vat_bind             = $("#percentage_vat_bind").val()
					var expenses_bind                   = $("#expenses_bind").val()
					var vat_bind                        = $("#vat_bind").val()
					var total_bind                      = $("#total_bind").val()
					var company_bind                    = $("#company_bind").val()
					var employee_bind                   = $("#employee_bind").val()
					var internal_observations_bind      = $("#internal_observations_bind").val()
					var observations_bind               = $("#observations_bind").val()
					var beneficairy_onerous_bind        = $("#beneficairy_onerous_input_bind").val()
					var beneficairy_name_bind           = $("#beneficairy_name_bind").val()
					var beneficairy_identification_bind = $("#beneficairy_identification_bind").val()


				var btn_delete = `
						<button type='button' onclick='editVinculacion("#tr_bind_${count}", ${count}, true)' class='btn btn-info btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-preview' aria-hidden='true'></i>
						</button>

						<button type='button' onclick='editVinculacion("#tr_bind_${count}", ${count})' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-save-edit' aria-hidden='true'></i>
						</button>

						<button type='button' onclick='DeleteTr("#tr_bind_${count}")' class='btn btn-danger btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='fa fa-trash' aria-hidden='true'></i>
						</button>

				`
				
				var values = "<input type='hidden'  name='number_annexed_bind[]' value='"+number_annexed+"'>"
				    values += "<input type='hidden' name='number_affiliate_bind[]' value='"+number_affiliate_bind+"'>"
				    values += "<input type='hidden' name='date_init_bind[]' value='"+date_init_bind+"'>"
				    values += "<input type='hidden' name='insured_object_bind[]' value='"+insured_object_bind+"'>"
				    values += "<input type='hidden' name='cousin_bind[]' value='"+cousin_bind+"'>"
				    values += "<input type='hidden' name='name_affiliate_bind[]' value='"+name_affiliate_bind+"'>"
				    values += "<input type='hidden' name='document_affiliate_bind[]' value='"+document_affiliate_bind+"'>"
				    values += "<input type='hidden' name='relationship_bind[]' value='"+relationship_bind+"'>"
				    values += "<input type='hidden' name='birthdate_bind[]' value='"+birthdate_bind+"'>"
				    values += "<input type='hidden' name='gender_bind[]' value='"+gender_bind+"'>"
				    values += "<input type='hidden' name='phone_bind[]' value='"+phone_bind+"'>"
				    values += "<input type='hidden' name='email_bind[]' value='"+email_bind+"'>"
					values += "<input type='hidden' name='address_bind[]' value='"+address_bind+"'>"
					values += "<input type='hidden' name='plan_bind[]' value='"+plan_bind+"'>"
				    values += "<input type='hidden' name='type_rate_bind[]' value='"+type_rate_bind+"'>"
				    values += "<input type='hidden' name='type_membership_bind[]' value='"+type_membership_bind+"'>"
				    values += "<input type='hidden' name='percentage_vat_bind[]' value='"+percentage_vat_bind+"'>"
				    values += "<input type='hidden' name='expenses_bind[]' value='"+expenses_bind+"'>"
				    values += "<input type='hidden' name='vat_bind[]' value='"+vat_bind+"'>"
				    values += "<input type='hidden' name='total_bind[]' value='"+total_bind+"'>"
				    values += "<input type='hidden' name='company_bind[]' value='"+company_bind+"'>"
				    values += "<input type='hidden' name='employee_bind[]' value='"+employee_bind+"'>"
				    values += "<input type='hidden' name='internal_observations_bind[]' value='"+internal_observations_bind+"'>"
				    values += "<input type='hidden' name='observations_bind[]' value='"+observations_bind+"'>"
				    values += "<input type='hidden' name='beneficairy_onerous_bind[]' value='"+beneficairy_onerous_bind+"'>"
				    values += "<input type='hidden' name='beneficairy_name_bind[]' value='"+beneficairy_name_bind+"'>"
				    values += "<input type='hidden' name='beneficairy_identification_bind[]' value='"+beneficairy_identification_bind+"'>"

				var html       = ""

				html += "<tr id='tr_bind_"+count+"'>"
					html += "<td>"+name_affiliate_bind+"</td>"
					html += "<td>"+document_affiliate_bind+"</td>"
					html += "<td>"+btn_delete+values+"</td>"
				html += "</tr>"

				if(count_fila != 'nuevo'){
					$('#tr_bind_'+count_fila).remove();
				}

				$("#table-bind tbody").append(html);

				$("#modal-lg").modal("hide")
				count++
        	});

			function editVinculacion(tr, countId, isinfo = false){
				let number_annexed_bind = document.querySelector(`${tr} input[name="number_annexed_bind[]"]`).value;
				let number_affiliate_bind = document.querySelector(`${tr} input[name="number_affiliate_bind[]"]`).value;
				let date_init_bind = document.querySelector(`${tr} input[name="date_init_bind[]"]`).value;
				let insured_object_bind = document.querySelector(`${tr} input[name="insured_object_bind[]"]`).value;
				let cousin_bind = document.querySelector(`${tr} input[name="cousin_bind[]"]`).value;
				let name_affiliate_bind = document.querySelector(`${tr} input[name="name_affiliate_bind[]"]`).value;
				let document_affiliate_bind = document.querySelector(`${tr} input[name="document_affiliate_bind[]"]`).value;
				let relationship_bind = document.querySelector(`${tr} input[name="relationship_bind[]"]`).value;
				let birthdate_bind = document.querySelector(`${tr} input[name="birthdate_bind[]"]`).value;
				let gender_bind = document.querySelector(`${tr} input[name="gender_bind[]"]`).value;
				let phone_bind = document.querySelector(`${tr} input[name="phone_bind[]"]`).value;
				let email_bind = document.querySelector(`${tr} input[name="email_bind[]"]`).value;
				let address_bind = document.querySelector(`${tr} input[name="address_bind[]"]`).value;
				let plan_bind = document.querySelector(`${tr} input[name="plan_bind[]"]`).value;
				let type_rate_bind = document.querySelector(`${tr} input[name="type_rate_bind[]"]`).value;
				let type_membership_bind = document.querySelector(`${tr} input[name="type_membership_bind[]"]`).value;
				let percentage_vat_bind = document.querySelector(`${tr} input[name="percentage_vat_bind[]"]`).value;
				let expenses_bind = document.querySelector(`${tr} input[name="expenses_bind[]"]`).value;
				let vat_bind = document.querySelector(`${tr} input[name="vat_bind[]"]`).value;
				let total_bind = document.querySelector(`${tr} input[name="total_bind[]"]`).value;
				let company_bind = document.querySelector(`${tr} input[name="company_bind[]"]`).value;
				let employee_bind = document.querySelector(`${tr} input[name="employee_bind[]"]`).value;
				let internal_observations_bind = document.querySelector(`${tr} input[name="internal_observations_bind[]"]`).value;
				let observations_bind = document.querySelector(`${tr} input[name="observations_bind[]"]`).value;
				let beneficairy_onerous_bind = document.querySelector(`${tr} input[name="beneficairy_onerous_bind[]"]`).value;
				let beneficairy_name_bind = document.querySelector(`${tr} input[name="beneficairy_name_bind[]"]`).value;
				let beneficairy_identification_bind = document.querySelector(`${tr} input[name="beneficairy_identification_bind[]"]`).value

				$("#btn-bind-policies").click();

				$('#count_fila').val(countId);
				$("#number_anexo_bind").val(number_annexed_bind)
				$("#number_affiliate_bind").val(number_affiliate_bind)
				$("#date_init_bind").val(date_init_bind)
				$("#insured_object_bind").val(insured_object_bind)
				$("#cousin_bind").val(cousin_bind)
				$("#name_affiliate_bind").val(name_affiliate_bind)
				$("#document_affiliate_bind").val(document_affiliate_bind)
				$("#relationship_bind").val(relationship_bind)
				$("#birthdate_bind").val(birthdate_bind)
				$("#gender_bind").val(gender_bind)
				$("#phone_bind").val(phone_bind)
				$("#email_bind").val(email_bind)
				$("#address_bind").val(address_bind)
				$("#plan_bind").val(plan_bind)
				$("#type_rate_bind").val(type_rate_bind)
				$("#type_membership_bind").val(type_membership_bind)
				$("#percentage_vat_bind").val(percentage_vat_bind)
				$("#expenses_bind").val(expenses_bind)
				$("#vat_bind").val(vat_bind)
				$("#total_bind").val(total_bind)
				$("#company_bind").val(company_bind)
				$("#employee_bind").val(employee_bind)
				$("#internal_observations_bind").val(internal_observations_bind)
				$("#observations_bind").val(observations_bind)

				if(beneficairy_onerous_bind == '1'){
					$("#beneficairy_onerous_bind").attr('checked', true);
				}
				else{
					$("#beneficairy_onerous_bind").attr('checked', false);
				}

				$("#beneficairy_onerous_input_bind").val(beneficairy_onerous_bind)

				$("#beneficairy_name_bind").val(beneficairy_name_bind)
				$("#beneficairy_identification_bind").val(beneficairy_identification_bind)

				if(isinfo){
					$('#modal-lg input').attr('disabled', true)
					$('#modal-lg select').attr('disabled', true)
					$('#modal-lg #btn-add-bind').hide();
				}

			}

			$("#clients_select").change(function (e) { 
				var arrayClient = $(this).val().split("|")
				$("#clients").val(arrayClient[0])
				$("#type_clients").val(arrayClient[1])
			});


			$("#clients_select_edit").change(function (e) { 
				var arrayClient = $(this).val().split("|")
				$("#clients_edit").val(arrayClient[0])
				$("#type_clients_edit").val(arrayClient[1])
			});


			$("#type_poliza").change(function (e) { 
				
				if($(this).val() == "Collective"){
					$(".remove").css("display", "none")
					$(".remove-pay").css("display", "block")
				}else{
					$(".remove").css("display", "block")
					$(".remove-pay").css("display", "none")
				}
				
			});




			$("#birthdate_bind").change(function (e) { 
			  $("#age_bind").val(calcularEdad($(this).val()))
		  	});


			$("#add-vehicle").click(function (e) { 
				var placa = $("#placa").val()
				var html = ""

				html += "<tr>"
					html +="<td><a target='_blank' href='vehicles/"+placa+"'>"+placa+"<input type='hidden' name='placas[]' value='"+placa+"'></a></td>"
					html +="<td></td>"
				html += "</tr>"

				$("#table-placas").append(html)
			});
			
			$("#add-vehicle-edit").click(function (e) { 
				var placa = $("#placa-edit").val()
				var html = ""

				html += "<tr>"
					html +="<td><a target='_blank' href='vehicles/"+placa+"'>"+placa+"<input type='hidden' name='placas[]' value='"+placa+"'></a></td>"
					html +="<td></td>"
				html += "</tr>"

				$("#table-placas-edit").append(html)
			});



		

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_policies+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-policies/'+data.id_policies+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_policies+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>
	@endsection


