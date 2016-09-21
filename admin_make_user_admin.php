<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$str = "Update tbl_user set admin=$option where id=$userid";
$result = mysql_query($str);

require("close_db.php");

require("top.php");

echo "<p><br><b>Adminrechte geändert!</b></p>";

require("admin_show_users.php");

require("bottom.php");

?>
