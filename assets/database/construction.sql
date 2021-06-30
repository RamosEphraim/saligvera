-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2018 at 05:08 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `construction`
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
(1, 'Pascual', 'Arjeth', 'Soriano', 'arjethpascual@gmail.com', '09123456789', 'arjeth', '$2y$10$LVZ20midDw5lvOi/9JwWa.SizqmM9clUrgNorv/otwqb5FEAfcqAO', 1010, 7, 0, 1),
(5, 'Naruto', 'Naruto', '', 'Naruto@gmail.com', '12345678900', '1199', '$2y$10$Wq.KqcqV7gS9rcPkoHJAce/A5HeUxZKr.lPFYsoiLY8qk9O2.CcXy', 2222, 1, 0, 1),
(6, 'Sakura', 'Sakura', '', 'Sakura@gmail.com', '12345678900', '7600', '$2y$10$2xLlBe2EMbQqxvppFwsefO4TgynXS/mejUcaJYHZqQHEgotrfyiMi', 1234, 2, 0, 1),
(7, 'Lee', 'Lee', '', 'Lee@gmail.com', '12345678900', '6848', '$2y$10$/3qQpd9Xd.StXZGgcxZibODOlbEZVB4VVeTpGJIae2qKUbwyVVB8O', 0, 3, 0, 1),
(8, 'Gaara', 'Gaara', '', 'Gaara@gmail.com', '12345678900', '4657', '$2y$10$/3qQpd9Xd.StXZGgcxZibODOlbEZVB4VVeTpGJIae2qKUbwyVVB8O', 0, 4, 1, 1),
(9, 'Kakashi', 'Kakashi', '', 'Kakashi@gmail.com', '12345678900', '8533', '$2y$10$QphCj4kMqth4CTzzYXWLHO2xctSDeLlW9LnuOQgqQEHGbRfZkWzUm', 8533, 5, 0, 1),
(11, 'Sasuke', 'Sasuke', '', 'Sasuke@gmail.com', '12345678900', '9775', '$2y$10$eb4kkfEC7xe0sefMN9eAgukdPwe1FLjRAeLUClGh6SATvbGUZZmYe', 0, 4, 1, 1),
(12, 'Sakuragi', 'Sakuragi', '', 'Sakuragi@gmail.com', '12345678900', '3647', '$2y$10$sAfUaiRm74iJoxNl/dMvn.2CpwsRInUoPlQv0xk//poekAAKtsXia', 0, 2, 0, 1),
(13, 'Tetsuya', 'Tetsuya', '', 'Tetsuya@gmail.com', '12345678900', '7757', '$2y$10$JUk73fXd3J97WlBfkWa8NuPsq746ITa4nzVtkCGuBAsCbfoXQYP4u', 0, 4, 1, 1),
(14, 'Sunade', 'Sunade', '', 'Sunade@gmail.com', '12345678900', '6101', '$2y$10$njgKuhan51XJu0doU4mD6.KTd134HTrc3Dt3/wrgRbrGNPOHkGb8.', 0, 4, 2, 1),
(15, 'Utchimaru', 'Utchimaru', '', 'Utchimaru@gmail.com', '12345678900', '3286', '$2y$10$FNsWLDL2.GBSA0hu253VXuvyItdYEXpk0ARD7dVhXla6mtznJKZua', 0, 4, 2, 1),
(16, 'Kazama', 'Jin', '', 'jin@gmail.com', '12345678900', '1259', '$2y$10$YSjAHtOhJnhicEY30yp/k.SLnJNDlgDzv4y2AK8Ysg8kptkGMrM4C', 0, 4, 2, 1);

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
  `date_started` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `checklist_tbl`
--

