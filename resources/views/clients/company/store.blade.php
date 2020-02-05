<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Clientes - Empresas</h6>
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
                        <label for=""><b>Razón social *</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="business_name" class="form-control form-control-user" id="business_name" placeholder="Razón social" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>NIT*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="nit" class="form-control form-control-user" id="nit" placeholder="NIT" required>
                          </div>
                      </div>
                    </div>


                    <div class="row">
                    
                        <div class="col-sm-6">
                          <label for=""><b>Fecha expedición</b></label>
                          <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date">
                        </div>

                        <div class="col-sm-6">
                          <label for=""><b>Fecha Constitución</b></label>
                          <input type="date" name="constitution_date" class="form-control form-control-user" id="constitution_date">
                        </div>

                    </div>

                    <br>

                    <div class="row">
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
                            <label for="address1" class="col-md-2 control-label">Teléfono 1*</label>
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
                            <label for="address1" class="col-md-2 control-label">Teléfono 2</label>
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

