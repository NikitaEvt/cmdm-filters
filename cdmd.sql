-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2022 at 07:50 PM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdmd`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `admin_type` int(11) NOT NULL DEFAULT 2,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 - enabled; 0 - deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`, `admin_type`, `status`) VALUES
(1, 'cd', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 1),
(4, 'demo', '3d90c79ecaad25d0e4381b7ea4b5d2cc710c92658b88085dfd7dc04176d99cc3', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `uriRU` varchar(300) NOT NULL,
  `uriRO` varchar(300) NOT NULL,
  `uriEN` varchar(300) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) DEFAULT NULL,
  `titleEN` varchar(255) DEFAULT NULL,
  `descRU` text NOT NULL,
  `descRO` text NOT NULL,
  `descEN` text NOT NULL,
  `textRU` text DEFAULT NULL,
  `textRO` text DEFAULT NULL,
  `textEN` text DEFAULT NULL,
  `date` date NOT NULL,
  `seoTitleRU` varchar(255) DEFAULT NULL,
  `seoTitleRO` varchar(255) DEFAULT NULL,
  `seoTitleEN` varchar(255) DEFAULT NULL,
  `seoKeywordsRU` text DEFAULT NULL,
  `seoKeywordsRO` text DEFAULT NULL,
  `seoKeywordsEN` text DEFAULT NULL,
  `seoDescRU` text DEFAULT NULL,
  `seoDescRO` text DEFAULT NULL,
  `seoDescEN` text DEFAULT NULL,
  `system` tinyint(1) NOT NULL DEFAULT 0,
  `img` varchar(255) DEFAULT NULL,
  `sorder` int(11) NOT NULL,
  `isShown` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `uri` varchar(255) NOT NULL,
  `textRU` text NOT NULL,
  `textRO` text NOT NULL,
  `textEN` text NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `step` int(11) DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `seoTitleRU` varchar(255) NOT NULL,
  `seoTitleRO` varchar(255) NOT NULL,
  `seoTitleEN` varchar(255) NOT NULL,
  `seoDescRU` text NOT NULL,
  `seoDescRO` text NOT NULL,
  `seoDescEN` text NOT NULL,
  `seoKeywordsRU` text NOT NULL,
  `seoKeywordsRO` text NOT NULL,
  `seoKeywordsEN` text NOT NULL,
  `sorder` int(11) DEFAULT 1,
  `isShown` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `step` int(11) NOT NULL DEFAULT 0,
  `titleRU` varchar(256) DEFAULT NULL,
  `titleRO` varchar(256) DEFAULT NULL,
  `titleEN` varchar(256) DEFAULT NULL,
  `descRU` varchar(255) NOT NULL,
  `descRO` varchar(255) NOT NULL,
  `descEN` varchar(255) NOT NULL,
  `uriRU` varchar(256) DEFAULT NULL,
  `uriRO` varchar(256) DEFAULT NULL,
  `uriEN` varchar(256) DEFAULT NULL,
  `img` varchar(256) DEFAULT NULL,
  `img_icon` varchar(255) NOT NULL,
  `seoTitleRU` varchar(255) NOT NULL,
  `seoTitleRO` varchar(255) NOT NULL,
  `seoTitleEN` varchar(255) NOT NULL,
  `seoDescRU` varchar(512) NOT NULL,
  `seoDescRO` varchar(512) NOT NULL,
  `seoDescEN` varchar(512) NOT NULL,
  `seoKeywordsRU` varchar(255) NOT NULL,
  `seoKeywordsRO` varchar(255) NOT NULL,
  `seoKeywordsEN` varchar(255) NOT NULL,
  `home_views` int(11) NOT NULL,
  `sorder` int(11) DEFAULT 0,
  `isShown` tinyint(1) DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `surname` varchar(256) DEFAULT NULL,
  `phone` varchar(256) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `sorder` int(11) DEFAULT 0,
  `isShown` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `active`, `name`, `surname`, `phone`, `email`, `address`, `password`, `sorder`, `isShown`) VALUES
