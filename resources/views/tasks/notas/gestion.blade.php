@extends('layouts.app')

	@section('content')
			
		 <!-- Content Wrapper START -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<link rel='stylesheet' href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css'>
<style type="text/css">
.hidden {
  display: none !important;
  visibility: hidden;
}

.visuallyhidden {
  border: 0;
  clip: rect(0 0 0 0);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}

.visuallyhidden.focusable:active,
.visuallyhidden.focusable:focus {
  clip: auto;
  height: auto;
  margin: 0;
  overflow: visible;
  position: static;
  width: auto;
}

.invisible {
  visibility: hidden;
}

.clearfix:before,
.clearfix:after {
  content: " ";
  display: table;
}

.clearfix:after {
  clear: both;
}

.noflick, #board, .note, .button {
  -webkit-perspective: 1000;
          perspective: 1000;
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transform: translate3d(0, 0, 0);
          transform: translate3d(0, 0, 0);
}


* {
  box-sizing: border-box;
}

html,
button,
input,
select,
textarea {
  color: #000000;
}

::-moz-selection {
  background: #B3D4FC;
  text-shadow: none;
}

::selection {
  background: #B3D4FC;
  text-shadow: none;
}

a:focus {
  outline: none;
}

::-webkit-input-placeholder {
  color: rgba(0, 0, 0, 0.7);
}

:placeholder {
  
  color: rgba(0, 0, 0, 0.7);
}


#board {
  padding: 100px 30px 30px;
  overflow-y: visible;
 margin-bottom: 80px;
}

.note {
  float: left;
  display: block;
  position: relative;
  padding: 1em;
  width: 300px;
  min-height: 300px;
  margin: 0 30px 30px 0;
  background-color: #FFFD75;

  -webkit-transform: rotate(2deg);
          transform: rotate(2deg);
  -webkit-transform: skew(-1deg, 1deg);
          transform: skew(-1deg, 1deg);
  -webkit-transition: -webkit-transform .15s;
  transition: -webkit-transform .15s;
  transition: transform .15s;
  transition: transform .15s, -webkit-transform .15s;
  z-index: 1;
}
.note:hover {
  cursor: move;
}
.note.ui-draggable-dragging:nth-child(n) {
  box-shadow: 5px 5px 15px 0 rgba(0, 0, 0, 0.3);
  -webkit-transform: scale(1.125) !important;
          transform: scale(1.125) !important;
  z-index: 100;
  cursor: move;
  -webkit-transition: -webkit-transform .150s;
  transition: -webkit-transform .150s;
  transition: transform .150s;
  transition: transform .150s, -webkit-transform .150s;
}
.note textarea {
  background-color: transparent;
  border: none;
  resize: vertical;
  width: 100%;
  padding: 5px;
}
.note textarea:focus {
  outline: none;
  border: none;
  box-shadow: 0 0 5px 1px rgba(0, 0, 0, 0.2) inset;
}
.note textarea.title {
  font-size: 24px;
  line-height: 1.2;
  color: #000000;
  height: 64px;
  margin-top: 20px;
}
.note textarea.cnt {
  min-height: 200px;
}
.note:nth-child(2n) {
  background: #5680ff82;
}
.note:nth-child(3n) {
  background: #05eb80ba;
}

/* Button style  */

.button.remove {
  position: absolute;
  top: 5px;
  right: 5px;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  background-color: #E01C12;
  text-align: center;
  line-height: 16px;
  padding: 10px;
  border-color: #B30000;
  font-style: 1.6em;
  font-weight: bolder;
  color: white;
}
.button.remove:hover {
  background-color: #EF0005;
}

#add_new {
  position: fixed;
  top: 100px;
  right: 20px;
  z-index: 100;
}

.author {
  position: absolute;
  top: 20px;
  left: 20px;
}
</style>

<br>
<br>
<br>  
        <button href="javascript:;" class="btn btn-success" id="add_new"> <i class="ti-pencil-alt"></i><span>Nueva nota</span></button> 
       
        <div id="board">
            
        </div>
        

<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>

<script type="text/javascript">
    (function($)
{
    /**
     * Auto-growing textareas; technique ripped from Facebook
     *
     * https://github.com/jaz303/jquery-grab-bag/tree/master/javascripts/jquery.autogrow-textarea.js
     */
    $.fn.autogrow = function(options)
    {
        return this.filter('textarea').each(function()
        {
            var self         = this;
            var $self        = $(self);
            var minHeight    = $self.height();
            var noFlickerPad = $self.hasClass('autogrow-short') ? 0 : parseInt($self.css('lineHeight')) || 0;

            var shadow = $('<div></div>').css({
                position:    'absolute',
                top:         -10000,
                left:        -10000,
                width:       $self.width(),
                fontSize:    $self.css('fontSize'),
                fontFamily:  $self.css('fontFamily'),
                fontWeight:  $self.css('fontWeight'),
                lineHeight:  $self.css('lineHeight'),
                resize:      'none',
                'word-wrap': 'break-word'
            }).appendTo(document.body);

            var update = function(event)
            {
                var times = function(string, number)
                {
                    for (var i=0, r=''; i<number; i++) r += string;
                    return r;
                };

                var val = self.value.replace(/</g, '&lt;')
                                    .replace(/>/g, '&gt;')
                                    .replace(/&/g, '&amp;')
                                    .replace(/\n$/, '<br/>&nbsp;')
                                    .replace(/\n/g, '<br/>')
                                    .replace(/ {2,}/g, function(space){ return times('&nbsp;', space.length - 1) + ' ' });

                // Did enter get pressed?  Resize in this keydown event so that the flicker doesn't occur.
                if (event && event.data && event.data.event === 'keydown' && event.keyCode === 13) {
                    val += '<br />';
                }

                shadow.css('width', $self.width());
                shadow.html(val + (noFlickerPad === 0 ? '...' : '')); // Append '...' to resize pre-emptively.
                $self.height(Math.max(shadow.height() + noFlickerPad, minHeight));
            }

            $self.change(update).keyup(update).keydown({event:'keydown'},update);
            $(window).resize(update);

            update();
        });
    };
})(jQuery);


var noteTemp =  '<div class="note">'
                +   '<a href="javascript:;" class="button remove">X</a>'
                +   '<div class="note_cnt">'
                +       '<textarea class="title" placeholder="Añade un titulo"></textarea>'
                +       '<textarea class="cnt" placeholder="Descripción..."></textarea>'
                +   '</div> '
                +'</div>';

var noteZindex = 1;
function deleteNote(){
    $(this).parent('.note').hide("puff",{ percent: 133}, 250);
};

function newNote() {
  $(noteTemp).hide().appendTo("#board").show("fade", 300).draggable().on('dragstart',
    function(){
       $(this).zIndex(++noteZindex);
    });
 
    $('.remove').click(deleteNote);
    $('textarea').autogrow();
    
  $('.note')
    return false; 
};



$(document).ready(function() {
    
    $("#board").height($(document).height());
    
    $("#add_new").click(newNote);
    
    $('.remove').click(deleteNote);
    newNote();
      
    return false;
});
</script>






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


