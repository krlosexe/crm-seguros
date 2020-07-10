<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Vehículos</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf



        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-store" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2-store" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>
        </ul>

        <br><br>


        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-store">

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
                          <div class="col-md-4">
                            <label for=""><b>Número de placa*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="placa" class="form-control form-control-user" id="placa" placeholder="EJ: FHP823" required>
                              </div>
                          </div>

                          <div class="col-md-4">
                            <label for=""><b>Tipo de Vehículo*</b></label>
                              <select name="type_vehicule" class="form-control" id="type_vehicule" required>
                               <option value="">Seleccione</option>
                               
                              </select>
                          </div>
                            <div class="col-sm-4">
                              <label for=""><b>Marca*</b></label>
                              <select name="marca" class="selectized" id="marca" required>
                               <option value="">Seleccione</option>
                                
                              </select>
                            </div>

                        </div>


                        <div class="row">
                        
                        

                            <div class="col-sm-4">
                              <label for=""><b>Linea*</b></label>
                              <select name="line" class="selectized" id="line" required>
                               <option value="">Seleccione</option>
                                
                              </select>
                            </div>
                            
                            <div class="col-sm-4">
                              <label for=""><b>Referencia 2*</b></label>
                              <select name="refer2" class="selectized" id="refer2" required>
                               <option value="">Seleccione</option>
                                
                              </select>
                            </div>

                            <div class="col-sm-4">
                              <label for=""><b>Referencia 3*</b></label>
                              <select name="refer3" class="selectized" id="refer3" required>
                               <option value="">Seleccione</option>
                                
                              </select>
                            </div>



                            
                        </div>

                        <br>
                          

                        <div class="row">
                          <div class="col-sm-4">
                              <label for=""><b>Modelo*</b></label>
                              <select class="form-control" name="model" id="model" required> 
                                <option value="">Seleccione</option>
                                @foreach (range(2021, 1970) as $element)
                                  <option value="{{ $element }}">{{ $element }}</option>
                                @endforeach
                              </select>
                            </div>
                          <div class="col-sm-4">
                            <label for=""><b>Color*</b></label>
                              <input type="text" name="color" class="form-control form-control-user" id="gender" placeholder="Color del vehículo" required>
                      
                          </div>


                            <div class="col-sm-4">
                            <label for=""><b>Servicio*</b></label>
                            <input type="text" name="service" class="form-control form-control-user" id="service" placeholder="Tipo de servicio" readonly>
                          </div>


                          
                        </div>

                      </div>
                        <br>
                        <br>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Característica</h6>
                      </div>
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-4">
                            <label for=""><b>Cilindraje*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="cc" class="form-control form-control-user" id="cc" placeholder="Cilindraje" required>
                              </div>
                          </div>

                          <div class="col-md-4">
                            <label for=""><b>Número de Motor*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="number_motor" class="form-control form-control-user" id="number_motor" placeholder="Número de motor">
                              </div>
                          </div>

                          <div class="col-md-4">
                            <label for=""><b>Número de Chasis*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="number_chassis" class="form-control form-control-user" id="number_chassis" placeholder="Número de chasis">
                              </div>
                          </div>
                        </div>


                        

                        <br><br><br>

                        <div class="row">
                          <div class="form-group col-md-12">
                              <div class="row">
                                <div class="col-md-4">
                                    <label for=""><b>Número de pasajeros*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="number_passengers" class="form-control form-control-user" id="number_passengers" placeholder="Número pasajeros" required>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                     <label for=""><b>Puertas*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="doors" class="form-control form-control-user" id="doors" placeholder="Número de puertas" required>
                                      </div>
                                </div>
                                 <div class="col-md-4">
                                    <label for=""><b>Peso de vehículo*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="vehicle_weight" class="form-control form-control-user" id="vehicle_weight" placeholder="Peso en KG" required>
                                      </div>
                                </div>
                              </div>
                              <br>
                              <div class="row">
                                


                                <div class="col-md-4">
                                     <label for=""><b>Ejes*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="axes" class="form-control form-control-user" id="axes" placeholder="Número de ejes" required>
                                      </div>
                                </div>

                                <div class="col-md-4">
                                    <label for=""><b>Tipo de caja*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="type_drop" class="form-control form-control-user" id="type_drop" placeholder="Tipo de caja" required>
                                      </div>
                                </div>
                                <div class="col-md-4">
                                     <label for=""><b>Tipo de combustible*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="type_fuel" class="form-control form-control-user" id="type_fuel" placeholder="Tipo de combustible" required>
                                      </div>
                                </div>

                              </div>
                              <br>
                              <div class="row">
                                

                                <div class="col-md-4">
                                      <label for=""><b>Transmisión*</b></label>
                                      <div class="form-group valid-required">
                                        <input type="text" name="transmission" class="form-control form-control-user" id="transmission" placeholder="Mecánica/Automatica" required>
                                      </div>
                                </div>

                               
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
                        <h6 class="m-0 font-weight-bold text-primary">Informacion adicional</h6>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <label for=""><b>Fecha de vencimiento de técnico mecánica</b></label>
                              <div class="form-group valid-required">
                                <input type="date" name="due_date_techno_mechanics" class="form-control form-control-user" id="due_date_techno_mechanics" >
                              </div>
                          </div>
                          <div class="col-md-6">
                            <label for=""><b>Fecha de vencimiento de SOAT</b></label>
                              <div class="form-group valid-required">
                                <input type="date" name="due_date_soat" class="form-control form-control-user" id="due_date_soat" >
                              </div>
                          </div>


                        </div>


                        <br>
                      <div class="row">
                          <div class="col-md-6">
                            <label for=""><b>Valor Fasecolda*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="value_fasecolda" class="form-control form-control-user" id="value_fasecolda" placeholder="Valor en pesos" >
                              </div>
                          </div>
                          
                          <div class="col-md-6">
                            <label for=""><b>Código Fasecolda</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="code" class="form-control form-control-user" id="code" >
                              </div>
                          </div>
                           <div class="card-header py-3">
                          <center> <a href="https://fasecolda.com/guia-de-valores/index.php" target="_blank"><h6 class="m-0 font-weight-bold text-primary">Para buscar información más detallada haz clic aquí</h6></a></center>
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
          <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-store">
            <div class="col-md-12" >
              <div class="row">
                <div class="col-md-6">
                  <button type="button" id="add-file" class="btn btn-success btn-user" >
                    <i class="ti-image"></i>
                    Agregar
                  </button>
                </div>
              </div>
              <br>
              <div id="content-file" class="row">       
              </div> 
            </div>
          </div>
        </div>
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

