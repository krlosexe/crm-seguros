<div class="card shadow mb-4 hidden" id="cuadro6" >

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Cuenta Cobro</h6>
  </div>
  <div class="card-body ">
      <form class="user" autocomplete="off" method="post" id="edit-multiple" enctype="multipart/form-data">

        @csrf

        <div class="row">
        
          <div class="col-md-12">

            <div class="row">

              <div class="col-md-3">
                {{-- <label for=""><b>¿Póliza o Anexo ?</b></label> --}}
                <label for=""><b>Póliza</b></label>
                  <div class="form-group valid-required">
                    <select name="policie_annexes" class="form-control start_simulation selectized" id="policie_annexes-multiple-edit" required>
                      <option value="">Seleccione</option>
                      <option value="Poliza">Poliza</option>
                      <option value="Anexo">Anexo</option>
                    </select>
                  </div>
              </div>

                <div class="col-md-3">
                  <label for=""><b>Número*</b></label>
                    <div class="form-group valid-required">
                      <select name="number0" class="multiselect" id="number-multiple-edit" multiple required>
                      </select>
                    </div>
                </div>

              <div class="col-sm-3">
                <label for=""><b>Fecha inico</b></label>
                <input type="date" name="init_date" class="form-control form-control-user" id="init_date-multiple-edit">
              </div>

              <div class="col-sm-3">
                <label for=""><b>Fecha Limite *</b></label>
                <input type="date" name="limit_date" class="form-control form-control-user" id="limit_date-multiple-edit" required>
              </div>
            </div>

            <br><br>

            <table class="table table-bordered table-striped number-multiple-edit" id="table_multiple_poliza">
              <thead>
                <th width="10%">Prima *</th>
                <th width="28%">Gastos (Expedición,Runt,Fosyga) *</th>
                <th width="6%">IVA</th>
                <th width="11%">% IVA Prima*</th>
                <th class="row-participacion" width="15%">Porcentaje Comisión</th>
                <th width="11%">Participación</th>
                <th class="row-participacion" width="12%">Comisión agencia</th>
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
                  <input type="text" name="issue" class="form-control form-control-user" id="issue-multiple-edit">
              </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-12">
                <label for=""><b>Pie de Página</b></label>
                  <div class="form-group valid-required">
                    <textarea class="form-control" name="observations" id="footer-multiple-edit" cols="30" rows="10"></textarea>
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
        <input type="hidden" name="type_client" value="{{$type_client}}">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="id_user_edit" id="id_edit">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
   
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro6')">
                Cancelar
            </button>
            <button type="submit" id="submit-registrar-multiple-edit" class="btn btn-success btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      


      </div>
 </div>

