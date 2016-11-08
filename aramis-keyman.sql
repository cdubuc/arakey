-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 08 Novembre 2016 à 01:44
-- Version du serveur :  5.7.16-0ubuntu0.16.04.1
-- Version de PHP :  7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `aramis-keyman`
--

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--

CREATE TABLE `cars` (
  `id` int(10) UNSIGNED NOT NULL,
  `maker` varchar(30) CHARACTER SET latin1 NOT NULL,
  `model` varchar(30) CHARACTER SET latin1 NOT NULL,
  `price` decimal(12,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `cars`
--

INSERT INTO `cars` (`id`, `maker`, `model`, `price`) VALUES
(1, 'Renault Sport', 'Megane 2 RS', '35000.00'),
(2, 'Peugeot', '208 RS', '38000.00'),
(4, 'Pigeot', '12011', '42.00');

-- --------------------------------------------------------

--
-- Structure de la table `car_equipments`
--

CREATE TABLE `car_equipments` (
  `car_e_id` int(10) UNSIGNED NOT NULL,
  `equip_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `car_equipments`
--

INSERT INTO `car_equipments` (`car_e_id`, `equip_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `car_options`
--

CREATE TABLE `car_options` (
  `car_o_id` int(10) UNSIGNED NOT NULL,
  `option_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `car_options`
--

INSERT INTO `car_options` (`car_o_id`, `option_id`) VALUES
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Contenu de la table `equipments`
--

INSERT INTO `equipments` (`id`, `label`) VALUES
(1, 'Jantes Alu'),
(2, 'Jantes Alu 19"');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `car_equipments`
--
ALTER TABLE `car_equipments`
  ADD PRIMARY KEY (`car_e_id`,`equip_id`),
  ADD KEY `idx_car_id` (`car_e_id`),
  ADD KEY `idx_equip_id` (`equip_id`) USING BTREE;

--
-- Index pour la table `car_options`
--
ALTER TABLE `car_options`
  ADD PRIMARY KEY (`car_o_id`,`option_id`),
  ADD KEY `car_id` (`car_o_id`),
  ADD KEY `equipment_id` (`option_id`);

--
-- Index pour la table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `car_equipments`
--
ALTER TABLE `car_equipments`
  ADD CONSTRAINT `fk_car_id` FOREIGN KEY (`car_e_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `fk_equip_id` FOREIGN KEY (`equip_id`) REFERENCES `equipments` (`id`);

--
-- Contraintes pour la table `car_options`
--
ALTER TABLE `car_options`
  ADD CONSTRAINT `fk_options_car_id` FOREIGN KEY (`car_o_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `fk_options_equip_id` FOREIGN KEY (`option_id`) REFERENCES `equipments` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
