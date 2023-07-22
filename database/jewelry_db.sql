-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 10:15 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jewelry_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `colour_id` int(30) NOT NULL,
  `size_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `price` float NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `colour_id`, `size_id`, `qty`, `price`, `ip_address`, `date_created`) VALUES
(4, 2, 2, 1, 2, 1, 3500, '', '2020-11-12 17:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `date_created`) VALUES
(1, 'Rings', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque eget ante eu laoreet. Duis a rutrum eros. Duis maximus varius ipsum eu maximus. Proin et feugiat felis, non sodales erat. Nunc porta diam sit amet diam tincidunt, eleifend volutpat erat tristique. Integer vitae ex nec dolor tempus rutrum vel sed nulla. Nam elit enim, placerat vel lectus quis, facilisis sollicitudin velit. Vivamus blandit lectus vitae libero facilisis, vitae bibendum arcu consequat. Duis viverra interdum molestie. Vivamus mattis auctor velit.</span>															', '0000-00-00 00:00:00'),
(2, 'Necklace', '<span style=\"color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Duis quis felis sit amet odio convallis ullamcorper vel sed eros. Donec leo magna, tincidunt non ipsum quis, semper convallis eros. Nam et lectus vitae est mollis facilisis sit amet vitae metus. Aliquam sagittis ligula non vulputate consequat. Pellentesque non eleifend dolor, ac facilisis velit. Aenean pulvinar eget lorem et dictum. Nulla et sollicitudin eros. Donec eu tortor ac nibh tincidunt gravida id in nisl. Nam auctor ultrices justo et fermentum. Quisque quis risus libero. Aliquam porttitor ante vel sem fringilla suscipit. Nulla ac tempus velit. Sed laoreet vestibulum rutrum. Proin tellus erat, fermentum imperdiet feugiat non, vestibulum at velit. Proin orci lectus, mattis vel ultricies id, iaculis et nunc.</span>															', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `colours`
--

CREATE TABLE `colours` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `color` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colours`
--

INSERT INTO `colours` (`id`, `product_id`, `color`, `date_created`) VALUES
(1, 2, 'Silver', '2020-11-12 13:00:31'),
(2, 2, 'Gold', '2020-11-12 13:00:31'),
(3, 3, '', '2020-11-12 13:36:42'),
(4, 4, 'Silver', '2020-11-12 13:49:10'),
(5, 5, '', '2020-11-12 13:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(30) NOT NULL,
  `ref_id` varchar(200) NOT NULL,
  `user_id` int(30) NOT NULL,
  `delivery_address` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ref_id`, `user_id`, `delivery_address`, `status`, `date_created`) VALUES
(1, 'assferetdg', 2, 'Sample Address', 1, '2020-11-12 15:42:24'),
(2, 'xGglucIwb4tL7vWm', 2, 'Sample Address', 3, '2020-11-12 15:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(30) NOT NULL,
  `order_id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `colour_id` int(30) NOT NULL,
  `size_id` int(30) NOT NULL,
  `qty` int(30) NOT NULL,
  `price` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `colour_id`, `size_id`, `qty`, `price`, `date_created`) VALUES
(1, 1, 4, 4, 6, 2, 1500, '2020-11-12 15:42:24'),
(2, 1, 4, 4, 7, 2, 1500, '2020-11-12 15:42:24'),
(3, 2, 2, 1, 4, 2, 3500, '2020-11-12 15:56:33');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `item_code` varchar(200) NOT NULL,
  `price` float NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `item_code`, `price`, `date_created`) VALUES
