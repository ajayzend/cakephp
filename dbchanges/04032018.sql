ALTER TABLE `cars`
  ADD COLUMN `engine_condition` VARCHAR (10) NULL AFTER `remarks`,
  ADD COLUMN `automatic_condition` VARCHAR (10) NULL AFTER `engine_condition`,
  ADD COLUMN `rust_body` VARCHAR (10) NULL AFTER `automatic_condition`,
  ADD COLUMN `rust_engine` VARCHAR (10) NULL AFTER `rust_body` ;

ALTER TABLE `cars` ADD COLUMN `groupid` INT(5) NULL AFTER `modified_by`;