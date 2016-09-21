<?php

//session_start();

$parafile = "para.ini.inc";
include ($parafile);

$_SESSION['season']= $season;
$_SESSION['season']= $season;

$_SESSION['db_name']= $db_name;
$_SESSION['db_user']= $db_user;
$_SESSION['db_host']= $db_host;

$connect = mysql_connect($db_host, $db_user, $db_passwd) or die ("Verbindung zur Datenbank fehlgeschlagen!");

@mysql_select_db($db_name);

?>
