@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card calendar-event">
                                    <div class="card-block overlay-dark bg" style="background-image: url('assets/images/others/img-8.jpg')">
                                        <div class="text-center">
                                            <h1 class="font-size-65 text-light mrg-btm-5 lh-1">28<span class="font-size-18">th</span></h1>
                                            <h2 class="no-mrg-top">Sunday</h2>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <button type="button" class="add-event btn-warning" data-toggle="modal" data-target="#calendar-edit">
                                            <i class="ti-plus"></i>
                                        </button>
                                        <ul class="event-list">
                                            <li class="event-items">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                    <span class="bullet success"></span>
                                                    <span class="event-name"> All Day Event</span>
                                                    <div class="event-detail">
                                                        <span>Aug 01 - </span>
                                                        <i>Meetings</i>
                                                    </div>
                                                </a>
                                                <a href="" class="remove">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </li>
                                            <li class="event-items">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                    <span class="bullet success"></span>
                                                    <span class="event-name"> Long Event</span>
                                                    <div class="event-detail">
                                                        <span>Aug 21 - Aug 24</span>
                                                        <i>Hangouts</i>
                                                    </div>
                                                </a>
                                                <a href="" class="remove">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </li>
                                            <li class="event-items">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                    <span class="bullet warning"></span>
                                                    <span class="event-name">Repeating Event</span>
                                                    <div class="event-detail">
                                                        <span>Aug 23 -</span>
                                                        <i>Product Checkup</i>
                                                    </div>
                                                </a>
                                                <a href="javascript:void(0);" class="remove">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </li>
                                            <li class="event-items">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                    <span class="bullet danger"></span>
                                                    <span class="event-name">Repeating Event</span>
                                                    <div class="event-detail">
                                                        <span>Aug 30 -</span>
                                                        <i>Conference</i>
                                                    </div>
                                                </a>
                                                <a href="" class="remove">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </li>
                                            <li class="event-items">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                    <span class="bullet"></span>
                                                    <span class="event-name">Birthday Party</span>
                                                    <div class="event-detail">
                                                        <span>Aug 27 -</span>
                                                        <i>Gathering</i>
                                                    </div>
                                                </a>
                                                <a href="" class="remove">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </li>
                                            <li class="event-items">
                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#calendar-edit">
                                                    <span class="bullet success"></span>
                                                    <span class="event-name">Click for google</span>
                                                    <div class="event-detail">
                                                        <span>Aug 28 - Aug 29</span>
                                                        <i>Google</i>
                                                    </div>
                                                </a>
                                                <a href="" class="remove">
                                                    <i class="ti-trash"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id='full-calendar'></div>
                            </div>
                        </div>




                        <div class="modal fade" id="calendar-edit">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="border btm padding-15">
                                        <h4 class="no-mrg">Edit Event</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="form-store">
                                            <div class="form-group">
                                                <label>Responsable</label>
                                                <select class="selectized" id="responsable" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>Asunto</label>
                                                <input class="form-control" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Fecha de Entrega</label>
                                                    <div class="timepicker-input input-icon form-group">
                                                        <i class="ti-calendar"></i>
                                                        <input type="text" class="form-control start-date" placeholder="Datepicker" data-provide="datepicker" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Descripcion</label>
                                                <textarea class="form-control"></textarea>
                                            </div>
                                            <div class="text-right">
                                                <button type="submit" class="btn btn-success">Guardar</button>
                                                
                                            </div>
                                        </form>
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
			//	list();
				update();

				$("#collapse_Configuraciones").addClass("show");
				$("#nav_li_Configuraciones").addClass("open");
                $("#nav_users, #modulo_Configuraciones").addClass("active");
                
               

                verifyPersmisos(id_user, tokens, "modules");
                GetUsers("#responsable")
			});


			function update(){
				enviarFormularioPut("#form-update", 'api/branchs', '#cuadro4', false, "#avatar-edit");
			}

			function store(){
				enviarFormulario("#form-store", 'api/tasks', '#cuadro2');
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
		
		</script>
	@endsection


