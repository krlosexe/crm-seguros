<div class="card shadow mb-4 hidden" id="cuadro2">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Siniestro</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf


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
                            <select name="state_policie" class="form-control selectized" id="state_policie" required>
                                <option value="">Seleccione</option>
                                <option value="Objected to">Objetado</option>
                                <option value="paid">Pagado</option>
                                <option value="in process">En proceso</option>
                                <option value="Requested">Solicitado</option>
                              </select>
                          </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <label for=""><b>Número siniestro compañía*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="number_sinister" class="form-control form-control-user" id="number_sinister" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Tipo de siniestro*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="type_sinister" class="form-control form-control-user" id="type_sinister" placeholder="Ej (Choque, incendio, robo, etc)" required>
                          </div>
                      </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha del siniestro</b></label>
                          <input type="date" name="date_sinister" class="form-control form-control-user" id="date_sinister">
                        </div>


                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha de aviso</b></label>
                          <input type="date" name="date_notice" class="form-control form-control-user" id="date_notice">
                        </div>

                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha notificación aseguradora</b></label>
                          <input type="date" name="date_notification_insurers" class="form-control form-control-user" id="date_notification_insurers">
                        </div>

                    </div>
                    <br>


                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Proveedor asignado</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="assigned_provider" class="form-control form-control-user" id="assigned_provider" placeholder="" required>
                          </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Descripción (Hechos)</b></label>
                          <div class="form-group valid-required">
                            <textarea name="descriptions" id="descriptions" class="form-control" cols="30" rows="10"></textarea>
                          </div>
                      </div>
                    </div>

                    <br>


                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Póliza*</b></label>
                          <div class="form-group valid-required">
                            <select name="policie" class="selectized" id="policie" required>
                                <option value="">Seleccione</option>
                              </select>
                          </div>
                      </div>
                    </div>


                    <div class="row">
                    
                        <div class="col-md-6">
                          <label for=""><b>Aseguradora*</b></label>
                            <div class="form-group valid-required">
                            <input type="text"  class="form-control form-control-user" id="insures" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Ramo*</b></label>
                            <div class="form-group valid-required">
                            <input type="text"  class="form-control form-control-user" id="branch" placeholder="" disabled>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Nombre del asegurado</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="insured_name" class="form-control form-control-user" id="insured_name" placeholder="" disabled>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Documento del asegurado*</b></label>
                          <div class="form-group valid-disabled">
                            <input type="text" name="document_insured" class="form-control form-control-user" id="document_insured" disabled>
                          </div>
                      </div>

                    </div>



                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Valor de indemnización</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="compensation_value" class="form-control form-control-user" id="compensation_value" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Deducible</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="deductible" class="form-control form-control-user" id="deductible" required>
                          </div>
                      </div>
                      
                    </div>



                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Monto de Reclamo</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="claim_amount" class="form-control form-control-user" id="claim_amount" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Coaseguros</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="coinsurance" class="form-control form-control-user" id="coinsurance" required>
                          </div>
                      </div>
                      
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                          <label for="finalized"><b>Finalizado</b><br></label><br>
                          <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                <input type="checkbox" name="finalized" id="finalized">
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
                                              <button class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-amparo">
                                                  <i class="fa fa-plus"  aria-hidden="true"></i>
                                              </button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="amparos"></tbody>

                                    <tfooter>
                                      <tr>
                                        <td colspan="2"  style="text-align: right"><b>Total</b></td>
                                        <td colspan="1"><input type="text" style="text-align: right" readonly id="total_amparos" class="form-control form-control-user monto_formato_decimales"></td>
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


            <div class="row remove">
            
              <div class="col-md-12">
                
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Archivos</h6>
                  </div>
                  <div class="card-body">
                    
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
            <button  type="submit" class="btn btn-success btn-user">
                Registrar
            </button>

          </center>
          <br>
          <br>
      </form>
      
    </div>

