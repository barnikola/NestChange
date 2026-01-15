CREATE TABLE `report` (
  `id` VARCHAR(36) PRIMARY KEY,
  `reporter_id` VARCHAR(36) NOT NULL,
  `reported_type` ENUM('listing','user','message') NOT NULL,
  `reported_id` VARCHAR(36) NOT NULL,
  `reason` VARCHAR(255) NOT NULL,
  `description` TEXT,
  `status` ENUM('pending','reviewed','resolved') NOT NULL DEFAULT 'pending',
  `created_at` DATETIME NOT NULL
);
