<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../../config/Config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);
$idTyping = intval($_REQUEST["IdTipificacion"]);
$quantity = intval($_REQUEST["Cantidad"]);
$idUnity = intval($_REQUEST["IdUnidad"]);
$idServiceAgreement = intval($_REQUEST["id"]);

$paramsRequest = "{\r\n  \"IdAcuerdoServicio\": $idServiceAgreement,"
        . "\r\n  \"IdTipificacion\": $idTyping,"
        . "\r\n  \"Cantidad\": $quantity,"
        . "\r\n  \"IdUnidad\": $idUnity,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";


$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_AcuerdoServicio/PqrAcuerdoServicioActualizar",
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
        "postman-token: 3bb63537-6809-7e0b-259c-b1494b8e33ec"
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