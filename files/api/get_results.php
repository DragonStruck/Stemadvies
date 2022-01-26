<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require ('../classes/db.php');
require ('../classes/Answer.php');
require ('../classes/Partij.php');

$database = new Dbconfig();
$db = $database->getConnection();

$answer = new Answer($db);
$partij = new Partij($db);

$data = json_decode($_GET['data'], true);
$dataLength = count($data);
$skipped = 0;
$partijen = $partij->getList();

$percentagelist = [];
$partyIDlist = $answer->getAgreeList();

for($x = 1; $x <= $dataLength; $x++) {
    $list = [];
    $questionId = $x;
    $realquestionId = $partyIDlist[$questionId]["questionID"];
    $option = $data["$realquestionId"];
//    var_dump($option);
    foreach ($partijen as $key => $value) {

        if(!array_key_exists("points",$partijen[$key])) {
            $partijen[$key]["points"] = 0;
        }
        if ($option == 1) {
            if($answer->checkAgree($realquestionId,$value["ID"])->fetchColumn(0) != false) {

                $partijen[$key]["points"] += 1;
            }
        }


    }
    if ($option == 3) {
        $skipped = $skipped + 1;
    }
}


foreach ($partijen as $key => $value) {

    if ($skipped == $dataLength) {
        $percentage = 0;
    } else {
        $percentage = $value["points"] / ($dataLength - $skipped) * 100;
    }

    $percentagelist[$key]["party"] = $value["short"];
    $percentagelist[$key]["percentage"] = round($percentage);
}

if ($percentagelist != "") {
    http_response_code(200);
    echo json_encode($percentagelist);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Not found")
    );
}