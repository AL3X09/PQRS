<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file("../../config/config.ini");
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$name = $_REQUEST["Nombres"];
$idDocumentType = $_REQUEST["IdTipoDocumento"];
$lastname = $_REQUEST["Apellidos"];
$documentNumber = $_REQUEST["NumeroDocumento"];
$age = $_REQUEST["Edad"];
$address = $_REQUEST["Direccion"];
$phoneNumber = $_REQUEST["TelefonoFijo"];
$cellphoneNumber = $_REQUEST["TelefonoMovil"];
$email = $_REQUEST["Email"];

$paramsRequest = "{\r\n  \"IdPersona\": 1,"
        . "\r\n  \"IdTipoDocumento\": $idDocumentType,"
        . "\r\n  \"NumeroDocumento\": \"$documentNumber\","
        . "\r\n  \"Nombres\": \"$name\","
        . "\r\n  \"Apellidos\": \"$lastname\","
        . "\r\n  \"Edad\": $age,"
        . "\r\n  \"Direccion\": \"$address\","
        . "\r\n  \"TelefonoFijo\": $phoneNumber,"
        . "\r\n  \"TelefonoMovil\": $cellphoneNumber,"
        . "\r\n  \"Email\": \"$email\","
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Personas/PersonasInsertar",
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
        "postman-token: 21852675-1d33-5898-462f-8550d2dc77ca"
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