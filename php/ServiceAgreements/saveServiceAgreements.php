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

$paramsRequest = "{\r\n  \"IdTipificacion\": $idTyping,"
        . "\r\n  \"Cantidad\": $quantity,"
        . "\r\n  \"IdUnidad\": $idUnity,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config['server'] . "/api/Pqr_AcuerdoServicio/PqrAcuerdoServicioInsertar",
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
        "postman-token: 779a3f7b-08a7-811c-e718-9159ab1b5ebf"
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