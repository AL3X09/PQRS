<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../../config/config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);

$name = htmlspecialchars($_REQUEST["Nombre"]);
$codeDANE = intval($_REQUEST["CodigoDANE"]);
$state = 0;
if (isset($_REQUEST["Activo"])) {
    $state = ($_REQUEST["Activo"] == "on") ? 1 : 0;
}
$idCountry = intval($_REQUEST["IdPais"]);


$paramsRequest = "{"
        . "\r\n  \"IdDepartamento\": 1,"
        . "\r\n  \"Nombre\": \"$name\","
        . "\r\n  \"CodigoDANE\": $codeDANE,"
        . "\r\n  \"Activo\": $state,"
        . "\r\n  \"IdPais\": $idCountry,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Departamentos/DepartamentosInsertar",
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
        "postman-token: 12b817de-6367-3a2f-b5a9-412879745963"
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