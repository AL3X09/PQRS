<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file("../../config/config.ini");
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);

$idBranchOffice = intval($_REQUEST["IdSucursal"]);
$name = htmlspecialchars($_REQUEST["Nombre"]);
$idCity = intval($_REQUEST["IdCiudad"]);
$codeThird = htmlspecialchars($_REQUEST["CodigoTercero"]);

$paramsRequest = "{\r\n  \"IdSucursal\":$idBranchOffice,"
        . "\r\n  \"Nombre\": \"$name\","
        . "\r\n  \"IdCiudad\": $idCity,"
        . "\r\n  \"CodigoTercero\": \"$codeThird\","
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Sucursales/PqrSucursalesActualizar",
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
        "postman-token: b4cd861e-f720-7488-304e-2b8f6278813c"
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