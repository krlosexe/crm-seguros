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
		var url = $(location).attr('href').split("/").splice(-2);
		
        validAuth(false, url[0]);
      });
    </script>

  @endif

</head>

<body class="{{ Request::path() != '/' ? 'dasboard-body' : ''}} bg-gradient-primary">
  <div id="page-loader"  ><span class="preloader-interior"></span></div>

  <div id="wrapper" class="app">
    <div id="content-wrapper" class="layout">
		@include('layouts.sidebar')


       <div class="page-container" >
	   		@include('layouts.topBar') 
			<div class="main-content">

			<div class="card shadow mb-4" id="cuadro3">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Consulta de Vehiculo.</h6>
				</div>
				<div class="card-body">
					<form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
					
						@csrf


						<ul class="nav nav-pills" role="tablist">
							<li class="nav-item">
								<a href="#default-tab-1-store" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
							</li>
							<li class="nav-item">
								<a href="#default-tab-2-store" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
							</li>
						</ul>

						<br><br>


						<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-store">

							<div class="row">
							<div class="col-md-6">

								<div class="row">

								<div class="col-md-12">

									<div class="card shadow mb-4">
									<div class="card-header py-3">
										<h6 class="m-0 font-weight-bold text-primary">Datos Principales</h6>
									</div>
									<div class="card-body">

										<div class="row">
										<div class="col-md-4">
											<label for=""><b>Número de placa*</b></label>
											<div class="form-group valid-required">
												<input type="text" name="placa" class="form-control form-control-user" id="placa_view" placeholder="EJ: FHP823" required>
											</div>
										</div>

										<div class="col-md-4">
											<label for=""><b>Tipo de Vehículo*</b></label>
											<select name="type_vehicule" class="form-control" id="type_vehicule_view" required>
											<option value="">Seleccione</option>
											
											</select>
										</div>
											<div class="col-sm-4">
											<label for=""><b>Marca*</b></label>
											<select name="marca" class="selectized" id="marca_view" required>
											<option value="">Seleccione</option>
												
											</select>
											</div>

										</div>


										<div class="row">
										
										

											<div class="col-sm-4">
											<label for=""><b>Linea*</b></label>
											<select name="line" class="selectized" id="line_view" required>
											<option value="">Seleccione</option>
												
											</select>
											</div>
											
											<div class="col-sm-4">
											<label for=""><b>Referencia 2*</b></label>
											<select name="refer2" class="selectized" id="refer2_view" required>
											<option value="">Seleccione</option>
												
											</select>
											</div>

											<div class="col-sm-4">
											<label for=""><b>Referencia 3*</b></label>
											<select name="refer3" class="selectized" id="refer3_view" required>
											<option value="">Seleccione</option>
												
											</select>
											</div>



											
										</div>

										<br>
										

										<div class="row">
										<div class="col-sm-4">
											<label for=""><b>Modelo*</b></label>
											<input type="number" name="model" class="form-control form-control-user" id="model_view" placeholder="EJ: 2007" required>
											</div>
										<div class="col-sm-4">
											<label for=""><b>Color*</b></label>
											<input type="text" name="color" class="form-control form-control-user" id="color_view" placeholder="Color del vehículo" required>
									
										</div>


											<div class="col-sm-4">
											<label for=""><b>Servicio*</b></label>
											<input type="text" name="service" class="form-control form-control-user" id="service_view" placeholder="Tipo de servicio" readonly>
										</div>


										
										</div>

									</div>
										<br>
										<br>
									</div>
								</div>
								</div>


								<div class="row">
								<div class="col-md-12">
									<div class="card shadow mb-4">
									<div class="card-header py-3">
										<h6 class="m-0 font-weight-bold text-primary">Característica</h6>
									</div>
									<div class="card-body">

										<div class="row">
										<div class="col-md-4">
											<label for=""><b>Cilindraje*</b></label>
											<div class="form-group valid-required">
												<input type="text" name="cc" class="form-control form-control-user" id="cc_view" placeholder="Cilindraje" required>
											</div>
										</div>

										<div class="col-md-4">
											<label for=""><b>Número de Motor*</b></label>
											<div class="form-group valid-required">
												<input type="text" name="number_motor" class="form-control form-control-user" id="number_motor_view" placeholder="Número de motor" required>
											</div>
										</div>

										<div class="col-md-4">
											<label for=""><b>Número de Chasis*</b></label>
											<div class="form-group valid-required">
												<input type="text" name="number_chassis" class="form-control form-control-user" id="number_chassis_view" placeholder="Número de chasis" required>
											</div>
										</div>
										</div>

										<br>

										<div class="row">
										<div class="form-group col-md-12">
											<div class="row">
												<div class="col-md-4">
													<label for=""><b>Número de pasajeros*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="number_passengers" class="form-control form-control-user" id="number_passengers_view" placeholder="Número pasajeros" required>
													</div>
												</div>
												<div class="col-md-4">
													<label for=""><b>Puertas*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="doors" class="form-control form-control-user" id="doors_view" placeholder="Número de puertas" required>
													</div>
												</div>
												<div class="col-md-4">
													<label for=""><b>Peso de vehículo*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="vehicle_weight" class="form-control form-control-user" id="vehicle_weight_view" placeholder="Peso en KG" required>
													</div>
												</div>
											</div>
											<br>
											<div class="row">
												


												<div class="col-md-4">
													<label for=""><b>Ejes*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="axes" class="form-control form-control-user" id="axes_view" placeholder="Número de ejes" required>
													</div>
												</div>

												<div class="col-md-4">
													<label for=""><b>Tipo de caja*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="type_drop" class="form-control form-control-user" id="type_drop_view" placeholder="Tipo de caja" required>
													</div>
												</div>
												<div class="col-md-4">
													<label for=""><b>Tipo de combustible*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="type_fuel" class="form-control form-control-user" id="type_fuel_view" placeholder="Tipo de combustible" required>
													</div>
												</div>

											</div>
											<br>
											<div class="row">
												

												<div class="col-md-4">
													<label for=""><b>Transmisión*</b></label>
													<div class="form-group valid-required">
														<input type="text" name="transmission" class="form-control form-control-user" id="transmission_view" placeholder="Mecánica/Automatica" required>
													</div>
												</div>

											
											</div>
										</div>
										</div>
										<br>

									</div>
									</div>
								</div>

								</div>


							</div>




							<div class="col-md-6">

								<div class="row">

								<div class="col-md-12">
									<div class="card shadow mb-4">
									<div class="card-header py-3">
										<h6 class="m-0 font-weight-bold text-primary">Informacion adicional</h6>
									</div>
									<div class="card-body">
										<div class="row">
										<div class="col-md-6">
											<label for=""><b>Fecha de vencimiento de técnico mecánica</b></label>
											<div class="form-group valid-required">
												<input type="date" name="due_date_techno_mechanics" class="form-control form-control-user" id="due_date_techno_mechanics_view" >
											</div>
										</div>

										<div class="col-md-6">
											<label for=""><b>Valor Fasecolda*</b></label>
											<div class="form-group valid-required">
												<input type="text" name="value_fasecolda" class="form-control form-control-user" id="value_fasecolda_view" placeholder="Valor en pesos" >
											</div>
										</div>
										
										</div>


										<br>
									<div class="row">
										<div class="col-md-12">
											<label for=""><b>Código Fasecolda</b></label>
											<div class="form-group valid-required">
												<input type="text" name="code" class="form-control form-control-user" id="code_view" >
											</div>
										</div>
										<div class="card-header py-3">
										<center> <a href="https://fasecolda.com/guia-de-valores/index.php" target="_blank"><h6 class="m-0 font-weight-bold text-primary">Para buscar información más detallada haz clic aquí</h6></a></center>
										</div>
										</div>

									
										</div>

									</div>
									</div>
								</div>
								</div>




							
							
							</div>

						<!---END ROW-->
						</div>



						<div role="tabpanel" class="tab-pane fade in" id="default-tab-2-store">
							<div class="col-md-12" >
							

							<div class="row">
								<div class="col-md-6">
								<button type="button" id="add-file" class="btn btn-success btn-user" >
									<i class="ti-image"></i>
									Agregar
								</button>
								</div>
							</div>

							<br>

							<div id="content-file" class="row">

								
							</div>

							
							</div>
						</div>
						</div>


						


						<input type="hidden" name="id_user" class="id_user">
						<input type="hidden" name="token" class="token">
						<br>
						<br>
						</div>
						<center>
							<button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro3')">
								Cancelar
							</button>
						</center>
						<br>
						<br>
					</form>
					
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
			
				getData();
				$("#collapse_Polizas").addClass("show");
				$("#nav_li_Polizas").addClass("open");
				$("#nav_users, #modulo_Polizas").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");

				// $(".selectized").selectize({
				// 	//sortField: 'text'
				// });


			});


			function getData(){
				var placa = "{{$placa}}"
				var url=document.getElementById('ruta').value; 
				$.ajax({
					url:''+url+'/api/vehicle/'+placa,
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

						ShowTypeVehicule("#type_vehicule_view", data.clase, false)

						$("#placa_view").val(data.placa).attr("disabled", "disabled")
						$("#type_vehicule_view").attr("disabled", "disabled")

						changeTypeVehicule("#type_vehicule_view", "#marca_view", data.marca)
						$("#type_vehicule_view").trigger("change");

						
						 changeMarca("#marca_view", "#line_view", data.referencia1)
						 $("#marca_view").trigger("change");
						

						ChangeRefer1("#line_view", "#refer2_view", data.referencia2)
						$("#line_view").trigger("change");

						ChangeRefer2("#refer2_view", "#refer3_view", data.referencia3)
						$("#refer2_view").trigger("change");

						changeRefer3("#refer3_view", "view")
						$("#refer3_view").trigger("change");


						$("#marca_view").attr("disabled", "disabled")
						$("#line_view").attr("disabled", "disabled")
						$("#refer2_view").attr("disabled", "disabled")
						$("#refer3_view").attr("disabled", "disabled")

						
						$("#model_view").val(data.model).attr("disabled", "disabled")
						$("#color_view").val(data.color).attr("disabled", "disabled")
						$("#due_date_techno_mechanics_view").val(data.due_date_techno_mechanics).attr("disabled", "disabled")

						$("#number_motor_view").val(data.number_motor).attr("disabled", "disabled")
						$("#number_chassis_view").val(data.number_chassis).attr("disabled", "disabled")

						$("#value_fasecolda_view").val(number_format(data.valor_fasecolda ,2)).attr("disabled", "disabled")
						
						$("#service_view").val(data.servicio)
					}
				});
			}



			$("#code").keyup(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
					url:''+url+'/api/fasecolda/get/'+$(this).val(),
					type:'GET',
					dataType:'JSON',
					//async: false,
					beforeSend: function(){
					// mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					},
					error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					},
					success: function(data){
						
						ShowTypeVehicule("#type_vehicule", data.clase, false)

						$("#type_vehicule").attr("disabled", "disabled")

						changeTypeVehicule("#type_vehicule", "#marca", data.marca)
						$("#type_vehicule").trigger("change");


						changeMarca("#marca", "#line", data.referencia1)
						$("#marca").trigger("change");
						

						ChangeRefer1("#line", "#refer2", data.referencia2)
						$("#line").trigger("change");

						ChangeRefer2("#refer2", "#refer3", data.referencia3)
						$("#refer2").trigger("change");

						changeRefer3Temporal("#refer3", "")
						$("#refer3").trigger("change");


						$("#marca").attr("disabled", "disabled")
						$("#line").attr("disabled", "disabled")
						$("#refer2").attr("disabled", "disabled")
						$("#refer3").attr("disabled", "disabled")
						
						
						$("#service").val(data.servicio)

					}
				});
			});









			function ShowTypeVehicule(select, select_default = false, asinc = true){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule',
				  type:'GET',
				  data: {
					  "id_user": id_user,
					  "token"  : tokens,
					},

					async: asinc,

				  dataType:'JSON',
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$(select).each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$(select+" option").remove();
					$(select).append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$(select).append($('<option>',
						{
						  value: item.clase,
						  text : item.clase,
						  selected: select_default == item.clase ? true : false
						}));
					 
					});
			  
					
				  }
				});
			  }




			  
			  function changeTypeVehicule(type_vehicule, marca, value_marca){
					$(type_vehicule).unbind().change(function (e) { 
					
						var url=document.getElementById('ruta').value;
						$.ajax({
							url:''+url+'/api/fasecolda/typevehicule/trademark/',
							type:'GET',
							data: {
								"clase"  : $(this).val(),
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
						
							$(marca).each(function() {
								if (this.selectize) {
								this.selectize.destroy();
								}
							});
							
							$(marca+" option").remove();
							$(marca).append($('<option>',
							{
								value: "null",
								text : "Seleccione"
							}));
						
							$.each(data, function(i, item){
								
								
								$(marca).append($('<option>',
								{
									value: item.marca,
									text : item.marca,
									selected: value_marca == item.marca ? true : false
								}));
							
							});
		
							$(marca).selectize({
								//sortField: 'text'
							});
						
							
							}
						});
					});
			  }



			  function changeMarca(marca, referencia1, value_referencia1){
					$(marca).unbind().change(function (e) { 
						var url=document.getElementById('ruta').value;
						$.ajax({
						url:''+url+'/api/fasecolda/typevehicule/trademark/line/',
						type:'GET',
						data: {
							"marca"  : $(this).val(),
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
					
							$(referencia1).each(function() {
							if (this.selectize) {
								this.selectize.destroy();
							}
						});
						
							$(referencia1+" option").remove();
							$(referencia1).append($('<option>',
							{
							value: "null",
							text : "Seleccione"
							}));
					
							$.each(data, function(i, item){
							
							
								$(referencia1).append($('<option>',
								{
									value: item.referencia1,
									text : item.referencia1,
									selected: value_referencia1 == item.referencia1 ? true : false
								}));
							
							});

							$(referencia1).selectize({
								//sortField: 'text'
							});
					
						}
						});
						
					});
			  }





			  function ChangeRefer1(referencia1, referencia2, value_referencia2){
					$(referencia1).unbind().change(function (e) { 
						var url=document.getElementById('ruta').value;
						$.ajax({
						url:''+url+'/api/fasecolda/typevehicule/trademark/line/refer2',
						type:'GET',
						data: {
							"line"  : $(this).val(),
							},
						async: false,
						dataType:'JSON',
						beforeSend: function(){
						// mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
						},
						error: function (data) {
							//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
						},
						success: function(data){
					
							$(referencia2).each(function() {
							if (this.selectize) {
								this.selectize.destroy();
							}
						});
						
							$(referencia2+" option").remove();
							$(referencia2).append($('<option>',
							{
							value: "null",
							text : "Seleccione"
							}));
					
							$.each(data, function(i, item){
							
							
								$(referencia2).append($('<option>',
								{
									value: item.referencia2,
									text : item.referencia2,
									selected: value_referencia2 == item.referencia2 ? true : false
								}));
							
							});

							$(referencia2).selectize({
								//sortField: 'text'
							});
					
						}
					});
					
				});
			  }


			  function ChangeRefer2(referencia2, referencia3, value_referencia3){
					$(referencia2).unbind().change(function (e) { 
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/fasecolda/typevehicule/trademark/line/refer2/refer3',
						type:'GET',
						data: {
							"refer2"  : $(this).val(),
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
					
							$(referencia3).each(function() {
							if (this.selectize) {
								this.selectize.destroy();
							}
						});
						
							$(referencia3+" option").remove();
							$(referencia3).append($('<option>',
							{
							value: "null",
							text : "Seleccione"
							}));
					
							$.each(data, function(i, item){
							
							
								$(referencia3).append($('<option>',
								{
									value: item.referencia3,
									text : item.referencia3,
									selected: value_referencia3 == item.referencia3 ? true : false
								}));
							
							});

							$(referencia3).selectize({
								//sortField: 'text'
							});
					
						}
					});
					
				});
			  }




			  function changeRefer3(refer3, type){
					$(refer3).unbind().change(function (e) { 
						var url=document.getElementById('ruta').value;
						$.ajax({
						url:''+url+'/api/fasecolda/get/by/clase/marca/refer1/refer2/refer3',
						type:'GET',
						data: {
							"clase"  : $("#type_vehicule_"+type).val(),
							"marca"  : $("#marca_"+type).val(),
							"refer1" : $("#line_"+type).val(),
							"refer2"  : $("#refer2_"+type).val(),
							"refer3"  : $(refer3).val(),
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
							$("#service").val(data.servicio)

							$("#cc_"+type).val(data.cilindraje).attr("readonly", "readonly")
							$("#number_passengers_"+type).val(data.capacidad_pasajeros).attr("readonly", "readonly")
							$("#doors_"+type).val(data.puertas).attr("readonly", "readonly")
							$("#vehicle_weight_"+type).val(data.peso).attr("readonly", "readonly")
							$("#axes_"+type).val(data.ejes).attr("readonly", "readonly")
							$("#type_drop_"+type).val(data.tipo_caja).attr("readonly", "readonly")
							$("#type_fuel_"+type).val(data.combustible).attr("readonly", "readonly")
							$("#transmission_"+type).val(data.transmision).attr("readonly", "readonly")

							$("#code_"+type).val(data.codigo).attr("readonly", "readonly")
					
						}
					});
					
				});
			  }



			  function changeRefer3Temporal(refer3, type){
					$(refer3).unbind().change(function (e) { 
						var url=document.getElementById('ruta').value;
						$.ajax({
						url:''+url+'/api/fasecolda/get/by/clase/marca/refer1/refer2/refer3',
						type:'GET',
						data: {
							"clase"  : $("#type_vehicule").val(),
							"marca"  : $("#marca").val(),
							"refer1" : $("#line").val(),
							"refer2"  : $("#refer2").val(),
							"refer3"  : $(refer3).val(),
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
							$("#service").val(data.servicio)

							$("#cc").val(data.cilindraje).attr("readonly", "readonly")
							$("#number_passengers").val(data.capacidad_pasajeros).attr("readonly", "readonly")
							$("#doors").val(data.puertas).attr("readonly", "readonly")
							$("#vehicle_weight").val(data.peso).attr("readonly", "readonly")
							$("#axes").val(data.ejes).attr("readonly", "readonly")
							$("#type_drop").val(data.tipo_caja).attr("readonly", "readonly")
							$("#type_fuel").val(data.combustible).attr("readonly", "readonly")
							$("#transmission").val(data.transmision).attr("readonly", "readonly")

							$("#code").val(data.codigo).attr("readonly", "readonly")
					
						}
					});
					
				});
			  }



			  $("#type_vehicule").change(function (e) { 
				  
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/',
				  type:'GET',
				  data: {
					  "clase"  : $(this).val(),
					},
				  dataType:'JSON',
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$("#marca").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#marca option").remove();
					$("#marca").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#marca").append($('<option>',
						{
						  value: item.marca,
						  text : item.marca,
						}));
					 
					});

					$("#marca").selectize({
						//sortField: 'text'
					});
			  
					
				  }
				});
			  });


			  $("#marca").change(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/line/',
				  type:'GET',
				  data: {
					  "marca"  : $(this).val(),
					},
				  dataType:'JSON',
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$("#line").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#line option").remove();
					$("#line").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#line").append($('<option>',
						{
						  value: item.referencia1,
						  text : item.referencia1,
						}));
					 
					});

					$("#line").selectize({
						//sortField: 'text'
					});
			  
				  }
				});
				  
			  });










			  $("#line").change(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/line/refer2',
				  type:'GET',
				  data: {
					  "line"  : $(this).val(),
					},
				  dataType:'JSON',
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$("#refer2").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#refer2 option").remove();
					$("#refer2").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#refer2").append($('<option>',
						{
						  value: item.referencia2,
						  text : item.referencia2,
						}));
					 
					});

					$("#refer2").selectize({
						//sortField: 'text'
					});
			  
				  }
				});
				  
			  });






			  $("#refer2").change(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/typevehicule/trademark/line/refer2/refer3',
				  type:'GET',
				  data: {
					  "refer2"  : $(this).val(),
					},
				  dataType:'JSON',
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$("#refer3").each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$("#refer3 option").remove();
					$("#refer3").append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));
			  
					$.each(data, function(i, item){
					  
					  
						$("#refer3").append($('<option>',
						{
						  value: item.referencia3,
						  text : item.referencia3,
						}));
					 
					});

					$("#refer3").selectize({
						//sortField: 'text'
					});
			  
				  }
				});
				  
			  });



			  $("#refer3").change(function (e) { 
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/fasecolda/get/by/clase/marca/refer1/refer2/refer3',
				  type:'GET',
				  data: {
					  "clase"  : $("#type_vehicule").val(),
					  "marca"  : $("#marca").val(),
					  "refer1" : $("#line").val(),
					  "refer2"  : $("#refer2").val(),
					  "refer3"  : $("#refer3").val(),
					},
				  dataType:'JSON',
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
					$("#service").val(data.servicio)

					$("#cc").val(data.cilindraje).attr("readonly", "readonly")
					$("#number_passengers").val(data.capacidad_pasajeros).attr("readonly", "readonly")
					$("#doors").val(data.puertas).attr("readonly", "readonly")
					$("#vehicle_weight").val(data.peso).attr("readonly", "readonly")
					$("#axes").val(data.ejes).attr("readonly", "readonly")
					$("#type_drop").val(data.tipo_caja).attr("readonly", "readonly")
					$("#type_fuel").val(data.combustible).attr("readonly", "readonly")
					$("#transmission").val(data.transmision).attr("readonly", "readonly")

					$("#code").val(data.codigo).attr("readonly", "readonly")
				

			  
				  }
				});
				  
			  });


			  $("#model").keyup(function (e) { 
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/fasecolda/value',
						type:'GET',
						data: {
							"clase"   : $("#type_vehicule").val(),
							"marca"   : $("#marca").val(),
							"refer1"  : $("#line").val(),
							"refer2"  : $("#refer2").val(),
							"refer3"  : $("#refer3").val(),
							"year"    : $("#model").val(),
						},
						dataType:'JSON',
						beforeSend: function(){
						// mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
						},
						error: function (data) {
							//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
						},
						success: function(data){
							$("#value_fasecolda").val(number_format(data, 2)).attr("readonly", "readonly")
						}
					});
			  });




		</script>

</body>

</html>
