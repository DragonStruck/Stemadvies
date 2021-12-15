<?php
include_once "./classloader.php";
$Stelling = new Stelling();
$list = $Stelling->getList();
$html = "";

for ($i = 0; $i < sizeof($list); $i++) {
    $html .= "<div class='table-entry'>";
    $html .= "<div>";
    $html .= $list[$i]['ID'];
    $html .= "</div>";
    $html .= "<div>";
    $html .= $list[$i]['question'];
    $html .= "</div>";
    $html .= "<div>";
    $html .= "<button class='table-button editTest'>Edit</button>";
    $html .= "<button class='table-button deleteTest'>Delete</button>";
    $html .= "</div>";
    $html .= "</div>";
}

echo $html;