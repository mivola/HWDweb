<?PHP

session_start();
extract($_SESSION); 

$first_name_new = trim($HTTP_POST_VARS["first_name"]);
$last_name_new = trim($HTTP_POST_VARS["last_name"]);
$nick_name_new = trim($HTTP_POST_VARS["nick_name"]);
$email_new = trim($HTTP_POST_VARS["email"]);
$admin_new = trim($HTTP_POST_VARS["admin"]);

require("connect_db.php");

$query = "Insert into tbl_user Values (0, '".$first_name_new."', '".$last_name_new."', '".$nick_name_new."', '".$nick_name_new."', '".$email."', '".time()."', ".time().", 0, 0, ".$admin_new.")";

$result = mysql_query($query);

//Fehlerüberprüfung!!!

require("close_db.php");

require("top.php");

echo "<p><br><b>User ".$first_name_new." ".$last_name_new." (".$nick_name_new.") angelegt!</b></p>";
// echo $query;
require("admin_show_users.php");

require("bottom.php");

?>

