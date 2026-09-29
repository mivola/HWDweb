<?PHP
session_start();
extract($_SESSION);
if (empty($_SESSION['admin'])) { die("Keine Berechtigung!"); }

$userid = (int)$_GET['userid'];
$option = ((int)$_GET['option'] == 1) ? 1 : 0;

require("connect_db.php");

$str = "Update tbl_user set admin=$option where id=$userid";
$result = mysqli_query($connectedDb, $str);

require("close_db.php");

require("top.php");

echo "<p><br><b>Adminrechte geändert!</b></p>";

require("admin_show_users.php");

require("bottom.php");

?>
