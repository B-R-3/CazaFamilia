-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 10 avr. 2025 à 09:25
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `caza familia`
--

DELIMITER $$
--
-- Fonctions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `renvoie_somme_produit` (`idcom` INT) RETURNS INT(11) DETERMINISTIC BEGIN
    DECLARE total_qte INT;
    
    -- Calcul de la somme des quantités pour une commande donnée
    SELECT SUM(qte) INTO total_qte
    FROM lignecommande
    WHERE id_commande = idcom;
    
    -- Retourner la somme calculée
    RETURN total_qte;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id_commande` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `_date` datetime NOT NULL DEFAULT current_timestamp(),
  `total_commande` decimal(10,2) DEFAULT 0.00,
  `type_conso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_user`, `id_etat`, `_date`, `total_commande`, `type_conso`) VALUES
(2, 2, 1, '2024-11-15 08:19:01', 127.66, 1),
(3, 2, 1, '2024-11-15 09:35:03', 116.05, 1),
(4, 2, 2, '2024-11-20 14:43:09', 217.80, 0),
(5, 2, 1, '2024-11-20 14:43:59', 144.10, 0),
(6, 3, 3, '2024-12-16 16:32:19', 22.00, 0),
(8, 3, 0, '2025-04-03 10:20:18', 61.60, 0),
(9, 8, 3, '2025-04-03 10:35:47', 14.77, 1),
(10, 8, 3, '2025-04-03 10:45:53', 10.55, 1),
(11, 9, 2, '2025-04-03 11:13:19', 145.59, 1),
(12, 5, 0, '2025-04-07 17:58:30', 7.70, 0),
(13, 5, 2, '2025-04-07 18:04:20', 25.32, 1),
(14, 5, 3, '2025-04-07 18:05:21', 25.32, 1),
(15, 5, 0, '2025-04-07 18:06:02', 0.00, 1),
(16, 5, 0, '2025-04-07 18:10:45', 88.00, 0),
(17, 5, 0, '2025-04-07 18:16:11', 59.08, 1),
(18, 5, 0, '2025-04-07 18:25:23', 22.00, 0),
(19, 5, 0, '2025-04-07 18:28:03', 42.20, 1),
(20, 5, 0, '2025-04-07 18:28:25', 42.20, 1),
(21, 5, 0, '2025-04-07 18:32:34', 253.20, 1),
(22, 5, 0, '2025-04-07 18:42:32', 239.80, 0),
(23, 5, 0, '2025-04-07 18:46:15', 15.40, 0),
(24, 5, 0, '2025-04-07 18:49:16', 21.10, 1),
(25, 5, 0, '2025-04-07 18:55:07', 110.00, 0),
(26, 5, 0, '2025-04-07 19:19:35', 82.50, 0),
(27, 10, 0, '2025-04-08 10:26:23', 1118.30, 1),
(28, 10, 0, '2025-04-08 10:26:27', 1118.30, 1),
(29, 5, 0, '2025-04-08 11:58:39', 0.00, 0),
(30, 5, 0, '2025-04-08 12:19:59', 11.00, 0),
(31, 5, 0, '2025-04-08 12:37:14', 92.40, 0);

-- --------------------------------------------------------

--
-- Structure de la table `lignecommande`
--

CREATE TABLE `lignecommande` (
  `id_ligne_commande` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `total_ligne_ht` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `lignecommande`
--

INSERT INTO `lignecommande` (`id_ligne_commande`, `id_commande`, `id_produit`, `qte`, `total_ligne_ht`) VALUES
(1, 2, 5, 3, 45.00),
(2, 2, 6, 3, 42.00),
(3, 2, 10, 1, 14.00),
(4, 2, 11, 1, 14.00),
(5, 2, 12, 1, 6.00),
(6, 3, 2, 3, 36.00),
(7, 3, 6, 1, 14.00),
(8, 3, 8, 1, 14.00),
(9, 3, 9, 1, 14.00),
(10, 3, 10, 1, 14.00),
(11, 3, 12, 1, 6.00),
(12, 3, 13, 2, 12.00),
(13, 4, 1, 5, 50.00),
(14, 4, 4, 2, 16.00),
(15, 4, 5, 1, 15.00),
(16, 4, 6, 1, 14.00),
(17, 4, 7, 1, 14.00),
(18, 4, 8, 2, 28.00),
(19, 4, 10, 2, 28.00),
(20, 4, 11, 1, 14.00),
(21, 4, 12, 1, 6.00),
(22, 4, 13, 1, 6.00),
(23, 4, 15, 1, 7.00),
(24, 5, 1, 4, 40.00),
(25, 5, 4, 1, 8.00),
(26, 5, 5, 1, 15.00),
(27, 5, 6, 1, 14.00),
(28, 5, 9, 2, 28.00),
(29, 5, 10, 1, 14.00),
(30, 5, 13, 2, 12.00),
(31, 6, 1, 2, 20.00),
(32, 8, 1, 2, 20.00),
(33, 8, 2, 2, 24.00),
(34, 8, 3, 1, 12.00),
(35, 9, 1, 1, 10.00),
(36, 9, 14, 1, 4.00),
(37, 10, 1, 1, 10.00),
(38, 11, 1, 3, 30.00),
(39, 11, 2, 4, 48.00),
(40, 11, 3, 5, 60.00),
(41, 12, 15, 1, 7.00),
(42, 13, 2, 2, 24.00),
(43, 14, 2, 2, 24.00),
(44, 16, 1, 8, 80.00),
(45, 17, 6, 4, 56.00),
(46, 18, 1, 2, 20.00),
(47, 19, 4, 5, 40.00),
(48, 20, 4, 5, 40.00),
(49, 21, 1, 4, 40.00),
(50, 21, 4, 5, 40.00),
(51, 21, 5, 6, 90.00),
(52, 21, 11, 5, 70.00),
(53, 22, 1, 5, 50.00),
(54, 22, 2, 4, 48.00),
(55, 22, 3, 4, 48.00),
(56, 22, 8, 1, 14.00),
(57, 22, 9, 1, 14.00),
(58, 22, 10, 1, 14.00),
(59, 22, 11, 1, 14.00),
(60, 22, 12, 1, 6.00),
(61, 22, 13, 1, 6.00),
(62, 22, 14, 1, 4.00),
(63, 23, 15, 2, 14.00),
(64, 24, 14, 5, 20.00),
(65, 25, 1, 10, 100.00),
(66, 26, 5, 5, 75.00),
(67, 27, 1, 20, 200.00),
(68, 27, 5, 20, 300.00),
(69, 27, 9, 20, 280.00),
(70, 27, 10, 20, 280.00),
(71, 28, 1, 20, 200.00),
(72, 28, 5, 20, 300.00),
(73, 28, 9, 20, 280.00),
(74, 28, 10, 20, 280.00),
(75, 30, 1, 1, 10.00),
(76, 31, 15, 12, 84.00);

--
-- Déclencheurs `lignecommande`
--
DELIMITER $$
CREATE TRIGGER `After_ligne_update` AFTER UPDATE ON `lignecommande` FOR EACH ROW BEGIN
    DECLARE total_ht DECIMAL(10,2);
    DECLARE taux_tva DECIMAL(4,3);

    -- Calculer le total hors taxes pour toutes les lignes de la commande
    SELECT SUM(total_ligne_ht) INTO total_ht
    FROM lignecommande
    WHERE id_commande = NEW.id_commande;

    -- Vérifier si le taux réduit de 5,5% doit être appliqué
    IF (SELECT type_conso FROM commande WHERE id_commande = NEW.id_commande) = 1 THEN
        SET taux_tva = 0.055;  -- Taux réduit de 5,5%
    ELSE IF (SELECT type_conso FROM commande WHERE id_commande = NEW.id_commande) = 0 THEN
        SET taux_tva = 0.10;   -- Taux standard de 10%
    END IF;
END IF;


    -- Mettre à jour le total de la commande et appliquer la TVA
    UPDATE commande
    SET total_commande = total_ht * (1 + taux_tva)
    WHERE id_commande = NEW.id_commande;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `after_ligne_insert` AFTER INSERT ON `lignecommande` FOR EACH ROW BEGIN
    DECLARE total_ht DECIMAL(10,2);
    DECLARE taux_tva DECIMAL(4,3);  

    -- Calculer le total HT pour la commande
    SELECT SUM(total_ligne_ht) INTO total_ht
    FROM lignecommande
    WHERE id_commande = NEW.id_commande;

IF (SELECT type_conso FROM commande WHERE id_commande = NEW.id_commande) = 1 THEN
        SET taux_tva = 0.055;  -- Taux réduit de 5,5%
    ELSE
        SET taux_tva = 0.10;   -- Taux standard de 10%
    END IF;


    -- Mettre à jour le total TTC de la commande
    UPDATE commande
    SET total_commande = total_ht * (1 + taux_tva)
    WHERE id_commande = NEW.id_commande;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_ligne_insert` BEFORE INSERT ON `lignecommande` FOR EACH ROW BEGIN
    DECLARE prix_produit DECIMAL(10,2);

    -- Récupérer le prix HT du produit
    SELECT prix_ht INTO prix_produit
    FROM produit
    WHERE id_produit = NEW.id_produit;

    -- Calculer le total HT pour la ligne
    SET NEW.total_ligne_ht = NEW.qte * prix_produit;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_ligne_update` BEFORE UPDATE ON `lignecommande` FOR EACH ROW BEGIN
    DECLARE prix_produit DECIMAL(10,2);

    -- Récupérer le prix HT du produit
    SELECT prix_ht INTO prix_produit
    FROM produit
    WHERE id_produit = NEW.id_produit;

    -- Recalculer le total HT pour la ligne
    SET NEW.total_ligne_ht = NEW.qte * prix_produit;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `prix_ht` decimal(10,2) NOT NULL,
  `quantité_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `libelle`, `prix_ht`, `quantité_produit`) VALUES
