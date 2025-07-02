-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 23 juin 2025 à 14:13
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
-- Base de données : `gestion-de-stock`
--

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `password`, `phone`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'mehdi', 'mehdielbidaoui@example.com', '$2y$12$Nk5rk7vVPDakBwuwf9A1C.JGoXNjw6TVQXIft0mr1sxtEtcxcKQLC', '0772885570', 'casa', NULL, '2025-05-28 18:57:59', '2025-05-28 18:57:59'),
(3, 'Anwar', 'Anwar@example.com', '$2y$12$sOKxu7.VowNVS3HlsCtaY.cmjKJcoke7p3GscBDGiaNgUNR8yQJEe', '08888888', 'casa', NULL, '2025-05-28 19:10:00', '2025-05-28 19:10:00'),
(4, 'Ousama', 'Ousama@example.com', '$2y$12$L284cdACewm8T5VKDcURt.2s4KQMa0Drj/c5UoTE5Zx.WJtVk9hmy', '8094348546', 'Casa', NULL, '2025-05-28 19:10:38', '2025-05-28 19:10:38'),
(5, 'mehdi', 'mehdi2@example.com', '$2y$12$MK1p6DF73DUs7vHHHKiDH.mNT4pXO8qS4EbrN5ALxBeesuBU5sGkC', '0908080808', 'casa', NULL, '2025-05-29 06:48:55', '2025-05-29 06:48:55'),
(6, 'mehdi', 'mehdi@example.com', '$2y$12$u1bXNN/OSwjn5Ct9bPkH6Oj6tsrSnc1doBa/GnZj3UXQxYsgKODRO', '0908080808', 'casa', NULL, '2025-05-29 22:08:17', '2025-05-29 22:08:17');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `invoice_date` date NOT NULL,
  `total_amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `client_id`, `order_id`, `invoice_date`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2025-05-20', 23400.00, '2025-05-28 19:19:15', '2025-05-28 19:19:15'),
(2, 3, 2, '2025-05-19', 30580.00, '2025-05-28 19:19:37', '2025-05-28 19:19:37'),
(3, 4, 3, '2025-05-21', 26070.00, '2025-05-28 19:19:55', '2025-05-28 19:19:55'),
(4, 2, 3, '2025-05-29', 23300.00, '2025-05-29 06:47:19', '2025-05-29 06:47:19');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(31, '0001_01_01_000000_create_users_table', 1),
(32, '0001_01_01_000001_create_cache_table', 1),
(33, '0001_01_01_000002_create_jobs_table', 1),
(34, '2025_01_13_164509_create_clients_table', 1),
(35, '2025_01_13_164807_create_orders_table', 1),
(36, '2025_01_22_153557_create_produits_table', 1),
(37, '2025_01_22_164304_create_factures_table', 1),
(38, '2025_01_22_181828_add_category_to_produits_table', 1),
(39, '2025_01_23_114956_add_quantite_to_produits_table', 1),
(40, '2025_05_20_195553_add_order_date_to_orders_table', 1),
(41, '2025_05_20_200325_create_personal_access_tokens_table', 1),
(42, '2025_05_22_140059_create_order_produit_table', 1),
(43, '2025_05_22_140060_add_status_to_orders_table', 1),
(44, '2025_05_22_190241_add_image_to_produits_table', 1),
(45, '2025_05_22_191039_modify_price_column_in_produits_table', 1),
(46, '2025_05_22_200401_add_image_to_produits_table', 1),
(47, '2025_05_22_205200_create_products_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` enum('pending','completed','cancelled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `total_amount`, `created_at`, `updated_at`, `order_date`, `status`) VALUES
(1, 2, 17000.00, '2025-05-28 19:11:35', '2025-05-28 19:17:37', '2025-05-28', 'completed'),
(2, 2, 34000.00, '2025-05-28 19:11:45', '2025-05-29 06:49:51', '2025-05-28', 'completed'),
(3, 2, 16000.00, '2025-05-28 19:11:52', '2025-05-28 19:17:39', '2025-05-28', 'completed'),
(4, 2, 19000.00, '2025-05-28 19:11:59', '2025-05-28 19:17:40', '2025-05-28', 'cancelled'),
(5, 2, 16000.00, '2025-05-28 19:12:11', '2025-05-29 06:49:58', '2025-05-28', 'cancelled'),
(6, 5, 16000.00, '2025-05-29 06:49:19', '2025-05-29 06:49:56', '2025-05-29', 'completed'),
(7, 6, 16000.00, '2025-05-29 22:14:47', '2025-05-29 22:14:47', '2025-05-29', 'pending'),
(8, 6, 34000.00, '2025-05-29 22:14:59', '2025-05-29 22:14:59', '2025-05-29', 'pending'),
(9, 6, 21600.00, '2025-05-29 22:15:05', '2025-05-29 22:15:05', '2025-05-29', 'pending');

-- --------------------------------------------------------

--
-- Structure de la table `order_produit`
--

CREATE TABLE `order_produit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `produit_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `order_produit`
--

INSERT INTO `order_produit` (`id`, `order_id`, `produit_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 1, 17000.00, NULL, NULL),
(2, 2, 4, 2, 17000.00, NULL, NULL),
(3, 3, 9, 4, 4000.00, NULL, NULL),
(4, 4, 7, 1, 19000.00, NULL, NULL),
(5, 5, 8, 2, 8000.00, NULL, NULL),
(6, 6, 5, 1, 16000.00, NULL, NULL),
(7, 7, 5, 1, 16000.00, NULL, NULL),
(8, 8, 4, 2, 17000.00, NULL, NULL),
(9, 9, 10, 4, 5400.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `quantite` int(11) NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `name`, `description`, `price`, `quantity`, `created_at`, `updated_at`, `category`, `quantite`, `image`) VALUES
(4, 'iPhone 16 Pro Max', 'Sur les deux modèles\r\nDynamic Island\r\nÉcran toujours activé\r\nTechnologie ProMotion avec taux de rafraîchissement adaptatif atteignant 120 Hz\r\nÉcran HDR\r\nTrue Tone\r\nLarge gamme de couleurs (P3)', 17000.00, 0, '2025-05-28 19:00:25', '2025-05-29 22:14:59', NULL, 0, NULL),
(5, 'Galaxy S25 Ultra', '6.8-inch Dynamic AMOLED 2X display\r\n3200 x 1440 resolution with 1-120Hz LTPO adaptive refresh rate\r\nImproved brightness & color accuracy (possibly 2500+ nits peak brightness)', 16000.00, 38, '2025-05-28 19:02:05', '2025-05-29 22:14:47', NULL, 0, NULL),
(7, 'ASUS GAMER TUF A15', 'Asus Store Maroc - Setup Gamer & Composant\r\n Revendeur Officiel ASUS\r\nFiche technique, Processeur, AMD Ryzen™ 7 6800H Mobile Processor', 19000.00, 12, '2025-05-28 19:04:31', '2025-05-28 19:17:40', NULL, 0, NULL),
(8, 'apple watch series 10', 'Thinner & Lighter: Possible slimmer case design with microLED or OLED display.\r\nLarger Screen Options: Rumored 45mm/49mm sizes (up from 41mm/45mm).\r\nNew Band Mechanism: Potential magnetic attachment system (replacing the current slide-in bands).\r\nFlat Display? Some rumors suggest a flatter design like the iPhone 12-15.', 8000.00, 21, '2025-05-28 19:06:08', '2025-05-29 06:49:58', NULL, 0, NULL),
(9, 'xiaomi redmi note 10', '6.43-inch FHD+ AMOLED DotDisplay\r\nResolution: 2400 × 1080 pixels\r\nRefresh Rate: 60Hz (standard) / No high refresh rate (unlike the Pro model)\r\nBrightness: 700 nits (peak), Corning Gorilla Glass 3', 4000.00, 33, '2025-05-28 19:07:18', '2025-05-28 19:17:39', NULL, 0, NULL),
(10, 'Samsung 55-inch TV Series', 'Display: Neo QLED (Mini-LED backlight)\r\nResolution: 4K UHD (3840×2160)\r\nHDR Support: HDR10+, HLG, Dolby Vision (via update?)\r\nRefresh Rate: 120Hz (VRR, FreeSync Premium Pro, HDMI 2.1)', 5400.00, 14, '2025-05-28 19:09:15', '2025-05-29 22:15:05', NULL, 0, NULL),
(11, 'PC', 'PC', 22000.00, 3, '2025-05-29 06:46:41', '2025-05-29 06:46:41', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('H0g6rfXTp0PukJhslhQq4jf4n9grogV3t38z2zYf', 6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibHVsWGo5anEzSGZCZkVxY2cwVG8yZmVDR1FrWHJoUDU0SzdPWHdiUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jbGllbnQvZGFzaGJvYXJkIjt9czo1MzoibG9naW5fY2xpZW50XzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Njt9', 1748872219);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@example.com', NULL, '$2y$12$E6CPdGlqfHTE6ManfdJIjeby6rstWyZwbufZdAEmHfA2VB3/41QOe', 'Ni1cuP7YxywuGjXkvDeSBqxe2BHMuqoQraX8yTlBhtIZPYpLHJRsY4VN0OAF', '2025-05-28 16:59:22', '2025-05-28 16:59:22'),
(2, 'mehdi', 'admin2@example.com', NULL, '$2y$12$pFgGwp7XBsRrPEBkne.5m.UnqyXvUjlEQPYOeSKCT/UgUquXcESfC', NULL, '2025-05-29 06:43:31', '2025-05-29 06:43:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factures_client_id_foreign` (`client_id`),
  ADD KEY `factures_order_id_foreign` (`order_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_client_id_foreign` (`client_id`);

--
-- Index pour la table `order_produit`
--
ALTER TABLE `order_produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_produit_order_id_foreign` (`order_id`),
  ADD KEY `order_produit_produit_id_foreign` (`produit_id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `order_produit`
--
ALTER TABLE `order_produit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `factures`
--
ALTER TABLE `factures`
  ADD CONSTRAINT `factures_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `factures_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `order_produit`
--
ALTER TABLE `order_produit`
  ADD CONSTRAINT `order_produit_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_produit_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
