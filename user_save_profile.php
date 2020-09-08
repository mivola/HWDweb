<?PHP
session_start();
extract($_POST);
extract($_SESSION);

require("connect_db.php");

//$str = "UPDATE tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long." ";
//$str = "UPDATE tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long.", table_head='$table_head', table_lineA='$table_lineA', table_lineB='$table_lineB', table_colA='$table_colA', table_colB='$table_colB', table_max_points='$table_max_points' ";
$str = "UPDATE tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long." ";

if ($pass1 != "") {
  $str = $str." , password='".$pass1."' ";
}
$str = $str." WHERE id=".$act_userid;

$result = mysqli_query($connectedDb, $str);

require("close_db.php");

// Variablen übernehmen
$email = $tmp_email;
$show_long = $tmp_show_long;
require("top.php");

echo "<br><b>Profil geändert</b><br><br>";
require("user_show_profile.php");

require("bottom.php");

?>




