<?PHP

session_start();
extract($_SESSION); 

require("connect_db.php");

$resultUsers = mysql_query("SELECT * FROM ".$season."_tbl_user ORDER BY id");
for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){
  $row = mysql_fetch_array($resultUsers);
  $users[$i] = $row["id"];
  $user_names[$i] = $row["nick_name"];
  $user_show_tipps[$i] = $row["show_tipps"];
  if ($row["id"] == $act_userid) { $user_show_tipps[$i] = 3; }
  $points[$users[$i]] = 0;
  //echo $users[$i]."!<br>";
} //for

$max_points = 0;

$str_resultPlayBL1 = "SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 WHERE play=".$_REQUEST[play]." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=1 ORDER BY g.p_ts, g.id";
$str_resultPlayBL2 = "SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 WHERE play=".$_REQUEST[play]." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=2 ORDER BY g.p_ts, g.id";
$resultPlayBL1 = mysql_query($str_resultPlayBL1);
$resultPlayBL2 = mysql_query($str_resultPlayBL2);

for ($i = 1; $i <= mysql_num_rows($resultPlayBL1); $i++){
  $row = mysql_fetch_array($resultPlayBL1);
  $games[$i] = $row["id"];
  $team1[$i] = $row["name"];
  $team2[$i] = $row["name2"];
  $p_tss[$i] = $row["p_ts"];
  if (isset($row["result1"])) { $results[$i] = $row["result1"]; }
  else { $results[$i] = -1; }
  $k = $i + 12;
  if (isset($row["result2"])) { $results[$k] = $row["result2"]; }
  else { $results[$k] = -1; }
}

for ($i = 10; $i < 13; $i++){
  $row = mysql_fetch_array($resultPlayBL2);
  $games[$i] = $row["id"];
  $team1[$i] = $row["name"];
  $team2[$i] = $row["name2"];
  $p_tss[$i] = $row["p_ts"];
  if (isset($row["result1"])) { $results[$i] = $row["result1"]; }
  else { $results[$i] = -1; }
  $k = $i + 12;
  if (isset($row["result2"])) { $results[$k] = $row["result2"]; }
  else { $results[$k] = -1; }
}

for ($i=1; $i <= 12; $i++){

  $k = $i + 12;
  $res1 = $results[$i];
  $res2 = $results[$k];
  $game = $games[$i];



    foreach ($users as $userid){
      $user_points = 0;
      $all_points[$userid][$i] = "";
      $user_bets[$userid][$i] = "";
      $user_bets2[$userid][$i][0] = -1;
      $user_bets2[$userid][$i][1] = -1;

      $query = "SELECT * from ".$season."_tbl_game g, ".$season."_tbl_bet b WHERE g.id=b.game AND b.game=".$game." AND b.userID=".$userid;
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
/*
        if ( ($bet1 == $res1) && ($bet1 == $res1) ) { $user_points = 3; }
        else {
          if ( (($bet1 > $res1) && ($bet1 > $res1)  ) ||
               (($bet1 < $res1) && ($bet1 < $res1)  ) ||
               (($bet1 == $bet2) && ($res1 == $res2)) ) {
            $user_points = 1;
          } // if

        } // if bet1=bet2
*/
              // Unentschieden, richtige tendenz mit gleicher tordifferenz
                                          // selbe Tendenz
        if ( ($diff_res == $diff_bet) || ($diff_res * $diff_bet > 0) ){
	  if ($bet1 == $res1 && $bet2 == $res2){ //richtiges Ergebniss
	    $user_points = 3;
	  } else{
	    if ( ($diff_res == $diff_bet) && ($diff_bet != 0) ) {
	      $user_points = 2; //richtige Tendenz und Tordifferenz
	    } else {
	      $user_points = 1; //Unentschieden oder richtige Tendenz
	    } // if
	  } // if
        } else { // if diff_res==diff_bet
          $user_points = 0;
        } // if diff_bet

      } // if ($bet1 > -1 && $bet2 > -1 && $res1 > -1 && $res2 > -1)

      $all_points[$userid][$i] = $user_points;
      $points[$userid] = $points[$userid] + $user_points;
      if ($points[$userid] > $max_points) { $max_points = $points[$userid]; }
      //echo "spieler: ".$userid."; Spiel: ".$game."; Ergebnis: ".$res1.":".$res2." Tipp: ".$bet1.":".$bet2." => ".$user_points."<br>";



    } // loop players

} //for i / loop games

//$resultPlayBL1 = mysql_query("SELECT g.id, t1.name, t2.name2, p_ts, result1, result2 from ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 WHERE play=".$play." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=1 ORDER BY g.id");
//$resultPlayBL2 = mysql_query("SELECT g.id, t1.name, t2.name2, p_ts, result1, result2 from ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 WHERE play=".$play." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=2 ORDER BY g.id");
$resultPlayBL1 = mysql_query($str_resultPlayBL1);
$resultPlayBL2 = mysql_query($str_resultPlayBL2);


require("close_db.php");

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Tipps und Ergebnisse des ".$play.". Spieltags:</b><br><br>";
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
//    if ($row["result1"] > -1){
//      echo $row["result1"]." : ";
    if ($results[$j] > -1){
      echo $results[$j]." : ";
    } else {
      echo "&nbsp;&nbsp; : ";
    }

//    if ($row["result2"] > -1){
//      echo $row["result2"];
    if ($results[$k] > -1){
      echo $results[$k];
    }
    echo "</td>\n";

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
      } // if (($row["p_ts"] - mktime()) < 3600) {
    } // foreach

    echo "</td>";

    echo "</tr>\n";

  } // for ($j

?>

    <tr></tr><tr></tr><tr></tr>
    <tr><td colspan=4><b>2. Bundesliga</b></td></tr>
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
//    if ($row["result1"] > -1){
//      echo $row["result1"]." : ";
    if ($results[$j] > -1){
      echo $results[$j]." : ";
    } else {
      echo "&nbsp;&nbsp; : ";
    }

//    if ($row["result2"] > -1){
//      echo $row["result2"];
    if ($results[$k] > -1){
      echo $results[$k];
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

    if (bcmod($userid + $show_long, 2) == 0) { $style = $table_colA; }
    else { $style = $table_lineA; }

    if (($max_points == $points[$userid]) && ($max_points > 0)){
      $style = $table_max_points;
    }

    echo "<td style=\"background-color:".$style.";\" align=right><b>".$points[$userid]."</b></td>";

  }
  echo "</tr>";

?>

  </table>


<?PHP

require("bottom.php");

?>
