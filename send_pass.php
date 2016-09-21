<?PHP
session_start();
extract($_POST);
extract($_SESSION);

$name = $HTTP_POST_VARS["name"];

require("connect_db.php");

$result = mysql_query("SELECT password, email FROM tbl_user WHERE nick_name='".$name."'");
//echo "SELECT password, email FROM tbl_user WHERE nick_name='".$name."'";

require("close_db.php");

session_destroy();

  while ($row = mysql_fetch_row ($result)) {
    $pass = $row[0];
    $email = $row[1];
  }

if ( isset($email) ) {
  $header = "From: HWD<michael.voigt@web.de>\n";
  $header .= "Reply-To: HWD<michael.voigt@web.de>\n";
  $body = "Du (oder jemand anderes) hat dein HWD-Passwort angefordert:\n\n";
  $body .= $pass."\n\n";
  $body .= "Also nicht so schnell wieder vergessen!";
  $subject = "HWD-Passwort";
  mail($email, $subject, $body, $header);
}

require("index_top.php");

if ( isset($email) ) {
  echo "<font size=4 color=red>Dein Passwort wurde an deine gespeicherte Email-Adresse ($email) gesendet!</font><br><br>";
} else {
  echo "<font size=4 color=red>Der eingegebene Username ($name) ist nicht bekannt!</font><br><br>";
}

require("index_bottom.php");

?>
