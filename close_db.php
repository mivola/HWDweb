<?php

$parafile = "para.ini.inc";
include ($parafile);

$db_close = @mysqli_close($connectedDb) or die ("Konnte Verbindung zur Datenbank nicht schliessen");

?>
