<?PHP
session_start();
extract($_SESSION); 
  require("top.php");

?>

<body bgcolor="#000000">
<p align="center">&nbsp;</p>
<p align="center">Hier k&ouml;nnt ihr eine Mail an den Administrator schreiben
 und &uumlber Probleme, Verbesserungsvorschl&auml;ge, etc. berichten.</p>
<form name="contact" method="post" action="contact2.php">
  <div align="center">
    <table width="100%" border="0">
      <tr>
        <td>
          <div align="right">Von</div></td>
        <td width="11">&nbsp;</td>
        <td width="479">
          <input name="name" type=hidden value=<?PHP echo $nick_name; ?> size="50"><?PHP echo $nick_name; ?>
        </td>
      </tr>
      <tr>
        <td>
          <div align="right">e-mail</div></td>
        <td width="11">&nbsp;</td>
        <td>
          <input name="email" type=hidden value=<?PHP echo $email; ?> size="50"><?PHP echo $email; ?>
        </td>
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
