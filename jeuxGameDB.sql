CREATE TABLE `hostUser` (
  `hostId` int PRIMARY KEY AUTO_INCREMENT,
  `userName` varchar(255),
  `emailAddress` varchar(255),
  `password` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `games` (
  `gameId` int PRIMARY KEY AUTO_INCREMENT,
  `gameLink` varchar(255),
  `name` varchar(255),
  `playerLimit` int,
  `descripton` varchar(255),
  `gameImage` varchar(255)
);

CREATE TABLE `gameRoom` (
  `gameRoomId` int PRIMARY KEY AUTO_INCREMENT,
  `hostId` int,
  `gameId` int,
  `roomName` varchar(255) COMMENT 'User given name of the room',
  `created_at` timestamp
);

CREATE TABLE `gamePlayers` (
  `playerId` int PRIMARY KEY AUTO_INCREMENT,
  `playerNum` int COMMENT 'use to store the player postion for the game room ex: 1,2,3. Also identifies player. STORES hostID for host player',
  `userName` varchar(255),
  `points` int COMMENT 'total points for that user',
  `gameRoomId` int
);

CREATE TABLE `gameInstance` (
  `gameRoomId` int,
  `gameState` varchar(255) COMMENT 'this column tracks the game state across all the player devices and syncronizes progression of the game on each device'
);

CREATE TABLE `game1PromptQuestion` (
  `promptId` int PRIMARY KEY AUTO_INCREMENT,
  `promptText` varchar(255) COMMENT 'question prompts for game1. Load into JavaScript Array'
);

CREATE TABLE `game1PromptAnswers` (
  `answerId` int PRIMARY KEY AUTO_INCREMENT,
  `playerId` int,
  `gameRoomId` int,
  `promptId` int,
  `selectedGif` int,
  `created_at` timestamp
);

CREATE TABLE `gifListGame1` (
  `imgId` int PRIMARY KEY AUTO_INCREMENT,
  `gifName` varchar(255) COMMENT 'name description of GIF ex: Happy',
  `gifLink` varchar(255) COMMENT 'server or web link for GIF'
);

CREATE TABLE `game1AnswersVoting` (
  `answerId` int,
  `playerId` int COMMENT 'player who voted the points in the row',
  `votePoint` int COMMENT 'point vote given from a player to an answer. filled from JS points calculator algorithm',
  `created_at` timestamp
);

ALTER TABLE `gameRoom` ADD FOREIGN KEY (`hostId`) REFERENCES `hostUser` (`hostId`);

ALTER TABLE `gameRoom` ADD FOREIGN KEY (`gameId`) REFERENCES `games` (`gameId`);

ALTER TABLE `gamePlayers` ADD FOREIGN KEY (`gameRoomId`) REFERENCES `gameRoom` (`gameRoomId`);

ALTER TABLE `gameInstance` ADD FOREIGN KEY (`gameRoomId`) REFERENCES `gameRoom` (`gameRoomId`);

ALTER TABLE `game1PromptAnswers` ADD FOREIGN KEY (`playerId`) REFERENCES `gamePlayers` (`playerId`);

ALTER TABLE `game1PromptAnswers` ADD FOREIGN KEY (`gameRoomId`) REFERENCES `gameRoom` (`gameRoomId`);

ALTER TABLE `game1PromptAnswers` ADD FOREIGN KEY (`promptId`) REFERENCES `game1PromptQuestion` (`promptId`);

ALTER TABLE `game1PromptAnswers` ADD FOREIGN KEY (`selectedGif`) REFERENCES `gifListGame1` (`imgId`);

ALTER TABLE `game1AnswersVoting` ADD FOREIGN KEY (`answerId`) REFERENCES `game1PromptAnswers` (`answerId`);

ALTER TABLE `game1AnswersVoting` ADD FOREIGN KEY (`playerId`) REFERENCES `gamePlayers` (`playerId`);
