<?php

session_start();

if ((!isset($_POST['email'])) || (!isset($_POST['password']))) {
    header('Location: Page.php');
    exit();
}

require_once "connect.php";

try {
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $login = $_POST['email'];
        $haslo = $_POST['password'];


        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
        if ($rezultat = @$polaczenie->query(
            sprintf(
                "SELECT * FROM `klienci` WHERE `Adres_email`='%s'",
                mysqli_real_escape_string($polaczenie, $login)
            )
        )) {
            $ilu_userow = $rezultat->num_rows;
            if ($ilu_userow > 0) {
                $wiersz = $rezultat->fetch_assoc();
                if (password_verify($haslo, $wiersz['Haslo'])) {
                    $_SESSION['zalogowany'] = true;
                    $_SESSION['id'] = $wiersz['ID'];
                    $_SESSION['email'] = $wiersz['Adres_email'];
                    $_SESSION['imie'] = $wiersz['Imie'];
                    $_SESSION['nazwisko'] = $wiersz['Nazwisko'];

                    unset($_SESSION['blad']);
                    $rezultat->free_result();
                    header('Location: Page.php');
                } else {
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: Login_user.php');
                }
            } else {
                $_SESSION['blad'] = '<span style="color:blue">Nieprawidłowy login lub hasło!</span>';
                header('Location: Login_user.php');
            }
        }
        $polaczenie->close();
    }
} catch (Exception $e) {
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
    echo '<br />Informacja developerska: ' . $e;
}








