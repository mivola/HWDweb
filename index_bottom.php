
  <table>
    <tr>
      <td align=left>
        <form name=user_in action="display_user.php" method=post>
          Nutzeranmeldung<br>
            <input type=text name=name>
            <br>
            <input type=password maxlength=10 name=pass>
            <br>
            <input type=submit value=anmelden>

        </form>
      </td>
      <td width="22">&nbsp;</td>
      <td align=right>
        <form name=admin_in action="display_admin.php" method=post>
          Administatoranmeldung<br>
            <input type=text name=name>
            <br>
            <input type=password maxlength=10 name=pass>
            <br>
            <input type=submit value=anmelden>

        </form>
      </td>
    </tr>
    <tr>
      <td colspan=3 align=center>
        <form name=send_pass action="send_pass.php" method=post>
          Passwort vergessen?
          <br>
          <input type=text name=name>
          <br><br>
          <input type=submit value="an Email senden">

        </form>
      </td>
    </tr>
  </table>
  <p>zur HWD-Saison von <a href="http://hwd.bts-computer.de/hwd04_05/" target="_blank">2004/2005</a><br>
    &copy; 2003 <a href="http://www.michavoigt.de" target=\"_blank\">Michael Voigt</a>
    im Auftrag von HWD
  </p>
</div>


<?PHP require("bottom.php") ?>