(1, 'Tomate Mozzarella Basilic ', 10.00, 15),
(2, 'Carpaccio de bresaola au pesto', 12.00, 15),
(3, 'Bruschetta Tomate Jambon', 12.00, 17),
(4, 'Wrap à l\'italienne', 8.00, 18),
(5, 'Lasagnes bolognaise', 15.00, 20),
(6, 'Cannelloni fromage/bolognaise', 14.00, 25),
(7, 'Spaghetti Bolognaise/Carbonara', 14.00, 22),
(8, 'Pizza Margherita', 14.00, 21),
(9, 'Pizza Calzone', 14.00, 15),
(10, 'Pizza Truffe', 14.00, 14),
(11, 'Pizza Sicilienne', 14.00, 11),
(12, 'Tiramisu ', 6.00, 26),
(13, 'Panna Cotta', 6.00, 22),
(14, 'Café', 4.00, 50),
(15, 'Affogato', 7.00, 28);

-- --------------------------------------------------------

--
-- Structure de la table `_user`
--

CREATE TABLE `_user` (
  `id_user` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `_user`
--

INSERT INTO `_user` (`id_user`, `login`, `email`, `mot_de_passe`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin'),
(2, 'br', 'brmo@lim.com', '$2y$10$Ux5lduAOmEVr/NoVMmMnce8ie0B.4hg37Qhnj7RK08esr98SRvRye'),
(3, 'ad', 'ad@rien.fr', '$2y$10$rChJLYGO8XFOo3EwnXkpj.0vGGPVf0hUL4RuL4dAW7BGGFMihmORa'),
(4, 'ala', 'ala@il.fr', '$2y$10$3fRCyr5MB.N8/izd6BOOiOWD0EvFicVzuIRWyTaco5e2xe8I3qTs6'),
(5, 'gla', 'gla@dys.fr', '$2y$10$rI8eatmiALn3mLJOkCuc/u6sq7fGY4lhm1oZIbJSs.i.LqnBWTAa.'),
(8, 'brz', 'brz@sio.fr', '$2y$10$6wS4tRgtgj8MV1IoFL5vuuUNl2FuuSdqGhSUP9wYLXqJ9rhEnhYIu'),
(9, 'jef', 'jef@m2l.com', '$2y$10$HQCVoNglWvFkSqwMiqxBNOfuubOSAg/xs.MMUoGrN1JTFcCNs9y6.'),
(10, 'r34', 'r@gmail.com', '$2y$10$AA1SjeJ.7Jqc.Y0cr6ymt.dF3AKX4lV2pb94Ie0aaQPONOFrKhdtu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id_commande`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD PRIMARY KEY (`id_ligne_commande`),
  ADD KEY `id_commande` (`id_commande`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Index pour la table `_user`
--
ALTER TABLE `_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id_ligne_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `_user`
--
ALTER TABLE `_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `_user` (`id_user`);

--
-- Contraintes pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  ADD CONSTRAINT `lignecommande_ibfk_1` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id_commande`) ON DELETE CASCADE,
  ADD CONSTRAINT `lignecommande_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
