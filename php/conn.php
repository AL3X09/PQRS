<?php

function coneccion() {
    $config = parse_ini_file("Config.ini");
    $serverName = $config["instance"]; //"SERVER\SQL2014"; //serverName\instanceName
    $connectionInfo = array("Database" => $config["database"], "UID" => $config["user"], "PWD" => $config["password"]);
//    var_dump($config);
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    return $conn;
}

//
//$service_url = 'http://server:8002/api/Pqr_Departamentos/DepartamentosConsultarTodo';
//$curl = curl_init($service_url);
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//$curl_response = curl_exec($curl);
//if ($curl_response === false) {
//    $info = curl_getinfo($curl);
//    curl_close($curl);
//    die('error occured during curl exec. Additioanl info: ' . var_export($info));
//}
//echo $curl_response;
//curl_close($curl);
?>