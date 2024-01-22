-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 22 jan. 2024 à 13:00
-- Version du serveur : 5.7.24
-- Version de PHP : 8.1.0

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

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `createdAt`, `user_id`) VALUES
(4, '2024-01-16 18:56:49', 8),
(5, '2024-01-16 18:56:49', 8),
(6, '2024-01-16 18:56:56', 8);

-- --------------------------------------------------------

--
-- Structure de la table `articleoftheday`
--

CREATE TABLE `articleoftheday` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articleoftheday`
--

INSERT INTO `articleoftheday` (`id`, `date`, `article_id`) VALUES
(22, '2024-01-16', 6),
(24, '2024-01-17', 4),
(25, '2024-01-17', 5),
(26, '2024-01-18', 4),
(28, '2024-01-19', 4),
(29, '2024-01-19', 6),
(30, '2024-01-20', 5),
(31, '2024-01-20', 6),
(32, '2024-01-22', 5),
(33, '2024-01-22', 6);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(1, 'Linuxe'),
(2, 'Windows'),
(3, 'Symfony'),
(4, 'Laravel'),
(5, 'JavaScript'),
(6, 'JQuery');

-- --------------------------------------------------------

--
-- Structure de la table `tag_article`
--

CREATE TABLE `tag_article` (
  `id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tag_article`
--

INSERT INTO `tag_article` (`id`, `tag_id`, `article_id`) VALUES
(3, 2, 6),
(1, 5, 4),
(2, 6, 4);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'ROLE_USER',
  `apiKey` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `firstname`, `lastname`, `password`, `role`, `apiKey`) VALUES
(8, 'a@a.fr', 'kozeuh', 'Kozeuh', 'Dev', '$2y$10$0hkT.oXXqfXhUQSLloTeUOFS5QEMzMgHsgUrx38CQujMMSf2aSHFe', 'ROLE_ADMIN', '65ae2d055ab972.21700851'),
(9, 'nikolailemerre@gmail.com', 'nikoo', 'Nikolaï', 'LEMERRE', '$2y$10$vZH./rCJdDAxgqYtBkN8A.7EaSeGcVNsrxEvCswQx8H4O83MfSiJ2', 'ROLE_ADMIN', '65ae2d2518f312.31836580'),
(11, 'antoinebtn@gmail.com', 'antoinebtn', 'Antoine', 'Broutin', '$2y$10$pyIWALDMUX.iJhuXP9mSX.vLD99lJSc06.WreYo2ou.xxfith7Gdq', 'ROLE_USER', '65ae2a0922d880.13696302');

-- --------------------------------------------------------

--
-- Structure de la table `version_article`
--

CREATE TABLE `version_article` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `isValid` tinyint(1) DEFAULT NULL,
  `content` text,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `article_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `version_article`
--

INSERT INTO `version_article` (`id`, `title`, `isValid`, `content`, `updatedAt`, `article_id`, `user_id`) VALUES
(5, 'Présentation de la version 0.8 de JQuery !', 0, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-10 17:00:19', 4, 8),
(6, 'Présentation de la version 1.0 de JQuery !', 1, '<h1>Présentation v1</h1>\r\n<p>Coucou alors c\'est juste un paragraphe de test !</p>\r\n\r\n<h2 class=\"text-center\">Ce titre est centré et ceci est un test ! </h2>', '2024-01-14 17:00:19', 4, 8),
(9, 'Présentation de la version 5.0 de Symfony !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 5, 8),
(10, 'Présentation de la version 10.0 de FiveM !', 0, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 6, 8),
(11, 'Présentation de la version 11.0 de FiveM !', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2024-01-16 17:00:19', 6, 8);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `articleoftheday`
--
ALTER TABLE `articleoftheday`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`article_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tag_article`
--
ALTER TABLE `tag_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tag_id` (`tag_id`,`article_id`),
  ADD KEY `article_id` (`article_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `version_article`
--
ALTER TABLE `version_article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `articleoftheday`
--
ALTER TABLE `articleoftheday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `tag_article`
--
ALTER TABLE `tag_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `version_article`
--
ALTER TABLE `version_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
