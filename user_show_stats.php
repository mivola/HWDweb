<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$wins         = mysql_query("SELECT u.id, u.nick_name AS nick_name, SUM(w.wins) AS wins FROM ".$season."_tbl_user u, ".$season."_tbl_wins w WHERE u.id=w.userID GROUP BY u.id ORDER BY wins DESC");
$extra_wins   = mysql_query("SELECT u.id, u.nick_name AS nick_name, SUM(e.wins) AS wins FROM ".$season."_tbl_user u, ".$season."_tbl_extra_wins e WHERE u.id=e.userID GROUP BY u.id ORDER BY wins DESC");
$max_points   = mysql_query("SELECT u.id, u.nick_name, p.play, p.points FROM ".$season."_tbl_points p, ".$season."_tbl_user u WHERE u.id=p.userID ORDER BY points DESC, u.id, p.play");
$min_points   = mysql_query("SELECT u.id, u.nick_name, p.play, p.points FROM ".$season."_tbl_points p, ".$season."_tbl_user u WHERE u.id=p.userID ORDER BY points ASC, u.id, p.play");
$three_points = mysql_query("SELECT u.id, count(*) FROM ".$season."_tbl_game g, ".$season."_tbl_bet b, ".$season."_tbl_user u WHERE u.id=b.userid AND b.game=g.id AND b.bet1=g.result1 AND b.bet2=g.result2 GROUP BY u.id ORDER BY u.id");

$max_points_row = 5;


while ($row4 = mysql_fetch_row ($three_points)) {
  $three_points_array[$row4[0]] = $row4[1]; // 3-Punkte: $row4[0]=u.id, $row4[1]=count(*)
}

$i = 0;
while ($row = mysql_fetch_row ($wins)) {
  $i++;
  $id = $row[0];
  $users[$i][0] = $row[0]; // id
  $users[$i][1] = $row[1]; // nick_name
  $users[$i][2] = $row[2]; // wins

  $points = mysql_query("SELECT u.id, u.nick_name AS nick_name, SUM(p.points) AS points, MAX(p.points) AS max, MIN(p.points) AS min, round(AVG(p.points), 2) AS avg FROM ".$season."_tbl_user u, ".$season."_tbl_points p WHERE u.id=p.userID AND u.id=".$id." GROUP BY u.id");
  while ($row2 = mysql_fetch_row ($points)) {
    $users[$i][3] = $row2[2]; // points
    $users[$i][6] = $row2[3]; // maxs
    $users[$i][7] = $row2[4]; // mins
    $users[$i][8] = $row2[5]; // avgs
    $users[$i][9] = $three_points_array[$users[$i][0]]; // 3-Punkte
    $users[$i][10]= $users[$i][3] - $users[$i][9]*3; // 1er
  }
  
  $extra_wins = mysql_query("SELECT e.userid, e.wins FROM ".$season."_tbl_extra_wins e WHERE e.userid=".$id);
  while ($row3 = mysql_fetch_row ($extra_wins)) {
    $users[$i][4] = $row3[1]/2; // extra_wins
  }

  if ( ! strpos($users[$i][4], ".") ) {
    $users[$i][4] = $users[$i][4].".0";
  }

  $users[$i][5] = $users[$i][4] + $users[$i][2]; // all wins

  if ( ! strpos($users[$i][5], ".") ) {
    $users[$i][5] = $users[$i][5].".0";
  }

  $userids[$i] = $row[0];
  $userpoints[$i] = $users[$i][5].$users[$i][4];
  $userwins[$i] = $users[$i][5];
  $user_sort[$i] = $users[$i][5]."0".$users[$i][3];
  $user_sort_save[$i] = $user_sort[$i]; // zur Ausgabe
  $user_sort[$i] = $user_sort[$i] + 0; // Sortierkriterium
  //problem: unterschiedliche nachkommastellen (2.00101 va 2.0099)

}

require("close_db.php");

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Aktuelle Stastistik</b><br><br>";

?>

  <table border="0">
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>Spieler</b></td>
      <td valign=top><b>Gesamtpunkte</b></td>
      <td valign=top><b>Tipppunkte</b></td>
      <td valign=top><b>Maximum</b></td>
      <td valign=top><b>Minimum</b></td>
      <td valign=top><b>Durchschnitt</b></td>
      <td valign=top><b>3er</b></td>
      <td valign=top><b>1er</b></td>
    </tr>

<?PHP

//  array_multisort($userpoints, SORT_DESC, $userwins);
//  array_multisort($userwins, SORT_DESC, $userids);

