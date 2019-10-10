-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Ven 11 Mai 2018 à 23:10
-- Version du serveur: 5.5.20
-- Version de PHP: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `projet2`
--

-- --------------------------------------------------------

--
-- Structure de la table `enigme`
--

CREATE TABLE IF NOT EXISTS `enigme` (
  `idenigme` int(11) NOT NULL AUTO_INCREMENT,
  `enigme` text NOT NULL,
  `niveau` int(11) NOT NULL,
  `Idtresor` int(11) NOT NULL,
  PRIMARY KEY (`idenigme`),
  KEY `Idtresor` (`Idtresor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `enigme`
--

INSERT INTO `enigme` (`idenigme`, `enigme`, `niveau`, `Idtresor`) VALUES
(1, 'je suis ce que je suis , si je n''etais pas ce que je suis je ne serai pas ce que je suis', 1, 1),
(2, 'je suis un ecrivain reconnu , une universite a ete baptise en mon nom\r\nla science est le domaine', 3, 4),
(3, 'je pleure quand je suis en joie , triste j,etais qui suis-je??', 1, 3),
(4, 'je suis ce que je suis , si je n''etais pas ce que je suis je ne serai pas ce que je suis', 1, 2),
(5, 'je suis un scientifique non reconnu de mon temps mais connu du futur', 1, 8),
(6, 'enigme', 0, 45),
(7, 'enigme', 2, 46),
(8, 'enigme', 2, 47),
(9, 'enigme', 3, 48),
(10, 'enigme', 3, 49),
(11, 'enigme', 2, 49),
(12, 'enigme', 2, 50),
(13, 'NON RIEN CHERCHEZ SEULEMENT', 3, 51),
(14, 'NON RIEN CHERCHEZ SEULEMENT', 3, 52);

-- --------------------------------------------------------

--
-- Structure de la table `statistique`
--

CREATE TABLE IF NOT EXISTS `statistique` (
  `idstatistique` int(11) NOT NULL AUTO_INCREMENT,
  `NbRechercher` int(11) NOT NULL DEFAULT '0' COMMENT 'augmente a chaque fois q''un mÃªme utilisateur recherche un trÃ©sor ',
  `NbTrouver` int(11) NOT NULL DEFAULT '0' COMMENT 'augmente si un mÃªme utilisateur trouve un trÃ©sor',
  `Idtresor` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  PRIMARY KEY (`idstatistique`),
  KEY `Idtresor` (`Idtresor`),
  KEY `idutilisateur` (`idutilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=59 ;

--
-- Contenu de la table `statistique`
--

INSERT INTO `statistique` (`idstatistique`, `NbRechercher`, `NbTrouver`, `Idtresor`, `idutilisateur`) VALUES
(1, 2, 0, 2, 1),
(2, 1, 0, 3, 1),
(9, 0, 0, 3, 2),
(10, 0, 21, 34, 10),
(16, 0, 21, 34, 10),
(24, 0, 21, 34, 10),
(25, 0, 21, 34, 10),
(26, 0, 21, 34, 10),
(27, 0, 21, 34, 10),
(28, 0, 21, 34, 10),
(29, 0, 21, 34, 10),
(30, 0, 21, 34, 10),
(31, 0, 21, 34, 10),
(32, 0, 21, 34, 10),
(33, 0, 21, 34, 10),
(34, 0, 21, 34, 10),
(35, 0, 21, 34, 10),
(36, 0, 21, 34, 10),
(37, 0, 21, 34, 10),
(38, 0, 21, 34, 10),
(39, 0, 21, 34, 10),
(40, 0, 21, 34, 10),
(41, 0, 21, 34, 10),
(42, 0, 21, 34, 10),
(43, 0, 21, 34, 10),
(44, 0, 21, 34, 10),
(45, 0, 21, 34, 10),
(46, 0, 21, 34, 10),
(47, 0, 21, 34, 10),
(48, 0, 21, 34, 10),
(49, 0, 21, 34, 10),
(50, 0, 21, 34, 10),
(51, 0, 21, 34, 10),
(52, 0, 21, 34, 10),
(53, 0, 21, 34, 10),
(54, 0, 21, 34, 10),
(55, 0, 21, 34, 10),
(56, 0, 21, 34, 10),
(57, 2, 0, 3, 10),
(58, 0, 21, 34, 10);

-- --------------------------------------------------------

--
-- Structure de la table `tresor`
--

CREATE TABLE IF NOT EXISTS `tresor` (
  `Idtresor` int(11) NOT NULL AUTO_INCREMENT,
  `nomtresor` varchar(50) NOT NULL,
  `objet1` varchar(255) NOT NULL COMMENT 'obliglatoire',
  `objet2` varchar(255) NOT NULL COMMENT 'facultatif',
  `objet3` varchar(255) NOT NULL COMMENT 'facultatif',
  `objet1change` varchar(255) NOT NULL,
  `objet2change` varchar(255) NOT NULL,
  `objet3change` varchar(255) NOT NULL,
  `statutTresor` varchar(55) NOT NULL DEFAULT 'cacher',
  `date` date NOT NULL,
  `dateT` date NOT NULL,
  `DescriptionBoite` varchar(255) NOT NULL,
  `photo` longblob NOT NULL,
  `Lieu` varchar(255) NOT NULL DEFAULT 'code,dÃ©partement,ville',
  `idutilisateur` int(11) NOT NULL,
  `nbCacher` int(11) NOT NULL DEFAULT '1' COMMENT 'augmente a chaque fois q''un mÃªme utilisateur cache un trÃ©sor ',
  `NbTrouver` int(11) NOT NULL DEFAULT '0' COMMENT 'augmente si un mÃªme trÃ©sor Ã  Ã©tÃ© trouvÃ© plusieurs fois',
  PRIMARY KEY (`Idtresor`),
  KEY `idutilisateur` (`idutilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `tresor`
--

INSERT INTO `tresor` (`Idtresor`, `nomtresor`, `objet1`, `objet2`, `objet3`, `objet1change`, `objet2change`, `objet3change`, `statutTresor`, `date`, `dateT`, `DescriptionBoite`, `photo`, `Lieu`, `idutilisateur`, `nbCacher`, `NbTrouver`) VALUES
(1, 'bille', '', '', '', '', '', '', 'cacher', '2018-04-24', '0000-00-00', 'noir wiko', '', 'France , 37 ,Indre-Loire, Tours.', 1, 1, 3),
(2, 'Macbook', '', '', '', '', '', '', 'cacher', '2018-04-17', '0000-00-00', 'emballage cadeaux', '', 'France , 37 ,Indre-Loire,Tours.', 2, 1, 0),
(3, 'chaussures adidas', '', '', '', '', '', '', 'cacher', '2018-04-01', '0000-00-00', 'carton', '', 'France , 37 ,Indre-Loire, Tours.', 4, 1, 0),
(4, 'tee-shirt,stylo,basket', '', '', '', '', '', '', 'cacher', '2018-03-06', '0000-00-00', 'un sac jaune', '', 'France , 37 ,Indre-Loire, Tours.', 5, 1, 0),
(8, 'chemise', '', '', '', '', '', '', 'cacher', '2018-02-12', '0000-00-00', 'carton belge', '', 'France ,37 ,Indre-Loire, Tours.', 1, 2, 0),
(9, 'un verre', '', '', '', '', '', '', 'cacher', '2018-04-13', '0000-00-00', '', '', 'France , 37 ,Indre-Loire, Tours.', 1, 3, 0),
(34, 'Jolie', 'sac', 'trousse', '', 'stylo', 'phone', 'billet 10', 'trouver', '0000-00-00', '2018-05-23', 'boite noir', '', '95,Ile-de-France,Paris', 8, 1, 10),
(35, 'fds', 'sdf', 'sfd', 'sdf', '', '', '', 'cacher', '0000-00-00', '0000-00-00', 'sdf', '', 'sdf', 8, 1, 0),
(39, 'bataille', 'pistolet', 'grenade', 'balle', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'sac ', '', '95,Ile-de-France,Paris', 8, 1, 0),
(40, 'bataille', 'pistolet', 'grenade', 'balle', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'sac ', '', '95,Ile-de-France,Paris', 8, 1, 0),
(41, 'bataille', 'pistolet', 'grenade', 'balle', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'sac ', '', '95,Ile-de-France,Paris', 8, 1, 0),
(42, 'ddfjshfk', 'fskjhf', 'sdjkh', 'sdfhjk', '', '', '', 'cacher', '2018-12-31', '0000-00-00', 'fsjhkd', 0x447261676f6e2d42616c6c2d53757065722d457069736f64652d3133302d707265766965772d30303030312e6a7067, '95,Ile-de-France,Paris', 8, 1, 0),
(43, 'ddfjshfk', 'fskjhf', 'sdjkh', 'sdfhjk', '', '', '', 'cacher', '2018-12-31', '0000-00-00', 'fsjhkd', 0x447261676f6e2d42616c6c2d53757065722d457069736f64652d3133302d707265766965772d30303030312e6a7067, '95,Ile-de-France,Paris', 8, 1, 0),
(44, 'ddfjshfk', 'fskjhf', 'sdjkh', 'sdfhjk', '', '', '', 'cacher', '2018-12-31', '0000-00-00', 'fsjhkd', 0x447261676f6e2d42616c6c2d53757065722d457069736f64652d3133302d707265766965772d30303030312e6a7067, '95,Ile-de-France,Paris', 8, 1, 0),
(45, 'Poster', 'Poster', '', '', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'en carton', 0x62326438333130636333313563613139373734376462306638346138666436312e6a7067, '37,Indre-et-Loire,Tours', 8, 1, 0),
(46, 'Poster', 'Poster', '', '', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'en carton', 0x62326438333130636333313563613139373734376462306638346138666436312e6a7067, '37,Indre-et-Loire,Tours', 8, 1, 0),
(47, 'Poster', 'Poster', '', '', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'en carton', 0x62326438333130636333313563613139373734376462306638346138666436312e6a7067, '37,Indre-et-Loire,Tours', 8, 2, 0),
(48, 'fdzh', 'fdsjkh', 'sfdjkh', '', '', '', '', 'cacher', '2018-05-11', '0000-00-00', 'fsf', '', '56464', 8, 3, 0),
(49, 'boiteb', 'carte', '', '', '', '', '', 'perdu', '2018-05-11', '0000-00-00', 'creuse', '', '59,Le cher', 10, 1, 0),
(50, 'cuisine', 'four', 'micro-onde', '', '', '', '', 'perdu', '2018-05-22', '0000-00-00', 'carton rouge', '', '37,indre_et_loire', 10, 2, 0),
(51, 'ecole', 'sac', 'trousse', 'crayon', '', '', '', 'cacher', '2018-05-25', '0000-00-00', 'carton noir 25*35cm', '', '37,indre_et_loire', 10, 3, 0),
(52, 'ecole', 'sac', 'trousse', 'crayon', '', '', '', 'cacher', '2018-05-25', '0000-00-00', 'carton noir 25*35cm', '', '37,indre_et_loire', 10, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idutilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`idutilisateur`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idutilisateur`, `pseudo`, `email`, `password`) VALUES
(1, 'christian', 'christianmadambari@yahoo.fr', '2345hbs'),
(2, 'Delal', 'Delal@hotmail.com', 'dhbesahdg35'),
(3, 'sidney', 'sidney@hotmail.com', 'bdshbd3263'),
(4, 'sebastien', 'Sebastien@hotmail.com', 'bhdegdy32653'),
(5, 'Thierry', 'thierry@hotmail.com', ''),
(6, 'seletli1', 'delalsel@hotmail.fr', '$2x$14$df5hkt7edlkWz57fgmpqvuxW3kB.dzHUP5SYtF.d4cc40srbSkpqK'),
(7, 'seletli2', 'delalsel@hotmail.fr', '$2x$14$df5hkt7edlkWz57fgmpqvud3l9U/0YoiLP/Qj1xaN/UyOg.FduiBG'),
(8, 'delal2', 'delalsel@hotmail.fr', '$2x$14$df5hkt7edlkWz57fgmpqvuDBZ7WaJHKRd.cN5083BxBD0DMyp88OO'),
(9, 'delal3', 'delalsel@hotmail.fr', '$2x$14$df5hkt7edlkWz57fgmpqvum7kH9oHsSP7JfEcYlZ42Puc/BiXjUZe'),
(10, 'cmoi', 'delalsel@hotmail.fr', '$2x$14$df5hkt7edlkWz57fgmpqvum7kH9oHsSP7JfEcYlZ42Puc/BiXjUZe'),
(11, 'asdd', 'asd@hotmail.com', '$2x$14$df5hkt7edlkWz57fgmpqvuz7I5/XsubnT6i.ap1I6dgG1nPeubg76');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `enigme`
--
ALTER TABLE `enigme`
  ADD CONSTRAINT `enigme_ibfk_1` FOREIGN KEY (`Idtresor`) REFERENCES `tresor` (`Idtresor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `statistique`
--
ALTER TABLE `statistique`
  ADD CONSTRAINT `statistique_ibfk_4` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `statistique_ibfk_3` FOREIGN KEY (`Idtresor`) REFERENCES `tresor` (`Idtresor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tresor`
--
ALTER TABLE `tresor`
  ADD CONSTRAINT `tresor_ibfk_1` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`idutilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
