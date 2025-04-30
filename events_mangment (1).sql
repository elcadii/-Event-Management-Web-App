-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 10:56 AM
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
-- Database: `events_mangment`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Theatre'),
(2, 'Cinema'),
(3, 'Music');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `evente`
--

CREATE TABLE `evente` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(50) DEFAULT NULL,
  `event_salle_quantity` int(11) DEFAULT NULL,
  `event_description` varchar(50) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `event_image` varchar(225) DEFAULT NULL,
  `salle_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `normal_tarif` int(11) DEFAULT NULL,
  `spicail_tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `evente`
--

INSERT INTO `evente` (`event_id`, `event_name`, `event_salle_quantity`, `event_description`, `start_date`, `event_image`, `salle_id`, `category_id`, `normal_tarif`, `spicail_tarif`) VALUES
(1, 'Shakespeare Play', 503, 'A classic play by Shakespeare', '2025-04-04 22:00:00', 'events_images/shakespeare_play.jpg', 1, 1, 150, 80),
(2, 'Rock Concert', 19, 'Live rock music event', '2025-04-10 23:00:00', 'events_images/rock_concert.jpg', 2, 3, 130, 60),
(3, 'Comedy Movie', 0, 'A fun comedy film', '2025-04-15 20:00:00', 'events_images/comedy_movie.jpg', 3, 2, 100, 50),
(4, 'Jazz Night', 0, 'A smooth jazz night with live performances', '2025-05-01 23:00:00', 'events_images/jazz_night.jpg', 3, 3, 200, 100);

-- --------------------------------------------------------

--
-- Table structure for table `resrvtion`
--

CREATE TABLE `resrvtion` (
  `resrve_id` int(11) NOT NULL,
  `date_now` datetime DEFAULT NULL,
  `event_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `normal_tarif` int(11) DEFAULT NULL,
  `spicail_tarif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resrvtion`
--

INSERT INTO `resrvtion` (`resrve_id`, `date_now`, `event_id`, `user_id`, `normal_tarif`, `spicail_tarif`) VALUES
(198, '2025-04-28 00:07:23', 3, 20, 1, 1),
(199, '2025-04-28 00:08:34', 3, 20, 1, 1),
(200, '2025-04-28 00:11:35', 3, 20, 1, 1),
(201, '2025-04-28 00:12:15', 3, 20, 1, 1),
(202, '2025-04-28 00:12:30', 3, 20, 1, 1),
(203, '2025-04-28 00:20:43', 3, 20, 1, 1),
(204, '2025-04-28 00:20:56', 3, 20, 1, 1),
(205, '2025-04-28 00:47:57', 3, 20, 1, 2),
(206, '2025-04-28 12:42:26', 3, 20, 1, 0),
(207, '2025-04-28 12:42:27', 3, 20, 1, 0),
(208, '2025-04-30 10:50:53', 3, 20, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `salle_id` int(11) NOT NULL,
  `salle_quentity` int(11) DEFAULT NULL,
  `salle_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`salle_id`, `salle_quentity`, `salle_name`) VALUES
(1, 600, 'Salle A'),
(2, 300, 'Salle B'),
(3, 150, 'Salle C');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(11) NOT NULL,
  `reserve_id` int(11) NOT NULL,
  `ticket_code` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `reserve_id`, `ticket_code`, `created_at`) VALUES
(47, 208, 'TKT-6811e46d99cdf', '2025-04-30 08:50:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `password`, `email`) VALUES
(12, 'sami', 'belhadj', '$2y$10$i0rO4xOeLzQwHpGiwnQnnuLNfy/8bl/wXUv0xfG0AaiF55ERHhZqC', 'sami@gmail.com'),
(14, 'mohammad', 'elcadi', '$2y$10$shnRc5bavTol.Vp4vM87oOw5DEHSpX9/J7dJ6JBA0HuTDHy1lgXLG', 'MOHAMMAD@gmail.com'),
(15, 'adam', 'moha', '$2y$10$Aoz86eSfkFyNBJV9uS025Oz6o3GHklb5Q0NgzHwLpVpveQ/ouvWTy', 'adam@gmail.com'),
(16, 'jawad', 'mustafa', '$2y$10$Y6gro9JcYptWUVe.EfmPE.J2x0tdPsYcYw0RJprLVFyoCBWPeS.I2', 'jawad@gmail.com'),
(17, 'omar', 'lantit', '$2y$10$W2pG5C9UzBR7z9tdHbfezem7177cwZ1QwQHKYuw36i7Up7wIFvYDK', 'lantit@gmail.com'),
(18, 'hicham', 'benala', '$2y$10$gut9hiNzjCU/osN1H7VEROpAOLqLwD5gOgNkoIxXitymsW/4HKysm', 'hicham@gmail.com'),
(19, 'saad', 'talhi', '$2y$10$Osfr8l2d.NhGicf9Oh4h1u2tLUFjnKYtjttS29gMG42qYaRi1FPn.', 'talhi@gmail.com'),
(20, 'mohammad', 'elcadi', '$2y$10$kkjJsRzSR9lmwnb1BHCs6unLJxBfnP3nMo0RbxLORv1lEI3GzsVtu', 'adamx@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evente`
--
ALTER TABLE `evente`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `salle_id` (`salle_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `resrvtion`
--
ALTER TABLE `resrvtion`
  ADD PRIMARY KEY (`resrve_id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`salle_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evente`
--
ALTER TABLE `evente`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `resrvtion`
--
ALTER TABLE `resrvtion`
  MODIFY `resrve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;

--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
  MODIFY `salle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `evente`
--
ALTER TABLE `evente`
  ADD CONSTRAINT `evente_ibfk_1` FOREIGN KEY (`salle_id`) REFERENCES `salle` (`salle_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `evente_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `resrvtion`
--
ALTER TABLE `resrvtion`
  ADD CONSTRAINT `resrvtion_ibfk_1` FOREIGN KEY (`event_id`) REFERENCES `evente` (`event_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resrvtion_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
