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

		var url = $(location).attr('href').split("/").splice(-4);
		console.log(url)
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
						<h4>Gestión de Cartera.</h4>
					</div>
					<div class="row">
	  
						<div class="col-md-12">
							<div class="card">
								<div class="card-block">
									<div class="table-overflow">

									@if($management == 1)
										<button onclick="nuevo()" id="btn-new" class="btn btn-success" style="float: left;">
											<i class="ti-plus"></i>
											<span>Nuevo</span>
										</button>
									@endif
										
										<table class="table table-bordered" id="table" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Tipo</th>
													<th>Motivo</th>
													<th>Total</th>
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


				@include('policies.individual.wallet.store')
				@include('policies.individual.wallet.view')
				@include('policies.individual.wallet.edit')



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

				verifyPersmisos(id_user, tokens, "policies");
				if(name_rol != 'Administrador'){
					$('.row-participacion').hide()
				}

			});



			function update(){
				enviarFormularioPut("#form-update", 'api/charge/account', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/charge/account', '#cuadro2');
			}


			function list(cuadro) {

				var management = {{ $management }}
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
						 "url":''+url+'/api/charge/account/'+{{$id_policie}},
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"policie_annexes"},
						{"data":"issue"},
						{"data":"total", 
							render : function(data, type, row){
								return number_format(data, 2)
							}
						},
						{"data": "fec_regins"},
						{"data": null,
							render : function(data, type, row) {
								var botones = "";
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
								if(actualizar == 1 && management == 1)
									botones += "<span class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
								if(data.status == 1 && actualizar == 1 && management == 1)
									botones += "<span class='desactivar btn btn-warning waves-effect' data-toggle='tooltip' title='Desactivar'><i class='fa fa-unlock' style='margin-bottom:5px'></i></span> ";
								else if(data.status == 2 && actualizar == 1 && management == 1)
									botones += "<span class='activar btn btn-warning waves-effect' data-toggle='tooltip' title='Activar'><i class='fa fa-lock' style='margin-bottom:5px'></i></span> ";
								if(borrar == 1 && management == 1)
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

				$("#beneficairy_onerous_input_bind").val(1)

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")

				cuadros("#cuadro1", "#cuadro2");
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
				$("#issue-store").val($("#name-footer").val())
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
					console.log(data)
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
					$("#participation-edit").val(data.participation)
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
					var route = '/api/policies/'+{{$id_policie}};
				}else{
					var route = '/api/policies/annexes/'+{{$id_policie}};
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
								$("#participation").val(data.participation)
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
							$("#participation").val(data.participation)
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


	

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/charge/account/statusChangeAccount/'+data.id_charge_accounts+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/charge/account/statusChangeAccount/'+data.id_charge_accounts+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/charge/account/statusChangeAccount/'+data.id_charge_accounts+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>

</body>

</html>
