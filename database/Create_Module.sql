CREATE TABLE `modules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(1000) DEFAULT NULL,
  `description` varchar(2500) CHARACTER SET utf8 DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `ispaid` tinyint(4) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `lastmodifiedon` datetime NOT NULL,
  `maxscore` double DEFAULT NULL,
  `passpercent` double DEFAULT NULL,
  `companyseq` bigint(20) NOT NULL,
  `timeallowed` int(11) DEFAULT NULL,
  `tagline` varchar(500) DEFAULT NULL,
  `imagepath` varchar(500) DEFAULT NULL,
  `synopsis` varchar(500) DEFAULT NULL,
  `author` varchar(250) DEFAULT NULL,
  `moduletype` varchar(100) DEFAULT NULL,
  `tags` varchar(500) DEFAULT NULL,
  `prerequisties` varchar(500) DEFAULT NULL,
  `prework` varchar(500) DEFAULT NULL,
  `videourl` varchar(500) DEFAULT NULL,
  `typedetails` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
