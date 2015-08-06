CREATE TABLE `managercriteria` (
  `seq`            bigint AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `managerseq`     bigint NOT NULL,
  `criteriatype`   nvarchar(20) NOT NULL,
  `criteriavalue`  nvarchar(20) NOT NULL
) ENGINE = InnoDB;
