<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$result = mysql_query("SELECT e.* FROM ".$season."_tbl_extra_wins e WHERE e.userID=0");

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

<form name="extra_tipp" method=post action="admin_save_extra_tipp.php">
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


  echo "<tr><td align=right>1. Trainerentlassung</td><td align=right>";
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

  echo "<tr></tr><tr><td></td><td align=right><input type=submit name=Submit value=\"Extra-Tipps speichern\"></td></tr>\n";

?>

</table>


<?PHP

require("bottom.php");

?>
