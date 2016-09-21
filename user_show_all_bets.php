<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");
$min_points = -3;

$resultUsers = mysql_query("SELECT * FROM tbl_user ORDER BY id");
for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){
  $row = mysql_fetch_array($resultUsers);
  $users[$row["id"]] = $row["id"];
  $user_names[$row["id"]] = $row["nick_name"];
  $user_show_tipps[$row["id"]] = $row["show_tipps"];
  if ($row["id"] == $act_userid) { $user_show_tipps[$row["id"]] = 3; }
  $points[$users[$row["id"]]] = 0;
  //echo $users[$i]."!<br>";
} //for


$str_resultPlayBL1 = "SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from tbl_game g, tbl_team t1, view_team2 t2 WHERE play=".$_REQUEST['play']." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=1 ORDER BY g.p_ts, g.id";
$str_resultPlayBL2 = "SELECT g.id, t1.name, t1.short, t2.name2, t2.short2, p_ts, result1, result2 from tbl_game g, tbl_team t1, view_team2 t2 WHERE play=".$_REQUEST['play']." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=2 ORDER BY g.p_ts, g.id";
$resultPlayBL1 = mysql_query($str_resultPlayBL1);
$resultPlayBL2 = mysql_query($str_resultPlayBL2);

for ($i = 1; $i <= mysql_num_rows($resultPlayBL1); $i++){
  $row = mysql_fetch_array($resultPlayBL1);
  $games[$i] = $row["id"];
  $team1[$i] = $row["name"];
  $team2[$i] = $row["name2"];
  $p_tss[$i] = $row["p_ts"];
  if (isset($row["result1"])) { $results[$i] = $row["result1"]; }
  else { $results[$i] = -1; }
  $k = $i + 12;
  if (isset($row["result2"])) { $results[$k] = $row["result2"]; }
  else { $results[$k] = -1; }
}

for ($i = 10; $i < 13; $i++){
  $row = mysql_fetch_array($resultPlayBL2);
  $games[$i] = $row["id"];
  $team1[$i] = $row["name"];
  $team2[$i] = $row["name2"];
  $p_tss[$i] = $row["p_ts"];
  if (isset($row["result1"])) { $results[$i] = $row["result1"]; }
  else { $results[$i] = -1; }
  $k = $i + 12;
  if (isset($row["result2"])) { $results[$k] = $row["result2"]; }
  else { $results[$k] = -1; }
}

