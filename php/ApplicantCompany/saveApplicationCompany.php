<?php

$config = parse_ini_file("../../config/config.ini");

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_EmpresasSolicitantes/EmpresasSolicitantesInsertar",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n  \"IdEmpresa\": 1,\r\n  \"NIT\": \"sample string 1\",\r\n  \"Nombre\": \"sample string 2\",\r\n  \"Direccion\": \"sample string 3\",\r\n  \"Telefono\": \"sample string 4\",\r\n  \"Email\": \"sample string 5\",\r\n  \"Contacto\": \"sample string 6\",\r\n  \"CargoContacto\": \"sample string 7\",\r\n  \"Usuario\": 8,\r\n  \"DirIp\": \"sample string 9\"\r\n}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: 8610a896-e1ca-69f3-1c9c-c1ec537d02e1"
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