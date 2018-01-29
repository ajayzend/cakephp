ALTER TABLE `cars` ADD COLUMN `created_by` INT(10) NULL AFTER `isrecent`;

update cars set created_by = 1;

update car_payments set created_by = 1;