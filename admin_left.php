<?PHP 
session_start();
extract($_SESSION);
?>

<?PHP require("top.php") ?>
<body bgcolor="#000000">
<script language=javascript>
<!--
  function openMyAdminPopup() {
    var myadmin=window.open("http://mitglied.lycos.de/mivola2/phpMyAdmin/index.php","PhpMyAdmin","width=780,height=540,resizable=1,status=no,scrollbars=yes,screenX=100,screenY=100,top=100,left=100'");
    myadmin.focus();
  }
//-->
</script>



<p align="center"><b class="capt">Hallo <?PHP echo $first_name." (".$nick_name.")" ?>,<br>Willkommen bei<br>
  </b><br>
  <font color="#000099" size="7"><strong>HWD</strong></font><br>(Admin-Mode)</p>


<table>
<tr><td>Admin:</td></tr>
<tr><td><a href="admin_show_users.php" target="right">User verwalten</a></td></tr>
<tr><td><a href="admin_choose_play_to_enter.php" target="right">Spieltag eingeben</a></td></tr>
<tr><td><a href="admin_choose_play_to_enter_bets.php" target="right">Tipps nachtr&auml;glich eingeben</a></td></tr>
<tr><td><a href="admin_choose_play_to_results.php" target="right">Ergebnisse eingeben</a></td></tr>
<tr><td><a href="admin_show_extra_tipp.php" target="right">Extra-Tipps eingeben</a></td></tr>
<!--<tr><td><a href="admin_show_teams.php" target="right">Teams verwalten</a></td></tr>-->
<tr><td><a href="mail1.php" target="right">Rundmail</a></td></tr>
<?PHP
  if ($phpMySQL > 0) {

    echo "<tr><td>";
    //if ($dbname == "mivola2_de_d") {
      //echo "<a href=\"javascript:openMyAdminPopup();\">";
      echo "<a href=http://berlin240.server4free.de/phpmyadmin/index.php target=_blank>";
    //}
    echo "phpMySQL-Admin";
    //if ($dbname == "mivola2_de_d") {
      echo "</a>\n";
    //}
    echo "</td></tr>\n";
  }

?>
<tr><td>&nbsp;</td></tr>
<tr><td>User:</td></tr>
<tr><td><a href="user_choose_play_to_enter.php" target="right">Tipps eintragen</a></td></tr>
<tr><td><a href="user_show_extra_tipp.php" target="right">Extra-Tipps</a></td></tr>
<tr><td><a href="user_choose_play_to_show.php" target="right">Konkurrenzanalyse</a></td></tr>
<tr><td><a href="user_show_profile.php" target="right">Profil verwalten</a></td></tr>
<tr><td><a href="user_show_all_plays.php" target="right">Saison&uuml;bersicht</a></td></tr>
<tr><td><a href="user_show_stats.php" target="right">Statistik</a></td></tr>
<tr><td><a href="contact1.php" target="right">Kontakt</a></td></tr>
<tr><td><a href="logout.php" target="_parent">Logout</a></td></tr>
</table>



<?PHP require("bottom.php") ?>