//array_multisort($user_sort, SORT_DESC, $userwins, $userids, $users[1], $users[2], $users[3], $users[4]);

  // Array sortieren


  //do {
  for ($j=1; $j <= count($users); $j++) {
    $sorted = true;
    $max = 0;
    $id = -1;
    for ($i=1; $i <= count($users); $i++) {
      if ($max < $user_sort[$i]) {
        $max = $user_sort[$i];
        $sorted = false;
        $id = $i;
//echo "<br>j: $j; id: $id; max: $max";        
      } // if
    } // for
//echo "<br><b>j: $j; id: $id; max: $max</b>";  
    if (! $sorted) {
      $user_sorted[$j] = $id;
      $user_sort[$id] = 0;
//echo "<br>j: $j; user_sorted[j]: $user_sorted[$j]";        
    } // if
   
  //    if ($user_sort[$i] < $user_sort[$i+1]) {
  //      $sorted = false;
  //    } // if

//    } // for

//    $user_sorted[1] = $users[

  //} while (! $sorted);
  } // for



  for ($i=0; $i < count($users); $i++) {
    if (($i % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }
    //$sort_id = $i+1;
    $sort_id = $user_sorted[$i+1];
    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$users[$sort_id][1]."</td>";
    echo "<td align=right>".$users[$sort_id][2]." + ".$users[$sort_id][4]." = ".$users[$sort_id][5]."</td>";
    echo "<td align=right>".$users[$sort_id][3]."</td>";
    echo "<td align=right>".$users[$sort_id][6]."</td>";
    echo "<td align=right>".$users[$sort_id][7]."</td>";
    echo "<td align=right>".$users[$sort_id][8]."</td>";    
    echo "<td align=right>".$users[$sort_id][9]."</td>";    
    echo "<td align=right>".$users[$sort_id][10]."</td>";    
//echo "<td>sort: ".$user_sorted[$i]."</td>";
    echo "</tr>\n";

  } // for

//    echo "<tr><td>---------</td></tr>";
          // zum aktivieren $i auf 1 setzen!
  for ($i=100; $i <= count($users); $i++) {
//    echo $userids[$i-1]."-".$userwins[$i-1];
    //$sort_id = $userids[$i-1];
    $sort_id = $i;
    if (($i % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$users[$sort_id][1]."</td>";
    echo "<td align=right>".$users[$sort_id][2]." + ".$users[$sort_id][4]." = ".$users[$sort_id][5]."</td>";
    echo "<td>".$users[$sort_id][3]."</td>";

//    echo "<td>sort: ".$user_sort[$i]."</td>";
    echo "</tr>\n";


  } // while

?>
  </table>


<p></p>
<br><b>Saisonrekorde - Maximum</b><br><br>
  <table border="0">
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>Spieler</b></td>
      <td valign=top><b>Spieltag</b></td>
      <td valign=top><b>Punkte</b></td>
    </tr>

<?PHP

  $old_points = 0;
  for ($i = 1; $i <= mysql_num_rows($max_points); $i++){
  
    $row = mysql_fetch_array($max_points);
    
    if ( ($max_points_row >= $i) ||
         ($max_points_row < $i) && ($row["points"] == $old_points) ) {
             
    if (($i % 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }
  
    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$row["nick_name"]."</td>";
    echo "<td align=right>".$row["play"]."</td>";
    echo "<td align=right>".$row["points"]."</td>";
    echo "</tr>\n";

      $old_points = $row["points"];
      
    } else { // if  
      $i = mysql_num_rows($min_points);
    }

  } // for

?>

  </table>
  
<br><b>Saisonrekorde - Minimum</b><br><br>
  <table border="0">
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>Spieler</b></td>
      <td valign=top><b>Spieltag</b></td>
      <td valign=top><b>Punkte</b></td>
    </tr>

<?PHP

  $old_points = 0;
  for ($i = 1; $i <= mysql_num_rows($min_points); $i++){
  
    $row = mysql_fetch_array($min_points);
//echo "<br>old: $old_points - new: ".$row["points"];    
    if ( ($max_points_row >= $i) ||
         ($max_points_row < $i) && ($row["points"] == $old_points) ) {
    
      if (($i % 2) == 1) { $style = $table_lineA; }
      else { $style = $table_lineB; }
  
      echo "<tr style=\"background-color:".$style.";\">";
      echo "<td>".$row["nick_name"]."</td>";
      echo "<td align=right>".$row["play"]."</td>";
      echo "<td align=right>".$row["points"]."</td>";
      echo "</tr>\n";
    
      $old_points = $row["points"];
      
    } else { // if  
      $i = mysql_num_rows($min_points);
    }
  } // for

?>

  </table>

<?PHP

require("bottom.php");

?>


