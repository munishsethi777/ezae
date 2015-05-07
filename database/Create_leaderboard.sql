CREATE TABLE `leaderboard` (
  `seq`              bigint AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `name`             nvarchar(255),
  `type`             nvarchar(50),
  `learningplanseq`  bigint,
  `moduleseq`        bigint,
  `createdon`        datetime,
  `lastmodfiedon`    datetime,
  `isenabled`        tinyint
) ENGINE = InnoDB;