INSERT INTO `checklist_tbl` (`check_id`, `project_id`, `task`, `percentage`, `task_status`, `date_started`) VALUES
(1, 16, 'demo', 20, 0, '2018-09-23 06:00:41'),
(2, 16, 'Buhos', 20, 0, '2018-09-23 01:49:39'),
(3, 16, 'Sample', 20, 0, '2018-09-23 01:49:49'),
(4, 16, 'zxc', 20, 0, '2018-09-23 01:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `request_id`, `order_status`, `order_date`) VALUES
(9, 1, 1, '2018-09-23 05:58:05'),
(10, 1, 3, '2018-09-23 05:59:24'),
(11, 1, 2, '2018-09-23 06:04:26'),
(12, 1, 2, '2018-09-23 06:11:11'),
(13, 1, 2, '2018-09-23 06:12:27'),
(14, 1, 1, '2018-09-23 06:13:16'),
(15, 1, 3, '2018-09-23 06:13:56'),
(16, 1, 2, '2018-09-23 06:17:49'),
(17, 1, 1, '2018-09-23 06:18:41'),
(18, 1, 4, '2018-09-23 06:19:56'),
(19, 1, 1, '2018-09-23 06:20:39'),
(20, 1, 3, '2018-09-23 06:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `photo_tbl`
--

CREATE TABLE `photo_tbl` (
  `photo_id` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `project_id` int(11) NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo_tbl`
--

INSERT INTO `photo_tbl` (`photo_id`, `photo`, `project_id`, `date_uploaded`) VALUES
(1, 'project.jpg', 16, '2018-09-23 01:53:24'),
(2, 'project.jpg', 16, '2018-09-23 01:53:24'),
(3, 'project.jpg', 16, '2018-09-23 01:53:24'),
(4, 'project.jpg', 16, '2018-09-23 01:53:24');

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
(18, 8, 11, 13, 'Pabahay', '50000000', 0, 0, 0, 'October 01, 2018', 'October 01, 2026');

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
  `request_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_tbl`
--

INSERT INTO `request_tbl` (`request_id`, `project_id`, `account_id`, `supply_id`, `quantity`, `request_status`, `request_date`) VALUES
(1, 16, 8, 4, 15, 1, '2018-09-22');

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
  `record_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supply_tbl`
--

INSERT INTO `supply_tbl` (`supply_id`, `item`, `description`, `unit`, `stocks`, `supplier`, `supply_status`, `record_date`, `updated_date`) VALUES
(4, 'Paint', 'ASDFGHJ', 'Can', 100, 'ZXCVBN', 1, '2018-09-23 07:25:05', '2018-09-23 03:03:14');

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
  `project_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `worker_tbl`
--

INSERT INTO `worker_tbl` (`worker_id`, `name`, `position`, `contact`, `address`, `worker_img`, `worker_status`, `project_id`, `project_date`) VALUES
(13, 'Pak pak', 'Carpenters', '12345678900', 'Pak pak', '180923031950.jpg', 3, 16, '2018-09-23 01:19:50'),
(14, 'Pek pek', 'Construction Laborers', '12345678900', 'Pek pek', '180923032018.jpg', 3, 16, '2018-09-23 01:20:18'),
(15, 'Pik pik', 'Construction Managers', '12345678900', 'Pik pik', '180923032029.jpg', 3, 16, '2018-09-23 01:20:29'),
(16, 'Pok pok', 'Electricians', '12345678900', 'Pok pok', '180923032039.jpg', 1, 0, '2018-09-23 01:20:39'),
(17, 'Puk puk', 'Equipment Operator', '12345678900', 'Puk puk', '180923032051.jpg', 1, 0, '2018-09-23 01:20:51');

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
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `photo_tbl`
--
ALTER TABLE `photo_tbl`
  ADD PRIMARY KEY (`photo_id`);

--
-- Indexes for table `project_tbl`
--
ALTER TABLE `project_tbl`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `request_tbl`
--
ALTER TABLE `request_tbl`
  ADD PRIMARY KEY (`request_id`);

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
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `checklist_tbl`
--
ALTER TABLE `checklist_tbl`
  MODIFY `check_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `photo_tbl`
--
ALTER TABLE `photo_tbl`
  MODIFY `photo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project_tbl`
--
ALTER TABLE `project_tbl`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `request_tbl`
--
ALTER TABLE `request_tbl`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
