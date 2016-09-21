<?PHP
session_start();
extract($_POST);
extract($_SESSION);

//$play = $playID;
$play = $_POST["playID"];
$joker1 = $_POST["joker1"];
//$play = $HTTP_POST_VARS["playID"];

require("connect_db.php");

// Füllen der Arrays
$bets[1] = $bet1; $bets[2] = $bet2; $bets[3] = $bet3; $bets[4] = $bet4; $bets[5] = $bet5; $bets[6] = $bet6; $bets[7] = $bet7; $bets[8] = $bet8; $bets[9] = $bet9;
if (isset($bet10)) $bets[10] = $bet10;
if (isset($bet11)) $bets[11] = $bet11;
if (isset($bet12)) $bets[12] = $bet12;
$bets[13] = $bet13; $bets[14] = $bet14; $bets[15] = $bet15; $bets[16] = $bet16; $bets[17] = $bet17; $bets[18] = $bet18;
$bets[19] = $bet19; $bets[20] = $bet20; $bets[21] = $bet21;
if (isset($bet22)) $bets[22] = $bet22;
if (isset($bet23)) $bets[23] = $bet23;
if (isset($bet24)) $bets[24] = $bet24;
$games[1] = $game1; $games[2] = $game2; $games[3] = $game3; $games[4] = $game4; $games[5] = $game5; $games[6] = $game6; $games[7] = $game7; $games[8] = $game8; $games[9] = $game9;
if (isset($game10)) $games[10] = $game10;
if (isset($game11)) $games[11] = $game11;
if (isset($game12)) $games[12] = $game12;

$maxi = 12;
for ($i=1; $i <= $maxi; $i++){

  $game = $games[$i];
  $bet1 = trim($bets[$i]);
  $bet2 = trim($bets[$i+12]);
  if ($bet1 == "") { $bet1 = "-1"; }
  if ($bet2 == "") { $bet2 = "-1"; }
  $result1 = mysql_query("DELETE FROM tbl_bet WHERE game=".$game." AND userID=".$act_userid);
  $query = "INSERT INTO tbl_bet (userID, game, bet1, bet2, bet_ts) VALUES (".$act_userid.", ".$game.", ".$bet1.", ".$bet2.", ".time().")";
  
  $resultBets[$i] = mysql_query($query);

  //echo "<br>".$query;

}

// save joker1  
$queryJoker = "UPDATE tbl_bet SET joker1=1 WHERE userID=".$act_userid." AND game=".$joker1.";";
mysql_query($queryJoker);
//echo "<br>".$joker1." --- ".$queryJoker;

//Select * from tbl_bet b, tbl_game g, tbl_team t1, view_team2 t2 where play=1 and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id
//$resultPlayBL1 = mysql_query("Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1");
$resultPlayBL1 = mysql_query("Select * from tbl_bet b, tbl_game g, tbl_team t1, view_team2 t2, tbl_user u where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id and b.userID=".$act_userid." and u.id=".$act_userid." order by g.p_ts, g.id");
$resultPlayBL2 = mysql_query("Select * from tbl_bet b, tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 and b.game=g.id and b.userID=".$act_userid." order by g.p_ts, g.id");

//$resultBL1 = mysql_query("Select * from tbl_team where league=1 order by name");
//$resultBL2 = mysql_query("Select * from tbl_team where league=2 order by name");

$email_body = "";
$to = "";
$maxi = 9;
if (mysql_num_rows($resultPlayBL2) > 0) {
  $maxi = 12;
}

//require("connect_db.php");

require("close_db.php");

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Folgende Tipps wurden f&uuml;r ".$playID.". Spieltag eingetragen:</b><br><br>";

?>

  <table>
    <tr><td colspan=4 class="noBorder"><b>1. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Tipp</b></td>
    </tr>


<?PHP

  $j = 0;
  $k = 0;
  $email_body .= "1. Liga\n\n";
  for ($j=1; $j<=9; $j++){

    $row = mysql_fetch_array($resultPlayBL1);
    $to = $row["email"];
	$userName = $row["nick_name"];
	
	if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";
    $k = $j + 12;
    if ($row["bet1"] > -1){
      echo "<td>".$row["bet1"]." : ".$row["bet2"];
    } else {
      echo "<td>nicht getippt";
    }
    
    // show joker
    $joker1Set = "";
    if ( $row["joker1"] == "1" ) {
	    $joker1Set = " (J)";
    } 
    echo "$joker1Set</td>\n";
    
    echo "</tr>\n";
    
    $email_body .= $j." - ".date("d.m.Y", $row["p_ts"])." ".date("H:i", $row["p_ts"]).": ".$row["name"]." - ".$row["name2"].":\t ".$row["bet1"].":".$row["bet2"];
    $email_body .= $joker1Set;
    $email_body .= "\n";


  } // for ($j

//if ($maxi>9){
?>

    
    <tr><td colspan=4 class="noBorder"><br><b>2. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Tipp</b></td>
    </tr>

<?PHP

  $email_body .= "\n\n\n2. Liga\n\n";
  for ($j=10; $j<=12; $j++){

    $row = mysql_fetch_array($resultPlayBL2);
    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";

    if ($row["bet1"] > -1){
      echo "<td>".$row["bet1"]." : ".$row["bet2"];        
    } else {
      echo "<td>nicht getippt";    
    }

    // show joker
    $joker1Set = "";
    if ( $row["joker1"] == "1" ) {
	    $joker1Set = " (J)";
    } 
    echo "$joker1Set</td>\n";
    
    echo "</tr>\n";

    $email_body .= $j." - ".date("d.m.Y", $row["p_ts"])." ".date("H:i", $row["p_ts"]).": ".$row["name"]." - ".$row["name2"].":\t ".$row["bet1"].":".$row["bet2"];
    $email_body .= $joker1Set;
    $email_body .= "\n";

  } // for ($j

//} // if ($maxi>9)

?>

  </table>

<?PHP

  //EMail mit den Tipps als Bestätigung verschicken
  $header = "From: HWD<admin@hwd.bts-computer.de>\n";
  $header .= "Reply-To: HWD<admin@hwd.bts-computer.de>\n";

  $subject = "HWD: Tipps wurden gespeichert (".$userName.")";
  $body = "Folgende Tipps wurden von dir für den $play. Spieltag gespeichert:";
  
  mail($to, $subject, $body."\n\n".$email_body, $header);
  mail("wettmafia@hwd.bts-computer.de", $subject, $body."\n\n".$email_body, $header);
//  echo "<br>Mail an ".$to." geschickt.";
//  echo "Mail Inhalt: <br>".$email_body;
  

?>

<?PHP

require("bottom.php");

?>
