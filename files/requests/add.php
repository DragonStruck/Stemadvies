<?php
session_start();
include_once "../includes/classloader.php";

if (isset($_POST['add'])) {
    $Account = new Account();
    switch ($_POST['add']) {
        case "party":
            $name = htmlspecialchars($_POST['name']);
            $short = htmlspecialchars($_POST['short']);

            $Partij = new Partij();
            return $Partij->addPartij($name, $short);
        case "question":
            $Stelling = new Stelling();
            return $Stelling->updateStelling();
    }
}