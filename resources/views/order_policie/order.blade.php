<head>
<title>Chseguros</title>
    <style>
        table, th, td {
            border: 1px solid black;
            padding : 5px
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>
<body>

<div style="justify-content: center;align-items: center;">
    <div style="display:inline; flex-direction: row">
            <img style="width:30%; height:150px;" src={{$LOGO}}>
            <img  style="width:30%; height:150px" src="https://uberlink.co/wp-content/uploads/2019/01/inder-alcaldia-de-medellin-e1548361056743.jpg">
            <img  style="width:30%; height:150px" src={{$LOGO2}}>
    </div>


    <div style="
    margin-bottom:20px;
    width:700px;
    margin-top:-60px;
    text-aling:right;
    border: solid 1px black;
    width:100px;
    margin-left : 600px;
    ">

        <div style="padding:5px; border-bottom: solid 2px black;font-weight: 700;">N º ORDEN</div>
        <div style="padding:5px">{{$NRO_ORDEN}}</div>
    </div>



        





    <table>
        <tr>
            <td style = "width : 250px"><b>FECHA</b></td>
            <td>{{$FECHA}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>ASEGURADORA</b></td>
            <td>{{$ASEGURADORA}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>NIT</b></td>
            <td>{{$NIT_ASEGURADORA}}</td>
        </tr>  
    </table>


        <br>
    <table>
        <tr>
            <td style = "width : 250px"><b>ENTIDAD TOMADORA</b></td>
            <td>{{$ENTIDAD_TOMADORA}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>NIT</b></td>
            <td>{{$NIT_TOMADORA}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>N POLIZA</b></td>
            <td>{{$NRO_POLIZA}}</td>
        </tr>  
    </table>
    <br>
    <table>
        <tr>
            <td style = "width : 250px"><b>NOMBRES</b></td>
            <td>{{$NOMBRES}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>APELLIDOS</b></td>
            <td>{{$APELLIDOS}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>DOCUMENTO</b></td>
            <td>{{$DOCUMENTO}}</td>
        </tr>  
        <tr>
            <td style = "width : 250px"><b>FECHA DE NACIMIENTO</b></td>
            <td>{{$FECHA_DE_NACIMIENTO}}</td>
        </tr>  
        <tr>
            <td style = "width : 250px"><b>TIPO DE ACCIDENTE</b></td>
            <td>{{$TIPO_DE_ACCIDENTE}}</td>
        </tr>  
    </table>
    <br>
    <table>
        <tr>
            <td style = "width : 250px"><b>ENTIDAD MÉDICA</b></td>
            <td>{{$ENTIDAD_MEDICA}}</td>
        </tr>
        <tr>
            <td style = "width : 250px"><b>NIT</b></td>
            <td>{{$NIT_ENTIDAD_MEDICA}}</td>
        </tr>
    </table>
    <br> <br>
    <div style="margin:auto; text-align:center; height:50px; width:200px;margin-bottom:200px; border-bottom:solid 2px black"> Firma de Autorización:</div>
</div>
</body>