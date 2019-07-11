
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `first_name` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `last_name` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `nick_name` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `password` char(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `registration` int(10) DEFAULT NULL,
  `last_loggin` int(10) DEFAULT NULL,
  `show_tipps` int(1) DEFAULT NULL,
  `show_long` int(1) DEFAULT NULL,
  `table_head` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_lineA` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_lineB` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_colA` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_colB` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `table_max_points` char(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logged_in` int(1) DEFAULT NULL,
  `admin` int(1) DEFAULT NULL,
  `phpMySQL` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `first_name`, `last_name`, `nick_name`, `password`, `email`, `registration`, `last_loggin`, `show_tipps`, `show_long`, `table_head`, `table_lineA`, `table_lineB`, `table_colA`, `table_colB`, `table_max_points`, `logged_in`, `admin`, `phpMySQL`) VALUES
(1, 'Chris', 'Hünerfürst', 'hueni', 'hwdhuen', 'chris.huenerfuerst@web.de', 1041968570, 1558279697, 0, 1, '#099990', '#ccccc0', '#ffff22', '#aaaa00', '#EBEB00', '#CC0000', 1, 1, 0),
(6, 'Tobias', 'Buschmann', 'tobi', 'tobi', 'koehra@gmx.de', 1041968570, 1558280399, 1, 1, '#099990', '#ccccc0', '#ffff22', '#aaaa00', '#EBEB00', '#CC0000', 1, 1, 1),
(4, 'Nico', 'Schreier', 'nico', 'hwdtips', 'nico_at_work@gmx.de', 1041968570, 1558280347, 0, 0, '#099990', '#ccccc0', '#ffff22', '#aaaa00', '#EBEB00', '#CC0000', 0, 0, 0),
(9, 'Jan', 'Thomas', 'janosch', 'bayern', 'janoschick@web.de', 1154442831, 1562732282, 1, 0, '#099990', '#ccccc0', '#ffff22', '#aaaa00', '#EBEB00', '#CC0000', 0, 0, 0),
(13, 'Christian', 'Schroeter', 'schroe89', 'tipphaus', 'schroe89@web.de', 1406013485, 1558275960, 0, 1, '#099990', '#ccccc0', '#ffff22', '#aaaa00', '#EBEB00', '#CC0000', 1, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_bet`
--

DROP TABLE IF EXISTS `tbl_bet`;
CREATE TABLE IF NOT EXISTS `tbl_bet` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `userID` int(2) DEFAULT NULL,
  `game` int(10) NOT NULL DEFAULT '0',
  `bet1` int(2) NOT NULL DEFAULT '0',
  `bet2` int(2) NOT NULL DEFAULT '0',
  `joker1` int(1) NOT NULL DEFAULT '0',
  `bet_ts` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7261 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_extra_wins`
--

DROP TABLE IF EXISTS `tbl_extra_wins`;
CREATE TABLE IF NOT EXISTS `tbl_extra_wins` (
  `userID` int(2) NOT NULL DEFAULT '0',
  `season` int(2) NOT NULL DEFAULT '0',
  `champ` int(1) DEFAULT NULL,
  `second` int(2) DEFAULT NULL,
  `third` int(2) DEFAULT NULL,
  `forth` int(2) DEFAULT NULL,
  `fifth` int(2) DEFAULT NULL,
  `down1` int(2) DEFAULT NULL,
  `down2` int(2) DEFAULT NULL,
  `down3` int(2) DEFAULT NULL,
  `up1` int(2) DEFAULT NULL,
  `up2` int(2) DEFAULT NULL,
  `up3` int(2) DEFAULT NULL,
  `fired` int(2) DEFAULT NULL,
  `fired2` int(2) DEFAULT NULL,
  `wins` int(2) DEFAULT NULL,
  PRIMARY KEY (`userID`,`season`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_extra_wins`
--

INSERT INTO `tbl_extra_wins` (`userID`, `season`, `champ`, `second`, `third`, `forth`, `fifth`, `down1`, `down2`, `down3`, `up1`, `up2`, `up3`, `fired`, `fired2`, `wins`) VALUES
(0, 19, 10, 5, 13, 4, 17, 7, 31, 44, 2, 24, 23, 16, 43, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_game`
--

DROP TABLE IF EXISTS `tbl_game`;
CREATE TABLE IF NOT EXISTS `tbl_game` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `play` int(5) NOT NULL DEFAULT '0',
  `team1` int(2) NOT NULL DEFAULT '0',
  `team2` int(2) NOT NULL DEFAULT '0',
  `p_ts` int(10) DEFAULT NULL,
  `result1` int(2) DEFAULT NULL,
  `result2` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=604 ;

--
-- Tabellenstruktur für Tabelle `tbl_play`
--

DROP TABLE IF EXISTS `tbl_play`;
CREATE TABLE IF NOT EXISTS `tbl_play` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `season` int(2) NOT NULL DEFAULT '0',
  `recorded` int(1) NOT NULL DEFAULT '0',
  `completed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Daten für Tabelle `tbl_play`
--

INSERT INTO `tbl_play` (`id`, `season`, `recorded`, `completed`) VALUES
(1, 19, 0, 0), 
(2, 19, 0, 0), 
(3, 19, 0, 0), 
(4, 19, 0, 0), 
(5, 19, 0, 0), 
(6, 19, 0, 0), 
(7, 19, 0, 0), 
(8, 19, 0, 0), 
(9, 19, 0, 0), 
(10, 19, 0, 0), 
(11, 19, 0, 0), 
(12, 19, 0, 0), 
(13, 19, 0, 0), 
(14, 19, 0, 0), 
(15, 19, 0, 0), 
(16, 19, 0, 0), 
(17, 19, 0, 0), 
(18, 19, 0, 0), 
(19, 19, 0, 0), 
(20, 19, 0, 0), 
(21, 19, 0, 0), 
(22, 19, 0, 0), 
(23, 19, 0, 0), 
(24, 19, 0, 0), 
(25, 19, 0, 0), 
(26, 19, 0, 0), 
(27, 19, 0, 0), 
(28, 19, 0, 0), 
(29, 19, 0, 0), 
(30, 19, 0, 0), 
(31, 19, 0, 0), 
(32, 19, 0, 0), 
(33, 19, 0, 0), 
(34, 19, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_points`
--

DROP TABLE IF EXISTS `tbl_points`;
CREATE TABLE IF NOT EXISTS `tbl_points` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `play` int(5) NOT NULL DEFAULT '0',
  `userID` int(2) NOT NULL DEFAULT '0',
  `points` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=420 ;

--
-- Tabellenstruktur für Tabelle `tbl_team`
--

DROP TABLE IF EXISTS `tbl_team`;
CREATE TABLE IF NOT EXISTS `tbl_team` (
  `id` int(2) NOT NULL DEFAULT '0',
  `name` char(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `short` char(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `league` int(1) DEFAULT NULL,
  `icon` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '""',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `tbl_team`
--

INSERT INTO `tbl_team` (`id`, `name`, `short`, `league`, `icon`) VALUES
(6, 'Borussia MönchenGladbach', 'MGladb', 1, 'MGladb.png'),
(22, 'TSV Alemannia Aachen', 'Aachen', 3, 'Aachen.png'),
(32, 'FSV Mainz 05', 'Mainz', 1, 'Mainz.png'),
(1, '1.FC Kaiserslautern', '1.FCK', 3, '1.FCK.png'),
(2, '1.FC Köln', 'Köln', 1, 'Köln.png'),
(3, 'SC Freiburg', 'Freib', 1, 'Freib.png'),
(4, 'Bayer 04 Leverkusen', 'Bayer', 1, 'Bayer.png'),
(5, 'Borussia Dortmund', 'BVB', 1, 'BVB.png'),
(7, 'Hamburger SV', 'HSV', 2, 'HSV.png'),
(8, 'Hansa Rostock', 'Hansa', 3, 'Hansa.png'),
(9, 'Hertha BSC Berlin', 'Hertha', 1, 'Hertha.png'),
(10, 'FC Bayern München', 'FCB', 1, 'FCB.png'),
(11, 'Eintracht Frankfurt', 'Frank', 1, 'Frank.png'),
(12, 'Hannover 96', 'Hann96', 2, 'Hann96.png'),
(13, 'FC Schalke 04', 'S04', 1, 'S04.png'),
(14, 'VfL Bochum', 'Bochum', 2, 'Bochum.png'),
(15, 'TSV 1860 München', '1860', 3, '1860.png'),
(16, 'VfB Stuttgart', 'VfB', 2, 'VfB.png'),
(17, 'VfL Wolfsburg', 'Wolfsb', 1, 'Wolfsb.png'),
(18, 'Werder Bremen', 'Werder', 1, 'Werder.png'),
(19, 'Erzgebirge Aue', 'Aue', 2, 'Aue.png'),
(20, 'Karlsruher SC', 'KSC', 2, 'KSC.png'),
(21, 'Osnabrück', 'Osna', 2, 'Osna.png'),
(23, 'SpVgg Greuther Fürth', 'Fürth', 2, 'Fürth.png'),
(24, 'SC Paderborn 07', 'SCPad', 1, 'SCPad.png'),
(25, 'St. Pauli', 'Pauli', 2, 'Pauli.png'),
(26, 'TuS Koblenz', 'Kobl', 3, 'Kobl.png'),
(27, 'MSV Duisburg', 'Duisb', 3, 'Duisb.png'),
(28, 'DSC Arminia Bielefeld', 'Biele', 2, 'Biele.png'),
(29, 'Energie Cottbus', 'Cottb', 3, 'Cottb.png'),
(30, 'Hoffenheim', 'Hoff', 1, 'Hoff.png'),
(31, '1.FC Nürnberg', '1.FCN', 2, '1.FCN.png'),
(33, 'Carl Zeiss Jena', 'Jena', 3, '""'),
(34, 'Wehen', 'Wehen', 2, '""'),
(35, 'Kickers Offenbach', 'Kicker', 3, 'Kicker.png'),
(36, 'FC Augsburg', 'Augsb', 1, 'Augsb.png'),
(37, 'Rot-Weiß Oberhausen', 'RWO', 3, 'RWO.png'),
(38, 'Rot-Weiss Ahlen', 'Ahlen', 3, '""'),
(39, 'FSV Frankfurt', 'FSVFr', 3, 'FSVFr.png'),
(40, 'FC Ingolstadt 04', 'Ingol', 3, 'Ingol.png'),
(41, '1. FC Union Berlin', 'Union', 1, 'Union.png'),
(42, 'Fortuna Düsseldorf', 'Fortun', 1, 'Fortun.png'),
(43, 'Dynamo Dresden', 'Dynamo', 2, 'Dynamo.png'),
(44, 'Eintracht Braunschweig', 'Braun', 3, 'Braun.png'),
(45, 'SV Sandhausen', 'SVSand', 2, 'SVSand.png'),
(46, 'VfR Aalen', 'Aalen', 3, 'Aalen.png'),
(47, 'SSV Jahn Regensburg', 'JahnR', 2, 'JahnR.png'),
(48, '1. FC Heidenheim', 'Heide', 2, 'Heide.png'),
(49, 'RB Leipzig', 'RBL', 1, 'RBL.png'),
(50, 'SV Darmstadt 98', 'Darm98', 2, 'Darm98.png'),
(51, 'FC Würzburger Kickers', 'Wuerz', 3, 'Wuerz.png'),
(52, 'Holstein Kiel', 'Kiel', 2, 'Kiel.png'),
(53, '1. FC Magdeburg', 'Magde', 3, 'Magdeburg.png'),
(-1, 'NULL', 'NULL', 2, '""');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_wins`
--

DROP TABLE IF EXISTS `tbl_wins`;
CREATE TABLE IF NOT EXISTS `tbl_wins` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `play` int(5) DEFAULT NULL,
  `userID` int(2) NOT NULL DEFAULT '0',
  `wins` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=420 ;

-- --------------------------------------------------------

--
-- Struktur des Views `view_games`
--
DROP TABLE IF EXISTS `view_games`;

CREATE VIEW `view_games` AS select `t1`.`league` AS `league`,`g`.`play` AS `play`,`g`.`p_ts` AS `p_ts`,`g`.`id` AS `gameId`,`g`.`result1` AS `result1`,`g`.`result2` AS `result2`,`t1`.`id` AS `team1Id`,`t1`.`name` AS `name`,`t1`.`short` AS `short`,`t1`.`icon` AS `icon`,`t2`.`id` AS `team2Id`,`t2`.`name` AS `name2`,`t2`.`short` AS `short2`,`t2`.`icon` AS `icon2` from ((`tbl_game` `g` join `tbl_team` `t1`) join `tbl_team` `t2`) where ((`t1`.`id` = `g`.`team1`) and (`t2`.`id` = `g`.`team2`)) order by `t1`.`league`,`g`.`p_ts`,`g`.`id`;

-- --------------------------------------------------------

--
-- Struktur des Views `view_team2`
--
DROP TABLE IF EXISTS `view_team2`;

CREATE VIEW `view_team2` AS select `tbl_team`.`id` AS `id2`,`tbl_team`.`name` AS `name2`,`tbl_team`.`short` AS `short2`,`tbl_team`.`league` AS `league2`,`tbl_team`.`icon` AS `icon2` from `tbl_team`;
