<?php

$config = parse_ini_file('../../config/config.ini');
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8002",
  CURLOPT_URL => $config['server'] ."/api/Pqr_Tareas/PqrTareasConsultarTodo",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 396905d9-454b-5b31-5bf2-4a5c8c565048"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $response;
/*
//tener en cuenta si hay modificaciones en las consultas y no aparecen los datos es porque
//estan en un array asosiativo para tener mejor control de este.
*/
    //envio respuesta a un array 
    $array = json_decode($response, true);
    //valido si no un array
    if (!is_array($array)) {
    var_dump($array);
    }else {                         //si es un array se trabaja 
    $result = array();              // variable donde se re asigna array
    $row;                           //variable donde con la que se trabaja el array 
    foreach ($array as $key => $value) {
        //re asigno valores
        $row = array(
            "IdTarea" => $value["IdTarea"],
            "Nombre" => $value["Nombre"],
            "IdResponsableTarea" => $value["IdResponsableTarea"],
            "nResponsableTarea" => $value["nResponsableTarea"],
            //"FechaInicioTarea" => substr($value["FechaInicioTarea"],0,10), // con substr controlo las cadenas a mostar
            "FechaInicioTarea" => $value["FechaInicioTarea"] == ("") ? "" : substr($value["FechaInicioTarea"],0,10),
            "FechaFinEstimadoTarea" => substr($value["FechaFinEstimadoTarea"],0,10),            
            //"FechaFinTarea" => substr($value["FechaFinTarea"],0,10),
            //quitar false de la vista de campos fechas
            "FechaFinTarea" => $value["FechaFinTarea"] == ("") ? "" : substr($value["FechaFinTarea"],0,10),
        );
        array_push($result, $row);      //agrego valores de row en result 
    }
       //var_dump($result);
   echo json_encode($result, true);     //envio jason a vista para trabajarlo
  }
}