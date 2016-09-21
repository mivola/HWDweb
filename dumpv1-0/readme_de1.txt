/*******************************************/
/* MySQL Datenbankbackup                   */
/* Modul "readme_de"                       */
/* Version 1.0 , GNU TAW24 Germany         */
/* Author Transatlantic-Web                */
/* http://www.taw24.de                     */
/*                                         */
/* modified by benjamin klatt              */
/*  <benjamin.klatt@raytion.com>           */
/*******************************************/

Die Nutzung des Scriptes ist auf eigene Gefahr.
Wir uebernehmen keinerlei Haftung fuer Systemabstuerze
oder verlorengegangene Daten.
Bei Problemen wenden Sie sich bitte an Info@taw24.de
oder www.php3-forum.de

Vielen Dank an www.php3-Forum.de und <benjamin.klatt@raytion.com> fuer gute Ideen!

-------------------------------------------------------------------------------------
Installation:

Alle Dateien in ein Verzeichniss auf dem Server kopieren.
Unterverzeichnis z.B. "backup" erstellen.(Wird sonst automatisch erstellt.)
Die Zugangsdaten für die MySQL-Datenbank und andere Variablen in "dump_cfg.inc" eintragen.
de = deutsch, en = english
Backupdateien mit aktuellem Datum versehen 0=nein/1=ja
Dateien werden dann nur noch am selben Tag ueberschrieben. Neuer Tag = neue Datei usw. 

Ueber Browser die Datei "dump.php" aufrufen....
Backup-Dateien werden im Unterverzeichnis erstellt.

-------------------------------------------------------------------------------------
FAQ:

> Keine Verbindung mit dem Server
- Die Zugangsdaten ueberpruefen. Script ist unter Win32-Apache und Unix Free-BSD getestet.

> Script bricht ab
- Je nach Menge der Daten in der Datenbank in der Datei php.ini die MAXTIME fuer 
- php-Scripte von Standard 30 Sekunden raufsetzen.

-------------------------------------------------------------------------------------
Fragen dazu oder die Version fuer mehrere Datenbanken gleichzeitig auf einem Server??? 
Info@taw24.de  