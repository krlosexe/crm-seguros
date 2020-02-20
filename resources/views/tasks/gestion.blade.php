@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->
		<div class="main-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card calendar-event">
                                    <div class="card-block overlay-dark bg" style="background-image: url('images/others/img-8.jpg')">
                                        <div class="text-center">
                                                 <h1 class="font-size-65 text-light mrg-btm-5 lh-1"><?= date("d") ?></h1>
												<h2 class="no-mrg-top"><?= date('l', strtotime(date("d"))); ?></h2>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <button type="button" class="add-event btn-warning" id="new-tasks">
                                            <i class="ti-plus"></i>
                                        </button>
                                        <ul class="event-list" id="list-today">
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
                                        <h4 class="no-mrg" id="title-modal">Tarea</h4>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post" id="form-store">
                                            <div class="form-group">
                                                <label>Responsable</label>
                                                <select class="selectized" name="responsable" id="responsable" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>


                                            <div class="form-group">
                                                <label>Asunto</label>
                                                <input  name="issue" id="issue" class="form-control" required>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Fecha de Entrega</label>
                                                    <div class="timepicker-input input-icon form-group">
                                                        <i class="ti-calendar"></i>
                                                        <input type="text" autocomplete="off" id="delivery_date" name="delivery_date" class="form-control start-date" placeholder="Datepicker" data-provide="datepicker" required>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <label>Estado</label>
                                                    <select class="form-control" name="state" id="state" required>
                                                        <option value="Abierta">Abierta</option>
                                                        <option value="Finalizada">Finalizada</option>
                                                        <option value="Cancelada">Cancelada</option>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="form-group">
                                                <label>Descripcion</label>
                                                <textarea name="description" id="description" class="form-control"></textarea>
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


		</div>
        
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">


                <!-- Content Wrapper END -->
	@endsection





	@section('CustomJs')


		<script>
            
			$(document).ready(function(){
	
				$("#collapse_Tareas").addClass("show");
				$("#nav_li_Tareas").addClass("open");
                $("#nav_users, #modulo_Tareas").addClass("active");

                verifyPersmisos(id_user, tokens, "modules");
                GetUsers("#responsable")


                initCalendar()

                ListTasksToday("#list-today")



            });
            

            function initCalendar(){
                $('#full-calendar').fullCalendar("destroy")

                $('#full-calendar').fullCalendar({
                    lang: 'es',
                    height: 800,
                    editable: true,
                    header:{
                        left: 'month,agendaWeek,agendaDay',
                        center: 'title',
                        right: 'today prev,next'
                    },
                    eventSources: [
							{
								url: 'api/calendar/tasks', 
                            }
                    ],


                    eventClick: function(calEvent, jsEvent, view) {

                        enviarFormularioTask("#form-store", 'api/tasks/update/'+calEvent.id_tasks, '#cuadro2');



                         $("#issue").val(calEvent.title)
                         $("#delivery_date").val(calEvent.delivery_date)
                         $("#description").val(calEvent.description)
                         $("#state").val(calEvent.state)
                        $("#responsable").each(function() {
                            if (this.selectize) {
                            this.selectize.destroy();
                            }
                        });

                        $("#responsable").val(calEvent.responsable);
                         
                        $("#responsable").selectize({});

                        $("#calendar-edit").modal("show")
                    }
                        

                })

                $('.start-date').datepicker();
                $('.end-date').datepicker();

            }

            
            


            function enviarFormularioTask(form, controlador, cuadro, auth = false){
                $(form).unbind().submit(function(e){
                    e.preventDefault(); //previene el comportamiento por defecto del formulario al darle click al input submit
                    var url=document.getElementById('ruta').value; 
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
                            if (respuesta.success == false) {
                                showNoty('error', "topRight", respuesta.message, 3000);
                                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                            }else{
                                $('input[type="submit"]').removeAttr('disabled'); //activa el input submit
                                showNoty('success', "topRight", respuesta.mensagge, 3000);
                               
                            }

                            initCalendar()
                            ListTasksToday("#list-today")

                            $("#calendar-edit").modal("hide")

                        }

                    });
                });
            }



            $("#new-tasks").click(function (e) { 
                $("#calendar-edit").modal("show")
                $("#form-store")[0].reset()

                enviarFormularioTask("#form-store", 'api/tasks', '#cuadro2');

            });





            function ListTasksToday(list){
                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/tasks-today',
                    type:'GET',
                    dataType:'JSON',
                    async: false,
                    beforeSend: function(){
                    
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){
                        var html = ""

                        var array = []
                        $.each(data, function (key, event) { 
                            array.push(event)
                        });	


                        array.sort(function(a,b){
                            return  new Date(a.start) - new Date(b.start);
                        });

                        $.each(array, function (key, event) { 
                            html += '<li class="event-items">'
                                    html += '<a href="javascript:void(0);" data-event=\''+JSON.stringify(event)+'\' onclick="showEvent(this)">'
                                        html += '<span class="bullet success"></span>'
                                        html += '<span class="event-name">'+event.title+'</span>'
                                        html += '<div class="event-detail">'
                                            html += '<span>'+event.delivery_date+' - </span>'
                                            html += '<i>'+event.nombres+' '+event.apellido_p+'</i>'
                                        html += '</div>'
                                    html += '</a>'
                                    
                                html += '</li>'
                        });

                        $(list).html(html)


                    }
                });

            }



            function showEvent(data){

                var data = JSON.parse($(data).attr("data-event"));

                
                enviarFormularioTask("#form-store", 'api/tasks/update/'+data.id_tasks, '#cuadro2');

                $("#issue").val(data.title)
                $("#delivery_date").val(data.delivery_date)
                $("#description").val(data.description)
                $("#state").val(data.state)
                $("#responsable").each(function() {
                    if (this.selectize) {
                    this.selectize.destroy();
                    }
                });

                $("#responsable").val(data.responsable);
                    
                $("#responsable").selectize({});

                $("#calendar-edit").modal('show');

            }
		
		</script>
	@endsection


