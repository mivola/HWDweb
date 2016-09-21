<?php

$parafile = "para.ini.inc";
include ($parafile);

$db_close = @mysql_close($connect)  or die ("Konnte Verbindung zur Datenbank nicht schliessen");

?>
