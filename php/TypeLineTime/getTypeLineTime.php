<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8002",
  CURLOPT_URL => "http://server:8002/api/Pqr_TipoLineaTiempo/PqrTipoLineaTiempoConsultarTodo",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "postman-token: 8dbd7ece-b0e6-d807-1a2c-d54934861d8b"
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