for ($i=1; $i <= 12; $i++){

  $k = $i + 12;
  $res1 = $results[$i];
  $res2 = $results[$k];
  $game = $games[$i];
  $max_points = 0;


    foreach ($users as $userid){
      $user_points = 0;
      $all_points[$userid][$i] = "";
      $user_bets[$userid][$i] = "";
      $user_bets2[$userid][$i][0] = -1;
      $user_bets2[$userid][$i][1] = -1;

      $query = "SELECT * from tbl_game g, tbl_bet b WHERE g.id=b.game AND b.game=".$game." AND b.userID=".$userid;
      $bets = mysql_query($query);
      $row = mysql_fetch_array($bets);
      $bet1 = $row["bet1"];
      $bet2 = $row["bet2"];
      if ($bet1 == "") { $bet1 = -1; }
      if ($bet2 == "") { $bet2 = -1; }
      if ($res1 == "") { $res1 = -1; }
      if ($res2 == "") { $res2 = -1; }

      $user_bets2[$userid][$i][0] = $bet1;
      $user_bets2[$userid][$i][1] = $bet2;

      if (($bet1 > -1) && ($bet2 > -1)) {
        $user_bets[$userid][$i] = $bet1." : ".$bet2;
        
        // add joker flag
        if ( $row["joker1"] == "1" ) {
          $user_bets[$userid][$i] = $user_bets[$userid][$i]." (J)";
        }
      }

      if (($bet1 > -1) && ($bet2 > -1) && ($res1 > -1) && ($res2 > -1)) {

        $diff_bet = $bet1 - $bet2;
        $diff_res = $res1 - $res2;
        $user_bets[$userid][$i] = $bet1." : ".$bet2;
        
        // add joker flag
        if ( $row["joker1"] == "1" ) {
          $user_bets[$userid][$i] = $user_bets[$userid][$i]." (J)";
        }        
        
        $user_bets2[$userid][$i][0] = $bet1;
        $user_bets2[$userid][$i][1] = $bet2;
/*
        if ( ($bet1 == $res1) && ($bet1 == $res1) ) { $user_points = 3; }
        else {
          if ( (($bet1 > $res1) && ($bet1 > $res1)  ) ||
               (($bet1 < $res1) && ($bet1 < $res1)  ) ||
               (($bet1 == $bet2) && ($res1 == $res2)) ) {
            $user_points = 1;
          } // if

        } // if bet1=bet2
*/
              // Unentschieden, richtige tendenz mit gleicher tordifferenz
                                          // selbe Tendenz
        if ( ($diff_res == $diff_bet) || ($diff_res * $diff_bet > 0) ){
	  if ($bet1 == $res1 && $bet2 == $res2){ //richtiges Ergebniss
	    $user_points = 3;
	  } else{
	    if ( ($diff_res == $diff_bet) && ($diff_bet != 0) ) {
	      $user_points = 2; //richtige Tendenz und Tordifferenz
	    } else {
	      $user_points = 1; //Unentschieden oder richtige Tendenz
	    } // if
	  } // if
        } else { // if diff_res==diff_bet
          $user_points = 0;
        } // if diff_bet

      } // if ($bet1 > -1 && $bet2 > -1 && $res1 > -1 && $res2 > -1)

      // check if joker is set
      if ( $row["joker1"] == "1" ) {
        if ( $user_points == 0 ) {
          $user_points = $min_points;
        } else {
          $user_points = $user_points * 2;
        }
      }

      $all_points[$userid][$i] = $user_points;
      $points[$userid] = $points[$userid] + $user_points;
      if ($points[$userid] > $max_points) { $max_points = $points[$userid]; }
      //echo "spieler: ".$userid."; Spiel: ".$game."; Ergebnis: ".$res1.":".$res2." Tipp: ".$bet1.":".$bet2." => ".$user_points."<br>";



    } // loop players

} //for i / loop games


//Punktzahl des 1. - 5. Platzes
$max_points = $min_points;
$max_points2 = $min_points;
$max_points3 = $min_points;
$max_points4 = $min_points;
$max_points5 = $min_points;

//echo "<br><br><br>";
foreach ($users as $userid){
     
      if ($points[$userid] >= $max_points) { 
        if ($points[$userid] > $max_points) { 
          $max_points5 = $max_points4;
          $max_points4 = $max_points3;
          $max_points3 = $max_points2;
          $max_points2 = $max_points;
      	}
      	$max_points = $points[$userid];
      } else {
        if ($points[$userid] >= $max_points2) {       	  
      	  if ($points[$userid] > $max_points2) { 
            $max_points5 = $max_points4;
            $max_points4 = $max_points3;
            $max_points3 = $max_points2;
      	  }
      	  $max_points2 = $points[$userid];
      	} else {
          if ($points[$userid] >= $max_points3) { 
			if ($points[$userid] > $max_points3) { 
              $max_points5 = $max_points4;
              $max_points4 = $max_points3;
      	  	}
      	    $max_points3 = $points[$userid];
      	  } else {
            if ($points[$userid] >= $max_points4) { 
	  	  	  if ($points[$userid] > $max_points4) { 
                $max_points5 = $max_points4;
       		  }
      	      $max_points4 = $points[$userid];
      	    } else {
          	  if ($points[$userid] >= $max_points5) {
      	    	$max_points5 = $points[$userid];
      	  	  }
			}

		  }
      	}
      }
      //echo "spieler: ".$userid."; Spiel: ".$game."; maxpoints: ".$max_points."; maxpoints2: ".$max_points2."; maxpoints3: ".$max_points3."<br>";
  
}//foreach


