-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2024 at 05:58 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestion_stock`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Telephone'),
(2, 'Tablet'),
(3, 'Pc-Portable'),
(4, 'Switch');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `ice` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `nom`, `ice`, `email`, `phone`, `adresse`) VALUES
(4, 'Hmimou', '123456789012323', 'kawe44@fahih.com', '0612341223', 'Rabat, Moroc'),
(5, 'asjasd', '123456780812345', 'ka44@fahih.com', '0612341223', 'Sale'),
(6, 'client1', '123456789012348', 'client1@fahih.com', '0612341223', 'Kenitra');

-- --------------------------------------------------------

--
-- Table structure for table `emplacement`
--

DROP TABLE IF EXISTS `emplacement`;
CREATE TABLE IF NOT EXISTS `emplacement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `capacity_max` int NOT NULL,
  `capacity_actuelle` int DEFAULT (`capacity_max`),
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `emplacement`
--

INSERT INTO `emplacement` (`id`, `nom`, `capacity_max`, `capacity_actuelle`) VALUES
(1, 'emp1', 200, 165),
(2, 'emp2', 120, 76),
(24, 'emp3', 300, 235);

-- --------------------------------------------------------

--
-- Table structure for table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `facture`
--

INSERT INTO `facture` (`id`, `type`) VALUES
(1, 'reception'),
(2, 'reception'),
(3, 'reception'),
(4, 'reception'),
(6, 'reception'),
(7, 'expedition'),
(8, 'expedition'),
(9, 'expedition'),
(10, 'reception'),
(11, 'expedition'),
(12, 'reception'),
(13, 'expedition');

-- --------------------------------------------------------

--
-- Table structure for table `fornisseur`
--

DROP TABLE IF EXISTS `fornisseur`;
CREATE TABLE IF NOT EXISTS `fornisseur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(30) DEFAULT NULL,
  `ice` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `adresse` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fornisseur`
--

INSERT INTO `fornisseur` (`id`, `nom`, `ice`, `email`, `phone`, `adresse`) VALUES
(1, 'forni1', '123456789012345', 'forn@ahm.ma', '0612341223', 'layaayda'),
(3, 'forni2', '123456789012345', 'kawete3944@fahih.com', '0612341223', 'Rabat');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` text,
  `categorie` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id`, `code`, `nom`, `description`, `categorie`) VALUES
