<div class="card shadow mb-4 hidden" id="cuadro5">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Visualizar Cotización</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-view" enctype="multipart/form-data">
      
        @csrf
        <input type="hidden" name="_method" value="put">

        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-view" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
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
                        <h6 class="m-0 font-weight-bold text-primary">Datos Personales</h6>
                      </div>
                      <div class="card-body">

                        <div class="row">
                             <div class="col-md-6">
                              <label for=""><b>Placa*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="placa" class="form-control form-control-user" id="placa_view"  required>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Nombre*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="nombre" class="form-control form-control-user" id="nombre_view"  required>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Apellido*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="apellido" class="form-control form-control-user" id="apellido_view"  required>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Correo*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="correo" class="form-control form-control-user" id="correo_view"  required>
                                </div>
                            </div>


                            <div class="col-md-6">
                              <label for=""><b>Estado*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="estado" class="form-control form-control-user" id="estado_view"  required>
                                </div>
                            </div>

                        </div>

                        <br>
                          
                      </div>

                    </div>
                  </div>
                 </div>

              </div>
             
            </div>
                    
          </div>
                  
        </div>

         </form>
          <br>
    </div>
    <center>

      <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro5')">
          Cancelar
      </button>


    </center>

</div>

