<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../../config/Config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = $_SESSION["id-user"];

$paramsRequest = "{" . $functions->concatComma($functions->validateRequestParameter("IdAcuerdoServicio", "IdAcuerdoServicio"))
        . $functions->concatComma($functions->validateRequestParameter("IdTipificacion", "IdTipificacion"))
        . $functions->concatComma($functions->validateRequestParameter("Cantidad", "Cantidad"))
        . $functions->concatComma($functions->validateRequestParameter("IdUnidad", "IdUnidad"))
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";
//echo $paramsRequest;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_AcuerdoServicio/PqrAcuerdoServicioConsultarFiltrosExcel",
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
        "postman-token: 57c609dc-2f68-bfe4-9c11-6430bc1c6e94"
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