(1, 1, 'Igor', 'TesT', '+37369153080', 'igori-melnik@mail.ru', NULL, 'S3E2SG5XZjg4eUkzUTJ4TzBoa3BrZz09', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients_addresses`
--

CREATE TABLE `clients_addresses` (
  `id` int(11) NOT NULL,
  `city` varchar(128) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `home` varchar(50) DEFAULT NULL,
  `appart` varchar(50) DEFAULT NULL,
  `entrance` varchar(50) DEFAULT NULL,
  `floor` varchar(50) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `constants`
--

CREATE TABLE `constants` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `EN` text DEFAULT NULL,
  `RO` text NOT NULL,
  `RU` text DEFAULT NULL,
  `fieldType` tinyint(1) NOT NULL DEFAULT 0,
  `groupes` enum('errors','transliteration','contacts','form') NOT NULL,
  `sorder` int(11) NOT NULL DEFAULT 999,
  `isShown` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `constants`
--

INSERT INTO `constants` (`id`, `name`, `description`, `EN`, `RO`, `RU`, `fieldType`, `groupes`, `sorder`, `isShown`) VALUES
(1, 'HOME', 'home', 'home', 'home', 'home', 0, 'transliteration', 999, 1);

-- --------------------------------------------------------

--
-- Table structure for table `diagnostics`
--

CREATE TABLE `diagnostics` (
  `id` int(11) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) DEFAULT NULL,
  `titleEN` varchar(255) NOT NULL,
  `descRU` varchar(1024) DEFAULT NULL,
  `descRO` varchar(1024) DEFAULT NULL,
  `descEN` varchar(1024) NOT NULL,
  `img` varchar(64) DEFAULT NULL,
  `sorder` int(11) DEFAULT 1,
  `isShown` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `uriRU` varchar(255) NOT NULL,
  `uriRO` varchar(255) NOT NULL,
  `uriEN` varchar(255) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) NOT NULL,
  `titleEN` varchar(255) DEFAULT NULL,
  `sorder` int(11) NOT NULL,
  `isShown` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_img`
--

CREATE TABLE `gallery_img` (
  `id` int(11) NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `img` varchar(64) NOT NULL,
  `sorder` int(11) NOT NULL,
  `isShown` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `home_advantages`
--

CREATE TABLE `home_advantages` (
  `id` int(11) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) DEFAULT NULL,
  `titleEN` varchar(255) NOT NULL,
  `img` varchar(64) DEFAULT NULL,
  `sorder` int(11) DEFAULT 1,
  `isShown` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `id` int(11) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) DEFAULT NULL,
  `titleEN` varchar(255) NOT NULL,
  `subtitleRU` varchar(256) DEFAULT NULL,
  `subtitleRO` varchar(256) DEFAULT NULL,
  `subtitleEN` varchar(256) NOT NULL,
  `urlRU` varchar(128) DEFAULT NULL,
  `urlRO` varchar(128) DEFAULT NULL,
  `urlEN` varchar(128) NOT NULL,
  `imgRU` varchar(64) DEFAULT NULL,
  `imgRO` varchar(64) DEFAULT NULL,
  `imgEN` varchar(64) NOT NULL,
  `sorder` int(11) DEFAULT 1,
  `isShown` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `home_video`
--

CREATE TABLE `home_video` (
  `id` int(11) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) DEFAULT NULL,
  `titleEN` varchar(255) NOT NULL,
  `urlRU` varchar(128) DEFAULT NULL,
  `urlRO` varchar(128) DEFAULT NULL,
  `urlEN` varchar(128) NOT NULL,
  `img` varchar(255) NOT NULL,
  `sorder` int(11) DEFAULT 1,
  `isShown` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `uriRU` varchar(255) NOT NULL,
  `uriRO` varchar(255) NOT NULL,
  `uriEN` varchar(255) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) NOT NULL,
  `titleEN` varchar(255) DEFAULT NULL,
  `descRU` text NOT NULL,
  `descRO` text NOT NULL,
  `descEN` text NOT NULL,
  `textRU` text DEFAULT NULL,
  `textRO` text NOT NULL,
  `textEN` text DEFAULT NULL,
  `seoTitleRU` varchar(255) DEFAULT NULL,
  `seoTitleRO` varchar(255) NOT NULL,
  `seoTitleEN` varchar(255) DEFAULT NULL,
  `seoKeywordsRU` text DEFAULT NULL,
  `seoKeywordsRO` text NOT NULL,
  `seoKeywordsEN` text DEFAULT NULL,
  `seoDescRU` text DEFAULT NULL,
  `seoDescRO` text NOT NULL,
  `seoDescEN` text DEFAULT NULL,
  `onTop` int(1) NOT NULL DEFAULT 0,
  `onBottom` int(1) NOT NULL DEFAULT 0,
  `parentID` int(11) DEFAULT 0,
  `system` tinyint(1) NOT NULL DEFAULT 0,
  `img` varchar(255) DEFAULT NULL,
  `sorder` int(11) NOT NULL,
  `isShown` tinyint(1) NOT NULL DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `uriRU`, `uriRO`, `uriEN`, `titleRU`, `titleRO`, `titleEN`, `descRU`, `descRO`, `descEN`, `textRU`, `textRO`, `textEN`, `seoTitleRU`, `seoTitleRO`, `seoTitleEN`, `seoKeywordsRU`, `seoKeywordsRO`, `seoKeywordsEN`, `seoDescRU`, `seoDescRO`, `seoDescEN`, `onTop`, `onBottom`, `parentID`, `system`, `img`, `sorder`, `isShown`, `updated_at`, `created_at`) VALUES
