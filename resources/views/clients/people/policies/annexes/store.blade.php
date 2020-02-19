<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Anexo</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
            <div class="col-md-6">
              <label for=""><b>NÚmero de Anexo*</b></label>
              <div class="form-group valid-required">
              <input name="number_annexed" type="text" class="form-control" id="number_annexed-store">
              </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>Estado*</b></label>
                <div class="form-group valid-required">
                  <select name="state"  class="form-control selectize-input items has-options full has-items" id="state-store" required>
                    <option value="">Seleccione</option>
                    <option value="Vigente">Vigente</option>
                  </select>
                </div>
            </div>
        </div>


        <div class="row">
     
            <div class="col-md-6">
              <label for=""><b>Riesgo (Placa, Dirección, etc)*</b></label>
                <div class="form-group valid-required">
                  <input type="text" name="risk" class="form-control form-control-user" id="risk-store" placeholder="Codigo Objeto Asegurado">
                </div>
            </div>


            <div class="col-md-3">
              <label for="is_renewable-store"><b>¿Es renovable?</b><br></label><br>
              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                    <input type="checkbox" name="is_renewable" id="is_renewable-store" checked="checked">
                    <label for="is_renewable-store"></label>
              </div>
            </div>

            <div class="col-md-3">
              <label for=""><b>Motivo*</b></label>
              <div class="form-group valid-required">
                <input name="reason" type="text" class="form-control" id="reason-store"  required>
              </div>
            </div>

        </div>



        <div class="row">

          <div class="col-sm-3">
            <label for=""><b>Fecha expedición*</b></label>
            <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date">
          </div>


          <div class="col-sm-3">
            <label for=""><b>Fecha inicio*</b></label>
            <input type="date" name="start_date" class="form-control form-control-user" id="start_date" required>
          </div>

          <div class="col-sm-3">
            <label for=""><b>Fecha Fin*</b></label>
            <input type="date" name="end_date" class="form-control form-control-user" id="end_date" required>
          </div>


          <div class="col-sm-3">
            <label for=""><b>Fecha Recepción*</b></label>
            <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date" required="">
          </div>

        </div>

        <br>
        <br>


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

          <div class="col-md-6">
            <label for=""><b>IVA</b></label>
              <div class="form-group valid-required">
                <input type="text" name="vat" class="form-control form-control-user" id="vat" readonly value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>% IVA Prima*</b></label>
              <div class="form-group valid-required">
                <input type="number" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin" value="0">
              </div>
          </div>



          <div class="col-md-6">
            <label for=""><b>Porcentaje Comisión</b></label>
              <div class="form-group valid-required">
                <input type="number" name="commission_percentage" class="form-control form-control-user" id="commission_percentage" value="0" style="text-align: right">
              </div>
          </div>


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





        <div class="row">

          <div class="col-md-4">
            <label for=""><b>Forma Pago</b></label>
              <div class="form-group valid-required">
                <select name="payment_method" class="form-control start_simulation selectized" id="payment_method" required>
                  <option value="">Seleccione</option>
                  <option value="Contado">Contado</option>
                  <option value="Financiado">Financiado</option>
                </select>
              </div>
          </div>

        </div>





        <div class="row">
          <div class="col-md-6">
            <label for=""><b>Observaciones</b></label>
              <div class="form-group valid-required">
                <textarea name="observations" class="form-control" id="observations" cols="30" rows="10"></textarea>
              </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Accesorios</b></label>
              <div class="form-group valid-required">
                <textarea name="accessories" class="form-control" id="accessories" cols="30" rows="10"></textarea>
              </div>
          </div>

        </div>

        <!---END ROW-->

        <input type="hidden" name="id_policie" value="{{$id_policies}}">
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

