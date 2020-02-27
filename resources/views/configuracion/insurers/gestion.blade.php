@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Aseguradoras.</h4>
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
											<th>Código</th>
											<th>Nombre</th>
											<th>NIT</th>
											<th>Teléfono</th>
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

			@include('configuracion.insurers.store')
			@include('configuracion.insurers.view')
			@include('configuracion.insurers.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Configuraciones").addClass("show");
				$("#nav_li_Configuraciones").addClass("open");
				$("#nav_users, #modulo_Configuraciones").addClass("active");
				$("#nav_insurers").addClass("active");
				verifyPersmisos(id_user, tokens, "insurers");


				$('#selectize-tags-1').selectize({
					delimiter: ',',
					persist: false,
					create: function(input) {
						return {
							value: input,
							text: input
						}
					}
				});


			});



			function update(){
				enviarFormularioPut("#form-update", 'api/insurers', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/insurers', '#cuadro2');
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
						 "url":''+url+'/api/insurers',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						{"data":"code"},
						{"data":"name"},
						{"data":"nit"},
						{"data":"phone"},
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

				GetRamos("#branchs")

				AddBranch( "#add-branch", "#table-branch","#branchs")
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
				
					$("#code_view").val(data.code).attr("disabled", "disabled")
					$("#name_view").val(data.name).attr("disabled", "disabled")
					$("#nit_view").val(data.nit).attr("disabled", "disabled")
					$("#email_view").val(data.email).attr("disabled", "disabled")
					$("#address_view").val(data.address).attr("disabled", "disabled")
					$("#phone_view").val(data.phone).attr("disabled", "disabled")
					$("#bank_account_view").val(data.bank_account).attr("disabled", "disabled")
					$("#code_adviser_view").val(data.code_adviser).attr("disabled", "disabled")

					ShowDataBranchs("#table-branch-view", data.branchs, "view")

					var url = "sub-company/"+data.id_insurers+"/0"
					$('#iframeView').attr('src', url);


					var urlOficce = "insurers/oficce/"+data.id_insurers+"/0"
					$('#iframeOficinasView').attr('src', urlOficce);


					
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
					
					$("#code_edit").val(data.code)
					$("#name_edit").val(data.name)
					$("#nit_edit").val(data.nit)
					$("#email_edit").val(data.email)
					$("#address_edit").val(data.address)
					$("#phone_edit").val(data.phone)
					$("#bank_account_edit").val(data.bank_account)
					$("#code_adviser_edit").val(data.code_adviser)
					GetRamos("#branchs-edit")
					ShowDataBranchs("#table-branch-edit", data.branchs, "edit")
					AddBranch( "#add-branch-edit", "#table-branch-edit","#branchs-edit")
					


					var url = "sub-company/"+data.id_insurers+"/1"
					$('#iframeEdit').attr('src', url);

					var urlOficce = "insurers/oficce/"+data.id_insurers+"/1"
					$('#iframeOficinasEdit').attr('src', urlOficce);

					$("#id_edit").val(data.id_insurers)
					cuadros('#cuadro1', '#cuadro4');
				});
			}







			function AddBranch(btn, table, select){
				var count = 0
				
				$(btn).unbind().click(function (e) { 
					e.preventDefault();

					var name_branch  = $(select+" option:selected").text()
					var value_select = $(select).val()
					var valid_data = true

					$(table+" tr").each(function (index, element) {
						var id_branch = $(this).find(".id_branch").val()
						if((id_branch == value_select)){
							valid_data =  false;
						}
						
					});

					if(value_select != "null"){
						if(valid_data){
							var input_client = "<input type='hidden' name='id_branch[]'   class='id_branch' value='"+value_select+"'>"
							var btn_delete   = "<button type='button' onclick='DeleteTr(\"" + "#tr_branch_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
							
							var html = ""
							html += "<tr id='tr_branch_"+count+"'>"
								html +="<td>"+name_branch+input_client+"</td>"
								html +="<td><input type='text' class='form-control' name='codes[]' required></td>"
								html +="<td><input type='text' class='form-control' name='commission_percentages[]' required></td>"
								html +="<td><input type='text' class='form-control' name='vat_percentages[] required'></td>"
								html +="<td>"+btn_delete+"</td>"
							html += "</tr>"
							count++
							$(table).append(html)
						}else{
							warning("El ramo ya fue agredado.")
						}
					}else{
						warning("Debe seleccionar un ramo.")
					}
					
					
				});
			}





			function ShowDataBranchs(table, data, option) { 

				var html  = ""
				var count = ""

				$.each(data, function (key, item) { 

					var input_client = "<input type='hidden' name='id_branch[]'   class='id_branch' value='"+item.id_branch+"'>"
					var btn_delete   = "<button type='button' onclick='DeleteTr(\"" + "#tr_branch_edit_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
							
					html += "<tr id='tr_branch_edit_"+count+"'>"
						html +="<td>"+item.name+input_client+"</td>"
						html +="<td><input type='text' class='form-control' name='codes[]' value='"+item.code+"' required></td>"
						html +="<td><input type='text' class='form-control' name='commission_percentages[]' value='"+item.commission_percentage+"' required></td>"
						html +="<td><input type='text' class='form-control' name='vat_percentages[]' value='"+item.vat_percentage+"' required></td>"
						if(option == "edit"){
							html +="<td>"+btn_delete+"</td>"
						}
						
					html += "</tr>"

				});

				$(table).html(html)
			}




		/* ----------------------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar............
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-insurers/'+data.id_insurers+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
				});
			}
		/* ------------------------------------------------------------------------------- */

			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function activar(tbody, table){
				$(tbody).on("click", "span.activar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-insurers/'+data.id_insurers+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-insurers/'+data.id_insurers+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


