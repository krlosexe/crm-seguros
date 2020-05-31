<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Recaudos</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
          <div class="col-md-12" id="file-'+count+'">
              <div class="row">

                <div class="col-sm-6">
                  <label><b>Forma de pago *</b></label>
                  <select name="way_to_pay" id="way_to_pay_store" class="form-control" required="">
                    <option value="">SELECCIONE</option>
                    <option value="TARJETA DE CRÉDITO">TARJETA DE CRÉDITO</option>
                    <option value="TRANSFERENCIAS">TRANSFERENCIAS</option>
                    <option value="EFECTIVO">EFECTIVO</option>
                    <option value="CHEQUE">CHEQUE</option>
                    <option value="DEPOSITO">DEPÓSITO</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label for=""><b>Monto *</b></label>
                  <div class="form-group valid-required">
                    <input type="text" name="amount" id="amount_store" class="form-control form-control-user monto_formato_decimales" required>
                  </div>
                </div>

              </div>

              <br>

              <div class="row">

                <div class="col-md-6">
                  <label><b>Banco</b></label>
                  <input type="text" name="bank" class="form-control form-control-user" id="bank_store" required>
                </div>

                <div class="col-md-6">
                  <label><b>Fecha del pago*</b></label>
                  <input type="date" name="payment_date" class="form-control form-control-user" id="date_pay_store" required>
                </div>

              </div>

              <br>

              <div class="row">
                <div class="col-md-12 text-center">
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="input-file-store" name="file" type="file" required>
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
        <input type="hidden" name="id_charge_accounts" value="{{$id_charge}}">
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

