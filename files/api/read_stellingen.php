<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF- 8");

include_once 'files/classes/Connection.php';
include_once 'files/classes/Stelling.php';

$database = new Connection();
$db = $database->connectToDatabase();

$stelling = new Stelling();

$stmt = $stelling->getList();

if ($stelling != "") {
    http_response_code(200);
    echo json_encode($stmt);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Not found")
    );
}
