<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Cartera</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf
        
        <div class="row">
          
          <div class="col-md-5">

            <div class="row">

              <div class="col-md-12">

                <div class="card shadow mb-4">

                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informacion del Pago</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                        <label class="col-sm-3"><b>Forma de pago</b></label>
                        <div class="col-sm-9 focused">
                          <select name="way_to_pay" id="way_to_pay" class="form-control" required="">
                            <option value="">SELECCIONE</option>
                            <option value="TRAJETA DE CRÉDITO">TRAJETA DE CRÉDITO</option>
                            <option value="TRANSFERENCIAS">TRANSFERENCIAS</option>
                            <option value="EFECTIVO">EFECTIVO</option>
                            <option value="CHEQUE">CHEQUE</option>
                            <option value="DEPOSITO">DEPOSITO</option>
                          </select>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="col-sm-3"><b>Banco</b></label>
                        <div class="col-sm-9 focused">
                          <input type="text" name="bank" class="form-control form-control-user" id="bank" >
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        
                        <div class="col-sm-6">
                          <label><b>Fecha del pago*</b></label>
                          <input type="date" name="payment_date" class="form-control form-control-user" id="date_pay" required>
                        </div>

                        <div class="col-sm-6">
                          <label><b>Monto del pago</b></label>
                          <input type="text" name="payment" class="form-control form-control-user monto_formato_decimales" id="amount_pay" style="text-align: right">
                        </div>

                    </div>
                    <br>


                    <div class="row">
                        <label class="col-sm-6"><b>Saldo Pendiente de la cuota</b></label>
                        <div class="col-sm-6 focused">
                          <input type="text" class="form-control form-control-user" id="balance_fee_cuota" style="text-align: right" readonly>
                        </div>
                    </div>
                    <br>


                    <div class="row">
                        <label class="col-sm-6"><b>Saldo total pendiente</b></label>
                        <div class="col-sm-6 focused">
                          <input type="text" class="form-control form-control-user" id="balance_total_pending" style="text-align: right" readonly>
                        </div>
                    </div>
                    <br>


                    <center>

                      <button type="button"   class="btn btn-danger btn-user" onclick="prev('#cuadro4')">
                          Cancelar
                      </button>

                    </center>
                    <br>
                    <br>



                  </div>
                </div>
              </div>

            </div>

          </div>



          <div class="col-md-7">

            <div class="row">

              <div class="col-md-12">

                <div class="card shadow mb-4">

                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Estado de Cuenta</h6>
                  </div>
                  <div class="card-body">

                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-bordered" id="table-status-account" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th></th>
                                <th>Numero de Cuota</th>
                                <th>Tipo</th>
                                <th>Fecha de Movimiento</th>
                                <th>Cargo</th>
                                <th>Abono</th>
                                <th>Saldo</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                          </table>

                        </div>
                      </div>
                      <br>
                      
                  </div>
                </div>
              </div>

            </div>

          </div>


        </div>

        <!---END ROW-->
        <input type="hidden" name="id_policie"     id="id_policie">
        <input type="hidden" name="id_recibos_cobranza" id="id_recibos_cobranza">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">

          <br>
          <br>
    </div>
         
      </form>
      
    </div>

