-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 22 jan. 2024 à 21:57
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `createdAt`, `user_id`) VALUES
(4, '2024-01-16 18:56:49', 8),
(5, '2024-01-16 18:56:49', 8),
(6, '2024-01-16 18:56:56', 8),
(13, '2024-01-22 18:52:45', 11);

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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `articleoftheday`
--

INSERT INTO `articleoftheday` (`id`, `date`, `article_id`) VALUES
(22, '2024-01-16', 6),
(24, '2024-01-17', 4),
(25, '2024-01-17', 5),
(26, '2024-01-18', 4),
(28, '2024-01-22', 4),
(29, '2024-01-22', 6);

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `article_id` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `comment_ibfk_1` (`user_id`),
  KEY `comment_ibfk_2` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `article_id`, `content`, `createdAt`) VALUES
(11, 11, 4, 'trop bien !', '2024-01-22 22:50:25');

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

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
  `id` int NOT NULL AUTO_INCREMENT,
  `tag_id` int NOT NULL,
  `article_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tag_id` (`tag_id`,`article_id`),
  KEY `article_id` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tag_article`
--

INSERT INTO `tag_article` (`id`, `tag_id`, `article_id`) VALUES
(3, 2, 6),
(10, 5, 4),
(7, 5, 13),
(11, 6, 4);

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
  `apiKey` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `firstname`, `lastname`, `password`, `role`, `apiKey`) VALUES
(8, 'a@a.fr', 'kozeuh', 'Kozeuh', 'Dev', '$2y$10$0hkT.oXXqfXhUQSLloTeUOFS5QEMzMgHsgUrx38CQujMMSf2aSHFe', 'ROLE_ADMIN', '65aeb5fc775983.06144005'),
(11, 'nikolailemerre@gmail.com', 'nikoo', 'Nikolaï', 'LEMERRE', '$2y$10$NFxNYhb9GqfBAdPmWz2nDuuGrHyW6Tz0md6xxkAfQKkX3pZ/GH6Ky', 'ROLE_ADMIN', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `version_article`
--

DROP TABLE IF EXISTS `version_article`;
CREATE TABLE IF NOT EXISTS `version_article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `isValid` tinyint(1) NOT NULL DEFAULT '0',
  `content` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `version_article`
--

