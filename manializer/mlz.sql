-- phpMyAdmin SQL Dump
-- version 2.8.2.4
-- http://www.phpmyadmin.net
-- 
-- Host: localhost:3306
-- Erstellungszeit: 01. August 2010 um 19:47
-- Server Version: 5.0.45
-- PHP-Version: 5.2.6
-- 
-- Datenbank: `keine`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `manializer_days`
-- 

CREATE TABLE `manializer_days` (
  `id` int(11) NOT NULL auto_increment,
  `date` varchar(20) NOT NULL,
  `num_visits` int(11) NOT NULL,
  `daynum` varchar(2) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=654 DEFAULT CHARSET=utf8 AUTO_INCREMENT=654 ;

CREATE TABLE `manializer_main` (
  `id` int(11) NOT NULL auto_increment,
  `starttime` varchar(32) NOT NULL,
  `boss` varchar(256) NOT NULL,
  `bossip` varchar(256) NOT NULL,
  `bossnick` varchar(512) NOT NULL,
  `bosspath` varchar(512) NOT NULL,
  `bosslang` varchar(2) NOT NULL,
  `lizesurl` varchar(256) NOT NULL,
  `lizestitle` varchar(512) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- 
-- Daten für Tabelle `manializer_main`
-- 

INSERT INTO `manializer_main` (`id`, `starttime`, `boss`, `bossip`, `bossnick`, `bosspath`, `bosslang`, `lizesurl`, `lizestitle`) VALUES (1, 'das heutige datum', 'dein tm login', '0', 'dein nickname', 'wo du wohnst (braucht man nicht)', 'de', 'deine ml url', 'dein ml titel');

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `manializer_players`
-- 

CREATE TABLE `manializer_players` (
  `id` int(11) NOT NULL auto_increment,
  `lstvisit` varchar(20) NOT NULL,
  `num_visits` int(11) NOT NULL,
  `login` varchar(256) NOT NULL,
  `nick` varchar(512) NOT NULL,
  `path` varchar(512) NOT NULL,
  `lng` varchar(2) NOT NULL,
  `ip` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3898 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3898 ;

-- 
-- Tabellenstruktur für Tabelle `manializer_temp`
-- 

CREATE TABLE `manializer_temp` (
  `id` int(11) NOT NULL auto_increment,
  `country` varchar(256) NOT NULL,
  `num_logins` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `manializer_visits`
-- 

CREATE TABLE `manializer_visits` (
  `id` int(11) NOT NULL auto_increment,
  `login` varchar(256) NOT NULL,
  `nick` varchar(512) NOT NULL,
  `path` varchar(512) NOT NULL,
  `lng` varchar(2) NOT NULL,
  `date` varchar(20) NOT NULL,
  `ip` varchar(256) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16403 DEFAULT CHARSET=utf8 AUTO_INCREMENT=16403 ;

