<?PHP
session_start();
extract($_SESSION);

$play = $_POST["play"];
//session_register("play");

require("connect_db.php");

//id  play  team1  team2  p_ts  result1  result2  id  name  short  league  id2  name2  short2  league2
$games1 = 1;
//$resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id");
$resultPlayBL1 = mysqli_query($connectedDb, "Select t1.id, t2.id2, g.p_ts from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id");
$stringResultPlayBL1 = "Select t1.id, t2.id2, g.p_ts from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id";
//echo "Select t1.id, t2.id2, g.p_ts from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id";
if (mysqli_num_rows($resultPlayBL1) == 0) {
  $games1 = 0;
//  $resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id");
}

$games2=1;
//$resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.id");
$resultPlayBL2 = mysqli_query($connectedDb, "Select t1.id, t2.id2, g.p_ts from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.p_ts, g.id");
$stringResultPlayBL2 = "Select t1.id, t2.id2, g.p_ts from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.id";
if (mysqli_num_rows($resultPlayBL2) == 0) {
  $games2=0;
//  $resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.id");
}

$str = "Select * from tbl_team where league=1 order by name";
$resultBL1 = mysqli_query($connectedDb, $str);
$resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.p_ts, g.id");
$str = "Select * from tbl_team where league=2 order by name";
$resultBL2 = mysqli_query($connectedDb, $str);

require("close_db.php");

require("top.php");

echo "<body><br><b>".$play.". Spieltag eingeben</b><br><br>";

$i = 0;
$BL1 = array();
$BL1_order = array();
while($row = mysqli_fetch_array($resultBL1)) {
  $BL1[$i] = $row;
  $i++;
}

$i = 0;
$BL2 = array();
while($row = mysqli_fetch_array($resultBL2)) {
  $BL2[$i] = $row;
  $i++;
}

?>

<script language="JavaScript">
<!---

function opencal(feld,startdat) {
  lmocal="cal.php?abs=play&amp;feld="+feld;
  if(startdat!=""){lmocal=lmocal+"&amp;calshow="+startdat;}
  lmowin = window.open(lmocal,"lmocalpop","width=180,height=200,resizable=no,dependent=yes");
  lmotest=false;
}

//-->
</script>

<form name="play" method="post" action="admin_enter_play2.php" onSubmit="return chk_admin_play1()">
<!--<form name="play" method="post" action="admin_enter_play2.php">-->
<input name=playID type=hidden value=<?PHP echo $play ?>>
  <table border="0">
    <tr>
    	<td colspan=6><b>1. Bundesliga</b><br>
    		<a href="http://www.dfb.de/bundesliga/spieltagtabelle/" target="_blank">zur DFB-Seite</a>
    		|
    		<a href="http://www.gaijin.at/olsutc.php" target="_blank">Timestamp Generator</a>
    	</td>
    </tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>&uuml;ber-<br>nehmen</b></td>
      <td valign=top><b>Datum<br><?PHP echo date("d.m.Y"); ?></b></td>
      <td valign=top align=center><b>Uhrzeit<br>15 &nbsp;: &nbsp;30</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
    </tr>


