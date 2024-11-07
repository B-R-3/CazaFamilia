-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 07 nov. 2024 à 11:31
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

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
CREATE DEFINER=`root`@`localhost` FUNCTION `renvoie_somme_produit` (`idcom` INT) RETURNS INT(11)  BEGIN
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
(1, 1, 1, '2024-10-03 11:36:27', 14.00, 1);

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
(4, "Wrap à l'italienne", 8.00, 18),
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
(1, 'admin', 'admin@gmail.com', 'admin');

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
  MODIFY `id_commande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `lignecommande`
--
ALTER TABLE `lignecommande`
  MODIFY `id_ligne_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `_user`
--
ALTER TABLE `_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
