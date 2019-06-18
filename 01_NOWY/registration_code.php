<?php
session_start();

if(isset($_POST['email']))
{
    $wszystko_OK = true;
    
    $imie = $_POST['imie'];
    /*
    if (ctype_alpha($imie)==false)
	{
		$wszystko_OK=false;
        $_SESSION['e_imie']="Imie składa się tylko z liter";
        //header('Location: Rejestracja.php');
	}
    */
    $nazwisko = $_POST['nazwisko'];
    $nr_tel = $_POST['nr_tel'];
    $haslo = $_POST['haslo'];
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


    /*
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
					
			if ($polaczenie->query("INSERT INTO klienci VALUES (NULL, '$nick', '$haslo_hash', '$email', 100, 100, 100, 14)"))
			{
				$_SESSION['udanarejestracja']=true;
				header('Location: witamy.php');
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
}*/
}

