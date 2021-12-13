<?php


?>
<!doctype html>
<html lang="en">
<head>

    <?php include "files/includes/head.php";?>

    <link rel="stylesheet" href="/files/css/login.css">

    <title>Login | Stemadvies</title>
</head>
<body>
<main class="main">
    <div class="login-form-container">
        <form action="/files/requests/login.php" class="login-form">
            <div class="logo">
                <img src="/files/images/stemadvies.svg" alt="logo">
            </div>
            <div class="form-inputs">
                <div class="input-container">
                    <label for="username">Gebruikersnaam</label>
                    <input class="input" id="username" name="username" type="text">
                </div>
                <div class="input-container">
                    <label for="password">Wachtwoord</label>
                    <input class="input" id="password" name="password" type="password">
                </div>
            </div>
            <div class="submit-container">
                <input value="Inloggen" class="submit" id="submit-login" name="login" type="submit">
            </div>
        </form>
    </div>
</main>
</body>
</html>
