<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Aseguradoras</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
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
                        <label for=""><b>Código *</b></label>
                          <div class="form-group valid-required">
                            <input type="number" name="code" class="form-control form-control-user" id="code" placeholder="Codigo" required>
                          </div>
                        </div>
                        <div class="col-md-6">
                        <label for=""><b>Link Citas</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="link_cita" class="form-control form-control-user" id="link" placeholder="link citas">
                          </div>
                        </div>

                    </div>

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
                        <label for=""><b>Teléfono </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="phone" class="form-control form-control-user" id="phone" placeholder="Telefono">
                          </div>
                      </div>



                      

                       <br>
                   </div>



                    <div class="row">
                      <div class="col-md-8">
                        <label for=""><b>Cuenta Bancaria </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="bank_account" class="form-control form-control-user" id="bank_account" placeholder="Cuenta Bancaria">
                          </div>
                      </div>

                      <div class="col-md-4">
                        <label for=""><b>Código del Asesor </b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="code_adviser" class="form-control form-control-user" id="code_adviser" placeholder="Codigo del Asesor">
                          </div>
                      </div>


                      <br>
                   </div>


                   <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Dirección </b></label>
                          <div class="form-group valid-required">
                            <textarea class="form-control" name="address" id="address" cols="30" rows="10"></textarea>
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
                          <select id="branchs">
                              <option value="" disabled selected>Selecciona un ramo...</option>
                          </select>
                      </div>


                      <div class="col-md-4">
                        <label for=""><b><br></b></label>
                          <div class="form-group valid-required">
                          <button type="button"  class="btn btn-primary btn-user" id="add-branch">
                              Agregar <i class="ei-addthis"></i>
                          </button>
                          </div>
                      </div>


                      <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Porcentaje de Comisión</th>
                                    <th>Porcentaje de IVA</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="table-branch"></tbody>
                        </table>
                      </div>


                    
                    </div>
                    <br>

                  </div>
                </div>
              </div>
            </div>



            <div class="row">
                <div class="col-md-12 text-center">

                <label for=""><b>Logo *</b></label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="input-file-store" name="logo" type="file" required>
                    </div>
                  </div>

                  <div class="kv-avatar-hintss">
                    <small>Seleccione una foto</small>
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

