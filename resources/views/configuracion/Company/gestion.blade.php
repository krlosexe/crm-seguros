@extends('layouts.app')
	

	@section('CustomCss')

		<style>
			.kv-avatar .krajee-default.file-preview-frame,.kv-avatar .krajee-default.file-preview-frame:hover {
			    margin: 0;
			    padding: 0;
			    border: none;
			    box-shadow: none;
			    text-align: center;
			}
			.kv-avatar {
			    display: inline-block;
			}
			.kv-avatar .file-input {
			    display: table-cell;
			    width: 213px;
			}
			.kv-reqd {
			    color: red;
			    font-family: monospace;
			    font-weight: normal;
			}
		</style>


	@endsection


	@section('content')
	    
			@include('configuracion.Company.store')

		</div>
                <!-- Content Wrapper END -->
	@endsection


	@section('CustomJs')

		<script>
			$(document).ready(function(){
				update();
				getData()
				verifyPersmisos(id_user, tokens, "users");
				
				$("#collapse_Perfiles").addClass("show");
				$("#nav_li_Perfiles").addClass("open");
				$("#nav_users, #modulo_Perfiles").addClass("active");

				
			});



			function getData(){
				var url=document.getElementById('ruta').value; 
				$.ajax({
					url:''+url+'/api/my/company',
					type:"GET",
					dataType:'JSON',
					async: false,
					beforeSend: function(){
					
					},
					error: function (repuesta) {
						
					},
					success: function(data){
						$("#name").val(data.name);
						$("#nit").val(data.nit);
						$("#phone").val(data.phone);
						$("#email").val(data.email);



						$('#avatar-1').fileinput('destroy');


					

					url_imagen = '/img/my_company/'

					if(data.logo != ""){
						img = '<img src="'+url_imagen+data.logo+'" class="file-preview-image kv-preview-data">'
					}else{rfc2c = ""}
					
					$("#avatar-1").fileinput({
						theme: "fas",
						overwriteInitial: true,
						maxFileSize: 1500,
						showClose: false,
						showCaption: false,
						browseLabel: '',
						removeLabel: '',
						browseIcon: '<i class="fa fa-folder-open"></i>',
						removeIcon: '<i class="fas fa-trash-alt"></i>',
						previewFileIcon: '<i class="fas fa-file"></i>',
						removeTitle: 'Cancel or reset changes',
						elErrorContainer: '#kv-avatar-errors-1',
						msgErrorClass: 'alert alert-block alert-danger',
						defaultPreviewContent: '<img src="img/default-user.png" width="150" alt="Your Avatar">',
						layoutTemplates: {main2: '{preview}  {remove} {browse}'},
						allowedFileExtensions: ["jpg", "png", "gif"],
						initialPreview: [ 
							img
						],
						initialPreviewConfig: [
								
							{caption: data.logo , downloadUrl: url_imagen+data.logo  ,url: url+"uploads/delete", key: data.logo}
					
						],

					});



					}
				});

			}

		
			function update(){
				enviarFormularioPut("#store", 'api/my/company', '#cuadro4', false, "#avatar-edit");
			}


			function nuevo() {
				$("#alertas").css("display", "none");

				$("#store")[0].reset();

				$('.tab_content0').removeClass("active in");$('#tab0').removeClass("active");
		        $('.tab_content1').removeClass("active in");$('#tab1').removeClass("active");
		        $('.tab_content2').removeClass("active in");$('#tab2').removeClass("active");
		        $('.tab_content3').removeClass("active in");$('#tab3').removeClass("active");
		        $('.tab_content4').removeClass("active in");$('#tab4').removeClass("active");
		        $('.tab_content5').removeClass("active in");$('#tab5').removeClass("active");
		        $('.tab_content6').removeClass("active in");$('#tab6').removeClass("active");
		        $('.tab_content80').removeClass("active in");$('#tab80').removeClass("active");
		        
		        $('.tab_content0').addClass("active in show");$('#tab0').addClass("active");

				$("#avatar-1").fileinput({
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
					defaultPreviewContent: '<img src="img/default-user.png" width="150" alt="Your Avatar">',
					layoutTemplates: {main2: '{preview}  {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif"],

				});


				GetRoles("#rol")

				cuadros("#cuadro1", "#cuadro2");
			}




		</script>
		
	@endsection


