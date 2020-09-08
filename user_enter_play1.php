<?PHP
session_start();
extract($_SESSION);

$play = $_POST["play"];
require("connect_db.php");

$bets1=1;
// mit bet: Select * from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=1 and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id
$resultPlayBL1 = mysqli_query($connectedDb, "Select *, b.id AS betId from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id and b.userID=".$act_userid." order by g.p_ts, g.id");
// SELECT g.id, g.p_ts, t1.name, t2.name2, b.bet1, g.bet2 FROM tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where g.play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 and b.game=g.id order by g.id
if (mysqli_num_rows($resultPlayBL1) < 9) {
//if (mysqli_num_rows($resultPlayBL1) == 0) {
  $bets1=0;
  // SELECT g.id, g.p_ts, t1.name, t2.name2 FROM tbl_game g, tbl_team t1, view_team2 t2 where g.play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.id
  $resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=1 order by g.p_ts, g.id");
}

$bets2=1;
$resultPlayBL2 = mysqli_query($connectedDb, "Select *, b.id AS betId from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 and b.game=g.id and b.userID=".$act_userid." order by g.p_ts, g.id");
if (mysqli_num_rows($resultPlayBL2) == 0) {
  $bets2=0;
  $resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 order by g.p_ts, g.id");
}

//$resultPlayBL1 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2, tbl_bet b where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2 and b.game=g.id");
//$resultPlayBL2 = mysqli_query($connectedDb, "Select * from tbl_game g, tbl_team t1, view_team2 t2 where play=".$play." and t1.id=g.team1 and t2.id2=g.team2 and t1.league=2");

$resultBL1 = mysqli_query($connectedDb, "Select * from tbl_team where league=1 order by name");
$resultBL2 = mysqli_query($connectedDb, "Select * from tbl_team where league=2 order by name");


//abfrage nach frühester startzeit des spieltages
$joker1 = 0;
$joker1Set = 0;
$joker1AlreadyUsed = 0;
$resultJoker = mysqli_query($connectedDb, "SELECT min(p_ts) as min FROM tbl_game g WHERE g.play=".$play);
$row = mysqli_fetch_array($resultJoker);
$now = mktime();
//echo "\n<br>".$now;
//echo "\n<br>".$row["min"];
if (($row["min"] - $now) < 300) {
  //joker auf ein spiel gesetzt, was schon angefangen hat
  $joker1Set = 1;
}


require("close_db.php");

$maxi = 9;
if (mysqli_num_rows($resultPlayBL2) > 0) {
  $maxi = 12;
}

require("top.php");

echo "<body><br><b>Tipps f&uuml;r ".$play.". Spieltag eintragen:</b><br><br>";

?>

<script src="js/chkForm.js" type="text/javascript"></script>

