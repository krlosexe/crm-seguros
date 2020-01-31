<div class="card shadow mb-4 hidden" id="cuadro3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Clientes - Consorcios.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf



        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-view" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2-view" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>
        </ul>

        <br><br>

        <div class="tab-content">
          
          <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-view">
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
                                  <input type="text" name="name" class="form-control form-control-user" id="name_consortium_view" placeholder="Nombre del consorcio" required>
                                </div>
                            </div>

                              <div class="col-md-12">
                                <label for=""><b>Identificación del consorcio*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="identification" class="form-control form-control-user" id="identification_consortium_view" placeholder="Identificación del consorcio" required>
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

                            <!-- <div class="col-md-8">
                              <label for=""><b>Cliente *</b></label>
                                <select id="clients-store">
                                    <option value="" disabled selected>Select a person...</option>
                                </select>
                            </div>


                            <div class="col-md-4">
                              <label for=""><b><br></b></label>
                                <div class="form-group valid-required">
                                <button type="button"  class="btn btn-primary btn-user" id="add-partner">
                                    Agregar <i class="ei-addthis"></i>
                                </button>
                                </div>
                            </div> -->


                            <div class="col-md-12">
                              <table class="table table-bordered">
                                  <thead>
                                      <tr>
                                          <th>Nombre</th>
                                          <th> </th>
                                      </tr>
                                  </thead>
                                  <tbody id="table-partner-view"></tbody>
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
          </div>


          <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-view">
              <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item " id="iframeView" allowfullscreen>

                </iframe>
              </div>
          </div>


        </div>

        


        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
        </div>
          <center>
            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro3')">
                Cancelar
            </button>
          </center>
          <br>
          <br>
      </form>
      
    </div>

