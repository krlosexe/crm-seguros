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
						<h4>Gestión de Anexos.</h4>
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
													<th>Numero de Anexo</th>
													<th>Motivo</th>
													<th>Descripción</th>
													<th>Total</th>
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


				@include('policies.individual.annexes.store')
				@include('policies.individual.annexes.view')
				@include('policies.individual.annexes.edit')



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
				enviarFormularioPut("#form-update", 'api/policies/annexes', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/policies/annexes', '#cuadro2');
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
						 "url":''+url+'/api/policies/annexes/'+{{$id_policies}},
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_annexed"},
						{"data":"reason"},
						{"data":"reason_description"},
						{"data":"total", 
							render : function(data, type, row){
								total_normal = number_format(data, 2)

								if(data < 0)
									total_normal = total_normal * -1;

								return total_normal
							}
						},
						{"data":"state"},
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

			/* ---------------------------11111111111111---------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){

				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();
					
					let cousin_normal = number_format(data.cousin, 2)
					let xpenses_normal = number_format(data.xpenses, 2)
					let vat_normal = number_format(data.vat, 2)
					let agency_commission_normal = number_format(data.agency_commission, 2)
					let total_normal = number_format(data.total, 2)

					if(data.cousin < 0)
						cousin_normal = cousin_normal * -1;

					if(data.xpenses < 0)
						xpenses_normal = xpenses_normal * -1;

					if(data.vat < 0)
						vat_normal = vat_normal * -1;

					if(data.agency_commission < 0)
						agency_commission_normal = agency_commission_normal * -1;

					if(data.total < 0)
						total_normal = total_normal * -1;

					$("#number_annexed_view").val(data.number_annexed).attr("disabled", "disabled")
					$("#state_view").val(data.state).attr("disabled", "disabled")
					$("#risk_view").val(data.risk).attr("disabled", "disabled")
					$("#reason_view").val(data.reason).attr("disabled", "disabled")
					$("#reason_description_view").val(data.reason_description).attr("disabled", "disabled")
					$("#expedition_date_view").val(data.expedition_date).attr("disabled", "disabled")
					$("#start_date_view").val(data.start_date).attr("disabled", "disabled")
					$("#end_date_view").val(data.end_date).attr("disabled", "disabled")
					$("#reception_date_view").val(data.reception_date).attr("disabled", "disabled")
					$("#cousin_view").val(cousin_normal).attr("disabled", "disabled")
					$("#xpenses_view").val(xpenses_normal).attr("disabled", "disabled")
					$("#vat_view").val(vat_normal).attr("disabled", "disabled")
					$("#percentage_vat_cousin_view").val(data.percentage_vat_cousin).attr("disabled", "disabled")
					$("#commission_percentage_view").val(data.commission_percentage).attr("disabled", "disabled")
					$("#agency_commission_view").val(agency_commission_normal).attr("disabled", "disabled")
					$("#total_view").val(total_normal).attr("disabled", "disabled")
					$("#payment_method_view").val(data.payment_method).attr("disabled", "disabled")
					$("#observations_view").val(data.observations).attr("disabled", "disabled")
					$("#accessories_view").val(data.accessories).attr("disabled", "disabled")
				
					data.is_renewable   == 1 ? $("#is_renewable_view").prop("checked", true)   : $("#is_renewable_view").prop("checked", false) 
					
					var url = document.querySelector('#ruta').value + "/policies_annexes/files/"+data.id_policies_annexes+"/0"

					$('#iframeView').attr('src', url);

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
					
					let cousin_normal = number_format(data.cousin, 2)
					let xpenses_normal = number_format(data.xpenses, 2)
					let vat_normal = number_format(data.vat, 2)
					let agency_commission_normal = number_format(data.agency_commission, 2)
					let total_normal = number_format(data.total, 2)

					if(data.cousin < 0)
						cousin_normal = cousin_normal * -1;

					if(data.xpenses < 0)
						xpenses_normal = xpenses_normal * -1;

					if(data.vat < 0)
						vat_normal = vat_normal * -1;

					if(data.agency_commission < 0)
						agency_commission_normal = agency_commission_normal * -1;

					if(data.total < 0)
						total_normal = total_normal * -1;


					$("#number_annexed_edit").val(data.number_annexed)
					$("#state_edit").val(data.state)
					$("#risk_edit").val(data.risk)
					$("#reason_edit").val(data.reason)
					$("#reason_description_edit").val(data.reason_description)
					$("#expedition_date_edit").val(data.expedition_date)
					$("#start_date_edit").val(data.start_date)
					$("#end_date_edit").val(data.end_date)
					$("#reception_date_edit").val(data.reception_date)
					$("#cousin_edit").val(cousin_normal)
					$("#xpenses_edit").val(xpenses_normal)
					$("#vat_edit").val(vat_normal)
					$("#percentage_vat_cousin_edit").val(data.percentage_vat_cousin)
					$("#commission_percentage_edit").val(data.commission_percentage)
					$("#agency_commission_edit").val(agency_commission_normal)
					$("#total_edit").val(total_normal)
					$("#payment_method_edit").val(data.payment_method)
					$("#observations_edit").val(data.observations)
					$("#accessories_edit").val(data.accessories)
				
					data.is_renewable   == 1 ? $("#is_renewable_edit").prop("checked", true)   : $("#is_renewable_view").prop("checked", false) 

					$("#id_edit").val(data.id_policies_annexes)

					var url = document.querySelector('#ruta').value + "/policies_annexes/files/"+data.id_policies_annexes+"/1"

					$('#iframeEdit').attr('src', url);

					cuadros('#cuadro1', '#cuadro4');
				});
			}
			

			function GetBranchByInsurers(select_insurers, select_branch, value_default = false){

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
							
							$.each(data.branchs, function (key, item) { 
								
								$(select_branch).append($('<option>',
								{
									value: item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage,
									text : item.name,
									selected: value_default == item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage ? true : false
								}));
							});

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

			$("body").on('change', '.monto_formato_decimales_annexes', function() {   
			  if($(this).val() != ""){  
			  	let val = number_format($(this).val(), 2)
			  	let valOriginal = parseFloat($(this).val());

			  	if(valOriginal < 0){
			  		val = val * -1;
			  	}

			    $(this).val(val);   
			  }       
			});

			$("#cousin, #xpenses, #commission_percentage, #percentage_vat_cousin").keyup(function (e) { 
				calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission", "#participation")
			});


			$("#cousin_edit, #xpenses_edit, #commission_percentage_edit, #percentage_vat_cousin_edit").keyup(function (e) { 
				calc("#cousin_edit", "#xpenses_edit", "#total_edit", "#percentage_vat_cousin_edit", "#vat_edit", "#commission_percentage_edit", "#agency_commission_edit", "#participation_edit")
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

				let percentage_vat_cousin_normal = number_format(result_percentage_vat_cousin, 2)
				let comission_total_normal = number_format(comission_total, 2)
				let total_normal = number_format(total, 2)

				if(result_percentage_vat_cousin < 0)
					percentage_vat_cousin_normal = percentage_vat_cousin_normal * -1;

				if(comission_total < 0)
					comission_total_normal = comission_total_normal * -1;

				if(total < 0)
					total_normal = total_normal * -1;

				$(input_vat).val(percentage_vat_cousin_normal)
				$(agency_commission).val(comission_total_normal)
				$(input_total).val(total_normal)
			}


	

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/policies/annexes/status/'+data.id_policies_annexes+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/policies/annexes/status/'+data.id_policies_annexes+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/policies/annexes/status/'+data.id_policies_annexes+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>

</body>

</html>
