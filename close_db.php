<?php

$parafile = "para.ini";
$para = file($parafile);

for ($x = 0; $x < count($para); $x++ ) {

  $str = split("=", $para[$x]);

  if ($str[0] == "host"){
    $host = substr($str[1], 0, -2);
  }
  if ($str[0] == "dbname"){
    $dbname = substr($str[1], 0, -2);
  }
  if ($str[0] == "user"){
    $user = substr($str[1], 0, -2);
  }
  if ($str[0] == "pass"){
    //$passwd = $str[1];
    $passwd = substr($str[1], 0, -2);
  }

}

$db_close = @mysql_close($connect)  or die ("Konnte Verbindung zur Datenbank nicht schliessen");

?>
