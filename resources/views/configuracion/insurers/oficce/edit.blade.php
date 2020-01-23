<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Oficinas</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf

        <input type="hidden" name="_method" value="put">
        
        <div class="row">
            <div class="col-md-3">
              <label for=""><b>Nombre</b></label>
              <div class="form-group valid-required">
                <input name="name" type="text" class="form-control" id="name_edit">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Telefono Oficina</b></label>
              <div class="form-group valid-required">
                <input name="phone" type="text" class="form-control" id="phone_edit">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Fax</b></label>
              <div class="form-group valid-required">
                <input name="fax" type="text" class="form-control" id="fax_edit">
              </div>
            </div>

            <div class="col-md-3">
              <label for="headquarters_default_edit"><b>Es la cede por defecto ?</b></label>
                <div class="checkbox"><input type="checkbox" name="headquarters_default" id="headquarters_default_edit" value="1"><label for="headquarters_default_edit"></label></div>
            </div>


        </div>


        <div class="row">
            <div class="col-md-3">
              <label for=""><b>Nombre del contacto</b></label>
              <div class="form-group valid-required">
                <input name="name_contact" type="text" class="form-control" id="name_contact_edit">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Telefono del contacto</b></label>
              <div class="form-group valid-required">
                <input name="phone_contact" type="text" class="form-control" id="phone_contact_edit">
              </div>
            </div>


            <div class="col-md-3">
              <label for=""><b>Email del contacto</b></label>
              <div class="form-group valid-required">
                <input name="email_contact" type="text" class="form-control" id="email_contact_edit">
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

