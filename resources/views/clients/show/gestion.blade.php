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

				@include('clients.show.view')

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
				$('#cuadro3').show()
				showDataPolicie()


				$("#collapse_Polizas").addClass("show");
				$("#nav_li_Polizas").addClass("open");
				$("#nav_users, #modulo_Polizas").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");
			});



			function showDataPolicie(){
			
				var url=document.getElementById('ruta').value;
				$.ajax({
					url:''+url+'/api/people/'+{{$id_client}},
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

						GetDepartament("#departament_view", data.id_department)

						ChangeDepartament("#departament_view", "#municipios_view", data.id_city)


						$("#type_document_view").each(function() {
						  if (this.selectize) {
							this.selectize.destroy();
						  }
					   });




						$("#names_view").val(data.names).attr("disabled", "disabled")
						$("#last_names_view").val(data.last_names).attr("disabled", "disabled")
						$("#type_document_view").val(data.type_document).attr("disabled", "disabled")


						$("#type_document_view").selectize({
						  //sortField: 'text'
						});



						$("#number_document_view").val(data.number_document).attr("disabled", "disabled")
						$("#expedition_date_view").val(data.expedition_date).attr("disabled", "disabled")
						$("#weight_view").val(data.weight).attr("disabled", "disabled")
						$("#height_view").val(data.height).attr("disabled", "disabled")
						$("#eps_view").val(data.eps).attr("disabled", "disabled")
						$("#gender_view").val(data.gender).attr("disabled", "disabled")
						$("#birthdate_view").val(data.birthdate).attr("disabled", "disabled")
						$("#stratum_view").val(data.stratum).attr("disabled", "disabled")

						$("#age_view").val(calcularEdad(data.birthdate)).attr("disabled", "disabled")

						data.data_treatment == 1 ? $("#data_treatment_view").prop("checked", true) : $("#data_treatment_view").prop("checked", false) 
						$("#data_treatment_view").attr("disabled", "disabled")
						
						$("#observations_view").val(data.observations).attr("disabled", "disabled")
						$("#city_view").val(data.city).attr("disabled", "disabled")

						$("#address1_view").val(data.address1).attr("disabled", "disabled")
						$("#type_address1_view").val(data.type_address1).attr("disabled", "disabled")
						$("#address2_view").val(data.address2).attr("disabled", "disabled")
						$("#type_address2_view").val(data.type_address2).attr("disabled", "disabled")

						$("#phone1_view").val(data.phone1).attr("disabled", "disabled")
						$("#type_phone1_view").val(data.type_phone1).attr("disabled", "disabled")
						$("#phone2_view").val(data.phone2).attr("disabled", "disabled")
						$("#type_phone2_view").val(data.type_phone2).attr("disabled", "disabled")

						$("#email_view").val(data.email).attr("disabled", "disabled")

						$("#marital_status_view").val(data.marital_status).attr("disabled", "disabled")
						$("#monthly_income_view").val(data.monthly_income).attr("disabled", "disabled")
						$("#heritage_view").val(data.heritage).attr("disabled", "disabled")

						$("#departament_view").trigger("change");


						data.own_house == 1 ? $("#own_house_view").prop("checked", true) : $("#own_house_view").prop("checked", false) 
						$("#number_house_view").val(data.number_house).attr("disabled", "disabled")
						$("#own_house_view").prop("checked", true).attr("disabled", "disabled")
						$("#children_view").attr("disabled", "disabled")
						$("#vehicle_view").attr("disabled", "disabled")
						if(data.childrens.length > 0){
							$("#children_view").prop("checked", true)
							$(".container-datos-adicionales-hijo-view").css("display", "block");
							ShowChildren("#dato-extra-hijo-container-view", data.childrens, "view")
						}else{
							$(".container-datos-adicionales-hijo-view").css("display", "none");
							$("#children_view").prop("checked", false)
						}

						if(data.vehicle.length > 0){
							$("#vehicle_view").prop("checked", true)
							$(".container-datos-adicionales-vehicle-view").css("display", "block");
							ShowVehicle("#dato-extra-vehicle-container-view", data.vehicle, "view")
						}else{
							$(".container-datos-adicionales-vehicle-view").css("display", "none");
							$("#vehicle_view").prop("checked", false)
						}



						data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_view").prop("checked", true)  : $("#send_policies_for_expire_email_view").prop("checked", false) 
						data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_view").prop("checked", true) : $("#send_portfolio_for_expire_email_view").prop("checked", false) 
						data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_view").prop("checked", true)    : $("#send_policies_for_expire_sms_view").prop("checked", false) 
						data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_view").prop("checked", true)   : $("#send_portfolio_for_expire_sms_view").prop("checked", false) 
						data.send_birthday_card              == 1 ? $("#send_birthday_card_view").prop("checked", true)              : $("#send_birthday_card_view").prop("checked", false) 



						$("#send_policies_for_expire_email_view").attr("disabled", "disabled")
						$("#send_portfolio_for_expire_email_view").attr("disabled", "disabled")
						$("#send_policies_for_expire_sms_view").attr("disabled", "disabled")
						$("#send_portfolio_for_expire_sms_view").attr("disabled", "disabled")
						$("#send_birthday_card_view").attr("disabled", "disabled")       


						$("#occupation_view").val(data.occupation).attr("disabled", "disabled")
						$("#company_view").val(data.company).attr("disabled", "disabled")


					}
				});
			}

			

			function showCasa(check, input){
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(input).val("").removeAttr("disabled").focus();
						$(input).attr("required", "required");
					}else{
						$(input).val(0).attr("disabled", "disabled");
						$(input).removeAttr("required");
					}
					
				});
			}



			function showHijos(check, table){
				
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(table).css("display", "block");
					}else{
						$(table).css("display", "none");
						$(table+" table tbody tr").remove()
					}
					
				});
			}
			function ShowChildren(table, data, option){
				var html = ""

				var count = 0

				
				$.each(data, function (key, item) { 
					var input_name      = "<input type='text' name=name_children[] value='"+item.name+"'  class='form-control' required placeholder='Nombres'>"
					var input_phone     = "<input type='text' name=phone_children[] value='"+item.phone+"'  class='form-control' required placeholder='Telefono'>"
					var input_birthdate = "<input type='date' name=birthdate_children[] class='form-control' value='"+item.birthdate+"' required placeholder='Birthdate'>"
					var btn_delete = "" 
					if(option != "view"){
						btn_delete = "<button type='button' onclick='DeleteTr(\"" + "#tr_childred_edit_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					}
					
					
					
					html += "<tr id='tr_childred_edit_"+count+"'>"
						html +="<td>"+input_name+"</td>"
						html +="<td>"+input_phone+"</td>"
						html +="<td>"+input_birthdate+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"


					count++
				});	
					
				$(table).html(html)
				
			}



			function ShowVehicle(table, data, option){
				var count_vehicle_edit = 0;
				var html = ""
				$.each(data, function (key, item) { 

					var input_placa     = "<input type='text' name=placa_vehicle[] value='"+item.placa+"' class='form-control' placeholder='Placa'>"
					var date_soat       = "<input type='date' name=date_soat[]     value='"+item.date_soat+"' class='form-control' placeholder='Fecha vencimiento SOAT'>"
					var date_impuestos  = "<input type='date' name=date_taxes[]    value='"+item.date_taxes+"' class='form-control' placeholder='Fecha pago de impuestos'>"
					var date_tecno      = "<input type='date' name=date_tecno[]    value='"+item.date_tecno+"' class='form-control' placeholder='Fecha vencimiento tecnomecánica'>"
					var btn_delete = "" 

					if(option != "view"){
						var btn_delete      = "<button type='button' onclick='DeleteTr(\"" + "#tr_vehicle_edit" + count_vehicle_edit +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					}
					
					html += "<tr id='tr_vehicle_edit"+count_vehicle_edit+"'>"
						html +="<td>"+input_placa+"</td>"
						html +="<td>"+date_soat+"</td>"
						html +="<td>"+date_impuestos+"</td>"
						html +="<td>"+date_tecno+"</td>"
						html +="<td>"+btn_delete+"</td>"
					html += "</tr>"

					count_vehicle_edit++
				});	
					

				$(table).html(html)
			}


			function ChangeDepartament(select, municipios, select_default = false){
				$(select).change(function (e) { 
					
					console.log(select_default)
					var url=document.getElementById('ruta').value;
					$.ajax({
					url:''+url+'/api/departamentos/municipios/'+$(this).val(),
					type:'GET',
					dataType:'JSON',
					async: false,
					beforeSend: function(){
					// mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					},
					error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					},
					success: function(data){
				
						$(municipios).each(function() {
						if (this.selectize) {
							this.selectize.destroy();
						}
					});
					
						$(municipios+" option").remove();
						$(municipios).append($('<option>',
						{
						value: "null",
						text : "Seleccione"
						}));
				
						$.each(data, function(i, item){
						
							$(municipios).append($('<option>',
							{
								value: item.id,
								text : item.nombre,
								selected: select_default == item.id ? true : false
							}));
						
						});
				
						$(municipios).selectize({
						//sortField: 'text'
						});
					}
					});
					
				});
			}


			function GetDepartament(select, select_default = false){	

				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/departamentos',
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
						  value: item.id,
						  text : item.nombre,
						  selected: select_default == item.id ? true : false
						}));
					  
					});
			  
					$(select).selectize({
					  //sortField: 'text'
					});
				  }
				});
			}



			




			function showVehicle(check, table){
				$(check).change(function (e) { 
					if ($(check).is(':checked')){
						$(table).css("display", "block");
					}else{
						$(table).css("display", "none");
						$(table+" table tbody tr").remove()
					}
					
				});
			}
			

		</script>

</body>

</html>
