@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Siniestros.</h4>
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
												<th>Numero de Siniestro</th>
												<th>Fecha Siniestro</th>
												<th>Póliza</th>
												<th>Estado</th>
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

			@include('policies.sinister.store')
			@include('policies.sinister.view')
			@include('policies.sinister.edit')

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
				$("#nav_sinister").addClass("active");
				verifyPersmisos(id_user, tokens, "sinister");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/sinister', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/sinister', '#cuadro2');
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
						 "url":''+url+'/api/sinister',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_sinister"},
						{"data":"date_sinister"},
						{"data":"number_policies"},
						{"data":"state_policie"},
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
				
				//GetClients("#clients_select");
				GetPolicies("#policie")
				
				GetPoliciesById("#policie", "#insures", "#branch", "#insured_name", "#document_insured")

				addAmparos("#add-amparo", "#amparos")

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


					GetPolicies("#policie_view", data.policie)

					GetPoliciesById("#policie_view", "#insures_view", "#branch_view", "#insured_name_view", "#document_insured_view")

					$("#state_policie_view").val(data.state_policie).attr("disabled", "disabled")
					$("#number_sinister_view").val(data.number_sinister).attr("disabled", "disabled")
					$("#type_sinister_view").val(data.type_sinister).attr("disabled", "disabled")
					$("#date_sinister_view").val(data.date_sinister).attr("disabled", "disabled")
					$("#date_notice_view").val(data.date_notice).attr("disabled", "disabled")
					$("#date_notification_insurers_view").val(data.date_notification_insurers).attr("disabled", "disabled")
					$("#assigned_provider_view").val(data.assigned_provider).attr("disabled", "disabled")
					$("#descriptions_view").val(data.descriptions).attr("disabled", "disabled")

					$("#policie_view").val(data.policie).attr("disabled", "disabled")
					$("#policie_view").trigger("change")
					$("#policie_view").attr("disabled", "disabled")

					$("#compensation_value_view").val(data.compensation_value).attr("disabled", "disabled")
					$("#deductible_view").val(data.deductible).attr("disabled", "disabled")
					$("#claim_amount_view").val(data.claim_amount).attr("disabled", "disabled")
					$("#coinsurance_view").val(data.coinsurance).attr("disabled", "disabled")
					$("#finalized_view").val(data.finalized).attr("disabled", "disabled")

					data.finalized   == 1 ? $("#finalized_view").prop("checked", true)   : $("#finalized_view").prop("checked", false)
					
					
					ShowAmparos(data.sinister_amparos_affected, "#amparos-view", "#total_amparos_view", "view")
					
					var url = "policies/sinister/files/"+data.id_sinister+"/0"
					$('#iframeView').attr('src', url);
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
					
					
					GetPolicies("#policie_edit", data.policie)

					GetPoliciesById("#policie_edit", "#insures_edit", "#branch_edit", "#insured_name_edit", "#document_insured_edit")

					$("#state_policie_edit").val(data.state_policie)
					$("#number_sinister_edit").val(data.number_sinister)
					$("#type_sinister_edit").val(data.type_sinister)
					$("#date_sinister_edit").val(data.date_sinister)
					$("#date_notice_edit").val(data.date_notice)
					$("#date_notification_insurers_edit").val(data.date_notification_insurers)
					$("#assigned_provider_edit").val(data.assigned_provider)
					$("#descriptions_edit").val(data.descriptions)

					$("#policie_edit").val(data.policie)
					$("#policie_edit").trigger("change")
					$("#policie_edit")

					$("#compensation_value_edit").val(data.compensation_value)
					$("#deductible_edit").val(data.deductible)
					$("#claim_amount_edit").val(data.claim_amount)
					$("#coinsurance_edit").val(data.coinsurance)
					$("#finalized_edit").val(data.finalized)

					data.finalized   == 1 ? $("#finalized_edit").prop("checked", true)   : $("#finalized_edit").prop("checked", false)
					
					ShowAmparos(data.sinister_amparos_affected, "#amparos-edit", "#total_amparos_edit", "edit")

					addAmparos("#add-amparo-edit", "#amparos-edit")


					$("#id_edit").val(data.id_sinister)

					var url = "policies/sinister/files/"+data.id_sinister+"/1"
					$('#iframeEdit').attr('src', url);



					cuadros('#cuadro1', '#cuadro4');
				});
			}



			function addAmparos(btn, table) {
				var count = 0;
				$(btn).unbind().click(function (e) { 
					e.preventDefault();
					count++
					var btn_delete = "<button type='button' onclick='DeleteTrSinister(\"" + "#tr_" + count +"\");' class='btn btn-danger btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					var html = "<tr id='tr_"+count+"'>"
							html += "<td><input type='text' name='name_claimant_sinister[]' class='form-control form-control-user' required></td>"
							html += "<td><input type='text' name='amparo_sinister[]' class='form-control form-control-user' required></td>"
							html += "<td><input type='text' name='value_sinister[]' class='form-control form-control-user monto_formato_decimales valor_amparos' style='text-align: right' required></td>"
							html += "<td>"+btn_delete+"</td>"
					    html += "</tr>"
						
					$(table).append(html);

					$(".monto_formato_decimales").change(function() {   
						if($(this).val() != ""){  
							$(this).val(number_format($(this).val(), 2));   
						}       
					});

					$(".valor_amparos").keyup(function (e) { 
						calc("#total_amparos", "#amparos tr")
					});


					$(".valor_amparos").keyup(function (e) { 
						calc("#total_amparos_edit", "#amparos-edit tr")
					});

				});
			}


			function ShowAmparos(amparos, table, total_input, option){

				var html  = ""
				var total = 0
				var count = 0
				$.each(amparos, function (key, item) { 
					
					count++

					total = total + inNum(item.value)

					var btn_delete = ""
					option == "view" ?  btn_delete = "" :  btn_delete = "<button type='button' onclick='DeleteTrSinister(\"" + "#tr_edit_" + count +"\")' class='btn btn-danger btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					html += "<tr id='tr_edit_"+count+"'>"

						html += "<td><input type='text' name='name_claimant_sinister[]' class='form-control form-control-user' value='"+item.name_claimant+"'></td>"
						html += "<td><input type='text' name='amparo_sinister[]' class='form-control form-control-user' value='"+item.amparo+"'></td>"
						html += "<td><input type='text' name='value_sinister[]'  class='form-control form-control-user monto_formato_decimales valor_amparos' style='text-align: right' value='"+number_format(item.value, 2)+"'></td>"
						
						html += "<td>"+btn_delete+"</td>"
					html += "</tr>"

				
				});

				$(total_input).val(number_format(total, 2));
				$(table).html(html)

				$(".valor_amparos").keyup(function (e) { 
					calc("#total_amparos_edit", "#amparos-edit tr")
				});
			}


			function GetPoliciesById(select, insures, branch, insured_name, document_insured){
			
				$(select).change(function (e) { 

					var id_policie = $(this).val()

					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/policies/'+id_policie,
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
							$(insures).val(data.name_insurers)
							$(branch).val(data.name_branchs)

							$(insured_name).val(data.name_insured)
							$(document_insured).val(data.identification_insured)
						}
					});

				});
			
			}



			function calc(total_amparos, amparos){

				var total = 0
				$(amparos).each(function (index, element) {

					total = total + inNum($(element).find(".valor_amparos").val())

				});

				$(total_amparos).val(number_format(total, 2))
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


			function DeleteTrSinister(tr) {
				$(tr).remove()
				calc("#total_amparos", "#amparos tr")
				calc("#total_amparos_edit", "#amparos-edit tr")
			}



		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-sinister/'+data.id_sinister+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-sinister/'+data.id_sinister+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-sinister/'+data.id_sinister+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>
	@endsection


