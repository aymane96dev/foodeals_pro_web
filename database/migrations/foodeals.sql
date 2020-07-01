-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 16 avr. 2019 à 14:02
-- Version du serveur :  10.1.36-MariaDB
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `foodeals`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `name`, `tel`, `email`, `email_verified_at`, `password`, `sexe`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'adam', '063698963', 'adam@adam.ma', '0000-00-00 00:00:00', '12345678', 'm', NULL, NULL, NULL),
(2, 'yassine', '063698963', 'yassine@adam.ma', '0000-00-00 00:00:00', '12345678', 'm', NULL, NULL, NULL),
(3, 'kamal', '06569836', 'kamal@gmail.com', '0000-00-00 00:00:00', '12345678', 'm', NULL, NULL, NULL),
(4, 'maryem', '06896523', 'maryem@gmail.com', '0000-00-00 00:00:00', '12345678', 'f', NULL, NULL, NULL),
(5, 'kamal', '06569836', 'kamal@gmail.com', '0000-00-00 00:00:00', '12345678', 'm', NULL, NULL, NULL),
(6, 'maryem', '06896523', 'maryem@gmail.com', '0000-00-00 00:00:00', '12345678', 'f', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `heure_collecte` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `signatures_id` int(10) UNSIGNED DEFAULT NULL,
  `clients_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id`, `heure_collecte`, `signatures_id`, `clients_id`, `created_at`, `updated_at`) VALUES
(2, '12:12:12', 1, 1, NULL, NULL),
(3, '00:12:12', 2, 1, NULL, NULL),
(4, '02:12:12', 1, 1, NULL, NULL),
(5, '12:12:12', 1, 3, NULL, NULL),
(6, '12:12:12', 1, 2, NULL, NULL),
(7, '13:13:13', 1, 3, NULL, NULL),
(8, '5', NULL, 1, NULL, NULL),
(12, '12', 8, 4, NULL, NULL),
(13, '11', 9, 4, '2019-04-13 23:08:43', '2019-04-13 23:08:43'),
(14, '11', 10, 4, '2019-04-13 23:13:25', '2019-04-13 23:13:25'),
(15, '11', 11, 4, '2019-04-13 23:16:32', '2019-04-13 23:16:32'),
(16, '11', 12, 4, '2019-04-13 23:17:05', '2019-04-13 23:17:05'),
(17, '11', 13, 4, '2019-04-13 23:17:16', '2019-04-13 23:17:16'),
(18, '11', 14, 4, '2019-04-13 23:18:01', '2019-04-13 23:18:01'),
(19, '11', 15, 4, '2019-04-13 23:18:02', '2019-04-13 23:18:02'),
(20, '11', 16, 4, '2019-04-14 02:40:30', '2019-04-14 02:40:30'),
(21, '11', 17, 4, '2019-04-14 02:40:33', '2019-04-14 02:40:33'),
(22, '11', 18, 4, '2019-04-14 02:40:33', '2019-04-14 02:40:33'),
(23, '11', 19, 4, '2019-04-14 02:40:34', '2019-04-14 02:40:34'),
(24, '11', 20, 4, '2019-04-14 02:40:34', '2019-04-14 02:40:34'),
(25, '11', 21, 4, '2019-04-14 02:40:34', '2019-04-14 02:40:34'),
(26, '11', 22, 4, '2019-04-14 02:40:35', '2019-04-14 02:40:35'),
(27, '11', 23, 4, '2019-04-14 02:40:38', '2019-04-14 02:40:38'),
(28, '11', 24, 4, '2019-04-14 02:40:41', '2019-04-14 02:40:41');

--
-- Déclencheurs `commandes`
--
DELIMITER $$
CREATE TRIGGER `AjouterSignature` BEFORE INSERT ON `commandes` FOR EACH ROW BEGIN
 
 DECLARE id_sg integer;
 INSERT INTO signatures
    SET 
     etat = 0,
        code = conv(floor(rand() * 99999999999999), 20, 36),
        created_at = NOW(); 
  

 set id_sg = (select max(id) from signatures);
 
 set NEW.signatures_id=id_sg;

