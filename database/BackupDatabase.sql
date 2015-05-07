-- Generated by SQL Maestro for MySQL. Release date 9/15/2008
-- 3/30/2015 3:38:15 PM
-- ----------------------------------
-- Alias: ezae at localhost
-- Database name: ezae
-- Host: localhost
-- Port number: 3306
-- User name: root
-- Server: 5.1.43-community
-- Session ID: 26
-- Character set: latin1
-- Collation: latin1_swedish_ci
-- Client encoding: utf8


SET FOREIGN_KEY_CHECKS=0;

CREATE DATABASE `ezae`
  CHARACTER SET `latin1`
  COLLATE `latin1_swedish_ci`;

USE `ezae`;

/* Tables */
CREATE TABLE `activities` (
  `seq`              bigint AUTO_INCREMENT NOT NULL,
  `moduleseq`        bigint,
  `userseq`          bigint,
  `iscompleted`      tinyint,
  `progress`         int,
  `dateofplay`       datetime,
  `learningplanseq`  bigint,
  `score`            int,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `adminmodules` (
  `seq`         bigint AUTO_INCREMENT NOT NULL,
  `companyseq`  bigint NOT NULL,
  `adminseq`    bigint NOT NULL,
  `moduleseq`   bigint NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `admins` (
  `seq`             bigint AUTO_INCREMENT NOT NULL,
  `name`            varchar(256),
  `username`        varchar(256),
  `password`        varchar(256),
  `emailid`         varchar(100),
  `mobileno`        varchar(20),
  `companyseq`      bigint,
  `createdon`       datetime,
  `isenabled`       tinyint,
  `issuper`         bit,
  `lastmodifiedon`  datetime NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `companies` (
  `seq`            bigint AUTO_INCREMENT NOT NULL,
  `name`           varchar(256),
  `description`    varchar(500),
  `emailid`        varchar(100),
  `mobileno`       varchar(20),
  `contactperson`  varchar(100),
  `createdon`      datetime,
  `isenabled`      tinyint,
  `address`        varchar(200) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `phone`          varchar(20) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `learningplans` (
  `seq`               bigint AUTO_INCREMENT NOT NULL,
  `adminseq`          bigint NOT NULL,
  `companyseq`        bigint NOT NULL,
  `title`             varchar(100) CHARACTER SET `utf8` COLLATE `utf8_general_ci` NOT NULL,
  `description`       varchar(250) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `isleaderboard`     tinyint,
  `issequencelocked`  tinyint,
  `isenabled`         tinyint,
  `expiringon`        datetime,
  `createdon`         datetime NOT NULL,
  `lastmodifiedon`    datetime NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `learningprofiles` (
  `seq`          bigint AUTO_INCREMENT NOT NULL,
  `tag`          varchar(50) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `adminseq`     bigint NOT NULL,
  `companyseq`   bigint NOT NULL,
  `createdon`    datetime NOT NULL,
  `description`  varchar(500) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `managers` (
  `seq`             bigint AUTO_INCREMENT NOT NULL,
  `companyseq`      bigint NOT NULL,
  `adminseq`        bigint NOT NULL,
  `name`            varchar(250) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `email`           varchar(100) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `password`        varchar(250) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `isenabled`       tinyint,
  `createdon`       datetime,
  `lastmodifiedon`  datetime,
  `mobile`          varchar(20) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `modules` (
  `seq`             bigint AUTO_INCREMENT NOT NULL,
  `title`           varchar(1000),
  `description`     varchar(2500) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `createdon`       datetime,
  `isenabled`       tinyint,
  `ispaid`          tinyint,
  `price`           double,
  `lastmodifiedon`  datetime NOT NULL,
  `maxscore`        double,
  `passpercent`     double,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `my_log` (
  `timestamp`  varchar(32),
  `logger`     varchar(64),
  `level`      varchar(32),
  `message`    varchar(9999),
  `thread`     varchar(32),
  `file`       varchar(255),
  `line`       varchar(6)
) ENGINE = InnoDB;

CREATE TABLE `usercustomfields` (
  `seq`         bigint AUTO_INCREMENT NOT NULL,
  `companyseq`  bigint,
  `name`        varchar(256),
  `title`       varchar(256),
  `fieldtype`   varchar(20),
  `adminseq`    bigint NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `userlearningprofiles` (
  `seq`       int AUTO_INCREMENT NOT NULL,
  `userseq`   bigint,
  `tagseq`    bigint NOT NULL,
  `adminseq`  bigint NOT NULL,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

CREATE TABLE `users` (
  `seq`                bigint AUTO_INCREMENT NOT NULL,
  `username`           varchar(56),
  `password`           varchar(56) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `emailid`            varchar(150),
  `companyseq`         bigint,
  `customfieldvalues`  varchar(5000) CHARACTER SET `utf8` COLLATE `utf8_general_ci`,
  `createdon`          datetime,
  `isenabled`          tinyint,
  `adminseq`           bigint NOT NULL,
  `lastmodifiedon`     datetime,
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;

/* Indexes */
CREATE INDEX `foreign_activities_learningplan`
  ON `activities`
  (`learningplanseq`);

CREATE INDEX `foreign_key03`
  ON `activities`
  (`moduleseq`);

CREATE INDEX `foreign_key04`
  ON `activities`
  (`userseq`);

CREATE INDEX `foreign_adminmodule_admin`
  ON `adminmodules`
  (`adminseq`);

CREATE INDEX `foreign_adminmodule_company`
  ON `adminmodules`
  (`companyseq`);

CREATE INDEX `foreign_adminmodule_module`
  ON `adminmodules`
  (`moduleseq`);

CREATE INDEX `foreign_key02`
  ON `admins`
  (`companyseq`);

CREATE INDEX `foreign_lp_admin`
  ON `learningplans`
  (`adminseq`);

CREATE INDEX `foreign_lp_company`
  ON `learningplans`
  (`companyseq`);

CREATE INDEX `foreign_tag_admin`
  ON `learningprofiles`
  (`adminseq`);

CREATE INDEX `foreign_tag_company`
  ON `learningprofiles`
  (`companyseq`);

CREATE INDEX `foreign_managers_admin`
  ON `managers`
  (`adminseq`);

CREATE INDEX `foreign_managers_company`
  ON `managers`
  (`companyseq`);

CREATE INDEX `foreign_key06`
  ON `usercustomfields`
  (`companyseq`);

CREATE INDEX `foreign_uc_admin`
  ON `usercustomfields`
  (`adminseq`);

CREATE INDEX `foreign_ut_admin`
  ON `userlearningprofiles`
  (`adminseq`);

CREATE INDEX `foreign_ut_tag`
  ON `userlearningprofiles`
  (`tagseq`);

CREATE INDEX `foreign_ut_user`
  ON `userlearningprofiles`
  (`userseq`);

CREATE INDEX `foreign_key01`
  ON `users`
  (`companyseq`);

CREATE INDEX `foreign_user_admin`
  ON `users`
  (`adminseq`);

CREATE UNIQUE INDEX `username`
  ON `users`
  (`username`);

/* Foreign Keys */
ALTER TABLE `activities`
  ADD CONSTRAINT `foreign_activities_learningplan`
  FOREIGN KEY (`learningplanseq`)
    REFERENCES `learningplans`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `activities`
  ADD CONSTRAINT `foreign_activities_user`
  FOREIGN KEY (`userseq`)
    REFERENCES `users`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `activities`
  ADD CONSTRAINT `foreign_actvities_module`
  FOREIGN KEY (`moduleseq`)
    REFERENCES `modules`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `adminmodules`
  ADD CONSTRAINT `foreign_adminmodule_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `adminmodules`
  ADD CONSTRAINT `foreign_adminmodule_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `adminmodules`
  ADD CONSTRAINT `foreign_adminmodule_module`
  FOREIGN KEY (`moduleseq`)
    REFERENCES `modules`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `admins`
  ADD CONSTRAINT `foreign_admin_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `learningplans`
  ADD CONSTRAINT `foreign_lp_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `learningplans`
  ADD CONSTRAINT `foreign_lp_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `learningprofiles`
  ADD CONSTRAINT `foreign_tag_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `learningprofiles`
  ADD CONSTRAINT `foreign_tag_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `managers`
  ADD CONSTRAINT `foreign_managers_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `managers`
  ADD CONSTRAINT `foreign_managers_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `usercustomfields`
  ADD CONSTRAINT `foreign_uc_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `usercustomfields`
  ADD CONSTRAINT `foreign_uc_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `userlearningprofiles`
  ADD CONSTRAINT `foreign_ut_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `userlearningprofiles`
  ADD CONSTRAINT `foreign_ut_tag`
  FOREIGN KEY (`tagseq`)
    REFERENCES `learningprofiles`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `users`
  ADD CONSTRAINT `foreign_user_admin`
  FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

ALTER TABLE `users`
  ADD CONSTRAINT `foreign_user_company`
  FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION;

/* Data for table "activities" */
COMMIT;


/* Data for table "adminmodules" */
COMMIT;


/* Data for table "admins" */
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (1, NULL, NULL, 'bb', 'bb@b.com', '9814622356', 4, '2015-03-13 10:37:51', NULL, '', '2015-03-13 10:37:51');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (2, 'bsingh', NULL, 'bb', 'bb@b.com', '9814622356', 10, '2015-03-13 12:34:51', NULL, '', '2015-03-13 12:34:51');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (3, 'bsingh', NULL, 'bb', 'bb@b.com', '9814622356', 11, '2015-03-13 12:40:10', NULL, '', '2015-03-13 12:40:10');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (4, 'bsingh', NULL, 'bb', 'bb@b.com', '9814622356', 12, '2015-03-13 12:40:58', NULL, '', '2015-03-13 12:40:58');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (5, 'bsingh', NULL, 'bb', 'bb@b.com', '9814622356', 13, '2015-03-13 12:43:15', NULL, '', '2015-03-13 12:43:15');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (6, 'bsingh', NULL, 'bb', 'bb@b.com', '9814622356', 14, '2015-03-13 12:47:41', NULL, '', '2015-03-13 12:47:41');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (7, 'bsingh', 'bsingh', 'bb', 'bb@b.com', '9814622356', 15, '2015-03-13 12:48:04', NULL, '', '2015-03-13 12:48:04');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (8, 'bbsingh', 'bbsingh', 'bb', 'bb@b.com', '9814622356', 16, '2015-03-13 13:07:51', NULL, '', '2015-03-13 13:07:51');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (9, 'bsingh', 'bsingh', 'bb', 'bb@b.com', '9814622356', 22, '2015-03-16 14:35:08', NULL, '', '2015-03-16 14:35:08');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (10, 'bsinghsded', 'bsinghsded', 'bb', 'bb@b.com', '9814622356', 23, '2015-03-16 14:38:30', NULL, '', '2015-03-16 14:38:30');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (11, 'bsingh', 'bsingh', 'bb', 'bb@b.com', '9814622356', 24, '2015-03-16 14:43:27', NULL, '', '2015-03-16 14:43:26');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (12, 'bsingh', 'bsingh', 'bb', 'bb@b.com', '9814622356', 25, '2015-03-16 14:44:35', NULL, '', '2015-03-16 14:44:34');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (13, 'bsinghsd', 'bsinghsd', 'bb', 'bb@b.com', '9814622356', 26, '2015-03-16 16:57:56', NULL, '', '2015-03-16 16:57:56');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (14, 'mm', 'mm', 'mm', 'bb@b.com', '9814622356', 27, '2015-03-16 16:59:19', NULL, '', '2015-03-16 16:59:19');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (15, 'bsingh', 'bsingh', 'nn', 'bb@b.com', '9814622356', 28, '2015-03-16 17:00:58', NULL, '', '2015-03-16 17:00:58');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (16, 'bsingh', 'bsingh', 'klk', 'bb@b.com', '9814622356', 29, '2015-03-16 17:03:15', NULL, '', '2015-03-16 17:03:15');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (17, 'bsingh', 'bsingh', 'dd', 'bb@b.com', '9814622356', 36, '2015-03-16 17:12:15', 1, '', '2015-03-16 17:12:15');
INSERT INTO `admins` (`seq`, `name`, `username`, `password`, `emailid`, `mobileno`, `companyseq`, `createdon`, `isenabled`, `issuper`, `lastmodifiedon`) VALUES (18, '', '', 'bb', '', '9814622356', 37, '2015-03-17 05:13:30', 1, '', '2015-03-17 05:13:30');
COMMIT;


/* Data for table "companies" */
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (1, 'LearnTech', 'LearnTech Pvt. Ltd. India.', 'munishsethi777@gmail.com', '9814600356', 'Munish Sethi', '2014-09-04 12:39:21', 1, NULL, NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (2, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 10:26:23', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (3, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 10:30:43', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (4, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 10:37:49', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (5, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:24:00', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (6, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-13 12:24:55', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (7, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-13 12:28:09', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (8, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-13 12:29:09', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (9, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:32:19', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (10, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:34:51', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (11, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:40:10', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (12, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:40:58', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (13, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:43:15', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (14, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:47:41', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (15, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 12:48:04', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (16, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-13 13:07:51', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (17, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 13:16:04', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (18, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 13:16:39', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (19, 'b', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 13:17:26', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (20, 'b', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 13:18:53', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (21, 'D company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-13 13:24:16', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (22, 'Dewan Mech', 'des', 'b@b.com', '568984', 'Test 1256', '2015-03-16 14:35:08', 1, 'address 12345', NULL);
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (23, 'Dewan Mech', 'des', 'b@b.com', '568984', 'Test 1256', '2015-03-16 14:38:30', 1, 'address 12345', '25262558');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (24, 'D company ss t', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 14:43:19', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (25, 'D company ss t', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 14:44:30', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (26, 'te comp', 'des', 'b@b.com', '123456', 'b s g', '2015-03-16 16:57:56', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (27, 'te comp', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 16:59:17', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (28, 'Dewan company', 'description company', 'b@b.com', '123456', 'b s g', '2015-03-16 17:00:58', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (29, 'D company', 'des', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:03:15', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (30, 'D company', 'des', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:03:42', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (31, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:05:08', 1, 'address 12345', '25262558');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (32, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:09:46', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (33, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:10:11', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (34, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:10:36', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (35, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:11:27', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (36, 'D company', 'description company', 'baljeetgaheer@gmail.com', '123456', 'b s g', '2015-03-16 17:12:15', 1, 'address 12345', '321654');
INSERT INTO `companies` (`seq`, `name`, `description`, `emailid`, `mobileno`, `contactperson`, `createdon`, `isenabled`, `address`, `phone`) VALUES (37, 'D company', '', 'baljeetgaheer@gmail.com', '', '', '2015-03-17 05:13:30', 1, '', '');
COMMIT;


/* Data for table "learningplans" */
COMMIT;


/* Data for table "learningprofiles" */
INSERT INTO `learningprofiles` (`seq`, `tag`, `adminseq`, `companyseq`, `createdon`, `description`) VALUES (20, 'testdes', 7, 15, '2015-03-29 17:41:42', 'ddd');
INSERT INTO `learningprofiles` (`seq`, `tag`, `adminseq`, `companyseq`, `createdon`, `description`) VALUES (21, 'new tag', 7, 15, '2015-03-29 20:22:33', 'dd');
INSERT INTO `learningprofiles` (`seq`, `tag`, `adminseq`, `companyseq`, `createdon`, `description`) VALUES (22, 'My tag', 7, 15, '2015-03-29 20:22:39', 'dd');
COMMIT;


/* Data for table "managers" */
COMMIT;


/* Data for table "modules" */
INSERT INTO `modules` (`seq`, `title`, `description`, `createdon`, `isenabled`, `ispaid`, `price`, `lastmodifiedon`, `maxscore`, `passpercent`) VALUES (1, 'New Training Videos', 'New Training Videos', '2014-09-04 12:40:43', 1, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `modules` (`seq`, `title`, `description`, `createdon`, `isenabled`, `ispaid`, `price`, `lastmodifiedon`, `maxscore`, `passpercent`) VALUES (2, 'New Training Videos', 'New Training Videos', '2014-09-09 22:19:14', 1, NULL, NULL, NULL, NULL, NULL);
COMMIT;


/* Data for table "my_log" */
INSERT INTO `my_log` (`timestamp`, `logger`, `level`, `message`, `thread`, `file`, `line`) VALUES ('2015-03-12 08:07:54,325', 'myDBLogger', 'ERROR', 'Error During loginUser', '4656', 'D:\\projects\\ezae\\httpdocs\\ajaxUsersMgr.php', '34');
INSERT INTO `my_log` (`timestamp`, `logger`, `level`, `message`, `thread`, `file`, `line`) VALUES ('2015-03-12 08:08:21,565', 'myDBLogger', 'ERROR', 'Error During loginUser', '4656', 'D:\\projects\\ezae\\httpdocs\\ajaxUsersMgr.php', '34');
INSERT INTO `my_log` (`timestamp`, `logger`, `level`, `message`, `thread`, `file`, `line`) VALUES ('2015-03-12 08:09:57,306', 'myDBLogger', 'ERROR', 'Error During loginUser', '4656', 'D:\\projects\\ezae\\httpdocs\\ajaxUsersMgr.php', '34');
INSERT INTO `my_log` (`timestamp`, `logger`, `level`, `message`, `thread`, `file`, `line`) VALUES ('2015-03-12 08:11:19,759', 'myDBLogger', 'ERROR', 'Error During loginUser', '4656', 'D:\\projects\\ezae\\httpdocs\\ajaxUsersMgr.php', '34');
COMMIT;


/* Data for table "usercustomfields" */
INSERT INTO `usercustomfields` (`seq`, `companyseq`, `name`, `title`, `fieldtype`, `adminseq`) VALUES (79, 15, 'Username', 'Username', 'Text', 7);
INSERT INTO `usercustomfields` (`seq`, `companyseq`, `name`, `title`, `fieldtype`, `adminseq`) VALUES (80, 15, 'Password', 'Password', 'date', 7);
COMMIT;


/* Data for table "userlearningprofiles" */
INSERT INTO `userlearningprofiles` (`seq`, `userseq`, `tagseq`, `adminseq`) VALUES (2, 9, 21, 7);
INSERT INTO `userlearningprofiles` (`seq`, `userseq`, `tagseq`, `adminseq`) VALUES (3, 9, 22, 7);
INSERT INTO `userlearningprofiles` (`seq`, `userseq`, `tagseq`, `adminseq`) VALUES (4, 8, 21, 7);
INSERT INTO `userlearningprofiles` (`seq`, `userseq`, `tagseq`, `adminseq`) VALUES (5, 8, 22, 7);
COMMIT;


/* Data for table "users" */
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (190, 'sat_B Gaheer', 'U72*cmtr', 'bm3@satya.com', 15, 'Username:B Gaheer;Password:mm3;EmpCode:123459;Email :bm3@satya.com;Age:33;Sex:M;Date Of Joining:03-16-15;', '2015-03-26 15:10:32', 1, 7, NULL);
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (191, 'sat_G Sethi', 'R=FW#2O?', 'bm4@satya.com', 15, 'Username:G Sethi;Password:mm4;EmpCode:1234510;Email :bm4@satya.com;Age:34;Sex:M;Date Of Joining:03-16-15;', '2015-03-26 15:10:32', 1, 7, NULL);
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (227, 'cv', 'cv', 'b@b.com', 15, 'Username:cc;Password:cc;', NULL, NULL, 7, '2015-03-27 14:54:03');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (228, 'testeert', 'dd', 'b@b.com', 15, 'Username:d;Password:ff;', NULL, NULL, 7, '2015-03-27 14:55:38');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (229, 'testdfv', 'vv', 'b@b.com', 15, 'Username:uu;Password:pp;', NULL, NULL, 7, '2015-03-27 14:56:35');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (230, 'testtyu', 'gg', 'b@b.com', 15, 'Username:bn;Password:mn;', NULL, NULL, 7, '2015-03-27 14:57:31');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (231, 'yrdy', 'ff', 'b@b.com', 15, 'Username:bg;Password:h;', NULL, NULL, 7, '2015-03-27 14:58:25');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (232, 'ffdd', '', 'b@b.com', 15, 'Username:gg;Password:gg;', '2015-03-28 00:42:26', 1, 7, '2015-03-28 00:42:26');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (233, 'test vbn', 'gg', 'b@b.com', 15, 'Username:tt;Password:yy;', '2015-03-28 02:16:30', 1, 7, '2015-03-28 02:16:30');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (234, 'test vbnsd', 'gg', 'b@b.com', 15, 'Username:tt;Password:yy;', '2015-03-28 02:17:25', 1, 7, '2015-03-28 02:17:25');
INSERT INTO `users` (`seq`, `username`, `password`, `emailid`, `companyseq`, `customfieldvalues`, `createdon`, `isenabled`, `adminseq`, `lastmodifiedon`) VALUES (235, 'test 32820152', 'ddd', 'b@b.com', 15, 'Username:ttt;Password:yy;', '2015-03-28 02:18:12', 1, 7, '2015-03-28 02:29:04');
COMMIT;
