<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

  $resultUsers = mysql_query("SELECT * FROM tbl_user u ORDER BY u.id");
  for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){

    $row = mysql_fetch_array($resultUsers);
    $users[$i] = $row["id"];
    $user_names[$i] = $row["nick_name"];
    $user_show_tipps[$i] = $row["show_tipps"];

  } //for

$resultPlays = mysql_query("SELECT id, recorded FROM tbl_play WHERE season=".$season." ORDER BY id");
$i = 1;
while ($row = mysql_fetch_row($resultPlays)) {
  $plays[$i] = $row[0];
  $recorded[$i] = $row[1];
  $i++;
}

foreach($plays as $play) {

  $resultUsers = mysql_query("SELECT * FROM tbl_user u, tbl_points p, tbl_wins w WHERE p.userID=u.id AND p.play=".$play." AND w.userID=u.id AND w.play=p.play ORDER BY u.id");
    
  foreach ($users as $user_id){
    $results[$play][$user_id] = "---";
  } //foreach users
  
  $sum = 0;
  
  for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){
  
    $row = mysql_fetch_array($resultUsers);
    $results[$play][$i] = $row["points"];
    $wins[$play][$i] = $row["wins"];
    
    $sum = $sum + $results[$play][$i];

  } //for
  
  
  //durchschnitt
  if ($sum > 0){
    $results[$play][-13] = round($sum/mysql_num_rows($resultUsers), 2);
    if (! strpos($results[$play][-13], ".")) {
      $results[$play][-13] = $results[$play][-13].".00";
    }
    if (strlen($results[$play][-13]) < 4) {      
      $results[$play][-13] = $results[$play][-13]."0";
    } //if
    
  } else {
    $results[$play][-13] = "";
  } //if
  
  	 
} // foreach plays


require("close_db.php");

require("top.php");

echo "<body><br><b>Saison&uuml;bersicht</b><br><br>";

  //Farbdefinitionen
  $table_max2_points = "#006699";
  $table_max3_points = "#009900";
  $table_max4_points = "#22DBF1";
  $table_max5_points = "#F0FA50"; 
  
  echo "<table>";
  
  //Legende
  echo "<tr><td colspan=2 align=right class=noBorder><b>Legende:</b></td>\n";
  echo "<td colspan=12><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=0>";
  echo "<tr><td style=\"background-color:".$table_max_points.";\" align=center width=\"20%\">1. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max2_points.";\" align=center width=\"20%\">2. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max3_points.";\" align=center width=\"20%\">3. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max4_points.";\" align=center width=\"20%\">4. Platz</td>\n";
  echo "<td style=\"background-color:".$table_max5_points.";\" align=center width=\"20%\">5. Platz</td></tr>\n";
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
    if ($recorded[$play] > 0) { echo "<a href=user_show_all_bets.php?play=$play>$play</a>"; }
    echo "</td>"; // TipTag
    echo "<td bgColor=#3300ff align=center><font color=black>$play</font></td>"; // SpielTag
    
    foreach ($users as $user_id){
    
      $style = "#c0c0c0";
      
      if ($wins[$play][$user_id] == 5) { $style = $table_max_points; }
      if ($wins[$play][$user_id] == 4) { $style = $table_max2_points; }
      if ($wins[$play][$user_id] == 3) { $style = $table_max3_points; }
      if ($wins[$play][$user_id] == 2) { $style = $table_max4_points; }
      if ($wins[$play][$user_id] == 1) { $style = $table_max5_points; }

      echo "<td style=\"background-color:".$style.";\"><b>".$results[$play][$user_id]."</b></td>\n";
      
    } //foreach user

    //echo "<td>".$results[$play][-1]."</td>";

    echo "<td bgColor=#c0c0c0 align=right>".$results[$play][-13]."</td>"; //Durchschnitt
    echo "</tr>";
  } // foreach

  //Legende
  echo "<tr><td colspan=2 align=right class=noBorder><b>Legende:</b></td>\n";
  echo "<td colspan=12><table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=0>";
  echo "<tr><td style=\"background-color:".$table_max_points.";\" align=center width=\"20%\">1. Platz</td>\n";
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
