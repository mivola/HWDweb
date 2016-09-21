<?PHP
  session_start();
  //session_unregister("id");
  //session_unregister("first_name");
  //session_unregister("last_name");
  //session_unregister("nick_name");
require("connect_db.php");

$result = mysql_query("UPDATE ".$season."_tbl_user SET logged_in=0 WHERE id=".$act_userid);

require("close_db.php");

session_destroy();

require("index_top.php");

echo "<font size=4 color=red>Erfolgreich abgemeldet!<br>Danke für die Teilnahme bei HWD!</font><br><br>";

require("index_bottom.php");

?>
