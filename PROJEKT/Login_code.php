<?php

session_start();
	
	if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
	{
		header('Location: Page.php');
		exit();
	}

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
        $login = $_POST['email'];
		$haslo = $_POST['password'];
		
		$login = htmlentities($login, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
        if ($rezultat = @$polaczenie->query(
            sprintf("SELECT * FROM klienci WHERE ID='%s' AND Haslo='%s'",
            mysqli_real_escape_string($polaczenie,$login),
            mysqli_real_escape_string($polaczenie,$haslo))))
            {
                $ilu_userow = $rezultat->num_rows;
                if($ilu_userow>0)
                {
                    $_SESSION['zalogowany'] = true;
                    
                    $wiersz = $rezultat->fetch_assoc();
                    $_SESSION['id'] = $wiersz['ID'];
                    $_SESSION['imie'] = $wiersz['Imie'];
                    $_SESSION['nazwisko'] = $wiersz['Nazwisko'];
                    $_SESSION['adresemail'] = $wiersz['Adres_email'];
                    echo 'blabla1';
                    unset($_SESSION['blad']);
                    echo 'blabla2';
                    header('Location: Page.php');
                    $rezultat->free_result();
                    
                } else {
                    
                    $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    echo 'blabla3';
                    header('Location: Login_user.php');
                    echo 'blabla3';
                    
                }
            }
            $polaczenie->close();
        }
    }
    catch(Exception $e)
		{
			echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
			echo '<br />Informacja developerska: '.$e;
		}
    