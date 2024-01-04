-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 04 jan. 2024 à 18:46
-- Version du serveur : 5.7.39
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

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `createdAt`, `tags`, `user_id`) VALUES
(1, '2023-12-26 16:57:59', 'informatique, linux, ', 1),
(2, '2024-01-03 16:46:38', 'test,tyest', 1),
(3, '2024-01-03 16:47:27', 'test,tyest', 1);

-- --------------------------------------------------------

--
-- Structure de la table `articleOfTheDay`
--

CREATE TABLE `articleOfTheDay` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `articleOfTheDay`
--

INSERT INTO `articleOfTheDay` (`id`, `date`, `id_article`) VALUES
(16, '2024-01-04', 3);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `username`, `firstname`, `lastname`, `password`) VALUES
(1, 'nikolailemerre@gmail.com', 'Nikoolaii', 'Nikolaï', 'LEMERRE', '4f56fe65c8bd5296ca6a5f95faa0d65fb54b1ad8a87a1f816c7206803bcff938');

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
(1, 'Chob – Pour rechercher des applications Linux (Flatpack, Snap et AppImage)', 1, '<h1>Content 1</h1>\r\n<p>This is the first content of the first version of the article', '2023-12-26 16:59:18', 1, 1),
(2, 'Chob – Pour rechercher des applications Linux (Flatpack, Snap et AppImage)', 1, '<h1>Content nb2</h1>\r\n<p>This is the second content of the first article</p>', '2023-12-26 17:00:19', 1, 1),
(3, 'Test', 0, '<p>ceci est un test d\'article</p>', '2024-01-03 16:46:38', 2, 1),
(4, 'Test', 0, '<p>ceci est un test d\'article</p>', '2024-01-03 16:47:27', 3, 1);

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
-- Index pour la table `articleOfTheDay`
--
ALTER TABLE `articleOfTheDay`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `articleOfTheDay`
--
ALTER TABLE `articleOfTheDay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `version_article`
--
ALTER TABLE `version_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `version_article`
--
ALTER TABLE `version_article`
  ADD CONSTRAINT `version_article_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `version_article_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
