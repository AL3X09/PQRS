<?php

require_once './functions.php';

if (isset($_REQUEST["id"]) && !empty($_REQUEST["id"])) {
    ini_set("display_errors", "on");
    session_start();

    $config = parse_ini_file('Config.ini');
    $functions = new functions();

    $ipUser = $functions->getRealIp();
    $idUser = $_SESSION["id-user"];

    $idCompany = $_REQUEST["id"];
    $nameCompany = $_REQUEST["Nombre"];

    $paramsRequest = "{\r\n  \"IdEmpresa\": $idCompany,"
            . "\r\n  \"Nombre\": \"$nameCompany\","
            . "\r\n  \"Usuario\": $idUser,"
            . "\r\n  \"DirIp\": \"$ipUser\"\r\n}";
//echo $paramsRequest;
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_PORT => "8002",
        CURLOPT_URL => $config["server"] . "/api/Pqr_Empresas/EmpresasActualizar",
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
        $result = (is_numeric($response)) ? "Empresa Actualizada con exito" : "Ha ocurrido un error, por favor intente nuevamente. $response";
        echo json_encode($result);
    }
} else {
    echo json_encode("No se ha seleccionado un registro.");
}