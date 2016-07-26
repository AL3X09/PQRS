<?php

$config = parse_ini_file("../../config/config.ini");

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Detalle/PqrDetalleInsertar",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n  \"IdPqrDetalle\": 1,\r\n  \"IdPqrEncabezado\": 1,\r\n  \"IdTipificacion2\": 1,\r\n  \"IdEstado\": 1,\r\n  \"Escalado\": true,\r\n  \"UResponsable\": 1,\r\n  \"FechaEstimadaRespuesta\": \"2016-07-22T14:44:20.1324643-05:00\",\r\n  \"FechaRespuesta\": \"2016-07-22T14:44:20.1324643-05:00\",\r\n  \"IdTipoRespuesta\": 1\r\n}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 4368c49d-036a-20f8-c970-0fd081075916"
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