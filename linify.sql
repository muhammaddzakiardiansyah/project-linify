-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2024 at 01:03 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `linify`
--

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `id` int NOT NULL,
  `original_url` varchar(250) NOT NULL,
  `short_url` varchar(250) NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`id`, `original_url`, `short_url`, `user_id`, `created_at`, `updated_at`) VALUES
(4997810, 'https://www.youtube.com/watch?v=O3BZZNdB0Sk&list=RDjAYviJQYcAo&index=7', 'http://localhost/linify/public/youtube-music', 0, '2024-09-12 00:15:41', '2024-09-12 00:15:41'),
(5616796, 'https://www.youtube.com/watch?v=O3BZZNdB0Sk&list=RDjAYviJQYcAo&index=7', 'http://localhost/linify/public/youtube-gitar', 0, '2024-09-11 06:37:05', '2024-09-11 06:37:05'),
(6581199, 'https://www.youtube.com/watch?v=xRPQT0-4EpM&list=RDxRPQT0-4EpM&start_radio=1', 'anahontalaik', 9362619, '2024-09-12 02:29:36', '2024-09-12 02:29:36'),
(7073658, 'http://localhost/phpmyadmin/index.php?route=/sql&pos=0&db=linify&table=urls', 'http://localhost/linify/public/mysqlku', 0, '2024-09-11 06:40:52', '2024-09-11 06:40:52'),
(8550806, 'j', 'sd', 9362619, '2024-09-12 13:00:42', '2024-09-12 13:00:42'),
(9692218, 'https://stackoverflow.com/questions/2942325/jquery-form-validate-not-allow-space-for-username-field', 'no-space', 9362619, '2024-09-12 04:48:46', '2024-09-12 04:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(4586933, 'muhammaddzaki28', '$argon2i$v=19$m=65536,t=4,p=1$OThPS1ppbTFQMmRXLnFmUA$kDYFV24nodXd5WNZaivvIw/ERodPLPnbiAorw36+NaA', '2024-09-09 06:56:54', '2024-09-09 06:56:54'),
(6676557, 'azmya', '$argon2i$v=19$m=65536,t=4,p=1$NWZlakxDbGFWdGFuVzZKNg$04asR4QnkO2NzEkEK5knccR4HHgvdPpVrdQ+BnUTorY', '2024-09-11 02:23:19', '2024-09-11 02:23:19'),
(9362619, 'anggelika', '$argon2i$v=19$m=65536,t=4,p=1$RU9pLy9ZUkxHUGxJNndRUw$iC6uYfd9QNIx5aSajnkVShCQ009L+9II/fu4gyqyidw', '2024-09-09 04:04:25', '2024-09-09 04:04:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
