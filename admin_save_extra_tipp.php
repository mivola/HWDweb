<?PHP
//session_start();
if (isset($_SESSION)) {extract($_SESSION);}
extract($_POST);

require("connect_db.php");

//$str = "SELECT * FROM tbl_extra_wins WHERE userID > 0";
$result2 = mysql_query("SELECT * FROM tbl_extra_wins WHERE userID > 0");

while($row = mysql_fetch_array($result2)) {

  $wins = 0;

  if ( !isset($row["champ"])){ $tmp_champ=-1; } else { $tmp_champ = $row["champ"]; }
  if ( !isset($row["second"])){ $tmp_second=-1; } else { $tmp_second = $row["second"]; }
  if ( !isset($row["third"])){ $tmp_third=-1; } else { $tmp_third = $row["third"]; }
  if ( !isset($row["forth"])){ $tmp_forth=-1; } else { $tmp_forth = $row["forth"]; }
  if ( !isset($row["fifth"])){ $tmp_fifth=-1; } else { $tmp_fifth = $row["fifth"]; }
  if ( !isset($row["down1"])){ $tmp_down1=-1; } else { $tmp_down1 = $row["down1"]; }
  if ( !isset($row["down2"])){ $tmp_down2=-1; } else { $tmp_down2 = $row["down2"]; }
  if ( !isset($row["down3"])){ $tmp_down3=-1; } else { $tmp_down3 = $row["down3"]; }
  if ( !isset($row["up1"])){ $tmp_up1=-1; } else { $tmp_up1 = $row["up1"]; }
  if ( !isset($row["up2"])){ $tmp_up2=-1; } else { $tmp_up2 = $row["up2"]; }
  if ( !isset($row["up3"])){ $tmp_up3=-1; } else { $tmp_up3 = $row["up3"]; }
  if ( !isset($row["fired"])){ $tmp_fired=-1; } else { $tmp_fired = $row["fired"]; }
  if ( !isset($row["fired2"])){ $tmp_fired2=-1; } else { $tmp_fired2 = $row["fired2"]; }

//Meister
  if ( ($tmp_champ > 0) && ($tmp_champ == $champ) ) { $wins = $wins + 1; }
//echo "wins: ".$wins."<br>";
//Platz2-5
  if ( $tmp_second > 0 ) {
	if ( $tmp_second == $second) { $wins = $wins + 1; }
	else if ( ($tmp_second == $third) || ($tmp_second == $forth) || ($tmp_second == $fifth) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_third > 0 ) {
	if ( $tmp_third == $third) { $wins = $wins + 1; }
	else if ( ($tmp_third == $second) || ($tmp_third == $forth) || ($tmp_third == $fifth) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_forth > 0 ) {
	if ( $tmp_forth == $forth) { $wins = $wins + 1; }
	else if ( ($tmp_forth == $second) || ($tmp_forth == $third) || ($tmp_forth == $fifth) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_fifth > 0 ) {
	if ( $tmp_fifth == $fifth) { $wins = $wins + 1; }
	else if ( ($tmp_fifth == $second) || ($tmp_fifth == $third) || ($tmp_fifth == $forth) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";

//Absteiger
  if ( $tmp_down1 > 0 ) {
	if ( $tmp_down1 == $down1 ) { $wins = $wins + 1; }
	else if ( ($tmp_down1 == $down2) || ($tmp_down1 == $down3) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_down2 > 0 ) {
	if ( $tmp_down2 == $down2 ) { $wins = $wins + 1; }
	else if ( ($tmp_down2 == $down1) || ($tmp_down2 == $down3) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_down3 > 0 ) {
	if ( $tmp_down3 == $down3 ) { $wins = $wins + 1; }
	else if ( ($tmp_down3 == $down1) || ($tmp_down3 == $down2) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";

//Aufsteiger
  if ( $tmp_up1 > 0 ) {
	if ( $tmp_up1 == $up1 ) { $wins = $wins + 1; }
	else if ( ($tmp_up1 == $up2) || ($tmp_up1 == $up3) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_up2 > 0 ) {
	if ( $tmp_up2 == $up2 ) { $wins = $wins + 1; }
	else if ( ($tmp_up2 == $up1) || ($tmp_up2 == $up3) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";
  if ( $tmp_up3 > 0 ) {
	if ( $tmp_up3 == $up3 ) { $wins = $wins + 1; }
	else if ( ($tmp_up3 == $up1) || ($tmp_up3 == $up2) ) { $wins = $wins + 0.5; }
  }
//echo "wins: ".$wins."<br>";

//TrainerEntl
  if ( ($tmp_fired > 0) && ($tmp_fired == $fired) ) { $wins = $wins + 1; }
  if ( ($tmp_fired2 > 0) && ($tmp_fired2 == $fired2) ) { $wins = $wins + 1; }
//echo "wins: ".$wins."<br>";

// verdopplung der punkte, da wir bisher immer nur halbe punkte verteilt haben
  $wins = $wins * 2;

  $str = "UPDATE tbl_extra_wins SET wins=".$wins." WHERE userID=".$row["userID"];
//echo $str;
  $result = mysql_query($str);

}

$str = "DELETE FROM tbl_extra_wins WHERE userID=0";
$result = mysql_query($str);
$str = "INSERT INTO tbl_extra_wins values (0, $season, $champ, $second, $third, $forth, $fifth, $down1, $down2, $down3, $up1, $up2, $up3, $fired, $fired2, 0)";
//$str = "UPDATE tbl_extra_wins SET champ=".$champ." WHERE userID=".$act_userid;
$result = mysql_query($str);
//echo $str;
//$str = "UPDATE tbl_user SET email='".$tmp_email."', show_tipps=".$show_tipps.", show_long=".$tmp_show_long.", table_head='$table_head', table_lineA='$table_lineA', table_lineB='$table_lineB', table_colA='$table_colA', table_colB='$table_colB', table_max_points='$table_max_points' ";

require("close_db.php");

require("top.php");

echo "<br><b>Extra-Tipps gespeichert</b><br><br>";
require("admin_show_extra_tipp.php");

require("bottom.php");

?>
