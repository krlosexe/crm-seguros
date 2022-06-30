<table>
    <thead>
    <tr>
        <th><b>Numero de Polzia</b></th>
        <th><b>Cliente</b></th>
        <th><b>Telefono1</b></th>
        <th><b>Telefono2</b></th>
        <th><b>Aseguradora</b></th>
        <th><b>Ramo</b></th>
        <th><b>Riesgo</b></th>
        <th><b>Estatus</b></th>
        <th><b>Fecha Expedicion</b></th>
        <th><b>Fecha Inicio</b></th>
        <th><b>Fecha Fin</b></th>

        <th><b>Nombre tomador</b></th>
        <th><b>Documento del tomador</b></th>
        <th><b>Nombre Asegurado</b></th>
        <th><b>Documento del Asegurado</b></th>
        <th><b>Nombre Beneficiario</b></th>
        <th><b>Documento Beneficiario</b></th>


        <th><b>Prima</b></th>
        <th><b>Gastos (Expedición,Runt,Fosyga) *</b></th>
        <th><b>IVA</b></th>

    </tr>
    </thead>
    <tbody>
    @foreach($data as $value)
        <tr>
            <td>{{ $value->number_policies }}</td>

            @if($value->type_clients)
                <td>{{ $value->business_name }}</td>
            @else
                <td>{{ $value->names }} {{ $value->last_names }}</td>
            @endif


            <td>{{ $value->phone_client }}</td>
            <td>{{ $value->phone_client2 }}</td>


            <td>{{ $value->name_insurers }}</td>
            <td>{{ $value->name_branchs }}</td>
            <td>{{ $value->risk }}</td>
            <td>{{ $value->state_policies }}</td>
            <td>{{ $value->expedition_date }}</td>
            <td>{{ $value->start_date }}</td>
            <td>{{ $value->end_date }}</td>

            <td>{{ $value->name_taker }}</td>
            <td>{{ $value->identification_taker }}</td>
            <td>{{ $value->name_insured }}</td>
            <td>{{ $value->identification_insured }}</td>
            <td>{{ $value->beneficairy_name }}</td>
            <td>{{ $value->beneficairy_identification }}</td>

            <td>{{ $value->cousin }}</td>
            <td>{{ $value->xpenses }}</td>
            <td>{{ $value->vat }}</td>
        </tr>
    @endforeach
    </tbody>
</table>