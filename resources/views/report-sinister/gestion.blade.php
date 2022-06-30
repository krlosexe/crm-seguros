@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Siniestros Reportados.</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>#</th>
												<th>Cliente</th>
												<th>Motivo</th>
												<th>Tipo</th>
												<th>Audio</th>
												<th>Fecha de registro</th>
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

			@include('report-sinister.store')
			@include('report-sinister.view')
			@include('report-sinister.edit')

		</div>
                <!-- Content Wrapper END ------->
	@endsection





	@section('CustomJs')


	<link href="<?= url('/') ?>/vendors/summernote-master/dist/summernote.min.css" rel="stylesheet">
    <script src="<?= url('/') ?>/vendors/summernote-master/dist/summernote.min.js"></script>


		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Pólizas").addClass("show");
				$("#nav_li_Siniestos").addClass("open");
				$("#nav_users, #modulo_Pólizas").addClass("active");
				$("#nav_sinister").addClass("active");

				GetCompanies("#companie-filter")
				GetRamos("#branch-filter")
				verifyPersmisos(id_user, tokens, "sinister");


				$('#comments').summernote({
						height: 145, 
					})



			});



			function update(){
				enviarFormularioPut("#form-update", 'api/sinister', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/sinister', '#cuadro2');
			}


			$("#companie-filter, #branch-filter").change(function (e) { 
				list()
			});

			$("#number-sinister").keyup(function (e) { 
				list()
			});

			function list(cuadro) {
				var data = {
					"id_user": id_user,
					"token"  : tokens,
				};


				let number_sinister = 0

				if($("#number-sinister").val() != ""){
					number_sinister = $("#number-sinister").val()
				}

				$('#table tbody').off('click');
				var url=document.getElementById('ruta').value; 
				cuadros(cuadro, "#cuadro1");

				var table=$("#table").DataTable({
					"destroy":true,
					
					"stateSave": true,
					"serverSide":false,
					"ajax":{
						"method":"GET",
						 "url":''+url+'/api/get/report/sinister/',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[

						{"data":"id"},

						{"data":"names",
							render : function(data, type, row) {
								return `${data} ${row.last_names}`;
							}
						},
						{"data":"motivo"},
						{"data":"type"},
						{"data":"file",
							render : function(data, type, row) {
								return `<a href="/img/${data}" target="_blank">Audio</a>`;
							}
						},
						{"data": "created_at"},
						
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": true,
					"order": [[ 3, "desc" ]], //or asc 
    				"columnDefs" : [{"targets":3, "type":"date-eu"}],
					"responsive": true,
					"buttons": buttonsDatatable({
						title: 'Siniestros',
						filename: 'siniestros',
						columns: [0,1,2,3, 4],
					}),
					
					initComplete(){
						$('.dt-button').removeClass('dt-button buttons-copy buttons-html5')
					},
					

				});


				ver("#table tbody", table)
				edit("#table tbody", table)
				activar("#table tbody", table)
				desactivar("#table tbody", table)
				eliminar("#table tbody", table)


			}



		function select2_search ($el, term) {
		  $el.select2('open');
		  
		  var $search = $el.data('select2').dropdown.$search || $el.data('select2').selection.$search;
		  
		  $search.val(term);
		  $search.trigger('keyup');
		}

			function asyncPolizas(select, defaultPolicie){
				// $('#policie').select2('destroy');

		      if(defaultPolicie != undefined){
		      	$(select).append(`<option value="${defaultPolicie.id}">${defaultPolicie.text}</option>`).trigger('change')
		      }

				$(select).select2({
				  width: '50%',
				language: {
				  noResults: function() {
				    return "No hay resultado";        
				  },
				  searching: function() {
				    return "Buscando..";
				  },
				  inputTooShort: function () {
				    return "Colocar mínimo 2 caracteres para buscar...";
				  }
				},
				  ajax: {
				  	delay: 300,
				    url: `${ruta.value}/api/select2polizas`,
				    data(params) {
				    
				      return {
				      	search: params.term,
				      	type: 'public',
						id_user : id_user
				      }
				    },
				    processResults(data) {
				      let results = data.map(item => ({
				      		id: item.id_policies,
				      		text: item.number_policies
				      	}))

				      return { results };
				    }
				  }
				})


		
			}

			function nuevo() {

				$("#alertas").css("display", "none");
				$("#store")[0].reset();
				$(".container-datos-adicionales-hijo").css("display", "none");
				$(".container-datos-adicionales-vehicle").css("display", "none");
				
				asyncPolizas('#policie');

				//GetClients("#clients_select");
				// GetPolicies("#policie")
				
				GetPoliciesById("#policie", "#insures", "#branch", "#insured_name", "#document_insured")

				addAmparos("#add-amparo", "#amparos")

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")



				$('#input-file-store').fileinput('destroy').val('');
				$("#input-file-store").fileinput({
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


					asyncPolizas('#policie_view', {id: data.policie, text: data.number_policies});

					// GetPolicies("#policie_view", data.policie)

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
					
					asyncPolizas('#policie_edit', {id: data.policie, text: data.number_policies});

					// GetPolicies("#policie_edit", data.policie)

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

					$("#history-edit").html("")

					getComments(data.state_policie, data.id_sinister, "#comments_content_edit")
				    //getFiles(data.state_policie, data.id_sinister)
					getHistory(data.state_policie, data.id_sinister)



					$("#input-file-edit").fileinput({
						theme: "fas",
						overwriteInitial: true,
						maxFileSize: 10000,
						showClose: false,
						showCaption: false,
						browseLabel: '',
						removeLabel: '',
						browseIcon: '<i class="fa fa-folder-open"></i>',
						removeIcon: '<i class="fas fa-trash-alt"></i>',
						previewFileIcon: '<i class="fas fa-file"></i>',
						removeTitle: 'Cancel or reset changes',
						elErrorContainer: '#kv-avatar-errors-1',
						msgErrorClass: 'alert alert-block alert-danger',
						layoutTemplates: {main2: '{preview}  {remove} {browse}'},
						allowedFileExtensions: ["jpg", "png", "gif", "pdf"],
						
						

					});

					$('#comments-edit').summernote({
						height: 145, 
					})




					$("#id_edit").val(data.id_sinister)

					var url = "policies/sinister/files/"+data.id_sinister+"/1"
					$('#iframeEdit').attr('src', url);



					cuadros('#cuadro1', '#cuadro4');
				});
			}




			function getFiles(state, id){
				console.log(state, id)

				var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/sinister/get/files/'+state+'/'+id,
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
							$("#files_content_edit-state").html("")
							$.map(data, function (item, key) {
								console.log(item)
								$("#files_content_edit-state").append(`
									<a target="_blank" href="/img/sinisters/${item.file}" >${item.file}</a><br>
								`)
							});
						}
					});

			}





			function getHistory(state, id){
				console.log(state, id)

				var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/sinister/get/states/'+id,
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
							var html = ""

							$.map(data, function (item, key) {
								html = `
									<div class="col-md-3">
										<img  onclick="showState('${item.status}')" style="width: 127px;" src ="https://static3.depositphotos.com/1006031/209/i/600/depositphotos_2091246-stock-photo-full-blue-folder-icon.jpg">
										<br>
										<b>${item.fecha}</b>
									</div>
								`
								$("#history-edit").append(html)
							});

						}
					});

			}


			function showState(state){
				getComments(state, $("#id_edit").val(), "#comments_content_edit-state")
		        getFiles(state, $("#id_edit").val(), "#comment-state-edit")
			}

			function getComments(state, id, comment){
				console.log(state, id)

				var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/sinister/get/comments/'+state+'/'+id,
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
							

							var count_view = 0
							var html  = "";
                        $.map(data, function (item, key) {

                            count_view++
                            html += '<div class="col-md-12" style="margin-bottom: 34px" id="comments_view_'+count_view+'">'
                                html += '<div class="row">'
                                    html += '<div class="col-md-2">'
                                        html += "<img class='rounded' src='"+url+"/img/usuarios/profile/"+item.img_profile+"' style='height: 4rem;width: 4rem; margin: 1%; border-radius: 50%!important;' title='"+item.name_follower+" "+item.last_name_follower+"'>"
                                        
                                        html += '</div>'
                                                html += '<div class="col-md-10" style="background: #eee;padding: 2%;border-radius: 17px;">'
                                                html += '<div class="row">'
                                            html += '<div class="col-md-10">'
                                                html += '<div>'+item.comment+'</div>'
                                            html += '</div>'

                                            // html += '<div class="col-md-2">'

                                            //     if(id_rol == 6){
                                            //         html += "<div><a href='javascript:void(0)' style='color: red' onclick='DeleteComment(\"" + "#comments_view_" + count_view +"\", true, "+item.id_tasks_comments+")'>Borrar</a></div>"
                                            //     }
                                               
                                            html += '</div>'
                                        html += '</div>'

                                        html += '<div><b>'+item.nombres+" "+item.apellido_p+'</b> <span style="float: right">'+item.created_at+'</span></div>'


                                    html += '</div>'
                                html += '</div>'
                            html += '</div>'
                            
                        });

						$(comment).html("")
						$(comment).html(html)

						}
					});

			}



			$("#add-comments-edit").click(function (e) { 


				var url=document.getElementById('ruta').value;

				$.ajax({
					url:''+url+'/api/sinister/store/comments',
					type:'post',
					data: {
						"id_user": id_user,
						"state"  : $("#state_policie_edit").val(),
						"id"     : $("#id_edit").val(),
						"comment" : $("#comments-edit").val(),
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
						
						getComments($("#state_policie_edit").val(), $("#id_edit").val(), "#comments_content_edit")

					}
				});
			});

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

							$("#id_client").val(data.clients)
							$("#branch_hidden").val(data.branch)
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



			function GetCompanies(select){
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/company/',
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
					$(select+" option").remove();
					$(select).append($('<option>',
					{
					  value: 0,
					  text : "Seleccione"
					}));
					$.each(data, function(i, item){
					  if (item.status == 1) {
						$(select).append($('<option>',
						{
						  value: item.id_clients_company,
						  text : item.business_name
						}));
					  }
					});
			  
				  }
				});
			  }	




			  function GetRamos(select){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/branchs',
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
					$(select+" option").remove();
					$(select).append($('<option>',
					{
					  value : 0,
					  text  : "Seleccione"
					}));
					$.each(data, function(i, item){
					  if (item.status == 1) {
						$(select).append($('<option>',
						{
						  value: item.id_branchs,
						  text : item.name,
						  
						}));
					  }
					});
			  
				  }
				});
			  }




			  



		</script>
	@endsection


