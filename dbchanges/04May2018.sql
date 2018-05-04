INSERT INTO `user_groups` (`id`, `name`, `alias_name`, `allowRegistration`, `created`, `modified`, `deleted`) VALUES (NULL, 'Sell User', 'Sell User', '1', '2018-05-04 08:06:37', '2018-05-04 08:06:43', '0');

CREATE TABLE user_group_permissions_tmp LIKE user_group_permissions;
INSERT user_group_permissions_tmp SELECT * FROM user_group_permissions WHERE user_group_id = 2;
UPDATE user_group_permissions_tmp SET user_group_id = 5;
UPDATE user_group_permissions_tmp SET id = (id+401);
INSERT user_group_permissions SELECT *  FROM user_group_permissions_tmp;
DROP TABLE `user_group_permissions_tmp`;