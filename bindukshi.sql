-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2025 at 09:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bindukshi`
--

-- --------------------------------------------------------

--
-- Table structure for table `abc`
--

CREATE TABLE `abc` (
  `d` int(12) NOT NULL,
  `dw` int(3) NOT NULL,
  `ads` int(1) NOT NULL,
  `acd` int(21) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(1, 'admin', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `pid`, `name`, `price`, `quantity`, `image`) VALUES
(1, 1, 3, 'ring1', 50544, 1, 'ring1.jpg'),
(2, 1, 4, 'RING2', 65468, 1, 'ring2.jpg'),
(3, 4, 3, 'ring1', 50544, 1, 'ring1.jpg'),
(4, 1, 12, 'tanisq ring 2', 65561, 1, 'ring2 1.webp'),
(32, 11, 4, 'RING2', 65468, 1, 'ring2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `name` varchar(20) NOT NULL,
  `img` varchar(100) NOT NULL,
  `id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`name`, `img`, `id`) VALUES
('Ring', 'category-name-ring.jpg', 5),
('Mangalsutra', 'category-name-mangalsutra.webp', 6),
('Bracelets', 'category-name-bracelets.webp', 7),
('Nose Ring', 'category-name-nosepin.webp', 10),
('Earring', 'category-name-earring.jpg', 11),
('Pendent', 'category-name-pendent.jpg', 12),
('Neckless', 'category-name-neckless.webp', 13),
('Bangle', 'category-name-bangle.jpg', 14),
('Gold Coin', 'category-name-goldcoin.jpg', 15),
('Chain', 'category-name-chain.jpg', 16);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` datetime NOT NULL DEFAULT current_timestamp(),
  `payment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(2, 1, 'subrata', '', 'subrata123@gmail.com', 'cash on delevery', '18 a shreeji park', 'a +b+c', 666, '2025-03-03 00:00:00', 'completed'),
(3, 2, 'Meet', '', 'meet@123gmai.com', 'cash on delevery', 'abc abc abc abc cab cabca cb ac ', 'absc scskdk scsdscsn cnscns', 5134, '2025-03-04 16:45:44', 'completed'),
(7, 10, 'Subrata Santra', '810677819', 'subrata@gmail.com', 'on', 'flat no. 18-A, shreeji park, nani khodiyar road,, Anand, Gujrat , india - 388001', 'ring1 (50544 x 1) - RING2 (65468 x 1) - ring3 (54481 x 1) - ', 170493, '2025-03-12 00:29:46', ''),
(8, 10, 'Subrata Santra', '8101677819', 'subrata@gmail.com', 'Cash on Delivery', 'flat no. 18-A, shreeji park, nani khodiyar road,, Anand, Gujrat , india - 388001', 'men ring 3 (446684 x 1) - tanisq ring 2 (65561 x 1) - tanisq ring 3 (56451 x 1) - ', 568696, '2025-03-12 00:33:43', 'pending'),
(9, 2, 'abc', '2151568646', 'dev@gmail.com', 'Cash on Delivery', 'flat no. Sdca, asca, asas, acscass, india - sasax', 'men ring1 (48974 x 1) - ', 48974, '2025-03-12 10:16:39', ''),
(10, 2, 'ansh', '8484', 'printa123@gmail.com', '', 'flat no. asd, sad, ads, sa, india - 6565', 'RING2 (65468 x 1) - ', 65468, '2025-03-12 10:21:59', ''),
(11, 2, 'nnn', '554', 'ahbd@gmail.com', '', 'flat no. jdakn, jsndjk, jnj, jnj, india - jnk', 'ring4 (48465 x 1) - ', 48465, '2025-03-12 10:23:56', ''),
(12, 11, 'Subrata Santra', '8101677819', 'subrata@gmail.com', 'Cash on Delivery', 'flat no. 18-A, shreeji park, nani khodiyar road,, Anand, Gujrat, india - 388001', 'ring 5 (54846 x 1) - men ring1 (48974 x 1) - men ring 3 (446684 x 1) - ', 550504, '2025-03-12 10:51:08', '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `categories` varchar(100) NOT NULL,
  `weight` double NOT NULL,
  `gender` varchar(10) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `stock` int(100) NOT NULL,
  `price` int(100) NOT NULL,
  `details` varchar(500) NOT NULL,
  `image_01` varchar(100) NOT NULL,
  `image_02` varchar(100) NOT NULL,
  `image_03` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `categories`, `weight`, `gender`, `tag`, `stock`, `price`, `details`, `image_01`, `image_02`, `image_03`) VALUES
