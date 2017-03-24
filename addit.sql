-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 24, 2017 at 06:32 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `addit`
--

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'title', 'Addit 0.0.6'),
(2, 'template', 'Default'),
(3, 'url', 'http://localhost/addit/'),
(4, 'language', 'arabic');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(535) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(535) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` int(21) NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `fullname`, `avatar`, `message`, `sex`, `data`) VALUES
(1, 'xlmnxp', 'Salem Yaslim', '', 'مرحبًا بكم', 0, ''),
(2, 'ksa711', 'Saleh Yaslim', '', 'أرحبوا جميعًا كلكم :)', 0, ''),
(3, 'xzx711', 'Abdulaziz Moqbal', '', ':يامرحبا :) في حساب عبد العزيز مقبل ', 0, ''),
(4, 'xdx711', 'Naif', '', 'مرحبًا بكم كم احبكم\r\nتابعوني ارجوكم :)', 0, ''),
(5, 'Saeed', 'Saeed', '', 'ياهلا وسهلا', 0, ''),
(6, 'yos1818', 'سعودي قوي', 'https://pbs.twimg.com/profile_images/823982936894611456/Gf8jp-YM_400x400.jpg', 'سناب سعودي قوي وعزازي ابو حريقة ', 0, ''),
(7, 'albron', 'تم سالم', 'http://localhost/addit/Uploads/e90b113e5fda56d672b9263af0c8da9d.png', 'مرحبًا بكم', 0, '[{\"category\":\"2\",\"country\":\"3\"}]'),
(8, 'dasdasd', 'dasdasda', 'http://localhost/addit/Uploads/b8ea012dbc3393a95f4625842ea70721.png', 'dasdasdasdasd', 0, '[{\"category\":\"4\",\"country\":\"4\"}]'),
(9, 'albronwwq', 'ewqeqwewqeqweqweqweq', 'Uploads/d03cabb32543a76d8f6488be3cd7518f.png', 'eqweqweqweqweq', 0, '[{\"category\":\"5\",\"country\":\"5\"}]'),
(10, 'ksa711[2]', 'sdasdda', 'Uploads/8e29fec442b66000a91e1edbebe912bc.jpg', 'صالح اثنين', 0, '[{\"category\":\"2\",\"country\":\"4\"}]'),
(11, '\'.echo\"hello world\".\'', 'XSS', 'Uploads/a6c222296a161f7c862d95851c7c6a84.png', 'XSS Inject', 0, '[{\"category\":\"1\",\"country\":\"1\"}]'),
(12, 'امبمبمملم', 'ظلظىظقمقمق', 'http://localhost/addit/Uploads/bd2da74fe73dd597d446fa8e0f853ce9.jpg', 'ببينميخيهب', 0, '[{\"category\":\"2\",\"country\":\"2\"}]'),
(13, 'لظبمبمكبمى', 'اظلظبظبظق', 'http://localhost/addit/Uploads/9ff1f8e9da0d58f4b56d3b0de1a53c35.jpg', 'رظبحيمميبممب', 0, '[{\"category\":\"1\",\"country\":\"1\"}]');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
