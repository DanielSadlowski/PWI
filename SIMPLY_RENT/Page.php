<?php

session_start();

?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>
        Simply Rent - Główna
    </title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i&amp;subset=latin-ext" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>

<body>


    - Strona główna - <a href="Login_user.php">Zaloguj się!</a>
    <?php
    if (isset($_SESSION['zalogowany'])) {
        echo  '<a href="Logout_user.php">Wyloguj się!</a>';
    }
    if(isset($_SESSION['zalogowany']) && isset($_SESSION['admin']) && $_SESSION['admin'] == true)
    {
        echo  '<a href="AdminShowData.php">Pokaż bazę</a>';
        echo  '<a href="Logout_admin.php">Wyloguj się Admin!</a>';
    }
    ?>

    <div id="wrapper">
        <img src="LogoSimplyRent.png" alt="Info">
    </div>

    <nav>
        <a class="menu active" href="Wynajem.php">Wypożycz auto</a>
        <a class="menu" href="Car_fleet.php">Nasze auta</a>
        <a class="menu" href="Rent_conditions.php">Warunki wynajmu</a>
        <a class="menu" href="Contact.php">Kontakt</a>
    </nav>

    <div id="showcase">
        <img src="PanelGrafika.png" alt="showcase">
        <img src="Std1pop.png" alt="std1">
        <img src="Std2pop.png" alt="std2">
    </div>
    - Strona główna - <a href="PanelAdmina.php">Panel administracji</a>
</body>


</html>