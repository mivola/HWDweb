<?
session_start();
extract($_POST);
extract($_SESSION);

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
if (isset($HTTP_POST_VARS)) {
  for(reset($HTTP_POST_VARS);
            $key=key($HTTP_POST_VARS);
            next($HTTP_POST_VARS)) {
    $thisKey = addslashes($HTTP_POST_VARS[$key]);

    //$this = str_replace("\n","<br>",$this);
    $thisKey = str_replace("<br>","\n",$thisKey);
    //$this = strtr($this, ">", " ");
    //$this = strtr($this, "<", " ");
    //$this = strtr($this, "|", " ");
    $$key = $thisKey;
  }
}  
  ////////////////////////////////
  // This will catch if someone is trying to submit a blank
  // or incomplete form.
  ////////////////////////////////

  if ($name && $message) {

    $notall = 0;
    $header = "From: $name<$email>\n";
    $header .= "Reply-To: $name<$email>\n";
    $body = "Du hast Post von $name ($email):\n\n";
    $body = $body.$message;
    mail("admin@hwd.bts-computer.de", $subject, $body, $header);

    if ($email) {
      $header = "From: HWD<admin@hwd.bts-computer.de>\n";
      $header .= "Reply-To: HWD<admin@hwd.bts-computer.de>\n";
      $body = "Vielen Dank für deine Nachricht:\n\n";
      $body = $body.$message."\n\n";
      $body = $body."Die Nachricht wurde erfolgreich übermittelt!";
      mail($email, $subject, $body, $header);

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

<body>

<?
if ($name && $message) {

  $body = "Vielen Dank für deine Nachricht:<br><br>";
  $body = $body.$message."<br><br>";
  $body = $body."Die Nachricht wurde erfolgreich übermittelt!";

?>

  <p align="center">&nbsp;</p>
  <p align="center"><? echo $body; ?></p>

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
<?PHP require("bottom.php"); ?>
