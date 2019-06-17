<?php
session_start();
$_SESSION['isLoggedIn']=false;
session_destroy();
header('Location: login.php');