(1, 'home', 'home', 'home', 'Главная', 'Principala', 'Home', '', '', '', '', '', '', '', '', 'Bulking-lab: Buy Online Steroids Anabolics USA, EU,Canada.Domestic shipping.', '', '', 'Buy steroids, buy roids, buy steroids online, oral steroids for sale , legal steroids for sale , buy steroids USA, buy deca, buy sustanon, anabolic, injectable, buy steroids eu.', '', '', 'Fast secure Multi Brands steroids for sale USA, EU domestic.  Buy legal steroids online with Bitcoin (BTC) . Top price for legal anabolic steroids & stacks.  ✅BUILD MUSCLE, CUT FAT 100% Worldwide Shipping .HARDCORE BODYBUILDING SUPPLEMENTS FOR BULKING, CUTTING & STRENGTH. \r\n\r\n\r\n', 1, 1, 0, 1, NULL, 1, 1, '2022-01-19 21:36:13', '2021-05-04 16:45:50'),
(2, 'katalog', 'catalog', '', 'Каталог', 'Catalog', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 2, 1, NULL, '2022-01-18 20:35:07'),
(3, 'o_nas', 'despre', '', 'О нас', 'Despre', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 3, 1, NULL, '2022-01-18 20:35:57'),
(4, 'skidki', 'promotii', '', 'Скидки', 'Promotii', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 4, 1, NULL, '2022-01-18 20:36:17'),
(5, 'dostavka_i_oplata', 'livrare_si_achitare', '', 'Доставка и оплата', 'Livrare si achitare', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 5, 1, NULL, '2022-01-18 20:36:43'),
(6, 'novosti', 'noutati', '', 'Новости', 'Noutati', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 6, 1, NULL, '2022-01-18 20:37:02'),
(7, 'kontaktyi', 'contacte', '', 'Контакты', 'Contacte', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 7, 1, NULL, '2022-01-18 20:37:17'),
(8, 'polojenie_o_konfidentsialnosti', 'declaratie_de_confidentialitate', '', 'Положение о конфиденциальности', 'Declarație de confidențialitate', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 22, 1, NULL, '2022-01-18 20:39:31'),
(9, 'pravila_i_usloviya', 'termeni_si_conditii', '', 'Правила и условия', 'Termeni și condiții', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 22, 1, NULL, '2022-01-18 20:39:51'),
(10, 'korzina', 'cos', '', 'Корзина', 'Cos', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 77, 1, NULL, '2022-01-18 20:40:30'),
(11, 'oformlenie_zakaza', 'checkout', '', 'Оформление заказа', 'Checkout', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 77, 1, NULL, '2022-01-18 20:40:56'),
(12, 'poisk', 'cautare', '', 'Поиск', 'Căutare', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 33, 1, NULL, '2022-01-18 20:41:49'),
(13, 'izbrannyie_tovaryi', 'produse_recomandate', '', 'Избранные товары', 'Produse recomandate', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 55, 1, NULL, '2022-01-18 20:43:00'),
(14, 'intrare', 'vhod', '', 'Intrare', 'Вход', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 99, 1, NULL, '2022-01-18 20:44:01'),
(15, 'registratsiya', 'inregistrare', '', 'Регистрация', 'Inregistrare', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 99, 1, NULL, '2022-01-18 20:44:17'),
(16, 'vosstanovlenie_parolya', 'recuperare_parola', '', 'Восстановление пароля', 'Recuperare parola', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 99, 1, NULL, '2022-01-18 20:44:34'),
(17, 'lichnyiy_kabinet', 'zona_personala', '', 'Личный кабинет', 'Zona personală', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 88, 1, NULL, '2022-01-18 20:44:58'),
(18, 'redaktirovanie_lichnyih_dannyih', 'editarea_datelor_personale', '', 'Редактирование личных данных', 'Editarea datelor personale', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 88, 1, NULL, '2022-01-18 20:45:33'),
(19, 'istoriya_zakazov', 'istoria_comenzilor', '', 'История заказов', 'Istoria comenzilor', NULL, '', '', '', '', '', NULL, '', '', NULL, '', '', NULL, '', '', NULL, 0, 0, 0, 1, NULL, 88, 1, NULL, '2022-01-18 20:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `title` varchar(256) DEFAULT NULL,
  `uri` varchar(256) DEFAULT NULL,
  `img` varchar(256) DEFAULT NULL,
  `seoTitleRU` varchar(255) NOT NULL,
  `seoTitleRO` varchar(255) NOT NULL,
  `seoTitleEN` varchar(255) NOT NULL,
  `seoDescRU` varchar(512) NOT NULL,
  `seoDescRO` varchar(512) NOT NULL,
  `seoDescEN` varchar(512) NOT NULL,
  `seoKeywordsRU` varchar(255) NOT NULL,
  `seoKeywordsRO` varchar(255) NOT NULL,
  `seoKeywordsEN` varchar(255) NOT NULL,
  `sorder` int(11) DEFAULT 0,
  `isShown` tinyint(1) DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `status` enum('new','progress','finished','canceled') NOT NULL DEFAULT 'new',
  `total` varchar(64) NOT NULL,
  `delivery` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(250) NOT NULL,
  `country` varchar(64) NOT NULL,
  `city` varchar(64) NOT NULL,
  `zip` varchar(64) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `house` varchar(64) NOT NULL,
  `apartment_number` varchar(64) NOT NULL,
  `cart_code` varchar(255) NOT NULL,
  `mesaj` text NOT NULL,
  `added` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `price` varchar(64) DEFAULT NULL,
  `total` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `SKU` varchar(128) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `titleRU` varchar(256) DEFAULT NULL,
  `titleRO` varchar(255) NOT NULL,
  `titleEN` varchar(255) NOT NULL,
  `descRU` varchar(255) NOT NULL,
  `descRO` varchar(255) NOT NULL,
  `descEN` varchar(255) NOT NULL,
  `textRU` text DEFAULT NULL,
  `textRO` text DEFAULT NULL,
  `textEN` text NOT NULL,
  `uriRU` varchar(256) DEFAULT NULL,
  `uriRO` varchar(256) DEFAULT NULL,
  `uriEN` varchar(255) NOT NULL,
  `price` float DEFAULT NULL,
  `discount_price` float DEFAULT NULL,
  `on_stock` int(11) DEFAULT 1,
  `model` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `is_new` tinyint(4) DEFAULT 0,
  `best` int(11) NOT NULL,
  `best_selling` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `seoTitleRU` varchar(255) NOT NULL,
  `seoTitleRO` varchar(255) NOT NULL,
  `seoTitleEN` varchar(255) NOT NULL,
  `seoKeywordsRU` text NOT NULL,
  `seoKeywordsRO` text NOT NULL,
  `seoKeywordsEN` text NOT NULL,
  `seoDescRU` text NOT NULL,
  `seoDescRO` text NOT NULL,
  `seoDescEN` text NOT NULL,
  `sorder` int(11) DEFAULT 1,
  `home_shown` int(11) NOT NULL,
  `isShown` tinyint(1) DEFAULT 1,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_alternative`
--

CREATE TABLE `products_alternative` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `products_alt` int(11) DEFAULT NULL,
  `titleRU` varchar(255) NOT NULL,
  `SKU` varchar(255) NOT NULL,
  `sorder` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_features`
--

CREATE TABLE `products_features` (
  `id` int(11) NOT NULL,
  `product_id` int(5) DEFAULT NULL,
  `feature_id` int(5) DEFAULT NULL,
  `feature_value_id` int(5) DEFAULT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products_img`
--

CREATE TABLE `products_img` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `img` varchar(64) NOT NULL,
  `sorder` int(11) NOT NULL,
  `isShown` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_cart_items`
--

CREATE TABLE `shop_cart_items` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `rowid` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `create_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `qty` int(11) NOT NULL,
  `price` decimal(15,4) DEFAULT NULL,
  `options` text CHARACTER SET utf8 COLLATE utf8_roman_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `shop_feature`
--

CREATE TABLE `shop_feature` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `name_RU` varchar(255) NOT NULL,
  `name_RO` varchar(255) NOT NULL,
  `name_EN` varchar(255) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 0,
  `sorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_feature`
--

INSERT INTO `shop_feature` (`id`, `type_id`, `name_RU`, `name_RO`, `name_EN`, `type`, `sorder`) VALUES
(1, 1, 'Цвет', 'Color', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_feature_values`
--

CREATE TABLE `shop_feature_values` (
  `id` int(11) NOT NULL,
  `feature_id` int(11) NOT NULL,
  `name_RU` varchar(255) DEFAULT NULL,
  `name_RO` varchar(255) DEFAULT NULL,
  `name_EN` varchar(255) NOT NULL,
  `color` varchar(10) NOT NULL DEFAULT '#ffffff',
  `sorder` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_feature_values`
--

INSERT INTO `shop_feature_values` (`id`, `feature_id`, `name_RU`, `name_RO`, `name_EN`, `color`, `sorder`) VALUES
(1, 1, 'Красный', 'Rosu', '', '#ffffff', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_type`
--

CREATE TABLE `shop_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sorder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_type`
--

INSERT INTO `shop_type` (`id`, `name`, `sorder`) VALUES
(1, 'Генераторы', 1);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `titleRU` varchar(255) DEFAULT NULL,
  `titleRO` varchar(255) DEFAULT NULL,
  `titleEN` varchar(255) NOT NULL,
  `subtitleRU` varchar(256) DEFAULT NULL,
  `subtitleRO` varchar(256) DEFAULT NULL,
  `subtitleEN` varchar(256) NOT NULL,
  `textRU` text DEFAULT NULL,
  `textRO` text DEFAULT NULL,
  `textEN` text NOT NULL,
  `urlRU` varchar(128) DEFAULT NULL,
  `urlRO` varchar(128) DEFAULT NULL,
  `urlEN` varchar(128) NOT NULL,
  `color` varchar(64) NOT NULL,
  `text_alight` varchar(32) NOT NULL,
  `imgRU` varchar(64) DEFAULT NULL,
  `imgRO` varchar(64) DEFAULT NULL,
  `imgEN` varchar(64) NOT NULL,
  `sorder` int(11) DEFAULT 1,
  `isShown` tinyint(4) DEFAULT 1,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID` (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_addresses`
--
ALTER TABLE `clients_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `constants`
--
ALTER TABLE `constants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ID` (`id`);

--
-- Indexes for table `diagnostics`
--
ALTER TABLE `diagnostics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID` (`id`);

--
-- Indexes for table `gallery_img`
--
ALTER TABLE `gallery_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID` (`id`);

--
-- Indexes for table `home_advantages`
--
ALTER TABLE `home_advantages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_video`
--
ALTER TABLE `home_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID` (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_alternative`
--
ALTER TABLE `products_alternative`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_features`
--
ALTER TABLE `products_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_img`
--
ALTER TABLE `products_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID` (`id`);

--
-- Indexes for table `shop_cart_items`
--
ALTER TABLE `shop_cart_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_feature`
--
ALTER TABLE `shop_feature`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_feature_values`
--
ALTER TABLE `shop_feature_values`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_type`
--
ALTER TABLE `shop_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clients_addresses`
--
ALTER TABLE `clients_addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `constants`
--
ALTER TABLE `constants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `diagnostics`
--
ALTER TABLE `diagnostics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_img`
--
ALTER TABLE `gallery_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_advantages`
--
ALTER TABLE `home_advantages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_video`
--
ALTER TABLE `home_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_alternative`
--
ALTER TABLE `products_alternative`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_features`
--
ALTER TABLE `products_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_img`
--
ALTER TABLE `products_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_cart_items`
--
ALTER TABLE `shop_cart_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop_feature`
--
ALTER TABLE `shop_feature`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop_feature_values`
--
ALTER TABLE `shop_feature_values`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shop_type`
--
ALTER TABLE `shop_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
