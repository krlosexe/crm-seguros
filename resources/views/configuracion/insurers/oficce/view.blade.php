<div class="card shadow mb-4 hidden" id="cuadro3">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Oficinas.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
            <div class="col-md-3">
              <label for=""><b>Nombre</b></label>
              <div class="form-group valid-required">
                <input name="name" type="text" class="form-control" id="name_view">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Teléfono Oficina</b></label>
              <div class="form-group valid-required">
                <input name="phone" type="text" class="form-control" id="phone_view">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Fax</b></label>
              <div class="form-group valid-required">
                <input name="fax" type="text" class="form-control" id="fax_view">
              </div>
            </div>

            <div class="col-md-3">
              <label for="headquarters_default"><b>¿Es la sede por defecto?</b></label>
                <div class="checkbox"><input type="checkbox" name="headquarters_default" id="headquarters_default_view" value="1"><label for="headquarters_default"></label></div>
            </div>


        </div>


        <div class="row">
            <div class="col-md-3">
              <label for=""><b>Nombre del contacto</b></label>
              <div class="form-group valid-required">
                <input name="name_contact" type="text" class="form-control" id="name_contact_view">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Teléfono del contacto</b></label>
              <div class="form-group valid-required">
                <input name="phone_contact" type="text" class="form-control" id="phone_contact_view">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Email del contacto</b></label>
              <div class="form-group valid-required">
                <input name="email_contact" type="text" class="form-control" id="email_contact_view">
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

