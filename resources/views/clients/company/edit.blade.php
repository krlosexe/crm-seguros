<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar de Clientes - Empresas</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf
        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-edit" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2-edit" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-3-edit" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Pólizas</a>
            </li>

            <li class="nav-item">
                <a href="#default-tab-4-edit" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Cartera</a>
            </li>
        </ul>


        <br><br>


        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-edit">
              <input type="hidden" name="_method" value="put">
        
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
                                  <input type="text" name="business_name" class="form-control form-control-user" id="business_name_edit" placeholder="Razón social" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>NIT*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="nit" class="form-control form-control-user" id="nit_edit" placeholder="NIT" required>
                                </div>
                            </div>
                          </div>


                          <div class="row">
                          
                              <div class="col-sm-6">
                                <label for=""><b>Fecha expedición</b></label>
                                <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date_edit">
                              </div>

                              <div class="col-sm-6">
                                <label for=""><b>Fecha Constitución</b></label>
                                <input type="date" name="constitution_date" class="form-control form-control-user" id="constitution_date_edit">
                              </div>

                          </div>

                          <br>

                          <div class="row">
                            <div class="col-md-4">
                              <label for=""><br><b>Autoriza tratamiento de datos*</b></label>
                              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                    <input type="checkbox" name="data_treatment" id="data_treatment_edit" checked="">
                                    <label for="data_treatment_edit"></label>
                                </div>
                            </div>


                          </div>


                          <br>

                          <div class="row">
                            <div class="col-md-12">
                              <label for=""><b>Observaciones</b></label>
                              <textarea class="form-control" name="observations" id="observations_edit" cols="30" rows="10"></textarea>
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
                                  <input type="text" name="department" class="form-control form-control-user" id="department_edit" placeholder="Departamento" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Ciudad*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="city" class="form-control form-control-user" id="city_edit" placeholder="Ciudad" required>
                                </div>
                            </div>
                          </div>

                          <br>

                          <div class="row">
                            <div class="form-group col-md-12">
                                <div class="row">
                                  <label for="address1" class="col-md-2 control-label">Dirección 1*</label>
                                  <div class="col-md-6">
                                      <input type="text" class="form-control" id="address1_edit" name="address1" placeholder="Direccion 1" require>
                                  </div>

                                  <div class="col-md-4">
                                    <select name="type_address1" class="form-control selectize-input items has-options full has-items" id="type_address1_edit">
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
                                      <input type="text" class="form-control" id="address2_edit" name="address2" placeholder="Direccion 2">
                                  </div>

                                  <div class="col-md-4">
                                    <select name="type_address2" class="form-control selectize-input items has-options full has-items" id="type_address2_edit">
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
                                      <input type="text" class="form-control" id="phone1_edit" name="phone1" placeholder="Telefono 1" require>
                                  </div>

                                  <div class="col-md-4">
                                    <select name="type_phone1" class="form-control selectize-input items has-options full has-items" id="type_phone1_edit">
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
                                      <input type="text" class="form-control" id="phone2_edit" name="phone2" placeholder="Telefono 2">
                                  </div>

                                  <div class="col-md-4">
                                    <select name="type_phone2" class="form-control selectize-input items has-options full has-items" id="type_phone2_edit">
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
                                      <input type="text" class="form-control" id="email_edit" name="email" placeholder="Email" require>
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
                                  <input type="checkbox" name="send_policies_for_expire_email" id="send_policies_for_expire_email_edit">
                                  <label for="send_policies_for_expire_email_edit"></label>
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
                                  <input type="checkbox" name="send_portfolio_for_expire_email" id="send_portfolio_for_expire_email_edit">
                                  <label for="send_portfolio_for_expire_email_edit"></label>
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
                                  <input type="checkbox" name="send_policies_for_expire_sms" id="send_policies_for_expire_sms_edit">
                                  <label for="send_policies_for_expire_sms_edit"></label>
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
                                  <input type="checkbox" name="send_portfolio_for_expire_sms" id="send_portfolio_for_expire_sms_edit">
                                  <label for="send_portfolio_for_expire_sms_edit"></label>
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
                                  <input type="checkbox" name="send_birthday_card" id="send_birthday_card_edit">
                                  <label for="send_birthday_card_edit"></label>
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
          </div>



          <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-edit">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item " id="iframeEdit" allowfullscreen>

              </iframe>
            </div>
          </div>
          
          <div role="tabpanel" class="tab-pane fade in" id="default-tab-3-edit">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item " id="iframePoliciesEdit" allowfullscreen>

              </iframe>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane fade in " id="default-tab-4-edit">
            <div class="embed-responsive embed-responsive-16by9">
              <iframe class="embed-responsive-item " id="iframeCarteraEdit" allowfullscreen>

              </iframe>
            </div>
          </div>

        </div>




        

        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">

        <input type="hidden" name="id_user_edit" id="id_edit">


          <br>
          <br>
        </div>
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

