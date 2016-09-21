<?PHP

session_start();
extract($_SESSION); 

require("connect_db.php");

$result = mysql_query("Select * from ".$season."_tbl_user");

require("close_db.php");

require("top.php");

?>
<body bgcolor="#000000">
<br><b>User verwalten</b><br><br>

<table width="100%" border="0">
  <tr style="background-color:<?PHP echo $table_head; ?>;">
    <td><b>Vorname</b></td>
    <td><b>Nachname</b></td>
    <td><b>Nickname</b></td>
    <td><b>Email</b></td>
    <td><b>Mitglied seit</b></td>
    <td><b>letzter Login</b></td>
    <td><b>Anzeige der Tipps</b></td>
    <td><b>momentan eingeloggt</b></td>
    <td><b>Admin</b></td>
    <td><b>User l&ouml;schen</b></td>
  </tr>

<?PHP

while($row = mysql_fetch_array($result)) {
  if (bcmod($row["id"], 2) == 1) { $style = $table_lineA; }
  else { $style = $table_lineB; }

  echo "<tr style=\"background-color:".$style.";\">";
  echo "<td>".$row["first_name"]."</td>";
  echo "<td>".$row["last_name"]."</td>";
  echo "<td>".$row["nick_name"]."</td>";
  echo "<td>".$row["email"]."</td>";
  echo "<td>".date("d.m.Y", $row["registration"])."<br>".date("H:i:s", $row["registration"])."</td>";

  echo "<td>".date("d.m.Y", $row["last_loggin"])."<br>".date("H:i:s", $row["last_loggin"])."</td>";



  echo "<td>".$row["show_tipps"]."</td>";

  // angemeldet?
  if ($row["logged_in"] == 0) {
    echo "<td>nein</td>";
  }
  else {
    echo "<td>ja</td>";
  }

  // Admin?
  if ($act_userid == $row["id"]) {
    echo "<td>ja (".$row["admin"].")</td>";
  }
  else {
    if ($row["admin"] <> 0) {
      echo "<td>ja (".$row["admin"].")<br><a href=admin_make_user_admin.php?userid=".$row['id']."&option=0>admin entziehen</a></td>";
    }
    else {
      echo "<td>nein (".$row["admin"].") <br><a href=admin_make_user_admin.php?userid=".$row['id']."&option=1>admin</a></td>";
    }
  }

  echo "<td><a href=admin_del_user.php?userid=".$row['id']." onClick=\"return confirm('User wirklich l&ouml;schen?')\">löschen</a></td>";


  echo "</tr>\n";
}

?>
<table>
<br><br>
<ul>
<li><a href=admin_add_user1.php>neuen User anlegen</a></li>


</ul>

<?PHP

require("bottom.php");

?>




