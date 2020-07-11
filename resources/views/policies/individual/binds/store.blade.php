<div class="card shadow mb-4 hidden" id="cuadro2">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Registro de Vinculados</h6>
  </div>
  <div class="card-body">
      <form class="user" autocomplete="off" method="post" id="store" enctype="multipart/form-data">
      
        @csrf

        <div class="row">
          <div class="col-md-6">
            <label for=""><b>No. Anexo</b></label>
            <div class="form-group valid-required">
            <input name="number_annexed" type="text" class="form-control" id="number_anexo_bind">
            </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Numero afiliado*</b></label>
            <div class="form-group valid-required">
            <input name="number_affiliate" type="text" class="form-control" id="number_affiliate_bind" required>
            </div>
          </div>
            </div>



        <div class="row">
     
     
          <div class="col-md-4">
            <label for=""><b>Fecha de Inicio *</b></label>
            <div class="form-group valid-required">
            <input name="date_init" type="date" class="form-control" id="date_init_bind" required>
            </div>
          </div>


          <div class="col-md-4">
            <label for=""><b>Objeto asegurado*</b></label>
            <div class="form-group valid-required">
            <input name="insured_object" type="text" class="form-control" id="insured_object_bind" placeholder="Codigo Objeto Asegurado" required>
            </div>
          </div>

          <div class="col-md-4">
            <label for=""><b>Prima (Mensual, semestral, anual)*</b></label>
            <div class="form-group valid-required">
            <input name="cousin" type="text" class="form-control monto_formato_decimales" id="cousin_bind" required style="text-align: right">
            </div>
          </div>

            </div>



        <div class="row">

          <div class="col-md-4">
            <label for=""><b>Nombre del Afiliado *</b></label>
            <div class="form-group valid-required">
            <input name="name_affiliate" type="text" class="form-control" id="name_affiliate_bind" required>
            </div>
          </div>

          <div class="col-md-4">
            <label for=""><b>Documento del Afiliado*</b></label>
            <div class="form-group valid-required">
            <input name="document_affiliate" type="text" class="form-control" id="document_affiliate_bind" placeholder="Documento del Afiliado" required>
            </div>
          </div>

          <div class="col-md-4">
            <label for=""><b>Parentesco</b></label>
            <div class="form-group valid-required">
            <input name="relationship" type="text" class="form-control" id="relationship_bind">
            </div>
          </div>

            </div>



        <div class="row">

          <div class="col-md-4">
            <label for=""><b>Fecha de nacimiento</b></label>
            <div class="form-group valid-required">
              <input name="birthdate" type="date" class="form-control" id="birthdate_bind" >
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
            <select name="gender"  class="form-control selectize-input items has-options full has-items" id="gender_bind" required>
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
              <input name="phone"  type="text" class="form-control" id="phone_bind">
            </div>
          </div>

          <div class="col-md-4">
            <label for=""><b>Correo</b></label>
            <div class="form-group valid-required">
              <input name="email"  type="text" class="form-control" id="email_bind">
            </div>
          </div>

          <div class="col-sm-4">
            <label for=""><b>Direccion*</b></label>
            <input name="address" type="text" class="form-control" id="address_bind">
          </div>

        </div>





        <div class="row">

          <div class="col-md-4">
            <label for=""><b>Plan Afiliado</b></label>
            <div class="form-group valid-required">
              <input name="plan"  type="text" class="form-control" id="plan_bind">
            </div>
          </div>

          <div class="col-md-4">
            <label for=""><b>Tipo Tarifa</b></label>
            <div class="form-group valid-required">
              <input name="type_rate" type="text" class="form-control" id="type_rate_bind">
            </div>
          </div>

          <div class="col-sm-4">
            <label for=""><b>Tipo de Afiliacion</b></label>
            <input name="type_membership" type="text" class="form-control" id="type_membership_bind">
          </div>

        </div>




        <div class="row">

          <div class="col-md-2">
            <label for=""><b>% IVA</b></label>
            <div class="form-group valid-required">
              <input name="percentage_vat" type="text" class="form-control" id="percentage_vat_bind">
            </div>
          </div>

          <div class="col-md-3">
            <label for=""><b>Gastos de expedicion</b></label>
            <div class="form-group valid-required">
              <input name="expenses" type="text" class="form-control monto_formato_decimales" id="expenses_bind" style="text-align: right">
            </div>
          </div>

          <div class="col-sm-3">
            <label for=""><b>IVA</b></label>
            <input name="vat" type="text" class="form-control" id="vat_bind" readonly style="text-align: right">
          </div>


          <div class="col-sm-4">
            <label for=""><b>Total</b></label>
            <input name="total" type="text" class="form-control" id="total_bind" style="text-align: right" readonly>
          </div>

        </div>






        <div class="row">

          <div class="col-md-6">
            <label for=""><b>Empresa</b></label>
            <div class="form-group valid-required">
              <input name="company" type="text" class="form-control" id="company_bind">
            </div>
          </div>


          <div class="col-md-6">
            <label for=""><b>Empleado</b></label>
            <div class="form-group valid-required">
              <input name="employee" type="text" class="form-control" id="employee_bind">
            </div>
          </div>

        </div>

        <div class="row">
          <div class="col-md-12">
            
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Carga Familiar</h6>
              </div>
              <div class="card-body">

                <div class="row">

                  <div class="col-md-12">
                    <button type="button" data-toggle="modal" data-target="#modal-cf" id="btn-familyBurden" class="btn btn-success" style="float: left;">
                      <i class="ti-user"></i>
                      <span>Agregar</span>
                    </button>
                  </div>

                  <div class="col-md-12">
                      <table class="table table-bordered" id="table-familyBurden-store">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Parentezco</th>
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
          <div class="col-md-6">
            <label for=""><b>Observaciones Internas</b></label>
            <div class="form-group valid-required">
              <textarea name="internal_observations" class="form-control" id="internal_observations_bind" cols="30" rows="10"></textarea>
            </div>
          </div>

          <div class="col-md-6">
            <label for=""><b>Observaciones</b></label>
            <div class="form-group valid-required">
              <textarea name="observations"  id="observations_bind" class="form-control" cols="30" rows="10"></textarea>
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

              <input type="hidden" name="beneficairy_onerous" id="beneficairy_onerous_input_bind">
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

        </div>


        <!---END ROW-->
        <input type="hidden" name="id_policie" value="{{$id_policies}}">
        <input type="hidden" name="id_user" class="id_user">
        <input type="hidden" name="token" class="token">
          <br>
          <br>
   
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
 </div>

