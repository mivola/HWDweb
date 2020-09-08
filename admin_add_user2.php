<?PHP
session_start();
extract($_SESSION);

$first_name_new = trim($_REQUEST[first_name]);
$last_name_new = trim($_REQUEST[last_name]);
$nick_name_new = trim($_REQUEST[nick_name]);
$email_new = trim($_REQUEST[email]);
$admin_new = trim($_REQUEST[admin]);

require("connect_db.php");

$query = "Insert into tbl_user (`first_name` , `last_name` , `nick_name` , `password` , `email` , `registration` , `last_loggin` , `show_tipps` , `show_long` , `logged_in` , `admin` , `phpMySQL` ) Values ('".$first_name_new."', '".$last_name_new."', '".$nick_name_new."', '".$nick_name_new."', '".$email_new."', '".time()."', ".time().", 0, 0, 0, ".$admin_new.", 0)";

$result = mysqli_query($connectedDb, $query);

//Fehlerüberprüfung!!!

require("close_db.php");

require("top.php");
echo $query;
echo "<p><br><b>User ".$first_name_new." ".$last_name_new." (".$nick_name_new.") angelegt!</b></p>";
// echo $query;
require("admin_show_users.php");

require("bottom.php");

?>

