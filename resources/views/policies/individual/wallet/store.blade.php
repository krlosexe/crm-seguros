<div class="card shadow mb-4 hidden" id="cuadro2" >

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Cuenta Cobro</h6>
  </div>
  <div class="card-body ">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
        
          <div class="col-md-6">

            <div class="row">

              <div class="col-md-6">
                <label for=""><b>¿Póliza o Anexo ?</b></label>
                  <div class="form-group valid-required">
                    <select name="policie_annexes" class="form-control start_simulation selectized" id="policie_annexes-store" required>
                      <option value="">Seleccione</option>
                      <option value="Poliza">Poliza</option>
                      <option value="Anexo">Anexo</option>
                    </select>
                  </div>
              </div>

                <div class="col-md-6">
                  <label for=""><b>Número*</b></label>
                    <div class="form-group valid-required">
                      <select name="number" id="number-store" class="form-control" required>
                        <option value="">Seleccione</option>
                      </select>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <label for=""><b>Fecha inico</b></label>
                <input type="date" name="init_date" class="form-control form-control-user" id="init_date-store">
              </div>

              <div class="col-sm-6">
                <label for=""><b>Fecha Limite *</b></label>
                <input type="date" name="limit_date" class="form-control form-control-user" id="limit_date-store" required>
              </div>
            </div>


            <br><br>


            <div class="row">
              <div class="col-sm-12">
                  <label for=""><b>Asunto</b></label>
                  <input type="text" name="issue" class="form-control form-control-user" id="issue-store">
              </div>
            </div>

            <br><br>

            <div class="row">
              <div class="col-sm-12">
                <button type="button" id="add-pie" class="btn btn-success" data-toggle="default-modal" data-target="default-modal">Añadir nuevo</button>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label for=""><b>Pie de Página</b></label>
                  <div class="form-group valid-required">
                    <textarea class="form-control" name="observations" id="footer-store" cols="30" rows="10"></textarea>
                  </div>
              </div>
            </div>


          </div>

          <div class="col-md-6">
              <div class="row">
                <div class="col-md-6">
                  <label for=""><b>Prima *</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales" id="cousin" required value="0" style="text-align: right">
                    </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales" id="xpenses" value="0" style="text-align: right">
                    </div>
                </div>
            </div>
        
            <br>

            <div class="row">
                <div class="col-md-6">
                  <label for=""><b>IVA</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="vat" class="form-control form-control-user" id="vat" readonly value="0" style="text-align: right">
                    </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>% IVA Prima*</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin">
                    </div>
                </div>
            </div>
        
           <br>

            <div class="row row-participacion">
                <div class="col-md-6">
                  <label for=""><b>Porcentaje Comisión</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="commission_percentage" class="form-control form-control-user" id="commission_percentage" value="100" readonly style="text-align: right">
                    </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Participación</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="participation" class="form-control form-control-user" id="participation" value="100">
                    </div>
                </div>
            </div>
        
            <br>


            <div class="row">
                <div class="col-md-6">
                  <label for=""><b>Comisión agencia</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission" readonly value="0" style="text-align: right">
                    </div>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Total</b></label>
                    <div class="form-group valid-required">
                      <input type="text" name="total" class="form-control form-control-user" id="total" readonly value="0" style="text-align: right">
                    </div>
                </div>
            </div>
          
          </div>


        </div>
        <br>
        <br>

        <!---END ROW-->

        <input type="hidden" name="id_policie" value="{{$id_policie}}">
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



                      <div class="text-right">
                        <button type="button" id="btn-delete-pie" data-dismiss="modal" class="btn btn-danger btn-delete-pie" disabled>Borrar</button>
                      </div>




                  </div>
                </div>
              </div>
            </div>
        


      </div>
 </div>

