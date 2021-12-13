<?php
session_start();
include_once ("files/includes/classloader.php");

$request = $_SERVER['REQUEST_URI'];
$url = parse_url($request);
$urlpaths = explode("/", $url["path"]);

switch ($urlpaths[1]) {
    case '':
    case '/':
    case "stellingen":
        require __DIR__ . '/files/views/stellingen.php';
        break;
    case "partijen":
        require __DIR__ . '/files/views/partijen.php';
        break;
    case 'login':
        require __DIR__ . '/files/views/login.php';
        break;
    case 'logout':
        require __DIR__ . '/files/views/logout.php';
        break;
    default:
        header('HTTP/1.0 404 Not Found');
        require __DIR__ . '/files/views/404.php';
        break;
}