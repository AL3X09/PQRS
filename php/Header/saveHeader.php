<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../../config/config.ini');
$functions = new functions();

$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);

$idCompany = intval($_REQUEST["IdEmpresa"]);
$idTypePerson = intval($_REQUEST["IdTipoPersona"]);
$idPerson = intval($_REQUEST["IdPersona"]);
$idApplicantCompany = intval($_REQUEST["IdEmpresaSolicitante"]);
$idCity = intval($_REQUEST["IdCiudad"]);
$hasClient = ($_REQUEST["Cliente"] == 'on') ? true : false;
$idTypeClient = intval($_REQUEST["IdTipoCliente"]);
$idProduct = intval($_REQUEST["IdProducto"]);
$ocurrenceDate = date_format(new DateTime($_REQUEST["FechaOcurrencia"]), 'Y-m-d H:i');
$idOrigin = intval($_REQUEST["IdOrigen"]);
$idTyping = intval($_REQUEST["IdTipificacion"]);
$comment = htmlspecialchars($_REQUEST["Comentario"]);
$idState = intval($_REQUEST["IdEstado"]);
//$idUserResponsable = $_REQUEST["UResponsable"];
$idBranchOffice = 17; //$_REQUEST["IdSucursalRadicacion"];
$userCreation = 1013660676; //$_REQUEST["UsuarioCreacion"];

$paramsRequest = "{"
        . "\r\n  \"IdEmpresa\": $idCompany,"
        . "\r\n  \"IdTipoPersona\": $idTypePerson,"
        . "\r\n  \"IdPersona\": $idPerson,"
        . "\r\n  \"IdEmpresaSolicitante\": $idApplicantCompany,"
        . "\r\n  \"IdCiudad\": $idCity,"
        . "\r\n  \"Cliente\": $hasClient,"
        . "\r\n  \"IdTipoCliente\": $idTypeClient,"
        . "\r\n  \"IdProducto\": $idProduct,"
        . "\r\n  \"FechaOcurrencia\": \"$ocurrenceDate\","
        . "\r\n  \"IdOrigen\": $idOrigin,"
//        . "\r\n  \"IdModulo\": $idModule,"
        . "\r\n  \"IdTipificacion\": $idTyping,"
        . "\r\n  \"Comentario\": \"$comment\","
        . "\r\n  \"IdEstado\": $idState,"
        . "\r\n  \"UResponsable\": null,"
        . "\r\n  \"IdSucursalRadicacion\": $idBranchOffice,"
        . "\r\n  \"UsuarioCreacion\": $idUser,"
        . "\r\n  \"FechaEstimadaRespuesta\": null,"
        . "\r\n  \"FechaRespuesta\": null,"
        . "\r\n  \"IdTipoRespuesta\": null,"
        . "\r\n  \"Usuario\": $idUser,"
        . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";

//echo $paramsRequest;
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Encabezado/PqrEncabezadoInsertar",
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
        "postman-token: 198e7113-d4e6-8458-610c-90a0d8f6e3e5"
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