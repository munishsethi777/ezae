CREATE TABLE `companymodules` (
  `seq` bigint(20) NOT NULL AUTO_INCREMENT,
  `companyseq` bigint(20) NOT NULL,
  `adminseq` bigint(20) NOT NULL,
  `moduleseq` bigint(20) NOT NULL,
  `addedon` datetime DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `foreign_adminmodule_company` (`companyseq`),
  KEY `foreign_adminmodule_admin` (`adminseq`),
  KEY `foreign_adminmodule_module` (`moduleseq`),
  CONSTRAINT `foreign_adminmodule_admin` FOREIGN KEY (`adminseq`) REFERENCES `admins` (`seq`) ON UPDATE NO ACTION,
  CONSTRAINT `foreign_adminmodule_company` FOREIGN KEY (`companyseq`) REFERENCES `companies` (`seq`) ON UPDATE NO ACTION,
  CONSTRAINT `foreign_adminmodule_module` FOREIGN KEY (`moduleseq`) REFERENCES `modules` (`seq`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
