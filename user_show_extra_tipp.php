<?PHP

session_start();
extract($_SESSION); 

require("connect_db.php");

$result = mysql_query("SELECT * FROM tbl_extra_wins e WHERE userID=0");
while($row = mysql_fetch_array($result)){
  $act_champ = $row["champ"];
  $act_down1 = $row["down1"];
  $act_down2 = $row["down2"];
  $act_down3 = $row["down3"];
  $act_up1 = $row["up1"];
  $act_up2 = $row["up2"];
  $act_up3 = $row["up3"];
  $act_fired = $row["fired"];
}

// nur bis zum 2. Spieltag
$play_str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=".$season." GROUP BY g.play";
$play_str = "SELECT g.play AS play, max(g.p_ts) AS p_ts FROM tbl_play p, tbl_game g WHERE p.id=g.play AND p.recorded > 0 AND completed = 0 AND season=".$season." AND g.play=2 GROUP BY g.play";
$play = mysql_query($play_str);


$result = mysql_query("SELECT e.* FROM tbl_user u, tbl_extra_wins e WHERE u.id=".$act_userid." AND e.userID=u.id");

while($row = mysql_fetch_array($result)) {
  if ( !isset($row["champ"])){ $champ=0; } else { $champ = $row["champ"]; }
  if ( !isset($row["down1"])){ $down1=0; } else { $down1 = $row["down1"]; }
  if ( !isset($row["down2"])){ $down2=0; } else { $down2 = $row["down2"]; }
  if ( !isset($row["down3"])){ $down3=0; } else { $down3 = $row["down3"]; }
  if ( !isset($row["up1"])){ $up1=0; } else { $up1 = $row["up1"]; }
  if ( !isset($row["up2"])){ $up2=0; } else { $up2 = $row["up2"]; }
  if ( !isset($row["up3"])){ $up3=0; } else { $up3 = $row["up3"]; }
  if ( !isset($row["fired"])){ $fired=0; } else { $fired = $row["fired"]; }
}

$resultBL1 = mysql_query("SELECT * FROM ".$season."_tbl_team1 WHERE league=1 ORDER BY name");
$resultBL2 = mysql_query("SELECT * FROM ".$season."_tbl_team1 WHERE league=2 ORDER BY name");

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
  if ( !isset($row["down1"])){ $down1_array[$i]=0; } else { $down1_array[$i] = $row["down1"]; }
  if ( !isset($row["down2"])){ $down2_array[$i]=0; } else { $down2_array[$i] = $row["down2"]; }
  if ( !isset($row["down3"])){ $down3_array[$i]=0; } else { $down3_array[$i] = $row["down3"]; }
  if ( !isset($row["up1"])){ $up1_array[$i]=0; } else { $up1_array[$i] = $row["up1"]; }
  if ( !isset($row["up2"])){ $up2_array[$i]=0; } else { $up2_array[$i] = $row["up2"]; }
  if ( !isset($row["up3"])){ $up3_array[$i]=0; } else { $up3_array[$i] = $row["up3"]; }
  if ( !isset($row["fired"])){ $fired_array[$i]=0; } else { $fired_array[$i] = $row["fired"]; }
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
?>
<body bgcolor="#000000" onLoad="makeBgColor()">
<br><b>Extra-Tipp eingeben</b><br><br>

<form name="extra_tipp" method=post action="user_save_extra_tipp.php">
<table border="0">
<?PHP

  echo "<tr><td align=right>Meister</td><td align=right>";
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

  echo "<tr><td align=right>Absteiger</td><td align=right>";
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

  echo "<tr><td align=right>Absteiger</td><td align=right>";
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

  echo "<tr><td align=right>Absteiger</td><td align=right>";
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

  echo "<tr><td align=right>Aufsteiger</td><td align=right>";
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

  echo "<tr><td align=right>Aufsteiger</td><td align=right>";
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

  echo "<tr><td align=right>Aufsteiger</td><td align=right>";
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


  echo "<tr><td align=right>1. Tr.Ent.</td><td align=right>";
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

  echo "<tr></tr><tr><td></td><td align=right>";

  $t = mktime() - 60 * 2; // 2 Minuten vor Spielbeginn
  $late = 0;
  while($row = mysql_fetch_array($play)) {
    if ($row["p_ts"] <= $t) { $late = 1; }
  }

  if ($late == 1) {
    echo "<input type=submit name=Submit value=\"Extra-Tipps speichern\">";
  } else {
    echo "schon zu sp&auml;t";
  }



  echo "</td></tr>\n";

