<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Sub Compañias</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
            <div class="col-md-6">
              <label for=""><b>Nombre</b></label>
              <div class="form-group valid-required">
                <input name="name" type="text" class="form-control" id="name">
              </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>NIT*</b></label>
              <div class="form-group valid-required">
                <input type="text" name="nit" class="form-control" id="nit" required>
              </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
              <label for=""><b>Tipo de Sub Compañia</b></label>
              <div class="form-group valid-required">
                <select name="type_sub_company" id="type_sub_company"></select>
              </div>
            </div>

            <div class="col-md-3">
              <label for="turn_check"><b>Girar Cheques a nombre de la subcia</b></label>
                <div class="checkbox"><input type="checkbox" name="turn_check" id="turn_check" value="1"><label for="turn_check"></label></div>
            </div>

            <div class="col-md-3">
              <label for=""><b>A nombre de :</b></label>
              <div class="form-group valid-required">
                <input type="text" name="to_name" class="form-control" id="to_name" disabled>
              </div>
            </div>
            
        </div>



        <div class="row">
            <div class="col-md-2">
              <label for="court_of_accounts"><b>Maneja corte de cuentas?</b></label>
              <div class="form-group valid-required">
                <div class="checkbox"><input type="checkbox" name="court_of_accounts" id="court_of_accounts" value="1"><label for="court_of_accounts"></label></div>
              </div>
            </div>

            <div class="col-md-2">
              <label for="ica"><b>Maneja Rte ICA en el corte?</b></label>
                <div class="checkbox"><input type="checkbox" name="ica" id="ica" value="1"><label for="ica"></label></div>
            </div>

            <div class="col-md-2">
              <label for="percentage_ica"><b>Porcentaje Rete ICA</b></label>
              <div class="form-group valid-required">
                <input type="number" name="percentage_ica" class="form-control" id="percentage_ica" disabled>
              </div>
            </div>
            
        </div>



        <!---END ROW-->
        <input type="hidden" name="id_surgerie" value="{{$id_surgerie}}">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
   
          <center>

            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro2')">
                Cancelar
            </button>
            <button id="send_usuario" type="submit" class="btn btn-success btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      
      </div>
 </div>

