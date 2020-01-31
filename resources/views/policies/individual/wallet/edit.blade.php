<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Cuenta Cobro</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf

        <input type="hidden" name="_method" value="put">
        
		<div class="row">
            <div class="col-md-6">
              <label for=""><b>Numero</b></label>
              <div class="form-group valid-required">
              <input name="number_annexed" type="text" class="form-control" id="number_annexed_edit">
              </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>Estado*</b></label>
                <div class="form-group valid-required">
                  <select name="state"  class="form-control selectize-input items has-options full has-items" id="state_edit" required>
                    <option value="">Seleccione</option>
                    <option value="Vigente">Vigente</option>
                  </select>
                </div>
            </div>
        </div>


        <div class="row">
     
            <div class="col-md-6">
              <label for=""><b>Riesgo (Placa, Direccion, etc)*</b></label>
                <div class="form-group valid-required">
                  <input type="text" name="risk" class="form-control form-control-user" id="risk_edit" placeholder="Codigo Objeto Asegurado">
                </div>
            </div>


            <div class="col-md-3">
              <label for="is_renewable_edit"><b>Es renovable?</b><br></label><br>
              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                    <input type="checkbox" name="is_renewable" id="is_renewable_edit" checked="checked">
                    <label for="is_renewable_edit"></label>
              </div>
            </div>

            <div class="col-md-3">
              <label for=""><b>Motivo*</b></label>
              <div class="form-group valid-required">
                <input name="reason" type="text" class="form-control" id="reason_edit"  required>
              </div>
            </div>

        </div>



        <div class="row">

          <div class="col-sm-3">
            <label for=""><b>Fecha expedicion</b></label>
            <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date_edit">
          </div>


          <div class="col-sm-3">
            <label for=""><b>Fecha inicio *</b></label>
            <input type="date" name="start_date" class="form-control form-control-user" id="start_date_edit" required>
          </div>

          <div class="col-sm-3">
            <label for=""><b>Fecha Fin *</b></label>
            <input type="date" name="end_date" class="form-control form-control-user" id="end_date_edit" required>
          </div>


          <div class="col-sm-3">
            <label for=""><b>Fecha Recepcion</b></label>
            <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date_edit">
          </div>

        </div>

        <br>
        <br>


        <div class="row">

          <div class="col-md-6">
            <label for=""><b>Prima *</b></label>
              <div class="form-group valid-required">
                <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales" id="cousin_edit" required value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
              <div class="form-group valid-required">
                <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales" id="xpenses_edit" value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>IVA</b></label>
              <div class="form-group valid-required">
                <input type="text" name="vat" class="form-control form-control-user" id="vat_edit" readonly value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>% IVA Prima*</b></label>
              <div class="form-group valid-required">
                <input type="number" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin_edit" value="0">
              </div>
          </div>



          <div class="col-md-6">
            <label for=""><b>Porcentaje Comisión</b></label>
              <div class="form-group valid-required">
                <input type="number" name="commission_percentage" class="form-control form-control-user" id="commission_percentage_edit" value="0" style="text-align: right">
              </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Comisión agencia</b></label>
              <div class="form-group valid-required">
                <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission_edit" readonly value="0" style="text-align: right">
              </div>
          </div>



            <div class="col-md-6">
              <label for=""><b>Total</b></label>
                <div class="form-group valid-required">
                  <input type="text" name="total" class="form-control form-control-user" id="total_edit" readonly value="0" style="text-align: right">
                </div>
            </div>


        </div>





        <div class="row">

          <div class="col-md-4">
            <label for=""><b>Forma Pago</b></label>
              <div class="form-group valid-required">
                <select name="payment_method" class="form-control start_simulation selectized" id="payment_method_edit" required>
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
                <textarea name="observations" class="form-control" id="observations_edit" cols="30" rows="10"></textarea>
              </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Accesorios</b></label>
              <div class="form-group valid-required">
                <textarea name="accessories" class="form-control" id="accessories_edit" cols="30" rows="10"></textarea>
              </div>
          </div>

        </div>

        <!---END ROW-->

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

          </center>
          <br>
          <br>
      </form>
      
    </div>

