-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 16 jan. 2024 à 22:24
-- Version du serveur : 8.0.31
-- Version de PHP : 8.2.0

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
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `createdAt`, `user_id`) VALUES
(1, '2023-12-26 16:57:59', 1),
(2, '2024-01-03 16:46:38', 1),
(3, '2024-01-03 16:47:27', 1),
(4, '2024-01-16 18:56:49', 8),
(5, '2024-01-16 18:56:49', 8),
(6, '2024-01-16 18:56:56', 8),
(8, '2024-01-16 18:56:56', 8);

-- --------------------------------------------------------

--
-- Structure de la table `articleoftheday`
--

DROP TABLE IF EXISTS `articleoftheday`;
CREATE TABLE IF NOT EXISTS `articleoftheday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `article_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_article` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articleoftheday`
--

INSERT INTO `articleoftheday` (`id`, `date`, `article_id`) VALUES
(22, '2024-01-16', 6),
(23, '2024-01-16', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Linux'),
(2, 'Windows'),
(3, 'Symfony'),
(4, 'Laravel'),
(5, 'JavaScript'),
(6, 'JQuery');

-- --------------------------------------------------------

--
-- Structure de la table `tag_article`
--

DROP TABLE IF EXISTS `tag_article`;
CREATE TABLE IF NOT EXISTS `tag_article` (
  `tag_id` int NOT NULL,
  `article_id` int NOT NULL,
  KEY `tag_id` (`tag_id`,`article_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tag_article`
--

INSERT INTO `tag_article` (`tag_id`, `article_id`) VALUES
(2, 6),
(2, 8),
(5, 4),
(6, 4);

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
  `role` varchar(50) DEFAULT 'ROLE_USER',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `firstname`, `lastname`, `password`, `role`) VALUES
(1, 'nikolailemerre@gmail.com', 'Nikoolaii', 'Nikolaï', 'LEMERRE', '4f56fe65c8bd5296ca6a5f95faa0d65fb54b1ad8a87a1f816c7206803bcff938', 'ROLE_USER'),
(8, 'a@a.fr', 'kozeuh', 'Kozeuh', 'Dev', '$2y$10$0hkT.oXXqfXhUQSLloTeUOFS5QEMzMgHsgUrx38CQujMMSf2aSHFe', 'ROLE_ADMIN');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `version_article`
--

INSERT INTO `version_article` (`id`, `title`, `isValid`, `content`, `updatedAt`, `article_id`, `user_id`) VALUES
(1, 'Chob – Pour rechercher des applications Linux (Flatpack, Snap et AppImage)', 1, '<h1>Content 1</h1>\r\n<p>This is the first content of the first version of the article', '2023-12-26 16:59:18', 1, 1),
(2, 'Chob – Pour rechercher des applications Linux (Flatpack, Snap et AppImage)', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2023-12-26 17:00:19', 1, 1),
(5, 'Présentation de la version 0.8 de JQuery !', 0, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-10 17:00:19', 4, 8),
(6, 'Présentation de la version 1.0 de JQuery !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-14 17:00:19', 4, 8),
(7, 'Chob – Pour rechercher des applications Windows (Flatpack, Snap et AppImage)', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2023-12-26 17:00:19', 2, 1),
(8, 'Chob – Pour rechercher des applications MACOS (Flatpack, Snap et AppImage)', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2023-12-26 17:00:19', 3, 1),
(9, 'Présentation de la version 5.0 de Symfony !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 5, 8),
(10, 'Présentation de la version 10.0 de FiveM !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 6, 8),
(11, 'Présentation de la version 11.0 de FiveM !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 8, 8);

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
  ADD CONSTRAINT `articleoftheday_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tag_article`
--
ALTER TABLE `tag_article`
  ADD CONSTRAINT `tag_article_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tag_article_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

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
