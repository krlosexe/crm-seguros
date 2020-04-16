@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Cartera.</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">

							<div class="animation_home"></div>
								<div class="table-overflow">
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>#</th>
												<th>Número de Poliza</th>
												<th>Cliente</th>
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
			@include('administracion.payment.admin')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				list();
				update();

				$("#nav_li_Cartera").addClass("open");
				$("#nav_payment").addClass("active");

				verifyPersmisos(id_user, tokens, "payment");
			});



			function update(){
				savePayment("#form-update", 'api/payment/fee', '#cuadro4', false, "#avatar-edit");
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
						 "url":''+url+'/api/payment',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"id_charge_accounts"},


						{"data":"number_policies",
							render : function(data, type, row){
								return "<a href='policies/"+row.id_policie+"' target='_blank' class=''>"+data+"</a>"
							}
						},

						{"data":"names",
							render : function(data, type, row){

								if(row.type_clients == 0){
									return "<a href='people/"+row.id_clients_people+"' target='_blank' class=''>"+row.name_client+" "+row.last_names+"</a>"
								}else{
									return "<a href='people/"+row.clients+"' target='_blank' class=''>"+row.business_name+"</a>"
								}
								
							}
						},

						{"data": null,
							render : function(data, type, row) {
								var botones = "";
							
								botones += "<span class='editar btn btn-primary  btn-sm waves-effect' data-toggle='tooltip' title='Gestionar Pagos'><i class='ei-money-bag' style='margin-bottom:5px'></i></span> ";
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
			
				edit("#table tbody", table)

			}

			var api = "/api/footers";
			var api2 = "/api/footers";
			$("#add-pie").click(function (e) { 
				$("#default-modal").modal("show")
				getFooters()
			});

			$("#new-pie").click(function (e) { 
				$(".btn-save-pie").removeAttr("disabled")
				$(".remove-pie").css("display", "block")
				$("#name-footer").val("")
				$("#content-footer").val("")
				api = "/api/footers";
				
			});


			$("#footers").change(function (e) { 
				$(".btn-save-pie").removeAttr("disabled")
				$(".btn-delete-pie").removeAttr("disabled")
				$("#name-footer").val($("#footers option:selected").text())
				$("#content-footer").val($(this).val())
				$(".remove-pie").css("display", "block")
				api  = "/api/footers/update";
				api2 = "/api/footers/delete";
			});

			$("#btn-delete-pie").click(function (e) { 
				e.preventDefault();

				e.preventDefault();
				
				if(($("#name-footer").val() == "") || ($("#content-footer").val() == "")){
					alert("Los Campos son requeridos")
				}else{
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+api2,
						type:'POST',
						data: {
							"name"     : $("#name-footer").val(),
							"content"  : $("#content-footer").val()
						},
						dataType:'JSON',
						async: false,
						beforeSend: function(){
						
						},
						error: function (data) {
						
						},
						success: function(data){
							getFooters()
						}

					});
				}
				
			});
			$("#btn-select-pie").click(function (e) { 
				$("#footer-store").val($("#content-footer").val())
				
			});


			function getFooters(){
				var url=document.getElementById('ruta').value;
				$.ajax({
					url:''+url+"/api/footers",
					type:'GET',
					dataType:'JSON',
					async: false,
					beforeSend: function(){
					
					},
					error: function (data) {
					
					},
					success: function(data){
						$("#footers option").remove();
						$.each(data, function (key, item) { 
							$("#footers").append($('<option>',
							{
								value: item.content,
								text : item.name,
								
							}));
							
						});
					}

				});
			}



			$("#btn-save-pie").click(function (e) { 
				e.preventDefault();
				
				if(($("#name-footer").val() == "") || ($("#content-footer").val() == "")){
					alert("Los Campos son requeridos")
				}else{
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+api,
						type:'POST',
						data: {
							"name"     : $("#name-footer").val(),
							"content"  : $("#content-footer").val()
						},
						dataType:'JSON',
						async: false,
						beforeSend: function(){
						
						},
						error: function (data) {
						
						},
						success: function(data){
							getFooters()
						}

					});
				}
				
			});
			/* ---------------------------11111111111111---------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){

				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();
					
					$("#policie_annexes-view").val(data.policie_annexes).attr("disabled", "disabled")
					$("#number-view").val(data.number_policies).attr("disabled", "disabled")
					$("#number-view option").remove();
					$("#number-view").append($('<option>',
					{
						value: data.policie_annexes == "Poliza" ? data.id_policie : data.number,
						text : data.policie_annexes == "Poliza" ? data.number_policies : data.number_annexed,
						
					}));

					$("#init_date-view").val(data.init_date).attr("disabled", "disabled")
					$("#limit_date-view").val(data.limit_date).attr("disabled", "disabled")
					$("#issue-view").val(data.issue).attr("disabled", "disabled")
					$("#observations-view").val(data.observations).attr("disabled", "disabled")

					$("#cousin-view").val(number_format(data.cousin, 2)).attr("disabled", "disabled")
					$("#xpenses-view").val(number_format(data.xpenses, 2)).attr("disabled", "disabled")
					$("#vat-view").val(number_format(data.vat, 2)).attr("disabled", "disabled")
					$("#percentage_vat_cousin-view").val(data.percentage_vat_cousin).attr("disabled", "disabled")
					$("#commission_percentage-view").val(data.commission_percentage).attr("disabled", "disabled")
					$("#participation-view").val(data.participation).attr("disabled", "disabled")
					$("#agency_commission-view").val(number_format(data.agency_commission, 2)).attr("disabled", "disabled")
					$("#total-view").val(number_format(data.total, 2)).attr("disabled", "disabled")
					
					$("#btn-print-view").attr("href", "/policies/wallet/pdf/"+data.id_charge_accounts+"/1")


					var url = "/policies/wallet/files/"+data.id_charge_accounts+"/0"
					$('#iframeDigitalesView').attr('src', url);



					cuadros('#cuadro1', '#cuadro3');
				});

			}



			/* ---------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();
					
					$("#policie_annexes-edit").val(data.policie_annexes).attr("disabled", "disabled")
					$("#number-edit").val(data.number_policies).attr("disabled", "disabled")
					$("#number-edit option").remove();
					$("#number-edit").append($('<option>',
					{
						value: data.policie_annexes == "Poliza" ? data.id_policie : data.number,
						text : data.policie_annexes == "Poliza" ? data.number_policies : data.number_annexed,
						
					}));

					$("#init_date-edit").val(data.init_date)
					$("#limit_date-edit").val(data.limit_date)
					$("#issue-edit").val(data.issue)
					$("#observations-edit").val(data.observations)

					$("#cousin-edit").val(number_format(data.cousin, 2))
					$("#xpenses-edit").val(number_format(data.xpenses, 2))
					$("#vat-edit").val(number_format(data.vat, 2)).attr("readonly", "readonly")
					$("#percentage_vat_cousin-edit").val(data.percentage_vat_cousin)
					$("#commission_percentage-edit").val(data.commission_percentage).attr("readonly", "readonly")
					$("#participation-edit").val(data.participation).attr("readonly", "readonly")
					$("#agency_commission-edit").val(number_format(data.agency_commission, 2)).attr("readonly", "readonly")
					$("#total-edit").val(number_format(data.total, 2)).attr("readonly", "readonly")

					$("#id_edit").val(data.id_charge_accounts)

					$("#btn-print").attr("href", "/policies/wallet/pdf/"+data.id_charge_accounts+"/1")

					ShowCollections(data.collections)




					$('#input-file-store').fileinput('destroy');
				
					$("#input-file-store").fileinput({
						theme: "fas",
						overwriteInitial: true,
						maxFileSize: 1500,
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

					var url = "/policies/wallet/files/"+data.id_charge_accounts+"/1"
					$('#iframeDigitalesEdit').attr('src', url);

					cuadros('#cuadro1', '#cuadro4');
				});
			}
			

			
			function ShowCollections(data){
				
				var count = 0

				$.each(data, function (key, item) { 
					
					count++
					var html = "";
					html += '<div class="col-md-12" id="file-'+count+'">'
						html += '<div class="row">'
							html += '<div class="col-md-6">'
								html += ' <label for=""><b>Titulo *</b></label>'
								html += '<div class="form-group valid-required">'
									html += '<input type="text" name="titles[]" class="form-control form-control-user" required value="'+item.title+'">'
								html += '</div>'
							html += '</div>'


							html += '<div class="col-md-6">'
								html += ' <label for=""><b>Monto *</b></label>'
								html += '<div class="form-group valid-required">'
									html += '<input type="text" name="descriptions[]" class="form-control form-control-user"  required value="'+item.amount+'">'
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


				
			}

			function CreateInputFile(input){

				$(input).fileinput({
					theme: "fas",
					overwriteInitial: true,
					maxFileSize: 1500,
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

			$("#policie_annexes-store").change(function (e) { 
				
				var type = $(this).val();
				if($(this).val() == "Poliza"){
					var route = '/api/policies/';
				}else{
					var route = '/api/policies/annexes/';
				}
				var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+route,
						type:'GET',
						data: {
							"id_user": id_user,
							"token"  : tokens,
						},
						dataType:'JSON',
						async: false,
						beforeSend: function(){
						
						},
						error: function (data) {
						
						},
						success: function(data){

							$("#number-store option").remove();
							
							if(type == "Poliza"){

								if (data.status == 1) {
									$("#number-store").append($('<option>',
									{
										value: data.id_policies,
										text : data.number_policies,
										
									}));
								}

								$("#cousin").val(number_format(data.cousin, 2))
								$("#xpenses").val(number_format(data.xpenses, 2))
								$("#vat").val(number_format(data.vat, 2)).attr("readonly", "readonly")
								$("#percentage_vat_cousin").val(data.percentage_vat_cousin)
								$("#commission_percentage").val(data.commission_percentage).attr("readonly", "readonly")
								$("#participation").val(data.participation).attr("readonly", "readonly")
								$("#agency_commission").val(number_format(data.agency_commission, 2)).attr("readonly", "readonly")
								$("#total").val(number_format(data.total, 2)).attr("readonly", "readonly")

							}else{

								$.each(data, function (key, item) { 
									if (item.status == 1) {
										$("#number-store").append($('<option>',
										{
											value: item.id_policies_annexes,
											text : item.number_annexed,
											
										}));
									} 
								});
								$("#number-store").trigger("change");
							}

							

						}

					});
			});



			$("#number-store").change(function (e) { 
				
				if($("#policie_annexes-store").val() != "Poliza"){
					
					var route = '/api/annexes/'+$(this).val();
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+route,
						type:'GET',
						data: {
							"id_user": id_user,
							"token"  : tokens,
						},
						dataType:'JSON',
						async: false,
						beforeSend: function(){
						
						},
						error: function (data) {
						
						},
						success: function(data){

							$("#cousin").val(number_format(data.cousin, 2))
							$("#xpenses").val(number_format(data.xpenses, 2))
							$("#vat").val(number_format(data.vat, 2)).attr("readonly", "readonly")
							$("#percentage_vat_cousin").val(data.percentage_vat_cousin)
							$("#commission_percentage").val(data.commission_percentage).attr("readonly", "readonly")
							$("#participation").val(data.participation).attr("readonly", "readonly")
							$("#agency_commission").val(number_format(data.agency_commission, 2)).attr("readonly", "readonly")
							$("#total").val(number_format(data.total, 2)).attr("readonly", "readonly")

						}

					});
				}
				
			});


			$("#cousin, #xpenses, #commission_percentage, #percentage_vat_cousin").keyup(function (e) { 
				calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission", "#participation")
			});


			$("#cousin-edit, #xpenses-edit, #commission_percentage-edit, #percentage_vat_cousin-edit").keyup(function (e) { 
				calc("#cousin-edit", "#xpenses-edit", "#total-edit", "#percentage_vat_cousin-edit", "#vat-edit", "#commission_percentage-edit", "#agency_commission-edit", "#participation-edit")
			});

			function calc(input_cousin, input_xpenses, input_total, input_percentage_vat_cousin, input_vat, input_commission_percentage, agency_commission, participation){
				
				var value_cousin                      = inNum($(input_cousin).val())
				var value_xpenses                     = inNum($(input_xpenses).val())
				var value_percentage_vat_cousin       = inNum($(input_percentage_vat_cousin).val())
				var value_input_commission_percentage = inNum($(input_commission_percentage).val())
				var participation                     = inNum($(participation).val())
				
				var result_percentage_vat_cousin = inNum(((value_cousin + value_xpenses)/100) * value_percentage_vat_cousin)
				var result_commission_percentage = inNum(((value_cousin - (value_cousin*value_percentage_vat_cousin/100)) /100) * value_input_commission_percentage)
				
				var comission_total =  inNum(result_commission_percentage)

				
				var total = result_percentage_vat_cousin + value_cousin + value_xpenses

				$(input_vat).val(number_format(result_percentage_vat_cousin, 2))
				$(agency_commission).val(number_format(comission_total ,2))
				$(input_total).val(number_format(total, 2))
			}

		</script>

	@endsection


