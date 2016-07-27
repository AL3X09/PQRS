<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file("../../config/config.ini");
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$idHeader = intval($_REQUEST["IdPqrEncabezado"]);
$idTypeLineTime = intval($_REQUEST["IdTipoLineaTiempo"]);
$description = htmlspecialchars($_REQUEST["Descripcion"]);
$emailTo = htmlspecialchars($_REQUEST["EmailTo"]);
$homework = intval($_REQUEST["Tarea"]);
$idHomework = intval($_REQUEST["IdTarea"]);
$creationUser = intval($_REQUEST["UsuarioCreacion"]);

$paramsRequest = "{"
        . "\r\n  \"IDLineaTiempo\": 1,"
        . "\r\n  \"IdPqrEncabezado\": $idHeader,"
        . "\r\n  \"IdTipoLineaTiempo\": $idTypeLineTime,"
        . "\r\n  \"Descripcion\": \"$description\","
        . "\r\n  \"EmailTo\": \"$emailTo\","
        . "\r\n  \"Tarea\": $homework,"
        . "\r\n  \"IdTarea\": $idHomework,"
        . "\r\n  \"UsuarioCreacion\": $creationUser\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_LineaTiempo/PqrLineaTiempoInsertar",
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
        "postman-token: c57b9265-0850-8efd-8241-72eae0b59899"
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