-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2025 at 07:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiosk`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`) VALUES
(1, 'Breakfast', 'breakfast'),
(2, 'Lunch&Dinner', 'lunch&dinner'),
(3, 'Sides', 'sides'),
(4, 'Snacks', 'snacks'),
(5, 'Dips', 'dips'),
(6, 'Drinks', 'drinks');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `filename`, `description`) VALUES
(1, 'breakfast1.webp', ''),
(2, 'breakfast2.webp', ''),
(3, 'breakfast3.webp', ''),
(4, 'lunch&dinner1.webp', ''),
(5, 'lunch&dinner2.webp', ''),
(6, 'lunch&dinner3.webp', ''),
(7, 'sides1.webp', ''),
(8, 'sides2.webp', ''),
(9, 'sides3.webp', ''),
(10, 'sides4.webp', ''),
(11, 'snacks1.webp', ''),
(12, 'snacks2.webp', ''),
(13, 'snacks3.webp', ''),
(14, 'snacks4.webp', ''),
(15, 'snacks5.webp', ''),
(16, 'snacks6.webp', ''),
(17, 'snacks7.webp', ''),
(18, 'dips1.webp', ''),
(19, 'dips2.webp', ''),
(20, 'dips3.webp', ''),
(21, 'dips4.webp', ''),
(22, 'dips5.webp', ''),
(23, 'dips6.webp', ''),
(24, 'dips7.webp', ''),
(25, 'drinks1.webp', ''),
(26, 'drinks2.webp', ''),
(27, 'drinks3.webp', ''),
(28, 'drinks4.webp', ''),
(29, 'drinks5.webp', '');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `pickup_number` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_status_id`, `pickup_number`, `price`, `datetime`) VALUES
(1, 1, 0, 0.00, '0000-00-00 00:00:00'),
(2, 1, 0, 0.00, '0000-00-00 00:00:00'),
(3, 2, 2, 0.00, '2025-03-07 10:31:52'),
(4, 2, 3, 7.30, '2025-03-07 10:36:53'),
(5, 1, 0, 0.00, '0000-00-00 00:00:00'),
(6, 2, 5, 12.00, '2025-03-07 10:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `product_id`, `price`, `quantity`) VALUES
(1, 7, 3.50, 2),
(1, 8, 3.00, 1),
(2, 1, 4.50, 2),
(2, 2, 3.50, 1),
(2, 5, 5.00, 11),
(4, 1, 4.50, 1),
(4, 3, 2.80, 1),
(6, 2, 3.50, 2),
(6, 5, 5.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `description`) VALUES
(1, 'Started'),
(2, 'Placed and paid'),
(3, 'Preparing'),
(4, 'Ready for pickup'),
(5, 'Picked up');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `kcal` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `category_id`, `image_id`, `name`, `description`, `price`, `kcal`, `available`) VALUES
(1, 1, 1, 'Eggcellent Wrap', 'Whole-grain wrap filled with scrambled eggs, spinach, and a light yogurt-based sauce.', 4.50, 250, 1),
(2, 1, 2, 'Peanut Butter Power Toast', 'Whole-grain toast with natural peanut butter and banana slices.\r\n', 3.50, 220, 1),
(3, 1, 3, 'Morning Boost Smoothie Bowl', 'A blend of acai, banana, and mixed berries topped with granola, chia seeds, and coconut flakes.', 2.80, 300, 1),
(4, 2, 4, 'Protein-Packed Bowl', 'Quinoa, grilled tofu, roasted vegetables, and a tahini dressing.', 6.00, 450, 1),
(5, 2, 5, 'Supergreen Salad', 'Kale, spinach, avocado, edamame, cucumber, and a lemon-olive oil vinaigrette.', 5.00, 300, 1),
(6, 2, 6, 'Zesty Chickpea Wrap', 'Whole-grain wrap with spiced chickpeas, shredded carrots, lettuce, and hummus.', 4.50, 500, 1),
(7, 3, 7, 'Sweet Potato Wedges', 'Oven-baked sweet potato wedges seasoned with paprika and a touch of olive oil.', 3.50, 250, 1),
(8, 3, 8, 'Quinoa Salad Cup', 'Mini cup of quinoa mixed with cucumber, cherry tomatoes, parsley, and lemon dressing.', 3.00, 150, 1),
(9, 3, 9, 'Mini Veggie Platter', 'A selection of carrot sticks, celery, cucumber slices, and cherry tomatoes served with a dip of your choice.', 3.00, 150, 1),
(10, 3, 10, 'Brown Rice & Edamame Bowl', 'A small portion of brown rice topped with steamed edamame and a drizzle of soy sauce.', 3.50, 300, 1),
(11, 4, 11, 'Roasted Chickpeas (Spicy or Herb)', 'Crunchy roasted chickpeas with your choice of spicy paprika or herb seasoning.', 2.50, 180, 1),
(12, 4, 12, 'Trail Mix Cup', 'A mix of nuts, dried fruits, and seeds for an energy boost.', 2.00, 200, 1),
(13, 4, 13, 'Chia Pudding Cup', 'Creamy chia pudding made with almond milk and topped with fresh fruit.', 3.00, 250, 1),
(14, 4, 14, 'Baked Falafel Bites (4 pcs)', 'Baked falafel balls served with a dip of your choice.', 3.50, 220, 1),
(15, 4, 15, 'Mini Whole-Grain Breadsticks', 'Crisp, wholesome breadsticks perfect for pairing with hummus or salsa.', 2.00, 150, 1),
(16, 4, 16, 'Apple & Cinnamon Chips', 'Baked apple slices lightly dusted with cinnamon.', 2.50, 100, 1),
(17, 4, 17, 'Zucchini Fries', 'Baked zucchini sticks coated in a light breadcrumb crust.', 3.00, 180, 1),
(18, 5, 18, 'Classic Hummus', '', 0.80, 70, 1),
(19, 5, 19, 'Avocado Lime Dip', '', 1.00, 80, 1),
(20, 5, 20, 'Greek Yogurt Ranch', '', 0.70, 50, 1),
(21, 5, 21, 'Spicy Sriracha Mayo', '', 0.70, 60, 1),
(22, 5, 22, 'Garlic Tahini Sauce', '', 0.90, 90, 1),
(23, 5, 23, 'Zesty Tomato Salsa', '', 0.60, 20, 1),
(24, 5, 24, 'Peanut Dipping Sauce', '', 0.90, 100, 1),
(25, 6, 25, 'Green Glow Smoothie', 'Spinach, pineapple, cucumber, and coconut water.', 3.50, 120, 1),
(26, 6, 26, 'Iced Matcha Latte', 'Lightly sweetened matcha green tea with almond milk.', 3.00, 90, 1),
(27, 6, 27, 'Fruit-Infused Water', 'Freshly infused water with a choice of lemon-mint, strawberry-basil, or cucumber-lime.', 1.50, 0, 1),
(28, 6, 28, 'Berry Blast Smoothie', 'A creamy blend of strawberries, blueberries, and raspberries with almond milk.', 3.80, 140, 1),
(29, 6, 29, 'Citrus Cooler', 'A refreshing mix of orange juice, sparkling water, and a hint of lime.', 3.00, 90, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_status_id_relation` (`order_status_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `image_id_relation` (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_status_id_relation` FOREIGN KEY (`order_status_id`) REFERENCES `order_status` (`order_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_id_relation` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_id_relation` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categorie_relation` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `image_id_relation` FOREIGN KEY (`image_id`) REFERENCES `images` (`image_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
