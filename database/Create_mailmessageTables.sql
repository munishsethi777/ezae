CREATE TABLE `mailmessage` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB

CREATE TABLE `mailmessageaction` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageid` bigint(20) DEFAULT NULL,
  `sendondate` datetime DEFAULT NULL,
  `condition` varchar(45) DEFAULT NULL,
  `gettingmarksvalue` int(11) DEFAULT NULL,
  `moduleseq` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB

CREATE TABLE `mailmessagelearningprofiles` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageid` bigint(20) DEFAULT NULL,
  `learningprofileid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB


CREATE TABLE `mailmessagesent` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `messageactionid` bigint(20) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`)
) ENGINE=InnoDB





