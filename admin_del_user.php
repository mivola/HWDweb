<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$str = "Delete from tbl_user where id=$userid";
$result = mysqli_query($connectedDb, $str);

require("close_db.php");

require("top.php");

echo "<p><br><b>User gel&ouml;scht!</b></p>";

require("admin_show_users.php");

require("bottom.php");

?>
