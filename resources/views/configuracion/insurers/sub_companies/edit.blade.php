<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Sub Compañias</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf

        <input type="hidden" name="_method" value="put">
        
		<div class="row">
            <div class="col-md-6">
              <label for=""><b>Nombre</b></label>
              <div class="form-group valid-required">
                <input name="name" type="text" class="form-control" id="name_edit">
              </div>
            </div>


            <div class="col-md-6">
              <label for=""><b>NIT*</b></label>
              <div class="form-group valid-required">
                <input type="text" name="nit" class="form-control" id="nit_edit" required>
              </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-6">
              <label for=""><b>Tipo de Sub Compañia</b></label>
              <div class="form-group valid-required">
                <select name="type_sub_company" id="type_sub_company_edit"></select>
              </div>
            </div>

            <div class="col-md-3">
              <label for="turn_check_edit"><b>Girar Cheques a nombre de la subcia</b></label>
                <div class="checkbox"><input type="checkbox" name="turn_check" id="turn_check_edit" value="1"><label for="turn_check_edit"></label></div>
            </div>

            <div class="col-md-3">
              <label for="to_name_edit"><b>A nombre de :</b></label>
              <div class="form-group valid-required">
                <input type="text" name="to_name" class="form-control" id="to_name_edit" disabled>
              </div>
            </div>
            
        </div>



        <div class="row">
            <div class="col-md-2">
              <label for="court_of_accounts_edit"><b>Maneja corte de cuentas?</b></label>
              <div class="form-group valid-required">
                <div class="checkbox"><input type="checkbox" name="court_of_accounts" id="court_of_accounts_edit" value="1"><label for="court_of_accounts_edit"></label></div>
              </div>
            </div>

            <div class="col-md-2">
              <label for="ica_edit"><b>Maneja Rte ICA en el corte?</b></label>
                <div class="checkbox"><input type="checkbox" name="ica" id="ica_edit" value="1"><label for="ica_edit"></label></div>
            </div>

            <div class="col-md-2">
              <label for="percentage_ica_edit"><b>Porcentaje Rete ICA</b></label>
              <div class="form-group valid-required">
                <input type="number" name="percentage_ica" class="form-control" id="percentage_ica_edit" disabled>
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

