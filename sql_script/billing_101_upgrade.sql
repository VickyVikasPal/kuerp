-- 26-June-2023
CREATE TABLE IF NOT EXISTS `branchs` (
  `id` char(36) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `branch_code` varchar(10) DEFAULT NULL,
  `ip_address` text,
  `status` varchar(25) DEFAULT NULL,
  `upload_path` varchar(255) DEFAULT NULL,
  `default_branch` tinyint(1) DEFAULT '0',
  `for_mobileapp` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
);
INSERT INTO `branchs` (`id`, `name`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `description`, `deleted`, `assigned_user_id`, `branch_code`, `ip_address`, `status`, `upload_path`, `default_branch`, `for_mobileapp`) VALUES
('12a19da2-fec7-9360-cc97-645397faa635', 'Gabriel Witt', '2023-05-04 11:31:33', '2023-05-04 11:31:33', '1', '1', 'Asperiores voluptate', 0, NULL, 'aaaa', 'Enim aut itaque enim', 'Active', 'Ullam nihil qui labo', 1, 1),
('18098667-ac62-b2bd-8886-6453959d9ccb', 'Lucas Santos', '2023-05-04 11:23:32', '2023-05-04 11:28:13', '1', '1', 'Magnam a ex at ea na', 1, NULL, 'sss', 'Quia nihil cupiditat', 'Active', 'Tenetur doloremque q', 0, 1),
('2e0280b3-36fe-e73d-57da-645395859a43', 'Orla Salas', '2023-05-04 11:23:49', '2023-05-04 11:28:08', '1', '1', 'Excepteur amet debi', 1, NULL, 'aaaaaaa', 'Ut aut qui fugiat p', 'InActive', 'Unde eum ut amet li', 0, 1),
('40997ce5-9550-9bf4-61bd-6453981423ac', 'Dennis Rowe', '2023-05-04 11:33:33', '2023-05-04 11:33:33', '1', '1', 'Dicta excepteur amet', 0, NULL, 'jjj', 'Duis atque dolore co', 'Active', 'Id harum voluptatib', 0, 1),
('54d5f092-57b3-b629-5e5d-64539750525b', 'Quinn Knowles', '2023-05-04 11:32:31', '2023-05-04 11:32:31', '1', '1', 'Eos dolore quis pari', 0, NULL, 'ccc', 'Exercitation quia ut', 'InActive', 'Ullamco perspiciatis', 1, 0),
('629f24a6-7b8d-0e68-db47-645398ae3f47', 'Kalia Clements', '2023-05-04 11:34:04', '2023-05-04 11:34:04', '1', '1', 'Iure in harum iusto', 0, NULL, 'lll', 'Deleniti soluta in e', 'Active', 'Ullam ut nemo fuga', 0, 1),
('73baa42f-ec5d-6fe7-2b67-6453972785d5', 'Joel Rivers', '2023-05-04 11:33:17', '2023-05-04 11:33:17', '1', '1', 'Impedit incidunt v', 0, NULL, 'hhh', 'Quis non commodi ut', 'Active', 'Ratione amet rerum', 1, 1),
('7473a32b-4fad-bea2-9007-645397e851a6', 'Jordan Peterson', '2023-05-04 11:33:09', '2023-05-04 11:33:09', '1', '1', 'Impedit magnam ut d', 0, NULL, 'ggg', 'Non dolor in cupidit', 'Active', 'Quia ut magni provid', 1, 0),
('7efcc4f8-3057-a120-9e79-645398466ce7', 'Tanya Allison', '2023-05-04 11:33:51', '2023-05-04 11:33:51', '1', '1', 'Ratione eveniet qui', 0, NULL, 'kkk', 'Adipisicing fugit q', 'Active', 'Minus optio magnam', 1, 0),
('85c48e93-2137-f243-49cd-6453971779f7', 'Merritt Whitfield', '2023-05-04 11:32:21', '2023-05-04 11:32:21', '1', '1', 'Temporibus dicta odi', 0, NULL, 'bbb', 'Natus voluptatem Ad', 'InActive', 'Nam dicta vitae aute', 1, 1),
('92193ab5-24dd-a867-f142-64539730f7d9', 'Kasimir Welch', '2023-05-04 11:32:40', '2023-05-04 11:32:40', '1', '1', 'Dolore veritatis qui', 0, NULL, 'ddd', 'Aliquip voluptatem i', 'InActive', 'Perspiciatis occaec', 0, 0),
('ce6b778f-986d-4d85-bb7d-645393a64f12', 'Pascale Reeves', '2023-05-04 11:12:43', '2023-05-04 11:28:18', '1', '1', 'Minim nihil nemo qui', 1, NULL, 'Test', 'Dolores nihil conseq', 'InActive', 'Error incidunt pers', 1, 1),
('df2abc8f-5519-0144-f4b5-645398e9fa7b', 'Arthur Buchanan', '2023-05-04 11:34:15', '2023-05-04 12:59:08', '0', '1', 'Sit nesciunt ad ad', 1, NULL, 'mmm', 'Ipsa quis quam in q', 'InActive', 'Non excepteur vel di', 0, 1),
('e59be362-648e-5355-da12-6453978c7421', 'Andrew Merrill', '2023-05-04 11:32:49', '2023-05-04 11:32:49', '1', '1', 'Asperiores magni est', 0, NULL, 'ee', 'Perferendis dignissi', 'Active', 'Et et cupidatat ab r', 1, 0),
('eb45cffc-7c72-90e8-d17f-6453971be767', 'Tatiana Lloyd', '2023-05-04 11:33:01', '2023-05-04 11:33:01', '1', '1', 'Sit minim ut dolores', 0, NULL, 'fff', 'Officia nisi atque m', 'InActive', 'Delectus minima qua', 0, 0),
('f17103e3-9226-3eec-034d-64539885e9c4', 'Mark Hammond', '2023-05-04 11:33:27', '2023-05-04 11:33:27', '1', '1', 'Ex lorem laborum Es', 0, NULL, 'iii', 'Quis eum esse nulla', 'InActive', 'Blanditiis tempor la', 1, 0),
('fa3e0a19-73a9-56af-a31b-645391071c32', 'Stephen Blevins', '2023-05-04 11:06:01', '2023-05-04 11:28:23', '1', NULL, 'Doloremque nihil nem', 1, NULL, 'Ut non', 'Proident maxime sed', 'Active', 'Aliquam voluptas pro', 0, 1);
COMMIT;



