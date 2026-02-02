CREATE TABLE IF NOT EXISTS `#__games` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '',
    `slug` varchar(255) NOT NULL DEFAULT '',
    `description` text NOT NULL,
    `release_date` date DEFAULT NULL,
    `image` varchar(1024) NOT NULL DEFAULT '',
    `is_approved` tinyint unsigned NOT NULL DEFAULT 0,
    `state` tinyint NOT NULL DEFAULT 1,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_slug` (`slug`),
    KEY `idx_state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__game_companies` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '',
    `slug` varchar(255) NOT NULL DEFAULT '',
    `abbreviation` varchar(50) NOT NULL DEFAULT '',
    `founded_at` date DEFAULT NULL,
    `deck` text NOT NULL,
    `description` text NOT NULL,
    `image_id` varchar(1024) NOT NULL DEFAULT '',
    `phone` varchar(100) NOT NULL DEFAULT '',
    `website` varchar(1024) NOT NULL DEFAULT '',
    `state` tinyint NOT NULL DEFAULT 1,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_slug` (`slug`),
    KEY `idx_state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__game_developers` (
    `game_id` int unsigned NOT NULL,
    `company_id` int unsigned NOT NULL,
    PRIMARY KEY (`game_id`, `company_id`),
    KEY `idx_company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__game_publishers` (
    `game_id` int unsigned NOT NULL,
    `company_id` int unsigned NOT NULL,
    PRIMARY KEY (`game_id`, `company_id`),
    KEY `idx_company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__game_platforms` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '',
    `slug` varchar(255) NOT NULL DEFAULT '',
    `company_id` int unsigned DEFAULT NULL,
    `abbreviation` varchar(50) NOT NULL DEFAULT '',
    `deck` text NOT NULL,
    `description` text NOT NULL,
    `image_id` varchar(1024) NOT NULL DEFAULT '',
    `install_base` varchar(255) NOT NULL DEFAULT '',
    `online_support` tinyint unsigned NOT NULL DEFAULT 0,
    `original_price` decimal(10,2) DEFAULT NULL,
    `released_at` date DEFAULT NULL,
    `state` tinyint NOT NULL DEFAULT 1,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_slug` (`slug`),
    KEY `idx_state` (`state`),
    KEY `idx_company_id` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS `#__game_dlcs` (
    `id` int unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL DEFAULT '',
    `slug` varchar(255) NOT NULL DEFAULT '',
    `game_id` int unsigned NOT NULL,
    `platform_id` int unsigned DEFAULT NULL,
    `deck` text NOT NULL,
    `description` text NOT NULL,
    `image_id` varchar(1024) NOT NULL DEFAULT '',
    `released_at` date DEFAULT NULL,
    `state` tinyint NOT NULL DEFAULT 1,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `idx_slug` (`slug`),
    KEY `idx_game_id` (`game_id`),
    KEY `idx_platform_id` (`platform_id`),
    KEY `idx_state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 DEFAULT COLLATE=utf8mb4_unicode_ci;
