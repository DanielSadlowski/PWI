<?php
$l1 =  $_POST["l1"];
$l2 =  $_POST["l2"];
$znak =  $_POST["znak"];

switch ($znak) {
    case "+":
        echo $l1+$l2;
        break;
    case "-":
        echo $l1+$l2;
        break;
    case "*":
        echo $l1*$l2;
        break;
    case "/":
      if ($l2 == 0) {
        echo "DZIELENIE PRZEZ 0!";
      }
      else {
        echo $l1/$l2;
      }
      break;
    default:
        echo "Podaj właściwy znak";
}
?>