<?php
include_once "classloader.php";

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
    $html .= "<button data-type='question' data-entry='".$list[$i]['ID']."' class='table-button editEntry'>Edit</button>";
    $html .= "<button data-type='question' data-entry='".$list[$i]['ID']."' class='table-button deleteEntry'>Delete</button>";
    $html .= "</div>";
    $html .= "</div>";
}

echo $html;