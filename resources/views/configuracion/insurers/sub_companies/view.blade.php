<div class="card shadow mb-4 hidden" id="cuadro3">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Sub Compañias.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" enctype="multipart/form-data">
      
        @csrf

		<div class="row">
            <div class="col-md-6">
              <label for=""><b>Nombre</b></label>
              <div class="form-group valid-required">
                <input name="name" type="text" class="form-control" id="name_view">
              </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>NIT*</b></label>
              <div class="form-group valid-required">
                <input type="text" name="nit" class="form-control" id="nit_view" required>
              </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
              <label for=""><b>Tipo de Sub Compañia</b></label>
              <div class="form-group valid-required">
                <select name="type_sub_company" id="type_sub_company_view"></select>
              </div>
            </div>

            <div class="col-md-3">
              <label for="turn_check_view"><b>Girar Cheques a nombre de la subcia</b></label>
                <div class="checkbox"><input type="checkbox" name="turn_check" id="turn_check_view" value="1"><label for="turn_check_view"></label></div>
            </div>

            <div class="col-md-3">
              <label for="to_name_view"><b>A nombre de :</b></label>
              <div class="form-group valid-required">
                <input type="text" name="to_name" class="form-control" id="to_name_view" disabled>
              </div>
            </div>
            
        </div>



        <div class="row">
            <div class="col-md-2">
              <label for="court_of_accounts_view"><b>Maneja corte de cuentas?</b></label>
              <div class="form-group valid-required">
                <div class="checkbox"><input type="checkbox" name="court_of_accounts" id="court_of_accounts_view" value="1"><label for="court_of_accounts_view"></label></div>
              </div>
            </div>

            <div class="col-md-2">
              <label for="ica_view"><b>Maneja Rte ICA en el corte?</b></label>
                <div class="checkbox"><input type="checkbox" name="ica" id="ica_view" value="1"><label for="ica_view"></label></div>
            </div>

            <div class="col-md-2">
              <label for="percentage_ica_view"><b>Porcentaje Rete ICA</b></label>
              <div class="form-group valid-required">
                <input type="number" name="percentage_ica" class="form-control" id="percentage_ica_view" disabled>
              </div>
            </div>
            
        </div>

        <!---END ROW-->

        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
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

