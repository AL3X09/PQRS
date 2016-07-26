<?php

/*
 * QUEDA PENDIENTE YA QUE LA AGENDA DEPENDE DEL ENCABEZADO 
 * 
 * 
 */



require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file("../../config/config.ini");
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$typeDairy = $_REQUEST["IdTipoAgenda"];


$paramsRequest = "{"
        . "\r\n  \"IdTipoAgenda\": 1,"
        . "\r\n  \"IdPqrEncabezado\": 1,"
        . "\r\n  \"URadicaAgenda\": 1,"
        . "\r\n  \"FechaCreacion\": \"2016-07-25T15:22:10.8738611-05:00\","
        . "\r\n  \"CorreoA\": \"sample string 1\","
        . "\r\n  \"Agenda\": \"sample string 2\"\r\n}";


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Agenda/AgendaInsertar",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $paramsRequest,
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: de6ca25e-5c73-3938-8426-51640c74ecf1"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}