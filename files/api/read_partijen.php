<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF- 8");

require ('../classes/db.php');
require ('../classes/Partij.php');

$database = new Dbconfig();
$db = $database->getConnection();

$partij = new Partij($db);

$stmt = $partij->getList();

if ($stmt != "") {
    http_response_code(200);
    echo json_encode($stmt);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Not found")
    );
}
