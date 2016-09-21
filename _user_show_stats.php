<?PHP

session_start();

require("connect_db.php");

$wins = mysql_query("SELECT u.id, u.nick_name AS nick_name, SUM(w.wins) AS wins FROM tbl_user u, tbl_wins w WHERE u.id=w.userID GROUP BY u.id ORDER BY wins DESC");
$extra_wins = mysql_query("SELECT u.id, u.nick_name AS nick_name, SUM(e.wins) AS wins FROM tbl_user u, tbl_extra_wins e WHERE u.id=e.userID GROUP BY u.id ORDER BY wins DESC");

$i = 0;
while ($row = mysql_fetch_row ($wins)) {
  $i++;
  $id = $row[0];
  $users[$i][0] = $row[0]; // id
  $users[$i][1] = $row[1]; // nick_name
  $users[$i][2] = $row[2]; // wins

  $points = mysql_query("SELECT u.id, u.nick_name AS nick_name, SUM(p.points) AS points FROM tbl_user u, tbl_points p WHERE u.id=p.userID AND u.id=".$id." GROUP BY u.id");
  while ($row2 = mysql_fetch_row ($points)) {
    $users[$i][3] = $row2[2]; // points
  }
  $extra_wins = mysql_query("SELECT e.userid, e.wins FROM tbl_extra_wins e WHERE e.userid=".$id);
  while ($row3 = mysql_fetch_row ($extra_wins)) {
    $users[$i][4] = $row3[1]/2; // extra_points
  }
  $users[$i][5] = $users[$i][4] + $users[$i][2]; // all points
  $userids[$i] = $row[0];
  $userpoints[$i] = $users[$i][5].$users[$i][4];
  $userwins[$i] = $users[$i][5];
}

require("close_db.php");

require("top.php");

echo "<br><b>Aktuelle Stastistik</b><br><br>";

?>

  <table border="0">
    <tr style="background-color:<?PHP echo $table_head; ?>;">
      <td valign=top><b>Spieler</b></td>
      <td valign=top><b>Tipp-Punkte</b></td>
      <td valign=top><b>Gewinn-Punkte</b></td>
    </tr>

<?PHP

//  array_multisort($userpoints, SORT_DESC, $userwins);
//  array_multisort($userwins, SORT_DESC, $userids);
  for ($i=1; $i <= count($users); $i++) {
//    echo $userids[$i-1]."-".$userwins[$i-1];
    //$sort_id = $userids[$i-1];
    $sort_id = $i;
    if (bcmod($i, 2) == 1) { $style = $table_lineA; }
    else { $style = $table_lineB; }

    echo "<tr style=\"background-color:".$style.";\">";
    echo "<td>".$users[$sort_id][1]."</td>";
    echo "<td align=right>".$users[$sort_id][2]." + ".$users[$sort_id][4]." = ".$users[$sort_id][5]."</td>";
    echo "<td>".$users[$sort_id][3]."</td>";
    echo "</tr>\n";


  } // while

?>

  </table>


<?PHP

require("bottom.php");

?>



