<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Aseguradoras</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf



        <div class="row">
          
          <div class="col-md-6">

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
                          <input type="text" name="name" class="form-control form-control-user" id="name_edit" placeholder="Nombre" required>
                        </div>
                    </div>

                    <div class="col-md-6">

                      <label for=""><b>NIT *</b></label>
                        <div class="form-group valid-required">
                          <input type="text" name="nit" class="form-control form-control-user" id="nit_edit" placeholder="NIT" required>
                        </div>
                    </div>


                  </div>
                    <br>



                    <div class="row">

                      <div class="col-md-6">

                        <label for=""><b>Email </b></label>
                          <div class="form-group valid-required">
                            <input type="email" name="email" class="form-control form-control-user" id="email_edit" placeholder="Email">
                          </div>
                      </div>


                      <div class="col-md-6">
                        <label for=""><b>Telefono </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="phone" class="form-control form-control-user" id="phone_edit" placeholder="Telefono">
                          </div>
                      </div>



                      

                       <br>
                   </div>



                    <div class="row">

                      <div class="col-md-12">

                        <label for=""><b>Cuenta Bancaria </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="bank_account" class="form-control form-control-user" id="bank_account_edit" placeholder="Cuenta Bancaria">
                          </div>
                      </div>

                      <br>


                      <div class="col-md-12">
                        <label for=""><b>Direccion </b></label>
                          <div class="form-group valid-required">
                            <textarea class="form-control" name="address" id="address_edit" cols="30" rows="10"></textarea>
                          </div>
                      </div>


                   </div>

                  </div>
                </div>
              </div>
            </div>

          </div>




          <div class="col-md-6">


            <div class="row">
            
              <div class="col-md-12">
                
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ramos</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                            
                      <div class="col-md-8">
                        <label for=""><b>Ramos *</b></label>
                          <select id="branchs-edit">
                              <option value="" disabled selected>Select a person...</option>
                          </select>
                      </div>


                      <div class="col-md-4">
                        <label for=""><b><br></b></label>
                          <div class="form-group valid-required">
                          <button type="button"  class="btn btn-primary btn-user" id="add-branch-edit">
                              Agregar <i class="ei-addthis"></i>
                          </button>
                          </div>
                      </div>


                      <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Porcentaje de Comisión</th>
                                    <th>Porcentaje de IVA</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="table-branch-edit"></tbody>
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



        <input type="hidden" name="_method" value="put">
        
        
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
  </div>

