@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Cartera.</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">

							<div class="animation_home"></div>
								<div class="table-overflow">
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Número de Poliza</th>
												<th>Cliente</th>
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
			@include('administracion.payment.admin')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				list();
				update();

				$("#collapse_Administración").addClass("show");
				$("#nav_li_Administración").addClass("open");
				$("#nav_users, #modulo_Administración").addClass("active");
				$("#nav_payment").addClass("active");
				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				savePayment("#form-update", 'api/payment/fee', '#cuadro4', false, "#avatar-edit");
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
						 "url":''+url+'/api/payment',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_policies"},
						{"data":"names"},
						{"data": null,
							render : function(data, type, row) {
								var botones = "";
								if(actualizar == 1)
									botones += "<span class='editar btn btn-primary  btn-sm waves-effect' data-toggle='tooltip' title='Gestionar Pagos'><i class='ei-money-bag' style='margin-bottom:5px'></i></span> ";
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
			
				edit("#table tbody", table)

			}

			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();
					
					AccountStatus("#table-status-account", data.id_policie)
					getMonthlyFee(data.id_policie)
					$("#id_policie").val(data.id_policie)
					cuadros('#cuadro1', '#cuadro4');
				});
			}




			function savePayment(form, controlador, cuadro, auth = false){
				$(form).submit(function(e){
					e.preventDefault(); //previene el comportamiento por defecto del formulario al darle click al input submit
					var url=document.getElementById('ruta').value; //obtiene la ruta del input hidden con la variable 
					var formData=new FormData($(form)[0]); //obtiene todos los datos de los inputs del formulario pasado por parametros
					var method = $(this).attr('method'); //obtiene el method del formulario
					$('input[type="submit"]').attr('disabled','disabled'); //desactiva el input submit
					$.ajax({
						url:''+url+'/'+controlador+'',
						type:method,
						dataType:'JSON',
						data:formData,
						cache:false,
						contentType:false,
						processData:false,
						beforeSend: function(){
						showNoty('info', "topLeft",'<span>Espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>', 1000);
						},
						error: function (repuesta) {
							$('input[type="submit"]').removeAttr('disabled'); //activa el input submit
							var errores=repuesta.responseText;
							if(errores!="")
								showNoty("error", "topRight", errores, 3000)
							else
								showNoty("error", "topRight","<span>Ha ocurrido un error, por favor intentelo de nuevo.</span>", 3000)
						},
						success: function(respuesta){

							
							AccountStatus("#table-status-account", $("#id_policie").val())
							getMonthlyFee($("#id_policie").val())
							
							if (respuesta.success == false) {
								showNoty('error', "topRight", respuesta.message, 3000);
								$('input[type="submit"]').removeAttr('disabled'); //activa el input submit
							}else{
								$('input[type="submit"]').removeAttr('disabled'); //activa el input submit
								showNoty('success', "topRight", respuesta.mensagge, 3000);
							}

							



						}

					});
				});
			}
	


			function getMonthlyFee(id_policie){

				var url=document.getElementById('ruta').value;
				$.ajax({
					url:''+url+'/api/payment/fee/pending',
					type:'POST',
					data: {
						"id_user"     : id_user,
						"token"       : tokens,
						"id_policie"  : id_policie,
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
						$("#form-update")[0].reset()
						if(data == "1"){
							$("#save_pay").attr("disabled", "disabled")
							$("#balance_total_pending").val(0)
						}else{
							$("#cuota").val(data.fee_pending.monthly_fee)
							$("#amount").val(number_format(data.fee_pending.balance, 2))
							$("#amount_pay").val(number_format(data.fee_pending.balance, 2))
							$("#id_recibos_cobranza").val(data.fee_pending.id_recibos_cobranza)
							$("#balance_total_pending").val(number_format(data.balance, 2))
							CalcBalanceFee()

							$("#save_pay").removeAttr("disabled")

						}
						
						
					}
				});

			}


			$("#amount_pay").keyup(function (e) { 
				CalcBalanceFee()
			});



			function CalcBalanceFee(){
				var balance = inNum($("#amount").val()) - inNum($("#amount_pay").val())
				 if(balance <= 0){
					balance = 0	 
				 }
				$("#balance_fee_cuota").val(number_format(balance, 2))
			}

			function AccountStatus(table, id_policie){
				var url=document.getElementById('ruta').value; 
        
				var token   = localStorage.getItem('token');
				var user_id = localStorage.getItem('user_id');

				var table=$(table).DataTable({
					"destroy":true,
					
					"stateSave": true,
					"serverSide":false,
					"ajax":{
						"method":"POST",
						 "url":''+url+'/api/payment',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
							"id_policie" : id_policie
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":null,
							render : function(data, type, row){
								if (row.balance == 0) {
									var chek = "<span class='btn btn-success btn-xs'><i class='fa fa-check' style='margin-bottom:5px'></i></span>"
									return chek;
								}else{
									return "";
								}
							}
						},

						{"data":"monthly_fee"},

						{"data":"type_operation",
							render: function(data, type, row){
								var clase = data == "C" ? "badge-danger" : "badge-success"
								return '<span class="badge '+clase+'">'+data+'</span>'
							}
						},

						{"data":"payment_date"},

						{"data":"amount",
							render : function(data, type, row){
								return number_format(data, 2)
							}
						},

						{"data":"payment",
							render : function(data, type, row){
								return number_format(data, 2)
							}
						},

						{"data":"balance",
							render : function(data, type, row){
								return number_format(data, 2)
							}
						},
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,
					"buttons":[
						
					]
				});

			}

		</script>

	@endsection


