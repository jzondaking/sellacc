CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `order_code` text,
  `buyer` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `icon` text NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `icon`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/2021_Facebook_icon.svg/225px-2021_Facebook_icon.svg.png', 'Facebook Accounts', '2022-03-28 21:34:06', '2022-05-07 10:25:03'),
	(2, 'https://play-lh.googleusercontent.com/TBRwjS_qfJCSj1m7zZB93FnpJM5fSpMA_wUlFDLxWAb45T9RmwBvQd5cWR5viJJOhkI', 'Netflix Accounts', '2022-05-07 17:25:47', '2022-05-07 10:25:53'),
	(3, 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Twitter-logo.svg/1200px-Twitter-logo.svg.png', 'Twitter Accounts', '2022-05-07 17:26:34', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text NOT NULL,
  `content` text NOT NULL,
  `balance` text,
  `order_code` text,
  `useragent` text NOT NULL,
  `ip` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
	(6, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
	(7, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
	(8, '2016_06_01_000004_create_oauth_clients_table', 2),
	(9, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
	('1e30f20cf55d21e446de29df1720b6e589b34936888ccf17cde44a3516fea9c179b9a9761658861d', 6, 1, 'Auth Token', '[]', 0, '2022-05-02 03:35:14', '2022-05-02 03:35:14', '2023-05-02 03:35:14'),
	('469d80a8c066026db9e96a99adbd35344d46ee434a37e41515614407b2a71b031526e4fa42db4eeb', 2, 1, 'Auth Token', '[]', 0, '2022-04-02 00:39:29', '2022-04-02 00:39:29', '2023-04-02 00:39:29'),
	('4ca1cd7ae084bb7ace0bf0bfc8cda2fa7cfd719a2aa1ef45be37926d069579d8192918a5f4d847a1', 1, 1, 'Auth Token', '[]', 0, '2022-03-28 13:52:13', '2022-03-28 13:52:13', '2023-03-28 13:52:13'),
	('8fb354f7c29f01e8d7cdd83f42d6016498b7e302188623e640fab510969e02ed442f880615f28510', 4, 1, 'Auth Token', '[]', 0, '2022-04-18 11:53:34', '2022-04-18 11:53:34', '2023-04-18 11:53:34'),
	('9688b6d9596297436f61c879d32d441ef0051b479c456afbba8b8a4e0851d38afc092a9c1f6dd52e', 3, 1, 'Auth Token', '[]', 0, '2022-04-02 05:03:46', '2022-04-02 05:03:46', '2023-04-02 05:03:46'),
	('e452c386cf71e55d057fea373e125ca3fd9613f744500686a45e87a8c1db74f6f57cbfb9cf71d946', 5, 1, 'Auth Token', '[]', 0, '2022-04-18 14:21:32', '2022-04-18 14:21:32', '2023-04-18 14:21:32');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
	(1, NULL, 'Laravel Personal Access Client', 'vtOdkMsvDgkAfbicLssNjkJyJIC1WAaqSAhTsMM4', NULL, 'http://localhost', 1, 0, 0, '2022-03-28 12:01:47', '2022-03-28 12:01:47'),
	(2, NULL, 'Laravel Password Grant Client', 'YrIifUN09apDQrFbYGOZzFZZ2ORbQVeeMnkIISeV', 'users', 'http://localhost', 0, 1, 0, '2022-03-28 12:01:47', '2022-03-28 12:01:47');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
	(1, 1, '2022-03-28 12:01:47', '2022-03-28 12:01:47');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` text NOT NULL,
  `buyer` text NOT NULL,
  `product` json NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `total_pay` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` (`id`, `code`, `buyer`, `product`, `product_id`, `quantity`, `total_pay`, `created_at`, `updated_at`) VALUES
	(1, 'MHRQU5RKFPC', 'xiunhangiaasdasd@gmai.com', '{"id": 11, "hot": 1, "flag": "VN", "name": "Facebook Accounts Created At Vietnam 2007", "sold": 0, "price": 60, "maximum": 100000, "minimum": 1, "created_at": "2022-05-07T17:54:02.000000Z", "updated_at": null, "category_id": 1, "description": null}', 11, 10, 600, '2022-05-07 18:02:47', NULL);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` text NOT NULL,
  `name` text NOT NULL,
  `number_account` text NOT NULL,
  `owner` text NOT NULL,
  `branch` text,
  `note` longtext,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
INSERT INTO `payments` (`id`, `logo`, `name`, `number_account`, `owner`, `branch`, `note`, `created_at`, `updated_at`) VALUES
	(5, 'https://www.paypalobjects.com/webstatic/icon/pp258.png', 'Paypal', 'jzondev@gmail.com', 'JZON DEV SAMPLE', NULL, 'CAPTURE BILL + DM TELEGRAM FOR WEB CASH', '2022-05-07 18:18:32', NULL),
	(6, 'https://upload.wikimedia.org/wikipedia/vi/thumb/f/fe/MoMo_Logo.png/220px-MoMo_Logo.png', 'MoMo E-Wallet', '0123456789', 'PHAM DUC THANH', NULL, 'Only for Vietnamese customers', '2022-05-07 18:18:53', NULL),
	(7, 'https://bitcoin.org/img/icons/opengraph.png?1651392467', 'Bitcoin', '1F1tAaz5x1HZXrCNLbtMDqcw6o5CZa4xqX', 'Bitcoin Address', NULL, 'CAPTURE TRANSACTION + DM TELEGRAM FOR WEB CASH', '2022-05-07 18:19:10', NULL);
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text,
  `flag` text,
  `price` float NOT NULL,
  `minimum` int(11) NOT NULL,
  `maximum` int(11) NOT NULL,
  `sold` int(11) NOT NULL DEFAULT '0',
  `hot` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `flag`, `price`, `minimum`, `maximum`, `sold`, `hot`, `created_at`, `updated_at`) VALUES
	(5, 1, 'Business manager account Limit $50 created on MIX accounts', 'Order deliver instantly.', NULL, 4, 1, 10000, 0, 1, '2022-05-07 17:41:00', NULL),
	(6, 1, 'BM $250 created on US accounts', 'Order deliver instantly.', 'US', 30, 1, 100000, 0, 0, '2022-05-07 17:41:54', NULL),
	(7, 2, 'Netflix Premium for 1 User (1 Day)', 'Expiry date is 24 hours from the date of purchase.', NULL, 0.39, 1, 100, 0, 0, '2022-05-07 17:44:23', NULL),
	(8, 2, 'Netflix Premium for 1 User (1 Month)', '1 month only', NULL, 3.44, 1, 10000, 0, 0, '2022-05-07 17:45:55', NULL),
	(9, 3, 'Twitter accounts with 100k followers', 'You can have a Twitter account with 100,000 followers at an affordable price. The followers of the account are mixed users from all over the world.', NULL, 100, 1, 10, 0, 0, '2022-05-07 17:47:03', NULL),
	(10, 3, 'Twitter 2010 Accounts', '2010 accounts. insurance 24 hours', NULL, 2, 1, 10, 0, 0, '2022-05-07 17:47:54', NULL),
	(11, 1, 'Facebook Accounts Created At Vietnam 2007', NULL, 'VN', 60, 1, 100000, 1, 1, '2022-05-07 17:54:02', '2022-05-07 11:02:47');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `value` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `name`, `value`) VALUES
	(1, 'website_name', 'SELLACC'),
	(2, 'client_title', 'SELLACC'),
	(3, 'logo', '/@jzon/images/jzontech.svg'),
	(4, 'client_title_banner', 'SELLACC.COM - SOCIAL MEDIA ACCOUNTS SHOP'),
	(5, 'client_description_banner', 'Leading marketplace to buy and sell established Instagram accounts, Youtube channels & Tiktok accounts!'),
	(6, 'client_image_banner', 'https://i.ibb.co/hDypqsT/network-1591589833510328454113.jpg'),
	(7, 'marquee_nofication', 'LOREM IPSUM IS SIMPLY DUMMY TEXT OF THE PRINTING AND TYPESETTING INDUSTRY. LOREM IPSUM HAS BEEN THE INDUSTRY\'S STANDARD DUMMY TEXT EVER SINCE THE 1500S, WHEN AN UNKNOWN PRINTER TOOK A GALLEY OF TYPE AND SCRAMBLED IT TO MAKE A TYPE SPECIMEN BOOK. IT HAS SURVIVED NOT ONLY FIVE CENTURIES, BUT ALSO THE LEAP INTO ELECTRONIC TYPESETTING, REMAINING ESSENTIALLY UNCHANGED. IT WAS POPULARISED IN THE 1960S WITH THE RELEASE OF LETRASET SHEETS CONTAINING LOREM IPSUM PASSAGES, AND MORE RECENTLY WITH DESKTOP PUBLISHING SOFTWARE LIKE ALDUS PAGEMAKER INCLUDING VERSIONS OF LOREM IPSUM.'),
	(8, 'deposit_prefix', 'SHOPNAME'),
	(9, 'favicon', '/client/assets/images/favicon/favicon.ico'),
	(10, 'keywords', 'we sell netflex accounts'),
	(11, 'description', 'we sell netflex accounts'),
	(12, 'captcha_v2_secret', 'your secret key'),
	(13, 'captcha_v2_site', 'your site key'),
	(14, 'captcha_v2_mode', 'off'),
	(15, 'registration_limit_per_day', '10');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;

CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `cash` float NOT NULL DEFAULT '0',
  `cash_used` float NOT NULL DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_ip` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `cash`, `cash_used`, `password`, `role`, `last_ip`, `remember_token`, `access_token`, `created_at`, `updated_at`) VALUES
	(1, 'jzondev', 'admin@jzontech.asia', NULL, 9980920, 0, '$2y$10$h9cqT71WKYZBG3OBivaEa.azVTExJy2lcHWodI9N2ViLwKVIr2JSG', 'admin', NULL, 'J3YBAHuwkyRFED2EPqRkiCQKUt4sHJG9cRxEFKhLqqg3AFQvix19brqMhIRO', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGNhMWNkN2FlMDg0YmI3YWNlMGJmMGJmYzhjZGEyZmE3Y2ZkNzE5YTJhYTFlZjQ1YmUzNzkyNmQwNjk1NzlkODE5MjkxOGE1ZjRkODQ3YTEiLCJpYXQiOjE2NDg0NzU1MzMuODc2MjQzLCJuYmYiOjE2NDg0NzU1MzMuODc2MjQ0LCJleHAiOjE2ODAwMTE1MzMuODY2MTQzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.rw7ke5Qx06kX5Fj2JqS-SDdXLQZoxWPUq5oJbKUwWi83xZTxpvIyqQOldDcrTJuv3Lr4h1erEwMb12dlYRGRJlR5zLLM6sEM6xpiVQba2Vy9VncMc1TQO7aNSbkRcsX80N1yAvmx7BbSxc_4UOmKmT3c9WgsCK_ScZgSoyoiI6pooBxz9sa-s71puLsK5HXJeQeyVJJH2nxToABcjPf4rYUtmVSTJ161XmDHLez7Kvn-hZqXkkwQp7GMV1Ur9XPYWlSxYt026lG2HlyACHOTh8IT2-vR-DLb0SktlbfRC9TagT_-c586YhDbTbwjxS7UT_vW25uj_HuE95Ee3EVTk_JkQ-IUrncZyzKWLUSSiRrYkzzSDMoiZBTeAck5tKIFEdUUtKT8YEKzch-ijRCM6VhR_fglfccVClR08KACf-95FshCBIK4LMgxpqNNGjvz4BcWxCQd03MybgkiKpdDBTw3TPq74RtUToUSyp9fN3GWmTR4WSX9jD8oCpwVjwsuIikbEOglr9YZA6hrbB3m9rWTN0fBtti7DCneeFEvgy_7M-Hchhvu8l6y3Cj1X9tKuIthZbBa8e91cll5SGzjCQiuDikLPhMblyY1sQHG6l1S-rmKUoBP4TN-N1eTLYZABOXrRG7nNcmuEyLKN42ULGDyplcI4sjeYHC6OSMoloY', NULL, '2022-04-01 13:39:27'),
	(4, 'deptrai9x', 'deptrai9x@gmail.com', NULL, 10000, 1, '$2y$10$rj0Ja2NFB5GDGB8DFRM/PuTswmkX3EYeMrj0zp9gMQ/nrqKV.xjGa', 'member', NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiOGZiMzU0ZjdjMjlmMDFlOGQ3Y2RkODNmNDJkNjAxNjQ5OGI3ZTMwMjE4ODYyM2U2NDBmYWI1MTA5NjllMDJlZDQ0MmY4ODA2MTVmMjg1MTAiLCJpYXQiOjE2NTAyODI4MTQuMDcyNzQ1LCJuYmYiOjE2NTAyODI4MTQuMDcyNzQ2LCJleHAiOjE2ODE4MTg4MTQuMDYzNTUyLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.RseJzJRLlBPqzTUkfVsJoWg72KHi8amVqJRwRlsmn1tzMJuTJuNXhk-NUGTLRynzUTaRsZSkJ1sKs-ZTgzJBMhnSa7DafTClArFRrEKI46xWgI5D0hwz5TaQu0PhTmyk6bldzI6FBCiCEjfTiGZXXAw2ZvU2Y2f1L12lGq3p30668dySyC0y94nnjP_Lg_fgiC_JESM036nPwSaHvxo3FU1JW5Zu2frzYG1Azj4U-VhYLtYvM8AKxMmHTN3Xuga-5_1jdhNtbqi691uUvn9UCc49mUyGJlAKNXnovC4v_qm_2GPir-qM7ood9_DfUtb-JQULrXQnXfC-aWeLIOnBeaKfMkRKa9fErvIeWMgJtD9IiJQQFmdEFJLJ-8CTiGozjiR4AaO_Y97H4dFcNP1vk7e-WuQopctDqobtxf4v2TR5zMqfJWwQu1Ap5nzxS-6Q35dlrIyHqKIVMH6tvY5yg21LS8cuQM2aV8c1iB8UEH8BLiHpygI6ZvM4S44YYWFiyLl6QMD9aKbCWJhm-i40hgCVSPIkiDgnlKmBIdZmrdZWbRVsaib21Iyg7wcCuNpKQDlPg_nOl1eHkhfVINBIDuO0sxQJxhElksVZMxrx98tCN8eMXfkYy6ZaLA9U6ahWwMnn4GmwHrtK--T4iEASYP-QWdRV1WU5pgIr3iu9PTU', NULL, '2022-04-18 14:19:01'),
	(5, 'xiunhan', 'xiunhangiaasdasd@gmai.com', NULL, 11093100, 0, '$2y$10$WIWa7PLzbyAqAg07tHaFXOsbTIfh57lg45U7RjjUTUULyNkwAr6P6', 'admin', '127.0.0.1', 'jt6U38HinJuvsT1UfzLEbeH6odblbqEwtzbEvq3Jnk3fTPsk1pdF0u3bKA4W', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiZTQ1MmMzODZjZjcxZTU1ZDA1N2ZlYTM3M2UxMjVjYTNmZDk2MTNmNzQ0NTAwNjg2YTQ1ZTg3YThjMWRiNzRmNmY1N2NiZmI5Y2Y3MWQ5NDYiLCJpYXQiOjE2NTAyOTE2OTIuNjAxNzU4LCJuYmYiOjE2NTAyOTE2OTIuNjAxNzU5LCJleHAiOjE2ODE4Mjc2OTIuNTk1MTQsInN1YiI6IjUiLCJzY29wZXMiOltdfQ.1JQ2SlPje1w1IIFn7v8a6vOva5kft8j9p6duJSBsqTBJj1X17VhtD_4z09iARK6gS9xHG1L_PsjQ35Co5d9tZ-BsF4jkHvognpFXEwm1Ax3biBBQOJ6QPB-oD_D0E3VkZUR-RdSPcYPtXgk9a7PPI388j0ktTGAkgzHCLC-LQfX0He9cgiDzA7313wXq3skud8WI58tvS8dIA6ZCJrY2_ba-22YjQlfrM41JwoQ_vJEXa6qAGMCExkntgNIY19FWGjTmnpYkbxR6_lvhcKBgtULMo4AJnaGHdup-Dj0gG4Y01CO803TogPktjOrR446G_PLxiJD0CPyeARp2t4w0eqd9NTb10DXSO3wnOTAvdXElDnFIlrOODm3xRS8HB_Zl5Shj7tNMqmxwuoFJ6Hf3HFPr3DYaN-afKzGkcbro1SJP5Y2IQU-rsK5pFxhY2M0nLFCoX8E32xGJdLjH4mJizjTiumCU6mz2WmDdcs9SxVIDvMsWuRW_fPvRw4U5WxVtdHh6tYtVwIveBArHE9HU4dW4ErulGdeAt9iP_Muwr2DrkNl13tkptTrENab6hi6qTet9-MKHaxgWSzzSX2SPQaDVTH3zgXlcPxV3IRK6xGTnwkvQAYz-DsWyqMG5sYLK026xu13OoEC7siwc-DTM6xuhtXWEQs32xLoqWcjJczw', NULL, '2022-05-07 11:02:47'),
	(6, 'client', 'clientclient@gmail.com', NULL, 0, 0, '$2y$10$gocBi6EKqFlv65WVDdAHIuw1qI9xA876.woPg84.UJ1PZQ3M.Ntru', 'admin', NULL, NULL, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMWUzMGYyMGNmNTVkMjFlNDQ2ZGUyOWRmMTcyMGI2ZTU4OWIzNDkzNjg4OGNjZjE3Y2RlNDRhMzUxNmZlYTljMTc5YjlhOTc2MTY1ODg2MWQiLCJpYXQiOjE2NTE0NjI1MTQuNjg1Njc1LCJuYmYiOjE2NTE0NjI1MTQuNjg1Njc3LCJleHAiOjE2ODI5OTg1MTQuNjE4Nzc5LCJzdWIiOiI2Iiwic2NvcGVzIjpbXX0.MKBFDn080Durt4stOCfOb9BnsP7ME8ERyl-kh5fb3wdHPG_m3jWP_xWEKWeLYoTGQFg1AGyCvdTvH6Cb6An22onRGDLBOgfp64EDJZlRba8-WXbEPPmd4IltXBPUoFJUAxYfISRk2MXhiOhBw8rmNfnZZL0vvHQGYxkGSoeNmcBso0Uwfff1k4AJs_EEwDD1ypSv6QA_eUCYUonaQtfsumZJugnIa-YP8JWBgY7B8vOTJizTxQGgneYuqLYx4uZD89TQDzTBlkpmNtDcYS89N67gpRLr8OuDug3MmFlXUhLJX5hC3BuhPHidV9I0BFXS0QE62sWYfRz70QRm3Y_df0HjlWQwpujL9gwuu9OErWiIJlBdPsIxhNrl-z5bpriyg5UjDVVRY2K8ff19CzfY2gj_kaC9aH3lbCUE-k2X47eBR2U5KICeykZgY_lIWRg4HXDfjPQAgI3_5akck_1kPU33ZVPiGGldeBAXnUlvfyNvK6qoS4Yl5FbuChXCz2Am_TYsInMEA8KUTR7MW5iXoUHZ3dfEi_pSa7VhdVelTL40okLxfjgGw0dkiVIZOQByyrPG4f2htvguZkFNZRnr4le1qkgWUp_Bd_aTChYv2ngjlgPFKoeyFmrErpctv-1GipnPvfpAPMuC0agwAL9OJfA-5nq4N5z2fy4AMfPcfTE', '2022-05-02 10:35:14', '2022-05-02 03:35:14');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;