<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$result = mysql_query("SELECT * FROM ".$season."_tbl_user WHERE id=".$act_userid);

require("close_db.php");

require("top.php");

?>

  <SCRIPT LANGUAGE="Javascript">

  function OpenWindow(strZiel, strName, intWidth, i){
//    if ((document.user_profile.table_head.value != "") && (strName == "Auswahl2")) {
//      strZiel = document.user_profile.table_head.value;
//    }

    Picker = window.open(strZiel, strName, 'width='+intWidth+',height=260,scrollbars=no,resizablel');

    if (document.all) {
      var ClickX = window.event.x;
      var ClickY = window.event.y;
      if (navigator.appVersion.indexOf("MSIE 5")>0 ) {
        Picker.moveTo(ClickX+window.screenLeft+5, ClickY+window.screenTop-50);
      }
    }
  }

  function MakeDef(def_type){
    document.user_profile.table_head1.value = '#999999';
    document.user_profile.table_lineA1.value = '#cccccc';
    document.user_profile.table_lineB1.value = '#ffffff';
    document.user_profile.table_colA1.value = '#aaaaaa';
    document.user_profile.table_colB1.value = '#EBEBEB';
    document.user_profile.table_max_points1.value = '#aa1144';
    makeBgColor();

  }

  function makeBgColor(){

//    document.user_profile.table_head1.style.backgroundColor = document.user_profile.table_head1.value;
//    document.user_profile.table_lineA1.style.backgroundColor = document.user_profile.table_lineA1.value;
//    document.user_profile.table_lineB1.style.backgroundColor = document.user_profile.table_lineB1.value;
//    document.user_profile.table_colA1.style.backgroundColor = document.user_profile.table_colA1.value;
//    document.user_profile.table_colB1.style.backgroundColor = document.user_profile.table_colB1.value;
//    document.user_profile.table_max_points1.style.backgroundColor = document.user_profile.table_max_points1.value;

  }

  </SCRIPT>

<body onLoad="makeBgColor()">
<br><b>Profil verwalten</b><br><br>
<form name=user_profile method=post action=user_save_profile.php onSubmit="return chk_user_profile()">
<table class="noBorder">
<?PHP

