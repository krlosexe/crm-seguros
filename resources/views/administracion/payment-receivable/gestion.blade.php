@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Cuentas por Cobrar</h4>
				</div>
				<div class="row">
					<div class="col-md-12">
						
						<div class="card">
							<div class="card-block">
							  <div class="row">
							  	
								<div class="col-md-3">
									<label>Fecha desde</label>
									<input type="date" id="fecha_desde" class="form-control" value="{{ date('Y-m-01') }}" onchange="filtrarFecha()">
								</div>
								<div class="col-md-3">
									<label>Fecha hasta</label>
									<input type="date" id="fecha_hasta" class="form-control" value="{{ date('Y-m-d') }}" onchange="filtrarFecha()">
								</div>

							  </div>	 	
							</div>
						</div>

					</div>
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
												<th style="display: none"></th>
												<th>#</th>
												<th>Motivo</th>
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

				if(name_rol != 'Administrador'){
					$('.row-participacion').hide()
				}
			});

			function filtrarFecha(){
				$(table).DataTable().draw();
			}


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
						 "url":''+url+'/api/payments/receivable',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"fec_regins", visible: false},

						{"data":"id"},


						{"data":"issue"},

						{"data":"name_client",
							render : function(data, type, row){

								if(row.type_client == 0){
									return "<a href='people/"+row.id_client+"' target='_blank' class=''>"+row.name_client+" "+row.last_names+"</a>"
								}else{
									return "<a href='company/"+row.id_client+"' target='_blank' class=''>"+row.business_name+"</a>"
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
					"buttons": buttonsDatatable({
						title: 'Gestión de Cuentas por Cobrar',
						filename: 'cuentas-cobrar',
						columns: [1,2,3],
					}),
					initComplete(){
						$('.dt-button').removeClass('dt-button buttons-copy buttons-html5')
					}
				});

			$.fn.dataTableExt.afnFiltering.push(
				function( oSettings, aData, iDataIndex ) {

					var iFini = document.getElementById('fecha_desde').value;
					var iFfin = document.getElementById('fecha_hasta').value;
					var iStartDateCol = 0;

					var datofini=aData[iStartDateCol]
					var datoffin=aData[iStartDateCol]
				
					if ( iFini === "" && iFfin === "" )
					{
						return true;
					}
					else if ( iFini <= datofini && iFfin === "")
					{
						return true;
					}
					else if ( iFfin >= datoffin && iFini === "")
					{
						return true;
					}
					else if (iFini <= datofini && iFfin >= datoffin)
					{
						return true;
					}
					return false;
				}
			);
			
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


			var ClientSelected = 0;
			var TypeClientSelected= 0;

			/* ---------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();

					ClientSelected = data.id_client;
					TypeClientSelected = data.type_client;

					$("#policie_annexes-multiple-view").val(data.policie_annexes).trigger('change');
					$("#policie_annexes-multiple-view").attr("readonly", "readonly");

					setTimeout(() => {


				   	   $('.multiselect').multiselect('destroy');


						data.charge_account.forEach(item => {

							let chargeSelected = data.policie_annexes == "Poliza" ? 
														item.policie_data.id_policies : 
														item.policie_anexes_data.id_policies_annexes;

							let optionSelected = $(`.multiselect option[value="${chargeSelected}"]`);

							let jsonOption = JSON.parse(optionSelected.attr('json'));

							jsonOption.charge_account_id = item.id_charge_accounts;
							jsonOption.cousin = item.cousin;
							jsonOption.xpenses = item.xpenses;
							jsonOption.vat = item.vat;
							jsonOption.percentage_vat_cousin = item.percentage_vat_cousin;
							jsonOption.commission_percentage = item.commission_percentage;
							jsonOption.participation = item.participation;
							jsonOption.agency_commission = item.agency_commission;
							jsonOption.total = item.total;

							optionSelected.attr('json', JSON.stringify(jsonOption)).attr('selected', 'selected');


						})


						$('.multiselect').multiselect({
						      selectAllText: true,
						      buttonWidth: '100%'
						});

						$('#number-multiple-view').change();

						$('#cuadro4').find('input, select, textarea').attr('disabled', 'disabled')

					}, 1500)

					$("#init_date-multiple-view").val(data.init_date)
					$("#limit_date-multiple-view").val(data.limit_date)
					$("#issue-multiple-view").val(data.issue)
					$("#footer-multiple-view").val(data.observations)
					

					var url = ruta.value + "/policies/wallet/files/"+data.id+"/1"
					
					$('#iframeDigitalesEdit').attr('src', url);

					var urlpdf = document.querySelector('#ruta').value + "/policies/wallet/pdf/"+data.id+"/1"
					$('#btn-print').attr('href', urlpdf);

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


			$("#policie_annexes-store, #policie_annexes-multiple, #policie_annexes-multiple-edit, #policie_annexes-multiple-view").change(function (e) { 

				var type = $(this).val();
				const idElement = $(this).attr('id');

				if($(this).val() == "Poliza"){
					var route = '/api/clients/people/policies/'+ClientSelected+'/'+TypeClientSelected;
				}else{
					var route = '/api/client/policies/annexes/'+ClientSelected+'/'+TypeClientSelected;
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
							
							if(idElement != 'policie_annexes-multiple' && idElement != 'policie_annexes-multiple-edit' && idElement != 'policie_annexes-multiple-view'){

								$("#number-store option").remove();
								$("#number-store").append($('<option>',
								{
									value: "",
									text : "Seleccione",
									
								}));
						    }

								if(idElement == 'policie_annexes-multiple' || idElement == 'policie_annexes-multiple-edit' || idElement == 'policie_annexes-multiple-view'){

									$(".multiselect option").remove();

									$('#number-multiple').change();
									$('#number-multiple-edit').change();
									$('#number-multiple-view').change();

								    $('.multiselect').multiselect('destroy');

									$.map(data, function (item, key) {
							
										if(type == "Poliza"){
											var number_policies = item.number_policies;
											var id_policies = item.id_policies;
										}else{
											var number_policies = item.number_annexed;
											var id_policies = item.id_policies_annexes;
										}

										if (item.status == 1) {
											
											item.charge_account_id = 0;

											$(".multiselect").append($('<option>',
											{
												value: id_policies,
												text : number_policies,
												json: JSON.stringify(item)
											}));

										}
									});

									$('.multiselect').multiselect({
									      selectAllText: true,
									      buttonWidth: '100%'
									});

								}

							

						}

					});
			});


			$('#number-multiple-view').change(function(){
				const values = $(this).val();

				const tdContent = `
                  <td>
                  	<input class="form-control text-right form-control-user monto_formato_decimales" name="cousin[]" value="" required>
                  	<input name="id_policie[]" hidden>
                  	<input name="charge_account_id[]" hidden>
                  </td>
                  <td>
                  	<input class="form-control text-right form-control-user monto_formato_decimales" name="xpenses[]" value="" required>
                  </td>
                  <td>
                  	<input name="vat[]" readonly="readonly" class="form-control text-right  form-control-user" value="">
                  </td>
                  <td>
                  	<input name="percentage_vat_cousin[]" class="form-control text-right  form-control-user" value="">
                  </td>

  	                  <td ${name_rol != 'Administrador'? 'style="display:none"' : ''}>
	                  	<input name="commission_percentage[]" value="" readonly="readonly" class="form-control text-right  form-control-user">
	                  </td>
	                  

	                  <td>
	                  	<input name="participation[]" value="" class="form-control text-right  form-control-user">
	                  </td>
	                  
                  
                  <td ${name_rol != 'Administrador'? 'style="display:none"' : ''}>
                  	<input name="agency_commission[]"  value="" readonly="readonly" class="form-control text-right  form-control-user">
                  </td>
                  <td>
                  	<input  name="total[]" value="" readonly="readonly" class="form-control text-right form-control-user">
                  </td>
				`

				let tbody = document.querySelector(`.${this.id} tbody`);

				if(values == null){
					tbody.innerHTML = '<tr><td colspan="8" class="text-center">Sin datos</td></tr>';
					return;
				}
				else{
					if(tbody.children[0].childElementCount == 1){
						tbody.innerHTML = '';
					}
					else{
						Array.from(tbody.children).forEach(tr => {
							let encontered = values.find(id =>  id == tr.children[0].getAttribute('id'));

							if(encontered == undefined){
								tr.remove();
							}
						});

					}

					values.forEach(id => {
						
						let rowExist = tbody.querySelector(`td[id="${id}"]`)

						if(rowExist != null){
							return;
						}

						const json = JSON.parse($(`#number-multiple-view option[value="${id}"]`).attr('json'));

						let row = tbody.insertRow();
						row.innerHTML = tdContent;

						row.querySelector("input[name='id_policie[]']").value = id;
						row.querySelector("input[name='charge_account_id[]']").value = json.charge_account_id;
						row.querySelector("input[name='cousin[]']").value = json.cousin == null? 0 : json.cousin;
						row.querySelector("input[name='xpenses[]']").value = json.xpenses == null? 0 : json.xpenses;
						row.querySelector("input[name='vat[]']").value = json.vat == null? 0 : json.vat;
						row.querySelector("input[name='percentage_vat_cousin[]']").value = json.percentage_vat_cousin == null? 0 : json.percentage_vat_cousin;
						row.querySelector("input[name='commission_percentage[]']").value = json.commission_percentage == null? 100 : json.commission_percentage;
						row.querySelector("input[name='participation[]']").value = json.participation == null? 100 : json.participation;
						row.querySelector("input[name='agency_commission[]']").value = json.agency_commission == null? 0 : json.agency_commission;
						row.querySelector("input[name='total[]']").value = json.total == null? 0 : json.total;

						$(row).find('.form-control').change();
						row.children[0].setAttribute('id', id);

					})


				}
			})

			$('body').on('keyup', "input[name='cousin[]'], input[name='xpenses[]'], input[name='commission_percentage[]'], input[name='percentage_vat_cousin[]']", function (e) { 
				let row = this.closest('tr');

				calc(
					row.querySelector("input[name='cousin[]']"), 
					row.querySelector("input[name='xpenses[]']"), 
					row.querySelector("input[name='total[]']"), 
					row.querySelector("input[name='percentage_vat_cousin[]']"), 
					row.querySelector("input[name='vat[]']"), 
					row.querySelector("input[name='commission_percentage[]']"), 
					row.querySelector("input[name='agency_commission[]']"), 
					row.querySelector("input[name='participation[]']"), 
				)
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


