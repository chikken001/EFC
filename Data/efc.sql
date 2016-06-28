-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 28 Juin 2016 à 22:44
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `efc`
--

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(150) NOT NULL,
  `message` text,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `agendatraduction`
--

CREATE TABLE IF NOT EXISTS `agendatraduction` (
  `id` int(11) NOT NULL,
  `id_agenda` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `picture`, `title`, `message`, `created_at`, `id_user`, `id_language`) VALUES
(1, 'desert.jpg', 'Titre test', 'Message test', '2016-06-25 20:44:35', 2, 2),
(2, '', 'test 2', 'article sans traduction', '2016-06-26 17:12:17', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `articletraduction`
--

CREATE TABLE IF NOT EXISTS `articletraduction` (
  `id` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articletraduction`
--

INSERT INTO `articletraduction` (`id`, `id_article`, `title`, `message`, `id_language`) VALUES
(1, 1, 'Title test', 'Message test', 3),
(2, 1, '职称考试', '测试消息', 1);

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

CREATE TABLE IF NOT EXISTS `article_tag` (
  `id` int(11) NOT NULL,
  `article` int(11) NOT NULL,
  `tag` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article_tag`
--

INSERT INTO `article_tag` (`id`, `article`, `tag`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `id_language`) VALUES
(1, 'Président en France d''Environnement France Chine', 2),
(2, 'Chargée des relations avec les Universités', 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorytraduction`
--

CREATE TABLE IF NOT EXISTS `categorytraduction` (
  `id` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `categorytraduction`
--

INSERT INTO `categorytraduction` (`id`, `id_category`, `name`, `id_language`) VALUES
(1, 1, 'President of Environnement France Chine in France', 3),
(2, 1, '法中环境协会法方会长', 1),
(3, 2, 'Responsible for relations with Universities', 3),
(4, 2, '校际交流代表', 1);

-- --------------------------------------------------------

--
-- Structure de la table `job`
--

CREATE TABLE IF NOT EXISTS `job` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `job`
--

INSERT INTO `job` (`id`, `name`, `id_language`) VALUES
(1, 'Avocat au Barreau de Paris', 2),
(2, 'Professeur Agrégé – Faculté de Droit Jean Monnet', 2);

-- --------------------------------------------------------

--
-- Structure de la table `jobtraduction`
--

CREATE TABLE IF NOT EXISTS `jobtraduction` (
  `id` int(11) NOT NULL,
  `id_job` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `jobtraduction`
--

INSERT INTO `jobtraduction` (`id`, `id_job`, `id_language`, `name`) VALUES
(1, 1, 3, 'Lawyer, Paris Bar'),
(2, 1, 1, '巴黎律师公会注册律师'),
(3, 2, 3, 'Lecturer – Jean Monnet Law Faculty, Paris Sud University'),
(4, 2, 1, '让 莫奈（巴黎11大）法学院资格教师');

-- --------------------------------------------------------

--
-- Structure de la table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL,
  `name` varchar(155) NOT NULL,
  `code` char(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `language`
--

INSERT INTO `language` (`id`, `name`, `code`) VALUES
(1, 'chinese', 'zh'),
(2, 'french', 'fr'),
(3, 'english', 'en');

-- --------------------------------------------------------

--
-- Structure de la table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `id_article` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sess_id` char(40) NOT NULL,
  `sess_datas` text NOT NULL,
  `sess_ip` varchar(15) NOT NULL,
  `sess_expire` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `id_language`) VALUES
(1, 'test tag', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tagtraduction`
--

CREATE TABLE IF NOT EXISTS `tagtraduction` (
  `id` int(11) NOT NULL,
  `id_tag` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `first_name_ch` varchar(150) DEFAULT NULL,
  `last_name_ch` varchar(150) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `team`
--

INSERT INTO `team` (`id`, `first_name`, `last_name`, `first_name_ch`, `last_name_ch`, `id_category`, `email`, `picture`) VALUES
(1, 'Manuel', 'Pennaforte', '潘富石', NULL, 1, 'mpennaforte@environnement-france-chine.org', NULL),
(2, 'Susan', 'Harris', '海苏珊', NULL, 2, 'sharris@environnement-france-chine.org ', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `team_job`
--

CREATE TABLE IF NOT EXISTS `team_job` (
  `id` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `job` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `team_job`
--

INSERT INTO `team_job` (`id`, `team`, `job`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `login` varchar(255) NOT NULL,
  `password` char(128) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` char(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `first_name_ch` varchar(150) DEFAULT NULL,
  `last_name_ch` varchar(150) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `admin`, `login`, `password`, `last_name`, `first_name`, `created_at`, `salt`, `active`, `first_name_ch`, `last_name_ch`) VALUES
(2, 0, 'chikken', '5873272b15f16e4f05be25d52235936c26d8b8051e7a439fea7b976d352e529e8b12f013351e37fd05a1e250cb678245da58ac53af2a25c7b6f69bdae2caad12', 'aujean', 'thomas', '2016-06-25 20:42:27', '@e6Hù9+aQ5', 1, '托马斯', NULL);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `agenda`
--
ALTER TABLE `agenda`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `agendatraduction`
--
ALTER TABLE `agendatraduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_agenda` (`id_agenda`),
  ADD KEY `id_language` (`id_language`);

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_language` (`id_language`);

--
-- Index pour la table `articletraduction`
--
ALTER TABLE `articletraduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_language` (`id_language`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article` (`article`),
  ADD KEY `tag` (`tag`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_language` (`id_language`);

--
-- Index pour la table `categorytraduction`
--
ALTER TABLE `categorytraduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_language` (`id_language`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_language` (`id_language`);

--
-- Index pour la table `jobtraduction`
--
ALTER TABLE `jobtraduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_job` (`id_job`),
  ADD KEY `id_language` (`id_language`);

--
-- Index pour la table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`);

--
-- Index pour la table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sess_id`);

--
-- Index pour la table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_language` (`id_language`);

--
-- Index pour la table `tagtraduction`
--
ALTER TABLE `tagtraduction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_language` (`id_language`),
  ADD KEY `id_tag` (`id_tag`);

--
-- Index pour la table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Index pour la table `team_job`
--
ALTER TABLE `team_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team` (`team`),
  ADD KEY `job` (`job`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `agenda`
--
ALTER TABLE `agenda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `agendatraduction`
--
ALTER TABLE `agendatraduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `articletraduction`
--
ALTER TABLE `articletraduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `article_tag`
--
ALTER TABLE `article_tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `categorytraduction`
--
ALTER TABLE `categorytraduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `jobtraduction`
--
ALTER TABLE `jobtraduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `tagtraduction`
--
ALTER TABLE `tagtraduction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `team_job`
--
ALTER TABLE `team_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `agendatraduction`
--
ALTER TABLE `agendatraduction`
  ADD CONSTRAINT `agendatraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `agendatraduction_ibfk_2` FOREIGN KEY (`id_agenda`) REFERENCES `agenda` (`id`),
  ADD CONSTRAINT `agendatraduction_ibfk_3` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `article_ibfk_2` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `articletraduction`
--
ALTER TABLE `articletraduction`
  ADD CONSTRAINT `articletraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `articletraduction_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD CONSTRAINT `article_tag_ibfk_1` FOREIGN KEY (`article`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `article_tag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`);

--
-- Contraintes pour la table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `categorytraduction`
--
ALTER TABLE `categorytraduction`
  ADD CONSTRAINT `categorytraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `categorytraduction_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `jobtraduction`
--
ALTER TABLE `jobtraduction`
  ADD CONSTRAINT `jobtraduction_ibfk_1` FOREIGN KEY (`id_job`) REFERENCES `job` (`id`),
  ADD CONSTRAINT `jobtraduction_ibfk_2` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `picture_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `tagtraduction`
--
ALTER TABLE `tagtraduction`
  ADD CONSTRAINT `tagtraduction_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `tagtraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);

--
-- Contraintes pour la table `team_job`
--
ALTER TABLE `team_job`
  ADD CONSTRAINT `team_job_ibfk_1` FOREIGN KEY (`team`) REFERENCES `team` (`id`),
  ADD CONSTRAINT `team_job_ibfk_2` FOREIGN KEY (`job`) REFERENCES `job` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
