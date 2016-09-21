<head>
<meta name="ROBOTS" content="noINDEX, noFOLLOW">
<title>MySQL Backupmodul by Transatlantic-Web</title>
</head>
<?php include ("unlink_wc.php.inc"); ?>
<?php 


/*******************************************/
/* MySQL Datenbankbackup                   */
/* Modul "dump.php"                        */
/* Version 1.0 , GNU TAW24 Germany         */
/* Author Transatlantic-Web                */
/* http://www.taw24.de                     */
/*                                         */
/* modified by benjamin klatt              */
/*  <benjamin.klatt@raytion.com>           */
/*******************************************/

//  -------------------------------------------------------------------------------------
include ("dump_cfg.inc");
include ("lang_" .$lang.".inc");
require("mimezip.php.class");

echo "<font size=+1><b>".$title."</b><br>Servername: '".$host."'</font><br>";
echo $system.php_uname().$phpversion.phpversion(). "<p>";

// Alle Datenbanken auf dem Server suchen
echo "<table border=1>";
echo "<tr><td><b>".$dbname."</b></td><td><b>".$tcount."</b></td><td><b>".$size."</b></td><td><b>".$status."</b></td></tr>";
echo "<tr><td>&nbsp;&nbsp;$db1</td>";
 $database = $db1;
 $zaehler = 0;
 $start=0;


// generate filesuffix if it should be used
if($use_date == 1)
{
	$datum = date(Ymd)."_";	
}
else
{
	$datum = "";	
}

 $file_name = $path.$datum.$database.".sql"; 
 $file_name2 = $datum.$database.".sql";
 $file_old = $path.$database.".old";
 $aktime=date("d-m-Y H:i");
 $db_name = $dump1."$aktime\n";
 $db_name.= $dump2."$database \r\n";
 if (file_exists($file_name)){unlink($file_name);}  
 $fd = fopen($file_name,"a");
 fwrite($fd, $db_name); 
 fclose($fd);     
 
// Tabellenname Array auslesen und aufbauen

$tbl_array = array(); $c = 0;
$result2 = mysql_list_tables($database);
for($x=0; $x<mysql_num_rows($result2); $x++) { 	
  $tabelle = mysql_tablename($result2,$x);
  //if ($tabelle <> "" && (substr($tabelle, 0, 2) == "5_" or $tabelle == "guests")) {
    $tbl_array[$c] = mysql_tablename($result2,$x); $c++;$zaehler++;
  //} // if
} // for

echo "<td align=right>&nbsp;".$zaehler."&nbsp;&nbsp;</td>";
flush();
// Start Ausgabe und Berechnung 
for ($y = 0; $y < $c; $y++){  
    $tabelle=$tbl_array[$y];
//echo "<h3>tabelle: $tabelle</h3>";
// Struktur der Tabelle einlesen

    $def = "";
    $def .= "DROP TABLE IF EXISTS $tabelle; \n";
    $def .= "CREATE TABLE $tabelle (\n"; 
    $result3 = mysql_db_query($database, "SHOW FIELDS FROM $tabelle",$conn_id);
    while($row = mysql_fetch_array($result3)) {
//echo "<br>$row[Field] $row[Type]";
        $def .= "    $row[Field] $row[Type]";
        if ($row["Default"] != "") $def .= " DEFAULT '$row[Default]'";
        if ($row["Null"] != "YES") $def .= " NOT NULL";
       	if ($row[Extra] != "") $def .= " $row[Extra]";
        	$def .= ",\n";
     }
     unset($index); //Michael
     $def = ereg_replace(",\n$","", $def);
     $result3 = mysql_db_query($database, "SHOW KEYS FROM $tabelle",$conn_id);
     while($row = mysql_fetch_array($result3)) {
//echo "<br>row[Key_name]   :$row[Key_name]";    
//echo "<br>row[Column_name]: $row[Column_name]";
          $kname=$row[Key_name];
          if(($kname != "PRIMARY") && ($row[Non_unique] == 0)) $kname="UNIQUE|$kname";
          if(!isset($index[$kname])) $index[$kname] = array();
          $index[$kname][] = $row[Column_name];
     }
     $xy = "";

     while(list($xy, $columns) = @each($index)) {
//echo "<br>column: $column";
//echo "<br>index : $index";
//echo "<br>xy    : $xy";
          $def .= ",\n";
          if($xy == "PRIMARY") $def .= "   PRIMARY KEY (" . implode($columns, ", ") . ")";
          else if (substr($xy,0,6) == "UNIQUE") $def .= "   UNIQUE ".substr($xy,7)." (" . implode($columns, ", ") . ")";
          else $def .= "   KEY $xy (" . implode($columns, ", ") . ")";
     }

     $def .= "\n); \n";
     
// Ende Struktur Modul
$db = @mysql_select_db($database,$conn_id); 

$tabelle="".$tabelle; 
$ergebnis=array();
$tbl_name = $dump3."$tabelle \r\n"; 
$fd = fopen($file_name,"a+"); 
fwrite($fd, $tbl_name.$def); 
fclose($fd);

	unset($data);
if ($tabelle>""){  
    $ergebnis[]=@mysql_select_db($database,$conn_id); 
    $result=mysql_query("select * from $tabelle"); 
        $anzahl= mysql_num_rows ($result); 
    $spaltenzahl = mysql_num_fields($result); 
        for ($i=0;$i<$anzahl;$i++) { 
                $zeile=mysql_fetch_array($result); 
        
                $data.="insert into $tabelle ("; 
        for ($spalte = 0; $spalte < $spaltenzahl;$spalte++) { 
              $feldname = mysql_field_name($result, $spalte); 
              if($spalte == ($spaltenzahl - 1)) 
          { 
            $data.= $feldname; 
          } 
          else 
          { 
            $data.= $feldname.","; 
          } 
        }; 
        $data.=") VALUES ("; 
                for ($k=0;$k < $spaltenzahl;$k++){ 
          if($k == ($spaltenzahl - 1)) 
          { 
                        $data.="'".addslashes($zeile[$k])."'"; 
                  } 
          else 
          { 
                        $data.="'".addslashes($zeile[$k])."',"; 
                  } 
        } 
                $data.= ");\n"; 
        } 
$data.= "\n";
} 
else 
{ 
      $ergebnis[]= $err; 
} 

$zeit = (date("d_m_Y")); 
$fd = fopen($file_name,"a+"); 
$zeit = time() - $start;
$speed = $speed+$zeit;

for ($i3=0;$i3<count($ergebnis);$i3++){ 

		fwrite($fd, $data); 
        fclose($fd);	
} 
}
$groesse = filesize($file_name) / 1024;
$place =  $place+$groesse;

