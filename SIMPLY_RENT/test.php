<?php
 $haslo = $_POST['password'];
$haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
                echo $haslo_hash;

                ?>