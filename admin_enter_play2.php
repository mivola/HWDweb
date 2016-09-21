<?PHP

session_start();
extract($_SESSION); 

//$playID = $HTTP_POST_VARS["playID"];

// Füllen der Arrays
$dates[1] = $date1; $dates[2] = $date2; $dates[3] = $date3; $dates[4] = $date4; $dates[5] = $date5; $dates[6] = $date6; $dates[7] = $date7; $dates[8] = $date8; $dates[9] = $date9; $dates[10] = $date10; $dates[11] = $date11; $dates[12] = $date12;
$mins[1] = $min1; $mins[2] = $min2; $mins[3] = $min3; $mins[4] = $min4; $mins[5] = $min5; $mins[6] = $min6; $mins[7] = $min7; $mins[8] = $min8; $mins[9] = $min9; $mins[10] = $min10; $mins[11] = $min11; $mins[12] = $min12;
$hours[1] = $hour1; $hours[2] = $hour2; $hours[3] = $hour3; $hours[4] = $hour4; $hours[5] = $hour5; $hours[6] = $hour6; $hours[7] = $hour7; $hours[8] = $hour8; $hours[9] = $hour9; $hours[10] = $hour10; $hours[11] = $hour11; $hours[12] = $hour12;
$teams[1] = $team1; $teams[2] = $team2; $teams[3] = $team3; $teams[4] = $team4; $teams[5] = $team5; $teams[6] = $team6; $teams[7] = $team7; $teams[8] = $team8; $teams[9] = $team9;
$teams[10] = $team10; $teams[11] = $team11; $teams[12] = $team12; $teams[13] = $team13; $teams[14] = $team14; $teams[15] = $team15; $teams[16] = $team16; $teams[17] = $team17; $teams[18] = $team18;
$teams[19] = $team19; $teams[20] = $team20; $teams[21] = $team21; $teams[22] = $team22; $teams[23] = $team23; $teams[24] = $team24;

$email_body = "";
$maxi = 9;
if (! isset($onlyBL)) {
  $maxi = 12;
}
//$date = array($date1, $date2, $date3);
//echo "1: ".$date1."!".$date2."!".$date3."<br>";
//echo "2: ".$dates[1]."!".$dates[2]."!".$dates[3]."<br>";

require("connect_db.php");

$str = "SELECT * from tbl_user";
$users = mysql_query($str);

$result1 = mysql_query("DELETE FROM tbl_game WHERE play=".$play);
if (isset($rueck)) {
  $p = $playID + 17;
  $result1 = mysql_query("DELETE FROM tbl_game WHERE play=".$p);
}


for ($i=1; $i <= $maxi; $i++){

  $date = trim($dates[$i]);
  $min = trim($mins[$i]);
  $hour = trim($hours[$i]);
  $team1 = $teams[$i];
  $team2 = $teams[$i+12];
//echo "3: ".$dates[$i]."!".$dates[$i+1]."!".$dates[$i+2]."<br>";
//echo "<br>!!".$i.":".$date.$min.$hour."!!<br>";
//mktime(8,30,0,5,29,2001)."
  $mktime = mktime($hour, $min, 0, substr($date, 3, 2), substr($date, 0, 2), substr($date, 6, 4));

  $query = "INSERT INTO tbl_game (play, team1, team2, p_ts) VALUES (".$playID.", ".$team1.", ".$team2.", ".$mktime.")";
  $resultBL1[$i] = mysql_query($query);

  if (isset($rueck) && $i < 10) {
    $p = $playID + 17;
    $query = "INSERT INTO tbl_game (play, team1, team2) VALUES (".$p.", ".$team2.", ".$team1.")";
    $resultBL1_rueck[$i] = mysql_query($query);
  }


  //echo "<br>".$query;
}

