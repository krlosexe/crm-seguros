<div class="card shadow mb-4 hidden" id="cuadro5" >

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Cuenta Cobro</h6>
  </div>
  <div class="card-body ">
      <form class="user" autocomplete="off" method="post" id="store-multiple" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
        
          <div class="col-md-12">

            <div class="row">

              <div class="col-md-3">
                {{-- <label for=""><b>¿Póliza o Anexo ?</b></label> --}}
                <label for=""><b>Póliza</b></label>
                  <div class="form-group valid-required">
                    <select name="policie_annexes" class="form-control start_simulation selectized" id="policie_annexes-multiple" required>
                      <option value="">Seleccione</option>
                      <option value="Poliza">Poliza</option>
                    </select>
                  </div>
              </div>

                <div class="col-md-3">
                  <label for=""><b>Número*</b></label>
                    <div class="form-group valid-required">
                      <select name="number0" class="multiselect" id="number-multiple" multiple required>
                      </select>
                    </div>
                </div>

              <div class="col-sm-3">
                <label for=""><b>Fecha inico</b></label>
                <input type="date" name="init_date" class="form-control form-control-user" id="init_date-multiple">
              </div>

              <div class="col-sm-3">
                <label for=""><b>Fecha Limite *</b></label>
                <input type="date" name="limit_date" class="form-control form-control-user" id="limit_date-multiple" required>
              </div>
            </div>

            <br><br>

            <table class="table table-bordered table-striped" id="table_multiple_poliza">
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
                  <input type="text" name="issue" class="form-control form-control-user" id="issue-multiple">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <label for=""><b>Pie de Página</b></label>
                  <div class="form-group valid-required">
                    <textarea class="form-control" name="observations" id="footer-multiple" cols="30" rows="10"></textarea>
                  </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <button type="button" id="add-pie" class="btn btn-success" data-toggle="default-modal" data-target="default-modal">Añadir nuevo</button>
              </div>
            </div>


          </div>


        </div>
        <br>
        <br>

        <!---END ROW-->

        <input type="hidden" name="id_client" value="{{$id_client}}">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
   
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro5')">
                Cancelar
            </button>
            <button type="submit" id="submit-registrar-multiple" class="btn btn-success btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" id="default-modal" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <div class="modal-header">
                <h4>Pie de página</h4></div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-8">
                        <label for=""><b>Seleccione</b></label>
                        <select name="" id="footers" class="form-control">
                          <option value="">Seleccione</option>
                        </select>
                      </div>

                      <div class="col-md-4">
                        <button type="button" id="new-pie" class="btn btn-success">Nuevo</button>
                      </div>
                    </div>
                    


                    <div id="content-pie" class="remove-pie" style="display:none">
                      <div class="row">
                        <div class="col-md-12">
                        <label for=""><b>Nombre</b></label>
                          <div class="form-group valid-required">
                          <input type="text" name="issue" class="form-control form-control-user" id="name-footer">
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                        <label for=""><b>Contenido</b></label>
                          <div class="form-group valid-required">
                            <textarea class="form-control" name="" id="content-footer" cols="30" rows="10"></textarea>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="modal-footer no-border">
                      <div class="text-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn-save-pie" class="btn btn-success btn-save-pie" disabled>Guardar</button>
                      </div>


                      <div class="text-right">
                        <button type="button" id="btn-select-pie" data-dismiss="modal" class="btn btn-success btn-save-pie" disabled>Seleccionar</button>
                      </div>


                  </div>
                </div>
              </div>
            </div>

      </div>
 </div>

