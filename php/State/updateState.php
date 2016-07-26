<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file("../../config/config.ini");
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$idState = $_REQUEST["IdEstado"];
$name = $_REQUEST["Nombre"];
$radication = 0;
if (isset($_REQUEST["Radicacion"])) {
    $radication = ($_REQUEST["Radicacion"] == "on") ? 1 : 0;
}
$typin = 0;
if (isset($_REQUEST["Tipificacion"])) {
    $typin = ($_REQUEST["Tipificacion"] == "on") ? 1 : 0;
}
$state = 0;
if (isset($_REQUEST["Activo"])) {
    $state = ($_REQUEST["Activo"] == "on") ? 1 : 0;
}

$paramsRequest = "{"
        . "\r\n  \"IdEstado\": $idState,"
        . "\r\n  \"Nombre\": \"$name\","
        . "\r\n  \"Radicacion\": $radication,"
        . "\r\n  \"Tipificacion\": $typin,"
        . "\r\n  \"Activo\": $state,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Estados/EstadosInsertar",
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
        "postman-token: 9d53acbf-4478-0320-ea2e-5508ce762931"
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