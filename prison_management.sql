-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2024 at 01:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prison_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `Admin_ID` int(11) NOT NULL,
  `Admin_Name` varchar(100) NOT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`Admin_ID`, `Admin_Name`, `Contact`, `Email`) VALUES
(2, 'Jane Smith', '0987654321', 'jane.smith@example.com'),
(3, 'amir', '', 'd@gmail.com'),
(4, 'aaa', '010101', 'q@gmail.com'),
(5, 'amar', '737373', 'fff@gmail.com'),
(6, 'Jane Smith', '0987654326', 'jane.smith@example.com'),
(7, 'Jane Smith', '0987654326', 'jane.smith@example.com'),
(8, 'Jane Smith', '0987654326', 'jane.smith@example.com'),
(9, 'as', '222', 'bhyd@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `govorn`
--

CREATE TABLE `govorn` (
  `Admin_ID` int(11) NOT NULL,
  `Jailor_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `govorn`
--

INSERT INTO `govorn` (`Admin_ID`, `Jailor_ID`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `guards`
--

CREATE TABLE `guards` (
  `Guard_ID` int(11) NOT NULL,
  `Guard_Name` varchar(100) NOT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Residence` varchar(100) DEFAULT NULL,
  `Duty_hours` int(11) DEFAULT NULL,
  `Shift` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guards`
--

INSERT INTO `guards` (`Guard_ID`, `Guard_Name`, `Contact`, `Residence`, `Duty_hours`, `Shift`) VALUES
(1, 'Michael Scott', '5555050505', 'Dhaka', 8, 'Morning'),
(2, 'Dwight Schrute', '5556060606', 'Chittagong', 12, 'Night'),
(3, 'mcdjxdsjxd', '8747474', 'njdjdjdjd', 20, 'vava'),
(4, 'babab', '8748474', 'nfhfhfy', 47, 'hdhd');

-- --------------------------------------------------------

--
-- Table structure for table `jailor`
--

CREATE TABLE `jailor` (
  `Jailor_ID` int(11) NOT NULL,
  `Jailor_Name` varchar(100) NOT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Qualification` varchar(100) DEFAULT NULL,
  `Residence` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jailor`
--

INSERT INTO `jailor` (`Jailor_ID`, `Jailor_Name`, `Contact`, `Email`, `Qualification`, `Residence`) VALUES
(1, 'Alice Johnson', '1231231234', 'alice.johnson@example.com', 'Bachelor of Criminology', 'Dhaka'),
(2, 'Bob Brown', '3213213210', 'bob.brown@example.com', 'Master of Security Management', 'Chittagong'),
(3, 'hamza', '', 'qqq@gmail.com', 'ababa', ''),
(4, 'nd', '', 'j@gmail.com', 'dn', ''),
(5, 'aaa', '', 'ff@gmail.com', 'a', ''),
(6, 'aaw2', '', 'r@gmail.com', 'vfddd', ''),
(7, 'ccc', '', 'bka@gmail.com', 'dgdfgdgdgdgdgdg', ''),
(8, 'coc', '', 'ss@gmail.com', 'kdkdkd', ''),
(9, 'boom', '', 'kao@gmail.com', 'njdjdjd', ''),
(10, 'dddd', '', 'mm@gmail.com', 'njhdjdhdhd', ''),
(11, 'jahin', '010101', 'h@gmail.com', 'mamama', 'mama');

-- --------------------------------------------------------

--
-- Table structure for table `keep`
--

CREATE TABLE `keep` (
  `Pri_ID` int(11) NOT NULL,
  `Guard_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keep`
--

INSERT INTO `keep` (`Pri_ID`, `Guard_ID`) VALUES
(1, 1),
(2, 2),
(2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `manage`
--

CREATE TABLE `manage` (
  `Guard_ID` int(11) NOT NULL,
  `Admin_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `manage`
--

INSERT INTO `manage` (`Guard_ID`, `Admin_ID`) VALUES
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `prison`
--

CREATE TABLE `prison` (
  `Prison_ID` int(11) NOT NULL,
  `Prison_Name` varchar(100) NOT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `No_of_prisoners` int(11) DEFAULT NULL,
  `Capacity` int(11) DEFAULT NULL,
  `Jailor_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prison`
--

INSERT INTO `prison` (`Prison_ID`, `Prison_Name`, `Contact`, `Location`, `Email`, `No_of_prisoners`, `Capacity`, `Jailor_ID`) VALUES
(1, 'Central Prison Dhaka', '5551234567', 'Dhaka', 'cp.dhaka@example.com', 500, 1000, 1),
(2, 'Chittagong Prison', '5559876543', 'Chittagong', 'cp.chittagong@example.com', 300, 800, 2);

-- --------------------------------------------------------

--
-- Table structure for table `prisoner`
--

CREATE TABLE `prisoner` (
  `Pri_ID` int(11) NOT NULL,
  `Prisoner_Name` varchar(100) NOT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Residence` varchar(100) DEFAULT NULL,
  `Crime` varchar(200) DEFAULT NULL,
  `Punishment` varchar(200) DEFAULT NULL,
  `Relative_details` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisoner`
--

INSERT INTO `prisoner` (`Pri_ID`, `Prisoner_Name`, `Contact`, `Email`, `Residence`, `Crime`, `Punishment`, `Relative_details`) VALUES
(1, 'Tom Williams', '5551010101', 'tom.williams@example.com', 'Dhaka', 'Theft', '5 years', 'John Williams, Brother'),
(2, 'Jerry Miller', '5552020202', 'jerry.miller@example.com', 'Chittagong', 'Robbery', '7 years', 'Sarah Miller, Sister');

-- --------------------------------------------------------

--
-- Table structure for table `prisoner_in_prison`
--

CREATE TABLE `prisoner_in_prison` (
  `Pri_ID` int(11) NOT NULL,
  `Prison_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prisoner_in_prison`
--

INSERT INTO `prisoner_in_prison` (`Pri_ID`, `Prison_ID`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `role`) VALUES
(1, 'a@gmail.com', '$2y$10$A8SwxWyo9c8e2Br7VPK0Le9nFr2MLnTEnw4uz6K/AqaFxho1npqHC', 'jailors'),
(2, 'b@gmail.com', '$2y$10$TIxjzuX31n6T6dfByCPt8.7kPPoo1KEnpG6TxAkfsmE9vbIvWtqG.', 'guards'),
(3, 'c@gmail.com', '$2y$10$VIw6PoTf0Q7XQeygWFKVTeuVhn97Uy7Ibdj5V1GmD26iEobB/Ko.i', 'admin'),
(4, 'd@gmail.com', '$2y$10$griXEEFyIU9a/kodFvFTaemfnXn1BNKBdDcuPVor5BDindBXYPQKG', 'admin'),
(5, 'q@gmail.com', '$2y$10$11chjlXNmVQJvvEIbOYtQu2/Njvc.5FHDX8KtdF4TS5.yR6tyUfRS', 'admin'),
(6, 'qqq@gmail.com', '$2y$10$PC/HeJ3zT.2YRXDuGr1Jle69r041lxjNZn0m0TiHD.0SUSBiFL2BW', 'jailors'),
(7, 'j@gmail.com', '$2y$10$cfihI/a8Yb2cQokswD3h8uon/pbYkOgk/V7zpQ1M/W1AdJIu1u5va', 'jailors'),
(8, 'ff@gmail.com', '$2y$10$cqYkiZGKIYQ3gCILxTrQS.UVW5W2stquIjBjvrdXmMOd7QpzAKqyW', 'jailors'),
(9, 'r@gmail.com', '$2y$10$rfewoYimtcszhrYhPuVeo.2M1EGa2gVABHa5CJaRR0zlYSjB1pvB2', 'jailors'),
(10, 'bka@gmail.com', '$2y$10$IOShryP8moj2aKWhDfp0gu8XZXX7ro7C6zNQluX/QPon8L6M66MPy', 'jailors'),
(11, 'ss@gmail.com', '$2y$10$UuWFHPI8Kr8z0ysbmJRkWethIpGvQ9WLdmoJWFBnsZpqY5Udaw.bK', 'jailors'),
(12, 'kao@gmail.com', '$2y$10$X5QV2Ux11bA1nPQQCQH5J.SFJdEf3f4qZTv3W5UcnmoEH7SsZ4DlS', 'jailors'),
(13, 'mm@gmail.com', '$2y$10$aCN063jdKBkgIFWSaD9/O.FHHTCUbRNPqQZ6.HLMc/C09eUQ/M5wq', 'jailors'),
(14, 'bfr@gmail.com', '$2y$10$vzxZqcYUZqGE.SWdf16JM.F7ablEDwDva0jqYjmpsiI65MbXFVSJW', 'guards'),
(15, 'fa@gmail.com', '$2y$10$pnG6Lwnc3KNZPviRnbRrkOeBF2dyHk.kwuobPRsK0jF60z4mp5AaC', 'visitors'),
(16, 'h@gmail.com', '$2y$10$pxhCkKihzU/t5H8MjlioN.pbvTA.kuQF00iAKbQnRD2zl197j.nkm', 'jailors'),
(17, 'fff@gmail.com', '$2y$10$Xfb1d4YvdxjJFk.ziB2zhOJsryn7sTQ084gIeE72LULqRf8zGiyCu', 'admin'),
(18, 'ccc@gmail.com', '$2y$10$Nd9kwcPMypXYmIzbZKeYiucizbT1PAWXdcCMIi8atgU5W9CF3q6lq', 'guards'),
(19, 'hdr@gmail.com', '$2y$10$CW40IM.XneCBqKzt3t82G.R3KvUhHHdCrlDaxvvkJn1SFW.2hEwJq', 'visitors'),
(20, 'u@gmail.com', '$2y$10$uc55OjW3NDC5GYubFbeYv.cUJTrgTZRj6KMWcs6.a01f9MKbKe1MW', 'visitors'),
(22, 'v@gmail.com', '$2y$10$t8eBxObKl1ZK/wvdXG039eCURtG3TMfUFiQvkisUtMaZSeUpLvBy6', 'visitors'),
(23, 'bhyd@gmail.com', '$2y$10$arcN4Rbo1nykVAj9RY0aa.2y2oyzzHcdrrj4Hs/29oC1iuBJtolIy', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `V_ID` int(11) NOT NULL,
  `Visitor_Name` varchar(100) NOT NULL,
  `Relationship` varchar(100) DEFAULT NULL,
  `Contact` varchar(15) DEFAULT NULL,
  `U_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`V_ID`, `Visitor_Name`, `Relationship`, `Contact`, `U_ID`) VALUES
(1, 'John Williams', 'Brother', '5553030303', NULL),
(2, 'Sarah Miller', 'Sister', '5554040404', NULL),
(3, 'nana', 'mama', '', NULL),
(4, 'mama', 'mama', '0101', NULL),
(5, 'farhan', 'baa', '838387', NULL),
(6, 'jahin', 'ss', '88', 22);

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `V_ID` int(11) NOT NULL,
  `Pri_ID` int(11) NOT NULL,
  `Approved` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visits`
--

INSERT INTO `visits` (`V_ID`, `Pri_ID`, `Approved`) VALUES
(1, 1, '0000-00-00 00:00:00'),
(2, 2, '0000-00-00 00:00:00'),
(3, 2, '0000-00-00 00:00:00'),
(4, 1, '0000-00-00 00:00:00'),
(4, 2, '0000-00-00 00:00:00'),
(6, 1, '0000-00-00 00:00:00'),
(6, 2, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `govorn`
--
ALTER TABLE `govorn`
  ADD PRIMARY KEY (`Admin_ID`,`Jailor_ID`),
  ADD KEY `Jailor_ID` (`Jailor_ID`);

--
-- Indexes for table `guards`
--
ALTER TABLE `guards`
  ADD PRIMARY KEY (`Guard_ID`);

--
-- Indexes for table `jailor`
--
ALTER TABLE `jailor`
  ADD PRIMARY KEY (`Jailor_ID`);

--
-- Indexes for table `keep`
--
ALTER TABLE `keep`
  ADD PRIMARY KEY (`Pri_ID`,`Guard_ID`),
  ADD KEY `Guard_ID` (`Guard_ID`);

--
-- Indexes for table `manage`
--
ALTER TABLE `manage`
  ADD PRIMARY KEY (`Guard_ID`,`Admin_ID`),
  ADD KEY `Admin_ID` (`Admin_ID`);

--
-- Indexes for table `prison`
--
ALTER TABLE `prison`
  ADD PRIMARY KEY (`Prison_ID`),
  ADD KEY `Jailor_ID` (`Jailor_ID`);

--
-- Indexes for table `prisoner`
--
ALTER TABLE `prisoner`
  ADD PRIMARY KEY (`Pri_ID`);

--
-- Indexes for table `prisoner_in_prison`
--
ALTER TABLE `prisoner_in_prison`
  ADD PRIMARY KEY (`Pri_ID`,`Prison_ID`),
  ADD KEY `Prison_ID` (`Prison_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`V_ID`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`V_ID`,`Pri_ID`),
  ADD KEY `Pri_ID` (`Pri_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `guards`
--
ALTER TABLE `guards`
  MODIFY `Guard_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jailor`
--
ALTER TABLE `jailor`
  MODIFY `Jailor_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prison`
--
ALTER TABLE `prison`
  MODIFY `Prison_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prisoner`
--
ALTER TABLE `prisoner`
  MODIFY `Pri_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `V_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `govorn`
--
ALTER TABLE `govorn`
  ADD CONSTRAINT `govorn_ibfk_1` FOREIGN KEY (`Admin_ID`) REFERENCES `administrator` (`Admin_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `govorn_ibfk_2` FOREIGN KEY (`Jailor_ID`) REFERENCES `jailor` (`Jailor_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keep`
--
ALTER TABLE `keep`
  ADD CONSTRAINT `keep_ibfk_1` FOREIGN KEY (`Pri_ID`) REFERENCES `prisoner` (`Pri_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `keep_ibfk_2` FOREIGN KEY (`Guard_ID`) REFERENCES `guards` (`Guard_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manage`
--
ALTER TABLE `manage`
  ADD CONSTRAINT `manage_ibfk_1` FOREIGN KEY (`Guard_ID`) REFERENCES `guards` (`Guard_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `manage_ibfk_2` FOREIGN KEY (`Admin_ID`) REFERENCES `administrator` (`Admin_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prison`
--
ALTER TABLE `prison`
  ADD CONSTRAINT `prison_ibfk_1` FOREIGN KEY (`Jailor_ID`) REFERENCES `jailor` (`Jailor_ID`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `prisoner_in_prison`
--
ALTER TABLE `prisoner_in_prison`
  ADD CONSTRAINT `prisoner_in_prison_ibfk_1` FOREIGN KEY (`Pri_ID`) REFERENCES `prisoner` (`Pri_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prisoner_in_prison_ibfk_2` FOREIGN KEY (`Prison_ID`) REFERENCES `prison` (`Prison_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `visits`
--
ALTER TABLE `visits`
  ADD CONSTRAINT `visits_ibfk_1` FOREIGN KEY (`V_ID`) REFERENCES `visitors` (`V_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visits_ibfk_2` FOREIGN KEY (`Pri_ID`) REFERENCES `prisoner` (`Pri_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
