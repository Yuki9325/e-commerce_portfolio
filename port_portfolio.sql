-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 23, 2019 at 03:59 AM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_status` varchar(10) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `user_id`, `cart_status`) VALUES
(32, 2, 'closed'),
(34, 2, 'closed'),
(35, 2, 'closed'),
(37, 2, 'closed'),
(38, 2, 'closed'),
(39, 7, 'available'),
(40, 2, 'closed'),
(41, 2, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `cartitem_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `cartitem_qty` int(100) NOT NULL,
  `cartitem_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`cartitem_id`, `cart_id`, `user_id`, `item_id`, `cartitem_qty`, `cartitem_price`) VALUES
(65, 35, 2, 32, 2, 1000),
(78, 37, 2, 32, 5, 2500),
(80, 38, 2, 29, 4, 6400),
(81, 38, 2, 29, 3, 4800),
(84, 39, 7, 31, 6, 6000),
(85, 40, 2, 40, 10, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `cat_name`, `cat_status`) VALUES
(2, 'A', 'D'),
(3, 'Stationaries', 'A'),
(4, 'Others', 'A'),
(5, 'Cosmetics', 'A'),
(6, 'iPhone Cases', 'A'),
(7, 'Apparel', 'A'),
(8, 'Books', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `checkout_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `ua_id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `purchased_price` float NOT NULL,
  `purchased_date` date DEFAULT NULL,
  `shipped_date` date DEFAULT NULL,
  `checkout_status` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`checkout_id`, `cart_id`, `ua_id`, `payment_id`, `purchased_price`, `purchased_date`, `shipped_date`, `checkout_status`) VALUES
(46, 35, 2, 4, 1900, '2019-08-22', NULL, 'confirmed'),
(47, 35, 2, 4, 1700, '2019-08-22', NULL, 'confirmed'),
(48, 35, 2, 2, 1900, '2019-08-22', '2019-08-22', 'pending'),
(49, 37, 2, 2, 6900, '2019-08-22', NULL, 'pending'),
(50, 38, 2, 4, 11600, '2019-08-22', '2019-08-23', 'shipped'),
(51, 40, 2, 2, 30400, '2019-08-23', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `credit_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `credit_f_name` varchar(50) NOT NULL,
  `credit_l_name` varchar(50) NOT NULL,
  `credit_c_number` int(16) NOT NULL,
  `credit_exp_month` int(2) NOT NULL,
  `credit_exp_year` int(2) NOT NULL,
  `credit_security` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credit_cards`
--

INSERT INTO `credit_cards` (`credit_id`, `user_id`, `credit_f_name`, `credit_l_name`, `credit_c_number`, `credit_exp_month`, `credit_exp_year`, `credit_security`) VALUES
(16, 2, 'qwe', 'qwe', 12345678, 8, 2019, 123),
(17, 2, 'qwe', 'qwe', 123456789, 8, 2019, 123);

-- --------------------------------------------------------

--
-- Table structure for table `fav_lists`
--

CREATE TABLE `fav_lists` (
  `fav_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `fav_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fav_lists`
--

INSERT INTO `fav_lists` (`fav_id`, `user_id`, `item_id`, `fav_status`) VALUES
(26, 7, 40, 'A'),
(28, 2, 35, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `item_photo` varchar(100) DEFAULT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_qty` int(100) NOT NULL,
  `item_price` float NOT NULL,
  `item_description` text,
  `item_status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `category_id`, `item_photo`, `item_name`, `item_qty`, `item_price`, `item_description`, `item_status`) VALUES
