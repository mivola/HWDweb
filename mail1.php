<?PHP
session_start();
extract($_SESSION);

require("connect_db.php");

$username = mysqli_fetch_row(mysqli_query($connectedDb, "SELECT nick_name from tbl_user WHERE id=".$act_userid));

require("close_db.php");

require("top.php");

?>

<body>
<p align="center">&nbsp;</p>
<p align="center">Hier k&ouml;nnt ihr eine Mail an alle anderen Teilnehmer schicken und
denen kr&auml;tig auf den Geist gehen ;-)</p>
<form name="contact" method="post" action="mail2.php">
  <div align="center">
    <table width="100%" border="0">
      <tr>
        <td>
          <div align="right">Von</div></td>
        <td width="11">&nbsp;</td>
        <td width="479">

<?PHP
  if ($admin > 0) {
    echo "<select name=name>\n";
    echo "<option value=HWD>HWD</option>\n";
    echo "<option value=".$username[0].">".$username[0]."</option>\n";
    echo "</select>\n";
  } else {
    echo "<input name=name type=hidden value=".$username[0]." size=50>".$username[0]."\n";
  }
?>

        </td>
      </tr>
      <tr>
        <td>
          <div align="right">e-mail</div></td>
        <td width="11">&nbsp;</td>
        <td>
          <input name="email" type=hidden value=<?PHP echo $email; ?> size="50"><?PHP echo $email; ?></td>
      </tr>

      <tr>
        <td>
          <div align="right">Betreff</div></td>
        <td width="11">&nbsp;</td>
        <td>
          <input name=subject type=text size="50"></td>
      </tr>
      <tr>

      <tr>
        <td valign="top">
          <div align="right">Nachricht</div></td>
        <td width="11">&nbsp;</td>
        <td>
          <textarea name="message" cols="50" rows="10" id="message"></textarea></td>
      </tr>
      <tr>
        <td>
          <div align="right"></div></td>
        <td width="11">&nbsp;</td>
        <td>
          <input type="submit" name="Submit2" value="e-mail verschicken"></td>
      </tr>
    </table>
  </div>
</form>
<p align="center"></p>
<p align="center"></p>

<?PHP require("bottom.php"); ?>
