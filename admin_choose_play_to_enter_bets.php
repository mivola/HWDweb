<?PHP

session_start();
extract($_SESSION); 

require("connect_db.php");

// zum bearbeiten: Select distinct ".$season."_tbl_play.id from ".$season."_tbl_game, ".$season."_tbl_play, ".$season."_tbl_bet where ".$season."_tbl_game.play=".$season."_tbl_play.id and ".$season."_tbl_bet.game=".$season."_tbl_game.id and recorded>0 and season=2 and ".$season."_tbl_bet.userID=1
$str = "SELECT id FROM ".$season."_tbl_play WHERE recorded > 0 AND completed = 0 AND season=".$season;
$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM ".$season."_tbl_play p, ".$season."_tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=".$season." GROUP BY g.play";
$result = mysql_query($str);

$str = "SELECT * from ".$season."_tbl_user";
$users = mysql_query($str);

require("close_db.php");

require("top.php");

?>
<body bgcolor="#000000">
<br><b>Spieler und Spieltag ausw&auml;hlen</b><br>

<form name="choose_play_form" method="post" action="admin_enter_bets1.php">
<p>

<?PHP

$i = 0;
while($row = mysql_fetch_array($result)) {
  $plays[$i] = $row["play"];
  $i++;
}

if ($i > 0) {
  echo "<select name=new_user_id size=1>\n";
  while($row = mysql_fetch_array($users)) {
    if ($act_userid != $row["id"]) {
      echo "<option value=".$row["id"].">".$row["nick_name"]."</option>\n";
    }
  }
  echo "</select>\n";

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
