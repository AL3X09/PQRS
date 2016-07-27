<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../../config/config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);

$name = htmlspecialchars($_REQUEST["Nombre"]);
$passwordMediatory = $_REQUEST["ClaveInter"];
$email = htmlspecialchars($_REQUEST["Email"]);
$address = htmlspecialchars($_REQUEST["Direccion"]);
$phoneNumber = htmlspecialchars($_REQUEST["Telefono"]);
$idMediatory = intval($_REQUEST["IdIntermediario"]);

$paramsRequest = "{\r\n  \"IdIntermediario\": $idMediatory,"
        . "\r\n  \"Nombre\": \"$name\","
        . "\r\n  \"ClaveInter\": \"$passwordMediatory\","
        . "\r\n  \"Email\": \"$email\","
        . "\r\n  \"Direccion\": \"$address\","
        . "\r\n  \"Telefono\": \"$phoneNumber\","
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n"
        . "}";
//echo $paramsRequest;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Intermediarios/IntermediariosActualizar",
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
        "postman-token: c8ea4430-8309-4562-4396-a70cb2d6a69e"
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