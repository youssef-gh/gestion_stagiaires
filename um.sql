-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 15, 2021 at 01:16 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `um`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123456'),
('L131341', '1234'),
('l223423', '1234'),
('J123', '1234'),
('j1234', '1234'),
('e1234', '1234'),
('E123', '1234'),
('L11', '1234'),
('L22', '1234'),
('L33', '1234'),
('L44', '1234'),
('L55', '1234'),
('L66', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `demande`
--

DROP TABLE IF EXISTS `demande`;
CREATE TABLE IF NOT EXISTS `demande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dem` varchar(50) DEFAULT 'En attente',
  `accord` varchar(20) DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `annee` varchar(50) NOT NULL,
  `filliere` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demande`
--

INSERT INTO `demande` (`id`, `dem`, `accord`, `nom`, `annee`, `filliere`) VALUES
(1, 'qdfqdsfq', NULL, '', '', ''),
(2, 'En attentefgsdfgsdfgsg', NULL, '', '', ''),
(3, 'En attente', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `demandeliste`
--

DROP TABLE IF EXISTS `demandeliste`;
CREATE TABLE IF NOT EXISTS `demandeliste` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cne` varchar(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `ville` varchar(50) DEFAULT NULL,
  `duree` varchar(50) DEFAULT NULL,
  `detail` text,
  `domaine` varchar(50) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `filliere` varchar(50) DEFAULT NULL,
  `annee` varchar(50) DEFAULT NULL,
  `accord` int(11) DEFAULT NULL,
  `choix` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL,
  `confirmer` int(11) DEFAULT NULL,
  `refuser` int(11) DEFAULT '3',
  `avertir` int(11) DEFAULT NULL,
  `afficher` int(11) NOT NULL DEFAULT '0',
  `reponse_etd` int(11) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `demandeliste`
--

INSERT INTO `demandeliste` (`id`, `cne`, `status`, `ville`, `duree`, `detail`, `domaine`, `nom`, `prenom`, `filliere`, `annee`, `accord`, `choix`, `stage_id`, `confirmer`, `refuser`, `avertir`, `afficher`, `reponse_etd`) VALUES
(48, 'L22', NULL, 'CASA', '6 mois', '  sdfsdf', 'informatique', 'Hamidi', 'Fadel', 'gp2', '4', NULL, NULL, 1, 1, 0, NULL, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

DROP TABLE IF EXISTS `etudiant`;
CREATE TABLE IF NOT EXISTS `etudiant` (
  `cne` varchar(20) NOT NULL,
  `nom` varchar(20) DEFAULT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `filliere` varchar(20) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`cne`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`cne`, `nom`, `prenom`, `filliere`, `date_naissance`, `annee`, `Vimage1`) VALUES
('L131341', 'Ghoundal', 'Youssef', 'IID2', '2000-12-13', 4, 'bg_login'),
('L11', 'Amine', 'Amine', 'GI1', '2001-12-07', 3, 'bg_login'),
('L22', 'Hamidi', 'Fadel', 'gp2', '2021-12-14', 4, 'bg_login'),
('L33', 'Ghoundal', 'Jihad', 'API2', '2002-12-07', 2, 'bg_login'),
('L44', 'jabrane', 'youssef', 'ge2', '2021-12-14', 4, 'bg_login'),
('L55', 'houkmi', 'moad', 'GRT2', '2002-12-07', 4, 'bg_login'),
('L66', 'amezzane', 'moad', 'GRT1', '2002-12-07', 4, 'bg_login');

-- --------------------------------------------------------

--
-- Table structure for table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `num` int(40) NOT NULL AUTO_INCREMENT,
  `domaine` varchar(20) DEFAULT NULL,
  `entreprise` varchar(20) DEFAULT NULL,
  `info` text NOT NULL,
  `dispo` varchar(20) DEFAULT 'disponible',
  `type` varchar(20) DEFAULT NULL,
  `duree` varchar(50) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `cne_etudiant` varchar(50) NOT NULL DEFAULT 'aucun',
  `id_encadrant` varchar(50) NOT NULL,
  `encadrant` varchar(50) NOT NULL,
  PRIMARY KEY (`num`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stage`
--

INSERT INTO `stage` (`num`, `domaine`, `entreprise`, `info`, `dispo`, `type`, `duree`, `ville`, `cne_etudiant`, `id_encadrant`, `encadrant`) VALUES
(1, 'informatique', 'Orange', '    sdqsdqsd', 'non disponible', 'pfa', '2 mois', 'CASA', 'L22', 'E123', 'Mr.Ghazdali'),
(4, 'electrique', 'centrale', '  fsdfsdfsdf  qdfqdshgsfghsfhs    ', 'non disponible', 'pfe', '6 mois', 'CASA', 'L22', 'E5466', 'Mr.Hafidi');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `img`) VALUES
(1, 'ysf.jpeg'),
(2, 'ysf.jpeg'),
(3, 'TD4 UML.pdf');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
