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
    $html .= "<button data-type='stelling' data-entry='".$list[$i]['ID']."' class='table-button editTest'>Edit</button>";
    $html .= "<button data-type='stelling' data-entry='".$list[$i]['ID']."' class='table-button deleteTest'>Delete</button>";
    $html .= "</div>";
    $html .= "</div>";
}

echo $html;