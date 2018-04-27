DROP DATABASE IF EXISTS SPORTS_MANAGEMENT;
CREATE DATABASE IF NOT EXISTS SPORTS_MANAGEMENT;

DROP USER IF EXISTS 'admin'@'localhost';
CREATE USER IF NOT EXISTS 'admin'@'localhost' IDENTIFIED BY '123456';


DROP USER IF EXISTS 'manager'@'localhost';
CREATE USER IF NOT EXISTS 'manager'@'localhost' IDENTIFIED BY '123456';

DROP USER IF EXISTS 'user'@'localhost';
CREATE USER IF NOT EXISTS 'user'@'localhost' IDENTIFIED BY '123456';

DROP USER IF EXISTS 'player'@'localhost';
CREATE USER IF NOT EXISTS 'player'@'localhost' IDENTIFIED BY '123456';

-- GRANT SELECT, INSERT, DELETE, UPDATE
-- ON SPORTS_MANAGEMENT.PLAYER, SPORTS_MANAGEMENT.STATS,
-- TO 'admin'@'localhost' IDENTIFIED BY '123456';
USE SPORTS_MANAGEMENT;

CREATE TABLE USERS
(
  USER_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PASSWORD_HASH varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  EMAIL varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  -- TYPE varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'U'
  TYPE ENUM('U', 'A', 'M', 'P') DEFAULT 'U'
);

CREATE TABLE MANAGER
(
  MANAGER_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  MUSER_ID INT(10) UNSIGNED NOT NULL,

  CONSTRAINT FOREIGN KEY (MUSER_ID) REFERENCES USERS(USER_ID)
);

CREATE TABLE PROFILE
(
  PROFILE_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PUSER_ID INT(10) UNSIGNED NOT NULL,
  FIRST_NAME VARCHAR(100),
  LAST_NAME VARCHAR(150),
  COUNTRY VARCHAR(250),
  ZIPCODE VARCHAR(100),
  CITY VARCHAR(100),
  STREET VARCHAR(100),
  STATE CHAR(10),

  CONSTRAINT FOREIGN KEY (PUSER_ID) REFERENCES USERS(USER_ID),
  CHECK (ZIPCODE  REGEXP '(?!0{5})(?!9{5})\\d{5}(-(?!0{4})(?!9{4})\\d{4})?'),
  INDEX (LAST_NAME ),
  UNIQUE (FIRST_NAME , LAST_NAME )
);

CREATE TABLE TEAMS
(
  TEAM_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  TMANAGER_ID INT(10) UNSIGNED NOT NULL,
  TEAM_NAME  VARCHAR(100),
  WIN TINYINT(3) UNSIGNED DEFAULT 0,
  LOSS TINYINT(3) UNSIGNED DEFAULT 0,

  FOREIGN KEY (TMANAGER_ID) REFERENCES MANAGER(MANAGER_ID)
);

CREATE TABLE GAMES
(
  GAME_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  START_DAY VARCHAR(100),
  END_DAY VARCHAR(150) NOT NULL
);


CREATE TABLE PLAYER
(
  PLAYER_ID INT(10) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  PLUSER_ID INT(10) UNSIGNED NOT NULL,
  PLTEAM_ID INT(10) UNSIGNED NOT NULL,

  CONSTRAINT FOREIGN KEY (PLTEAM_ID) REFERENCES TEAMS(TEAM_ID),
  CONSTRAINT FOREIGN KEY (PLUSER_ID) REFERENCES USERS(USER_ID)


);

CREATE TABLE STATS
(
  SPLAYER_ID INT(10) UNSIGNED NOT NULL,
  SGAME_ID INT(10) UNSIGNED NOT NULL,
  PLAYINGTIMEMIN TINYINT(2) UNSIGNED DEFAULT 0,
  PLAYINGTIMESEC TINYINT(2) UNSIGNED DEFAULT 0,
  POINTS TINYINT(3) UNSIGNED DEFAULT 0,
  ASSISTS TINYINT(3) UNSIGNED DEFAULT 0,
  REBOUNDS TINYINT(3) UNSIGNED DEFAULT 0,
  THREE_POINTS TINYINT(3) UNSIGNED DEFAULT 0,
  FTA TINYINT(3) UNSIGNED DEFAULT 0,
  STEAL TINYINT(3) UNSIGNED DEFAULT 0,
  FOUL TINYINT(3) UNSIGNED DEFAULT 0,
  BLOCK TINYINT(3) UNSIGNED DEFAULT 0,
  FTM TINYINT(3) UNSIGNED DEFAULT 0,

  PRIMARY KEY(SPLAYER_ID,SGAME_ID),

  CONSTRAINT FOREIGN KEY (SPLAYER_ID) REFERENCES PLAYER(PLAYER_ID),
  CONSTRAINT FOREIGN KEY (SGAME_ID) REFERENCES GAMES(GAME_ID),

  CHECK((PLAYINGTIMEMIN < 40 AND PLAYINGTIMESEC < 60) OR
        (PLAYINGTIMEMIN = 40 AND PLAYINGTIMESEC = 0 ))
);

CREATE TABLE PLAY
(
  PGAME_ID INT(10) UNSIGNED NOT NULL,
  PTEAM_ID INT(10) UNSIGNED NOT NULL,
  SCORE TINYINT(3) UNSIGNED DEFAULT 0,

  PRIMARY KEY(PGAME_ID,PTEAM_ID),

  CONSTRAINT FOREIGN KEY (PTEAM_ID) REFERENCES TEAMS(TEAM_ID),
  CONSTRAINT FOREIGN KEY (PGAME_ID) REFERENCES GAMES(GAME_ID)
);

