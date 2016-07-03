-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 03 Juillet 2016 à 21:28
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `efc`
--

-- --------------------------------------------------------

--
-- Structure de la table `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(150) NOT NULL,
  `message` text,
  `id_language` int(11) NOT NULL,
  `place` varchar(150) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(6) DEFAULT NULL,
  `adress` text,
  `city_ch` varchar(100) DEFAULT NULL,
  `place_ch` varchar(150) DEFAULT NULL,
  `id_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `agenda`
--

INSERT INTO `agenda` (`id`, `date`, `created_at`, `title`, `message`, `id_language`, `place`, `city`, `postal_code`, `adress`, `city_ch`, `place_ch`, `id_type`) VALUES
(1, '2016-06-30', '2016-06-30 21:10:28', 'date de rendu du projet', 'Ouais on a fini ^^', 2, 'chez moi', 'nogent sur marne', '94130', '44 rue de coulmier', '马恩河畔诺让', '家', 2),
(2, '2016-07-09', '2016-06-30 21:16:06', 'sorti ciné', 'go voir warcraft', 2, '', '', '', '', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `agendatraduction`
--

CREATE TABLE IF NOT EXISTS `agendatraduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_agenda` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text,
  PRIMARY KEY (`id`),
  KEY `id_agenda` (`id_agenda`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `agendatraduction`
--

INSERT INTO `agendatraduction` (`id`, `id_agenda`, `id_language`, `title`, `message`) VALUES
(1, 1, 1, '呈现项目的日期', '是啊，我们结束 ^^'),
(2, 1, 3, 'rendering date of project', 'Yeah we ended ^^');

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(255) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `picture`, `title`, `message`, `created_at`, `id_user`, `id_language`) VALUES
(1, 'desert.jpg', 'Titre test', 'Message test', '2016-06-25 20:44:35', 2, 2),
(2, '', 'article 2', 'article sans traduction\r\nsans tag', '2016-06-26 17:12:17', 2, 2),
(3, '', 'autre article', 'article avec 2 tag\r\nsans traduction', '2016-06-29 21:59:19', 2, 2),
(4, '', 'article 4', 'article avec le même tag que le 1 et le 2', '2016-06-29 23:14:32', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `articletraduction`
--

CREATE TABLE IF NOT EXISTS `articletraduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_article` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `message` text,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article` (`article`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `article_tag`
--

INSERT INTO `article_tag` (`id`, `article`, `tag`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 3, 2),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `category`
--

INSERT INTO `category` (`id`, `name`, `id_language`, `ordre`) VALUES
(1, 'Président en France d''Environnement France Chine', 2, 1),
(2, 'Chargée des relations avec les Universités', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `categorytraduction`
--

CREATE TABLE IF NOT EXISTS `categorytraduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_job` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_job` (`id_job`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(155) NOT NULL,
  `code` char(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE IF NOT EXISTS `picture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `picture`
--

INSERT INTO `picture` (`id`, `name`, `id_article`) VALUES
(1, 'test', 1);

-- --------------------------------------------------------

--
-- Structure de la table `resume`
--

CREATE TABLE IF NOT EXISTS `resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `id_language` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_article` (`id_article`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `resume`
--

INSERT INTO `resume` (`id`, `message`, `id_language`, `id_article`) VALUES
(1, 'résumé de l''article 1', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `resumetraduction`
--

CREATE TABLE IF NOT EXISTS `resumetraduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_resume` int(11) NOT NULL,
  `message` text NOT NULL,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_resume` (`id_resume`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `resumetraduction`
--

INSERT INTO `resumetraduction` (`id`, `id_resume`, `message`, `id_language`) VALUES
(1, 1, '在第1条概要', 1);

-- --------------------------------------------------------

--
-- Structure de la table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `sess_id` char(40) NOT NULL,
  `sess_datas` text NOT NULL,
  `sess_ip` varchar(15) NOT NULL,
  `sess_expire` int(10) NOT NULL,
  PRIMARY KEY (`sess_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tag`
--

INSERT INTO `tag` (`id`, `name`, `id_language`) VALUES
(1, 'test tag', 2),
(2, 'tag 2', 2);

-- --------------------------------------------------------

--
-- Structure de la table `tagtraduction`
--

CREATE TABLE IF NOT EXISTS `tagtraduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tag` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_tag` (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `team`
--

CREATE TABLE IF NOT EXISTS `team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `first_name_ch` varchar(150) DEFAULT NULL,
  `last_name_ch` varchar(150) DEFAULT NULL,
  `id_category` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_category` (`id_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` int(11) NOT NULL,
  `job` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `team` (`team`),
  KEY `job` (`job`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `team_job`
--

INSERT INTO `team_job` (`id`, `team`, `job`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `id_language` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type`
--

INSERT INTO `type` (`id`, `name`, `id_language`) VALUES
(1, 'cinema', 2),
(2, 'autre', 2);

-- --------------------------------------------------------

--
-- Structure de la table `typetraduction`
--

CREATE TABLE IF NOT EXISTS `typetraduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `id_language` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_language` (`id_language`),
  KEY `id_type` (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `typetraduction`
--

INSERT INTO `typetraduction` (`id`, `id_type`, `id_language`, `name`) VALUES
(1, 1, 1, '电影院'),
(2, 1, 3, 'cinema');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `login` varchar(255) NOT NULL,
  `password` char(128) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `salt` char(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `first_name_ch` varchar(150) DEFAULT NULL,
  `last_name_ch` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `admin`, `login`, `password`, `last_name`, `first_name`, `created_at`, `salt`, `active`, `first_name_ch`, `last_name_ch`) VALUES
(2, 0, 'chikken', '5873272b15f16e4f05be25d52235936c26d8b8051e7a439fea7b976d352e529e8b12f013351e37fd05a1e250cb678245da58ac53af2a25c7b6f69bdae2caad12', 'aujean', 'thomas', '2016-06-25 20:42:27', '@e6Hù9+aQ5', 1, '托马斯', NULL);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

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
-- Contraintes pour la table `resume`
--
ALTER TABLE `resume`
  ADD CONSTRAINT `resume_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `resume_ibfk_2` FOREIGN KEY (`id_article`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `resumetraduction`
--
ALTER TABLE `resumetraduction`
  ADD CONSTRAINT `resumetraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `resumetraduction_ibfk_2` FOREIGN KEY (`id_resume`) REFERENCES `resume` (`id`);

--
-- Contraintes pour la table `tag`
--
ALTER TABLE `tag`
  ADD CONSTRAINT `tag_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `tagtraduction`
--
ALTER TABLE `tagtraduction`
  ADD CONSTRAINT `tagtraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`),
  ADD CONSTRAINT `tagtraduction_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id`);

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

--
-- Contraintes pour la table `type`
--
ALTER TABLE `type`
  ADD CONSTRAINT `type_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

--
-- Contraintes pour la table `typetraduction`
--
ALTER TABLE `typetraduction`
  ADD CONSTRAINT `typetraduction_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `typetraduction_ibfk_1` FOREIGN KEY (`id_language`) REFERENCES `language` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
