<?PHP

session_start();
extract($_SESSION); 

//$playID = $HTTP_POST_VARS["playID"];

// Füllen der Arrays
$results[1] = $res1; $results[2] = $res2; $results[3] = $res3; $results[4] = $res4; $results[5] = $res5; $results[6] = $res6; $results[7] = $res7; $results[8] = $res8; $results[9] = $res9;
$results[10] = $res10; $results[11] = $res11; $results[12] = $res12; $results[13] = $res13; $results[14] = $res14; $results[15] = $res15; $results[16] = $res16; $results[17] = $res17; $results[18] = $res18;
$results[19] = $res19; $results[20] = $res20; $results[21] = $res21; $results[22] = $res22; $results[23] = $res23; $results[24] = $res24;
$games[1] = $game1; $games[2] = $game2; $games[3] = $game3; $games[4] = $game4; $games[5] = $game5; $games[6] = $game6; $games[7] = $game7; $games[8] = $game8; $games[9] = $game9;
$games[10] = $game10; $games[11] = $game11; $games[12] = $game12;
$play = $playID;

for ($i=1; $i <= 24; $i++){
  if ($results[$i] == ""){
    $results[$i] = -1;
  }
}

require("connect_db.php");

$str = "SELECT * from tbl_user";
$users_email = mysql_query($str);

$resultUsers = mysql_query("SELECT * FROM tbl_user ORDER BY id");

for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){
  $row = mysql_fetch_array($resultUsers);
//while($row = mysql_fetch_array($resultUsers)){
  $users[$i] = $row["id"];
  $user_names[$i] = $row["nick_name"];
  $user_show_tipps[$i] = $row["show_tipps"];
  $points[$users[$i]] = 0;
  //echo $users[$i]."!<br>";
} //for

$max_points = 0;

for ($i=1; $i <= 12; $i++){

  $k = $i + 12;
  $res1 = $results[$i];
  $res2 = $results[$k];
  $game = $games[$i];
  $query = "UPDATE tbl_game SET result1=".$res1.", result2=".$res2." WHERE id=".$game;
  //echo $query."<br>\n";
  $resultBL1[$i] = mysql_query($query);

  //echo "<br>".$query;

  //if (isset($free)){ // alle Punkte und Gewinner berechnen !!!

    foreach ($users as $userid){
      $user_points = 0;
      $all_points[$userid][$i] = "";
      $user_bets[$userid][$i] = "";
      $user_bets2[$userid][$i][0] = -1;
      $user_bets2[$userid][$i][1] = -1;

      $query = "SELECT * from tbl_game g, tbl_bet b WHERE g.id=b.game AND b.game=".$game." AND b.userID=".$userid;
      $bets = mysql_query($query);
      $row = mysql_fetch_array($bets);
      $bet1 = $row["bet1"];
      $bet2 = $row["bet2"];
      if ($bet1 == "") { $bet1 = -1; }
      if ($bet2 == "") { $bet2 = -1; }
      if ($res1 == "") { $res1 = -1; }
      if ($res2 == "") { $res2 = -1; }

      $user_bets2[$userid][$i][0] = $bet1;
      $user_bets2[$userid][$i][1] = $bet2;

      if (($bet1 > -1) && ($bet2 > -1)) {
        $user_bets[$userid][$i] = $bet1." : ".$bet2;
      }

      if (($bet1 > -1) && ($bet2 > -1) && ($res1 > -1) && ($res2 > -1)) {

        $diff_bet = $bet1 - $bet2;
        $diff_res = $res1 - $res2;
        $user_bets[$userid][$i] = $bet1." : ".$bet2;
        $user_bets2[$userid][$i][0] = $bet1;
        $user_bets2[$userid][$i][1] = $bet2;

        if ( ($bet1 == $res1) && ($bet1 == $res1) ) { $user_points = 3; }
        else {
          if ( (($bet1 > $res1) && ($bet1 > $res1)  ) ||
               (($bet1 < $res1) && ($bet1 < $res1)  ) ||
               (($bet1 == $bet2) && ($res1 == $res2)) ) {
            $user_points = 1;
          }

        } // if bet1=bet2

            // Unentschieden            // selbe Tendenz
        if ( ($diff_res == $diff_bet) || ($diff_res * $diff_bet > 0) ){
	  if ($bet1 == $res1 && $bet2 == $res2){
	    $user_points = 3;
	  }
	  else{
	    $user_points = 1;
	  }
        } else { // if diff_bet
          $user_points = 0;
        } // if diff_bet

      } // if ($bet1 > -1 && $bet2 > -1 && $res1 > -1 && $res2 > -1)

      $all_points[$userid][$i] = $user_points;
      $points[$userid] = $points[$userid] + $user_points;
      if ($points[$userid] > $max_points) { $max_points = $points[$userid]; }
      //echo "spieler: ".$userid."; Spiel: ".$game."; Ergebnis: ".$res1.":".$res2." Tipp: ".$bet1.":".$bet2." => ".$user_points."<br>";



    } // loop players



//  } //if isset(free)


} //for i / loop games

