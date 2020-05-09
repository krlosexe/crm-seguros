<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Cuenta Cobro</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf


        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-edit" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
        </ul>

       <br><br>

       <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-edit">
            <input type="hidden" name="_method" value="put">
        
              <div class="row">
                
                <div class="col-md-6">

                  <div class="row">

                    <div class="col-md-6">
                      <label for=""><b>¿Póliza o Anexo?</b></label>
                        <div class="form-group valid-required">
                          <select name="policie_annexes" class="form-control start_simulation selectized" id="policie_annexes-edit" required>
                            <option value="">Seleccione</option>
                            <option value="Poliza">Poliza</option>
                            <option value="Anexo">Anexo</option>
                          </select>
                        </div>
                    </div>

                      <div class="col-md-6">
                        <label for=""><b>Número*</b></label>
                          <div class="form-group valid-required">
                            <select name="number" id="number-edit" class="form-control" required>
                              <option value="">Seleccione</option>
                            </select>
                          </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-6">
                      <label for=""><b>Fecha inicio</b></label>
                      <input type="date" name="init_date" class="form-control form-control-user" id="init_date-edit">
                    </div>

                    <div class="col-sm-6">
                      <label for=""><b>Fecha Limite *</b></label>
                      <input type="date" name="limit_date" class="form-control form-control-user" id="limit_date-edit" required>
                    </div>
                  </div>


                  <br><br>


                  <div class="row">
                    <div class="col-sm-12">
                      <label for=""><b>Asunto</b></label>
                      <input type="text" name="issue" class="form-control form-control-user" id="issue-edit">
                    </div>

                    <br> <br>
                    <div class="col-md-12">
                      <label for=""><b>Observaciones</b></label>
                        <div class="form-group valid-required">
                          <textarea name="observations" class="form-control" id="observations-edit" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                  </div>

                </div>

                <div class="col-md-6">
                    <div class="row">
                      <div class="col-md-6">
                        <label for=""><b>Prima *</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales" id="cousin-edit" required value="0" style="text-align: right">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales" id="xpenses-edit" value="0" style="text-align: right">
                          </div>
                      </div>
                  </div>
              
                  <br>

                  <div class="row">
                      <div class="col-md-6">
                        <label for=""><b>IVA</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="vat" class="form-control form-control-user" id="vat-edit" readonly value="0" style="text-align: right">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>% IVA Prima*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin-edit">
                          </div>
                      </div>
                  </div>
              
                <br>

                  <div class="row">
                      <div class="col-md-6 row-participacion">
                        <label for=""><b>Porcentaje Comisión</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="commission_percentage" class="form-control form-control-user" id="commission_percentage-edit" value="100" readonly style="text-align: right">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Participación</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="participation" class="form-control form-control-user" id="participation-edit" value="100">
                          </div>
                      </div>
  
                      <div class="col-md-6 row-participacion">
                        <label for=""><b>Comisión agencia</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission-edit" readonly value="0" style="text-align: right">
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Total</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="total" class="form-control form-control-user" id="total-edit" readonly value="0" style="text-align: right">
                          </div>
                      </div>
                  </div>
                
                </div>


            </div>
            <br>
            <br>

            <!---END ROW-->
          </div>

          <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-edit">


              <div class="embed-responsive embed-responsive-16by9">

                <iframe class="embed-responsive-item " id="iframeDigitalesEdit" allowfullscreen>
                  
                </iframe>

              </div>
            </div>
       </div>
        

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

            <a href="/policies/wallet/pdf" id="btn-print" target="_blanck" class="btn btn-danger btn-user" >
              <i class="ti-printer"></i>
                Imprimir
            </a>

            

          </center>
          <br>
          <br>
      </form>
      
    </div>

