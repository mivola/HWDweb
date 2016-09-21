<?php
session_start();
extract($_SESSION);

require("connect_db.php");

$result = mysql_query("Select * from ".$season."_tbl_user where nick_name = '".$_REQUEST['name']."' and password = '".$_REQUEST['pass']."' and admin <> 0");

require("close_db.php");

while($row = mysql_fetch_array($result)) {
  $act_userid = $row["id"];
  $first_name = $row["first_name"];
  $last_name = $row["last_name"];
  $nick_name = $row["nick_name"];
  $email = $row["email"];
  $show_long = $row["show_long"];
  $table_head = $row["table_head"];
  $table_lineA = $row["table_lineA"];
  $table_lineB = $row["table_lineB"];
  $table_colA = $row["table_colA"];
  $table_colB = $row["table_colB"];
  $table_max_points = $row["table_max_points"];
  $phpMySQL = $row["phpMySQL"];
  $admin = $row["admin"];
}


if (mysql_num_rows($result) == 0){

  require("index_top.php");

  echo "<font size=4 color=red>Fehlerhafte Eingabe, bitte erneut versuchen!</font><br><br>";

  require("index_bottom.php");

}

else{

//extract($_SESSION);

  require("connect_db.php");

  $result = mysql_query("UPDATE ".$season."_tbl_user SET last_loggin=".mktime().", logged_in=1 WHERE id=".$act_userid);

  require("close_db.php");

  $_SESSION['act_userid']=$act_userid;
  $_SESSION['first_name']=$first_name;
  $_SESSION['last_name']=$last_name;
  $_SESSION['nick_name']=$nick_name;
  $_SESSION['email']=$email;
  $_SESSION['table_head']=$table_head;
  $_SESSION['table_lineA']=$table_lineA;
  $_SESSION['table_lineB']=$table_lineB;
  $_SESSION['table_colA']=$table_colA;
  $_SESSION['table_colB']=$table_colB;
  $_SESSION['table_max_points']=$table_max_points;
  $_SESSION['show_long']=$show_long;
  $_SESSION['phpMySQL']=$phpMySQL;
  $_SESSION['admin']=$admin; 

  require("top.php");

  ?>

  <frameset cols="180, *" border=0>
    <frame src="admin_left.php" name="left">
    <frame src="admin_right.php" name="right">
  </frameset>
  <noframes><body></body></noframes>

<?PHP

  require("bottom.php");

}


?>
