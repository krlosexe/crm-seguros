@extends('layouts.app')

	@section('content')
	     <!-- Theme Toggle Button START -->
		 <button class="theme-toggle btn btn-rounded btn-icon">
                    <i class="ti-palette"></i>
                </button>
                <!-- Theme Toggle Button END -->

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <div class="container-fluid dashbord_content">
                        <div class="row">
                            <div class="col-lg-3">

                                <div class="card casilla-ganancias">
                                    <div class="card-block">
                                        <div class="inline-block">
                                            <h1 class="no-mrg-vertical" id="balance">$968.900</h1>
                                            <p>Ganancias de la semana</p>
                                        </div>
                                        {{-- Programar esto --}}
{{--                                         <div class="pdd-top-25 inline-block pull-right">
                                            <span class="label label-success label-lg mrg-left-5">+18%</span>
                                        </div> --}}
                                        <div class="mrg-top-25">
                                            <div id="bar-config"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card estadistica-poliza">
                                    <div class="card-block">
                                        <p class="mrg-btm-5">Estadisticas de pólizas</p>
                                        <h1 class="no-mrg-vertical font-size-35" id="sold"><b class="font-size-16"></b></h1>
                                        <p class="text-semibold">Pólizas vendidas</p>
                                        <div class="mrg-top-10">
                                            <h2 class="no-mrg-btm" id="renovations"></h2>
                                            <span class="inline-block mrg-btm-10 font-size-13 text-semibold">Renovaciones</span>
                                            <span class="pull-right pdd-right-10 font-size-13" id="renovations_porcentaje"></span>
                                            <div class="progress progress-success">
                                                <div class="progress-bar" id="progressbar_renovations" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width:0%">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mrg-top-10">
                                            <h2 class="no-mrg-btm" id="expired"></h2>
                                            <span class="inline-block mrg-btm-10 font-size-13 text-semibold">Pendientes de renovar</span>
                                            <span class="pull-right pdd-right-10 font-size-13" id="expired_porcentaje"></span>
                                            <div class="progress progress-warning">
                                                <div class="progress-bar" role="progressbar" id="progressbar_expired"  aria-valuenow="0" aria-valuemin="0" aria-valuemax="0" style="width:0%">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="card estadistica-poliza-vigente">
                                    <div class="card-block">
                                        <h1 class="no-mrg-vertical font-size-35" id="Vigentes_count"><b class="font-size-16"></b></h1>
                                        <p class="mrg-btm-5">Pólizas Vigentes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="card ciudades-principales">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="maps map-500 padding-20">
                                                <div id="map">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 border left border-hide-sm">
                                            <div class="card-block">
                                                <h2>Principales ciudades </h2>
                                                <div class="mrg-top-40">
                                                    <div>
                                                        <canvas height="230" id="allocation-chart"></canvas>
                                                    </div>
                                                </div>
                                                <div class="mrg-top-30" id="legends-allocation">
                                                    <div class="relative mrg-top-15">
                                                        <span class="status info"> </span>
                                                        <span class="pdd-left-20 font-size-16"><b class="text-dark">25%</b> Bógota</span>
                                                    </div>
                                                    <div class="relative mrg-top-15">
                                                        <span class="status primary"> </span>
                                                        <span class="pdd-left-20 font-size-16"><b class="text-dark">45%</b> Medellín</span>
                                                    </div>
                                                    <div class="relative mrg-top-15">
                                                        <span class="status success"> </span>
                                                        <span class="pdd-left-20 font-size-16"><b class="text-dark">10%</b> Cali</span>
                                                    </div>
                                                    <div class="relative mrg-top-15">
                                                        <span class="status"> </span>
                                                        <span class="pdd-left-20 font-size-16"><b class="text-dark">15%</b> Manizales</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   <!-- Content Wrapper START <div class="card-footer d-none d-md-inline-block">
                                        <div class="text-center">
                                            <div class="row">
                                                <div class="col-md-12 ml-auto mr-auto">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="pdd-vertical-5">
                                                                <p class="no-mrg-btm"><b class="text-dark font-size-16">Aseguradora MP:</b> <br>Suramericana en seguros SA</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="pdd-vertical-5">
                                                                <p class="no-mrg-btm"><b class="text-dark font-size-16">Ramo MP:</b><br> Vida</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="pdd-vertical-5">
                                                                <p class="no-mrg-btm"><b class="text-dark font-size-16">Vendedor MP: </b><br> chseguros.com ltda</p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --> 
                                    </div>
                                </div>
                            </div>
                        </div>

                          <div class="row">
                             <div class="col-md-12">
                                 
                                 <div class="card ragen-time">
                                    <div class="card-heading">
                                        
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label>Fecha desde</label>
                                                <input type="date" id="fecha_desde_polizas" onchange="reloadTables()" class="form-control" value="{{ date('Y-m-01', strtotime('-1 year')) }}">
                                            </div>

                                            <div class="col-md-3">
                                                <label>Fecha hasta</label>
                                                <input type="date" id="fecha_hasta_polizas"  onchange="reloadTables()" class="form-control" value="{{ date('Y-m-d') }}">                                
                                            </div>

                                        </div>
                                    </div>
                                 </div>
                             </div>
                         </div>

                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                              <div class="card next-polices">
                                    <div class="card-heading">
                                                <h4 class="card-title inline-block pdd-top-5">Pólizas próximas a renovar</h4>
      
                                        {{-- <a href="" class="btn btn-default pull-right no-mrg">Ver toda</a> --}}
                                    </div>
                                    <div class="pdd-horizon-20 pdd-vertical-5 content-load">

                                    <div class="text-center col-md-12 loader-1" style="display: none">
                                          <span>Cargando...</span>
                                          <div class="progress">
                                              <div class="progress-bar  progress-bar-striped progress-bar-info active" role="progressbar"
                                                   aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                                   style="width: 100%">
                                                  <span class="sr-only"></span>
                                              </div>
                                          </div>
                                      </div>

                                        <div class="overflow-y-auto relative table-result-1 scrollable" style="max-height: 381px">
                                            <table class="table table-lg table-hover" id="table_policies_next_expired">
                                                <tbody>
                                                   
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="card cartera-cobro">
                                    <div class="card-heading">
                                        <h4 class="card-title inline-block pdd-top-5">Cartera por cobrar</h4>
                                        {{-- <a href="" class="btn btn-default pull-right no-mrg">Ver toda</a> --}}
                                    </div>
                                    <div class="pdd-horizon-20 pdd-vertical-5 content-load">

                                        <div class="text-center col-md-12 loader-2" style="display: none">
                                              <span>Cargando...</span>
                                              <div class="progress">
                                                  <div class="progress-bar  progress-bar-striped progress-bar-info active" role="progressbar"
                                                       aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                                       style="width: 100%">
                                                      <span class="sr-only"></span>
                                                  </div>
                                              </div>
                                          </div>

                                        <div class="overflow-y-auto relative table-result-2 scrollable" style="max-height: 381px">
                                            <table class="table table-lg table-hover">
                                                <tbody id="table_charge_account">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                              <div class="card polizas-vencidas">
                                    <div class="card-heading">
                                                <h4 class="card-title inline-block pdd-top-5">Pólizas Vencidas/No renovadas</h4>
      
                                        {{-- <a href="" class="btn btn-default pull-right no-mrg">Ver toda</a> --}}
                                    </div>
                                    <div class="pdd-horizon-20 pdd-vertical-5 content-load">

                                    <div class="text-center col-md-12 loader-1" style="display: none">
                                          <span>Cargando...</span>
                                          <div class="progress">
                                              <div class="progress-bar  progress-bar-striped progress-bar-info active" role="progressbar"
                                                   aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                                   style="width: 100%">
                                                  <span class="sr-only"></span>
                                              </div>
                                          </div>
                                      </div>

                                        <div class="overflow-y-auto relative table-result-1 scrollable" style="max-height: 381px">
                                            <table class="table table-lg table-hover" id="table_policies_expired">
                                                <tbody>
                                                   
                                                </tbody>
                                            </table>
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

                /* case by role*/
                if(id_rol != 22){
                    RemoveNotRole('.estadistica-poliza-vigente')
                    login()
                    Clients()
                    var primary = '#7774e7',
                    success = '#37c936',
                    info = '#0f9aee',
                    warning = '#ffcc00',
                    danger = '#ff3c7e',
                    primaryInverse = 'rgba(119, 116, 231, 0.1)',
                    successInverse = 'rgba(55, 201, 54, 0.1)',
                    infoInverse = 'rgba(15, 154, 238, 0.1)',
                    warningInverse = 'rgba(255, 204, 0, 0.1)',
                    dangerInverse = 'rgba(255, 60, 126, 0.1)',
                    gray = '#f6f7fb',
                    white = '#fff',
                    dark = '#515365'

                    ganancias()
                    policies()
                    policiesExpired()
                    policiesVencidas()
                    ChargeAccountPending()

                }else{
                    $('.dashbord_content').find('.casilla-ganancias,.estadistica-poliza-vigente').show();
                    ganancias();
                    policiesVigentes();
                }

                /**/





            });
            

            function RemoveNotRole(class_list){
                $(class_list).parent().remove();
                $('.dashbord_content .card').show();
            }


            function reloadTables(){
                ChargeAccountPending();
                policiesVencidas()
                policiesExpired();
            }


			function login(){
				enviarFormulario("#login", 'auth', '#cuadro2', true);
			}


            function ganancias(){
                
               if(name_rol != 'Administrador'){
                    $('.casilla-ganancias').hide()
                }

                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/ganancias',
                    type:'GET',
                    dataType:'JSON',
                   
                    beforeSend: function(){
                    
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){
                        $("#balance").text(number_format(data.total, 2))
                    }
                });


            }



            function ChargeAccountPending(){

                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/charge/account/pending',
                    type:'GET',
                    dataType:'JSON',
                    data: {
                        fecha_hasta_polizas: $('#fecha_hasta_polizas').val(),
                        fecha_desde_polizas: $('#fecha_desde_polizas').val(),
                    },
                    beforeSend: function(){
                        $('.table-result-2').hide();
                        $('.loader-2').show();
                        $("#table_charge_account").html('')
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){

                        $('.loader-2').hide();
                        $('.table-result-2').show();

                        var html = ""

                        if(data.length == 0){
                            html = `
                                <tr>
                                    <td>
                                        <div class="list-info text-center">
                                            <span>Sin datos que mostrar</span>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }

                        $.map(data, function (item, key) {

                            let name = item.type_client == 1? item.company.business_name : item.client.fullname;

                            html += '<tr>'
                                    +'<td>'
                                        +'<div class="list-info">'
                                        +` <img class="thumb-img" src="${url}/img/default-user.png" alt="">`
                                            + '<div class="info">'
                                            +  '<span class="title">'+name+'</span>'
                                            + '<a target="_blank" href="payment/'+item.id+'" class="sub-title"># '+item.issue+'</a>'
                                            +'</div>'
                                        +'</div>'
                                + '</td>'
                                + ' <td>'
                                    + '<div class="mrg-top-10">'
                                        + '<span>'+item.limit_date+'</span>'
                                        +'</div>'
                                + '</td>'
                            + '</tr>'

                        });

                        $("#table_charge_account").html(html)
                    }
                });

            }




            function policiesExpired(){

                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/policies/next/expired',
                    type:'GET',
                    dataType:'JSON',
                    data: {
                        fecha_desde_polizas: $('#fecha_desde_polizas').val(),
                        fecha_hasta_polizas: $('#fecha_hasta_polizas').val(),
                    },
                    beforeSend: function(){
                        $('.table-result-1').hide();
                        $('.loader-1').show();

                        $("#table_policies_next_expired").html('')
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){

                        var html = ""
                        $('.loader-1').hide();
                        $('.table-result-1').show();

                        if(data.length == 0){
                            html = `
                                <tr>
                                    <td>
                                        <div class="list-info text-center">
                                            <span>Sin datos que mostrar</span>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }

                        $.map(data, function (item, key) {
                           let name = item.type_clients == 1? item.business_name : item.fullname

                           html += '<tr>'
                                +'<td>'
                                    +'<div class="list-info">'
                                        +` <img class="thumb-img" src="${url}/img/default-user.png" alt="">`
                                       + '<div class="info">'
                                          +  '<span class="title">'+name+'</span>'
                                           + '<a target="_blank" href="policies/'+item.id_policies+'" class="sub-title"># '+item.number_policies+'</a>'
                                        +'</div>'
                                    +'</div>'
                               + '</td>'
                              + ' <td>'
                                   + '<div class="mrg-top-10">'
                                       + '<span>'+item.end_date+'</span>'
                                    +'</div>'
                               + '</td>'
                           + '</tr>'

                        });

                        $("#table_policies_next_expired").html(html)
                    }
                });

            }

            function policiesVencidas(){

                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/policies/next/vencidas',
                    type:'GET',
                    dataType:'JSON',
                    data: {
                        fecha_desde_polizas: $('#fecha_desde_polizas').val(),
                        fecha_hasta_polizas: $('#fecha_hasta_polizas').val(),
                    },
                    beforeSend: function(){
                        $('.table-result-1').hide();
                        $('.loader-1').show();

                        $("#table_policies_next_expired").html('')
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){

                        var html = ""
                        $('.loader-1').hide();
                        $('.table-result-1').show();

                        if(data.length == 0){
                            html = `
                                <tr>
                                    <td>
                                        <div class="list-info text-center">
                                            <span>Sin datos que mostrar</span>
                                        </div>
                                    </td>
                                </tr>
                            `;
                        }

                        $.map(data, function (item, key) {
                           let name = item.type_clients == 1? item.business_name : item.fullname

                           html += '<tr>'
                                +'<td>'
                                    +'<div class="list-info">'
                                        +` <img class="thumb-img" src="${url}/img/default-user.png" alt="">`
                                       + '<div class="info">'
                                          +  '<span class="title">'+name+'</span>'
                                          +  '<span class="sub-title" style="font-weight: bold;">'+item.state_policies+'</span>'
                                           + '<a target="_blank" href="policies/'+item.id_policies+'" class="sub-title"># '+item.number_policies+'</a>'
                                        +'</div>'
                                    +'</div>'
                               + '</td>'
                              + ' <td>'
                                   + '<div class="mrg-top-10">'
                                       + '<span>'+item.end_date+'</span>'
                                    +'</div>'
                               + '</td>'
                           + '</tr>'

                        });

                        $("#table_policies_expired").html(html)
                    }
                });

            }

            function policiesVigentes(){

                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/policies/next/vigentes',
                    type:'GET',
                    dataType:'JSON',
                    data: { id_user },
                    success: function(data){
                        $('#Vigentes_count').text(
                            data.length
                        )
                    }
                });

            }

            function policies(){

                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/policies',
                    type:'GET',
                    dataType:'JSON',
                   
                    beforeSend: function(){
                    
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){
                
                        $("#sold").text(data.sold.total)
                        $("#renovations").text(data.renovations.total)
                        $("#renovations_porcentaje").text(data.renovations.porcentaje+" %")
                        $("#progressbar_renovations").attr("aria-valuenow", data.renovations.porcentaje)
                        $("#progressbar_renovations").attr("aria-valuemax", data.renovations.porcentaje)
                        $("#progressbar_renovations").css("width", data.renovations.porcentaje+"%")

                        $("#expired").text(data.expired.total)
                        $("#expired_porcentaje").text(data.expired.porcentaje+" %")
                        $("#progressbar_expired").attr("aria-valuenow", data.expired.porcentaje)
                        $("#progressbar_expired").attr("aria-valuemax", data.expired.porcentaje)
                        $("#progressbar_expired").css("width", data.expired.porcentaje+"%")

                        

                    }
                });

            }





            function Clients(){
                
                var url=document.getElementById('ruta').value;
                $.ajax({
                    url:''+url+'/api/stadist/client/',
                    type:'GET',
                    dataType:'JSON',
                   
                    beforeSend: function(){
                    
                    },
                    error: function (data) {
                        
                    },
                    success: function(data){
                       
                       var labels = []
                       var colors = []
                       var counts = []


                       var countries = []
                       
                       var html = ""
                       $.map(data.data, function (item, key) {
                            labels.push(item.nombre)
                            colors.push(item.color)
                            counts.push(item.count)
                            
                            countries = {
                                ...countries,
                                [item.cod] : item.color
                            }

                            html += '<div class="relative mrg-top-15">'
                                    + '<span style="border-color: '+item.color+';" class="status info"> </span>'
                                    + '<span class="pdd-left-20 font-size-16"><b class="text-dark">'+item.porcentaje+'%</b> '+item.nombre+'</span>'
                                    + '</div>'
                            
                       });

                       $("#legends-allocation").html(html)

                       var allocationChart = document.getElementById("allocation-chart");
                        var allocationCtx = allocationChart.getContext('2d');
                        var allocationData = {
                            labels: labels,
                            datasets: [
                                {
                                    fill: true,
                                    backgroundColor: colors,
                                    data: counts
                                }
                            ]
                        };

                        var allocationConfig = new Chart(allocationCtx, {
                            type: 'doughnut',
                            data: allocationData,
                            options: {
                                maintainAspectRatio: false,
                                legend: {
                                    display: false
                                },
                                cutoutPercentage: 75
                            }
                        });


                        $('#map').vectorMap({
                            map: 'co_merc',
                            backgroundColor: '#fff',
                            scaleColors: ['#C8EEFF', '#0071A4'],
                            regionStyle: {
                                initial: {
                                    fill: '#19212e87'
                                }
                            },
                            series: {
                                regions: [{
                                values: countries
                                }]
                            }
                            
                        });




                    }
                });
            }


		</script>


	@endsection


