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
										<i class="ti-plus"></i>
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
				$("#nav_consortium").addClass("active");
				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/consortium', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/consortium', '#cuadro2');
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
						 "url":''+url+'/api/consortium',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"name"},
						{"data":"identification"},
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

					$("#name_consortium_view").val(data.name).attr("disabled", "disabled")
					$("#identification_consortium_view").val(data.identification).attr("disabled", "disabled")
					

					ShowPartners("#table-partner-view", data.partners_people, data.partners_company, "view")
					cuadros('#cuadro1', '#cuadro3');


					var url = "clients/consortium/files/"+data.id_clients_consortium+"/0"
					$('#iframeView').attr('src', url);


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
					
					$("#name_consortium_edit").val(data.name)
					$("#identification_consortium_edit").val(data.identification)


					GetClients("#clients-store-edit");
					AddPartner("#add-partner-edit", "#table-partner-edit", "#clients-store-edit")



					ShowPartners("#table-partner-edit", data.partners_people, data.partners_company, "edit")

					$("#id_edit").val(data.id_clients_consortium)
					cuadros('#cuadro1', '#cuadro4');

					var url = "clients/consortium/files/"+data.id_clients_consortium+"/1"
					$('#iframeEdit').attr('src', url);


				});
			}



			function AddPartner(btn, table, select){
				var count_children = 0
				
				$(btn).unbind().click(function (e) { 
					e.preventDefault();



					var name_client  = $(select+" option:selected").text()
					var value_select = $(select).val()
					var array_select = value_select.split("|") 
					var type_client  = array_select[1]

					var valid_data = true

					$(table+" tr").each(function (index, element) {
						var id_client = $(this).find(".id_client").val()
						var type      = $(this).find(".type_client").val()

						if((id_client == array_select[0]) && (type_client == type)){
							valid_data =  false;
						}
						
					});

					if(value_select != "null"){
						if(valid_data){
							var input_client = "<input type='hidden' name='id_client[]'   class='id_client' value='"+array_select[0]+"'>"
							var input_type   = "<input type='hidden' name='type_client[]' class='type_client' value='"+type_client+"'>"

							var btn_delete   = "<button type='button' onclick='DeleteTr(\"" + "#tr_partner_" + count_children +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
							
							var html = ""
							html += "<tr id='tr_partner_"+count_children+"'>"
								html +="<td>"+name_client+input_client+input_type+"</td>"
								html +="<td>"+btn_delete+"</td>"
							html += "</tr>"
							count_children++
							$(table).append(html)
						}else{
							warning("El cliente ya fue agredado")
						}
					}else{
						warning("Debe seleccionar un cliente")
					}
					
					
				});
			}




			function ShowPartners(table, peopels, company, mode){

				$(table+" tr").remove()
				
				var count  = 0;
				$.each(peopels, function (key, item) { 
					var html = "";

					var input_client = ""
					var input_type   = ""
					var btn_delete   = ""

					if(mode == "edit"){
						var input_client = "<input type='hidden' name='id_client[]'   class='id_client' value='"+item.id_client_people+"'>"
						var input_type   = "<input type='hidden' name='type_client[]' class='type_client' value='0'>"

						var btn_delete   = "<button type='button' onclick='DeleteTr(\"" + "#tr_partner_people_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					}


					html += "<tr id='tr_partner_people_"+count+"'>"
						html += "<td>"+item.names+" "+item.last_names+input_client+input_type+"</td>"
						html += "<td>"+btn_delete+"</td>"
					html += "</tr>"

					$(table).append(html);
					count++;
				});


				$.each(company, function (key, item) { 
					count++;
					var html = "";


					var input_client = ""
					var input_type   = ""
					var btn_delete   = ""

					if(mode == "edit"){
						var input_client = "<input type='hidden' name='id_client[]'   class='id_client' value='"+item.id_client_company+"'>"
						var input_type   = "<input type='hidden' name='type_client[]' class='type_client' value='1'>"

						var btn_delete   = "<button type='button' onclick='DeleteTr(\"" + "#tr_partner_company_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					}



					html += "<tr id='tr_partner_company_"+count+"'>"
						html += "<td>"+item.business_name+input_client+input_type+"</td>"
						html += "<td>"+btn_delete+"</td>"
					html += "</tr>"

					$(table).append(html);
				});

			}


		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-consortium/'+data.id_clients_consortium+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-consortium/'+data.id_clients_consortium+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-consortium/'+data.id_clients_consortium+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


