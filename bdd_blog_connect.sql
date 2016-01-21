-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 21 Novembre 2015 à 01:40
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `bd_blog_connect`
--
CREATE DATABASE IF NOT EXISTS `bd_blog_connect` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bd_blog_connect`;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categories` varchar(100) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE IF NOT EXISTS `commentaire` (
  `id_tags` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL,
  `titre_commentaire` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_com` date NOT NULL,
  PRIMARY KEY (`id_tags`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Structure de la table `rel_tags_billet`
--

CREATE TABLE IF NOT EXISTS `rel_tags_billet` (
  `id_tags` int(11) NOT NULL,
  `id_billet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rel_tags_billet`
--

INSERT INTO `rel_tags_billet` (`id_tags`, `id_billet`) VALUES
(137, 45),
(303, 54),
(304, 55),
(305, 55),
(306, 55),
(307, 55),
(308, 55),
(309, 55),
(310, 55),
(311, 56),
(312, 57),
(313, 57),
(314, 57),
(315, 58),
(316, 58),
(317, 58),
(318, 58),
(319, 59),
(320, 59),
(321, 59),
(322, 60),
(323, 60),
(324, 60),
(325, 61),
(326, 61),
(327, 61),
(328, 62),
(329, 62),
(330, 62),
(331, 62),
(332, 63),
(333, 63),
(334, 63),
(335, 63),
(336, 64),
(337, 64),
(338, 64),
(339, 65),
(340, 65),
(341, 66),
(342, 66),
(343, 67),
(344, 67),
(345, 67),
(346, 67),
(347, 68),
(348, 68),
(349, 68),
(350, 69),
(351, 69),
(352, 69),
(353, 70),
(354, 70),
(355, 70),
(356, 71),
(357, 71),
(358, 71),
(359, 71),
(360, 72),
(361, 72),
(362, 72),
(363, 72),
(364, 73),
(365, 73),
(366, 73),
(367, 74),
(368, 74),
(369, 74),
(370, 74),
(371, 75),
(372, 75),
(373, 75),
(374, 75);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id_tags` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tags` varchar(200) NOT NULL,
  PRIMARY KEY (`id_tags`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=375 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`id_tags`, `nom_tags`) VALUES
(339, 'bussnes'),
(340, 'solver'),
(341, 'bussnes'),
(342, 'solver'),
(343, 'developpeur'),
(344, 'html'),
(345, 'css'),
(346, 'R2'),
(347, 'startup'),
(348, 'jeune'),
(349, 'etudiant'),
(350, 'rencontre'),
(351, 'Ã©volution'),
(352, 'entreuprenariat'),
(353, 'poster'),
(354, 'role'),
(355, 'equipe'),
(356, 'pop'),
(357, 'echo'),
(358, 'lock'),
(359, 'rock'),
(360, 'pop'),
(361, 'echo'),
(362, 'lock'),
(363, 'rock'),
(364, 'hello'),
(366, 'top'),
(367, 'pop'),
(368, 'echo'),
(369, 'lock'),
(370, 'rock'),
(371, ''),
(372, 'BON'),
(373, 'COOL'),
(374, 'TOP');

-- --------------------------------------------------------

--
-- Structure de la table `tp_billet`
--

CREATE TABLE IF NOT EXISTS `tp_billet` (
  `id_billet` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `titre` varchar(150) NOT NULL,
  `chapo` varchar(255) NOT NULL,
  `corps` text NOT NULL,
  `image` text NOT NULL,
  `date_post` date NOT NULL,
  PRIMARY KEY (`id_billet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- Structure de la table `tp_user`
--

CREATE TABLE IF NOT EXISTS `tp_user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `email` varchar(250) NOT NULL,
  `date_inscription` date NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Contenu de la table `tp_user`
--

INSERT INTO `tp_user` (`id_user`, `pseudo`, `password`, `nom`, `prenom`, `sexe`, `status`, `avatar`, `email`, `date_inscription`) VALUES
(19, 'loop', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'zuma', 'jonathan', 'homme', 'admin', 'suricate-50.jpg', 'lololo@loki.fr', '2015-11-20'),
(21, 'jeanmoulin', '9cf95dacd226dcf43da376cdb6cbba7035218921', 'Ahlem', 'last', 'homme', 'lecteur', 'ahlem.jpg', 'mathias@epitech.eu', '2015-11-21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
