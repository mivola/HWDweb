<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$result = mysql_query("SELECT * FROM tbl_extra_wins e WHERE userID=0");
while($row = mysql_fetch_array($result)){
  $act_champ = $row["champ"];
  $act_second = $row["second"];
  $act_third = $row["third"];
  $act_forth = $row["forth"];
  $act_fifth = $row["fifth"];
  $act_down1 = $row["down1"];
  $act_down2 = $row["down2"];
  $act_down3 = $row["down3"];
  $act_up1 = $row["up1"];
  $act_up2 = $row["up2"];
  $act_up3 = $row["up3"];
  $act_fired = $row["fired"];
  $act_fired2 = $row["fired2"];
}

// nur bis zum $lastPlayAllowed Spieltag der $lastAllowedLeague
$lastPlayAllowed = 1;
$lastAllowedLeague = 1;
$play_str = "SELECT g.play AS play, min(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g, tbl_team t WHERE p.id=g.play AND g.team1 = t.id AND t.league = ".$lastAllowedLeague." AND p.recorded > 0 AND season=".$season." AND g.play=".$lastPlayAllowed." GROUP BY g.play";

//echo $play_str;
$play = mysql_query($play_str);
$resultPlays = mysql_query("SELECT * FROM tbl_play WHERE completed>0 AND id>1");
//$str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND season=".$season." AND p.id=3 AND p_ts<SYSDATE() GROUP BY g.play";
//$resultPlays = mysql_query($str);

$result = mysql_query("SELECT e.* FROM tbl_user u, tbl_extra_wins e WHERE u.id=".$act_userid." AND e.userID=u.id");

while($row = mysql_fetch_array($result)) {
  if ( !isset($row["champ"])){ $champ=0; } else { $champ = $row["champ"]; }
  if ( !isset($row["second"])){ $second=0; } else { $second = $row["second"]; }
  if ( !isset($row["third"])){ $third=0; } else { $third = $row["third"]; }
  if ( !isset($row["forth"])){ $forth=0; } else { $forth = $row["forth"]; }
  if ( !isset($row["fifth"])){ $fifth=0; } else { $fifth = $row["fifth"]; }
  if ( !isset($row["down1"])){ $down1=0; } else { $down1 = $row["down1"]; }
  if ( !isset($row["down2"])){ $down2=0; } else { $down2 = $row["down2"]; }
  if ( !isset($row["down3"])){ $down3=0; } else { $down3 = $row["down3"]; }
  if ( !isset($row["up1"])){ $up1=0; } else { $up1 = $row["up1"]; }
  if ( !isset($row["up2"])){ $up2=0; } else { $up2 = $row["up2"]; }
  if ( !isset($row["up3"])){ $up3=0; } else { $up3 = $row["up3"]; }
  if ( !isset($row["fired"])){ $fired=0; } else { $fired = $row["fired"]; }
  if ( !isset($row["fired2"])){ $fired2=0; } else { $fired2 = $row["fired2"]; }
}

$resultBL1 = mysql_query("SELECT * FROM tbl_team WHERE league=1 ORDER BY name");
$resultBL2 = mysql_query("SELECT * FROM tbl_team WHERE league=2 ORDER BY name");

//$result_users = mysql_query("SELECT u.nick_name, e.* FROM tbl_user u, tbl_extra_wins e WHERE u.id=e.userID");

$resultUsers = mysql_query("SELECT * FROM tbl_user u, tbl_extra_wins e WHERE u.id=e.userID ORDER BY u.id");
//$resultUsers = mysql_query("SELECT * FROM tbl_user ORDER BY id");
for ($i = 1; $i <= mysql_num_rows($resultUsers); $i++){

  $row = mysql_fetch_array($resultUsers);
  $users[$i] = $row["id"];
  $user_names[$i] = $row["nick_name"];
  $user_show_tipps[$i] = $row["show_tipps"];
  if ($row["id"] == $act_userid) { $user_show_tipps[$i] = 3; }
  $points[$users[$i]] = 0;

  //extra_tipps:
  if ( !isset($row["champ"])){ $champ_array[$i]=0; } else { $champ_array[$i] = $row["champ"]; }
  if ( !isset($row["second"])){ $second_array[$i]=0; } else { $second_array[$i] = $row["second"]; }
  if ( !isset($row["third"])){ $third_array[$i]=0; } else { $third_array[$i] = $row["third"]; }
  if ( !isset($row["forth"])){ $forth_array[$i]=0; } else { $forth_array[$i] = $row["forth"]; }
  if ( !isset($row["fifth"])){ $fifth_array[$i]=0; } else { $fifth_array[$i] = $row["fifth"]; }
  if ( !isset($row["down1"])){ $down1_array[$i]=0; } else { $down1_array[$i] = $row["down1"]; }
  if ( !isset($row["down2"])){ $down2_array[$i]=0; } else { $down2_array[$i] = $row["down2"]; }
  if ( !isset($row["down3"])){ $down3_array[$i]=0; } else { $down3_array[$i] = $row["down3"]; }
  if ( !isset($row["up1"])){ $up1_array[$i]=0; } else { $up1_array[$i] = $row["up1"]; }
  if ( !isset($row["up2"])){ $up2_array[$i]=0; } else { $up2_array[$i] = $row["up2"]; }
  if ( !isset($row["up3"])){ $up3_array[$i]=0; } else { $up3_array[$i] = $row["up3"]; }
  if ( !isset($row["fired"])){ $fired_array[$i]=0; } else { $fired_array[$i] = $row["fired"]; }
  if ( !isset($row["fired2"])){ $fired2_array[$i]=0; } else { $fired2_array[$i] = $row["fired2"]; }
  if ( !isset($row["wins"])){ $wins_array[$i]=0; } else { $wins_array[$i] = $row["wins"]; }

  //echo $users[$i]."!<br>";
} //for

