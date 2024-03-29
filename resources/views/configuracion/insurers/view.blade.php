<div class="card shadow mb-4 hidden" id="cuadro3">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Aseguradoras.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf



        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item remove-pay">
                <a href="#default-tab-2" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Sub Compañias de la Aseguradora</a>
            </li>

            <li class="nav-item remove-pay">
                <a href="#default-tab-3" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Oficinas</a>
            </li>


            <li class="nav-item remove-pay">
              <a href="#default-tab-4-1" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>



        </ul>

<br>
<br>


        <div class="tab-content">
        
           <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1">

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
                                  <input type="number" name="code" class="form-control form-control-user" id="code_view" placeholder="Codigo" required>
                                </div>
                              </div>
                              <div class="col-md-6">
                              <label for=""><b>Link Citas</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="link_cita" class="form-control form-control-user" id="link_view" placeholder="link citas">
                                </div>
                              </div>

                          </div>
                          <div class="row">

                            <div class="col-md-6">

                              <label for=""><b>Nombre *</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="name" class="form-control form-control-user" id="name_view" placeholder="Nombre" required>
                                </div>
                            </div>

                            <div class="col-md-6">

                              <label for=""><b>NIT *</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="nit" class="form-control form-control-user" id="nit_view" placeholder="NIT" required>
                                </div>
                            </div>


                        </div>
                          <br>



                          <div class="row">

                            <div class="col-md-6">

                              <label for=""><b>Email </b></label>
                                <div class="form-group valid-required">
                                  <input type="email" name="email" class="form-control form-control-user" id="email_view" placeholder="Email">
                                </div>
                            </div>


                            <div class="col-md-6">
                              <label for=""><b>Teléfono </b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="phone" class="form-control form-control-user" id="phone_view" placeholder="Telefono">
                                </div>
                            </div>



                            

                            <br>
                        </div>



                          <div class="row">

                            <div class="col-md-8">

                              <label for=""><b>Cuenta Bancaria </b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="bank_account" class="form-control form-control-user" id="bank_account_view" placeholder="Cuenta Bancaria">
                                </div>
                            </div>


                            <div class="col-md-4">
                              <label for=""><b>Código del Asesor </b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="code_adviser" class="form-control form-control-user" id="code_adviser_view" placeholder="Codigo del Asesor">
                                </div>
                            </div>

                            <br>

                        </div>


                        <div class="row">
                        
                          <div class="col-md-12">
                            <label for=""><b>Dirección </b></label>
                              <div class="form-group valid-required">
                                <textarea class="form-control" name="address" id="address_view" cols="30" rows="10"></textarea>
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
                                  <!-- 
                            <div class="col-md-8">
                              <label for=""><b>Ramos *</b></label>
                                <select id="branchs">
                                    <option value="" disabled selected>Select a person...</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                              <label for=""><b><br></b></label>
                                <div class="form-group valid-required">
                                <button type="button"  class="btn btn-primary btn-user" id="add-branch">
                                    Agregar <i class="ei-addthis"></i>
                                </button>
                                </div>
                            </div> -->


                            <div class="col-md-12">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Nombre</th>
                                          <th>Código</th>
                                          <th>Porcentaje de Comisión</th>
                                          <th>Porcentaje de IVA</th>
                                          <!-- <th> </th> -->
                                      </tr>
                                  </thead>
                                  <tbody id="table-branch-view"></tbody>
                              </table>
                            </div>


                          
                          </div>
                          <br>



                          <div class="row">
                              <div class="col-md-12 text-center">

                              <label for=""><b>Logo *</b></label>
                                <div class="kv-avatar">
                                  <div class="file-loading">
                                    <input id="input-file-view" name="logo" type="file" required>
                                  </div>
                                </div>

                                <div class="kv-avatar-hintss">
                                  <small>Seleccione una foto</small>
                                </div>

                              </div>
                            </div>



                        </div>
                      </div>
                    </div>
                  </div>

                </div>

              </div>

              <!---END ROW-->


           </div>



            <!-- ---------------- -->
           <div role="tabpanel" class="tab-pane fade in" id="default-tab-2">
           
            <div class="embed-responsive embed-responsive-16by9">

                <iframe class="embed-responsive-item " id="iframeView" allowfullscreen>

                </iframe>

              </div>

           </div>


           <div role="tabpanel" class="tab-pane fade in" id="default-tab-3">
            <div class="embed-responsive embed-responsive-16by9">

              <iframe class="embed-responsive-item " id="iframeOficinasView" allowfullscreen>

              </iframe>

            </div>
          </div>


          <div role="tabpanel" class="tab-pane fade in" id="default-tab-4-1">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item " id="iframeDigitalesView" allowfullscreen>

              </iframe>
            </div>
          </div>





        
        </div>

        

    

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

