<?PHP
session_start();
extract($_SESSION);

require("top.php");

?>
<body bgcolor="#000000">
<br><b>neuen User anlegen</b><br><br>

<form name="add_user_form" method="post" action="admin_add_user2.php">
  <table width="90%" border="0">
    <tr>
      <td><div align="right">Vorname</div></td>
      <td>&nbsp;</td>
      <td><input type="text" name="first_name"></td>
    </tr>
    <tr>
      <td><div align="right">Nachname</div></td>
      <td>&nbsp;</td>
      <td><input type="text" name="last_name"></td>
    </tr>
    <tr>
      <td><div align="right">Nickname</div></td>
      <td>&nbsp;</td>
      <td><input type="text" name="nick_name"></td>
    </tr>
    <tr>
      <td><div align="right">Passwort</div></td>
      <td>&nbsp;</td>
      <td>= Nickname</td>
    </tr>
    <tr>
      <td><div align="right">Email</div></td>
      <td>&nbsp;</td>
      <td><input type="text" name="email"></td>
    </tr>
    <tr>
      <td><div align="right">Admin</div></td>
      <td>&nbsp;</td>
      <td>ja <input type="radio" name="admin" value="1">
        nein <input type="radio" name="admin" value="0" checked></td>
    </tr>
    <tr>
      <td></td>
      <td>&nbsp;</td>
      <td><input type="submit" name="Submit" value="User Anlegen"></td>
    </tr>


  </table>
</form>

<?PHP

require("bottom.php");

?>
