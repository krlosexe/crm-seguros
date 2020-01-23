<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Polizas</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf



        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-edit" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item remove-pay">
                <a href="#default-tab-2-edit" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Vinculados</a>
            </li>

            <li class="nav-item">
                <a href="#default-tab-3-edit" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Anexos</a>
            </li>
        </ul>



        <div class="tab-content">
          <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-edit">

            <input type="hidden" name="_method" value="put">
        
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
                                <select name="type_poliza" class="form-control selectized" id="type_poliza_edit">
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
                                <input type="text" name="number_policies" class="form-control form-control-user" id="number_policies_edit" placeholder="Numero de póliza" required>
                              </div>
                          </div>

                          <div class="col-md-4">
                            <label for=""><b>Estado Póliza*</b></label>
                              <div class="form-group valid-required">
                                <select name="state_policies" class="form-control selectized" id="state_policies_edit" required>
                                  <option value="">Seleccione</option>
                                  <option value="Vigente">Vigente</option>
                                  <option value="Vencida">Vencida</option>
                                  <option value="No renovada">No renovada</option>
                                  <option value="Expedición">Expedición</option>
                                  <option value="Devengada">Devengada</option>
                                  <option value="Cotización">Cotización</option>
                                  <option value="Cancelada">Cancelada</option>
                                </select>
                              </div>
                          </div>

                          <div class="col-md-4">
                            <label for="is_renewable_edit"><b>Es renovable?</b><br></label><br>
                            <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                  <input type="checkbox" name="is_renewable" id="is_renewable_edit" checked="checked">
                                  <label for="is_renewable_edit"></label>
                            </div>
                          </div>
                        </div>


                        <div class="row">
                        
                            <div class="col-md-6">
                              <label for=""><b>Aseguradora*</b></label>
                                <div class="form-group valid-required">
                                  <select name="insurers"  id="insurers_edit" required>
                                    <option value="">Seleccione</option>
                                  </select>
                                </div>
                            </div>


                            <div class="col-md-6">
                              <label for=""><b>Ramo*</b></label>
                                <div class="form-group valid-required">
                                  <select name="branch"  id="branch_edit" required>
                                    <option value="">Seleccione</option>
                                  </select>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                              <label for=""><b>Fecha expedicion</b></label>
                              <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date_edit">
                            </div>


                            <div class="col-sm-6">
                              <label for=""><b>Fecha Recepcion</b></label>
                              <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date_edit">
                            </div>

                            
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-sm-6">
                              <label for=""><b>Fecha inicio *</b></label>
                              <input type="date" name="start_date" class="form-control form-control-user" id="start_date_edit" required>
                            </div>

                            <div class="col-sm-6">
                              <label for=""><b>Fecha Fin *</b></label>
                              <input type="date" name="end_date" class="form-control form-control-user" id="end_date_edit" required>
                            </div>
                            
                            
                        </div>


                          <br>

                        <div class="row remove">
                          <div class="col-md-12">
                            <label for=""><b>Riesgo (Placa, Direccion, etc)*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="risk" class="form-control form-control-user" id="risk_edit" placeholder="Codigo Objeto Asegurado" required>
                              </div>
                          </div>
                        </div>

                        <br>

                        <div class="row">
                          <div class="col-md-12">
                              <label for=""><b>Cliente *</b></label>
                                <div class="form-group valid-required">
                                  <select class="selectized" id="clients_select_edit" required>
                                    <option value="">Seleccione</option>
                                  </select>
                                </div>

                                <input type="hidden" name="type_clients" id="type_clients_edit">
                                <input type="hidden" name="clients" id="clients_edit">
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
                                <input type="text" name="name_taker" class="form-control form-control-user" id="name_taker_edit" placeholder="Nombre Tomador" required>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Documento del Tomador*</b></label>
                              <div class="form-group valid-required">
                                <input type="text" name="identification_taker" class="form-control form-control-user" id="identification_taker_edit" placeholder="Docuemnento Tomador" required>
                              </div>
                          </div>
                        </div>

                        <br>



                        <div class="remove">
                          <div class="row">
                              <div class="col-md-6">
                                <label for=""><b>Nombre Asegurado*</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="name_insured" class="form-control form-control-user" id="name_insured_edit" placeholder="Nombre Asegurado" required>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <label for=""><b>Documento del Asegurado*</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="identification_insured" class="form-control form-control-user" id="identification_insured_edit" placeholder="Documento del Asegurado" required>
                                  </div>
                              </div>
                          </div>

                          <br>
                        </div>
                        


                        <div class="remove">
                          <div class="row">
                            <div class="col-md-12">
                              <h6 class="m-0 font-weight-bold text-primary">Beneficiarios</h6>
                            </div> <br> <br>
                            <div class="col-md-6">
                              <label for="beneficiary_remission_edit"><b>¿Beneficiarios en la remisión?</b><br></label><br>
                              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                    <input type="checkbox" name="beneficiary_remission" id="beneficiary_remission_edit" checked="checked">
                                    <label for="beneficiary_remission_edit"></label>
                              </div>
                            </div>


                            <div class="col-md-6">
                              <label for="beneficairy_onerous_edit"><b>Beneficiario Oneroso</b><br></label><br>
                              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                    <input type="checkbox" name="beneficairy_onerous" id="beneficairy_onerous_edit" checked="checked">
                                    <label for="beneficairy_onerous_edit"></label>
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
                                            <input type="text" name="beneficairy_name" class="form-control" id="beneficairy_name_edit" placeholder="Nombre del Beneficiario">
                                          </td>

                                          <td>
                                            <input type="text" name="beneficairy_identification" class="form-control" id="beneficairy_identification_edit" placeholder="Documento del Beneficiario">
                                          </td>
                                      </tr>
                                  </tbody>
                              </table>
                            </div>
                            


                          </div>

                          <br>
                        </div>
                        

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
                                <textarea name="internal_observations" class="form-control" id="internal_observations_edit" cols="30" rows="10"></textarea>
                              </div>
                          </div>

                          <div class="col-md-6">
                            <label for=""><b>Observaciones</b></label>
                              <div class="form-group valid-required">
                                <textarea name="observations" id="observations_edit" class="form-control" cols="30" rows="10"></textarea>
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
                                  <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales" id="cousin_edit" required value="0" style="text-align: right">
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales" id="xpenses_edit" value="0" style="text-align: right">
                                </div>
                            </div>
                        </div>
                      
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                              <label for=""><b>IVA</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="vat" class="form-control form-control-user" id="vat_edit" readonly value="0" style="text-align: right">
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>% IVA Prima*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin_edit" readonly>
                                </div>
                            </div>
                        </div>
                      
                        <br>

                        <div class="row">
                            <div class="col-md-6">
                              <label for=""><b>Porcentaje Comisión</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="commission_percentage" class="form-control form-control-user" id="commission_percentage_edit" readonly style="text-align: right">
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Participación</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="participation" class="form-control form-control-user" id="participation_edit">
                                </div>
                            </div>
                        </div>
                      
                        <br>


                        <div class="row">
                            <div class="col-md-6">
                              <label for=""><b>Comisión agencia</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission_edit" readonly value="0" style="text-align: right">
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Total</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="total" class="form-control form-control-user" id="total_edit" readonly value="0" style="text-align: right">
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
                                <select name="payment_method" class="form-control start_simulation selectized" id="payment_method_edit" required disabled>
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
                                <select name="payment_period" class="form-control start_simulation selectized" id="payment_period_edit" required disabled>
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
                                <input type="number" name="payment_terms" class="form-control start_simulation" id="payment_terms_edit" required disabled>
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
                          <h6 class="m-0 font-weight-bold text-primary">Simulacion de pagos</h6>
                        </div>
                        <div class="card-body">

                          <div class="row">

                          <div class="col-md-12">

                          <table class="table table-bordered" id="table-simulation-edit" width="100%" cellspacing="0">
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

            <!---END ROW-->
          </div>



          <div role="tabpanel" class="tab-pane fade in" id="default-tab-2-edit">
            <div class="embed-responsive embed-responsive-16by9">

              <iframe class="embed-responsive-item " id="iframeVinculadosEdit" allowfullscreen>

              </iframe>

            </div>
          </div>



          <div role="tabpanel" class="tab-pane fade in" id="default-tab-3-edit">
            <div class="embed-responsive embed-responsive-16by9">

              <iframe class="embed-responsive-item " id="iframeAnnexesEdit" allowfullscreen>

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

