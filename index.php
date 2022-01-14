<?php
session_start();
include_once ("files/includes/classloader.php");

$request = $_SERVER['REQUEST_URI'];
$url = parse_url($request);
$urlpaths = explode("/", $url["path"]);

switch ($urlpaths[1]) {
    case '':
    case '/':
    case "home":
        require __DIR__ . '/files/views/home.php';
        break;
    case 'login':
        require __DIR__ . '/files/views/login.php';
        break;
    case 'logout':
        require __DIR__ . '/files/views/logout.php';
        break;

    case 'api':
        if ($urlpaths[2]) {
            switch ($urlpaths[2]) {
                case 'read_stellingen':
                    require __DIR__ . '/files/api/read_stellingen.php';
                    break;
                case 'read_partijen':
                    require __DIR__ . '/files/api/read_partijen.php';
                    break;
            }
        }
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        require __DIR__ . '/files/views/404.php';
        break;
}