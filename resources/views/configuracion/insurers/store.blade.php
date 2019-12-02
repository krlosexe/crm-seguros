<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Aseguradoras</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf


        <div class="row">
          
          <div class="col-md-12">

            <div class="row">

              <div class="col-md-12">

                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Datos Principales</h6>
                  </div>
                  <div class="card-body">

                  <div class="row">

                    <div class="col-md-6">

                      <label for=""><b>Nombre *</b></label>
                        <div class="form-group valid-required">
                          <input type="text" name="name" class="form-control form-control-user" id="name" placeholder="Nombre" required>
                        </div>
                    </div>

                    <div class="col-md-6">

                      <label for=""><b>NIT *</b></label>
                        <div class="form-group valid-required">
                          <input type="text" name="nit" class="form-control form-control-user" id="nit" placeholder="NIT" required>
                        </div>
                    </div>


                  </div>
                    <br>



                    <div class="row">

                      <div class="col-md-6">

                        <label for=""><b>Email </b></label>
                          <div class="form-group valid-required">
                            <input type="email" name="email" class="form-control form-control-user" id="email" placeholder="Email">
                          </div>
                      </div>

                      <div class="col-md-6">

                        <label for=""><b>Direccion </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="address" class="form-control form-control-user" id="address" placeholder="Direccion">
                          </div>
                      </div>

                       <br>
                   </div>



                    <div class="row">

                      <div class="col-md-6">

                        <label for=""><b>Telefono </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="phone" class="form-control form-control-user" id="phone" placeholder="Telefono">
                          </div>
                      </div>

                      <div class="col-md-6">

                        <label for=""><b>Cuenta Bancaria </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="bank_account" class="form-control form-control-user" id="bank_account" placeholder="Cuenta Bancaria">
                          </div>
                      </div>





                      <div class="col-md-4">
                          <label for=""><b>Aseguradora*</b></label>
                            <div class="form-group valid-required">
                            <select id="selectize-tags-1" name="person" multiple class="item-info">
                              <option value="" disabled selected>Select a person...</option>
                              <option value="1">Adam</option>
                              <option value="2" selected>Amalie</option>
                              <option value="3">Estefanía</option>
                              <option value="4">Adrian</option>
                              <option value="5">Wladimir</option>
                              <option value="6">Samantha</option>
                              <option value="7">Nicole</option>
                              <option value="8" selected>Michael</option>
                          </select>
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

        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
        </div>
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

