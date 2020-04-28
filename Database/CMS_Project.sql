-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 28, 2020 at 10:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CMS_Project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(7, 'Javascript'),
(27, 'ReactJS'),
(28, 'NodeJS'),
(29, 'Angular 9');

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
  `comment_status` varchar(255) NOT NULL DEFAULT 'draft',
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(37, 93, 'test', 'test@gmail.com', 'Bài viết rất hay', 'unapproved', '2020-04-24'),
(38, 121, 'test123', 'test123@gmail.com', 'Đây là comment 1', 'unapproved', '2020-04-24');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_user` varchar(255) DEFAULT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) DEFAULT NULL,
  `post_comment_count` varchar(255) DEFAULT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_user`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(93, 1, 'admin', 'Post 1', NULL, '2020-04-02', 'image_1.jpg', '<p>PHP for Beginners: learn everything you need to become a professional PHP developer with practical exercises &amp; projects.</p>', 'Post 1, Bootstrap', '0', 'publish', 7),
(94, 7, 'admin', 'Post 2', NULL, '2020-04-02', 'image_2.jpg', '<p><strong>Are you new to PHP or need a refresher?</strong> Then this course will help you get all the fundamentals of Procedural PHP, Object Oriented PHP, MYSQLi and ending the course by building a CMS system similar to WordPress, Joomla or Drupal.</p>', 'Post 2, Javascript', '0', 'publish', 1),
(120, 1, 'admin', 'Post 3', NULL, '2020-04-24', 'image_3.jpg', '<p>Đây là bài post 3&nbsp;</p>', 'Post 3, Bootstrap', '0', 'publish', 0),
(121, 27, 'admin', 'Post 4', NULL, '2020-04-24', 'image_4.jpg', '<p>HTML,CSS, Javasctipt, ReactJS</p><p>&nbsp;</p>', 'Post 4', '0', 'publish', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text DEFAULT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) DEFAULT '$2y$10$iusesomescrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(11, 'admin', '$2y$10$iusesomescrazystringsuBi2rLk6cyfn7UhPMbLrb4YCbPV33srC', 'Nguyễn', 'Phát', 'thanhphat19@gmail.com', NULL, 'Admin', '$2y$10$iusesomescrazystrings22'),
(22, 'peter', '$2y$12$X81hVRWPkQDFQtWQZnTxOurk5uNER.3qytsHEQXsyH1PK9IlGrS0q', NULL, NULL, 'peter123@gmail.com', NULL, 'Subscriber', '$2y$10$iusesomescrazystrings22'),
(26, 'rico', '$2y$12$MyIyMnnQ4NV0UciKs.YVqeNrru5AzNeEVVZ3XpWYGajXrZKGgvpdy', NULL, NULL, 'rico@gmail.com', NULL, 'Subscriber', '$2y$10$iusesomescrazystrings22'),
(29, 'hhd444', '$2y$12$tkPXVLqYKGJ1Hnd2YLsVZOJ4PezKwGkSQdUal2TLWx7QsZDGrbuJe', NULL, NULL, 'hhd@gmail.com', NULL, 'Subscriber', '$2y$10$iusesomescrazystrings22');

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
(1, 'eef50002fdfc4c8a1d35bdc8e65f41b9', 1584113952),
(2, '66858b7cb19b73616245e5dd8aa34c85', 1584110634),
(3, '9d5eb74bd6a6ec1c770533fa9e55726d', 1584110628),
(4, '8f508cdbdc7aca8f1044a63125021418', 1584200112),
(5, '9c689c17e5056fbba7d5f3582d390dbd', 1584110858),
(6, 'ebce76c812cdc1e11b2b5e5531eac2a5', 1584110721),
(7, 'f9c21483b11944ce54f9ae99617cb910', 1584110853),
(8, '77c22334c11a1c14157ee0b1e3386b39', 1584110922),
(9, 'e60b60f8023ac048ad822c0f37b7f727', 1584110934),
(10, '3d26e1d9537b98db63304ea88d30fbe3', 1584111107),
(11, 'b17ed94708a7fa5906c152e5f4f55233', 1584113470),
(12, 'dfc32dd2efe21ecde2e78c8a8a0c461f', 1584113914),
(13, '9fb4300f892ac2610e198cca98a20900', 1584113883),
(14, 'bcc45750c4b2a243035495abda4ba357', 1584113883),
(15, 'bce0c826516456e0f89ad1ae0ac96d38', 1584113918),
(16, 'f491c47f88d18914620e38b8c3b94e59', 1584185706),
(17, '0c8733adf6d1b6452b6a0040a8034c94', 1584199928),
(18, 'faf17bcf097e5bfd15404f9990b1f4e5', 1584200328),
(19, '385e79268cbe470f23791e34ee35b776', 1584200052),
(20, 'c8cda099cad3a91df3fc6dd2625fb9e2', 1584200210),
(21, '8099a0460e46ce4c93a9dcd16072162f', 1584278864),
(22, '50a935ad0a5cc8fe8c183352e357f40e', 1584277211),
(23, 'd081cd6ada72a233a347cb8aaa756ee1', 1584354591),
(24, 'b1d92aae1f3c4d9aa1c34e453f13fd71', 1584353642),
(25, 'ae570e78f4ad66e73478120fe3241932', 1584372101),
(26, '7fe96269373aea0e65424f078f3504e2', 1584421481),
(27, '0db5774bb78fa918f52616b48b0862d5', 1584451668),
(28, 'fde9b015a63abe138269dc53a9daa5b1', 1584430200),
(29, 'b0145f7833cd37cf6d1b277312d184b3', 1584457798),
(30, '9a1b436ba9519a7ee5895e3a92de878f', 1584593490),
(31, '05cb1f4884bd9126fd598993ad6e594e', 1584633235),
(32, '0b960e124057f74feccbaac75f3cd284', 1584634555),
(33, 'e3dcd652e9cd6b24a90192832355b069', 1584705440),
(34, 'ceb740dd25c9c41dd33f822b56606e0c', 1584783644),
(35, '0ff6382dc67b00f2c91dcc3a1113d2c0', 1584789861),
(36, '1d3443528638c343220de2ca96e86aa8', 1584949716),
(37, 'ac2ff480534042e3bde88bb1ee336e89', 1584969786),
(38, 'b479a3b1b9fbec46ac714c3c96d01d31', 1584963133),
(39, 'd4a9b66b4aa5f3ccc071099163e07e80', 1585024841),
(40, 'f2b5336208e9c6f2eb955f264fd2149b', 1585031581),
(41, 'cabff5f4d0491891e1f07b328d52153e', 1585035653),
(42, 'df89a93122cb7dba99dccd715db5e8c8', 1585035804),
(43, 'f2277645fe6cc7ce12d40ac816f83b61', 1585035831),
(44, '946bc9ecdd6dd0544c50b9544279d8cd', 1585051703),
(45, '818d7b33e5ffca3b6ad32068a91b0678', 1585239142),
(46, 'c220f7c0d12888d887f00d822d55d25d', 1585326771),
(47, '615ae2b189f7d1e523a40c441255c56c', 1585384090),
(48, 'd067ec093d14bf287b0f496d4895060e', 1585409845),
(49, 'af51c0cabeae0fb4af0f46eaddb0c497', 1585499647),
(50, '54fc714a82f5ee2c29bd2874a8069e26', 1585584742),
(51, '70ad522dc5c0dc15346410f5fa399167', 1585670643),
(52, 'c72462ba66739a204e828dcef8df17c2', 1585672580),
(53, '7d3ff02fe23cc18b67825795540307d3', 1585755831),
(54, '0233644e87d88ec0b5eae83329d299a1', 1585807216),
(55, '644edc7fab1bc52b4cd7c4b296f9262f', 1585835512),
(56, '4e7f38dc68989d6f9568b8a89ad88206', 1585892399),
(57, '27ddb53b36670a834fab628a2c441968', 1585901114),
(58, '9968abfa964e987e5008e3910ba1a7d7', 1585931261),
(59, '11b6e31c5cc7337f5c0d8410acbc437b', 1585996812),
(60, 'c554cc446cdffa540b411ddbf673b307', 1586017480),
(61, '0ce8eb3305f1adf908f4eebea6c908d0', 1586101999),
(62, 'adcd4783cbdd4ad26c6667af18ea2c98', 1586233504),
(63, '247ae35fe66a3743bc95d697e3cc8c56', 1587701956),
(64, '923d9a978d75becb1db8ffcbf0361c05', 1587701888),
(65, 'b1663b7ed345fd8f898e2f71eacd4a89', 1587702765),
(66, 'cdf8323ea25eb48ba084e5c93d3d279c', 1587702660);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
