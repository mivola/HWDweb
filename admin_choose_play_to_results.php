<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

// SELECT g.play, max(g.p_ts) FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 GROUP BY g.play
// $str = "Select id from tbl_play where recorded=0 and season=".$season;
//$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 GROUP BY g.play";
$str = "SELECT g.play AS play, min(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND p.completed=0 AND season=".$season." GROUP BY g.play";
$result = mysql_query($str);

require("close_db.php");

require("top.php");

?>
<body bgcolor="#000000">
<br><b>Spieltag auswählen</b><br>

<form name="choose_play_form" method="post" action="admin_enter_results1.php">
<p>


<?PHP

$t = mktime() - 7200;
$i = 0;
while($row = mysql_fetch_array($result)) {
  if ($row["p_ts"] < $t){
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
  echo "<input type=submit value=\"Resultate eingeben\">\n";
} else {
  echo "kein entsprechender Spieltag gefunden!";
}

?>


</p>
</form>

<?PHP

require("bottom.php");

?>
