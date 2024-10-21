-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2024 at 06:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jk`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `actname` varchar(200) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `picture` blob DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `actname`, `barangay`, `date`, `picture`, `description`) VALUES
(10, 'Katubigan Festival', 'Upper Jasaan, Jasaan Misamis Oriental', '2023-12-08', 0x696d616765732f4b617475626967616e2d466573746976616c2e6a7067, 'katubigan festival nga way tubiiig! wow jasaaan!!! luso mayor red'),
(11, 'Balsa Festival', 'Lower Jasaan', '2024-03-26', 0x696d616765732f62616c73612e6a7067, 'balsa is a celebration every araw ng lower jasaan'),
(14, 'Ms. Agutayan', 'Jampason, Jasaan Misamis Oriental', '2024-04-29', 0x696d616765732f3334353539353139365f3933303339323930383239383332365f323937383730353133333832363635313336335f6e2e6a7067, 'mao ray ma dali2 nga kalingawan inig araw ng jampason'),
(18, 'jsddndj', 'kdskldks', '2024-04-01', 0x696d616765732f3433323639373635395f3432373533343934323936353537385f363038383336333832333537313934313838375f6e2e706e67, 'jshklskl');

--
-- Triggers `activities`
--
DELIMITER $$
CREATE TRIGGER `activities_delete_trigger` AFTER DELETE ON `activities` FOR EACH ROW BEGIN
    INSERT INTO activities_archive (id, actname, barangay, date, picture, description, deleted_at)
    VALUES (OLD.id, OLD.actname, OLD.barangay, OLD.date, OLD.picture, OLD.description, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `activities_archive`
--

CREATE TABLE `activities_archive` (
  `id` int(11) NOT NULL,
  `actname` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `picture` blob DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activities_archive`
--

INSERT INTO `activities_archive` (`id`, `actname`, `barangay`, `date`, `picture`, `description`, `deleted_at`) VALUES
(19, 'balablablaaaa', 'Jampason Jasaan Misamis Oriental', '2024-05-23', 0x696d616765732f6c61626c61622e6a7067, 'gwegfoiqehoV', '2024-04-22 23:38:42');

-- --------------------------------------------------------

--
-- Table structure for table `barangay`
--

CREATE TABLE `barangay` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `population` int(11) DEFAULT NULL,
  `history` text DEFAULT NULL,
  `officials` varchar(255) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `events` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `activity_id`, `comment`, `created_at`) VALUES
(1, 10, 'Ka way lami sa kalingawan gabie', '2024-05-21 04:19:38');

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `complaint` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '',
  `complainant` varchar(255) DEFAULT NULL,
  `contactnum` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `title`, `complaint`, `type`, `date`, `barangay`, `file`, `status`, `complainant`, `contactnum`) VALUES
(1, 'Noise Complaint', 'There is a lot of noise coming from the construction site near my house.', 'Noise', '2024-05-01', 'Barangay 1', 'files/noise_complaint.pdf', 'Under Observation', NULL, NULL),
(2, 'Water Supply Issue', 'We have not received water supply for the past three days.', 'Utilities', '2024-05-02', 'Barangay 2', 'files/water_supply_issue.pdf', 'Under Observation', NULL, NULL),
(3, 'Street Light Not Working', 'The street light near my house is not working for over a week now.', 'Infrastructure', '2024-05-03', 'Barangay 3', 'files/street_light_issue.pdf', 'Under Observation', NULL, NULL),
(4, 'Garbage Collection Delay', 'Garbage has not been collected for the past week.', 'Sanitation', '2024-05-04', 'Barangay 4', 'files/garbage_collection_delay.pdf', 'Under Observation', NULL, NULL),
(5, 'Road Damage', 'The main road in our area has several potholes that need immediate repair.', 'Infrastructure', '2024-05-05', 'Barangay 5', 'files/road_damage.pdf', 'Under Observation', NULL, NULL),
(6, 'wawawaa', 'sfnvpn en gnip n twil n fnfjg iwn n ptepin neknkn', 'Public', '2024-05-23', 'Lower Jasaan Purok 2', '', 'Actioned', NULL, NULL),
(7, 'wawawaa', 'sfnvpn en gnip n twil n fnfjg iwn n ptepin neknkn', 'Public', '2024-05-23', 'Lower Jasaan Purok 2', '', '', NULL, NULL),
(8, 'Wa na nanghatag og balon si madam', 'I got no money/allowance anymore', 'Private', '2024-10-21', 'Lower Jasaan', '', '', 'shairojames', '09191234567');

-- --------------------------------------------------------

--
-- Table structure for table `household`
--

