<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require ('../classes/db.php');
require ('../classes/Stelling.php');

$database = new Dbconfig();
$db = $database->getConnection();

$stelling = new Stelling($db);

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
