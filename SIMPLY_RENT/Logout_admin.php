<?php
session_start();
$_SESSION['zalogowany']=false;
unset($_SESSION['admin']);
session_destroy();
header('Location: Page.php');