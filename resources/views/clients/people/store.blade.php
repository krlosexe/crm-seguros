<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Clientes - Personas</h6>
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
                          <div class="col-md-6">
                            <label for=""><b>Nombres*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="names" class="form-control form-control-user" id="names" placeholder="Nombre" required>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Apellidos*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="last_names" class="form-control form-control-user" id="last_names" placeholder="Apellidos" required>
                              </div>
                          </div>
                        </div>


                        <div class="row">
                        
                          <div class="col-sm-4">
                              <label for=""><b>Tipo de documento*</b></label>
                              <select name="type_document" class="form-control selectized" id="type_document" required>
                               <option value="">Seleccione</option>
                                <option value="CÉDULA">CÉDULA</option>
                                <option value="CÉDULA DE EXTRANJERÍA">CÉDULA DE EXTRANJERÍA</option>
                                <option value="RUC">RUC</option>
                                <option value="PASAPORTE">PASAPORTE</option>
                                <option value="NUIP">NUIP</option>
                                <option value="TARJETA DE IDENTIDAD">TARJETA DE IDENTIDAD</option>
                              </select>
                            </div>


                            <div class="col-sm-4">
                              <label for=""><b>Numero documento*</b></label>
                              <input type="text" name="number_document" class="form-control form-control-user" id="number_document" required>
                            </div>


                            <div class="col-sm-4">
                              <label for=""><b>Fecha expedición</b></label>
                              <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date">
                            </div>
                        </div>

                        <br>
                          

                        <div class="row">
                          <div class="col-sm-4">
                            <label for=""><b>Genero*</b></label>
                            <select name="gender" class="form-control selectize-input items has-options full has-items" id="gender" required>
                              <option value="">Seleccione</option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                            </select>
                          </div>


                          <div class="col-sm-4">
                            <label for=""><b>Fecha nacimiento*</b></label>
                            <input type="date" name="birthdate" class="form-control form-control-user" id="birthdate"  required>
                          </div>


                          <div class="col-sm-2">
                            <label for=""><b>Edad</b></label>
                            <input type="text" name="age" class="form-control form-control-user" id="age"  disabled>
                          </div>
                        </div>

                        <br>

                        <div class="row">
                          <div class="col-sm-4">
                            <label for=""><b>Peso</b></label>
                            <input type="number" name="weight" class="form-control form-control-user" id="weight">  
                          </div>

                          <div class="col-sm-4">
                            <label for=""><b>Altura*</b></label>
                            <input type="number" name="height" class="form-control form-control-user" id="height">
                          </div>

                          <div class="col-sm-4">
                            <label for=""><b>EPS</b></label>
                            <input type="text" name="eps" class="form-control form-control-user" id="eps">
                          </div>
                        </div>

                        <br>

                        <div class="row">
                          <div class="col-sm-4">
                            <label for=""><b>Estrato</b></label>
                            <input type="text" name="stratum" class="form-control form-control-user" id="stratum">
                          </div>

                          <div class="col-md-4">
                            <label for=""><br><b>Autoriza tratamiento de datos*</b></label>
                            <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                  <input type="checkbox" name="data_treatment" id="data_treatment" checked="">
                                  <label for="data_treatment"></label>
                              </div>
                          </div>


                        </div>


                        <br>

                        <div class="row">
                          <div class="col-md-12">
                            <label for=""><b>Observaciones</b></label>
                            <textarea class="form-control" name="observations" id="observations" cols="30" rows="10"></textarea>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos de contacto</h6>
                      </div>
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-6">
                            <label for=""><b>Departamento*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="department" class="form-control form-control-user" id="department" placeholder="Departamento" required>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Ciudad*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="city" class="form-control form-control-user" id="city" placeholder="Ciudad" required>
                              </div>
                          </div>
                        </div>

                        <br>

                        <div class="row">
                          <div class="form-group col-md-12">
                              <div class="row">
                                <label for="address1" class="col-md-2 control-label">Dirección 1*</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="address1" name="address1" placeholder="Direccion 1" required>
                                </div>

                                <div class="col-md-4">
                                  <select name="type_address1" class="form-control selectize-input items has-options full has-items" id="type_address1">
                                    <option value="Residencial">Residencial</option>
                                    <option value="Oficina">Oficina</option>
                                    <option value="Otro">Otro</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                        </div>
                        <br>


                        <div class="row">
                          <div class="form-group col-md-12">
                              <div class="row">
                                <label for="address1" class="col-md-2 control-label">Dirección 2</label>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" id="address2" name="address2" placeholder="Direccion 2">
                                </div>

                                <div class="col-md-4">
                                  <select name="type_address2" class="form-control selectize-input items has-options full has-items" id="type_address2">
                                    <option value="Residencial">Residencial</option>
                                    <option value="Oficina">Oficina</option>
                                    <option value="Otro">Otro</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                        </div>
                        <br>








                        <div class="row">
                          <div class="form-group col-md-12">
                              <div class="row">
                                <label for="address1" class="col-md-2 control-label">Telefono 1*</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="phone1" name="phone1" placeholder="Telefono 1" required="">
                                </div>

                                <div class="col-md-4">
                                  <select name="type_phone1" class="form-control selectize-input items has-options full has-items" id="type_phone1">
                                    <option value="Personal">Personal</option>
                                    <option value="Residencial">Residencial</option>
                                    <option value="Oficina">Oficina</option>
                                    <option value="Otro">Otro</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                        </div>
                        <br>



                        <div class="row">
                          <div class="form-group col-md-12">
                              <div class="row">
                                <label for="address1" class="col-md-2 control-label">Telefono 2</label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control" id="phone2" name="phone2" placeholder="Telefono 2">
                                </div>

                                <div class="col-md-4">
                                  <select name="type_phone2" class="form-control selectize-input items has-options full has-items" id="type_phone2">
                                    <option value="Personal">Personal</option>
                                    <option value="Residencial">Residencial</option>
                                    <option value="Oficina">Oficina</option>
                                    <option value="Otro">Otro</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                        </div>
                        <br>





                        <div class="row">
                          <div class="form-group col-md-12">
                              <div class="row">
                                <label for="address1" class="col-md-2 control-label">Email*</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
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
                        <h6 class="m-0 font-weight-bold text-primary">Informacion CRM</h6>
                      </div>
                      <div class="card-body">


                        <div class="row">

                          <div class="col-md-12">
                            <label for=""><b>Estado civil</b></label>
                              <select name="marital_status" class="form-control selectize-input items has-options full has-items" id="marital_status">
                                <option value="">Seleccione</option>
                                <option value="Soltero">Soltero</option>ss
                                <option value="Casado">Casado</option>
                                <option value="Divorciado">Divorciado</option>
                                <option value="Unión Libre">Unión Libre</option>
                                <option value="Seperado">Seperado</option>
                                <option value="Viudo">Viudo</option>
                            </select>
                          </div>

                        </div>


                        <br>


                        <div class="row">
                          <div class="col-md-6">
                            <label for=""><b>Ingreso mensual</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="monthly_income" class="form-control form-control-user" id="names" >
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Patrimonio</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="heritage" class="form-control form-control-user" id="heritage" >
                              </div>
                          </div>
                          
                        </div>


                        <br>

                        <div class="row">


                        <div class="col-md-12" style="padding: 0;padding-left: 10px;padding-top: 10px;padding-bottom: 10px;border: 2px solid #e6e6e6;">

                            <div class="row">

                              <div class="col-md-5 form-group" style="margin-bottom: 0px !important">
                                <div class="form-group row" style="margin-bottom: 0px !important">
                                    <label for="form-1-1" class="col-md-5 control-label">Casa propia</label>
                                    <div class="col-md-5 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                    <input type="checkbox" name="own_house" id="own_house">
                                    <label for="own_house"></label>
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-6 form-group" style="margin-bottom: 0px !important">
                                <div class="form-group row" style="margin-bottom: 0px !important">
                                    <label for="form-1-1" class="col-md-4 control-label">No. Casas</label>
                                    <div class="col-md-6">
                                        <input type="number" class="form-control" id="number_house" name="number_house" disabled>
                                    </div>
                                </div>
                              </div>

                            </div>
                          </div>





                          <div class="col-md-12" style="padding: 0;padding-left: 10px;padding-top: 10px;padding-bottom: 10px;border: 2px solid #e6e6e6;">

                            <div class="row">

                              <div class="col-md-5 form-group" style="margin-bottom: 0px !important">
                                <div class="form-group row" style="margin-bottom: 0px !important">
                                    <label for="form-1-1" class="col-md-5 control-label">Hijos</label>
                                    <div class="col-md-5 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                    <input type="checkbox" name="children" id="children">
                                    <label for="children"></label>
                                  </div>
                                </div>
                              </div>

                              <div class="container-datos-adicionales-hijo col-sm-12" style="display: none;">
                                  <table class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Nombre</th>
                                              <th>Teléfono</th>
                                              <th>Fecha nacimiento</th>
                                              <th>
                                                  
                                                <button class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-children">
                                                    <i class="fa fa-plus"  aria-hidden="true"></i>
                                                </button>
                                                  
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody id="dato-extra-hijo-container"></tbody>
                                  </table>
                              </div>

                            </div>
                          </div>











                          <div class="col-md-12" style="padding: 0;padding-left: 10px;padding-top: 10px;padding-bottom: 10px;border: 2px solid #e6e6e6;">

                            <div class="row">

                              <div class="col-md-5 form-group" style="margin-bottom: 0px !important">
                                <div class="form-group row" style="margin-bottom: 0px !important">
                                    <label for="form-1-1" class="col-md-5 control-label">Vehículo</label>
                                    <div class="col-md-5 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                    <input type="checkbox" name="vehicle" id="vehicle">
                                    <label for="vehicle"></label>
                                  </div>
                                </div>
                              </div>

                              <div class="container-datos-adicionales-vehicle col-sm-12" style="display: none;">
                                  <table class="table table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Placa</th>
                                              <th>Fecha vencimiento SOAT</th>
                                              <th>Fecha pago de impuestos</th>
                                              <th>Fecha vencimiento tecnomecánica</th>
                                              <th>
                                                  
                                              <button class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-vehicle">
                                                  <i class="fa fa-plus"  aria-hidden="true"></i>
                                              </button>
                                                  
                                              </th>
                                          </tr>
                                      </thead>
                                      <tbody id="dato-extra-vehicle-container"></tbody>
                                  </table>
                              </div>

                            </div>
                          </div>

                        </div>

                      </div>
                    </div>
                  </div>
                </div>


                <div class="row">
                
                  <div class="col-md-12">
                    
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Notificaciones</h6>
                      </div>
                      <div class="card-body">
                        

                        <div class="row">

                          <div class="col-md-12 form-group" style="margin-bottom: 0px !important">
                          
                            <div class="form-group row" style="margin-bottom: 0px !important">
                                <label for="send_policies_for_expire_email" class="col-md-6 control-label">Enviar correo pólizas por vencer</label>
                                <div class="col-md-1 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                <input type="checkbox" name="send_policies_for_expire_email" id="send_policies_for_expire_email">
                                <label for="send_policies_for_expire_email"></label>
                              </div>
                            </div>
                          </div>

                        </div>
                        <br>


                        <div class="row">

                          <div class="col-md-12 form-group" style="margin-bottom: 0px !important">
                          
                            <div class="form-group row" style="margin-bottom: 0px !important">
                                <label for="send_portfolio_for_expire_email" class="col-md-6 control-label">Enviar correo cartera por vencer</label>
                                <div class="col-md-1 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                <input type="checkbox" name="send_portfolio_for_expire_email" id="send_portfolio_for_expire_email">
                                <label for="send_portfolio_for_expire_email"></label>
                              </div>
                            </div>
                          </div>

                        </div>
                        <br>







                        <div class="row">

                          <div class="col-md-12 form-group" style="margin-bottom: 0px !important">
                          
                            <div class="form-group row" style="margin-bottom: 0px !important">
                                <label for="send_policies_for_expire_sms" class="col-md-6 control-label">Enviar SMS pólizas por vencer</label>
                                <div class="col-md-1 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                <input type="checkbox" name="send_policies_for_expire_sms" id="send_policies_for_expire_sms">
                                <label for="send_policies_for_expire_sms"></label>
                              </div>
                            </div>
                          </div>

                        </div>
                        <br>





                        <div class="row">

                          <div class="col-md-12 form-group" style="margin-bottom: 0px !important">
                          
                            <div class="form-group row" style="margin-bottom: 0px !important">
                                <label for="send_portfolio_for_expire_sms" class="col-md-6 control-label">Enviar SMS cartera por vencer</label>
                                <div class="col-md-1 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                <input type="checkbox" name="send_portfolio_for_expire_sms" id="send_portfolio_for_expire_sms">
                                <label for="send_portfolio_for_expire_sms"></label>
                              </div>
                            </div>
                          </div>

                        </div>
                        <br>





                        <div class="row">

                          <div class="col-md-12 form-group" style="margin-bottom: 0px !important">
                          
                            <div class="form-group row" style="margin-bottom: 0px !important">
                                <label for="send_birthday_card" class="col-md-6 control-label">Enviar tarjeta de compleaños</label>
                                <div class="col-md-1 toggle-checkbox toggle-success checkbox-inline toggle-sm mrg-top-8">
                                <input type="checkbox" name="send_birthday_card" id="send_birthday_card">
                                <label for="send_birthday_card"></label>
                              </div>
                            </div>
                          </div>

                        </div>
                        <br>

                      </div>
                    </div>
                  </div>
                </div>







                <div class="row">
                
                  <div class="col-md-12">
                    
                    <div class="card shadow mb-4">
                      <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Información laboral</h6>
                      </div>
                      <div class="card-body">

                        <div class="row">

                          <div class="col-md-12">
                              <label for=""><b>Ocupación </b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="occupation" class="form-control form-control-user" id="occupation" >
                              </div>
                          </div>

                        </div>
                        <br>
                        <div class="row">
                          <div class="col-md-12">
                            <label for=""><b>Empresa</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="company" class="form-control form-control-user" id="company" >
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

          <!---END ROW-->
          </div>



          <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-store">
            <div class="col-md-12" >
             

              <div class="row">
                <div class="col-md-6">
                  <button type="button" id="add-file" class="btn btn-primary btn-user" >
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

