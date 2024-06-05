-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 31 mai 2024 à 00:35
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
-- Base de données : `platforme de gestion des dons`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `ID_Article_de_campagne` bigint(20) NOT NULL,
  `ID_campagne` bigint(20) DEFAULT NULL,
  `Nom_article` text DEFAULT NULL,
  `Description_Article_de_campagne` text DEFAULT NULL,
  `Quantite_requise_Article_de_campagne` bigint(20) DEFAULT NULL,
  `Status_article` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`ID_Article_de_campagne`, `ID_campagne`, `Nom_article`, `Description_Article_de_campagne`, `Quantite_requise_Article_de_campagne`, `Status_article`) VALUES
(1, 2, 'T-shirts', 'Des t-shirts pour les enfants orphelins', 300, 'validé'),
(4, 4, 'chaussures', 'chaussures des enfants', 400, 'validé'),
(6, 2, 'pantalon ', 'Des pantalons de taille S', 250, 'validé'),
(7, 2, 'jeux', 'Des jeux pour les petits enfants', 130, 'validé');

-- --------------------------------------------------------

--
-- Structure de la table `campagne`
--

CREATE TABLE `campagne` (
  `ID_Campagne` bigint(20) NOT NULL,
  `Titre_Campagne` text DEFAULT NULL,
  `Description_Campagne` text DEFAULT NULL,
  `Objectif_Campagne` bigint(20) DEFAULT NULL,
  `Date_de_debut_Campagne` date DEFAULT NULL,
  `Date_de_fin_Campagne` date DEFAULT NULL,
  `Statut_Campagne` text DEFAULT NULL,
  `ID_Organisation` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `campagne`
--

INSERT INTO `campagne` (`ID_Campagne`, `Titre_Campagne`, `Description_Campagne`, `Objectif_Campagne`, `Date_de_debut_Campagne`, `Date_de_fin_Campagne`, `Statut_Campagne`, `ID_Organisation`) VALUES
(1, 'AlRayane', 'une compagne a pour but d\'aider les gens en besoin de l\'argent\r\n', NULL, '2023-04-05', '2024-04-05', 'fermé', 2),
(2, 'Rayhane', 'conçu pour un future lumineux ', 0, '2017-04-05', '2024-04-16', 'en cour  de travaille', 3),
(4, 'Ferdaouss', 'une campage d\'aide des enfants orphelins', 0, '2024-05-03', '2024-05-04', 'en cours de travail', 2),
(6, 'ALamal', 'une campagne pour les gens handicapés', 0, '2024-05-01', '2025-05-01', 'en cours de travail', 2);

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `contenu_du_commentaire` text NOT NULL,
  `Heure_et_date` datetime NOT NULL,
  `ID_Donateur` bigint(10) NOT NULL,
  `ID_Campagne` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `contenu_du_commentaire`, `Heure_et_date`, `ID_Donateur`, `ID_Campagne`) VALUES
