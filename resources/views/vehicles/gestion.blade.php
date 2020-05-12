@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Vehículos</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="table-overflow">
									<button onclick="nuevo()" id="btn-new" class="btn btn-success" style="float: left;">
										<i class="ti-car"></i>
										<span>Nuevo</span>
									</button>
									<table class="table table-bordered" id="table" width="100%" cellspacing="0">
										<thead>
											<tr>
											
											<th>Número de placa</th>
											<th>Tipo de vehículo</th>
											<th>Marca</th>
											<th>Valor Fasecolda</th>
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

			@include('vehicles.store')
			@include('vehicles.view')
			@include('vehicles.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
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


			});



			function update(){
				enviarFormularioPut("#form-update", 'api/vehicle', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/vehicle', '#cuadro2');
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
					"serverSide":true,
          			"processing": true,
					"ajax":{
						"method":"post",
						 "url":''+url+'/api/vehicle/paginate',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
					},
					"columnDefs":[
						
						{targets: 0, "data":"placa"},
						{targets: 1, "data":"clase"},
						{targets: 2, "data":"marca"},
						{targets: 3, "data":"valor_fasecolda", 
							render: function(data, type, row){
								return number_format(data, 2)
							}
						},
						{targets: 4, "data": "fec_regins"},
						{targets: 5, "data": null,
							render : function(data, type, row) {
								var botones = "";
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
								if(actualizar == 1)
									botones += "<span class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
								if(data.status == 1 && actualizar == 1)
									botones += "<span class='desactivar btn btn-warning waves-effect' data-toggle='tooltip' title='Desactivar'><i class='fa fa-unlock' style='margin-bottom:5px'></i></span> ";
								else if(data.status == 2 && actualizar == 1)
									botones += "<span class='activar btn btn-warning waves-effect' data-toggle='tooltip' title='Activar'><i class='fa fa-lock' style='margin-bottom:5px'></i></span> ";
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

				$("#type_vehicule, #code").removeAttr("disabled").removeAttr("readonly")
				ShowTypeVehicule("#type_vehicule")

				cuadros("#cuadro1", "#cuadro2");
			}


			

			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(tbody, table){
				$(tbody).on("click", "span.consultar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();


					cuadros('#cuadro1', '#cuadro3');

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
					$("#due_date_soat_view").val(data.due_date_soat).attr("disabled", "disabled")

					$("#number_motor_view").val(data.number_motor).attr("disabled", "disabled")
					$("#number_chassis_view").val(data.number_chassis).attr("disabled", "disabled")

					$("#value_fasecolda_view").val(number_format(data.valor_fasecolda ,2)).attr("disabled", "disabled")
					
					$("#service_view").val(data.servicio)

					var url = "vehicles/files/"+data.id_vehicules+"/0"
					$('#iframeInfo').attr('src', url);
					
				});
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
					maxFileSize: 1500,
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
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");
					var data = table.row( $(this).parents("tr") ).data();
					
			
					ShowTypeVehicule("#type_vehicule_edit", data.clase, false)

					$("#placa_edit").val(data.placa)
				

					changeTypeVehicule("#type_vehicule_edit", "#marca_edit", data.marca)
					$("#type_vehicule_edit").trigger("change");

					
					changeMarca("#marca_edit", "#line_edit", data.referencia1)
					$("#marca_edit").trigger("change");
					

					ChangeRefer1("#line_edit", "#refer2_edit", data.referencia2)
					$("#line_edit").trigger("change");

					ChangeRefer2("#refer2_edit", "#refer3_edit", data.referencia3)
					$("#refer2_edit").trigger("change");

					changeRefer3("#refer3_edit", "edit")
					$("#refer3_edit").trigger("change");

					
					$("#model_edit").val(data.model)
					$("#color_edit").val(data.color)
					$("#due_date_techno_mechanics_edit").val(data.due_date_techno_mechanics)
					$("#due_date_soat_edit").val(data.due_date_soat)

					$("#number_motor_edit").val(data.number_motor)
					$("#number_chassis_edit").val(data.number_chassis)

					$("#value_fasecolda_edit").val(number_format(data.valor_fasecolda ,2))
					$("#service_edit").val(data.servicio)

					$("#id_edit").val(data.id_vehicules)

					cuadros('#cuadro1', '#cuadro4');

					let url = "vehicles/files/"+data.id_vehicules+"/1"
					$('#iframeEdit').attr('src', url);

				});
			}
			


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
	@endsection


