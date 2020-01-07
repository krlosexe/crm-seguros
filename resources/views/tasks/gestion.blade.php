@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		 <div class="main-content">
			<div class="container-fluid" id="cuadro1">
				<div class="page-title">
					<h4>Gestión de Tareas.</h4>
				</div>
				<div class="row">
					
					<div class="col-md-12">
						<div class="card">
							<div class="card-block">
								<div class="row">
									<div class="col-sm-3">
                                
										<div class="card">
											<div class="card-body">
												<h4 class="card-title">
													<span>Urgente</span>
												</h4>
												<div id='board1'>
													<div class="card padding-15 draggable-item">
														<ul class="list-label mrg-btm-10">
															<li class="bg-info"></li>
															<li class="bg-danger"></li>
														</ul>
														<p class="font-size-15">
															<b>Phase 1 - Preparation</b>
														</p>
														<div class="mrg-top-20">
															<ul class="list-inline d-inline-block mrg-top-10">
																<li class="d-inline-block mrg-right-10">
																	<i class="ti-clip mrg-right-5"></i>
																	<span>8</span>
																</li>
																<li class="d-inline-block">
																	<i class="ti-calendar mrg-right-5"></i>
																	<span>10/29</span>
																</li>
															</ul>
															<ul class="list-members list-inline float-right">
																<li>
																	<a href="">
																		<img src="C:/Users/Usuario/Desktop/Espire%20-%20Bootstrap%204%20Admin%20Template/html/demo/app/assets/images/avatars/thumb-4.jpg" alt="">
																	</a>
																</li>
																<li>
																	<a href="">
																		<img src="C:/Users/Usuario/Desktop/Espire%20-%20Bootstrap%204%20Admin%20Template/html/demo/app/assets/images/avatars/thumb-4.jpg" alt="">
																	</a>
																</li>
															</ul>
														</div>
													</div>
													<div class="card padding-15 draggable-item">
														<ul class="list-label mrg-btm-10">
															<li class="bg-info"></li>
														</ul>
														<p class="font-size-15">
															<b>Phase 2 - Gather Material</b>
														</p>
														<div class="mrg-top-20">
															<ul class="list-inline d-inline-block mrg-top-10">
																<li class="d-inline-block mrg-right-10">
																	<i class="ti-comment mrg-right-5"></i>
																	<span>3</span>
																</li>
															</ul>
															<ul class="list-members list-inline float-right">
																<li>
																	<a href="">
																		<img src="assets/images/avatars/thumb-9.jpg" alt="">
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>



									<div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <span>Prioritario</span>
                                        </h4>
                                        <div id='board2'>
                                            <div class="card padding-15 draggable-item">
                                                <ul class="list-label mrg-btm-10">
                                                    <li class="bg-info"></li>
                                                    <li class="bg-danger"></li>
                                                </ul>
                                                <p class="font-size-15">
                                                    <b>Setup Database</b>
                                                </p>
                                                <div class="mrg-top-20">
                                                    <ul class="list-inline d-inline-block mrg-top-10">
                                                        <li class="d-inline-block mrg-right-10">
                                                            <i class="ti-clip mrg-right-5"></i>
                                                            <span>8</span>
                                                        </li>
                                                        <li class="d-inline-block">
                                                            <i class="ti-calendar mrg-right-5"></i>
                                                            <span>10/29</span>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-members list-inline float-right">
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-3.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-5.jpg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card padding-15 draggable-item">
                                                <ul class="list-label mrg-btm-10">
                                                    <li class="bg-info"></li>
                                                    <li class="bg-danger"></li>
                                                    <li class="bg-warning"></li>
                                                </ul>
                                                <p class="font-size-15">
                                                    <b>Setup Server</b>
                                                </p>
                                                <div class="mrg-top-20">
                                                    <ul class="list-inline d-inline-block mrg-top-10">
                                                        <li class="d-inline-block mrg-right-10">
                                                            <i class="ti-comment mrg-right-5"></i>
                                                            <span>3</span>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-members list-inline float-right">
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-11.jpg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card padding-15 draggable-item">
                                                <ul class="list-label mrg-btm-10">
                                                    <li class="bg-success"></li>
                                                </ul>
                                                <p class="font-size-15">
                                                    <b>Setup Workspace</b>
                                                </p>
                                                <div class="mrg-top-20">
                                                    <ul class="list-inline d-inline-block mrg-top-10">
                                                        <li class="d-inline-block mrg-right-10">
                                                            <i class="ti-clip mrg-right-5"></i>
                                                            <span>8</span>
                                                        </li>
                                                        <li class="d-inline-block">
                                                            <i class="ti-calendar mrg-right-5"></i>
                                                            <span>10/29</span>
                                                        </li>    
                                                    </ul>
                                                    <ul class="list-members list-inline float-right">
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-5.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-7.jpg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <span>General</span>
                                        </h4>
                                        <div id='board3'>
                                            <div class="card padding-15 draggable-item">
                                                <ul class="list-label mrg-btm-10">
                                                    <li class="bg-warning"></li>
                                                    <li class="bg-danger"></li>
                                                </ul>
                                                <p class="font-size-15">
                                                    <b>Onboarding</b>
                                                </p>
                                                <div class="mrg-top-20">
                                                    <ul class="list-inline d-inline-block mrg-top-10">
                                                        <li class="d-inline-block mrg-right-10">
                                                            <i class="ti-clip mrg-right-5"></i>
                                                            <span>8</span>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-members list-inline float-right">
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-4.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-8.jpg" alt="">
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-10.jpg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card padding-15 draggable-item">
                                                <ul class="list-label mrg-btm-10">
                                                    <li class="bg-info"></li>
                                                </ul>
                                                <p class="font-size-15">
                                                    <b>Dashboard error</b>
                                                </p>
                                                <div class="mrg-top-20">
                                                    <ul class="list-inline d-inline-block mrg-top-10">
                                                        <li class="d-inline-block mrg-right-10">
                                                            <i class="ti-comment mrg-right-5"></i>
                                                            <span>3</span>
                                                        </li>
                                                    </ul>
                                                    <ul class="list-members list-inline float-right">
                                                        <li>
                                                            <a href="">
                                                                <img src="assets/images/avatars/thumb-6.jpg" alt="">
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
							

							

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			@include('configuracion.branch.store')
			@include('configuracion.branch.view')
			@include('configuracion.branch.edit')

		</div>
                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')

		<script>
			$(document).ready(function(){
				store();
				list();
				update();

				$("#collapse_Configuraciones").addClass("show");
				$("#nav_li_Configuraciones").addClass("open");
				$("#nav_users, #modulo_Configuraciones").addClass("active");

				verifyPersmisos(id_user, tokens, "modules");
			});



			function update(){
				enviarFormularioPut("#form-update", 'api/branchs', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/branchs', '#cuadro2');
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
						 "url":''+url+'/api/branchs',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"name"},
						{"data": "fec_regins"},
						{"data": null,
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

					$("#name_view").val(data.name).attr("disabled", "disabled")
					
					cuadros('#cuadro1', '#cuadro3');
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
					
					$("#name_edit").val(data.name)

					$("#id_edit").val(data.id_branchs)
					cuadros('#cuadro1', '#cuadro4');
				});
			}



		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-branchs/'+data.id_branchs+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
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
					statusConfirmacion('api/status-branchs/'+data.id_branchs+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-branchs/'+data.id_branchs+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}
		</script>
	@endsection