//Anzahl der "Gleichbepunkteten"
$cnt_max_points = 0;
$cnt_max_points2 = 0;
$cnt_max_points3 = 0;
$cnt_max_points4 = 0;
$cnt_max_points5 = 0;

foreach ($users as $userid){
     
      if ($points[$userid] == $max_points) { 
        $cnt_max_points = $cnt_max_points + 1;
      }
      if ($points[$userid] == $max_points2) { 
        $cnt_max_points2 = $cnt_max_points2 + 1;
      }
      if ($points[$userid] == $max_points3) { 
        $cnt_max_points3 = $cnt_max_points3 + 1;
      }
      if ($points[$userid] == $max_points4) { 
        $cnt_max_points4 = $cnt_max_points4 + 1;
      }
      if ($points[$userid] == $max_points5) { 
        $cnt_max_points5 = $cnt_max_points5 + 1;
      }
       
      
      //echo "<br><br>anzahl 1. platz: ".$cnt_max_points."; anzahl 2. platz: ".$cnt_max_points2."; anzahl 3. platz: ".$cnt_max_points3.";<br>";      
  
}//foreach

//Punkteverteilung für die entsprechenden Plätze:
$max_points_win = 5; //immer 5 punkte für den ersten Platz
$max_points2_win = 4;
$max_points3_win = 3;
$max_points4_win = 2;
$max_points5_win = 1;

if ($cnt_max_points > 4) {
	$max_points2_win = 0;
	$max_points3_win = 0;
	$max_points4_win = 0;
	$max_points5_win = 0;
} else 
if ($cnt_max_points == 4) {
	$max_points2_win = 1;
	$max_points3_win = 0;
	$max_points4_win = 0;
	$max_points5_win = 0;
} else 
if ($cnt_max_points == 3) {
	$max_points2_win = 2;
	if ($cnt_max_points2 > 1) { 	
		$max_points3_win = 0;
	} else {
		$max_points3_win = 1;
	}
	$max_points4_win = 0;
	$max_points5_win = 0;
} else
if ($cnt_max_points == 2) {
	$max_points2_win = 3;
	if ($cnt_max_points2 > 2) {
		$max_points3_win = 0;
		$max_points4_win = 0;
		$max_points5_win = 0;
	} else if ($cnt_max_points2 == 2) {
		$max_points3_win = 1;
		$max_points4_win = 0;
	} else { //$cnt_max_points2 == 1
		$max_points3_win = 2;
		if ($cnt_max_points3 > 1) {
			$max_points4_win = 0;
		} else {
			$max_points4_win = 1;
		}
	}
	$max_points5_win = 0;
} else { // ($cnt_max_points == 1)
	if ($cnt_max_points2 > 3) {
		$max_points3_win = 0;
		$max_points4_win = 0;
		$max_points5_win = 0;
	} else 
	if ($cnt_max_points2 == 3) {
		$max_points3_win = 1;
		$max_points4_win = 0;
		$max_points5_win = 0;
	} else 
	if ($cnt_max_points2 == 2) {
		$max_points3_win = 2;
		if ($cnt_max_points3 > 1) { 	
			$max_points4_win = 0;
		} else {
			$max_points4_win = 1;
		}
		$max_points5_win = 0;
	} else { //$cnt_max_points2 == 1
		if ($cnt_max_points3 > 2) {
			$max_points4_win = 0;
			$max_points5_win = 0;
		} else
		if ($cnt_max_points3 == 2) {
			$max_points4_win = 1;
			$max_points5_win = 0;
		} else { //($cnt_max_points3 == 1)
			if ($cnt_max_points4 > 1) {
				$max_points5_win = 0;
			} 
		}
	}

}


//echo "<br><br>punkte für 1. platz: ".$max_points_win."; punkte für 2. platz: ".$max_points2_win."; punkte für 3. platz: ".$max_points3_win.";<br>";      