(1, 'le gestion des dons de cette application est pas mal!', '2024-05-17 00:00:00', 1, 1),
(2, 'je trouve l\'application satisfaisante ', '2024-05-03 13:50:56', 3, 2),
(3, 'vraiment super!!!', '2024-05-10 21:55:00', 2, 2),
(5, 'trés bon travail', '2024-05-10 00:30:00', 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `don`
--

CREATE TABLE `don` (
  `ID_Don` bigint(20) NOT NULL,
  `Montant_Don` decimal(10,2) DEFAULT NULL,
  `Date_du_don` date DEFAULT NULL,
  `ID_donateur` bigint(20) DEFAULT NULL,
  `ID_campagne` bigint(20) DEFAULT NULL,
  `Mode_de_paiement` varchar(100) DEFAULT NULL,
  `Statut_Don` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `don`
--

INSERT INTO `don` (`ID_Don`, `Montant_Don`, `Date_du_don`, `ID_donateur`, `ID_campagne`, `Mode_de_paiement`, `Statut_Don`) VALUES
(16, 203.00, '2024-04-29', 1, 1, 'virement bancaire', 'confirmé'),
(17, 340.00, '2024-04-08', 2, 2, 'cache', 'confirmé'),
(18, 700.00, '2024-04-26', 3, 2, 'versement bancaire', 'en cour de traitement'),
(22, 350.00, '2024-05-10', 1, 2, 'cache', 'en cour de traitement');

-- --------------------------------------------------------

--
-- Structure de la table `donateur`
--

CREATE TABLE `donateur` (
  `ID_Donateur` bigint(10) NOT NULL,
  `Nom_Donateur` text DEFAULT NULL,
  `Adresse_email_Donateur` varchar(255) DEFAULT NULL,
  `Mot_de_passe_Donateur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `donateur`
--

INSERT INTO `donateur` (`ID_Donateur`, `Nom_Donateur`, `Adresse_email_Donateur`, `Mot_de_passe_Donateur`) VALUES
(1, 'cheikhi mohamed', 'cheikhimohamed@gmail.com', 'hamadach'),
(2, 'ayoub', 'ayoube@gmail.com', 'ayough'),
(3, 'hamada', 'hamada@gmail.com', '$2y$10$nIxXjrjGCPBI3Tc6vVgtzeD19M6okPBgELoZukh27h8brMO375cY6'),
(6, 'hamada', 'hamada@gmail.com', '$2y$10$K5fYO3WwDtoHb7dgyaIw8ukAjN0WY3zfjfNvSYoTtumIRdw2z4dAG'),
(8, 'Mohammed', 'Mohammed@gmail.com', '$2y$10$KePaAFJ5WSihJi53eqziqeh8Meuo5q6cFmxhOXyQwEqCu6M5HU.0m'),
(9, 'Ayoub', 'GhouzaliAyoub@gmail.com', '$2y$10$5nqaXxohwZl.yy0/Wvei3OKvBmWOYm4ypOcYjDKo/iPK/pFgdL4LC');

-- --------------------------------------------------------

--
-- Structure de la table `organisation`
--

CREATE TABLE `organisation` (
  `ID_Organisation` bigint(20) NOT NULL,
  `Nom_Organisation` text DEFAULT NULL,
  `Adresse_Organisation` text DEFAULT NULL,
  `Numero_d_enregistrement_Organisation` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Email_Organisation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `organisation`
--

INSERT INTO `organisation` (`ID_Organisation`, `Nom_Organisation`, `Adresse_Organisation`, `Numero_d_enregistrement_Organisation`, `password`, `Email_Organisation`) VALUES
(1, 'farah organisation', 'riad salam', 342425, '$2y$10$58BJaYZD5lHN88dqdKvsxuUJ', ''),
(2, 'AL rayan', 'hey karima', 3324242, '$2y$10$lsolED2xKj.hSeWBZBoKWOprE', ''),
(3, 'rayhane', 'hey sallam meknes', 2323, '$2y$10$MJALZ4suHXDDt4wESPQfZ.gaE', ''),
(4, 'AL Amal', 'hey karima', 2312, '$2y$10$5ZXkBwKn/J3VQLm86sNtmuciH', 'Alamal@gmail.com'),
(5, 'Alfarah', 'Alwifak Rabat', 34, '$2y$10$upQfpYenTTXhOLgygCrJQ.7JENl7sUPdg08i6Nwr10Wn7JsXPFA8u', 'Alfarah@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`ID_Article_de_campagne`),
  ADD KEY `ID_campagne` (`ID_campagne`);

--
-- Index pour la table `campagne`
--
ALTER TABLE `campagne`
  ADD PRIMARY KEY (`ID_Campagne`),
  ADD KEY `ID_Organisation` (`ID_Organisation`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_Donateur` (`ID_Donateur`),
  ADD KEY `ID_Campagne` (`ID_Campagne`);

--
-- Index pour la table `don`
--
ALTER TABLE `don`
  ADD PRIMARY KEY (`ID_Don`),
  ADD KEY `ID_donateur` (`ID_donateur`),
  ADD KEY `ID_campagne` (`ID_campagne`);

--
-- Index pour la table `donateur`
--
ALTER TABLE `donateur`
  ADD PRIMARY KEY (`ID_Donateur`);

--
-- Index pour la table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`ID_Organisation`),
  ADD UNIQUE KEY `index_numero_er` (`Numero_d_enregistrement_Organisation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `ID_Article_de_campagne` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `campagne`
--
ALTER TABLE `campagne`
  MODIFY `ID_Campagne` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `don`
--
ALTER TABLE `don`
  MODIFY `ID_Don` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `donateur`
--
ALTER TABLE `donateur`
  MODIFY `ID_Donateur` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `organisation`
--
ALTER TABLE `organisation`
  MODIFY `ID_Organisation` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`ID_campagne`) REFERENCES `campagne` (`ID_Campagne`);

--
-- Contraintes pour la table `campagne`
--
ALTER TABLE `campagne`
  ADD CONSTRAINT `campagne_ibfk_1` FOREIGN KEY (`ID_Organisation`) REFERENCES `organisation` (`ID_Organisation`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`ID_Donateur`) REFERENCES `donateur` (`ID_Donateur`),
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`ID_Campagne`) REFERENCES `campagne` (`ID_Campagne`),
  ADD CONSTRAINT `commentaire_ibfk_3` FOREIGN KEY (`ID_Campagne`) REFERENCES `campagne` (`ID_Campagne`);

--
-- Contraintes pour la table `don`
--
ALTER TABLE `don`
  ADD CONSTRAINT `don_ibfk_1` FOREIGN KEY (`ID_donateur`) REFERENCES `donateur` (`ID_Donateur`),
  ADD CONSTRAINT `don_ibfk_2` FOREIGN KEY (`ID_campagne`) REFERENCES `campagne` (`ID_Campagne`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
