<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Digitales</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
          <div class="col-md-12" id="file-'+count+'">
              <div class="row">
                <div class="col-md-6">
                  <label for=""><b>Titulo *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="title" id="titles_store" class="form-control form-control-user" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Descripcion *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="descripcion" id="descriptions_store" class="form-control form-control-user" id="description" required>
                  </div>
                </div>

              </div>
              <br>


              <div class="row">
                <div class="col-md-12 text-center">
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="input-file-store" name="file" type="file" required>
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
        <input type="hidden" name="tabla" value="sinister">
        <input type="hidden" name="id_register" value="{{$id_client}}">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
   
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro2')">
                Cancelar
            </button>
            <button type="submit" class="btn btn-success btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      
      </div>
 </div>