<form name="play" method="post" action="user_enter_play2.php" onSubmit="return chk_user_play1()">
<input name=playID type=hidden value=<?PHP echo $play ?>>
  <table>
    <tr><td colspan=6 class="noBorder"><b>1. Bundesliga</b><br>
        <font>na, wieder keine Ahnung was du tippen sollst? Schau doch mal bei <a href="https://www.bwin.com/de/fu%C3%9Fball" target="_blank">bet&win.de</a> vorbei!<br>
        oder probiers mal <a href="http://www.sport1.de/de/fussball/fussball_bundesliga/" target="_blank">sport1.de</a> oder <a href="http://www.bundesliga.de/de/liga/tabelle/" target="_blank">bundesliga.de</a>.
        </font></td>
    </tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Tipp</b></td>
      <td valign=top><b>Joker</b></td>
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
    if ($phpMySQL > 0) {
    	echo "<td><input type=hidden name=game".$j." value=".$game."><a href=\"_horst.php?server=$db_host&username=$db_user&db=$db_name&edit=tbl_game&where%5Bid%5D=$game\" target=\"_blank\">".$j.".</a></td>\n";
    } else {
    	echo "<td><input type=hidden name=game".$j." value=".$game.">".$j.".</td>\n";
    }

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";
    $k = $j + 12;

    $bet1 = "";
    $bet2 = "";
    $betId = -1;

    if (isset($row["betId"])) { $betId = $row["betId"]; }
    if (isset($row["bet1"])) { $bet1 = $row["bet1"]; }
    if (isset($row["bet2"])) { $bet2 = $row["bet2"]; }
    if ($bet1 == "-1") { $bet1 = ""; }
    if ($bet2 == "-1") { $bet2 = ""; }

    if (isset($row["joker1"])) { $joker1 = $row["joker1"]; }

    //prüfung auf mind. 1h (60*60=3600) bis Anpfiff:
    //24.08.2005: Verkürzung auf 5min: 5*60=300
    if (($row["p_ts"] - mktime()) < 300) {
      //tipps können nicht mehr eingetragen werden

      if (isset($row["bet1"])){
        //tipps wurden eingetragen

        echo "<td><input type=hidden name=bet".$j." value=".$bet1.">";
        echo "<input type=hidden name=bet".$k." value=".$bet2.">";
        //if ($bet1 < 0) {
        if ($bet1 == "") {
          echo "zu sp&auml;t!";
	    }
        else {
          echo $bet1." : ".$bet2;
        }        
        echo "</td>\n";
        
        
        //show if joker1 is set
        if ($joker1 == 1) {
          echo "<td><input type=\"radio\" name=\"joker1\" value=\"$game\" checked=\"checked\"></td>";
        } else {
          echo "<td></td>";
        }
        
        
      } else {
        //tipps wurden vergessen einzutragen

        echo "<td><input type=hidden name=bet".$j." value=-1>";
        echo "<input type=hidden name=bet".$k." value=-1>";
        echo "zu sp&auml;t!</td>\n";

        //show if joker1 is set
        if ($joker1 == 1) {
          echo "<td><input type=\"radio\" name=\"joker1\" value=\"$game\" checked=\"checked\"></td>";
        } else {
          echo "<td></td>";
        }

      }

    } else {
      // tipps können noch eingetragen werden

      echo "<td>";
	  if ($phpMySQL > 0) {
    	echo "<a href=\"_horst.php?server=$db_host&username=$db_user&db=$db_name&edit=tbl_bet&where%5Bid%5D=$betId\" target=\"_blank\">[mySQL]</a> \n";
   	  }
      echo "<input type=text maxlength=2 size=2 name=bet".$j;

      if ($bets1>0) {
        echo " value=".$bet1;
      }
      echo "> : <input type=text maxlength=2 size=2 name=bet".$k;
      if ($bets1>0) {
        echo " value=".$bet2;
      }
      echo "></td>\n";
      
      if ($joker1Set <> 1) {
        //zusätzlicher Joker kann noch gesetzt werden
        echo "<td align=center><input type=\"radio\" name=\"joker1\" value=\"$game\"";
        if ( $joker1 == "1" ) {
      	  echo " checked=\"checked\" ";
		  $joker1AlreadyUsed = 1;
        }      
        echo "></td>\n";
      } else {
        //show if joker1 is set
        if ($joker1 == 1) {
          echo "<td><input type=\"radio\" name=\"joker1\" value=\"$game\" checked=\"checked\"></td>";
        } else {
          echo "<td></td>";
        }
      }
    }
    echo "</tr>\n";


  } // for ($j

