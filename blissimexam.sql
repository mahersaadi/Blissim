-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 15 juin 2023 à 15:41
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blissimexam`
--

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`, `slug`) VALUES
(19, 'Electronics, Industrial & Beauty', 'quia-provident-architecto-amet-aut-dolorem-quia-cum'),
(20, 'Kids & Sports', 'officia-possimus-magni-maiores-est-aliquam-rem-beatae-ut'),
(21, 'Books, Games & Automotive', 'facilis-consectetur-ut-et-animi');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int DEFAULT NULL,
  `comment` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5F9E962A4584665A` (`product_id`),
  KEY `IDX_5F9E962AA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `product_id`, `comment`, `created_at`, `user_id`) VALUES
(5, 133, 'In provident nihil est autem iusto quod. Voluptas similique dignissimos quos consequuntur et magnam officiis sed. Nulla quos voluptatem quibusdam quasi temporibus aut enim.', '2022-07-08 13:31:26', 34),
(6, 133, 'Vel quo sunt esse tenetur sed. Ullam magni similique vero eos repudiandae. Aut quis unde non fuga aut itaque quo.', '2023-06-09 22:55:04', 34),
(7, 133, 'In aut voluptas distinctio eum sed sint dolor. Aut cupiditate accusamus deleniti illum. Ducimus ut aut aut est quia.', '2022-05-12 10:26:30', 34),
(8, 133, 'Vero dignissimos hic similique. Quae doloribus expedita reiciendis et vel dignissimos totam. Iure nisi numquam consequuntur dolore ullam. Magnam totam non consequatur officiis.', '2022-11-21 15:38:33', 34),
(9, 124, 'uuuuuuuuuuuuuuuu', '2023-06-14 14:31:45', 30),
(10, 124, 'hhhhhhhhhhhhhhhhh', '2023-06-14 14:35:19', 30),
(11, 124, 'maher1 comment', '2023-06-15 08:51:55', 31),
(12, 124, 'maher comment 3', '2023-06-15 09:10:00', 31),
(13, 124, NULL, '2023-06-15 11:48:27', 30),
(14, 124, NULL, '2023-06-15 11:48:45', 30),
(15, 124, 'ccccccccccccccc', '2023-06-15 11:57:27', 30);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230611121516', '2023-06-11 12:16:02', 187),
('DoctrineMigrations\\Version20230611121740', '2023-06-11 12:17:46', 87),
('DoctrineMigrations\\Version20230611151646', '2023-06-11 15:16:53', 107),
('DoctrineMigrations\\Version20230611182042', '2023-06-11 18:20:54', 268),
('DoctrineMigrations\\Version20230611214953', '2023-06-11 21:50:03', 83),
('DoctrineMigrations\\Version20230613133323', '2023-06-13 13:33:33', 94),
('DoctrineMigrations\\Version20230614094638', '2023-06-14 09:47:00', 1009),
('DoctrineMigrations\\Version20230614095736', '2023-06-14 09:57:46', 228);

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `slug`, `category_id`, `picture`, `short_desc`) VALUES
(124, 'Awesome Marble Lamp', 6879, 'sunt-ut-quam-rem-quo', 21, 'https://picsum.photos/id/108/400/400', 'Quaerat molestiae nemo earum quia. Perferendis neque tenetur odit.'),
(125, 'Incredible Plastic Plate', 4609, 'fugiat-sunt-enim-eligendi-quibusdam-ut-dolorem-aut', 21, 'https://picsum.photos/id/304/400/400', 'Dolor quisquam accusantium atque quia voluptas consequatur accusamus. Numquam et blanditiis sunt consectetur fugit enim tempora. Sunt in magni nisi laudantium rem.'),
(126, 'Ergonomic Bronze Car', 5309, 'est-similique-occaecati-sed-consequatur-reprehenderit-maiores', 21, 'https://picsum.photos/id/783/400/400', 'Cum esse suscipit nostrum esse delectus eius. Et vel laudantium et dolor repellendus.'),
(127, 'Awesome Linen Shoes', 7839, 'in-et-tenetur-molestiae-eligendi', 21, 'https://picsum.photos/id/449/400/400', 'Deleniti et vero aperiam laboriosam repudiandae. Quisquam modi excepturi ut et libero consequatur. Velit sed at qui neque deserunt. Cumque cum esse ut voluptas libero.'),
(128, 'Fantastic Linen Shirt', 7639, 'excepturi-aut-et-et-iure', 21, 'https://picsum.photos/id/72/400/400', 'Et delectus autem officia quis. Impedit enim voluptatibus incidunt sit sint. Nihil incidunt officiis rerum et possimus deserunt sunt vel.'),
(129, 'Aerodynamic Iron Watch', 7659, 'vel-cupiditate-et-magni-quia-nostrum-similique-aut', 21, 'https://picsum.photos/id/234/400/400', 'Voluptas autem quasi quae veritatis. Et unde quam vel eum nisi vel. Magnam fugit consectetur atque explicabo. Quo necessitatibus ut distinctio dolores sed repudiandae.'),
(130, 'Durable Wooden Wallet', 7959, 'debitis-vitae-temporibus-maxime-et-magni-ad', 21, 'https://picsum.photos/id/789/400/400', 'Omnis natus asperiores voluptas aperiam ipsum maiores. Porro dolorem enim temporibus veritatis vero voluptatibus ad. Rerum esse voluptas vero ab. Quis beatae tenetur et fugit enim fuga.'),
(131, 'Aerodynamic Rubber Watch', 4209, 'nulla-provident-sint-molestiae', 21, 'https://picsum.photos/id/130/400/400', 'Velit adipisci necessitatibus optio et omnis. Dolores sunt et doloribus autem voluptatem. Omnis quia ipsam totam ut doloremque sequi. Ea voluptate veritatis velit fugit ipsa sunt.'),
(132, 'Practical Iron Keyboard', 7039, 'porro-velit-magni-velit-qui-modi-necessitatibus-laudantium', 21, 'https://picsum.photos/id/1084/400/400', 'Similique eum ut eius hic vel voluptatem blanditiis est. Sapiente magnam est nulla odit iusto nulla id. Quis sint quas quia et. Et id reprehenderit perspiciatis culpa impedit delectus ullam.'),
(133, 'Practical Wooden Chair', 4029, 'eligendi-eos-sunt-id-tempore-excepturi', 21, 'https://picsum.photos/id/238/400/400', 'Dolores architecto velit voluptas quam dolores. Quia minus earum sed dolores excepturi aut qui. Eligendi rerum enim sunt et quo quia labore eius.');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `full_name`) VALUES
(29, 'admin@gmail.com', '[\"ROLE_ADMIN\"]', '$2y$13$DI060bp2jMZDCMa0hH5EyuAWT20GR2E.8e879QRvoHYnKI0SWE/yu', 'Bertrand Coste'),
(30, 'maher0@gmail.com', '[]', '$2y$13$VP4j7bLBjevPvyHL2bTZZ.iubpVNTG.SlHXAqnld6NdXszXlWMPDa', 'Maher Saadi0'),
(31, 'maher1@gmail.com', '[]', '$2y$13$I8ZaMw1C2cdXRySQ6NzvRec6yCdURe4Iapg4vm3AtfUB7/IXaFr0u', 'Maher Saadi1'),
(32, 'maher2@gmail.com', '[]', '$2y$13$ClcmZNeznjmQl1PyYnaMpuA2YbzsbrnRbzCzCIqsnBWedw47GD6sa', 'Maher Saadi2'),
(33, 'maher3@gmail.com', '[]', '$2y$13$HVjKl1fZwwG7l/fGf051oOtoQVx1dsuRjYXs66bLqStjB5gNRvf7S', 'Maher Saadi3'),
(34, 'maher4@gmail.com', '[]', '$2y$13$vRRkj2XJpCLhTh/3TvcDB.eAg0QegwIUnSBV2Ub4YcoHKs50GlOG6', 'Maher Saadi4'),
(35, 'test@gmail.com', '[]', '$2y$13$FoDhIkpzu0i1m5Ydt0UyNuSpcLQSQ5aOQibeAab3VNNK2D1YOn916', 'test 3');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FK_5F9E962A4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_5F9E962AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
