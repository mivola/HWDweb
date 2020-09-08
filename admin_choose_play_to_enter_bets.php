<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

// zum bearbeiten: Select distinct tbl_play.id from tbl_game, tbl_play, tbl_bet where tbl_game.play=tbl_play.id and tbl_bet.game=tbl_game.id and recorded>0 and season=2 and tbl_bet.userID=1
$str = "SELECT id FROM tbl_play WHERE recorded > 0 AND completed = 0 AND season=".$season;
$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=".$season." GROUP BY g.play";
$result = mysqli_query($connectedDb, $str);

$str = "SELECT * from tbl_user";
$users = mysqli_query($connectedDb, $str);

require("close_db.php");

require("top.php");

?>
<body bgcolor="#000000">
<br><b>Spieler und Spieltag ausw&auml;hlen</b><br>

<form name="choose_play_form" method="post" action="admin_enter_bets1.php">
<p>

<?PHP

$i = 0;
while($row = mysqli_fetch_array($result)) {
  $plays[$i] = $row["play"];
  $i++;
}

if ($i > 0) {
  echo "<select name=new_user_id size=1>\n";
  while($row = mysqli_fetch_array($users)) {
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
