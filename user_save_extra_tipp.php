<?PHP

$champ=0;
$down1=0;
$down2=0;
$down3=0;
$up1=0;
$up2=0;
$up3=0;
$fired=0;

session_start();
extract($_SESSION);

$champ=$_REQUEST[champ];
$down1=$_REQUEST[down1];
$down2=$_REQUEST[down2];
$down3=$_REQUEST[down3];
$up1=$_REQUEST[up1];
$up2=$_REQUEST[up2];
$up3=$_REQUEST[up3];
$fired=$_REQUEST[fired];

require("connect_db.php");

$str = "SELECT * FROM ".$season."_tbl_extra_wins ew, ".$season."_tbl_user u WHERE ew.userID=0 AND ew.userID=u.id";
//echo $str."<br>";
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

$email_body = "Folgende Extratipps wurden gespeichert:\n\n<br><br>";

$str = "DELETE FROM ".$season."_tbl_extra_wins WHERE userID=".$act_userid;
//echo $str;
$result = mysql_query($str);
$str = "INSERT INTO ".$season."_tbl_extra_wins values ($act_userid, $season, $champ, $down1, $down2, $down3, $up1, $up2, $up3, $fired, $wins)";
//echo $str;
//$str = "UPDATE ".$season."_tbl_extra_wins SET champ=".$champ." WHERE userID=".$act_userid;
$result = mysql_query($str);
//echo $str;

//init string; just add column name of table extra_wins
$initStr = "SELECT u.email AS mail, t.name AS team_name FROM ".$season."_tbl_user u, ".$season."_tbl_extra_wins ew, ".$season."_tbl_team1 t WHERE ew.userID=".$act_userid." AND u.ID=ew.userID AND t.id=ew.";

//champ
$str = $initStr."champ";
$result = mysql_fetch_array( mysql_query($str) );
$champ = $result["team_name"];

//down1
$str = $initStr."down1";
$result = mysql_fetch_array( mysql_query($str) );
$down1 = $result["team_name"];

//down2
$str = $initStr."down2";
$result = mysql_fetch_array( mysql_query($str) );
$down2 = $result["team_name"];

//down3
$str = $initStr."down3";
$result = mysql_fetch_array( mysql_query($str) );
$down3 = $result["team_name"];

//up1
$str = $initStr."up1";
$result = mysql_fetch_array( mysql_query($str) );
$up1 = $result["team_name"];

//up2
$str = $initStr."up2";
$result = mysql_fetch_array( mysql_query($str) );
$up2 = $result["team_name"];

//up3
$str = $initStr."up3";
$result = mysql_fetch_array( mysql_query($str) );
$up3 = $result["team_name"];

//fired
$str = $initStr."fired";
$result = mysql_fetch_array( mysql_query($str) );
$fired = $result["team_name"];

//email
$email = $result["mail"];


require("close_db.php");

require("top.php");

echo "<br><b>Extra-Tipps gespeichert</b><br><br>";
$email_body = $email_body."Meister: ".$champ."\n<br>";
$email_body = $email_body."Absteiger 1: ".$down1."\n<br>";
$email_body = $email_body."Absteiger 2: ".$down2."\n<br>";
$email_body = $email_body."Absteiger 3: ".$down3."\n<br>";
$email_body = $email_body."Aufsteiger 1: ".$up1."\n<br>";
$email_body = $email_body."Aufsteiger 2: ".$up2."\n<br>";
$email_body = $email_body."Aufsteiger 3: ".$up3."\n<br>";
$email_body = $email_body."Trainerentlassung: ".$fired."\n<br>";

//send email
$header = "From: HWD<michael.voigt@web.de>\n";
$header .= "Reply-To: HWD<michael.voigt@web.de>\n";

$subject = "HWD: Deine Extra-Tipps wurden gespeichert";

mail($email, $subject, $body."\n\n".$email_body, $header);
echo "EMail verschickt an: $email:<br>";
echo $email_body."<br>";


require("user_show_extra_tipp.php");

require("bottom.php");

?>
