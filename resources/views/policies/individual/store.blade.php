<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Pólizas</h6>
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
                    <h6 class="m-0 font-weight-bold text-primary">Información principal de la póliza</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">

                      <div class="col-md-4">
                        <label for=""><b>Tipo de póliza*</b></label>
                          <div class="form-group valid-required">
                            <select name="type_poliza" class="form-control selectized" id="type_poliza" required>
                                <option value="">Seleccione</option>
                                <option value="individual">Individual</option>
                                <option value="Collective">Colectiva</option>
                              </select>
                          </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <label for=""><b>Numero de póliza*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="number_policies" class="form-control form-control-user" id="number_policies" placeholder="Numero de póliza" required>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <label for=""><b>Estado Póliza*</b></label>
                          <div class="form-group valid-required">
                            <select name="state_policies" class="form-control selectized" id="state_policies" required>
                              <option value="">Seleccione</option>
                              <option value="Vigente">Vigente</option>
                              <option value="Vencida">Vencida</option>
                              <option value="No renovada">No renovada</option>
                              <option value="Expedición">Expedición</option>
                              <option value="Devengada">Devengada</option>
                              <option value="Cotización">Cotización</option>
                              <!-- <option value="Cancelada">Cancelada</option> -->
                            </select>
                          </div>
                      </div>

                      <div class="col-md-4">
                        <label for="is_renewable"><b>¿Es renovable?</b><br></label><br>
                        <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                              <input type="checkbox" name="is_renewable" id="is_renewable" checked="checked">
                              <label for="is_renewable"></label>
                        </div>
                      </div>
                    </div>


                    <div class="row">
                    
                        <div class="col-md-6">
                          <label for=""><b>Aseguradora*</b></label>
                            <div class="form-group valid-required">
                              <select name="insurers"  id="insurers" required>
                                <option value="">Seleccione</option>
                              </select>
                            </div>
                        </div>


                        <div class="col-md-6">
                          <label for=""><b>Ramo*</b></label>
                            <div class="form-group valid-required">
                              <select name="branch"  id="branch" required>
                                <option value="">Seleccione</option>
                              </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-sm-6">
                          <label for=""><b>Fecha expedición</b></label>
                          <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date">
                        </div>


                        <div class="col-sm-6">
                          <label for=""><b>Fecha Recepción</b></label>
                          <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date">
                        </div>

                        
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-sm-6">
                          <label for=""><b>Fecha inicio *</b></label>
                          <input type="date" name="start_date" class="form-control form-control-user" id="start_date" required>
                        </div>

                        <div class="col-sm-6">
                          <label for=""><b>Fecha Fin *</b></label>
                          <input type="date" name="end_date" class="form-control form-control-user" id="end_date" required>
                        </div>
                        
                        
                    </div>


                      <br>

                    <div class="row remove">
                      <div class="col-md-12">
                        <label for=""><b>Riesgo (Placa, Direccion, etc)*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="risk" class="form-control form-control-user" id="risk" placeholder="Codigo Objeto Asegurado">
                          </div>
                      </div>
                    </div>

                    <br>

                    <div class="row">
                      <div class="col-md-12">
                          <label for=""><b>Cliente *</b></label>
                            <div class="form-group valid-required">
                              <select class="selectized" id="clients_select" required>
                                <option value="">Seleccione</option>
                              </select>
                            </div>

                            <input type="hidden" name="type_clients" id="type_clients">
                            <input type="hidden" name="clients" id="clients">
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
                    <h6 class="m-0 font-weight-bold text-primary">Información de Tomador/Asegurado/Beneficiario</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Nombre Tomador*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="name_taker" class="form-control form-control-user" id="name_taker" placeholder="Nombre Tomador" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Documento del Tomador*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="identification_taker" class="form-control form-control-user" id="identification_taker" placeholder="Docuemnento Tomador" required>
                          </div>
                      </div>
                    </div>

                    <br>




                    <div class="remove">
                      <div class="row">
                          <div class="col-md-6">
                            <label for=""><b>Nombre Asegurado*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="name_insured" class="form-control form-control-user" id="name_insured" placeholder="Nombre Asegurado" >
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Documento del Asegurado*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="identification_insured" class="form-control form-control-user" id="identification_insured" placeholder="Documento del Asegurado">
                              </div>
                          </div>
                      </div>
                    </div>

                    <br>


                    
                    <div class="remove">
                      <div class="row">

                          <div class="col-md-12">
                            <h6 class="m-0 font-weight-bold text-primary">Beneficiarios</h6>
                          </div> <br> <br>
                          <div class="col-md-6">
                            <label for="beneficiary_remission"><b>¿Beneficiarios en la remisión?</b><br></label><br>
                            <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                  <input type="checkbox" name="beneficiary_remission" id="beneficiary_remission" checked="checked">
                                  <label for="beneficiary_remission"></label>
                            </div>
                          </div>


                          <div class="col-md-6">
                            <label for="beneficairy_onerous"><b>Beneficiario Oneroso</b><br></label><br>
                            <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                  <input type="checkbox" name="beneficairy_onerous" id="beneficairy_onerous" checked="checked">
                                  <label for="beneficairy_onerous"></label>
                            </div>
                          </div>



                          <div class="col-md-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Documento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                          <input type="text" name="beneficairy_name" class="form-control" id="beneficairy_name" placeholder="Nombre del Beneficiario">
                                        </td>

                                        <td>
                                          <input type="text" name="beneficairy_identification" class="form-control" id="beneficairy_identification" placeholder="Documento del Beneficiario">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
                    <h6 class="m-0 font-weight-bold text-primary">Observaciones y relación de contenido</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">

                      <div class="col-md-6 remove">
                        <label for=""><b>Observaciones Internas</b></label>
                          <div class="form-group valid-required">
                            <textarea name="internal_observations" class="form-control" id="internal_observations" cols="30" rows="10"></textarea>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Observaciones</b></label>
                          <div class="form-group valid-required">
                            <textarea name="observations" id="observations" class="form-control" cols="30" rows="10"></textarea>
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

            <div class="row remove">

              <div class="col-md-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información prima y comisiones</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                          <label for=""><b>Prima *</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales" id="cousin" required value="0" style="text-align: right">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales" id="xpenses" value="0" style="text-align: right">
                            </div>
                        </div>
                    </div>
                  
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                          <label for=""><b>IVA</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="vat" class="form-control form-control-user" id="vat" readonly value="0" style="text-align: right">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>% IVA Prima*</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin" readonly>
                            </div>
                        </div>
                    </div>
                  
                    <br>

                    <div class="row row-participacion">
                        <div class="col-md-6">
                          <label for=""><b>Porcentaje Comisión</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="commission_percentage" class="form-control form-control-user" id="commission_percentage" value="100" readonly style="text-align: right">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Participación</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="participation" class="form-control form-control-user" id="participation" value="100">
                            </div>
                        </div>
                    </div>
                  
                    <br>


                    <div class="row">
                        <div class="col-md-6">
                          <label for=""><b>Comisión agencia</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission" readonly value="0" style="text-align: right">
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Total</b></label>
                            <div class="form-group valid-required">
                              <input type="text" name="total" class="form-control form-control-user" id="total" readonly value="0" style="text-align: right">
                            </div>
                        </div>
                    </div>
                  
                    <br>

                  </div>
                </div>
              </div>
            </div>

      <div class="row remove">

              <div class="col-md-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vehículos asociados</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">
                        <div class="col-md-8">
                          <label for=""><b>Placa del vehículo</b></label>
                            <div class="form-group valid-required">
                              <select name="placa" class="selectized"  id="placa" required>
                               <option value="">Seleccione</option>
                              </select>
                            </div>
                            
                        </div>
                        <div class="col-md-4">
                              <label for=""><b>Añadir nuevo *</b></label>
                              <div class="form-group valid-required">
                              <button type="button" class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-vehicle">
                                                  <i class="fa fa-plus" ></i>
                                              </button>
                                                 </div>
                        </div>

                    </div>   


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Placas</th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody id="table-placas"></tbody>
                    </table>



                    <br>                 
         
                  </div>
                </div>
              </div>
            </div>

            <div class="row remove">
            
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

                  </div>
                </div>
              </div>
            </div>






            <div class="row remove-pay">
            
              <div class="col-md-12">
                
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Vinculaciones</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">

                      <div class="col-md-12">
                        <button type="button" data-toggle="modal" data-target="#modal-lg" id="btn-bind-policies" class="btn btn-success" style="float: left;">
                          <i class="ti-user"></i>
                          <span>Incluir</span>
                        </button>
                      </div>

                      <div class="col-md-12">
                          <table class="table table-bordered" id="table-bind">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody></tbody>
                          </table>
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
                    <h6 class="m-0 font-weight-bold text-primary">Información pagos</h6>
                  </div>
                  <div class="card-body">

                  <div class="row">

                        <div class="col-md-4">
                          <label for=""><b>Forma Pago</b></label>
                            <div class="form-group valid-required">
                              <select name="payment_method" class="form-control start_simulation selectized" id="payment_method" required>
                                <option value="">Seleccione</option>
                                <option value="Contado">Contado</option>
                                <option value="Financiado">Financiado</option>
                                <!-- <option value="Fraccionado">Fraccionado</option> -->
                              </select>
                            </div>
                        </div>
                   

                      <div class="col-md-4">
                        <label for=""><b>Periodicidad del pago</b></label>
                          <div class="form-group valid-required">
                            <select name="payment_period" class="form-control start_simulation selectized" id="payment_period" required disabled>
                              <option value="">Seleccione</option>
                              <option value="Mensual">Mensual</option>
                              <option value="Bimensual">Bimensual</option>
                              <option value="Trimestral">Trimestral</option>
                              <option value="Semestral">Semestral</option>
                              <option value="Anual">Anual</option>
                            </select>
                          </div>
                      </div>


                      <div class="col-md-4">
                        <label for=""><b>Plazos del pago</b></label>
                          <div class="form-group valid-required">
                            <input type="number" name="payment_terms" class="form-control start_simulation" id="payment_terms" required disabled>
                          </div>
                      </div>


                      <div class="col-md-4">
                        <label for=""><b>Fecha de cobro</b></label>
                          <div class="form-group valid-required">
                            <input type="date" name="payment_date" class="form-control start_simulation selectized" id="payment_date" required>
                          </div>
                      </div>

                  </div>

                </div>
              </div>



              <div class="row">
              
                <div class="col-md-12">
                  
                  <div class="card shadow mb-4">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Simulacion de pagos</h6>
                    </div>
                    <div class="card-body">

                      <div class="row">
                        <div class="col-md-12">
                          <table class="table table-bordered" id="table-simulation" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>Numero de Cuota</th>
                                <th>Fecha de Pago</th>
                                <th>Monto</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                          </table>

                        </div>
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