?>

</table>
<p></p><p><b></b></p>
<table border=0>

<?PHP


echo "<tr><td valign=top align=center colspan=2 BGCOLOR=\"#0000ff\"><font color=black>Extra-Tipp</td>\n";
foreach ($user_names as $username){
  echo "<td BGCOLOR=\"#808080\" valign=top><FONT SIZE=3 color=black>".$username."</FONT></td>\n";
}
echo "</tr>";

for ($i=0; $i<9; $i++){

  echo "<tr>\n";

  switch ($i) {
    //Meister
    case 0:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Meister</font></td>\n";
      echo "<td BGCOLOR=\"#0000ff\" align=center><font color=black>\n";

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
      echo "</font></td>\n";

      foreach ($champ_array as $ch){
        echo "<td align=center ";
        if ($ch == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($ch == $id){
              if ($ch == $act_champ) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
      echo "</td>\n";
      } // foreach

      break;
    //1.Absteiger
    case 1:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Absteiger</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($d1 == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($d1 == $id){
              if ($d1 == $act_down1 || $d1 == $act_down2 || $d1 == $act_down3) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach

      break;
    //2.Absteiger
    case 2:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Absteiger</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($d2 == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($d2 == $id){
              if ($d2 == $act_down1 || $d2 == $act_down2 || $d2 == $act_down3) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
    //3.Absteiger
    case 3:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Absteiger</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($d3 == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($d3 == $id){
              if ($d3 == $act_down1 || $d3 == $act_down2 || $d3 == $act_down3) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;

    //1.Aufsteiger
    case 4:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Aufsteiger</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($u1 == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($u1 == $id){
              if ($u1 == $act_up1 || $u1 == $act_up2 || $u1 == $act_up3) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach

      break;
    //2.Aufsteiger
    case 5:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Aufsteiger</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($u2 == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($u2 == $id){
              if ($u2 == $act_up1 || $u2 == $act_up2 || $u2 == $act_up3) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
    //3.Aufsteiger
    case 6:
      echo "<td BGCOLOR=\"#808080\"><font color=black>Aufsteiger</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($u3 == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL2); $j++){

            $row = $BL2[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($u3 == $id){
              if ($u3 == $act_up1 || $u3 == $act_up2 || $u3 == $act_up3) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;
    //TrainerEntl
    case 7:
      echo "<td BGCOLOR=\"#808080\"><font color=black>1. Tr.Ent.</font></td>";
      echo "<td align=center BGCOLOR=\"#0000ff\" align=center><font color=black>";
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
        if ($f == 0) { echo " BGCOLOR=\"#c0c0c0\"><font color=black>---</font>"; }
        else {

          for ($j=0; $j<count($BL1); $j++){

            $row = $BL1[$j];
            if ($show_long == 1) { $team = $row["name"]; }
            else { $team = $row["short"]; }

            $id = $row["id"];

            if ($f == $id){
              if ($f == $act_fired) { echo " BGCOLOR=\"#008080\""; }
              else { echo " BGCOLOR=\"#c0c0c0\""; }
              echo "><font color=black>$team</font>";
            }
          } // for ($j
        } // else
        echo "</td>\n";

      } // foreach
      break;

    // punkte
    case 8:
      echo "<td></td><td></td>\n";

      foreach ($wins_array as $w){
        $w = $w/2;
        echo "<td align=center BGCOLOR=white><font color=black>$w</font></td>\n";
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
