<?php
session_start();

if(isset($_POST['email']))
{
    $wszystko_OK = true;
    
    $imie = $_POST['imie'];
    
    if (ctype_alpha($imie)==false)
	{
		$wszystko_OK=false;
        $_SESSION['e_imie']="Imie składa się tylko z liter";
        //header('Location: Rejestracja.php');
    }
    
    
    $nazwisko = $_POST['nazwisko'];
    if (ctype_alpha($nazwisko)==false)
	{
		$wszystko_OK=false;
        $_SESSION['e_nazwisko']="Nazwisko składa się tylko z liter";
        //header('Location: Rejestracja.php');
	}

    $nr_tel = $_POST['nr_tel'];
    $haslo = $_POST['haslo'];
    $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
    $haslo2 = $_POST['haslo2'];
    if ((strlen($haslo)<3) || (strlen($haslo2)>20))
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Hasło musi posiadać od 3 do 20 znaków!";
    }
    
    if ($haslo!=$haslo2)
    {
        $wszystko_OK=false;
        $_SESSION['e_haslo']="Podane hasła nie są identyczne!";
    }

    $email = $_POST['email'];


    
    require_once "connect.php";
try 
{
	$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
	if ($polaczenie->connect_errno!=0)
	{
		throw new Exception(mysqli_connect_errno());
	}
	else
	{
        //Czy email już istnieje?
		$rezultat = $polaczenie->query("SELECT Adres_email FROM klienci WHERE Adres_email='$email'");
	
		if (!$rezultat) throw new Exception($polaczenie->error);
				
		$ile_takich_maili = $rezultat->num_rows;
	    if($ile_takich_maili>0)
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail!";
		}		
				
		if ($wszystko_OK==true)
		{
			//Hurra, wszystkie testy zaliczone, dodajemy gracza do bazy
					
			if ($polaczenie->query("INSERT INTO klienci VALUES (NULL, '$imie', '$nazwisko', '$email', '$nr_tel','$haslo_hash')"))
			{
				$_SESSION['udanarejestracja']=true;
				header('Location: Page.php');   //specjalna strona do witania??
			}
			else
			{
			    throw new Exception($polaczenie->error);
			}
					
        } 
        else {
            echo 'nie jest ok xd';
        }
		$polaczenie->close();
    }
}
catch(Exception $e)
{
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
	echo '<br />Informacja developerska: '.$e;
}
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <title>
        Rejestracja
    </title>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
    <form action="Rejestracja.php" method="post" class="check">
        <br/>
        <h2 class="text-center"><b style="color: darkred;">Zarejestruj się!</b></h2>
        <br/>
        <div class="row row-custom">
            <div class="form-group form-text-custom col-md-4">
                <label for="inputFirstName">Imię</label>
                <input type="text" class="form-control" id="inputFirstName" name="imie" placeholder="np. Adam" required>
                <?php
                if(isset($_SESSION['e_imie']))
                {
                    echo $_SESSION['e_imie'];
                    unset($_SESSION['e_imie']);
                }
                ?>
            </div>
            <div class="form-group form-text-custom col-md-4">
                <label for="inputLastName">Nazwisko</label>
                <input type="text" class="form-control" id="inputLastName" name="nazwisko" placeholder="np. Kowalski"
                       required>
                       <?php
                if(isset($_SESSION['e_nazwisko']))
                {
                    echo $_SESSION['e_nazwisko'];
                    unset($_SESSION['e_nazwisko']);
                }
                ?>
            </div>
            <div class="form-group form-text-custom col-md-4">
                <label for="inputPhoneNr">Numer telefonu</label>
                <input type="text" class="form-control" id="inputPhoneNr" name="nr_tel"
                       onkeypress="return isNumber(event)" minlength="9" maxlength="9" step="1"
                       placeholder="np. 746839281" title="Wpisz tylko liczby!" required>
            </div>
        </div>
        
        <div class="form-row form-text-custom form-custom">
            <div class="form-group col-md-3">
                <label for="inputCity">Email</label>
                <input type="email" class="form-control" id="inputCity" name="email"
                       placeholder="np. a.kowalski@kowal.pl" required>
                       <?php
                if(isset($_SESSION['e_email']))
                {
                    echo $_SESSION['e_email'];
                    unset($_SESSION['e_email']);
                }
                ?>
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Hasło</label>
                <input type="password" class="form-control" id="inputCity" name="haslo"
                       placeholder="od 3 do 20 znaków" required>
            </div>
            <div class="form-group col-md-3">
                <label for="inputCity">Powtórz hasło</label>
                <input type="password" class="form-control" id="inputCity" name="haslo2"
                       placeholder="Powtórz hasło" required>
                       <?php
			if (isset($_SESSION['e_haslo']))
			{
				echo '<div class="error">'.$_SESSION['e_haslo'].'</div>';
				unset($_SESSION['e_haslo']);
			}
		?>	
            </div>
        </div>
        
        <div class="row row-custom">
            <div class="form-group text-center ml-auto mr-3">
                <button type="submit" class="btn btn-login btn-custom text-center" name="register">Zarejestruj się!
                </button>
            </div>
            <div class="form-group text-center mr-auto ml-3">
                <button type="reset" class="btn btn-login btn-custom text-center">Wyczyść</button>
            </div>
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

<script type="text/javascript">
    function isNumber(event) {
        var keycode = event.keyCode;
        if (keycode >= 48 && keycode <= 57)
            return true;
        return false;
    }
    function maxLengthCheck(object) {
        if(object.value.length > object.max.length)
            object.value = object.value.slice(0, object.max.length);
    }
</script>
    
</body>

</html>