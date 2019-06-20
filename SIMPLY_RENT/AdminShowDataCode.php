<?php
require_once "connect.php";
try {
    $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);

    if ($polaczenie->connect_errno != 0) {
        throw new Exception(mysqli_connect_errno());
    } else {
        $sql = "SELECT * FROM wynajem";
            $result = $polaczenie->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                     echo '<div>'. 'ID użytkownika: '.  $row['ID']. '</br>' . 'ID Auta: ' .  $row['IDAuta'] .  '</br>' . 'Data od: ' . $row['Data_Od'] . '</br>' . 'Data do: '. $row['Data_Do'] . '</div>';
                } 
            } else {
                echo "Problem z wyswietleniem dyscyplin";
            }
    }
} catch (Exception $e) {
    echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!</span>';
    echo '<br />Informacja developerska: ' . $e;
}