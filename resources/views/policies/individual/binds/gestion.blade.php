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
						<h4>Gestión de Vinculados.</h4>
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
													<th>Número de Anexo</th>
													<th>Número de Afiliado</th>
													<th>Nombre</th>
													<th>Documento</th>
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


				@include('policies.individual.binds.store')
				@include('policies.individual.binds.view')
				@include('policies.individual.binds.edit')



      </div>
    </div>


			<div class="modal fade" id="modal-cf" aria-hidden="true" style="display: none;">
			
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Carga Familiar</h3>
						</div>
						<div class="modal-body">
							<form action="" id="form-familyBurden">
							<input id="count_fila_familyBurden" hidden value="nuevo">
								<div class="row">
									 
									<input id="count_fila_familyBurden" hidden value="nuevo">

									<div class="col-md-6">
										<label for=""><b>Nombre</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="name_familyBurden">
										</div>
									</div>


									<div class="col-md-6">
										<label for=""><b>Documento</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="document_familyBurden" required>
										</div>
									</div>

									<div class="col-md-6">
										<label for=""><b>Fecha de Nacimiento</b></label>
										<div class="form-group valid-required">
											<input type="date" class="form-control" id="birthdate_familyBurden" >
										</div>
									</div>

									<div class="col-md-6">
										<label for=""><b>Parentesco</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="relationship_familyBurden" required>
										</div>
									</div>

									<div class="col-md-6">
										<label for=""><b>Fecha Inicio</b></label>
										<div class="form-group valid-required">
											<input type="date" class="form-control" id="startDate_familyBurden" required>
										</div>
									</div>

									<div class="col-md-6">
										<label for=""><b>Prima</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control monto_formato_decimales" id="cousin_familyBurden" required>
										</div>
									</div>

								</div>


								<div class="row">
									<div class="col-md-12">
										<button type="submit" id="btn-add-familyBurden" class="btn btn-success" style="float: left;">
										<span>Guardar  </span>
									</button>
									</div>
								</div>
							</form>

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
				enviarFormularioPut("#form-update", 'api/policies-binds', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/policies-binds', '#cuadro2');
			}



			$("#btn-familyBurden, #btn-familyBurden-edit").click(function (e) { 
				$('#count_fila_familyBurden').val('nuevo');
				$('#modal-cf input').removeAttr('disabled')
				$('#modal-cf select').removeAttr('disabled')
				$("#form-familyBurden")[0].reset()
				$('#modal-cf #btn-add-familyBurden').show();
			});


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
						 "url":''+url+'/api/policies-binds/'+{{$id_policies}},
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_annexed"},
						{"data":"number_affiliate"},
						{"data":"name_affiliate"},
						{"data":"document_affiliate"},
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

				GetInsurers("#insurers")

				$('#table-familyBurden-store tbody').html('');

				GetBranchByInsurers("#insurers", "#branch")
				GetClients("#clients_select");

				ChangeSelectBranch("#branch")

				$("#beneficairy_onerous_input_bind").val(1)

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")

				cuadros("#cuadro1", "#cuadro2");
			}

			function editFamilyBurden(tr, countId, isinfo = false){

				let name_familyBurden 		  = document.querySelector(`${tr} input[name="name_familyBurden[]"]`).value;
				let document_familyBurden     = document.querySelector(`${tr} input[name="document_familyBurden[]"]`).value;
				let birthdate_familyBurden    = document.querySelector(`${tr} input[name="birthdate_familyBurden[]"]`).value;
				let relationship_familyBurden = document.querySelector(`${tr} input[name="relationship_familyBurden[]"]`).value;
				let startDate_familyBurden 	  = document.querySelector(`${tr} input[name="startDate_familyBurden[]"]`).value;
				let cousin_familyBurden       = document.querySelector(`${tr} input[name="cousin_familyBurden[]"]`).value;
				

				$("#btn-familyBurden").click();

				$('#count_fila_familyBurden').val(countId);
				$("#name_familyBurden").val(name_familyBurden)
				$("#document_familyBurden").val(document_familyBurden)
				$("#birthdate_familyBurden").val(birthdate_familyBurden)
				$("#relationship_familyBurden").val(relationship_familyBurden)
				$("#startDate_familyBurden").val(startDate_familyBurden)
				$("#name_affiliate_bind").val(name_affiliate_bind)
				$("#cousin_familyBurden").val(cousin_familyBurden)
				
				if(isinfo){
					$('#modal-cf input').attr('disabled', true)
					$('#modal-cf select').attr('disabled', true)
					$('#modal-cf #btn-add-familyBurden').hide();
				}

			}

			var countFamilyBurden = 0

			function realFormFamily(view = false){
				var count_fila_familyBurden   = document.querySelector('#count_fila_familyBurden').value;
				var name_familyBurden 		  = document.querySelector('#name_familyBurden').value;
				var document_familyBurden     = document.querySelector('#document_familyBurden').value;
				var birthdate_familyBurden    = document.querySelector('#birthdate_familyBurden').value;
				var relationship_familyBurden = document.querySelector('#relationship_familyBurden').value;
				var startDate_familyBurden 	  = document.querySelector('#startDate_familyBurden').value;
				var cousin_familyBurden       = document.querySelector('#cousin_familyBurden').value;

				var btn_delete_familyBurden = `
						<button type='button' onclick='editFamilyBurden("#tr_familyBurden_${countFamilyBurden}", ${countFamilyBurden}, true)' class='btn btn-info btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-preview'></i>
						</button>

						<button type='button' onclick='editFamilyBurden("#tr_familyBurden_${countFamilyBurden}", ${countFamilyBurden})' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-save-edit'></i>
						</button>

						<button type='button' onclick='DeleteTr("#tr_familyBurden_${countFamilyBurden}")' class='btn btn-danger btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='fa fa-trash'></i>
						</button>`

				var valuesFB = `<input type='hidden'  name='name_familyBurden[]' value='${name_familyBurden}'>`
				    valuesFB += `<input type='hidden'  name='document_familyBurden[]' value='${document_familyBurden}'>`
				    valuesFB += `<input type='hidden'  name='birthdate_familyBurden[]' value='${birthdate_familyBurden}'>`
				    valuesFB += `<input type='hidden'  name='relationship_familyBurden[]' value='${relationship_familyBurden}'>`
				    valuesFB += `<input type='hidden'  name='startDate_familyBurden[]' value='${startDate_familyBurden}'>`
				    valuesFB += `<input type='hidden'  name='cousin_familyBurden[]' value='${cousin_familyBurden}'>`


				var htmlFamilyBurden       = ""


				htmlFamilyBurden += "<tr id='tr_familyBurden_"+countFamilyBurden+"'>"
					htmlFamilyBurden += "<td>"+name_familyBurden+"</td>"
					htmlFamilyBurden += "<td>"+document_familyBurden+"</td>"
					htmlFamilyBurden += "<td>"+relationship_familyBurden+"</td>"
					if (!view) {

						htmlFamilyBurden += "<td>"+btn_delete_familyBurden+valuesFB+"</td>"
					}
					else{

						htmlFamilyBurden += `<td>
								<button type='button' onclick='editFamilyBurden("#tr_familyBurden_${countFamilyBurden}", ${countFamilyBurden}, true)' class='btn btn-info btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-preview' aria-hidden='true'></i>
						</button>
						${valuesFB}
						</td>`
					}
				htmlFamilyBurden += "</tr>"


				if(count_fila_familyBurden != 'nuevo'){
					$('#tr_familyBurden_'+count_fila_familyBurden).remove();
					$('#tr_familyBurden_'+count_fila_familyBurden).remove();
					$('#tr_familyBurden_'+count_fila_familyBurden).remove();
				}

				$("#table-familyBurden-store tbody").append(htmlFamilyBurden);
				$("#table-familyBurden-edit tbody").append(htmlFamilyBurden);
				$("#table-familyBurden-view tbody").append(htmlFamilyBurden);

				$("#modal-cf").modal("hide");

				countFamilyBurden++		
			}

			document.querySelector('#form-familyBurden').addEventListener("submit", function(e){

				e.preventDefault();
			
				realFormFamily();
			})


			/* ---------------------------11111111111111---------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){

				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();

				$('#table-familyBurden-view tbody').html('');
					
					$("#number_anexo_bind_view").val(data.number_annexed).attr("disabled", "disabled")
					$("#number_affiliate_bind_view").val(data.number_affiliate).attr("disabled", "disabled")
					$("#date_init_bind_view").val(data.date_init).attr("disabled", "disabled")
					$("#insured_object_bind_view").val(data.insured_object).attr("disabled", "disabled")
					$("#cousin_bind_view").val(data.cousin).attr("disabled", "disabled")
					$("#name_affiliate_bind_view").val(data.name_affiliate).attr("disabled", "disabled")
					$("#document_affiliate_bind_view").val(data.document_affiliate).attr("disabled", "disabled")
					$("#relationship_bind_view").val(data.relationship).attr("disabled", "disabled")
					$("#birthdate_bind_view").val(data.birthdate).attr("disabled", "disabled")
					$("#age_bind_view").val(calcularEdad(data.birthdate)).attr("disabled", "disabled")
					$("#gender_bind_view").val(data.gender).attr("disabled", "disabled")
					$("#phone_bind_view").val(data.phone).attr("disabled", "disabled")
					$("#email_bind_view").val(data.email).attr("disabled", "disabled")
					$("#address_bind_view").val(data.address).attr("disabled", "disabled")
					$("#plan_bind_view").val(data.plan).attr("disabled", "disabled")
					$("#type_rate_bind_view").val(data.type_rate).attr("disabled", "disabled")
					$("#type_membership_bind_view").val(data.type_membership).attr("disabled", "disabled")

					$("#percentage_vat_bind_view").val(number_format(data.percentage_vat, 2)).attr("disabled", "disabled")
					$("#expenses_bind_view").val(number_format(data.expenses, 2)).attr("disabled", "disabled")
					$("#vat_bind_view").val(number_format(data.vat, 2)).attr("disabled", "disabled")
					$("#total_bind_view").val(number_format(data.total, 2)).attr("disabled", "disabled")
					$("#company_bind_view").val(data.company).attr("disabled", "disabled")
					$("#employee_bind_view").val(data.employee).attr("disabled", "disabled")
					$("#internal_observations_bind_view").val(data.internal_observations).attr("disabled", "disabled")
					$("#observations_bind_view").val(data.observations).attr("disabled", "disabled")

					$("#beneficairy_name_bind_view").val(data.beneficairy_name).attr("disabled", "disabled")
					$("#beneficairy_identification_bind_view").val(data.beneficairy_identification).attr("disabled", "disabled")
				
					data.beneficairy_onerous   == 1 ? $("#beneficairy_onerous_bind_view").prop("checked", true)   : $("#beneficairy_onerous_bind_view").prop("checked", false)

					if(data.policies_family_burden_data.length > 0){
						data.policies_family_burden_data.forEach(item => {

								document.querySelector('#count_fila_familyBurden').value = countFamilyBurden;
								document.querySelector('#name_familyBurden').value = item.name;
								document.querySelector('#document_familyBurden').value = item.document;
								document.querySelector('#birthdate_familyBurden').value = item.birthdate;
							    document.querySelector('#relationship_familyBurden').value = item.relationship;
								document.querySelector('#startDate_familyBurden').value = item.date_init;
								document.querySelector('#cousin_familyBurden').value = item.cousin;

								realFormFamily(true)
						})
					}

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
					
				$('#table-familyBurden-edit tbody').html('');

					$("#number_anexo_bind_edit").val(data.number_annexed)
					$("#number_affiliate_bind_edit").val(data.number_affiliate)
					$("#date_init_bind_edit").val(data.date_init)
					$("#insured_object_bind_edit").val(data.insured_object)
					$("#cousin_bind_edit").val(data.cousin)
					$("#name_affiliate_bind_edit").val(data.name_affiliate)
					$("#document_affiliate_bind_edit").val(data.document_affiliate)
					$("#relationship_bind_edit").val(data.relationship)
					$("#birthdate_bind_edit").val(data.birthdate)
					
					$("#age_bind_edit").val(calcularEdad(data.birthdate)).attr("disabled", "disabled")
					$("#gender_bind_edit").val(data.gender)
					$("#phone_bind_edit").val(data.phone)
					$("#email_bind_edit").val(data.email)
					$("#address_bind_edit").val(data.address)
					$("#plan_bind_edit").val(data.plan)
					$("#type_rate_bind_edit").val(data.type_rate)
					$("#type_membership_bind_edit").val(data.type_membership)

					$("#percentage_vat_bind_edit").val(number_format(data.percentage_vat, 2))
					$("#expenses_bind_edit").val(number_format(data.expenses, 2))
					$("#vat_bind_edit").val(number_format(data.vat, 2))
					$("#total_bind_edit").val(number_format(data.total, 2))
					$("#company_bind_edit").val(data.company)
					$("#employee_bind_edit").val(data.employee)
					$("#internal_observations_bind_edit").val(data.internal_observations)
					$("#observations_bind_edit").val(data.observations)

					$("#beneficairy_name_bind_edit").val(data.beneficairy_name)
					$("#beneficairy_identification_bind_edit").val(data.beneficairy_identification)
				
					data.beneficairy_onerous   == 1 ? $("#beneficairy_onerous_bind_edit").prop("checked", true)   : $("#beneficairy_onerous_bind_edit").prop("checked", false) 
					
					$("#id_edit").val(data.id_policies_bind)

					if(data.policies_family_burden_data.length > 0){
						data.policies_family_burden_data.forEach(item => {
								document.querySelector('#count_fila_familyBurden').value = countFamilyBurden;
								document.querySelector('#name_familyBurden').value = item.name;
								document.querySelector('#document_familyBurden').value = item.document;
								document.querySelector('#birthdate_familyBurden').value = item.birthdate;
							    document.querySelector('#relationship_familyBurden').value = item.relationship;
								document.querySelector('#startDate_familyBurden').value = item.date_init;
								document.querySelector('#cousin_familyBurden').value = item.cousin;

								realFormFamily()
						})
					}

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



			// $("#cousin, #xpenses, #participation").keyup(function (e) { 
			// 	calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission", "#participation")
			// });


			$("#cousin_bind_edit, #expenses_bind_edit, #percentage_vat_bind_edit, #total_bind_edit").keyup(function (e) { 
				calc_bind("#cousin_bind_edit", "#expenses_bind_edit", "#total_bind_edit", "#percentage_vat_bind_edit", "#vat_bind_edit")
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



			$("#beneficairy_onerous_bind_edit").change(function (e) { 
				if ($("#beneficairy_onerous_bind_edit").is(':checked')){
					$("#beneficairy_onerous_input_bind_edit").val(1)
				}else{
					$("#beneficairy_onerous_input_bind_edit").val(0)
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



		

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies-bind/'+data.id_policies_bind+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-policies-bind/'+data.id_policies_bind+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies-bind/'+data.id_policies_bind+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>

</body>

</html>
