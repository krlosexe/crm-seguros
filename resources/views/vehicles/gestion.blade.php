@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Vehículos</h4>
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
											
											<th>Número de placa</th>
											<th>Tipo de vehículo</th>
											<th>Marca</th>
											<th>Valor Fasecolda</th>
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

			@include('vehicles.store')
			@include('vehicles.view')
			@include('vehicles.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Vehículos").addClass("show");
				$("#nav_li_Vehículos").addClass("open");
				$("#nav_people").addClass("active");

				$("#nav_users, #modulo_Vehículos").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");


				$(".selectized").selectize({
						//sortField: 'text'
					});


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
						 "url":''+url+'/api/people',
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

				ShowTypeVehicule("#type_vehicule")

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
					$("#weight_view").val(data.weight).attr("disabled", "disabled")
					$("#height_view").val(data.height).attr("disabled", "disabled")
					$("#eps_view").val(data.eps).attr("disabled", "disabled")
					$("#gender_view").val(data.gender).attr("disabled", "disabled")
					$("#birthdate_view").val(data.birthdate).attr("disabled", "disabled")
					$("#stratum_view").val(data.stratum).attr("disabled", "disabled")

					$("#age_view").val(calcularEdad(data.birthdate)).attr("disabled", "disabled")

					data.data_treatment == 1 ? $("#data_treatment_view").prop("checked", true) : $("#data_treatment_view").prop("checked", false) 
					$("#data_treatment_view").attr("disabled", "disabled")
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
					$("#own_house_view").prop("checked", true).attr("disabled", "disabled")
					$("#children_view").attr("disabled", "disabled")
					$("#vehicle_view").attr("disabled", "disabled")
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



					$("#send_policies_for_expire_email_view").attr("disabled", "disabled")
					$("#send_portfolio_for_expire_email_view").attr("disabled", "disabled")
					$("#send_policies_for_expire_sms_view").attr("disabled", "disabled")
					$("#send_portfolio_for_expire_sms_view").attr("disabled", "disabled")
					$("#send_birthday_card_view").attr("disabled", "disabled")       


					$("#occupation_view").val(data.occupation).attr("disabled", "disabled")
					$("#company_view").val(data.company).attr("disabled", "disabled")


					var url = "clients/people/files/"+data.id_clients_people+"/0"
					$('#iframeView').attr('src', url);


					var url = "clients/people/policies/"+data.id_clients_people+""
					$('#iframePoliciesView').attr('src', url);

					var url = "clients/people/wallet/"+data.id_clients_people+"/0"
					$('#iframeCarteraView').attr('src', url);


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
					$("#weight_edit").val(data.weight)
					$("#height_edit").val(data.height)
					$("#eps_edit").val(data.eps)
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

					$("#id_edit").val(data.id_clients_people)

					showCasa("#own_house_edit", "#number_house_edit")
					showHijos("#children_edit", ".container-datos-adicionales-hijo-edit")
					showVehicle("#vehicle_edit", ".container-datos-adicionales-vehicle-edit")

					AddChildren("#add-children-edit", "#dato-extra-hijo-container-edit")
					AddVehicle("#add-vehicle-edit", "#dato-extra-vehicle-container-edit")


					var url = "clients/people/files/"+data.id_clients_people+"/1"
					$('#iframeEdit').attr('src', url);


					var url = "clients/people/policies/"+data.id_clients_people+""
					$('#iframePolizasEdit').attr('src', url);


					var url = "clients/people/wallet/"+data.id_clients_people+"/1"
					$('#iframeCarteraEdit').attr('src', url);

					cuadros('#cuadro1', '#cuadro4');
				});
			}
			


			function ShowTypeVehicule(select, select_default = false){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule',
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
					  
					  
						$(select).append($('<option>',
						{
						  value: item.clase,
						  text : item.clase,
						  selected: select_default == item.id_type_sub_company ? true : false
						}));
					 
					});
			  
					
				  }
				});
			  }




			  $("#type_vehicule").change(function (e) { 
				  
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/',
				  type:'GET',
				  data: {
					  "clase"  : $(this).val(),
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
			  
					$("#marca").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#marca option").remove();
					$("#marca").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#marca").append($('<option>',
						{
						  value: item.marca,
						  text : item.marca,
						}));
					 
					});

					$("#marca").selectize({
						//sortField: 'text'
					});
			  
					
				  }
				});
				  
			  });


			  $("#marca").change(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/line/',
				  type:'GET',
				  data: {
					  "marca"  : $(this).val(),
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
			  
					$("#line").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#line option").remove();
					$("#line").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#line").append($('<option>',
						{
						  value: item.referencia1,
						  text : item.referencia1,
						}));
					 
					});

					$("#line").selectize({
						//sortField: 'text'
					});
			  
				  }
				});
				  
			  });










			  $("#line").change(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/line/refer2',
				  type:'GET',
				  data: {
					  "line"  : $(this).val(),
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
			  
					$("#refer2").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#refer2 option").remove();
					$("#refer2").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#refer2").append($('<option>',
						{
						  value: item.referencia2,
						  text : item.referencia2,
						}));
					 
					});

					$("#refer2").selectize({
						//sortField: 'text'
					});
			  
				  }
				});
				  
			  });



		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-people/'+data.id_clients_people+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-people/'+data.id_clients_people+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-people/'+data.id_clients_people+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


