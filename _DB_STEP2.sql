-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017 年 12 月 16 日 03:07
-- サーバのバージョン： 5.5.52-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakephp_dev`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `follows`
--

CREATE TABLE `follows` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `followed_userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `follows`
--

INSERT INTO `follows` (`id`, `user_id`, `followed_userid`) VALUES
(4, 8, 5),
(8, 5, 8);

-- --------------------------------------------------------

--
-- テーブルの構造 `tweets`
--

CREATE TABLE `tweets` (
  `tweetid` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tweet` text,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tweets`
--

INSERT INTO `tweets` (`tweetid`, `user_id`, `tweet`, `created_at`) VALUES
(3, 5, 'さらにてすっとー。', '2017-12-15 13:56:31'),
(4, 5, 'あいうえお', '2017-12-15 18:47:56'),
(8, 8, 'test', '2017-12-15 21:11:55');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userid` varchar(20) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `nickname` varchar(30) DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `private` tinyint(1) DEFAULT '0',
  `password` varchar(256) DEFAULT NULL,
  `registered_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `userid`, `name`, `nickname`, `mail`, `private`, `password`, `registered_at`, `modified_at`) VALUES
(5, 'refshiz', 'Hashizo', 'Refshiz', 'shizref@gmail.com', 1, '$2y$10$ETzRXjer70AqNPWvjtODJusVVX0ma/gYNpUfnv2otWAjw0tRQgHZq', '2017-12-14 02:11:22', '2017-12-14 02:11:22'),
(8, '1234', '1234', '1234', '1234', 1, '$2y$10$Vjigiht4YCBrdCkP7/lLZO6lyPkRbyB3oXMLZSvYB8WODXGPc5onO', '2017-12-15 20:25:46', '2017-12-15 21:23:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
  ADD PRIMARY KEY (`tweetid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`) USING BTREE,
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `follows`
--
ALTER TABLE `follows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `tweetid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
