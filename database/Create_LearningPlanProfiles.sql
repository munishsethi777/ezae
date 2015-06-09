CREATE TABLE `learningplanprofiles` (
  `seq`                 bigint AUTO_INCREMENT NOT NULL,
  `learningplanseq`     bigint NOT NULL,
  `learningprofileseq`  bigint NOT NULL,
  /* Keys */
  PRIMARY KEY (`seq`)
) ENGINE = InnoDB;