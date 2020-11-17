-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2020 at 04:36 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES
(1, 'Bootstrap'),
(2, 'Python'),
(13, 'Love Me'),
(15, 'PHP7');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 1, 'Akbar', 'barstuvwxyz@gmail.com', 'That\'s great!', 'approved', '2020-10-17'),
(4, 1, 'Akbarun', 'barstuvwxyz@gmail.com', 'Hola anjeng', 'approved', '2020-10-17'),
(11, 2, 'akbarun', 'barstuvwxyz@gmail.com', 'Cupu lw', 'approved', '2020-10-17'),
(12, 1, 'Bar', 'barstuvwxyz@gmail.com', 'sensimeter!', 'approved', '2020-10-27'),
(13, 1, 'nanana', 'tydak', 'huhuhu', 'approved', '2020-10-27');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`) VALUES
(4, 5, 19);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) DEFAULT 0,
  `post_likes` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`, `post_likes`) VALUES
(1, 1, 'Mari belajar Python', '5', '2020-10-27', 'image_1.jpg', 'Daddy daddy do ~', 'python, kaguya', 0, 'draft', 2, 0),
(2, 13, 'Mari Belajar HTML, CSS, PHP', '5', '2020-10-27', 'image_5.jpg', 'Pusing gaes\r\nKNP COURSE PHPNYA BNYK BGT', 'php, html, css', 0, 'draft', 0, 0),
(3, 2, 'Greetings', '5', '2020-10-13', 'image_3.jpg', 'Cheers guys\r\nHehe', 'greeting', 0, 'draft', 0, 0),
(6, 1, 'mau nangis', '5', '2020-10-27', '', '<p>anjir</p>', 'tidaaak', 0, 'published', 0, 0),
(7, 1, 'Mari belajar Python', '5', '2020-10-27', 'image_1.jpg', 'Daddy daddy do ~', 'python, kaguya', 0, 'published', 0, 0),
(8, 1, 'mau nangis', '5', '2020-10-27', '', '<p>anjir</p>', 'tidaaak', 0, 'published', 0, 0),
(9, 2, 'Greetings', '5', '2020-10-27', 'image_3.jpg', 'Cheers guys\r\nHehe', 'greeting', 0, 'published', 0, 0),
(10, 13, 'Mari Belajar HTML, CSS, PHP', '5', '2020-10-27', 'image_5.jpg', 'Pusing gaes\r\nKNP COURSE PHPNYA BNYK BGT', 'php, html, css', 0, 'published', 0, 0),
(11, 13, 'Mari Belajar HTML, CSS, PHP', '5', '2020-10-29', 'image_5.jpg', 'Pusing gaes\r\nKNP COURSE PHPNYA BNYK BGT', 'php, html, css', 0, 'published', 1, 0),
(12, 2, 'Greetings', '5', '2020-10-29', 'image_3.jpg', 'Cheers guys\r\nHehe', 'greeting', 0, 'published', 0, 0),
(13, 1, 'mau nangis', '5', '2020-10-29', '', '<p>anjir</p>', 'tidaaak', 0, 'draft', 5, 0),
(14, 1, 'Mari belajar Python', '5', '2020-10-29', 'image_1.jpg', 'Daddy daddy do ~', 'python, kaguya', 0, 'draft', 0, 0),
(15, 1, 'mau nangis', '5', '2020-10-29', '', '<p>anjir</p>', 'tidaaak', 0, 'draft', 1, 0),
(16, 2, 'Greetings', '5', '2020-10-29', 'image_3.jpg', 'Cheers guys\r\nHehe', 'greeting', 0, 'draft', 0, 0),
(18, 1, 'Mari belajar Python', '2', '2020-11-03', 'image_1.jpg', '<p>Daddy daddy do ~</p>', 'python, kaguya', 0, 'draft', 0, 0),
(19, 2, 'Oregairu', '5', '2020-11-05', '', '<h1>Haii</h1><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Hehe</p>', '', 0, 'published', 40, 1),
(20, 13, 'Masih dengan saya', '3', '2020-11-05', '', '<p>Tanjirou san</p><p>Kiminosadiiruuu h</p><p>lorem ipsum dos color sit amet</p>', '', 0, 'published', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `token` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `token`) VALUES
(2, 'barcode', '$2y$10$wWG9ZDEHNWpg0nx0XIuvUesJPnd5GwEig3c5xJ06JAMSbNMn6MCNG', 'Misaka', 'Mikoto', 'misakamikoto@isekai.com', NULL, 'admin', ''),
(3, 'abar', '$2y$10$uczWGU980wTZZT4R43O6AuLvZfAX7vkAWLj0m3qJhhf76TAwddmsa', 'abar', 'maulana', 'manusiayanghidup@gmail.com', NULL, 'admin', NULL),
(4, 'mipan', '$2y$10$rFudzHeReji9m9jWV0bhLuxkDZN/srqwXekQhvIiiyU7tCV6Xz7TS', 'Akbar kun', 'Maulana', 'aakbarmr@outlook.co.id', NULL, 'subscriber', ''),
(5, 'admin', '$2y$10$9VbX24FL2yW6/jlOVUiMf.W.LnAFPk.9CeER0lzb2aY.TgvnkBITu', 'admin', 'admin', 'admin@admin.com', NULL, 'admin', NULL),
(8, 'kaguya', '$2y$10$0i.OTzTZrspT1hs7t0ehjObvSRQgK7VOpJ4xGiU5/X11cj.hxx8BK', 'kaguya', 'shinomiya', 'kaguya@shinomiya.com', NULL, 'subscriber', NULL),
(9, '', '$2y$10$kvghVgoXJVYQgcADgxHxd.BJBpS4L/7iR2Ied/CdHeDWZQJb5vrxO', '', '', '', NULL, 'subscriber', NULL),
(10, 'yahoo', '$2y$10$v20XiLdH/qQi0Swy2/lL..mYTLF.2ITIoZcjl.Lp0iQZt1gbIJzy6', 'yahoo', 'mistah', 'mistah@gmail.com', NULL, 'subscriber', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '0b25932afaf3e7257244516704d28038', 1605583677);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
