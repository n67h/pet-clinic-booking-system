-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 07:52 PM
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
  `pet_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `timeslot` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `user_id`, `pet_name`, `category_id`, `birthdate`, `gender`, `service_id`, `date`, `timeslot`, `status`, `is_deleted`, `date_added`, `last_updated`) VALUES
(2, 5, 'test', 1, '2021-01-12', 'Female', 1, '2023-03-16', '2:00PM - 3:00PM', 0, 0, '2023-03-12 08:45:04', '2023-03-13 16:46:55'),
(3, 5, 'test23', 1, '2012-12-12', 'Male', 1, '2023-03-16', '11:00AM - 12:00PM', 2, 0, '2023-03-12 10:46:22', '2023-03-13 16:46:29'),
(4, 10, 'test', 1, '2023-03-07', 'Male', 1, '2023-03-17', '8:00AM - 9:00AM', 1, 0, '2023-03-13 03:32:14', '2023-03-14 03:02:11'),
(5, 5, 'awawaw', 1, '2022-03-15', 'Male', 1, '2023-03-20', '1:00PM - 2:00PM', 0, 0, '2023-03-13 03:38:04', '2023-03-13 16:52:43'),
(6, 11, 'Bogart', 1, '2022-12-12', 'Male', 1, '2023-03-17', '10:00AM - 11:00AM', 2, 0, '2023-03-14 02:52:35', '2023-04-16 06:22:21');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 'Dogs', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(2, 'Cats', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(3, 'Rabbits', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(4, 'Hamsters', 0, '2023-03-10 02:06:09', '2023-03-10 02:06:09'),
(5, 'Dolphins', 0, '2023-03-10 02:17:15', '2023-03-10 02:17:15'),
(6, 'Unicorns', 0, '2023-03-10 02:17:30', '2023-03-10 02:39:03'),
(7, 'Komodo dragons', 0, '2023-03-10 02:40:40', '2023-03-10 02:40:40'),
(8, 'Dinosaurs', 0, '2023-03-10 02:42:21', '2023-03-10 02:48:42'),
(9, 'Polar bears', 0, '2023-03-10 02:42:25', '2023-03-10 02:52:38'),
(10, 'Penguins', 0, '2023-03-10 02:43:21', '2023-03-10 02:52:48');

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

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`password_reset_id`, `password_reset_email`, `password_reset_selector`, `password_reset_token`, `password_reset_expires`) VALUES
(20, 'andrepaul.staclara67@gmail.com', '37da88ee18020aad', '$2y$10$KE3rjuctX07FXv/ftsTgZO6I1smFrRZ75aPwDVYXirO/WFcCBrT7C', '1678762852');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `category_id`, `service`, `description`, `price`, `is_deleted`, `date_added`, `last_updated`) VALUES
(1, 1, 'Anti-rabies', 'Prevent them from acquiring the disease from wildlife, and thereby prevent possible transmission to your family or other people.', 1500.00, 0, '2023-03-10 03:13:46', '2023-03-14 02:04:33'),
(2, 1, 'Check-up', ' A medical examination by your doctor or dentist to make sure that there is nothing wrong with your health.', 1000.00, 0, '2023-03-10 03:36:32', '2023-03-14 02:08:19'),
(3, 2, 'Anti-rabies', 'test', 1400.00, 1, '2023-03-10 03:39:54', '2023-03-14 02:06:29'),
(4, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:40:55', '2023-03-10 04:49:57'),
(5, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:41:05', '2023-03-10 04:49:48'),
(6, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:41:46', '2023-03-10 04:49:45'),
(7, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:42:49', '2023-03-10 04:49:50'),
(8, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:43:24', '2023-03-10 04:49:43'),
(9, 1, 'Check-up', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia quod vero nam, deserunt dolor omnis laudantium sequi provident quisquam quo voluptas, nisi inventore totam dolorem placeat recusandae, dicta iste itaque?', 1000.00, 1, '2023-03-10 03:43:55', '2023-03-10 04:49:24'),
(10, 1, 'Surgery', 'The treatment of injuries or diseases in animals by cutting open the body and removing or repairing the damaged part.', 4000.00, 0, '2023-03-12 02:26:10', '2023-03-14 02:07:37');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role_id`, `username`, `password`, `verification_key`, `is_verified`, `is_deleted`, `last_login`, `date_added`, `last_updated`) VALUES
(1, 1, 'admin', '$2y$10$/ScUXoTER2V4lCZWev2nFOn49mAANnCkpbfMQsRwPGYfx.mIPY.x.', 'N/A', 1, 0, '2023-04-16 06:18:50', '2023-02-10 02:28:53', '2023-04-16 06:18:50'),
(4, 2, 'test123', '$2y$10$NeXmYy964PSWXXEn6xa1SOUlkUwUw.z6CNO4Qfl.CYINQOmOQjUTO', 'a14b0f101698053dd6b5dec603cc8ca3', 0, 0, '0000-00-00 00:00:00', '2023-02-10 03:19:32', '2023-02-19 12:34:36'),
(5, 2, 'qweqweqwe', '$2y$10$2C8y.TXzj89Y3ER9U2RcOe/LGrQy1RYH9BAU5ZhJAK6jiC5ZOH9m2', '2ea81794f650a2497c62190e91058135', 1, 0, '2023-05-01 17:50:26', '2023-02-14 14:25:48', '2023-05-01 17:50:26'),
(8, 2, 'zxczxczxczxczxczxc', '$2y$10$FMilhbIIs6V7E6pIl4t1FeJ5/0eVllPyqr835gZDmHceTaEuc0J1q', '7f4039e9ea73123975253b84d8820a15', 0, 0, '0000-00-00 00:00:00', '2023-02-19 13:05:08', '2023-02-19 13:05:35'),
(9, 2, 'test_username', '$2y$10$64n/Kka1xmBSfZTn0JrrxOebBT3OKwvKJAiP2sdIc4NMi4gklIWBm', '70e0e8bb3f1e4dc707514a993cbcddc7', 0, 0, '0000-00-00 00:00:00', '2023-03-06 02:56:32', '2023-03-06 02:56:32'),
(10, 2, 'andrepaul123', '$2y$10$.LFv00mUICpH.xMYIRSbTOdQExwLO0f0RrhuD8N1Sx9f4MtrHFK4e', 'db4ab603ede996c0199eec0effce89a5', 1, 0, '2023-03-07 05:41:54', '2023-03-07 03:19:53', '2023-03-13 13:33:43'),
(11, 2, 'staclara123', '$2y$10$uMl2ScVrzOZMXZSzfFboTeNkTksOL5zJpxh0D4hrLd8h8/bcph.BC', 'd49d06c2ca22dca2cdeb221aeb6bbab1', 1, 0, '2023-04-16 06:22:00', '2023-03-14 02:39:52', '2023-04-16 06:22:00');

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
(5, 5, 'andrepaul.staclarea67@gmail.com', '09298410728', 'Andre Paul', 'Sta. Clara', '../profile-pictures/5.jpg', 0, '2023-02-14 14:25:48', '2023-03-13 10:54:26'),
(6, 8, 'testzxc@gmail.com', '09123456789', 'zxc test', 'test zxc', 'profile-pictures/default.png', 0, '2023-02-19 13:05:08', '2023-02-19 13:05:08'),
(7, 9, 'testemail123@gmail.com', '09298410728', 'test', 'test', 'profile-pictures/default.png', 0, '2023-03-06 02:56:33', '2023-03-06 02:56:33'),
(8, 10, 'andrepaul.staclaara67@gmail.com', '09298410728', 'Andre Paul', 'Sta. Clara', 'profile-pictures/default.png', 0, '2023-03-07 03:19:54', '2023-03-14 02:38:25'),
(9, 11, 'andrepaul.staclara67@gmail.com', '09298410728', 'Andre Paul', 'Sta. Clara', '../profile-pictures/11.jpg', 0, '2023-03-14 02:39:52', '2023-03-14 02:49:33');

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
  ADD KEY `category_id` (`category_id`),
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
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `password_reset_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `timeslot`
--
ALTER TABLE `timeslot`
  MODIFY `timeslot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
