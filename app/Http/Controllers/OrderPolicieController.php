<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class OrderPolicieController extends Controller
{

public function RegisterClientPeople(Request $request){
    $insert = DB::table('clients_people')
                ->insert([
                    'namespace'       =>$request['nombres'],
                    'last_names'      =>$request['apellidos'],
                    'type_document'   =>$request['tipo_documento'],
                    'number_document' =>$request['nro_documento'],
                    'birthdate'       =>$request['fecha_nacimiento']
                ]);
//return id_clients_people
}





    public function CreatePdf(Request $request){
        $data  = DB:: table('order_sinister_person')
                    ->insert([
                        'id_person'              =>$request['id_client'],
                        'id_entidad_medica'      =>$request['id_medica'],
                        'id_entidad_tomadora'    =>$request['id_tomadora'],
                        'id_entidad_aseguradora' =>$request['id_insures'],
                        'accident'               =>$request['type_accident']
                    ]);
//return id

    }




    public function DownloadPdf($id_order){
            $DATA = DB::table('order_sinister_person')
            ->join('hospitales', 'hospitales.id', 'order_sinister_person.id_entidad_medica')
            ->join('clients_people','clients_people.id_clients_people','order_sinister_person.id_person')
            ->join('insurers','insurers.id_insurers','order_sinister_person.id_entidad_aseguradora')
            ->join('clients_company','clients_company.id_clients_company','order_sinister_person.id_entidad_tomadora')

            ->select(
                'order_sinister_person.id',
                'order_sinister_person.created_at',
                'order_sinister_person.accident',
                'clients_people.names',
                'clients_people.last_names',
                'clients_people.number_document',
                'clients_people.birthdate',
                'hospitales.name as hospital',
                'hospitales.code',
                'clients_company.business_name',
                'clients_company.id_clients_company',
                'clients_company.nit',
                'insurers.name',
                'insurers.code',
                'insurers.id_insurers',
                'insurers.nit',
            )
            ->get();

    $pdf = app('dompdf.wrapper');
    //$pdf->loadHTML('<h1>Styde.net</h1>');
   // $pdf->loadView()
    //return $pdf->download();
    $data = [
        "LOGO" => "https://www.gruposura.com/wp-content/uploads/2018/09/SURA_logo_unatinta_azul_POSITIVO.png",//"https://uberlink.co/wp-content/uploads/2019/01/inder-alcaldia-de-medellin-e1548361056743.jpg",
        "LOGO2" => "data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxESEhISERAVFRMXFhYYFhcXFxgVFRgZFxYYFh0XGhcYHSggGRolHRUWITIhJSkrLzouFyAzODU4NygtLisBCgoKDg0OGxAQGy0mICUtLS8vLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLf/AABEIALwBDAMBIgACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAABgcDBQgEAgH/xABOEAABAwIDAwYICQkHAwUAAAABAAIDBBEFEiEGBzETIkFRYXEIFDJygZGyszM0NVJzdIKhsSM2QlNikqLD0RUXQ0WEwcIWJCVEVGODk//EABkBAQADAQEAAAAAAAAAAAAAAAABAgMEBf/EADIRAAIBAwIDBAkFAQEAAAAAAAABAgMEESExEkFxBVGR8BMyQmGBobHB0SIzNOHxJBT/2gAMAwEAAhEDEQA/ALxREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAEREAREQBERAERajaPHYqOLlJcxucrWtFy51ibdQ0B1KlJt4RDaSyzbXUN2j29p4LshtNLw0P5Np7X9J7B6woLtFtjU1d235KE/4bDxH7buLu7Qdijq7adpzn4HJUuuUPEsDGdr6uLB/HmPbywqANWjIW8plyZfm20437V6Nit7FHWZYqi1NUHSzj+Sef2ZDwJ+a63GwJUY2l/No/WB70qllvStadWMs6Yk9jaEnwrodrouX9i95lbh+WMnl6caclITzR1Rv1LO7Udi6B2P2ogxGDl6fMAHZHteLOa8AOLeo6OBuD0rir206Wr27zVSTN+iIuckIiIAiIgCIiAIiIAiIgCIiAIiIAiIgCIiAIiIAvh7wASSABxJ0C+1BMZrZJJHtc7mtc4Bo0GhI4dJXJd3St4KTWc7FZS4Tc4ntG1t2wjMfnHyR3dah+2O8qXDcQjhkiEtM6CN7gObK1znPBc08CLN8k+sLOVXO/f5Qi+qQ+1Io7DrSu7iaq7Y25LcpGbeS9dm9qKSvZnpZmvt5TOEjPOYdR068DbQr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",
        "NRO_ORDEN" => "123",
        "FECHA"  =>"10/07/2021",
        "ASEGURADORA"  =>"Aseguradora Solidaria de Colombia",
        "NIT_ASEGURADORA"  =>"10332423 - 9",
        "ENTIDAD_TOMADORA" => "Inder Medellin",
        "NIT_TOMADORA"  =>"1019288124 - 9",
        "NRO_POLIZA" => "31123213",
        "NOMBRES"  =>"Pedrito",
        "APELLIDOS" => "Perez Gonzales",
        "DOCUMENTO" => "1032343244",
        "FECHA_DE_NACIMIENTO"  =>"19/07/2021",
        "TIPO_DE_ACCIDENTE" => "Fractura",
        "ENTIDAD_MEDICA" => "Hospital Pablo Tobon Uribe",
        "NIT_ENTIDAD_MEDICA"  =>"12314124 - 9"
    ];
        
    return $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('order_policie.order', $data)
        ->stream('archivo.pdf');
    }
}
