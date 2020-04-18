<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>App</title>

  <!-- Custom fonts for this template-->
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/bootstrap/dist/css/bootstrap.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/PACE/themes/blue/pace-theme-minimal.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/perfect-scrollbar/css/perfect-scrollbar.min.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/selectize/dist/css/selectize.default.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/nvd3/build/nv.d3.min.css" />
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/datatables/media/css/jquery.dataTables.css" />
    <link href="<?= url('/') ?>/vendors/bootstrap-fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?= url('/') ?>/vendors/bootstrap-fileinput/themes/explorer-fas/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="<?= url('/') ?>/vendors/sweetalert/sweetalert.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/selectize/dist/css/selectize.default.css" />
    <link href="<?= url('/') ?>/css/ei-icon.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/themify-icons.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/animate.min.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/app.css" rel="stylesheet">
    <link href="<?= url('/') ?>/css/custom.css" rel="stylesheet">
    <script src="<?= url('/') ?>/vendors/jquery/dist/jquery.min.js"></script>

  
   @if(Request::path() != '/')

    <script>
      $(document).ready(function(){
		var url = $(location).attr('href').split("/").splice(-3);
        validAuth(false, url[0]);
      });
    </script>

  @endif

</head>

<body class="{{ Request::path() != '/' ? 'dasboard-body' : ''}} bg-gradient-primary">
  <div id="page-loader"  ><span class="preloader-interior"></span></div>

  <div id="wrapper" class="app">
    <div id="content-wrapper" class="layout">
      
       <div class="page-container" style="padding-left: 0px">
			<div class="main-content">

				<div class="container-fluid" id="cuadro1">
					<div class="page-title">
						<h4>Gestión de Polizas.</h4>
					</div>
					<div class="row">
	  
						<div class="col-md-12">
							<div class="card">
								<div class="card-block">
									<div class="table-overflow">
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Número de Póliza</th>
												<th>Cliente</th>
												<th>Aseguradora</th>
												<th>Ramo</th>
												<th>Tipo</th>
												<th>Estatus</th>
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


				@include('clients.people.policies.store')
				@include('clients.people.policies.view')
				@include('clients.people.policies.edit')



      </div>
    </div>
    <!-- End of Content Wrapper -->

<input type="hidden" id="ruta" value="<?= url('/') ?>">
      <script src="<?= url('/') ?>/vendors/popper.js/dist/umd/popper.min.js"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap/dist/js/bootstrap.js"></script>
      <script src="<?= url('/') ?>/vendors/PACE/pace.min.js"></script>
      <script src="<?= url('/') ?>/vendors/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
      <script src="<?= url('/') ?>/vendors/bower-jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="<?= url('/') ?>/js/maps/jquery-jvectormap-us-aea.js"></script>
      <script src="<?= url('/') ?>/vendors/d3/d3.min.js"></script>
      <script src="<?= url('/') ?>/vendors/nvd3/build/nv.d3.min.js"></script>
      <script src="<?= url('/') ?>/vendors/jquery.sparkline/index.js"></script>
      <script src="<?= url('/') ?>/vendors/chart.js/dist/Chart.min.js"></script>
      <script src="<?= url('/') ?>/vendors/noty/js/noty/packaged/jquery.noty.packaged.min.js"></script>
      <script src="<?= url('/') ?>/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
      <script src="<?= url('/') ?>/vendors/datatables/media/js/jquery.dataTables.js"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/plugins/piexif.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/plugins/sortable.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/fileinput.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/locales/fr.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/js/locales/es.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/themes/fas/theme.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/bootstrap-fileinput/themes/explorer-fas/theme.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/sweetalert/sweetalert.min.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/sweetalert/sweetalert-dev.js" type="text/javascript"></script>
      <script src="<?= url('/') ?>/vendors/selectize/dist/js/standalone/selectize.min.js"></script>
      <script src="<?= url('/') ?>/vendors/numeral/min/numeral.min.js"></script>
      <script src="<?= url('/') ?>/js/app.js"></script>
      <script src="<?= url('/') ?>/js/dashboard/dashboard.js"></script>
      <script src="<?= url('/') ?>/js/funciones.js"></script>
      <script src="<?= url('/') ?>/js/table/data-table.js"></script>
  <script>
    var user_id = localStorage.getItem('user_id');
    $("#logout").attr("href", "logout/"+user_id)
  </script>

<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Polizas").addClass("show");
				$("#nav_li_Polizas").addClass("open");
				$("#nav_users, #modulo_Polizas").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/files', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/files', '#cuadro2');
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
						 "url":''+url+'/api/clients/people/policies/'+{{$id_client}}+'/'+{{ $type_client }},
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_policies"},
						{"data":null,
							render : function(data, type, row) {
								if(row.type_clients == 0){
									return row.names+" "+row.last_names
								}else{
									return row.business_name
								}
									
							}
						},
						{"data":"name_insurers"},
						{"data":"name_branchs"},
						{"data":"type_poliza"},
						{"data":"state_policies"},
						{"data": "fec_regins"},
						{"data": null,
							render : function(data, type, row) {
								var botones = "";
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
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

			}


			/* ---------------------------11111111111111---------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){

				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();

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


					var url = "/policies/annexes/"+data.id_policies+"/0"
					$('#iframeAnnexesView').attr('src', url);


					var url = "/policies/files/"+data.id_policies+"/0"
					$('#iframeDigitalesView').attr('src', url);


					var url = "/policies/wallet/"+data.id_policies+"/0"
					$('#iframeCarteraView').attr('src', url);



					cuadros('#cuadro1', '#cuadro3');
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
				$("#form-bind")[0].reset()
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


				var btn_delete = "<button type='button' onclick='DeleteTr(\"" + "#tr_bind_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"

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

				$("#table-bind tbody").append(html);

				$("#modal-lg").modal("hide")
				count++
				});



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


		</script>

</body>

</html>
