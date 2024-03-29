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
								<button onclick="nuevo()" id="btn-new" class="btn btn-success" style="float: left;">
									<i class="ti-user"></i>
									<span>Nuevo</span>
								</button>

								<br>
									
								<div class="table-overflow">

									<table class="table table-bordered" id="table" width="100%" cellspacing="0">



										<div id="table_filter" class="dataTables_filter"><label style="float: right;">Buscar:
											<input type="search" id="search" class="form-control form-control-sm" placeholder="" aria-controls="table"></label>
										</div>


										<thead>
											<tr>
											
											<th>Nombres</th>
											<th>Apellidos</th>
											<th>Tipo de Documento</th>
											<th>Número de Documento</th>
											<th>Fecha de registro</th>
											<th>Acciones</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>


									<div class="dataTables_info" id="table_info" role="status" aria-live="polite"></div>

									<div class="dataTables_paginate paging_simple_numbers">
										<ul class="pagination"></ul>
									</div>


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
				$("#nav_people").addClass("active");

				$("#nav_users, #modulo_Clientes").addClass("active");

				verifyPersmisos(id_user, tokens, "people");


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



			$("#search").keyup(function (e) {
				list("", 1)
			});

			var number_page = 1
			function list(cuadro = "", page = 1){


				number_page = page
				var url=document.getElementById('ruta').value;

				cuadros(cuadro, "#cuadro1");

				if($("#search").val() != ""){
					var search = $("#search").val()
				}else{
					var search = null
				}


				$.ajax({
					url:''+url+'/api/peoples/paginate',
					type:'GET',
					data: {
						"id_user" : id_user,
						"token"   : tokens,
						"page"    : page,
						"search"  : search
					},
					dataType:'JSON',

					beforeSend: function(){

						var html = ""
						 html += "<tr>"
								html += "<td colspan='8'> Cargando...</td>"
							html += "</tr>"

						$("#table tbody").html(html)
					},
					error: function (data) {
					},
					success: function(result){

						var html = ""

						if(result.data.length == 0){
							html += "<tr>"
								html += "<td colspan='8'> No se encontraron Resultados...</td>"
							html += "</tr>"
						$("#table tbody").html(html)
							return false;
						}


						$.map(result.data, function (item, key) {

							var botones = "";

							if(consultar == 1)
								botones += "<span data='"+JSON.stringify(item)+"'  class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
							if(actualizar == 1)
								botones += "<span data='"+JSON.stringify(item)+"'  class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
							if(item.status == 1 && actualizar == 1)
								botones += "<span data='"+JSON.stringify(item)+"'  class='desactivar btn btn-warning waves-effect' data-toggle='tooltip' title='Desactivar'><i class='fa fa-unlock' style='margin-bottom:5px'></i></span> ";
							else if(item.status == 2 && actualizar == 1)
								botones += "<span data='"+JSON.stringify(item)+"'  class='activar btn btn-success waves-effect' data-toggle='tooltip' title='Activar'><i class='fa fa-lock' style='margin-bottom:5px'></i></span> ";
							if(borrar == 1)
								botones += "<span data='"+JSON.stringify(item)+"'  class='eliminar btn btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='ei-delete-alt' style='margin-bottom:5px'></i></span>";

							html += "<tr>"
								html += `<td>${item.names}</td>`
								html += `<td>${item.last_names}</td>`
								html += `<td>${item.type_document}</td>`
								html += `<td>${item.number_document}</td>`
								html += `<td>${item.fec_regins}</td>`
								html += "<td>"+botones+"</td>"
							html += "</tr>"

							var table = $("#table tbody").html(html)



							if(result.next_page_url != null){
								var next = result.next_page_url.split("page=")[1]
								var className = ''
							}else{
								var next = result.last_page
								var className = 'disabled'
							}


							if(result.prev_page_url != null){
								var prev = result.prev_page_url.split("page=")[1]
								var className = ''
							}else{
								var prev = 1;
								var className = 'disabled'
							}


							var li = ""
							li  += '<li class="paginate_button page-item previous '+className+'" onclick="list(\'\', '+prev+')" id="table_previous"><a href="javascript:void(0)" aria-controls="table" data-dt-idx="0" tabindex="0" class="page-link">Anterior</a></li>'

							li += '<li class="paginate_button page-item next" onclick="list(\'\', '+next+')" id="table_next"><a href="javascript:void(0)" aria-controls="table" data-dt-idx="8" tabindex="0" class="page-link">Siguiente</a></li>'

							$(".pagination").html(li)


							$("#table_info").text("Mostrando registros del "+result.from+" al  "+result.to+" de un total de "+result.total+" registros")




						})


					}
				});


				ver("#table tbody")
				edit("#table tbody")
				activar("#table tbody")
				desactivar("#table tbody")
				eliminar("#table tbody")




			}


			function list2(cuadro) {
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
						
						{"data":"names", targets: 0},
						{"data":"last_names", targets: 1},
						{"data":"type_document", targets: 2},
						{"data":"number_document", targets: 3},
						{"data": "fec_regins", targets: 4},
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
						}
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,
					"buttons": buttonsDatatable({
						title: 'Clientes - Personas',
						filename: 'clientes-personas',
						columns: [0,1,2,3,4]
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
				$(".container-datos-adicionales-hijo").css("display", "none");
				$(".container-datos-adicionales-vehicle").css("display", "none");

				showCasa("#own_house", "#number_house")

				showHijos("#children", ".container-datos-adicionales-hijo")
				

				AddChildren("#add-children", "#dato-extra-hijo-container")
				$("#dato-extra-hijo-container").html("")

				showVehicle("#vehicle", ".container-datos-adicionales-vehicle")
				AddVehicle("#add-vehicle", "#dato-extra-vehicle-container")

				GetDepartament("#departament")

				cuadros("#cuadro1", "#cuadro2");

			}


			

			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");


					var data = JSON.parse($(this).attr("data"))

					//var data = table.row( $(this).parents("tr") ).data();


					GetDepartament("#departament_view", data.id_department)

					ChangeDepartament("#departament_view", "#municipios_view", data.id_city)


					$("#type_document_view").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });




					$("#names_view").val(data.names).attr("disabled", "disabled")
					$("#last_names_view").val(data.last_names).attr("disabled", "disabled")
					$("#type_document_view").val(data.type_document).attr("disabled", "disabled")


					$("#type_document_view").selectize({
					  //sortField: 'text'
					});



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

					$("#departament_view").trigger("change");


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


					var url = "clients/people/policies/"+data.id_clients_people+"/0"
					$('#iframePoliciesView').attr('src', url);

					var url = "clients/people/wallet/"+data.id_clients_people+"/0"
					$('#iframeCarteraView').attr('src', url);


					var url = "clients/people/sinister/"+data.id_clients_people+"/1"
					$('#iframeSinisterView').attr('src', url);



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
					var data = JSON.parse($(this).attr("data"))
					

					GetDepartament("#departament_edit", data.id_department)

					ChangeDepartament("#departament_edit", "#municipios_edit", data.id_city)

					$("#departament_edit").trigger("change");


					$("#type_document_edit").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });





					$("#names_edit").val(data.names)
					$("#last_names_edit").val(data.last_names)
					$("#type_document_edit").val(data.type_document)

					$("#type_document_edit").selectize({
					  //sortField: 'text'
					});


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



					Digitales("#iframeEdit", "#tab-digitales-edit" ,data.id_clients_people)
					Polizas("#iframePolizasEdit", "#tab-polizas-edit" ,data.id_clients_people)
					Cartera("#iframeCarteraEdit", "#tab-cartera-edit" ,data.id_clients_people)
					Siniestros("#iframeSinisterEdit", "#tab-siniestro-edit" ,data.id_clients_people)

					
					// var url = "clients/people/files/"+data.id_clients_people+"/1"
					// $('#iframeEdit').attr('src', url);

					// var url = "clients/people/policies/"+data.id_clients_people+"/0"
					// $('#iframePolizasEdit').attr('src', url);


					// var url = "clients/people/wallet/"+data.id_clients_people+"/1"
					// $('#iframeCarteraEdit').attr('src', url);


					//var url = "clients/people/sinister/"+data.id_clients_people+"/1"
				//	$('#iframeSinisterEdit').attr('src', url);



					cuadros('#cuadro1', '#cuadro4');
				});
			}


			function Digitales(iframe, tab, id_client){
				$(tab).click(function (e) { 
					var url = "clients/people/files/"+id_client+"/1"
					$(iframe).attr('src', url);
				});
			}


			function Polizas(iframe, tab, id_client){
				$(tab).click(function (e) { 
					var url = "clients/people/policies/"+id_client+"/0"
					$(iframe).attr('src', url);
				});
			}



			function Cartera(iframe, tab, id_client){
				$(tab).click(function (e) { 
					var url = "clients/people/wallet/"+id_client+"/1"
					$(iframe).attr('src', url);
				});
			}


			function Siniestros(iframe, tab, id_client){
				$(tab).click(function (e) { 
					var url = "clients/people/sinister/"+id_client+"/1"
					$(iframe).attr('src', url);
				});
			}




			var count = 0

			$("#add-file").click(function (e) { 
				
				var html = "";
				count++

				html += '<div class="col-md-6" id="file-'+count+'">'
					html += '<div class="row">'
						html += '<div class="col-md-6">'
							html += ' <label for=""><b>Titulo *</b></label>'
							html += '<div class="form-group valid-required">'
								html += '<input type="text" name="titles[]" class="form-control form-control-user" required>'
							html += '</div>'
						html += '</div>'


						html += '<div class="col-md-6">'
							html += ' <label for=""><b>Descripcion *</b></label>'
							html += '<div class="form-group valid-required">'
								html += '<input type="text" name="descriptions[]" class="form-control form-control-user" id="description" required>'
							html += '</div>'
						html += '</div>'

					html += '</div>'
					html += '<br>'


					html += '<div class="row">'
						html += '<div class="col-md-12 text-center">'
							html += '<div class="kv-avatar">'
								html += '<div class="file-loading">'
									html += '<input id="input-file-'+count+'" name="file[]" type="file" required>'
								html += '</div>'
							html += '</div>'

							html += '<div class="kv-avatar-hintss">'
								html += '<small>Seleccione una foto</small>'
							html += '</div>'

						html += '</div>'
					html += '</div>'
					html += '<br>'
					html += '<br>'
				html += '</div>'


				$("#content-file").append(html);
				CreateInputFile("#input-file-"+count)
			});



			function CreateInputFile(input){
				$(input).fileinput({
					theme: "fas",
					overwriteInitial: true,
					maxFileSize: 10000,
					showClose: false,
					showCaption: false,
					browseLabel: '',
					removeLabel: '',
					browseIcon: '<i class="fa fa-folder-open"></i>',
					removeIcon: '<i class="ei-delete-alt"></i>',
					previewFileIcon: '<i class="fas fa-file"></i>',
					removeTitle: 'Cancel or reset changes',
					elErrorContainer: '#kv-avatar-errors-1',
					msgErrorClass: 'alert alert-block alert-danger',
					layoutTemplates: {main2: '{preview}  {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif", "pdf"],
				});
			}




			function showCasa(check, input){
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(input).val("").removeAttr("disabled").focus();
						$(input).attr("required", "required");
					}else{
						$(input).val(0).attr("disabled", "disabled");
						$(input).removeAttr("required");
					}
					
				});
			}



			function showHijos(check, table){
				
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(table).css("display", "block");
					}else{
						$(table).css("display", "none");
						$(table+" table tbody tr").remove()
					}
					
				});
			}
	
			
			function AddChildren(btn, table){
				var count_children = 0
				
				$(btn).unbind().click(function (e) { 
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
					count_children++
					$(table).append(html)
				});
			}


			function ShowChildren(table, data, option){
				var html = ""

				var count = 0

				
				$.each(data, function (key, item) { 
					var input_name      = "<input type='text' name=name_children[] value='"+item.name+"'  class='form-control' required placeholder='Nombres'>"
					var input_phone     = "<input type='text' name=phone_children[] value='"+item.phone+"'  class='form-control' required placeholder='Telefono'>"
					var input_birthdate = "<input type='date' name=birthdate_children[] class='form-control' value='"+item.birthdate+"' required placeholder='Birthdate'>"
					var btn_delete = "" 
					if(option != "view"){
						btn_delete = "<button type='button' onclick='DeleteTr(\"" + "#tr_childred_edit_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					}
					
					
					
					html += "<tr id='tr_childred_edit_"+count+"'>"
						html +="<td>"+input_name+"</td>"
						html +="<td>"+input_phone+"</td>"
						html +="<td>"+input_birthdate+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"


					count++
				});	
					
				$(table).html(html)
				
			}



			function ShowVehicle(table, data, option){
				var count_vehicle_edit = 0;
				var html = ""
				$.each(data, function (key, item) { 

					var input_placa     = "<input type='text' name=placa_vehicle[] value='"+item.placa+"' class='form-control' placeholder='Placa'>"
					var date_soat       = "<input type='date' name=date_soat[]     value='"+item.date_soat+"' class='form-control' placeholder='Fecha vencimiento SOAT'>"
					var date_impuestos  = "<input type='date' name=date_taxes[]    value='"+item.date_taxes+"' class='form-control' placeholder='Fecha pago de impuestos'>"
					var date_tecno      = "<input type='date' name=date_tecno[]    value='"+item.date_tecno+"' class='form-control' placeholder='Fecha vencimiento tecnomecánica'>"
					var btn_delete = "" 

					if(option != "view"){
						var btn_delete      = "<button type='button' onclick='DeleteTr(\"" + "#tr_vehicle_edit" + count_vehicle_edit +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					}
					
					html += "<tr id='tr_vehicle_edit"+count_vehicle_edit+"'>"
						html +="<td>"+input_placa+"</td>"
						html +="<td>"+date_soat+"</td>"
						html +="<td>"+date_impuestos+"</td>"
						html +="<td>"+date_tecno+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"

					count_vehicle_edit++
				});	
					

				$(table).html(html)
			}




			




			function showVehicle(check, table){
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(table).css("display", "block");
					}else{
						$(table).css("display", "none");
						$(table+" table tbody tr").remove()
					}
					
				});
			}

			
			var count_vehicle = 0
			function AddVehicle(btn, table){
				$(btn).unbind().click(function (e) { 
					e.preventDefault();
					var input_placa     = "<input type='text' name=placa_vehicle[]  required class='form-control' placeholder='Placa'>"
					var date_soat       = "<input type='date' name=date_soat[]      required class='form-control' placeholder='Fecha vencimiento SOAT'>"
					var date_impuestos  = "<input type='date' name=date_taxes[]     required class='form-control' placeholder='Fecha pago de impuestos'>"
					var date_tecno      = "<input type='date' name=date_tecno[]     required class='form-control' placeholder='Fecha vencimiento tecnomecánica'>"
					var btn_delete      = "<button type='button' onclick='DeleteTr(\"" + "#tr_vehicle" + count_vehicle +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					
					var html = ""
					html += "<tr id='tr_vehicle"+count_vehicle+"'>"
						html +="<td>"+input_placa+"</td>"
						html +="<td>"+date_soat+"</td>"
						html +="<td>"+date_impuestos+"</td>"
						html +="<td>"+date_tecno+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"

					count_vehicle++

					$(table).append(html)
				});
			}



			$("#birthdate").change(function (e) { 
			  $("#age").val(calcularEdad($(this).val()))
		  	});


			  $("#birthdate_edit").change(function (e) { 
				$("#age_edit").val(calcularEdad($(this).val()))
				});




			$("#departament").change(function (e) { 
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/departamentos/municipios/'+$(this).val(),
				  type:'GET',
				  dataType:'JSON',
				  async: false,
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$("#municipios").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#municipios option").remove();
					$("#municipios").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					 
						$("#municipios").append($('<option>',
						{
						  value: item.id,
						  text : item.nombre
						}));
					  
					});
			  
					$("#municipios").selectize({
					  //sortField: 'text'
					});
				  }
				});
				
			});



			function ChangeDepartament(select, municipios, select_default = false){
				$(select).change(function (e) { 
					
					console.log(select_default)
					var url=document.getElementById('ruta').value;
					$.ajax({
					url:''+url+'/api/departamentos/municipios/'+$(this).val(),
					type:'GET',
					dataType:'JSON',
					beforeSend: function(){
					// mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					},
					error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					},
					success: function(data){
				
						$(municipios).each(function() {
						if (this.selectize) {
							this.selectize.destroy();
						}
					});
					
						$(municipios+" option").remove();
						$(municipios).append($('<option>',
						{
						value: "null",
						text : "Seleccione"
						}));
				
						$.each(data, function(i, item){
						
							$(municipios).append($('<option>',
							{
								value: item.id,
								text : item.nombre,
								selected: select_default == item.id ? true : false
							}));
						
						});
				
						$(municipios).selectize({
						//sortField: 'text'
						});
					}
					});
					
				});
			}

			


				
			function GetDepartament(select, select_default = false){	

				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/departamentos',
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
						  value: item.id,
						  text : item.nombre,
						  selected: select_default == item.id ? true : false
						}));
					  
					});
			  
					$(select).selectize({
					  //sortField: 'text'
					});
				  }
				});
			}







		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					//var data=table.row($(this).parents("tr")).data();

					var data = JSON.parse($(this).attr("data"))


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
					//var data=table.row($(this).parents("tr")).data();

					var data = JSON.parse($(this).attr("data"))


					statusConfirmacion('api/status-people/'+data.id_clients_people+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					//var data=table.row($(this).parents("tr")).data();

					var data = JSON.parse($(this).attr("data"))


					statusConfirmacion('api/status-people/'+data.id_clients_people+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