echo "<td align=right>&nbsp;&nbsp;<I>".number_format($groesse,2)."</I> KB&nbsp;&nbsp;</td><td align=center> OK! </td></tr>";
echo "</table><p>".$info."<I>".$path."<BR>".$allsize.number_format($place,2)."</I> KB <p>";
echo $copyright;


////////////////////////////////
// Michael
// EMail versenden
////////////////////////////////
if (($REQUEST_METHOD=='POST')) {

  $email = 0;
////////////////////////////////
// This loop removed "dangerous" characters from the posted data
// and puts backslashes in front of characters that might cause
// problems in the database.
////////////////////////////////
  for(reset($HTTP_POST_VARS);
            $key=key($HTTP_POST_VARS);
            next($HTTP_POST_VARS)) {
    $this = addslashes($HTTP_POST_VARS[$key]);

    //$this = str_replace("\n","<br>",$this);
    $this = str_replace("<br>","\n",$this);
    //$this = strtr($this, ">", " ");
    //$this = strtr($this, "<", " ");
    //$this = strtr($this, "|", " ");
    $$key = $this;
    echo "key: $key; value: $HTTP_POST_VARS[$key]<br>";
    
  } //for
  
  
} // if (($REQUEST_METHOD=='POST')) 
else {
  foreach ($HTTP_GET_VARS as $key=> $value ){
    if($QSTRING==""){
      $QSTRING = $key.'='.urlencode($value); 
//      echo "$key=".urlencode($value)."<br>";
    } else {
      $QSTRING = $QSTRING.'&'.$key.'='.urlencode($value); 
//      echo "$key=".urlencode($value)."<br>";
    }
    
////////////////////////////////////////////////
//// send zip-file to me
////////////////////////////////////////////////
    if ($key == "email" && $value == "1") {    
    
    
        $from = "michael.voigt@web.de";
        $to = "michael.voigt@web.de";
        $subject = "mySQL-Backup von BTS-HWD: ".date(Ymd);
        $body = "mySQL-Backup von BTS-HWD: ".date(Ymd)."\n\nsiehe Zip-File im Anhang!";
      
        //require("mimezip.php.class");
        $zipfile = new zipfile();
        $filedata = fread(fopen($file_name, "r"), filesize($file_name));   
        $zipfile -> add_file($filedata, $file_name);   
        $mail = new mime_mail();
        $mail->from = $from;
        $mail->to = $to;
        $mail->subject = $subject;
        $mail->body = $body; 
        $mail->add_attachment($zipfile -> file(), $file_name2.".zip", "application/octet-stream");
        $mail->send();          
        
        echo "<br>Email an $to verschickt, falls über dieser Meldung keine Fehlermeldungen zu sehen sind!";
        
    } // if ($key == "email" && $value == "1") {    

////////////////////////////////////////////////
//// create Zip-File
////////////////////////////////////////////////
    if ($key == "zip" && $value == "1") {
      
     
//        require("mimezip.php.class");
//        $zipfile_name = $file_name2."zip";
//        $zipfile = new zipfile();
//        $filedata = fread(fopen($file_name, "r"), filesize($file_name));   
//        $zipfile -> add_file($filedata, $file_name);   
//$zipfile -> file()
//  fopen($file_name, "r"), filesize($file_name));    

//      unlink_wc($path, $file_pattern);
            
    } // if ($key == "zip" && $value == "1") {    

////////////////////////////////////////////////
//// Delete old Files
////////////////////////////////////////////////
    if ($key == "delete" && $value == "1") {
      
      $year = date(Y);
      $month = date(m) - 1;
      if ($month == 0) {
        $month = 1;
        $year = $year - 1;
      }
      if ($month < 10) {
        $month = "0".$month;
      }
      
      $file_pattern = "usr_web384_1_".$year.$month."??.sql";
//      echo "<br>file_patern: ".$file_pattern;
//      echo "<br>path: ".$path;
      unlink_wc($path, $file_pattern);
            
    } // if ($key == "delete" && $value == "1") {    

    
  } //for

} //else


exit; 
?>