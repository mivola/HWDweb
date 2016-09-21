<?PHP
session_start();
extract($_POST);
extract($_SESSION);

require("connect_db.php");

  $table_head=$table_head1;
  $table_lineA=$table_lineA1;
  $table_lineB=$table_lineB1;
  $table_colA=$table_colA1;
  $table_colB=$table_colB1;
  $table_max_points=$table_max_points1;

//$str = "UPDATE ".$season."_tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long." ";
$str = "UPDATE ".$season."_tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long.", table_head='$table_head', table_lineA='$table_lineA', table_lineB='$table_lineB', table_colA='$table_colA', table_colB='$table_colB', table_max_points='$table_max_points' ";

if ($pass1 != "") {
  $str = $str." , password='".$pass1."' ";
}
// else {
  //$result = mysql_query("UPDATE ".$season."_tbl_user SET email='".$email."', show_tipps=".$show_tipps." WHERE id=".$act_userid);
//}
$str = $str." WHERE id=".$act_userid;

$result = mysql_query($str);

require("close_db.php");

// Variablen übernehmen
$email = $tmp_email;
$show_long = $tmp_show_long;
require("top.php");

echo "<br><b>Profil geändert</b><br><br>";
require("user_show_profile.php");

require("bottom.php");

?>




