<?php

include './conn.php';
$conn = coneccion();
$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
$offset = ($page - 1) * $rows;
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;
$result = array();
if ($id == 0) {
    $sql = ("select count(*) as todo from Pqr_Tipificacion where Padre=0");
    $rs = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($rs, SQLSRV_FETCH_ASSOC);
    $result["total"] = $row['todo'];

    $sql = ("select * from Pqr_Tipificacion where Padre = 0 ");
    $rs = sqlsrv_query($conn, $sql);
    $items = array();
    while ($row = sqlsrv_fetch_array($rs, SQLSRV_FETCH_ASSOC)) {
        $row['state'] = has_child($row['IdTipificacion']) ? 'closed' : 'open';
        array_push($items, $row);
    }
    $result["rows"] = $items;
} else {
    $sql = ("select  * from Pqr_Tipificacion where Padre=$id");
    $rs = sqlsrv_query($conn, $sql);
    while ($row = sqlsrv_fetch_array($rs, SQLSRV_FETCH_ASSOC)) {
        $row['state'] = has_child($row['IdTipificacion']) ? 'closed' : 'open';
        array_push($result, $row);
    }
}
echo json_encode($result);

//$json_string = json_encode($result);
//$file = 'clientes.json';
//file_put_contents($file, $json_string);

function has_child($id) {
    $serverName = "SERVER\SQL2014"; //serverName\instanceName
    $connectionInfo = array("Database" => "PQR_New", "UID" => "desarrollo", "PWD" => "desarrollo");
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $sql = ("select count(*) as string from Pqr_Tipificacion where Padre= $id");
    $rs = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($rs, SQLSRV_FETCH_ASSOC);
    return $row['string'] > 0 ? true : false;
}

?>