if ($maxi>9){
?>

    <tr><td colspan=4 class="noBorder"><br><b>2. Bundesliga</b><br>
        <font>Infos zur 2. Liga: <a href="http://www.sport1.de/de/fussball/fussball_bundesliga2/" target="_blank">Sport1.de</a> oder <a href="http://www.bundesliga.de/de/liga2/tabelle/" target="_blank">bundesliga.de</a>.
        </font></td>
    </tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>SpNr.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Tipp</b></td>
      <td valign=top><b>Joker</b></td>
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
    if ($phpMySQL > 0) {
    	echo "<td><input type=hidden name=game".$j." value=".$game."><a href=\"_horst.php?server=$db_host&username=$db_user&db=$db_name&edit=tbl_game&where%5Bid%5D=$game\" target=\"_blank\">".$j.".</a></td>\n";
    } else {
    	echo "<td><input type=hidden name=game".$j." value=".$game.">".$j.".</td>\n";
    }

    echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
    echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    echo "<td>".$row["name"]."</td>\n";
    echo "<td>".$row["name2"]."</td>\n";
    $k = $j + 12;
    //echo "<td><input type=text maxlength=2 size=2 name=bet".$j."> : <input type=text maxlength=2 size=2 name=bet".$k."></td>\n";

    $bet1 = "";
    $bet2 = "";
    $betId = -1;

    if (isset($row["betId"])) { $betId = $row["betId"]; }
    if (isset($row["bet1"])) { $bet1 = $row["bet1"]; }
    if (isset($row["bet2"])) { $bet2 = $row["bet2"]; }
    if ($bet1 == "-1") { $bet1 = ""; }
    if ($bet2 == "-1") { $bet2 = ""; }
    
    if (isset($row["joker1"])) { $joker1 = $row["joker1"]; }    

    //prüfung auf mind. 1h (60*60=3600) bis Anpfiff:
    //24.08.2005: Verkürzung auf 5min: 5*60=300
    if (($row["p_ts"] - mktime()) < 300) {
      if (isset($row["bet1"])){

        echo "<td><input type=hidden name=bet".$j." value=".$bet1.">";
        echo "<input type=hidden name=bet".$k." value=".$bet2.">";
        if ($phpMySQL > 0) {
    		echo "<a href=\"_horst.php?server=$db_host&username=$db_user&db=$db_name&edit=tbl_bet&where%5Bid%5D=$betId\" target=\"_blank\">[mySQL]</a> \n";
    	}

    	//if ($bet1 < 0) {
        if ($bet1 == "") {
          echo "zu sp&auml;t!</td>\n";
		}
        else {
          	echo $bet1." : ".$bet2."</td>\n";
        }
        
        //show if joker1 is set
        if ($joker1 == 1) {
          echo "<td><input type=\"radio\" name=\"joker1\" value=\"$game\" checked=\"checked\"></td>";
        } else {
          echo "<td></td>";
        }        
        
      } // if isset
      else {

        echo "<td><input type=hidden name=bet".$j." value=-1>";
        echo "<input type=hidden name=bet".$k." value=-1>";
        echo "zu sp&auml;t!</td>\n";

        //show if joker1 is set
        if ($joker1 == 1) {
          echo "<td><input type=\"radio\" name=\"joker1\" value=\"$game\" checked=\"checked\"></td>";
        } else {
          echo "<td></td>";
        }

      }

    } else {

      echo "<td>";
	  if ($phpMySQL > 0) {
    	echo "<a href=\"_horst.php?server=$db_host&username=$db_user&db=$db_name&edit=tbl_bet&where%5Bid%5D=$betId\" target=\"_blank\">[mySQL]</a> \n";
   	  }
   	  
      echo "<input type=text maxlength=2 size=2 name=bet".$j;
      if ($bets1>0) {
        echo " value=".$bet1;
      }
      echo "> : <input type=text maxlength=2 size=2 name=bet".$k;
      if ($bets1>0) {
        echo " value=".$bet2;
      }
      echo "></td>\n";
      
      
      if ($joker1Set <> 1) {
        //zusätzlicher Joker kann noch gesetzt werden
        echo "<td align=center><input type=\"radio\" name=\"joker1\" value=\"$game\"";
        if ( $joker1 == "1" ) {
      	  echo " checked=\"checked\" ";
		  $joker1AlreadyUsed = 1;
        }      
        echo "></td>\n";
      } else {
        echo "<td></td>";
      }
      
    }

    echo "</tr>\n";


  } // for ($j

} // if ($maxi>9)
  //<tr><td colspan=5 align=right><br>nur 1. Liga speichern<input type=checkbox name="onlyBL"></td><td align=right><br><input type="submit" name="Submit" value="Spieltag speichern"></td></tr>


  ?>

  <tr valign=bottom>
    <td colspan=6 align=right class="noBorder"><br><input type="submit" name="Submit" value="Tipps speichern"></td>
    <?PHP
      if ($joker1Set <> 1) {
        echo "<td align=center class=\"noBorder\">kein Joker<br><input type=\"radio\" name=\"joker1\" value=\"0\"";
        if ($joker1AlreadyUsed == 0) {
      	  echo " checked=\"checked\" ";
        }      
        echo "></td>";
      }
	?>
    
    
  </tr>
  </table>
</form>

<?PHP

require("bottom.php");

?>
