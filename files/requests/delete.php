<?php
session_start();
include_once "../includes/classloader.php";

if (isset($_POST['delete'])) {
    $Account = new Account();
    switch ($_POST['delete']) {
        case "party":
            $Partij = new Partij();
            if ($Partij->deletePartij($_POST['did'])) {
                echo "true";
            } else {
                echo "false";
            }
            break;
        case "question":
            $Stelling = new Stelling();
            if ($Stelling->deleteQuestion($_POST['did'])) {
                echo "true";
            } else {
                echo "false";
            }
            break;
    }
}