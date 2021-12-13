<?php
session_start();
include_once "../includes/classloader.php";

if (isset($_POST['login'])) {
    $Account = new Account();
    switch ($Account->Login(htmlspecialchars($_POST['username']), $_POST['password'])) {
        case true:
            header('location: /home');
            break;
        case false:
            header('location: /login');
            break;
    }
}