<?PHP
session_start();
extract($_POST);
extract($_SESSION);

require("connect_db.php");

// zum bearbeiten: Select distinct tbl_play.id from tbl_game, tbl_play, tbl_bet where tbl_game.play=tbl_play.id and tbl_bet.game=tbl_game.id and recorded>0 and season=2 and tbl_bet.userID=1
$str = "SELECT id FROM tbl_play WHERE recorded > 0 AND completed = 0 AND season=".$season;
$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=".$season." GROUP BY g.play";
//$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=".$season." AND p.id=3 AND p_ts<SYSDATE() GROUP BY g.play";
//$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM 4_tbl_play p, 4_tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=4 AND p.id=3 AND p_ts<SYSDATE() GROUP BY g.play";
$result = mysqli_query($connectedDb, $str);

require("close_db.php");

require("top.php");

?>
<body bgcolor="#000000">
<br><b>Spieltag auswählen</b><br>

<form name="choose_play_form" method="post" action="user_enter_play1.php">
<p>

<?PHP

$t = mktime() - 3600; // 1 Stunde vor Spielbeginn
$t = mktime() - 60 * 2; // 2 Minuten vor Spielbeginn
$i = 0;
while($row = mysqli_fetch_array($result)) {
  if ($row["p_ts"] > $t){
    $plays[$i] = $row["play"];
    $i++;
  }
}

if ($i > 0) {
  echo "<select name=play size=1>\n";
  foreach($plays as $play_id){
    echo "<option value=".$play_id.">".$play_id."</option>\n";
  } // foreach
  echo "</select>\n";
  echo "<input type=submit value=\"Tipps eingeben\">\n";
} else {
  echo "kein entsprechender Spieltag gefunden!";
}

?>

</p>
</form>

<?PHP
require("bottom.php");

?>
