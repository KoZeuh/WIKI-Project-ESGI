-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 15 jan. 2024 à 16:30
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `esgi_wiki`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(255) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `createdAt`, `tags`, `user_id`) VALUES
(1, '2023-12-26 16:57:59', 'informatique, linux, ', 1),
(2, '2024-01-03 16:46:38', 'test,tyest', 1),
(3, '2024-01-03 16:47:27', 'test,tyest', 1);

-- --------------------------------------------------------

--
-- Structure de la table `articleoftheday`
--

DROP TABLE IF EXISTS `articleoftheday`;
CREATE TABLE IF NOT EXISTS `articleoftheday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `id_article` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articleoftheday`
--

INSERT INTO `articleoftheday` (`id`, `date`, `id_article`) VALUES
(16, '2024-01-15', 3),
(17, '2024-01-15', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `firstname`, `lastname`, `password`) VALUES
(1, 'nikolailemerre@gmail.com', 'Nikoolaii', 'Nikolaï', 'LEMERRE', '4f56fe65c8bd5296ca6a5f95faa0d65fb54b1ad8a87a1f816c7206803bcff938');

-- --------------------------------------------------------

--
-- Structure de la table `version_article`
--

DROP TABLE IF EXISTS `version_article`;
CREATE TABLE IF NOT EXISTS `version_article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT NULL,
  `content` text,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `version_article`
--

INSERT INTO `version_article` (`id`, `title`, `isValid`, `content`, `updatedAt`, `article_id`, `user_id`) VALUES
(1, 'Chob – Pour rechercher des applications Linux (Flatpack, Snap et AppImage)', 1, '<h1>Content 1</h1>\r\n<p>This is the first content of the first version of the article', '2023-12-26 16:59:18', 1, 1),
(2, 'Chob – Pour rechercher des applications Linux (Flatpack, Snap et AppImage)', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2023-12-26 17:00:19', 1, 1),
(3, 'Test', 0, '<p>ceci est un test d\'article</p>', '2024-01-03 16:46:38', 2, 1),
(4, 'Test', 0, '<p>ceci est un test d\'article</p>', '2024-01-03 16:47:27', 3, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `articleoftheday`
--
ALTER TABLE `articleoftheday`
  ADD CONSTRAINT `articleoftheday_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `version_article`
--
ALTER TABLE `version_article`
  ADD CONSTRAINT `version_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `version_article_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
