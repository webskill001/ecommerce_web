-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2021 at 10:06 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `addcart`
--

CREATE TABLE `addcart` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` text NOT NULL,
  `admin_job` varchar(255) NOT NULL,
  `admin_about` text NOT NULL,
  `admin_country` varchar(100) NOT NULL,
  `admin_city` varchar(100) NOT NULL,
  `admin_contact` int(11) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_username`, `admin_password`, `admin_job`, `admin_about`, `admin_country`, `admin_city`, `admin_contact`, `admin_image`, `date`) VALUES
(3, 'sumit chouhan', 'sumitchouhan10091999@gmail.com', 'sumit', '123', 'ceo', 'i am ceo', 'india', 'jalgaon', 2147483647, 'img3.jpg', '2020-07-19 10:13:25');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `carousel_id` int(11) NOT NULL,
  `carousel_img` text NOT NULL,
  `carousel_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`carousel_id`, `carousel_img`, `carousel_title`) VALUES
(1, 'pexels-photo-5231086.jpeg', 'slider image'),
(2, 'pexels-photo-6231881.jpeg', 'slider image 22'),
(3, 'pexels-photo-7125420.jpeg', 'slider image 3'),
(10, 'pexels-photo-5529935.jpeg', 'oioio');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_desc`) VALUES
(5, 'None', 'not belongs to this cagetory');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_code`
--

CREATE TABLE `coupon_code` (
  `coupon_id` int(11) NOT NULL,
  `coupon_title` varchar(100) NOT NULL,
  `coupon_type` varchar(100) NOT NULL,
  `coupon_value` int(100) NOT NULL,
  `cart_min_value` bigint(20) NOT NULL,
  `coupon_expire` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_password` text NOT NULL,
  `cus_username` varchar(255) NOT NULL,
  `cus_country` varchar(255) NOT NULL,
  `cus_city` varchar(255) NOT NULL,
  `cus_address` text NOT NULL,
  `cus_contact` int(10) NOT NULL,
  `cus_ip` text DEFAULT NULL,
  `cus_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_status` int(11) NOT NULL DEFAULT 0,
  `time&date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `cus_email`, `cus_password`, `cus_username`, `cus_country`, `cus_city`, `cus_address`, `cus_contact`, `cus_ip`, `cus_image`, `status`, `email_status`, `time&date`) VALUES
(1, 'sumit chouhan', 'sumit.chouhan102020@gmail.com', '$2y$10$2cJ78hckgRkADEHxXfLJb.1WxX0mnu2VR1CqHvBPVEgDvu79omaCK', 'sumit001', 'india', 'BURHANPUR', 'Ward no.11', 2147483647, '::1', '1517236595419.jpg', 1, 1, '2021-07-13 02:47:21');

-- --------------------------------------------------------

--
-- Table structure for table `deliveryboy`
--

CREATE TABLE `deliveryboy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_no` bigint(20) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deliveryboy`
--

INSERT INTO `deliveryboy` (`id`, `name`, `contact_no`, `status`, `added_on`) VALUES
(12, 'ayush', 9898989898, '1', '2020-08-10 04:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `delivery_address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `mobile_no` bigint(20) NOT NULL,
  `zipcode` int(100) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_no` bigint(20) NOT NULL,
  `total_amount` int(100) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_status` text NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT '6',
  `deliveryboy_id` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `delivery_address`, `city`, `mobile_no`, `zipcode`, `customer_id`, `invoice_no`, `total_amount`, `order_date`, `payment_status`, `order_status`, `deliveryboy_id`, `payment_mode`, `payment_id`) VALUES
(1, 'Ward no.11', 'BURHANPUR', 6362927036, 450331, 1, 3900119059, 4650, '2021-07-13 07:45:56', '', '6', 0, 'paytm', '0'),
(2, 'Ward no.11', 'BURHANPUR', 6362927036, 450331, 1, 6050965719, 8400, '2021-07-13 07:47:52', '', '6', 0, 'paytm', '0');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `qty` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `attribute_id`, `qty`) VALUES
(1, 1, 1, 1, 3),
(2, 1, 6, 6, 3),
(3, 2, 1, 1, 3),
(4, 2, 3, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `status`) VALUES
(1, 'placed'),
(2, 'ready to shippment'),
(3, 'order picked'),
(4, 'order arrive at your city'),
(5, 'completed'),
(6, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_no` int(10) NOT NULL,
  `amount` int(100) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `ref_no` int(100) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_p_cat_id` int(11) NOT NULL,
  `product_cat_id` int(11) NOT NULL,
  `product_crea_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_img1` varchar(255) NOT NULL,
  `product_img2` varchar(255) NOT NULL,
  `product_img3` varchar(255) NOT NULL,
  `product_price` int(10) NOT NULL,
  `product_desc` text NOT NULL,
  `product_keyword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_p_cat_id`, `product_cat_id`, `product_crea_time`, `product_img1`, `product_img2`, `product_img3`, `product_price`, `product_desc`, `product_keyword`) VALUES
