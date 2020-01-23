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

				@include('policies.show.view')

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

				showDataPolicie()


				$("#collapse_Polizas").addClass("show");
				$("#nav_li_Polizas").addClass("open");
				$("#nav_users, #modulo_Polizas").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");
			});



			function showDataPolicie(){
			
				var url=document.getElementById('ruta').value;
				$.ajax({
					url:''+url+'/api/policies/'+{{$number_policie}},
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


		</script>

</body>

</html>
