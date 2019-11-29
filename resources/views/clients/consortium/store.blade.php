<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Clientes - Consorcios</h6>
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
                      <div class="col-md-12">
                        <label for=""><b>Nombre del consorcio *</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="name_consortium" class="form-control form-control-user" id="name_consortium" placeholder="Nombre del consorcio" required>
                          </div>
                      </div>

                        <div class="col-md-12">
                          <label for=""><b>Identificación del consorcio*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="identification_consortium" class="form-control form-control-user" id="identification_consortium" placeholder="Identificación del consorcio" required>
                          </div>
                      </div>
                    </div>

                    <br>

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
                    <h6 class="m-0 font-weight-bold text-primary">Socios del consorcio</h6>
                  </div>
                  <div class="card-body">
                    

                    <div class="row">

                      <div class="col-md-8">
                        <label for=""><b>Cliente *</b></label>
                          <div class="form-group valid-required">
                            <select id="clients-store" class="form-control">
                              <option value="">Seleccione</option>
                            </select>
                          </div>
                      </div>


                      <div class="col-md-4">
                        <label for=""><b><br></b></label>
                          <div class="form-group valid-required">
                          <button type="button"  class="btn btn-primary btn-user" id="add-partner">
                              Agregar <i class="ei-addthis"></i>
                          </button>
                          </div>
                      </div>


                      <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody id="table-partner"></tbody>
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