-- 10-May-2023
RENAME TABLE `sequences` TO `master_sequences`;

-- 10 may --
CREATE TABLE `user_preferences` (
  `id` char(36) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_entered` datetime  DEFAULT NULL,
  `date_modified` datetime  DEFAULT NULL,
  `assigned_user_id` char(36)  DEFAULT NULL,
  `modified_user_id` char(36)  DEFAULT NULL,
  `created_by` char(36)  DEFAULT NULL,
  `branch_id` char(36) DEFAULT NULL,
  `contents` text,
  PRIMARY KEY (`id`),
  KEY `idx_userprefnamecat` (`assigned_user_id`,`branch_id`)
);

-- 11-May-2023

ALTER TABLE `personal_access_tokens` CHANGE `tokenable_id` `tokenable_id` VARCHAR(36) DEFAULT NULL;

CREATE TABLE `login_users` (
  `id` char(36) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `user_id` char(36) DEFAULT NULL,
  `logged_in` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `session_id` varchar(100) DEFAULT NULL,
  `remote_address` varchar(100) DEFAULT NULL,
  `mod_timestamp` varchar(100) DEFAULT NULL,
  `branch_id` char(36) DEFAULT NULL
);

ALTER TABLE `login_users` ADD PRIMARY KEY (`id`), ADD KEY `idx_log_ers_bch` (`branch_id`);

-- 15-May-2023
CREATE TABLE `global_settings` (
  `id` char(36) NOT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `status_number` int(4) DEFAULT 0,
  `status` VARCHAR(50) DEFAULT NULL,
  `last_run_date` date DEFAULT NULL,
  `other_configs` text DEFAULT NULL,
  `branch_id` VARCHAR(36) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `global_settings` (`id`, `name`, `date_entered`, `date_modified`, `deleted`, `status_number`, `status`, `last_run_date`, `other_configs`, `branch_id`) VALUES ('51f2d85d-54d2-11ec-a823-50c4e9428f10', 'no_allow_user_login', '2022-08-08 10:13:00', '2022-08-08 10:13:00', '0', '0', 'Yes', NULL, NULL, '9197651b-e2b9-1924-b931-54f13cfc31c0');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_client` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp DEFAULT NULL,
  `updated_at` timestamp DEFAULT NULL,
  `email_verified_at` timestamp DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_hash` varchar(32) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authenticate_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `heal_login` tinyint(1) DEFAULT '1',
  `salutation` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reports_to_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_notifications` tinyint(1) DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `department_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_home` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_mobile` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_work` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_other` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_status` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Active',
  `sex` char(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_street` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_city` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_state` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_postalcode` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_preferences` text COLLATE utf8mb4_unicode_ci,
  `use_real_names` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `portal_only` tinyint(1) DEFAULT '0',
  `mobileapp_view` tinyint(1) DEFAULT '0',
  `slot_duration` int(2) DEFAULT '0',
  `employee_status` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_code` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `leaving_date` date DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `patient_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_category_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messenger_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `messenger_type` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_group` tinyint(1) DEFAULT '0',
  `external_doctor` tinyint(1) DEFAULT '0',
  `share_percent` int(4) DEFAULT '0',
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_service` tinyint(1) DEFAULT '1',
  `quick_chat` tinyint(1) DEFAULT '1',
  `is_present` tinyint(1) DEFAULT '0',
  `in_time` datetime DEFAULT NULL,
  `laboratory_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_room` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pf_apply` tinyint(1) DEFAULT '1',
  `esi_apply` tinyint(1) DEFAULT '1',
  `bill_correction` tinyint(1) DEFAULT '0',
  `pf_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `esi_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_grp` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `relation_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medical_reg_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_category` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_confirm` date DEFAULT NULL,
  `emp_medical` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_marital_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_branch` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `micr_code` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emp_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `council_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mfn_validto` date DEFAULT NULL,
  `midwife_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nurse_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empgroup_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hrcandidate_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ohccompany_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ohcdepartment_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_date` date DEFAULT NULL,
  `emp_skill_category` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uan_number` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'To store Universal Account No.',
  `doctor_reg_number` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kiosk_counter_id` text COLLATE utf8mb4_unicode_ci,
  `token_limit` int(3) DEFAULT NULL COMMENT 'doctor token per day',
  `otp_date` datetime DEFAULT NULL,
  `otp` int(7) DEFAULT NULL,
  `local_lang_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
);

INSERT INTO `users` (`id`, `name`, `user_name`, `email_client`, `email`, `avatar`, `role_id`, `status`, `password`, `remember_token`, `created_at`, `updated_at`, `email_verified_at`, `date_entered`, `date_modified`, `modified_user_id`, `created_by`, `branch_id`, `user_hash`, `authenticate_id`, `heal_login`, `salutation`, `first_name`, `last_name`, `reports_to_id`, `user_type`, `receive_notifications`, `description`, `title`, `department_id`, `phone_home`, `phone_mobile`, `phone_work`, `phone_other`, `phone_fax`, `login_status`, `sex`, `email_address`, `address_street`, `address_city`, `address_state`, `address_country`, `address_postalcode`, `user_preferences`, `use_real_names`, `deleted`, `portal_only`, `mobileapp_view`, `slot_duration`, `employee_status`, `emp_code`, `joining_date`, `leaving_date`, `birth_date`, `patient_id`, `user_category_id`, `messenger_id`, `messenger_type`, `is_group`, `external_doctor`, `share_percent`, `qualification`, `specialization`, `sms_service`, `quick_chat`, `is_present`, `in_time`, `laboratory_id`, `current_room`, `pf_apply`, `esi_apply`, `bill_correction`, `pf_no`, `esi_no`, `blood_grp`, `father_name`, `relation_type`, `medical_reg_no`, `emp_category`, `date_confirm`, `emp_medical`, `emp_marital_status`, `account_no`, `bank_name`, `bank_branch`, `micr_code`, `pan_no`, `emp_type`, `council_name`, `mfn_validto`, `midwife_no`, `nurse_no`, `empgroup_id`, `hrcandidate_id`, `ohccompany_id`, `ohcdepartment_id`, `sms_date`, `emp_skill_category`, `uan_number`, `doctor_reg_number`, `kiosk_counter_id`, `token_limit`, `otp_date`, `otp`, `local_lang_name`) VALUES
('8c73e4d6-8646-4194-72be-645c8b14d996', 'Vikas 2 Pal 2', 'vikas2', 'mailto', 'vikas.pal2@Softdevinfo.com', NULL, '3', 1, '$2y$10$V9jmMkpLakyPM0GUdS90guKYsDTrLx2AogTgKeMAaFZ1zHgJ51sX6', NULL, NULL, NULL, NULL, '2023-05-11 06:31:41', '2023-05-11 13:22:22', 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', '629f24a6-7b8d-0e68-db47-645398ae3f47', NULL, NULL, 1, NULL, 'Vikas 2', 'Pal 2', NULL, NULL, 0, NULL, NULL, NULL, NULL, '8756966569', NULL, NULL, NULL, '1', 'Male', 'vikas.pal2@Softdevinfo.com', 'Noida2', 'Gutam Budh Nagar2', 'Uttar Pradesh2', 'USA', '110074', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Test Qualification2', 'Test Specialization2', 1, 1, 0, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('9ccdbeea-58f7-b632-6d65-645cb1674ebd', 'Jemima Shaffer', 'ziximebume', 'sugar', 'fesadola@mailinator.com', NULL, '2', 1, '$2y$10$3a/yBsbAsQU1ZdZhVTQI1uabLXupeXoq9wJHqtGdXBoN9QCNE2BIW', NULL, NULL, NULL, NULL, '2023-05-11 09:11:10', '2023-05-11 16:07:15', 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', '629f24a6-7b8d-0e68-db47-645398ae3f47', NULL, NULL, 1, NULL, 'Jemima', 'Shaffer', NULL, NULL, 0, NULL, NULL, NULL, NULL, '1122334455', NULL, NULL, NULL, '1', 'Female', 'fesadola@mailinator.com', 'Aut consequat Elige', 'Anim eum exercitatio', 'Asperiores cillum du', 'India', '147852', NULL, 0, 1, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Et tempore voluptat', 'Voluptates nobis est', 1, 1, 0, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('aa646fb1-4abd-945a-f775-6452288b571a', 'Admin', 'Admin', '', 'admin@admin.com', 'avatar/8uBijWUfbu1IRc5mntMrtXiYb3KN7omKGQ07rMsp.png', '1', 1, '$2y$10$aoLK1eHvjp6sQpbAzZYDTeb8gPLaL3a2t2rlMbOqRV5wIqf0mSlYO', NULL, '2023-03-14 15:40:42', '2023-04-30 22:09:20', NULL, NULL, NULL, NULL, NULL, '629f24a6-7b8d-0e68-db47-645398ae3f47', NULL, NULL, 1, NULL, 'Admin', NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Active', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
('e00aab53-8661-6ad6-47d3-645de566a88c', 'Test2 Last2', 'testuser', 'sugar', 'vikas.pal@Softdevinfo.com', NULL, '29', 1, '$2y$10$pP0rTZQxRI9xrp/Vxq4z3u3VbkP7zse1kO7iyTOzqCZvPH9TjLO8u', NULL, NULL, NULL, NULL, '2023-05-12 07:05:13', '2023-05-12 09:26:43', 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', '7efcc4f8-3057-a120-9e79-645398466ce7', NULL, NULL, 1, NULL, 'Test2', 'Last2', NULL, 'Accounts', 0, NULL, NULL, NULL, NULL, '8756966599', NULL, NULL, NULL, '1', 'Female', 'vikas.pal@Softdevinfo.com', 'Test Address', 'Test City', 'State', 'USA', '110099', NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 'Test 12th2', 'Test Doctor2', 1, 1, 0, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


DROP TABLE IF EXISTS `user_preferences`;
CREATE TABLE `user_preferences` (
  `id` char(36) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `branch_id` char(36) DEFAULT NULL,
  `contents` text,
  PRIMARY KEY (`id`)
);

INSERT INTO `user_preferences` (`id`, `category`, `deleted`, `date_entered`, `date_modified`, `assigned_user_id`, `modified_user_id`, `created_by`, `branch_id`, `contents`) VALUES
('4891f194-e413-efc5-8311-645de57859ed', 'Users', 0, '2023-05-12 07:05:13', '2023-05-12 07:17:41', 'e00aab53-8661-6ad6-47d3-645de566a88c', 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', '111', 'YToxMTp7czo4OiJpc19hZG1pbiI7YjoxO3M6MTQ6InVzZV9yZWFsX25hbWVzIjtiOjE7czoxMDoiZGF0ZWZvcm1hdCI7czo1OiJkLW0tWSI7czoxMDoidGltZWZvcm1hdCI7czo0OiJoOmlBIjtzOjg6InRpbWV6b25lIjtzOjE4OiJBZnJpY2EvQWRkaXNfQWJhYmEiO3M6MjoidXQiO2I6MTtzOjg6ImN1cnJlbmN5IjtzOjM6Ii05OSI7czozNToiZGVmYXVsdF9jdXJyZW5jeV9zaWduaWZpY2FudF9kaWdpdHMiO3M6MToiMiI7czoxMToibnVtX2dycF9zZXAiO3M6MjoiMTEiO3M6NzoiZGVjX3NlcCI7czoyOiIyMiI7czoyNjoiZGVmYXVsdF9sb2NhbGVfbmFtZV9mb3JtYXQiO3M6MjoiMzMiO30='),
('af701403-1c30-283d-44fa-645c8bfb0ab5', 'Users', 0, '2023-05-11 06:31:41', '2023-05-11 13:22:22', '8c73e4d6-8646-4194-72be-645c8b14d996', 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', '111', 'YToxMjp7czo4OiJpc19hZG1pbiI7YjoxO3M6MTQ6InVzZV9yZWFsX25hbWVzIjtiOjE7czoxMDoiZGF0ZWZvcm1hdCI7czo1OiJZLW0tZCI7czoxMDoidGltZWZvcm1hdCI7czo0OiJoOmlhIjtzOjg6InRpbWV6b25lIjtzOjEyOiJBZnJpY2EvQWNjcmEiO3M6MjoidXQiO047czo4OiJjdXJyZW5jeSI7TjtzOjM1OiJkZWZhdWx0X2N1cnJlbmN5X3NpZ25pZmljYW50X2RpZ2l0cyI7TjtzOjExOiJudW1fZ3JwX3NlcCI7TjtzOjMzOiJkZWZhdWx0X251bWJlcl9ncm91cGluZ19zZXBlcmF0b3IiO047czo3OiJkZWNfc2VwIjtOO3M6MjY6ImRlZmF1bHRfbG9jYWxlX25hbWVfZm9ybWF0IjtOO30='),
('c01c700b-4bed-084a-212c-645cb13e1e95', 'Users', 0, '2023-05-11 09:11:10', '2023-05-11 09:11:10', '9ccdbeea-58f7-b632-6d65-645cb1674ebd', 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', NULL, 'YTo5OntzOjE0OiJ1c2VfcmVhbF9uYW1lcyI7YjowO3M6MTA6ImRhdGVmb3JtYXQiO3M6NToibS9kL1kiO3M6MTA6InRpbWVmb3JtYXQiO3M6NDoiaDppQSI7czo4OiJ0aW1lem9uZSI7czoxMjoiQWZyaWNhL0FjY3JhIjtzOjI6InV0IjtiOjA7czo4OiJjdXJyZW5jeSI7czozOiItOTkiO3M6MzU6ImRlZmF1bHRfY3VycmVuY3lfc2lnbmlmaWNhbnRfZGlnaXRzIjtzOjE6IjUiO3M6MzM6ImRlZmF1bHRfbnVtYmVyX2dyb3VwaW5nX3NlcGVyYXRvciI7czoyMDoiQXV0IHZlbCBlc3QgZXN0IHByYWUiO3M6MjY6ImRlZmF1bHRfbG9jYWxlX25hbWVfZm9ybWF0IjtzOjIwOiJCZWF0YWUgb2ZmaWNpaXMgZXQgYSI7fQ==');

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE `user_roles` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `type` int(11) NOT NULL DEFAULT '2',
  `permissions` longtext COLLATE utf8mb4_unicode_ci,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `branch_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `modified_user_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
);

INSERT INTO `user_roles` (`id`, `name`, `status`, `type`, `permissions`, `date_entered`, `date_modified`, `branch_id`, `created_by`, `modified_user_id`, `deleted`) VALUES
('1', 'Admin', 1, 1, '\"[]\"', '2023-03-15 08:10:42', '2023-03-15 08:10:42', NULL, NULL, NULL, 0),
('2', 'User', 1, 1, '\"[\\\"App.Http.Controllers.Api.Dashboard.StatsController\\\"]\"', '2023-03-15 08:10:42', '2023-03-15 08:10:42', NULL, NULL, NULL, 0),
('27e1447a-3184-db1f-44be-645e23f25734', 'Test User Role', 0, 2, '\"{\\\"accessAccess\\\":[\\\"LanguageLanguage\\\"],\\\"accessView\\\":[\\\"AppHttpsAppList\\\",\\\"LanguageLanguage\\\"],\\\"accessList\\\":[\\\"AuthAuth\\\",\\\"LanguageLanguage\\\"],\\\"accessAdd\\\":[\\\"LanguageLanguage\\\"],\\\"accessEdit\\\":[\\\"AppCommonSoftdevExport\\\",\\\"LanguageLanguage\\\"],\\\"accessDelete\\\":[\\\"StatusStatus\\\",\\\"LanguageLanguage\\\"],\\\"accessExport\\\":[\\\"AccountAccount\\\",\\\"LanguageLanguage\\\",\\\"Category\\\",\\\"DashboardStats\\\",\\\"DashboardAdminLanguage\\\",\\\"Taxtype\\\",\\\"DashboardIncident\\\",\\\"Search\\\",\\\"SubCategory\\\",\\\"DashboardAdminComponent\\\",\\\"Branch\\\",\\\"User\\\"]}\"', '2023-05-12 11:29:14', '2023-05-12 11:56:11', NULL, 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', 0),
('29', 'Support', 1, 2, '\"{\\\"accessList\\\":[\\\"LanguageLanguage\\\",\\\"Product\\\"],\\\"accessAdd\\\":[\\\"LanguageLanguage\\\",\\\"AuthAuth\\\",\\\"Product\\\"],\\\"accessEdit\\\":[\\\"LanguageLanguage\\\",\\\"AuthAuth\\\",\\\"AppHttpsAppList\\\"],\\\"accessDelete\\\":[\\\"LanguageLanguage\\\",\\\"AuthAuth\\\",\\\"AppHttpsAppList\\\",\\\"StatusStatus\\\"],\\\"accessExport\\\":[\\\"LanguageLanguage\\\",\\\"AuthAuth\\\",\\\"AppHttpsAppList\\\",\\\"StatusStatus\\\",\\\"AccountAccount\\\"]}\"', '2023-03-27 10:19:59', '2023-03-27 10:20:33', NULL, NULL, NULL, 0),
('3', 'Developer', 1, 2, '\"[\\\"App.Http.Controllers.Api.Dashboard.StatsController\\\",\\\"App.Http.Controllers.Api.Dashboard.IncidentController\\\",\\\"App.Http.Controllers.Api.Dashboard.Admin.ComponentController\\\",\\\"App.Http.Controllers.Api.Dashboard.Admin.UserController\\\",\\\"App.Http.Controllers.Api.Dashboard.Admin.UserRoleController\\\",\\\"App.Http.Controllers.Api.Dashboard.Admin.SettingController\\\",\\\"App.Http.Controllers.Api.Dashboard.Admin.LanguageController\\\",\\\"App.Http.Controllers.Api.ProductController\\\"]\"', '2023-03-15 12:51:07', '2023-03-24 06:35:30', NULL, NULL, NULL, 0),
('377609be-8a47-d925-1011-645cdb7720e4', 'Test 1', 1, 2, '\"{\\\"accessAccess\\\":[],\\\"accessView\\\":[\\\"DashboardStats\\\",\\\"LanguageLanguage\\\"],\\\"accessList\\\":[\\\"DashboardAdminLanguage\\\",\\\"Taxtype\\\",\\\"DashboardStats\\\",\\\"LanguageLanguage\\\"],\\\"accessAdd\\\":[],\\\"accessEdit\\\":[],\\\"accessDelete\\\":[],\\\"accessExport\\\":[\\\"UserRole\\\",\\\"Product\\\",\\\"StatusStatus\\\"]}\"', '2023-05-11 12:11:23', '2023-05-12 16:56:25', NULL, 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', 1),
('6628e3bd-fd4f-5194-a398-645e1b892ed6', 'Test 12 May', 1, 2, '\"{\\\"accessAccess\\\":[\\\"LanguageLanguage\\\"],\\\"accessView\\\":[\\\"LanguageLanguage\\\",\\\"DashboardStats\\\"],\\\"accessList\\\":[],\\\"accessAdd\\\":[],\\\"accessEdit\\\":[],\\\"accessDelete\\\":[],\\\"accessExport\\\":[]}\"', '2023-05-12 10:59:05', '2023-05-12 16:55:58', NULL, 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', 1),
('6ebba35c-80e3-b0dd-7db1-645dff41431a', 'Test 12 May', 1, 2, '\"{\\\"accessAccess\\\":[\\\"LanguageLanguage\\\"],\\\"accessView\\\":[],\\\"accessList\\\":[],\\\"accessAdd\\\":[],\\\"accessEdit\\\":[],\\\"accessDelete\\\":[],\\\"accessExport\\\":[]}\"', '2023-05-12 08:58:36', '2023-05-12 16:56:06', NULL, 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', 1),
('dcdc2d39-b223-0823-9e15-645e1d58c3da', 'Testee', 1, 2, '\"{\\\"accessAccess\\\":[\\\"LanguageLanguage\\\"],\\\"accessView\\\":[\\\"LanguageLanguage\\\",\\\"DashboardStats\\\"],\\\"accessList\\\":[],\\\"accessAdd\\\":[],\\\"accessEdit\\\":[],\\\"accessDelete\\\":[],\\\"accessExport\\\":[\\\"DashboardAdminLanguage\\\",\\\"Category\\\",\\\"DashboardStats\\\",\\\"LanguageLanguage\\\"]}\"', '2023-05-12 11:05:50', '2023-05-12 16:55:46', NULL, 'aa646fb1-4abd-945a-f775-6452288b571a', 'aa646fb1-4abd-945a-f775-6452288b571a', 1);

-- 16-May-2023

CREATE TABLE `userdashlets` (
  `id` char(36) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `description` text,
  `deleted` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `column_width` varchar(50) DEFAULT NULL,
  `column_number` int(3) DEFAULT 1,
  `branch_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `emails` (
  `id` char(36) NOT NULL,
  `fromname` varchar(150) DEFAULT NULL,
  `fromaddress` varchar(150) DEFAULT NULL,
  `smtpserver` varchar(150) DEFAULT NULL,
  `smtpport` varchar(150) DEFAULT NULL,
  `smtpuser` varchar(150) DEFAULT NULL,
  `smtppassword` varchar(150) DEFAULT NULL,
  `date_entered` datetime DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `assigned_user_id` char(36) DEFAULT NULL,
  `branch_id` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `email_statuss` (
  `id` char(36) NOT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `assigned_user_id` char(36) DEFAULT NULL,
  `modified_user_id` char(36) DEFAULT NULL,
  `created_by` char(36) DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `branch_id` char(36) DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `fromname` varchar(255) DEFAULT NULL,
  `fromaddress` varchar(255) DEFAULT NULL,
  `smtpuser` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `html` text DEFAULT NULL,
  `request_from` varchar(255) DEFAULT '0',
  `status` varchar(255) DEFAULT '0',
  `reply_to_status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`id`)
);
-- 16 May 2023
ALTER TABLE `user_roles` ADD `assigned_user_id` VARCHAR(36) DEFAULT NULL AFTER `deleted`;

-- 17 May 2023
ALTER TABLE `users` ADD `assigned_user_id` VARCHAR(36) DEFAULT NULL AFTER `created_by`;

CREATE TABLE `schedulers` ( `id` varchar(36) NOT NULL, `deleted` tinyint(1) NOT NULL DEFAULT '0', `date_entered` datetime NOT NULL, `date_modified` datetime NOT NULL, `created_by` char(36) DEFAULT NULL, `modified_user_id` char(36) DEFAULT NULL, `assigned_user_id` char(36) DEFAULT NULL, `name` varchar(255) NOT NULL, `job` varchar(255) NOT NULL, `date_time_start` datetime NOT NULL, `date_time_end` datetime DEFAULT NULL, `job_interval` varchar(100) NOT NULL, `time_from` datetime DEFAULT NULL, `time_to` datetime DEFAULT NULL, `last_run` datetime DEFAULT NULL, `status` varchar(25) DEFAULT NULL, `catch_up` tinyint(1) DEFAULT '1', `branch_id` char(36) DEFAULT NULL, PRIMARY KEY (`id`), KEY `idx_schedule` (`date_time_start`,`deleted`), KEY `idx_sch_ers_bch` (`branch_id`) );

-- 17-May-2023
ALTER TABLE `userdashlets` MODIFY COLUMN `column_width` tinyint(1) DEFAULT 0;

ALTER TABLE `userdashlets` MODIFY COLUMN `column_number` tinyint(1) DEFAULT 0;

ALTER TABLE `userdashlets` CHANGE `column_width` `graph_view` tinyint(1) DEFAULT 0, CHANGE `column_number` `table_view` tinyint(1) DEFAULT 0;


ALTER TABLE `userdashlets` ADD COLUMN `status` VARCHAR(50) DEFAULT 'Active';

-- 18-May-2023

CREATE TABLE `userdashletsetups` (
  `id` VARCHAR(36) NOT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `date_entered` DATETIME DEFAULT NULL,
  `date_modified` DATETIME DEFAULT NULL,
  `modified_user_id` VARCHAR(36) DEFAULT NULL,
  `created_by` VARCHAR(36) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `assigned_user_id` VARCHAR(36) DEFAULT NULL,
  `user_type` VARCHAR(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `branch_id` VARCHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `userdashletconfigs` (
   `id` VARCHAR(36) NOT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `date_entered` DATETIME DEFAULT NULL,
  `date_modified` DATETIME DEFAULT NULL,
  `modified_user_id` VARCHAR(36) DEFAULT NULL,
  `created_by` VARCHAR(36) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `assigned_user_id` VARCHAR(36) DEFAULT NULL,
  `dashletsetup_id` VARCHAR(36) DEFAULT NULL,
  `user_type` VARCHAR(50) DEFAULT NULL,
  `dashlet_name` VARCHAR(150) DEFAULT NULL,
  `dashlet_module` VARCHAR(100) DEFAULT NULL,
  `dashlet_title` VARCHAR(150) DEFAULT NULL,
  `display_rows` int(4) DEFAULT 0,
  `myitems_only` tinyint(1) DEFAULT 0,
  `display_columns` VARCHAR(255) DEFAULT NULL,
  `hidden_columns` VARCHAR(255) DEFAULT NULL,
  `dashlet_count` int(5) DEFAULT 1,
  `dashlet_detail` text DEFAULT NULL,
  `branch_id` VARCHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
);

ALTER TABLE `userdashlets` ADD COLUMN `status` VARCHAR(50) DEFAULT 'Inactive';


-- 19-May-2023

CREATE TABLE `config` (
  `value` text DEFAULT NULL,
  `branch_id` char(36) DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL
);

-- 19-May-2023

ALTER TABLE `userdashlets` ADD `graph_type` VARCHAR(50) DEFAULT NULL AFTER `graph_view`;
ALTER TABLE `userdashletconfigs` ADD `graph_type` VARCHAR(50) DEFAULT NULL AFTER `dashlet_detail`;
ALTER TABLE `userdashletconfigs` ADD `graph_view` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`, ADD `table_view` TINYINT(1) NOT NULL DEFAULT '0' AFTER `graph_view`;



INSERT INTO `global_settings` (`id`, `name`, `date_entered`, `date_modified`, `deleted`, `status_number`, `status`, `last_run_date`, `other_configs`, `branch_id`, `description`) VALUES ('51f2d85d-54d2-11ec-a823-50c4e9428e33', 'login_with_captcha2', '2022-08-08 10:13:00', '2022-08-08 10:13:00', '0', '0', 'Yes', NULL, NULL, '629f24a6-7b8d-0e68-db47-645398ae3f47', NULL);

-- 20-May-2023

CREATE TABLE `schedulers_times` (
  `id` VARCHAR(36) NOT NULL,
  `name` VARCHAR(255) DEFAULT NULL,
  `date_entered` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `created_by` VARCHAR(36) DEFAULT NULL,
  `modified_user_id` VARCHAR(36) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT 0,
  `scheduler_id` VARCHAR(36) DEFAULT NULL,
  `execute_time` datetime DEFAULT NULL,
  `status` VARCHAR(25) DEFAULT NULL,
  `branch_id` VARCHAR(36) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
INSERT INTO `global_settings` (`id`, `name`, `date_entered`, `date_modified`, `deleted`, `status_number`, `status`, `last_run_date`, `other_configs`, `branch_id`, `description`) VALUES ('51f2d85d-54d2-11ec-a823-50c4e9428f33', 'two_factor_authentication', '2022-08-08 10:13:00', '2022-08-08 10:13:00', '0', '0', 'Yes', NULL, NULL, '9197651b-e2b9-1924-b931-54f13cfc31c0', NULL);

-- 01-June-2023

ALTER TABLE `audits_products` CHANGE `user_id` `user_id` VARCHAR(36) DEFAULT NULL;

-- 02-June-2023

ALTER TABLE `userdashletsetups` ADD `left_width` int(3) DEFAULT 60;
ALTER TABLE `userdashletsetups` ADD `right_width` int(3) DEFAULT 40;
ALTER TABLE `userdashlets` ADD `dashlet_setup_id` VARCHAR(36) DEFAULT NULL;
ALTER TABLE `userdashletconfigs` ADD `dashlet_id` VARCHAR(36) NULL DEFAULT NULL AFTER `dashletsetup_id`;
ALTER TABLE `userdashlets` ADD `show_dashlets` TINYINT(1) NOT NULL DEFAULT '0' AFTER `dashlet_setup_id`;


-- 09-June-2023

CREATE TABLE `countrylists` (
  `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `isd_code` VARCHAR(10) DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `statelists` (
  `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

-- 30-June-2023

CREATE TABLE `vendormasters` (
`id` char(36) NOT NULL,
`name` varchar(255) DEFAULT NULL,
`date_entered` datetime NOT NULL,
`date_modified` datetime NOT NULL,
`modified_user_id` char(36) DEFAULT NULL,
`created_by` char(36) DEFAULT NULL,
`assigned_user_id` char(36) DEFAULT NULL,
`deleted` tinyint(1) DEFAULT '0',
`vendor_id` VARCHAR(36) DEFAULT NULL,
`firm_name` VARCHAR(255) DEFAULT NULL,
`contact_no` TEXT DEFAULT NULL,
`vendor_email` VARCHAR(255) DEFAULT NULL,
`gst_status` VARCHAR(10) DEFAULT NULL,
`gst_number` VARCHAR(20) DEFAULT NULL,
`address` TEXT DEFAULT NULL,
`area` VARCHAR(100) DEFAULT NULL,
`state` VARCHAR(100) DEFAULT NULL,
`pin_no` VARCHAR(10) DEFAULT NULL,
`status` VARCHAR(25) DEFAULT NULL,
`branch_id` char(36) DEFAULT NULL,
PRIMARY KEY (`id`)
);

-- 01-july-2023

ALTER TABLE `products` ADD COLUMN `product_qty` INT(11) DEFAULT 0 AFTER `product_name`;

-- 02-july-2023

ALTER TABLE `products` ADD COLUMN `description` TEXT DEFAULT NULL AFTER `branch_id`;

-- 08-July-2023

CREATE TABLE `purchases` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `bill_no` char(50) DEFAULT NULL,
 `bill_date` datetime NOT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `purchase_items` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `hsn_code` VARCHAR(50) DEFAULT NULL,
 `product_code` VARCHAR(50) DEFAULT NULL,
 `qty` VARCHAR(10) DEFAULT NULL,
 `unit_price` DOUBLE DEFAULT NULL,
 `total_value` DOUBLE DEFAULT NULL,
 `discount` int(5) DEFAULT 0,
 `discount_amount` DOUBLE DEFAULT NULL,
 `taxable_value` DOUBLE DEFAULT NULL,
 `tax_type` INT(5) DEFAULT 0,
 `cgst` DOUBLE DEFAULT NULL,
 `sgst` DOUBLE DEFAULT NULL,
 `igst` DOUBLE DEFAULT NULL,
 `total_amount` DOUBLE DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 `description` VARCHAR(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

ALTER TABLE `purchases` CHANGE `bill_date` `bill_date` DATE NOT NULL;

-- 09-July-2023

ALTER TABLE `purchase_items` ADD COLUMN `product_id` VARCHAR(36) DEFAULT NULL AFTER `parent_id`;

ALTER TABLE `purchases` ADD COLUMN `total_taxable` DOUBLE DEFAULT NULL AFTER `bill_date`;
ALTER TABLE `purchases` ADD COLUMN `total_tax` DOUBLE DEFAULT NULL AFTER `total_taxable`;
ALTER TABLE `purchases` ADD COLUMN `grand_total` DOUBLE DEFAULT NULL AFTER `total_tax`;

-- 11-July-2023

CREATE TABLE `clientmasters` (
`id` char(36) NOT NULL,
`name` varchar(255) DEFAULT NULL,
`date_entered` datetime NOT NULL,
`date_modified` datetime NOT NULL,
`modified_user_id` char(36) DEFAULT NULL,
`created_by` char(36) DEFAULT NULL,
`assigned_user_id` char(36) DEFAULT NULL,
`deleted` tinyint(1) DEFAULT '0',
`client_id` VARCHAR(36) DEFAULT NULL,
`firm_name` VARCHAR(255) DEFAULT NULL,
`contact_no` TEXT DEFAULT NULL,
`client_email` VARCHAR(255) DEFAULT NULL,
`gst_status` VARCHAR(10) DEFAULT NULL,
`gst_number` VARCHAR(20) DEFAULT NULL,
`address` TEXT DEFAULT NULL,
`area` VARCHAR(100) DEFAULT NULL,
`state` VARCHAR(100) DEFAULT NULL,
`pin_no` VARCHAR(10) DEFAULT NULL,
`status` VARCHAR(25) DEFAULT NULL,
`branch_id` char(36) DEFAULT NULL,
PRIMARY KEY (`id`)
);

-- 13-July-2023

CREATE TABLE `quotations` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `quotation_no` char(50) DEFAULT NULL,
 `total_taxable` DOUBLE DEFAULT NULL,
 `total_tax` DOUBLE DEFAULT NULL,
 `grand_total` DOUBLE DEFAULT NULL,
 `delivery_no` char(50) DEFAULT NULL,
 `invoice_no` char(50) DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `quotation_items` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `product_id` VARCHAR(36) DEFAULT NULL,
 `hsn_code` VARCHAR(50) DEFAULT NULL,
 `product_code` VARCHAR(50) DEFAULT NULL,
 `qty` VARCHAR(10) DEFAULT NULL,
 `unit_price` DOUBLE DEFAULT NULL,
 `total_value` DOUBLE DEFAULT NULL,
 `discount` int(5) DEFAULT 0,
 `discount_amount` DOUBLE DEFAULT NULL,
 `taxable_value` DOUBLE DEFAULT NULL,
 `tax_type` INT(5) DEFAULT 0,
 `cgst` DOUBLE DEFAULT NULL,
 `sgst` DOUBLE DEFAULT NULL,
 `igst` DOUBLE DEFAULT NULL,
 `total_amount` DOUBLE DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 `description` VARCHAR(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

-- 21-July-2023

CREATE TABLE `deliverys` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `quotation_id` char(36) DEFAULT NULL,
 `quotation_no` char(50) DEFAULT NULL,
 `delivery_no` char(50) DEFAULT NULL,
 `total_taxable` DOUBLE DEFAULT NULL,
 `total_tax` DOUBLE DEFAULT NULL,
 `grand_total` DOUBLE DEFAULT NULL,
 `invoice_no` char(50) DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `delivery_items` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `product_id` VARCHAR(36) DEFAULT NULL,
 `hsn_code` VARCHAR(50) DEFAULT NULL,
 `product_code` VARCHAR(50) DEFAULT NULL,
 `qty` VARCHAR(10) DEFAULT NULL,
 `unit_price` DOUBLE DEFAULT NULL,
 `total_value` DOUBLE DEFAULT NULL,
 `discount` int(5) DEFAULT 0,
 `discount_amount` DOUBLE DEFAULT NULL,
 `taxable_value` DOUBLE DEFAULT NULL,
 `tax_type` INT(5) DEFAULT 0,
 `cgst` DOUBLE DEFAULT NULL,
 `sgst` DOUBLE DEFAULT NULL,
 `igst` DOUBLE DEFAULT NULL,
 `total_amount` DOUBLE DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 `description` VARCHAR(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

-- 25-Aug-2023

CREATE TABLE `invoices` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `quotation_id` char(36) DEFAULT NULL,
 `delivery_id` char(50) DEFAULT NULL,
 `total_taxable` DOUBLE DEFAULT NULL,
 `total_tax` DOUBLE DEFAULT NULL,
 `grand_total` DOUBLE DEFAULT NULL,
 `invoice_no` char(50) DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `invoice_items` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `product_id` VARCHAR(36) DEFAULT NULL,
 `hsn_code` VARCHAR(50) DEFAULT NULL,
 `product_code` VARCHAR(50) DEFAULT NULL,
 `qty` VARCHAR(10) DEFAULT NULL,
 `unit_price` DOUBLE DEFAULT NULL,
 `total_value` DOUBLE DEFAULT NULL,
 `discount` int(5) DEFAULT 0,
 `discount_amount` DOUBLE DEFAULT NULL,
 `taxable_value` DOUBLE DEFAULT NULL,
 `tax_type` INT(5) DEFAULT 0,
 `cgst` DOUBLE DEFAULT NULL,
 `sgst` DOUBLE DEFAULT NULL,
 `igst` DOUBLE DEFAULT NULL,
 `total_amount` DOUBLE DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 `description` VARCHAR(255) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

ALTER TABLE  `deliverys` DROP `quotation_no`;

-- 30-Aug-2023

ALTER TABLE `invoices` ADD COLUMN `payment_status` VARCHAR(10) DEFAULT 'Pending' AFTER `status`;
ALTER TABLE `invoices` ADD COLUMN `payment_id` VARCHAR(10) DEFAULT NULL AFTER `payment_status`;

-- 02-Sep-2023

CREATE TABLE `payments` (
   `id` char(36) NOT NULL,
 `name` varchar(255) DEFAULT NULL,
 `date_entered` datetime NOT NULL,
 `date_modified` datetime NOT NULL,
 `modified_user_id` char(36) DEFAULT NULL,
 `created_by` char(36) DEFAULT NULL,
 `assigned_user_id` char(36) DEFAULT NULL,
 `deleted` int(1) NOT NULL DEFAULT '0',
 `parent_type` char(50) DEFAULT NULL,
 `parent_id` char(36) DEFAULT NULL,
 `total_taxable` DOUBLE DEFAULT NULL,
 `total_tax` DOUBLE DEFAULT NULL,
 `grand_total` DOUBLE DEFAULT NULL,
 `invoice_no` char(50) DEFAULT NULL,
 `status` VARCHAR(25) DEFAULT NULL,
 `branch_id` char(36) DEFAULT NULL,
 PRIMARY KEY (`id`)
);

ALTER TABLE `payments` ADD COLUMN `payment_no` VARCHAR(10) DEFAULT NULL AFTER `deleted`;
ALTER TABLE `payments` ADD COLUMN `payment_mode` VARCHAR(10) DEFAULT NULL AFTER `payment_no`;
ALTER TABLE `payments` ADD COLUMN `transaction_no` VARCHAR(30) DEFAULT NULL AFTER `payment_mode`;
ALTER TABLE `payments` ADD COLUMN `transaction_remark` VARCHAR(255) DEFAULT NULL AFTER `transaction_no`;

ALTER TABLE `invoices` CHANGE `payment_id` `payment_id` VARCHAR(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL;

-- 06-Sep-2023

ALTER TABLE `user_roles` CHANGE `status` `status` VARCHAR(10) NULL DEFAULT NULL;

CREATE TABLE `user_roles_actions` (
    `id` varchar(36) NOT NULL,
    `date_entered` datetime NOT NULL,
    `date_modified` datetime NOT NULL,
    `created_by` varchar(36) NOT NULL,
    `modified_user_id` varchar(36) NOT NULL,
    `assigned_user_id` varchar(36) DEFAULT NULL,
    `name` varchar(255) DEFAULT NULL,
    `description` text,
    `parent_type` varchar(36) DEFAULT NULL,
    `parent_id` varchar(36) DEFAULT NULL,
    `deleted` tinyint(1) DEFAULT '0',
    `branch_id` varchar(36) DEFAULT NULL,
    PRIMARY KEY (`id`)
    );


-- 24-july-2023

ALTER TABLE `user_roles_actions` ADD `access` VARCHAR(25) NULL DEFAULT NULL AFTER `branch_id`, ADD `delete` VARCHAR(25) NULL DEFAULT NULL AFTER `access`, ADD `export` VARCHAR(25) NULL DEFAULT NULL AFTER `delete`, ADD `list` VARCHAR(25) NULL DEFAULT NULL AFTER `export`, ADD `edit` VARCHAR(25) NULL DEFAULT NULL AFTER `list`, ADD `view` VARCHAR(25) NULL DEFAULT NULL AFTER `edit`;