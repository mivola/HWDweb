<?
session_start();
extract($_POST);
extract($_SESSION);

require("connect_db.php");
$str = "SELECT * from tbl_user";
$users = mysqli_query($connectedDb, $str);
require("close_db.php");


////////////////////////////////
// This checks to see if we need to add another guestbook entry.
////////////////////////////////
$notall = 1;
//if (($REQUEST_METHOD=='POST')) {

////////////////////////////////
// This loop removed "dangerous" characters from the posted data
// and puts backslashes in front of characters that might cause
// problems in the database.
////////////////////////////////
  for(reset($HTTP_POST_VARS);
            $key=key($HTTP_POST_VARS);
            next($HTTP_POST_VARS)) {
    $value=addslashes($HTTP_POST_VARS[$key]);
    $value=str_replace("<br>","\n",$this);
    //$HTTP_POST_VARS[$key] = addslashes($HTTP_POST_VARS[$key]);

echo $value;

    //$this = str_replace("\n","<br>",$this);
    //$HTTP_POST_VARS[$key] = str_replace("<br>","\n",$this);
    //$this = strtr($this, ">", " ");
    //$this = strtr($this, "<", " ");
    //$this = strtr($this, "|", " ");
    //$$key = $this;
    $$key = $value;
  }
  ////////////////////////////////
  // This will catch if someone is trying to submit a blank
  // or incomplete form.
  ////////////////////////////////


  //$name = $HTTP_POST_VARS["name"];
  //$message = $HTTP_POST_VARS["message"];
  //$email = $HTTP_POST_VARS["email"];
  //$subject = $HTTP_POST_VARS["subject"];

  $name = $_REQUEST[name];
  $message = $_REQUEST[message];
  $email = $_REQUEST[email];
  $subject = $_REQUEST[subject];

  //echo $name;
  //echo $email; 
  //echo $subject;

  if ($name && $message) {

    $notall = 0;
    $header = "From: $name<$email>\n";
    $header .= "Reply-To: $name<$email>\n";

    $body = "Du hast Post von $name ($email):\n\n";
    $body = $body.$message;

    $to = "";
    $i = 0;
    while($row = mysqli_fetch_array($users)) {
      if ($i > 0) { $to .= "; "; }
      $to .= $row["email"];
      $i++;

      mail($row["email"], $subject, $body, $header) or die ("Mail konnte nicht verschickt werden!");

    }
    //$to = "admin@hwd.bts-computer.de";



    if ($email) {
      $header = "From: HWD<admin@hwd.bts-computer.de>\n";
      $header .= "Reply-To: HWD<admin@hwd.bts-computer.de>\n";
      $body = "Deine Nachricht wurde an alle HWD-Mitglieder (".$to.") versendet:\n\n";
      $body = $body.$message."\n\n";
      $body = $body."Die Nachricht wurde erfolgreich übermittelt!";
      mail($email, $subject, $body, $header) or die ("Mail konnte nicht verschickt werden!");

    }


  } else {

    ////////////////////////////////
    // If they didn't include all the required fields set a variable
    // and keep going.
    ////////////////////////////////
    $notall = 1;

  }
//}
?>
<!-- Start Page -->
<?PHP
  require("top.php");
?>

<body bgcolor="#000000">

<?
if ($name && $message) {

  $body = "Vielen Dank für deine Nachricht:<br><br>";
  $body = $body.$message."<br><br>";
  $body = $body."Die Nachricht wurde erfolgreich an ".$to." &uuml;bermittelt!";

?>

  <p align="center">&nbsp;</p>
  <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif">
  <? echo $body; ?>
  </font></p>

<?
}
else {

  $body = "Leider hast du nicht alle benötigten Felder (Name, Nachricht) ausgefüllt.<br>";
  $body = $body."Die Nachricht konnte nicht übermittelt werden!<br>";
  $body = $body."Bitte versuch es noch <a href=javascript:history.back();>einmal</a>.";

?>

  <p align="center">&nbsp;</p>
  <p align="center"><font face="Verdana, Arial, Helvetica, sans-serif">
  <? echo $body; ?>
  </font></p>

<?
}
?>
<?PHP 

require("bottom.php"); ?>
