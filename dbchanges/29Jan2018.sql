ALTER TABLE `cars` ADD COLUMN `created_by` INT(10) NULL AFTER `isrecent`;

ALTER TABLE cars ADD COLUMN `modified_by` INT(10) NULL AFTER `created_by`;

update cars set created_by = 1;
update cars set modified_by = 1;

update car_payments set created_by = 1;