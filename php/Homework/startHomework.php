<?php
require_once '../functions.php';
ini_set("display_errors", "on");
session_start();
$config = parse_ini_file('../../config/config.ini');
$classFunction = new functions(); // Clase funciones
$idUser = $_SESSION["id-user"];
$ipUser = $classFunction->getRealIp();
$idHomework = intval($_REQUEST["id"]);
$nameHomework = htmlspecialchars($_REQUEST["nombre"]);
$idResponsableTarea = htmlspecialchars($_REQUEST["idresponsable"]);
$FechaFinEstimadoTarea = htmlspecialchars($_REQUEST["fechaestimado"]);
$FechaFinEstimadoTarea = substr($FechaFinEstimadoTarea,0,10);
$dateStartHomework = date("Y-m-d");
 //valido si ya se a iniciado la tarea
if (($_POST["FechaInicioTarea"]!="") and ($_POST["FechaInicioTarea"]!="false")) {
    $result ="Error ya habia iniciado la tarea";
    echo json_encode($result);
}else {     //valido no se haya iniciado la tarea

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_PORT => "8002",
    CURLOPT_URL => $config['server'] . "/api/Pqr_Tareas/PqrTareasActualizar",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "{\r\n  \"IdTarea\": $idHomework,\r\n  \"Nombre\": \"$nameHomework\",\r\n  \"IdResponsableTarea\": $idResponsableTarea,\r\n  \"FechaInicioTarea\": \"$dateStartHomework\",\r\n  \"FechaFinEstimadoTarea\": \"$FechaFinEstimadoTarea\",\r\n  \"FechaFinTarea\": null,\r\n  \"Usuario\": $idUser,\r\n  \"DirIp\": \"$ipUser\"\r\n}",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: application/json",
        "postman-token: cbb87fcf-3afe-662c-6044-dab108438ec9"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    //echo $response;
    $result = (is_numeric($response)) ? "Tarea iniciada" : "Ha ocurrido un error, por favor intente nuevamente. $response";
    echo json_encode($result);
    
}

} 