INSERT INTO `version_article` (`id`, `title`, `isValid`, `content`, `updatedAt`, `article_id`, `user_id`) VALUES
(5, 'Présentation de la version 0.8 de JQuery !', 0, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-10 17:00:19', 4, 8),
(6, 'Présentation de la version 1.0 de JQuery !', 1, '<h1>Présentation v1</h1>\r\n<p>Coucou alors c\'est juste un paragraphe de test !</p>\r\n\r\n<h2 class=\"text-center\">Ce titre est centré et ceci est un test ! </h2>', '2024-01-14 17:00:19', 4, 8),
(9, 'Présentation de la version 5.0 de Symfony !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 5, 8),
(10, 'Présentation de la version 10.0 de FiveM !', 0, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 6, 8),
(11, 'Présentation de la version 11.0 de FiveM !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 6, 8),
(14, 'Enlever l’obfuscation d’un code javascript', 0, '<div class=\"w-full h-64 bg-neutral-lightest\"><img class=\"object-cover w-full h-full multiply\" role=\"presentation\" src=\"https://korben.info/app/uploads/2011/07/wallpaper-751514.png\" width=\"1000\" height=\"360\" loading=\"lazy\"></div>\r\n<div class=\"entry-wrapper grid gap-10 -mt-10 pb-10 relative\"><header class=\"bg-white dark:bg-black p-10 -m-10 rounded-t-lg relative decoration\">\r\n<h1 class=\"font-bold\">Enlever l&rsquo;obfuscation d&rsquo;un code javascript</h1>\r\n<p class=\"byline author vcard fn uppercase text-xs font-bold p-1 text-primary\">@KORBEN&nbsp;&nbsp;&mdash;&nbsp;&nbsp;<time datetime=\"2011-07-22T09:30:33+00:00\">22 JUILLET 2011</time></p>\r\n</header>\r\n<div id=\"NKSYD1CP-38a65f1674895ccffcf51807072004a7\" class=\"NKSYD1CP-38a65f1674895ccffcf51807072004a7 NKSYD1CP-top-article\"></div>\r\n<div class=\"entry-wrapper alignfull grid prose dark:prose-dark max-w-none pb-2 overflow-x-hidden\">\r\n<p>L&rsquo;obfuscation de code javascript sur un site web permet 2 choses&hellip; Gagner en taille avec le raccourcissement des variables et la suppression de l&rsquo;indentation. Mais surtout rendre un peu plus obscur son code javascript pour un &ecirc;tre humain normalement constitu&eacute;.</p>\r\n<div id=\"NKSYD1CP-1460636654\" class=\"NKSYD1CP-target\" data-nksyd1cp-trackid=\"124505\" data-nksyd1cp-trackbid=\"1\"></div>\r\n<p>Et pourtant, il existe 2 m&eacute;thodes simple pour &laquo;&nbsp;desobfuscationner&nbsp;&raquo; un code javascript sur un site web.</p>\r\n<p>Premi&egrave;re m&eacute;thode : Faites un copier coller du code, et rendez vous sur le site&nbsp;<a href=\"https://beautifier.io/\">Beautifier.io</a>&nbsp;afin de remettre tout &ccedil;a en forme.</p>\r\n<p>Seconde m&eacute;thode : Avec Chrome, il y a directement la possibilit&eacute; de rendre lisible n&rsquo;importe quel code javascript un peu tortur&eacute;.</p>\r\n<p><iframe src=\"https://www.youtube.com/embed/AnrykWhRE-E?feature=oembed\" width=\"800\" height=\"450\" frameborder=\"0\" allow=\"autoplay; encrypted-media\" allowfullscreen=\"allowfullscreen\"></iframe></p>\r\n<p>Je pense que &ccedil;a vous servira&hellip;</p>\r\n<div id=\"NKSYD1CP-68589515\" class=\"NKSYD1CP-target\" data-nksyd1cp-trackid=\"124507\" data-nksyd1cp-trackbid=\"1\"></div>\r\n<p>[<a href=\"http://www.labnol.org/software/deobfuscate-javascript/19815/\">Source</a>]</p>\r\n</div>\r\n<div class=\"entry-wrapper alignfull grid prose dark:prose-dark max-w-none pb-2 overflow-x-hidden\">\r\n<div id=\"NKSYD1CP-e7128462ad9f49d8368b04a4c52bb5a2\" class=\"NKSYD1CP-e7128462ad9f49d8368b04a4c52bb5a2 NKSYD1CP-sous-categories\"></div>\r\n</div>\r\n</div>', '2024-01-22 18:52:45', 13, 11),
(15, 'Présentation de la version 1.0 de JQuery !', 0, '<h1>Pr&eacute;sentation v1</h1>\r\n<p>Coucou alors c\'est juste un paragraphe de test !</p>\r\n<h2 class=\"text-center\">Ce titre est centr&eacute; et ceci est un test</h2>', '2024-01-22 19:59:02', 4, 11),
(16, 'Présentation de la version 1.0 de JQuery !', 0, '<h1>Pr&eacute;sentation v1</h1>\r\n<p>Coucou alors c\'est juste un paragraphe de test !</p>\r\n<h2 class=\"text-center\">Ce titre est centr&eacute; et ceci est un test</h2>', '2024-01-22 20:00:15', NULL, 11),
(17, 'Présentation de la version 1.0 de JQuery !', 0, '<h1>Pr&eacute;sentation v1</h1>\r\n<p>Coucou alors c\'est juste un paragraphe de test !</p>\r\n<h2 class=\"text-center\">Ce titre est centr&eacute; et ceci est un test (oui)</h2>', '2024-01-22 20:02:02', 4, 11),
(18, 'Présentation de la version 1.0 de JQuery !', 0, '<h1>Pr&eacute;sentation v1</h1>\r\n<p>Coucou alors c\'est juste un paragraphe de test !</p>\r\n<h2 class=\"text-center\">Ce titre est centr&eacute; et ceci est un test (oui)</h2>\r\n<p>et encore une hehehe</p>', '2024-01-22 20:05:27', 4, 11);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `articleoftheday`
--
ALTER TABLE `articleoftheday`
  ADD CONSTRAINT `articleoftheday_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `version_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `version_article_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
