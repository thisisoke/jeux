-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 17, 2020 at 02:37 AM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `jeux`
--

-- --------------------------------------------------------

--
-- Table structure for table `game1AnswersVoting`
--

CREATE TABLE `game1AnswersVoting` (
  `answerId` int(11) DEFAULT NULL,
  `playerId` int(11) DEFAULT NULL COMMENT 'player who voted the points in the row',
  `votePoint` int(11) DEFAULT NULL COMMENT 'point vote given from a player to an answer. filled from JS points calculator algorithm',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game1PromptAnswers`
--

CREATE TABLE `game1PromptAnswers` (
  `answerId` int(11) NOT NULL,
  `playerId` int(11) DEFAULT NULL,
  `gameRoomId` int(11) DEFAULT NULL,
  `promptId` int(11) DEFAULT NULL,
  `selectedGif` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `game1PromptQuestion`
--

CREATE TABLE `game1PromptQuestion` (
  `promptId` int(11) NOT NULL,
  `promptText` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'question prompts for game1. Load into JavaScript Array'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gameInstance`
--

CREATE TABLE `gameInstance` (
  `gameRoomId` int(11) DEFAULT NULL,
  `gameState` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'this column tracks the game state across all the player devices and syncronizes progression of the game on each device'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gamePlayers`
--

CREATE TABLE `gamePlayers` (
  `playerId` int(11) NOT NULL,
  `playerNum` int(11) DEFAULT NULL COMMENT 'use to store the player postion for the game room ex: 1,2,3. Also identifies player. STORES hostID for host player',
  `userName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `points` int(11) DEFAULT NULL COMMENT 'total points for that user',
  `gameRoomId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gameRoom`
--

CREATE TABLE `gameRoom` (
  `gameRoomId` int(11) NOT NULL,
  `hostId` int(11) DEFAULT NULL,
  `gameId` int(11) DEFAULT NULL,
  `roomName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'User given name of the room',
  `roomCode` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Visible Room code for users to find a loom and login',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gameRoom`
--

INSERT INTO `gameRoom` (`gameRoomId`, `hostId`, `gameId`, `roomName`, `roomCode`, `created_at`) VALUES
(1, 11, 2, 'jayeeee', 'TFhpk', '2020-12-17 00:33:15'),
(2, 11, 1, 'jayee', 'TFhpj', '2020-12-17 00:31:56'),
(7, 11, 1, 'ROOM TO BE!', 'cQqfS', '2020-12-17 00:36:24');

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `gameId` int(11) NOT NULL,
  `gameLink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `playerLimit` int(11) DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gameImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featuredGameFlag` tinyint(1) DEFAULT NULL COMMENT 'Wether and Article is featured or Not'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`gameId`, `gameLink`, `name`, `playerLimit`, `description`, `gameImage`, `featuredGameFlag`) VALUES
(1, 'gifChat.json', 'GIF CHAT', 4, 'Select the best Gifs for your game', 'gifchatIcon.png', 1),
(2, 'newGames.json', 'New Games', 6, 'New Games coming ', 'newgameIcon.png', 0),
(3, 'socialGames.json', 'Social Games', 5, 'New Social Games coming', 'newsocialgamesIcon.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gifListGame1`
--

CREATE TABLE `gifListGame1` (
  `imgId` int(11) NOT NULL,
  `gifName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'name description of GIF ex: Happy',
  `gifLink` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'server or web link for GIF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hostUser`
--

CREATE TABLE `hostUser` (
  `hostId` int(11) NOT NULL,
  `userName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emailAddress` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `avatarHost` int(11) NOT NULL COMMENT 'What avatar does the host have'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hostUser`
--

INSERT INTO `hostUser` (`hostId`, `userName`, `emailAddress`, `password`, `created_at`, `avatarHost`) VALUES
(1, 'toro', 'email@email.com', 'toro789', '2020-12-16 06:48:28', 1),
(2, 'host1', 'host@host.com', 'host789', '2020-12-16 06:48:39', 3),
(4, 'host4', 'host@host.com', 'host789', '2020-12-16 18:01:31', 2),
(5, 'host5', 'host@host.com', 'host789', '2020-12-16 18:05:55', 2),
(6, 'host7', 'host@host.com', 'host789', '2020-12-16 18:11:25', 2),
(7, 'host9', 'host@host.com', 'host789', '2020-12-16 18:12:31', 2),
(8, 'hoster9', 'host@host.com', 'host789', '2020-12-16 18:13:15', 1),
(9, 'hoster1', 'host@host.com', 'host789', '2020-12-16 18:13:49', 1),
(10, 'hoster3', 'host@host.com', 'host789', '2020-12-16 18:15:26', 1),
(11, 'toro3', 'toro@email.com', 'host789', '2020-12-16 23:27:12', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `game1AnswersVoting`
--
ALTER TABLE `game1AnswersVoting`
  ADD KEY `answerId` (`answerId`),
  ADD KEY `playerId` (`playerId`);

--
-- Indexes for table `game1PromptAnswers`
--
ALTER TABLE `game1PromptAnswers`
  ADD PRIMARY KEY (`answerId`),
  ADD KEY `playerId` (`playerId`),
  ADD KEY `gameRoomId` (`gameRoomId`),
  ADD KEY `promptId` (`promptId`),
  ADD KEY `selectedGif` (`selectedGif`);

--
-- Indexes for table `game1PromptQuestion`
--
ALTER TABLE `game1PromptQuestion`
  ADD PRIMARY KEY (`promptId`);

--
-- Indexes for table `gameInstance`
--
ALTER TABLE `gameInstance`
  ADD KEY `gameRoomId` (`gameRoomId`);

--
-- Indexes for table `gamePlayers`
--
ALTER TABLE `gamePlayers`
  ADD PRIMARY KEY (`playerId`),
  ADD KEY `gameRoomId` (`gameRoomId`);

--
-- Indexes for table `gameRoom`
--
ALTER TABLE `gameRoom`
  ADD PRIMARY KEY (`gameRoomId`),
  ADD KEY `hostId` (`hostId`),
  ADD KEY `gameId` (`gameId`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`gameId`);

--
-- Indexes for table `gifListGame1`
--
ALTER TABLE `gifListGame1`
  ADD PRIMARY KEY (`imgId`);

--
-- Indexes for table `hostUser`
--
ALTER TABLE `hostUser`
  ADD PRIMARY KEY (`hostId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `game1PromptAnswers`
--
ALTER TABLE `game1PromptAnswers`
  MODIFY `answerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `game1PromptQuestion`
--
ALTER TABLE `game1PromptQuestion`
  MODIFY `promptId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gamePlayers`
--
ALTER TABLE `gamePlayers`
  MODIFY `playerId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gameRoom`
--
ALTER TABLE `gameRoom`
  MODIFY `gameRoomId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `gameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gifListGame1`
--
ALTER TABLE `gifListGame1`
  MODIFY `imgId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostUser`
--
ALTER TABLE `hostUser`
  MODIFY `hostId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `game1AnswersVoting`
--
ALTER TABLE `game1AnswersVoting`
  ADD CONSTRAINT `game1answersvoting_ibfk_1` FOREIGN KEY (`answerId`) REFERENCES `game1PromptAnswers` (`answerId`),
  ADD CONSTRAINT `game1answersvoting_ibfk_2` FOREIGN KEY (`playerId`) REFERENCES `gamePlayers` (`playerId`);

--
-- Constraints for table `game1PromptAnswers`
--
ALTER TABLE `game1PromptAnswers`
  ADD CONSTRAINT `game1promptanswers_ibfk_1` FOREIGN KEY (`playerId`) REFERENCES `gamePlayers` (`playerId`),
  ADD CONSTRAINT `game1promptanswers_ibfk_2` FOREIGN KEY (`gameRoomId`) REFERENCES `gameRoom` (`gameRoomId`),
  ADD CONSTRAINT `game1promptanswers_ibfk_3` FOREIGN KEY (`promptId`) REFERENCES `game1PromptQuestion` (`promptId`),
  ADD CONSTRAINT `game1promptanswers_ibfk_4` FOREIGN KEY (`selectedGif`) REFERENCES `gifListGame1` (`imgId`);

--
-- Constraints for table `gameInstance`
--
ALTER TABLE `gameInstance`
  ADD CONSTRAINT `gameinstance_ibfk_1` FOREIGN KEY (`gameRoomId`) REFERENCES `gameRoom` (`gameRoomId`);

--
-- Constraints for table `gamePlayers`
--
ALTER TABLE `gamePlayers`
  ADD CONSTRAINT `gameplayers_ibfk_1` FOREIGN KEY (`gameRoomId`) REFERENCES `gameRoom` (`gameRoomId`);

--
-- Constraints for table `gameRoom`
--
ALTER TABLE `gameRoom`
  ADD CONSTRAINT `gameroom_ibfk_1` FOREIGN KEY (`hostId`) REFERENCES `hostUser` (`hostId`),
  ADD CONSTRAINT `gameroom_ibfk_2` FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`);