while($row = mysql_fetch_array($result)) {

  echo "<tr></tr><tr><td><b>Details</b></td></tr>\n";
  echo "<tr><td align=right>Vorname</td><td>".$row["first_name"]."</td></tr>\n";
  echo "<tr><td align=right>Nachname</td><td>".$row["last_name"]."</td></tr>\n";
  echo "<tr><td align=right>Nickname</td><td>".$row["nick_name"]."</td></tr>\n";
  echo "<tr><td align=right>Email</td><td><input type=text name=tmp_email value=".$row["email"]." size=30></td></tr>\n";
  echo "<tr><td align=right>dabei seit</td><td>".date("d.m.Y", $row["registration"])." ".date("H:i:s", $row["registration"])."</td></tr>\n";
  echo "<tr><td align=right>letztes login</td><td>".date("d.m.Y", $row["last_loggin"])." ".date("H:i:s", $row["last_loggin"])."</td></tr>\n";

  echo "<tr></tr><tr><td><b>Anzeigen</b></td></tr>\n";

  echo "<tr><td align=right>Tipps anzeigen</td><td>";
  echo "<select name=show_tipps>";
  echo "<option value=0";
  if ($row["show_tipps"] == 0) { echo " selected"; }
  echo ">keine Angabe zu Tipps machen</option>\n";

  echo "<option value=1";
  if ($row["show_tipps"] == 1) { echo " selected"; }
  echo ">nur zeigen, ob schon eingetragen</option>\n";
  echo "<option value=2";
  if ($row["show_tipps"] == 2) { echo " selected"; }
  echo ">nur Tendenz zeigen</option>\n";
  echo "<option value=3";
  if ($row["show_tipps"] == 3) { echo " selected"; }
  echo ">offen zeigen</option>\n";

  echo "</select>";
  echo "</td></tr>\n";

  echo "<tr><td align=right>Daten ausf&uuml;hrlich <br>anzeigen</td>\n";
  echo "<td><select name=tmp_show_long>\n";
  echo "<option value=1";
  if ($row["show_long"] == 1) { echo " selected"; }
  echo ">ja</option>\n";
  echo "<option value=0";
  if ($row["show_long"] == 0) { echo " selected"; }
  echo ">nein</option>\n";
  echo "</select></td></tr>\n";

/*
  echo "<tr></tr><tr><td><b>Farben</b></td><td>";
  echo "<a href=\"#\" onclick=\"MakeDef(1);\">Defaultwerte einstellen</a>";
  echo "</td></tr>\n";

  echo "<tr><td align=right>Tabellenkopf</td><td><input gbColor=$table_head type=text name=table_head1 size=10 value=$table_head>\n";
  echo "<a href=\"#\" onMouseOver=\"javascript:table_head1.style.backgroundColor=table_head1.value\" onclick=\"OpenWindow('pmccolorpicker/cp.php?ziel=table_head1&f=' + user_profile.table_head1.value.substr(1,6), 'Auswahl1', 124, 1);\">\n<img src=pmccolorpicker/images/colorpicker.gif border=0 alt=Colorpicker width=16 height=16></a>\n\n";

  echo "<tr><td align=right>Tabelle Linie 1</td><td><input type=text name=table_lineA1 size=10 value=$table_lineA>\n";
  echo "<a href=\"#\" onMouseOver=\"javascript:table_lineA1.style.backgroundColor=table_lineA1.value\" onclick=\"OpenWindow('pmccolorpicker/cp.php?ziel=table_lineA1&f=' + user_profile.table_lineA1.value.substr(1,6), 'Auswahl1', 124, 1);\">\n<img src=pmccolorpicker/images/colorpicker.gif border=0 alt=Colorpicker width=16 height=16></a>\n\n";

  echo "<tr><td align=right>Tabelle Linie 2</td><td><input type=text name=table_lineB1 size=10 value=$table_lineB>\n";
  echo "<a href=\"#\" onMouseOver=\"javascript:table_lineB1.style.backgroundColor=table_lineB1.value\" onclick=\"OpenWindow('pmccolorpicker/cp.php?ziel=table_lineB1&f=' + user_profile.table_lineB1.value.substr(1,6), 'Auswahl1', 124, 1);\">\n<img src=pmccolorpicker/images/colorpicker.gif border=0 alt=Colorpicker width=16 height=16></a>\n\n";

  echo "<tr><td align=right>Tabelle Spalte 1</td><td><input type=text name=table_colA1 size=10 value=$table_colA>\n";
  echo "<a href=\"#\" onMouseOver=\"javascript:table_colA1.style.backgroundColor=table_colA1.value\" onclick=\"OpenWindow('pmccolorpicker/cp.php?ziel=table_colA1&f=' + user_profile.table_colA1.value.substr(1,6), 'Auswahl1', 124, 1);\">\n<img src=pmccolorpicker/images/colorpicker.gif border=0 alt=Colorpicker width=16 height=16></a>\n\n";

  echo "<tr><td align=right>Tabelle Spalte 2</td><td><input type=text name=table_colB1 size=10 value=$table_colB>\n";
  echo "<a href=\"#\" onMouseOver=\"javascript:table_colB1.style.backgroundColor=table_colB1.value\" onclick=\"OpenWindow('pmccolorpicker/cp.php?ziel=table_colB1&f=' + user_profile.table_colB1.value.substr(1,6), 'Auswahl1', 124, 1);\">\n<img src=pmccolorpicker/images/colorpicker.gif border=0 alt=Colorpicker width=16 height=16></a>\n\n";

  echo "<tr><td align=right>Tabelle Siegerzelle</td><td><input type=text name=table_max_points1 size=10 value=$table_max_points>\n";
  echo "<a href=\"#\" onMouseOver=\"javascript:table_max_points1.style.backgroundColor=table_max_points1.value\" onclick=\"OpenWindow('pmccolorpicker/cp.php?ziel=table_max_points1&f=' + user_profile.table_max_points1.value.substr(1,6), 'Auswahl1', 124, 1);\">\n<img src=pmccolorpicker/images/colorpicker.gif border=0 alt=Colorpicker width=16 height=16></a>\n\n";

  echo "</td>";
*/
  echo "<tr></tr><tr><td><b>Passwort</b></td></tr>\n";
  echo "<tr><td align=right>neues Passwort <br>(max. 10 Zeichen: <br>Ziffern, Buchstaben und . , !)</td><td><input type=password name=pass1 maxlength=10 size=15></td></tr>";
  echo "<tr><td align=right>neues Passwort <br>(Best&auml;tigung)</td><td><input type=password name=pass2 maxlength=10 size=15></td></tr>";

  echo "<tr><td align=right>Admin</td><td>";

  if ($row["admin"] = 1) { echo "ja"; }
  else { echo "nein"; }

  echo "</td></tr>\n";
}



?>
<tr>
<td colspan=1 align=right><input type=reset onClick="javascript:reset();makeBgColor();" value="Reset"></td>
<td colspan=1 align=right><input type=submit value="&Auml;nderungen speichern"></td></tr>
</table>
</form>
<br><br>

<?PHP

require("bottom.php");

?>




