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
    <link rel="stylesheet" href="<?= url('/') ?>/vendors/multiple-select/css/bootstrap-multiselect.css" />
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

			@include('administracion.payment.show.admin')

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
		$(document).ready(function(){
			verifyPersmisos(id_user, tokens, "modules");

			$("#nav_li_Cartera").addClass("open");
			$("#nav_payment").addClass("active");

			$('#cuadro4').show()
			edit()

		});



		var ClientSelected = 0;
		var TypeClientSelected= 0;

		/* ---------------------------------------------------------------------------------- */
		/* 
			Funcion que muestra el cuadro3 para la consulta del banco.
		*/
		function edit(tbody, table){
		
			var url=document.getElementById('ruta').value;
			$.ajax({
				url:''+url+'/api/payment/'+{{$id}},
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

						$("#alertas").css("display", "none");

						ClientSelected = data.id_client;
						TypeClientSelected = data.type_client;

						$("#policie_annexes-multiple-view").val(data.policie_annexes).trigger('change');
						$("#policie_annexes-multiple-view").attr("readonly", "readonly");

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

							$('#number-multiple-view').change();

							$('#cuadro4').find('input, select, textarea').attr('disabled', 'disabled')

						}, 1500)

						$("#init_date-multiple-view").val(data.init_date)
						$("#limit_date-multiple-view").val(data.limit_date)
						$("#issue-multiple-view").val(data.issue)
						$("#footer-multiple-view").val(data.observations)
						
				}
			});



		}
		
		$("#policie_annexes-store, #policie_annexes-multiple, #policie_annexes-multiple-edit, #policie_annexes-multiple-view").change(function (e) { 

			var type = $(this).val();
			const idElement = $(this).attr('id');

			if($(this).val() == "Poliza"){
				var route = '/api/clients/people/policies/'+ClientSelected+'/'+TypeClientSelected;
			}else{
				var route = '/api/client/policies/annexes/'+ClientSelected+'/'+TypeClientSelected;
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

						
						if(type == "Poliza"){

							// bloque solo se encarga del form de polizas multiples

							if(idElement == 'policie_annexes-multiple' || idElement == 'policie_annexes-multiple-edit' || idElement == 'policie_annexes-multiple-view'){

								$(".multiselect option").remove();

								$('#number-multiple').change();
								$('#number-multiple-edit').change();
								$('#number-multiple-view').change();

							    $('.multiselect').multiselect('destroy');

								$.map(data, function (item, key) {
									if (item.status == 1) {
										
										item.charge_account_id = 0;

										$(".multiselect").append($('<option>',
										{
											value: item.id_policies,
											text : item.number_policies,
											json: JSON.stringify(item)
										}));

									}
								});

								$('.multiselect').multiselect({
								      selectAllText: true,
								      buttonWidth: '100%'
								});

								return;
							}

							// fin acá

							$.map(data, function (item, key) {
								if (item.status == 1) {
									$("#number-store").append($('<option>',
									{
										value: item.id_policies,
										text : item.number_policies,
										
									}));
								}
							});

							$("#cousin").val(number_format(data.cousin, 2))
							$("#xpenses").val(number_format(data.xpenses, 2))
							$("#vat").val(number_format(data.vat, 2)).attr("readonly", "readonly")
							$("#percentage_vat_cousin").val(data.percentage_vat_cousin)
							$("#commission_percentage").val(data.commission_percentage).attr("readonly", "readonly")
							$("#participation").val(data.participation).attr("readonly", "readonly")
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

		$('#number-multiple-view').change(function(){
			const values = $(this).val();

			const tdContent = `
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
              <td>
              	<input name="commission_percentage[]" value="" readonly="readonly" class="form-control text-right  form-control-user">
              </td>
              <td>
              	<input name="participation[]" value="" class="form-control text-right  form-control-user">
              </td>
              <td>
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

					const json = JSON.parse($(`#number-multiple-view option[value="${id}"]`).attr('json'));

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


	</script>



</body>

</html>
