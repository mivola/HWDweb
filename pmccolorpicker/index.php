<html>

<head>
<title>PMCColorpicker</title>

  <SCRIPT LANGUAGE="Javascript">

  function OpenWindow(strZiel, strName, intWidth){
    if ((document.formular.farbe1.value != "") && (strName == "Auswahl2")) {
      strZiel = document.formular.farbe1.value;
    }

    Picker = window.open(strZiel, strName, 'width='+intWidth+',height=260,scrollbars=no,resizablel');

    if (document.all) {
      var ClickX = window.event.x;
      var ClickY = window.event.y;
      if (navigator.appVersion.indexOf("MSIE 5")>0 ) {
        Picker.moveTo(ClickX+window.screenLeft+5, ClickY+window.screenTop-50);
      }
    }
  }
  </SCRIPT>
  <link rel="stylesheet" type="text/css" href="colorpicker.css">
</head>

<body>
  <h2>PMCColorpicker</h2>
  <form name="formular">
    <table border="0">
      <tr>
        <td>Color</td>
        <td><input type="text" name="farbe1" size="10"></td>
        <td><a href="#" onclick="OpenWindow('cp.php?ZielFeld=formular.farbe1&f=' + formular.farbe1.value.substr(1,6), 'Auswahl1', 124);"><img src="images/colorpicker.gif" border="0" alt="Colorpicker" width="16" height="16"></a></td>
      </tr>
    </table>
  </form>
  <hr>
</body>

</html>