(1, '22/2012', 'Samsung Galaxy A04', 'Le Galaxy A04 est un téléphone de base de la série Galaxy A, ce qui signifie qu\'il est équipé de fonctionnalités d\'entrée de gamme, mais à un prix abordable.', 1),
(2, '22/2013', 'XIAOMI redmi A3', 'Redmi A3 présente un tout nouveau design Halo Premium qui est accrocheur et vous donne fière allure dans une mer de designs ennuyeux. Choisissez parmi trois belles couleurs qui vous démarqueront toujours.', 1),
(3, '21/2023', 'Apple Tablette-iPad Air1', 'Clairement, Apple vise toujours plus haut dans la maîtrise de ses produits. Alors même que l’iPad Air1 était d’une très grande qualité.', 2),
(4, '22/2016', 'Apple Pad 2021', 'Avec l’iPad, travailler devient une véritable partie de plaisir. Modifiez facilement un document tout en consultant un site web et en appelant un collègue sur FaceTime', 2),
(5, '20/2012', 'Hp PC PORTABLE ELITEBOOK 755', 'Hp Elitebook 755 G3 AMD PRO A10-8700B 8GB RAM 256GB SSD 15.6 Inches FHD Display-REMIS A NEUF', 3),
(6, '20/2013', 'DELL PC Portable Latitude E555', 'Nom : DELL Latitude E5550 2.3GHz i3-4300U Ecran : 15.6 \"  HD 1366 x 768 pixels Noir Modèle de processeur : i3-4300U Famille de processeur : Intel Core i3-5ème Génération', 3),
(7, '25/2012', 'TP-Link TL-POE150S', 'L’injecteur PoE TL-POE150S est parfaitement conforme aux normes 802.3af et fonctionne avec tous les appareils téléalimentés PoE répondant à la norme IEEE 802', 4),
(8, '25/2016', 'tenda Switch Ethernet 8-port', 'Le commutateur Ethernet Tenda 8 ports S108 est un commutateur de bureau spécialement conçu pour les familles, les bureaux, les dortoirs, etc', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reception`
--

DROP TABLE IF EXISTS `reception`;
CREATE TABLE IF NOT EXISTS `reception` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produit` int DEFAULT NULL,
  `fornisseur` int NOT NULL,
  `emplacement` int DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `date_reception` date DEFAULT NULL,
  `statut` varchar(20) NOT NULL,
  `user` int NOT NULL,
  `facture` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `reception`
--

INSERT INTO `reception` (`id`, `produit`, `fornisseur`, `emplacement`, `quantite`, `date_reception`, `statut`, `user`, `facture`) VALUES
(1, 1, 1, 1, 25, '2024-03-12', 'associe', 1, 1),
(4, 7, 3, 2, 80, '2024-03-22', 'associe', 1, 2),
(7, 6, 3, 2, 9, '2024-03-22', 'associe', 1, 2),
(9, 8, 3, 2, 10, '2024-03-22', 'associe', 1, 2),
(10, 5, 3, 2, 14, '2024-03-22', 'associe', 1, 2),
(11, 1, 1, 1, 10, '2024-03-05', 'associe', 1, 3),
(15, 1, 1, 24, 20, '2024-03-19', 'associe', 1, 6),
(16, 7, 3, 2, 5, '2024-03-25', 'associe', 5, 4),
(18, 5, 1, 24, 10, '2024-03-19', 'associe', 1, 6),
(19, 7, 1, 24, 5, '2024-03-19', 'associe', 1, 6),
(25, 5, 3, 24, 20, '2024-03-24', 'associe', 5, 10),
(26, 3, 3, 24, 30, '2024-03-24', 'associe', 5, 10),
(27, 4, 1, 1, 40, '2024-03-23', 'associe', 5, 12);

--
-- Triggers `reception`
--
DROP TRIGGER IF EXISTS `confirm_reception`;
DELIMITER $$
CREATE TRIGGER `confirm_reception` AFTER UPDATE ON `reception` FOR EACH ROW begin
	declare exist int;
    select count(*) into exist from stock where produit = new.produit and emplacement = new.emplacement;
    
    if new.statut = 'associe' and old.statut = 'selection' then
    if exist > 0 then
		update stock set quantite = quantite + new.quantite where produit = new.produit and emplacement = new.emplacement;
	else
		INSERT INTO `stock` (`produit`, `quantite`, `emplacement`) VALUES ( new.produit, new.quantite, new.emplacement);
    end if;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sortie`
--

DROP TABLE IF EXISTS `sortie`;
CREATE TABLE IF NOT EXISTS `sortie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produit` int DEFAULT NULL,
  `client` int DEFAULT NULL,
  `emplacement` int DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `date_livraison` date NOT NULL,
  `statut` varchar(20) NOT NULL,
  `user` int NOT NULL,
  `facture` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sortie`
--

INSERT INTO `sortie` (`id`, `produit`, `client`, `emplacement`, `quantite`, `date_livraison`, `statut`, `user`, `facture`) VALUES
(3, 7, 4, 2, 30, '2024-03-20', 'associe', 1, 7),
(5, 5, 6, 2, 14, '2024-03-25', 'associe', 1, 8),
(7, 7, 5, 2, 30, '2024-03-21', 'associe', 5, 9),
(8, 1, 5, 1, 10, '2024-03-21', 'associe', 5, 9),
(9, 1, 5, 24, 5, '2024-03-21', 'associe', 5, 9),
(10, 3, 4, 24, 15, '2024-03-24', 'associe', 5, 11),
(11, 4, 4, 1, 30, '2024-03-25', 'associe', 5, 13);

--
-- Triggers `sortie`
--
DROP TRIGGER IF EXISTS `confirm_expedition`;
DELIMITER $$
CREATE TRIGGER `confirm_expedition` AFTER UPDATE ON `sortie` FOR EACH ROW begin
    if new.statut = 'associe' and old.statut = 'selection' then
		update stock set quantite = quantite - new.quantite where produit = new.produit and emplacement = new.emplacement;
    end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int NOT NULL AUTO_INCREMENT,
  `produit` int DEFAULT NULL,
  `quantite` int DEFAULT NULL,
  `emplacement` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `produit`, `quantite`, `emplacement`) VALUES
(4, 1, 25, 1),
(5, 7, 25, 2),
(6, 6, 9, 2),
(7, 8, 10, 2),
(8, 5, 0, 2),
(10, 1, 15, 24),
(11, 5, 30, 24),
(12, 7, 5, 24),
(13, 3, 15, 24),
(14, 4, 10, 1);

--
-- Triggers `stock`
--
DROP TRIGGER IF EXISTS `delete_quantite_stock`;
DELIMITER $$
CREATE TRIGGER `delete_quantite_stock` AFTER DELETE ON `stock` FOR EACH ROW begin
	declare capacity int;
    select COALESCE(sum(quantite), 0) into capacity from stock where emplacement = old.emplacement;
    update emplacement set capacity_actuelle = capacity_max - capacity where id = old.emplacement;
end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `insert_quantite_stock`;
DELIMITER $$
CREATE TRIGGER `insert_quantite_stock` AFTER INSERT ON `stock` FOR EACH ROW begin
	declare capacity int;
    select coalesce(sum(quantite), 0) into capacity from stock where emplacement = new.emplacement;
    update emplacement set capacity_actuelle = capacity_max - capacity where id = new.emplacement;
end
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `update_quantite_stock`;
DELIMITER $$
CREATE TRIGGER `update_quantite_stock` AFTER UPDATE ON `stock` FOR EACH ROW begin
	declare capacity int;
    select coalesce(sum(quantite), 0) into capacity from stock where emplacement = new.emplacement;
    update emplacement set capacity_actuelle = capacity_max - capacity where id = new.emplacement;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `motpass` varchar(100) DEFAULT NULL,
  `role` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nom`, `login`, `motpass`, `role`) VALUES
(1, 'Alae Hmimou', 'root', 'admin', 'admin'),
(5, 'Ayoub Bouihe', 'Ayoub01', 'admin', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
