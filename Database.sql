-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 05 avr. 2023 à 14:56
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
-- Base de données : `SP_Comptable`
--

CREATE DATABASE IF NOT EXISTS SP_Comptable;
USE SP_Comptable;



-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(50) DEFAULT NULL,
  `id_type_comptable` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_c

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom_categorie`, `id_type_comptable`) VALUES
(1, 'Shopping', 2),
(2, 'Nourriture', 2),
(3, 'Transport', 2),
(4, 'Salaire', 1);

-- --------------------------------------------------------

--
-- Structure de la table `moyen_de_paiement`
--

DROP TABLE IF EXISTS `moyen_de_paiement`;
CREATE TABLE IF NOT EXISTS `moyen_de_paiement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_moyen_de_paiment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `moyen_de_paiement`
--

INSERT INTO `moyen_de_paiement` (`id`, `nom_moyen_de_paiment`) VALUES
(1, 'Carte Bancaire'),
(2, 'Espece'),
(3, 'Virement'),
(4, 'Cheque'),
(5, 'Crypto');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_transaction` datetime DEFAULT NULL,
  `montant` decimal(10,0) DEFAULT NULL,
  `description` varchar(50) NOT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  `id_moyen_de_paiement` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `date_transaction`, `montant`, `description`, `id_categorie`, `id_moyen_de_paiement`) VALUES
(3, '2023-04-12 12:09:00', '100', 'Test', 2, 1),
(9, '2023-04-01 12:16:00', '1100', 'Salaire Mars', 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_comptable`
--

DROP TABLE IF EXISTS `type_comptable`;
CREATE TABLE IF NOT EXISTS `type_comptable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_type_comptable` varchar(50) DEFAULT NULL,
  `coefficient` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `type_comptable`
--

INSERT INTO `type_comptable` (`id`, `nom_type_comptable`, `coefficient`) VALUES
(1, 'Crédit', 1),
(2, 'Débit', -1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;