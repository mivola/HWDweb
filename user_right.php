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

	Herzlich willkommen bei der Online-Version von HWD zur Saison 2019/2020.</b>
	<br><br><br>
	Wie gewohnt steht euch rechtzeitig die neue Tippseite zur Verf&uuml;gung. Ich bin gespannt zu erfahren wie viele von euch auf RBL als kommenden Meister (oder Absteiger) tippen ;-)<br>
	<br />
	Die Tipps der vergangenen Saison gibt es <a href="http://hwd.bts-computer.de/hwd18_19" target="_blank">hier</a>.<br /> 
	<br />
	<div align="center">
	<b>ACHTUNG: Ab 05/2017 ganz neu & ohne Werbung:</b>	HWD als Android App. Download nur <a href="https://github.com/mivola/hwd-app/releases/download/release-1.0.0/HWD-1.0.0-10.apk" target="_blank">hier</a> oder per QR Code!
	</div>
			<br>
	                <div align="center">
						<!-- erstellt mit https://www.qrcode-monkey.de -->
                        <img src="qrcode.png" style="width:111px;">
                    </div>
		    
		    <div align="center">
			Hier bekommst du einen <a href="https://play.google.com/store/apps/details?id=com.application_4u.qrcode.barcode.scanner.reader.flashlight&rdid=com.application_4u.qrcode.barcode.scanner.reader.flashlight" target="_blank">QR Code Scanner</a><br/>
		    </div>
		    
	<br>
	</p>
	
<?php } //else ?>

<?PHP require("bottom.php") ?>
