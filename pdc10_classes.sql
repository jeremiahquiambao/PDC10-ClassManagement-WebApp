-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2022 at 10:45 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdc10_classes`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `teacher_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `description`, `code`, `teacher_number`) VALUES
(18, 'Professional Domain Course 1', 'About PHP Programming', 'PDC10', '10-10-10'),
(19, 'Advance Information Management', 'About Database Management', 'AIM10', '20-20-20'),
(20, 'Object Oriented Programming', 'About  C# Programming', 'OOP10', '30-30-30'),
(21, 'Networking and Communications', 'About Networking', 'NEC101', '40-40-40'),
(22, 'Data Structures and Algorithms', 'About Python Programming', 'DSAL10', '50-50-50');

-- --------------------------------------------------------

--
-- Table structure for table `classes_rosters`
--

CREATE TABLE `classes_rosters` (
  `id` int(255) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `enrolled_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classes_rosters`
--

INSERT INTO `classes_rosters` (`id`, `class_code`, `student_number`, `is_active`, `enrolled_at`) VALUES
(17, 'PDC10', '18-0165-372', 1, '2022-10-15'),
(18, 'PDC10', '14-0904-328', 1, '2022-10-15'),
(21, 'PDC10', '14-0072-264', 1, '2022-10-15'),
(22, 'OOP10', '20-0730-992', 1, '2022-10-15'),
(24, 'OOP10', '20-1068-435', 1, '2022-10-15'),
(25, 'AIM10', '18-0165-372', 1, '2022-10-16'),
(26, 'AIM10', '14-0072-264', 1, '2022-10-16');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `program` varchar(255) NOT NULL,
  `student_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `first_name`, `last_name`, `email`, `contact`, `program`, `student_number`) VALUES
(1, 'Jello', 'Mangune', 'mangune.jello@gmail.com', '09123456781', 'BSIT', '20-0730-992'),
(2, 'Kane', 'Castillano', 'castillano.kane@gmail.com', '09123456782', 'BSIT', '18-0165-372'),
(3, 'Micoh', 'Yabut', 'yabut.micoh@gmail.com', '09123456783', 'BSIT', '14-0072-264'),
(4, 'Russelle', 'Bangsil', 'bangsil.russelle@gmail.com', '09123456784', 'BSIT', '14-0904-328'),
(5, 'Karylle', 'Lopez', 'lopez.karylle@gmail.com', '09123456785', 'BSIT', '20-1068-435');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `employee_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `first_name`, `last_name`, `email`, `contact`, `employee_number`) VALUES
(1, 'Romack', 'Natividad', 'NatividadRomack@gmail.com', '12345678901', '10-10-10'),
(2, 'Adriane', 'Castro', 'CastroAdriane@gmail.com', '12345678902', '20-20-20'),
(3, 'Jonilo', 'Mababa', 'MababaJonilo@gmail.com', '12345678903', '30-30-30'),
(4, 'Benedict', 'Guarin', 'GuarinBenedict@gmail.com', '12345678904', '40-40-40'),
(5, 'James', 'Esquivel', 'EsquivelJames@gmail.com', '12345678905', '50-50-50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `teacher_number` (`teacher_number`);

--
-- Indexes for table `classes_rosters`
--
ALTER TABLE `classes_rosters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_code` (`class_code`,`student_number`),
  ADD KEY `student_number` (`student_number`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_number` (`student_number`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_number` (`employee_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `classes_rosters`
--
ALTER TABLE `classes_rosters`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`teacher_number`) REFERENCES `teachers` (`employee_number`) ON DELETE CASCADE;

--
-- Constraints for table `classes_rosters`
--
ALTER TABLE `classes_rosters`
  ADD CONSTRAINT `classes_rosters_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`code`) ON DELETE CASCADE,
  ADD CONSTRAINT `classes_rosters_ibfk_2` FOREIGN KEY (`student_number`) REFERENCES `students` (`student_number`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
