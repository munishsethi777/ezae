ALTER TABLE modules ADD COLUMN `timeallowed` INT NULL  AFTER `companyseq` , ADD COLUMN `tagline` VARCHAR(500) NULL  AFTER `timeallowed` , ADD COLUMN `imagepath` VARCHAR(500) NULL  AFTER `tagline` , ADD COLUMN `synopsis` VARCHAR(500) NULL  AFTER `imagepath` , ADD COLUMN `author` VARCHAR(250) NULL  AFTER `synopsis` , ADD COLUMN `type` VARCHAR(100) NULL  AFTER `author` , ADD COLUMN `tags` VARCHAR(500) NULL  AFTER `type` , ADD COLUMN `prerequisties` VARCHAR(500) NULL  AFTER `tags` , ADD COLUMN `prework` VARCHAR(500) NULL  AFTER `prerequisties` , ADD COLUMN `videourl` VARCHAR(500) NULL  AFTER `prework` ;