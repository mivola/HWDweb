<?PHP

session_start();
extract($_SESSION); 

require("connect_db.php");

$str = "SELECT * FROM tbl_extra_wins WHERE userID=0";
$result = mysql_query($str);
$wins = 0;
while($row = mysql_fetch_array($result)) {
  if ( ($row["champ"] > 0) && ($row["champ"] == $champ) ) { $wins = $wins + 1; }
  if ( ($row["down1"] > 0) && ( ($row["down1"] == $down1) || ($row["down1"] == $down2) || ($row["down1"] == $down3) ) ) { $wins = $wins + 1; }
  if ( ($row["down2"] > 0) && ( ($row["down2"] == $down1) || ($row["down2"] == $down2) || ($row["down2"] == $down3) ) ) { $wins = $wins + 1; }
  if ( ($row["down3"] > 0) && ( ($row["down3"] == $down1) || ($row["down3"] == $down2) || ($row["down3"] == $down3) ) ) { $wins = $wins + 1; }
  if ( ($row["up1"] > 0) && ( ($row["up1"] == $up1) || ($row["up1"] == $up2) || ($row["up1"] == $up3) ) ) { $wins = $wins + 1; }
  if ( ($row["up2"] > 0) && ( ($row["up2"] == $up1) || ($row["up2"] == $up2) || ($row["up2"] == $up3) ) ) { $wins = $wins + 1; }
  if ( ($row["up3"] > 0) && ( ($row["up3"] == $up1) || ($row["up3"] == $up2) || ($row["up3"] == $up3) ) ) { $wins = $wins + 1; }
  if ( ($row["fired"] > 0) && ($row["fired"] == $fired) ) { $wins = $wins + 1; }

}

$str = "DELETE FROM tbl_extra_wins WHERE userID=".$act_userid;
$result = mysql_query($str);
$str = "INSERT INTO tbl_extra_wins values ($act_userid, $champ, $down1, $down2, $down3, $up1, $up2, $up3, $fired, $wins)";
//$str = "UPDATE tbl_extra_wins SET champ=".$champ." WHERE userID=".$act_userid;
$result = mysql_query($str);
//echo $str;
//$str = "UPDATE tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long.", table_head='$table_head', table_lineA='$table_lineA', table_lineB='$table_lineB', table_colA='$table_colA', table_colB='$table_colB', table_max_points='$table_max_points' ";



require("close_db.php");

require("top.php");

echo "<br><b>Extra-Tipps gespeichert</b><br><br>";
require("user_show_extra_tipp.php");

require("bottom.php");

?>
