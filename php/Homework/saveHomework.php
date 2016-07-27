<?php

require_once '../functions.php';
ini_set("display_errors", "on");
session_start();
$config = parse_ini_file('../../config/config.ini');
$classFunction = new functions(); // Clase funciones
$idUser = intval($_SESSION["id-user"]);
$ipUser = htmlspecialchars($classFunction->getRealIp());
$nameModule = htmlspecialchars($_REQUEST["Nombre"]);
$idResponsableHomework = htmlspecialchars($_REQUEST["IdResponsableTarea"]);
$dateEndHomework = date_format(new DateTime($_REQUEST["FechaFinEstimadoTarea"]), 'Y-m-d');

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_PORT => "8002",
  CURLOPT_URL => $config['server'] ."/api/Pqr_Tareas/PqrTareasInsertar",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\r\n  \"Nombre\": \"$nameModule\",\r\n  \"IdResponsableTarea\": $idResponsableHomework,\r\n  \"FechaInicioTarea\": null,\r\n  \"FechaFinEstimadoTarea\": \"$dateEndHomework\",\r\n  \"FechaFinTarea\": null,\r\n  \"Usuario\": $idUser,\r\n  \"DirIp\": \"$ipUser\"\r\n}",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/json",
    "postman-token: d75a9230-099d-bf79-3d13-07ddb17841bf"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
//    echo $response;
    $result = (is_numeric($response)) ? "Tarea ingresada con exito" : "Ha ocurrido un error, por favor intente nuevamente. $response";
    echo json_encode($result);
}