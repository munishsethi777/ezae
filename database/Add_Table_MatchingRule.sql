CREATE TABLE `matchingrules` (
  `seq`            bigint AUTO_INCREMENT NOT NULL PRIMARY KEY,
  `usernamefield`  nvarchar(100) NOT NULL,
  `emailfield`     nvarchar(100) NOT NULL,
  `passwordfield`  nvarchar(100) NOT NULL
) ENGINE = InnoDB;
