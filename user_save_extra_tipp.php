<?PHP

error_reporting(E_ERROR | E_WARNING | E_PARSE);

session_start();
extract($_POST);
extract($_SESSION);

$champ=0;
$second=0;
$third=0;
$forth=0;
$fifth=0;
$down1=0;
$down2=0;
$down3=0;
$up1=0;
$up2=0;
$up3=0;
$fired=0;
$fired2=0;

$champ=$_REQUEST["champ"];
$second=$_REQUEST["second"];
$third=$_REQUEST["third"];
$forth=$_REQUEST["forth"];
$fifth=$_REQUEST["fifth"];
$down1=$_REQUEST["down1"];
$down2=$_REQUEST["down2"];
$down3=$_REQUEST["down3"];
$up1=$_REQUEST["up1"];
$up2=$_REQUEST["up2"];
$up3=$_REQUEST["up3"];
$fired=$_REQUEST["fired"];
$fired2=$_REQUEST["fired2"];

require("connect_db.php");

//get the reference values
//$str = "SELECT * FROM tbl_extra_wins ew, tbl_user u WHERE ew.userID=0 AND ew.userID=u.id";
$str = "SELECT * FROM tbl_extra_wins ew WHERE ew.userID=0";
//echo $str."<br>";
$result = mysql_query($str);

$wins = 0;
$echoStr = "";

