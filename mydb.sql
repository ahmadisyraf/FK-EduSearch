-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 17, 2023 at 06:31 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminid` int NOT NULL,
  `adminFullName` varchar(60) NOT NULL,
  `adminEmail` varchar(60) NOT NULL,
  `adminPassword` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminid`, `adminFullName`, `adminEmail`, `adminPassword`) VALUES
(9, 'AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA', 'isyrafmagic@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `commentid` int NOT NULL,
  `userid` int NOT NULL,
  `postid` int NOT NULL,
  `comment` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaintid` int NOT NULL,
  `userid` int NOT NULL,
  `complaintDate` datetime NOT NULL,
  `complaintType` varchar(60) NOT NULL,
  `complaintDescription` varchar(60) NOT NULL,
  `complaintStatus` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expert`
--

CREATE TABLE `expert` (
  `expertid` int NOT NULL,
  `expertFullName` varchar(60) NOT NULL,
  `expertEmail` varchar(60) NOT NULL,
  `expertPassword` varchar(60) NOT NULL,
  `expertUsername` varchar(60) NOT NULL,
  `researchAcademicStatus` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expertCV` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expertUpdateProfileStatus` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expertAccountStatus` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `expertOnlineStatus` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `expert`
--

INSERT INTO `expert` (`expertid`, `expertFullName`, `expertEmail`, `expertPassword`, `expertUsername`, `researchAcademicStatus`, `expertCV`, `expertUpdateProfileStatus`, `expertAccountStatus`, `expertOnlineStatus`) VALUES
(1, 'AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA', 'isyrafmagic@gmail.com', '12345', 'isyrafmagic', '', NULL, 'Accepted', 'Deactive', 'Offline'),
(3, 'AHMAD BADRUDDIN ZAINI ', 'badzaini28@gmail.com', '12345', 'badzaini', '', NULL, 'Accepted', 'Active', 'Offline');

-- --------------------------------------------------------

--
-- Table structure for table `expertlogin`
--

CREATE TABLE `expertlogin` (
  `expertloginid` int NOT NULL,
  `expertid` int NOT NULL,
  `expertLastLoginDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expertlogin`
--

INSERT INTO `expertlogin` (`expertloginid`, `expertid`, `expertLastLoginDate`) VALUES
(3, 1, '2023-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackid` int NOT NULL,
  `userid` int NOT NULL,
  `feedback` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `likeid` int NOT NULL,
  `userid` int NOT NULL,
  `postid` int NOT NULL,
  `like` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `postid` int NOT NULL,
  `userid` int DEFAULT NULL,
  `replyid` int DEFAULT NULL,
  `postTopic` varchar(60) NOT NULL,
  `postContent` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `postCategory` varchar(60) NOT NULL,
  `postDate` varchar(60) NOT NULL,
  `postStatus` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`postid`, `userid`, `replyid`, `postTopic`, `postContent`, `postCategory`, `postDate`, `postStatus`) VALUES
(8, 1, NULL, 'How to code in Laravel', 'Kawan saya luqman hakim suka orang yang boleh code laravel. Tapi saya boleh code dalam react dgn next je. Tolong saya. Saya dah buntu', 'Software Engineering', '1686960000', NULL),
(9, 1, NULL, 'apash busuk', '12345', 'Software Engineering', '1686960000', NULL),
(10, 1, NULL, 'man usuk', 'ushyyinyaaa man', 'Software Engineering', '1686960000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `publication`
--

CREATE TABLE `publication` (
  `publicationid` int NOT NULL,
  `expertid` int NOT NULL,
  `publicationTitle` varchar(60) NOT NULL,
  `publicationDate` varchar(60) NOT NULL,
  `publicationCategory` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `publication`
--

INSERT INTO `publication` (`publicationid`, `expertid`, `publicationTitle`, `publicationDate`, `publicationCategory`) VALUES
(3, 1, 'sdad', 'sdasd', 'dadas'),
(4, 1, 'sdad', 'dasfgdrgtd', 'we567890');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `ratingid` int NOT NULL,
  `userid` int NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `replyid` int NOT NULL,
  `expertid` int NOT NULL,
  `postid` int NOT NULL,
  `feedbackid` int NOT NULL,
  `ratingid` int NOT NULL,
  `reply` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `reportid` int NOT NULL,
  `postid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `researchid` int NOT NULL,
  `adminid` int NOT NULL,
  `researchPaperTitle` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `researchRole` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `researchStatus` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`researchid`, `adminid`, `researchPaperTitle`, `researchRole`, `researchStatus`) VALUES
(1, 1, 'cubaan title', 'cubaan role', 'cubaan status'),
(2, 1, 'FFSFDFS', 'FSFSF', 'FSFD'),
(3, 1, 'esrsdffdsdfs', 'fdsfsdfsfd', 'fsdfdsfsdfs');

-- --------------------------------------------------------

--
-- Table structure for table `researcharea`
--

CREATE TABLE `researcharea` (
  `researchareaid` int NOT NULL,
  `userid` int NOT NULL,
  `researchTitle` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `researcharea`
--

INSERT INTO `researcharea` (`researchareaid`, `userid`, `researchTitle`) VALUES
(1, 1, 'Software Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int NOT NULL,
  `userFullName` varchar(60) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userPassword` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `userAcademicStatus` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `userUpdateProfileStatus` varchar(60) DEFAULT NULL,
  `userOnlineStatus` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `userFullName`, `userEmail`, `userPassword`, `username`, `userAcademicStatus`, `userUpdateProfileStatus`, `userOnlineStatus`) VALUES
(1, 'AHMAD ISYRAF BIN MOHD FAISHAL-ADZHA', 'isyrafmagic@gmail.com', '12345', 'isyrafmagic', 'Degree', 'Pending', 'Online'),
(7, 'AIMAN BIN MUHD SABRI', 'aiman@gmail.com', '12345', 'aimansabri', '', 'Pending', 'Online');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminid`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`commentid`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaintid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `expert`
--
ALTER TABLE `expert`
  ADD PRIMARY KEY (`expertid`);

--
-- Indexes for table `expertlogin`
--
ALTER TABLE `expertlogin`
  ADD PRIMARY KEY (`expertloginid`),
  ADD KEY `expertid` (`expertid`);

--
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`likeid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`postid`),
  ADD KEY `replyid` (`replyid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`publicationid`),
  ADD KEY `expertid` (`expertid`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`ratingid`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`replyid`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`reportid`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`researchid`),
  ADD KEY `adminid` (`adminid`);

--
-- Indexes for table `researcharea`
--
ALTER TABLE `researcharea`
  ADD PRIMARY KEY (`researchareaid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `commentid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaintid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expert`
--
ALTER TABLE `expert`
  MODIFY `expertid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expertlogin`
--
ALTER TABLE `expertlogin`
  MODIFY `expertloginid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `likeid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `postid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `publication`
--
ALTER TABLE `publication`
  MODIFY `publicationid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `ratingid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `replyid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `reportid` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `researchid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `researcharea`
--
ALTER TABLE `researcharea`
  MODIFY `researchareaid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaint`
--
ALTER TABLE `complaint`
  ADD CONSTRAINT `complaint_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `expertlogin`
--
ALTER TABLE `expertlogin`
  ADD CONSTRAINT `expertlogin_ibfk_1` FOREIGN KEY (`expertid`) REFERENCES `expert` (`expertid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_3` FOREIGN KEY (`replyid`) REFERENCES `reply` (`replyid`),
  ADD CONSTRAINT `post_ibfk_4` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `publication_ibfk_1` FOREIGN KEY (`expertid`) REFERENCES `expert` (`expertid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `research`
--
ALTER TABLE `research`
  ADD CONSTRAINT `research_ibfk_1` FOREIGN KEY (`adminid`) REFERENCES `expert` (`expertid`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `researcharea`
--
ALTER TABLE `researcharea`
  ADD CONSTRAINT `researcharea_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
