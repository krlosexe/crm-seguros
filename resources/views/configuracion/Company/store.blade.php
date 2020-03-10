<div class="card shadow mb-4 " id="cuadro2">
	<div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary">Registro de usuarios</h6>
	</div>
	<div class="card-block">
	  	<form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
			<div class="page-title">
	  
			<ul class="nav nav-pills" role="tablist">
				<li class="nav-item">
					<a href="#default-tab-1-0" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
				</li>
			
				<li class="nav-item remove-pay">
					<a href="#default-tab-3-0" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Oficinas</a>
				</li>
			</ul>
			@csrf


			<div class="tab-content">
        
           		<div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-0">
				   
				   	aa
				</div>


				   
				<div role="tabpanel" class="tab-pane fade in" id="default-tab-2-0">bbb</div>
			</div>

			

			<br><br>	<center><h4>Actualizar información de la Empresa</h4></center> 	</div><br><br>	<br><br>

			<div class="row">
					
				<div class="col-md-6">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="kv-avatar">
								<div class="file-loading">
									<input id="avatar-1" name="logo_file" type="file" >
								</div>
							</div>
							<div class="kv-avatar-hintss">
								<small>Sube el logo de tu empresa</small>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group valid-required">
						<label for="">Nombre de la empresa</label>
						<input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Rázon social" required>
					</div>
					<div class="form-group row">
						<div class="col-sm-12 mb-3 mb-sm-0 valid-required">
							<label for="">Nit</label>
							<input type="text" name="nit" class="form-control form-control-user" id="nit" placeholder="Número de NIT" required>
						</div>
					</div>
			
					<div class="row">
						<div class="col-sm-6 valid-required">
							<label for="">Teléfono</label>
							<input type="number" name="phone" class="form-control form-control-user" id="phone" placeholder="Teléfono de oficina" required>
						</div>
						<div class="col-sm-6 valid-required">
							<label for="">Email</label>
							<input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Correo Eléctronico" required>
						</div>
					</div>
				</div>
			</div>        
  			<br>
       		<br>
            <br>
			<input type="hidden" name="_method" value="put">
			<input type="hidden" name="id_user_edit" id="id_edit" value="1">


            <center>
            	<button id="send_usuario" class="btn btn-primary btn-user">
              		Guardar
            	</button>

            </center>
          <br>
          <br>
          <br>
          <br>
          <br>
        </form>
	</div>
</div>