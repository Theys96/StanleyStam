-- phpMyAdmin SQL Dump
-- version 4.1.9
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Gegenereerd op: 10 dec 2018 om 21:31
-- Serverversie: 5.6.29
-- PHP-versie: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stam`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `activities`
--

CREATE TABLE IF NOT EXISTS `activities` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `type` enum('opkomst','kamp','groepsraad','activiteit') NOT NULL,
  `organisators` text NOT NULL,
  `description` text NOT NULL,
  `p` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `activities_p`
--

CREATE TABLE IF NOT EXISTS `activities_p` (
  `lid` int(11) NOT NULL,
  `act` int(11) NOT NULL,
  PRIMARY KEY (`lid`,`act`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `barkaarten`
--

CREATE TABLE IF NOT EXISTS `barkaarten` (
  `id` int(11) NOT NULL,
  `link` text NOT NULL,
  `datum` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `leden`
--

CREATE TABLE IF NOT EXISTS `leden` (
  `id` int(11) NOT NULL,
  `scoutnummer` text NOT NULL,
  `geboortedag` date DEFAULT NULL,
  `sinds` date DEFAULT NULL,
  `voornaam` text NOT NULL,
  `schermnaam` text NOT NULL,
  `achternaam` text NOT NULL,
  `wachtwoord` text NOT NULL,
  `mail` text NOT NULL,
  `tier` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `todos`
--

CREATE TABLE IF NOT EXISTS `todos` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `organisators` text NOT NULL,
  `status_date` date NOT NULL,
  `status` text NOT NULL,
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structuur voor view `verjaardagen`
--
CREATE TABLE IF NOT EXISTS `verjaardagen` (
`id` int(11)
,`voornaam` text
,`achternaam` text
,`leeftijd` bigint(11)
,`verjaardag` date
,`tier` int(11)
);
-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `wachtwoordreset`
--

CREATE TABLE IF NOT EXISTS `wachtwoordreset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `lid` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `sha1` char(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Structuur voor de view `verjaardagen`
--
DROP TABLE IF EXISTS `verjaardagen`;

CREATE ALGORITHM=UNDEFINED DEFINER=`stam`@`localhost` SQL SECURITY DEFINER VIEW `verjaardagen` AS select `leden`.`id` AS `id`,`leden`.`voornaam` AS `voornaam`,`leden`.`achternaam` AS `achternaam`,floor(((to_days(now()) - to_days(`leden`.`geboortedag`)) / 365.25)) AS `leeftijd`,(`leden`.`geboortedag` + interval floor(((to_days(now()) - to_days(`leden`.`geboortedag`)) / 365.25)) year) AS `verjaardag`,`leden`.`tier` AS `tier` from `leden` where ((`leden`.`geboortedag` is not null) and (`leden`.`tier` > 0)) order by (`leden`.`geboortedag` + interval floor(((to_days(now()) - to_days(`leden`.`geboortedag`)) / 365.25)) year);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
