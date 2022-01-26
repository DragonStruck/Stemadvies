<?php
if (!isset($_SESSION['logedin']) || $_SESSION['logedin'] != true) {
    header("Location: /login");
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/files/css/main.css">
    <link rel="stylesheet" href="/files/css/home.css">

    <title>Home - Stemadvies</title>
</head>
<body>
<div class="layout">
    <section class="layout-section shadow">
        <nav class="nav">
            <div class="logo">
                <img src="/files/images/stemadvies.svg" alt="Stemadvies logo">
                <hr>
            </div>
            <div class="a-container">
                <button id="button-stellingen" class="menu-button stellingen">Stellingen</button>
                <button id="button-partijen" class="menu-button partijen">Partijen</button>
            </div>
            <div class="logout-container">
                <hr>
                <a href="/logout">
                    <button class="logout-button">Uitloggen</button>
                </a>
            </div>
        </nav>
    </section>
    <section id="content-container" class="layout-section shadow"></section>
</div>

<script src="/files/js/home.js"></script>
</body>
</html>

