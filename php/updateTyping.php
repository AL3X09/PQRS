<?php

require_once './functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('Config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$idTyping = $_REQUEST["id"];
$nameTyping = $_REQUEST["Nombre"];
$timeResponse = $_REQUEST["TiempoEstimadoRespuesta"];
$codeSuper = $_REQUEST["CodigoSuper"];
$status = true; //$_REQUEST["Activo"];
$dependece = $_REQUEST["Padre"];

$paramsRequest = "{\r\n  \"IdTipificacion\": $idTyping,"
        . "\r\n  \"Nombre\": \"$nameTyping\","
        . "\r\n  \"Activo\": $status,"
        . "\r\n  \"Padre\": $dependece,"
        . "\r\n  \"CodigoSuper\": $codeSuper,"
        . "\r\n  \"TiempoEstimadoRespuesta\": 10,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$$ipUser\"\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Tipificacion/PqrTipificacionActualizar",
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
        "postman-token: 1a47a70a-3bda-71f6-4d75-d12c713ea8d5"
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