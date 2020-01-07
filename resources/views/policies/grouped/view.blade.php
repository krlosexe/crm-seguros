<div class="card shadow mb-4 hidden" id="cuadro3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Polizas Agrupadas.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-view" enctype="multipart/form-data">
      
        @csrf

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Vinculados</a>
            </li>
        </ul>


        <div class="tab-content">
           <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1">
            
            <div class="row">
              <div class="col-md-12">
                <label for=""><b>Numero de Poliza*</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="number_policies" class="form-control form-control-user" id="number_policies_view" required>
                  </div>
              </div>
            </div>



            <div class="row">
            
              <div class="col-md-6">
                  <label for=""><b>Aseguradora*</b></label>
                    <div class="form-group valid-required">
                      <select name="insurers"  id="insurers_view" required>
                        <option value="">Seleccione</option>
                      </select>
                    </div>
                </div>


                <div class="col-md-6">
                  <label for=""><b>Ramo*</b></label>
                    <div class="form-group valid-required">
                      <select id="branch_view" required>
                        <option value="">Seleccione</option>
                      </select>
                    </div>
                </div>

                <input type="hidden" name="branch" id="branch_value_view">

            </div>



            <div class="row">
              <div class="col-md-6">
                <label for=""><b>Nombre Tomador*</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="name_taker" class="form-control form-control-user" id="name_taker_view" placeholder="Nombre Tomador" required>
                  </div>
              </div>

              <div class="col-md-6">
                <label for=""><b>Documento del Tomador*</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="identification_taker" class="form-control form-control-user" id="identification_taker_view" placeholder="Docuemnento Tomador" required>
                  </div>
              </div>
            </div>


            <div class="row">

              <div class="col-sm-3">
                <label for=""><b>Fecha inicio *</b></label>
                <input type="date" name="start_date" class="form-control form-control-user" id="start_date_view" required>
              </div>

              <div class="col-sm-3">
                <label for=""><b>Fecha Fin *</b></label>
                <input type="date" name="end_date" class="form-control form-control-user" id="end_date_view" required>
              </div>


              <div class="col-sm-3">
                <label for=""><b>Fecha Recepcion</b></label>
                <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date_view">
              </div>

              <div class="col-md-3">
                <label for="is_renewable"><b>Es renovable?</b><br></label><br>
                <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                      <input type="checkbox" name="is_renewable" id="is_renewable_view" checked="checked">
                      <label for="is_renewable"></label>
                </div>
              </div>
                
            </div>
            <br>

              <!---END ROW-->
            </div>




            <div role="tabpanel" class="tab-pane fade in" id="default-tab-2">

                <div class="embed-responsive embed-responsive-16by9">

                  <iframe class="embed-responsive-item " id="iframeView" allowfullscreen>

                  </iframe>

                </div>

            </div>
          </div>


        




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

