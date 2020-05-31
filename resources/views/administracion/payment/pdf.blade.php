@extends('layouts.app')

@section('validarUrl', false)

@section('content')
      
     <!-- Content Wrapper START -->
     <div class="main-content">
      <div class="container-fluid" id="cuadro1">

        <div class="page-title">
          <h4>Gestión de Cartera.</h4>
        </div>

            <div class="container">
                <div class="card">
                    <div class="pdd-vertical-5 pdd-horizon-10 border bottom print-invisible">
                        <ul class="list-unstyle list-inline text-right">
                            <li class="list-inline-item">
                                <a href="" class="btn text-gray text-hover display-block padding-10 no-mrg-btm" onclick="window.print();">
                                    <i class="ti-printer text-info pdd-right-5"></i>
                                    <b>Imprimir</b>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="" class="text-gray text-hover display-block padding-10 no-mrg-btm">
                                    <i class="fa fa-file-pdf-o text-danger pdd-right-5"></i>
                                    <b>Exportar PDF</b>
                                </a>
                                <a onclick="this.href='data:application/pdf;charset=UTF-8,'+encodeURIComponent(document.documentElement.outerHTML)" href="#" download="page.pdf">Download</a>

                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="pdd-horizon-30">
                            <div class="mrg-top-15">
                                <div class="inline-block">
                                    <img class="img-responsive" src="{{ url('/') }}/images/logo/logo-dark.png" id="logo" width="260px">
                                       <address class="pdd-left-10 mrg-top-20">
                <b class="text-dark" id="name">Espire, Inc.</b><br>
                <span class="text-uppercase">Nit: 900709309-1</span><br>
                  </address>
                                    </div>
                                    <div class="pull-right">
                                        <h2>CUENTA DE COBRO</h2>
                                    </div>
                                </div>
                                <div class="row mrg-top-20">
                                    <div class="col-md-9 col-sm-9">
                                        <h3 class="pdd-left-10 mrg-top-10 text-uppercase">Asegurado:</h3>
                                        <address class="pdd-left-10 mrg-top-10">
                    <b class="text-dark" id="name_client">JUAN FERNANDO RIVERA QUEVEDO</b><br>
                    <span id="number_document">CÉDULA: 1036686527</span><br>
                    <span id="address" class="text-uppercase">BELLO, ANTIOQUIA</span>
                  </address>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="mrg-top-80">
                                        <div class="text-dark text-uppercase inline-block"><b>No. Cuenta Cobro:</b></div>
                                        <div class="pull-right" id="id">#1668</div>
                                    </div>
                                    <div class="">
                                        <div class="text-dark text-uppercase inline-block"><b>Fecha:</b></div>
                                        <div class="pull-right" id="date">25/6/2020</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mrg-top-50">
                                        <div class="col-md-12">
                                            <div class="text-dark">
                                              <p><b class="text-dark text-uppercase">Cordial Saludo</b></p>
                                                <p class="text-opacity text-uppercase" id="issue" >Ajuntamos el documento relacionado a continuación el cual corresponde a la expedición de la Póliza de asunto vigencia 2019 - 2020, esperamos una pronta respuesta</p>
                                            </div>
                                        </div>
                                    </div>
                            <div class="row mrg-top-20">
                                <div class="col-md-12">
                                    <div class="table-overflow">
                                        <table class="table table-hover" id="showtable">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Ramo</th>
                                                    <th>Póliza</th>
                                                    <th>Detalle</th>
                                                    <th>Prima</th>
                                                    <th>IVA</th>
                                                    <th class="text-right">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
{{--                                                 <tr>
                                                    <td>1</td>
                                                    <td id="branch">SEGURO DE VIDA</td>
                                                    <td id="number_policie">0012654</td>
                                                    <td>EXPEDICIÓN PÓLIZA</td>
                                                    <td id="cousin">4.500.000</td>
                                                    <td id="vat">450.000</td>
                                                    <td id="total" class="text-right">4.950.000</td>
                                                </tr> --}}
                                               
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row mrg-top-30">
                                        <div class="col-md-12">
                                            <div class="pull-right text-right">
                                                <p class="text-uppercase" >Subtotal: <span id="subtotal">4.500.000</span></p>
                                                <p class="text-uppercase">IVA (19%): <span id="ivasubtotal" >450.000</span>  </p>
                                                <hr>
                                                <h3><b class="text-uppercase">Total a pagar:</b> <span id="totalpagar">4.950.000</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mrg-top-30">
                                        <div class="col-md-12">
                                            <div class=" top bottom pdd-vertical-20">
                                                <p><b class="text-dark text-uppercase">Instructivo de pago</b></p>
                                                <p class="text-opacity" id="observations">De acuerdo con lo anterior le solicitamos girar  cheque por valor de 4.950.000 a nombre de la compañía SURAMERICANA DE SEGUROS S A NIT: 89768723-9</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mrg-top-30">
                                        <div class="col-md-12">
                                            <div class="border top bottom pdd-vertical-20">
                                                <span><b class="text-dark text-uppercase">Agradecemos la atención prestada</b></span> <br>
                                                <span class="text-opacity text-uppercase">Atentamente,</span> <br>                       
                                                     <img id="firm_agent" class="img-responsive text-opacity mrg-top-5" width="150" src="https://upload.wikimedia.org/wikipedia/commons/1/14/Firma_Ildefonso_Leal.jpg" alt=""> <br>
                                                <span><b class="text-dark text-uppercase" id="name_agent">JUAN FERNANDO RIVERA QUEVEDO</b></span> <br>
                                                <span class="text-opacity text-uppercase" >Asistente en seguros</span>
                                                <br>
                                                <span class="text-opacity text-uppercase correo" >example@gmail.com</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mrg-vertical-20">
                                        <div class="col-md-6">
                                            <img class="img-responsive text-opacity mrg-top-5" width="100" src="assets/images/logo/logo.png" alt="">
                                        </div>
                                        <div class="col-md-6 text-right">                                           
                                            <small class="text-uppercase">gerencia@chasesoresenseguros.com</small>
                                            <br>
                                            <small class="text-uppercase">Cll 43a # 58-40 int(201) Bello - Antioquia</small>
                                            <br>
                                            <small><b class="text-uppercase">PBX:</b> (4) 448 02 01</small>
                                            
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
                <!-- Content Wrapper END -->
  @endsection


  @section('CustomJs')

    <script>

      $(document).ready(function(){
         validAuth(false, 'payment');
      
      });

    var id = {{$id}}
    

    $(document).ready(function(){
        getDataCompany();
        getData();
    });


    function getData(){
        var url=document.getElementById('ruta').value; 
        $.ajax({
            url:''+url+'/api/payment/'+id,
            type:"GET",
            data: {
                "id_user": id_user,
                "token"  : tokens,
            },
            dataType:'JSON',
            async: false,
            beforeSend: function(){
            
            },
            error: function (repuesta) {
                
            },
            success: function(data){

                $("#issue").text(data.issue);
                $("#id").text("#"+data.id);
                $("#date").text(data.init_date)
                $("#observations").text(data.observations)

                let nitText =  data.type_client == 1? `NIT: ${data.company.nit}`: `CÉDULA: ${data.client.number_document}`;
                let address =  data.type_client == 1? `${data.company.contact.department}, ${data.company.contact.city}`: data.client.number_document

                
                data.charge_account.forEach(charge => {
                    let branchName = charge.policie_data == null? charge.policie_anexes_data.policie.branch_data.name : 
                                                                  charge.policie_data.branch_data.name

                    let cells = `
                        <td>1</td>
                        <td id="branch">${branchName}</td>
                        <td id="number_policie">${charge.number}</td>
                        <td>-</td>
                        <td id="cousin">${charge.cousin}</td>
                        <td id="vat">${charge.vat}</td>
                        <td id="total" class="text-right">${charge.total}</td>
                    `;

                    let row = document.createElement('tr');
                    row.innerHTML = cells;

                    document.querySelector('#showtable tbody').appendChild(row)
                })

                $("#number_document").text(nitText)
                
                $("#address").text(address.trim() == ','? '' : address);

                let sumaCousin = data.charge_account.map(item => item.cousin).reduce((el1, el2) => el1 + el2);
                let sumaXpenses = data.charge_account.map(item => item.xpenses).reduce((el1, el2) => el1 + el2);
                let sumaVat = data.charge_account.map(item => item.vat).reduce((el1, el2) => el1 + el2);

                $("#subtotal").text(number_format((sumaCousin + sumaXpenses), 2))

                $("#ivasubtotal").text(number_format(sumaVat, 2))

                $("#totalpagar").text(number_format(sumaVat + (sumaCousin + sumaXpenses), 2))

                if(data.name_client == null && data.last_names == null){
                    data.nombreapellido = data.business_name;
                }
                else{
                    data.nombreapellido = `${data.name_client} ${data.last_names}`;
                }

                // nombre de agente, no se sabe

                $("#name_agent").text(data.nombre_p + ' '+data.apellido_p)
                $(".correo").text(data.email)

                $("#firm_agent").attr("src", url + "/img/usuarios/firms/"+data.firm)

                $("#name_client").text(data.nombreapellido)                
                


            }
        });

    }



    function getDataCompany(){

        var url=document.getElementById('ruta').value; 
        $.ajax({
            url:''+url+'/api/my/company',
            type:"GET",
            dataType:'JSON',
            async: false,
            beforeSend: function(){
            
            },
            error: function (repuesta) {
                
            },
            success: function(data){

                url_imagen = '/img/my_company/'
                $("#logo").attr("src", url+'/'+url_imagen+"/"+data.logo)


                $("#name").text(data.name)
                $("#phone").text(data.phone)

            }
        });
    }



    </script>

  @endsection
