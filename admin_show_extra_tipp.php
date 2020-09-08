<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$result = mysqli_query($connectedDb, "SELECT e.* FROM tbl_extra_wins e WHERE e.userID=0");

while($row = mysqli_fetch_array($result)) {
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

$resultBL1 = mysqli_query($connectedDb, "SELECT * FROM tbl_team WHERE league=1 ORDER BY name");
$resultBL2 = mysqli_query($connectedDb, "SELECT * FROM tbl_team WHERE league=2 ORDER BY name");

require("close_db.php");

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


require("top.php");
?>
<body>
<br><b>Extra-Tipps eingeben</b><br><br>

<form name="extra_tipp" method=post action="admin_save_extra_tipp.php">
<table border="0">
<?PHP

  echo "<tr style=background-color:".$table_head."><td align=right>Wer? Was?</td><td>Die Wahrheit</td></tr>";

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
  echo "<tr style=background-color:".$table_lineB."><td align=right>Relegation (Platz 16)</td><td align=right>";
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

  echo "<tr style=background-color:".$table_lineA."><td align=right>Relegation (Platz 3)</td><td align=right>";
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
  echo "<tr style=background-color:".$table_lineB."><td align=right>1. Trainerentlassung - 1. Liga</td><td align=right>";
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
  echo "<tr style=background-color:".$table_lineA."><td align=right>1. Trainerentlassung - 2. Liga</td><td align=right>";
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


  echo "<tr></tr><tr><td class=noBorder></td><td align=right class=noBorder><input type=submit name=Submit value=\"Extra-Tipps speichern\"></td></tr>\n";

?>

</table>


<?PHP

require("bottom.php");

?>
