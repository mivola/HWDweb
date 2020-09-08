<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$str = "Select id from tbl_play where recorded=0 and season=".$season;
$result = mysqli_query($connectedDb, $str);

require("close_db.php");

require("top.php");

?>
<body bgcolor="#000000">
<br><b>Spieltag auswählen</b><br>

<form name="choose_play_form" method="post" action="admin_enter_play1.php">
<p>

<?PHP

$i = 0;
while($row = mysqli_fetch_array($result)) {
  $plays[$i] = $row["id"];
  $i++;
}

if ($i > 0) {
  echo "<select name=play size=1>\n";
  foreach($plays as $play_id){
    echo "<option value=".$play_id.">".$play_id."</option>\n";
  } // foreach
  echo "</select>\n";
  echo "<input type=submit value=\"Spieltag eingeben\">\n";
} else {
  echo "kein entsprechender Spieltag gefunden!";
}

?>

</p>
</form>

<?PHP
require("bottom.php");

?>
