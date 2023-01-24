-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2022 at 03:11 AM
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
-- CREATE DATABASE IF NOT EXISTS cdcms_db
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `enroller_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `date`, `doctor_id`, `enroller_id`, `status`) VALUES
(13, '2022-11-24', 5, 31, 2),
(15, '2022-11-20', 6, 31, 2),
(16, '2022-11-18', 6, 31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_details`
--

CREATE TABLE `babysitter_details` (
  `babysitter_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_details`
--

INSERT INTO `babysitter_details` (`babysitter_id`, `meta_field`, `meta_value`) VALUES
(4, 'firstname', 'mumin'),
(4, 'middlename', ''),
(4, 'lastname', 'Farooq'),
(4, 'gender', 'Male'),
(4, 'email', 'muminfarooq420@gmail.com'),
(4, 'contact', '235443452345'),
(4, 'address', 'Hmt zainakote srinagar\r\nNear sicop'),
(4, 'skills', 'dsfds'),
(4, 'years_experience', '1'),
(4, 'achievement', 'dsfdsf'),
(4, 'other', 'dsafd'),
(5, 'firstname', 'zahid'),
(5, 'middlename', ''),
(5, 'lastname', 'dar'),
(5, 'gender', 'Male'),
(5, 'email', 'zahiddar420@gmail.com'),
(5, 'contact', '235443452345'),
(5, 'address', 'Hmt zainakote srinagar\r\nNear sicop'),
(5, 'skills', 'fdsfds'),
(5, 'years_experience', '1'),
(5, 'achievement', 'fdfd'),
(5, 'other', 'sdfd');

-- --------------------------------------------------------

--
-- Table structure for table `babysitter_list`
--

CREATE TABLE `babysitter_list` (
  `id` int(30) NOT NULL,
  `code` varchar(50) NOT NULL DEFAULT '50',
  `fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `babysitter_list`
--

INSERT INTO `babysitter_list` (`id`, `code`, `fullname`, `status`, `date_created`, `date_updated`) VALUES
(4, 'BS-2022110001', 'Farooq, mumin ', 1, '2022-11-14 12:26:04', '2022-11-19 16:25:55'),
(5, 'BS-2022110002', 'dar, zahid ', 3, '2022-11-14 12:26:40', '2022-11-18 18:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `disease_detection`
--

CREATE TABLE `disease_detection` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disease_detection`
--

INSERT INTO `disease_detection` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Disease 1', '&lt;p style=&quot;text-align: justify; &quot;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:00', '2022-11-19 19:16:17'),
(2, 'Disease 2', '&lt;p style=&quot;text-align: justify; &quot;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:23', '2022-11-19 19:16:21'),
(3, 'Disease 4', '&lt;p style=&quot;text-align: justify; &quot;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:33', '2022-11-19 19:16:33'),
(4, 'Disease 3', '&lt;p style=&quot;text-align: justify; &quot;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:52', '2022-11-19 19:16:29'),
(6, 'Disease 5', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2022-11-19 19:02:55', '2022-11-19 19:16:56'),
(7, '', '', 1, '2022-11-24 20:22:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_details`
--

CREATE TABLE `doctor_details` (
  `doctor_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_details`
--

INSERT INTO `doctor_details` (`doctor_id`, `meta_field`, `meta_value`) VALUES
(6, 'firstname', 'huzaif'),
(6, 'middlename', ''),
(6, 'lastname', 'Shafi'),
(6, 'gender', 'Male'),
(6, 'email', 'HuzaifSyed420@gmail.com'),
(6, 'contact', '235443452345'),
(6, 'address', 'Hmt zainakote srinagar\r\nNear sicop'),
(6, 'skills', 'adsfadsf'),
(6, 'years_experience', '1'),
(6, 'achievement', 'fdaf'),
(6, 'other', 'fdsf'),
(5, 'firstname', 'Uzair'),
(5, 'middlename', ''),
(5, 'lastname', 'Shafi'),
(5, 'gender', 'Male'),
(5, 'email', 'daruzair420@gmail.com'),
(5, 'contact', '235443452345'),
(5, 'address', 'Hmt zainakote srinagar\r\nNear sicop'),
(5, 'skills', 'gfsdfgdfs'),
(5, 'years_experience', '1'),
(5, 'achievement', 'drgdfs'),
(5, 'other', 'gfg');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_list`
--

CREATE TABLE `doctor_list` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp(),
  `fullname` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_list`
--

INSERT INTO `doctor_list` (`id`, `code`, `date_created`, `date_updated`, `fullname`, `status`) VALUES
(5, 'D-2022110001', '2022-11-14 12:24:40', '2022-11-14 12:24:40', 'Shafi, Uzair ', 1),
(6, 'D-2022110002', '2022-11-14 12:25:24', '2022-11-14 12:25:24', 'Shafi, huzaif ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_details`
--

CREATE TABLE `enrollment_details` (
  `enrollment_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_details`
--

INSERT INTO `enrollment_details` (`enrollment_id`, `meta_field`, `meta_value`) VALUES
(33, 'child_firstname', 'Uzair'),
(33, 'child_middlename', ''),
(33, 'child_lastname', 'Shafi'),
(33, 'username', 'UzairShafi'),
(33, 'password', '12345'),
(33, 'gender', 'Female'),
(33, 'child_dob', '2022-11-01'),
(33, 'parent_firstname', 'Uzair'),
(33, 'parent_middlename', ''),
(33, 'parent_lastname', 'Shafi'),
(33, 'parent_contact', '98797890789078'),
(33, 'parent_email', 'daruzair420@gmail.com'),
(33, 'address', 'Hmt zainakote srinagar\r\nNear sicop'),
(33, 'child_fullname', 'Shafi, Uzair '),
(33, 'parent_fullname', 'Shafi, Uzair '),
(31, 'child_firstname', 'Uzair1'),
(31, 'child_middlename', 'adas1'),
(31, 'child_lastname', 'Shafi1'),
(31, 'username', 'UzairShafi11'),
(31, 'password', '12345'),
(31, 'gender', 'Female'),
(31, 'child_dob', '2022-11-03'),
(31, 'parent_firstname', 'Uzairs1'),
(31, 'parent_middlename', '11'),
(31, 'parent_lastname', 'Shafi1'),
(31, 'parent_contact', '987978907890781'),
(31, 'parent_email', 'daruzair420@gmail.com1'),
(31, 'address', 'Hmt zainakote srinagarNear sicop1'),
(31, 'child_fullname', 'Shafi1, Uzair1 adas1'),
(31, 'parent_fullname', 'Shafi1, Uzairs1 11'),
(31, 'avatar', 'uploads/enroller/enroller-31.png?v=1668538227'),
(32, 'child_firstname', 'Uzair'),
(32, 'child_middlename', ''),
(32, 'child_lastname', 'Shafi'),
(32, 'username', 'UzairShafi'),
(32, 'password', '12345'),
(32, 'gender', 'Male'),
(32, 'child_dob', '2022-11-08'),
(32, 'parent_firstname', 'Uzair'),
(32, 'parent_middlename', ''),
(32, 'parent_lastname', 'Shafi'),
(32, 'parent_contact', '98797890789078'),
(32, 'parent_email', 'daruzair420@gmail.com'),
(32, 'address', 'Hmt zainakote srinagarNear sicop'),
(32, 'child_fullname', 'Shafi, Uzair '),
(32, 'parent_fullname', 'Shafi, Uzair '),
(32, 'avatar', 'uploads/enroller/enroller-32.png?v=1669204679');

-- --------------------------------------------------------

--
-- Table structure for table `enrollment_list`
--

CREATE TABLE `enrollment_list` (
  `id` int(30) NOT NULL,
  `avatar` text DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `code` varchar(50) NOT NULL,
  `child_fullname` text NOT NULL,
  `parent_fullname` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enrollment_list`
--

INSERT INTO `enrollment_list` (`id`, `avatar`, `username`, `password`, `code`, `child_fullname`, `parent_fullname`, `status`, `date_created`, `date_updated`) VALUES
(31, 'uploads/enroller/enroller-31.png?v=1668538227', 'UzairShafi11', '827ccb0eea8a706c4c34a16891f84e7b', 'WQL-2022110001', 'Shafi1, Uzair1 adas1', 'Shafi1, Uzairs1 11', 1, '2022-11-14 13:06:02', '2022-11-16 00:20:27'),
(32, 'uploads/enroller/enroller-32.png?v=1669204679', 'UzairShafi', '827ccb0eea8a706c4c34a16891f84e7b', 'VBS-2022110001', 'Shafi, Uzair ', 'Shafi, Uzair ', 1, '2022-11-15 20:58:47', '2022-11-23 17:27:59'),
(33, NULL, 'UzairShafi', '827ccb0eea8a706c4c34a16891f84e7b', 'MEB-2022110001', 'Shafi, Uzair ', 'Shafi, Uzair ', 0, '2022-11-15 23:07:26', '2022-11-15 23:07:26');

-- --------------------------------------------------------

--
-- Table structure for table `government_schemes`
--

CREATE TABLE `government_schemes` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `government_schemes`
--

INSERT INTO `government_schemes` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Schemes 1', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;', 1, '2021-12-14 10:02:00', '2022-11-19 19:07:28'),
(2, 'Schemes 2', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:23', '2022-11-19 19:13:04'),
(3, 'Schemes 4', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:33', '2022-11-19 19:13:42'),
(4, 'Schemes 5 ', '&lt;p style=&quot;text-align: justify; &quot;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2021-12-14 10:02:52', '2022-11-19 19:14:20'),
(6, 'Schemes 3', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;br&gt;&lt;/p&gt;', 1, '2022-11-19 19:05:23', '2022-11-19 19:15:11');

-- --------------------------------------------------------

--
-- Table structure for table `hire_babysitter`
--

CREATE TABLE `hire_babysitter` (
  `id` int(11) NOT NULL,
  `babysitter_id` int(11) NOT NULL,
  `enroller_id` int(11) NOT NULL,
  `hire_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hire_babysitter`
--

INSERT INTO `hire_babysitter` (`id`, `babysitter_id`, `enroller_id`, `hire_date`) VALUES
(32, 5, 31, '2022-11-18 18:49:43');

-- --------------------------------------------------------

--
-- Table structure for table `mealplanchart`
--

CREATE TABLE `mealplanchart` (
  `id` int(11) NOT NULL,
  `fromC` int(11) NOT NULL,
  `toC` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_list`
--

CREATE TABLE `service_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_list`
--

INSERT INTO `service_list` (`id`, `name`, `description`, `status`, `date_created`, `date_updated`) VALUES
(1, 'Program 1', '<p><span style=\"color: rgb(156, 163, 175); font-family: Roboto, sans-serif; background-color: rgb(49, 51, 72);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.</span><br></p>', 1, '2021-12-14 10:02:00', '2022-11-19 15:34:22'),
(2, 'Program 2', '<p><span style=\"color: rgb(156, 163, 175); font-family: Roboto, sans-serif; background-color: rgb(49, 51, 72);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.</span><br></p>', 1, '2021-12-14 10:02:23', '2022-11-19 15:34:25'),
(3, 'Program 4', '<p><span style=\"color: rgb(156, 163, 175); font-family: Roboto, sans-serif; background-color: rgb(49, 51, 72);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.</span><br></p>', 1, '2021-12-14 10:02:33', '2022-11-19 15:34:28'),
(4, 'Program 3', '<p><span style=\"color: rgb(156, 163, 175); font-family: Roboto, sans-serif; background-color: rgb(49, 51, 72);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.</span><br></p>', 1, '2021-12-14 10:02:52', '2022-11-19 15:34:31'),
(5, 'Program 5', '<p><span style=\"color: rgb(156, 163, 175); font-family: Roboto, sans-serif; background-color: rgb(49, 51, 72);\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.</span><br></p>', 1, '2021-12-14 10:05:32', '2022-11-19 15:34:34'),
(6, 'Program 6', '&lt;p&gt;&lt;span style=&quot;color: rgb(156, 163, 175); font-family: Roboto, sans-serif; background-color: rgb(49, 51, 72);&quot;&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id augue est. Praesent eu augue efficitur, sodales lacus eget, sagittis est. Praesent ultricies eleifend facilisis. Praesent maximus justo tellus, in pharetra nulla mollis ut. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras fringilla est mi, eget hendrerit lacus vehicula id. Nam nisi magna, venenatis sit amet placerat non, porttitor eu ante. Phasellus sagittis aliquam turpis et malesuada. Quisque sollicitudin sit amet mi non suscipit. Integer turpis magna, tempor nec orci vel, aliquet ultricies dolor. Nulla venenatis maximus gravida. Aenean scelerisque ornare nunc, sed tempor tortor blandit et.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;', 1, '2022-11-19 15:33:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Child Care Management System '),
(6, 'short_name', 'CCMS'),
(11, 'logo', 'uploads/logo-1668620331.png'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover-1668620359.png'),
(15, 'content', 'Array'),
(16, 'email', 'info@babycare.com'),
(17, 'contact', '7006402808 / 7006402806'),
(18, 'from_time', '11:00'),
(19, 'to_time', '21:30'),
(20, 'address', 'Hmt Zainakote Srinagar , near Sicop');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0=not verified, 1 = verified',
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `status`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', NULL, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatar-1.png?v=1639468007', NULL, 1, 1, '2021-01-20 14:02:37', '2021-12-14 15:47:08'),
(4, 'adsf', NULL, 'fsadf', 'admins', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatar-4.png?v=1668408643', NULL, 2, 1, '2022-11-12 16:25:09', '2022-11-14 12:21:05'),
(5, 'Uzair', NULL, 'Shafi', 'administrator', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatar-5.png?v=1668408719', NULL, 1, 1, '2022-11-12 16:25:49', '2022-11-14 12:21:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `babysitter_details`
--
ALTER TABLE `babysitter_details`
  ADD KEY `babysitter_id` (`babysitter_id`);

--
-- Indexes for table `babysitter_list`
--
ALTER TABLE `babysitter_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disease_detection`
--
ALTER TABLE `disease_detection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_details`
--
ALTER TABLE `doctor_details`
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctor_list`
--
ALTER TABLE `doctor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  ADD KEY `enrollment_id` (`enrollment_id`);

--
-- Indexes for table `enrollment_list`
--
ALTER TABLE `enrollment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `government_schemes`
--
ALTER TABLE `government_schemes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hire_babysitter`
--
ALTER TABLE `hire_babysitter`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `babysitter_id` (`babysitter_id`);

--
-- Indexes for table `mealplanchart`
--
ALTER TABLE `mealplanchart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_list`
--
ALTER TABLE `service_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `babysitter_list`
--
ALTER TABLE `babysitter_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `disease_detection`
--
ALTER TABLE `disease_detection`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor_list`
--
ALTER TABLE `doctor_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrollment_list`
--
ALTER TABLE `enrollment_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `government_schemes`
--
ALTER TABLE `government_schemes`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hire_babysitter`
--
ALTER TABLE `hire_babysitter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `mealplanchart`
--
ALTER TABLE `mealplanchart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_list`
--
ALTER TABLE `service_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `babysitter_details`
--
ALTER TABLE `babysitter_details`
  ADD CONSTRAINT `babysitter_details_ibfk_1` FOREIGN KEY (`babysitter_id`) REFERENCES `babysitter_list` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollment_details`
--
ALTER TABLE `enrollment_details`
  ADD CONSTRAINT `enrollment_details_ibfk_1` FOREIGN KEY (`enrollment_id`) REFERENCES `enrollment_list` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
