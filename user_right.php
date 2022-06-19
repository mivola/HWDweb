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
	- mit einem rechten Mausklick auf den Eintrag "http://hwd.bts-computer.de/hwd19_20" das Kontextmen&uuml; &ouml;ffnen<br>
	- w&auml;hle den Eintrag "Cookies von dieser Seite immer annehmen<br>
	<img src="images/cookie02.jpg"><br>
	- Dialog mit "Schliessen" beenden<br>
	<br>
	Jetzt fragt ihr Euch sicherlich, ob es nicht eine einfachere M&ouml;glichkeit gibt. Und ja, die gibt es:<br>
	<a href="http://www.mozilla.com/firefox/" target="_blank"><img src="images/firefox.gif" border=0></a>	
	
	</p>
	</td></tr></table>
<?php } else { //if ?>

	Herzlich willkommen bei der Online-Version von HWD zur Saison 2022/2023.</b>
	<br><br><br>
	Zwei großen Namen der Sportwettenwelt kehren nach 7-jähriger Abstinenz zu HWD zurück. Wir sind gespannt wie sich Rossi & Micha beim Comeback schlagen werden :-)<br>
	<br />
	Die Tipps der vergangenen Saison gibt es <a href="http://hwd.bts-computer.de/hwd21_22" target="_blank">hier</a>. Auch die <a href="http://hwd.bts-computer.de/hwd-history" target="_blank">HWD-History</a> ist natürlich aktualisiert!<br /> 
	<br />
	<div align="center">
	<b>Auch die HWD-App für Android wurde aktualisiert. Download nur <a href="https://github.com/mivola/hwd-app/releases/download/release-1.0.1/HWD-1.0.1.apk" target="_blank">hier</a>!
	<br>
	</p>
	
<?php } //else ?>

<?PHP require("bottom.php") ?>
