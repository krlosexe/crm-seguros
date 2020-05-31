<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Digitales</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf

        <input type="hidden" name="_method" value="put">
        
        <div class="row">
          <div class="col-md-12" id="file-'+count+'">
              <div class="row">
                <div class="col-md-6">
                  <label for=""><b>Titulo *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="title" id="titles_edit" class="form-control form-control-user" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Descripción *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="descripcion" id="descriptions_edit" class="form-control form-control-user" id="description" required>
                  </div>
                </div>

              </div>
              <br>


              <div class="row">
                <div class="col-md-12 text-center">
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="input-file-edit" name="file" type="file">
                    </div>
                  </div>

                  <div class="kv-avatar-hintss">
                    <small>Seleccione una foto</small>
                  </div>

                </div>
              </div>
              <br>
              <br>
          </div>
        </div>

        <!---END ROW-->


        <input type="hidden" name="tabla" value="clients_company">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">

        <input type="hidden" name="id_user_edit" id="id_edit">


          <br>
          <br>
   
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro4')">
                Cancelar
            </button>
            <button id="send_usuario" class="btn btn-success btn-user">
                Guardar
            </button>

          </center>
          <br>
          <br>
      </form>
      
    </div>

