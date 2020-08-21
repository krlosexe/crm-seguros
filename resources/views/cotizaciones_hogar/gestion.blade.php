@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Cotizaciones de Hogar</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
											<th>Nombres</th>
											<th>Correo</th>
											<th>Teléfono</th>
											<th>Influencer</th>
											<th>Fecha</th>
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

			@include('cotizaciones_hogar.view')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				list();

				$("#collapse_Vehículos").addClass("show");
				$("#nav_li_Vehículos").addClass("open");
				$("#nav_people").addClass("active");

				$("#nav_users, #modulo_Vehículos").addClass("active");

				verifyPersmisos(id_user, tokens, "vehicles");

				$(".selectized").selectize({
					//sortField: 'text'
				});


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
					"serverSide":true,
          			"processing": true,
					"ajax":{
						"method":"post",
						 "url":''+url+'/api/cotizaciones_hogar/paginate',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
					},
					"columnDefs":[
						{targets: 0, "data":"fullname"},
						{targets: 1, "data":"correo"},
						{targets: 2, "data":"telefono"},
						{targets: 3, "data":"influencer_name"},
						{targets: 4, "data":"created_at_formated"},
						{targets: 5, "data": null,
							render : function(data, type, row) {
								var botones = "";
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";	
	
								if(borrar == 1)
									botones += "<span class='eliminar btn btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='ei-delete-alt' style='margin-bottom:5px'></i></span>";

								return botones;
							}
						}
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,
					"buttons": buttonsDatatable({
						title: 'Cotizaciones Hogar',
						filename: 'cotizaciones-hogar',
						columns: [0,1,2,3,4],
						async: true
					}),
					initComplete(){
						$('.dt-button').removeClass('dt-button buttons-copy buttons-html5')
					}
				});


				ver("#table tbody", table)
				eliminar("#table tbody", table)


			}


			

			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					var data = table.row( $(this).parents("tr") ).data();

					$("#nombre_view").val(data.nombre).attr("disabled", "disabled")
					$("#apellido_view").val(data.apellido).attr("disabled", "disabled")
					$("#tipo_documento_view").val(data.tipo_documento).attr("disabled", "disabled")
					$("#documento_identidad_view").val(data.documento).attr("disabled", "disabled")
					$("#correo_view").val(data.correo).attr("disabled", "disabled")
					$("#telefono_view").val(data.telefono).attr("disabled", "disabled")
					$("#ciudad_view").val(data.ciudad).attr("disabled", "disabled")

					$("#nombre_influencer_view").val(data.influencer.fullname).attr("disabled", "disabled")
					$("#codigo_view").val(data.influencer.code).attr("disabled", "disabled")

					cuadros('#cuadro1', '#cuadro5');

				});
			}


	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/cotizaciones_hogar/status/'+data.id+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


