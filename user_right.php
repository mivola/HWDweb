<?PHP
session_start();
extract($_SESSION);
?>

<?PHP require("top.php") ?>
<body>
<br><br>
<p><b>

<?php if($first_name == ""){ ?>
	<table widht="75%"><tr><td>
	<p align="center"><font color=red size="6"><strong>FEHLER!</strong></font></p>
	<p>
	Fehler bei der Anmeldung: Offensichtlich ist dein Browser nicht richtig für diese Seite konfiguriert.<br>
	Zur L&ouml;sung dieses Problems musst du die Cookies für die Seite "mivola.mi.funpic.de" zulassen.<br><br>
	Hier eine Kurzanleitung f&uuml;r den Internet Explorer:<br>
	- in der Stauszeile auf das kleine rote Symbol doppelklicken<br>
	<img src="images/cookie01.jpg"><br>
	- danach erscheint ein Fenster in dem schon die blockierte Seite angezeigt wird<br>
	- mit einem rechten Mausklick auf den Eintrag "http://hwd.bts-computer.de/" das Kontextmen&uuml; &ouml;ffnen<br>
	- w&auml;hle den Eintrag "Cookies von dieser Seite immer annehmen<br>
	<img src="images/cookie02.jpg"><br>
	- Dialog mit "Schliessen" beenden<br>
	<br>
	Jetzt fragt ihr Euch sicherlich, ob es nicht eine einfachere M&ouml;glichkeit gibt. Und ja, die gibt es:<br>
	<a href="http://www.mozilla.com/firefox/" target="_blank"><img src="images/firefox.gif" border=0></a>	
	
	</p>
	</td></tr></table>
<?php } else { //if ?>

	Herzlich willkommen bei der Online-Version von HWD zur Saison 2025/2026.</b>
	<br><br><br>
	Achtung: Es wird weiterhin die berühmt-berüchtigte "Maximal 4 gleiche Tipps"-Regel überprüft!<br>
	<br />
	Die Tipps der vergangenen Saison gibt es wie gewohnt <a href="http://hwd.bts-computer.de/hwd24_25" target="_blank">hier</a>. Auch die <a href="http://hwd.bts-computer.de/hwd-history" target="_blank">HWD-History</a> ist natürlich aktualisiert!<br />
	<br />
	<div align="center">
	<b>Die HWD-App für Android wurde eingestellt, stattdessen empfehlen wir einfach einen <a href="https://blog.deinhandy.de/internetseite-auf-startbildschirm-hinzufuegen-so-funktionierts-bei-android-und-ios" target="_blank">Shortcut auf dem Startbildschirm zu erstellen!</a>!
	<br>
	</p>
	
<?php } //else ?>

<?PHP require("bottom.php") ?>
