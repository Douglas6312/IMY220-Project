-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2020 at 09:17 PM
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
  `albumID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `privacy` varchar(10) NOT NULL DEFAULT 'public',
  `timeStamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbalbum`
--

INSERT INTO `tbalbum` (`albumID`, `userID`, `title`, `description`, `privacy`, `timeStamp`) VALUES
(30, 25, 'Travel Life', 'Do what i do best', 'public', '2020-11-08 18:10:16'),
(40, 27, 'Let the adventure begin', 'What ever my heart desires', 'public', '2020-11-08 18:49:13'),
(44, 25, 'Nature', 'Going for a walk', 'private', '2020-11-08 18:12:26'),
(45, 29, 'Passion', 'Where passion over flows', 'private', '2020-11-08 19:29:14'),
(46, 30, 'Welcome Album', 'My First Album', 'private', '2020-11-08 19:50:51'),
(47, 31, 'The story is all in the eyes', 'Anyone that catches my eye', 'public', '2020-11-08 19:57:10'),
(48, 33, 'Just having Fun', 'Take pictuers of things i enjoy', 'public', '2020-11-08 20:23:37'),
(49, 34, 'Things that inspire', 'Capturing the best day of peoples lives', 'public', '2020-11-08 20:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbalbumhashtag`
--

CREATE TABLE `tbalbumhashtag` (
  `ID` int(11) NOT NULL,
  `albumID` int(11) NOT NULL,
  `hashtag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbalbumhashtag`
--

INSERT INTO `tbalbumhashtag` (`ID`, `albumID`, `hashtag`) VALUES
(56, 30, '#Wow'),
(57, 30, '#ineedaholiday'),
(58, 30, '#hardwork'),
(59, 30, '#IMY220'),
(62, 44, '#nature'),
(63, 44, '#beuty'),
(64, 40, '#passion'),
(65, 40, '#Welcome'),
(67, 45, '#passion'),
(68, 45, '#photography'),
(69, 46, '#Welcome'),
(71, 47, '#potraits'),
(72, 47, '#eyes'),
(75, 48, '#enjoy'),
(78, 49, '#wedding'),
(79, 49, '#love');

-- --------------------------------------------------------

--
-- Table structure for table `tbalbumparticipant`
--

CREATE TABLE `tbalbumparticipant` (
  `ID` int(11) NOT NULL,
  `albumID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbalbumparticipant`
--

INSERT INTO `tbalbumparticipant` (`ID`, `albumID`, `userID`) VALUES
(24, 44, 27),
(25, 47, 25),
(26, 48, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tbfollower`
--

CREATE TABLE `tbfollower` (
  `ID` int(11) NOT NULL,
  `userIDFollower` int(11) NOT NULL,
  `userIDFollowing` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbfollower`
--

INSERT INTO `tbfollower` (`ID`, `userIDFollower`, `userIDFollowing`) VALUES
(13, 27, 25),
(16, 25, 27),
(17, 29, 25),
(18, 29, 27),
(19, 30, 29),
(20, 31, 25),
(21, 25, 31),
(22, 32, 31),
(23, 32, 30),
(24, 33, 27),
(25, 27, 33),
(26, 34, 27),
(27, 34, 25),
(28, 33, 34),
(30, 25, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tbmessage`
--

CREATE TABLE `tbmessage` (
  `ID` int(11) NOT NULL,
  `senderUserID` int(11) NOT NULL,
  `receiverUserID` int(11) NOT NULL,
  `message` varchar(50) NOT NULL,
  `timeStamp` datetime NOT NULL,
  `hasRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbpost`
--

CREATE TABLE `tbpost` (
  `imageID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `caption` varchar(50) NOT NULL,
  `stars` int(11) NOT NULL DEFAULT '0',
  `timeStamp` datetime DEFAULT NULL,
  `fileLocation` varchar(200) NOT NULL DEFAULT 'default',
  `privacy` varchar(10) DEFAULT 'public',
  `iso` int(11) DEFAULT NULL,
  `shutterSpeed` varchar(10) DEFAULT NULL,
  `fStop` float DEFAULT NULL,
  `lens` varchar(10) DEFAULT NULL,
  `albumID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpost`
--

INSERT INTO `tbpost` (`imageID`, `userID`, `title`, `caption`, `stars`, `timeStamp`, `fileLocation`, `privacy`, `iso`, `shutterSpeed`, `fStop`, `lens`, `albumID`) VALUES
(16, 25, 'The Falls of life', 'Listen to that soothing waterfall', 0, '2020-11-05 22:43:13', '../gallery/1604608993-falls2.jpg', 'public', 300, '1/200', 5.8, '75mm', 30),
(18, 25, 'On top of the world', 'Look at me !!!', 0, '2020-11-08 18:14:07', '../gallery/1604859247-5-good-reasons-to-add-people.jpg', 'public', 200, '1/400', 4.8, '100mm', 44),
(19, 25, 'Nature is beauty', 'Went for a gamedrive', 0, '2020-11-08 18:15:48', '../gallery/1604859348-images.jpg', 'public', 100, '1/900', 2.8, '50mm', 44),
(20, 25, '4 seasons', 'The World keeps spinning', 0, '2020-11-08 18:17:55', '../gallery/1604859475-landscapetipsfeatt-800x420.jpg', 'public', 300, '1/500', 5.6, '80mm', 44),
(21, 25, 'Emerge from the water', 'Look theres land', 0, '2020-11-08 18:29:24', '../gallery/1604860164-GSL-50mm-1-of-1.jpg', 'public', 400, '1/500', 11, '150mm', 44),
(22, 25, 'Look the Sun', 'Mom, can i take the sun home', 0, '2020-11-08 18:31:34', '../gallery/1604860294-d765deba042958eee51e664c99046ec6.jpeg', 'public', 1200, '1/4', 9, '250mm', 44),
(23, 25, 'A field of Sun', 'I love sunflower seeds', 0, '2020-11-08 18:33:15', '../gallery/1604860395-hero.jpg', 'public', 400, '1/3200', 4.6, '80mm', 44),
(24, 27, 'Reflective lights', 'Who doesnt like a good rain', 0, '2020-11-08 18:51:34', '../gallery/1604861494-tumblr_ny8jd6dx5S1qi3wodo2_500.jpg', 'public', 500, '1/1000', 11, '50mm', 40),
(25, 27, 'The Urban Jungle', 'Wow..', 0, '2020-11-08 18:53:22', '../gallery/1604861602-leannecole-7-tips-urbanlandscapes42.jpg', 'public', 700, '1/10', 16, '50mm', 40),
(26, 27, 'The rocks', 'The beauty is in the beholder', 0, '2020-11-08 19:20:45', '../gallery/1604863245-nature.jpg', 'public', 500, '1/7000', 16, '24mm', 44),
(27, 29, 'Made you look', 'I ow you a lummy', 0, '2020-11-08 19:30:26', '../gallery/1604863826-creative-photography-ideas-by-chiok-jun -jie.jpg', 'public', 300, '1/400', 4.5, '80mm', 45),
(28, 30, 'The man, the Mith, the Legend', 'Bring him back', 0, '2020-11-08 19:51:51', '../gallery/1604865111-170206172449-martin-schoeller-homepage-tease-obama-super-tease.jpg', 'public', 300, '1/500', 4.8, '50mm', 46),
(29, 31, 'Robin', 'The world will miss you', 0, '2020-11-08 19:58:33', '../gallery/1604865513-64735a25159e28bd3e321bde3910368b.jpg', 'public', 1100, '1/12', 5.8, '80mm', 47),
(30, 31, 'Steve', 'The inovation runs deep within', 0, '2020-11-08 20:00:01', '../gallery/1604865601-steve-jobs-745x419.jpg.optimal.jpg', 'public', 600, '1/8000', 8, '80mm', 47),
(31, 31, 'Mother', 'Caring for everyone', 0, '2020-11-08 20:01:15', '../gallery/1604865675-tumblr_mi0nt61DXr1rwsaheo1_500.jpg', 'public', 200, '1/300', 5.6, '600mm', 47),
(32, 31, 'Happiness is a choice', 'Money cant buy true happiness', 0, '2020-11-08 20:03:49', '../gallery/1604865829-Top-10-photographers-for-travel-portraits28__700.jpg', 'public', 300, '1/500', 5.6, '300mm', 47),
(33, 31, 'come now my child', 'The innocenec childhood', 0, '2020-11-08 20:06:12', '../gallery/1604865972-RÃ©hahn-1024x576.jpg', 'public', 700, '1/1000', 8.5, '250mm', 47),
(34, 31, 'Hard labour', 'The eyes never lie', 0, '2020-11-08 20:10:08', '../gallery/1604866208-unnamed (1).jpg', 'public', 200, '1/300', 2.8, '80mm', 47),
(35, 33, 'All about perspecitive', 'low', 0, '2020-11-08 20:42:40', '../gallery/1604868160-urban-photography-1.jpg', 'public', 300, '1/400', 5.6, '50mm', 48),
(36, 33, 'The Hill', 'every uphill has a down hill', 0, '2020-11-08 20:44:15', '../gallery/1604868255-urban_street_photography_37.jpg', 'public', 300, '1/5000', 16, '80mm', 48),
(37, 34, 'The sun came to dance', 'The first dance', 0, '2020-11-08 20:48:07', '../gallery/1604868487-Wedding-Photography-Tips-14.jpg', 'public', 400, '1/400', 5.6, '120mm', 49),
(38, 34, 'The family', 'The awesome family', 0, '2020-11-08 20:49:12', '../gallery/1604868552-man-drops-wedding-cake-in-front-of-camera-bride-groom-accident-idiot_shutterstock_622206089.jpg', 'public', 200, '1/200', 5.6, '50mm', 49),
(39, 34, 'The light', 'The light emerges from the shaddow', 0, '2020-11-08 20:50:30', '../gallery/1604868630-wedding-photography-workshop.jpg', 'public', 800, '1/3000', 5.4, '300mm', 49),
(40, 34, 'He Who enspires', 'The great one', 0, '2020-11-08 20:51:49', '../gallery/1604868709-Yousuf-Karsh-Portrait-of-Albert-Einstein.jpg', 'public', 300, '1/500', 2.8, '80mm', 49),
(41, 34, 'Creative', 'my creativity was shining today', 0, '2020-11-08 20:52:52', '../gallery/1604868772-fisherman-creative-photography-ideas-aka-carson.jpg', 'public', 200, '1/10', 4.8, '24mm', 49);

-- --------------------------------------------------------

--
-- Table structure for table `tbpostcomment`
--

CREATE TABLE `tbpostcomment` (
  `ID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `timeStamp` datetime DEFAULT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpostcomment`
--

INSERT INTO `tbpostcomment` (`ID`, `imageID`, `comment`, `timeStamp`, `userID`) VALUES
(8, 16, 'My First Picture on this website', '2020-11-08 18:08:30', 25),
(9, 23, 'This photo is soo bright, hahaha', '2020-11-08 19:31:54', 29),
(10, 19, 'Wow, cool photo', '2020-11-08 19:38:05', 29),
(11, 28, 'Yeah for sure', '2020-11-08 20:17:54', 32),
(12, 29, 'I really miss him', '2020-11-08 20:19:29', 32),
(13, 31, 'A mothers love is truly uncoditional', '2020-11-08 20:58:57', 34),
(14, 22, 'Dont burn yourself, hahah', '2020-11-08 20:59:22', 34),
(15, 18, 'Watch your footing', '2020-11-08 20:59:36', 34),
(16, 24, 'Hey, is that me in the background', '2020-11-08 21:00:25', 33),
(17, 24, 'Well unless you live in NYC, then NO. LOL', '2020-11-08 21:02:30', 25);

-- --------------------------------------------------------

--
-- Table structure for table `tbposthashtag`
--

CREATE TABLE `tbposthashtag` (
  `ID` int(11) NOT NULL,
  `imageID` int(11) NOT NULL,
  `hashtag` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbposthashtag`
--

INSERT INTO `tbposthashtag` (`ID`, `imageID`, `hashtag`) VALUES
(32, 16, '#awesome'),
(33, 16, '#water'),
(34, 16, '#cool'),
(35, 18, '#sunset'),
(36, 18, '#nature'),
(37, 18, '#hiking'),
(38, 19, '#Africa'),
(39, 19, '#sunset'),
(40, 19, '#tree'),
(41, 20, '#seasons'),
(42, 20, '#amazing'),
(43, 21, '#land'),
(44, 21, '#water'),
(45, 22, '#creative'),
(46, 22, '#nature'),
(47, 23, '#sun'),
(48, 23, '#flower'),
(49, 24, '#rain'),
(50, 24, '#water'),
(51, 24, '#color'),
(52, 25, '#urban'),
(53, 25, '#inspire'),
(54, 26, '#rocks'),
(55, 26, '#nature'),
(56, 26, '#bestLife'),
(57, 27, '#hahaha'),
(58, 27, '#Fun'),
(59, 28, '#Obama'),
(60, 28, '#USA'),
(61, 29, '#RobinWilliams'),
(62, 29, '#Talent'),
(63, 29, '#funny'),
(64, 30, '#SteveJobs'),
(65, 30, '#Apple'),
(66, 31, '#life'),
(67, 31, '#care'),
(68, 31, '#mom'),
(69, 32, '#happiness'),
(70, 32, '#life'),
(71, 33, '#childhood'),
(72, 33, '#youth'),
(73, 34, '#hardWork'),
(74, 34, '#eyes'),
(75, 35, '#perspective'),
(76, 35, '#creative'),
(77, 36, '#urban'),
(78, 36, '#inspirational'),
(79, 37, '#dance'),
(80, 37, '#sun'),
(81, 37, '#love'),
(82, 38, '#family'),
(83, 39, '#light'),
(84, 39, '#wedding'),
(85, 39, '#love'),
(86, 40, '#inspire'),
(87, 40, '#revolitionary'),
(88, 41, '#creative');

-- --------------------------------------------------------

--
-- Table structure for table `tbpostreportreason`
--

CREATE TABLE `tbpostreportreason` (
  `ID` int(11) NOT NULL,
  `reason` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpostreportreason`
--

INSERT INTO `tbpostreportreason` (`ID`, `reason`) VALUES
(1, 'Inappropriate'),
(2, 'Hate Speech'),
(3, 'Racism'),
(4, 'Bullying'),
(5, 'Sexism'),
(6, 'Spam'),
(8, 'boring');

-- --------------------------------------------------------

--
-- Table structure for table `tbpostreports`
--

CREATE TABLE `tbpostreports` (
  `ID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `timeStamp` datetime NOT NULL,
  `reportReason` int(11) NOT NULL,
  `imageID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbpostreports`
--

INSERT INTO `tbpostreports` (`ID`, `userID`, `timeStamp`, `reportReason`, `imageID`) VALUES
(15, 27, '2020-11-06 01:36:15', 8, 16),
(16, 31, '2020-11-08 20:11:14', 6, 18),
(17, 31, '2020-11-08 20:11:23', 1, 28),
(18, 33, '2020-11-08 20:21:22', 6, 28);

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
  `profileImage` varchar(200) DEFAULT '../gallery/profilePics/default.png',
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`userID`, `userType`, `name`, `email`, `dateOfBirth`, `bio`, `profileImage`, `password`) VALUES
(25, 'admin', 'Douglas', 'Douglas@gmail.com', '2020-10-17', 'The Creator of this website', '../gallery/profilePics/1604858789-d765deba042958eee51e664c99046ec6.jpeg', '$2y$10$bCKDG3tNTq/PoF8Fd5DY0OWsdX7rS2mIMi4UUbeUl8CZ8S5dVndIG'),
(27, 'user', 'Arno', 'Arno@gmail.com', '2020-10-30', 'The beast', '../gallery/profilePics/1604861295-img_page_1_58305b35ebf5e.png', '$2y$10$6ZfI.BsY2cDH.DNv2FLtDuXwTgFZXy0aJsMDbBEvv.eBWc8a6BYUy'),
(29, 'user', 'John', 'john@gmail.com', '2020-11-19', 'coder by day, photographer by night', '../gallery/profilePics/1604863691-photo-1497316730643-415fac54a2af.jpg', '$2y$10$QKAe9fOD0EbOxbfI/R.3OeUQ3zvMqjb0i.txet8FxmKbg539k/BLC'),
(30, 'user', 'Oates', 'Oats@gmail.com', '2020-11-19', 'exploit innovative photography', '../gallery/profilePics/1604865186-images (2).jpg', '$2y$10$gjf/RYsL43o6Mtv92rgM0eyKjYA5o4tTI93GhyBUsefczPxXLPsTe'),
(31, 'admin', 'Alicia', 'Alicia@gmail.com', '2020-11-25', 'No goal is un reachable', '../gallery/profilePics/1604865361-unnamed.jpg', '$2y$10$9WaEX/PfO5PgabTUtytOSuiELnVGlCJOAKM1uEqFGWmRwAQgRAcAa'),
(32, 'user', 'Ronald', 'Ronald@gmail.com', '2020-11-11', 'Photography is cool', '../gallery/profilePics/1604866685-images (1).jpg', '$2y$10$R/puXhcG0r5wewRRyyCPrORZSIO1ymukowW5laOu1ArS6lREmCheG'),
(33, 'user', 'Darius', 'Darius@gmail.com', '2020-11-25', 'Motocross is everything', '../gallery/profilePics/1604868282-funny-profile-pic59.jpg', '$2y$10$.lKpFt9YWWgs4bV2bQcClekQrLUK8lq5cOjN2zd0oXY1HwXobtmqK'),
(34, 'admin', 'Emil', 'Emill@gmail.com', '2020-11-16', 'Weddings are just my thing', '../gallery/profilePics/1604868991-annie-spratt-176308-unsplash.jpg', '$2y$10$DBt/b2cO1jP25dXdToIEbe5juhhNTE9j9N3xiB.3XZWYJiUPUiKOa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbalbum`
--
ALTER TABLE `tbalbum`
  ADD PRIMARY KEY (`albumID`),
  ADD KEY `tbAlbumDetails_tbuser_userID_fk` (`userID`);

--
-- Indexes for table `tbalbumhashtag`
--
ALTER TABLE `tbalbumhashtag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbalbumhashtags_tbalbum_albumID_fk` (`albumID`);

--
-- Indexes for table `tbalbumparticipant`
--
ALTER TABLE `tbalbumparticipant`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbAlbumParticipants_tbalbumdetails_albumID_fk` (`albumID`),
  ADD KEY `tbAlbumParticipants_tbuser_userID_fk` (`userID`);

--
-- Indexes for table `tbfollower`
--
ALTER TABLE `tbfollower`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbFollower_tbuser_userID_fk` (`userIDFollower`),
  ADD KEY `tbFollower_tbuser_userID_fk_2` (`userIDFollowing`);

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
-- Indexes for table `tbpostcomment`
--
ALTER TABLE `tbpostcomment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbComments_tbpost_imageID_fk` (`imageID`),
  ADD KEY `tbpostcomment_tbuser_userID_fk` (`userID`);

--
-- Indexes for table `tbposthashtag`
--
ALTER TABLE `tbposthashtag`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbHashtags_tbpost_imageID_fk` (`imageID`);

--
-- Indexes for table `tbpostreportreason`
--
ALTER TABLE `tbpostreportreason`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbpostreports`
--
ALTER TABLE `tbpostreports`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `tbpostreports_tbpostreportreason_ID_fk` (`reportReason`),
  ADD KEY `tbpostreports_tbuser_userID_fk` (`userID`),
  ADD KEY `tbpostreports_tbpost_imageID_fk` (`imageID`);

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
  MODIFY `albumID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `tbalbumhashtag`
--
ALTER TABLE `tbalbumhashtag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `tbalbumparticipant`
--
ALTER TABLE `tbalbumparticipant`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tbfollower`
--
ALTER TABLE `tbfollower`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbmessage`
--
ALTER TABLE `tbmessage`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbpost`
--
ALTER TABLE `tbpost`
  MODIFY `imageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tbpostcomment`
--
ALTER TABLE `tbpostcomment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbposthashtag`
--
ALTER TABLE `tbposthashtag`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `tbpostreportreason`
--
ALTER TABLE `tbpostreportreason`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbpostreports`
--
ALTER TABLE `tbpostreports`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbalbum`
--
ALTER TABLE `tbalbum`
  ADD CONSTRAINT `tbAlbumDetails_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tbalbumhashtag`
--
ALTER TABLE `tbalbumhashtag`
  ADD CONSTRAINT `tbalbumhashtags_tbalbum_albumID_fk` FOREIGN KEY (`albumID`) REFERENCES `tbalbum` (`albumID`) ON DELETE CASCADE;

--
-- Constraints for table `tbalbumparticipant`
--
ALTER TABLE `tbalbumparticipant`
  ADD CONSTRAINT `tbAlbumParticipants_tbalbumdetails_albumID_fk` FOREIGN KEY (`albumID`) REFERENCES `tbalbum` (`albumID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbAlbumParticipants_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tbfollower`
--
ALTER TABLE `tbfollower`
  ADD CONSTRAINT `tbFollower_tbuser_userID_fk` FOREIGN KEY (`userIDFollower`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbFollower_tbuser_userID_fk_2` FOREIGN KEY (`userIDFollowing`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tbmessage`
--
ALTER TABLE `tbmessage`
  ADD CONSTRAINT `tbMessage_tbuser_userID_fk` FOREIGN KEY (`senderUserID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbMessage_tbuser_userID_fk_2` FOREIGN KEY (`receiverUserID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tbpost`
--
ALTER TABLE `tbpost`
  ADD CONSTRAINT `tbPost_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tbpostcomment`
--
ALTER TABLE `tbpostcomment`
  ADD CONSTRAINT `tbComments_tbpost_imageID_fk` FOREIGN KEY (`imageID`) REFERENCES `tbpost` (`imageID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbpostcomment_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;

--
-- Constraints for table `tbposthashtag`
--
ALTER TABLE `tbposthashtag`
  ADD CONSTRAINT `tbHashtags_tbpost_imageID_fk` FOREIGN KEY (`imageID`) REFERENCES `tbpost` (`imageID`) ON DELETE CASCADE;

--
-- Constraints for table `tbpostreports`
--
ALTER TABLE `tbpostreports`
  ADD CONSTRAINT `tbpostreports_tbpost_imageID_fk` FOREIGN KEY (`imageID`) REFERENCES `tbpost` (`imageID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbpostreports_tbpostreportreason_ID_fk` FOREIGN KEY (`reportReason`) REFERENCES `tbpostreportreason` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbpostreports_tbuser_userID_fk` FOREIGN KEY (`userID`) REFERENCES `tbuser` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