//$resultPlayBL1 = mysql_query("SELECT g.id, t1.name, t2.name2, p_ts, result1, result2 from tbl_game g, tbl_team t1, view_team2 t2 WHERE play=".$_REQUEST[play]." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=1 ORDER BY g.id");
//$resultPlayBL2 = mysql_query("SELECT g.id, t1.name, t2.name2, p_ts, result1, result2 from tbl_game g, tbl_team t1, view_team2 t2 WHERE play=".$_REQUEST[play]." AND t1.id=g.team1 AND t2.id2=g.team2 AND t1.league=2 ORDER BY g.id");
$resultPlayBL1 = mysql_query($str_resultPlayBL1);
$resultPlayBL2 = mysql_query($str_resultPlayBL2);


require("close_db.php");

require("top.php");

echo "<body><br><b>Tipps und Ergebnisse des ".$_REQUEST['play'].". Spieltags:</b><br><br>";

?>

  <table>
    <tr><td colspan=4 class="noBorder"><b>1. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
<?PHP
  if ($show_long == 1) {
?>
      <td valign=top><b>Sp.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
<?PHP
  }
?>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Erg.</b></td>
      <?PHP
      foreach ($user_names as $username){
        echo "<td valign=top><b>".$username."</b></td>";
      }
      ?>
    </tr>

<?PHP

  $j = 0;
  for ($j=1; $j<=9; $j++){
    $k = $j + 12;

    $row = mysql_fetch_array($resultPlayBL1);
    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";

    if ($show_long == 1) {
      echo "<td>".$j.".</td>";
      echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
      echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    }
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }
    echo "<td>";
//    if ($row["result1"] > -1){
//      echo $row["result1"]." : ";
    if ($results[$j] > -1){
      echo $results[$j]." : ";
    } else {
      echo "&nbsp;&nbsp; : ";
    }

//    if ($row["result2"] > -1){
//      echo $row["result2"];
    if ($results[$k] > -1){
      echo $results[$k];
    }
    echo "</td>\n";

    // userpunkte angeben
    foreach ($users as $userid){

      if (($userid % 2) == 1) {
        if (($j % 2) == 1) { $style = $table_colA; }
        else { $style = $table_colB; }
      }
      else {
        if (($j % 2) == 1) { $style = $table_lineA; }
        else { $style = $table_lineB; }
      }


      // spiel schon angefangen
      if (($row["p_ts"] - mktime()) < 3600) {
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
            if (($results[$j] > -1) && ($results[$k] > -1)) {
              echo " (<b>".$all_points[$userid][$j]."</b>)";
            } //  if (($results[$j] > -1) && ($results[$k] > -1))
          } // if ($user_bets[$userid][$j] == "")
          echo "</td>\n";
      } else {
      // ergebnisse schon eingetragen
      if (($results[$j] > -1) && ($results[$k] > -1)) {

        if ($user_bets[$userid][$j] == "") {
          echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
        } else {
          echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
          echo " (<b>".$all_points[$userid][$j]."</b>)";
          echo "</td>\n";
        }
      } // if (($results[$j] > -1) && ($results[$k] > -1)) {
      else { // ergebnisse noch nicht eingetragen
      switch($user_show_tipps[$userid]){
        case 0:
          echo "<td style=\"background-color:".$style.";\">top secret</td>\n";
          break;
        case 1:
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">noch nicht</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">abgegeben</td>\n";
          }
          break;
        case 2:
          echo "<td style=\"background-color:".$style.";\">";
          $diff = $user_bets2[$userid][$j][0] - $user_bets2[$userid][$j][1];
          if ($user_bets2[$userid][$j][0] > -1 && $user_bets2[$userid][$j][1] > -1) {

            if ($diff == 0) { echo "Unent"; }
            if ($diff > 0) { echo "Heim"; }
            if ($diff < 0) { echo "Gast"; }
          } else {
            echo "noch nicht";
          } // if

          //.$user_bets[$userid][$j]."/".$diff.
          echo "</td>\n";
          break;
        case 3:

      if ($user_bets[$userid][$j] == "") {
        echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; -</td>\n";
      } else {
        echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
        if (($results[$j] > -1) && ($results[$k] > -1)) {
          echo " (<b>".$all_points[$userid][$j]."</b>)";
        }
        echo "</td>\n";
      }
          break;
      } // switch
      } // if (($results[$j] > -1) && ($results[$k] > -1)) {
      } // if (($row["p_ts"] - mktime()) < 3600) {
    } // foreach

    echo "</td>";

    echo "</tr>\n";

  } // for ($j

