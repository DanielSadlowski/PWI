<?php
session_start();

if (isset($_POST['datastart'])) {
    require_once "connect.php";
    try {
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if ($polaczenie->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            $datastart = $_POST['datastart'];
            $datakoniec = $_POST['datakoniec'];
            $ID = $_POST['ID'];
            $IDuzytkownika = $_SESSION['id'];
            //if (isset($_SESSION['datastart']) && isset($_SESSION['datakoniec'])) {
                if ($polaczenie->query("INSERT INTO wynajem VALUES ('$ID', '$IDuzytkownika', '$datastart','$datakoniec')")) {
                    header('Location: Page.php');   //specjalna strona do witania??
                } else {
                    throw new Exception($polaczenie->error);
                }
           // }
            $polaczenie->close();
        }
    } catch (Exception $e) {
        //echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
        //echo '<br />Informacja developerska: ' . $e;
        echo '<br />Przepraszamy, auto jest już zarezerwowane :(';
    }
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>
        Wypożyczamy
    </title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
</head>

<body>

    <div id="wrapper">
        <a href="Page.php"><img src="LogoSimplyRent.png" alt="Info"></a>
    </div>
    <nav>
        <a class="menu active" href="Rent.html">Wypożycz auto</a>
        <a class="menu" href="Car_fleet.php">Nasze auta</a>
        <a class="menu" href="Rent_conditions.php">Warunki wynajmu</a>
        <a class="menu" href="Contact.php">Kontakt</a>
    </nav>
    <div class="container container-custom">
        <form action="FormularzWynajmu.php" method="post" class="check">
            <br />
            <h2 class="text-center"><b style="color: darkred;">Wypożycz auto!</b></h2>
            <br />
            <div class="row row-custom">
                <div class="form-group form-text-custom col-md-3">
                    <label for="inputState">Data rozpoczęcia wynajmu</label>
                    <select id="inputState" class="form-control" name="datastart" required>
                        <option>2019-06-19</option>
                        <option>2019-06-20</option>
                        <option>2019-06-21</option>
                    </select>
                </div>
                <div class="form-group form-text-custom col-md-3">
                    <label for="inputState">Data zakończenia wynajmu</label>
                    <select id="inputState" class="form-control" name="datakoniec" required>
                        <option>2019-06-20</option>
                        <option>2019-06-21</option>
                        <option>2019-06-22</option>
                    </select>
                </div>

                <input type="hidden" value="1" name="ID">

                <div class="row row-custom">
                    <div class="form-group text-center ml-auto mr-3">
                        <button type="submit" class="btn btn-login btn-custom text-center" name="register">Wypożycz auto
                        </button>
                    </div>
                </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">
        function isNumber(event) {
            var keycode = event.keyCode;
            if (keycode >= 48 && keycode <= 57)
                return true;
            return false;
        }

        function maxLengthCheck(object) {
            if (object.value.length > object.max.length)
                object.value = object.value.slice(0, object.max.length);
        }
    </script>

</body>

</html>