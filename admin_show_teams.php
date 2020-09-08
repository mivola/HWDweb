<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$resultBL1 = mysqli_query($connectedDb, "SELECT * FROM tbl_team WHERE league=1 ORDER BY id");
$resultBL2 = mysqli_query($connectedDb, "SELECT * FROM tbl_team WHERE league=2 ORDER BY id");
$resultPlays = mysqli_query($connectedDb, "SELECT * FROM tbl_play WHERE recorded>0");

require("close_db.php");

require("top.php");

?>

<body bgcolor="#000000">
<br><b>Teams verwalten</b><br><br>
<form name=admin_teams method=post action=admin_save_teams.php onSubmit="return chk_admin_teams()">
<table border="0">
    <tr><td colspan=3><b>1. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>ID</b></td>
      <td valign=top><b>Teamname</b></td>
      <td valign=top><b>Teamk&uuml;rzel</b></td>
    </tr>

<?PHP

while($row = mysqli_fetch_array($resultBL1)) {

  if (($row["id"] % 2) == 1) { $style = $table_lineA; }
  else { $style = $table_lineB; }

  echo "<tr style=\"background-color:".$style.";\">";

  echo "<td>".$row["id"]."</td>\n";
  echo "<td><input type=text name=name".$row["id"]." value=\"".$row["name"]."\" size=30></td>\n";
  echo "<td><input type=text name=short".$row["id"]." value=\"".$row["short"]."\" size=10 maxlength=6></td>\n";
  echo "</tr>\n";

} // while

?>

    <tr><td colspan=3><b>2. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>ID</b></td>
      <td valign=top><b>Teamname</b></td>
      <td valign=top><b>Teamk&uuml;rzel</b></td>
    </tr>

<?PHP

while($row = mysqli_fetch_array($resultBL2)) {

  if (($row["id"] % 2) == 1) { $style = $table_lineA; }
  else { $style = $table_lineB; }

  echo "<tr style=\"background-color:".$style.";\">";

  echo "<td>".$row["id"]."</td>\n";
  echo "<td><input type=text name=name".$row["id"]." value=\"".$row["name"]."\" size=30></td>\n";
  echo "<td><input type=text name=short".$row["id"]." value=\"".$row["short"]."\" size=10 maxlength=6></td>\n";
  echo "</tr>\n";

} // while

?>
<?PHP if (mysqli_num_rows($resultPlays) == 0) { ?>
<tr><td colspan=3 align=right><input type=reset value="Reset">&nbsp;&nbsp;&nbsp;<input type=submit value="Teams speichern"></td></tr>
<?PHP } ?>
</table>
</form>
<br><br>

<?PHP

require("bottom.php");

?>

