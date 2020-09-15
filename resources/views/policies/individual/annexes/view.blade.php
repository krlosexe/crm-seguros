<div class="card shadow mb-4 hidden" id="cuadro3">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de vinculados.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" enctype="multipart/form-data">
      
        @csrf
        
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-view" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2-view" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>
        </ul>

    <div class="tab-content">
      <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-view">
        <br>

		    <div class="row">
            <div class="col-md-6">
              <label for=""><b>Numero</b></label>
              <div class="form-group valid-required">
              <input name="number_annexed" type="text" class="form-control" id="number_annexed_view">
              </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>Estado*</b></label>
                <div class="form-group valid-required">
                  <select name="state"  class="form-control selectize-input items has-options full has-items" id="state_view" required>
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
                  <input type="text" name="risk" class="form-control form-control-user" id="risk_view" placeholder="Codigo Objeto Asegurado">
                </div>
            </div>


            <div class="col-md-3">
              <label for="is_renewable_view"><b>Es renovable?</b><br></label><br>
              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                    <input type="checkbox" name="is_renewable" id="is_renewable_view" checked="checked">
                    <label for="is_renewable"></label>
              </div>
            </div>

            <div class="col-md-3">
              <label for=""><b>Motivo*</b></label>
              <div class="form-group valid-required">
                <input name="reason" type="text" class="form-control" id="reason_view"  required>
              </div>
            </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            <label for="">Descripción Motivo</label>

            <textarea style="height: 120px !important" class="form-control" rows="1"  name="reason_description" id="reason_description_view"></textarea>
          </div>
        </div>

<br>

        <div class="row row-municipio-hide">

          <div class="col-sm-3">
            <label for=""><b>Fecha expedicion</b></label>
            <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date_view">
          </div>


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

        </div>

        <br>
        <br>


        <div class="row row-municipio-hide">

          <div class="col-md-6">
            <label for=""><b>Prima *</b></label>
              <div class="form-group valid-required">
                <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales_annexes" id="cousin_view" required value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
              <div class="form-group valid-required">
                <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales_annexes" id="xpenses_view" value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>IVA</b></label>
              <div class="form-group valid-required">
                <input type="text" name="vat" class="form-control form-control-user" id="vat_view" readonly value="0" style="text-align: right">
              </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>% IVA Prima*</b></label>
              <div class="form-group valid-required">
                <input type="number" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin_view" value="0">
              </div>
          </div>



          <div class="col-md-6">
            <label for=""><b>Porcentaje Comisión</b></label>
              <div class="form-group valid-required">
                <input type="number" name="commission_percentage" class="form-control form-control-user" id="commission_percentage_view" value="0" style="text-align: right">
              </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Comisión agencia</b></label>
              <div class="form-group valid-required">
                <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission_view" readonly value="0" style="text-align: right">
              </div>
          </div>



            <div class="col-md-6">
              <label for=""><b>Total</b></label>
                <div class="form-group valid-required">
                  <input type="text" name="total" class="form-control form-control-user" id="total_view" readonly value="0" style="text-align: right">
                </div>
            </div>


        </div>





        <div class="row row-municipio-hide">

          <div class="col-md-4">
            <label for=""><b>Forma Pago</b></label>
              <div class="form-group valid-required">
                <select name="payment_method" class="form-control start_simulation selectized" id="payment_method_view" required>
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
                <textarea name="observations" class="form-control" id="observations_view" cols="30" rows="10"></textarea>
              </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Accesorios</b></label>
              <div class="form-group valid-required">
                <textarea name="accessories" class="form-control" id="accessories_view" cols="30" rows="10"></textarea>
              </div>
          </div>

        </div>


        <!---END ROW-->


        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
       </div>
        <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-view">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item " id="iframeView" allowfullscreen>

              </iframe>
            </div>
        </div>
    </div>
          <br>
          <br>
   
          <center>
            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro3')">
                Cancelar
            </button>
          </center>
          <br>
          <br>
      </form>
      
    </div>
  </div>

