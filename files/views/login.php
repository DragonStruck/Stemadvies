<?php
$_SESSION['login'] = true;
if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
    header("Location: /");
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/files/css/main.css">
    <link rel="stylesheet" href="/files/css/login.css">

    <title>Login - Stemadvies</title>
</head>
<body>
<main class="main">
    <div class="login-form-container">
        <form action="/files/requests/login.php" class="login-form" method="post">
            <div class="logo">
                <img src="/files/images/stemadvies.svg" alt="Stemadvies logo">
            </div>
            <div class="form-inputs">
                <div class="input-container">
                    <label for="username">Gebruikersnaam</label>
                    <input class="input" id="username" name="username" type="text" <?php if (isset($_SESSION['username'])) { echo "value='".$_SESSION['username']."'"; } ?> >
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
