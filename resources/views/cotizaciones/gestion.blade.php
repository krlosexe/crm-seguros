@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Cotizaciones</h4>
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
											<th>Placa</th>
											<th>Correo</th>
											<th>Telefono</th>
											<th>Referido por </th>
											<th>Asesor</th>
											<th>Estado</th>
											<th>Fecha de Consulta</th>
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

			@include('cotizaciones.view')
			@include('cotizaciones.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')
	<link href="<?= url('/') ?>/vendors/summernote-master/dist/summernote.min.css" rel="stylesheet">
    <script src="<?= url('/') ?>/vendors/summernote-master/dist/summernote.min.js"></script>
		<script>
			$(document).ready(function(){
				list();
				update();

				$("#collapse_Vehículos").addClass("show");
				$("#nav_li_Vehículos").addClass("open");
				$("#nav_people").addClass("active");

				$("#nav_users, #modulo_Vehículos").addClass("active");

				verifyPersmisos(id_user, tokens, "vehicles");

				$(".selectized").selectize({
					//sortField: 'text'
				});


				$('#comments').summernote({
                    height: 145, 
                })



			});



			$("#add-comments").click(function (e) { 
				var url=document.getElementById('ruta').value;
                $.ajax({
                  url:''+url+'/api/comment/cotizacion/vehiculo',
                  type:'POST',
                  data: {
                      "id_user": id_user,
                      "comment"  : $("#comments").val(),
					  "id_cotizacion" : $("#id_edit").val()
                    },
                  dataType:'JSON',
                  success: function(data){
					getCommetns($("#id_edit").val())
                  }
                });
			});


			function getCommetns(id_cotizacion){
				var url=document.getElementById('ruta').value;
                $.ajax({
                  url:''+url+'/api/comment/cotizacion/vehiculo/'+id_cotizacion,
                  type:'GET',
                  dataType:'JSON',
				  async: false,
                  success: function(data){

						$("#comments_content").html("")

						var count_view = 0
						var html
						$.map(data, function (item, key) {
							html = ""
                            count_view++
                            html += '<div class="col-md-12" style="margin-bottom: 15px" id="comments_view_'+count_view+'">'
                                html += '<div class="row">'
                                    html += '<div class="col-md-2">'
                                        html += "<img class='rounded' src='"+url+"/img/usuarios/profile/"+item.img_profile+"' style='height: 4rem;width: 4rem; margin: 1%; border-radius: 50%!important;' title='"+item.name_user+"'>"
                                        
                                        html += '</div>'
                                                html += '<div class="col-md-10" style="background: #eee;padding: 2%;border-radius: 17px;">'
                                                html += '<div class="row">'
                                            html += '<div class="col-md-10">'
                                                html += '<div>'+item.comment+'</div>'
                                            html += '</div>'

                                            html += '<div class="col-md-2">'

                                               
                                            html += '</div>'
                                        html += '</div>'

                                        html += '<div><b>'+item.name_user+" "+item.last_name_user+'</b> <span style="float: right">'+item.created_at+'</span></div>'


                                    html += '</div>'
                                html += '</div>'
                            html += '</div>'

							$("#comments_content").append(html)

                            
                        });
                  }
                });
			}

			
			function update(){
				enviarFormularioPut("#form-update", 'api/cotizaciones', '#cuadro4', false, "#avatar-edit");
			}


			function list(cuadro) {
				console.log(id_rol, "IR_ROL")
				var data = {
					id_user,
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
						 "url":''+url+'/api/cotizaciones/paginate',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
							id_rol
						},
					},
					"columnDefs":[
						{targets: 0, "data":"nombre_completo"},
						{targets: 1, "data":"placa"},
						{targets: 2, "data":"correo"},
						{targets: 3, "data":"phone"},
						{targets: 4, "data":"agencia"},
						{targets: 5, "data":"name"},
						{targets: 6, "data":"estado"},
						{targets: 7, "data":"fecha_consulta"},
						{targets: 8, "data": null,
							render : function(data, type, row) {
								var botones = "";
								
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";	

									botones += "<span class='link btn btn-success waves-effect' data-toggle='tooltip' title='Link'><i class='ei-link' style='margin-bottom:5px'></i></span> ";

								
								botones += "<span class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
	
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
						title: 'Cotizaciones',
						filename: 'cotizaciones',
						columns: [0,1,2,3,4],
						async: true
					}),
					initComplete(){
						$('.dt-button').removeClass('dt-button buttons-copy buttons-html5')
					}
				});


				ver("#table tbody", table)
				link("#table tbody", table)
				edit("#table tbody", table)

				eliminar("#table tbody", table)


			}


			
			function link(tbody, table){
				$(tbody).on("click", "span.link", function(){
					var data = table.row( $(this).parents("tr") ).data();
				   	
				   	let str = `sodastereo-${data.id_vehiculo}`
					let refLink = btoa(unescape(encodeURIComponent(str)));

					window.open(`https://chseguros.com.co/api/cotizador/resultados/${refLink}`)
				});
			}	

			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					var data = table.row( $(this).parents("tr") ).data();
				   $('.show-when-interesado').hide();
					$("#nombre_view").val(data.nombre).attr("disabled", "disabled")
					$("#apellido_view").val(data.apellido).attr("disabled", "disabled")
					$("#tipo_documento_view").val(data.tipo_documento_identidad).attr("disabled", "disabled")
					$("#documento_identidad_view").val(data.documento_identidad).attr("disabled", "disabled")
					$("#tipo_persona_view").val(data.tipo_persona).attr("disabled", "disabled")
					$("#correo_view").val(data.correo).attr("disabled", "disabled")
					$("#phone_view").val(data.phone).attr("disabled", "disabled")
					$("#clase_vehiculo_view").val(data.clase_vehiculo).attr("disabled", "disabled")
					$("#marca_view").val(data.marca).attr("disabled", "disabled")
					$("#modelo_view").val(data.modelo).attr("disabled", "disabled")
					$("#referencia_view").val(data.referencia).attr("disabled", "disabled")
					$("#tipo_servicio_view").val(data.tipo_servicio).attr("disabled", "disabled")
					$("#estado_view").val(data.estado).attr("disabled", "disabled")
					if(data.estado == 'INTERESADO'){
						$('.show-when-interesado').show();
						$('#plan_view').val(data.plan).attr('disabled', 'disabled')
						$('#total_view').val(data.total).attr('disabled', 'disabled')
					}
					$("#created_at").html(data.fecha_consulta)
					cuadros('#cuadro1', '#cuadro5');
				});
			}
			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();
					
	
					$("#nombre_edit").val(data.nombre).attr('disabled', 'disabled')
					$("#apellido_edit").val(data.apellido).attr('disabled', 'disabled')
					$("#tipo_documento_edit").val(data.tipo_documento_identidad).attr('disabled', 'disabled')
					$("#documento_identidad_edit").val(data.documento_identidad).attr('disabled', 'disabled')
					$("#tipo_persona_edit").val(data.tipo_persona).attr('disabled', 'disabled')
					$("#correo_edit").val(data.correo).attr('disabled', 'disabled')
					$("#phone_edit").val(data.phone).attr("disabled", "disabled")
					$("#clase_vehiculo_edit").val(data.clase_vehiculo).attr('disabled', 'disabled')
					$("#marca_edit").val(data.marca).attr('disabled', 'disabled')
					$("#modelo_edit").val(data.modelo).attr('disabled', 'disabled')
					$("#referencia_edit").val(data.referencia).attr('disabled', 'disabled')
					$("#tipo_servicio_edit").val(data.tipo_servicio).attr('disabled', 'disabled')
					$("#created_at").html(data.fecha_consulta)
					$("#estado_edit").val(data.estado)
					$("#id_edit").val(data.id_vehiculo)

					getCommetns(data.id_vehiculo)


					if(data.estado == 'INTERESADO'){
						$('.show-when-interesado').show();
						$('#plan_edit').val(data.plan).attr('disabled', 'disabled')
						$('#total_edit').val(data.total).attr('disabled', 'disabled')
					}
					cuadros('#cuadro1', '#cuadro4');
				});
			}

	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/cotizaciones/status/'+data.id_vehiculo+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