if (isset($free)) {
  if ($maxi==9) {
    $result1 = mysql_query("UPDATE tbl_play SET recorded=1 WHERE id=".$play);
  }
  else {
    $result1 = mysql_query("UPDATE tbl_play SET recorded=2 WHERE id=".$play);
  }

    //email-adressen sammeln
    $to = "";
    $i = 0;
    while($row = mysql_fetch_array($users)) {
      if ($i > 0) { $to .= ", "; }
      $to .= $row["email"];
      $i++;
    }

//    $subject = "HWD: neuer Spieltag eingegeben";
//    $body = "Der $playID. Spieltag wurde von HWD eingegeben.\n\n";
//    $body .= "Jetzt kannst du deine Tipps unter hwd.michavoigt.de eintragen!";
//    mail($to, $subject, $body, $header);
}
$resultPlayBL1 = mysql_query("Select * from tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.p_ts, g.id");
$resultPlayBL2 = mysql_query("Select * from tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.p_ts, g.id");

// Select * from tbl_game g, tbl_team1 t1, tbl_team2 t2 where play=2 and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1

$resultBL1 = mysql_query("Select * from ".$season."_tbl_team1 where league=1 order by name");
$resultBL2 = mysql_query("Select * from ".$season."_tbl_team1 where league=2 order by name");

// g.team1, t1.name, t2.name
// select * from tbl_game g, tbl_team1 t1 where g.play=1 and t1.id=g.team1
// select * from tbl_game AS g, tbl_team1 AS t1, tbl_team1 AS t2 where g.play=1 and t1.id=g.team1 and t2.id=g.team2

require("close_db.php");

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Folgende Spiele des ".$playID.". Spieltags erfolgreich gespeichert</b><br><br>";

// echo $query;
// echo "<br>".$hour.", ".$min.", 0,".substr($date, 3, 2).", ".substr($date, 0, 2).", ".substr($date, 6, 4);
// echo "<br>".date("d.m.Y H:i:s", $mktime);
// echo "<br>!!".$resultBL1[1]."!!";


?>

  <table border="0">
    <tr><td colspan=4><b>1. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
    </tr>


<?PHP

  $j = 0;
  $email_body .= "1. Liga\n\n";
  for ($j=1; $j<=9; $j++){

    $row = mysql_fetch_array($resultPlayBL1);

    if (bcmod($j, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }

    echo "</tr>\n";
    
    $email_body .= $j." - ".date("d.m.Y", $row["p_ts"])." ".date("H:i", $row["p_ts"]).": ".$row["name"]." - ".$row["name2"]."\n";

  } // for ($j

if ($maxi>9){
?>

    <tr><td colspan=4><br><b>2. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
    </tr>

<?PHP

  $email_body .= "\n\n\n2. Liga\n\n";
  for ($j=10; $j<=12; $j++){

    $row = mysql_fetch_array($resultPlayBL2);

    if (bcmod($j, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";    
    
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }

    echo "</tr>\n";

    $email_body .= $j." - ".date("d.m.Y", $row["p_ts"])." ".date("H:i", $row["p_ts"]).": ".$row["name"]." - ".$row["name2"]."\n";

  } // for ($j

} // if ($maxi<9)

?>

  </table>


<?PHP

if (isset($free)) {
  echo "<br>Dieser Spieltag wurde freigegeben. Tipps können jetzt eingegeben werden.";

  $header = "From: HWD<michael.voigt@web.de>\n";
  $header .= "Reply-To: HWD<michael.voigt@web.de>\n";

  $subject = "HWD: neuer Spieltag eingegeben";
  $body = "Der $playID. Spieltag wurde von HWD eingegeben.\n\n";
  $body .= "Jetzt kannst du deine Tipps unter hwd.michavoigt.de eintragen!\n\n";
  $body .= "Damit im Notfall auch jeder die richtigen Spielansetzungen hat, gibt es diese ab jetzt per Email:\n";
  mail($to, $subject, $body."\n\n".$email_body, $header);
  //echo $email_body;

}

require("bottom.php");

?>