(3, 'ring1', 'ring', 10, 'women', 'FSDFRGTSBT', 2, 50544, 'ring 22 gold . Latest ', 'ring1.jpg', 'ring2.jpg', 'ring3.jpg'),
(4, 'RING2', 'ring', 9, 'women', 'SSADFEWA', 3, 65468, 'rING2 \r\nhere we have new collection', 'ring2.jpg', 'ring3.jpg', 'ring4.jpg'),
(5, 'ring3', 'ring', 8, 'women', 'ASFEWEFEWF', 7, 54481, 'huqwf ewiohf hfwweh whoe', 'ring3.jpg', 'ring4.jpg', 'ring6.jpg'),
(6, 'ring4', 'ring', 11, 'women', 'AEFWEFW', 5, 48465, 'this is the finest ring', 'ring5.jpg', 'ring6.jpg', 'ring7.jpg'),
(7, 'ring 5', 'ring', 12, 'women', 'DAEWEWF', 8, 54846, ' jakef auwefh foash ewwhu wcahowa weejfjds wiajde', 'ring6.jpg', 'ring7.jpg', 'ring5.jpg'),
(8, 'men ring1', 'ring', 20, 'men', 'ASFWEFEWF', 21, 48974, 'Men ring stylish', 'men ring1.jpg', 'men ring2.jpg', 'men ring3.jpg'),
(9, 'Men ring 2', 'ring', 23.5, 'men', 'AWEFWEFERF', 6, 46644, 'daewfew fhewhf iowhfowh wfhwoe', 'men ring2.jpg', 'men ring3.jpg', 'men ring4.jpg'),
(10, 'men ring 3', 'ring', 13, 'men', 'WEWFEWEFWE', 4, 446684, 'kqkhk whefowq heoqw hfo whehf w', 'men ring4.jpg', 'men ring3.jpg', 'men ring5.jpg'),
(11, 'tanisq updating ring 1 meet update', 'mangalsutra', 15, 'men', 'FSAFAERW', 5, 45646, 'ring 1 updating updating updating meet meet meet', 'ring1.webp', 'earring1 2.webp', 'earring1 1.webp'),
(12, 'tanisq ring 2', 'ring', 14, 'women', 'SDCSFSFE', 6, 65561, 'ring ring ', 'ring2 1.webp', 'ring2 2.webp', 'ring2 3.webp'),
(13, 'tanisq ring 3', 'ring', 24, 'women', 'SFFDWEF', 6, 56451, 'ring ring ', 'ring3 1.webp', 'ring3 2.webp', 'ring3 3.webp'),
(14, 'tanisq ring 4', 'ring', 21, 'women', 'SADEWFFEF', 5, 56451, 'rinig', 'ring4 1.webp', 'ring4 2.webp', 'ring4 3.webp'),
(15, 'tanisq ring 5', 'ring', 15, 'women', 'DWEWEDFEW', 5, 45564, 'ring ring', 'ring5 1.webp', 'ring5 2.webp', 'ring5 3.webp'),
(16, 'tanisq ring 6', 'ring', 14, 'women', 'SDSFEF', 4, 15456, 'ring ring', 'ring6 1.webp', 'ring6 2.webp', 'ring6 3.webp'),
(17, 'tanisq Earring 1', 'earring', 23, 'women', 'DADEWFE', 3, 46468, 'earring earring', 'earring1 1.webp', 'earring1 2.webp', 'earring1 3.webp'),
(18, 'tanisq Earring 2', 'earring', 45, 'women', 'SDFEFFRGFERF', 5, 464684, 'earring earring', 'earring2 1.webp', 'earring2 2.webp', 'earring2 3.webp'),
(19, 'tanisq earrring 3', 'earring', 23, 'women', 'SDSDFERE', 2, 65454, 'Earring earring', 'earring3 1.webp', 'earring3 2.webp', 'earring3 3.webp'),
(20, 'tanisq earring 4', 'earring', 23, 'women', 'AEFEWEFW', 5, 65454, 'Earring earring', 'earring4 1.webp', 'earring4 2.webp', 'earring4 1.webp'),
(21, 'bangles beautiful', 'bangle', 21, 'women', 'ADSFSFSEW', 1, 44848, 'jhsbfhfw kjasfj jfnjdskfa', 'bangle1.jpg', 'bangle2.jpg', 'bangle3.jpg'),
(22, 'Fency Bracelet', 'bracelet', 14, 'women', 'AEWAFEWEWF', 5, 656545, 'gold 18k | fency | bracelet', 'bracelet5.jpg', 'bracelet1.jpg', 'bracelet2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(3, 'dev', 'dev@gmail.com', '1c6637a8f2e1f75e06ff9984894d6bd16a3a36a9'),
(4, 'printa m prajapati', 'printa123@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(7, 'Roshni Sinha', 'roshni123@gmail.com', '97b0fd2f9b2c4e92174719458b283189c944e15b'),
(8, 'kishan ', 'kishan123@gmail.com', '5f079981221ce504832142e9526b623bbfb6e686'),
(9, 'urvi', 'urvi123@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(10, 'subroto', 'subroto@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2'),
(11, 'Subrata Santra', 'subrata@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(21, 2, 5, 'ring3', 54481, 'ring3.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
