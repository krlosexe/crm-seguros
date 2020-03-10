@extends('layouts.app')

	@section('content')
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Cuentas por cobrar.</h4>
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
												<th>Numero de Poliza</th>
												<th>Cliente</th>
												<th>Cuota</th>
												<th>Fecha</th>
												<th>Monto</th>
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

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				list();

				$("#collapse_Administración").addClass("show");
				$("#nav_li_Administración").addClass("open");
				$("#nav_users, #modulo_Administración").addClass("active");
				$("#nav_payments-receivable").addClass("active");
				verifyPersmisos(id_user, tokens, "payments-receivable");
			});

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
						 "url":''+url+'/api/payments/receivable',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"number_policies",
							render : function(data, type, row){
								return "<a href='policies/"+row.id_policie+"' target='_blank' class=''>"+data+"</a>"
							}
						},
						{"data":"names",
							render : function(data, type, row){
								return "<a href='people/"+row.clients+"' target='_blank' class=''>"+data+"</a>"
							}
						},
						{"data":"monthly_fee"},
						{"data":"payment_date"},
						{"data":"balance",
							render : function(data, row, type){
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

		</script>

	@endsection


