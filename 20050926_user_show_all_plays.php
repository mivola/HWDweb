<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

  $resultUsers = mysql_query("SELECT * FROM ".$season."_tbl_user u ORDER BY u.id");
  for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){

    $row = mysql_fetch_array($resultUsers);
    $users[$i] = $row["id"];
    $user_names[$i] = $row["nick_name"];
    $user_show_tipps[$i] = $row["show_tipps"];

  } //for

$resultPlays = mysql_query("SELECT id FROM ".$season."_tbl_play WHERE season=".$season." ORDER BY id");
$i = 1;
while ($row = mysql_fetch_row($resultPlays)) {
  $plays[$i] = $row[0];
  $i++;
}

foreach($plays as $play) {

  $resultUsers = mysql_query("SELECT * FROM ".$season."_tbl_user u, ".$season."_tbl_points p WHERE p.userID=u.id AND p.play=".$play." ORDER BY u.id");


  foreach ($users as $user_id){
    $results[$play][$user_id] = "---";
  }
  $max = 0;
  $min = 99;
  $sum = 0;
  $results[$play][-1] = $max;
  for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){
    $row = mysql_fetch_array($resultUsers);
    $results[$play][$i] = $row["points"];
    if ($max < $results[$play][$i]) { $max = $results[$play][$i]; }
    $results[$play][-1] = $max;
    if ($min > $results[$play][$i]) { $min = $results[$play][$i]; }
    $results[$play][-2] = $min;
    $sum = $sum + $results[$play][$i];


  } //for
  
  //durchschnitt
  if ($sum > 0){
    $results[$play][-3] = round($sum/mysql_num_rows($resultUsers), 2);
    if (! strpos($results[$play][-3], ".")) {
      $results[$play][-3] = $results[$play][-3].".00";
    }
    if (strlen($results[$play][-3]) < 4) {      
      $results[$play][-3] = $results[$play][-3]."0";
    } //if
    
  } else {
    $results[$play][-3] = "";
  } //if
} // foreach





require("close_db.php");

require("top.php");

echo "<body bgcolor=\"#000000\"><br><b>Saison&uuml;bersicht</b><br><br>";

  //Farbdefinitionen
  $table_max2_points = "#006699";
  $table_max3_points = "#009900";  
  
  echo "<table border=\"0\">";
  
  //Legende
  //echo "<tr><td colspan=13 align=right><table>\n";
  //echo "<tr><td colspan=3 align=left><b>Legende</b></td></tr>\n";
  echo "<tr><td colspan=2 align=right><b>Legende:</b></td>\n";
  echo "<td colspan=7><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=0><tr><td style=\"background-color:".$table_max_points.";\" align=center width=\"33%\">1. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max2_points.";\" align=center width=\"33%\">2. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max3_points.";\" align=center width=\"34%\">3. Platz</td></tr>\n";
  echo "</table></td></tr>\n";
  
  ?>
  
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>TipTag</b></td>
      <td valign=top><b>Spieltag</b></td>

      <?PHP
        foreach ($user_names as $username){
          echo "<td><b>".$username."</b></td>\n";
        }
      ?>     
      
      <td valign=top><b>Durchschnitt</b></td> 
    </tr>

<?PHP
  foreach($plays as $play) {
    echo "<tr>";
    echo "<td bgColor=#c0c0c0 align=center>";
    if ($results[$play][-1] > 0) { echo "<a href=user_show_all_bets.php?play=$play>$play</a>"; }
    echo "</td>"; // TipTag
    echo "<td bgColor=#3300ff align=center><font color=black>$play</font></td>"; // SpielTag
    foreach ($users as $user_id){
      echo "<td ";
      
      $bgc = "#ffffff";
      //minimum
      if ( ($results[$play][-2] < 99) && ($results[$play][-2] == $results[$play][$user_id]) ) { $bgc="#cc0000"; } //echo "bgColor=#AA8080 "; }
//      else { echo "bgColor=#ffffff "; }
      //maximum
      if ( ($results[$play][-1] > 0) && ($results[$play][-1] == $results[$play][$user_id]) ) { $bgc="#008080"; } //echo "bgColor=#008080 "; }
//      else { echo "bgColor=#ffffff "; }
      
      echo "bgColor=".$bgc;
      echo " align=center><font color=black>".$results[$play][$user_id]."</font></b></td>\n";
    }

    //echo "<td>".$results[$play][-1]."</td>";

    echo "<td bgColor=#c0c0c0 align=right>".$results[$play][-3]."</td>";
    echo "</tr>";
  } // foreach

  //Legende
  //echo "<tr><td colspan=13 align=right><table>\n";
  //echo "<tr><td colspan=3 align=left><b>Legende</b></td></tr>\n";
  echo "<tr><td colspan=2 align=right><b>Legende:</b></td>\n";
  echo "<td colspan=7><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=0><tr><td style=\"background-color:".$table_max_points.";\" align=center width=\"33%\">1. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max2_points.";\" align=center width=\"33%\">2. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max3_points.";\" align=center width=\"34%\">3. Platz</td></tr>\n";
  echo "</table></td></tr>\n";

?>


  </table>

<?PHP

require("bottom.php");

?>
