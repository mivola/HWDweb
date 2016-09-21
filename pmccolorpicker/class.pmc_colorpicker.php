<?
  // PMCColorpicker (c) 2001 by www.pmcweb.at
  // All rights reserved.
  // You can use this tool for free. More programs and
  // scripts like the PMCCount, ... can be found at
  // http://www.pmcweb.at
  // Have fun with this tool. PMCweb.at


  class pmc_colorpicker {
    var $f; // Farbe
    var $breite;
    var $anzahl;
    var $zellbreite;
    var $zellhoehe;
    var $zellabstand;
    var $j; // jump
    var $b; // blau
    var $img_type;
    //var $ziel;


    function pmc_colorpicker ($farbe = "FFFFFF", $blau = "00", $breite = 100, $anzahl = 5, $abstand = 1, $jump = 51, $img_type = "GIF", $ziel) {
      $this->breite = $breite;
      $this->anzahl = $anzahl;
      $this->zellabstand = $abstand;
      $this->f = $farbe;
      $this->zellbreite = floor ($this->breite / $this->anzahl);
      $this->zellhoehe = $this->zellbreite;
      $this->j = $jump;
      $this->b = $blau;
      $this->img_type = $img_type;
      $this->ziel = $ziel;
    }


    function panel () {
      $ret = "<CENTER><table border='0' cellspacing='".$this->zellabstand."' cellpadding='0'>\n";

      $r = 0;
      $g = 0;

      // von aktuellen farbe g plus ud minus die jump werte
      for ($i = 0; $i < $this->anzahl; $i++) {
        $ret .= "<tr>";
        // von aktuellen farbe r plus ud minus die jump werte
        for ($j = 0; $j < $this->anzahl; $j++) {
          $arr = $this->rgb2dec($this->f);

          // gerade ungerade noch checken
          $r_start = ($arr["r"] - round ( $this->anzahl / 2 ) * $this->j < 0) ? 0 : $arr["r"] - round ( $this->anzahl / 2) * $this->j ;
          $g_start = ($arr["g"] - round ( $this->anzahl / 2 ) * $this->j < 0) ? 0 : $arr["g"] - round ( $this->anzahl / 2) * $this->j ;

           $r = ( $r_start + $j*$this->j <= 255) ? $r_start + $j*$this->j : 255;
           $g = ( $g_start + $i*$this->j <= 255) ? $g_start + $i*$this->j : 255;

          $ret .= $this->zelle($r, $g, $this->b, 1,$this->f);
        }
        $ret .= "</tr>\n";
      }

      $ret .= "<tr><td><img src='images/l.gif' height='5'></td></tr>";

      $ret .= "<tr>";
      for ($k = 0;$k < $this->anzahl; $k++) {
        $b_start = ($this->b - round ( $this->anzahl / 2 ) * $this->j < 0) ? 0 : $this->b - round ( $this->anzahl / 2) * $this->j ;
        $b = ( $b_start + $k*$this->j <= 255) ? $b_start + $k*$this->j : 255;
        $ret .=  $this->zelle(0, 0, $b, 0,$this->f);
      }
      $ret .= "</tr>";


      $ret .= "</table></CENTER>";
      if($this->f) {
        $ret .= $this->auswahl();
      }
      $ret .= $this->diff();
      $ret .= $this->boxes();

      echo $ret;
    }


    function auswahl () {
      $ret .= "<CENTER><table><form action=\"javascript:eintragen('#$this->f', '$this->ziel')\" method=post>";
//    $ret .= "<tr><td>&nbsp;</td></tr>";
      $ret .= "<tr>";
      $ret .= "<td>
                   <img src='image.php?f=".$this->f."&t=$this->img_type' width='16' height='16' border='0' alt='#$this->f'></td>";
      $ret .= "<td  align='center'>
                 <font face='verdana' size='1'>
                   <INPUT TYPE='hidden' name='form_farbe' value='#".$this->f."'>#".$this->f."
                   <INPUT TYPE='submit' name='ok' value='OK'>
                 </font>
               </td>";
      $ret .= "</tr>";
      $ret .= "</form></table></CENTER>";
      return $ret;
    }


    function diff () {
      global $c, $anz;
      global $PHP_SELF;
      $file = basename($PHP_SELF);

      $ret .= "<table>";
      $ret .= "<tr align='left'>";
      $ret .= "<td>diff.: <b>$this->j</b><br>";

      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=1&ziel=".$this->ziel."'>1</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=3&ziel=".$this->ziel."'>3</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=5&ziel=".$this->ziel."'>5</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=10&ziel=".$this->ziel."'>10</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=20&ziel=".$this->ziel."'>20</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=30&ziel=".$this->ziel."'>30</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&anz=$anz&j=50&ziel=".$this->ziel."'>50</a> ";

      $ret .= "</td>";
      $ret .= "<tr>";
      $ret .= "</table>";
      return $ret;
    }


    function boxes () {
      global $c;
      global $PHP_SELF;
      $file = basename($PHP_SELF);

      $ret .= "<table>";
      $ret .= "<tr align='left'>";
      $ret .= "<td>boxes: <b>$this->anzahl</b><br>";

      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&j=$this->j&anz=3&ziel=".$this->ziel."'>3</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&j=$this->j&anz=5&ziel=".$this->ziel."'>5</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&j=$this->j&anz=7&ziel=".$this->ziel."'>7</a> ";
      $ret .= "<a href='$file?f=".$this->f."&b=$this->b&c=$c&j=$this->j&anz=9&ziel=".$this->ziel."'>9</a> ";

      $ret .= "</td>";
      $ret .= "<tr>";
      $ret .= "</table>";
      return $ret;
    }

    function zelle($red, $green, $blue, $c, $c_old){
      global $PHP_SELF;
      $file = basename($PHP_SELF);

      $rc= strtoupper(dechex($red));
      $gc= strtoupper(dechex($green));
      $bc= strtoupper(dechex($blue));

      if ($red<16) $rc = "0".$rc;
      if ($green<16) $gc = "0".$gc;
      if ($blue<16) $bc = "0".$bc;

      $rgb = $rc.$gc.$bc;

      $ret = "\n<td width='$this->zellbreite' height='$this->zellhoehe' bgcolor='#$rgb'><a href='$file?f=";
      if ($c == 1)
        $ret .= "$rgb";
      else
        $ret .= $c_old;
      $ret .= "&b=$blue&c=$c&j=".$this->j."&anz=$this->anzahl&ziel=".$this->ziel;
      $ret .= "'><img src='images/l.gif' width='$this->zellbreite' height='$this->zellhoehe' border='0' alt='#$rgb'></a></td>";
      return $ret;
    }


    function rgb2dec($rgbstr){
      ereg("([0-9A-F]{2})([0-9A-F]{2})([0-9A-F]{2})", $rgbstr, $c);
      if ($c[0]) {
        $arr["r"]= hexdec($c[1]);
        $arr["g"]= hexdec($c[2]);
        $arr["b"]= hexdec($c[3]);
      }
      return $arr;
    }


  } // class
?>                                                                                                                                                                                             