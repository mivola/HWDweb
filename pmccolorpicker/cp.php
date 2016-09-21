<html>
<head>
<title>PMCColorpicker</title>
<link rel="stylesheet" type="text/css" href="colorpicker.css">
<script language="JavaScript">
<!--
  function eintragen(farbe, ziel) {
    if (ziel == "table_head1") {
      parent.window.opener.document.user_profile.table_head1.value = farbe;
      parent.window.opener.document.user_profile.table_head1.style.backgroundColor = farbe;
    }
    if (ziel == "table_lineA1") {
      parent.window.opener.document.user_profile.table_lineA1.value = farbe;
      parent.window.opener.document.user_profile.table_lineA1.style.backgroundColor = farbe;
    }
    if (ziel == "table_lineB1") {
      parent.window.opener.document.user_profile.table_lineB1.value = farbe;
      parent.window.opener.document.user_profile.table_lineB1.style.backgroundColor = farbe;
    }
    if (ziel == "table_colA1") {
      parent.window.opener.document.user_profile.table_colA1.value = farbe;
      parent.window.opener.document.user_profile.table_colA1.style.backgroundColor = farbe;
    }
    if (ziel == "table_colB1") {
      parent.window.opener.document.user_profile.table_colB1.value = farbe;
      parent.window.opener.document.user_profile.table_colB1.style.backgroundColor = farbe;
    }
    if (ziel == "table_max_points1") {
      parent.window.opener.document.user_profile.table_max_points1.value = farbe;
      parent.window.opener.document.user_profile.table_max_points1.style.backgroundColor = farbe;
    }

      parent.window.opener.document.bgcolor = '#ff00ff';

    //parent.window.opener.document.user_profile.farbe1.value = farbe;
    parent.window.close();
  }
//-->
</script>
</head>

<body marginheight=5 marginwidth=5 rightmargin=5 topmargin=5 leftmargin=5>
<?
  include("class.pmc_colorpicker.php");

  $breite = 100;
  $abstand = 1;
  $img_type = ($HTTP_HOST == "localhost") ? "PNG" : "GIF";

  if (!isset($f)) $f = "999999";
  if (!isset($j)) $j = 51;
  if (!isset($anz))  $anz = 5;

  //echo $ziel."<br>\n";
  $cp = new pmc_colorpicker($f, $b, $breite, $anz, $abstand, $j, $img_type, $ziel);

  $cp->panel();

?>

</body>
</html>