require("close_db.php");

$i = 0;
$BL1 = array();
$BL1_order = array();
while($row = mysql_fetch_array($resultBL1)) {
  $BL1[$i] = $row;
  $i++;
}

$i = 0;
$BL2 = array();
while($row = mysql_fetch_array($resultBL2)) {
  $BL2[$i] = $row;
  $i++;
}


require("top.php");


  //Farbdefinitionen
  $table_max2_points = "#006699";


?>
<body>
<br><b>

<?PHP
echo "Extra-Tipps sind bis zum Beginn des ".$lastPlayAllowed.". Spieltags erlaubt!";
?>
</b><br><br>

<?PHP
  if (mysql_num_rows($resultPlays) == 0) {
	  echo "<form name=\"extra_tipp\" method=post action=\"user_save_extra_tipp.php\">";
	  echo "<table>";
	  echo "<tr style=background-color:".$table_head."><td align=right>Wer? Was?</td><td>Dein Tipp</td></tr>";

//Meister
	  echo "<tr style=background-color:".$table_lineA."><td align=right>Meister</td><td align=right>";
	  echo "<select name=champ>";
  
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
	
	    if ($champ == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//Second
	  echo "<tr style=background-color:".$table_lineB."><td align=right>Platz 2</td><td align=right>";
	  echo "<select name=second>";
  
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
	
	    if ($second == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";

//Third
	  echo "<tr style=background-color:".$table_lineA."><td align=right>Platz 3</td><td align=right>";
	  echo "<select name=third>";
  
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
	
	    if ($third == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";

//Forth
	  echo "<tr style=background-color:".$table_lineB."><td align=right>Platz 4</td><td align=right>";
	  echo "<select name=forth>";
  
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
	
	    if ($forth == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";

//Fifth
	  echo "<tr style=background-color:".$table_lineA."><td align=right>Platz 5</td><td align=right>";
	  echo "<select name=fifth>";
  
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
	
	    if ($fifth == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";

//Down1
	  echo "<tr style=background-color:".$table_lineB."><td align=right>Absteiger (Platz 16)</td><td align=right>";
	  echo "<select name=down1>";
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
	
	    if ($down1 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//down2
	  echo "<tr style=background-color:".$table_lineA."><td align=right>Absteiger (Platz 17)</td><td align=right>";
	  echo "<select name=down2>";
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
	
	    if ($down2 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//down3
	  echo "<tr style=background-color:".$table_lineB."><td align=right>Absteiger (Platz 18)</td><td align=right>";
	  echo "<select name=down3>";
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
	
	    if ($down3 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//Up1
	  echo "<tr style=background-color:".$table_lineA."><td align=right>Aufsteiger (Platz 1)</td><td align=right>";
	  echo "<select name=up1>";
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
	
	    if ($up1 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//up2
	  echo "<tr style=background-color:".$table_lineB."><td align=right>Aufsteiger (Platz 2)</td><td align=right>";
	  echo "<select name=up2>";
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
	
	    if ($up2 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//up3
	  echo "<tr style=background-color:".$table_lineA."><td align=right>Aufsteiger (Platz 3)</td><td align=right>";
	  echo "<select name=up3>";
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
	
	    if ($up3 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//fired
	  echo "<tr style=background-color:".$table_lineB."><td align=right>1. Tr.Ent. - 1. Liga</td><td align=right>";
	  echo "<select name=fired>";
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
	
	    if ($fired == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";
	
//fired2
	  echo "<tr style=background-color:".$table_lineA."><td align=right>1. Tr.Ent. - 2. Liga</td><td align=right>";
	  echo "<select name=fired2>";
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
	
	    if ($fired2 == $id){
	      echo "<option value=".$id." selected>".$team."</option>\n";
	    }
	    else {
	      echo "<option value=".$id.">".$team."</option>\n";
	    }
	
	  } // for ($i
	
	  echo "</select></td></tr>\n";

	  echo "<tr></tr><tr><td class=noBorder></td><td align=right class=noBorder>";
	
	  $rightNow = mktime();
	  $alreadyToLate = 0; // 0 == false
	  //echo "0";
	  while($row = mysql_fetch_array($play)) {
	    //echo "1";
	    //echo "2: ".$rightNow;
	    //echo "2: ".$row["p_ts"];
	    if ($row["p_ts"] < $rightNow) { 
	    	$alreadyToLate = 1; 
	    }
	  }
	
	  if ($alreadyToLate == 0) {	  
	    echo "<input type=submit name=Submit value=\"Extra-Tipps speichern\"></td></tr>\n</table>";
	  } else {
	    echo "schon zu sp&auml;t :-(";	    
	  }
	
	  echo "</td></tr>\n";
	  echo "</table>";
  } else {
	  //echo "there is already some games played";
  } //if
?>


<p></p><p><b></b></p>
<table>

<?PHP


echo "<tr style=background-color:".$table_head.">";
echo "<td valign=top align=center colspan=2>Extra-Tipp</td>\n";
foreach ($user_names as $username){
  echo "<td valign=top>".$username."</td>\n";
}
echo "</tr>";

for ($i=0; $i<14; $i++){

  if (($i % 2) == 1) { $style = $table_lineA; }
  else { $style = $table_lineB; }

  echo "<tr style=\"background-color:".$style.";\">";

  switch ($i) {
//Meister
    case 0:
      echo "<td align=right>Meister</td>\n";
      echo "<td align=center>\n";

      if ($act_champ == 0) { echo "---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_champ == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($champ_array as $ch){
        echo "<td align=center ";
        if ($ch == 0) { echo ">---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($ch == $id){
              if ($ch == $act_champ) { echo " BGCOLOR=\"".$table_max_points."\""; }
              echo ">$team";
            }
          } // for ($j
        } // else
      echo "</td>\n";
      } // foreach

      break;
//Second
    case 1:
      echo "<td align=right>Platz 2</td>\n";
      echo "<td align=center>\n";

      if ($act_second == 0) { echo "---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_second == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($second_array as $ch){
        echo "<td align=center ";
        if ($ch == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($ch == $id){
              if ($ch == $act_third || $ch == $act_forth || $ch == $act_fifth) { echo " BGCOLOR=\"".$table_max2_points."\""; }
              else if ($ch == $act_second) { echo " BGCOLOR=\"".$table_max_points."\""; }              

              echo ">$team";
            }
          } // for ($j
        } // else
      echo "</td>\n";
      } // foreach

      break;
//Third
    case 2:
      echo "<td align=right>Platz 3</td>\n";
      echo "<td align=center>\n";

      if ($act_third == 0) { echo "---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_third == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($third_array as $ch){
        echo "<td align=center ";
        if ($ch == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($ch == $id){
              if ($ch == $act_second || $ch == $act_forth || $ch == $act_fifth) { echo " BGCOLOR=\"".$table_max2_points."\""; }
              else if ($ch == $act_third) { echo " BGCOLOR=\"".$table_max_points."\""; }

              echo ">$team";
            }
          } // for ($j
        } // else
      echo "</td>\n";
      } // foreach

      break;
//Forth
    case 3:
      echo "<td align=right>Platz 4</td>\n";
      echo "<td align=center>\n";

      if ($act_forth == 0) { echo "---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_forth == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($forth_array as $ch){
        echo "<td align=center ";
        if ($ch == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($ch == $id){
              if ($ch == $act_second || $ch == $act_third || $ch == $act_fifth) { echo " BGCOLOR=\"".$table_max2_points."\""; }
              else if ($ch == $act_forth) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
      echo "</td>\n";
      } // foreach

      break;
//Fifth
    case 4:
      echo "<td align=right>Platz 5</td>\n";
      echo "<td align=center>\n";

      if ($act_fifth == 0) { echo "---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_fifth == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($fifth_array as $ch){
        echo "<td align=center ";
        if ($ch == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($ch == $id){
              if ($ch == $act_second || $ch == $act_third || $ch == $act_forth) { echo " BGCOLOR=\"".$table_max2_points."\""; }
              else if ($ch == $act_fifth) { echo " BGCOLOR=\"".$table_max_points."\""; }

              echo ">$team";
            }
          } // for ($j
        } // else
      echo "</td>\n";
      } // foreach

      break;
//1.Absteiger
    case 5:
      echo "<td align=right>Relegation (Platz 16)</td>";
      echo "<td align=center align=center>";
      if ($act_down1 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_down1 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($down1_array as $d1){
        echo "<td align=center ";
        if ($d1 == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($d1 == $id){
              if ($d1 == $act_down2 || $d1 == $act_down3) { echo " BGCOLOR=\"".$table_max2_points."\""; }
			  else if ($d1 == $act_down1) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach

      break;
    //2.Absteiger
    case 6:
      echo "<td align=right>Absteiger (Platz 17)</td>";
      echo "<td align=center align=center>";
      if ($act_down2 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_down2 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($down2_array as $d2){
        echo "<td align=center ";
        if ($d2 == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($d2 == $id){
              if ($d2 == $act_down1 || $d2 == $act_down3) { echo " BGCOLOR=\"".$table_max2_points."\""; }
			  else if ($d2 == $act_down2) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
    //3.Absteiger
    case 7:
      echo "<td align=right>Absteiger (Platz 18)</td>";
      echo "<td align=center align=center>";
      if ($act_down3 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_down3 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($down3_array as $d3){
        echo "<td align=center ";
        if ($d3 == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($d3 == $id){
              if ($d3 == $act_down1 || $d3 == $act_down2) { echo " BGCOLOR=\"".$table_max2_points."\""; }
			  else if ($d3 == $act_down3) { echo " BGCOLOR=\"".$table_max_points."\""; }
                   
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;

    //1.Aufsteiger
    case 8:
      echo "<td align=right>Aufsteiger (Platz 1)</td>";
      echo "<td align=center align=center>";
      if ($act_up1 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL2); $j++){

          $row = $BL2[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_up1 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($up1_array as $u1){
        echo "<td align=center ";
        if ($u1 == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($u1 == $id){
              if ($u1 == $act_up2 || $u1 == $act_up3) { echo " BGCOLOR=\"".$table_max2_points."\""; }
			  else if ($u1 == $act_up1) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach

      break;
    //2.Aufsteiger
    case 9:
      echo "<td align=right>Aufsteiger (Platz 2)</td>";
      echo "<td align=center align=center>";
      if ($act_up2 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL2); $j++){

          $row = $BL2[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_up2 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($up2_array as $u2){
        echo "<td align=center ";
        if ($u2 == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($u2 == $id){
              if ($u2 == $act_up1 || $u2 == $act_up3) { echo " BGCOLOR=\"".$table_max2_points."\""; }
			  else if ($u2 == $act_up2) { echo " BGCOLOR=\"".$table_max_points."\""; }
     
         
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
    //3.Aufsteiger
    case 10:
      echo "<td align=right>Relegation (Platz 3)</td>";
      echo "<td align=center align=center>";
      if ($act_up3 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL2); $j++){

          $row = $BL2[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_up3 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($up3_array as $u3){
        echo "<td align=center ";
        if ($u3 == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($u3 == $id){
              if ($u3 == $act_up1 || $u3 == $act_up2) { echo " BGCOLOR=\"".$table_max2_points."\""; }
			  else if ($u3 == $act_up3) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
//TrainerEntl
    case 11:
      echo "<td align=right>1. Tr.Ent. - 1. Liga</td>";
      echo "<td align=center align=center>";
      if ($act_fired == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL1); $j++){

          $row = $BL1[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_fired == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($fired_array as $f){
        echo "<td align=center ";
        if ($f == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($f == $id){
              if ($f == $act_fired) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
//TrainerEnt2
    case 12:
      echo "<td align=right>1. Tr.Ent. - 2. Liga</td>";
      echo "<td align=center align=center>";
      if ($act_fired2 == 0) { echo"---"; }
      else {
        for ($j=0; $j<count($BL2); $j++){

          $row = $BL2[$j];
          if ($show_long == 1) { $team = $row["name"]; }
          else { $team = $row["short"]; }

          $id = $row["id"];

          if ($act_fired2 == $id){
            echo "$team";
          }
        } // for ($j
      } // else
      echo "</td>\n";

      foreach ($fired2_array as $f){
        echo "<td align=center ";
        if ($f == 0) { echo " >---"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($f == $id){
              if ($f == $act_fired2) { echo " BGCOLOR=\"".$table_max_points."\""; }
              
              echo ">$team";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
    // punkte
    case 13:
      echo "<td colspan=2 align=right style=background-color:\"#f0ffde\">Punkte:&nbsp;</td>\n";

      foreach ($wins_array as $w){
        $w = $w/2;
        echo "<td align=center style=background-color:".$table_lineA.">$w</td>\n";
      } // foreach
      break;
    default:
      echo "xx";
  } //switch
  echo "</tr>";

} //for i<8

?>

</table>
<?PHP

require("bottom.php");

?>
