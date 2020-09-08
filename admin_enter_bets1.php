<?PHP
session_start();
extract($_SESSION);

$play = $_POST["play"];
$new_user_id = $_POST["new_user_id"];
//$play = $HTTP_POST_VARS["play"];
//$new_user_id = $HTTP_POST_VARS["new_user_id"];
$_SESSION['new_user_id']=$new_user_id;

require("connect_db.php");

$bets1=1;
// mit bet: Select * from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=1 and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id
$resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id and b.userID=".$new_user_id." order by g.id");
// SELECT g.id, g.p_ts, t1.name, t2.name2, b.bet1, g.bet2 FROM tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where g.play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id order by g.id
if (mysqli_num_rows($resultPlayBL1) < 9) {
//if (mysqli_num_rows($resultPlayBL1) == 0) {
  $bets1=0;
  // SELECT g.id, g.p_ts, t1.name, t2.name2 FROM tbl_game g, tbl_team t1, view_team2 t2 where g.play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id
  $resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id");
}

$bets2=1;
$resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 and b.game=g.id and b.userID=".$new_user_id." order by g.id");
if (mysqli_num_rows($resultPlayBL2) == 0) {
  $bets2=0;
  $resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.id");
}

//$resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 and b.game=g.id");
//$resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2");

$resultBL1 = mysqli_query($connectedDb, "Select * from tbl_team where league=1 order by name");
$resultBL2 = mysqli_query($connectedDb, "Select * from tbl_team where league=2 order by name");
$username = mysqli_fetch_row(mysqli_query($connectedDb, "SELECT nick_name from tbl_user WHERE id=".$new_user_id));

require("close_db.php");

$maxi = 9;
if (mysqli_num_rows($resultPlayBL2) > 0) {
  $maxi = 12;
}

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Tipps f&uuml;r <font color=red>".$username[0]."</font> f&uuml;r den ".$play.". Spieltag eintragen:</b><br><br>";

?>

<script src="js/chkForm.js" type="text/javascript"></script>

<form name="play" method="post" action="admin_enter_bets2.php" onSubmit="return chk_user_play1()">
<input name="new_user_id" type=hidden value=<?PHP echo $new_user_id ?>>
<input name=playID type=hidden value=<?PHP echo $play ?>>
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

    $row = mysqli_fetch_array($resultPlayBL1);

    if ($bets1 > 0){
      $game=$row["game"];
    }
    else{
      $game=$row[0];
    }

    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td><input type=hidden name=game".$j." value=".$game.">".$j.".</td>\n";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";
    $k = $j + 12;

    $bet1 = "";
    $bet2 = "";

    if (isset($row["bet1"])) { $bet1 = $row["bet1"]; }
    if (isset($row["bet2"])) { $bet2 = $row["bet2"]; }
    if ($bet1 == "-1") { $bet1 = ""; }
    if ($bet2 == "-1") { $bet2 = ""; }

    echo "<td><input type=text maxlength=2 size=2 name=bet".$j;

    if ($bets1>0) {
      echo " value=".$bet1;
    }
    echo "> : <input type=text maxlength=2 size=2 name=bet".$k;
    if ($bets1>0) {
      echo " value=".$bet2;
    }
    echo "></td>\n";

    echo "</tr>\n";


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
      <td valign=top><b>Tipp</b></td>
    </tr>

<?PHP

  for ($j=10; $j<=12; $j++){

    $row = mysqli_fetch_array($resultPlayBL2);

    if ($bets2 > 0){
      $game=$row["game"];
    }
    else{
      $game=$row[0];
    }

    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td><input type=hidden name=game".$j." value=".$game.">".$j.".</td>\n";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";
    $k = $j + 12;
    //echo "<td><input type=text maxlength=2 size=2 name=bet".$j."> : <input type=text maxlength=2 size=2 name=bet".$k."></td>\n";

    $bet1 = "";
    $bet2 = "";

    if (isset($row["bet1"])) { $bet1 = $row["bet1"]; }
    if (isset($row["bet2"])) { $bet2 = $row["bet2"]; }
    if ($bet1 == "-1") { $bet1 = ""; }
    if ($bet2 == "-1") { $bet2 = ""; }

    echo "<td><input type=text maxlength=2 size=2 name=bet".$j;
    if ($bets1>0) {
      echo " value=".$bet1;
    }
    echo "> : <input type=text maxlength=2 size=2 name=bet".$k;
    if ($bets1>0) {
      echo " value=".$bet2;
    }
    echo "></td>\n";
    echo "</tr>\n";


  } // for ($j

} // if ($maxi>9)
  //<tr><td colspan=5 align=right><br>nur 1. Liga speichern<input type=checkbox name="onlyBL"></td><td align=right><br><input type="submit" name="Submit" value="Spieltag speichern"></td></tr>
  ?>

  <tr><td colspan=6 align=right><br><input type="submit" name="Submit" value="Tipps speichern"></td></tr>
  </table>
</form>

<?PHP

require("bottom.php");

?>
