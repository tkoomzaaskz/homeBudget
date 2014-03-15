INSERT INTO `sf_guard_user` (`id`, `first_name`, `last_name`, `email_address`, `username`, `algorithm`, `salt`, `password`, `is_active`, `is_super_admin`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'b', 's', 'bs', 'bs', 'sha1', 'bs', 'bs', 1, 1, '2013-08-24 16:15:37', '2011-10-18 19:22:26', '2013-08-24 16:15:38'),
(2, 't', 'd', 'td', 'td', 'sha1', 'td', 'td', 1, 1, '2013-08-25 19:45:28', '2011-10-18 19:22:27', '2013-08-25 19:45:28');

INSERT INTO `category` (`id`, `parent_id`, `name`, `type`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, NULL, 'jedzenie', 'OutcomeCategory', '2011-10-18 19:22:27', '2011-10-18 19:22:27', 2, 2),
(2, NULL, 'zarobek', 'OutcomeCategory', '2011-10-18 19:22:27', '2011-10-18 19:22:27', 2, 2);

INSERT INTO `income` (`id`, `category_id`, `amount`, `description`, `created_at`, `created_by`) VALUES
(1, 2, '10.10', 'prezent od mikolaja', '2011-08-10 00:00:00', 1);

INSERT INTO `outcome` (`id`, `category_id`, `description`, `amount`, `created_at`, `created_by`) VALUES
(1, 1, 'szama', '121.46', '2011-09-01 00:00:00', 2);
