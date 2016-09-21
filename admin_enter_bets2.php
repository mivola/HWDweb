<?PHP

session_start();
extract($_SESSION); 

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

$play = $playID;

$maxi = 12;
for ($i=1; $i <= $maxi; $i++){

  $game = $games[$i];
  $bet1 = trim($bets[$i]);
  $bet2 = trim($bets[$i+12]);
  if ($bet1 == "") { $bet1 = "-1"; }
  if ($bet2 == "") { $bet2 = "-1"; }
  $result1 = mysql_query("DELETE FROM ".$season."_tbl_bet WHERE game=".$game." AND userID=".$new_user_id);
  $query = "INSERT INTO ".$season."_tbl_bet (userID, game, bet1, bet2, bet_ts) VALUES (".$new_user_id.", ".$game.", ".$bet1.", ".$bet2.", ".time().")";
  //echo $query;
  $resultBets[$i] = mysql_query($query);

  //echo "<br>".$query;
}


//Select * from ".$season."_tbl_bet b, ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=1 and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id
//$resultPlayBL1 = mysql_query("Select * from ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1");
$resultPlayBL1 = mysql_query("Select * from ".$season."_tbl_bet b, ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id and b.userID=".$new_user_id." order by g.id");
$resultPlayBL2 = mysql_query("Select * from ".$season."_tbl_bet b, ".$season."_tbl_game g, ".$season."_tbl_team1 t1, ".$season."_tbl_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 and b.game=g.id and b.userID=".$new_user_id." order by g.id");
$username = mysql_fetch_row(mysql_query("SELECT nick_name from ".$season."_tbl_user WHERE id=".$new_user_id));

//$resultBL1 = mysql_query("Select * from ".$season."_tbl_team1 where league=1 order by name");
//$resultBL2 = mysql_query("Select * from ".$season."_tbl_team1 where league=2 order by name");

$maxi = 9;
if (mysql_num_rows($resultPlayBL2) > 0) {
  $maxi = 12;
}

//require("connect_db.php");

require("close_db.php");

require("top.php");

echo "<body bgcolor=#000000><br><b>Folgende Tipps wurden f&uuml;r <font color=red>".$username[0]."</font> f&uuml;r den ".$playID.". Spieltag eingetragen:</b><br><br>";

?>

  <table border="0">
    <tr><td colspan=4><b>1. Bundesliga</b></td></tr>
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
  for ($j=1; $j<=9; $j++){

    $row = mysql_fetch_array($resultPlayBL1);
    if (bcmod($j, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";
    $k = $j + 12;
    if ($row["bet1"] > -1){
      echo "<td>".$row["bet1"]." : ".$row["bet2"]."</td>\n";
    } else {
      echo "<td>nicht getippt</td>\n";
    }
    echo "</tr>\n";


  } // for ($j

//if ($maxi>9){
?>

    <tr><td colspan=4><br><b>2. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Tipp</b></td>
    </tr>

<?PHP

  for ($j=10; $j<=12; $j++){

    $row = mysql_fetch_array($resultPlayBL2);
    if (bcmod($j, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";

    if ($row["bet1"] > -1){
      echo "<td>".$row["bet1"]." : ".$row["bet2"]."</td>\n";
    } else {
      echo "<td>nicht getippt</td>\n";
    }

    //echo "<td>".$row["bet1"]." : ".$row["bet2"]."</td>\n";
    echo "</tr>\n";


  } // for ($j

//} // if ($maxi>9)

?>

  </table>

<?PHP

require("bottom.php");

?>
