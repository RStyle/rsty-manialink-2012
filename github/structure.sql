SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `Online` (
  `nick` varchar(30) COLLATE utf8_bin NOT NULL,
  `IP` varchar(30) COLLATE utf8_bin NOT NULL,
  `DATUM` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `admins` (
  `user` varchar(30) COLLATE utf8_bin NOT NULL,
  `now` int(6) NOT NULL DEFAULT '0',
  `cc` int(6) NOT NULL DEFAULT '0',
  `tracks` int(6) NOT NULL DEFAULT '0',
  `skins` int(6) NOT NULL DEFAULT '0',
  `avatars` int(6) NOT NULL DEFAULT '0',
  `signs` int(6) NOT NULL DEFAULT '0',
  `horns` int(6) NOT NULL DEFAULT '0',
  `mods` int(6) NOT NULL DEFAULT '0',
  `plugins` int(6) NOT NULL DEFAULT '0',
  `screens` int(6) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `avatars` (
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  `uploader` varchar(30) COLLATE utf8_bin NOT NULL,
  `nick` varchar(50) COLLATE utf8_bin NOT NULL,
  `id` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `donate` (
  `login` varchar(30) COLLATE utf8_bin NOT NULL,
  `summe` int(20) DEFAULT '1',
  `spende` int(20) DEFAULT NULL,
  `nick` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


CREATE TABLE IF NOT EXISTS `gbook` (
  `id` int(6) NOT NULL,
  `player` varchar(30) NOT NULL,
  `nick` varchar(50) NOT NULL DEFAULT 'Nickname',
  `datum` varchar(10) NOT NULL,
  `eintrag` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `kontakt` (
  `empfang` varchar(30) NOT NULL,
  `type` varchar(3) DEFAULT '1',
  `titel` varchar(50) NOT NULL,
  `kom` varchar(400) NOT NULL,
  `absender` varchar(100) NOT NULL,
  `datum` varchar(30) NOT NULL,
  `id` int(6) NOT NULL,
  `id2` int(6) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id2`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;


CREATE TABLE IF NOT EXISTS `language` (
  `de` varchar(70) DEFAULT NULL,
  `en` varchar(70) DEFAULT NULL,
  `fr` varchar(70) DEFAULT NULL,
  `it` varchar(70) DEFAULT NULL,
  `sp` varchar(70) DEFAULT NULL,
  `un` varchar(70) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `language` (`de`, `en`, `fr`, `it`, `sp`, `un`) VALUES
('spendete', 'donated', NULL, NULL, NULL, NULL),
('Passwort', 'password', NULL, NULL, NULL, NULL),
('Admin News', 'admin news', NULL, NULL, NULL, NULL),
('Posteingang', 'inbox', NULL, NULL, NULL, NULL),
('Geld', 'money', NULL, NULL, NULL, NULL),
('Einstellungen', 'settings', NULL, NULL, NULL, NULL),
('Hintergrund Verhellung', 'background brightness', NULL, NULL, NULL, NULL),
('Hintergrund', 'background', NULL, NULL, NULL, NULL),
('info-box', 'info-box', NULL, NULL, NULL, NULL),
('Navigations Text Farbe', 'top bar text color', NULL, NULL, NULL, NULL),
('header', 'header', NULL, NULL, NULL, NULL),
('Beispieltext', 'filler text', NULL, NULL, NULL, NULL),
('Eintrag', 'post', NULL, NULL, NULL, NULL),
('Spenden', 'donate', NULL, NULL, NULL, NULL),
('du hast gespendet', 'you donated', NULL, NULL, NULL, NULL),
('Download', 'download', NULL, NULL, NULL, NULL),
('Jukebox', 'jukebox', NULL, NULL, NULL, NULL),
('Titel', 'title', NULL, NULL, NULL, NULL),
('Nachricht', 'message', NULL, NULL, NULL, NULL),
('senden', 'send', NULL, NULL, NULL, NULL),
('Server', 'server', NULL, NULL, NULL, NULL),
('Bewerter', 'rater', NULL, NULL, NULL, NULL),
('made by', 'made by', NULL, NULL, NULL, NULL),
('Downloads', 'downloads', NULL, NULL, NULL, NULL),
('Umgebung', 'environment', NULL, NULL, NULL, NULL),
('Beschreibung', 'description', NULL, NULL, NULL, NULL),
('Januar', 'january', NULL, NULL, NULL, NULL),
('Februar', 'february', NULL, NULL, NULL, NULL),
('März', 'march', NULL, NULL, NULL, NULL),
('April', 'april', NULL, NULL, NULL, NULL),
('Mai', 'may', NULL, NULL, NULL, NULL),
('Juni', 'june', NULL, NULL, NULL, NULL),
('Juli', 'july', NULL, NULL, NULL, NULL),
('August', 'ausgust', NULL, NULL, NULL, NULL),
('September', 'september', NULL, NULL, NULL, NULL),
('Oktober', 'oktober', NULL, NULL, NULL, NULL),
('November', 'november', NULL, NULL, NULL, NULL),
('Dezember', 'december', NULL, NULL, NULL, NULL),
('Montag', 'monday', NULL, NULL, NULL, NULL),
('Dienstag', 'tuesday', NULL, NULL, NULL, NULL),
('Mittwoch', 'wednesday', NULL, NULL, NULL, NULL),
('Donnerstag', 'thursday', NULL, NULL, NULL, NULL),
('Freitag', 'friday', NULL, NULL, NULL, NULL),
('Samstag', 'saturday', NULL, NULL, NULL, NULL),
('Sonntag', 'sunday', NULL, NULL, NULL, NULL),
('Preis', 'price', NULL, NULL, NULL, NULL),
('Datum', 'date', NULL, NULL, NULL, NULL),
('Uploader', 'uploader', NULL, NULL, NULL, NULL),
('bewerte', 'rate', NULL, NULL, NULL, NULL),
('Bewertung', 'evaluation', NULL, NULL, NULL, NULL),
('Letzte Besucher', 'last visitors', NULL, NULL, NULL, NULL),
('Beliebteste Musik', 'most liked music', NULL, NULL, NULL, NULL),
('Klicks', 'clicks', NULL, NULL, NULL, NULL),
('Anzahl Spenden', 'amount of donations', NULL, NULL, NULL, NULL),
('Name der Musik', 'music name', NULL, NULL, NULL, NULL),
('Summe Spenden', 'donate amount', NULL, NULL, NULL, NULL),
('Wie oft gew&#228;hlt', 'how many time chosen', NULL, NULL, NULL, NULL),
('letzter Spender', 'last donor', NULL, NULL, NULL, NULL),
('Besucher online', 'visitors at the moment', NULL, NULL, NULL, NULL),
('Spenden Statistik', 'donations statistic', NULL, NULL, NULL, NULL),
('Besucher', 'visitor', NULL, NULL, NULL, NULL),
('Bester Spender', 'best donor', NULL, NULL, NULL, NULL),
('Counter', 'counter', NULL, NULL, NULL, NULL),
('Werter', 'ratings', NULL, NULL, NULL, NULL);

CREATE TABLE IF NOT EXISTS `manializer_adresse` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `besucher` int(7) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


CREATE TABLE IF NOT EXISTS `manializer_days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `num_visits` int(11) NOT NULL,
  `daynum` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=672 ;


CREATE TABLE IF NOT EXISTS `manializer_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `starttime` varchar(32) NOT NULL,
  `boss` varchar(256) NOT NULL,
  `bossip` varchar(256) NOT NULL,
  `bossnick` varchar(512) NOT NULL,
  `bosspath` varchar(512) NOT NULL,
  `bosslang` varchar(2) NOT NULL,
  `lizesurl` varchar(256) NOT NULL,
  `lizestitle` varchar(512) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `manializer_main` (`id`, `starttime`, `boss`, `bossip`, `bossnick`, `bosspath`, `bosslang`, `lizesurl`, `lizestitle`) VALUES
(1, '01.01.1970', 'username', '0', 'manialink', 'wo du wohnst (braucht man nicht)', 'de', 'manialink', 'manialink');

CREATE TABLE IF NOT EXISTS `manializer_musik` (
  `zahl` int(10) NOT NULL DEFAULT '0',
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `manializer_players` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lstvisit` varchar(20) NOT NULL,
  `num_visits` int(11) NOT NULL,
  `login` varchar(256) NOT NULL,
  `nick` varchar(512) NOT NULL,
  `path` varchar(512) NOT NULL,
  `lng` varchar(2) NOT NULL,
  `ip` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3908 ;


CREATE TABLE IF NOT EXISTS `manializer_stunde` (
  `time` int(11) NOT NULL,
  `anzahl` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `manializer_temp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(256) NOT NULL,
  `num_logins` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `manializer_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(256) NOT NULL,
  `nick` varchar(512) NOT NULL,
  `path` varchar(512) NOT NULL,
  `lng` varchar(2) NOT NULL,
  `date` varchar(20) NOT NULL,
  `ip` varchar(256) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16426 ;


CREATE TABLE IF NOT EXISTS `manializer_zeit` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zeit` int(7) NOT NULL,
  `tag` int(2) NOT NULL,
  `monat` int(2) NOT NULL,
  `jahr` int(5) NOT NULL,
  `timestamp` varchar(16) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


CREATE TABLE IF NOT EXISTS `mods` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `file` varchar(30) COLLATE utf8_bin NOT NULL,
  `bild1` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `bild2` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `bild3` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `user` varchar(30) COLLATE utf8_bin NOT NULL,
  `nick` varchar(50) COLLATE utf8_bin NOT NULL,
  `envi` varchar(20) COLLATE utf8_bin NOT NULL,
  `kom` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `news` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `geheftet` int(2) NOT NULL DEFAULT '2',
  `news` varchar(200) COLLATE utf8_bin NOT NULL,
  `datum` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;


CREATE TABLE IF NOT EXISTS `plugins` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  `bild` varchar(30) COLLATE utf8_bin NOT NULL,
  `preis` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `screens` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `file` varchar(30) COLLATE utf8_bin NOT NULL,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `uploader` varchar(30) COLLATE utf8_bin NOT NULL,
  `nick` varchar(50) COLLATE utf8_bin NOT NULL,
  `kom` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `set` (
  `login` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `set1` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `set2` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `set3` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `set4` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `set5` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `set6` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `set7` varchar(20) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `signs` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `bild` varchar(30) COLLATE utf8_bin NOT NULL,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `uploader` varchar(30) COLLATE utf8_bin NOT NULL,
  `nick` varchar(50) COLLATE utf8_bin NOT NULL,
  `sig1` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig2` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig3` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig4` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig5` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig6` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig7` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig8` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig9` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig10` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig11` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig12` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig13` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig14` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig15` varchar(20) COLLATE utf8_bin NOT NULL,
  `sig16` varchar(20) COLLATE utf8_bin NOT NULL,
  `kom` varchar(200) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `skins` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  `file` varchar(30) COLLATE utf8_bin NOT NULL,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `bild` varchar(30) COLLATE utf8_bin NOT NULL,
  `uploader` varchar(30) COLLATE utf8_bin NOT NULL,
  `nickname` varchar(50) COLLATE utf8_bin NOT NULL,
  `kom` varchar(200) COLLATE utf8_bin NOT NULL,
  `3d` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `tracks` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_bin NOT NULL,
  `datum` varchar(10) COLLATE utf8_bin NOT NULL,
  `bild` varchar(30) COLLATE utf8_bin NOT NULL,
  `preis` int(6) NOT NULL,
  `envi` varchar(15) COLLATE utf8_bin NOT NULL,
  `uploader` varchar(30) COLLATE utf8_bin NOT NULL,
  `nick` varchar(50) COLLATE utf8_bin NOT NULL,
  `gps` int(1) NOT NULL,
  `kom` varchar(200) COLLATE utf8_bin NOT NULL,
  `wert` int(10) NOT NULL DEFAULT '0',
  `werter` int(6) NOT NULL DEFAULT '0',
  `bew` float NOT NULL DEFAULT '0',
  `downloads` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
