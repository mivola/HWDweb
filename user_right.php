<?PHP
session_start();
extract($_SESSION);
?>

<?PHP require("top.php") ?>
<body bgcolor="#000000">
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
	- mit einem rechten Mausklick auf den Eintrag "http://mivola.mi.funpic.de/hwd05_06" das Kontextmen&uuml; &ouml;ffnen<br>
	- w&auml;hle den Eintrag "Cookies von dieser Seite immer annehmen<br>
	<img src="images/cookie02.jpg"><br>
	- Dialog mit "Schliessen" beenden<br>
	<br>
	Jetzt fragt ihr Euch sicherlich, ob es nicht eine einfachere M&ouml;glichkeit gibt. Und ja, die gibt es:<br>
	<a href="http://www.mozilla.com/firefox/" target="_blank"><img src="images/firefox.gif" border=0></a>	
	
	</p>
	</td></tr></table>
<?php } else { //if ?>

	Herzlich willkommen bei der Online-Version von HWD zur Saison 2012/2013.</b>
	<br><br><br>
	Nun ist auch die aktuelle Saison eröffnet! Auch wenn ich weiß, dass wahrscheinlich kaum jemand dieses Text liest und es dieses Jahr mal keine neuen Teilnehmer gibt, so wünsche ich doch allen altbekannten viel Spass und Erfolg in der neuen Saison!<br>
	<br />
	Wenn ihr euch nochmal die Tipps und Ergebnisse der letzten Saison anschauen wollt, dann gibt es <a href="http://hwd.bts-computer.de/hwd10_11" target="_blank">hier</a> die alte Version.<br /> 
	<br />
	Weiterhin gibt es unter <a href="http://hwd.bts-computer.de/hwd-ng" target="_blank">HWD History</a> ab sofort einen Überblick über die Resultate aller vergangenen Spielzeiten. Das ganze ist momentan nur eine Spielerei und sicherlich gibt es noch Einiges zu verbessern, aber wenn ich mal Zeit habe, werde ich mich darum kümmern ;-)<br />
	Zu erwähnen bleibt noch, dass diese Seite mit allen ordentlichen Browsern gut funktioniert, lediglich der Internet Explorer ist ziemlich lahm...
	<br /><br /><br />
	<div align="center">
	<b>ACHTUNG: Jetzt ganz neu!</b>	HWD als Android App. Download hier und demnächst im Android Market!
	</div>
	                <div align="center">
	URL: <a href="http://www.appsgeyser.com/getwidget/HWD." target="_blank">http://www.appsgeyser.com/getwidget/HWD.</a><br/>
	Mirror: <a href="http://www.appsgeyser.com/247677" target="_blank">http://www.appsgeyser.com/247677</a>
			</div>
			<br>
	                <div align="center">
                        <img src="http://chart.apis.google.com/chart?cht=qr&amp;chs=300x300&amp;chld=L|0&amp;chl=http%3A%2F%2Fwww.appsgeyser.com%2FHWD.apk" style="width:111px;">
                    </div>

                    <div style="margin-top: 5px" align="center">
                        <img src="images/scan_text.png">
                    </div>
		    
		    <div align="center">
			Get <a href="https://play.google.com/store/apps/details?id=la.droid.qr&hl=de" target="_blank">QR Droid</a><br/>
		    </div>
		    
	<br>
	</p>
	
<?php } //else ?>

<?PHP require("bottom.php") ?>
