<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

//$str = "SELECT id FROM tbl_play WHERE recorded > 0 AND season=".$season;
$str = "SELECT g.play AS play, min(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND season=".$season." GROUP BY g.play ORDER BY g.play DESC";
$result = mysql_query($str);

require("close_db.php");

require("top.php");

?>
<body>
<br><b>Spieltag auswählen</b><br>

<form name="choose_play_form" method="post" action="user_show_all_bets.php">
<p>

<?PHP

$i = 0;
while($row = mysql_fetch_array($result)) {
  $plays[$i] = $row["play"];
  $i++;
}

if ($i > 0) {
  echo "<select name=play size=1>\n";
  foreach($plays as $play_id){
    echo "<option value=".$play_id.">".$play_id."</option>\n";
  } // foreach
  echo "</select>\n";
  echo "<input type=submit value=\"Tipps anzeigen\">\n";
} else {
  echo "kein entsprechender Spieltag gefunden!";
}

?>

</p>
</form>

<?PHP
require("bottom.php");

?>
