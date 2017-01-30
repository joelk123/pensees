-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Janvier 2017 à 01:15
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pensees`
--

-- --------------------------------------------------------

--
-- Structure de la table `pensees`
--

CREATE TABLE `pensees` (
  `id` int(11) NOT NULL,
  `pensee` varchar(256) NOT NULL,
  `pseudo` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `pensees`
--

INSERT INTO `pensees` (`id`, `pensee`, `pseudo`, `date`) VALUES
(1, 'je pense donc je suis ', 'rj45', '2017-01-29 00:00:00'),
(2, 'je fais se que je veux', 'inode', '2017-01-29 00:08:00'),
(3, 'on ne va jamais tres loin', 'sass', '2017-01-29 23:37:20'),
(4, 'l&#39; homme propose Dieu dispose', 'jk45', '2017-01-29 23:38:59');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `pensees`
--
ALTER TABLE `pensees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `pensees`
--
ALTER TABLE `pensees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