if (isset($free)) {
  if ($free > -1) {
    // Points und Win-Punkte eintragen
    foreach ($users as $userid){
      //echo "<br><br>spieler: ".$userid."; punkte: ".$points[$userid];
      mysql_query("DELETE FROM tbl_points WHERE play=".$play." AND userID=".$userid);
      $query = "INSERT INTO tbl_points (play, userID, points) VALUES (".$play.", ".$userid.", ".$points[$userid].")";
      mysql_query($query);
      mysql_query("DELETE FROM tbl_wins WHERE play=".$play." AND userID=".$userid);
      if ($max_points == $points[$userid]){
        $query = "INSERT INTO tbl_wins (play, userID, wins) VALUES (".$play.", ".$userid.", 1)";
        mysql_query($query);
      } else {
        $query = "INSERT INTO tbl_wins (play, userID, wins) VALUES (".$play.", ".$userid.", 0)";
        mysql_query($query);
      } // if ($max_points == $points[$userid]){
    } // foreach
    mysql_query("UPDATE tbl_play SET completed=1 WHERE id=".$play);

    $header = "From: HWD<michael.voigt@web.de>\n";
    $header .= "Reply-To: HWD<michael.voigt@web.de>\n";

    $to = "";
    $i = 0;
    while($row = mysql_fetch_array($users_email)) {
      if ($i > 0) { $to .= ", "; }
      $to .= $row["email"];
      $i++;
    }

    $subject = "HWD: Ergebnisse eingegeben";
    $body = "Die Ergebnisse des $playID. Spieltags wurden von HWD eingegeben.\n\n";
    $body .= "Die genaue Auswertung kannst du unter hwd.michavoigt.de abrufen!";
    mail($to, $subject, $body, $header);


  } // if ($free > -1)
} // if (isset($free))

//$resultPlayBL1 = mysql_query("Select * from tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id");
$resultPlayBL1 = mysql_query("SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 WHERE play=".$play." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=1 ORDER BY g.p_ts, g.id");
$resultPlayBL2 = mysql_query("SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 WHERE play=".$play." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=2 ORDER BY g.p_ts, g.id");

require("close_db.php");

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Folgende Ergebnisse des ".$playID.". Spieltags erfolgreich gespeichert</b><br><br>";

?>

  <table border="0">
    <tr><td colspan=4><b>1. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
<?PHP
  if ($show_long == 1) {
?>
      <td valign=top><b>Sp.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
<?PHP
  }
?>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Erg.</b></td>
      <?PHP
      foreach ($user_names as $username){
        echo "<td valign=top><b>".$username."</b></td>";
      }
      ?>
    </tr>

<?PHP

  $j = 0;
  for ($j=1; $j<=9; $j++){
    $k = $j + 12;

    $row = mysql_fetch_array($resultPlayBL1);
    if (bcmod($j, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";

    if ($show_long == 1) {
      echo "<td>".$j.".</td>";
      echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
      echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    }
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }
    echo "<td>";
    if ($row["result1"] > -1){
      echo $row["result1"]." : ";
    } else {
      echo "&nbsp;&nbsp; : ";
    }

    if ($row["result2"] > -1){
      echo $row["result2"];
    }

    // userpunkte angeben
    foreach ($users as $userid){

      if (bcmod($userid, 2) == 1) {
        if (bcmod($j, 2) == 1) { $style = $table_colA; }
        else { $style = $table_colB; }
      }
      else {
        if (bcmod($j, 2) == 1) { $style = $table_lineA; }
        else { $style = $table_lineB; }
      }

      // spiel schon angefangen
      if (($row["p_ts"] - mktime()) < 3600) {
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
            if (($results[$j] > -1) && ($results[$k] > -1)) {
              echo " (<b>".$all_points[$userid][$j]."</b>)";
            } //  if (($results[$j] > -1) && ($results[$k] > -1))
          } // if ($user_bets[$userid][$j] == "")
          echo "</td>\n";
      } else {
      // ergebnisse schon eingetragen
      if (($results[$j] > -1) && ($results[$k] > -1)) {

        if ($user_bets[$userid][$j] == "") {
          echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
        } else {
          echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
          echo " (<b>".$all_points[$userid][$j]."</b>)";
          echo "</td>\n";
        }
      } // if (($results[$j] > -1) && ($results[$k] > -1)) {
      else { // ergebnisse noch nicht eingetragen
      switch($user_show_tipps[$userid]){
        case 0:
          echo "<td style=\"background-color:".$style.";\">top secret</td>\n";
          break;
        case 1:
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">noch nicht</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">abgegeben</td>\n";
          }
          break;
        case 2:
          echo "<td style=\"background-color:".$style.";\">";
          $diff = $user_bets2[$userid][$j][0] - $user_bets2[$userid][$j][1];
          if ($user_bets2[$userid][$j][0] > -1 && $user_bets2[$userid][$j][1] > -1) {

            if ($diff == 0) { echo "Unent"; }
            if ($diff > 0) { echo "Heim"; }
            if ($diff < 0) { echo "Gast"; }
          } else {
            echo "noch nicht";
          } // if

          //.$user_bets[$userid][$j]."/".$diff.
          echo "</td>\n";
          break;
        case 3:

      if ($user_bets[$userid][$j] == "") {
        echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; -</td>\n";
      } else {
        echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
        if (($results[$j] > -1) && ($results[$k] > -1)) {
          echo " (<b>".$all_points[$userid][$j]."</b>)";
        }
        echo "</td>\n";
      }
          break;
      } // switch
      } // if (($results[$j] > -1) && ($results[$k] > -1)) {
      } // if (($row["p_ts"] - mktime()) < 3600)
    } // foreach

    echo "</td>";

    echo "</tr>\n";

  } // for ($j

