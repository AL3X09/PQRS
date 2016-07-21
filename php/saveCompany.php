<?php

require_once './functions.php';
//if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../config/Config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$nameCompany = $_REQUEST["Nombre"];

$paramsRequest = "{\r\n  \"Nombre\": \"$nameCompany\","
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";
//echo $paramsRequest;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Empresas/EmpresasInsertar",
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
        "postman-token: c3121a24-3f90-70ee-49c5-b021c00833be"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $result = (is_numeric($response)) ? "Empresa ingresada con exito" : "Ha ocurrido un error, por favor intente nuevamente. $response";
    echo json_encode($result);
}
//}else{
//    echo "inicio";
//}