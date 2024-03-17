-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2024 at 10:13 PM
-- Server version: 5.7.36
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pcis_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admission_history`
--

DROP TABLE IF EXISTS `admission_history`;
CREATE TABLE IF NOT EXISTS `admission_history` (
  `id` int(30) NOT NULL,
  `patient_id` int(30) NOT NULL,
  `room_id` int(30) DEFAULT NULL,
  `date_admitted` datetime NOT NULL,
  `date_discharged` datetime DEFAULT NULL,
  `status` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admission_history`
--

INSERT INTO `admission_history` (`id`, `patient_id`, `room_id`, `date_admitted`, `date_discharged`, `status`, `date_created`, `date_updated`) VALUES
(4, 1, 1, '2021-12-29 15:00:00', '2021-12-31 15:20:00', '1', '2021-12-30 14:49:29', '2021-12-30 15:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_list`
--

DROP TABLE IF EXISTS `doctor_list`;
CREATE TABLE IF NOT EXISTS `doctor_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `fullname` text NOT NULL,
  `specialization` text NOT NULL,
  `email` text NOT NULL,
  `contact` varchar(100) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_added` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_list`
--

INSERT INTO `doctor_list` (`id`, `fullname`, `specialization`, `email`, `contact`, `delete_flag`, `date_created`, `date_added`) VALUES
(1, 'Dr. Joan', 'Physical medicine and rehabilitation', 'joan@thisapp.com', '09123456789', 0, '2021-12-30 09:32:30', '2024-02-13 04:06:32'),
(2, 'MD. Claire C Chris', 'Gyn', 'abc@gmail.com', '0722378945', 0, '2021-12-30 09:33:38', '2024-01-31 16:34:53'),
(3, 'Dr. Mark D Cooper', 'Sample only', 'mcooper@sample.com', '09456987123', 1, '2021-12-30 09:34:29', '2021-12-30 09:38:05');

-- --------------------------------------------------------

--
-- Table structure for table `patient_details`
--

DROP TABLE IF EXISTS `patient_details`;
CREATE TABLE IF NOT EXISTS `patient_details` (
  `patient_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_details`
--

INSERT INTO `patient_details` (`patient_id`, `meta_field`, `meta_value`) VALUES
(2, 'firstname', 'Irankunda'),
(2, 'middlename', ''),
(2, 'lastname', 'kunda'),
(2, 'suffix', 'Sr'),
(2, 'gender', 'Male'),
(2, 'dob', '2024-01-31'),
(2, 'email', 'kunda@gmail.com'),
(2, 'contact', '0787998877'),
(2, 'address', 'Kampala Nakawa'),
(1, 'firstname', 'Mark'),
(1, 'middlename', 'Damos'),
(1, 'lastname', 'Cooper'),
(1, 'suffix', 'D'),
(1, 'gender', 'Male'),
(1, 'dob', '1997-06-23'),
(1, 'email', 'mcooper@sample.com'),
(1, 'contact', '09123456789'),
(1, 'address', 'Over There Street, Here City, Anywhere, 2306'),
(3, 'firstname', 'NAKUYA'),
(3, 'middlename', ''),
(3, 'lastname', 'CAROLOINE'),
(3, 'suffix', 'Mis'),
(3, 'gender', 'Female'),
(3, 'dob', '2000-02-02'),
(3, 'email', 'nakuya621@gami.com'),
(3, 'contact', '0773637051'),
(3, 'address', 'KYEBANDO, KAWEMPE'),
(4, 'firstname', 'nalikka'),
(4, 'middlename', ''),
(4, 'lastname', 'moureen'),
(4, 'suffix', ''),
(4, 'gender', 'Female'),
(4, 'dob', '2002-01-01'),
(4, 'email', 'nakuya621@gami.com'),
(4, 'contact', '0773637051'),
(4, 'address', 'KYEBANDO, KAWEMPE');

-- --------------------------------------------------------

--
-- Table structure for table `patient_history`
--

DROP TABLE IF EXISTS `patient_history`;
CREATE TABLE IF NOT EXISTS `patient_history` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `patient_id` int(30) NOT NULL,
  `illness` text,
  `diagnosis` text,
  `treatment` text,
  `remarks` text,
  `doctor_id` int(30) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `patient_id` (`patient_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_history`
--

INSERT INTO `patient_history` (`id`, `patient_id`, `illness`, `diagnosis`, `treatment`, `remarks`, `doctor_id`, `date_created`, `date_updated`) VALUES
(2, 1, 'Sample Illness Information', 'This is a sample diagnosis only', 'This the sample information of the treatment', 'Sample remarks', 1, '2021-12-30 13:27:27', NULL),
(4, 1, 'Sample Illness 102', 'Illness Diagnosis 102', 'Sample Treatment 102', 'Sample remarks', 2, '2021-12-30 13:55:21', '2021-12-30 13:57:43'),
(5, 3, 'Pregnancy', 'pregnancy', 'Albendaxole', 'Welcome', 2, '2024-02-13 04:13:16', NULL),
(6, 4, NULL, 'fv', 'sdfxcv', 'wesfdcvx', 2, '2024-02-13 14:20:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_list`
--

DROP TABLE IF EXISTS `patient_list`;
CREATE TABLE IF NOT EXISTS `patient_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `fullname` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_list`
--

INSERT INTO `patient_list` (`id`, `code`, `fullname`, `email`, `phone`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'PA-2021120001', 'COOPER D MARK DAMOS', '', 0, 0, 1, '2021-12-30 12:00:44', '2024-02-08 16:25:25'),
(2, 'PA-2024010001', 'KUNDA SR IRANKUNDA', '', 0, 0, 1, '2024-01-31 16:32:32', '2024-02-13 04:05:28'),
(3, 'PA-2024020001', 'CAROLOINE MIS NAKUYA', '', 0, 0, 0, '2024-02-13 04:10:38', NULL),
(4, 'PA-2024020002', 'MOUREEN NALIKKA', '', 0, 0, 0, '2024-02-13 14:10:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `room_list`
--

DROP TABLE IF EXISTS `room_list`;
CREATE TABLE IF NOT EXISTS `room_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `capacity` int(5) NOT NULL DEFAULT '0',
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `room_type_id` (`room_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_list`
--

INSERT INTO `room_list` (`id`, `room_type_id`, `name`, `description`, `capacity`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 3, 'Room-201', 'Sample Ward Room Good for 6 Patient', 6, 0, '2021-12-30 10:33:24', '2021-12-30 10:34:36'),
(2, 1, 'Room-301', 'Sample Single Bed Room', 1, 0, '2021-12-30 10:33:46', NULL),
(3, 2, 'Room-302', 'Sample 2 Bed Room', 2, 0, '2021-12-30 10:34:06', NULL),
(4, 4, 'Room-202', 'Sample Ward Good 12 Patents', 12, 0, '2021-12-30 10:35:01', NULL),
(5, 4, 'Room-303', 'Sample Deleted Room', 101, 1, '2021-12-30 10:35:19', '2021-12-30 10:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `room_type_list`
--

DROP TABLE IF EXISTS `room_type_list`;
CREATE TABLE IF NOT EXISTS `room_type_list` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `room` text NOT NULL,
  `description` text NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_type_list`
--

INSERT INTO `room_type_list` (`id`, `room`, `description`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Single Room', 'Private Room with Single Patient Bed.', 0, '2021-12-30 10:05:45', NULL),
(2, '2 Bed Room', 'Private Room with 2 Bed Room.', 0, '2021-12-30 10:10:56', NULL),
(3, 'Ward 6', 'Ward Room With 6 Beds', 0, '2021-12-30 10:11:54', NULL),
(4, 'Ward 12', 'Ward Room with 12 Bed Space', 1, '2021-12-30 10:12:38', '2024-02-13 04:07:02'),
(5, 'ward 32', 'Sample Deleted Room Type', 1, '2021-12-30 10:19:17', '2021-12-30 10:19:22'),
(6, 'Ward 4', 'For inpatients', 0, '2024-02-13 04:07:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

DROP TABLE IF EXISTS `system_info`;
CREATE TABLE IF NOT EXISTS `system_info` (
  `id` int(30) NOT NULL AUTO_INCREMENT,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'PREGNANCY CARE INFORMATION SYSTEM'),
(6, 'short_name', 'PCIS'),
(11, 'logo', 'uploads/logo-1707789437.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1706709543.png'),
(15, 'content', 'Array'),
(16, 'email', 'info@xyzhostpital.com'),
(17, 'contact', '09854698789 / 78945632'),
(18, 'from_time', '11:00'),
(19, 'to_time', '21:30'),
(20, 'address', 'XYZ Street, There City, Here, 2306');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(250) NOT NULL,
  `middlename` text,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Admin', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1707788353', NULL, 1, 1, '2021-01-20 14:02:37', '2024-02-15 01:02:16'),
(3, 'Claire', NULL, 'Blake', 'cblake', '4744ddea876b11dcb1d169fadf494418', 'uploads/avatar-3.png?v=1639467985', NULL, 2, 1, '2021-12-14 15:46:25', '2021-12-14 15:46:25'),
(4, 'Irankunda', NULL, 'kunda', 'kunda', 'c683059f41f2a812a8011d5d566e2724', 'uploads/avatar-4.png?v=1707786551', NULL, 2, 1, '2024-02-13 04:09:10', '2024-02-13 04:09:11');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_details`
--
ALTER TABLE `patient_details`
  ADD CONSTRAINT `patient_details_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `patient_history`
--
ALTER TABLE `patient_history`
  ADD CONSTRAINT `patient_history_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_list` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `patient_history_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `room_list`
--
ALTER TABLE `room_list`
  ADD CONSTRAINT `room_list_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `room_type_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