?>

    <tr></tr><tr></tr><tr></tr>
    <tr><td colspan=4 class="noBorder"><b>2. Bundesliga</b></td></tr>
    <tr style="background-color:<?PHP echo $table_head; ?>;">
<?PHP
  if ($show_long == 1) {
?>
      <td valign=top><b>Sp.</b></td>
      <td valign=top><b>Datum</b></td>
      <td valign=top align=center><b>Uhrzeit</b></td>
<?PHP
  }
?>
      <td valign=top><b>Heim</b></td>
      <td valign=top><b>Gast</b></td>
      <td valign=top><b>Erg.</b></td>
      <?PHP
      foreach ($user_names as $username){
        echo "<td valign=top><b>".$username."</b></td>";
      }
      ?>
    </tr>

<?PHP

  for ($j=10; $j<=12; $j++){
    $k = $j + 12;

    $row = mysql_fetch_array($resultPlayBL2);
    if (($j % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    if ($show_long == 1) {
      echo "<td>".$j.".</td>";
      echo "<td>".date("d.m.Y", $row["p_ts"])."</td>\n";
      echo "<td>".date("H:i", $row["p_ts"])."</td>\n";
    }
    if ($show_long == 1) {
      echo "<td>".$row["name"]."</td>\n";
      echo "<td>".$row["name2"]."</td>\n";
    } else {
      echo "<td>".$row["short"]."</td>\n";
      echo "<td>".$row["short2"]."</td>\n";
    }
    echo "<td>";
//    if ($row["result1"] > -1){
//      echo $row["result1"]." : ";
    if ($results[$j] > -1){
      echo $results[$j]." : ";
    } else {
      echo "&nbsp;&nbsp; : ";
    }

//    if ($row["result2"] > -1){
//      echo $row["result2"];
    if ($results[$k] > -1){
      echo $results[$k];
    }

    // userpunkte angeben
    foreach ($users as $userid){

      if (($userid % 2) == 1) {
        if (($j % 2) == 1) { $style = $table_colA; }
        else { $style = $table_colB; }
      }
      else {
        if (($j % 2) == 1) { $style = $table_lineA; }
        else { $style = $table_lineB; }
      }

      // spiel schon angefangen
      if (($row["p_ts"] - mktime()) < 3600) {
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
            if (($results[$j] > -1) && ($results[$k] > -1)) {
              echo " (<b>".$all_points[$userid][$j]."</b>)";
            } //  if (($results[$j] > -1) && ($results[$k] > -1))
          } // if ($user_bets[$userid][$j] == "")
          echo "</td>\n";
      } else {
      // ergebnisse schon eingetragen
      if (($results[$j] > -1) && ($results[$k] > -1)) {

        if ($user_bets[$userid][$j] == "") {
          echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; - (<b>0</b>)</td>\n";
        } else {
          echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
          echo " (<b>".$all_points[$userid][$j]."</b>)";
          echo "</td>\n";
        }
      } // if (($results[$j] > -1) && ($results[$k] > -1)) {
      else { // ergebnisse noch nicht eingetragen
      switch($user_show_tipps[$userid]){
        case 0:
          echo "<td style=\"background-color:".$style.";\">top secret</td>\n";
          break;
        case 1:
          if ($user_bets[$userid][$j] == "") {
            echo "<td style=\"background-color:".$style.";\">noch nicht</td>\n";
          } else {
            echo "<td style=\"background-color:".$style.";\">abgegeben</td>\n";
          }
          break;
        case 2:
          echo "<td style=\"background-color:".$style.";\">";
          $diff = $user_bets2[$userid][$j][0] - $user_bets2[$userid][$j][1];
          if ($user_bets2[$userid][$j][0] > -1 && $user_bets2[$userid][$j][1] > -1) {

            if ($diff == 0) { echo "Unent"; }
            if ($diff > 0) { echo "Heim"; }
            if ($diff < 0) { echo "Gast"; }
          } else {
            echo "noch nicht";
          } // if

          //.$user_bets[$userid][$j]."/".$diff.
          echo "</td>\n";
          break;
        case 3:

      if ($user_bets[$userid][$j] == "") {
        echo "<td style=\"background-color:".$style.";\">-&nbsp; :&nbsp; -</td>\n";
      } else {
        echo "<td style=\"background-color:".$style.";\">".$user_bets[$userid][$j];
        if (($results[$j] > -1) && ($results[$k] > -1)) {
          echo " (<b>".$all_points[$userid][$j]."</b>)";
        }
        echo "</td>\n";
      }
          break;
      } // switch
      } // if (($results[$j] > -1) && ($results[$k] > -1))
      } // if (($row["p_ts"] - mktime()) < 3600)
    } // foreach


    echo "</td>";
    echo "</tr>\n";


  } // for ($j

  // Punkte zusammenfassen
  if ($show_long == 1) { $cols = 6; }
  else { $cols = 3; }
  
  //Farbdefinitionen
  $table_max2_points = "#006699";
  $table_max3_points = "#009900";
  $table_max4_points = "#22DBF1";
  $table_max5_points = "#F0FA50";

  echo "<tr><td colspan=".$cols." align=right class=noBorder><b>Gesamtpunkte:</b></td>";
  foreach ($users as $userid){

    if ((($userid + $show_long) % 2) == 0) { $style = $table_colA; }
    else { $style = $table_lineA; }

    //hintergrundfarbe einheitlich per default
    $style = $table_lineA;

//check if $points[$userid]==$max_pointsX, than check if $max_pointsX_win
    // 1.Platz
    if ( ($max_points == $points[$userid]) && ($max_points > $min_points) ){
		$style = $table_max_points;
    }
    //2.Platz
    if ( ($max_points2 == $points[$userid]) && ($max_points2 > $min_points) ){
		if ( $max_points2_win == 4 ) { $style = $table_max2_points; }
		if ( $max_points2_win == 3 ) { $style = $table_max3_points; }
		if ( $max_points2_win == 2 ) { $style = $table_max4_points; }
		if ( $max_points2_win == 1 ) { $style = $table_max5_points; }
    }
    //3.Platz
    if ( ($max_points3 == $points[$userid]) && ($max_points3 > $min_points) ){
		if ( $max_points3_win == 3 ) { $style = $table_max3_points; }
		if ( $max_points3_win == 2 ) { $style = $table_max4_points; }
		if ( $max_points3_win == 1 ) { $style = $table_max5_points; }
    }
    //4.Platz
    if ( ($max_points4 == $points[$userid]) && ($max_points4 > $min_points) ){
		if ( $max_points4_win == 2 ) { $style = $table_max4_points; }
		if ( $max_points4_win == 1 ) { $style = $table_max5_points; }
    }
    //5.Platz
    if ( ($max_points5 == $points[$userid]) && ($max_points5 > $min_points) ){
		if ( $max_points5_win == 1 ) { $style = $table_max5_points; }
    }


    echo "<td style=\"background-color:".$style.";\" align=right><b>".$points[$userid]."</b></td>";

  } //foreach
  echo "</tr>";
  
  //Legende
  echo "<tr><td colspan=6 align=right class=noBorder><b>Legende:</b></td>\n";
  echo "<td colspan=11><table width=\"100%\"><tr><td style=\"background-color:".$table_max_points.";\" align=center width=\"20%\">1. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max2_points.";\" align=center width=\"20%\">2. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max3_points.";\" align=center width=\"20%\">3. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max4_points.";\" align=center width=\"20%\">4. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max5_points.";\" align=center width=\"20%\">5. Platz</td></tr>\n";
  echo "</table></td></tr>\n";

?>

  </table>


<?PHP

require("bottom.php");

?>
