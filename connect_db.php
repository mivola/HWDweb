<?php

  session_start();

$parafile = "para.ini.inc";
//$para = file($parafile);
include ($parafile);

//obsolete
for ($x = 0; $x < count($para); $x++ ) {
  $str = split("=", $para[$x]);
  if ($str[0] == "host"){
//    $host = substr($str[1], 0, -2);
  }
  if ($str[0] == "dbname"){
//    $dbname = substr($str[1], 0, -2);
  }
  if ($str[0] == "user"){
//    $user = substr($str[1], 0, -2);
  }
  if ($str[0] == "pass"){
    //$passwd = $str[1];
//    $passwd = substr($str[1], 0, -2);
  }
  if (($str[0] == "season") && (! isset($season))){
//    $season = substr($str[1], 0, -1);
  }

}
session_register("season");
session_register("db_name");

$connect = mysql_connect($db_host, $db_user, $db_passwd) or die ("Verbindung zur Datenbank fehlgeschlagen!");

@mysql_select_db($db_name);

?>