(1, '1057 Tomato (Syngenta)', 22, 5, '2021-07-13 06:03:45', '1057_tomato_400x400.jpg', '1057tomatosyngenta_455x455.png', '', 0, '<ul>\r\n	<li>High Yielding, Dark Skin with Red Flesh IceBox type</li>\r\n	<li>Crop Duration - 60-68 Days</li>\r\n	<li>Disease&nbsp;Tolerant against Wilting</li>\r\n	<li>Recommended for Cultivation in all India.</li>\r\n	<li>CHARACTER-HIGH YIELDING,EARLY MATURITY,</li>\r\n	<li>SMALL SEEDS CAVITY</li>\r\n	<li>FRUIT SHAPE-OVAL TO OBLONG</li>\r\n	<li>FRUIT SIZE-3.5-5.5 KG FRUIT</li>\r\n	<li>COLOR- DARK BLACK SKIN, RED FLESH</li>\r\n	<li>SEASON&ndash;ALL SEASON CROP</li>\r\n	<li>TSS- 13-13.5%</li>\r\n	<li>OTHER-HIGHKEEPING CAPACITY</li>\r\n</ul>\r\n', 'p1'),
(2, 'Accent Star Mix Impatients wallneria F1 Hybrid (Syngenta Flowers)', 22, 5, '2021-07-13 06:44:02', 'accentsstar_320x320.jpg', '20200916_205547-removebg-preview_456x534.png', '', 0, 'When large, high-quality blooms and strong garden vigor matter most. Ideal for larger retail-ready containers, but also adaptable to production in small pots or packs where its large flowers can handle PGR applications. Excels in climates with short growing seasons, where strong plant vigor provides consumers with full flower beds. Withstands cooler growing conditions and other environmental stresses.', 'p2'),
(3, 'Lal Pari F1 Hybrid Papaya (United Genetics)', 22, 5, '2021-07-13 07:21:33', 'Lal_pari_papaya_-_united_genetics_455x651.jpg', 'lalpari_455x468.jpg', 'lalpari-3-web_455x455.jpg', 0, 'Fruit weight is about 1.5-2 Kg. Flesh is bright red color with very high TSS (Sweetness). Plants are dwarf, grow up to a height of 5 to 6 feet maximum. On an average each plant bears 50-60 fruits in the first flush and 40-50 fruits in the second flush. The hybrid is free from male plants. Fruits have an excellent shelf life.', 'p5'),
(4, 'Dolichos HA4 Superb Quality Bush Type Seeds', 23, 5, '2021-07-13 07:23:45', 'field-bean-1-638_455x342.jpg', '', '', 0, 'Growing habit of strong, dwarf shrubs, with dense foliage and large leaves. Medium long, flat, attractive shiny green color. Pods average 10-12 cm long and 2-3 cm wide', 'p6'),
(5, 'Zinnia elegans Liliput OP Mix', 23, 5, '2021-07-13 07:28:17', 'zinnia-elegans-lilliput-mix_455x455.jpg', '', '', 0, 'Zinnia Lilliput is a Summer season flower, Sow when the night temp is 25-30°C. Plant Height: 45 cm, Flower Size: 4-6 cm across. Sowing distance: 40 cm Plant to Plant, Best for: Bed sowing/Pots, Sowing method: Seedling.', 'p7'),
(6, 'Gladiolius Flower Tuberose Bulbs (Farmers Stop)', 24, 5, '2021-07-13 07:30:51', 'gladiolusbulbonlinebuy_455x455.jpg', 'gladiolus-bulbs_455x304.jpg', 'gladiolous2bulbonlinebuy_455x303.jpg', 0, 'To ensure large-sized blooms, plant corms that are 1¼ inch or larger in diameter.\r\nSet the corm in the hole about 4 inches deep with the pointed end facing up. Cover with soil and press firmly.\r\nSpace the corms 6 to 8 inches apart.\r\nIf you grow gladioli primarily for cut flowers, plant them in rows. It’s easier to tend the plants and to harvest the flowers.\r\nIf planted with other flowers in borders or annual beds, plant the corms in groups of 7 or more for the best effect.\r\nWater the corms thoroughly at planting.\r\nIf you’re planting tall varieties, be sure to stake them at planting time. Be careful not to damage the corms with the stakes.', 'p9'),
(7, 'Kalichakra – Metarhizium anisopliae (Wettable Powder) BioInsecticide (IPL)', 26, 5, '2021-07-13 07:32:30', 'KALICHAKRA_IPL_455x455.jpg', '', '', 0, 'Target Disease/Insects:\r\nControl eggs, larvae, pupal, nymphal and adult stages of White grubs, Beetle grubs, Caterpillars, Semiloopers, Loopers, Cutworms, Termites and Sucking pest like Pyrilla, Mealy bugs and Aphids', 'p0'),
(8, 'Kalichakra – Metarhizium anisopliae (Liquid) BioInsecticide (IPL)', 26, 5, '2021-07-13 07:33:57', 'Kalichakra-liquid_455x455.jpg', '', '', 0, 'Target Disease/Insects:\r\nControl eggs, larvae, pupal, nymphal and adult stages of White grubs, Beetle grubs, Caterpillars, Semiloopers, Loopers, Cutworms, Termites and Sucking pest like Pyrilla, Mealy bugs and Aphids', 'p10'),
(9, 'Raja F1 Hybrid Watermelon (Rizwan Seeds)', 27, 5, '2021-07-13 07:39:44', 'rajawatermelon_455x486.jpg', '', '', 0, 'Maturity 60-65 days after sowing\r\nFruit Weight5 -6 kg\r\nFlesh Colour Black outside with red & juicy flesh\r\nFruit Shape Oblong', 'p11');

