<?php

$config = parse_ini_file("../../config/config.ini");

$curl = curl_init();

curl_setopt_array($curl, array(
//    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config["server"] . "/api/Pqr_Encabezado/PqrEncabezadoConsultarTodo",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: 18132c51-38e5-a12e-b522-c61fa26f05f8"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {

    $array = json_decode($response, true);
    //    var_dump($array);
    $result = array();
    $row = array();
    foreach ($array as $key => $value) {
        $ocurrenceDate = (!is_null($value)) ? date_format(new DateTime($value["FechaOcurrencia"]), 'd-m-Y H:i') : "";
        $creationDate = (!is_null($value)) ? date_format(new DateTime($value["FechaCreacion"]), 'd-m-Y H:i') : "";
        $client = ($value["IdOrigen"]) ? "on" : "off";
        $valueClient = ($value["IdOrigen"]) ? "SI" : "NO";
        $responseExpectedDate = (!is_null($value)) ? date_format(new DateTime($value["FechaEstimadaRespuesta"]), 'd-m-Y H:i') : "";
        $responseDate = (!is_null($value)) ? date_format(new DateTime($value["FechaRespuesta"]), 'd-m-Y H:i') : "";
        $row = array(
            "IdPqrEncabezado" => $value["IdPqrEncabezado"],
            "IdEmpresa" => $value["IdEmpresa"],
            "nEmpresa" => $value["nEmpresa"],
            "IdTipoPersona" => $value["IdTipoPersona"],
            "nTipoPersona" => $value["nTipoPersona"],
            "IdPersona" => $value["IdPersona"],
            "nPersona" => $value["nPersona"],
            "IdEmpresaSolicitante" => $value["IdEmpresaSolicitante"],
            "nEmpresaSolicitante" => $value["nEmpresaSolicitante"],
            "IdCiudad" => $value["IdCiudad"],
            "nCiudad" => $value["nCiudad"],
            "Cliente" => $client,
            "ValorCliente" => $valueClient,
            "IdTipoCliente" => $value["IdTipoCliente"],
            "nTipoCliente" => $value["nTipoCliente"],
            "IdProducto" => $value["IdProducto"],
            "nProducto" => $value["nProducto"],
            "FechaOcurrencia" => $ocurrenceDate,
//            "IdModulo" => $value["IdModulo"],
//            "nModulo" => $value["nModulo"],            
            "IdOrigen" => $value["IdOrigen"],
            "nOrigen" => $value["nOrigen"],
            "IdTipificacion" => $value["IdTipificacion"],
            "nTipificacion" => $value["nTipificacion"],
            "Comentario" => $value["Comentario"],
            "IdEstado" => $value["IdEstado"],
            "nEstado" => $value["nEstado"],
            "UResponsable" => $value["UResponsable"],
            "nUResponsable" => $value["nUResponsable"],
            "IdSucursalRadicacion" => $value["IdSucursalRadicacion"],
            "nSucursalRadicacion" => $value["nSucursalRadicacion"],
            "FechaCreacion" => $creationDate,
            "UsuarioCreacion" => $value["UsuarioCreacion"],
            "nUsuarioCreacion" => $value["nUsuarioCreacion"],
            "FechaEstimadaRespuesta" => $responseExpectedDate,
            "FechaRespuesta" => $responseDate,
            "IdTipoRespuesta" => $value["IdTipoRespuesta"],
            "nTipoRespuesta" => $value["nTipoRespuesta"]
        );
        array_push($result, $row);
    }
    echo json_encode($result, true);
//    echo $response;
}