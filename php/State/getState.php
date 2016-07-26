<?php

//ini_set("display_errors", "on");

$config = parse_ini_file("../../config/config.ini");

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Estados/EstadosConsultarTodo",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: e80e262e-7e58-8c93-3876-e58f27effd22"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
//    echo $response;
    $array = json_decode($response, true);
    $result = array();
    $row = array();
    foreach ($array as $key => $value) {
        $valueRadication = ($value["Radicacion"]) ? "on" : "off";
        $textRadication = ($value["Radicacion"]) ? "SI" : "NO";
        $valueTyping = ($value["Tipificacion"]) ? "on" : "off";
        $textTyping = ($value["Tipificacion"]) ? "SI" : "NO";
        $valueState = ($value["Activo"]) ? "on" : "off";
        $textState = ($value["Activo"]) ? "ACTIVO" : "INACTIVO";
        $row = array(
            "IdEstado" => $value["IdEstado"],
            "Nombre" => $value["Nombre"],
            "Radicacion" => $valueRadication,
            "valorRadicacion" => $textRadication,
            "Tipificacion" => $valueTyping,
            "valorTipificacion" => $textTyping,
            "Activo" => $valueState,
            "valorActivo" => $textState
        );
        array_push($result, $row);
    }
    echo json_encode($result, true);
}