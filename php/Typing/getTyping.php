<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();

$config = parse_ini_file('../../config/config.ini'); // Archivo de configuracion 

$functions = new functions();


$idTyping = (isset($_REQUEST["IdTipificacion"])) ? $_REQUEST["IdTipificacion"] : "null";
$name = (isset($_REQUEST["Nombre"])) ? htmlspecialchars($_REQUEST["Nombre"]) : "null";
$status = (isset($_REQUEST["Activo"])) ? $_REQUEST["Activo"] : "null";
$dependece = (!isset($_POST["id"]) || empty($_POST["id"])) ? 0 : intval($_POST["id"]);
$codeSuper = (isset($_REQUEST["CodigoSuper"])) ? htmlspecialchars($_REQUEST["CodigoSuper"]) : "null";
$timeResponse = (isset($_REQUEST["TiempoEstimadoRespuesta"])) ? $_REQUEST["TiempoEstimadoRespuesta"] : "null";
$idCompany = (isset($_REQUEST["IdEmpresa"])) ? intval($_REQUEST["IdEmpresa"]) : "null";


$ipUser = $functions->getRealIp();
$idUser = intval($_SESSION["id-user"]);
$array = peticion($idTyping, $name, $status, $dependece, $codeSuper, $timeResponse, $idUser, $ipUser, $idCompany);


/*
 * function peticion()
 * 
 * Realiza una peticion para consultar las tipificaciones asociadas a unos filtros ingresados
 * 
 * PARAMETROS
 * 
 *  $idTyping       --> Filtro de tipificacion
 *  $name           --> Filtro por el nombre
 *  $status         --> Filtro por estado
 *  $dependece      --> Filtro por dependecia(Padre)
 *  $codeSuper      --> Filtro por codigoSuper
 *  $timeResponse   --> Filtro por tiempo de respuesta
 *  $idCompany      --> Filtro por empresa
 *  $idUser         --> id de la session
 *  $ipUser         --> ip del que ejecuta la accion
 * 
 * RETORNO 
 *  json_encode($response,true); --> Array de la respuesta de la peticion a la API
 * 
 * Bryan Muñoz
 * 
 */

function peticion($idTyping, $name, $status, $dependece, $codeSuper, $timeResponse, $idUser, $ipUser, $idCompany) {
    $paramsRequest = "{\r\n  \"IdTipificacion\": " . $idTyping . "," .
            "\r\n  \"Nombre\":$name," .
            "\r\n  \"Activo\":  $status ," .
            "\r\n  \"Padre\":  $dependece  ," .
            "\r\n  \"CodigoSuper\" : $codeSuper," .
            "\r\n  \"TiempoEstimadoRespuesta\": $timeResponse ," .
            "\r\n  \"IdEmpresa\": $idCompany ," .
            "\r\n  \"Usuario\": " . $idUser . "," .
            "\r\n  \"DirIp\": \"" . $ipUser . "\" \r\n}";
//    echo $paramsRequest;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8002",
        CURLOPT_URL => "http://server:8002/api/Pqr_Tipificacion/PqrTipificacionConsultarFiltros",
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
            "postman-token: bc938f3a-0fea-53bc-b427-78f64b359661"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    if ($err) {
        return "cURL Error #:" . $err;
    } else {
        return json_decode($response, true);
    }
}

/*
 * Valida si el la peticion es un arreglo
 * 
 */
if (!is_array($array)) {
    var_dump($array);
} else {
    $result = array();
    $row;
    foreach ($array as $key => $value) {
        $hasCildren = sizeof(peticion("null", "null", "null", $value["IdTipificacion"], "null", "null", "null", "null", $idCompany));
        $total = ($hasCildren > 0) ? "     <b>(" . $hasCildren . ")</b>" : "";
        $row = array(
            "IdTipificacion" => $value["IdTipificacion"],
            "id" => $value["IdTipificacion"],
            "Nombre" => $value["Nombre"],
            "text" => $value["Nombre"] . $total,
            "Activo" => $value["Activo"],
            "Padre" => $value["Padre"],
            "CodigoSuper" => $value["CodigoSuper"],
            "IdModulo" => $value["IdModulo"],
            "IdEmpresa" => $value["IdEmpresa"],
            "TiempoEstimadoRespuesta" => $value["TiempoEstimadoRespuesta"],
            "state" => ($hasCildren > 0) ? "closed" : "open",
            "serviceAgreements" => ($hasCildren > 0) ? "false" : "true",
            "total" => $hasCildren,
            "IdEmpresa" => $value["IdTipificacion"]
        );
        array_push($result, $row);
    }
    echo json_encode($result, true);
}