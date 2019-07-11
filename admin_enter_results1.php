<?PHP
session_start();
extract($_SESSION);

$play = $_REQUEST['play'];

$freeChkBox = 1;

require("connect_db.php");

$resultPlayBL1 = mysql_query("SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from tbl_game g, tbl_team t1, view_team2 t2 WHERE play=".$play." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=1 ORDER BY g.p_ts, g.id");
$resultPlayBL2 = mysql_query("SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from tbl_game g, tbl_team t1, view_team2 t2 WHERE play=".$play." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=2 ORDER BY g.p_ts, g.id");

$resultBL1 = mysql_query("Select * from tbl_team where league=1 order by name");
$resultBL2 = mysql_query("Select * from tbl_team where league=2 order by name");

require("close_db.php");

require("top.php");

echo "<body><br><b>Ergebnisse f&uuml;r ".$play.". Spieltag eintragen:</b><br><br>";

?>

<script src="js/chkForm.js" type="text/javascript"></script>

<form name="play" method="post" action="admin_enter_results2.php" onSubmit="return chk_admin_results1()">
<input name=playID type=hidden value=<?PHP echo $play ?>>
  <table border="0">
    <tr>
    	<td colspan=6><b>1. Bundesliga</b><br>
    		<a href="http://www.dfb.de/index.php?id=500017&liga=bl1m&saison=<?PHP echo $season ?>&saisonl=20<?PHP echo $season ?>&spieltag=<?PHP echo $play ?>&cHash=d3589159deb822853ffc9abd331e0a00" target="_blank">zur DFB-Seite</a>
    		|
    		<a href="http://www.gaijin.at/olsutc.php" target="_blank">Timestamp Generator</a>
    	</td>
    </tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Ergebnis</b></td>
    </tr>


<?PHP

  $j = 0;
  $k = 0;
  for ($j=1; $j<=9; $j++){

    $row = mysql_fetch_array($resultPlayBL1);

    $game=$row["id"];

    if (isset($row["result1"])){
      $res1=$row["result1"];
    }
    else{
      $res1=-1;
    }
    if (isset($row["result2"])){
      $res2=$row["result2"];
    }
    else{
      $res2=-1;
    }


    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    //echo "<tr class=".$style.">";
    echo "<tr style=\"background-color:".$style.";\">";

    echo "<td><input type=hidden name=game".$j." value=".$game.">".$j.".</td>\n";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }
    $k = $j + 12;

    //pr�fung auf mind. 1h nach Ende:
    if ((mktime() - $row["p_ts"]) > 7200) {

      if ($res1 > -1){
        echo "<td><input name=res".$j." type=text maxlength=2 size=2 value=".$res1."> : \n";
      } else {
        echo "<td><input name=res".$j." type=text maxlength=2 size=2> : \n";
      }

      if ($res2 > -1){
        echo "<input name=res".$k." type=text maxlength=2 size=2 value=".$res2."></td>\n";
      } else {
        echo "<input name=res".$k." type=text maxlength=2 size=2>\n";
      }

    } else {

      echo "<td><input type=hidden name=res".$j." value=".$res1.">";
      echo "<input type=hidden name=res".$k." value=".$res2.">";
      echo "zu fr&uuml;h!</td>\n";
      $freeChkBox = 0;
    }

    echo "</tr>\n";


  } // for ($j


?>

    <tr>
    	<td colspan=4><br><b>2. Bundesliga</b><br>
		    <a href="http://www.dfb.de/index.php?id=500031&liga=bl2m&saison=<?PHP echo $season ?>&saisonl=20<?PHP echo $season ?>&spieltag=<?PHP echo $play ?>&cHash=d3589159deb822853ffc9abd331e0a00" target="_blank">zur DFB-Seite</a>
	    </td>
    </tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Ergebnis</b></td>
    </tr>

<?PHP

  for ($j=10; $j<=12; $j++){

    $row = mysql_fetch_array($resultPlayBL2);

    $game=$row["id"];

    if (isset($row["result1"])){
      $res1=$row["result1"];
    }
    else{
      $res1=-1;
    }
    if (isset($row["result2"])){
      $res2=$row["result2"];
    }
    else{
      $res2=-1;
    }

    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td><input type=hidden name=game".$j." value=".$game.">".$j.".</td>\n";

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }
    $k = $j + 12;

    //pr�fung auf mind. 1h nach Ende:
    if ((mktime() - $row["p_ts"]) > 7200) {

      if ($res1 > -1){
        echo "<td><input name=res".$j." type=text maxlength=2 size=2 value=".$res1."> : \n";
      } else {
        echo "<td><input name=res".$j." type=text maxlength=2 size=2> : \n";
      }

      if ($res2 > -1){
        echo "<input name=res".$k." type=text maxlength=2 size=2 value=".$res2."></td>\n";
      } else {
        echo "<input name=res".$k." type=text maxlength=2 size=2>\n";
      }

    } else {

      echo "<td><input type=hidden name=res".$j." value=".$res1.">";
      echo "<input type=hidden name=res".$k." value=".$res2.">";
      echo "zu fr&uuml;h!</td>\n";
      $freeChkBox = 0;
    }


    echo "</tr>\n";


  } // for ($j

  echo "<tr>";
  if ($freeChkBox > 0) {
    //echo "<td colspan=4 align=right>Ergebnisse freigeben <input name=free type=checkbox checked></td>";
    echo "<td colspan=4 align=right>Ergebnisse freigeben <input name=free type=checkbox></td>";
    echo "<td colspan=2 align=right>";
  } else {
    echo "<td colspan=6 align=right><input name=free type=hidden value=-1>";
  }
  ?>
  <input type="submit" name="Submit" value="Ergebnisse speichern"></td></tr>
  </table>
</form>

<?PHP

require("bottom.php");

?>
