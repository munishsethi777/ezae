CREATE TABLE `learningplancourses` (
  `seq`              bigint AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `learningplanseq`  bigint NOT NULL,
  `courseseq`        bigint NOT NULL
) ENGINE = InnoDB;
