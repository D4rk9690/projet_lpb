-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 05 juin 2023 à 22:06
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `examfin`
--

-- --------------------------------------------------------

--
-- Structure de la table `houses`
--

DROP TABLE IF EXISTS `houses`;
CREATE TABLE IF NOT EXISTS `houses` (
  `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  `house_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `is_louer` tinyint(1) DEFAULT '0',
  `description` text,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `reserved` date DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `houses`
--

INSERT INTO `houses` (`id`, `house_name`, `image`, `is_louer`, `description`, `date`, `reserved`, `status`) VALUES
(4, 'chalet de ans', 'jfVOsBdHSqYgdvhGY07O_bbaf20fd-a6f9-4c44-cccd-a38431aaa479.webp', 0, 'Decouvrez notre chalet a Ans, en Belgique ! Profitez d\'un sejour paisible au coeur de la nature, entoure de paysages pittoresques. Ce chalet chaleureux et confortable offre un refuge ideal pour se ressourcer et profiter de moments inoubliables en famille ou entre amis. Reservez des maintenant et vivez une experience unique dans ce havre de tranquillite en Belgique.', '2023-06-04 09:51:11', '2023-06-09', 'Attente'),
(5, 'Chalet de spa', '381931806.jpg', 0, 'Decouvrez notre chalet en Suisse, niche au coeur des montagnes ! Plongez-vous dans l\'atmosphere alpine et profitez d\'une vue imprenable sur les sommets enneiges. Ce chalet authentique allie charme traditionnel et confort moderne pour vous offrir un sejour inoubliable. Profitez des activites de plein air tout au long de l\'annee, que ce soit le ski en hiver ou la randonnee en ete. ', '2023-06-04 09:58:24', NULL, NULL),
(7, 'Chalet a ma montagne', 'log-cabin-1594361_960_720.webp', 0, 'Decouvrez notre chalet a la montagne, situe au coeur des sommets majestueux ! Plongez-vous dans l\'atmosphere envoutante de la nature sauvage et profitez d\'une vue panoramique a couper le souffle. Ce chalet pittoresque offre une escapade ideale pour les amoureux de la montagne. Detendez-vous au coin du feu, partez en randonnee a travers les sentiers alpins ou devalez les pistes de ski en hiver. Reservez des maintenant et laissez-vous envouter par l\'harmonie parfaite entre confort, tranquilite et aventures en pleine nature dans ce chalet de montagne.', '2023-06-05 21:54:52', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
