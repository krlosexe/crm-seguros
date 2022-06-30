@extends('layouts.app')
	

	@section('content')
	
	<style type="text/css">
		.drawpolizas .toggle-group .btn{
			margin: 0 !important;
		}
	</style>
		 <!-- Content Wrapper START -->
		 <div class="main-content">


         <div class="card shadow mb-4" id="cuadro3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Pólizas.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <ul class="nav nav-pills" role="tablist">


            <li class="nav-item">
                <a href="#default-tab-1" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item remove-pay">
                <a href="#default-tab-2" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Vinculados</a>
            </li>


            <li class="nav-item">
                <a href="#default-tab-3-view" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Anexos</a>
            </li>

            <li class="nav-item informacion-pagos">
                <a href="#default-tab-4-view" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>

            <li class="nav-item informacion-pagos">
                <a href="#default-tab-5-view" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Cartera</a>
            </li>


        </ul>
        <br><br>

        <div class="tab-content">
           <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1">
            
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
                                  <select name="type_poliza" class="form-control selectized" id="type_poliza_view">
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
                                  <input type="text" name="number_policies" class="form-control form-control-user" id="number_policies_view" placeholder="Numero de póliza" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                              <label for=""><b>Estado Póliza*</b></label>
                                <div class="form-group valid-required">
                                  <select name="state_policies" class="form-control selectized" id="state_policies_view" required>
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
                            <label for=""><b>Tipo de negocio*</b></label>
                              <div class="form-group valid-required">
                                <select name="business_type" class="form-control selectized" id="business_type_view">
                                    <option value="">Seleccione</option>
                                    <option value="Renovado">Renovado</option>
                                    <option value="Nuevo Cliente">Nuevo Cliente</option>
                                  </select>
                              </div>
                          </div>



                            <div class="col-md-4">
                              <label for="is_renewable"><b>¿Es renovable?</b><br></label><br>
                              <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                    <input type="checkbox" name="is_renewable" id="is_renewable_view" checked="checked">
                                    <label for="is_renewable"></label>
                              </div>
                            </div>
                          </div>


                          <div class="row">
                          
                              <div class="col-md-6">
                                <label for=""><b>Aseguradora*</b></label>
                                  <div class="form-group valid-required">
                                    <select name="insurers"  id="insurers_view" required>
                                      <option value="">Seleccione</option>
                                    </select>
                                  </div>
                              </div>


                              <div class="col-md-6">
                                <label for=""><b>Ramo*</b></label>
                                  <div class="form-group valid-required">
                                    <select name="branch"  id="branch_view" required>
                                      <option value="">Seleccione</option>
                                    </select>
                                  </div>
                              </div>

                          </div>


                          <div class="row">
                              <div class="col-sm-6">
                                <label for=""><b>Fecha expedición</b></label>
                                <input type="date" name="expedition_date" class="form-control form-control-user" id="expedition_date_view">
                              </div>


                              <div class="col-sm-6">
                                <label for=""><b>Fecha Recepción</b></label>
                                <input type="date" name="reception_date" class="form-control form-control-user" id="reception_date_view">
                              </div>

                              
                          </div>
                          <br>

                          <div class="row">
                              <div class="col-sm-6">
                                <label for=""><b>Fecha inicio *</b></label>
                                <input type="date" name="start_date" class="form-control form-control-user" id="start_date_view" required>
                              </div>

                              <div class="col-sm-6">
                                <label for=""><b>Fecha Fin *</b></label>
                                <input type="date" name="end_date" class="form-control form-control-user" id="end_date_view" required>
                              </div>
                              
                              
                          </div>


                            <br>

                          <div class="row remove">
                            <div class="col-md-12">
                              <label for=""><b>Riesgo (Placa, Dirección, etc)*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="risk" class="form-control form-control-user" id="risk_view" placeholder="Codigo Objeto Asegurado" required>
                                </div>
                            </div>
                          </div>

                          <br>

                          <div class="row">
                            <div class="col-md-12">
                                <label for=""><b>Cliente *</b></label>
                                  <div class="form-group valid-required">
                                    <select class="selectized" id="clients_select_view" required>
                                      <option value="">Seleccione</option>
                                    </select>
                                  </div>

                                  <input type="hidden" name="type_clients" id="type_clients_view">
                                  <input type="hidden" name="clients" id="clients_view">
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
                                  <input type="text" name="name_taker" class="form-control form-control-user" id="name_taker_view" placeholder="Nombre Tomador" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Documento del Tomador*</b></label>
                                <div class="form-group valid-required">
                                  <input type="text" name="identification_taker" class="form-control form-control-user" id="identification_taker_view" placeholder="Docuemnento Tomador" required>
                                </div>
                            </div>
                          </div>

                          <br>



                          <div class="remove">
                            <div class="row">
                                <div class="col-md-6">
                                  <label for=""><b>Nombre Asegurado*</b></label>
                                    <div class="form-group valid-required">
                                      <input type="text" name="name_insured" class="form-control form-control-user" id="name_insured_view" placeholder="Nombre Asegurado" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                  <label for=""><b>Documento del Asegurado*</b></label>
                                    <div class="form-group valid-required">
                                      <input type="text" name="identification_insured" class="form-control form-control-user" id="identification_insured_view" placeholder="Documento del Asegurado" required>
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
                                <label for="beneficiary_remission"><b>¿Beneficiarios en la remisión?</b><br></label><br>
                                <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                      <input type="checkbox" name="beneficiary_remission" id="beneficiary_remission_view" checked="checked">
                                      <label for="beneficiary_remission"></label>
                                </div>
                              </div>


                              <div class="col-md-6">
                                <label for="beneficairy_onerous"><b>Beneficiario Oneroso</b><br></label><br>
                                <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                      <input type="checkbox" name="beneficairy_onerous" id="beneficairy_onerous_view" checked="checked">
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
                                              <input type="text" name="beneficairy_name" class="form-control" id="beneficairy_name_view" placeholder="Nombre del Beneficiario">
                                            </td>

                                            <td>
                                              <input type="text" name="beneficairy_identification" class="form-control" id="beneficairy_identification_view" placeholder="Documento del Beneficiario">
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
                                  <textarea name="internal_observations" class="form-control" id="internal_observations_view" cols="30" rows="10"></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                              <label for=""><b>Observaciones</b></label>
                                <div class="form-group valid-required">
                                  <textarea name="observations" id="observations_view" class="form-control" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                          </div>

                          <br>


                          <div class="row">
                            <div class="col-md-12">
                              <label><b>Caratula</b></label>
                            </div>
                            <div class="col-md-12 text-center">
                              <div class="kv-avatar">
                                <div class="file-loading">
                                  <input id="input-file-view" name="file_caratula" type="file">
                                </div>
                              </div>

                              <div class="kv-avatar-hintss">
                                <small>Seleccione un archivo</small>
                              </div>

                            </div>
                          </div>


                        </div>
                      </div>
                    </div>
                    
                  </div>


                </div>




                <div class="col-md-6">

                  <div class="row remove informacion-pagos">

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
                                    <input type="text" name="cousin" class="form-control form-control-user monto_formato_decimales" id="cousin_view" required value="0" style="text-align: right">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <label for=""><b>Gastos (Expedición,Runt,Fosyga) *</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="xpenses" class="form-control form-control-user monto_formato_decimales" id="xpenses_view" value="0" style="text-align: right">
                                  </div>
                              </div>
                          </div>
                        
                          <br>

                          <div class="row">
                              <div class="col-md-6">
                                <label for=""><b>IVA</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="vat" class="form-control form-control-user" id="vat_view" readonly value="0" style="text-align: right">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <label for=""><b>% IVA Prima*</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="percentage_vat_cousin" class="form-control form-control-user" id="percentage_vat_cousin_view" readonly>
                                  </div>
                              </div>
                          </div>
                        
                          <br>

                          <div class="row">
                              <div class="col-md-6 row-participacion">
                                <label for=""><b>Porcentaje Comisión</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="commission_percentage" class="form-control form-control-user" id="commission_percentage_view" readonly style="text-align: right">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <label for=""><b>Participación</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="participation" class="form-control form-control-user" id="participation_view" value="100">
                                  </div>
                              </div>

                              <div class="col-md-6 row-participacion">
                                <label for=""><b>Comisión agencia</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="agency_commission" class="form-control form-control-user" id="agency_commission_view" readonly value="0" style="text-align: right">
                                  </div>
                              </div>

                              <div class="col-md-6">
                                <label for=""><b>Total</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="total" class="form-control form-control-user" id="total_view" readonly value="0" style="text-align: right">
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
                          <h6 class="m-0 font-weight-bold text-primary">Vehículos asociados</h6>
                        </div>
                        <div class="card-body">

                          <div class="row">
                              <!-- <div class="col-md-8">
                                <label for=""><b>Placa del vehículo *</b></label>
                                  <div class="form-group valid-required">
                                    <input type="text" name="placa" class="form-control form-control-user" id="placa" placeholder="FHP803" style="text-align: left" required>
                                  </div>
                                  
                              </div>
                              <div class="col-md-4">
                                    <label for=""><b>Añadir nuevo *</b></label>
                                    <div class="form-group valid-required">
                                    <button type="button" class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-vehicle">
                                                        <i class="fa fa-plus" ></i>
                                                    </button>
                                                      </div>
                              </div> -->

                          </div>   


                          <table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>Placas</th>
                                      <th></th>
                                  </tr>
                              </thead>

                              <tbody id="table-placas-view"></tbody>
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
                        <h6 class="m-0 font-weight-bold text-primary">Familiares</h6>
                      </div>
                      <div class="card-body">

                        <table class="table table-bordered" id="table-view-familiares">
                            <thead>
                                <tr>
                                    <th width="40%">Nombre</th>
                                    <th width="40%">Documento</th>
                                    <th width="20%">

                                    </th>
                                </tr>
                            </thead>

                            <tbody></tbody>
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
                                  <input type="checkbox" name="send_policies_for_expire_email" id="send_policies_for_expire_email_view">
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
                                  <input type="checkbox" name="send_portfolio_for_expire_email" id="send_portfolio_for_expire_email_view">
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
                                  <input type="checkbox" name="send_policies_for_expire_sms" id="send_policies_for_expire_sms_view">
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
                                  <input type="checkbox" name="send_portfolio_for_expire_sms" id="send_portfolio_for_expire_sms_view">
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


                  <div class="row informacion-pagos">
                  
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
                                    <select name="payment_method" class="form-control start_simulation selectized" id="payment_method_view" required>
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
                                    <select name="payment_period" class="form-control start_simulation selectized" id="payment_period_view" required disabled>
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
                                    <input type="number" name="payment_terms" class="form-control start_simulation" id="payment_terms_view" required disabled>
                                  </div>
                              </div>
                            </div>

                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="row simulacion-pagos">
              
                    <div class="col-md-12">
                      
                      <div class="card shadow mb-4">
                        <div class="card-header py-3">
                          <h6 class="m-0 font-weight-bold text-primary">Simulación de pagos</h6>
                        </div>
                        <div class="card-body">

                          <div class="row">

                          <div class="col-md-12">

                          <table class="table table-bordered" id="table-simulation-view" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>Número de Cuota</th>
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
                  </div></div>



                  <div class="row" id="history">
                      <div class="col-md-12">
                        
                        <div class="card shadow mb-4">
                          <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Historial</h6>
                          </div>
                          <div class="card-body">

                            <div class="row">

                            <div class="col-md-12">
                                <div id="logs_edit"></div>


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

           <div role="tabpanel" class="tab-pane fade in" id="default-tab-2">

              <div class="embed-responsive embed-responsive-16by9">

                <iframe class="embed-responsive-item " id="iframeVinculadosView" allowfullscreen>

                </iframe>

              </div>

          </div>


          <div role="tabpanel" class="tab-pane fade in" id="default-tab-3-view">
            <div class="embed-responsive embed-responsive-16by9">

              <iframe class="embed-responsive-item " id="iframeAnnexesView" allowfullscreen>

              </iframe>

            </div>
          </div>


          <div role="tabpanel" class="tab-pane fade in" id="default-tab-4-view">
            <div class="embed-responsive embed-responsive-16by9">

              <iframe class="embed-responsive-item " id="iframeDigitalesView" allowfullscreen>
                dasdasd
              </iframe>

            </div>
          </div>



          <div role="tabpanel" class="tab-pane fade in" id="default-tab-5-view">
            <div class="embed-responsive embed-responsive-16by9">

              <iframe class="embed-responsive-item " id="iframeCarteraView" allowfullscreen>
                dasdasd
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
            <!--<button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro3')">
                Cancelar
            </button>-->
          </center>
          <br>
          <br>
      </form>
      
    </div>



			<div class="modal fade" id="modal-lg" aria-hidden="true" style="display: none;">
			
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h3>Vinculados</h3>
						</div>
						<div class="modal-body">
							<form action="" id="form-bind">
								<div class="row">
									 
									 <input id="count_fila" hidden value="nuevo">

									<div class="col-md-6">
										<label for=""><b>No. Anexo</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="number_anexo_bind">
										</div>
									</div>


									<div class="col-md-6">
										<label for=""><b>Numero afiliado*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="number_affiliate_bind" required>
										</div>
									</div>

								</div>


								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Fecha de Inicio *</b></label>
										<div class="form-group valid-required">
											<input type="date" class="form-control" id="date_init_bind" required>
										</div>
									</div>


									<div class="col-md-4">
										<label for=""><b>Objeto asegurado*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="insured_object_bind" placeholder="Codigo Objeto Asegurado" required>
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Prima (Mensual, semestral, anual)*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control monto_formato_decimales" id="cousin_bind" required style="text-align: right">
										</div>
									</div>

								</div>


								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Nombre del Afiliado *</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="name_affiliate_bind" required>
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Documento del Afiliado*</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="document_affiliate_bind" placeholder="Documento del Afiliado" required>
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Parentesco</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="relationship_bind">
										</div>
									</div>

								</div>



								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Fecha de nacimiento</b></label>
										<div class="form-group valid-required">
											<input type="date" class="form-control" id="birthdate_bind" >
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Edad</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="age_bind" disabled>
										</div>
									</div>

									<div class="col-sm-4">
										<label for=""><b>Genero*</b></label>
										<select  class="form-control selectize-input items has-options full has-items" id="gender_bind" required>
										<option value="">Seleccione</option>
										<option value="Masculino">Masculino</option>
										<option value="Femenino">Femenino</option>
										</select>
									</div>

								</div>




								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Celular</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="phone_bind">
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Correo</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="email_bind">
										</div>
									</div>

									<div class="col-sm-4">
										<label for=""><b>Dirección*</b></label>
										<input type="text" class="form-control" id="address_bind">
									</div>

								</div>





								<div class="row">

									<div class="col-md-4">
										<label for=""><b>Plan Afiliado</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="plan_bind">
										</div>
									</div>

									<div class="col-md-4">
										<label for=""><b>Tipo Tarifa</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="type_rate_bind">
										</div>
									</div>

									<div class="col-sm-4">
										<label for=""><b>Tipo de Afiliación</b></label>
										<input type="text" class="form-control" id="type_membership_bind">
									</div>

								</div>



								<div class="row">

									<div class="col-md-2">
										<label for=""><b>% IVA</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="percentage_vat_bind">
										</div>
									</div>

									<div class="col-md-3">
										<label for=""><b>Gastos de expedicion</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control monto_formato_decimales" id="expenses_bind" style="text-align: right">
										</div>
									</div>

									<div class="col-sm-3">
										<label for=""><b>IVA</b></label>
										<input type="text" class="form-control" id="vat_bind" readonly style="text-align: right">
									</div>


									<div class="col-sm-4">
										<label for=""><b>Total</b></label>
										<input type="text" class="form-control" id="total_bind" style="text-align: right" readonly>
									</div>

								</div>



								<div class="row">

									<div class="col-md-6">
										<label for=""><b>Empresa</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="company_bind">
										</div>
									</div>


									<div class="col-md-6">
										<label for=""><b>Empleado</b></label>
										<div class="form-group valid-required">
											<input type="text" class="form-control" id="employee_bind">
										</div>
									</div>

								</div>



								<div class="row">
									<div class="col-md-6">
										<label for=""><b>Observaciones Internas</b></label>
										<div class="form-group valid-required">
											<textarea class="form-control" id="internal_observations_bind" cols="30" rows="10"></textarea>
										</div>
									</div>

									<div class="col-md-6">
										<label for=""><b>Observaciones</b></label>
										<div class="form-group valid-required">
											<textarea  id="observations_bind" class="form-control" cols="30" rows="10"></textarea>
										</div>
									</div>
								</div>



								<div class="row">

									<div class="col-md-12">
										<h6 class="m-0 font-weight-bold text-primary">Beneficiarios</h6>
									</div> <br> <br>


									<div class="col-md-6">
										<label for="beneficairy_onerous_bind"><b>Beneficiario Oneroso</b><br></label><br>
										<div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
											<input type="checkbox" name="beneficairy_onerous_bind" id="beneficairy_onerous_bind" checked="checked">
											<label for="beneficairy_onerous_bind"></label>

											<input type="hidden" id="beneficairy_onerous_input_bind" value="1">
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
													<input type="text" name="beneficairy_name" class="form-control" id="beneficairy_name_bind" placeholder="Nombre del Beneficiario">
													</td>

													<td>
													<input type="text" name="beneficairy_identification" class="form-control" id="beneficairy_identification_bind" placeholder="Documento del Beneficiario">
													</td>
												</tr>
											</tbody>
										</table>
									</div>


									<div class="col-md-12">
										<button type="submit" id="btn-add-bind" class="btn btn-success" style="float: left;">
										<i class="ti-user"></i>
										<span>Agregar  </span>
										</button>
									</div>

								</div>

							</form>

						</div>
					</div>

				</div>
			</div>


    
                <!-- Content Wrapper END ------->
	@endsection





	@section('CustomJs')

		<script>


			$(document).ready(function(){
				ver()
				GetInsurers2("#insurers-filter")
				GetRamos2("#branch-filter")
				$("#collapse_Pólizas").addClass("show");
				$("#nav_li_Pólizas").addClass("open");
				$("#nav_users, #modulo_Pólizas").addClass("active");
				$("#nav_policies").addClass("active");
				verifyPersmisos(id_user, tokens, "policies");
				
				// ocultar comision y participacion cuando es diferente de administrador

				if(name_rol != 'Administrador'){
					$('.row-participacion').hide()
					$("#history").css("display", "none")
				}else{
					$("#history").css("display", "block")
				}

				

			});


			function GetInsurers2(select, select_default = false){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/insurers',
				  type:'GET',
				  data: {
					  "id_user": id_user,
					  "token"  : tokens,
					},
				  dataType:'JSON',
				  async: false,
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  
					$(select).each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });
				   
					$(select+" option").remove();
					$(select).append($('<option>',
					{
					  value: "0",
					  text : "Seleccione"
					}));
					$.each(data, function(i, item){
					  if (item.status == 1) {
						$(select).append($('<option>',
						{
						  value: item.id_insurers,
						  text : item.name,
						  selected: select_default == item.id_insurers ? true : false
						}));
					  }
					});
					
				  }
				});
			}


			function GetRamos2(select){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/branchs',
				  type:'GET',
				  data: {
					  "id_user": id_user,
					  "token"  : tokens,
					},
				  dataType:'JSON',
				  async: false,
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
					$(select+" option").remove();
					$(select).append($('<option>',
					{
					  value: "0",
					  text : "Seleccione"
					}));
					$.each(data, function(i, item){
					  if (item.status == 1) {
						$(select).append($('<option>',
						{
						  value: item.id_branchs,
						  text : item.name,
						  
						}));
					  }
					});
			  
				  }
				});
			  }




			  


			function drawPolizas(){
				list();
			}


			function update(){
				enviarFormularioPut("#form-update", 'api/policies', '#cuadro4', false, "#avatar-edit");
			}


			function store(){
				enviarFormulario("#store", 'api/policies', '#cuadro2');
			}



			$("#state_policies-filter, #insurers-filter, #branch-filter, #date_init-filter, #date_end-filter").change(function (e) { 
				list();
			});


			$("#number_document-filter").keyup(function (e) { 
				list();
			});


			$("#placa-filter").keyup(function (e) { 
				list();
			});


			function list(cuadro) {
				var data = {
					"id_user": id_user,
					"token"  : tokens,
				};

				let proximas_a_vencer = document.querySelector('#switchpolizas').checked? 1 : 0;

				$('#table tbody').off('click');
				var url=document.getElementById('ruta').value; 
				cuadros(cuadro, "#cuadro1");

				var table=$("#table").DataTable({
					"destroy":true,
					"stateSave": true,
					"serverSide":true,
          			"processing": true,
					"ajax":{
						"method":"POST",
						 "url":''+url+'/api/policies/paginate',
						 "data": {
							"id_user": id_user,
							"token"  : tokens,
							'proximas_a_vencer': proximas_a_vencer,
							"state" : $("#state_policies-filter").val(),
							"insurance" : $("#insurers-filter").val(),
							"branch" : $("#branch-filter").val(),
							"date_init" : $("#date_init-filter").val(),
							"date_finish" : $("#date_end-filter").val(),
							"document" : $("#number_document-filter").val(),
							"placa" : $("#placa-filter").val()
						},
					},
					"columnDefs":[
						
						{targets: 0, "data":"number_policies"},
						{targets: 1, "data":null,
							render : function(data, type, row) {
								if(row.type_clients == 0){
									return row.fullname
								}else{
									return row.business_name
								}
									
							}
						},
						{targets: 2, "data":"name_insurers"},
						{targets: 3, "data":"name_branchs"},
						{targets: 4, "data":"risk"},
						{targets: 5, "data":"state_policies"},
						{targets: 6, "data": "start_date"},
						{targets: 7, "data": null,
							render : function(data, type, row) {
								var botones = "";
								if(consultar == 1)
									botones += "<span class='consultar btn btn-info waves-effect' data-toggle='tooltip' title='Consultar'><i class='ei-preview' style='margin-bottom:5px'></i></span> ";
								if(actualizar == 1)
									botones += "<span class='editar btn btn-primary waves-effect' data-toggle='tooltip' title='Editar'><i class='ei-save-edit' style='margin-bottom:5px'></i></span> ";
								if(data.status == 1 && actualizar == 1)
									botones += "<span class='desactivar btn btn-warning waves-effect' data-toggle='tooltip' title='Desactivar'><i class='fa fa-unlock' style='margin-bottom:5px'></i></span> ";
								else if(data.status == 2 && actualizar == 1)
									botones += "<span class='activar btn btn-success waves-effect' data-toggle='tooltip' title='Activar'><i class='fa fa-lock' style='margin-bottom:5px'></i></span> ";
								if(borrar == 1)
									botones += "<span class='eliminar btn btn-danger waves-effect' data-toggle='tooltip' title='Eliminar'><i class='ei-delete-alt' style='margin-bottom:5px'></i></span>";
								return botones;
							}
						}
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,
					"buttons": buttonsDatatable({
						title: 'Polizas',
						filename: 'polizas',
						columns: [0,1,2,3,4,5,6],
						async: true
					}),
					initComplete(){
						$('.dt-button').removeClass('dt-button buttons-copy buttons-html5')
					}
				});


				ver("#table tbody", table)
				edit("#table tbody", table)
				activar("#table tbody", table)
				desactivar("#table tbody", table)
				eliminar("#table tbody", table)

				hideElementsByRol();


				var date_init = 0
				if($("#date_init-filter").val() != ""){
					date_init = $("#date_init-filter").val()
				}

				var date_end = 0
				if($("#date_end-filter").val() != ""){
					date_end = $("#date_end-filter").val()
				}

				var cedula = 0
				if($("#number_document-filter").val() != ""){
					cedula = $("#number_document-filter").val()
				}


				var placa = 0
				if($("#placa-filter").val() != ""){
					placa = $("#placa-filter").val()
				}



				$(".buttons-excel").remove()
				$("#xls").remove();
				$("#view_xls").remove();

				var a = '<button id="xls" class="buttons-excel btn btn-sm btn-info"><span><i class="fa fa-file-excel-o mr-2"></i> Excel</span></button>';
				$('.dt-buttons').append(a);

				var b = `<button id="view_xls" target="_blank" style="opacity: 0" href="api/exports/policies/${id_user}/${$("#state_policies-filter").val()}/${$("#insurers-filter").val()}/${$("#branch-filter").val()}/${date_init}/${date_end}/${cedula}/${placa}" class="dt-button buttons-excel buttons-html5">xls</button>`;
				$('.dt-buttons').append(b);

				$("#xls").click(function (e) {
					url = $("#view_xls").attr("href");
					console.log(url)
					window.open(url, '_blank');
				});





			}

			function hideElementsByRol(){
				// rol municipio
				if(id_rol == 22){
					$('.informacion-pagos, .simulacion-pagos').hide();
				}
			}

			function nuevo() {

				$("#alertas").css("display", "none");
				$("#store")[0].reset();
				$(".container-datos-adicionales-hijo").css("display", "none");
				$(".container-datos-adicionales-vehicle").css("display", "none");

				GetInsurers("#insurers")

				GetBranchByInsurers("#insurers", "#branch")
				GetClients("#clients_select");

				ChangeSelectBranch("#branch")

				methodsPays("#payment_method", "#payment_period", "#payment_terms", "#payment_date")

				StartSimulation(".start_simulation", "#payment_method", "#payment_period", "#payment_terms","#payment_date", "#total", "#table-simulation")

				/*GetPlacas("#placa")*/
				asyncPlacaVehiculos("#placa")

				$('#table-store-familiares tbody').html('');

				$(".remove").css("display", "block")
				$(".remove-pay").css("display", "none")

				$('#input-file-store').fileinput('destroy').val('');
			
				initFileInput('#input-file-store')

				cuadros("#cuadro1", "#cuadro2");
			}	


			function initFileInput(id){
				$(id).fileinput({
					theme: "fas",
					overwriteInitial: true,
					maxFileSize: 10000,
					showClose: false,
					showCaption: false,
					browseLabel: '',
					removeLabel: '',
					browseIcon: '<i class="fa fa-folder-open"></i>',
					removeIcon: '<i class="ei-delete-alt"></i>',
					previewFileIcon: '<i class="fas fa-file"></i>',
					removeTitle: 'Cancel or reset changes',
					elErrorContainer: '#kv-avatar-errors-1',
					msgErrorClass: 'alert alert-block alert-danger',
					layoutTemplates: {main2: '{preview}  {remove} {browse}'},
					allowedFileExtensions: ["jpg", "png", "gif", "pdf", "PDF"],
				});
			}


			


			function GetPlacas(select){
				
				var url=document.getElementById('ruta').value;
				$.ajax({
				  url:''+url+'/api/vehicle',
				  type:'GET',
				  data: {
					  "id_user": id_user,
					  "token"  : tokens,
					},
				  dataType:'JSON',
				  async: false,
				  beforeSend: function(){
				  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
				  },
				  error: function (data) {
					//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
				  },
				  success: function(data){
			  		console.log(data)
					$(select).each(function() {
					  if (this.selectize) {
						this.selectize.destroy();
					  }
				   });

				   
					$(select+" option").remove();

					$(select).append($('<option>',
					{
					  value: "null",
					  text : "Seleccione"
					}));

			  
					$.each(data, function(i, item){
					  
					  if (item.status == 1) {
						$(select).append($('<option>',
						{
						  value: item.placa,
						  text : item.placa
						}));

					  }
					});
			  
					$(select).selectize({
					  //sortField: 'text'
					});

				  }
				});
			}


			function asyncPlacaVehiculos(select,defaultPlaca){
				// $('#policie').select2('destroy');

		      if(defaultPlaca != undefined){
		      	$(select).append(`<option value="${defaultPlaca.id}">${defaultPlaca.text}</option>`).trigger('change')
		      }

				$(select).select2({
				  width: '100%',
				language: {
				  noResults: function() {
				    return "No hay resultado";        
				  },
				  searching: function() {
				    return "Buscando..";
				  },
				  inputTooShort: function () {
				    return "Colocar mínimo 2 caracteres para buscar...";
				  }
				},
				  ajax: {
				  	delay: 300,
				    url: `${ruta.value}/api/vehicles/asyncPlacaVehiculos`,
				    data(params) {
				    
				      return {
				      	search: params.term,
				      	type: 'public'
				      }
				    },
				    processResults(data) {
				      let results = data.map(item => ({
				      		id: item.placa,
				      		text: item.placa
				      	}))

				      return { results };
				    }
				  }
				})


		
			}


			  



			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function ver(){

				$("#alertas").css("display", "none");

					var url=document.getElementById('ruta').value;

					$.ajax({
					  url:''+url+'/api/policies/'+{{$id_policie}},
					  type:'GET',
					  data: {
						  "id_user": id_user,
						  "token"  : tokens,
					  },
					  dataType:'JSON',
					  beforeSend: function(){
					  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					  },
					  error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					  },
					  success: function(data){


							$("#insurers_view").attr("disabled", "disabled")
							$("#branch_view").attr("disabled", "disabled")
							$("#clients_select_view").attr("disabled", "disabled")
							GetInsurers("#insurers_view", data.insurers)

							GetBranchByInsurers("#insurers_view", "#branch_view", data.branch+"|"+data.percentage_vat_cousin+"|"+data.commission_percentage, data.branch, data.type_poliza)
							GetClients("#clients_select_view", data.clients+"|"+data.type_clients);

							ChangeSelectBranch("#branch_view")

							if(data.type_poliza == "Collective"){
								$(".remove").css("display", "none")
								$(".remove-pay").css("display", "block")


								var url = "binds/"+data.id_policies+"/0"
								$('#iframeVinculadosView').attr('src', url);

							}else{
								$(".remove").css("display", "block")
								$(".remove-pay").css("display", "none")
							}

							$("#business_type_view").val(data.business_type).attr("disabled", "disabled")
							$("#type_poliza_view").val(data.type_poliza).attr("disabled", "disabled")
							$("#number_policies_view").val(data.number_policies).attr("disabled", "disabled")
							$("#state_policies_view").val(data.state_policies).attr("disabled", "disabled")
							$("#expedition_date_view").val(data.expedition_date).attr("disabled", "disabled")
							$("#reception_date_view").val(data.reception_date).attr("disabled", "disabled")
							$("#start_date_view").val(data.start_date).attr("disabled", "disabled")
							$("#end_date_view").val(data.end_date).attr("disabled", "disabled")
							$("#risk_view").val(data.risk).attr("disabled", "disabled")

							$("#name_taker_view").val(data.name_taker).attr("disabled", "disabled")
							$("#identification_taker_view").val(data.identification_taker).attr("disabled", "disabled")
							$("#name_insured_view").val(data.name_insured).attr("disabled", "disabled")
							$("#identification_insured_view").val(data.identification_insured).attr("disabled", "disabled")
							$("#beneficairy_name_view").val(data.beneficairy_name).attr("disabled", "disabled")
							$("#beneficairy_identification_view").val(data.beneficairy_identification).attr("disabled", "disabled")

							$("#internal_observations_view").val(data.internal_observations).attr("disabled", "disabled")
							$("#observations_view").val(data.observations).attr("disabled", "disabled")


							$("#cousin_view").val(number_format(data.cousin, 2)).attr("disabled", "disabled")
							$("#xpenses_view").val(number_format(data.xpenses, 2)).attr("disabled", "disabled")
							$("#vat_view").val(number_format(data.vat, 2)).attr("disabled", "disabled")
							$("#percentage_vat_cousin_view").val(data.percentage_vat_cousin).attr("disabled", "disabled")
							$("#commission_percentage_view").val(data.commission_percentage).attr("disabled", "disabled")
							$("#participation_view").val(data.participation).attr("disabled", "disabled")
							$("#agency_commission_view").val(number_format(data.agency_commission, 2)).attr("disabled", "disabled")
							$("#total_view").val(number_format(data.total, 2)).attr("disabled", "disabled")

							$("#payment_period_view").val(data.payment_period).attr("disabled", "disabled")
							$("#payment_method_view").val(data.payment_method).attr("disabled", "disabled")
							$("#payment_terms_view").val(data.payment_terms).attr("disabled", "disabled")

							
							$("#insurers_view").trigger("change");
							data.is_renewable == 1 ? $("#is_renewable_view").prop("checked", true) : $("#is_renewable_view").prop("checked", false) 
							data.beneficiary_remission == 1 ? $("#beneficiary_remission_view").prop("checked", true) : $("#beneficiary_remission_view").prop("checked", false)
							data.beneficairy_onerous == 1 ? $("#beneficairy_onerous_view").prop("checked", true) : $("#beneficairy_onerous_view").prop("checked", false)

							data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_view").prop("checked", true)  : $("#send_policies_for_expire_email_view").prop("checked", false) 
							data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_view").prop("checked", true) : $("#send_portfolio_for_expire_email_view").prop("checked", false) 
							data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_view").prop("checked", true)    : $("#send_policies_for_expire_sms_view").prop("checked", false) 
							data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_view").prop("checked", true)   : $("#send_portfolio_for_expire_sms_view").prop("checked", false) 
							
							showPays(data.id_policies, "#table-simulation-view")

							var html = ""
							$.map(data.vehicules, function (item, key) {
								html += "<tr>"
									html +="<td><a target='_blank' href='vehicles/"+item.placa+"'>"+item.placa+"</a><input type='hidden' name='placas[]' value='"+item.placa+"'></td>"
									html +="<td></td>"
								html += "</tr>"
							});

							$("#table-placas-view").html(html)

							$('#table-view-familiares tbody').html('');

							data.familiares.forEach(item => {
								addFamiliar(document.querySelector('#table-view-familiares'), item, false)
							})


							var url = "policies/annexes/"+data.id_policies+"/0"
							$('#iframeAnnexesView').attr('src', url);


							var url = "policies/files/"+data.id_policies+"/0"
							$('#iframeDigitalesView').attr('src', url);


							var url = "policies/wallet/"+data.id_policies+"/0"
							$('#iframeCarteraView').attr('src', url);


							if(data.file_caratula != null){

								url_imagen = ruta.value + '/img/policies/caratulas/'

								var ext = data.file_caratula.split('.');
								if (ext[1] == "pdf") {
									img = '<embed class="kv-preview-data file-preview-pdf" src="'+url_imagen+data.file_caratula+'" type="application/pdf" style="width:213px;height:160px;" internalinstanceid="174">'
								}else{
									img = '<img src="'+url_imagen+data.file_caratula+'" class="file-preview-image kv-preview-data">'
								}

								console.log(data.file_caratula)

							$('#input-file-view').fileinput('destroy').val('')

								$("#input-file-view").fileinput({
									theme: "fas",
									overwriteInitial: true,
									maxFileSize: 10000,
									showClose: false,
									showCaption: false,
									browseLabel: '',
									removeLabel: '',
									browseIcon: '<i class="fa fa-folder-open"></i>',
									removeIcon: '<i class="fas fa-trash-alt"></i>',
									previewFileIcon: '<i class="fas fa-file"></i>',
									removeTitle: 'Cancel or reset changes',
									elErrorContainer: '#kv-avatar-errors-1',
									msgErrorClass: 'alert alert-block alert-danger',
									layoutTemplates: {main2: '{preview}  {remove} {browse}'},
									allowedFileExtensions: ["jpg", "png", "gif", "pdf", "PDF"],
									initialPreview: [ 
										img
									],
									initialPreviewConfig: [
											
										{caption: data.file_caratula , downloadUrl: url_imagen+data.file_caratula  ,url: url+"uploads/delete", key: data.file_caratula}
								
									],

								});

							}
							else{
							$('#input-file-view').fileinput('destroy').val('')
								initFileInput('#input-file-view');
							}
							hideElementsByRol();

					  }
					});

			}



			/* ------------------------------------------------------------------------------- */
			/* 
				Funcion que muestra el cuadro3 para la consulta del banco.
			*/
			function edit(tbody, table){
				$(tbody).on("click", "span.editar", function(){
					$("#alertas").css("display", "none");

					var info = table.row( $(this).parents("tr") ).data();

					var url=document.getElementById('ruta').value;

					$.ajax({
					  url:''+url+'/api/policies/'+info.id_policies,
					  type:'GET',
					  data: {
						  "id_user": id_user,
						  "token"  : tokens,
					  },
					  dataType:'JSON',
					  beforeSend: function(){
					  // mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
					  },
					  error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
					  },
					  success: function(data){
					
							GetInsurers("#insurers_edit", data.insurers)

							GetBranchByInsurers("#insurers_edit", "#branch_edit", data.branch+"|"+data.percentage_vat_cousin+"|"+data.commission_percentage,  data.branch, data.type_poliza)
							GetClients("#clients_select_edit", data.clients+"|"+data.type_clients);

							$('#clients_select_edit').change();

							/*GetPlacas("#placa-edit")*/

							asyncPlacaVehiculos('#placa-edit',{id: data.placa, text: data.placa})

							ChangeSelectBranch("#branch_edit", "_edit")

							$("#type_poliza_edit").val(data.type_poliza).attr("readonly", "readonly")
							$("#business_type_edit").val(data.business_type)
							
							
							$("#number_policies_edit").val(data.number_policies)
							$("#state_policies_edit").val(data.state_policies)
							$("#expedition_date_edit").val(data.expedition_date)
							$("#reception_date_edit").val(data.reception_date)
							$("#start_date_edit").val(data.start_date)
							$("#end_date_edit").val(data.end_date)
							$("#risk_edit").val(data.risk)

							if(data.type_poliza == "Collective"){
								$(".remove").css("display", "none")
								$(".remove-pay").css("display", "block")

								$('.remove input[required]').attr('disabled', 'disabled');
								$('.remove select[required]').attr('disabled', 'disabled');

								var url = "binds/"+data.id_policies+"/1"
								$('#iframeVinculadosEdit').attr('src', url);

							}else{
								$(".remove").css("display", "block")
								$(".remove-pay").css("display", "none")

								$('.remove-pay input[required]').attr('disabled', 'disabled');
								$('.remove-pay select[required]').attr('disabled', 'disabled');
							}



							$("#name_taker_edit").val(data.name_taker)
							$("#identification_taker_edit").val(data.identification_taker)
							$("#name_insured_edit").val(data.name_insured)
							$("#identification_insured_edit").val(data.identification_insured)
							$("#beneficairy_name_edit").val(data.beneficairy_name)
							$("#beneficairy_identification_edit").val(data.beneficairy_identification)

							$("#internal_observations_edit").val(data.internal_observations)
							$("#observations_edit").val(data.observations)


							$("#cousin_edit").val(number_format(data.cousin, 2))
							$("#xpenses_edit").val(number_format(data.xpenses, 2))
							$("#vat_edit").val(number_format(data.vat, 2))
							$("#percentage_vat_cousin_edit").val(data.percentage_vat_cousin)
							$("#commission_percentage_edit").val(data.commission_percentage)
							$("#participation_edit").val(data.participation)
							$("#agency_commission_edit").val(number_format(data.agency_commission, 2))
							$("#total_edit").val(number_format(data.total, 2))

							$("#payment_period_edit").val(data.payment_period)
							$("#payment_method_edit").val(data.payment_method)
							$("#payment_terms_edit").val(data.payment_terms)
							
							$("#insurers_edit").trigger("change");

							data.is_renewable          == 1 ? $("#is_renewable_edit").prop("checked", true)          : $("#is_renewable_edit").prop("checked", false) 
							data.beneficiary_remission == 1 ? $("#beneficiary_remission_edit").prop("checked", true) : $("#beneficiary_remission_edit").prop("checked", false)
							data.beneficairy_onerous   == 1 ? $("#beneficairy_onerous_edit").prop("checked", true)   : $("#beneficairy_onerous_edit").prop("checked", false)

							data.send_policies_for_expire_email  == 1 ? $("#send_policies_for_expire_email_edit").prop("checked", true)  : $("#send_policies_for_expire_email_edit").prop("checked", false) 
							data.send_portfolio_for_expire_email == 1 ? $("#send_portfolio_for_expire_email_edit").prop("checked", true) : $("#send_portfolio_for_expire_email_edit").prop("checked", false) 
							data.send_policies_for_expire_sms    == 1 ? $("#send_policies_for_expire_sms_edit").prop("checked", true)    : $("#send_policies_for_expire_sms_edit").prop("checked", false) 
							data.send_portfolio_for_expire_sms   == 1 ? $("#send_portfolio_for_expire_sms_edit").prop("checked", true)   : $("#send_portfolio_for_expire_sms_edit").prop("checked", false) 
							

							showPays(data.id_policies, "#table-simulation-edit")

							var html = ""
							$.map(data.vehicules, function (item, key) {
								html += "<tr>"
									html +="<td><a target='_blank' href='vehicles/"+item.placa+"'>"+item.placa+"</a><input type='hidden' name='placas[]' value='"+item.placa+"'></td>"
									html +="<td><a href='javascript:void(0)' onclick='deleteRow(this)'><i class='fa fa-trash'></i></a></td>"
								html += "</tr>"
							});

							$("#table-placas-edit").html(html)

							$('#table-edit-familiares tbody').html('');

							data.familiares.forEach(item => {

								addFamiliar(document.querySelector('#table-edit-familiares'), item);

							})



							var url = "policies/annexes/"+data.id_policies+"/1"
							$('#iframeAnnexesEdit').attr('src', url);
							

							var url = "policies/files/"+data.id_policies+"/1"
							$('#iframeDigitalesEdit').attr('src', url);


							var url = "policies/wallet/"+data.id_policies+"/1"
							$('#iframeCarteraEdit').attr('src', url);

							$("#id_edit").val(data.id_policies)

							cuadros('#cuadro1', '#cuadro4');

						if(data.file_caratula != null){


							url_imagen = ruta.value + '/img/policies/caratulas/'


							var ext = data.file_caratula.split('.');
							if (ext[1] == "pdf") {
								img = '<embed class="kv-preview-data file-preview-pdf" src="'+url_imagen+data.file_caratula+'" type="application/pdf" style="width:213px;height:160px;" internalinstanceid="174">'
							}else{
								img = '<img src="'+url_imagen+data.file_caratula+'" class="file-preview-image kv-preview-data">'
							}
															console.log(data.file_caratula)

							$('#input-file-edit').fileinput('destroy').val('');
							$("#input-file-edit").fileinput({
								theme: "fas",
								overwriteInitial: true,
								maxFileSize: 10000,
								showClose: false,
								showCaption: false,
								browseLabel: '',
								removeLabel: '',
								browseIcon: '<i class="fa fa-folder-open"></i>',
								removeIcon: '<i class="fas fa-trash-alt"></i>',
								previewFileIcon: '<i class="fas fa-file"></i>',
								removeTitle: 'Cancel or reset changes',
								elErrorContainer: '#kv-avatar-errors-1',
								msgErrorClass: 'alert alert-block alert-danger',
								layoutTemplates: {main2: '{preview}  {remove} {browse}'},
								allowedFileExtensions: ["jpg", "png", "gif", "pdf", "PDF"],
								initialPreview: [ 
									img
								],
								initialPreviewConfig: [
										
									{caption: data.file_caratula , downloadUrl: url_imagen+data.file_caratula  ,url: url+"uploads/deleteCaratulaBinds", key: data.file_caratula}
							
								],

							});

						}
						else{
							$('#input-file-edit').fileinput('destroy').val('');
							initFileInput('#input-file-edit');
						}
					  }
					});


				});
			}



			function StartSimulation(start_simulation, payment_method, payment_period, payment_terms, payment_date, amount, table){

				$(start_simulation).change(function (e) { 

					if((($(payment_method).val() == "Contado") && $(payment_date).val() != "") || (($(payment_period).val() != "") && ($(payment_terms).val() != "") && ($(payment_date).val() != ""))){


						$(table+' tbody').off('click');
						var url=document.getElementById('ruta').value; 
						
						$(table).DataTable({
							"destroy":true,
							"searching": false,
							"stateSave": true,
							"serverSide":false,
							"ajax":{
								"method":"POST",
								"url":''+url+'/api/policies/simulation/pay',
								"data": {
									"id_user"        : id_user,
									"token"          : tokens,
									"payment_method" : $(payment_method).val(),
									"payment_period" : $(payment_period).val(),
									"payment_terms"  : $(payment_terms).val(),
									"payment_date"   : $(payment_date).val(),
									"amount"         : $(amount).val()
								},
								"dataSrc":""
							},
							"columns":[
								
								{"data":"monthly_fee"},
								{"data":"payment_date"},
								{"data":"amount", 
									render:  function(data, type, row){
										return number_format(data, 2)
									}
								},
								
							],
							"language": idioma_espanol,
							"dom": 'Bfrtip',
							"ordering": false,
							"responsive": true,
							"buttons":[
								'copy', 'csv', 'excel', 'pdf', 'print'
							]
						});
					}
				});
			}




			function showPays(id_policie, table){

				$(table+' tbody').off('click');
				var url=document.getElementById('ruta').value; 
				
				$(table).DataTable({
					"destroy":true,
					"searching": false,
					"stateSave": true,
					"serverSide":false,
					"ajax":{
						"method":"GET",
						"url":''+url+'/api/policies/simulation/pay/'+id_policie,
						"data": {
							"id_user"        : id_user,
							"token"          : tokens,
						},
						"dataSrc":""
					},
					"columns":[
						
						{"data":"monthly_fee"},
						{"data":"payment_date"},
						{"data":"amount", 
							render:  function(data, type, row){
								return number_format(data, 2)
							}
						},
						
					],
					"language": idioma_espanol,
					"dom": 'Bfrtip',
					"ordering": false,
					"responsive": true,

				});
			}


			function methodsPays(method_payment, payment_period, payment_terms, payment_date){
				
				$(method_payment).change(function (e) { 
					
					if($(this).val() == "Contado"){
						$(payment_period).attr("disabled", "disabled")
						$(payment_terms).attr("disabled", "disabled")
					}else{
						$(payment_period).removeAttr("disabled")
						$(payment_terms).removeAttr("disabled")
					}
				});
			}

			

			function GetBranchByInsurers(select_insurers, select_branch, value_default = false, branch = false, type_poliza = false){

				$(select_branch).selectize({
					sortField: 'text'
				});

				$(select_insurers).change(function (e) { 
				
					var url=document.getElementById('ruta').value;
					$.ajax({
						url:''+url+'/api/insurers/'+$(this).val(),
						type:'GET',
						data: {
							"id_user": id_user,
							"token"  : tokens,
						},
						dataType:'JSON',
						async: false,
						beforeSend: function(){
						// mensajes('info', '<span>Buscando, espere por favor... <i class="fa fa-spinner fa-spin" aria-hidden="true"></i></span>');
						},
						error: function (data) {
						//mensajes('danger', '<span>Ha ocurrido un error, por favor intentelo de nuevo</span>');         
						},
						success: function(data){
							$(select_branch)[0].selectize.destroy()
							$(select_branch+" option").remove();
							$(select_branch).append($('<option>',
							{
								value: "null",
								text : "Seleccione"
							}));

							if(type_poliza == "Collective"){

								$.each(data.branchs, function (key, item) { 
								
								$(select_branch).append($('<option>',
								{
									value: item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage,
									text : item.name,
									selected: branch == item.id_branch ? true : false
								}));
								});

							}else{
								console.log(data.branchs, value_default)
								console.log("sleected")

								$.each(data.branchs, function (key, item) { 
								$(select_branch).append($('<option>',
								{
									value: item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage,
									text : item.name,
									selected: value_default == item.id_branch+"|"+item.vat_percentage+"|"+item.commission_percentage ? true : false
								}));
							});
							}
							
							

							$(select_branch).selectize({
								//sortField: 'text'
							});
						}
					});
				});
			}


			function ChangeSelectBranch(select, option = ""){
				$(select).change(function (e) { 
					var array = $(this).val().split("|")

					var percentage_vat_cousin = array[1]
					var commission_percentage = array[2]

					$("#percentage_vat_cousin"+option).val(percentage_vat_cousin)
					$("#commission_percentage"+option).val(commission_percentage)
					
					calc("#cousin"+option, "#xpenses"+option, "#total"+option, "#percentage_vat_cousin"+option, "#vat"+option, "#commission_percentage"+option, "#agency_commission"+option, "#participation"+option)

				});
			}



			$("#cousin, #xpenses, #participation").keyup(function (e) { 
				calc("#cousin", "#xpenses", "#total", "#percentage_vat_cousin", "#vat", "#commission_percentage", "#agency_commission", "#participation")
			});


			$("#cousin_edit, #xpenses_edit, #participation_edit").keyup(function (e) { 
				calc("#cousin_edit", "#xpenses_edit", "#total_edit", "#percentage_vat_cousin_edit", "#vat_edit", "#commission_percentage_edit", "#agency_commission_edit", "#participation_edit")
			});


			$("#cousin_bind, #expenses_bind, #percentage_vat_bind, #total_bind").keyup(function (e) { 
				calc_bind("#cousin_bind",  "#expenses_bind", "#total_bind", "#percentage_vat_bind","#vat_bind")
			});


			function calc(input_cousin, input_xpenses, input_total, input_percentage_vat_cousin, input_vat, input_commission_percentage, agency_commission, participation){
				var value_cousin                      = inNum($(input_cousin).val())
				var value_xpenses                     = inNum($(input_xpenses).val())
				var value_percentage_vat_cousin       = inNum($(input_percentage_vat_cousin).val())
				var value_input_commission_percentage = inNum($(input_commission_percentage).val())
				var participation                     = inNum($(participation).val())
				
				var result_percentage_vat_cousin = inNum(((value_cousin + value_xpenses)/100) * value_percentage_vat_cousin)
				var result_commission_percentage = inNum(((value_cousin - (value_cousin * value_percentage_vat_cousin/100)) /100) * value_input_commission_percentage)
				
				var comission_total =  inNum(((result_commission_percentage / 100) * participation))

				
				var total = result_percentage_vat_cousin + value_cousin + value_xpenses

				$(input_vat).val(number_format(result_percentage_vat_cousin, 2))
				$(agency_commission).val(number_format(comission_total ,2))
				$(input_total).val(number_format(total, 2))
			}





			function calc_bind(input_cousin, input_xpenses, input_total, input_percentage_vat_cousin, input_vat){
				var value_cousin                      = inNum($(input_cousin).val())
				var value_xpenses                     = inNum($(input_xpenses).val())
				var value_percentage_vat_cousin       = inNum($(input_percentage_vat_cousin).val())
				
				var result_percentage_vat_cousin = inNum(((value_cousin + value_xpenses)/100) * value_percentage_vat_cousin)
				
				
				var total = result_percentage_vat_cousin + value_cousin + value_xpenses
				$(input_vat).val(number_format(result_percentage_vat_cousin, 2))
				$(input_total).val(number_format(total, 2))
			}



			function ShowBinds(data, table, option){
				
				var html = ""
				$.each(data, function (key, item) { 

					var btn_delete = "<button type='button' onclick='DeleteTr(\"" + "#tr_bind_" + count +"\")' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> <i class='fa fa-trash'  aria-hidden='true'></i></button>"
					var btn_view   = "<button type='button' onclick='ShowBind(this)' data='"+JSON.stringify(item)+"' class='btn btn-info btn-sm waves-effect waves-light '> <i class='fa fa-eye'  aria-hidden='true'></i></button>"

					html += "<tr>"
						html += "<td>"+item.name_affiliate+"</td>"
						html += "<td>"+item.document_affiliate+"</td>"
						html += "<td>"+btn_view+"</td>"
					html += "</tr>"
				});

				$(table+" tbody").html(html)
			}



			function ShowBind(input){
				$("#modal-lg").modal("show")
			}

			$("#btn-bind-policies").click(function (e) { 
				$('#count_fila').val('nuevo');
				$('#modal-lg input').removeAttr('disabled')
				$('#modal-lg select').removeAttr('disabled')
				$("#form-bind")[0].reset()
				$('#modal-lg #btn-add-bind').show();
			});

			$("#btn-familyBurden").click(function (e) { 
				$('#count_fila_familyBurden').val('Nuevo');
				$('#modal-cf input').removeAttr('disabled')
				$('#modal-cf select').removeAttr('disabled')
				$("#form-familyBurden")[0].reset()
				$('#modal-cf #btn-add-familyBurden').show();
			});


			$("#beneficairy_onerous_bind").change(function (e) { 
				if ($("#beneficairy_onerous_bind").is(':checked')){
					$("#beneficairy_onerous_input_bind").val(1)
				}else{
					$("#beneficairy_onerous_input_bind").val(0)
				}
				
			});

			var count = 0
			$("#form-bind").submit(function(e){
				e.preventDefault();

				    var count_fila                      = $("#count_fila").val()
					var number_annexed                  = $("#number_anexo_bind").val()
					var number_affiliate_bind           = $("#number_affiliate_bind").val()
					var date_init_bind                  = $("#date_init_bind").val()
					var insured_object_bind             = $("#insured_object_bind").val()
					var cousin_bind                     = $("#cousin_bind").val()
					var name_affiliate_bind             = $("#name_affiliate_bind").val()
					var document_affiliate_bind         = $("#document_affiliate_bind").val()
					var relationship_bind               = $("#relationship_bind").val()
					var birthdate_bind                  = $("#birthdate_bind").val()
					var gender_bind                     = $("#gender_bind").val()
					var phone_bind                      = $("#phone_bind").val()
					var email_bind                      = $("#email_bind").val()
					var address_bind                    = $("#address_bind").val()
					var plan_bind                       = $("#plan_bind").val()
					var type_rate_bind                  = $("#type_rate_bind").val()
					var type_membership_bind            = $("#type_membership_bind").val()
					var percentage_vat_bind             = $("#percentage_vat_bind").val()
					var expenses_bind                   = $("#expenses_bind").val()
					var vat_bind                        = $("#vat_bind").val()
					var total_bind                      = $("#total_bind").val()
					var company_bind                    = $("#company_bind").val()
					var employee_bind                   = $("#employee_bind").val()
					var internal_observations_bind      = $("#internal_observations_bind").val()
					var observations_bind               = $("#observations_bind").val()
					var beneficairy_onerous_bind        = $("#beneficairy_onerous_input_bind").val()
					var beneficairy_name_bind           = $("#beneficairy_name_bind").val()
					var beneficairy_identification_bind = $("#beneficairy_identification_bind").val()


				var btn_delete = `
						<button type='button' onclick='editVinculacion("#tr_bind_${count}", ${count}, true)' class='btn btn-info btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-preview' aria-hidden='true'></i>
						</button>

						<button type='button' onclick='editVinculacion("#tr_bind_${count}", ${count})' class='btn btn-primary btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='ei-save-edit' aria-hidden='true'></i>
						</button>

						<button type='button' onclick='DeleteTr("#tr_bind_${count}")' class='btn btn-danger btn-sm waves-effect waves-light add-dato-btn' id='remove-children'> 
								<i class='fa fa-trash' aria-hidden='true'></i>
						</button>

				`
				
				var values = "<input type='hidden'  name='number_annexed_bind[]' value='"+number_annexed+"'>"
				    values += "<input type='hidden' name='number_affiliate_bind[]' value='"+number_affiliate_bind+"'>"
				    values += "<input type='hidden' name='date_init_bind[]' value='"+date_init_bind+"'>"
				    values += "<input type='hidden' name='insured_object_bind[]' value='"+insured_object_bind+"'>"
				    values += "<input type='hidden' name='cousin_bind[]' value='"+cousin_bind+"'>"
				    values += "<input type='hidden' name='name_affiliate_bind[]' value='"+name_affiliate_bind+"'>"
				    values += "<input type='hidden' name='document_affiliate_bind[]' value='"+document_affiliate_bind+"'>"
				    values += "<input type='hidden' name='relationship_bind[]' value='"+relationship_bind+"'>"
				    values += "<input type='hidden' name='birthdate_bind[]' value='"+birthdate_bind+"'>"
				    values += "<input type='hidden' name='gender_bind[]' value='"+gender_bind+"'>"
				    values += "<input type='hidden' name='phone_bind[]' value='"+phone_bind+"'>"
				    values += "<input type='hidden' name='email_bind[]' value='"+email_bind+"'>"
					values += "<input type='hidden' name='address_bind[]' value='"+address_bind+"'>"
					values += "<input type='hidden' name='plan_bind[]' value='"+plan_bind+"'>"
				    values += "<input type='hidden' name='type_rate_bind[]' value='"+type_rate_bind+"'>"
				    values += "<input type='hidden' name='type_membership_bind[]' value='"+type_membership_bind+"'>"
				    values += "<input type='hidden' name='percentage_vat_bind[]' value='"+percentage_vat_bind+"'>"
				    values += "<input type='hidden' name='expenses_bind[]' value='"+expenses_bind+"'>"
				    values += "<input type='hidden' name='vat_bind[]' value='"+vat_bind+"'>"
				    values += "<input type='hidden' name='total_bind[]' value='"+total_bind+"'>"
				    values += "<input type='hidden' name='company_bind[]' value='"+company_bind+"'>"
				    values += "<input type='hidden' name='employee_bind[]' value='"+employee_bind+"'>"
				    values += "<input type='hidden' name='internal_observations_bind[]' value='"+internal_observations_bind+"'>"
				    values += "<input type='hidden' name='observations_bind[]' value='"+observations_bind+"'>"
				    values += "<input type='hidden' name='beneficairy_onerous_bind[]' value='"+beneficairy_onerous_bind+"'>"
				    values += "<input type='hidden' name='beneficairy_name_bind[]' value='"+beneficairy_name_bind+"'>"
				    values += "<input type='hidden' name='beneficairy_identification_bind[]' value='"+beneficairy_identification_bind+"'>"

				var html       = ""

				html += "<tr id='tr_bind_"+count+"'>"
					html += "<td>"+name_affiliate_bind+"</td>"
					html += "<td>"+document_affiliate_bind+"</td>"
					html += "<td>"+btn_delete+values+"</td>"
				html += "</tr>"

				if(count_fila != 'nuevo'){
					$('#tr_bind_'+count_fila).remove();
				}

				$("#table-bind tbody").append(html);

				$("#modal-lg").modal("hide")
				count++
        	});


			function editVinculacion(tr, countId, isinfo = false){
				let number_annexed_bind = document.querySelector(`${tr} input[name="number_annexed_bind[]"]`).value;
				let number_affiliate_bind = document.querySelector(`${tr} input[name="number_affiliate_bind[]"]`).value;
				let date_init_bind = document.querySelector(`${tr} input[name="date_init_bind[]"]`).value;
				let insured_object_bind = document.querySelector(`${tr} input[name="insured_object_bind[]"]`).value;
				let cousin_bind = document.querySelector(`${tr} input[name="cousin_bind[]"]`).value;
				let name_affiliate_bind = document.querySelector(`${tr} input[name="name_affiliate_bind[]"]`).value;
				let document_affiliate_bind = document.querySelector(`${tr} input[name="document_affiliate_bind[]"]`).value;
				let relationship_bind = document.querySelector(`${tr} input[name="relationship_bind[]"]`).value;
				let birthdate_bind = document.querySelector(`${tr} input[name="birthdate_bind[]"]`).value;
				let gender_bind = document.querySelector(`${tr} input[name="gender_bind[]"]`).value;
				let phone_bind = document.querySelector(`${tr} input[name="phone_bind[]"]`).value;
				let email_bind = document.querySelector(`${tr} input[name="email_bind[]"]`).value;
				let address_bind = document.querySelector(`${tr} input[name="address_bind[]"]`).value;
				let plan_bind = document.querySelector(`${tr} input[name="plan_bind[]"]`).value;
				let type_rate_bind = document.querySelector(`${tr} input[name="type_rate_bind[]"]`).value;
				let type_membership_bind = document.querySelector(`${tr} input[name="type_membership_bind[]"]`).value;
				let percentage_vat_bind = document.querySelector(`${tr} input[name="percentage_vat_bind[]"]`).value;
				let expenses_bind = document.querySelector(`${tr} input[name="expenses_bind[]"]`).value;
				let vat_bind = document.querySelector(`${tr} input[name="vat_bind[]"]`).value;
				let total_bind = document.querySelector(`${tr} input[name="total_bind[]"]`).value;
				let company_bind = document.querySelector(`${tr} input[name="company_bind[]"]`).value;
				let employee_bind = document.querySelector(`${tr} input[name="employee_bind[]"]`).value;
				let internal_observations_bind = document.querySelector(`${tr} input[name="internal_observations_bind[]"]`).value;
				let observations_bind = document.querySelector(`${tr} input[name="observations_bind[]"]`).value;
				let beneficairy_onerous_bind = document.querySelector(`${tr} input[name="beneficairy_onerous_bind[]"]`).value;
				let beneficairy_name_bind = document.querySelector(`${tr} input[name="beneficairy_name_bind[]"]`).value;
				let beneficairy_identification_bind = document.querySelector(`${tr} input[name="beneficairy_identification_bind[]"]`).value

				$("#btn-bind-policies").click();

				$('#count_fila').val(countId);
				$("#number_anexo_bind").val(number_annexed_bind)
				$("#number_affiliate_bind").val(number_affiliate_bind)
				$("#date_init_bind").val(date_init_bind)
				$("#insured_object_bind").val(insured_object_bind)
				$("#cousin_bind").val(cousin_bind)
				$("#name_affiliate_bind").val(name_affiliate_bind)
				$("#document_affiliate_bind").val(document_affiliate_bind)
				$("#relationship_bind").val(relationship_bind)
				$("#birthdate_bind").val(birthdate_bind)
				$("#gender_bind").val(gender_bind)
				$("#phone_bind").val(phone_bind)
				$("#email_bind").val(email_bind)
				$("#address_bind").val(address_bind)
				$("#plan_bind").val(plan_bind)
				$("#type_rate_bind").val(type_rate_bind)
				$("#type_membership_bind").val(type_membership_bind)
				$("#percentage_vat_bind").val(percentage_vat_bind)
				$("#expenses_bind").val(expenses_bind)
				$("#vat_bind").val(vat_bind)
				$("#total_bind").val(total_bind)
				$("#company_bind").val(company_bind)
				$("#employee_bind").val(employee_bind)
				$("#internal_observations_bind").val(internal_observations_bind)
				$("#observations_bind").val(observations_bind)

				if(beneficairy_onerous_bind == '1'){
					$("#beneficairy_onerous_bind").attr('checked', true);
				}
				else{
					$("#beneficairy_onerous_bind").attr('checked', false);
				}

				$("#beneficairy_onerous_input_bind").val(beneficairy_onerous_bind)

				$("#beneficairy_name_bind").val(beneficairy_name_bind)
				$("#beneficairy_identification_bind").val(beneficairy_identification_bind)

				if(isinfo){
					$('#modal-lg input').attr('disabled', true)
					$('#modal-lg select').attr('disabled', true)
					$('#modal-lg #btn-add-bind').hide();
				}

			}


			$("#clients_select").change(function (e) { 
				var arrayClient = $(this).val().split("|")
				$("#clients").val(arrayClient[0])
				$("#type_clients").val(arrayClient[1])
			});


			$("#clients_select_edit").change(function (e) { 
				var arrayClient = $(this).val().split("|")
				$("#clients_edit").val(arrayClient[0])
				$("#type_clients_edit").val(arrayClient[1])
			});


			$("#type_poliza").change(function (e) { 
				
				if($(this).val() == "Collective"){
					$(".remove").css("display", "none")
					$(".remove-pay").css("display", "block")
				}else{
					$(".remove").css("display", "block")
					$(".remove-pay").css("display", "none")
				}
				
			});




			$("#birthdate_bind").change(function (e) { 
			  $("#age_bind").val(calcularEdad($(this).val()))
		  	});


			$("#add-vehicle").click(function (e) { 
				var placa = $("#placa").val()
				var html = ""

				html += "<tr>"
					html +="<td><a target='_blank' href='vehicles/"+placa+"'>"+placa+"<input type='hidden' name='placas[]' value='"+placa+"'></a></td>"
					html +=`<td><a href='javascript:void(0)' onclick="deleteRow(this)"><i class="fa fa-trash"></i></a></td>`
				html += "</tr>"

				$("#table-placas").append(html)
			});

			function deleteRow(element){
				element.closest('tr').remove();
			}

			$(".add-familiar").click(function (e) { 
				let tablita = e.target.closest('table');

				addFamiliar(tablita)
			});

			function addFamiliar(tablita, { id = 0, nombre = '', documento = ''} = {}, edit = true){
				
				let html = `
					<td>
						<input hidden name="familiar_id[]" value="${id}" />

						${edit? 
							`
								<input class="form-control" placeholder="Nombre" name="familiar_nombre[]" value="${nombre}" />
							`
							:
							nombre
						}
						

					</td>
					<td>
						${edit? 
							`
								<input class="form-control" placeholder="Documento" name="familiar_documento[]" value="${documento}" />
							`
							:
							documento
						}
					</td>
					<td>
						${edit? 
							`
		                      <button type="button" class="btn btn-danger btn-sm waves-effect waves-light" onclick="this.closest('tr').remove()">
		                          <i class="fa fa-trash"></i>
		                      </button>	
							`
							:
							''
						}
					
                    </td>
				`

				let tr = document.createElement('tr');

				tr.innerHTML = html;

				tablita.querySelector('tbody').appendChild(tr)

			}

			
			$("#add-vehicle-edit").click(function (e) { 
				var placa = $("#placa-edit").val()
				var html = ""

				html += "<tr>"
					html +="<td><a target='_blank' href='vehicles/"+placa+"'>"+placa+"<input type='hidden' name='placas[]' value='"+placa+"'></a></td>"
					html +="<td><a href='javascript:void(0)' onclick='deleteRow(this)'><i class='fa fa-trash'></i></a></td>"
				html += "</tr>"

				$("#table-placas-edit").append(html)
			});



		

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivarsssssss
			*/
			function desactivar(tbody, table){
				$(tbody).on("click", "span.desactivar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_policies+"/"+2,"¿Está seguro de desactivar el registro?", 'desactivar');
				});
			}
		/* ------------------------------------------------------------------------------- */

		/* ------------------------------------------------------------------------------- */
			/*
				Funcion que capta y envia los datos a desactivar
			*/
			function activar(tbody, table){
				$(tbody).on("click", "span.activar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_policies+"/"+1,"¿Está seguro de desactivar el registro?", 'activar');
				});
			}
	
			function eliminar(tbody, table){
				$(tbody).on("click", "span.eliminar", function(){
					var data=table.row($(this).parents("tr")).data();
					statusConfirmacion('api/status-policies/'+data.id_policies+"/"+0,"¿Esta seguro de eliminar el registro?", 'Eliminar');
				});
			}


		</script>
	@endsection


