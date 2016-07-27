<?php

require_once '../functions.php';
//ini_set("display_errors", "on");
session_start();

$config = parse_ini_file("../../config/config.ini");
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);

$idProduct = intval($_REQUEST["IdProducto"]);
$name = htmlspecialchars($_REQUEST["Nombre"]);
$codeThird = htmlspecialchars($_REQUEST["CodigoTercero"]);
$state = 0;
if (isset($_REQUEST["Activo"])) {
    $state = ($_REQUEST["Activo"] == "on") ? 1 : 0;
}
$paramsRequest = "{"
        . "\r\n  \"IdProducto\": $idProduct,"
        . "\r\n  \"Nombre\": \"$name\","
        . "\r\n  \"CodigoTercero\": \"$codeThird\","
        . "\r\n  \"Activo\": $state,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";
//echo $paramsRequest;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Productos/ProductosActualizar",
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
        "postman-token: a819dcdb-a3aa-3360-debd-e969ff68b027"
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