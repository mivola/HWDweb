<?php

session_start();

$parafile = "para.ini.inc";
include ($parafile);

session_register("season");
session_register("db_name");
session_register("db_user");
session_register("db_host");

$connect = mysql_connect($db_host, $db_user, $db_passwd) or die ("Verbindung zur Datenbank fehlgeschlagen!");

@mysql_select_db($db_name);

?>