<?PHP

  $j = 0;
  for ($j=1; $j<=9; $j++){

    $date = date("d.m.Y");
    $date = "";
    
    if ( $j == 1 ) {
      $time1 = "20";
      $time2 = "30";
    } else if ( $j < 7 ) {
      $time1 = "15";
      $time2 = "30";
    } else if ( $j == 7 ) {
      $time1 = "18";
      $time2 = "30";
    } else if ( $j == 8 ) {
      $time1 = "15";
      $time2 = "30";
    } else {    
      $time1 = "18";
      $time2 = "00";
    }
    
    $id1 = -1;
    $id2 = -2;

    if ($games1 == 1){
      $rowGame = mysqli_fetch_array($resultPlayBL1);

      if (isset($rowGame["p_ts"])){
        $date = date("d.m.Y",$rowGame["p_ts"]);
        $time1 = date("H",$rowGame["p_ts"]);
        $time2 = date("i",$rowGame["p_ts"]);
      }
      $id1 = $rowGame["id"];
      $id2 = $rowGame["id2"];
    }

    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    // mit JavaScript f�r die nachfolgenden �bernehmen
    if ($j == 1) {
      //echo "<td><a href=#>f�r alle</a></td>";

      $javastr = "";
      for ($k=2; $k<=12; $k++){
        $javastr = $javastr."date".$k.".value=date1.value;hour".$k.".value=hour1.value;min".$k.".value=min1.value;";
       // echo "<tr>".$javastr."</Tr>";
      }

      echo "<td><a href=# onClick=".$javastr.">f�r alle</a></td>";

    }
    else{
      if ($j > 2){
        $javastr = "date".$j.".value=date1.value;hour".$j.".value=hour1.value;min".$j.".value=min1.value";
        echo "<td><a href=# onClick=".$javastr.">von 1.</a><br>";
      } else {
        echo "<td>";
      }

      $k = $j - 1;
      $javastr = "date".$j.".value=date".$k.".value;hour".$j.".value=hour".$k.".value;min".$j.".value=min".$k.".value";
      echo "<a href=# onClick=".$javastr.">von ".$k.".</a></td>";

    }

    echo "<td><a href=# onClick=\"opencal('date".$j."','0')\"><img src=images/cal.gif border=0></a>&nbsp;\n";

    //echo "<input name=date".$j." type=text id=date maxlength=10 size=10 value=01.01.2003></td>\n";
    echo "<input name=date".$j." type=text id=date maxlength=10 size=10 value=".$date."></td>\n";
    echo "<td><input name=hour".$j." type=text id=hour maxlength=2 size=2 value=".$time1."> : \n";
    echo "<input name=min".$j." type=text id=min maxlength=2 size=2 value=".$time2."></td>\n";

    echo "<td><select name=team".$j.">\n";

    if ($show_long == 1) {
      echo "<option value=0>----------------------------------------</option>\n";
    } else {
      echo "<option value=0>--------</option>\n";
    }

    for ($i=0; $i<count($BL1); $i++){

      $row = $BL1[$i];
      if ($show_long == 1) { $team = $row["name"]; }
      else { $team = $row["short"]; }

      $id = $row["id"];

      // echo "<option value=".$id.">".$team."</option>\n";
      // neu f�r test
      if ($id1 == $id){
        echo "<option value=".$id." selected>".$team."</option>\n";
      }
      else {
        echo "<option value=".$id.">".$team."</option>\n";
      }

    } // for ($i

      echo "</select></td>\n";
      $k = $j + 12;
      echo "<td><select name=team".$k.">";

      if ($show_long == 1) {
        echo "<option value=0>----------------------------------------</option>\n";
      } else {
        echo "<option value=0>--------</option>\n";
      }

    for ($i=0; $i<count($BL1); $i++){
      $row = $BL1[$i];
      if ($show_long == 1) { $team = $row["name"]; }
      else { $team = $row["short"]; }

      $id = $row["id"];
      // echo "<option value=".$id.">".$team."</option>\n";

      // neu f�r test
      //if ($i == $j+8){
      if ($id2 == $id){
        echo "<option value=".$id." selected>".$team."</option>\n";
      }
      else {
        echo "<option value=".$id.">".$team."</option>\n";
      }

    } // for ($i
      echo "</select></td></tr>\n";


  } // for ($j

  if ($play < 18) {
    echo "</tr><td colspan=3><input name=rueck type=checkbox checked> R&uuml;ckrunde der 1. BL erzeugen</td></tr>";
  }

?>

    <tr>
    	<td colspan=4><br><b>2. Bundesliga</b><br>
		    <a href="http://www.dfb.de/2-bundesliga/spieltagtabelle/" target="_blank">zur DFB-Seite</a>
	    </td>
    </tr>    
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>&uuml;ber-<br>nehmen</b></td>
      <td valign=top><b>Datum<br><?PHP echo date("d.m.Y"); ?></b></td>
      <td valign=top align=center><b>Uhrzeit<br>15 &nbsp;: &nbsp;30</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
    </tr>

