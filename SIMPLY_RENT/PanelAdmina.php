<?php

session_start();

if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany'] == true)) {
    header('Location: Page.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <title>
        ADMIN
    </title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i&amp;subset=latin-ext" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>

<body>
    
    <div id="wrapper">
        <a href="Page.php"><img src="LogoSimplyRent.png" alt="Info"></a>
    </div>
    <nav>
        <a class="menu active" href="Wynajem.php">Wypożycz auto</a>
        <a class="menu" href="Car_fleet.php">Nasze auta</a>
        <a class="menu" href="Rent_conditions.php">Warunki wynajmu</a>
        <a class="menu" href="Contact.php">Kontakt</a>
    </nav>
    <div id="logowanie">
        <form action="Login_admin.php" method="post">
            <h2 class="text-center"><b style="color: darkred;">Zaloguj się!</b></h2>
            <br />

            <label for="username">Nazwa użytkownika:</label>
            <input type="email" id="email" name="email"><br />
            <label for="password">Hasło:</label>

            <input type="password" id="password" name="password">
            <input type="submit" value="Login"><br />
            
            <?php
                if(isset($_SESSION['blad']))
                {
                    echo $_SESSION['blad'];
                }
            ?>
        </form>
    </div>
</body>

</html>