<div class="card shadow mb-4 hidden" id="cuadro3">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Consulta de Siniestros.</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-view" enctype="multipart/form-data">
      
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
          
          <div class="col-md-7">

            <div class="row">

              <div class="col-md-12">

                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Información principal del siniestro</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">

                      <div class="col-md-4">
                        <label for=""><b>Estado*</b></label>
                          <div class="form-group valid-required">
                            <select name="state_policie" class="form-control selectized" id="state_policie_view" required>
                                <option value="">Seleccione</option>
                                <option value="Objetado">Objetado</option>
                                <option value="Pagado">Pagado</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Solicitado">Solicitado</option>
                                <option value="Cancelado">Cancelado</option>
                              </select>
                          </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <label for=""><b>Número siniestro compañía*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="number_sinister" class="form-control form-control-user" id="number_sinister_view" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Tipo de siniestro*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="type_sinister" class="form-control form-control-user" id="type_sinister_view" placeholder="Ej (Choque, incendio, robo, etc)" required>
                          </div>
                      </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha del siniestro</b></label>
                          <input type="date" name="date_sinister" class="form-control form-control-user" id="date_sinister_view">
                        </div>


                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha de aviso</b></label>
                          <input type="date" name="date_notice" class="form-control form-control-user" id="date_notice_view">
                        </div>

                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha notificación aseguradora</b></label>
                          <input type="date" name="date_notification_insurers" class="form-control form-control-user" id="date_notification_insurers_view">
                        </div>

                    </div>
                    <br>


                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Proveedor asignado</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="assigned_provider" class="form-control form-control-user" id="assigned_provider_view" placeholder="" required>
                          </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Descripción (Hechos)</b></label>
                          <div class="form-group valid-required">
                            <textarea name="descriptions" id="descriptions_view" class="form-control" cols="30" rows="10"></textarea>
                          </div>
                      </div>
                    </div>

                    <br>


                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Póliza*</b></label>
                          <div class="form-group valid-required">
                            <select name="policie" class="selectized" id="policie_view" required>
                                <option value="">Seleccione</option>
                              </select>
                          </div>
                      </div>
                    </div>


                    <div class="row">
                    
                        <div class="col-md-6">
                          <label for=""><b>Aseguradora*</b></label>
                            <div class="form-group valid-required">
                            <input type="text"  class="form-control form-control-user" id="insures_view" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Ramo*</b></label>
                            <div class="form-group valid-required">
                            <input type="text"  class="form-control form-control-user" id="branch_view" placeholder="" disabled>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Nombre del asegurado</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="insured_name" class="form-control form-control-user" id="insured_name_view" placeholder="" disabled>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Documento del asegurado*</b></label>
                          <div class="form-group valid-disabled">
                            <input type="text" name="document_insured" class="form-control form-control-user" id="document_insured_view" disabled>
                          </div>
                      </div>

                    </div>



                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Valor de indemnización</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="compensation_value" class="form-control form-control-user" id="compensation_value_view" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Deducible</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="deductible" class="form-control form-control-user" id="deductible_view" required>
                          </div>
                      </div>
                      
                    </div>



                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Monto de Reclamo</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="claim_amount" class="form-control form-control-user" id="claim_amount_view" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Coaseguros</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="coinsurance" class="form-control form-control-user" id="coinsurance_view" required>
                          </div>
                      </div>
                      
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                          <label for="finalized"><b>Finalizado</b><br></label><br>
                          <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                <input type="checkbox" name="finalized" id="finalized_view">
                                <label for="finalized"></label>
                          </div>
                        </div>
                    </div>



                    <br>

               

                  </div>
                </div>
              </div>
            </div>

          </div>




          <div class="col-md-5">

            <div class="row">

              <div class="col-md-12">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Amparos afectados</h6>
                  </div>
                  <div class="card-body">

                    <div class="row">

                     <div class="col-md-12" style="padding: 0;padding-left: 10px;padding-top: 10px;padding-bottom: 10px;border: 2px solid #e6e6e6;">

                          <div class="row">

                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre reclamante</th>
                                            <th>Amparo</th>
                                            <th>Valor</th>
                                            <th>
                                             <!--- <button class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-amparo">
                                                  <i class="fa fa-plus"  aria-hidden="true"></i>
                                              </button>-->
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="amparos-view"></tbody>

                                    <tfooter>
                                      <tr>
                                        <td colspan="2"  style="text-align: right"><b>Total</b></td>
                                        <td colspan="1"><input type="text" style="text-align: right" readonly id="total_amparos_view" class="form-control form-control-user monto_formato_decimales"></td>
                                        <td colspan="1"></td>
                                      </tr>
                                    </tfooter>
                                </table>
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

          <div role="tabpanel" class="tab-pane fade in " id="default-tab-2-view">
                    <div class="embed-responsive embed-responsive-16by9">
                      <iframe class="embed-responsive-item " id="iframeView" allowfullscreen>

                      </iframe>
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
            <button type="button"  class="btn btn-danger btn-user" onclick="prev('#cuadro3')">
                Cancelar
            </button>
          </center>
          <br>
          <br>
      </form>
      
    </div>


