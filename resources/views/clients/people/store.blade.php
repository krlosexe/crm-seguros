<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Clientes - Personas</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf


        <div class="row">
          <div class="col-md-6">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos Principales</h6>
              </div>
              <div class="card-body">
                <div class="row">

                  <div class="col-md-6">
                    <label for=""><b>Nombres</b></label>
                      <div class="form-group valid-required">
                        <input type="text" name="nombre" class="form-control form-control-user" id="names" placeholder="Nombre" required>
                      </div>
                  </div>

                  <div class="col-md-6">
                    <label for=""><b>Apellidos</b></label>
                      <div class="form-group valid-required">
                        <input type="text" name="last_names" class="form-control form-control-user" id="last_names" placeholder="Apellidos" required>
                      </div>
                  </div>

                  
                  <div class="col-sm-6">
                    <label for=""><b>Tipo de documento</b></label>
                    <select name="type_document" class="form-control form-control-user" id="type_document">
                      <option value="">Seleccione</option>
                      <option value="Cedula">Cedula</option>
                      <option value="Cedula de Extrangeria">Cedula de Extrangeria</option>
                      <option value="RUC">RUC</option>
                      <option value="Pasaporte">Pasaporte</option>
                      <option value="NUIP">NUIP</option>
                      <option value="Tarjeta de indentidad">Tarjeta de indentidad</option>
                    </select>
                  </div>


                  <div class="col-sm-6">
                    <label for=""><b>Icono</b></label>
                    <input type="text" name="icon" class="form-control form-control-user" id="descripcion" placeholder="fa fa-config" required>
                  </div>


                  <div class="col-sm-6">
                    <label for=""><b>Posicion</b></label>
                    <select id="posicion_modulo_vista_registrar" required class="form-control form-group" name="posicion">
                      <option value="">Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Datos Principales</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <label for=""><b>Nombre</b></label>
                      <div class="form-group valid-required">
                        <input type="text" name="nombre" class="form-control form-control-user" id="nombre" placeholder="Nombre" required>
                      </div>
                  </div>

                  
                  <div class="col-sm-3">
                    <label for=""><b>Descripcion</b></label>
                    <input type="text" name="descripcion" class="form-control form-control-user" id="descripcion" placeholder="Descripcion" required>
                  </div>


                  <div class="col-sm-3">
                    <label for=""><b>Icono</b></label>
                    <input type="text" name="icon" class="form-control form-control-user" id="descripcion" placeholder="fa fa-config" required>
                  </div>


                  <div class="col-sm-3">
                    <label for=""><b>Posicion</b></label>
                    <select id="posicion_modulo_vista_registrar" required class="form-control form-group" name="posicion">
                      <option value="">Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>



        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
        </div>
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro2')">
                Cancelar
            </button>
            <button id="send_usuario" class="btn btn-primary btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      
    </div>

