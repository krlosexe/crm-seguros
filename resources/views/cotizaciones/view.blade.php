<div class="card shadow mb-4 hidden" id="cuadro5">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Visualizar Cotización</h6>
  </div>
  <div class="card-body">
      
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
                            <label for=""><b>Tipo de Documento*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="tipo_documento_identidad" class="form-control form-control-user" id="tipo_documento_view"  required>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Nro de Documento*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="documento_identidad" class="form-control form-control-user" id="documento_identidad_view"  required>
                              </div>
                          </div>
                          
                          <div class="col-md-6">
                            <label for=""><b>Tipo de Persona*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="tipo_persona" class="form-control form-control-user" id="tipo_persona_view" required>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Correo*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="correo" class="form-control form-control-user" id="correo_view"  required>
                              </div>
                          </div>
                          

                        </div>


                        <div class="row">
                              <div class="col-md-6">
                                <label for=""><b>Telefono*</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="phone" class="form-control form-control-user" id="phone_view"  required>
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
                        <h6 class="m-0 font-weight-bold text-primary">Datos de Vehículo</h6>
                      </div>
                      <div class="card-body">

                        <div class="row">

                          <div class="col-md-6">
                            <label for=""><b>Clase de Vehículo*</b></label>
                                <input type="text" name="clase_vehiculo" class="form-control form-control-user" id="clase_vehiculo_view"  required>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Marca*</b></label>
                                <input type="text" name="marca" class="form-control form-control-user" id="marca_view"  required>
                          </div>

                            <div class="col-md-6">
                              <label for=""><b>Modelo*</b></label>
                               <input type="text" name="modelo" class="form-control form-control-user" id="modelo_view"  required>

                            </div>
                            
                            <div class="col-md-6">
                              <label for=""><b>Referencia*</b></label>
                               <input type="text" name="referencia" class="form-control form-control-user" id="referencia_view"  required>

                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Tipo de Servicio*</b></label>
                               <input type="text" name="tipo_servicio" class="form-control form-control-user" id="tipo_servicio_view"  required>
       
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Estado*</b></label>
                              <select class="form-control" id="estado_view" name="estado">
                                <option value="COTIZANDO">COTIZANDO</option>
                                <option value="INTERESADO">INTERESADO</option>
                              </select>       
                            </div>
                            

                            <div class="col-md-12">
                              <label for=""><b>Fecha y Hora*</b></label>
                              <label class="form-control" id="created_at"></label>
                            </div>
                          

                        </div>

                        <br>
                          


                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row show-when-interesado">
              <div class="col-md-6">
                <div class="row">

                  <div class="col-md-12">

                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos de Plan Escogido</h6>
                      </div>
                      <div class="card-body">

                        <div class="row">

                            <div class="col-md-6">
                              <label for=""><b>Plan*</b></label>
                               <input type="text" name="plan" id="plan_view" class="form-control form-control-user">
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Total*</b></label>
                               <input type="text" name="total" id="total_view" class="form-control form-control-user">
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

          <br>
    </div>
    <center>

      <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro5')">
          Cancelar
      </button>


    </center>

</div>