<?php

extract($_SESSION); 

$parafile = "para.ini.inc";
include ($parafile);

$_SESSION['season']= $season;
$_SESSION['db_name']= $db_name;

$connect = mysql_connect($db_host, $db_user, $db_passwd) or die ("Verbindung zur Datenbank fehlgeschlagen!");

@mysql_select_db($db_name);

?>
