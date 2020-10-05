-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 04, 2020 at 09:22 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbu19049782`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbalbum`
--

CREATE TABLE `tbalbum` (
  `ID` int(11) NOT NULL,
  `albumID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbalbumdetail`
--

CREATE TABLE `tbalbumdetail` (
  `albumID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `privacy` varchar(10) NOT NULL DEFAULT 'public'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbalbumparticipant`
--

CREATE TABLE `tbalbumparticipant` (
  `ID` int(11) NOT NULL,
  `albumID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbcomment`
--

CREATE TABLE `tbcomment` (
  `ID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `timeStamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbfollower`
--

CREATE TABLE `tbfollower` (
  `ID` int(11) NOT NULL,
  `userID1` int(11) NOT NULL,
  `userID2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbhashtag`
--

CREATE TABLE `tbhashtag` (
  `ID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `hashtag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbmessage`
--

CREATE TABLE `tbmessage` (
  `ID` int(11) NOT NULL,
  `senderUserID` int(11) NOT NULL,
  `receiverUserID` int(11) NOT NULL,
  `message` varchar(50) NOT NULL,
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbpost`
--

CREATE TABLE `tbpost` (
  `imageID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `stars` int(11) NOT NULL DEFAULT '0',
  `timeStamp` datetime DEFAULT NULL,
  `fileLocation` varchar(50) NOT NULL DEFAULT 'default'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbreportreason`
--

CREATE TABLE `tbreportreason` (
  `ID` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `userID` int(11) NOT NULL,
  `userType` varchar(10) NOT NULL DEFAULT 'user',
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `profileImage` varchar(50) DEFAULT 'default',
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbalbum`
--
ALTER TABLE `tbalbum`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbAlbum_tbalbumdetail_albumID_fk` (`albumID`),
  ADD KEY `tbAlbum_tbpost_imageID_fk` (`imageID`);

--
-- Indexes for table `tbalbumdetail`
--
ALTER TABLE `tbalbumdetail`
  ADD PRIMARY KEY (`albumID`),
  ADD KEY `tbAlbumDetails_tbuser_userID_fk` (`userID`);

--
-- Indexes for table `tbalbumparticipant`
--
ALTER TABLE `tbalbumparticipant`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbAlbumParticipants_tbalbumdetails_albumID_fk` (`albumID`),
  ADD KEY `tbAlbumParticipants_tbuser_userID_fk` (`userID`);

--
-- Indexes for table `tbcomment`
--
ALTER TABLE `tbcomment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbComments_tbpost_imageID_fk` (`imageID`);

--
-- Indexes for table `tbfollower`
--
ALTER TABLE `tbfollower`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbFollower_tbuser_userID_fk` (`userID1`),
  ADD KEY `tbFollower_tbuser_userID_fk_2` (`userID2`);

--
-- Indexes for table `tbhashtag`
--
ALTER TABLE `tbhashtag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbHashtags_tbpost_imageID_fk` (`imageID`);

--
-- Indexes for table `tbmessage`
--
ALTER TABLE `tbmessage`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbMessage_tbuser_userID_fk` (`senderUserID`),
  ADD KEY `tbMessage_tbuser_userID_fk_2` (`receiverUserID`);

--
-- Indexes for table `tbpost`
--
ALTER TABLE `tbpost`
  ADD PRIMARY KEY (`imageID`),
  ADD KEY `tbPost_tbuser_userID_fk` (`userID`);

--
-- Indexes for table `tbreportreason`
--
ALTER TABLE `tbreportreason`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbalbum`
--
ALTER TABLE `tbalbum`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbalbumdetail`
--
ALTER TABLE `tbalbumdetail`
  MODIFY `albumID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbalbumparticipant`
--
ALTER TABLE `tbalbumparticipant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbcomment`
--
ALTER TABLE `tbcomment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbfollower`
--
ALTER TABLE `tbfollower`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbhashtag`
--
ALTER TABLE `tbhashtag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbmessage`
--
ALTER TABLE `tbmessage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpost`
--
ALTER TABLE `tbpost`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbreportreason`
--
ALTER TABLE `tbreportreason`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbalbum`
--
ALTER TABLE `tbalbum`
  ADD CONSTRAINT `tbAlbum_tbalbumdetail_albumID_fk` FOREIGN KEY (`albumID`) REFERENCES `tbalbumdetail` (`albumID`),
  ADD CONSTRAINT `tbAlbum_tbpost_imageID_fk` FOREIGN KEY (`imageID`) REFERENCES `tbpost` (`imageID`);

--
-- Constraints for table `tbalbumdetail`
--
ALTER TABLE `tbalbumdetail`
  ADD CONSTRAINT `tbAlbumDetails_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`);

--
-- Constraints for table `tbalbumparticipant`
--
ALTER TABLE `tbalbumparticipant`
  ADD CONSTRAINT `tbAlbumParticipants_tbalbumdetails_albumID_fk` FOREIGN KEY (`albumID`) REFERENCES `tbalbumdetail` (`albumID`),
  ADD CONSTRAINT `tbAlbumParticipants_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`);

--
-- Constraints for table `tbcomment`
--
ALTER TABLE `tbcomment`
  ADD CONSTRAINT `tbComments_tbpost_imageID_fk` FOREIGN KEY (`imageID`) REFERENCES `tbpost` (`imageID`);

--
-- Constraints for table `tbfollower`
--
ALTER TABLE `tbfollower`
  ADD CONSTRAINT `tbFollower_tbuser_userID_fk` FOREIGN KEY (`userID1`) REFERENCES `tbuser` (`userID`),
  ADD CONSTRAINT `tbFollower_tbuser_userID_fk_2` FOREIGN KEY (`userID2`) REFERENCES `tbuser` (`userID`);

--
-- Constraints for table `tbhashtag`
--
ALTER TABLE `tbhashtag`
  ADD CONSTRAINT `tbHashtags_tbpost_imageID_fk` FOREIGN KEY (`imageID`) REFERENCES `tbpost` (`imageID`);

--
-- Constraints for table `tbmessage`
--
ALTER TABLE `tbmessage`
  ADD CONSTRAINT `tbMessage_tbuser_userID_fk` FOREIGN KEY (`senderUserID`) REFERENCES `tbuser` (`userID`),
  ADD CONSTRAINT `tbMessage_tbuser_userID_fk_2` FOREIGN KEY (`receiverUserID`) REFERENCES `tbuser` (`userID`);

--
-- Constraints for table `tbpost`
--
ALTER TABLE `tbpost`
  ADD CONSTRAINT `tbPost_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
