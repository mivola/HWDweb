<?php
/*******************************************/
/* MySQL Datenbankbackup                   */
/* Modul "dump_cfg.inc"                    */
/* Version 1.0 , GNU TAW24 Germany         */
/* Author Transatlantic-Web                */
/* http://www.taw24.de                     */
/*  <info@taw24.de>                        */
/*                                         */
/* modified by benjamin klatt              */
/*  <benjamin.klatt@raytion.com>           */
/*                                         */
/*******************************************/

//  -------------------------------------------------------------------------------------
// Script configuration:
    $user = "hwd07_08";                                                 // DB User
    $pw = "0500dwh";                                                   // Passwort
    $host = "localhost";                                           // Hostname
    $db1 = "hwd07_08";                                                  // Datenbank
	$lang = "de";                                                  // Sprache  de / en
    $use_date = 1;					// Backupdateiname mit Datum versehen 0 = nein / 1 = ja
	
//  -------------------------------------------------------------------------------------
// Don't change the lines below:
	$conn_id = mysql_connect($host,$user,$pw) or die(mysql_error());
	$path="";						
	$path = $path . "backup/";                                            
	if (!is_dir($path)) mkdir($path, 0777);
     	
?>