-- --------------------------------------------------------

--
-- Table structure for table `product_attribute`
--

CREATE TABLE `product_attribute` (
  `attribute_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_size` varchar(100) NOT NULL,
  `product_color` varchar(100) NOT NULL,
  `product_price` int(100) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attribute`
--

INSERT INTO `product_attribute` (`attribute_id`, `product_id`, `product_size`, `product_color`, `product_price`, `added_on`) VALUES
(1, 1, '50kg', 'none', 1400, '2021-07-13 06:03:45'),
(2, 2, '1000 seeds', 'none', 1600, '2021-07-13 06:44:02'),
(3, 3, '5gm', 'none', 2100, '2021-07-13 07:21:33'),
(4, 4, '10g', '60 seeds', 60, '2021-07-13 07:23:45'),
(5, 5, '15g', 'none', 300, '2021-07-13 07:28:17'),
(6, 6, 'pack of 10(max 8 types of color))', 'none', 150, '2021-07-13 07:30:51'),
(7, 7, '1kg', 'none', 400, '2021-07-13 07:32:30'),
(8, 8, '1litre', 'none', 850, '2021-07-13 07:33:57'),
(9, 9, '50g', 'none', 1050, '2021-07-13 07:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_cat_id` int(11) NOT NULL,
  `product_cat_name` varchar(255) NOT NULL,
  `product_cat_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_cat_id`, `product_cat_name`, `product_cat_desc`) VALUES
(21, 'none', 'not belongs to this category'),
(22, 'Hybrid Seeds', 'Vegetables, fruits, flowers, cereal'),
(23, 'OP/Desi Seeds', 'OP Vegetables seeds, OP flower seeds, Flowering tree'),
(24, 'Flower Bulbs', 'na'),
(25, 'Live plants', 'indoor plants, outdoor plants, Bonsai plants, Cacctus and Succsulent plants.'),
(26, 'Agro chemicals', 'biological products, insecticides, fungicides, herbicides, nematicides, plant promoters.'),
(27, 'accessories', 'all accessories');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `cart_min_price` bigint(20) NOT NULL,
  `cart_min_message` varchar(255) NOT NULL,
  `website_status` enum('Close','Open') NOT NULL,
  `website_close_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `cart_min_price`, `cart_min_message`, `website_status`, `website_close_message`) VALUES
(1, 200, 'cart minimum price should be 200 Rs', 'Open', 'website close for some technical issue 1.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addcart`
--
ALTER TABLE `addcart`
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`carousel_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`),
  ADD UNIQUE KEY `cat_name` (`cat_name`);

--
-- Indexes for table `coupon_code`
--
ALTER TABLE `coupon_code`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `coupon_title` (`coupon_title`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_user` (`cus_username`),
  ADD UNIQUE KEY `cus_email` (`cus_email`);

--
-- Indexes for table `deliveryboy`
--
ALTER TABLE `deliveryboy`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contact_no` (`contact_no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_keyword` (`product_keyword`);

--
-- Indexes for table `product_attribute`
--
ALTER TABLE `product_attribute`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`product_cat_id`),
  ADD UNIQUE KEY `product_cat_name` (`product_cat_name`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `carousel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `coupon_code`
--
ALTER TABLE `coupon_code`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliveryboy`
--
ALTER TABLE `deliveryboy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_attribute`
--
ALTER TABLE `product_attribute`
  MODIFY `attribute_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `product_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
