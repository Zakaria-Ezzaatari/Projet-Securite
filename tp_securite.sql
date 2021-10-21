-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 16 oct. 2021 à 21:20
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tp_securite`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int NOT NULL AUTO_INCREMENT,
  `user_comment_id` int NOT NULL,
  `post_id` int NOT NULL,
  `comment_content` varchar(500) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `user_comment_id` (`user_comment_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `demande_ami`
--

DROP TABLE IF EXISTS `demande_ami`;
CREATE TABLE IF NOT EXISTS `demande_ami` (
  `id_demande_ami` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_ami` int NOT NULL,
  `date_demande_ami` datetime NOT NULL,
  `statut_demande` int NOT NULL,
  PRIMARY KEY (`id_demande_ami`,`id_utilisateur`,`id_ami`),
  UNIQUE KEY `date_demande_ami` (`id_demande_ami`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_ami` (`id_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `gallerie`
--

DROP TABLE IF EXISTS `gallerie`;
CREATE TABLE IF NOT EXISTS `gallerie` (
  `id_gallerie` int NOT NULL AUTO_INCREMENT,
  `titre_gallerie` varchar(50) DEFAULT NULL,
  `date_creation_galleire` datetime DEFAULT NULL,
  `confidentialite_gallerie` varchar(30) DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  PRIMARY KEY (`id_gallerie`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `liste_ami`
--

DROP TABLE IF EXISTS `liste_ami`;
CREATE TABLE IF NOT EXISTS `liste_ami` (
  `id_liste_ami` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int NOT NULL,
  `id_ami` int NOT NULL,
  `date_ajout_ami` datetime NOT NULL,
  PRIMARY KEY (`id_liste_ami`,`id_utilisateur`,`id_ami`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_ami` (`id_ami`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id_photo` int NOT NULL AUTO_INCREMENT,
  `photo` longblob,
  `date_ajout_photo` datetime DEFAULT NULL,
  `confidentialite_photo` varchar(30) DEFAULT NULL,
  `id_utilisateur` int DEFAULT NULL,
  `id_gallerie` int DEFAULT NULL,
  PRIMARY KEY (`id_photo`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_gallerie` (`id_gallerie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_title` varchar(100) NOT NULL,
  `post_content` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(250) DEFAULT NULL,
  `prenom_utilisateur` varchar(250) DEFAULT NULL,
  `date_ajout_utilisateur` datetime DEFAULT NULL,
  `statut_utilisateur` int DEFAULT NULL,
  `mot_de_passe_utilisateur` varchar(250) DEFAULT NULL,
  `login_utilisateur` varchar(250) DEFAULT NULL,
  `telephone_utilisateur` int DEFAULT NULL,
  `email_utilisateur` varchar(250) DEFAULT NULL,
  `photo_profil` longblob,
  `code_confirmation_utilisateur` varchar(256) DEFAULT NULL,
  `date_expiration_code_confirmation` datetime DEFAULT NULL,
  `token_mot_de_passe_oublier` varchar(256) DEFAULT NULL,
  `description_utilisateur` varchar(256) ,
  `adresse_utilisateur` char(100) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

