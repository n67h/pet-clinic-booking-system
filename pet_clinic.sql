-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2023 at 04:39 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

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
  `service_id` int(11) DEFAULT NULL,
  `pet_name` varchar(255) NOT NULL,
  `species` varchar(255) NOT NULL,
  `breed` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service`, `description`, `is_deleted`, `date_added`, `last_updated`) VALUES
(4, 'Vaccination', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores error obcaecati iusto commodi reprehenderit ducimus nisi, cupiditate corporis eum earum magnam adipisci quibusdam sed! Et eius neque hic quasi ratione.', 0, '2023-02-19 02:34:02', '2023-02-19 02:34:02'),
(7, 'Medication', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores error obcaecati iusto commodi reprehenderit ducimus nisi, cupiditate corporis eum earum magnam adipisci quibusdam sed! Et eius neque hic quasi ratione.', 0, '2023-02-19 02:47:26', '2023-02-19 02:47:26'),
(8, 'Grooming', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores error obcaecati iusto commodi reprehenderit ducimus nisi, cupiditate corporis eum earum magnam adipisci quibusdam sed! Et eius neque hic quasi ratione.', 0, '2023-02-19 02:47:44', '2023-02-19 02:47:44'),
(9, 'Surgery', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores error obcaecati iusto commodi reprehenderit ducimus nisi, cupiditate corporis eum earum magnam adipisci quibusdam sed! Et eius neque hic quasi ratione.', 1, '2023-02-19 03:11:44', '2023-02-19 03:18:36');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role_id`, `username`, `password`, `verification_key`, `is_verified`, `is_deleted`, `last_login`, `date_added`, `last_updated`) VALUES
(1, 1, 'admin', '$2y$10$/ScUXoTER2V4lCZWev2nFOn49mAANnCkpbfMQsRwPGYfx.mIPY.x.', 'N/A', 1, 0, '2023-02-20 15:36:01', '2023-02-10 02:28:53', '2023-02-20 15:36:01'),
(4, 2, 'test123', '$2y$10$NeXmYy964PSWXXEn6xa1SOUlkUwUw.z6CNO4Qfl.CYINQOmOQjUTO', 'a14b0f101698053dd6b5dec603cc8ca3', 0, 0, '0000-00-00 00:00:00', '2023-02-10 03:19:32', '2023-02-19 12:34:36'),
(5, 2, 'qweqweqwe', '$2y$10$2C8y.TXzj89Y3ER9U2RcOe/LGrQy1RYH9BAU5ZhJAK6jiC5ZOH9m2', '2ea81794f650a2497c62190e91058135', 1, 0, '2023-02-19 06:26:23', '2023-02-14 14:25:48', '2023-02-19 06:26:23'),
(8, 2, 'zxczxczxczxczxczxc', '$2y$10$FMilhbIIs6V7E6pIl4t1FeJ5/0eVllPyqr835gZDmHceTaEuc0J1q', '7f4039e9ea73123975253b84d8820a15', 0, 0, '0000-00-00 00:00:00', '2023-02-19 13:05:08', '2023-02-19 13:05:35');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_info_id`, `user_id`, `email`, `phone_number`, `first_name`, `last_name`, `image`, `is_deleted`, `date_added`, `last_updated`) VALUES
(2, 1, '', '', 'Quimper', 'Parables', 'profile-pictures/quimmy_otlum.jpg', 0, '2023-02-10 03:00:32', '2023-02-19 12:41:02'),
(4, 4, 'johndoe123@gmail.com', '09123456789', 'test test', 'Doe', 'profile-pictures/default.png', 0, '2023-02-10 03:19:32', '2023-02-19 12:34:31'),
(5, 5, 'andrepaul.staclara67@gmail.com', '', 'Andre Paul', 'Sta. Clara', 'profile-pictures/default.png', 0, '2023-02-14 14:25:48', '2023-02-19 12:17:30'),
(6, 8, 'testzxc@gmail.com', '09123456789', 'zxc test', 'test zxc', 'profile-pictures/default.png', 0, '2023-02-19 13:05:08', '2023-02-19 13:05:08');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`password_reset_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `password_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
