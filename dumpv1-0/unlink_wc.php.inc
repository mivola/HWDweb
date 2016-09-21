<?php
////////////////////////////////////////////////
//// delete files with pattern (including * and ?)
////////////////////////////////////////////////
function unlink_wc($dir, $pattern){
   if ($dh = opendir($dir)) { 
       
       //List and put into an array all files
       while (false !== ($file = readdir($dh))){
//echo "<br>file1: ".$file;       
           if ($file != "." && $file != "..") {
               $files[] = $file;
           }
       }
       closedir($dh);
       
       
       //Split file name and extenssion
       if(strpos($pattern,".")) {
           $baseexp=substr($pattern,0,strpos($pattern,"."));
           $typeexp=substr($pattern,strpos($pattern,".")+1,strlen($pattern));
       }else{ 
           $baseexp=$pattern;
           $typeexp="";
       } 
//echo "<br><b>baseexp: ".$baseexp." - typeexp: ".$typeexp."</b>";
       
       //Escape all regexp Characters 
       $baseexp=preg_quote($baseexp); 
       $typeexp=preg_quote($typeexp); 
//echo "<br><b>baseexp: ".$baseexp." - typeexp: ".$typeexp."</b>";       
       // Allow ? and *
       $baseexp=str_replace(array("\*","\?"), array(".*","."), $baseexp);
       $typeexp=str_replace(array("\*","\?"), array(".*","."), $typeexp);
//echo "<br><b>baseexp: ".$baseexp." - typeexp: ".$typeexp."</b>";       
       //Search for pattern match
       $i=0;
       foreach($files as $file) {
//echo "<br>file2: ".$file;       
           $filename=basename($file);
//echo "<br>filename: ".$filename;                
           if(strpos($filename,".")) {
               $base=substr($filename,0,strpos($filename,"."));
               $type=substr($filename,strpos($filename,".")+1,strlen($filename));
//echo "<br>base: ".$base." - type: ".$type;                    
           }else{
               $base=$filename;
               $type="";               
           }
       
           if(preg_match("/^".$baseexp."$/i",$base) && preg_match("/^".$typeexp."$/i",$type))  {
           //if(preg_match("/^".$typeexp."$/i",$type))  {
               $matches[$i]=$file;
               $i++;
//echo "<br><b>matches[$i]: ".$matches[$i];
//echo "<br>baseexp: ".$baseexp;
//echo "<br>base: ".$base."</b>";
           }
       }
       
       if (count($matches) > 0){
         while(list($idx,$val) = each($matches)){
           if (substr($dir,-1) == "/"){
               unlink($dir.$val);
               echo "<br><b>FILE DELETED: ".$dir.$val."</b>";
           }else{
               unlink($dir."/".$val);
               echo "<br><b>FILE DELETED: ".$dir."/".$val."</b>";               
           } // if
         } // while
       } else { // if
         echo "<br><b>KEINE FILES ZUM LÖSCHEN GEFUNDEN !!!</b>";
       } // else
       
   }
} // end function
?>