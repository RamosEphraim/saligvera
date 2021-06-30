-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2021 at 10:38 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saligver_construction`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_tbl`
--

CREATE TABLE `account_tbl` (
  `account_id` int(11) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `role` int(11) NOT NULL,
  `type_role` int(11) NOT NULL,
  `account_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_tbl`
--

INSERT INTO `account_tbl` (`account_id`, `surname`, `firstname`, `middlename`, `email`, `contact`, `username`, `password`, `pincode`, `role`, `type_role`, `account_status`) VALUES
(8, 'Smith', 'John', 'Doe', 'honorjonel@gmail.com', '12345678900', '4657', '$2y$10$a/TAx8PbBy/ioYgu5BqskuKBozFdddnBCJrFyUmiYQPb2VDnUc1bO', 9124, 4, 1, 1),
(28, 'Pascual', 'Arjeth', '', 'honorjonel@gmail.com', '12345678900', '12345', '$2y$10$a/TAx8PbBy/ioYgu5BqskuKBozFdddnBCJrFyUmiYQPb2VDnUc1bO', 1000, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `checklist_tbl`
--

CREATE TABLE `checklist_tbl` (
  `check_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task` varchar(255) NOT NULL,
  `percentage` int(11) NOT NULL,
  `task_status` int(11) NOT NULL,
  `start` varchar(255) NOT NULL,
  `end` varchar(255) NOT NULL,
  `date_started` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_tbl`
--

INSERT INTO `checklist_tbl` (`check_id`, `project_id`, `task`, `percentage`, `task_status`, `start`, `end`, `date_started`) VALUES
(5, 18, 'Check List A', 10, 0, '2021-06-28', '2021-06-28', '2021-06-27 22:22:08'),
(6, 18, 'Check List B', 10, 0, '2021-06-30', '2021-06-30', '2021-06-27 22:24:15'),
(7, 18, 'Check List C', 10, 0, '2021-06-30', '2021-06-30', '2021-06-27 22:24:22'),
(8, 18, 'Check List D', 10, 2, '', '', '2021-06-27 22:24:32'),
(9, 18, 'Check List E', 10, 2, '', '', '2021-06-27 22:24:40'),
(10, 18, 'Check List F', 10, 2, '', '', '2021-06-27 22:24:43'),
(11, 18, 'Check List G', 10, 2, '', '', '2021-06-27 22:24:46'),
(12, 18, 'Check List H', 10, 2, '', '', '2021-06-27 22:24:51'),
(13, 18, 'Check List I', 10, 2, '', '', '2021-06-27 22:24:55'),
(14, 18, 'Check List J', 10, 2, '', '', '2021-06-27 22:25:01'),
(15, 18, 't', 2, 2, '', '', '2021-06-28 11:59:34'),
(16, 18, 'Another Task', 10, 2, '', '', '2021-06-30 02:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `photo_tbl`
--

CREATE TABLE `photo_tbl` (
  `photo_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo_tbl`
--

INSERT INTO `photo_tbl` (`photo_id`, `photo`, `project_id`, `date_uploaded`) VALUES
(1, 'project.jpg', 16, '2018-09-22 17:53:24'),
(2, 'project.jpg', 16, '2018-09-22 17:53:24'),
(3, 'project.jpg', 16, '2018-09-22 17:53:24'),
(4, 'project.jpg', 16, '2018-09-22 17:53:24'),
(5, 'download.png', 18, '2018-09-26 08:42:08'),
(6, 'download1.png', 18, '2018-09-26 08:42:15'),
(7, 'download2.png', 18, '2018-09-26 08:42:23'),
(8, 'download3.png', 18, '2018-09-26 08:43:12'),
(9, '41824750_328730857687751_6559381368504057856_n4.jpg', 18, '2018-09-26 14:24:17'),
(10, '1.jpg', 18, '2018-10-03 21:54:30'),
(11, 'paharang2.png', 18, '2018-10-04 06:38:08'),
(12, 'P_20181113_214528.jpg', 18, '2018-11-13 05:45:43'),
(13, 'sariaya1.jpg', 24, '2018-11-13 05:46:32'),
(14, 'vlcsnap-error541.png', 29, '2018-11-14 06:58:22'),
(15, 'P_20181113_2145281.jpg', 29, '2018-11-14 06:59:11');

-- --------------------------------------------------------

--
-- Table structure for table `project_tbl`
--

CREATE TABLE `project_tbl` (
  `project_id` int(11) NOT NULL,
  `first_ea` int(11) NOT NULL,
  `second_ea` int(11) NOT NULL,
  `third_ea` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_budget` varchar(255) NOT NULL,
  `project_workers` int(11) NOT NULL,
  `project_progress` int(11) NOT NULL,
  `project_status` int(11) NOT NULL,
  `project_startdate` varchar(255) NOT NULL,
  `project_enddate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_tbl`
--

INSERT INTO `project_tbl` (`project_id`, `first_ea`, `second_ea`, `third_ea`, `project_name`, `project_budget`, `project_workers`, `project_progress`, `project_status`, `project_startdate`, `project_enddate`) VALUES
(16, 8, 0, 0, 'Paharang', '10000000', 3, 100, 1, 'September 30, 2018', 'September 30, 2026'),
(18, 8, 11, 13, 'Pabahay', '50000000', 2, 30, 0, 'October 01, 2018', 'October 01, 2026');

-- --------------------------------------------------------

--
-- Table structure for table `request_tbl`
--

CREATE TABLE `request_tbl` (
  `request_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `request_status` int(11) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`request_id`, `project_id`, `account_id`, `supply_id`, `quantity`, `request_status`, `request_date`) VALUES
(4, 18, 11, 4, 5, 10, '2018-09-26 22:41:08'),
(5, 18, 11, 4, 5, 8, '2018-09-26 22:41:17'),
(6, 18, 11, 4, 5, 10, '2018-09-26 22:41:36'),
(7, 18, 11, 4, 10, 10, '2018-09-26 23:31:29'),
(8, 18, 11, 7, 20, 6, '2018-10-03 20:02:22'),
(9, 18, 8, 122, 20, 10, '2018-10-24 18:02:58'),
(10, 18, 8, 95, 22, 6, '2018-10-24 18:04:18'),
(11, 18, 8, 128, 50, 2, '2018-10-24 18:04:54'),
(12, 18, 11, 116, 25, 2, '2018-11-05 20:17:11'),
(13, 18, 11, 109, 10, 4, '2018-11-13 03:58:48'),
(14, 18, 11, 88, 10, 1, '2018-11-13 03:58:55'),
(15, 18, 11, 43, 10, 1, '2018-11-13 03:59:05'),
(16, 18, 11, 151, 10, 1, '2018-11-13 03:59:18'),
(17, 18, 11, 95, 10, 1, '2018-11-13 03:59:26'),
(18, 18, 11, 78, 10, 1, '2018-11-13 03:59:39'),
(19, 18, 11, 78, 10, 1, '2018-11-13 04:00:24'),
(20, 18, 11, 71, 10, 1, '2018-11-13 04:00:31'),
(21, 18, 11, 68, 10, 1, '2018-11-13 04:00:37'),
(22, 18, 11, 27, 10, 1, '2018-11-13 04:00:46'),
(23, 18, 11, 138, 10, 1, '2018-11-13 04:00:54'),
(24, 18, 11, 88, 10, 1, '2018-11-13 04:01:10'),
(25, 18, 11, 130, 10, 1, '2018-11-13 04:01:34'),
(26, 18, 11, 83, 10, 1, '2018-11-13 04:01:47'),
(27, 18, 11, 44, 10, 1, '2018-11-13 04:01:54'),
(28, 18, 11, 73, 10, 10, '2018-11-13 04:03:50'),
(29, 18, 11, 7, 10, 6, '2018-11-13 05:34:25'),
(30, 29, 11, 18, 10, 6, '2018-11-14 06:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `supply_tbl`
--

CREATE TABLE `supply_tbl` (
  `supply_id` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `stocks` int(11) NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `supply_status` int(11) NOT NULL,
  `record_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply_tbl`
--

INSERT INTO `supply_tbl` (`supply_id`, `item`, `description`, `unit`, `stocks`, `supplier`, `supply_status`, `record_date`, `updated_date`) VALUES
(4, 'Paint', 'TEST', 'Can', 100, 'ZXCVBN', 1, '2018-09-23 07:25:05', '2021-06-27 22:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `worker_tbl`
--

CREATE TABLE `worker_tbl` (
  `worker_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `worker_img` varchar(255) NOT NULL,
  `worker_status` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `project_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker_tbl`
--

INSERT INTO `worker_tbl` (`worker_id`, `name`, `position`, `contact`, `address`, `worker_img`, `worker_status`, `project_id`, `project_date`) VALUES
(13, 'Pak pak', 'Carpenters', '12345678900', 'Pak pak', '180923031950.jpg', 3, 16, '2018-09-23 01:19:50'),
(14, 'Pek pek', 'Construction Laborers', '12345678900', 'Pek pek', '180923032018.jpg', 3, 16, '2018-09-23 01:20:18'),
(15, 'Pik pik', 'Construction Managers', '12345678900', 'Pik pik', '180923032029.jpg', 3, 16, '2018-09-23 01:20:29'),
(16, 'Pok pok', 'Electricians', '12345678900', 'Pok pok', '180923032039.jpg', 3, 18, '2018-09-23 01:20:39'),
(17, 'Puk puk', 'Equipment Operator', '12345678900', 'Puk puk', '180923032051.jpg', 3, 18, '2018-09-23 01:20:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_tbl`
--
ALTER TABLE `account_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `checklist_tbl`
--
ALTER TABLE `checklist_tbl`
  ADD PRIMARY KEY (`check_id`);

--
-- Indexes for table `project_tbl`
--
ALTER TABLE `project_tbl`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `supply_tbl`
--
ALTER TABLE `supply_tbl`
  ADD PRIMARY KEY (`supply_id`);

--
-- Indexes for table `worker_tbl`
--
ALTER TABLE `worker_tbl`
  ADD PRIMARY KEY (`worker_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_tbl`
--
ALTER TABLE `account_tbl`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `checklist_tbl`
--
ALTER TABLE `checklist_tbl`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `project_tbl`
--
ALTER TABLE `project_tbl`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supply_tbl`
--
ALTER TABLE `supply_tbl`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `worker_tbl`
--
ALTER TABLE `worker_tbl`
  MODIFY `worker_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
