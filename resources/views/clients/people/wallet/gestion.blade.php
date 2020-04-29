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
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/multiple-select/css/bootstrap-multiselect.css" />


    <style type="text/css">
/*	    .multiselect-native-select .btn-group{
	    	display: block; 
	    }
*/

    	.multiselect.dropdown-toggle.btn.btn-default, .multiselect-container.dropdown-menu.show, .multiselect-container.dropdown-menu.show label{
    		width: 100% !important;
    	}
    	.multiselect-native-select .active{
    		background: aliceblue;
    	}
    </style>

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
										<button onclick="nuevoMultiple()" id="btn-new" class="btn btn-success" style="float: left;">
											<i class="ti-plus"></i>
											<span>Nuevo</span>
										</button>
									{{-- 	<button onclick="nuevoMultiple()" id="btn-new" class="btn btn-info" style="float: left;">
											<i class="ti-plus"></i>
											<span>Polizas multiples</span>
										</button>
 --}}									@endif
										
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


				@include('clients.people.wallet.store_multiple')
				@include('clients.people.wallet.edit_multiple')
				@include('clients.people.wallet.store')
				@include('clients.people.wallet.view')
				{{-- @include('clients.people.wallet.edit') --}}


      </div>

	  
    </div>



            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="default-modal" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                <h4>Pie de página</h4></div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-8">
                        <label for=""><b>Seleccione</b></label>
                        <select name="" id="footers" class="form-control footers">
                          <option value="">Seleccione</option>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <button type="button" id="new-pie" class="btn btn-success">Nuevo</button>
                      </div>
                    </div>
                    


                    <div id="content-pie" class="remove-pie" style="display:none">
                      <div class="row">
                        <div class="col-md-12">
                        <label for=""><b>Nombre</b></label>
                          <div class="form-group valid-required">
                          <input type="text" name="issue" class="form-control form-control-user" id="name-footer">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                        <label for=""><b>Contenido</b></label>
                          <div class="form-group valid-required">
                            <textarea class="form-control" name="" id="content-footer" cols="30" rows="10"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="modal-footer no-border">
                      <div class="text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn-save-pie" class="btn btn-success btn-save-pie" disabled>Guardar</button>
                      </div>


                      <div class="text-right">
                        <button type="button" id="btn-select-pie" data-dismiss="modal" class="btn btn-success btn-save-pie" disabled>Seleccionar</button>
                      </div>


                  </div>
                </div>
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
      <script src="<?= url('/') ?>/vendors/multiple-select/js/bootstrap-multiselect.js"></script>

  <script>
    var user_id = localStorage.getItem('user_id');
    $("#logout").attr("href", "logout/"+user_id)
  </script>

	<script>
		var multiselect;

			$(document).ready(function(){
				store();
				storeMultiple();
				updateMultiple();
				list();
				update();

				$("#collapse_Polizas").addClass("show");
				$("#nav_li_Polizas").addClass("open");
				$("#nav_users, #modulo_Polizas").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");

				$('.multiselect').multiselect({
				      selectAllText: true,
				      buttonWidth: '100%'
				});

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

			function updateMultiple(){
				enviarFormularioPut("#edit-multiple", 'api/charge/account/multiple', '#cuadro6', false, '#avatar-edit');
			}

			function storeMultiple(){
				enviarFormulario("#store-multiple", 'api/charge/account/multiple', '#cuadro5');
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
						 "url":''+url+'/api/client/charge/account/'+{{$id_client}}+'/'+{{$type_client}},
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

			function nuevoMultiple() {

				$("#alertas").css("display", "none");
				$("#store-multiple")[0].reset();
				$(".container-datos-adicionales-hijo").css("display", "none");
				$(".container-datos-adicionales-vehicle").css("display", "none");

				$("#beneficairy_onerous_input_bind").val(1)

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")

				$("#number-multiple option").remove();

			    $('.multiselect').multiselect('destroy');

				$('.multiselect').multiselect({
				      selectAllText: true,
				      buttonWidth: '100%'
				});

				$('#number-multiple').change();

				cuadros("#cuadro1", "#cuadro5");
			}


			var api = "/api/footers";
			$("body #add-pie").click(function (e) { 
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
				$("#name-footer").val($("#footers option:selected").text())
				$("#content-footer").val($(this).val())
				$(".remove-pie").css("display", "block")
				api = "/api/footers/update";
			});


			$("#btn-select-pie").click(function (e) { 
				$("#issue-multiple").val($("#name-footer").val())
				$("#issue-store").val($("#name-footer").val())
				$("#footer-store").val($("#content-footer").val())
				$("#footer-multiple").val($("#name-footer").val())
				
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

			$('#submit-registrar-multiple').click(function(e){
				e.preventDefault();

				let tbody = document.querySelector('.number-multiple tbody');
				let valid = true;

				if(tbody.children[0].childElementCount == 1){
					return alert("Debe seleccionar al menos una poliza")
				}

				Array.from(tbody.children).forEach(tr => {
					let cousin = tr.querySelector("input[name='cousin[]']").value;
					let xpense = tr.querySelector("input[name='xpenses[]']").value;

					if(cousin == '' && valid){
						valid = false;
						alert("El campo prima es requeridos en cada fila");
						tr.querySelector("input[name='cousin[]']").focus();
						return 
					}

					if(xpenses == '' && valid){
						valid = false;
						alert("El campo gastos es requeridos en cada fila");
						tr.querySelector("input[name='xpenses[]']").focus();
						return 
					}
				})

				if(valid){
					$('#store-multiple').submit();
				}
			})

			$('#submit-registrar-multiple-edit').click(function(e){
				e.preventDefault();

				let tbody = document.querySelector('.number-multiple-edit tbody');
				let valid = true;

				if(tbody.children[0].childElementCount == 1){
					return alert("Debe seleccionar al menos una poliza")
				}

				Array.from(tbody.children).forEach(tr => {
					let cousin = tr.querySelector("input[name='cousin[]']").value;
					let xpense = tr.querySelector("input[name='xpenses[]']").value;

					if(cousin == '' && valid){
						valid = false;
						alert("El campo prima es requeridos en cada fila");
						tr.querySelector("input[name='cousin[]']").focus();
						return 
					}

					if(xpenses == '' && valid){
						valid = false;
						alert("El campo gastos es requeridos en cada fila");
						tr.querySelector("input[name='xpenses[]']").focus();
						return 
					}
				})

				if(valid){
					$('#edit-multiple').submit();
				}
			})


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

					$("#policie_annexes-multiple-view").val(data.policie_annexes).trigger('change');
					$("#policie_annexes-multiple-view").attr("readonly", "readonly");

					setTimeout(() => {


				   	   $('.multiselect').multiselect('destroy');


						data.charge_account.forEach(item => {

							let chargeSelected = data.policie_annexes == "Poliza" ? 
														item.policie_data.id_policies : 
														item.policie_anexes_data.id_policies_annexes;

							let optionSelected = $(`.multiselect option[value="${chargeSelected}"]`);
							console.log(optionSelected)
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

						$('#cuadro3').find('input, select, textarea').attr('disabled', 'disabled')

					}, 2000)

					$("#init_date-multiple-view").val(data.init_date)
					$("#limit_date-multiple-view").val(data.limit_date)
					$("#issue-multiple-view").val(data.issue)
					$("#footer-multiple-view").val(data.observations)


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

					$("#policie_annexes-multiple-edit").val(data.policie_annexes).trigger('change');
					$("#policie_annexes-multiple-edit").attr("readonly", "readonly");

					console.log(data)

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

						$('#number-multiple-edit').change();

					}, 2000)

					$("#init_date-multiple-edit").val(data.init_date)
					$("#limit_date-multiple-edit").val(data.limit_date)
					$("#issue-multiple-edit").val(data.issue)
					$("#footer-multiple-edit").val(data.observations)


					$("#id_edit").val(data.id)

					cuadros('#cuadro1', '#cuadro6');
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

			$("#policie_annexes-store, #policie_annexes-multiple, #policie_annexes-multiple-edit, #policie_annexes-multiple-view").change(function (e) { 

				var type = $(this).val();
				const idElement = $(this).attr('id');

				if($(this).val() == "Poliza"){
					var route = '/api/clients/people/policies/'+{{$id_client}}+'/'+{{$type_client}};
				}else{
					var route = '/api/client/policies/annexes/'+{{$id_client}}+'/'+{{$type_client}};
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

							
								// bloque solo se encarga del form de polizas multiples

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


			$('#number-multiple, #number-multiple-edit, #number-multiple-view').change(function(){
				const values = $(this).val();

				let tdContent = `
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

						const json = JSON.parse($(`#number-multiple option[value="${id}"]`).attr('json'));
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
				}else{

					
					var route = '/api/policies/'+$(this).val();
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
					statusConfirmacion('api/charge/account/status/'+data.id+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/charge/account/status/'+data.id+"/"+1,"¿Está seguro de activar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/charge/account/status/'+data.id+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>

</body>

</html>
