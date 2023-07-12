CREATE TABLE `tbl_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('pending','approved','rejected','deletd') NOT NULL DEFAULT 'pending',
  `description` text NOT NULL,
  `rejection_note` text DEFAULT NULL,
  `expired_on` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
);