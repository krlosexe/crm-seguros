<div class="card shadow mb-4 hidden" id="cuadro3">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Ramos.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf


        <div class="row">
          
          <div class="col-md-12">

            <div class="row">

              <div class="col-md-12">

                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Principales</h6>
                  </div>
                  <div class="card-body">

                  <div class="row">

                    <div class="col-md-6">

                      <label for=""><b>Nombre *</b></label>
                        <div class="form-group valid-required">
                          <input type="text" name="name" class="form-control form-control-user" id="name_view" placeholder="Nombre" required>
                        </div>
                    </div>

                  </div>
                    <br>

                </div>
              </div>
            </div>

          </div>
          
        </div>

        <!---END ROW-->


        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
        </div>
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

