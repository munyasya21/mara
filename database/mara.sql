-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 09:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bethelex`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `bid` int(11) NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doc_id` int(11) DEFAULT NULL,
  `appt_date` varchar(255) NOT NULL,
  `appt_time` varchar(20) DEFAULT NULL,
  `booking_amount` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `patient_fname` varchar(255) NOT NULL,
  `patient_lname` varchar(255) NOT NULL,
  `patient_phone` varchar(255) NOT NULL,
  `patient_email` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `paid_amount` varchar(255) DEFAULT NULL,
  `payment_code` varchar(30) DEFAULT NULL,
  `appt_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`bid`, `patient_id`, `doc_id`, `appt_date`, `appt_time`, `booking_amount`, `date`, `patient_fname`, `patient_lname`, `patient_phone`, `patient_email`, `status`, `paid_amount`, `payment_code`, `appt_desc`) VALUES
(4, 4, 8, '2021-04-26', '10:00', '1000', '2021-04-27 17:02:25', 'Patient', 'One', '', 'patient@gmail.com', '2', '1000', '6088312d33fba7.34238076', 'General Consultation'),
(5, 4, 9, '2021-04-27', '12:30', '1500', '2021-04-27 17:02:22', 'Patient', 'One', '', 'patient@gmail.com', '2', '1500', '60882fcba15ba0.02273629', 'Treatement'),
(6, 4, 8, '2021-04-30', '15:30', '1000', '2021-05-04 07:12:48', 'Patient', 'One', '', 'patient@gmail.com', '1', '980', '6090f3f0d879c3.67456756', 'Counceling'),
(7, 4, 7, '2021-04-17', '18:50', '1000', '2021-04-27 19:58:01', 'Patient', 'One', '', 'patient@gmail.com', '1', '991', '608833ebf14df2.08145038', 'Consultation'),
(8, 4, 9, '2021-04-27', '18:53', '1500', '2021-04-27 17:02:14', 'Patient', 'One', '', 'patient@gmail.com', '1', '1000', '608833fc0773f0.36991846', 'To see a Dentist'),
(9, 10, 7, '2021-05-14', '10:00', '1000', '2021-05-04 10:17:29', 'Patient', 'Musyoka', '', 'patient2@gmail.com', '2', '1000', '6090feedc53d97.08447833', 'General Consultaion');

-- --------------------------------------------------------

--
-- Table structure for table `medicalrec`
--

CREATE TABLE `medicalrec` (
  `mrid` int(11) NOT NULL,
  `p_id` int(11) DEFAULT NULL,
  `d_id` int(11) DEFAULT NULL,
  `appt_id` int(11) DEFAULT NULL,
  `medicine` varchar(255) DEFAULT NULL,
  `m_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicalrec`
--

INSERT INTO `medicalrec` (`mrid`, `p_id`, `d_id`, `appt_id`, `medicine`, `m_desc`, `created_at`) VALUES
(2, 4, 8, 4, 'Acetaminophen', 'Acetaminophen (such as Tylenol) for fever and pain.\r\n1x2 for Pregnant patients', '2021-04-28 11:37:01'),
(3, 10, 7, 9, 'Kenazole', 'Ketoconazole Crème 1x2. To be applied on the affected  area/ skin', '2021-05-04 09:46:47'),
(4, 4, 9, 5, 'Kenazole', 'Ketoconazole Crème. apply on the affected area 1x2', '2021-05-04 10:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Has authority of users and roles and permissions.'),
(2, 'Doctor', 'Doctors handles patients'),
(3, 'Patient', 'To be attended by a Doctor');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name`) VALUES
(1, 'General practitioner'),
(5, 'Dentist');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `monday` varchar(255) DEFAULT NULL,
  `tuesday` varchar(255) DEFAULT NULL,
  `wednesday` varchar(255) DEFAULT NULL,
  `thursday` varchar(255) DEFAULT NULL,
  `friday` varchar(255) DEFAULT NULL,
  `saturday` varchar(255) DEFAULT NULL,
  `sunday` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `role_id`, `firstname`, `lastname`, `email`, `password`, `profile_picture`, `created_at`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `price`, `category`, `description`, `address`, `phone`) VALUES
(1, 1, 'Admin', 'Ian', 'admin@bhcs.com', '$2y$10$Efb6jW.um8DlUFLhPL7fcuS7.beb4MxlTAKAMTaTjaMPe368wVhZW', NULL, '2021-05-04 11:36:50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'Mitchel', 'Ndinda', 'patient@gmail.com', '$2y$10$ygzwkyC14wW0AO3xNGUQ1u.vCJ3vTs1sikpcGuVoiUtz3KS.dG.iq', '', '2021-05-04 09:58:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 722222222),
(7, 2, 'Dr. Gladys', 'Wambui', 'doctor1@bhcs.com', '$2y$10$6m.B3IW4v5v2qs02V0WVbe4/uMrb0mBA27yjEWN4DMaWGUCQsC1Em', 'doctor1.jpg', '2021-05-04 10:13:21', '9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '10:00 AM - 11:00 AM', '12:00 PM - 1:00 PM', '10:00 AM - 11:00 AM', 'Not Available', 'Not Available', '1000', 'General practitioner', 'MDS - Periodontology and Oral Implantology, BDS', 'Juja, Kiambu', 1234567890),
(8, 2, 'Dr. Hussein', 'Abdi', 'doctor2@bhcs.com', '$2y$10$/CxEKeVaDwT0UJBDwufm9.PpzBI6FXN5CsKkBM0OqLJGU4C81xhUy', 'doctor2.jpg', '2021-05-04 09:59:33', '9:00 AM - 10:00 AM', '9:00 AM - 10:00 AM', '10:00 AM - 11:00 AM', '11:00 AM - 12:00 PM', '9:00 AM - 10:00 AM', '9:00 AM - 10:00 AM', 'Not Available', '1000', 'General practitioner', 'MBBS, MD - General Medicine, DNB - Cardiology', 'Juja, Kiambu', 1234567891),
(9, 2, 'Dr. Melinda', 'Anyango', 'doctor3@bhcs.com', '$2y$10$iT33I6Najj3a5XH/g/x0U.dXlDOZ2IREBkF3144aK0u7zkO6gWELm', 'doctor3.jpg', '2021-05-04 09:59:59', '9:00 AM - 10:00 AM', 'Not Available', 'Not Available', '10:00 AM - 11:00 AM', '9:00 AM - 10:00 AM', 'Not Available', 'Not Available', '1500', 'Dentist', 'MDS - Periodontology and Oral Implantology', 'Nairobi, Kiambu', 1234567890),
(10, 3, 'Jessica', 'Kagweria', 'patient2@gmail.com', '$2y$10$fuVpXGb7QYCIcKZYk9.U.ubARZI7CWTWBjbHj6BySsg8Yr/jPdwX6', NULL, '2021-05-04 10:00:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `booking_ibfk_1` (`patient_id`),
  ADD KEY `booking_ibfk_2` (`doc_id`);

--
-- Indexes for table `medicalrec`
--
ALTER TABLE `medicalrec`
  ADD PRIMARY KEY (`mrid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `medicalrec`
--
ALTER TABLE `medicalrec`
  MODIFY `mrid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `specialities`
--
ALTER TABLE `specialities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `users` (`uid`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`doc_id`) REFERENCES `users` (`uid`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
