<?php
session_start();
include_once "../includes/classloader.php";

if (isset($_POST['edit'])) {
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

if (isset($_POST['stelling-partijen'])) {
    $id = htmlspecialchars($_POST['stelling-partijen']);

    $Stelling = new Stelling();
    echo $Stelling->getParties($id);
}

if (isset($_POST['update'])) {
    switch ($_POST['update']) {
        case "party":
            $id = htmlspecialchars($_POST['uid']);
            $name = htmlspecialchars($_POST['name']);
            $short = htmlspecialchars($_POST['short']);

            $Partij = new Partij();
            return $Partij->updatePartij($id, $name, $short);
        case "question":
            $id = htmlspecialchars($_POST['eid']);
            $subject = htmlspecialchars($_POST['subject']);
            $question = htmlspecialchars($_POST['question']);
            $parties = $_POST['parties'];

            $Stelling = new Stelling();
            return $Stelling->updateStelling($id, $subject, $question, $parties);
    }
}