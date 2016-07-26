<?php

//ini_set("display_errors", "on");

$config = parse_ini_file("../../config/config.ini");

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Productos/ProductosConsultarTodo",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: a33fc578-29bf-1f61-d4a4-2fa6d5d4bf61"
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
        $valueState = ($value["Activo"] && is_bool($value["Activo"])) ? "SI" : "NO";
        $state = ($value["Activo"] && is_bool($value["Activo"])) ? "on" : "off";
        $row = array(
            "IdProducto" => $value["IdProducto"],
            "Nombre" => $value["Nombre"],
            "CodigoTercero" => $value["CodigoTercero"],
            "Activo" => $state,
            "ValorActivo" => $valueState
        );
        array_push($result, $row);
    }
    echo json_encode($result, true);
}