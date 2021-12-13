<?php
if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
    header("Location: /login");
}
?>

<!doctype html>
<html lang="en">
<head>

    <?php include "files/includes/head.php";?>

    <link rel="stylesheet" href="/files/css/home.css">

    <title>Stellingen - Stemadvies</title>
</head>
<body>
    <div class="layout">
        <section class="layout-section shadow">
            <?php include "files/includes/menu.php";?>
        </section>
        <section class="layout-section shadow">

        </section>
    </div>
</body>
</html>
