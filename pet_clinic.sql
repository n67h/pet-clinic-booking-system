-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2024 at 10:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pet_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pet_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `user_id`, `pet_id`, `service_id`, `date`, `timeslot`, `status`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 5, 2, 11, '2023-05-09', '4:00PM - 5:00PM', 2, 0, '2023-05-08 09:38:57', '2023-05-14 14:15:24'),
(2, 5, 4, 1, '2023-05-10', '2:00PM - 3:00PM', 1, 1, '2023-04-08 09:41:37', '2023-05-09 07:27:25'),
(3, 10, 5, 2, '2023-04-25', '1:00PM - 2:00PM', 1, 0, '2023-04-08 18:42:52', '2023-05-08 18:51:45'),
(4, 10, 6, 11, '2023-04-24', '1:00PM - 2:00PM', 1, 0, '2023-04-08 18:48:29', '2023-05-08 18:51:36'),
(5, 10, 5, 1, '2023-05-15', '11:00AM - 12:00PM', 0, 0, '2023-05-08 18:56:22', '2023-05-08 18:56:22'),
(6, 10, 5, 2, '2023-01-02', '10:00AM - 11:00AM', 0, 0, '2023-05-08 18:56:42', '2023-05-08 19:13:18'),
(7, 10, 5, 2, '2023-01-13', '10:00AM - 11:00AM', 0, 0, '2023-05-08 18:56:51', '2023-05-08 19:13:28'),
(8, 10, 5, 1, '2023-01-14', '10:00AM - 11:00AM', 0, 0, '2023-05-08 18:56:59', '2023-05-08 19:13:36'),
(9, 10, 5, 2, '2022-07-14', '9:00AM - 10:00AM', 0, 0, '2023-05-08 18:57:08', '2023-05-08 19:00:55'),
(10, 10, 5, 2, '2022-06-03', '9:00AM - 10:00AM', 0, 0, '2023-05-08 19:00:27', '2023-05-08 19:03:25'),
(11, 10, 5, 1, '2022-06-12', '9:00AM - 10:00AM', 0, 0, '2023-05-08 19:00:27', '2023-05-08 19:03:17'),
(12, 10, 5, 1, '2022-06-01', '9:00AM - 10:00AM', 0, 0, '2023-05-08 19:00:27', '2023-05-08 19:00:27'),
(13, 10, 5, 2, '2022-05-10', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(14, 10, 5, 2, '2022-08-18', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(15, 10, 5, 2, '2022-08-19', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(16, 10, 5, 2, '2022-09-11', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(17, 10, 5, 2, '2022-09-28', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(18, 10, 5, 2, '2022-09-26', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(19, 10, 5, 2, '2022-09-27', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(20, 10, 5, 2, '2022-09-29', '10:00AM - 11:00AM\r\n', 0, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(21, 10, 5, 2, '2022-09-29', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(22, 10, 5, 2, '2022-09-30', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(23, 10, 5, 2, '2022-11-16', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(24, 10, 5, 2, '2022-11-17', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(25, 10, 5, 2, '2022-11-22', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(26, 10, 5, 2, '2022-12-08', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(27, 10, 5, 2, '2023-02-15', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(28, 10, 5, 2, '2023-03-14', '10:00AM - 11:00AM\r\n', 1, 0, '2023-05-08 19:23:54', '2023-05-08 19:23:54'),
(29, 21, 11, 1, '2023-05-11', '10:00AM - 11:00AM', 1, 0, '2023-05-09 04:40:30', '2023-05-09 04:47:50'),
(30, 22, 12, 2, '2023-05-09', '9:00AM - 10:00AM', 2, 0, '2023-05-09 07:13:56', '2023-05-09 07:24:00'),
(31, 22, 12, 1, '2023-05-09', '2:00PM - 3:00PM', 0, 0, '2023-05-09 07:31:54', '2023-05-09 07:31:54'),
(32, 22, 12, 1, '2023-05-09', '8:00AM - 9:00AM', 0, 0, '2023-05-09 07:42:45', '2023-05-09 07:42:45'),
(33, 22, 12, 14, '2023-05-09', '4:00PM - 5:00PM', 0, 0, '2023-05-09 07:43:00', '2023-05-09 07:43:00'),
(34, 22, 12, 1, '2023-05-09', '10:00AM - 11:00AM', 0, 0, '2023-05-09 07:43:17', '2023-05-09 07:43:17'),
(35, 22, 12, 1, '2023-05-09', '11:00AM - 12:00PM', 0, 0, '2023-05-09 07:43:29', '2023-05-09 07:43:29'),
(36, 22, 12, 1, '2023-05-09', '1:00PM - 2:00PM', 0, 0, '2023-05-09 07:43:38', '2023-05-09 07:43:38'),
(37, 22, 12, 1, '2023-05-09', '3:00PM - 4:00PM', 0, 0, '2023-05-09 07:43:45', '2023-05-09 07:43:45');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 'Dogs', 0, '2023-03-10 02:06:09', '2023-05-12 13:17:36'),
(2, 'Cats', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(3, 'Rabbits', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(4, 'Hamsters', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(5, 'Dolphins', 0, '2023-03-10 02:17:15', '2023-05-12 13:21:54'),
(6, 'Unicorns', 0, '2023-03-10 02:17:30', '2023-05-12 13:21:57'),
(7, 'Komodo dragons', 0, '2023-03-10 02:40:40', '2023-05-12 13:21:59'),
(8, 'Dinosaurs', 0, '2023-03-10 02:42:21', '2023-05-12 13:22:01'),
(9, 'Polar bears', 0, '2023-03-10 02:42:25', '2023-05-12 13:22:02'),
(10, 'Penguins', 0, '2023-03-10 02:43:21', '2023-05-12 13:22:04'),
(11, 'Tiger', 0, '2023-05-09 04:46:22', '2023-05-09 04:46:22'),
(12, 'Elephant', 0, '2023-05-09 07:16:31', '2023-05-09 07:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `password_reset_id` int(11) NOT NULL,
  `password_reset_email` text NOT NULL,
  `password_reset_selector` text NOT NULL,
  `password_reset_token` longtext NOT NULL,
  `password_reset_expires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pet`
--

CREATE TABLE `pet` (
  `pet_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `pet_name` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `pet_image` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pet`
--

INSERT INTO `pet` (`pet_id`, `user_id`, `category_id`, `pet_name`, `birthdate`, `gender`, `pet_image`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 5, 1, 'Washing Machine', '2022-12-12', 'Male', '1.jpg', 0, '2023-05-07 10:08:50', '2023-05-08 07:28:32'),
(2, 5, 2, 'Jumong1', '2020-03-12', 'Female', '2.jpg', 0, '2023-05-07 10:16:23', '2023-05-12 13:17:03'),
(3, 5, 1, 'test', '2020-01-31', 'Male', '3.jpg', 1, '2023-05-07 12:20:46', '2023-05-07 13:10:06'),
(4, 5, 1, 'Lycanthrope', '2009-01-01', 'Male', '4.jpg', 0, '2023-05-08 09:41:37', '2023-05-12 13:19:41'),
(5, 10, 1, 'Estes', '2022-12-12', 'Male', '', 0, '2023-05-08 18:42:52', '2023-05-08 18:42:52'),
(6, 10, 1, 'test', '2022-10-20', 'Male', '6.jpg', 0, '2023-05-08 18:48:29', '2023-05-09 03:34:35'),
(7, 10, 1, 'Bogart', '2020-12-12', 'Female', '7.jpg', 0, '2023-05-09 03:33:53', '2023-05-09 03:33:53'),
(8, 5, 4, 'qweqweq', '2000-12-12', 'Male', '8.jpg', 1, '2023-05-09 04:18:28', '2023-05-12 13:19:46'),
(9, 21, 1, 'Testaserer', '2022-12-12', 'Male', '9.jpg', 0, '2023-05-09 04:34:29', '2023-05-09 04:35:58'),
(10, 21, 2, 'test', '1212-12-12', 'Female', '10.png', 1, '2023-05-09 04:35:06', '2023-05-09 04:36:11'),
(11, 21, 1, 'asdasdasasd', '1000-12-12', 'Female', '11.jpg', 0, '2023-05-09 04:36:51', '2023-05-09 04:36:51'),
(12, 22, 1, 'dog', '2023-05-10', 'Male', '', 0, '2023-05-09 07:13:56', '2023-05-09 07:13:56'),
(13, 22, 12, 'elephant', '2022-12-12', 'Male', '13.jpg', 0, '2023-05-09 07:33:15', '2023-05-09 07:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` double(7,2) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `category_id`, `service`, `description`, `price`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 1, 'Anti-rabies', 'Prevents them from acquiring the disease from wildlife, and thereby prevent possible transmission to your family or other people.', 1500.00, 0, '2023-03-10 03:13:46', '2023-05-07 14:50:54'),
(2, 1, 'Check-up', ' A medical examination by your doctor or dentist to make sure that there is nothing wrong with your health.', 1000.00, 0, '2023-03-10 03:36:32', '2023-03-14 02:08:19'),
(3, 2, 'Anti-rabies', 'test', 1400.00, 1, '2023-03-10 03:39:54', '2023-03-14 02:06:29'),
(4, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:40:55', '2023-03-10 04:49:57'),
(5, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:41:05', '2023-03-10 04:49:48'),
(6, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:41:46', '2023-03-10 04:49:45'),
(7, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:42:49', '2023-03-10 04:49:50'),
(8, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:43:24', '2023-03-10 04:49:43'),
(9, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:43:55', '2023-03-10 04:49:24'),
(10, 1, 'Surgery', 'The treatment of injuries or diseases in animals by cutting open the body and removing or repairing the damaged part.', 4000.00, 0, '2023-03-12 02:26:10', '2023-03-14 02:07:37'),
(11, 2, 'Anti-rabies', 'Prevents them from acquiring the disease from wildlife, and thereby prevent possible transmission to your family or other people.', 450.00, 0, '2023-05-06 11:43:55', '2023-05-08 21:34:05'),
(12, 2, 'Vaccinations', 'Cats require certain vaccinations to protect against common feline diseases such as feline leukemia virus and rabies.', 500.00, 0, '2023-05-09 04:08:00', '2023-05-09 04:08:00'),
(13, 1, 'Grooming', 'Prevents them from acquiring the disease from wildlife, and thereby prevent possible transmission to your family or other people.', 10000.00, 0, '2023-05-09 04:47:08', '2023-05-12 13:23:49'),
(14, 1, 'Grooming', 'grooming', 500.00, 1, '2023-05-09 07:15:51', '2023-05-12 13:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `timeslot`
--

CREATE TABLE `timeslot` (
  `timeslot_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `timeslot` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timeslot`
--

INSERT INTO `timeslot` (`timeslot_id`, `service_id`, `timeslot`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 1, '8:00AM - 9:00AM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(2, 1, '9:00AM - 10:00AM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(3, 1, '10:00AM - 11:00AM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(4, 1, '11:00AM - 12:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(5, 1, '1:00PM - 2:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(6, 1, '2:00PM - 3:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(7, 1, '3:00PM - 4:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(8, 1, '4:00PM - 5:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 08:03:13'),
(9, 10, '9:00AM - 12:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 10:33:34'),
(10, 10, '2:00PM - 5:00PM', 0, '2023-03-12 08:03:13', '2023-03-12 10:33:40'),
(11, 2, '8:00AM - 9:00AM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(12, 2, '9:00AM - 10:00AM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(13, 2, '10:00AM - 11:00AM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(14, 2, '11:00AM - 12:00PM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(15, 2, '1:00PM - 2:00PM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(16, 2, '2:00PM - 3:00PM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(17, 2, '3:00PM - 4:00PM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47'),
(18, 2, '4:00PM - 5:00PM', 0, '2023-03-12 10:52:47', '2023-03-12 10:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_role_id` int(11) DEFAULT 2,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verification_key` varchar(255) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role_id`, `username`, `password`, `verification_key`, `is_verified`, `is_deleted`, `last_login`, `date_added`, `last_updated`) VALUES
(1, 1, 'admin', '$2y$10$/ScUXoTER2V4lCZWev2nFOn49mAANnCkpbfMQsRwPGYfx.mIPY.x.', 'N/A', 1, 0, '2023-05-12 13:41:51', '2023-02-10 02:28:53', '2023-05-12 13:41:51'),
(4, 2, 'test1234', '$2y$10$NeXmYy964PSWXXEn6xa1SOUlkUwUw.z6CNO4Qfl.CYINQOmOQjUTO', 'a14b0f101698053dd6b5dec603cc8ca3', 0, 0, '0000-00-00 00:00:00', '2023-02-10 03:19:32', '2023-05-07 14:10:02'),
(5, 2, 'qweqweqwe', '$2y$10$oWuLo99ohwwvsrTHc8yG7OQmcVxlZpBWJguA/d2Ds8IviDermnHwG', '2ea81794f650a2497c62190e91058135', 1, 0, '2023-05-14 02:56:15', '2023-02-14 14:25:48', '2023-05-14 02:56:15'),
(8, 2, 'zxczxczxczxczxczxc', '$2y$10$FMilhbIIs6V7E6pIl4t1FeJ5/0eVllPyqr835gZDmHceTaEuc0J1q', '7f4039e9ea73123975253b84d8820a15', 0, 0, '0000-00-00 00:00:00', '2023-02-19 13:05:08', '2023-02-19 13:05:35'),
(9, 2, 'test_username', '$2y$10$64n/Kka1xmBSfZTn0JrrxOebBT3OKwvKJAiP2sdIc4NMi4gklIWBm', '70e0e8bb3f1e4dc707514a993cbcddc7', 0, 0, '0000-00-00 00:00:00', '2023-03-06 02:56:32', '2023-03-06 02:56:32'),
(10, 2, 'andrepaul123', '$2y$10$.LFv00mUICpH.xMYIRSbTOdQExwLO0f0RrhuD8N1Sx9f4MtrHFK4e', 'db4ab603ede996c0199eec0effce89a5', 1, 0, '2023-05-09 03:33:18', '2023-03-07 03:19:53', '2023-05-09 03:33:18'),
(11, 2, 'staclara123', '$2y$10$uMl2ScVrzOZMXZSzfFboTeNkTksOL5zJpxh0D4hrLd8h8/bcph.BC', 'd49d06c2ca22dca2cdeb221aeb6bbab1', 1, 0, '2023-04-16 06:22:00', '2023-03-14 02:39:52', '2023-04-16 06:22:00'),
(15, 2, 'zxczxczxc321', '$2y$10$rjGxD4SJUXzxz1xDucDeI.Y7EFR3l5Ik19ZJxJuN3iAN8/hXNU/ha', '03d27859ce656d256f8a0a54302c44ba', 0, 0, '0000-00-00 00:00:00', '2023-05-06 11:20:32', '2023-05-06 11:20:32'),
(20, 2, 'andre_test', '$2y$10$Ws3f/rXtmngaax1.AQ2UG.rLUM9VFcx7Lj8nc5HFAoLIyHFD1psOe', '6b1e8fbd22fe40d2039085e11e52da9c', 1, 0, '2023-05-09 04:03:38', '2023-05-08 12:47:54', '2023-05-09 04:03:38'),
(21, 2, 'bogart', '$2y$10$47NuwEHcTH2qjpJAP2S/TOVSS8MOugWGFA3EjWWtlemR6fUk.1uEu', 'f92a50215d1edf2119e5efe9e2d00952', 1, 0, '2023-05-09 04:30:39', '2023-05-09 04:28:35', '2023-05-09 04:37:45'),
(22, 2, 'fanny', '$2y$10$f5OvGUYMrgwUCI4DH8t2feLvczUDOJUVbJ/FnslWNClb64o1Gcr5y', 'cba16f14abc41f1a6de8aaf3e05872ce', 1, 0, '2023-05-09 07:42:11', '2023-05-09 07:08:57', '2023-05-09 07:42:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_info_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'profile-pictures/default.png',
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `user_id`, `email`, `phone_number`, `first_name`, `last_name`, `image`, `is_deleted`, `date_added`, `last_updated`) VALUES
(2, 1, '', '', 'Quimper', 'Parables', 'profile-pictures/default.png', 0, '2023-02-10 03:00:32', '2023-05-08 18:24:38'),
(4, 4, 'johndoe123@gmail.com', '09123456789', 'test test', 'Doe', 'profile-pictures/default.png', 1, '2023-02-10 03:19:32', '2023-05-07 14:03:48'),
(5, 5, 'andrepaul.staclarea67@gmail.com', '09123456789', 'Andre Paul', 'Sta. Clara', '../profile-pictures/5.jpg', 0, '2023-02-14 14:25:48', '2023-05-09 04:18:40'),
(6, 8, 'testzxc@gmail.com', '09123456789', 'zxc test', 'test zxc', 'profile-pictures/default.png', 0, '2023-02-19 13:05:08', '2023-02-19 13:05:08'),
(7, 9, 'testemail123@gmail.com', '09298410728', 'test', 'testtesttest', 'profile-pictures/default.png', 0, '2023-03-06 02:56:33', '2023-05-09 03:55:21'),
(8, 10, 'andrepaul.staclaara67@gmail.com', '09298410728', 'Andre Paul', 'Sta. Clara', 'profile-pictures/default.png', 1, '2023-03-07 03:19:54', '2023-05-07 13:32:56'),
(9, 11, 'andrepaul.staclara6712@gmail.com', '09298410728', 'Andre Paul', 'Sta. Clara', '../profile-pictures/11.jpg', 0, '2023-03-14 02:39:52', '2023-05-06 10:57:54'),
(12, 15, 'andrepaul.22@gmail.com', '09123456789', 'qweqweqweqweqwe', 'qweqweqweqw', 'profile-pictures/default.png', 0, '2023-05-06 11:20:32', '2023-05-06 11:36:03'),
(16, 20, 'andrepaul.staclara67@gmail.com1', '09123456789', 'Andre Paul', 'Sta. Clara', 'profile-pictures/default.png', 0, '2023-05-08 12:47:54', '2023-05-09 04:28:07'),
(17, 21, 'andrepaul.staclara67@gma1il.com', '09123456789', 'Bogarts', 'Pederico', '../profile-pictures/21.jpg', 0, '2023-05-09 04:28:35', '2023-05-09 06:55:27'),
(18, 22, 'andrepaul.staclara67@gmail.com', '09123456789', 'Fanny', 'Fanny', 'profile-pictures/default.png', 0, '2023-05-09 07:08:57', '2023-05-09 07:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `role`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 'Admin', 0, '2023-02-10 01:46:54', '2023-02-10 01:46:54'),
(2, 'Customer', 0, '2023-02-10 01:46:54', '2023-02-10 01:46:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_id` (`pet_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`password_reset_id`);

--
-- Indexes for table `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`pet_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD PRIMARY KEY (`timeslot_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_role_id` (`user_role_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `password_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pet`
--
ALTER TABLE `pet`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeslot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`pet_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `timeslot`
--
ALTER TABLE `timeslot`
  ADD CONSTRAINT `timeslot_ibfk_1` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
