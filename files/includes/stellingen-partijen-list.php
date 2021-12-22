<?php
include_once "./classloader.php";
$Partij = new Partij();
$list = $Partij->getList();
$html = "";

for ($i = 0; $i < sizeof($list); $i++) {
    $html .= "<div class='partij-keuze'>";
    $html .= "<label class='partij-keuze-label' for='rad".$i."'>".$list[$i]['short'].":</label>";
    $html .= "<input value='".$list[$i]['ID']."' class='partij-keuze-checkbox' type='checkbox' id='rad".$i."' name='parties[]'>";
    $html .= "</div>";
}

echo $html;