<?PHP


  for ($j=10; $j<=12; $j++){

    $date = date("d.m.Y");
    $date = "";

    if ( $j == 10 ) {
      $time1 = "18";
      $time2 = "00";
    } else if ( $j == 12 ) {
      $time1 = "20";
      $time2 = "15";
    } else {    
      $time1 = "13";
      $time2 = "00";
    }

    $id1 = -1;
    $id2 = -2;

    if ($games2 == 1){
      $rowGame = mysqli_fetch_array($resultPlayBL2);

      if ($rowGame["p_ts"] <> NULL){
        $date = date("d.m.Y",$rowGame["p_ts"]);
        $time1 = date("H",$rowGame["p_ts"]);
        $time2 = date("i",$rowGame["p_ts"]);
      }
      $id1 = $rowGame["id"];
      $id2 = $rowGame["id2"];
    }

    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$j.".</td>";

    $javastr = "date".$j.".value=date1.value;hour".$j.".value=hour1.value;min".$j.".value=min1.value";
    echo "<td><a href=# onClick=".$javastr.">von 1.</a>";

    $k = $j - 1;
    $javastr = "date".$j.".value=date".$k.".value;hour".$j.".value=hour".$k.".value;min".$j.".value=min".$k.".value";
    echo "<br><a href=# onClick=".$javastr.">von ".$k.".</a></td>";

    echo "<td><a href=# onClick=\"opencal('date".$j."','0')\"><img src=images/cal.gif border=0></a>&nbsp;\n";
    echo "<input name=date".$j." type=text id=date maxlength=10 size=10 value=".$date."></td>\n";

//    echo "<td><input name=date".$j." type=text id=date maxlength=10 size=10></td>\n";
    echo "<td><input name=hour".$j." type=text id=hour maxlength=2 size=2 value=".$time1.">&nbsp;:&nbsp;\n";
    echo "<input name=min".$j." type=text id=min maxlength=2 size=2 value=".$time2."></td>\n";

    echo "<td><select name=team".$j.">\n";

    if ($show_long == 1) {
      echo "<option value=0>----------------------------------------</option>\n";
    } else {
      echo "<option value=0>--------</option>\n";
    }

    for ($i=0; $i<count($BL2); $i++){
      $row = $BL2[$i];
      if ($show_long == 1) { $team = $row["name"]; }
      else { $team = $row["short"]; }
      $id = $row["id"];

            if ($id1 == $id){
        echo "<option value=".$id." selected>".$team."</option>\n";
      }
      else {
        echo "<option value=".$id.">".$team."</option>\n";
      }

    } // for ($i

      echo "</select></td>\n";
      $k = $j + 12;
      echo "<td><select name=team".$k.">";

      if ($show_long == 1) {
        echo "<option value=0>----------------------------------------</option>\n";
      } else {
        echo "<option value=0>--------</option>\n";
      }

    for ($i=0; $i<count($BL2); $i++){
      $row = $BL2[$i];
      if ($show_long == 1) { $team = $row["name"]; }
      else { $team = $row["short"]; }
      $id = $row["id"];

      if ($id2 == $id){
        echo "<option value=".$id." selected>".$team."</option>\n";
      }
      else {
        echo "<option value=".$id.">".$team."</option>\n";
      }

    } // for ($i
      echo "</select></td></tr>\n";


  } // for ($j

    echo "<tr><td colspan=4 align=right>Spieltag freigeben (keine &Auml;nderung m&ouml;glich) <input name=free type=checkbox checked onClick=\"free_Click()\"></td>\n";
    echo "<td colspan=";
    if ($show_long == 1) { echo "1 "; }
    else { echo "2 "; }
    echo "align=right>nur 1. Liga speichern<input type=checkbox name=onlyBL onClick=\"onlyBL_Click()\"></td>\n";
    if ($show_long == 1) {
      echo "<td align=right><input type=submit name=Submit value=\"Spieltag speichern\"></td>\n";
    } else {
      echo "</tr><tr><td colspan=6 align=right><input type=submit name=Submit value=\"Spieltag speichern\"></td>\n";
    }
?>
  </tr>
  </table>
</form>



<?PHP

require("bottom.php");

?>
