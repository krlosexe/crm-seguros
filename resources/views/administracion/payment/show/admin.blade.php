  <div class="card shadow mb-4 hidden" id="cuadro4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Consultar Cuenta Cobro</h6>
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
                <div class="card-body ">

                      <div class="row">
                      
                        <div class="col-md-12">

                          <div class="row">

                            <div class="col-md-3">
                              {{-- <label for=""><b>¿Póliza o Anexo ?</b></label> --}}
                              <label for=""><b>Póliza</b></label>
                                <div class="form-group valid-required">
                                  <select name="policie_annexes" class="form-control start_simulation selectized" id="policie_annexes-multiple-view" required>
                                    <option value="">Seleccione</option>
                                    <option value="Poliza">Poliza</option>
                                  </select>
                                </div>
                            </div>

                              <div class="col-md-3">
                                <label for=""><b>Número*</b></label>
                                  <div class="form-group valid-required">
                                    <select name="number0" class="multiselect" id="number-multiple-view" multiple required>
                                    </select>
                                  </div>
                              </div>

                            <div class="col-sm-3">
                              <label for=""><b>Fecha inico</b></label>
                              <input type="date" name="init_date" class="form-control form-control-user" id="init_date-multiple-view">
                            </div>

                            <div class="col-sm-3">
                              <label for=""><b>Fecha Limite *</b></label>
                              <input type="date" name="limit_date" class="form-control form-control-user" id="limit_date-multiple-view" required>
                            </div>
                          </div>

                          <br><br>

                          <table class="table table-bordered table-striped number-multiple-view" id="table_multiple_poliza">
                            <thead>
                              <th width="10%">Prima *</th>
                              <th width="28%">Gastos (Expedición,Runt,Fosyga) *</th>
                              <th width="6%">IVA</th>
                              <th width="11%">% IVA Prima*</th>
                              <th width="15%">Porcentaje Comisión</th>
                              <th width="11%">Participación</th>
                              <th width="12%">Comisión agencia</th>
                              <th width="6%">Total</th>
                            </thead>
                            <tbody>
                              <tr>
                                <td colspan="8" class="text-center">Sin datos</td>
                              </tr>
                            </tbody>
                          </table>

                          <br><br>


                          <div class="row">
                            <div class="col-sm-12">
                                <label for=""><b>Asunto</b></label>
                                <input type="text" name="issue" class="form-control form-control-user" id="issue-multiple-view">
                            </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-12">
                              <label for=""><b>Pie de Página</b></label>
                                <div class="form-group valid-required">
                                  <textarea class="form-control" name="observations" id="footer-multiple-view" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                          </div>


                        </div>


                      </div>
                      <br>
                    

                 </div>
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


              <a href="/policies/wallet/pdf" id="btn-print" target="_blanck" class="btn btn-danger btn-user" >
                <i class="ti-printer"></i>
                  Imprimir
              </a>

              

            </center>
            <br>
            <br>
        </form>
        
      </div>