while($row = mysql_fetch_array($result)) {

//Meister
  if ( ($row["champ"] > 0) && ($row["champ"] == $champ) ) { $wins = $wins + 1; }
$echoStr .= "wins: ".$wins."<br>";

//Platz2-5
  if ( $row["second"] > 0 ) {
	if ( $row["second"] == $second) { $wins = $wins + 1; }
	else if ( ($row["second"] == $third) || ($row["second"] == $forth) || ($row["second"] == $fifth) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["third"] > 0 ) {
	if ( $row["third"] == $third) { $wins = $wins + 1; }
	else if ( ($row["third"] == $second) || ($row["third"] == $forth) || ($row["third"] == $fifth) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["forth"] > 0 ) {
	if ( $row["forth"] == $forth) { $wins = $wins + 1; }
	else if ( ($row["forth"] == $second) || ($row["forth"] == $third) || ($row["forth"] == $fifth) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["fifth"] > 0 ) {
	if ( $row["fifth"] == $fifth) { $wins = $wins + 1; }
	else if ( ($row["fifth"] == $second) || ($row["fifth"] == $third) || ($row["fifth"] == $forth) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";

//Absteiger
  if ( $row["down1"] > 0 ) {
	if ( $row["down1"] == $down1 ) { $wins = $wins + 1; }
	else if ( ($row["down1"] == $down2) || ($row["down1"] == $down3) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["down2"] > 0 ) {
	if ( $row["down2"] == $down2 ) { $wins = $wins + 1; }
	else if ( ($row["down2"] == $down1) || ($row["down2"] == $down3) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["down3"] > 0 ) {
	if ( $row["down3"] == $down3 ) { $wins = $wins + 1; }
	else if ( ($row["down3"] == $down1) || ($row["down3"] == $down2) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";

//Aufsteiger
  if ( $row["up1"] > 0 ) {
	if ( $row["up1"] == $up1 ) { $wins = $wins + 1; }
	else if ( ($row["up1"] == $up2) || ($row["up1"] == $up3) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["up2"] > 0 ) {
	if ( $row["up2"] == $up2 ) { $wins = $wins + 1; }
	else if ( ($row["up2"] == $up1) || ($row["up2"] == $up3) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";
  if ( $row["up3"] > 0 ) {
	if ( $row["up3"] == $up3 ) { $wins = $wins + 1; }
	else if ( ($row["up3"] == $up1) || ($row["up3"] == $up2) ) { $wins = $wins + 0.5; }
  }
$echoStr .= "wins: ".$wins."<br>";

//Tr.Ent.
  if ( ($row["fired"] > 0) && ($row["fired"] == $fired) ) { $wins = $wins + 1; }
  if ( ($row["fired2"] > 0) && ($row["fired2"] == $fired2) ) { $wins = $wins + 1; }

// verdopplung der punkte, da wir bisher immer nur halbe punkte verteilt haben
  $wins = $wins * 2;

$echoStr .= "wins: ".$wins."<br>";

}

$email_body = "Folgende Extratipps wurden gespeichert:\n\n<br><br>";

$str = "DELETE FROM tbl_extra_wins WHERE userID=".$act_userid;
//echo $str;
$result = mysql_query($str);
$str = "INSERT INTO tbl_extra_wins values ($act_userid, $season, $champ, $second, $third, $forth, $fifth, $down1, $down2, $down3, $up1, $up2, $up3, $fired, $fired2, $wins)";
//echo $str;
//$str = "UPDATE tbl_extra_wins SET champ=".$champ." WHERE userID=".$act_userid;
$result = mysql_query($str);
//echo $str;

//init string; just add column name of table extra_wins
$initStr = "SELECT t.name AS team_name FROM tbl_extra_wins ew, tbl_team t WHERE ew.userID=".$act_userid." AND t.id=ew.";

//champ
$str = $initStr."champ";
$result = mysql_fetch_array( mysql_query($str) );
$champ = $result["team_name"];

//second
$str = $initStr."second";
$result = mysql_fetch_array( mysql_query($str) );
$second = $result["team_name"];

//third
$str = $initStr."third";
$result = mysql_fetch_array( mysql_query($str) );
$third = $result["team_name"];

//forth
$str = $initStr."forth";
$result = mysql_fetch_array( mysql_query($str) );
$forth = $result["team_name"];

//fifth
$str = $initStr."fifth";
$result = mysql_fetch_array( mysql_query($str) );
$fifth = $result["team_name"];

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

//fired2
$str = $initStr."fired2";
$result = mysql_fetch_array( mysql_query($str) );
$fired2 = $result["team_name"];

//email
$str = "SELECT u.email AS mail FROM tbl_user u WHERE u.id=".$act_userid;
$result = mysql_fetch_array( mysql_query($str) );
$email = $result["mail"];


require("close_db.php");

require("top.php");


//echo "<br><b>Folgende Extra-Tipps wurden gespeichert</b><br><br>";
$email_body = $email_body."Meister: ".$champ."\n<br>";
$email_body = $email_body."Platz 2: ".$second."\n<br>";
$email_body = $email_body."Platz 3: ".$third."\n<br>";
$email_body = $email_body."Platz 4: ".$forth."\n<br>";
$email_body = $email_body."Platz 5: ".$fifth."\n<br>";
$email_body = $email_body."Absteiger 1: ".$down1."\n<br>";
$email_body = $email_body."Absteiger 2: ".$down2."\n<br>";
$email_body = $email_body."Absteiger 3: ".$down3."\n<br>";
$email_body = $email_body."Aufsteiger 1: ".$up1."\n<br>";
$email_body = $email_body."Aufsteiger 2: ".$up2."\n<br>";
$email_body = $email_body."Aufsteiger 3: ".$up3."\n<br>";
$email_body = $email_body."Trainerentlassung 1. Liga: ".$fired."\n<br>";
$email_body = $email_body."Trainerentlassung 2. Liga: ".$fired2."\n<br>";

//send email
$header = "From: HWD<admin@hwd.bts-computer.de>\n";
$header .= "Reply-To: HWD<admin@hwd.bts-computer.de>\n";

$subject = "HWD: Deine Extra-Tipps wurden gespeichert";

mail($email, $subject, $email_body, $header);
echo "EMail wurde verschickt an: - $email - <br>";
//echo $email_body."<br>";

//echo "gewinnpunkte: ".$echoStr;

require("user_show_extra_tipp.php");

require("bottom.php");

?>