(29, 8, 'images/1.jpg', 'Illustration Book', 3, 1600, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(30, 3, 'images/13.jpg', 'Shipping Girl Post Card', 8, 300, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(31, 7, 'images/5.jpg', 'Hand Bag', 6, 1000, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(32, 3, 'images/14.jpg', 'Post Card', 1, 500, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(33, 3, 'images/26.jpg', 'Sticker Set', 10, 800, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(35, 8, 'images/3.jpg', '2019 Schedule Book', 10, 2000, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(36, 3, 'images/22.jpg', 'Death God Sticker', 10, 500, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(37, 6, 'images/27.jpg', 'Doll iPhone Case', 20, 4000, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(38, 3, 'images/10.jpg', 'Fridge Post Card', 10, 500, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(39, 3, 'images/15.jpg', 'Pink Plastic File Folder', 10, 700, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(40, 6, 'images/24.jpg', 'Goth Girl iPhone Case', 0, 3000, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'A'),
(41, 3, 'images/8.jpg', 'Hi', 20, 700, 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Fugit, sed incidunt? Odio earum corrupti eaque consequuntur at excepturi praesentium quos. Illo excepturi nulla vitae, nihil quasi iure? Dolore, odio quod?\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Magnam corrupti, dolore nihil aspernatur debitis unde eum reprehenderit totam asperiores esse cum earum excepturi eaque beatae et rem ut. Voluptas, ea!\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Repellat hic quia reiciendis recusandae voluptatem! Doloribus optio ullam voluptates sint consequuntur perferendis earum dolorum error rem, assumenda, libero quisquam itaque deserunt!', 'D'),
(42, 5, 'images/11.jpg', 'Hello', 10, 1000, 'hello', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_name`) VALUES
(2, 'Bank Transfer'),
(4, 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_photo` varchar(100) DEFAULT NULL,
  `permission` text NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `profile_photo`, `permission`, `status`) VALUES
(1, 'a', 'a', 'a@gmail.com', '0cc175b9c0f1b6a831c399e269772661', NULL, 'admin', 'A'),
(2, 'i', 'i', 'b@gmail.com', '92eb5ffee6ae2fec3ad71c777531578f', 'images/11.jpg', 'user', 'A'),
(3, 'c', 'c', 'c@gmail.com', '4a8a08f09d37b73795649038408b5f33', 'images/jenny_footer.jpg', 'user', 'D'),
(4, 'd', 'd', 'd@gmail.com', '8277e0910d750195b448797616e091ad', NULL, 'user', 'A'),
(5, 'e', 'e', 'e@gmail.com', 'e1671797c52e15f763380b45e841ec32', 'images/jojowallpaper.jpg', 'user', 'D'),
(6, 'f', 'f', 'f@gmail.com', '8fa14cdd754f91cc6554c9e71929cce7', NULL, 'user', 'A'),
(7, 'g', 'g', 'g@gmail.com', 'b2f5ff47436671b6e533d8dc3614845d', '', 'user', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `ua_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ua_phone_number` varchar(50) DEFAULT NULL,
  `ua_zip` varchar(10) DEFAULT NULL,
  `ua_address` varchar(100) DEFAULT NULL,
  `ua_city` varchar(100) DEFAULT NULL,
  `ua_prefecture` varchar(100) DEFAULT NULL,
  `ua_area` varchar(100) DEFAULT NULL,
  `ua_status` varchar(10) DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`ua_id`, `user_id`, `ua_phone_number`, `ua_zip`, `ua_address`, `ua_city`, `ua_prefecture`, `ua_area`, `ua_status`) VALUES
(2, 2, '222-2222-2222', '000-0000', 'b', 'b', 'Tokyo', 'Honsyu', 'default'),
(3, 3, '333-333-3333', '000-0000', '1-11, Unomori', 'c', 'Naha', 'Okinawa', 'delete'),
(4, 4, '000-000-0000', '22', '3', 'f', NULL, 'd', 'default'),
(6, 5, '222-2222-222222222', 'dd', '090-093309-7777', 'dhgfd', NULL, 'd', 'delete'),
(7, 7, '000-0000', 'Honsyu', '000-0000', '12-2, Hello', 'World', 'Honsyu', 'default'),
(12, 6, '', '', '', '', '', '', 'default');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`cartitem_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`checkout_id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`credit_id`);

--
-- Indexes for table `fav_lists`
--
ALTER TABLE `fav_lists`
  ADD PRIMARY KEY (`fav_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`ua_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `cartitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `credit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `fav_lists`
--
ALTER TABLE `fav_lists`
  MODIFY `fav_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `ua_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
