-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2021 at 07:52 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `twice_but_nice`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(2, 'Topi', '2021-05-18 03:12:08', '2021-05-18 03:12:08'),
(3, 'Tas', '2021-05-18 03:12:15', '2021-05-18 03:12:15'),
(4, 'Sepatu', '2021-05-18 03:12:19', '2021-05-18 03:12:19'),
(5, 'Sendal', '2021-05-18 03:12:23', '2021-05-18 03:12:23'),
(6, 'Bomber Jaket', '2021-05-18 03:12:33', '2021-05-18 03:12:33'),
(7, 'Cardigan', '2021-05-18 03:12:37', '2021-05-18 03:12:37'),
(8, 'Dress', '2021-05-18 03:12:41', '2021-05-18 03:12:41'),
(9, 'Hoodie', '2021-05-18 03:12:45', '2021-05-18 03:12:45'),
(12, 'Sweater', '2021-05-18 03:13:06', '2021-05-18 03:13:06'),
(14, 'Rompi', '2021-05-18 03:13:30', '2021-05-18 03:13:30'),
(15, 'Kemeja', '2021-05-18 03:15:59', '2021-05-18 03:15:59'),
(16, 'Kaos', '2021-05-18 03:16:02', '2021-05-18 03:16:02'),
(17, 'Kaos Lengan Panjang', '2021-05-18 03:16:08', '2021-05-18 03:16:08'),
(18, 'Jeans', '2021-05-18 03:16:27', '2021-05-18 03:16:27'),
(19, 'Legging', '2021-05-18 03:16:31', '2021-05-18 03:16:31'),
(20, 'Celana', '2021-05-18 03:16:44', '2021-05-18 03:16:44'),
(21, 'Celana Pendek', '2021-05-18 03:16:54', '2021-05-18 03:16:54'),
(22, 'Rok', '2021-05-18 03:16:56', '2021-05-18 03:16:56');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_04_27_154234_create_colors_table', 1),
(5, '2021_04_27_154305_create_sizes_table', 1),
(6, '2021_04_27_154413_create_categories_table', 1),
(7, '2021_04_27_155132_create_table_products', 1),
(8, '2021_04_27_156200_create_stocks_table', 1),
(9, '2021_05_01_171511_drop_product_stock_table', 2),
(10, '2021_05_01_172218_add_column_product_table', 2),
(11, '2021_05_02_073544_create_permission_tables', 2),
(12, '2021_05_02_092737_add_telephone_column_to_users_table', 2),
(13, '2021_05_02_152241_add_available_column_to_products_table', 2),
(14, '2021_05_04_075749_add_column_brand_to_products_table', 2),
(15, '2021_05_04_080241_create_products_images_table', 2),
(16, '2021_05_04_161939_add_sex_and_quality_to_products_table', 2),
(17, '2021_05_06_150435_create_wishlists_table', 2),
(18, '2021_05_07_050834_drop_color_column_in_products_table', 2),
(19, '2021_05_07_051817_drop_colors_table', 2),
(20, '2021_05_07_063117_create_cart_table', 2),
(21, '2021_05_07_074304_create_orders_table', 2),
(22, '2021_05_07_075702_create_order_items_table', 2),
(23, '2021_05_07_083042_add_province_and_city_to_users', 2),
(24, '2021_05_07_163426_add_postal_code_to_users', 2),
(25, '2021_05_07_170923_add_weight_to_products', 2),
(26, '2021_05_07_175230_create_shipping_table', 2),
(27, '2021_05_07_180041_change_price_to_cost_on_shippings_table', 2),
(28, '2021_05_07_180424_add_courier_and_service_to_shipping', 2),
(29, '2021_05_07_184352_add_timestamps_to_order_items', 2),
(30, '2021_05_11_051322_add_paid_and_total_to_orders', 3),
(31, '2021_05_11_081154_add_condition_to_products', 3),
(32, '2021_05_11_153421_create_payment_table', 3),
(33, '2021_05_11_153929_rename_payment_type_on_payments', 3),
(34, '2021_05_16_185202_add_profile_image_to_users', 3),
(35, '2021_05_16_195930_create_table_reviews', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(1, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` int(11) NOT NULL,
  `paid` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `quality` int(11) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `weight` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `condition`, `brand`, `sex`, `quality`, `category_id`, `size_id`, `weight`, `price`, `available`, `created_at`, `updated_at`) VALUES
(1, 'Nike', 'Jenis snapback berwarna hitam dengan logo jordan dibagian depan kombinasi topi hitam dan merah', 'Minus bagian dalam topi banyak jahitan terkelupas', 'Nike Jordan bred Hat', 1, 7, 2, 2, 200, 130000, 1, '2021-05-18 03:19:49', '2021-05-18 03:19:49'),
(2, 'Brown bag Cloud kors', 'Tas dengan bahan leather dilapisi dengan alumunium pada pengikat sehingga tampil tangguh dan mudah disimpan karena ukuran kecil', 'Minus kulit dalam tas sudah terkelupas', 'Cloubudy', 0, 5, 3, 2, 600, 270000, 1, '2021-05-18 03:22:33', '2021-05-18 03:22:33'),
(3, 'Black mertiar bag', 'Bahan kulit sintetis pattern garis bambu dan warna mengkilat didalamnya terdapat storage yang besar', 'minus warna emas alumunium pudar', 'Snake Courtery', 0, 7, 3, 2, 400, 300000, 1, '2021-05-18 04:19:37', '2021-05-18 04:21:03'),
(4, 'Waistbag ss18 - blue', 'Supreme sling bag tas dengan storage compact berwarna biru bahan kain', 'minus klip selendang longgar', 'Supreme', 1, 8, 3, 1, 300, 100000, 1, '2021-05-18 04:20:39', '2021-05-18 04:20:39'),
(5, 'Waistbag ss18 - red', 'Supreme sling bag tas dengan storage compact berwarna merah bahan kain', 'tidak ada minus', 'Supreme', 1, 10, 3, 2, 300, 200000, 1, '2021-05-18 04:22:13', '2021-05-18 04:22:13'),
(6, 'Maroon florenta shoes', 'Sepatu high hils berbahan bludru maroon bisa dipakai acara formal dan nyaman', 'minus bagian tapak sudah tipis pemakaian', 'W Fashion', 0, 5, 4, 1, 500, 157000, 1, '2021-05-18 04:23:42', '2021-05-18 04:23:42'),
(7, 'Nike air jordan 1', 'Sepatu air jordan berbahan leather dan midsole putih cocok untuk dipakai street style karna hak tinggi dan dipadukan dengan warna celana gelap', 'minus tidak ada tali', 'Nike', 1, 7, 4, 3, 800, 1000000, 1, '2021-05-18 04:24:52', '2021-05-18 04:24:52'),
(8, 'Pharel HU nmd black', 'Sepatu hu collaborasi pharrel dengan ekstra tali berwarna hitam dan bahan sepatu kain sehingga dingin dipakai', 'minus tidak ada insole', 'Adidas', 1, 9, 4, 2, 800, 1500000, 1, '2021-05-18 04:27:27', '2021-05-18 04:27:27'),
(9, 'Yeezy ultraboost v3', 'Bahan rajutan dengan warna langka versi 3 dan dilengkapi dengan boost', 'minus boost bawah menguning', 'Adidas', 1, 6, 4, 2, 800, 1550000, 1, '2021-05-18 04:28:38', '2021-05-18 04:28:38'),
(10, 'Yeezy ultraboost v3', 'Bahan rajutan dengan warna putih dan kombinasi hitam versi 3 dan dilengkapi dengan boost', 'minus midsole kuning', 'Adidas', 1, 4, 4, 1, 600, 550000, 1, '2021-05-18 04:29:46', '2021-05-18 04:29:46'),
(11, 'Yeezy sandals', 'Sendal yeezy berbahan karet ini dapat menerjang berbagai medan dengan style unik kolaborasi kanye', 'minus tapak sudah tipis', 'Adidas', 1, 4, 5, 2, 400, 300000, 1, '2021-05-18 04:32:03', '2021-05-18 04:32:03'),
(12, 'Blood Mercy', 'jacket ini berbahan parasut dan kolaborasi khusus membuat mahal dengan warna yang langka', 'minus resleting kanan kiri macet', 'Yellow Clow', 1, 7, 6, 3, 700, 700000, 1, '2021-05-18 04:57:45', '2021-05-18 04:57:45'),
(13, 'Black Long Cardigan', 'Cardigan melindungi inshirt sehingga tampilan lebih menarik dan hangat karena cocok dikombinasikan', 'minus pada bagian tag sudah tidak ada', 'H&M', 0, 5, 7, 1, 200, 67000, 1, '2021-05-18 04:58:58', '2021-05-18 04:58:58'),
(14, 'Black Drasses', 'Midi black drasses adalah pakaian panjang dress yang nyaman dan dingin dipakai', 'minus dibagian bawah ada bagian jahitan yang lepas tetapi tidak terlalu kelihatan karena terletak dibagian belakang', 'Midi', 0, 8, 8, 3, 300, 87000, 1, '2021-05-18 05:03:07', '2021-05-18 05:03:07'),
(15, 'Flowery Drasses', 'Motif drasses pada kali ini adalah bunga menampilkan sifat feminim jika dipakai dan juga bahan yang tebal dan hangat, minus warna dibagian lengan kanan sedikir pudar', '6', 'Colorbox', 0, 7, 8, 3, 300, 57000, 1, '2021-05-18 05:04:02', '2021-05-18 05:04:02'),
(16, 'Thunder Horse Hoodie', 'Hoodie offwhite kualitas tinggi dan desaign loreng oren menarik dan bahan yang tebal membuat hangat', 'minus warna hitam pudar', 'Off White', 1, 4, 9, 3, 600, 157000, 1, '2021-05-18 05:05:50', '2021-05-18 05:05:50'),
(17, 'Brown supreme logobox', 'Hoodie supreme logobox berearna cokelat dan biru muda dengan tali berbahan mirip dengan sepatu dan tebal', 'minus karet bawah melar', 'Supreme', 1, 5, 9, 2, 600, 177000, 1, '2021-05-18 05:06:56', '2021-05-18 05:06:56'),
(18, 'Green stripe top', 'Kemeja loreng hitam dipadukan dengan garis putih membuat tampilan semakin terkini dan juga memiliki bahan yang nyaman dan dingin', 'minus dibagian kancing atas sudah lepas', 'Forever21', 0, 9, 17, 1, 300, 87000, 1, '2021-05-18 05:08:26', '2021-05-18 05:08:26'),
(19, 'Black top', 'Baju lengan panjang dengan style kerah lebar memberikan kepercayaan diri saat dipakai dan sedikit maskulin', 'minus dibagian tag hilang', 'Bella', 0, 9, 17, 2, 300, 77000, 1, '2021-05-18 05:09:41', '2021-05-18 05:09:41'),
(20, 'White top', 'Long sleeve berbahan cashmere tipis', 'minus dibagian bawah warna kuning', 'Cotton On', 0, 4, 17, 2, 200, 77000, 1, '2021-05-18 05:10:43', '2021-05-18 05:10:43'),
(21, 'Long Sleeve Shirt combination brown', 'Kemeja polyester dengan kerah kancing kece dan dingin', 'minus dibagian kancing lengan kanan hilang', 'H&M', 0, 6, 17, 4, 300, 109000, 1, '2021-05-18 05:13:46', '2021-05-18 05:13:46'),
(22, 'Pink neon shirt', 'Kemeja pink yang lucu dan juga kekinian dilihat dari list kancing sehingga tampilan makin kece, berlengan panjang dan nyaman sehingga dapat dipakai sehari-hari', 'minus dibagian kancing paling bawah tidak ada', 'Zara', 0, 8, 17, 1, 200, 117000, 1, '2021-05-18 05:15:34', '2021-05-18 05:15:34'),
(23, 'Vintage LongSleeve shirt', 'kemeja lengan panjang bahan flanel yang mudah dipakai dan santai, cocok dipakai acara formal maupun non', 'minus lengan kancing hilang', 'YunJin', 0, 8, 17, 2, 400, 130000, 1, '2021-05-18 05:16:32', '2021-05-18 05:16:32'),
(24, 'White shirt', 'Baju putih dipakai untuk acara formal berbahan flanel dingin dan nyaman', 'tidak ada minus', 'Uniqlo', 0, 10, 15, 1, 200, 100000, 1, '2021-05-18 05:18:40', '2021-05-18 05:18:40'),
(25, 'Blue strip top', 'Shirt berwarna putih dengan kera vline akan tampil kece berbahan cotton 80s', 'minus dibagian bawah warnanya pudar', 'This is April', 0, 9, 15, 2, 200, 77000, 1, '2021-05-18 05:23:23', '2021-05-18 05:23:23'),
(26, 'Cream tied top', 'Shirt ini memiliki pattern garis cokelat tua dan berkerah vneck', 'minus dibagian bawah kancing lepas', 'Temt', 0, 8, 15, 1, 200, 67000, 1, '2021-05-18 05:49:00', '2021-05-18 05:49:00'),
(27, 'Blue square shirt', 'Baju dengan tampilan mirip kemeja ini tidak memiliki kancing dan mudah dipakai dengan tidak mengurangi style', 'minus dibagian belakang warna pudar', 'Uniqlo', 0, 7, 15, 2, 400, 97000, 1, '2021-05-18 05:51:17', '2021-05-18 05:51:17'),
(28, 'Vertical shape shirt', 'Kemeja ini adalah kemeja trend 2021 dengan model desaign yang menarik dan juga berbahan cotton plyester berkualitas tinggi dan dibuat di indonesia', 'minus bagian belakang pudar', 'Teneu de Atire', 0, 5, 15, 3, 300, 180000, 1, '2021-05-18 05:52:57', '2021-05-18 05:52:57'),
(29, 'Indian Shirt', 'Kemeja berdesaign indian ethnic dengan bahan tipis sehingga dingin dipakai', 'tidak ada minus', 'Ethnic', 0, 8, 15, 2, 400, 60000, 1, '2021-05-18 05:54:18', '2021-05-18 05:54:18'),
(30, 'Maroon Sweater', 'Sweater ini memiliki model blank middle sehingga bisa dipadukan dengan inshirt', 'minus dibagian kerah sedikir melar', 'Colorbox', 0, 5, 12, 2, 450, 67000, 1, '2021-05-18 05:56:06', '2021-05-18 05:56:06'),
(31, 'Maroon Sweater', 'Sweater berbahan wol dibagian dalam menjaga tubuh tetap hangat dan memiliki', 'minus dibagian kerah lengan kanan melar', 'Bershka', 0, 7, 12, 1, 600, 87000, 1, '2021-05-18 05:58:29', '2021-05-18 05:58:29'),
(32, 'Pink Sweater', 'Sweater berbahan muslin pink dengan crewneck dan bahan tebal', 'minus dibagian belakang sedikir robek', 'H&M', 0, 8, 12, 1, 200, 97000, 1, '2021-05-18 05:59:35', '2021-05-18 05:59:35'),
(33, 'Black rosses T-Shirt', 'T-Shirt dengan bahan cotton 80s sehingga nyaman dan tebal', 'tidak ada minus', 'Pull&Bear', 0, 10, 16, 2, 245, 67000, 1, '2021-05-18 06:03:28', '2021-05-18 06:03:28'),
(34, 'Blue T-Shirt', 'T-Shirt dengan bahan cotton 80s sehingga nyaman dan tebal', 'minus pada bagian leher sedikit melar', 'Zara', 0, 8, 16, 2, 300, 87000, 1, '2021-05-18 06:05:01', '2021-05-18 06:05:01'),
(35, 'White T-Shirt', 'T-Shirt dengan bahan cotton 30s sehingga sedikit lebih dingin karena tipis', 'minus dibagian logo sedikit pudar', 'Levi\'s', 0, 4, 16, 1, 230, 77000, 1, '2021-05-18 06:06:31', '2021-05-18 06:06:31'),
(36, 'Big rare tee', 'Baju berbahan cotton 80s yang tebal sehingga dipakai hangat dan santai', 'minus bagian sablon terkelupas', 'Gvc rottweiler', 1, 7, 16, 1, 200, 59000, 1, '2021-05-18 06:07:48', '2021-05-18 06:07:48'),
(37, 'Gold Snake t-shirt', 'Bahan cotto. 30 s memiliki ketebalan medium dan menyerap keringat dengan desaign maskulin ular', 'minus dibagian jahitan bawah lepas', 'Marcelo Burlon', 1, 7, 16, 2, 310, 180000, 1, '2021-05-18 06:09:13', '2021-05-18 06:09:13'),
(38, 'Reversible Vest', 'ompi ini memiliki model timbal balek dengan berbeda desaign dan bahan muslin menyerap keringat', 'minus resleting sudah rusak', 'Nirmana', 1, 7, 14, 1, 500, 80000, 1, '2021-05-18 06:10:35', '2021-05-18 06:10:35'),
(39, 'Black Skinny Jeans', 'Desaign warna jeans light black dan juga bertype street mudah untuk dipakai berpergian dan kualitas bahan yang tebal dan tahan lama', 'minus lingkar kaki bagian kanan sedikit robek', 'H&M', 0, 6, 18, 3, 650, 117000, 1, '2021-05-18 06:13:02', '2021-05-18 06:13:02'),
(40, 'Light Ocean Kustiaris', 'Jeans dengan warna light blue dengan kualitas bahan premium dan tebal sehingga membentuk lapis kaki dengan baik', 'minus resleting rusak', 'Zara', 0, 8, 18, 3, 500, 260000, 1, '2021-05-18 06:15:19', '2021-05-18 06:15:19'),
(41, 'Black Street Undifinesional Jeans', 'Jeans ini memiliki warna hitam muda dan sesuai dengan trend saat ini dan pas dipakai menyerupai kaki dan bagian pergenalngan kaki yang model ripped', 'kantong belakang robek', 'Pull&Bear', 0, 6, 18, 2, 400, 80000, 1, '2021-05-18 06:17:06', '2021-05-18 06:17:06'),
(42, 'Black Ripped Jeans', 'Ripped Jeans celana trend saat ini dengan style street dan ripped dibagian tengah, celana sedikit dingin', 'minus bagian kanan jahitan lepas', 'Cotton On', 0, 7, 18, 2, 400, 157000, 1, '2021-05-18 06:19:54', '2021-05-18 06:19:54'),
(43, 'Foster Blue Jeans', 'Jeans style casual dan tidak skinny bahan lembut dan tidak tegang', 'minus bagian kancing longgar', 'Pull&Bear', 0, 9, 18, 1, 350, 59000, 1, '2021-05-18 06:21:29', '2021-05-18 06:21:29'),
(44, 'Light BLue mom Jeans', 'Memiliki warna unik dan desaign pattern slice menjadikan look dari celana ini bagus dan tidak terlalu ketat sehingga bisa dipakai daily', 'minus bagian kantong kanan bolong', 'Stradivarius', 0, 9, 18, 3, 520, 99000, 1, '2021-05-18 06:23:44', '2021-05-18 06:23:44'),
(45, 'Denim Ripped Jeans', 'Rippped skinnye jeans berbahan kualitas jeans dipadukan dengan muslin sehinga jeasn terlihat tebal dan kuat', 'tidak ada minus', 'Cotton On', 0, 8, 18, 2, 450, 210000, 1, '2021-05-18 06:25:16', '2021-05-18 06:25:16'),
(46, 'Rucas grey zip harald', 'barang baru jeans rucas buatan indonesia dengan bahan strach dan kualitas jeans tinggi', 'tidak ada minus', 'Rucas', 1, 10, 18, 2, 500, 360000, 1, '2021-05-18 06:27:13', '2021-05-18 06:27:13'),
(47, 'Rucas blue zip feno', 'barang baru jeans rucas buatan indonesia dengan bahan strach dan bagian zip berwarna tua dibagian bawah skinny', 'minus resleting rusak', 'Rucas', 1, 7, 18, 3, 340, 200000, 1, '2021-05-18 06:28:17', '2021-05-18 06:28:17'),
(48, 'Black fancom Legging', 'Legging didesaign dengan bahan tipis', 'tidak ada minus', 'Zara', 0, 10, 19, 2, 200, 100000, 1, '2021-05-18 06:31:43', '2021-05-18 06:31:43'),
(49, 'Black Legging', 'Legging dengan bahan chifron mengkilat dan dapat strach dipakai saat panas atau kena matahari tidak menyerap panas', 'minus tag robek', 'Cotton On', 0, 8, 19, 3, 150, 57000, 1, '2021-05-18 06:33:46', '2021-05-18 06:33:46'),
(50, 'Black Cream Legging', 'Legging ini memiliki bahan jersey yang menyerap keringat dan dingin', 'minus linkar kaki sedikit pudar', 'H&M', 0, 7, 2, 2, 200, 107000, 1, '2021-05-18 06:34:55', '2021-05-18 06:34:55'),
(51, 'Grey cullote', 'Memiliki bahan yang mirip dengan cotton sehingga bahan tidak mudah rusak dan mudah untuk di cuci', 'minus tag robek', 'This Is April', 0, 9, 20, 1, 320, 62000, 1, '2021-05-18 06:38:05', '2021-05-18 06:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE `products_images` (
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`product_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 'Hat1_1621304389_a625d9f4-6518-46a3-91a8-aba1e8cd279a.jpeg', '2021-05-18 03:19:49', '2021-05-18 03:19:49'),
(2, 'Bag1_1621304553_69fddaf6-c2db-4ed8-ba2c-75d9cd47621f.jpeg', '2021-05-18 03:22:33', '2021-05-18 03:22:33'),
(3, 'Bag2_1621307977_61cc5c03-b9c8-4404-ae7f-915909c33f8a.jpeg', '2021-05-18 04:19:37', '2021-05-18 04:19:37'),
(4, 'Bag3_1621308039_92c3e1ec-9086-4b1f-8a72-e1c23f64ed73.jpeg', '2021-05-18 04:20:39', '2021-05-18 04:20:39'),
(5, 'Bag4_1621308133_4035b092-64d7-4214-ab56-90c5c39e84af.jpeg', '2021-05-18 04:22:13', '2021-05-18 04:22:13'),
(6, 'Shoes1_1621308222_d2398fe8-4606-46cc-9759-d43df7a56403.jpeg', '2021-05-18 04:23:42', '2021-05-18 04:23:42'),
(7, 'Shoes2_1621308292_c7533144-7c3c-42f0-bddf-e3999918df8f.jpeg', '2021-05-18 04:24:52', '2021-05-18 04:24:52'),
(8, 'Shoes3_1621308447_0362e762-6ee0-4990-bf59-127c3f7d9888.jpeg', '2021-05-18 04:27:27', '2021-05-18 04:27:27'),
(9, 'Shoes4_1621308518_cb6e7c0d-c2fb-4373-83d3-1ccc6775d317.jpeg', '2021-05-18 04:28:39', '2021-05-18 04:28:39'),
(10, 'Shoes5_1621308586_076568cd-b29b-41c2-b867-ec88fd4d9bf6.jpeg', '2021-05-18 04:29:46', '2021-05-18 04:29:46'),
(11, 'Sandals1_1621308723_b71ea703-283d-434e-92b6-7379a6a3b4cd.jpeg', '2021-05-18 04:32:03', '2021-05-18 04:32:03'),
(12, 'BomberJacket1_1621310265_e612eaef-5b98-4289-80fc-161b34e73497.jpeg', '2021-05-18 04:57:45', '2021-05-18 04:57:45'),
(13, 'Cardigan1_1621310338_f5fca0d8-ece4-4390-a188-f390e9c1b906.jpeg', '2021-05-18 04:58:58', '2021-05-18 04:58:58'),
(14, 'Drasses1_1621310587_4b1e592d-9f5b-4b0c-8b4b-c4b7c4c0c8ab.jpeg', '2021-05-18 05:03:07', '2021-05-18 05:03:07'),
(15, 'Drasses2_1621310642_0350233f-3563-44f4-85a1-66c78b0bb874.jpeg', '2021-05-18 05:04:02', '2021-05-18 05:04:02'),
(16, 'Hoodie1_1621310750_7a523eab-2507-42d3-96a2-6f9d270ceb27.jpeg', '2021-05-18 05:05:50', '2021-05-18 05:05:50'),
(17, 'Hoodie2_1621310816_8f1031d9-360e-4c37-8f29-1fde6df296c6.jpeg', '2021-05-18 05:06:56', '2021-05-18 05:06:56'),
(18, 'LongSleeveShirt1_1621310906_fc5d8532-2183-4787-81c1-f7b1ffdab02f.jpeg', '2021-05-18 05:08:26', '2021-05-18 05:08:26'),
(19, 'LongSleeveShirt2(1)_1621310981_44bae590-1600-4973-968e-a576e3f4147c.jpeg', '2021-05-18 05:09:41', '2021-05-18 05:09:41'),
(19, 'LongSleeveShirt2(2)_1621310981_4f83b5a5-9359-4c87-82d0-67803d85e021.jpeg', '2021-05-18 05:09:41', '2021-05-18 05:09:41'),
(19, 'LongSleeveShirt2_1621310981_98224158-ad42-4c65-b954-651651cfd4d9.jpeg', '2021-05-18 05:09:41', '2021-05-18 05:09:41'),
(20, 'LongSleeveShirt3_1621311043_a83a03b2-b440-4fdb-b522-c1718d8a4283.jpeg', '2021-05-18 05:10:43', '2021-05-18 05:10:43'),
(21, 'LongSleeveShirt4(1)_1621311226_ed4c5afd-fe88-457a-b1a3-23266219dae6.jpeg', '2021-05-18 05:13:46', '2021-05-18 05:13:46'),
(21, 'LongSleeveShirt4_1621311226_5e58e6ec-a094-4e7d-bc0f-d2c805fe67c0.jpeg', '2021-05-18 05:13:46', '2021-05-18 05:13:46'),
(22, 'LongSleeveShirt4(2)_1621311334_583bdd73-5bd2-46ed-abe2-7cbc3341cd1d.jpeg', '2021-05-18 05:15:34', '2021-05-18 05:15:34'),
(22, 'LongSleeveShirt5(1)_1621311334_754e99c8-3f79-4c2c-af44-e53e0e30278c.jpeg', '2021-05-18 05:15:34', '2021-05-18 05:15:34'),
(22, 'LongSleeveShirt5_1621311334_b1a9faa2-4c57-4e41-a338-c4d2faec5fb8.jpeg', '2021-05-18 05:15:34', '2021-05-18 05:15:34'),
(23, 'LongSleeveShirt6(1)_1621311392_272514c5-d7ef-4ed0-abb6-9849c0ca36de.jpeg', '2021-05-18 05:16:32', '2021-05-18 05:16:32'),
(23, 'LongSleeveShirt6(2)_1621311392_7feedf4a-7cfb-4d7b-816a-f6355d4ceede.jpeg', '2021-05-18 05:16:33', '2021-05-18 05:16:33'),
(23, 'LongSleeveShirt6_1621311392_83c1f176-bae6-4f20-8dbf-b480ed1f735a.jpeg', '2021-05-18 05:16:33', '2021-05-18 05:16:33'),
(24, 'Shirt1_1621311520_a307c3bb-dc3f-4fcf-a1e2-d1a20cb0dd6d.jpeg', '2021-05-18 05:18:40', '2021-05-18 05:18:40'),
(25, 'Shirt2(1)_1621311803_6d313435-95b2-4e58-b983-5f5f61f66d49.jpeg', '2021-05-18 05:23:23', '2021-05-18 05:23:23'),
(25, 'Shirt2_1621311803_34479a2f-fc29-44b2-b5a8-b44aa911dd87.jpeg', '2021-05-18 05:23:23', '2021-05-18 05:23:23'),
(26, 'Shirt3_1621313340_b8825a58-4a05-4278-ac12-f88e9e2e9650.jpeg', '2021-05-18 05:49:00', '2021-05-18 05:49:00'),
(27, 'Shirt(1)_1621313477_d1f87421-86f6-46d0-9945-9cbd5f1921cb.jpeg', '2021-05-18 05:51:17', '2021-05-18 05:51:17'),
(27, 'Shirt4_1621313477_d98b2d3b-5c1e-44be-a3a9-c696af3c2b7d.jpeg', '2021-05-18 05:51:18', '2021-05-18 05:51:18'),
(28, 'Shirt5(1)_1621313577_2a979b78-7308-4465-8b5e-2a46022a5be0.jpeg', '2021-05-18 05:52:57', '2021-05-18 05:52:57'),
(28, 'Shirt5_1621313577_c4776a06-1d84-437e-91c6-18ef65fe93f3.jpeg', '2021-05-18 05:52:57', '2021-05-18 05:52:57'),
(29, 'Shirt6(1)_1621313658_a8e7ac38-011e-4712-b4ad-8f6a83d738fb.jpeg', '2021-05-18 05:54:18', '2021-05-18 05:54:18'),
(29, 'Shirt6_1621313658_2b91b9b1-de96-4ebb-af83-1af97bba1ec5.jpeg', '2021-05-18 05:54:18', '2021-05-18 05:54:18'),
(30, 'Sweater1_1621313766_a3030f4c-43ae-4de0-b555-752dab8aab66.jpeg', '2021-05-18 05:56:06', '2021-05-18 05:56:06'),
(31, 'Sweater2_1621313909_cdf1d03a-0174-47f0-8340-2c639c05d1b4.jpeg', '2021-05-18 05:58:30', '2021-05-18 05:58:30'),
(32, 'Sweater3_1621313975_24f9cbc2-e45e-4cad-9b8e-1cc9945530e5.jpeg', '2021-05-18 05:59:35', '2021-05-18 05:59:35'),
(33, 'T-Shirt1(1)_1621314208_e7678a85-e191-4969-aee7-f1efa31f1554.jpeg', '2021-05-18 06:03:28', '2021-05-18 06:03:28'),
(33, 'T-Shirt1_1621314208_97333038-9034-4574-b77e-1f9e15140b30.jpeg', '2021-05-18 06:03:28', '2021-05-18 06:03:28'),
(34, 'T-Shirt2(1)_1621314301_8d9a14ef-3298-458d-837b-05e6013b67e6.jpeg', '2021-05-18 06:05:01', '2021-05-18 06:05:01'),
(34, 'T-Shirt2_1621314301_3bad5345-d6b0-4b27-841c-81d8b9205d4e.jpeg', '2021-05-18 06:05:01', '2021-05-18 06:05:01'),
(35, 'T-Shirt3_1621314391_10b140e4-fde0-4c93-a5b6-a6a94ae044d9.jpeg', '2021-05-18 06:06:32', '2021-05-18 06:06:32'),
(36, 'T-Shirt4_1621314468_e154a067-e650-4af8-a375-cdb09a547dbf.jpeg', '2021-05-18 06:07:48', '2021-05-18 06:07:48'),
(37, 'T-Shirt5_1621314553_7876de88-fea6-4902-ac6b-dc7b07b4468f.jpeg', '2021-05-18 06:09:13', '2021-05-18 06:09:13'),
(38, 'Vest1(1)_1621314635_28a169ba-41e5-4b15-a901-166b523acf0a.jpeg', '2021-05-18 06:10:35', '2021-05-18 06:10:35'),
(38, 'Vest1_1621314635_4694c35c-9e52-41fe-9757-dc7ac70c4919.jpeg', '2021-05-18 06:10:35', '2021-05-18 06:10:35'),
(39, 'Jeans1(1)_1621314782_9fd27f26-6e42-4de3-81c8-624af087fba2.jpeg', '2021-05-18 06:13:03', '2021-05-18 06:13:03'),
(39, 'Jeans1_1621314782_e461ba0b-46de-4f6f-9d17-91dd9c088f66.jpeg', '2021-05-18 06:13:03', '2021-05-18 06:13:03'),
(40, 'Jeans2_1621314919_e1e1c276-1703-463f-8a56-29acbbfcb023.jpeg', '2021-05-18 06:15:19', '2021-05-18 06:15:19'),
(41, 'Jeans3_1621315026_200ff97e-2440-4d39-af6d-ca9d6e4ccdfd.jpeg', '2021-05-18 06:17:06', '2021-05-18 06:17:06'),
(42, 'Jeans4_1621315194_f9c1cc53-1bfd-4fff-9e88-de9c0ee404f8.jpeg', '2021-05-18 06:19:54', '2021-05-18 06:19:54'),
(43, 'Jeans5_1621315289_899a756e-4183-483f-b80f-4ee4c52c5ca2.jpeg', '2021-05-18 06:21:29', '2021-05-18 06:21:29'),
(44, 'Jeans6_1621315424_44816bd6-7e38-4b97-aedc-8e5515efdea9.jpeg', '2021-05-18 06:23:44', '2021-05-18 06:23:44'),
(45, 'Jeans7(1)_1621315516_4ec0ed28-57a2-4c81-be91-eb007f718818.jpeg', '2021-05-18 06:25:16', '2021-05-18 06:25:16'),
(45, 'Jeans7_1621315516_9d366b41-2ace-4931-9245-0e5a5a1668a4.jpeg', '2021-05-18 06:25:16', '2021-05-18 06:25:16'),
(46, 'Jeans8_1621315633_8a7ec705-0d62-4fef-93db-5f7965ca7c9d.jpeg', '2021-05-18 06:27:14', '2021-05-18 06:27:14'),
(47, 'Jeans9_1621315697_34815e7e-0ae3-4ae4-b23f-2e0ae4bb5c5f.jpeg', '2021-05-18 06:28:17', '2021-05-18 06:28:17'),
(48, 'Legging1_1621315903_65a5235a-8b05-4b15-9de7-d20ff6e332af.jpeg', '2021-05-18 06:31:43', '2021-05-18 06:31:43'),
(49, 'Legging2_1621316026_7f9c82a0-cb4c-4366-be58-e05884cbc817.jpeg', '2021-05-18 06:33:46', '2021-05-18 06:33:46'),
(50, 'Celana3(1)_1621316095_184d01cf-352e-4394-b92e-981395c99e11.jpeg', '2021-05-18 06:34:55', '2021-05-18 06:34:55'),
(50, 'Celana3(2)_1621316095_f90ef3a0-2c22-44e4-bee7-6b2a579d1814.jpeg', '2021-05-18 06:34:56', '2021-05-18 06:34:56'),
(50, 'Celana3_1621316095_00f9b5fa-bbd1-4af9-99a5-62330bec390f.jpeg', '2021-05-18 06:34:56', '2021-05-18 06:34:56'),
(51, 'Pants1_1621316285_59272367-2b96-4f8c-9702-fe6b18e03590.jpeg', '2021-05-18 06:38:05', '2021-05-18 06:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2021-05-01 17:15:49', '2021-05-01 17:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `cost` int(11) NOT NULL,
  `courier` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `created_at`, `updated_at`) VALUES
(1, 'S', '2021-05-18 03:10:58', '2021-05-18 03:10:58'),
(2, 'M', '2021-05-18 03:11:02', '2021-05-18 03:11:02'),
(3, 'L', '2021-05-18 03:11:07', '2021-05-18 03:11:07'),
(4, 'XL', '2021-05-18 03:11:10', '2021-05-18 03:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `postal_code` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_date` date NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `telephone`, `province_id`, `city_id`, `postal_code`, `address`, `birth_date`, `profile_image`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alfons', 'alfonschandrawan@gmail.com', '08123121312', 28, 254, 90235, 'Jalan tulip no 10, dekat pos satpam', '2001-12-20', 'review-2_1621170866_5245c257-854b-49e8-b8da-c56875054586.jpg', '$2y$10$LtAAD4oKPmNdTlqbSy5NPuAPj.02K.q2yvrYlrYDabeLn1FVdZqV2', NULL, NULL, '2021-05-01 18:38:39', '2021-05-16 06:38:52'),
(2, 'Kevin', 'kevin@gmail.com', '0823121312', 7, 131, 88569, 'Jalan Apel No.3', '2001-01-13', '', '$2y$10$HsVIzMoKfn/CYMCmu4o0ku8CXWpcq5SyTznnE.vcnfqsd5m7kB4Ei', NULL, NULL, '2021-05-01 18:38:39', '2021-05-11 11:02:06'),
(3, 'Abdi', 'abdidarsono11@gmail.com', '08123121312', 26, 350, 896365, 'Pekanbaru', '2001-02-02', 'review-3_1621174725_15a825a4-407b-43eb-99f6-3ca9e6f51b58.jpg', '$2y$10$hEhiIHEV8iRNWFtJqKenfucw2.XZN6QUFe14d82hcuuwqOmF/8v2C', NULL, NULL, '2021-05-01 18:38:39', '2021-05-16 07:19:12'),
(7, 'Jeremy', 'jeremy@gmail.com', '0812456936666', 0, 0, 0, 'Jalan Melati No. 90', '2001-12-12', '', '$2y$10$WPQjbNtD/6h.rq6.y0CVaeBezq2423ltHu//An4CKM2X5L1iwgK7a', NULL, NULL, '2021-05-03 15:30:48', '2021-05-03 15:30:48'),
(12, 'John', 'john@gmail.com', '08465952623', 11, 444, 98662, 'Jalan Jenderal Sudirman No.45', '2000-05-08', 'lingoshare 10 1aaa_1621164400_21ff115b-99f3-45ca-b83a-1141912ede89.png', '$2y$10$HDtW.ajoPOLkLaTD3NSpYOyBY7qMpIQVyWN5cuSZ5HlvGHcQXtqXm', NULL, NULL, '2021-05-16 02:55:16', '2021-05-16 04:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_user_id_foreign` (`user_id`),
  ADD KEY `cart_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_size_id_foreign` (`size_id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD KEY `products_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_order_id_foreign` (`order_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippings_order_id_foreign` (`order_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_size_name_unique` (`size_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `cart_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `products_images`
--
ALTER TABLE `products_images`
  ADD CONSTRAINT `products_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
