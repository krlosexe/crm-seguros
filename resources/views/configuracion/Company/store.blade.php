<div class="card shadow mb-4 " id="cuadro2">
	<div class="card-header py-3">
	  <h6 class="m-0 font-weight-bold text-primary">Registro de usuarios</h6>
	</div>
	<div class="card-body">
	  	<form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
			
			@csrf

			<br><br>	<br><br>	<br><br>	<br><br>


			<div class="row">
					
				<div class="col-md-6">
					<div class="row">
						<div class="col-sm-12 text-center">
							<div class="kv-avatar">
								<div class="file-loading">
									<input id="avatar-1" name="img-profile" type="file" required>
								</div>
							</div>
							<div class="kv-avatar-hintss">
								<small>Seleccione una foto</small>
							</div>
						</div>
					</div>
				</div>


				<div class="col-md-6">
					<div class="form-group valid-required">
						<label for="">Nombre Empresa</label>
						<input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email" required>
					</div>
					<div class="form-group row">
						<div class="col-sm-12 mb-3 mb-sm-0 valid-required">
							<label for="">Nit</label>
							<input type="number" name="password" class="form-control form-control-user" id="password" placeholder="Contraseña" required>
						</div>
					</div>
			
					<div class="row">
						
						<div class="col-sm-6 valid-required">
							<label for="">Telefono</label>
							<input type="number" name="repeat-password" class="form-control form-control-user" id="RepeatPassword" placeholder="Repita Contraseña" required>
						</div>
						<div class="col-sm-6 valid-required">
							<label for="">Email</label>
							<input type="email" name="repeat-password" class="form-control form-control-user" id="RepeatPassword" placeholder="Repita Contraseña" required>
						</div>
					</div>

			
				</div>
			</div>

            
            

            <center>
            	<button id="send_usuario" class="btn btn-primary btn-user">
              		Guardar
            	</button>

            </center>
          
        </form>
	</div>
</div>