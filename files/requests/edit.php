<?php
session_start();
include_once "../includes/classloader.php";

if (isset($_POST['edit'])) {
    $Account = new Account();
    switch ($_POST['edit']) {
        case "party":
            $Partij = new Partij();
            echo $Partij->getSingle($_POST['eid']);
            break;
        case "question":
            $Stelling = new Stelling();
            echo $Stelling->getSingle($_POST['eid']);
            break;
    }
}

if (isset($_POST['update'])) {
    $Account = new Account();
    switch ($_POST['update']) {
        case "party":
            $id = htmlspecialchars($_POST['uid']);
            $name = htmlspecialchars($_POST['name']);
            $short = htmlspecialchars($_POST['short']);

            $Partij = new Partij();
            return $Partij->updatePartij($id, $name, $short);
        case "question":
            $Stelling = new Stelling();
            return $Stelling->updateStelling();
    }
}