GRANT INSERT ON SPORTS_MANAGEMENT.PLAY TO 'admin'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.GAMES TO 'admin'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.TEAMS TO 'admin'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.MANAGER TO 'admin'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.USERS TO 'admin'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.PROFILE TO 'admin'@'localhost';


GRANT SELECT ON SPORTS_MANAGEMENT.* TO 'admin'@'localhost';

GRANT UPDATE ON SPORTS_MANAGEMENT.STATS TO 'admin'@'localhost';
GRANT UPDATE ON SPORTS_MANAGEMENT.USERS TO 'admin'@'localhost';
GRANT UPDATE(SCORE) ON SPORTS_MANAGEMENT.PLAY TO 'admin'@'localhost';
GRANT UPDATE ON SPORTS_MANAGEMENT.PROFILE TO 'admin'@'localhost';

GRANT SELECT ON SPORTS_MANAGEMENT.TEAMS TO 'manager'@'localhost';
GRANT SELECT(USER_ID) ON SPORTS_MANAGEMENT.USERS TO 'manager'@'localhost';

GRANT SELECT ON SPORTS_MANAGEMENT.* TO 'manager'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.PLAYER TO 'manager'@'localhost';
GRANT INSERT ON SPORTS_MANAGEMENT.STATS TO 'manager'@'localhost';
GRANT DELETE ON SPORTS_MANAGEMENT.STATS TO 'manager'@'localhost';
GRANT UPDATE ON SPORTS_MANAGEMENT.PROFILE TO 'manager'@'localhost';

GRANT SELECT ON SPORTS_MANAGEMENT.* TO 'user'@'localhost';
GRANT UPDATE ON SPORTS_MANAGEMENT.PROFILE TO 'user'@'localhost';

GRANT SELECT ON SPORTS_MANAGEMENT.* TO 'player'@'localhost';
GRANT UPDATE ON SPORTS_MANAGEMENT.PROFILE TO 'player'@'localhost';

INSERT INTO USERS VALUES
(1, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'admin@email.com', 'A'),
(2, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'manager@email.com', 'M'),
(3, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'user@email.com', 'U'),
(4, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'manager1@email.com', 'M'),
(5, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'manager2@email.com', 'M'),
(6, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'manager3@email.com', 'M'),
(7, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'manager4@email.com', 'M'),
(8, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player1@email.com', 'P'),
(9, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player2@email.com', 'P'),
(10, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player3@email.com', 'P'),
(11, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player4@email.com', 'P'),
(12, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player5@email.com', 'P'),
(13, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player6@email.com', 'P'),
(14, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player7@email.com', 'P'),
(15, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player8@email.com', 'P'),
(16, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player9@email.com', 'P'),
(17, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player10@email.com', 'P'),
(18, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player11@email.com', 'P'),
(19, '$2y$10$2vgZ0.zYbzZGPLO6vjlAquz6BOVOR3d34eCo8hF4pLjFBFyvwcRzS', 'player12@email.com', 'P');


INSERT INTO MANAGER VALUES
(1, 2),
(2, 4),
(3, 5),
(4, 6),
(5, 7);

INSERT INTO GAMES VALUES
(1, '04-18-2018', '04-20-2018'),
(2, '05-18-2018', '05-20-2018'),
(3, '06-18-2018', '06-20-2018'),
(4, '07-19-2018', '07-24-2018'),
(5, '08-1-2018', '08-10-2018');

INSERT INTO PROFILE VALUES
(1, 1, 'ADMIN', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(2, 2, 'MANAGER', 'DEMO', 'USA', '54321', 'WESMINSTER', '456 BLVD', 'TX'),
(3, 3, 'USER', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(4, 4, 'MANAGER1', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(5, 5, 'MANAGER2', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(6, 8, 'p1', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(7, 9, 'p2', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(8, 10, 'p3', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(9, 11, 'p4', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(10, 12, 'p5', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(11, 13, 'p6', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(12, 14, 'p7', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(13, 15, 'p8', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(14, 16, 'p9', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(15, 17, 'p10', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(16, 18, 'p11', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA'),
(17, 19, 'p12', 'DEMO', 'USA', '12345', 'FULLERTON', '123 MAIN ST', 'CA');


INSERT INTO TEAMS VALUES
(1, 1, 'APPLE', 4, 2),
(2, 2, 'ORANGE', 5, 8),
(3, 3, 'FIRE', 0, 0);

INSERT INTO PLAY VALUES
(1, 1, 10),
(1, 2, 5),
(2, 3, 1),
(2, 1, 2),
(3, 2, 4),
(3, 3, 5),
(4, 1, NULL),
(4, 2, NULL),
(5, 3, NULL),
(5, 2, NULL);

INSERT INTO PLAYER VALUES
(1, 8, 1),
(2, 9, 1),
(3, 10, 1),
(4, 11, 2),
(5, 12, 2),
(6, 13, 2),
(7, 14, 3),
(8, 15, 3),
(9, 16, 3);

INSERT INTO STATS VALUES
(1, 1, 25, 26, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 1, 25, 27, 1, 2, 3, 4, 5, 6, 7, 8, 9),
(3, 1, 25, 28, 2, 3, 5, 7, 3, 2, 1, 3, 5),
(4, 2, 15, 29, 2, 3, 5, 7, 3, 2, 1, 3, 5),
(5, 2, 15, 30, 2, 3, 5, 7, 3, 2, 1, 3, 5),
(6, 2, 15, 31, 2, 3, 5, 7, 3, 2, 1, 3, 5),
(7, 3, 30, 32, 9, 1, 12, 10, 4, 7, 2, 3, 1),
(8, 3, 30, 33, 1, 1, 1, 2, 1, 0, 0, 0, 1),
(9, 3, 30, 34, 1, 1, 4, 1, 1, 1, 9, 1, 1);