?>

    <tr><td colspan=4><br><b>2. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
<?PHP
  if ($show_long == 1) {
?>
      <td valign=top><b>Sp.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
<?PHP
  }
?>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Erg.</b></td>
      <?PHP
      foreach ($user_names as $username){
        echo "<td></td>";
      }
      ?>
    </tr>

<?PHP

  for ($j=10; $j<=12; $j++){
    $k = $j + 12;

    $row = mysql_fetch_array($resultPlayBL2);
    if (bcmod($j, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";

    if ($show_long == 1) {
      echo "<td>".$j.".</td>";
      echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
      echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    }
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }
    echo "<td>";
    if ($row["result1"] > -1){
      echo $row["result1"]." : ";
    } else {
      echo "&nbsp;&nbsp; : ";
    }

    if ($row["result2"] > -1){
      echo $row["result2"];
    }

    // userpunkte angeben
    foreach ($users as $userid){

      if (bcmod($userid, 2) == 1) {
        if (bcmod($j, 2) == 1) { $style = $table_colA; }
        else { $style = $table_colB; }
      }
      else {
        if (bcmod($j, 2) == 1) { $style = $table_lineA; }
        else { $style = $table_lineB; }
      }

      // spiel schon angefangen
      if (($row["p_ts"] - mktime()) < 3600) {
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
            if (($results[$j] > -1) && ($results[$k] > -1)) {
              echo " (<b>".$all_points[$userid][$j]."</b>)";
            } //  if (($results[$j] > -1) && ($results[$k] > -1))
          } // if ($user_bets[$userid][$j] == "")
          echo "</td>\n";
      } else {
      // ergebnisse schon eingetragen
      if (($results[$j] > -1) && ($results[$k] > -1)) {

        if ($user_bets[$userid][$j] == "") {
          echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
        } else {
          echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
          echo " (<b>".$all_points[$userid][$j]."</b>)";
          echo "</td>\n";
        }
      } // if (($results[$j] > -1) && ($results[$k] > -1)) {
      else { // ergebnisse noch nicht eingetragen
      switch($user_show_tipps[$userid]){
        case 0:
          echo "<td style=\"background-color:".$style.";\">top secret</td>\n";
          break;
        case 1:
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">noch nicht</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">abgegeben</td>\n";
          }
          break;
        case 2:
          echo "<td style=\"background-color:".$style.";\">";
          $diff = $user_bets2[$userid][$j][0] - $user_bets2[$userid][$j][1];
          if ($user_bets2[$userid][$j][0] > -1 && $user_bets2[$userid][$j][1] > -1) {

            if ($diff == 0) { echo "Unent"; }
            if ($diff > 0) { echo "Heim"; }
            if ($diff < 0) { echo "Gast"; }
          } else {
            echo "noch nicht";
          } // if

          //.$user_bets[$userid][$j]."/".$diff.
          echo "</td>\n";
          break;
        case 3:

      if ($user_bets[$userid][$j] == "") {
        echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; -</td>\n";
      } else {
        echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
        if (($results[$j] > -1) && ($results[$k] > -1)) {
          echo " (<b>".$all_points[$userid][$j]."</b>)";
        }
        echo "</td>\n";
      }
          break;
      } // switch
      } // if (($results[$j] > -1) && ($results[$k] > -1))
      } // if (($row["p_ts"] - mktime()) < 3600)
    } // foreach

    echo "</td>";
    echo "</tr>\n";


  } // for ($j

  // Punkte zusammenfassen
  if ($show_long == 1) { $cols = 6; }
  else { $cols = 3; }
  echo "<tr><td colspan=".$cols." align=right><b>Gesamtpunkte:</b></td>";
  foreach ($users as $userid){
    if (bcmod($userid, 2) == 0) { $bgcolor = "#ffffcc"; }
    else { $bgcolor = "#ffffff"; }
    if (bcmod($userid, 2) == 0) { $bgcolor = "#ffffcc"; }
    else { $bgcolor = "#ffffff"; }


    if (bcmod($userid, 2) == 0) { $style = $table_colA; }
    else { $style = $table_lineA; }

    if (($max_points == $points[$userid]) && ($max_points > 0)){
      $style = $table_max_points;
    }

    echo "<td style=\"background-color:".$style.";\" align=right><b>".$points[$userid]."</b></td>";

  }
  echo "</tr>\n";
  echo "<tr><td colspan=5>Emails gesendet an: $to</td></tr>\n";

?>

  </table>


<?PHP

require("bottom.php");

?>
