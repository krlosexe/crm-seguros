<div class="card shadow mb-4 hidden" id="cuadro4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Editar Siniestro</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="form-update" enctype="multipart/form-data">
      
        @csrf

        <input type="hidden" name="_method" value="put">

        <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a href="#default-tab-1-edit" class="nav-link active show" role="tab" data-toggle="tab" aria-selected="true">Datos Generales</a>
            </li>
            <li class="nav-item">
                <a href="#default-tab-2-edit" class="nav-link" role="tab" data-toggle="tab" aria-selected="false">Digitales</a>
            </li>
        </ul>

        <br><br>


        <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active show" id="default-tab-1-edit">

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

                      <div class="col-md-6">
                        <label for=""><b>Estado*</b></label>
                          <div class="form-group valid-required">
                            <select name="state_policie" class="form-control selectized" id="state_policie_edit" required>
                                <option value="">Seleccione</option>
                                <option value="Objetado">Objetado</option>
                                <option value="Pagado">Pagado</option>
                                <option value="En proceso">En proceso</option>
                                <option value="Solicitado">Solicitado</option>
                                <option value="Cancelado">Cancelado</option>
                              </select>
                          </div>
                      </div>


                      <div class="col-md-6">
                        <label for=""><b>Fecha de estatus*</b></label>
                          <div class="form-group valid-required">
                          <input type="date" name="date_status" class="form-control form-control-user" id="date_status-edit" placeholder="" required>
                          </div>
                      </div>



                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <label for=""><b>Número siniestro compañía*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="number_sinister" class="form-control form-control-user" id="number_sinister_edit" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Tipo de siniestro*</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="type_sinister" class="form-control form-control-user" id="type_sinister_edit" placeholder="Ej (Choque, incendio, robo, etc)" required>
                          </div>
                      </div>
                    </div>



                    <div class="row">
                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha del siniestro</b></label>
                          <input type="date" name="date_sinister" class="form-control form-control-user" id="date_sinister_edit">
                        </div>


                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha de aviso</b></label>
                          <input type="date" name="date_notice" class="form-control form-control-user" id="date_notice_edit">
                        </div>

                        <div class="col-sm-4">
                          <label for=""><br><b>Fecha notificación aseguradora</b></label>
                          <input type="date" name="date_notification_insurers" class="form-control form-control-user" id="date_notification_insurers_edit">
                        </div>

                    </div>
                    <br>


                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Proveedor asignado</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="assigned_provider" class="form-control form-control-user" id="assigned_provider_edit" placeholder="" required>
                          </div>
                      </div>
                    </div>
                    <br>

                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Descripción (Hechos)</b></label>
                          <div class="form-group valid-required">
                            <textarea name="descriptions" id="descriptions_edit" class="form-control" cols="30" rows="10"></textarea>
                          </div>
                      </div>
                    </div>

                    <br>


                    <div class="row">
                      <div class="col-md-12">
                        <label for=""><b>Póliza*</b></label>
                          <div class="form-group valid-required">
                            <select name="policie" class="selectized" id="policie_edit" required>
                                <option value="">Seleccione</option>
                              </select>
                          </div>
                      </div>
                    </div>


                    <div class="row">
                    
                        <div class="col-md-6">
                          <label for=""><b>Aseguradora*</b></label>
                            <div class="form-group valid-required">
                            <input type="text"  class="form-control form-control-user" id="insures_edit" placeholder="" disabled>
                            </div>
                        </div>

                        <div class="col-md-6">
                          <label for=""><b>Ramo*</b></label>
                            <div class="form-group valid-required">
                            <input type="text"  class="form-control form-control-user" id="branch_edit" placeholder="" disabled>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Nombre del asegurado</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="insured_name" class="form-control form-control-user" id="insured_name_edit" placeholder="" disabled>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Documento del asegurado*</b></label>
                          <div class="form-group valid-disabled">
                            <input type="text" name="document_insured" class="form-control form-control-user" id="document_insured_edit" disabled>
                          </div>
                      </div>

                    </div>



                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Valor de indemnización</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="compensation_value" class="form-control form-control-user" id="compensation_value_edit" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Deducible</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="deductible" class="form-control form-control-user" id="deductible_edit" required>
                          </div>
                      </div>
                      
                    </div>



                    <div class="row">

                      <div class="col-md-6">
                        <label for=""><b>Monto de Reclamo</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="claim_amount" class="form-control form-control-user" id="claim_amount_edit" placeholder="" required>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <label for=""><b>Coaseguros</b></label>
                          <div class="form-group valid-required">
                            <input type="text" name="coinsurance" class="form-control form-control-user" id="coinsurance_edit" required>
                          </div>
                      </div>
                      
                    </div>



                    <div class="row">
                        <div class="col-md-4">
                          <label for="finalized_edit"><b>Finalizado</b><br></label><br>
                          <div class="toggle-checkbox toggle-success checkbox-inline toggle-sm">
                                <input type="checkbox" name="finalized" id="finalized_edit">
                                <label for="finalized_edit"></label>
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
                                            <button class="btn btn-primary btn-sm waves-effect waves-light add-dato-btn" id="add-amparo-edit">
                                                  <i class="fa fa-plus"  aria-hidden="true"></i>
                                              </button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="amparos-edit"></tbody>

                                    <tfooter>
                                      <tr>
                                        <td colspan="2"  style="text-align: right"><b>Total</b></td>
                                        <td colspan="1"><input type="text" style="text-align: right" readonly id="total_amparos_edit" class="form-control form-control-user monto_formato_decimales"></td>
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



            <div class="row">
                <div class="col-md-12 text-center">

                <label for=""><b>Adjuntos *</b></label>
                  <div class="kv-avatar">
                    <div class="file-loading">
                      <input id="input-file-edit" name="logo" type="file">
                    </div>
                  </div>

                  <div class="kv-avatar-hintss">
                    <small>Seleccione una foto</small>
                  </div>

                </div>
              </div>





            <div class="row" id="comments_content_edit">
                  <div class="col-md-12">
                      <div class="row">
                          
                      </div>
                  </div>
              </div>
          
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label>Comentarios</label>
                          <textarea id="comments-edit" class="form-control"></textarea>
                      </div>
                  </div>
              </div>


              <div class="row">
                  <div class="col-md-2">
                      <button type="button" id="add-comments-edit"  class="btn btn-primary">
                          Comentar
                      </button>
                  </div>
              </div>



          </div>
          
        </div>
  </div>

        <div role="tabpanel" class="tab-pane fade in " id="default-tab-2-edit">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item " id="iframeEdit" allowfullscreen>            
                    </iframe>
                  </div>
                </div>
        </div>

        <!---END ROW-->




        <div class="row" id="history-edit">
         
        </div>


        <br><br>


        <div class="row">

          <div class="col-md-6">

            <h3>Comentarios</h3>
            <div id="comments_content_edit-state"></div>
          </div>
          <div class="col-md-6">
            <h3>Adjuntos</h3>
            <div id="files_content_edit-state"></div>
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

