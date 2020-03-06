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
                +       '<textarea class="title" placeholder="Añade un titulo" onchange="saveTitle()" ></textarea>'
                +       '<textarea class="cnt" placeholder="Descripción..."></textarea>'
                +   '</div> '
                +'</div>';

var noteZindex = 1;


function saveTitle(value, id){

  var url=document.getElementById('ruta').value;

  $.ajax({
      url:''+url+'/api/tasks/note/update/'+id,
      type:'POST',
      dataType:'JSON',
      data: {
        "title" : value
      },
      success: function(data){
        
      }
  });

}

function saveContent(value, id){

  var url=document.getElementById('ruta').value;

  $.ajax({
      url:''+url+'/api/tasks/note/update/'+id,
      type:'POST',
      dataType:'JSON',
      data: {
        "content" : value
      },
      success: function(data){
        
      }
  });

}



function deleteNote(note, id){
   
    $(note).parent('.note').hide("puff",{ percent: 133}, 250);
    var url=document.getElementById('ruta').value;
    $.ajax({
      url:''+url+'/api/tasks/note/delete/'+id,
      type:'POST',
      dataType:'JSON',
      success: function(data){
        
      }
  });



};

function newNote() {

    saveNote()
    
    
  $('.note')
    return false; 
};




function list(){

  $("#board").html("")
  var url=document.getElementById('ruta').value;
  $.ajax({
      url:''+url+'/api/tasks/note/list/'+id_user,
      type:'GET',
      dataType:'JSON',
      
      beforeSend: function(){
      
      },
      error: function (data) {
          
      },
      success: function(data){
        
        $.map(data, function (item, key) {

           var noteZindex = 1
           var noteTemp = ""
           noteTemp =  '<div class="note">'
                      +   '<a href="javascript:;" onclick="deleteNote(this, '+item.id_note+')" class="button remove">X</a>'
                      +   '<div class="note_cnt">'
                      +       '<textarea class="title" onchange="saveTitle(this.value, '+item.id_note+')"  placeholder="Añade un titulo">'+item.title+'</textarea>'
                      +       '<textarea class="cnt" onchange="saveContent(this.value, '+item.id_note+')"  placeholder="Descripción...">'+item.content+'</textarea>'
                      +   '</div> '
                      +'</div>';

            $(noteTemp).hide().appendTo("#board").show("fade", 300).draggable().on('dragstart',
              function(){
                $(this).zIndex(++noteZindex);
                
              });

            //  $('.remove').click(deleteNote);
              $('textarea').autogrow();


        });
      }
  });
}


  

function saveNote(){
  var url=document.getElementById('ruta').value;
  $.ajax({
      url:''+url+'/api/tasks/note/create/',
      type:'POST',
      data: {
        'id_user' : id_user
      },
      dataType:'JSON',
      beforeSend: function(){
      
      },
      error: function (data) {
          
      },
      success: function(data){
        list()
      }
  });
}







$(document).ready(function() {
    
    $("#board").height($(document).height());
    
    $("#add_new").click(newNote);
    
  //  $('.remove').click(deleteNote);

    list()


    //newNote();
      
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
            

		</script>
	@endsection