(2, 1, 'Sample Prod', '								&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur scelerisque eget ante eu laoreet. Duis a rutrum eros. Duis maximus varius ipsum eu maximus. Proin et feugiat felis, non sodales erat. Nunc porta diam sit amet diam tincidunt, eleifend volutpat erat tristique. Integer vitae ex nec dolor tempus rutrum vel sed nulla. Nam elit enim, placerat vel lectus quis, facilisis sollicitudin velit. Vivamus blandit lectus vitae libero facilisis, vitae bibendum arcu consequat. Duis viverra interdum molestie. Vivamus mattis auctor velit.&lt;/p&gt;&lt;p style=&quot;margin-right: 0px; margin-bottom: 15px; margin-left: 0px; padding: 0px; text-align: justify; color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px;&quot;&gt;Duis quis felis sit amet odio convallis ullamcorper vel sed eros. Donec leo magna, tincidunt non ipsum quis, semper convallis eros. Nam et lectus vitae est mollis facilisis sit amet vitae metus. Aliquam sagittis ligula non vulputate consequat. Pellentesque non eleifend dolor, ac facilisis velit. Aenean pulvinar eget lorem et dictum. Nulla et sollicitudin eros. Donec eu tortor ac nibh tincidunt gravida id in nisl. Nam auctor ultrices justo et fermentum. Quisque quis risus libero. Aliquam porttitor ante vel sem fringilla suscipit. Nulla ac tempus velit. Sed laoreet vestibulum rutrum. Proin tellus erat, fermentum imperdiet feugiat non, vestibulum at velit. Proin orci lectus, mattis vel ultricies id, iaculis et nunc.&lt;/p&gt;																						', 'JCSMmyV453K7xEg9', 3500, '2020-11-12 12:13:24'),
(3, 2, 'Necklace 1', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Aliquam consequat non tortor sed placerat. Mauris pulvinar suscipit est at tempor. Curabitur tempor ornare mauris, vitae sagittis massa congue ac. Nulla nisl ante, convallis at metus non, laoreet feugiat nisi. Proin rutrum lorem ut interdum suscipit. Sed ultrices nec magna eget rutrum. Nunc aliquam mauris vitae accumsan pulvinar. Nullam lorem neque, auctor in nisl vel, accumsan ultrices sapien. Morbi porta, ante at placerat eleifend, risus tellus consequat nisi, quis euismod ipsum ligula ac elit. Ut auctor nulla at sem blandit eleifend. Sed mollis auctor varius. Fusce tristique nibh quis orci sagittis viverra. Nullam consequat vestibulum volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dapibus fermentum nulla et ultricies.&lt;/span&gt;															', 'b9qSY10cfy7uPmI6', 3500, '2020-11-12 13:36:42'),
(4, 1, 'R1', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Aliquam consequat non tortor sed placerat. Mauris pulvinar suscipit est at tempor. Curabitur tempor ornare mauris, vitae sagittis massa congue ac. Nulla nisl ante, convallis at metus non, laoreet feugiat nisi. Proin rutrum lorem ut interdum suscipit. Sed ultrices nec magna eget rutrum. Nunc aliquam mauris vitae accumsan pulvinar. Nullam lorem neque, auctor in nisl vel, accumsan ultrices sapien. Morbi porta, ante at placerat eleifend, risus tellus consequat nisi, quis euismod ipsum ligula ac elit. Ut auctor nulla at sem blandit eleifend. Sed mollis auctor varius. Fusce tristique nibh quis orci sagittis viverra. Nullam consequat vestibulum volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dapibus fermentum nulla et ultricies.&lt;/span&gt;															', 'NoHid3pArPCSqTEk', 1500, '2020-11-12 13:49:10'),
(5, 2, 'n2', '&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-size: 14px; text-align: justify;&quot;&gt;Aliquam consequat non tortor sed placerat. Mauris pulvinar suscipit est at tempor. Curabitur tempor ornare mauris, vitae sagittis massa congue ac. Nulla nisl ante, convallis at metus non, laoreet feugiat nisi. Proin rutrum lorem ut interdum suscipit. Sed ultrices nec magna eget rutrum. Nunc aliquam mauris vitae accumsan pulvinar. Nullam lorem neque, auctor in nisl vel, accumsan ultrices sapien. Morbi porta, ante at placerat eleifend, risus tellus consequat nisi, quis euismod ipsum ligula ac elit. Ut auctor nulla at sem blandit eleifend. Sed mollis auctor varius. Fusce tristique nibh quis orci sagittis viverra. Nullam consequat vestibulum volutpat. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nulla dapibus fermentum nulla et ultricies.&lt;/span&gt;															', '5KygmkTuPLDaHRob', 3500, '2020-11-12 13:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `product_id` int(30) NOT NULL,
  `size` varchar(200) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `product_id`, `size`, `date_created`) VALUES
(2, 2, '5 (.62\"/1.57cm)', '2020-11-12 12:13:24'),
(3, 2, '6 (.65\"/1.65cm)', '2020-11-12 12:13:24'),
(4, 2, '7 (.98\"/1.73cm)', '2020-11-12 12:13:24'),
(5, 3, '', '2020-11-12 13:36:42'),
(6, 4, '5 (.62\"/1.57cm)', '2020-11-12 13:49:10'),
(7, 4, '7 (.98\"/1.73cm)', '2020-11-12 13:49:10'),
(8, 5, '', '2020-11-12 13:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Admin,2= users',
  `avatar` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `middlename`, `contact`, `address`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(1, 'Admin', 'Admin', '', '+12354654787', 'Sample', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, '', '2020-11-11 15:35:19'),
(2, 'Claire', 'Blake', '', '+12345687', 'Sample Address', 'cblake@sample.com', '9de07aee42012876a462e2dc739ffcc5', 2, '', '2020-11-12 14:45:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colours`
--
ALTER TABLE `colours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `colours`
--
ALTER TABLE `colours`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
