<div class="card shadow mb-4 hidden" id="cuadro3">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Digitales.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" enctype="multipart/form-data">
      
        @csrf


        <div class="row">
          <div class="col-md-12" id="file-'+count+'">
              <div class="row">
                <div class="col-md-6">
                  <label for=""><b>Titulo *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="titles" id="titles_view" class="form-control form-control-user" required>
                  </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Descripción *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="descriptions" id="descriptions_view" class="form-control form-control-user" id="description" required>
                  </div>
                </div>

              </div>
              <br>


              <div class="row">
                <div class="col-md-12 text-center">
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="input-file-view" name="file" type="file">
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


        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
        
          <center>
            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro3')">
                Cancelar
            </button>
          </center>
          <br>
          <br>
      </form>
      
    </div>
  </div>