End
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `detailcommandes`
--

CREATE TABLE `detailcommandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `commandes_id` int(10) UNSIGNED NOT NULL,
  `produits_id` int(10) UNSIGNED NOT NULL,
  `Qte` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detailcommandes`
--

INSERT INTO `detailcommandes` (`id`, `commandes_id`, `produits_id`, `Qte`, `created_at`, `updated_at`) VALUES
(3, 3, 1, 54, NULL, NULL),
(4, 4, 3, 0, NULL, NULL),
(5, 3, 1, 0, NULL, NULL),
(6, 4, 3, 0, NULL, NULL),
(7, 3, 1, 0, NULL, NULL),
(8, 4, 3, 0, NULL, NULL),
(9, 3, 1, 0, NULL, NULL),
(10, 4, 3, 0, NULL, NULL),
(11, 3, 1, 0, NULL, NULL),
(12, 4, 3, 0, NULL, NULL),
(13, 3, 1, 88, NULL, NULL),
(14, 4, 3, 0, NULL, NULL),
(15, 3, 1, 0, NULL, NULL),
(16, 4, 3, 0, NULL, NULL),
(17, 7, 5, 12, NULL, NULL),
(18, 7, 4, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `id` int(10) UNSIGNED NOT NULL,
  `clients_id` int(10) UNSIGNED NOT NULL,
  `restaurants_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `localisations`
--

CREATE TABLE `localisations` (
  `id` int(10) UNSIGNED NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `localisations`
--

INSERT INTO `localisations` (`id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 12, 19, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(12, '2019_04_08_145353_create_admins', 1),
(13, '2019_04_08_145403_create_payements', 1),
(14, '2019_04_08_145505_create_typerestaurants', 1),
(15, '2019_04_08_145511_create_localisations', 1),
(16, '2019_04_08_1455_create_users_table', 1),
(17, '2019_04_08_145702_create_signatures', 1),
(18, '2019_04_08_145712_create_restaurants', 1),
(19, '2019_04_08_150106_create_favoris', 1),
(20, '2019_04_08_150401_create_commandes', 1),
(21, '2019_04_08_150515_create_produits', 1),
(22, '2019_04_08_160348_create_detailcommandes', 1);

-- --------------------------------------------------------

--
-- Structure de la table `payements`
--

CREATE TABLE `payements` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int(10) UNSIGNED NOT NULL,
  `HD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HF` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Qte` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Prix` double(8,2) NOT NULL,
  `restaurants_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `HD`, `HF`, `Qte`, `Description`, `Photo`, `Prix`, `restaurants_id`, `created_at`, `updated_at`) VALUES
(1, '12:12:12', '13:13:13', 3, 'tacos', '', 15.00, 2, NULL, NULL),
(2, '12:12:12', '13:13:13', 3, 'tacos', '', 15.00, 2, NULL, NULL),
(3, '12:12:12', '13:13:13', 3, 'mixte', '', 15.00, 2, NULL, NULL),
(4, '12:12:12', '13:13:13', 3, 'viande h', '', 15.00, 2, NULL, NULL),
(5, '12:12:12', '13:13:13', 3, 'tagine', '', 15.00, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `restaurants`
--

CREATE TABLE `restaurants` (
  `id` int(10) UNSIGNED NOT NULL,
  `types_id` int(10) UNSIGNED NOT NULL,
  `Logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `localisations_id` int(10) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `restaurants`
--

INSERT INTO `restaurants` (`id`, `types_id`, `Logo`, `localisations_id`, `description`, `name`, `email`, `adresse`, `password`, `etat`, `created_at`, `updated_at`) VALUES
(2, 1, 'images/3QBMFtpW9x52n0OJLnyHNtA0zycodCrhx6MQRvmo.jpeg', 1, 'kolchi mzian 3ndna', 'inssaf', 'ismail@gmail.com', 'italia', '$2y$10$6NXBQg7me4RJCCPvljgvvOjYz/hQQY0loNZp3uSTbLyMKygkaWB42', '2019-04-13 00:06:51', '2019-04-13 00:05:24', '2019-04-13 00:06:51'),
(3, 2, 'images/jvGHPxLbCD2uEtza1oG38NeC1g5rcTS14PzJqKaT.png', 1, 'kolchi top', 'localike', 'snackAmo@gmail.com', 'im here', '$2y$10$xpxukU/IK1E2WPKITUTzDuvepVRPlzcpKjJZ5ZI4NEG1RLKBUAsdq', '2019-04-13 00:32:36', '2019-04-13 00:32:28', '2019-04-13 00:32:43'),
(4, 2, 'images/ZZNUiRO5cNnh8KJJy8gf9Ay5coA17WpwlvgGITjT.jpeg', 1, 'gsjfhvusj', 'lomber', 'youssef@gmail.com', 'uhfiqsdjfi', '$2y$10$51JLwnbNNT0B7AWH8fO27Om/.U2SrqOMvmNouhuoQauNoCbXbHQgS', NULL, '2019-04-13 01:00:39', '2019-04-13 01:04:13');

-- --------------------------------------------------------

--
-- Structure de la table `signatures`
--

CREATE TABLE `signatures` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `signatures`
--

INSERT INTO `signatures` (`id`, `code`, `etat`, `created_at`, `updated_at`) VALUES
(1, '1233moihk ', 1, NULL, NULL),
(2, '12mlo', 0, NULL, NULL),
(3, '4E8QG6SDUHVE', 0, '2019-04-13 13:40:18', NULL),
(8, '3DFVXV0WUWSI', 0, '2019-04-13 13:57:10', '2019-04-13 17:40:41'),
(9, '4TNG6DM3BFS', 0, '2019-04-13 14:08:43', '2019-04-13 17:40:41'),
(10, '3E8MPXVAO6QS', 0, '2019-04-13 14:13:25', '2019-04-13 17:40:41'),
(11, '50U8KY39UMON', 0, '2019-04-13 14:16:32', '2019-04-13 17:40:41'),
(12, '554OI413HT18', 0, '2019-04-13 14:17:05', '2019-04-13 17:40:41'),
(13, '4GFHTBSO92V7', 0, '2019-04-13 14:17:16', '2019-04-13 17:40:41'),
(14, '22E7A8XSTY39', 0, '2019-04-13 14:18:01', '2019-04-13 17:40:41'),
(15, '2K3WXBCYG0ZE', 0, '2019-04-13 14:18:02', '2019-04-13 17:40:41'),
(16, '4ZBE4YJUEAUP', 0, '2019-04-13 17:40:30', '2019-04-13 17:40:41'),
(17, '2NM9I8I176MT', 0, '2019-04-13 17:40:33', '2019-04-13 17:40:41'),
(18, '4HBRBYSCGCUS', 0, '2019-04-13 17:40:33', '2019-04-13 17:40:41'),
(19, 'T51W2FAIVEE', 0, '2019-04-13 17:40:34', '2019-04-13 17:40:41'),
(20, '391AS5SGSIR1', 0, '2019-04-13 17:40:34', '2019-04-13 17:40:41'),
(21, '51Y1LAYOIDSJ', 0, '2019-04-13 17:40:34', '2019-04-13 17:40:41'),
(22, '1JD20H4WXACZ', 0, '2019-04-13 17:40:35', '2019-04-13 17:40:41'),
(23, '3V3BN3Q9AZF0', 0, '2019-04-13 17:40:38', '2019-04-13 17:40:41'),
(24, '19XSJEGB2Y81', 0, '2019-04-13 17:40:41', '2019-04-13 17:40:41');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `obs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`, `obs`, `created_at`, `updated_at`) VALUES
(1, 'restaurant', NULL, NULL, NULL),
(2, 'hotel', NULL, NULL, NULL),
(3, 'boulangerie', NULL, NULL, NULL),
(4, 'snack', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tele` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `tele`, `email_verified_at`, `password`, `etat`, `created_at`, `updated_at`, `remember_token`) VALUES
(9, 'youssef', 'youssef@gmail.com', '0654789654', NULL, '$2y$10$4UAGXW0Gt7IxKT7j80WI6u/CD9MRwK4KF2tSoMRY.In8lg5krDequ', NULL, '2019-04-13 00:16:30', '2019-04-16 20:34:26', NULL),
(10, 'ismail', 'ismail@gmail.com', '063698569', NULL, '$2y$10$Roa0EpBgEumGMU9xFR4kJObe4GIowMWUOlCSlJ6S1vW81vub7lqWe', NULL, '2019-04-13 00:58:49', '2019-04-13 23:32:16', NULL),
(11, 'dsgdch', 'xwjsdc@chsyc.ma', 'kqndcjqhdxc', NULL, '$2y$10$EbILqkbQIrlJJRPg.auBj.4F3oLJ1S7BQPVf1c0HFVVjfxAuAznw2', NULL, '2019-04-14 04:22:32', '2019-04-14 04:22:32', NULL),
(13, 'issam', 'issam@gmail.com', '063698569', NULL, '$2y$10$5gdzEOE37Ws1jpaW.0SureC65voGJPkdk7kIk9zbeIMMrFYguuMGC', '2019-04-16 20:34:27', '2019-04-16 18:26:59', '2019-04-16 20:34:27', NULL),
(14, 'test1', 'test@gmail.com', '061485683', NULL, '$2y$10$rN5yD9gB8PBNCBz.lKUKVukeMKhKVJgqhEy4FZBGYJwvlf5d1S6QW', NULL, '2019-04-16 18:31:14', '2019-04-16 20:34:42', NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commandes_signatures_id_foreign` (`signatures_id`),
  ADD KEY `commandes_clients_id_foreign` (`clients_id`);

--
-- Index pour la table `detailcommandes`
--
ALTER TABLE `detailcommandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detailcommandes_commandes_id_foreign` (`commandes_id`),
  ADD KEY `detailcommandes_produits_id_foreign` (`produits_id`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favoris_clients_id_foreign` (`clients_id`),
  ADD KEY `favoris_restaurants_id_foreign` (`restaurants_id`);

--
-- Index pour la table `localisations`
--
ALTER TABLE `localisations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payements`
--
ALTER TABLE `payements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_restaurants_id_foreign` (`restaurants_id`);

--
-- Index pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurants_types_id_foreign` (`types_id`),
  ADD KEY `restaurants_localisations_id_foreign` (`localisations_id`);

--
-- Index pour la table `signatures`
--
ALTER TABLE `signatures`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `detailcommandes`
--
ALTER TABLE `detailcommandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `favoris`
--
ALTER TABLE `favoris`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `localisations`
--
ALTER TABLE `localisations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `payements`
--
ALTER TABLE `payements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `signatures`
--
ALTER TABLE `signatures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_clients_id_foreign` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `commandes_signatures_id_foreign` FOREIGN KEY (`signatures_id`) REFERENCES `signatures` (`id`);

--
-- Contraintes pour la table `detailcommandes`
--
ALTER TABLE `detailcommandes`
  ADD CONSTRAINT `detailcommandes_commandes_id_foreign` FOREIGN KEY (`commandes_id`) REFERENCES `commandes` (`id`),
  ADD CONSTRAINT `detailcommandes_produits_id_foreign` FOREIGN KEY (`produits_id`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `favoris_clients_id_foreign` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `favoris_restaurants_id_foreign` FOREIGN KEY (`restaurants_id`) REFERENCES `restaurants` (`id`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `produits_restaurants_id_foreign` FOREIGN KEY (`restaurants_id`) REFERENCES `restaurants` (`id`);

--
-- Contraintes pour la table `restaurants`
--
ALTER TABLE `restaurants`
  ADD CONSTRAINT `restaurants_localisations_id_foreign` FOREIGN KEY (`localisations_id`) REFERENCES `localisations` (`id`),
  ADD CONSTRAINT `restaurants_types_id_foreign` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
