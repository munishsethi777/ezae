CREATE TABLE `signupformfields` (
  `seq`             bigint AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `adminseq`        bigint NOT NULL,
  `companyseq`      bigint NOT NULL,
  `customfieldseq`  bigint NOT NULL,
  `isrequired`      tinyint,
  `isvisible`       tinyint,
  /* Foreign keys */
  CONSTRAINT `foreign_key01`
    FOREIGN KEY (`adminseq`)
    REFERENCES `admins`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION, 
  CONSTRAINT `foreign_key02`
    FOREIGN KEY (`companyseq`)
    REFERENCES `companies`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION, 
  CONSTRAINT `foreign_key03`
    FOREIGN KEY (`customfieldseq`)
    REFERENCES `usercustomfields`(`seq`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION
) ENGINE = InnoDB;
