<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Polizas Agrupadas</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf


        <div class="row">
          <div class="col-md-12">
            <label for=""><b>Número de Póliza*</b></label>
              <div class="form-group valid-required">
                <input type="text" name="number_policies" class="form-control form-control-user" id="number_policies"required>
              </div>
          </div>
        </div>



        <div class="row">
        
           <div class="col-md-6">
              <label for=""><b>Aseguradora*</b></label>
                <div class="form-group valid-required">
                  <select name="insurers"  id="insurers" required>
                    <option value="">Seleccione</option>
                  </select>
                </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>Ramo*</b></label>
                <div class="form-group valid-required">
                  <select id="branch" required>
                    <option value="">Seleccione</option>
                  </select>
                </div>
            </div>

            <input type="hidden" name="branch" id="branch_value">

        </div>



        <div class="row">
          <div class="col-md-6">
            <label for=""><b>Nombre Tomador*</b></label>
              <div class="form-group valid-required">
                <input type="text" name="name_taker" class="form-control form-control-user" id="name_taker" placeholder="Nombre Tomador" required>
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>Documento del Tomador*</b></label>
              <div class="form-group valid-required">
                <input type="text" name="identification_taker" class="form-control form-control-user" id="identification_taker" placeholder="Docuemnento Tomador" required>
              </div>
          </div>
        </div>


        <div class="row">

          <div class="col-sm-3">
            <label for=""><b>Fecha inicio *</b></label>
            <input type="date" name="start_date" class="form-control form-control-user" id="start_date" required>
          </div>

          <div class="col-sm-3">
            <label for=""><b>Fecha Fin *</b></label>
            <input type="date" name="end_date" class="form-control form-control-user" id="end_date" required>
          </div>


          <div class="col-sm-3">
            <label for=""><b>Fecha Recepción</b></label>
            <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date">
          </div>

          <div class="col-md-3">
            <label for="is_renewable"><b>¿Es renovable?</b><br></label><br>
            <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                  <input type="checkbox" name="is_renewable" id="is_renewable" checked="checked">
                  <label for="is_renewable"></label>
            </div>
          </div>
            
        </div>
        <br>


        <!---END ROW-->

        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
        </div>
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro2')">
                Cancelar
            </button>
            <button id="send_usuario" type="submit" class="btn btn-success btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      
    </div>