CREATE TABLE `household` (
  `ID` int(11) NOT NULL,
  `household_leader` varchar(255) NOT NULL,
  `number` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `social_status` enum('indigent','average','above average') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `household`
--

INSERT INTO `household` (`ID`, `household_leader`, `number`, `address`, `social_status`) VALUES
(1, 'Ranan Genia', '7', 'Lower Jasaan Misamis Oriental', 'average');

-- --------------------------------------------------------

--
-- Table structure for table `officials`
--

CREATE TABLE `officials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `contactnum` varchar(20) NOT NULL,
  `image` blob NOT NULL,
  `yearofterm` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `officials`
--

INSERT INTO `officials` (`id`, `name`, `position`, `barangay`, `age`, `contactnum`, `image`, `yearofterm`) VALUES
(5, 'shairo', 'Secretary', 'jasaan', 22, '09161165176', 0x75706c6f6164732f636f6d706c61696e742e77656270, '2022-2025'),
(13, 'chester', 'kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f6d696775656c69746f2e6a7067, '2022-2025'),
(14, 'chester', 'kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f6d696775656c69746f2e6a7067, '2022-2025'),
(15, 'cherry', 'kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f6164762e6a7067, '2022-2025'),
(16, 'lovely', 'kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f7164732e6a7067, '2022-2025'),
(17, 'charlie', 'kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f6c6562726f6f6e2e6a666966, '2022-2025'),
(18, 'shaiwoo', 'kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f616473782e6a7067, '2022-2025'),
(19, 'scott', 'Kapitan', 'jasaan', 22, '09161165176', 0x696d616765732f6c756b612e6a666966, '2022-2025'),
(20, 'line', 'sk chairman', 'jasaan', 22, '09161165176', 0x696d616765732f6d656d652e6a7067, '2022-2025'),
(21, 'meena', 'sk kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f726f73652e6a7067, '2022-2025'),
(22, 'nina', 'sk kagawad', 'jasaan', 22, '09161165176', 0x696d616765732f61772e6a7067, '2022-2025'),
(23, 'Batang Brayt', 'kapitan', 'Jampason Jasaan Misamis Oriental', 22, '09161165176', 0x696d616765732f, '2022-2025'),
(24, 'Jan chester ', 'kapitan', 'Upper Jasaan Misamis Oriental', 22, '09161165176', 0x696d616765732f73746570702e6a666966, '2022-2025');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `age` int(11) NOT NULL,
  `status` enum('Student','Employed','Unemployed','Child','Deceased') NOT NULL,
  `voter` enum('yes','no') NOT NULL DEFAULT 'no',
  `birth_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`id`, `name`, `address`, `gender`, `age`, `status`, `voter`, `birth_date`) VALUES
(1, 'Tomimbang,', 'Jampason Jasaan Misamis Oriental', 'Female', 21, 'Student', 'yes', '2002-07-05'),
(4, 'Primer Charlie Jay ', 'Kimaya Jasaan Misamis Oriental', 'Male', 22, 'Student', 'yes', '2001-10-05'),
(7, 'Ranan, John Paul', 'Lower Jasaan Misamis Oriental', 'Male', 27, 'Employed', 'no', '1996-04-09'),
(9, 'Jamero, Normena P.', 'Lower Jasaan Misamis Oriental', 'Female', 21, 'Student', 'yes', '2002-07-27'),
(11, 'Gahay, Shenna Jane ', 'Jampason Jasaan Misamis Oriental', 'Female', 22, 'Employed', 'yes', '2001-12-06'),
(18, 'Pahunang, James Shairo N.', 'Lower Jasaan Misamis Oriental', 'Male', 28, 'Student', 'yes', '1995-04-29'),
(19, 'Tumimbang, Jafe Kairos ', 'Jampason Jasaan Misamis Oriental', 'Male', 4, 'Child', 'no', '2019-07-26'),
(22, 'Ellezo Ezekiel Kalen ', 'Kimaya Jasaan Misamis Oriental', 'Female', 1, 'Child', 'no', '2022-06-03'),
(23, 'Pahunang, James Cyrel', 'Bobontugan Jasaaan Misamis Oriental', 'Male', 27, 'Unemployed', 'yes', '1997-04-16'),
(24, 'Bensig Ann Jelica Mae', 'Upper Jasaan Misamis Oriental', 'Female', 33, 'Student', 'yes', '1990-04-30');

--
-- Triggers `resident`
--
DELIMITER $$
CREATE TRIGGER `resident_delete_trigger` AFTER DELETE ON `resident` FOR EACH ROW BEGIN
    INSERT INTO resident_archive (id, name, address, gender, age, status, voter, birth_date, deleted_at)
    VALUES (OLD.id, OLD.name, OLD.address, OLD.gender, OLD.age, OLD.status, OLD.voter, OLD.birth_date, NOW());
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `resident_archive`
--

CREATE TABLE `resident_archive` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `voter` tinyint(1) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resident_archive`
--

INSERT INTO `resident_archive` (`id`, `name`, `address`, `gender`, `age`, `status`, `voter`, `birth_date`, `deleted_at`) VALUES
(26, 'Batang Brayt', 'Lower Jasaan, Jasaaan Misamis Oriental', '', 0, '', 0, '0000-00-00', '2024-04-22 21:05:19'),
(3, 'Ranan Genia', 'Lower Jasaan Misamis Oriental', 'Female', 59, 'Employed', 1, '1962-01-20', '2024-05-22 04:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `pic` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `pic`) VALUES
(1, 'James Shairo Pahunang', 'jamesshairo@gmail.com', '$2y$10$Y6Rf1YvXlPcl9bs4H5IBmOHOs37M0WEanxuGgrEYDd.7veNnHxa0.', 'Super Admin', NULL),
(2, 'Lovely Vanessa Tomimbang', 'lovelyvanessa@gmail.com', '$2y$10$tVuY69BwOBiFQ52xih/8o.59lt9ZvOHudpMM/g3AcaHatsRFIGm0S', 'Admin Jampason', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barangay`
--
ALTER TABLE `barangay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_id` (`activity_id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `household`
--
ALTER TABLE `household`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `officials`
--
ALTER TABLE `officials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `household`
--
ALTER TABLE `household`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `officials`
--
ALTER TABLE `officials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`activity_id`) REFERENCES `activities` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
