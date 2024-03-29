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
		
        validAuth(false, url[1]);
      });
    </script>

  @endif

</head>

<body class="{{ Request::path() != '/' ? 'dasboard-body' : ''}} bg-gradient-primary">
  <div id="page-loader"  ><span class="preloader-interior"></span></div>

  <div id="wrapper" class="app">
    <div id="content-wrapper" class="layout">
		@include('layouts.sidebar')
      
       <div class="page-container">
	   		@include('layouts.topBar') 
			<div class="main-content">

				@include('vehicles.show.admin')

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
				cuadros('#cuadro1', '#cuadro3');

				ver()

				$("#collapse_Vehículos").addClass("show");
				$("#nav_li_Vehículos").addClass("open");
				$("#nav_people").addClass("active");

				$("#nav_users, #modulo_Vehículos").addClass("active");



			});


			

			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(){

					$("#alertas").css("display", "none");

				var url=document.getElementById('ruta').value;
				$.ajax({
					url:''+url+'/api/vehicles/{{$placa}}',
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

					var url = ruta.value+"/vehicles/files/"+data.id_vehicules+"/0"
					$('#iframeInfo').attr('src', url);
					
					}
				})

				
			}

			var count = 0;

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




			/* ------------------------------------------------------------------------------- */

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


			  


		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/vehicle/status/'+data.id_vehicules+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/vehicle/status/'+data.id_vehicules+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/vehicle/status/'+data.id_vehicules+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	


