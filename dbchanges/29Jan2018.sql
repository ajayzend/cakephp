ALTER TABLE `cars` ADD COLUMN `created_by` INT(10) NULL AFTER `isrecent`;

ALTER TABLE cars ADD COLUMN `modified_by` INT(10) NULL AFTER `created_by`;

update cars set created_by = 1;
update cars set modified_by = 1;

update car_payments set created_by = 1;

ALTER TABLE `cars` CHANGE `purchase_country_id` `purchase_country_id` INT(11) NULL, CHANGE `country_id` `country_id` VARCHAR(255) CHARSET latin1 COLLATE latin1_swedish_ci NULL;

ALTER TABLE `car_payments` CHANGE `auction_id` `auction_id` VARCHAR(200) CHARSET utf8 COLLATE utf8_general_ci NULL, CHANGE `auction_name` `auction_name` VARCHAR(250) CHARSET utf8 COLLATE utf8_general_ci NULL;