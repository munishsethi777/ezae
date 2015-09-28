CREATE TABLE `quizprogress` (
  `seq`             bigint AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `moduleseq`        bigint NOT NULL,
  `learningplanseq`  bigint NOT NULL,
  `questionseq`      bigint NOT NULL,
  `answerseq`        bigint NOT NULL,
  `userseq`          bigint NOT NULL
  `dated`            datetime NOT NULL;

) ENGINE = InnoDB;
