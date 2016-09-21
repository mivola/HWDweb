<?PHP 
session_start();
extract($_SESSION);
?>

<?PHP require("top.php") ?>
<body bgcolor="#000000">


<p align="center"><b class="capt">Hallo <?PHP echo $first_name." (".$nick_name.")" ?>,<br>Willkommen bei<br>
  </b><br>
  <font color="#000099" size="7"><strong>HWD</strong></font></p>


<table>
<tr><td><a href="user_choose_play_to_enter.php" target="right">Tipps eintragen</a></td></tr>
<tr><td><a href="user_show_extra_tipp.php" target="right">Extra-Tipps</a></td></tr>
<tr><td><a href="user_choose_play_to_show.php" target="right">Konkurrenzanalyse</a></td></tr>
<tr><td><a href="user_show_profile.php" target="right">Profil verwalten</a></td></tr>
<tr><td><a href="user_show_all_plays.php" target="right">Saison&uuml;bersicht</a></td></tr>
<tr><td><a href="user_show_stats.php" target="right">Statistik</a></td></tr>
<tr><td><a href="mail1.php" target="right">Rundmail</a></td></tr>
<tr><td><a href="contact1.php" target="right">Kontakt</a></td></tr>
<tr><td><a href="logout.php" target="_parent">Logout</a></td></tr>
</table>



<?PHP require("bottom.php") ?>
