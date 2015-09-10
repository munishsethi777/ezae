CREATE TABLE `questions` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(500) DEFAULT NULL,
  `maxmarks` int(11) DEFAULT NULL,
  `timeallowed` int(11) DEFAULT NULL,
  `questiontype` varchar(20) DEFAULT NULL,
  `adminseq` bigint(20) DEFAULT NULL,
  `companyseq` bigint(20) DEFAULT NULL,
  `createdon` datetime DEFAULT NULL,
  `isenabled` tinyint(4) DEFAULT NULL,
  `lastmodifiedon` date DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `questionanswers` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `questionseq` bigint(20) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `feedback` varchar(500) DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `modulequestions` (
  `seq` bigint(20) DEFAULT NULL,
  `moduleseq` bigint(20) DEFAULT NULL,
  `questionseq` bigint(20) DEFAULT NULL,
  `addedon` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
