UPDATE cars SET groupid = 1 WHERE groupid <> 2 OR groupid IS NULL;

ALTER TABLE car_payments ADD COLUMN `psale_freight` FLOAT(11,2) NULL AFTER `sale_price`;
ALTER TABLE `logistics` ADD COLUMN `bl_no` VARCHAR(50) NULL AFTER `destination_port`;
ALTER TABLE `cars` ADD COLUMN `consignee` VARCHAR(100) NULL AFTER `recommended`;
ALTER TABLE `car_payments` CHANGE `psale_freight` `psale_freight` FLOAT(11,2) DEFAULT 0.00 NULL;