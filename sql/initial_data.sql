SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';

DROP TABLE IF EXISTS `tbl_bet`;
CREATE TABLE `tbl_bet` (
  `id` int(6) NOT NULL auto_increment,
  `userID` int(2) default NULL,
  `game` int(10) NOT NULL default '0',
  `bet1` int(2) NOT NULL default '0',
  `bet2` int(2) NOT NULL default '0',
  `joker1` int(1) NOT NULL default '0',
  `bet_ts` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22609 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tbl_extra_wins`;
CREATE TABLE `tbl_extra_wins` (
  `userID` int(2) NOT NULL default '0',
  `season` int(2) NOT NULL default '0',
  `champ` int(1) default NULL,
  `second` int(2) default NULL,
  `third` int(2) default NULL,
  `forth` int(2) default NULL,
  `fifth` int(2) default NULL,
  `down1` int(2) default NULL,
  `down2` int(2) default NULL,
  `down3` int(2) default NULL,
  `up1` int(2) default NULL,
  `up2` int(2) default NULL,
  `up3` int(2) default NULL,
  `fired` int(2) default NULL,
  `fired2` int(2) default NULL,
  `wins` int(2) default NULL,
  PRIMARY KEY  (`userID`,`season`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_extra_wins` (`userID`, `season`, `champ`, `second`, `third`, `forth`, `fifth`, `down1`, `down2`, `down3`, `up1`, `up2`, `up3`, `fired`, `fired2`, `wins`) VALUES
(0,	10,	5,	4,	10,	12,	32,	6,	11,	25,	9,	36,	14,	16,	20,	0);

DROP TABLE IF EXISTS `tbl_game`;
CREATE TABLE `tbl_game` (
  `id` int(10) NOT NULL auto_increment,
  `play` int(5) NOT NULL default '0',
  `team1` int(2) NOT NULL default '0',
  `team2` int(2) NOT NULL default '0',
  `p_ts` int(10) default NULL,
  `result1` int(2) default NULL,
  `result2` int(2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2458 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tbl_play`;
CREATE TABLE `tbl_play` (
  `id` int(5) NOT NULL auto_increment,
  `season` int(2) NOT NULL default '0',
  `recorded` int(1) NOT NULL default '0',
  `completed` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_play` (`id`, `season`, `recorded`, `completed`) VALUES
(1,	11,	0,	0), 
(2,	11,	0,	0), 
(3,	11,	0,	0), 
(4,	11,	0,	0), 
(5,	11,	0,	0), 
(6,	11,	0,	0), 
(7,	11,	0,	0), 
(8,	11,	0,	0), 
(9,	11,	0,	0), 
(10,	11,	0,	0), 
(11,	11,	0,	0), 
(12,	11,	0,	0), 
(13,	11,	0,	0), 
(14,	11,	0,	0), 
(15,	11,	0,	0), 
(16,	11,	0,	0), 
(17,	11,	0,	0), 
(18,	11,	0,	0), 
(19,	11,	0,	0), 
(20,	11,	0,	0), 
(21,	11,	0,	0), 
(22,	11,	0,	0), 
(23,	11,	0,	0), 
(24,	11,	0,	0), 
(25,	11,	0,	0), 
(26,	11,	0,	0), 
(27,	11,	0,	0), 
(28,	11,	0,	0), 
(29,	11,	0,	0), 
(30,	11,	0,	0), 
(31,	11,	0,	0), 
(32,	11,	0,	0), 
(33,	11,	0,	0), 
(34,	11,	0,	0);

DROP TABLE IF EXISTS `tbl_points`;
CREATE TABLE `tbl_points` (
  `id` int(5) NOT NULL auto_increment,
  `play` int(5) NOT NULL default '0',
  `userID` int(2) NOT NULL default '0',
  `points` int(2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1700 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `tbl_team1`;
CREATE TABLE `tbl_team1` (
  `id` int(2) NOT NULL default '0',
  `name` char(50) collate utf8_unicode_ci NOT NULL default '',
  `short` char(6) collate utf8_unicode_ci default NULL,
  `league` int(1) default NULL,
  `icon` varchar(25) collate utf8_unicode_ci NOT NULL default '""'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_team1` (`id`, `name`, `short`, `league`, `icon`) VALUES
(6,	'Borussia MönchenGladbach',	'MGladb',	1,	'MGladb.png'), 
(22,	'TSV Alemannia Aachen',	'Aachen',	2,	'Aachen.png'), 
(32,	'FSV Mainz 05',	'Mainz',	1,	'Mainz.png'), 
(1,	'1.FC Kaiserslautern',	'1.FCK',	1,	'1.FCK.png'), 
(2,	'1.FC Köln',	'Köln',	1,	'Köln.png'), 
(3,	'SC Freiburg',	'Freib',	1,	'Freib.png'), 
(4,	'Bayer 04 Leverkusen',	'Bayer',	1,	'Bayer.png'), 
(5,	'Borussia Dortmund',	'BVB',	1,	'BVB.png'), 
(7,	'Hamburger SV',	'HSV',	1,	'HSV.png'), 
(8,	'Hansa Rostock',	'Hansa',	2,	'Hansa.png'), 
(9,	'Hertha BSC Berlin',	'Hertha',	1,	'Hertha.png'), 
(10,	'FC Bayern München',	'FCB',	1,	'FCB.png'), 
(11,	'Eintracht Frankfurt',	'Frank',	2,	'Frank.png'), 
(12,	'Hannover 96',	'Hann96',	1,	'Hann96.png'), 
(13,	'FC Schalke 04',	'S04',	1,	'S04.png'), 
(14,	'VfL Bochum',	'Bochum',	2,	'Bochum.png'), 
(15,	'TSV 1860 München',	'1860',	2,	'1860.png'), 
(16,	'VfB Stuttgart',	'VfB',	1,	'VfB.png'), 
(17,	'VfL Wolfsburg',	'Wolfsb',	1,	'Wolfsb.png'), 
(18,	'Werder Bremen',	'Werder',	1,	'Werder.png'), 
(19,	'Erzgebirge Aue',	'Aue',	2,	'Aue.png'), 
(20,	'Karlsruher SC',	'KSC',	2,	'KSC.png'), 
(21,	'Osnabrück',	'Osna',	3,	'Osna.png'), 
(23,	'SpVgg Greuther Fürth',	'Fürth',	2,	'Fürth.png'), 
(24,	'SC Paderborn 07',	'SCPad',	2,	'SCPad.png'), 
(25,	'St. Pauli',	'Pauli',	2,	'Pauli.png'), 
(26,	'TuS Koblenz',	'Kobl',	3,	'Kobl.png'), 
(27,	'MSV Duisburg',	'Duisb',	2,	'Duisb.png'), 
(28,	'DSC Arminia Bielefeld',	'Biele',	3,	'Biele.png'), 
(29,	'Energie Cottbus',	'Cottb',	2,	'Cottb.png'), 
(30,	'Hoffenheim',	'Hoff',	1,	'Hoff.png'), 
(31,	'1.FC Nürnberg',	'1.FCN',	1,	'1.FCN.png'), 
(33,	'Carl Zeiss Jena',	'Jena',	3,	'\"\"'), 
(34,	'Wehen',	'Wehen',	3,	'\"\"'), 
(35,	'Kickers Offenbach',	'Kicker',	3,	'Kicker.png'), 
(36,	'FC Augsburg',	'Augsb',	1,	'Augsb.png'), 
(37,	'Rot-Weiß Oberhausen',	'RWO',	3,	'RWO.png'), 
(38,	'Rot-Weiss Ahlen',	'Ahlen',	3,	'\"\"'), 
(39,	'FSV Frankfurt',	'FSVFr',	2,	'FSVFr.png'), 
(40,	'FC Ingolstadt 04',	'Ingol',	2,	'Ingol.png'), 
(41,	'1. FC Union Berlin',	'Union',	2,	'Union.png'), 
(42,	'Fortuna Düsseldorf',	'Fortun',	2,	'Fortun.png'), 
(43,	'Dynamo Dresden',	'Dynamo',	2,	'Dynamo.png'), 
(44,	'Eintracht Braunschweig',	'Braun',	2,	'Braun.png'), 
(-1,	'NULL',	'NULL',	2,	'\"\"');

DROP TABLE IF EXISTS `tbl_team2`;
CREATE TABLE `tbl_team2` (
  `id2` int(2) NOT NULL default '0',
  `name2` char(50) collate utf8_unicode_ci NOT NULL default '',
  `short2` char(6) collate utf8_unicode_ci default NULL,
  `league2` int(1) default NULL,
  `icon2` varchar(25) collate utf8_unicode_ci NOT NULL default '""'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_team2` (`id2`, `name2`, `short2`, `league2`, `icon2`) VALUES
(6,	'Borussia MönchenGladbach',	'MGladb',	1,	'MGladb.png'), 
(22,	'TSV Alemannia Aachen',	'Aachen',	2,	'Aachen.png'), 
(32,	'FSV Mainz 05',	'Mainz',	1,	'Mainz.png'), 
(1,	'1.FC Kaiserslautern',	'1.FCK',	1,	'1.FCK.png'), 
(2,	'1.FC Köln',	'Köln',	1,	'Köln.png'), 
(3,	'SC Freiburg',	'Freib',	1,	'Freib.png'), 
(4,	'Bayer 04 Leverkusen',	'Bayer',	1,	'Bayer.png'), 
(5,	'Borussia Dortmund',	'BVB',	1,	'BVB.png'), 
(7,	'Hamburger SV',	'HSV',	1,	'HSV.png'), 
(8,	'Hansa Rostock',	'Hansa',	2,	'Hansa.png'), 
(9,	'Hertha BSC Berlin',	'Hertha',	1,	'Hertha.png'), 
(10,	'FC Bayern München',	'FCB',	1,	'FCB.png'), 
(11,	'Eintracht Frankfurt',	'Frank',	2,	'Frank.png'), 
(12,	'Hannover 96',	'Hann96',	1,	'Hann96.png'), 
(13,	'FC Schalke 04',	'S04',	1,	'S04.png'), 
(14,	'VfL Bochum',	'Bochum',	2,	'Bochum.png'), 
(15,	'TSV 1860 München',	'1860',	2,	'1860.png'), 
(16,	'VfB Stuttgart',	'VfB',	1,	'VfB.png'), 
(17,	'VfL Wolfsburg',	'Wolfsb',	1,	'Wolfsb.png'), 
(18,	'Werder Bremen',	'Werder',	1,	'Werder.png'), 
(19,	'Erzgebirge Aue',	'Aue',	2,	'Aue.png'), 
(20,	'Karlsruher SC',	'KSC',	2,	'KSC.png'), 
(21,	'Osnabrück',	'Osna',	3,	'Osna.png'), 
(23,	'SpVgg Greuther Fürth',	'Fürth',	2,	'Fürth.png'), 
(24,	'SC Paderborn 07',	'SCPad',	2,	'SCPad.png'), 
(25,	'St. Pauli',	'Pauli',	2,	'Pauli.png'), 
(26,	'TuS Koblenz',	'Kobl',	3,	'Kobl.png'), 
(27,	'MSV Duisburg',	'Duisb',	2,	'Duisb.png'), 
(28,	'DSC Arminia Bielefeld',	'Biele',	3,	'Biele.png'), 
(29,	'Energie Cottbus',	'Cottb',	2,	'Cottb.png'), 
(30,	'Hoffenheim',	'Hoff',	1,	'Hoff.png'), 
(31,	'1.FC Nürnberg',	'1.FCN',	1,	'1.FCN.png'), 
(33,	'Carl Zeiss Jena',	'Jena',	3,	'\"\"'), 
(34,	'Wehen',	'Wehen',	3,	'\"\"'), 
(35,	'Kickers Offenbach',	'Kicker',	3,	'Kicker.png'), 
(36,	'FC Augsburg',	'Augsb',	1,	'Augsb.png'), 
(37,	'Rot-Weiß Oberhausen',	'RWO',	3,	'RWO.png'), 
(38,	'Rot-Weiss Ahlen',	'Ahlen',	3,	'\"\"'), 
(39,	'FSV Frankfurt',	'FSVFr',	2,	'FSVFr.png'), 
(40,	'FC Ingolstadt 04',	'Ingol',	2,	'Ingol.png'), 
(41,	'1. FC Union Berlin',	'Union',	2,	'Union.png'), 
(42,	'Fortuna Düsseldorf',	'Fortun',	2,	'Fortun.png'), 
(43,	'Dynamo Dresden',	'Dynamo',	2,	'Dynamo.png'), 
(44,	'Eintracht Braunschweig',	'Braun',	2,	'Braun.png'), 
(-1,	'NULL',	'NULL',	2,	'\"\"');

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE `tbl_user` (
  `id` int(2) NOT NULL auto_increment,
  `first_name` char(50) collate utf8_unicode_ci NOT NULL default '',
  `last_name` char(50) collate utf8_unicode_ci NOT NULL default '',
  `nick_name` char(50) collate utf8_unicode_ci NOT NULL default '',
  `password` char(10) collate utf8_unicode_ci NOT NULL default '',
  `email` char(50) collate utf8_unicode_ci default NULL,
  `registration` int(10) default NULL,
  `last_loggin` int(10) default NULL,
  `show_tipps` int(1) default NULL,
  `show_long` int(1) default NULL,
  `table_head` char(7) collate utf8_unicode_ci default NULL,
  `table_lineA` char(7) collate utf8_unicode_ci default NULL,
  `table_lineB` char(7) collate utf8_unicode_ci default NULL,
  `table_colA` char(7) collate utf8_unicode_ci default NULL,
  `table_colB` char(7) collate utf8_unicode_ci default NULL,
  `table_max_points` char(7) collate utf8_unicode_ci default NULL,
  `logged_in` int(1) default NULL,
  `admin` int(1) default NULL,
  `phpMySQL` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_user` (`id`, `first_name`, `last_name`, `nick_name`, `password`, `email`, `registration`, `last_loggin`, `show_tipps`, `show_long`, `table_head`, `table_lineA`, `table_lineB`, `table_colA`, `table_colB`, `table_max_points`, `logged_in`, `admin`, `phpMySQL`) VALUES
(2,	'Michael',	'Voigt',	'micha',	'micha',	'michael.voigt@web.de',	1041968570,	1309350814,	2,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	1,	1,	1), 
(5,	'Markus',	'Heinicke',	'markus',	'sputnik',	'markus.heinicke@web.de',	1041968570,	1309988288,	2,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(1,	'Chris',	'Hünerfürst',	'hueni',	'hwdhuen',	'chris.huenerfuerst@web.de',	1041968570,	1305494373,	0,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	1,	1,	0), 
(6,	'Tobias',	'Buschmann',	'tobi',	'tobi',	'koehra@gmx.de',	1041968570,	1309377541,	1,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	1,	1,	0), 
(4,	'Nico',	'Schreier',	'nico',	'hwdtips',	'nico_at_work@gmx.de',	1041968570,	1306224890,	3,	0,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(3,	'Stev',	'Thomas',	'stev',	'bayern',	'stevi-wonder@web.de',	1041968570,	1306156921,	1,	0,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(7,	'Marcel',	'Liebing',	'marcelly',	'marcelly',	'Malies@gmx.de',	1121977725,	1304926185,	3,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	1,	0,	0), 
(8,	'Patrick',	'Kühn',	'patzi',	'passwort',	'patrick.kuehn@gmx.de',	1154442696,	1306072718,	0,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(9,	'Jan',	'Thomas',	'janosch',	'bayern',	'janoschick@web.de',	1154442831,	1305652335,	1,	0,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(10,	'Frank',	'Rostock',	'rossi',	'anal',	'rossi-@web.de',	1184959593,	1305538241,	0,	0,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(11,	'Sven',	'Lantsch',	'sven',	'sven',	'mandy_sven@hotmail.com',	1184959635,	1309569209,	1,	0,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0), 
(12,	'Thomas',	'Enge',	'chapper',	'chapper',	'mivola@gmx.de',	1282159990,	1305292763,	2,	1,	'#099990',	'#ccccc0',	'#ffff22',	'#aaaa00',	'#EBEB00',	'#CC0000',	0,	0,	0);

DROP TABLE IF EXISTS `tbl_wins`;
CREATE TABLE `tbl_wins` (
  `id` int(5) NOT NULL auto_increment,
  `play` int(5) default NULL,
  `userID` int(2) NOT NULL default '0',
  `wins` int(2) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1700 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP VIEW IF EXISTS `view_games2`;
CREATE VIEW `view_games2` AS select `t1`.`league` AS `league`,`g`.`play` AS `play`,`g`.`p_ts` AS `p_ts`,`g`.`id` AS `gameId`,`g`.`result1` AS `result1`,`g`.`result2` AS `result2`,`t1`.`id` AS `team1Id`,`t1`.`name` AS `name`,`t1`.`short` AS `short`,`t1`.`icon` AS `icon`,`t2`.`id2` AS `team2Id`,`t2`.`name2` AS `name2`,`t2`.`short2` AS `short2`,`t2`.`icon2` AS `icon2` from ((`tbl_game` `g` join `tbl_team1` `t1`) join `tbl_team2` `t2`) where ((`t1`.`id` = `g`.`team1`) and (`t2`.`id2` = `g`.`team2`)) order by `t1`.`league`,`g`.`p_ts`,`g`.`id`;



DROP TABLE IF EXISTS `tbl_team`;
CREATE TABLE `tbl_team` (
  `id` int(2) NOT NULL default '0',
  `name` char(50) collate utf8_unicode_ci NOT NULL default '',
  `short` char(6) collate utf8_unicode_ci default NULL,
  `league` int(1) default NULL,
  `icon` varchar(25) collate utf8_unicode_ci NOT NULL default '""'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `tbl_team` (`id`, `name`, `short`, `league`, `icon`) VALUES
(6,	'Borussia MönchenGladbach',	'MGladb',	1,	'MGladb.png'), 
(22,	'TSV Alemannia Aachen',	'Aachen',	2,	'Aachen.png'), 
(32,	'FSV Mainz 05',	'Mainz',	1,	'Mainz.png'), 
(1,	'1.FC Kaiserslautern',	'1.FCK',	1,	'1.FCK.png'), 
(2,	'1.FC Köln',	'Köln',	1,	'Köln.png'), 
(3,	'SC Freiburg',	'Freib',	1,	'Freib.png'), 
(4,	'Bayer 04 Leverkusen',	'Bayer',	1,	'Bayer.png'), 
(5,	'Borussia Dortmund',	'BVB',	1,	'BVB.png'), 
(7,	'Hamburger SV',	'HSV',	1,	'HSV.png'), 
(8,	'Hansa Rostock',	'Hansa',	2,	'Hansa.png'), 
(9,	'Hertha BSC Berlin',	'Hertha',	1,	'Hertha.png'), 
(10,	'FC Bayern München',	'FCB',	1,	'FCB.png'), 
(11,	'Eintracht Frankfurt',	'Frank',	2,	'Frank.png'), 
(12,	'Hannover 96',	'Hann96',	1,	'Hann96.png'), 
(13,	'FC Schalke 04',	'S04',	1,	'S04.png'), 
(14,	'VfL Bochum',	'Bochum',	2,	'Bochum.png'), 
(15,	'TSV 1860 München',	'1860',	2,	'1860.png'), 
(16,	'VfB Stuttgart',	'VfB',	1,	'VfB.png'), 
(17,	'VfL Wolfsburg',	'Wolfsb',	1,	'Wolfsb.png'), 
(18,	'Werder Bremen',	'Werder',	1,	'Werder.png'), 
(19,	'Erzgebirge Aue',	'Aue',	2,	'Aue.png'), 
(20,	'Karlsruher SC',	'KSC',	2,	'KSC.png'), 
(21,	'Osnabrück',	'Osna',	3,	'Osna.png'), 
(23,	'SpVgg Greuther Fürth',	'Fürth',	2,	'Fürth.png'), 
(24,	'SC Paderborn 07',	'SCPad',	2,	'SCPad.png'), 
(25,	'St. Pauli',	'Pauli',	2,	'Pauli.png'), 
(26,	'TuS Koblenz',	'Kobl',	3,	'Kobl.png'), 
(27,	'MSV Duisburg',	'Duisb',	2,	'Duisb.png'), 
(28,	'DSC Arminia Bielefeld',	'Biele',	3,	'Biele.png'), 
(29,	'Energie Cottbus',	'Cottb',	2,	'Cottb.png'), 
(30,	'Hoffenheim',	'Hoff',	1,	'Hoff.png'), 
(31,	'1.FC Nürnberg',	'1.FCN',	1,	'1.FCN.png'), 
(33,	'Carl Zeiss Jena',	'Jena',	3,	'\"\"'), 
(34,	'Wehen',	'Wehen',	3,	'\"\"'), 
(35,	'Kickers Offenbach',	'Kicker',	3,	'Kicker.png'), 
(36,	'FC Augsburg',	'Augsb',	1,	'Augsb.png'), 
(37,	'Rot-Weiß Oberhausen',	'RWO',	3,	'RWO.png'), 
(38,	'Rot-Weiss Ahlen',	'Ahlen',	3,	'\"\"'), 
(39,	'FSV Frankfurt',	'FSVFr',	2,	'FSVFr.png'), 
(40,	'FC Ingolstadt 04',	'Ingol',	2,	'Ingol.png'), 
(41,	'1. FC Union Berlin',	'Union',	2,	'Union.png'), 
(42,	'Fortuna Düsseldorf',	'Fortun',	2,	'Fortun.png'), 
(43,	'Dynamo Dresden',	'Dynamo',	2,	'Dynamo.png'), 
(44,	'Eintracht Braunschweig',	'Braun',	2,	'Braun.png'), 
(-1,	'NULL',	'NULL',	2,	'\"\"');


DROP VIEW IF EXISTS `view_games`;
CREATE VIEW `view_games` AS select `t1`.`league` AS `league`,`g`.`play` AS `play`,`g`.`p_ts` AS `p_ts`,`g`.`id` AS `gameId`,`g`.`result1` AS `result1`,`g`.`result2` AS `result2`,`t1`.`id` AS `team1Id`,`t1`.`name` AS `name`,`t1`.`short` AS `short`,`t1`.`icon` AS `icon`,`t2`.`id` AS `team2Id`,`t2`.`name` AS `name2`,`t2`.`short` AS `short2`,`t2`.`icon` AS `icon2` from ((`tbl_game` `g` join `tbl_team` `t1`) join `tbl_team` `t2`) where ((`t1`.`id` = `g`.`team1`) and (`t2`.`id` = `g`.`team2`)) order by `t1`.`league`,`g`.`p_ts`,`g`.`id`;
