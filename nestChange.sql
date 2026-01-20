-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2026 at 10:34 AM
-- Server version: 8.0.44-0ubuntu0.24.04.2
-- PHP Version: 8.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nestChange`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected','suspended') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_status_until` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('student','moderator','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `language` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'en',
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `status`, `email`, `password_hash`, `student_status_until`, `created_at`, `role`, `language`, `dob`) VALUES
(1, 'approved', 'ADMIN@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(2, 'approved', 'ONE@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(3, 'approved', 'THREE@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(4, 'approved', 'TWO@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(5, 'approved', 'tony.murray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(7, 'approved', 'nicole.barnes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(8, 'approved', 'penelope.farrell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(9, 'approved', 'frederick.wilson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(10, 'approved', 'george.holmes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(11, 'approved', 'leonardo.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(12, 'approved', 'arthur.hall@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(13, 'approved', 'amy.higgins@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(14, 'approved', 'henry.murray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(15, 'approved', 'victoria.morris@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(16, 'approved', 'sophia.holmes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(17, 'approved', 'patrick.casey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(18, 'approved', 'adison.barnes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(19, 'approved', 'violet.owens@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(20, 'approved', 'miranda.myers@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(21, 'approved', 'justin.morrison@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(22, 'approved', 'steven.craig@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(23, 'approved', 'honey.edwards@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(24, 'approved', 'alfred.douglas@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(25, 'approved', 'dainton.tucker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(26, 'approved', 'penelope.thomas@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(27, 'approved', 'mike.moore@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(28, 'approved', 'roman.wright@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(29, 'approved', 'catherine.lloyd@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(30, 'approved', 'nicole.parker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(31, 'approved', 'april.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(32, 'approved', 'spike.farrell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(33, 'approved', 'alen.foster@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(34, 'approved', 'elise.richardson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(35, 'approved', 'stuart.anderson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(36, 'approved', 'abraham.cole@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(37, 'approved', 'miranda.perry@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(38, 'approved', 'rafael.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(39, 'approved', 'alfred.mason@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(40, 'approved', 'adrian.brown@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(41, 'approved', 'stella.ross@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(42, 'approved', 'adam.gray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(43, 'approved', 'nicholas.scott@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(44, 'approved', 'marcus.roberts@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(45, 'approved', 'steven.crawford@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(46, 'approved', 'dexter.martin@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(47, 'approved', 'rubie.morrison@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(48, 'approved', 'jordan.andrews@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(49, 'approved', 'jacob.morgan@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(50, 'approved', 'deanna.fowler@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(51, 'approved', 'adrianna.tucker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(52, 'approved', 'stella.bailey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(53, 'approved', 'ellia.martin@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(54, 'approved', 'ryan.bailey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(55, 'approved', 'kristian.taylor@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(56, 'approved', 'maya.roberts@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(57, 'approved', 'alexia.harper@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(58, 'approved', 'dale.miller@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(59, 'approved', 'lucy.montgomery@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(60, 'approved', 'edward.moore@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(61, 'approved', 'kevin.spencer@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(62, 'approved', 'vanessa.ferguson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(63, 'approved', 'carlos.richardson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(64, 'approved', 'alissa.murray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(65, 'approved', 'adrian.wells@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(66, 'approved', 'kelsey.craig@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(67, 'approved', 'amber.montgomery@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(68, 'approved', 'ryan.cunningham@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(69, 'approved', 'lucy.chapman@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(70, 'approved', 'daisy.russell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(71, 'approved', 'kellan.edwards@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(72, 'approved', 'miley.warren@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(73, 'approved', 'sydney.mitchell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(74, 'approved', 'penelope.russell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(75, 'approved', 'tyler.bennett@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(76, 'approved', 'adele.reed@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(77, 'approved', 'eric.johnston@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(78, 'approved', 'deanna.phillips@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(79, 'approved', 'ryan.ross@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(80, 'approved', 'daisy.baker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(81, 'approved', 'reid.turner@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(82, 'approved', 'amelia.parker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(83, 'approved', 'miller.fowler@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(84, 'approved', 'martin.ryan@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(85, 'approved', 'adelaide.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(86, 'approved', 'garry.myers@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(87, 'approved', 'rafael.tucker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(88, 'approved', 'aldus.casey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(89, 'approved', 'jared.morrison@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(90, 'approved', 'garry.jones@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(91, 'approved', 'nicholas.alexander@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(92, 'approved', 'abigail.spencer@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(93, 'approved', 'lyndon.gray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(94, 'approved', 'elise.murphy@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(95, 'approved', 'agata.ryan@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(96, 'approved', 'emily.jones@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(97, 'approved', 'jordan.hamilton@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(98, 'approved', 'maximilian.johnson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(99, 'approved', 'violet.walker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(100, 'approved', 'darcy.phillips@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(101, 'approved', 'alexander.mitchell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(102, 'approved', 'michelle.hawkins@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(103, 'approved', 'michael.myers@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(104, 'approved', 'ted.fowler@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(105, 'approved', 'alina.craig@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(106, 'approved', 'nikolabaretic@eleve.isep.fr', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(107, 'approved', 'test@eleve.isep.fr', 'hash', NULL, '2025-12-07 17:55:16', 'student', 'en', NULL),
(108, 'pending', 'nikaosdk@gmail.com', '$2y$12$6KImNTywAO06w4VNGxqjfeOPhUSWy5W9bvZJ5Q6eheBjOpNzoFEGq', NULL, '2025-12-07 23:58:20', 'student', 'en', NULL),
(109, 'approved', 'nikola@ll.com', '$2y$12$0j06Aq62UoS1LRrdYEcuyu54SeKtQLw8jzMBWLZGq6GFuDkXR6Wju', '2026-04-25', '2025-12-08 00:46:23', 'student', 'en', NULL),
(110, 'pending', 'nikila@ll.com', '$2y$12$8nGFU4PIzgvUFZSH5aewGOczHP170lyyTeyVeZaSaceOLQ5pKZPjW', '2026-04-25', '2025-12-08 01:01:52', 'student', 'en', NULL),
(111, 'pending', 'nikaila@ll.com', '$2y$12$iA6zblThOGrBrfQoWiW1j.NtZ8KGNH2NegSmLAGmVgI.aWZ0n8bre', '2026-04-25', '2025-12-08 01:03:26', 'student', 'en', NULL),
(112, 'pending', 'nikola@gmail.com', '$2y$12$ERNQPPMDwTwCAvrObjA9bugSt6VJL4jKSfZvBsan0QDPWc/C6vA.y', '2026-01-31', '2025-12-09 21:57:18', 'student', 'en', NULL),
(113, 'approved', 'nikolanikola@gmail.com', '$2y$12$8PddFOdwezqnpVzhRMluBuCbXW4nA4bJYER8J3w06F1E5tD01RQ.a', '2026-04-18', '2025-12-10 10:15:40', 'admin', 'en', NULL),
(114, 'approved', 'aaa@gmail.com', '$2y$12$wbObuNqv/UQViuN4fkOiiOa/QoFCt7FUdo1w25PwcCVfcNvfj1Ckq', '2025-12-25', '2025-12-11 14:01:58', 'student', 'en', NULL),
(115, 'pending', 'aahsdhahdhadhaa@gmail.com', '$2y$12$VTmFBgYq2hhINr4B403Bh.TURdlI93esoUNqIrTnEIqFZTcoqgoea', '2025-12-25', '2025-12-11 14:08:06', 'student', 'en', NULL),
(116, 'pending', 'aahasashadhaa@gmail.com', '$2y$12$fqcF3T/bpBgxXfQ.qUIHlOeu/TaeBxgTrLHtskEu5AWBNWqisyNFy', '2025-12-25', '2025-12-11 14:12:29', 'student', 'en', NULL),
(117, 'approved', 'testing@test.com', '$2y$12$t34QXTJ.6HJE8DV8Rd9tMeixuDDKXyfAVBpgMWAOUlv0COZpE1tgS', '2025-12-30', '2025-12-14 23:08:05', 'student', 'en', NULL),
(118, 'approved', 'demo1@gmail.com', '$2y$12$1VHbWkBmH8z1z2AJbzsOZ.yUHjwltVLi2g8D3X3uag14QWkwk5yYq', '2026-06-26', '2025-12-17 10:38:16', 'student', 'en', NULL),
(119, 'approved', 'admindemo@gmail.com', '$2y$12$VO44H/ugfvV/05LjoneLh.RkfhCSH2aaf4jIzgNWm.8k.vLI8tg.e', '2099-06-28', '2025-12-17 10:39:05', 'admin', 'en', NULL),
(120, 'approved', 'tester2demo@gmail.com', '$2y$12$UuPB98S8aPrtpdzcsqO/lO7.7iS8rS2flmzVBF2vjX28zNbxsXc3e', '2026-05-31', '2025-12-17 10:39:45', 'student', 'en', NULL),
(121, 'approved', 'demo3@gmail.com', '$2y$12$8HAB4Ni4BnmPWKAIuhyXWubEFRcKEtO6DNGwY0HHbB63sXxrpbEDC', '2026-04-30', '2025-12-17 10:44:52', 'student', 'en', NULL),
(122, 'approved', 'demodemo@demo.com', '$2y$12$AP3LDPyC8AjfmWVlbIQ/7eB4geDl8TmMHAUMhF14lqtCW3GbEeRiG', '2025-12-28', '2025-12-17 14:20:21', 'student', 'en', NULL),
(123, 'approved', 'testtest@test.com', '$2y$12$6y3vGNkbSJpmfznsQbh32ebnfrLEgg0YB0KJIQPtTzE7hIXCiK/WW', '2026-03-25', '2025-12-17 15:55:02', 'student', 'en', NULL),
(124, 'approved', 'test@test.com', '$2y$12$2tv3T.bp0Twmupj4pDzTk.0Ot0Lbr50ZnJxlXl5X9pK4TR9SPK.4W', '2026-01-30', '2026-01-11 10:20:35', 'admin', 'en', NULL),
(125, 'approved', 'mal32@gmail.com', '$2y$12$4EXf9OLSPbNIoeJaa33gC.RBeDbRgT6hrovNkQVWQmHIFrOBpH7WS', '2026-01-29', '2026-01-13 11:39:01', 'student', 'en', NULL),
(126, 'approved', 'mal1@gmail.com', '$2y$12$Ce/ULvcOupB9wSxtKUogVu/aPupmWQj411y4HZ6iSPSCDCe9LgrKi', '2026-01-30', '2026-01-13 11:41:10', 'student', 'en', NULL),
(127, 'approved', 'mariferen52@gmail.com', '$2y$12$EmD5cBdwMMBgDf67hlbdruwptGwJ7smTz88JWqd0BULz3rLLg14xW', '2028-06-15', '2026-01-14 08:15:32', 'student', 'en', NULL),
(128, 'approved', 'mal@test.com', '$2y$12$BstGcmUZGqBUzZBQGs/DP.8yxJuS0lqVUzGT4HMx6o3mrZp/etLve', '2026-01-31', '2026-01-20 09:01:56', 'student', 'en', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `application_cancellations`
--

CREATE TABLE `application_cancellations` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `application_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci,
  `refund_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_cancellations`
--

INSERT INTO `application_cancellations` (`id`, `application_id`, `reason`, `refund_amount`, `created_at`) VALUES
('07bc72d2-7baa-4987-b346-13d97324b8c2', '5bee208c-1679-4bf9-abe8-7e6ffac5952b', 'User requested cancellation', 'Full', '2026-01-11 12:29:34'),
('e13bca1d-92a7-492b-a864-d42a8659ac11', 'deacce82-0cb0-4d29-9dd1-4acbc5b042f5', 'User requested cancellation', 'Full', '2026-01-11 12:23:01');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` smallint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `category`) VALUES
(1, 'WIFI', 'AMENITIES'),
(2, 'KITCHEN', 'AMENITIES'),
(3, 'DISHWASHER', 'AMENITIES'),
(4, 'PETS ALLOWED', 'RULES'),
(5, 'FREE PARKING', 'AMENITIES'),
(6, 'SMOKING NOT ALLOWED', 'RULES');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `contract` longblob,
  `listing_review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `listing_rating` int DEFAULT NULL,
  `guest_review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `guest_rating` int DEFAULT NULL,
  `listing_reviewed_at` datetime DEFAULT NULL,
  `guest_reviewed_at` datetime DEFAULT NULL,
  `application_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `contract`, `listing_review`, `listing_rating`, `guest_review`, `guest_rating`, `listing_reviewed_at`, `guest_reviewed_at`, `application_id`) VALUES
('1693de61-38ce-474b-9af1-19a9cebf804a', NULL, 'Perfect base in Paris; kitchenette is small but cleverly organized.', 4, 'Guest brought local treats and followed every house rule to the letter.', 5, '2022-05-19 15:00:00', '2022-05-19 15:10:00', '62109c20-fd5a-455f-951c-9e30dcee1f87'),
('37fd4b96-d6d0-4502-989c-9a90320dc7f8', NULL, 'Loved the sunlit workspace and the quiet courtyard view.', 4, 'Respectful guest who treated the Haussmann building like their own home.', 4, '2022-07-26 09:00:00', '2022-07-26 09:10:00', 'db4707e2-0f13-4cca-bde0-4d8afd99efae'),
('785bbd4b-80ee-43a4-a3cd-680a906dc30a', NULL, NULL, NULL, 'Host praised the guest for flexibility during minor maintenance.', 5, NULL, '2023-03-15 09:00:00', NULL),
('a7c4d1a1-1dcb-4d6f-8a7d-aaaaaaaaaaaa', NULL, 'Sunny Issy-les-Moulineaux stay with perfect transit links. Kitchen was spotless and the host responded instantly.', 5, 'Left the flat immaculate and even watered the plants. Would gladly host again.', 5, '2023-06-15 11:00:00', '2023-06-15 11:00:00', 'f1b0e510-0d6f-4f6b-9f87-111111111111'),
('a7c4d1a1-1dcb-4d6f-8a7d-bbbbbbbbbbbb', NULL, 'Large Haussmann apartment, great Wi-Fi and quiet for remote work. Pillows could be firmer but overall lovely.', 4, 'Communicative guest who respected the building rules and left a handwritten thank-you note.', 5, '2023-05-23 09:30:00', '2023-05-23 09:45:00', 'f1b0e510-0d6f-4f6b-9f87-222222222222'),
('a7c4d1a1-1dcb-4d6f-8a7d-cccccccccccc', NULL, 'Good value for an extended research stay. Kitchen was compact yet functional and the metro is 2 minutes away.', 4, 'Arrived early but coordinated politely, and kept neighbors happy. Would recommend as a future guest.', 4, '2023-04-19 12:05:00', '2023-04-19 12:10:00', 'f1b0e510-0d6f-4f6b-9f87-333333333333'),
('f03e0db3-eee5-4577-b4be-99132e58b519', NULL, 'radi jet', 1, 'Host noted the guest was courteous and communicated check-in changes promptly.', 5, '2026-01-09 23:23:58', '2022-03-25 10:00:00', 'fb88f76a-1e61-41b4-887e-ba7350b1333d'),
('fc6b63e2-13ec-40d7-9af5-074c7c047e6e', NULL, 'Host provided metro passes and a city guide—fantastic hospitality in Issy!', 5, 'Guest was punctual, tidy, and communicated clearly throughout their stay.', 5, '2022-09-18 14:30:00', '2022-09-18 14:35:00', '56ec927a-4651-456c-a07a-4b98f50c2ee7');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `application_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_message_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `application_id`, `created_at`, `last_message_at`) VALUES
('03201db4-2e66-4889-824c-3c63aa663580', '06091d6e-a8e0-4bb7-9ff3-81eddcff1f5d', '2026-01-20 08:16:04', '2026-01-20 08:16:04'),
('03dc1271-5611-4964-9f7b-e3f556811b73', '83b56635-d4ff-4cc6-a3f5-7d0ac7308149', '2026-01-11 12:37:01', '2026-01-11 12:37:01'),
('096c83b6-86cc-4863-a5a4-3f5470b480e0', '0ac0ff2a-cd21-488d-a09b-2f1b1caad9ba', '2025-12-14 21:31:19', '2025-12-14 22:31:49'),
('098e1333-8b32-418e-a05f-ebc11078512a', '8f8ca210-9bb0-40e6-a000-a1f9b5df3ddb', '2025-12-14 21:34:25', '2026-01-06 09:57:00'),
('154f07cb-04c0-4cc8-a035-8e9cd9fd7d74', '6f3ca1d3-7760-41b6-a9f4-c9173898763b', '2026-01-11 12:38:49', '2026-01-11 12:38:49'),
('1820d8f4-a899-4321-8cca-f3ec3c1bcf4b', 'deacce82-0cb0-4d29-9dd1-4acbc5b042f5', '2026-01-11 12:19:31', '2026-01-11 12:19:31'),
('1b552a4d-b7b6-4f96-9e12-2a86eda8b4e3', '60e25bda-ae54-4dea-a6f5-2a73567be3ba', '2025-12-13 20:41:36', '2025-12-14 13:12:58'),
('2dd6d054-bfc5-11f0-a648-52f5d85831eb', '2dd478f4-bfc5-11f0-a648-52f5d85831eb', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('3335ebc5-e87f-4262-b35c-a307220eb124', '65a47cb9-ecd5-4246-8a23-4ab3ac8c8f5a', '2025-12-17 15:57:24', '2026-01-10 11:26:58'),
('38dd2e23-20c9-4360-8010-e074f623cc05', '0e63eeff-4b6f-43c1-8681-f782b333a2a3', '2025-12-14 22:40:07', '2025-12-14 22:47:15'),
('3d8b77e5-8326-4883-a754-52fd6205a6ce', 'cf6e6bb1-2c9f-42fb-800d-569efe65d887', '2026-01-08 21:18:32', '2026-01-10 12:20:32'),
('445bd3ec-f634-4393-9269-7bc9cce35eeb', 'e27d0360-3701-4c68-a56e-4289290dd462', '2025-12-14 21:26:49', '2025-12-14 22:31:43'),
('55395707-fdc5-44fa-98dd-72322fc0080a', 'cc64e7a2-7455-42df-96c7-f9095bb199b1', '2026-01-11 10:22:16', '2026-01-11 10:47:58'),
('5eedcd03-0730-4b2b-b4b3-0b52b5b4a23b', '5dff6b09-d333-43c4-8ba5-f92deba53344', '2025-12-13 20:39:53', NULL),
('60edb959-4ce0-4df8-bdb0-472baac7e918', 'd5faab38-ca97-4e5c-ba19-14703bede218', '2026-01-11 12:16:11', '2026-01-11 12:16:11'),
('730f4d8b-cdcf-4922-a45b-b8384c828901', '30183f03-2a04-481c-bd52-86629adbbcbe', '2025-12-17 16:22:25', NULL),
('8208c83b-2a10-464c-8b79-8043272b7f66', '2299862b-84e9-4a4d-9bab-ddd23667d4a6', '2025-12-13 16:16:55', '2025-12-13 19:30:27'),
('841b0ee9-eee6-4d58-a229-79ac69b4b997', '1f77e629-e47d-4d82-85b7-006a3c9c8c5d', '2026-01-13 14:59:07', '2026-01-13 14:59:07'),
('85fde337-7058-400b-8648-e35a5c02307f', 'caff6f8a-1ded-4879-a32e-7cb4dd451b26', '2025-12-13 20:41:27', NULL),
('89fddc6d-ac9a-4ee6-a616-8fe348280919', '7f5977ee-b7fb-4613-8978-71b47f932a26', '2025-12-17 15:49:23', '2025-12-17 15:49:23'),
('9d0c53ee-b15b-41a2-a385-97554df5382c', '38e01f2f-705f-49af-bb69-15a88198deab', '2025-12-14 21:27:54', NULL),
('aa543075-53d7-4083-bdf3-efb61d050e04', '960ccc9b-f7c4-42b1-87df-799b5043ee03', '2025-12-17 15:25:39', NULL),
('b2e46e86-b02b-4cc3-a537-730f32186d3e', 'adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', '2026-01-20 09:10:05', '2026-01-20 09:10:05'),
('beae38c2-92f9-4c7c-9e2e-f130f78c6dbf', '8fa2969b-1b88-48eb-8745-45815e2d6458', '2026-01-11 12:29:58', '2026-01-11 12:29:58'),
('d1d142f6-efca-46df-a8ea-90c439b41ff8', 'ba86a0d1-b2e0-4815-882d-31d48e7766ef', '2026-01-20 09:14:54', '2026-01-20 09:14:54'),
('ea680481-d9b2-4358-87cf-53093bcb7ed3', '5bee208c-1679-4bf9-abe8-7e6ffac5952b', '2026-01-11 12:25:14', '2026-01-11 12:25:14'),
('ef1faf9d-9413-45dc-9f1d-003373b424c5', '8c93be1f-bf9a-4d15-b8c6-fc8a59a07999', '2025-12-14 22:36:18', '2025-12-14 22:36:25'),
('f1f2a38d-420e-44cb-8c5d-c1165e56e777', '0a1b1f80-2109-4cc1-9947-2864f78b7ed1', '2026-01-11 12:38:23', '2026-01-11 12:38:23'),
('f51699b6-cc98-4d46-a7a7-2e3e4d22d874', 'b618cb3c-ed70-47e3-9ae9-74fed37e1f92', '2025-12-13 16:17:26', '2025-12-13 19:37:27'),
('fad3e9d6-4310-4172-b29a-dfd37ca93130', 'd511a7f8-4d9e-4ab0-890e-2ecd868fa14d', '2026-01-11 12:38:36', '2026-01-11 12:38:36');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `chat_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `sender_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ok','reported') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `chat_id`, `sender_id`, `sender_profile_id`, `content`, `status`, `created_at`) VALUES
('00cf6d04-bdd6-4290-b9c0-e33dae59d46e', '38dd2e23-20c9-4360-8010-e074f623cc05', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaa', 'ok', '2025-12-14 22:40:11'),
('0677178b-64fb-4643-9d8a-ebf893ec5982', '098e1333-8b32-418e-a05f-ebc11078512a', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2026-01-06 09:57:00'),
('09dcfc6b-7179-4fbd-90f5-db5418ed42f5', '60edb959-4ce0-4df8-bdb0-472baac7e918', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'njnjjnjnnjnjnjnjnjnj', 'ok', '2026-01-11 12:16:11'),
('0bdccfcc-632e-477f-bca1-ae0ee945b5a9', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:57'),
('0fac08c0-d118-49ae-b0b6-1d6ff5af23dc', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:57'),
('1026fcab-dcfd-4445-88c2-69620d2384c2', 'd1d142f6-efca-46df-a8ea-90c439b41ff8', 127, '056e9e40-5ade-4d48-be1b-0b340dabf82d', 'ndkwndkwndkwnwkdnwkwnkndkwnd', 'ok', '2026-01-20 09:14:54'),
('13db5f7e-724c-4462-92d0-abcaa54b0c54', '38dd2e23-20c9-4360-8010-e074f623cc05', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaaaa', 'ok', '2025-12-14 22:40:07'),
('186a5daa-08a1-40b1-b4fb-24337115505d', '8208c83b-2a10-464c-8b79-8043272b7f66', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'e', 'ok', '2025-12-13 16:17:13'),
('1cc44d14-9f08-44bb-8c90-93df11724207', '55395707-fdc5-44fa-98dd-72322fc0080a', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'jbj', 'ok', '2026-01-11 10:47:54'),
('2d8b2be0-62db-4a1d-923c-6fa6cede147b', '154f07cb-04c0-4cc8-a035-8e9cd9fd7d74', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'qwdqwdwdwdw', 'ok', '2026-01-11 12:38:49'),
('2dd9031a-bfc5-11f0-a648-52f5d85831eb', '2dd6d054-bfc5-11f0-a648-52f5d85831eb', 3, '236a8940-1475-48c4-a793-2e67c005bba8', 'Hello, is this still available?', 'ok', '2025-11-12 11:43:24'),
('30ec346e-5021-4222-98aa-46ddc244d1f6', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:58'),
('3b356855-095e-42b3-92b6-b86ee989bad2', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'eje', 'ok', '2026-01-10 10:59:06'),
('3bd9023e-9835-4ca1-8f3a-eef646e3fd25', '55395707-fdc5-44fa-98dd-72322fc0080a', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'Hello, is this room is still available?', 'ok', '2026-01-11 10:47:58'),
('429b11b8-6adf-42c0-8c7d-e740576dc33f', '098e1333-8b32-418e-a05f-ebc11078512a', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-14 22:34:35'),
('46352ba5-46f1-4eaf-8958-58f22df7cb05', '8208c83b-2a10-464c-8b79-8043272b7f66', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-13 19:30:26'),
('4717ba44-75a2-4e2e-b25d-8516d5e26267', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'eje', 'ok', '2026-01-10 10:59:05'),
('4dee2b9e-5766-4e86-83f3-5e33e3cb0465', '8208c83b-2a10-464c-8b79-8043272b7f66', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-13 19:30:26'),
('4eada92d-34de-4024-99ec-78cdccd88d2d', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:56'),
('5f2c8374-5b01-447d-8bf3-b2d92526a8b0', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'ee', 'ok', '2026-01-10 11:26:56'),
('6371ab3a-32d5-4e6d-bea8-4e2560722417', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:57'),
('67a6532c-7b76-4e9d-8858-80f9930793ea', 'ea680481-d9b2-4358-87cf-53093bcb7ed3', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'jnjnjnjnjnjnj', 'ok', '2026-01-11 12:25:14'),
('689157e2-401d-432d-94e6-42fd0c64325e', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'ej', 'ok', '2026-01-10 11:32:16'),
('71544942-d980-4ab1-a713-8bc70eb70109', '096c83b6-86cc-4863-a5a4-3f5470b480e0', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-14 22:31:49'),
('71e8f18f-45de-4338-98c9-fc86703f6aee', 'f51699b6-cc98-4d46-a7a7-2e3e4d22d874', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaa', 'ok', '2025-12-13 16:17:31'),
('74dc70e5-b563-420f-9ed1-39fd1359ac21', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'ejjj', 'ok', '2026-01-10 12:20:29'),
('75a6f9e2-3592-404e-a6d8-f780a3aca67f', '1b552a4d-b7b6-4f96-9e12-2a86eda8b4e3', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'adadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsadadadadadsadsad', 'ok', '2025-12-14 13:12:58'),
('7a516ea2-6448-452c-ae86-159eef4d31a9', 'ef1faf9d-9413-45dc-9f1d-003373b424c5', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'adada', 'ok', '2025-12-14 22:36:25'),
('81b6dca2-4c0e-4695-a5de-28ce98b0e911', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:57'),
('8225621b-f735-4292-bbd0-60cd6548bd77', '841b0ee9-eee6-4d58-a229-79ac69b4b997', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'Hello, is this room still available?', 'ok', '2026-01-13 14:59:07'),
('82e733b3-89eb-43e8-a9d1-1dfeb81c5eda', '89fddc6d-ac9a-4ee6-a616-8fe348280919', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'dfghjktzui', 'ok', '2025-12-17 15:49:23'),
('83f0d53a-0fbb-445c-b59c-ca7c486839e5', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'je', 'ok', '2026-01-10 10:59:06'),
('887780b5-0311-464b-ac2e-257dc36c3f3a', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:58'),
('8a5decdd-c1a1-4a6c-b210-c7300697f676', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:56'),
('8e470300-3a54-45e7-8fbd-cb15005bd460', '1b552a4d-b7b6-4f96-9e12-2a86eda8b4e3', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'e', 'ok', '2025-12-13 20:41:39'),
('93ae3489-501c-41dd-9d15-d3adbe52ca37', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'hej', 'ok', '2026-01-08 21:18:34'),
('97843bd6-6aa1-4795-9fa6-0b82caef6407', '1820d8f4-a899-4321-8cca-f3ec3c1bcf4b', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'asd sa dsadmsa dmsa', 'ok', '2026-01-11 12:19:31'),
('9b49e2d9-a9fa-4ac3-8cee-48eb1fccbb01', '096c83b6-86cc-4863-a5a4-3f5470b480e0', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'asdfdsads', 'ok', '2025-12-14 21:31:19'),
('9d13a46a-200a-4fd7-9c19-81273c6d5cda', '098e1333-8b32-418e-a05f-ebc11078512a', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaaaaa', 'ok', '2025-12-14 21:34:25'),
('a0c337a8-3e40-4536-818e-96e8721d6216', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:58'),
('a29b42e6-8701-43eb-b5a7-4b1ade7fa03d', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:57'),
('a3945846-2a50-48d5-a999-eb5c8fabe069', 'f1f2a38d-420e-44cb-8c5d-c1165e56e777', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'qsqsqsq', 'ok', '2026-01-11 12:38:23'),
('a4a0e70c-a769-41a6-a364-b637c9102ef3', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'ej', 'ok', '2026-01-10 10:59:05'),
('a616223a-1eef-4fff-b4a6-beb4aeedfbc8', '9d0c53ee-b15b-41a2-a385-97554df5382c', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'eee top', NULL, '2025-12-14 21:27:54'),
('a6550da7-8e61-4e49-a3d6-85ca147ab1c9', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'jesi perv', 'ok', '2026-01-10 12:06:38'),
('ab6e6fd4-667f-4429-8051-67279cb735a6', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'ej', 'ok', '2026-01-10 10:59:04'),
('b5d03da3-ec7e-4cdf-b2a1-ec5b82f890c3', '03201db4-2e66-4889-824c-3c63aa663580', 127, '056e9e40-5ade-4d48-be1b-0b340dabf82d', 'nbnbbnbnbnb', 'ok', '2026-01-20 08:16:04'),
('b8325771-62b8-4669-ab66-0d8acfa0431a', '8208c83b-2a10-464c-8b79-8043272b7f66', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'ey', 'ok', '2025-12-13 16:17:00'),
('bbe00757-6836-4c24-9870-84ab99b424b2', 'f51699b6-cc98-4d46-a7a7-2e3e4d22d874', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'e', 'ok', '2025-12-13 19:37:25'),
('bc4c98d7-fc6d-430e-8e75-b88e1aa03f36', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'eje', 'ok', '2026-01-10 10:59:06'),
('c4673c7e-e239-4576-9d10-cf2a41424d3f', '098e1333-8b32-418e-a05f-ebc11078512a', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'e', 'ok', '2025-12-14 22:47:17'),
('c51ac47c-a1ed-45be-b642-5e4ab8389124', '3335ebc5-e87f-4262-b35c-a307220eb124', 123, '09b5e3c3-2f67-4450-8240-fac09d522536', 'dfgtzbzbuh. uhbzbuh', 'ok', '2025-12-17 15:57:24'),
('c53851d7-736f-42e6-aff7-1f0c669ce20a', '445bd3ec-f634-4393-9269-7bc9cce35eeb', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-14 22:31:43'),
('cd9d60cc-647a-4145-8e11-b9e7186d37cd', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:56'),
('cfd0625e-b0c1-485b-9e93-bf08866faffc', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:58'),
('cfe04c79-c6f8-422a-b167-c35a1e466937', '3335ebc5-e87f-4262-b35c-a307220eb124', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'e', 'ok', '2026-01-10 11:26:57'),
('d1481a0d-78e7-4f77-a801-786f525e7efa', 'f51699b6-cc98-4d46-a7a7-2e3e4d22d874', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'asadas', 'ok', '2025-12-13 19:37:27'),
('d48dfd2a-cac4-46a9-b951-7ce0772bc7dc', 'b2e46e86-b02b-4cc3-a537-730f32186d3e', 127, '056e9e40-5ade-4d48-be1b-0b340dabf82d', 'Hey is this available', 'ok', '2026-01-20 09:10:05'),
('d7037566-69f9-429e-9c34-08e08c3c701f', 'f51699b6-cc98-4d46-a7a7-2e3e4d22d874', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'e', 'ok', '2025-12-13 19:37:25'),
('d907d1fc-f39a-49e1-b82e-53f8aaa93d67', '38dd2e23-20c9-4360-8010-e074f623cc05', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'e', 'ok', '2025-12-14 22:47:15'),
('da5344b7-87a0-4087-b97d-60467b83153d', 'fad3e9d6-4310-4172-b29a-dfd37ca93130', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'n n n n n', 'ok', '2026-01-11 12:38:36'),
('dad96f88-73cb-435e-a1fb-e29af7f56970', '03dc1271-5611-4964-9f7b-e3f556811b73', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'wdwd', 'ok', '2026-01-11 12:37:01'),
('de6db023-6739-4d20-b2a8-7aebbdadffc4', 'ef1faf9d-9413-45dc-9f1d-003373b424c5', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'asdadsadasd', 'ok', '2025-12-14 22:36:18'),
('deeef4f3-ff36-47de-a55d-50415ee88fff', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'jejeje', 'ok', '2026-01-10 10:59:07'),
('eb5e3501-d734-40b1-b3de-66ee565ec32b', 'beae38c2-92f9-4c7c-9e2e-f130f78c6dbf', 124, '425d7131-0854-4437-853c-59f2cee9cafb', 'v vv', 'ok', '2026-01-11 12:29:58'),
('ec06455a-435f-4c7f-a891-e3c33e154eee', '3d8b77e5-8326-4883-a754-52fd6205a6ce', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'top', 'ok', '2026-01-10 12:20:32'),
('fb6bbf80-db92-43b9-90ca-272081c1cc38', '445bd3ec-f634-4393-9269-7bc9cce35eeb', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'ajsdajkdjka adjasdj adkj askjd akdk a', NULL, '2025-12-14 21:26:49'),
('fee4b7bc-c0f8-45e4-a17b-f86975405af6', '8208c83b-2a10-464c-8b79-8043272b7f66', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-13 19:30:27'),
('ffc0f212-02ba-4ba4-8e6f-cbb4f92a210f', '445bd3ec-f634-4393-9269-7bc9cce35eeb', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', 'a', 'ok', '2025-12-14 22:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `id` smallint UNSIGNED NOT NULL,
  `document_type_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`id`, `document_type_name`) VALUES
(1, 'PASSPORT'),
(2, 'STUDENT ID CARD'),
(3, 'DEED'),
(4, 'TITLE'),
(5, 'LEASE');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `profile_id`, `listing_id`, `created_at`) VALUES
('1eb82b20-265c-49d4-ba29-c330bd6bcecf', '357e760a-d08c-4078-be80-b6d8c819f56a', '942722bb-028d-49fe-8799-a2671dd05761', '2026-01-06 09:07:30'),
('4162dd95-f38e-41fa-838e-cdc4a50687a6', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-06 09:12:03'),
('4883d1f1-7a6d-4af0-b44b-f63a8e67f6f5', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-08 21:33:22'),
('5318581e-4007-4dd9-b187-5d7bbe16ebcc', '056e9e40-5ade-4d48-be1b-0b340dabf82d', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', '2026-01-19 15:18:58'),
('70f4c55f-aaeb-489c-a775-675e351e4a2e', '056e9e40-5ade-4d48-be1b-0b340dabf82d', '942722bb-028d-49fe-8799-a2671dd05761', '2026-01-19 15:18:57'),
('7d9c8b71-f165-49b7-a6f1-8948dcb280dd', '056e9e40-5ade-4d48-be1b-0b340dabf82d', '5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-19 16:03:08'),
('8368af48-0b68-4c4a-8097-ee89117bdbfd', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-06 09:42:02'),
('938cd3b5-f028-47ac-8bb9-285694cb773d', '056e9e40-5ade-4d48-be1b-0b340dabf82d', '2f0fd0de-79b6-43ea-9148-39ae45ce176d', '2026-01-20 09:29:05'),
('a45171d9-b9d1-4ec6-9493-84b15e014df9', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-10 23:17:50'),
('a928cd30-27c3-49a7-bc3e-ae6c21a97138', '3284455a-e9db-4e02-8f41-c6995838d53f', '942722bb-028d-49fe-8799-a2671dd05761', '2026-01-08 22:19:22'),
('b8667650-9d14-4b77-820a-0a1fdff6bcf3', '056e9e40-5ade-4d48-be1b-0b340dabf82d', '5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-19 15:18:59'),
('d0527c9c-9c3d-4ded-8c0f-6fa6d2c18b53', '357e760a-d08c-4078-be80-b6d8c819f56a', '2dcca07a-bfc5-11f0-a648-52f5d85831eb', '2026-01-19 15:07:41'),
('d38b2a91-0a42-4381-93a0-a71b6bfac432', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-06 09:12:02'),
('e20fe18c-26de-45f0-9bc7-864a41d697ab', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-10 23:17:53'),
('eb4b5ba0-8244-4cc0-aaf6-98c53b3db6d5', '357e760a-d08c-4078-be80-b6d8c819f56a', '5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-06 09:42:03'),
('eddd6dc4-a471-43af-8bb1-ef6e2bcd3b95', '3284455a-e9db-4e02-8f41-c6995838d53f', '5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', '2026-01-08 22:21:01'),
('fcccd58c-75e2-4d33-970f-49e985dbd286', '357e760a-d08c-4078-be80-b6d8c819f56a', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', '2026-01-08 21:29:56'),
('fef31355-33d4-45e8-af8a-ae94851e25f5', '3284455a-e9db-4e02-8f41-c6995838d53f', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', '2026-01-08 22:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `legal_content`
--

CREATE TABLE `legal_content` (
  `id` int NOT NULL,
  `type` enum('terms','privacy','cookies','disclaimer','faq','cookie_policy') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `legal_content`
--

INSERT INTO `legal_content` (`id`, `type`, `title`, `content`, `updated_at`) VALUES
(1, 'terms', 'Terms of Service', 'Terms of Service\r\n\r\nWelcome to NestChange. These Terms of Service govern your use of our website and services.\r\n\r\n1. Acceptance of Terms\r\nBy accessing our services, you agree to be bound by these terms.', '2026-01-08 20:41:23'),
(2, 'privacy', 'Privacy Policy', 'Privacy Policy\r\n\r\nYour privacy is important to us. This policy explains how we collect and use your data.\r\n\r\n1. Information Collection\r\nWe collect information you provide directly to us.', '2026-01-08 20:41:23'),
(3, 'cookie_policy', 'Cookie Policy', 'Cookie Policy\r\n\r\nWe use cookies to improve your experience.\r\n\r\n1. What are cookies?\r\nCookies are small text files stored on your device.\r\ntesttest', '2026-01-08 22:31:06');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `host_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `room_type` enum('room','whole_apartment') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_guests` int DEFAULT NULL,
  `host_role` enum('owner','renter') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','pending-approval','published','paused','archived') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `cancellation_policy` enum('flexible','moderate','strict') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'moderate',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `host_profile_id`, `title`, `description`, `country`, `city`, `address_line`, `latitude`, `longitude`, `room_type`, `max_guests`, `host_role`, `status`, `cancellation_policy`, `created_at`, `updated_at`) VALUES
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 'be0267ae-304e-40a7-949a-50bbec15936e', 'STUDIO NEAR CAMPUS', 'A BRIGHT SUNNY STUDIO APARTMENT PERFECT FOR A STUDENT. 10 MINUTES WALK FROM THE MAIN CAMPUS.', 'FRANCE', 'PARIS', '123 ISSY', 48.8566, 2.3522, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 'b429f253-cee8-45ce-81b7-e5acf8f4eebb', 'SHARED APARTMENT', 'A ROOM IN A 2 BEDROOM SHARED APARTMENT. CLOSE TO TRANSPORTATION', 'FRANCE', 'CALAIS', '456 RUE DE BAC', 50.9513, 1.8587, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 'be0267ae-304e-40a7-949a-50bbec15936e', 'DRAFT LISTING', 'THIS IS NOT FINISHED', 'GERMANY', 'BERLIN', NULL, NULL, NULL, 'whole_apartment', 4, 'owner', 'draft', 'moderate', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('2f0fd0de-79b6-43ea-9148-39ae45ce176d', 'cc20f470-d0fa-4e78-a1bb-d28df5a4f5a4', 'Negotiaition', 'AMskmsakmdakdmksamdksamdksa', 'BB', 'Poaris', 'Palaala', NULL, NULL, 'room', 1, 'renter', 'published', 'flexible', '2026-01-20 09:08:35', '2026-01-20 09:09:48'),
('331d2b70-bfd0-11f0-a648-52f5d85831eb', '9463d8c6-fbf8-48d3-aa49-7edf12b531f8', 'ADMIN ADMINSON • Student Stay', 'Comfortable room hosted by ADMIN ADMINSON in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '101 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d44fc-bfd0-11f0-a648-52f5d85831eb', 'be0267ae-304e-40a7-949a-50bbec15936e', 'ALEKSANDRE TEST • Student Stay', 'Comfortable room hosted by ALEKSANDRE TEST in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '102 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d460a-bfd0-11f0-a648-52f5d85831eb', '236a8940-1475-48c4-a793-2e67c005bba8', 'SURESH TESTER • Student Stay', 'Comfortable apartment hosted by SURESH TESTER in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '103 GRAND PLACE', 50.8647, 4.3689, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d46a0-bfd0-11f0-a648-52f5d85831eb', 'b429f253-cee8-45ce-81b7-e5acf8f4eebb', 'ARIF TUPLE • Student Stay', 'Comfortable room hosted by ARIF TUPLE in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '104 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 1, 'owner', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d47cc-bfd0-11f0-a648-52f5d85831eb', '32bba3a2-6ecb-4411-9e9d-a56238de5cf4', 'TONY MURRAY • Student Stay', 'Comfortable room hosted by Tony Murray in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '105 RUE DES ECOLES', 48.8745, 2.3815, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4862-bfd0-11f0-a648-52f5d85831eb', '49b62029-c9fe-48c0-b81a-760f45372054', 'NICOLE BARNES • Student Stay', 'Comfortable room hosted by Nicole Barnes in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '107 KEIZERSGRACHT', 52.37, 4.9, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d48e4-bfd0-11f0-a648-52f5d85831eb', 'f4343da9-11c0-40f9-9fe7-ad6efd1f492d', 'PENELOPE FARRELL • Student Stay', 'Comfortable room hosted by Penelope Farrell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '108 GRAND PLACE', 50.8549, 4.3563, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4966-bfd0-11f0-a648-52f5d85831eb', 'e2b4427d-b619-4fea-972d-68996aed4df7', 'FREDERICK WILSON • Student Stay', 'Comfortable apartment hosted by Frederick Wilson in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '109 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'whole_apartment', 2, 'renter', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d49f2-bfd0-11f0-a648-52f5d85831eb', '20125d2e-2aa5-4d46-85d8-d0b7e295f270', 'GEORGE HOLMES • Student Stay', 'Comfortable room hosted by George Holmes in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '110 RUE DES ECOLES', 48.8647, 2.3689, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4a6a-bfd0-11f0-a648-52f5d85831eb', '63eca209-eb5c-4d42-b650-3d7526273b1a', 'LEONARDO CLARK • Student Stay', 'Comfortable room hosted by Leonardo Clark in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '111 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4aec-bfd0-11f0-a648-52f5d85831eb', 'a42443d3-70fe-47e7-a10b-49c3c7272e96', 'ARTHUR HALL • Student Stay', 'Comfortable apartment hosted by Arthur Hall in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '112 KEIZERSGRACHT', 52.3945, 4.9315, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4b6e-bfd0-11f0-a648-52f5d85831eb', 'cc59fea3-0f51-4734-8912-497ad38c2df1', 'AMY HIGGINS • Student Stay', 'Comfortable room hosted by Amy Higgins in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '113 GRAND PLACE', 50.8794, 4.3878, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4c18-bfd0-11f0-a648-52f5d85831eb', '179593fe-5eea-4740-bd77-549fc4a015ed', 'HENRY MURRAY • Student Stay', 'Comfortable room hosted by Henry Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '114 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4c9a-bfd0-11f0-a648-52f5d85831eb', 'bea6d221-5cb6-462f-b14d-66e36a056dbd', 'VICTORIA MORRIS • Student Stay', 'Comfortable apartment hosted by Victoria Morris in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '115 RUE DES ECOLES', 48.8549, 2.3563, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4d12-bfd0-11f0-a648-52f5d85831eb', '607876cd-dd91-4689-abf2-0a67dbba2915', 'SOPHIA HOLMES • Student Stay', 'Comfortable room hosted by Sophia Holmes in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '116 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 1, 'owner', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4d8a-bfd0-11f0-a648-52f5d85831eb', '6a1e0fb7-4c5f-46c5-877a-9e000a32f358', 'PATRICK CASEY • Student Stay', 'Comfortable room hosted by Patrick Casey in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '117 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4e0c-bfd0-11f0-a648-52f5d85831eb', 'c6b62737-c60d-4a17-98d4-2af851a9279c', 'ADISON BARNES • Student Stay', 'Comfortable apartment hosted by Adison Barnes in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '118 GRAND PLACE', 50.8696, 4.3752, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4e84-bfd0-11f0-a648-52f5d85831eb', 'd5ef263d-8c25-4432-984e-9e6cf79836e6', 'VIOLET OWENS • Student Stay', 'Comfortable room hosted by Violet Owens in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '119 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4efc-bfd0-11f0-a648-52f5d85831eb', '3cd1f40c-dc0f-4955-b473-2d84ab89b73f', 'MIRANDA MYERS • Student Stay', 'Comfortable room hosted by Miranda Myers in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '120 RUE DES ECOLES', 48.8794, 2.3878, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4ff6-bfd0-11f0-a648-52f5d85831eb', '91484a59-2820-4572-94a4-60329b5c898f', 'JUSTIN MORRISON • Student Stay', 'Comfortable apartment hosted by Justin Morrison in BERLIN. Host account status: REJECTED.', 'GERMANY', 'BERLIN', '121 ALEXANDERPLATZ', 52.52, 13.405, 'whole_apartment', 2, 'renter', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5078-bfd0-11f0-a648-52f5d85831eb', '6c4807cc-f0e1-4aef-aff0-075c7c09b1dd', 'STEVEN CRAIG • Student Stay', 'Comfortable room hosted by Steven Craig in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '122 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d50f0-bfd0-11f0-a648-52f5d85831eb', '9c876b21-4e7f-4eb0-8f0c-ac2ca8c0bf34', 'HONEY EDWARDS • Student Stay', 'Comfortable room hosted by Honey Edwards in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '123 GRAND PLACE', 50.8598, 4.3626, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5172-bfd0-11f0-a648-52f5d85831eb', 'a26a1ad6-fabb-491d-91b8-bf42e94ebfd1', 'ALFRED DOUGLAS • Student Stay', 'Comfortable apartment hosted by Alfred Douglas in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '124 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5258-bfd0-11f0-a648-52f5d85831eb', '4741084c-90c6-4b0f-a6d5-811f13495825', 'DAINTON TUCKER • Student Stay', 'Comfortable room hosted by Dainton Tucker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '125 RUE DES ECOLES', 48.8696, 2.3752, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d52da-bfd0-11f0-a648-52f5d85831eb', 'b622405e-4ed5-4256-91de-8f3942e778ee', 'PENELOPE THOMAS • Student Stay', 'Comfortable room hosted by Penelope Thomas in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '126 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5352-bfd0-11f0-a648-52f5d85831eb', 'b2ae7561-d56f-498a-9d69-cf194dde8a35', 'MIKE MOORE • Student Stay', 'Comfortable apartment hosted by Mike Moore in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '127 KEIZERSGRACHT', 52.3994, 4.9378, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d53ca-bfd0-11f0-a648-52f5d85831eb', '0b23e575-89c4-46d0-bb77-91d3d7700365', 'ROMAN WRIGHT • Student Stay', 'Comfortable room hosted by Roman Wright in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '128 GRAND PLACE', 50.85, 4.35, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5442-bfd0-11f0-a648-52f5d85831eb', 'c8633364-e226-4946-ae0c-2c33b7e4681e', 'CATHERINE LLOYD • Student Stay', 'Comfortable room hosted by Catherine Lloyd in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '129 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 2, 'renter', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d54d8-bfd0-11f0-a648-52f5d85831eb', '76f9b842-0692-40fb-9893-b336803841ec', 'NICOLE PARKER • Student Stay', 'Comfortable apartment hosted by Nicole Parker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '130 RUE DES ECOLES', 48.8598, 2.3626, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d555a-bfd0-11f0-a648-52f5d85831eb', '79927f79-10ca-488a-a34b-34608e3111f9', 'APRIL CLARK • Student Stay', 'Comfortable room hosted by April Clark in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '131 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 4, 'renter', 'paused', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d55dc-bfd0-11f0-a648-52f5d85831eb', 'cdd6f3ec-bb8e-4b29-9741-cd360a352181', 'SPIKE FARRELL • Student Stay', 'Comfortable room hosted by Spike Farrell in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '132 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d565e-bfd0-11f0-a648-52f5d85831eb', '9419f24d-9875-4a88-a059-616d5261c67e', 'ALEN FOSTER • Student Stay', 'Comfortable apartment hosted by Alen Foster in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '133 GRAND PLACE', 50.8745, 4.3815, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d56d6-bfd0-11f0-a648-52f5d85831eb', '627fe270-d240-4f20-a860-7fba390f562c', 'ELISE RICHARDSON • Student Stay', 'Comfortable room hosted by Elise Richardson in BARCELONA. Host account status: SUSPENDED.', 'SPAIN', 'BARCELONA', '134 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 3, 'owner', 'paused', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5758-bfd0-11f0-a648-52f5d85831eb', '8f4fe2e2-e42b-4bae-9953-6f72a9e6b1ea', 'STUART ANDERSON • Student Stay', 'Comfortable room hosted by Stuart Anderson in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '135 RUE DES ECOLES', 48.85, 2.35, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d57d0-bfd0-11f0-a648-52f5d85831eb', '37384438-14ac-4066-9bbe-d15934c64acf', 'ABRAHAM COLE • Student Stay', 'Comfortable apartment hosted by Abraham Cole in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '136 ALEXANDERPLATZ', 52.5249, 13.4113, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5848-bfd0-11f0-a648-52f5d85831eb', '34b2bb02-8adc-446c-b219-466627542292', 'MIRANDA PERRY • Student Stay', 'Comfortable room hosted by Miranda Perry in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '137 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d58c0-bfd0-11f0-a648-52f5d85831eb', '6aaa8d59-1799-4cf4-bbe7-9922f536bff5', 'RAFAEL CLARK • Student Stay', 'Comfortable room hosted by Rafael Clark in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '138 GRAND PLACE', 50.8647, 4.3689, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5942-bfd0-11f0-a648-52f5d85831eb', 'a198dd45-7df8-45a3-87c9-9dccdb500f26', 'ALFRED MASON • Student Stay', 'Comfortable apartment hosted by Alfred Mason in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '139 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d59ba-bfd0-11f0-a648-52f5d85831eb', 'f5aa2129-f01c-45d5-9709-84c6e66c7bdf', 'ADRIAN BROWN • Student Stay', 'Comfortable room hosted by Adrian Brown in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '140 RUE DES ECOLES', 48.8745, 2.3815, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5a82-bfd0-11f0-a648-52f5d85831eb', 'fd430601-9895-4cc7-90c1-67733be8a5a6', 'STELLA ROSS • Student Stay', 'Comfortable room hosted by Stella Ross in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '141 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 2, 'renter', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5b04-bfd0-11f0-a648-52f5d85831eb', '2a6621b7-a0d2-403b-ac83-3c8f3944bfbf', 'ADAM GRAY • Student Stay', 'Comfortable apartment hosted by Adam Gray in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '142 KEIZERSGRACHT', 52.37, 4.9, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5b86-bfd0-11f0-a648-52f5d85831eb', 'f25392bf-47c6-4039-91de-4462a2d5edfb', 'NICHOLAS SCOTT • Student Stay', 'Comfortable room hosted by Nicholas Scott in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '143 GRAND PLACE', 50.8549, 4.3563, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5bfe-bfd0-11f0-a648-52f5d85831eb', '13783aeb-eab3-4feb-8cc4-63088c54af33', 'MARCUS ROBERTS • Student Stay', 'Comfortable room hosted by Marcus Roberts in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '144 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5c80-bfd0-11f0-a648-52f5d85831eb', 'e8d526f8-1274-4aca-afc6-bb9ecff78fda', 'STEVEN CRAWFORD • Student Stay', 'Comfortable apartment hosted by Steven Crawford in PARIS. Host account status: PENDING.', 'FRANCE', 'PARIS', '145 RUE DES ECOLES', 48.8647, 2.3689, 'whole_apartment', 2, 'renter', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5cf8-bfd0-11f0-a648-52f5d85831eb', 'e0af6061-f210-491b-9205-b20b07520095', 'DEXTER MARTIN • Student Stay', 'Comfortable room hosted by Dexter Martin in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '146 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5d7a-bfd0-11f0-a648-52f5d85831eb', 'bf3f11b4-e104-4c29-a73a-b8139a7afc75', 'RUBIE MORRISON • Student Stay', 'Comfortable room hosted by Rubie Morrison in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '147 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5df2-bfd0-11f0-a648-52f5d85831eb', 'dbf85fbd-7a28-4574-bfa7-6517fd3f64b6', 'JORDAN ANDREWS • Student Stay', 'Comfortable apartment hosted by Jordan Andrews in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '148 GRAND PLACE', 50.8794, 4.3878, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5e74-bfd0-11f0-a648-52f5d85831eb', '42c9a0c7-be34-4375-a6ae-5006be89ea8f', 'JACOB MORGAN • Student Stay', 'Comfortable room hosted by Jacob Morgan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '149 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5eec-bfd0-11f0-a648-52f5d85831eb', '8490dc56-8e97-4278-b84a-aac06a4595eb', 'DEANNA FOWLER • Student Stay', 'Comfortable room hosted by Deanna Fowler in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '150 RUE DES ECOLES', 48.8549, 2.3563, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5f64-bfd0-11f0-a648-52f5d85831eb', 'ffd2e4dd-d3d5-4681-bd6b-bf9f0d44ce15', 'ADRIANNA TUCKER • Student Stay', 'Comfortable apartment hosted by Adrianna Tucker in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '151 ALEXANDERPLATZ', 52.5298, 13.4176, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5fdc-bfd0-11f0-a648-52f5d85831eb', 'eaa50618-cb38-42a3-9ed4-f5f04a6e8c01', 'STELLA BAILEY • Student Stay', 'Comfortable room hosted by Stella Bailey in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '152 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d605e-bfd0-11f0-a648-52f5d85831eb', '9d6ad805-dabc-487c-b6d4-095f3e7faccb', 'ELLIA MARTIN • Student Stay', 'Comfortable room hosted by Ellia Martin in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '153 GRAND PLACE', 50.8696, 4.3752, 'room', 2, 'renter', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d60e0-bfd0-11f0-a648-52f5d85831eb', 'cfb67e61-3de6-470f-b758-72862fa0cda2', 'RYAN BAILEY • Student Stay', 'Comfortable apartment hosted by Ryan Bailey in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '154 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'whole_apartment', 3, 'owner', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6158-bfd0-11f0-a648-52f5d85831eb', 'fb594dc6-c736-423d-ad0f-63ff7fefa338', 'KRISTIAN TAYLOR • Student Stay', 'Comfortable room hosted by Kristian Taylor in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '155 RUE DES ECOLES', 48.8794, 2.3878, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d61d0-bfd0-11f0-a648-52f5d85831eb', 'ee8aa2d6-8f66-456d-a4c4-4285f5b6c3ed', 'MAYA ROBERTS • Student Stay', 'Comfortable room hosted by Maya Roberts in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '156 ALEXANDERPLATZ', 52.52, 13.405, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6252-bfd0-11f0-a648-52f5d85831eb', '7f782e61-5f5c-408b-ac05-9ed5c58698d6', 'ALEXIA HARPER • Student Stay', 'Comfortable apartment hosted by Alexia Harper in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '157 KEIZERSGRACHT', 52.3749, 4.9063, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d62ca-bfd0-11f0-a648-52f5d85831eb', 'ec345aad-8c4c-464c-8267-d9ffe8da8990', 'DALE MILLER • Student Stay', 'Comfortable room hosted by Dale Miller in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '158 GRAND PLACE', 50.8598, 4.3626, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d634c-bfd0-11f0-a648-52f5d85831eb', 'a210715b-ab0c-49ab-b37f-54787f7bc76a', 'LUCY MONTGOMERY • Student Stay', 'Comfortable room hosted by Lucy Montgomery in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '159 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d63ce-bfd0-11f0-a648-52f5d85831eb', '40d6c7e2-37cb-437a-90c9-fbb4b2fb1661', 'EDWARD MOORE • Student Stay', 'Comfortable apartment hosted by Edward Moore in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '160 RUE DES ECOLES', 48.8696, 2.3752, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6a0e-bfd0-11f0-a648-52f5d85831eb', '7b92d17d-f6ea-4b34-bdab-c184fc69cc31', 'KEVIN SPENCER • Student Stay', 'Comfortable room hosted by Kevin Spencer in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '161 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6b62-bfd0-11f0-a648-52f5d85831eb', 'dbd65d6b-925f-4c27-a7da-792494ca25c4', 'VANESSA FERGUSON • Student Stay', 'Comfortable room hosted by Vanessa Ferguson in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '162 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6be4-bfd0-11f0-a648-52f5d85831eb', '71d3fbd3-5b31-42e1-bb87-bbc53459ac48', 'CARLOS RICHARDSON • Student Stay', 'Comfortable apartment hosted by Carlos Richardson in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '163 GRAND PLACE', 50.85, 4.35, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6c66-bfd0-11f0-a648-52f5d85831eb', 'a1f7c2d2-ebbe-4bfa-8def-96b0aba7e543', 'ALISSA MURRAY • Student Stay', 'Comfortable room hosted by Alissa Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '164 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6cde-bfd0-11f0-a648-52f5d85831eb', '6b1954e8-0dbf-4c68-b762-4d91e30a6cb9', 'ADRIAN WELLS • Student Stay', 'Comfortable room hosted by Adrian Wells in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '165 RUE DES ECOLES', 48.8598, 2.3626, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6d6a-bfd0-11f0-a648-52f5d85831eb', '4437f3e7-cfb9-4df0-8704-357504968741', 'KELSEY CRAIG • Student Stay', 'Comfortable apartment hosted by Kelsey Craig in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '166 ALEXANDERPLATZ', 52.5347, 13.4239, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6de2-bfd0-11f0-a648-52f5d85831eb', 'ac6323d9-893a-4c0a-a733-fb8354a1b623', 'AMBER MONTGOMERY • Student Stay', 'Comfortable room hosted by Amber Montgomery in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '167 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6e64-bfd0-11f0-a648-52f5d85831eb', '407b7b25-d201-4e49-8084-52f0a9ab633a', 'RYAN CUNNINGHAM • Student Stay', 'Comfortable room hosted by Ryan Cunningham in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '168 GRAND PLACE', 50.8745, 4.3815, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6edc-bfd0-11f0-a648-52f5d85831eb', '2ec08256-3c19-4a57-854b-b835880a963e', 'LUCY CHAPMAN • Student Stay', 'Comfortable apartment hosted by Lucy Chapman in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '169 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6f5e-bfd0-11f0-a648-52f5d85831eb', '4454ecc1-cc49-419d-9c3c-75c9257b23ec', 'DAISY RUSSELL • Student Stay', 'Comfortable room hosted by Daisy Russell in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '170 RUE DES ECOLES', 48.85, 2.35, 'room', 3, 'owner', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7062-bfd0-11f0-a648-52f5d85831eb', '9cde0988-2517-4e85-bf51-e808beb2ee22', 'KELLAN EDWARDS • Student Stay', 'Comfortable room hosted by Kellan Edwards in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '171 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 4, 'renter', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d715c-bfd0-11f0-a648-52f5d85831eb', '6813fc4c-9e78-4bf8-a533-ddbef4846429', 'MILEY WARREN • Student Stay', 'Comfortable apartment hosted by Miley Warren in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '172 KEIZERSGRACHT', 52.3798, 4.9126, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d722e-bfd0-11f0-a648-52f5d85831eb', '7f2db7f8-dabd-45c2-93ff-8f86796dc552', 'SYDNEY MITCHELL • Student Stay', 'Comfortable room hosted by Sydney Mitchell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '173 GRAND PLACE', 50.8647, 4.3689, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d72f6-bfd0-11f0-a648-52f5d85831eb', '280988fa-8f35-48a1-b8f8-16d0c7cf2777', 'PENELOPE RUSSELL • Student Stay', 'Comfortable room hosted by Penelope Russell in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '174 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 3, 'owner', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7346-bfd0-11f0-a648-52f5d85831eb', 'e01d9e90-261e-4a75-95f9-31a3acd70758', 'TYLER BENNETT • Student Stay', 'Comfortable apartment hosted by Tyler Bennett in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '175 RUE DES ECOLES', 48.8745, 2.3815, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d73a0-bfd0-11f0-a648-52f5d85831eb', 'd57dc4f3-cb55-4016-890c-1d42fb397c5f', 'ADELE REED • Student Stay', 'Comfortable room hosted by Adele Reed in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '176 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 1, 'owner', 'paused', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d73f0-bfd0-11f0-a648-52f5d85831eb', 'a703687c-fc58-4449-a400-0d0ae477ad52', 'ERIC JOHNSTON • Student Stay', 'Comfortable room hosted by Eric Johnston in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '177 KEIZERSGRACHT', 52.37, 4.9, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7440-bfd0-11f0-a648-52f5d85831eb', '2027817b-9eb4-48d3-961a-808631ffc52c', 'DEANNA PHILLIPS • Student Stay', 'Comfortable apartment hosted by Deanna Phillips in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '178 GRAND PLACE', 50.8549, 4.3563, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d749a-bfd0-11f0-a648-52f5d85831eb', '3fb74c36-eb37-4d36-8bf7-38118ba0e12a', 'RYAN ROSS • Student Stay', 'Comfortable room hosted by Ryan Ross in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '179 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d74ea-bfd0-11f0-a648-52f5d85831eb', '9ed79eb6-91f0-4279-aa08-34cc7dd4528c', 'DAISY BAKER • Student Stay', 'Comfortable room hosted by Daisy Baker in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '180 RUE DES ECOLES', 48.8647, 2.3689, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7544-bfd0-11f0-a648-52f5d85831eb', '687dad09-5a5b-475a-922c-21f90f99c50b', 'REID TURNER • Student Stay', 'Comfortable apartment hosted by Reid Turner in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '181 ALEXANDERPLATZ', 52.5396, 13.4302, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7594-bfd0-11f0-a648-52f5d85831eb', '7b331d60-6522-4a40-acec-940bbee81c89', 'AMELIA PARKER • Student Stay', 'Comfortable room hosted by Amelia Parker in AMSTERDAM. Host account status: PENDING.', 'NETHERLANDS', 'AMSTERDAM', '182 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 3, 'owner', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d75e4-bfd0-11f0-a648-52f5d85831eb', '6a8d2833-4280-4d20-9a24-8255123e8cda', 'MILLER FOWLER • Student Stay', 'Comfortable room hosted by Miller Fowler in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '183 GRAND PLACE', 50.8794, 4.3878, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d763e-bfd0-11f0-a648-52f5d85831eb', 'd44b4cdf-91b1-4d13-93db-0aff09c3b3e2', 'MARTIN RYAN • Student Stay', 'Comfortable apartment hosted by Martin Ryan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '184 AVINGUDA DIAGONAL', 41.39, 2.16, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d774c-bfd0-11f0-a648-52f5d85831eb', 'bdf11e6d-f0df-4c19-940d-67347d395911', 'ADELAIDE CLARK • Student Stay', 'Comfortable room hosted by Adelaide Clark in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '185 RUE DES ECOLES', 48.8549, 2.3563, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d779c-bfd0-11f0-a648-52f5d85831eb', '9a9ba8e0-2ad6-4840-8755-2515765385f0', 'GARRY MYERS • Student Stay', 'Comfortable room hosted by Garry Myers in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '186 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d77f6-bfd0-11f0-a648-52f5d85831eb', '9cec3df4-b8c5-48e5-8b31-a6f15edd152e', 'RAFAEL TUCKER • Student Stay', 'Comfortable apartment hosted by Rafael Tucker in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '187 KEIZERSGRACHT', 52.3847, 4.9189, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7846-bfd0-11f0-a648-52f5d85831eb', '45117b65-3d55-4b61-8feb-5ed7f4c654a9', 'ALDUS CASEY • Student Stay', 'Comfortable room hosted by Aldus Casey in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '188 GRAND PLACE', 50.8696, 4.3752, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7896-bfd0-11f0-a648-52f5d85831eb', 'a8803f2c-cec4-49ce-ac84-aa37a14ce458', 'JARED MORRISON • Student Stay', 'Comfortable room hosted by Jared Morrison in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '189 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7fa8-bfd0-11f0-a648-52f5d85831eb', 'c2bc6777-4f25-4e2b-bf67-86726508a709', 'GARRY JONES • Student Stay', 'Comfortable apartment hosted by Garry Jones in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '190 RUE DES ECOLES', 48.8794, 2.3878, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8002-bfd0-11f0-a648-52f5d85831eb', '36ece217-9ef1-4f6d-9e05-27dfc17e2b15', 'NICHOLAS ALEXANDER • Student Stay', 'Comfortable room hosted by Nicholas Alexander in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '191 ALEXANDERPLATZ', 52.52, 13.405, 'room', 4, 'renter', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d805c-bfd0-11f0-a648-52f5d85831eb', 'eecde76a-9fd1-4299-a898-f54fe6c2af80', 'ABIGAIL SPENCER • Student Stay', 'Comfortable room hosted by Abigail Spencer in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '192 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d80b6-bfd0-11f0-a648-52f5d85831eb', '6701656c-5a89-4d41-9353-66880f3257f0', 'LYNDON GRAY • Student Stay', 'Comfortable apartment hosted by Lyndon Gray in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '193 GRAND PLACE', 50.8598, 4.3626, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8110-bfd0-11f0-a648-52f5d85831eb', 'a6f27d29-4a13-453c-a281-2e387a736868', 'ELISE MURPHY • Student Stay', 'Comfortable room hosted by Elise Murphy in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '194 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8160-bfd0-11f0-a648-52f5d85831eb', '7f9b83fe-3ee9-4a1a-977d-f772697511f3', 'AGATA RYAN • Student Stay', 'Comfortable room hosted by Agata Ryan in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '195 RUE DES ECOLES', 48.8696, 2.3752, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d81b0-bfd0-11f0-a648-52f5d85831eb', '9f189f5a-a1f7-484c-b50f-718f2bf89061', 'EMILY JONES • Student Stay', 'Comfortable apartment hosted by Emily Jones in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '196 ALEXANDERPLATZ', 52.5445, 13.4365, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d820a-bfd0-11f0-a648-52f5d85831eb', 'a45b64c2-81d7-4887-afdb-17d88a69c8af', 'JORDAN HAMILTON • Student Stay', 'Comfortable room hosted by Jordan Hamilton in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '197 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d825a-bfd0-11f0-a648-52f5d85831eb', 'eb0a7e62-b629-4510-a91b-38ff24b640ac', 'MAXIMILIAN JOHNSON • Student Stay', 'Comfortable room hosted by Maximilian Johnson in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '198 GRAND PLACE', 50.85, 4.35, 'room', 3, 'owner', 'draft', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d82b4-bfd0-11f0-a648-52f5d85831eb', '83290a01-a6c3-4e36-802e-dec89b0a8c43', 'VIOLET WALKER • Student Stay', 'Comfortable apartment hosted by Violet Walker in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '199 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8304-bfd0-11f0-a648-52f5d85831eb', '82f55787-20ca-4552-9549-9f9fd4f24243', 'DARCY PHILLIPS • Student Stay', 'Comfortable room hosted by Darcy Phillips in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '200 RUE DES ECOLES', 48.8598, 2.3626, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8390-bfd0-11f0-a648-52f5d85831eb', 'ddb8147f-6323-4be0-b6a3-67e0b16f2a46', 'ALEXANDER MITCHELL • Student Stay', 'Comfortable room hosted by Alexander Mitchell in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '201 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d83ea-bfd0-11f0-a648-52f5d85831eb', 'cef8637f-5422-4089-9b2f-fb869408720f', 'MICHELLE HAWKINS • Student Stay', 'Comfortable apartment hosted by Michelle Hawkins in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '202 KEIZERSGRACHT', 52.3896, 4.9252, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8444-bfd0-11f0-a648-52f5d85831eb', '832794de-0511-4d24-9aa1-1d20d6c9ff78', 'MICHAEL MYERS • Student Stay', 'Comfortable room hosted by Michael Myers in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '203 GRAND PLACE', 50.8745, 4.3815, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d849e-bfd0-11f0-a648-52f5d85831eb', '2f760c60-0317-4585-995c-e6f8a7d35530', 'TED FOWLER • Student Stay', 'Comfortable room hosted by Ted Fowler in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '204 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d84ee-bfd0-11f0-a648-52f5d85831eb', '83710363-2633-4264-8987-5600e20c1254', 'ALINA CRAIG • Student Stay', 'Comfortable apartment hosted by Alina Craig in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '205 RUE DES ECOLES', 48.85, 2.35, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', '9463d8c6-fbf8-48d3-aa49-7edf12b531f8', 'ADMIN ADMINSON • Student Stay', 'Comfortable room hosted by ADMIN ADMINSON in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '101 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 'be0267ae-304e-40a7-949a-50bbec15936e', 'ALEKSANDRE TEST • Student Stay', 'Comfortable room hosted by ALEKSANDRE TEST in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '102 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', '236a8940-1475-48c4-a793-2e67c005bba8', 'SURESH TESTER • Student Stay', 'Comfortable apartment hosted by SURESH TESTER in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '103 GRAND PLACE', 50.8647, 4.3689, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 'b429f253-cee8-45ce-81b7-e5acf8f4eebb', 'ARIF TUPLE • Student Stay', 'Comfortable room hosted by ARIF TUPLE in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '104 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-12-17 15:53:14'),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', '32bba3a2-6ecb-4411-9e9d-a56238de5cf4', 'TONY MURRAY • Student Stay', 'Comfortable room hosted by Tony Murray in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '105 RUE DES ECOLES', 48.8745, 2.3815, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', '49b62029-c9fe-48c0-b81a-760f45372054', 'NICOLE BARNES • Student Stay', 'Comfortable room hosted by Nicole Barnes in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '107 KEIZERSGRACHT', 52.37, 4.9, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 'f4343da9-11c0-40f9-9fe7-ad6efd1f492d', 'PENELOPE FARRELL • Student Stay', 'Comfortable room hosted by Penelope Farrell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '108 GRAND PLACE', 50.8549, 4.3563, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 'e2b4427d-b619-4fea-972d-68996aed4df7', 'FREDERICK WILSON • Student Stay', 'Comfortable apartment hosted by Frederick Wilson in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '109 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'whole_apartment', 2, 'renter', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', '20125d2e-2aa5-4d46-85d8-d0b7e295f270', 'GEORGE HOLMES • Student Stay', 'Comfortable room hosted by George Holmes in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '110 RUE DES ECOLES', 48.8647, 2.3689, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', '63eca209-eb5c-4d42-b650-3d7526273b1a', 'LEONARDO CLARK • Student Stay', 'Comfortable room hosted by Leonardo Clark in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '111 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 'a42443d3-70fe-47e7-a10b-49c3c7272e96', 'ARTHUR HALL • Student Stay', 'Comfortable apartment hosted by Arthur Hall in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '112 KEIZERSGRACHT', 52.3945, 4.9315, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 'cc59fea3-0f51-4734-8912-497ad38c2df1', 'AMY HIGGINS • Student Stay', 'Comfortable room hosted by Amy Higgins in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '113 GRAND PLACE', 50.8794, 4.3878, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', '179593fe-5eea-4740-bd77-549fc4a015ed', 'HENRY MURRAY • Student Stay', 'Comfortable room hosted by Henry Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '114 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 'bea6d221-5cb6-462f-b14d-66e36a056dbd', 'VICTORIA MORRIS • Student Stay', 'Comfortable apartment hosted by Victoria Morris in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '115 RUE DES ECOLES', 48.8549, 2.3563, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', '607876cd-dd91-4689-abf2-0a67dbba2915', 'SOPHIA HOLMES • Student Stay', 'Comfortable room hosted by Sophia Holmes in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '116 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 1, 'owner', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', '6a1e0fb7-4c5f-46c5-877a-9e000a32f358', 'PATRICK CASEY • Student Stay', 'Comfortable room hosted by Patrick Casey in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '117 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 'c6b62737-c60d-4a17-98d4-2af851a9279c', 'ADISON BARNES • Student Stay', 'Comfortable apartment hosted by Adison Barnes in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '118 GRAND PLACE', 50.8696, 4.3752, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 'd5ef263d-8c25-4432-984e-9e6cf79836e6', 'VIOLET OWENS • Student Stay', 'Comfortable room hosted by Violet Owens in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '119 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', '3cd1f40c-dc0f-4955-b473-2d84ab89b73f', 'MIRANDA MYERS • Student Stay', 'Comfortable room hosted by Miranda Myers in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '120 RUE DES ECOLES', 48.8794, 2.3878, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', '91484a59-2820-4572-94a4-60329b5c898f', 'JUSTIN MORRISON • Student Stay', 'Comfortable apartment hosted by Justin Morrison in BERLIN. Host account status: REJECTED.', 'GERMANY', 'BERLIN', '121 ALEXANDERPLATZ', 52.52, 13.405, 'whole_apartment', 2, 'renter', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', '6c4807cc-f0e1-4aef-aff0-075c7c09b1dd', 'STEVEN CRAIG • Student Stay', 'Comfortable room hosted by Steven Craig in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '122 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', '9c876b21-4e7f-4eb0-8f0c-ac2ca8c0bf34', 'HONEY EDWARDS • Student Stay', 'Comfortable room hosted by Honey Edwards in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '123 GRAND PLACE', 50.8598, 4.3626, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 'a26a1ad6-fabb-491d-91b8-bf42e94ebfd1', 'ALFRED DOUGLAS • Student Stay', 'Comfortable apartment hosted by Alfred Douglas in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '124 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', '4741084c-90c6-4b0f-a6d5-811f13495825', 'DAINTON TUCKER • Student Stay', 'Comfortable room hosted by Dainton Tucker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '125 RUE DES ECOLES', 48.8696, 2.3752, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 'b622405e-4ed5-4256-91de-8f3942e778ee', 'PENELOPE THOMAS • Student Stay', 'Comfortable room hosted by Penelope Thomas in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '126 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 'b2ae7561-d56f-498a-9d69-cf194dde8a35', 'MIKE MOORE • Student Stay', 'Comfortable apartment hosted by Mike Moore in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '127 KEIZERSGRACHT', 52.3994, 4.9378, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', '0b23e575-89c4-46d0-bb77-91d3d7700365', 'ROMAN WRIGHT • Student Stay', 'Comfortable room hosted by Roman Wright in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '128 GRAND PLACE', 50.85, 4.35, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 'c8633364-e226-4946-ae0c-2c33b7e4681e', 'CATHERINE LLOYD • Student Stay', 'Comfortable room hosted by Catherine Lloyd in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '129 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 2, 'renter', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', '76f9b842-0692-40fb-9893-b336803841ec', 'NICOLE PARKER • Student Stay', 'Comfortable apartment hosted by Nicole Parker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '130 RUE DES ECOLES', 48.8598, 2.3626, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', '79927f79-10ca-488a-a34b-34608e3111f9', 'APRIL CLARK • Student Stay', 'Comfortable room hosted by April Clark in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '131 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 4, 'renter', 'paused', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 'cdd6f3ec-bb8e-4b29-9741-cd360a352181', 'SPIKE FARRELL • Student Stay', 'Comfortable room hosted by Spike Farrell in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '132 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', '9419f24d-9875-4a88-a059-616d5261c67e', 'ALEN FOSTER • Student Stay', 'Comfortable apartment hosted by Alen Foster in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '133 GRAND PLACE', 50.8745, 4.3815, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46');
INSERT INTO `listing` (`id`, `host_profile_id`, `title`, `description`, `country`, `city`, `address_line`, `latitude`, `longitude`, `room_type`, `max_guests`, `host_role`, `status`, `cancellation_policy`, `created_at`, `updated_at`) VALUES
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', '627fe270-d240-4f20-a860-7fba390f562c', 'ELISE RICHARDSON • Student Stay', 'Comfortable room hosted by Elise Richardson in BARCELONA. Host account status: SUSPENDED.', 'SPAIN', 'BARCELONA', '134 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 3, 'owner', 'paused', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', '8f4fe2e2-e42b-4bae-9953-6f72a9e6b1ea', 'STUART ANDERSON • Student Stay', 'Comfortable room hosted by Stuart Anderson in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '135 RUE DES ECOLES', 48.85, 2.35, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', '37384438-14ac-4066-9bbe-d15934c64acf', 'ABRAHAM COLE • Student Stay', 'Comfortable apartment hosted by Abraham Cole in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '136 ALEXANDERPLATZ', 52.5249, 13.4113, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', '34b2bb02-8adc-446c-b219-466627542292', 'MIRANDA PERRY • Student Stay', 'Comfortable room hosted by Miranda Perry in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '137 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', '6aaa8d59-1799-4cf4-bbe7-9922f536bff5', 'RAFAEL CLARK • Student Stay', 'Comfortable room hosted by Rafael Clark in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '138 GRAND PLACE', 50.8647, 4.3689, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 'a198dd45-7df8-45a3-87c9-9dccdb500f26', 'ALFRED MASON • Student Stay', 'Comfortable apartment hosted by Alfred Mason in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '139 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 'f5aa2129-f01c-45d5-9709-84c6e66c7bdf', 'ADRIAN BROWN • Student Stay', 'Comfortable room hosted by Adrian Brown in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '140 RUE DES ECOLES', 48.8745, 2.3815, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 'fd430601-9895-4cc7-90c1-67733be8a5a6', 'STELLA ROSS • Student Stay', 'Comfortable room hosted by Stella Ross in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '141 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 2, 'renter', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', '2a6621b7-a0d2-403b-ac83-3c8f3944bfbf', 'ADAM GRAY • Student Stay', 'Comfortable apartment hosted by Adam Gray in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '142 KEIZERSGRACHT', 52.37, 4.9, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 'f25392bf-47c6-4039-91de-4462a2d5edfb', 'NICHOLAS SCOTT • Student Stay', 'Comfortable room hosted by Nicholas Scott in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '143 GRAND PLACE', 50.8549, 4.3563, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', '13783aeb-eab3-4feb-8cc4-63088c54af33', 'MARCUS ROBERTS • Student Stay', 'Comfortable room hosted by Marcus Roberts in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '144 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 'e8d526f8-1274-4aca-afc6-bb9ecff78fda', 'STEVEN CRAWFORD • Student Stay', 'Comfortable apartment hosted by Steven Crawford in PARIS. Host account status: PENDING.', 'FRANCE', 'PARIS', '145 RUE DES ECOLES', 48.8647, 2.3689, 'whole_apartment', 2, 'renter', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 'e0af6061-f210-491b-9205-b20b07520095', 'DEXTER MARTIN • Student Stay', 'Comfortable room hosted by Dexter Martin in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '146 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 'bf3f11b4-e104-4c29-a73a-b8139a7afc75', 'RUBIE MORRISON • Student Stay', 'Comfortable room hosted by Rubie Morrison in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '147 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 'dbf85fbd-7a28-4574-bfa7-6517fd3f64b6', 'JORDAN ANDREWS • Student Stay', 'Comfortable apartment hosted by Jordan Andrews in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '148 GRAND PLACE', 50.8794, 4.3878, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', '42c9a0c7-be34-4375-a6ae-5006be89ea8f', 'JACOB MORGAN • Student Stay', 'Comfortable room hosted by Jacob Morgan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '149 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', '8490dc56-8e97-4278-b84a-aac06a4595eb', 'DEANNA FOWLER • Student Stay', 'Comfortable room hosted by Deanna Fowler in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '150 RUE DES ECOLES', 48.8549, 2.3563, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 'ffd2e4dd-d3d5-4681-bd6b-bf9f0d44ce15', 'ADRIANNA TUCKER • Student Stay', 'Comfortable apartment hosted by Adrianna Tucker in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '151 ALEXANDERPLATZ', 52.5298, 13.4176, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 'eaa50618-cb38-42a3-9ed4-f5f04a6e8c01', 'STELLA BAILEY • Student Stay', 'Comfortable room hosted by Stella Bailey in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '152 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', '9d6ad805-dabc-487c-b6d4-095f3e7faccb', 'ELLIA MARTIN • Student Stay', 'Comfortable room hosted by Ellia Martin in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '153 GRAND PLACE', 50.8696, 4.3752, 'room', 2, 'renter', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 'cfb67e61-3de6-470f-b758-72862fa0cda2', 'RYAN BAILEY • Student Stay', 'Comfortable apartment hosted by Ryan Bailey in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '154 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'whole_apartment', 3, 'owner', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 'fb594dc6-c736-423d-ad0f-63ff7fefa338', 'KRISTIAN TAYLOR • Student Stay', 'Comfortable room hosted by Kristian Taylor in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '155 RUE DES ECOLES', 48.8794, 2.3878, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 'ee8aa2d6-8f66-456d-a4c4-4285f5b6c3ed', 'MAYA ROBERTS • Student Stay', 'Comfortable room hosted by Maya Roberts in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '156 ALEXANDERPLATZ', 52.52, 13.405, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', '7f782e61-5f5c-408b-ac05-9ed5c58698d6', 'ALEXIA HARPER • Student Stay', 'Comfortable apartment hosted by Alexia Harper in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '157 KEIZERSGRACHT', 52.3749, 4.9063, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 'ec345aad-8c4c-464c-8267-d9ffe8da8990', 'DALE MILLER • Student Stay', 'Comfortable room hosted by Dale Miller in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '158 GRAND PLACE', 50.8598, 4.3626, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 'a210715b-ab0c-49ab-b37f-54787f7bc76a', 'LUCY MONTGOMERY • Student Stay', 'Comfortable room hosted by Lucy Montgomery in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '159 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', '40d6c7e2-37cb-437a-90c9-fbb4b2fb1661', 'EDWARD MOORE • Student Stay', 'Comfortable apartment hosted by Edward Moore in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '160 RUE DES ECOLES', 48.8696, 2.3752, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', '7b92d17d-f6ea-4b34-bdab-c184fc69cc31', 'KEVIN SPENCER • Student Stay', 'Comfortable room hosted by Kevin Spencer in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '161 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 'dbd65d6b-925f-4c27-a7da-792494ca25c4', 'VANESSA FERGUSON • Student Stay', 'Comfortable room hosted by Vanessa Ferguson in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '162 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', '71d3fbd3-5b31-42e1-bb87-bbc53459ac48', 'CARLOS RICHARDSON • Student Stay', 'Comfortable apartment hosted by Carlos Richardson in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '163 GRAND PLACE', 50.85, 4.35, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 'a1f7c2d2-ebbe-4bfa-8def-96b0aba7e543', 'ALISSA MURRAY • Student Stay', 'Comfortable room hosted by Alissa Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '164 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', '6b1954e8-0dbf-4c68-b762-4d91e30a6cb9', 'ADRIAN WELLS • Student Stay', 'Comfortable room hosted by Adrian Wells in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '165 RUE DES ECOLES', 48.8598, 2.3626, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', '4437f3e7-cfb9-4df0-8704-357504968741', 'KELSEY CRAIG • Student Stay', 'Comfortable apartment hosted by Kelsey Craig in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '166 ALEXANDERPLATZ', 52.5347, 13.4239, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 'ac6323d9-893a-4c0a-a733-fb8354a1b623', 'AMBER MONTGOMERY • Student Stay', 'Comfortable room hosted by Amber Montgomery in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '167 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', '407b7b25-d201-4e49-8084-52f0a9ab633a', 'RYAN CUNNINGHAM • Student Stay', 'Comfortable room hosted by Ryan Cunningham in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '168 GRAND PLACE', 50.8745, 4.3815, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', '2ec08256-3c19-4a57-854b-b835880a963e', 'LUCY CHAPMAN • Student Stay', 'Comfortable apartment hosted by Lucy Chapman in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '169 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', '4454ecc1-cc49-419d-9c3c-75c9257b23ec', 'DAISY RUSSELL • Student Stay', 'Comfortable room hosted by Daisy Russell in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '170 RUE DES ECOLES', 48.85, 2.35, 'room', 3, 'owner', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', '9cde0988-2517-4e85-bf51-e808beb2ee22', 'KELLAN EDWARDS • Student Stay', 'Comfortable room hosted by Kellan Edwards in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '171 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 4, 'renter', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', '6813fc4c-9e78-4bf8-a533-ddbef4846429', 'MILEY WARREN • Student Stay', 'Comfortable apartment hosted by Miley Warren in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '172 KEIZERSGRACHT', 52.3798, 4.9126, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', '7f2db7f8-dabd-45c2-93ff-8f86796dc552', 'SYDNEY MITCHELL • Student Stay', 'Comfortable room hosted by Sydney Mitchell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '173 GRAND PLACE', 50.8647, 4.3689, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', '280988fa-8f35-48a1-b8f8-16d0c7cf2777', 'PENELOPE RUSSELL • Student Stay', 'Comfortable room hosted by Penelope Russell in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '174 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 3, 'owner', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 'e01d9e90-261e-4a75-95f9-31a3acd70758', 'TYLER BENNETT • Student Stay', 'Comfortable apartment hosted by Tyler Bennett in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '175 RUE DES ECOLES', 48.8745, 2.3815, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 'd57dc4f3-cb55-4016-890c-1d42fb397c5f', 'ADELE REED • Student Stay', 'Comfortable room hosted by Adele Reed in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '176 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 1, 'owner', 'paused', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 'a703687c-fc58-4449-a400-0d0ae477ad52', 'ERIC JOHNSTON • Student Stay', 'Comfortable room hosted by Eric Johnston in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '177 KEIZERSGRACHT', 52.37, 4.9, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', '2027817b-9eb4-48d3-961a-808631ffc52c', 'DEANNA PHILLIPS • Student Stay', 'Comfortable apartment hosted by Deanna Phillips in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '178 GRAND PLACE', 50.8549, 4.3563, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', '3fb74c36-eb37-4d36-8bf7-38118ba0e12a', 'RYAN ROSS • Student Stay', 'Comfortable room hosted by Ryan Ross in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '179 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', '9ed79eb6-91f0-4279-aa08-34cc7dd4528c', 'DAISY BAKER • Student Stay', 'Comfortable room hosted by Daisy Baker in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '180 RUE DES ECOLES', 48.8647, 2.3689, 'room', 1, 'owner', 'archived', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', '687dad09-5a5b-475a-922c-21f90f99c50b', 'REID TURNER • Student Stay', 'Comfortable apartment hosted by Reid Turner in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '181 ALEXANDERPLATZ', 52.5396, 13.4302, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', '7b331d60-6522-4a40-acec-940bbee81c89', 'AMELIA PARKER • Student Stay', 'Comfortable room hosted by Amelia Parker in AMSTERDAM. Host account status: PENDING.', 'NETHERLANDS', 'AMSTERDAM', '182 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 3, 'owner', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', '6a8d2833-4280-4d20-9a24-8255123e8cda', 'MILLER FOWLER • Student Stay', 'Comfortable room hosted by Miller Fowler in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '183 GRAND PLACE', 50.8794, 4.3878, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 'd44b4cdf-91b1-4d13-93db-0aff09c3b3e2', 'MARTIN RYAN • Student Stay', 'Comfortable apartment hosted by Martin Ryan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '184 AVINGUDA DIAGONAL', 41.39, 2.16, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 'bdf11e6d-f0df-4c19-940d-67347d395911', 'ADELAIDE CLARK • Student Stay', 'Comfortable room hosted by Adelaide Clark in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '185 RUE DES ECOLES', 48.8549, 2.3563, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', '9a9ba8e0-2ad6-4840-8755-2515765385f0', 'GARRY MYERS • Student Stay', 'Comfortable room hosted by Garry Myers in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '186 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', '9cec3df4-b8c5-48e5-8b31-a6f15edd152e', 'RAFAEL TUCKER • Student Stay', 'Comfortable apartment hosted by Rafael Tucker in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '187 KEIZERSGRACHT', 52.3847, 4.9189, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', '45117b65-3d55-4b61-8feb-5ed7f4c654a9', 'ALDUS CASEY • Student Stay', 'Comfortable room hosted by Aldus Casey in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '188 GRAND PLACE', 50.8696, 4.3752, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 'a8803f2c-cec4-49ce-ac84-aa37a14ce458', 'JARED MORRISON • Student Stay', 'Comfortable room hosted by Jared Morrison in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '189 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 'c2bc6777-4f25-4e2b-bf67-86726508a709', 'GARRY JONES • Student Stay', 'Comfortable apartment hosted by Garry Jones in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '190 RUE DES ECOLES', 48.8794, 2.3878, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', '36ece217-9ef1-4f6d-9e05-27dfc17e2b15', 'NICHOLAS ALEXANDER • Student Stay', 'Comfortable room hosted by Nicholas Alexander in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '191 ALEXANDERPLATZ', 52.52, 13.405, 'room', 4, 'renter', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 'eecde76a-9fd1-4299-a898-f54fe6c2af80', 'ABIGAIL SPENCER • Student Stay', 'Comfortable room hosted by Abigail Spencer in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '192 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', '6701656c-5a89-4d41-9353-66880f3257f0', 'LYNDON GRAY • Student Stay', 'Comfortable apartment hosted by Lyndon Gray in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '193 GRAND PLACE', 50.8598, 4.3626, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 'a6f27d29-4a13-453c-a281-2e387a736868', 'ELISE MURPHY • Student Stay', 'Comfortable room hosted by Elise Murphy in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '194 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', '7f9b83fe-3ee9-4a1a-977d-f772697511f3', 'AGATA RYAN • Student Stay', 'Comfortable room hosted by Agata Ryan in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '195 RUE DES ECOLES', 48.8696, 2.3752, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', '9f189f5a-a1f7-484c-b50f-718f2bf89061', 'EMILY JONES • Student Stay', 'Comfortable apartment hosted by Emily Jones in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '196 ALEXANDERPLATZ', 52.5445, 13.4365, 'whole_apartment', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 'a45b64c2-81d7-4887-afdb-17d88a69c8af', 'JORDAN HAMILTON • Student Stay', 'Comfortable room hosted by Jordan Hamilton in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '197 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 'eb0a7e62-b629-4510-a91b-38ff24b640ac', 'MAXIMILIAN JOHNSON • Student Stay', 'Comfortable room hosted by Maximilian Johnson in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '198 GRAND PLACE', 50.85, 4.35, 'room', 3, 'owner', 'draft', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', '83290a01-a6c3-4e36-802e-dec89b0a8c43', 'VIOLET WALKER • Student Stay', 'Comfortable apartment hosted by Violet Walker in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '199 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'whole_apartment', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', '82f55787-20ca-4552-9549-9f9fd4f24243', 'DARCY PHILLIPS • Student Stay', 'Comfortable room hosted by Darcy Phillips in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '200 RUE DES ECOLES', 48.8598, 2.3626, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 'ddb8147f-6323-4be0-b6a3-67e0b16f2a46', 'ALEXANDER MITCHELL • Student Stay', 'Comfortable room hosted by Alexander Mitchell in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '201 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 'cef8637f-5422-4089-9b2f-fb869408720f', 'MICHELLE HAWKINS • Student Stay', 'Comfortable apartment hosted by Michelle Hawkins in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '202 KEIZERSGRACHT', 52.3896, 4.9252, 'whole_apartment', 3, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', '832794de-0511-4d24-9aa1-1d20d6c9ff78', 'MICHAEL MYERS • Student Stay', 'Comfortable room hosted by Michael Myers in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '203 GRAND PLACE', 50.8745, 4.3815, 'room', 4, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', '2f760c60-0317-4585-995c-e6f8a7d35530', 'TED FOWLER • Student Stay', 'Comfortable room hosted by Ted Fowler in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '204 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 1, 'owner', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', '83710363-2633-4264-8987-5600e20c1254', 'ALINA CRAIG • Student Stay', 'Comfortable apartment hosted by Alina Craig in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '205 RUE DES ECOLES', 48.85, 2.35, 'whole_apartment', 2, 'renter', 'published', 'moderate', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('942722bb-028d-49fe-8799-a2671dd05761', '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'Demo 2', 'demo demo demo demo demo', 'Paris', 'Issy-les-Moulinoux', '10 Rue de Vanves', NULL, NULL, 'whole_apartment', 4, 'renter', 'paused', 'flexible', '2025-12-17 12:48:58', '2026-01-19 20:55:18'),
('b11f4a2c-c053-47de-80b2-5cace81c78e8', '425d7131-0854-4437-853c-59f2cee9cafb', 'Teste', 'knknkknknknknknknk jbjbjb', 'TR', 'Ankara', 'Ankara', NULL, NULL, 'room', 1, 'renter', 'draft', 'flexible', '2026-01-11 11:30:20', '2026-01-11 12:17:52'),
('c3a8e969-00f7-4f30-b019-25491a931870', '357e760a-d08c-4078-be80-b6d8c819f56a', 'daj vise brt', 'daj vise brtdaj vise brtdaj vise brt', 'FR', 'Paris', '23 Rue Labrouste', 48.8348135, 2.3089142, 'whole_apartment', 5, 'renter', 'draft', 'moderate', '2026-01-06 10:00:42', '2026-01-06 10:00:42'),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', '55e0f49d-5bad-4822-abec-00e5eb51c1c8', 'Demo listing', 'Demo demo demo demo demo demo demo', 'France', 'Paris', '28 Rue Notre Dame des Champs', NULL, NULL, 'whole_apartment', 6, 'owner', 'paused', 'moderate', '2025-12-17 10:47:48', '2026-01-19 20:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `listing_application`
--

CREATE TABLE `listing_application` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `applicant_id` bigint UNSIGNED NOT NULL,
  `applicant_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('pending','accepted','rejected','withdrawn','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_applicant_id` bigint GENERATED ALWAYS AS ((case when (`status` in (_utf8mb4'pending',_utf8mb4'accepted')) then `applicant_id` else NULL end)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_application`
--

INSERT INTO `listing_application` (`id`, `listing_id`, `applicant_id`, `applicant_profile_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
('06091d6e-a8e0-4bb7-9ff3-81eddcff1f5d', '5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 127, '056e9e40-5ade-4d48-be1b-0b340dabf82d', '2026-01-28', '2026-01-30', 'pending', '2026-01-20 08:16:04', '2026-01-20 08:16:04'),
('0a1b1f80-2109-4cc1-9947-2864f78b7ed1', '5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-11', '2026-01-11', 'withdrawn', '2026-01-11 12:38:23', '2026-01-11 12:41:34'),
('0ac0ff2a-cd21-488d-a09b-2f1b1caad9ba', '5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', '2025-12-14', '2025-12-27', 'pending', '2025-12-14 21:31:19', '2025-12-14 22:31:19'),
('0e63eeff-4b6f-43c1-8681-f782b333a2a3', '5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', '2025-12-21', '2025-12-30', 'pending', '2025-12-14 22:40:07', '2025-12-14 22:40:07'),
('1f77e629-e47d-4d82-85b7-006a3c9c8c5d', '5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-13', '2026-01-28', 'pending', '2026-01-13 14:59:07', '2026-01-13 14:59:07'),
('2299862b-84e9-4a4d-9bab-ddd23667d4a6', '5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', NULL, NULL, 'pending', '2025-12-13 16:16:55', '2025-12-13 16:16:55'),
('2dd478f4-bfc5-11f0-a648-52f5d85831eb', '2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 3, '236a8940-1475-48c4-a793-2e67c005bba8', '2025-09-01', '2026-06-30', 'withdrawn', '2025-11-12 11:43:24', '2025-11-12 12:00:41'),
('30183f03-2a04-481c-bd52-86629adbbcbe', '5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 119, '8b6e6fe5-0ff8-4fe7-b0ee-1371ec349bbb', NULL, NULL, 'pending', '2025-12-17 16:22:25', '2025-12-17 16:22:25'),
('38e01f2f-705f-49af-bb69-15a88198deab', '5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', '2025-12-21', '2025-12-29', 'pending', '2025-12-14 21:27:54', '2025-12-14 22:27:54'),
('56ec927a-4651-456c-a07a-4b98f50c2ee7', '942722bb-028d-49fe-8799-a2671dd05761', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', '2022-09-03', '2022-09-17', 'accepted', '2022-08-10 06:45:00', '2022-09-18 10:00:00'),
('5bee208c-1679-4bf9-abe8-7e6ffac5952b', '942722bb-028d-49fe-8799-a2671dd05761', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-25', '2026-01-31', 'cancelled', '2026-01-11 12:25:14', '2026-01-11 12:29:34'),
('5dff6b09-d333-43c4-8ba5-f92deba53344', '5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', NULL, NULL, 'pending', '2025-12-13 20:39:53', '2025-12-13 20:39:53'),
('60e25bda-ae54-4dea-a6f5-2a73567be3ba', '5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', NULL, NULL, 'pending', '2025-12-13 20:41:36', '2025-12-13 20:41:36'),
('62109c20-fd5a-455f-951c-9e30dcee1f87', '5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', '2022-05-05', '2022-05-18', 'accepted', '2022-04-01 07:40:00', '2022-05-19 12:20:00'),
('65a47cb9-ecd5-4246-8a23-4ab3ac8c8f5a', '942722bb-028d-49fe-8799-a2671dd05761', 123, '09b5e3c3-2f67-4450-8240-fac09d522536', '2025-12-22', '2025-12-31', 'accepted', '2025-12-17 15:57:24', '2025-12-17 15:58:50'),
('6f3ca1d3-7760-41b6-a9f4-c9173898763b', '5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-11', '2026-01-26', 'accepted', '2026-01-11 12:38:49', '2026-01-11 12:39:04'),
('7f5977ee-b7fb-4613-8978-71b47f932a26', '5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', '2025-12-23', '2025-12-31', 'pending', '2025-12-17 15:49:23', '2025-12-17 15:49:23'),
('83b56635-d4ff-4cc6-a3f5-7d0ac7308149', '942722bb-028d-49fe-8799-a2671dd05761', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-11', '2026-01-11', 'rejected', '2026-01-11 12:37:01', '2026-01-11 12:38:05'),
('8c93be1f-bf9a-4d15-b8c6-fc8a59a07999', '5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', '2025-12-21', '2025-12-28', 'pending', '2025-12-14 22:36:18', '2025-12-14 22:36:18'),
('8f8ca210-9bb0-40e6-a000-a1f9b5df3ddb', '5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', '2025-12-21', '2025-12-28', 'pending', '2025-12-14 21:34:25', '2025-12-14 22:34:25'),
('8fa2969b-1b88-48eb-8745-45815e2d6458', '942722bb-028d-49fe-8799-a2671dd05761', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-11', '2026-01-11', 'rejected', '2026-01-11 12:29:58', '2026-01-11 12:36:31'),
('960ccc9b-f7c4-42b1-87df-799b5043ee03', '5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', NULL, NULL, 'pending', '2025-12-17 15:25:39', '2025-12-17 15:25:39'),
('adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', '2f0fd0de-79b6-43ea-9148-39ae45ce176d', 127, '056e9e40-5ade-4d48-be1b-0b340dabf82d', '2026-01-20', '2026-01-22', 'accepted', '2026-01-20 09:10:05', '2026-01-20 09:57:46'),
('b618cb3c-ed70-47e3-9ae9-74fed37e1f92', '5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', NULL, NULL, 'pending', '2025-12-13 16:17:26', '2025-12-13 16:17:26'),
('ba86a0d1-b2e0-4815-882d-31d48e7766ef', '5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 127, '056e9e40-5ade-4d48-be1b-0b340dabf82d', '2026-01-22', '2026-01-31', 'pending', '2026-01-20 09:14:54', '2026-01-20 09:14:54'),
('caff6f8a-1ded-4879-a32e-7cb4dd451b26', '5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', NULL, NULL, 'pending', '2025-12-13 20:41:27', '2025-12-13 20:41:27'),
('cc64e7a2-7455-42df-96c7-f9095bb199b1', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 124, '425d7131-0854-4437-853c-59f2cee9cafb', NULL, NULL, 'withdrawn', '2026-01-11 10:22:16', '2026-01-11 12:37:56'),
('cf6e6bb1-2c9f-42fb-800d-569efe65d887', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', NULL, NULL, 'pending', '2026-01-08 21:18:32', '2026-01-08 21:18:32'),
('d511a7f8-4d9e-4ab0-890e-2ecd868fa14d', '5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-12', '2026-01-27', 'withdrawn', '2026-01-11 12:38:36', '2026-01-11 12:41:34'),
('d5faab38-ca97-4e5c-ba19-14703bede218', '942722bb-028d-49fe-8799-a2671dd05761', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-28', '2026-01-31', 'withdrawn', '2026-01-11 12:16:11', '2026-01-11 12:16:19'),
('db4707e2-0f13-4cca-bde0-4d8afd99efae', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 120, 'b1208357-c1d3-4529-a803-bbc06cf08035', '2022-07-12', '2022-07-25', 'accepted', '2022-06-15 08:10:00', '2022-07-26 11:30:00'),
('deacce82-0cb0-4d29-9dd1-4acbc5b042f5', '5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 124, '425d7131-0854-4437-853c-59f2cee9cafb', '2026-01-29', '2026-01-31', 'cancelled', '2026-01-11 12:19:31', '2026-01-11 12:23:01'),
('e27d0360-3701-4c68-a56e-4289290dd462', '5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 113, '357e760a-d08c-4078-be80-b6d8c819f56a', '2025-12-23', '2025-12-27', 'pending', '2025-12-14 21:26:49', '2025-12-14 22:26:49'),
('f1b0e510-0d6f-4f6b-9f87-111111111111', '942722bb-028d-49fe-8799-a2671dd05761', 120, 'b1208357-c1d3-4529-a803-bbc06cf08035', '2023-06-01', '2023-06-14', 'accepted', '2023-05-01 07:00:00', '2023-06-15 07:00:00'),
('f1b0e510-0d6f-4f6b-9f87-222222222222', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 122, '00e66855-47ad-41d2-8cf7-7347c1496c81', '2023-05-10', '2023-05-22', 'accepted', '2023-04-20 09:30:00', '2023-05-23 06:00:00'),
('f1b0e510-0d6f-4f6b-9f87-333333333333', '5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 123, '09b5e3c3-2f67-4450-8240-fac09d522536', '2023-04-05', '2023-04-18', 'accepted', '2023-03-10 14:45:00', '2023-04-19 08:15:00'),
('fb88f76a-1e61-41b4-887e-ba7350b1333d', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 118, '55e0f49d-5bad-4822-abec-00e5eb51c1c8', '2022-03-10', '2022-03-24', 'accepted', '2022-02-15 07:00:00', '2022-03-25 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `listing_attribute`
--

CREATE TABLE `listing_attribute` (
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `attribute_id` smallint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_attribute`
--

INSERT INTO `listing_attribute` (`listing_id`, `attribute_id`) VALUES
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 1),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 1),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 1),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 1),
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 2),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 2),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('942722bb-028d-49fe-8799-a2671dd05761', 2),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 2),
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 3),
('2f0fd0de-79b6-43ea-9148-39ae45ce176d', 3),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('942722bb-028d-49fe-8799-a2671dd05761', 3),
('b11f4a2c-c053-47de-80b2-5cace81c78e8', 3),
('c3a8e969-00f7-4f30-b019-25491a931870', 3),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 3),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 4),
('2f0fd0de-79b6-43ea-9148-39ae45ce176d', 4),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('942722bb-028d-49fe-8799-a2671dd05761', 4),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 4),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 5),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('942722bb-028d-49fe-8799-a2671dd05761', 5),
('c3a8e969-00f7-4f30-b019-25491a931870', 5),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 5),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 6),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 6),
('942722bb-028d-49fe-8799-a2671dd05761', 6),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 6);

-- --------------------------------------------------------

--
-- Table structure for table `listing_availability`
--

CREATE TABLE `listing_availability` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `available_from` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `available_until` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_availability`
--

INSERT INTO `listing_availability` (`id`, `listing_id`, `available_from`, `created_at`, `available_until`) VALUES
('10c40c87-bed6-4566-a4a6-855d9b3f8e61', 'b11f4a2c-c053-47de-80b2-5cace81c78e8', '2026-02-04', '2026-01-14 13:15:44', '2026-02-07'),
('693af09b-ffea-4991-ac50-6a379bea3782', 'c3a8e969-00f7-4f30-b019-25491a931870', '2026-01-01', '2026-01-06 10:00:42', '2026-05-29'),
('8cc2f14d-bcd4-4b2d-8d12-b8aff7b6d17a', '942722bb-028d-49fe-8799-a2671dd05761', '2025-12-17', '2025-12-17 12:48:58', NULL),
('96e43efd-72eb-4012-a8ee-6cb1d7737ced', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', '2025-12-17', '2025-12-17 10:47:48', NULL),
('cd2e8e4e-a395-4d57-8e98-37396745326c', '2f0fd0de-79b6-43ea-9148-39ae45ce176d', '2026-01-15', '2026-01-20 09:08:35', '2026-01-22');

-- --------------------------------------------------------

--
-- Table structure for table `listing_image`
--

CREATE TABLE `listing_image` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` smallint DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_image`
--

INSERT INTO `listing_image` (`id`, `listing_id`, `image`, `position`, `created_at`) VALUES
('02752886-2233-4048-afb1-b978a29f6e78', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 'uploads/images/ecc326f4-8b34-445d-9c17-765d76bdfaa5_69428a547de21.webp', 0, '2025-12-17 10:47:48'),
('0e23ac49-08dd-4dab-b6e8-0a8d482b8091', '942722bb-028d-49fe-8799-a2671dd05761', 'uploads/images/942722bb-028d-49fe-8799-a2671dd05761_6942a6ba42542.jpg', 2, '2025-12-17 12:48:58'),
('1567de44-b26f-49fb-9f77-b3788db0b7c9', '942722bb-028d-49fe-8799-a2671dd05761', 'uploads/images/942722bb-028d-49fe-8799-a2671dd05761_6942a6ba41195.webp', 0, '2025-12-17 12:48:58'),
('1985aa1e-8a49-4dea-8533-a9a404adea9e', '2f0fd0de-79b6-43ea-9148-39ae45ce176d', 'uploads/images/2f0fd0de-79b6-43ea-9148-39ae45ce176d_696f4613197fd.jpeg', 0, '2026-01-20 09:08:35'),
('20cdeed2-0003-4a83-9b4b-10165ee75e07', 'c3a8e969-00f7-4f30-b019-25491a931870', 'uploads/images/c3a8e969-00f7-4f30-b019-25491a931870_695cdd4a1d6e6.jpg', 0, '2026-01-06 10:00:42'),
('2dd25a6a-bfc5-11f0-a648-52f5d85831eb', '2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 'https://example.com/img/listing1_1.jpg', 0, '2025-11-12 11:43:24'),
('2dd25f38-bfc5-11f0-a648-52f5d85831eb', '2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 'https://example.com/img/listing1_2.jpg', 1, '2025-11-12 11:43:24'),
('2dd26050-bfc5-11f0-a648-52f5d85831eb', '2dcbb778-bfc5-11f0-a648-52f5d85831eb', 'https://example.com/img/listing2_1.jpg', 0, '2025-11-12 11:43:24'),
('331ff530-bfd0-11f0-a648-52f5d85831eb', '331d2b70-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331ffa30-bfd0-11f0-a648-52f5d85831eb', '331d44fc-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331ffbe8-bfd0-11f0-a648-52f5d85831eb', '331d460a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331ffcba-bfd0-11f0-a648-52f5d85831eb', '331d46a0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331ffd78-bfd0-11f0-a648-52f5d85831eb', '331d47cc-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331ffe40-bfd0-11f0-a648-52f5d85831eb', '331d4862-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331fff08-bfd0-11f0-a648-52f5d85831eb', '331d48e4-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('331fffbc-bfd0-11f0-a648-52f5d85831eb', '331d4966-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200070-bfd0-11f0-a648-52f5d85831eb', '331d49f2-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200138-bfd0-11f0-a648-52f5d85831eb', '331d4a6a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332001e2-bfd0-11f0-a648-52f5d85831eb', '331d4aec-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332002a0-bfd0-11f0-a648-52f5d85831eb', '331d4b6e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200354-bfd0-11f0-a648-52f5d85831eb', '331d4c18-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200408-bfd0-11f0-a648-52f5d85831eb', '331d4c9a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332004b2-bfd0-11f0-a648-52f5d85831eb', '331d4d12-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200566-bfd0-11f0-a648-52f5d85831eb', '331d4d8a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320061a-bfd0-11f0-a648-52f5d85831eb', '331d4e0c-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332006d8-bfd0-11f0-a648-52f5d85831eb', '331d4e84-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200782-bfd0-11f0-a648-52f5d85831eb', '331d4efc-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320082c-bfd0-11f0-a648-52f5d85831eb', '331d4ff6-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332008e0-bfd0-11f0-a648-52f5d85831eb', '331d5078-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320099e-bfd0-11f0-a648-52f5d85831eb', '331d50f0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200a98-bfd0-11f0-a648-52f5d85831eb', '331d5172-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200b7e-bfd0-11f0-a648-52f5d85831eb', '331d5258-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200c6e-bfd0-11f0-a648-52f5d85831eb', '331d52da-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200d68-bfd0-11f0-a648-52f5d85831eb', '331d5352-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200e4e-bfd0-11f0-a648-52f5d85831eb', '331d53ca-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33200f3e-bfd0-11f0-a648-52f5d85831eb', '331d5442-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320102e-bfd0-11f0-a648-52f5d85831eb', '331d54d8-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201146-bfd0-11f0-a648-52f5d85831eb', '331d555a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201240-bfd0-11f0-a648-52f5d85831eb', '331d55dc-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320133a-bfd0-11f0-a648-52f5d85831eb', '331d565e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320142a-bfd0-11f0-a648-52f5d85831eb', '331d56d6-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201524-bfd0-11f0-a648-52f5d85831eb', '331d5758-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201614-bfd0-11f0-a648-52f5d85831eb', '331d57d0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201704-bfd0-11f0-a648-52f5d85831eb', '331d5848-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201808-bfd0-11f0-a648-52f5d85831eb', '331d58c0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201934-bfd0-11f0-a648-52f5d85831eb', '331d5942-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332019ca-bfd0-11f0-a648-52f5d85831eb', '331d59ba-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201a2e-bfd0-11f0-a648-52f5d85831eb', '331d5a82-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201a88-bfd0-11f0-a648-52f5d85831eb', '331d5b04-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201aec-bfd0-11f0-a648-52f5d85831eb', '331d5b86-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201b50-bfd0-11f0-a648-52f5d85831eb', '331d5bfe-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201bb4-bfd0-11f0-a648-52f5d85831eb', '331d5c80-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201c0e-bfd0-11f0-a648-52f5d85831eb', '331d5cf8-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201c72-bfd0-11f0-a648-52f5d85831eb', '331d5d7a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201ccc-bfd0-11f0-a648-52f5d85831eb', '331d5df2-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201d26-bfd0-11f0-a648-52f5d85831eb', '331d5e74-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201d80-bfd0-11f0-a648-52f5d85831eb', '331d5eec-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201de4-bfd0-11f0-a648-52f5d85831eb', '331d5f64-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201e3e-bfd0-11f0-a648-52f5d85831eb', '331d5fdc-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201ede-bfd0-11f0-a648-52f5d85831eb', '331d605e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201f4c-bfd0-11f0-a648-52f5d85831eb', '331d60e0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33201fa6-bfd0-11f0-a648-52f5d85831eb', '331d6158-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320200a-bfd0-11f0-a648-52f5d85831eb', '331d61d0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202064-bfd0-11f0-a648-52f5d85831eb', '331d6252-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332020c8-bfd0-11f0-a648-52f5d85831eb', '331d62ca-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320212c-bfd0-11f0-a648-52f5d85831eb', '331d634c-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202186-bfd0-11f0-a648-52f5d85831eb', '331d63ce-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332021ea-bfd0-11f0-a648-52f5d85831eb', '331d6a0e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202244-bfd0-11f0-a648-52f5d85831eb', '331d6b62-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332022a8-bfd0-11f0-a648-52f5d85831eb', '331d6be4-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202302-bfd0-11f0-a648-52f5d85831eb', '331d6c66-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202366-bfd0-11f0-a648-52f5d85831eb', '331d6cde-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332023c0-bfd0-11f0-a648-52f5d85831eb', '331d6d6a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202424-bfd0-11f0-a648-52f5d85831eb', '331d6de2-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320247e-bfd0-11f0-a648-52f5d85831eb', '331d6e64-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332024e2-bfd0-11f0-a648-52f5d85831eb', '331d6edc-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320253c-bfd0-11f0-a648-52f5d85831eb', '331d6f5e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332025a0-bfd0-11f0-a648-52f5d85831eb', '331d7062-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332025fa-bfd0-11f0-a648-52f5d85831eb', '331d715c-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320265e-bfd0-11f0-a648-52f5d85831eb', '331d722e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332026b8-bfd0-11f0-a648-52f5d85831eb', '331d72f6-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320271c-bfd0-11f0-a648-52f5d85831eb', '331d7346-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202776-bfd0-11f0-a648-52f5d85831eb', '331d73a0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332027da-bfd0-11f0-a648-52f5d85831eb', '331d73f0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202834-bfd0-11f0-a648-52f5d85831eb', '331d7440-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202898-bfd0-11f0-a648-52f5d85831eb', '331d749a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332028f2-bfd0-11f0-a648-52f5d85831eb', '331d74ea-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202956-bfd0-11f0-a648-52f5d85831eb', '331d7544-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332029b0-bfd0-11f0-a648-52f5d85831eb', '331d7594-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33202a14-bfd0-11f0-a648-52f5d85831eb', '331d75e4-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205a66-bfd0-11f0-a648-52f5d85831eb', '331d763e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205b4c-bfd0-11f0-a648-52f5d85831eb', '331d774c-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205bc4-bfd0-11f0-a648-52f5d85831eb', '331d779c-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205c3c-bfd0-11f0-a648-52f5d85831eb', '331d77f6-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205caa-bfd0-11f0-a648-52f5d85831eb', '331d7846-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205d18-bfd0-11f0-a648-52f5d85831eb', '331d7896-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205d86-bfd0-11f0-a648-52f5d85831eb', '331d7fa8-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205dea-bfd0-11f0-a648-52f5d85831eb', '331d8002-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205e62-bfd0-11f0-a648-52f5d85831eb', '331d805c-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205ed0-bfd0-11f0-a648-52f5d85831eb', '331d80b6-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205f34-bfd0-11f0-a648-52f5d85831eb', '331d8110-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205fa2-bfd0-11f0-a648-52f5d85831eb', '331d8160-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33205ffc-bfd0-11f0-a648-52f5d85831eb', '331d81b0-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320606a-bfd0-11f0-a648-52f5d85831eb', '331d820a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332060c4-bfd0-11f0-a648-52f5d85831eb', '331d825a-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33206128-bfd0-11f0-a648-52f5d85831eb', '331d82b4-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33206196-bfd0-11f0-a648-52f5d85831eb', '331d8304-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332061f0-bfd0-11f0-a648-52f5d85831eb', '331d8390-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33206254-bfd0-11f0-a648-52f5d85831eb', '331d83ea-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('332062b8-bfd0-11f0-a648-52f5d85831eb', '331d8444-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('3320631c-bfd0-11f0-a648-52f5d85831eb', '331d849e-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('33206380-bfd0-11f0-a648-52f5d85831eb', '331d84ee-bfd0-11f0-a648-52f5d85831eb', 'assets/listing.jpg', 0, '2025-11-12 13:02:18'),
('528f259e-2782-4521-b424-a1af3a5dc803', 'b11f4a2c-c053-47de-80b2-5cace81c78e8', 'uploads/images/b11f4a2c-c053-47de-80b2-5cace81c78e8_696389cc01c8f.png', 0, '2026-01-11 11:30:20'),
('5e175e56-bfd8-11f0-9b66-3c11a3fd0c43', '5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e176f40-bfd8-11f0-9b66-3c11a3fd0c43', '5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1770a8-bfd8-11f0-9b66-3c11a3fd0c43', '5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1771d4-bfd8-11f0-9b66-3c11a3fd0c43', '5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177300-bfd8-11f0-9b66-3c11a3fd0c43', '5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1775e4-bfd8-11f0-9b66-3c11a3fd0c43', '5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1776e8-bfd8-11f0-9b66-3c11a3fd0c43', '5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1777e2-bfd8-11f0-9b66-3c11a3fd0c43', '5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1778d2-bfd8-11f0-9b66-3c11a3fd0c43', '5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177a58-bfd8-11f0-9b66-3c11a3fd0c43', '5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177b48-bfd8-11f0-9b66-3c11a3fd0c43', '5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177c4c-bfd8-11f0-9b66-3c11a3fd0c43', '5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177d3c-bfd8-11f0-9b66-3c11a3fd0c43', '5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177e36-bfd8-11f0-9b66-3c11a3fd0c43', '5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e177f94-bfd8-11f0-9b66-3c11a3fd0c43', '5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17808e-bfd8-11f0-9b66-3c11a3fd0c43', '5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e178188-bfd8-11f0-9b66-3c11a3fd0c43', '5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e178278-bfd8-11f0-9b66-3c11a3fd0c43', '5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e178368-bfd8-11f0-9b66-3c11a3fd0c43', '5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1784bc-bfd8-11f0-9b66-3c11a3fd0c43', '5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1785b6-bfd8-11f0-9b66-3c11a3fd0c43', '5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1786c4-bfd8-11f0-9b66-3c11a3fd0c43', '5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1787b4-bfd8-11f0-9b66-3c11a3fd0c43', '5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1788a4-bfd8-11f0-9b66-3c11a3fd0c43', '5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e178994-bfd8-11f0-9b66-3c11a3fd0c43', '5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e179d4e-bfd8-11f0-9b66-3c11a3fd0c43', '5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e179e7a-bfd8-11f0-9b66-3c11a3fd0c43', '5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e179f7e-bfd8-11f0-9b66-3c11a3fd0c43', '5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a078-bfd8-11f0-9b66-3c11a3fd0c43', '5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a186-bfd8-11f0-9b66-3c11a3fd0c43', '5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a280-bfd8-11f0-9b66-3c11a3fd0c43', '5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a370-bfd8-11f0-9b66-3c11a3fd0c43', '5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a460-bfd8-11f0-9b66-3c11a3fd0c43', '5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a550-bfd8-11f0-9b66-3c11a3fd0c43', '5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a640-bfd8-11f0-9b66-3c11a3fd0c43', '5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a730-bfd8-11f0-9b66-3c11a3fd0c43', '5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a820-bfd8-11f0-9b66-3c11a3fd0c43', '5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17a910-bfd8-11f0-9b66-3c11a3fd0c43', '5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17aa00-bfd8-11f0-9b66-3c11a3fd0c43', '5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17aaf0-bfd8-11f0-9b66-3c11a3fd0c43', '5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17abd6-bfd8-11f0-9b66-3c11a3fd0c43', '5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17acda-bfd8-11f0-9b66-3c11a3fd0c43', '5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17add4-bfd8-11f0-9b66-3c11a3fd0c43', '5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17aeba-bfd8-11f0-9b66-3c11a3fd0c43', '5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17afb4-bfd8-11f0-9b66-3c11a3fd0c43', '5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b0a4-bfd8-11f0-9b66-3c11a3fd0c43', '5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b194-bfd8-11f0-9b66-3c11a3fd0c43', '5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b2a2-bfd8-11f0-9b66-3c11a3fd0c43', '5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b392-bfd8-11f0-9b66-3c11a3fd0c43', '5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b482-bfd8-11f0-9b66-3c11a3fd0c43', '5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b572-bfd8-11f0-9b66-3c11a3fd0c43', '5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b662-bfd8-11f0-9b66-3c11a3fd0c43', '5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b752-bfd8-11f0-9b66-3c11a3fd0c43', '5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b842-bfd8-11f0-9b66-3c11a3fd0c43', '5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17b932-bfd8-11f0-9b66-3c11a3fd0c43', '5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17ba18-bfd8-11f0-9b66-3c11a3fd0c43', '5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17bb08-bfd8-11f0-9b66-3c11a3fd0c43', '5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17bbf8-bfd8-11f0-9b66-3c11a3fd0c43', '5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17bce8-bfd8-11f0-9b66-3c11a3fd0c43', '5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17bdd8-bfd8-11f0-9b66-3c11a3fd0c43', '5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17bec8-bfd8-11f0-9b66-3c11a3fd0c43', '5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17bfc2-bfd8-11f0-9b66-3c11a3fd0c43', '5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c0b2-bfd8-11f0-9b66-3c11a3fd0c43', '5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c198-bfd8-11f0-9b66-3c11a3fd0c43', '5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c288-bfd8-11f0-9b66-3c11a3fd0c43', '5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c378-bfd8-11f0-9b66-3c11a3fd0c43', '5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c468-bfd8-11f0-9b66-3c11a3fd0c43', '5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c54e-bfd8-11f0-9b66-3c11a3fd0c43', '5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c63e-bfd8-11f0-9b66-3c11a3fd0c43', '5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c72e-bfd8-11f0-9b66-3c11a3fd0c43', '5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c828-bfd8-11f0-9b66-3c11a3fd0c43', '5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c90e-bfd8-11f0-9b66-3c11a3fd0c43', '5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17c9fe-bfd8-11f0-9b66-3c11a3fd0c43', '5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17caee-bfd8-11f0-9b66-3c11a3fd0c43', '5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17cbe8-bfd8-11f0-9b66-3c11a3fd0c43', '5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17ccd8-bfd8-11f0-9b66-3c11a3fd0c43', '5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17cdbe-bfd8-11f0-9b66-3c11a3fd0c43', '5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17ceae-bfd8-11f0-9b66-3c11a3fd0c43', '5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17cf94-bfd8-11f0-9b66-3c11a3fd0c43', '5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17d084-bfd8-11f0-9b66-3c11a3fd0c43', '5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17d174-bfd8-11f0-9b66-3c11a3fd0c43', '5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17d264-bfd8-11f0-9b66-3c11a3fd0c43', '5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17ed62-bfd8-11f0-9b66-3c11a3fd0c43', '5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17eeb6-bfd8-11f0-9b66-3c11a3fd0c43', '5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17efb0-bfd8-11f0-9b66-3c11a3fd0c43', '5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f3f2-bfd8-11f0-9b66-3c11a3fd0c43', '5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f492-bfd8-11f0-9b66-3c11a3fd0c43', '5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f514-bfd8-11f0-9b66-3c11a3fd0c43', '5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f578-bfd8-11f0-9b66-3c11a3fd0c43', '5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f5f0-bfd8-11f0-9b66-3c11a3fd0c43', '5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f7a8-bfd8-11f0-9b66-3c11a3fd0c43', '5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f816-bfd8-11f0-9b66-3c11a3fd0c43', '5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f87a-bfd8-11f0-9b66-3c11a3fd0c43', '5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17f974-bfd8-11f0-9b66-3c11a3fd0c43', '5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17fa3c-bfd8-11f0-9b66-3c11a3fd0c43', '5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17fdde-bfd8-11f0-9b66-3c11a3fd0c43', '5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17fe60-bfd8-11f0-9b66-3c11a3fd0c43', '5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17fee2-bfd8-11f0-9b66-3c11a3fd0c43', '5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17ff5a-bfd8-11f0-9b66-3c11a3fd0c43', '5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e17ffd2-bfd8-11f0-9b66-3c11a3fd0c43', '5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e180040-bfd8-11f0-9b66-3c11a3fd0c43', '5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e1800a4-bfd8-11f0-9b66-3c11a3fd0c43', '5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e180112-bfd8-11f0-9b66-3c11a3fd0c43', '5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('5e18018a-bfd8-11f0-9b66-3c11a3fd0c43', '5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 'assets/listing.jpg', 0, '2025-11-12 14:00:46'),
('9c50b8c3-a171-43fe-a6f5-36006e625ab0', '942722bb-028d-49fe-8799-a2671dd05761', 'uploads/images/942722bb-028d-49fe-8799-a2671dd05761_6942a6ba41b63.jpeg', 1, '2025-12-17 12:48:58'),
('b0f233d2-7a5a-47a4-a0fd-7b5b2e1d908e', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 'uploads/images/ecc326f4-8b34-445d-9c17-765d76bdfaa5_69428a547f137.jpg', 2, '2025-12-17 10:47:48'),
('f50af1ce-8d3d-46e4-a452-5277cb3ad440', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 'uploads/images/ecc326f4-8b34-445d-9c17-765d76bdfaa5_69428a547eb28.jpeg', 1, '2025-12-17 10:47:48');

-- --------------------------------------------------------

--
-- Table structure for table `listing_service`
--

CREATE TABLE `listing_service` (
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `service_id` smallint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_service`
--

INSERT INTO `listing_service` (`listing_id`, `service_id`) VALUES
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 1),
('2f0fd0de-79b6-43ea-9148-39ae45ce176d', 1),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 1),
('942722bb-028d-49fe-8799-a2671dd05761', 1),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 1),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 2),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 2),
('942722bb-028d-49fe-8799-a2671dd05761', 2),
('b11f4a2c-c053-47de-80b2-5cace81c78e8', 2),
('c3a8e969-00f7-4f30-b019-25491a931870', 2),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 2),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 3),
('b11f4a2c-c053-47de-80b2-5cace81c78e8', 3),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 3),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 4),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 4),
('2f0fd0de-79b6-43ea-9148-39ae45ce176d', 5),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 5),
('942722bb-028d-49fe-8799-a2671dd05761', 5),
('b11f4a2c-c053-47de-80b2-5cace81c78e8', 5),
('c3a8e969-00f7-4f30-b019-25491a931870', 5),
('ecc326f4-8b34-445d-9c17-765d76bdfaa5', 5);

-- --------------------------------------------------------

--
-- Table structure for table `listing_verification_document`
--

CREATE TABLE `listing_verification_document` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `document_type_id` smallint DEFAULT NULL,
  `document` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_verification_document`
--

INSERT INTO `listing_verification_document` (`id`, `listing_id`, `document_type_id`, `document`, `created_at`, `verified_at`) VALUES
('10e5172c-a3d2-40d3-aa22-67ad4dff2311', '942722bb-028d-49fe-8799-a2671dd05761', 5, 'uploads/verification_docs/942722bb-028d-49fe-8799-a2671dd05761_verification_6942a6ba42ea7.png', '2025-12-17 12:48:58', NULL),
('2c6d6e85-a56e-49a1-963c-fac3fc7879fc', 'c3a8e969-00f7-4f30-b019-25491a931870', 5, 'uploads/verification_docs/c3a8e969-00f7-4f30-b019-25491a931870_verification_695cdd4a1e2db.jpg', '2026-01-06 10:00:42', NULL),
('2dd364dc-bfc5-11f0-a648-52f5d85831eb', '2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 3, 'https://example.com/docs/listing1_deed.pdf', '2025-11-12 11:43:24', NULL),
('33217306-bfd0-11f0-a648-52f5d85831eb', '331d2b70-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321786a-bfd0-11f0-a648-52f5d85831eb', '331d44fc-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33217946-bfd0-11f0-a648-52f5d85831eb', '331d460a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332179dc-bfd0-11f0-a648-52f5d85831eb', '331d46a0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33217a72-bfd0-11f0-a648-52f5d85831eb', '331d47cc-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33217af4-bfd0-11f0-a648-52f5d85831eb', '331d4862-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33217bda-bfd0-11f0-a648-52f5d85831eb', '331d48e4-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33217c66-bfd0-11f0-a648-52f5d85831eb', '331d4966-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33217cde-bfd0-11f0-a648-52f5d85831eb', '331d49f2-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33217d60-bfd0-11f0-a648-52f5d85831eb', '331d4a6a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33217de2-bfd0-11f0-a648-52f5d85831eb', '331d4aec-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33217e64-bfd0-11f0-a648-52f5d85831eb', '331d4b6e-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33217ee6-bfd0-11f0-a648-52f5d85831eb', '331d4c18-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33217f68-bfd0-11f0-a648-52f5d85831eb', '331d4c9a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33217fea-bfd0-11f0-a648-52f5d85831eb', '331d4d12-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218062-bfd0-11f0-a648-52f5d85831eb', '331d4d8a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332180e4-bfd0-11f0-a648-52f5d85831eb', '331d4e0c-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321815c-bfd0-11f0-a648-52f5d85831eb', '331d4e84-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332181de-bfd0-11f0-a648-52f5d85831eb', '331d4efc-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218260-bfd0-11f0-a648-52f5d85831eb', '331d4ff6-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332182e2-bfd0-11f0-a648-52f5d85831eb', '331d5078-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218364-bfd0-11f0-a648-52f5d85831eb', '331d50f0-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332183f0-bfd0-11f0-a648-52f5d85831eb', '331d5172-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218468-bfd0-11f0-a648-52f5d85831eb', '331d5258-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332184ea-bfd0-11f0-a648-52f5d85831eb', '331d52da-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218562-bfd0-11f0-a648-52f5d85831eb', '331d5352-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332185e4-bfd0-11f0-a648-52f5d85831eb', '331d53ca-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321865c-bfd0-11f0-a648-52f5d85831eb', '331d5442-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332186de-bfd0-11f0-a648-52f5d85831eb', '331d54d8-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321876a-bfd0-11f0-a648-52f5d85831eb', '331d555a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332187ec-bfd0-11f0-a648-52f5d85831eb', '331d55dc-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321886e-bfd0-11f0-a648-52f5d85831eb', '331d565e-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332188e6-bfd0-11f0-a648-52f5d85831eb', '331d56d6-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218968-bfd0-11f0-a648-52f5d85831eb', '331d5758-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332189e0-bfd0-11f0-a648-52f5d85831eb', '331d57d0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218a58-bfd0-11f0-a648-52f5d85831eb', '331d5848-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33218ad0-bfd0-11f0-a648-52f5d85831eb', '331d58c0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218b48-bfd0-11f0-a648-52f5d85831eb', '331d5942-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33218bc0-bfd0-11f0-a648-52f5d85831eb', '331d59ba-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218c42-bfd0-11f0-a648-52f5d85831eb', '331d5a82-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33218cce-bfd0-11f0-a648-52f5d85831eb', '331d5b04-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218dc8-bfd0-11f0-a648-52f5d85831eb', '331d5b86-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33218f30-bfd0-11f0-a648-52f5d85831eb', '331d5bfe-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33218fee-bfd0-11f0-a648-52f5d85831eb', '331d5c80-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219084-bfd0-11f0-a648-52f5d85831eb', '331d5cf8-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219156-bfd0-11f0-a648-52f5d85831eb', '331d5d7a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332191e2-bfd0-11f0-a648-52f5d85831eb', '331d5df2-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321926e-bfd0-11f0-a648-52f5d85831eb', '331d5e74-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219304-bfd0-11f0-a648-52f5d85831eb', '331d5eec-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321937c-bfd0-11f0-a648-52f5d85831eb', '331d5f64-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332193fe-bfd0-11f0-a648-52f5d85831eb', '331d5fdc-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321948a-bfd0-11f0-a648-52f5d85831eb', '331d605e-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219502-bfd0-11f0-a648-52f5d85831eb', '331d60e0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219584-bfd0-11f0-a648-52f5d85831eb', '331d6158-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219606-bfd0-11f0-a648-52f5d85831eb', '331d61d0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219688-bfd0-11f0-a648-52f5d85831eb', '331d6252-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219700-bfd0-11f0-a648-52f5d85831eb', '331d62ca-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321978c-bfd0-11f0-a648-52f5d85831eb', '331d634c-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219804-bfd0-11f0-a648-52f5d85831eb', '331d63ce-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219886-bfd0-11f0-a648-52f5d85831eb', '331d6a0e-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332198fe-bfd0-11f0-a648-52f5d85831eb', '331d6b62-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219980-bfd0-11f0-a648-52f5d85831eb', '331d6be4-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('332199f8-bfd0-11f0-a648-52f5d85831eb', '331d6c66-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219a70-bfd0-11f0-a648-52f5d85831eb', '331d6cde-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219ae8-bfd0-11f0-a648-52f5d85831eb', '331d6d6a-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219b6a-bfd0-11f0-a648-52f5d85831eb', '331d6de2-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219be2-bfd0-11f0-a648-52f5d85831eb', '331d6e64-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219c64-bfd0-11f0-a648-52f5d85831eb', '331d6edc-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219cdc-bfd0-11f0-a648-52f5d85831eb', '331d6f5e-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219d54-bfd0-11f0-a648-52f5d85831eb', '331d7062-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219dd6-bfd0-11f0-a648-52f5d85831eb', '331d715c-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219e4e-bfd0-11f0-a648-52f5d85831eb', '331d722e-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219ec6-bfd0-11f0-a648-52f5d85831eb', '331d72f6-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('33219f48-bfd0-11f0-a648-52f5d85831eb', '331d7346-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('33219fc0-bfd0-11f0-a648-52f5d85831eb', '331d73a0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321a042-bfd0-11f0-a648-52f5d85831eb', '331d73f0-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321a132-bfd0-11f0-a648-52f5d85831eb', '331d7440-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321a268-bfd0-11f0-a648-52f5d85831eb', '331d749a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321a39e-bfd0-11f0-a648-52f5d85831eb', '331d74ea-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321a4d4-bfd0-11f0-a648-52f5d85831eb', '331d7544-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321a60a-bfd0-11f0-a648-52f5d85831eb', '331d7594-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321a736-bfd0-11f0-a648-52f5d85831eb', '331d75e4-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321a86c-bfd0-11f0-a648-52f5d85831eb', '331d763e-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321a9c0-bfd0-11f0-a648-52f5d85831eb', '331d774c-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321ab32-bfd0-11f0-a648-52f5d85831eb', '331d779c-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321ac72-bfd0-11f0-a648-52f5d85831eb', '331d77f6-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321ae48-bfd0-11f0-a648-52f5d85831eb', '331d7846-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321afce-bfd0-11f0-a648-52f5d85831eb', '331d7896-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321b104-bfd0-11f0-a648-52f5d85831eb', '331d7fa8-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321b244-bfd0-11f0-a648-52f5d85831eb', '331d8002-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321b398-bfd0-11f0-a648-52f5d85831eb', '331d805c-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321b4d8-bfd0-11f0-a648-52f5d85831eb', '331d80b6-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321b618-bfd0-11f0-a648-52f5d85831eb', '331d8110-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321b7da-bfd0-11f0-a648-52f5d85831eb', '331d8160-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321b92e-bfd0-11f0-a648-52f5d85831eb', '331d81b0-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321ba64-bfd0-11f0-a648-52f5d85831eb', '331d820a-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321bba4-bfd0-11f0-a648-52f5d85831eb', '331d825a-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321bcda-bfd0-11f0-a648-52f5d85831eb', '331d82b4-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321be10-bfd0-11f0-a648-52f5d85831eb', '331d8304-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321bf46-bfd0-11f0-a648-52f5d85831eb', '331d8390-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321c07c-bfd0-11f0-a648-52f5d85831eb', '331d83ea-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321c1b2-bfd0-11f0-a648-52f5d85831eb', '331d8444-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('3321c2e8-bfd0-11f0-a648-52f5d85831eb', '331d849e-bfd0-11f0-a648-52f5d85831eb', 3, 'house_deed.pdf', '2025-11-12 13:02:18', NULL),
('3321c41e-bfd0-11f0-a648-52f5d85831eb', '331d84ee-bfd0-11f0-a648-52f5d85831eb', 4, 'lease.pdf', '2025-11-12 13:02:18', NULL),
('5e1998b0-bfd8-11f0-9b66-3c11a3fd0c43', '5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19a2ce-bfd8-11f0-9b66-3c11a3fd0c43', '5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19a472-bfd8-11f0-9b66-3c11a3fd0c43', '5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19a5e4-bfd8-11f0-9b66-3c11a3fd0c43', '5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19a742-bfd8-11f0-9b66-3c11a3fd0c43', '5e123174-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19a8a0-bfd8-11f0-9b66-3c11a3fd0c43', '5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19a9ea-bfd8-11f0-9b66-3c11a3fd0c43', '5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19ab34-bfd8-11f0-9b66-3c11a3fd0c43', '5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19ac74-bfd8-11f0-9b66-3c11a3fd0c43', '5e123322-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19adb4-bfd8-11f0-9b66-3c11a3fd0c43', '5e123372-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19aef4-bfd8-11f0-9b66-3c11a3fd0c43', '5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19b034-bfd8-11f0-9b66-3c11a3fd0c43', '5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19b17e-bfd8-11f0-9b66-3c11a3fd0c43', '5e123476-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19b2b4-bfd8-11f0-9b66-3c11a3fd0c43', '5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19b3f4-bfd8-11f0-9b66-3c11a3fd0c43', '5e123516-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19b534-bfd8-11f0-9b66-3c11a3fd0c43', '5e123566-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19b674-bfd8-11f0-9b66-3c11a3fd0c43', '5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19b7b4-bfd8-11f0-9b66-3c11a3fd0c43', '5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19b8ea-bfd8-11f0-9b66-3c11a3fd0c43', '5e123660-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19ba2a-bfd8-11f0-9b66-3c11a3fd0c43', '5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19bb60-bfd8-11f0-9b66-3c11a3fd0c43', '5e123764-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19bc96-bfd8-11f0-9b66-3c11a3fd0c43', '5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19bdd6-bfd8-11f0-9b66-3c11a3fd0c43', '5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19bf16-bfd8-11f0-9b66-3c11a3fd0c43', '5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19c056-bfd8-11f0-9b66-3c11a3fd0c43', '5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19c1fa-bfd8-11f0-9b66-3c11a3fd0c43', '5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19c344-bfd8-11f0-9b66-3c11a3fd0c43', '5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19c498-bfd8-11f0-9b66-3c11a3fd0c43', '5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19c5d8-bfd8-11f0-9b66-3c11a3fd0c43', '5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19c722-bfd8-11f0-9b66-3c11a3fd0c43', '5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19ca24-bfd8-11f0-9b66-3c11a3fd0c43', '5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19cc04-bfd8-11f0-9b66-3c11a3fd0c43', '5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19cd94-bfd8-11f0-9b66-3c11a3fd0c43', '5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19db86-bfd8-11f0-9b66-3c11a3fd0c43', '5e124056-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19dd98-bfd8-11f0-9b66-3c11a3fd0c43', '5e124164-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19df0a-bfd8-11f0-9b66-3c11a3fd0c43', '5e124240-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19e0c2-bfd8-11f0-9b66-3c11a3fd0c43', '5e124308-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19e22a-bfd8-11f0-9b66-3c11a3fd0c43', '5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19e388-bfd8-11f0-9b66-3c11a3fd0c43', '5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19e4dc-bfd8-11f0-9b66-3c11a3fd0c43', '5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19e630-bfd8-11f0-9b66-3c11a3fd0c43', '5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19e7ca-bfd8-11f0-9b66-3c11a3fd0c43', '5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19e928-bfd8-11f0-9b66-3c11a3fd0c43', '5e124862-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19ea90-bfd8-11f0-9b66-3c11a3fd0c43', '5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19ebda-bfd8-11f0-9b66-3c11a3fd0c43', '5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19ed60-bfd8-11f0-9b66-3c11a3fd0c43', '5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19eec8-bfd8-11f0-9b66-3c11a3fd0c43', '5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19f030-bfd8-11f0-9b66-3c11a3fd0c43', '5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19f184-bfd8-11f0-9b66-3c11a3fd0c43', '5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19f2ce-bfd8-11f0-9b66-3c11a3fd0c43', '5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19f468-bfd8-11f0-9b66-3c11a3fd0c43', '5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19f5b2-bfd8-11f0-9b66-3c11a3fd0c43', '5e125118-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19f6fc-bfd8-11f0-9b66-3c11a3fd0c43', '5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19f846-bfd8-11f0-9b66-3c11a3fd0c43', '5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19f9d6-bfd8-11f0-9b66-3c11a3fd0c43', '5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19fb34-bfd8-11f0-9b66-3c11a3fd0c43', '5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e19fc88-bfd8-11f0-9b66-3c11a3fd0c43', '5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e19fdd2-bfd8-11f0-9b66-3c11a3fd0c43', '5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a01f6-bfd8-11f0-9b66-3c11a3fd0c43', '5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a02c8-bfd8-11f0-9b66-3c11a3fd0c43', '5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a035e-bfd8-11f0-9b66-3c11a3fd0c43', '5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0660-bfd8-11f0-9b66-3c11a3fd0c43', '5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a073c-bfd8-11f0-9b66-3c11a3fd0c43', '5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0804-bfd8-11f0-9b66-3c11a3fd0c43', '5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a089a-bfd8-11f0-9b66-3c11a3fd0c43', '5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0930-bfd8-11f0-9b66-3c11a3fd0c43', '5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a09b2-bfd8-11f0-9b66-3c11a3fd0c43', '5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0a48-bfd8-11f0-9b66-3c11a3fd0c43', '5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0ade-bfd8-11f0-9b66-3c11a3fd0c43', '5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0d36-bfd8-11f0-9b66-3c11a3fd0c43', '5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0e6c-bfd8-11f0-9b66-3c11a3fd0c43', '5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0ef8-bfd8-11f0-9b66-3c11a3fd0c43', '5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a0f7a-bfd8-11f0-9b66-3c11a3fd0c43', '5e127116-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1006-bfd8-11f0-9b66-3c11a3fd0c43', '5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1088-bfd8-11f0-9b66-3c11a3fd0c43', '5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a110a-bfd8-11f0-9b66-3c11a3fd0c43', '5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1196-bfd8-11f0-9b66-3c11a3fd0c43', '5e127468-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1218-bfd8-11f0-9b66-3c11a3fd0c43', '5e127544-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a129a-bfd8-11f0-9b66-3c11a3fd0c43', '5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a138a-bfd8-11f0-9b66-3c11a3fd0c43', '5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1470-bfd8-11f0-9b66-3c11a3fd0c43', '5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a14f2-bfd8-11f0-9b66-3c11a3fd0c43', '5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1574-bfd8-11f0-9b66-3c11a3fd0c43', '5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1600-bfd8-11f0-9b66-3c11a3fd0c43', '5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1682-bfd8-11f0-9b66-3c11a3fd0c43', '5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1704-bfd8-11f0-9b66-3c11a3fd0c43', '5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a17c2-bfd8-11f0-9b66-3c11a3fd0c43', '5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1858-bfd8-11f0-9b66-3c11a3fd0c43', '5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a18da-bfd8-11f0-9b66-3c11a3fd0c43', '5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a195c-bfd8-11f0-9b66-3c11a3fd0c43', '5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1a2e-bfd8-11f0-9b66-3c11a3fd0c43', '5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1ab0-bfd8-11f0-9b66-3c11a3fd0c43', '5e128584-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1b28-bfd8-11f0-9b66-3c11a3fd0c43', '5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1baa-bfd8-11f0-9b66-3c11a3fd0c43', '5e128728-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1c22-bfd8-11f0-9b66-3c11a3fd0c43', '5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1ca4-bfd8-11f0-9b66-3c11a3fd0c43', '5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1d26-bfd8-11f0-9b66-3c11a3fd0c43', '5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1da8-bfd8-11f0-9b66-3c11a3fd0c43', '5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1e2a-bfd8-11f0-9b66-3c11a3fd0c43', '5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1eac-bfd8-11f0-9b66-3c11a3fd0c43', '5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a1f24-bfd8-11f0-9b66-3c11a3fd0c43', '5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a2104-bfd8-11f0-9b66-3c11a3fd0c43', '5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('5e1a2186-bfd8-11f0-9b66-3c11a3fd0c43', '5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', 3, 'house_deed.pdf', '2025-11-12 14:00:46', NULL),
('5e1a246a-bfd8-11f0-9b66-3c11a3fd0c43', '5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', 4, 'lease.pdf', '2025-11-12 14:00:46', NULL),
('cb029ccc-db66-4acf-992e-d497be1c3a53', '2f0fd0de-79b6-43ea-9148-39ae45ce176d', 5, 'uploads/verification_docs/2f0fd0de-79b6-43ea-9148-39ae45ce176d_verification_696f461319967.jpeg', '2026-01-20 09:08:35', NULL),
('d9031e4e-e710-4e3e-bd3e-5fbceeab85c6', 'b11f4a2c-c053-47de-80b2-5cace81c78e8', 5, 'uploads/verification_docs/b11f4a2c-c053-47de-80b2-5cace81c78e8_verification_696389cc01dbb.png', '2026-01-11 11:30:20', NULL),
('fa58137a-7568-46c1-ac26-074a8abf8a83', 'ecc326f4-8b34-445d-9c17-765d76bdfaa5', 3, 'uploads/verification_docs/ecc326f4-8b34-445d-9c17-765d76bdfaa5_verification_69428a547f72f.pdf', '2025-12-17 10:47:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `negotiation`
--

CREATE TABLE `negotiation` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `application_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `proposer_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `proposed_start_date` date DEFAULT NULL,
  `proposed_end_date` date DEFAULT NULL,
  `terms` text,
  `status` enum('proposed','countered','accepted','rejected') DEFAULT 'proposed',
  `parent_negotiation_id` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `negotiation`
--

INSERT INTO `negotiation` (`id`, `application_id`, `proposer_profile_id`, `proposed_start_date`, `proposed_end_date`, `terms`, `status`, `parent_negotiation_id`, `created_at`) VALUES
('0ad2922f-d191-4ae3-aeb4-c5cf015a4faa', 'adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', '056e9e40-5ade-4d48-be1b-0b340dabf82d', '2026-01-20', '2026-01-21', 'Sheeeee', 'accepted', NULL, '2026-01-20 09:53:46'),
('0ffd1ede-2e07-4579-baf5-388ee1f93f31', 'adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', 'cc20f470-d0fa-4e78-a1bb-d28df5a4f5a4', '2026-01-22', '2026-01-27', 'What about this one?', 'rejected', 'b6ced461-6547-4f64-8d16-794acb3e3d9d', '2026-01-20 09:32:21'),
('4502ed2d-357c-4221-9282-c8d4c26a5895', 'adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', 'cc20f470-d0fa-4e78-a1bb-d28df5a4f5a4', '2026-01-20', '2026-01-21', 'Sheeee', 'accepted', NULL, '2026-01-20 09:54:19'),
('6c8b0af3-9a85-4899-9ca6-7c878785a584', 'adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', 'cc20f470-d0fa-4e78-a1bb-d28df5a4f5a4', '2026-01-20', '2026-01-22', 'mdkemdkemdkemdkemdkdmkedme', 'accepted', NULL, '2026-01-20 09:57:39'),
('b6ced461-6547-4f64-8d16-794acb3e3d9d', 'adc2bc3c-65c9-42ec-8a52-a267e9b6ea6c', '056e9e40-5ade-4d48-be1b-0b340dabf82d', '2026-01-21', '2026-01-29', 'DMKDAKMDKMADKMDKMAKDMAKSMDKAMDKMDKAMDKAMKMDKAMDKAMDKAMDKMDKAMKM', 'countered', NULL, '2026-01-20 09:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `user_id` bigint UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `type` enum('info','success','warning','error') DEFAULT 'info',
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `message`, `type`, `is_read`, `created_at`) VALUES
('49d1a8ac-f5e6-11f0-98cc-10e18e7e3ea2', 128, 'Your proposal was accepted.', 'success', 1, '2026-01-20 09:56:27'),
('748987dc-f5e6-11f0-98cc-10e18e7e3ea2', 127, 'You have received a new negotiation proposal.', 'info', 1, '2026-01-20 09:57:39'),
('78fda83c-f5e6-11f0-98cc-10e18e7e3ea2', 128, 'Your proposal was accepted.', 'success', 1, '2026-01-20 09:57:46'),
('87146998-f5da-11f0-98cc-10e18e7e3ea2', 127, 'Your document verification was rejected. Please re-upload.', 'error', 1, '2026-01-20 08:32:16'),
('b06e2e2c-f5de-11f0-98cc-10e18e7e3ea2', 128, 'Your account has been approved!', 'success', 1, '2026-01-20 09:02:04'),
('be6d970b-f5e2-11f0-98cc-10e18e7e3ea2', 128, 'You have received a new negotiation proposal.', 'info', 1, '2026-01-20 09:31:05'),
('e9e4748f-f5e5-11f0-98cc-10e18e7e3ea2', 128, 'You have received a new negotiation proposal.', 'info', 1, '2026-01-20 09:53:46'),
('eb8aaebc-f5e2-11f0-98cc-10e18e7e3ea2', 127, 'You have received a counter-proposal.', 'info', 1, '2026-01-20 09:32:21'),
('f34bcc50-f5e5-11f0-98cc-10e18e7e3ea2', 127, 'Your proposal was accepted.', 'success', 1, '2026-01-20 09:54:02'),
('fd9ea953-f5e5-11f0-98cc-10e18e7e3ea2', 127, 'You have received a new negotiation proposal.', 'info', 1, '2026-01-20 09:54:19'),
('ff250419-f5e2-11f0-98cc-10e18e7e3ea2', 128, 'Your proposal was rejected.', 'error', 1, '2026-01-20 09:32:54');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `token` varchar(64) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` char(36) NOT NULL DEFAULT (uuid()),
  `reporter_id` char(36) DEFAULT NULL,
  `reported_type` enum('listing','user','message') NOT NULL,
  `reported_id` varchar(36) NOT NULL,
  `reason` enum('spam','inappropriate','scam','harassment','other') NOT NULL,
  `description` text,
  `status` enum('pending','reviewed','resolved','dismissed') DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `resolved_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `reporter_id`, `reported_type`, `reported_id`, `reason`, `description`, `status`, `created_at`, `resolved_at`, `resolved_by`) VALUES
('86c3f237-08e3-4432-9117-ea2f6770942f', '056e9e40-5ade-4d48-be1b-0b340dabf82d', 'listing', '5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 'spam', 'dsq qdj qdnq nq dq dnq dn', 'pending', '2026-01-19 16:09:13', NULL, NULL),
('f79518f2-7b8d-4eb2-8f50-e9442423467e', '056e9e40-5ade-4d48-be1b-0b340dabf82d', 'listing', '5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', 'other', 'adjnadjandjadjandjnjdnajdnaj', 'pending', '2026-01-20 09:29:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` smallint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `description`) VALUES
(1, 'BASIC CLEANING', 'THE APARTMENT IS NEEDED TO CLEANED PER WEEK'),
(2, 'PET CARE', 'PETS ARE NEEDED TO CARED'),
(3, 'PLANT CARE', 'PLANT ARE NEEDED TO CARED'),
(4, 'TUTORING', 'TUTORING IS NEEDED'),
(5, 'CHORES', 'CHORES ARE NEEDED TO DONE');

-- --------------------------------------------------------

--
-- Table structure for table `user_document`
--

CREATE TABLE `user_document` (
  `id` char(36) NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `document_type_id` smallint UNSIGNED NOT NULL,
  `document_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_at` timestamp NULL DEFAULT NULL,
  `status` enum('pending','rejected','approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_document`
--

INSERT INTO `user_document` (`id`, `account_id`, `document_type_id`, `document_path`, `created_at`, `verified_at`, `status`) VALUES
('02ddbefa-8e34-44d7-90a6-c557ef4ee280', 123, 1, '/uploads/documents/id/ff5d4754-52a5-48c3-997e-c2086f2e9d5f.jpeg', '2025-12-17 15:55:02', NULL, 'pending'),
('05adc3fc-823c-43e8-b19e-02598a512c37', 113, 1, '/uploads/documents/id/af09866a-1970-45c4-979f-e9f8d5b7f915.png', '2025-12-10 10:15:40', NULL, 'pending'),
('130ae3e4-9fdf-4bf0-8608-60454b407689', 119, 2, '/uploads/documents/student/54eba0f2-becb-4cf6-b9eb-f367b7841e46.png', '2025-12-17 10:39:05', NULL, 'pending'),
('18481cb1-3b3a-4d5d-ac87-0932b094d6da', 128, 2, '/uploads/documents/student/f81aae07-d5e7-4dde-b27c-7de496c2164d.pdf', '2026-01-20 09:01:56', NULL, 'pending'),
('264b6cd8-0b75-4a0a-badc-36d443adc037', 122, 2, '/uploads/documents/student/1bd89b5b-aca6-4608-9adf-f2c736a0a09a.png', '2025-12-17 14:20:21', NULL, 'pending'),
('32641faf-efeb-4689-8b31-2efabf175435', 111, 2, '/uploads/documents/student/65535308-c4cf-48d3-b2b6-71b38ecd4613.png', '2025-12-08 01:03:26', NULL, 'pending'),
('3b49a2ee-379b-411c-9668-f24dd4d58ccb', 118, 1, '/uploads/documents/id/6e83f23a-18b4-4994-9428-fe996217decc.png', '2025-12-17 10:38:16', NULL, 'pending'),
('41f7646a-669b-4b0c-a5c6-37c93c10f414', 124, 1, '/uploads/documents/id/c05c812c-3557-47c6-bf8d-b4e8b5a686b7.jpeg', '2026-01-11 10:20:35', NULL, 'pending'),
('52ccaa3c-1eb5-43b6-b561-bfafaf7f6abf', 2, 2, 'user_docs/101001010101010.pdf', '2025-12-07 17:55:16', NULL, 'pending'),
('5cc118d1-ec19-476d-a2ad-5a22ff2d24cb', 120, 2, '/uploads/documents/student/fb45031a-5ca8-431f-b816-ac0603c8787c.png', '2025-12-17 10:39:45', NULL, 'pending'),
('5df612bb-3cf7-444f-8a04-2d8015fd6187', 124, 2, '/uploads/documents/student/878b24cf-b12c-4f97-af74-39995973f279.pdf', '2026-01-11 10:20:35', NULL, 'pending'),
('5fd0a4b0-345e-401e-b123-f821d2ebda84', 111, 1, '/uploads/documents/id/97d0202e-7d54-4778-8bc6-043d2dd2ce30.png', '2025-12-08 01:03:26', NULL, 'pending'),
('694fab7e-9ffd-49db-819f-b24a48de9fb9', 122, 1, '/uploads/documents/id/d27db937-3d6b-4fa8-b68f-bd0c4b59cd4a.png', '2025-12-17 14:20:21', NULL, 'pending'),
('713acd02-6499-4137-ad11-3afe24d8df43', 112, 1, '/uploads/documents/id/9fcda375-ea85-45a0-ad74-f446d395a7af.png', '2025-12-09 21:57:18', NULL, 'pending'),
('74dc0d8e-828b-4f7a-8a1a-3c1ebcce3d5e', 119, 1, '/uploads/documents/id/2e783040-b0ac-4cc9-ada4-2166f8967895.png', '2025-12-17 10:39:05', NULL, 'pending'),
('8efed709-6b6f-42cb-8a26-b13cc6f67561', 121, 2, '/uploads/documents/student/f9adc59a-e4da-4397-806b-48e332e3ccfe.png', '2025-12-17 10:44:52', NULL, 'pending'),
('99dde6d8-5966-4aa7-9d7c-b00807ecddfb', 117, 2, '/uploads/documents/student/c9b6f8bb-4fe0-4578-8141-9814a5e7bf48.pdf', '2025-12-14 23:08:05', NULL, 'pending'),
('9c516aef-89bd-4a99-ae25-ff6ebcc2f6be', 121, 1, '/uploads/documents/id/7206ff04-c182-4e0f-8dbe-d77e923fbd80.png', '2025-12-17 10:44:52', NULL, 'pending'),
('a25977b8-6d14-4580-8b37-671f34ee2c68', 127, 1, '/uploads/documents/id/b65c8fea-4780-49dc-bdee-927fa5bd060c.pdf', '2026-01-14 08:15:32', '2026-01-20 08:18:09', 'rejected'),
('aac2eb0f-8a34-413d-b129-391fe4d7865a', 128, 1, '/uploads/documents/id/df37debd-d9b9-4a50-886d-699b0286a97a.pdf', '2026-01-20 09:01:56', NULL, 'pending'),
('b18f7911-e0c7-49ba-a9a4-2bde740e046b', 112, 2, '/uploads/documents/student/d291f6e9-f442-4452-97e8-3021ea6c238c.png', '2025-12-09 21:57:18', NULL, 'pending'),
('b5f5a005-52b3-40ba-b9ad-e149ec9ffa25', 125, 1, '/uploads/documents/id/7a650534-e289-41d6-91e9-0b3a23dae7bf.pdf', '2026-01-13 11:39:02', NULL, 'pending'),
('c004712c-be92-4c40-92d0-f552ba795074', 125, 2, '/uploads/documents/student/63d582b3-056d-4f62-bbd9-a3fb98e2396d.pdf', '2026-01-13 11:39:02', NULL, 'pending'),
('c55b696d-a7c0-4016-87da-60f3d6c56c15', 120, 1, '/uploads/documents/id/5c6db159-6b24-42a4-9eda-e9c492495d27.png', '2025-12-17 10:39:45', NULL, 'pending'),
('c7763c06-ebf1-4871-a59b-0498a840b2a1', 118, 2, '/uploads/documents/student/88ba3b51-0f5f-4b82-8339-0ee9c3dd74bc.png', '2025-12-17 10:38:16', NULL, 'pending'),
('c7b05432-f871-47f1-ba00-04ccc4364f06', 116, 2, '/uploads/documents/student/139fcd16-8bc6-48d8-a053-1b3db36d40d5.png', '2025-12-11 14:12:29', NULL, 'pending'),
('ca310656-04ea-4878-a36e-4c20bd052904', 127, 2, '/uploads/documents/student/e8f38901-a56e-4ddc-a767-ac0ebab33340.jpg', '2026-01-14 08:15:32', '2026-01-20 08:17:58', 'rejected'),
('d396fb13-8232-4a17-86d9-3f8dd8074c8f', 4, 2, 'user_docs/0101010010110.jpg', '2025-12-07 17:55:16', NULL, 'pending'),
('e2a175b0-6050-42a6-8b81-bde02d7f18ad', 126, 1, '/uploads/documents/id/95f18f7f-4ba3-4c76-8fff-adaabcbec4da.jpeg', '2026-01-13 11:41:10', NULL, 'pending'),
('ebcf9172-dd65-414f-b0e2-1b364f6e4ca7', 3, 1, 'user_docs/110101001.png', '2025-12-07 17:55:16', NULL, 'pending'),
('ed9a8db8-42b3-4cd9-91d6-c887b96c0c43', 117, 1, '/uploads/documents/id/f9251ea0-3f8f-4b07-bd12-eccb2289fefd.pdf', '2025-12-14 23:08:05', NULL, 'pending'),
('f79b23f1-80e1-4ad1-8b36-29f21ab6653d', 116, 1, '/uploads/documents/id/fc5f7fa1-8e3e-4cb2-a836-19dd20fe6bf1.png', '2025-12-11 14:12:29', NULL, 'pending'),
('f9234066-32f5-410e-bfdf-9d4ea1d73c3d', 113, 2, '/uploads/documents/student/89868fa5-b367-42d3-a8e0-63d3f4ad3f3c.png', '2025-12-10 10:15:40', NULL, 'pending'),
('fd3c9a02-d114-468d-ab41-adaa5decfb8e', 123, 2, '/uploads/documents/student/94c5b13d-2695-47a9-a0b1-dd2d9ec903a5.jpeg', '2025-12-17 15:55:02', NULL, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` char(36) NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `bio` text,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `languages` text,
  `accessibility_needs` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `account_id`, `first_name`, `last_name`, `profile_picture`, `phone`, `bio`, `city`, `country`, `created_at`, `updated_at`, `languages`, `accessibility_needs`) VALUES
('00e66855-47ad-41d2-8cf7-7347c1496c81', 122, 'Demooo', 'Demoo', '/uploads/profile_pictures/1c3a5166-0ad0-480f-b9e0-bf604bf9bf10.png', NULL, NULL, NULL, NULL, '2025-12-17 14:20:21', '2025-12-17 14:20:21', NULL, NULL),
('04cdf8c2-80fa-4eb5-9c44-d22e8c9d204b', 111, 'Nikola', 'Batre', NULL, NULL, NULL, NULL, NULL, '2025-12-08 01:03:26', '2025-12-08 01:03:26', NULL, NULL),
('056e9e40-5ade-4d48-be1b-0b340dabf82d', 127, 'Muhammed Arif', 'EREN', '/uploads/profile_pictures/62fa3858-d37b-4336-a8ce-b4956fd6b47e.jpg', NULL, NULL, NULL, NULL, '2026-01-14 08:15:32', '2026-01-14 08:15:32', NULL, NULL),
('09b5e3c3-2f67-4450-8240-fac09d522536', 123, 'Test', 'Twest', '/uploads/profile_pictures/62c71896-bc41-4894-82cc-9c15f0534057.jpeg', NULL, NULL, NULL, NULL, '2025-12-17 15:55:02', '2025-12-17 15:55:02', NULL, NULL),
('0b23e575-89c4-46d0-bb77-91d3d7700365', 28, 'Roman', 'Wright', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('13783aeb-eab3-4feb-8cc4-63088c54af33', 44, 'Marcus', 'Roberts', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('179593fe-5eea-4740-bd77-549fc4a015ed', 14, 'Henry', 'Murray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('20125d2e-2aa5-4d46-85d8-d0b7e295f270', 10, 'George', 'Holmes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('2027817b-9eb4-48d3-961a-808631ffc52c', 78, 'Deanna', 'Phillips', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('236a8940-1475-48c4-a793-2e67c005bba8', 3, 'SURESH', 'TESTER', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('280988fa-8f35-48a1-b8f8-16d0c7cf2777', 74, 'Penelope', 'Russell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('2a6621b7-a0d2-403b-ac83-3c8f3944bfbf', 42, 'Adam', 'Gray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('2a74da3b-389e-4d79-a1e2-d4d103226cfb', 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-07 23:58:20', '2025-12-07 23:58:20', NULL, NULL),
('2ec08256-3c19-4a57-854b-b835880a963e', 69, 'Lucy', 'Chapman', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('2f760c60-0317-4585-995c-e6f8a7d35530', 104, 'Ted', 'Fowler', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('3284455a-e9db-4e02-8f41-c6995838d53f', 117, 'Nik', 'Ola', NULL, NULL, NULL, NULL, NULL, '2025-12-14 23:08:05', '2025-12-14 23:08:05', NULL, NULL),
('32bba3a2-6ecb-4411-9e9d-a56238de5cf4', 5, 'Tony', 'Murray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('332700ca-7bb8-42db-8894-999cc144375f', 109, 'Nikola', 'Batre', NULL, NULL, NULL, NULL, NULL, '2025-12-08 00:46:23', '2025-12-08 00:46:23', NULL, NULL),
('34b2bb02-8adc-446c-b219-466627542292', 37, 'Miranda', 'Perry', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('357e760a-d08c-4078-be80-b6d8c819f56a', 113, 'Nikola', 'Bare', 'avatars/695cda6060fa9.jpg', NULL, 'aaa', 'Paris', 'France', '2025-12-10 10:15:40', '2026-01-06 09:48:16', 'English, Croatian', 'adsjahdjasjdnakjsdnkajã'),
('36ece217-9ef1-4f6d-9e05-27dfc17e2b15', 91, 'Nicholas', 'Alexander', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('37384438-14ac-4066-9bbe-d15934c64acf', 36, 'Abraham', 'Cole', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('3a116d3b-7468-4fad-a615-a7ed9b8a0ff6', 125, 'poo23', 'makla', '/uploads/profile_pictures/864c9aff-bb10-4969-8cc7-ee6fd864a4bc.jpg', NULL, NULL, NULL, NULL, '2026-01-13 11:39:01', '2026-01-13 11:39:01', NULL, NULL),
('3cd1f40c-dc0f-4955-b473-2d84ab89b73f', 20, 'Miranda', 'Myers', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('3fb74c36-eb37-4d36-8bf7-38118ba0e12a', 79, 'Ryan', 'Ross', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('407b7b25-d201-4e49-8084-52f0a9ab633a', 68, 'Ryan', 'Cunningham', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('40d6c7e2-37cb-437a-90c9-fbb4b2fb1661', 60, 'Edward', 'Moore', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('425d7131-0854-4437-853c-59f2cee9cafb', 124, 'test', 'test', 'avatars/696e9c9a4ad24.jpg', NULL, '', '', '', '2026-01-11 10:20:35', '2026-01-19 21:05:30', '', ''),
('42c9a0c7-be34-4375-a6ae-5006be89ea8f', 49, 'Jacob', 'Morgan', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('4437f3e7-cfb9-4df0-8704-357504968741', 66, 'Kelsey', 'Craig', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('4454ecc1-cc49-419d-9c3c-75c9257b23ec', 70, 'Daisy', 'Russell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('4475d178-1506-43bc-9d1f-0b5df1aacab0', 112, 'N', 'B', NULL, NULL, NULL, NULL, NULL, '2025-12-09 21:57:18', '2025-12-09 21:57:18', NULL, NULL),
('45117b65-3d55-4b61-8feb-5ed7f4c654a9', 88, 'Aldus', 'Casey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('4741084c-90c6-4b0f-a6d5-811f13495825', 25, 'Dainton', 'Tucker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('49b62029-c9fe-48c0-b81a-760f45372054', 7, 'Nicole', 'Barnes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('55e0f49d-5bad-4822-abec-00e5eb51c1c8', 118, 'Tester', '1', '/uploads/profile_pictures/2bcd6b2f-ad73-4950-9ada-b64b27c73a95.png', NULL, NULL, NULL, NULL, '2025-12-17 10:38:16', '2025-12-17 10:38:16', NULL, NULL),
('607876cd-dd91-4689-abf2-0a67dbba2915', 16, 'Sophia', 'Holmes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('627fe270-d240-4f20-a860-7fba390f562c', 34, 'Elise', 'Richardson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('63eca209-eb5c-4d42-b650-3d7526273b1a', 11, 'Leonardo', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6701656c-5a89-4d41-9353-66880f3257f0', 93, 'Lyndon', 'Gray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6813fc4c-9e78-4bf8-a533-ddbef4846429', 72, 'Miley', 'Warren', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('687dad09-5a5b-475a-922c-21f90f99c50b', 81, 'Reid', 'Turner', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6a1e0fb7-4c5f-46c5-877a-9e000a32f358', 17, 'Patrick', 'Casey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6a8d2833-4280-4d20-9a24-8255123e8cda', 83, 'Miller', 'Fowler', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6aaa8d59-1799-4cf4-bbe7-9922f536bff5', 38, 'Rafael', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6b1954e8-0dbf-4c68-b762-4d91e30a6cb9', 65, 'Adrian', 'Wells', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6c4807cc-f0e1-4aef-aff0-075c7c09b1dd', 22, 'Steven', 'Craig', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('6d94f63d-9913-4752-ab7c-f6743f69ed2e', 121, 'Tester', '3', '/uploads/profile_pictures/cdf245bb-05d3-4294-a0da-d0accc718188.png', NULL, NULL, NULL, NULL, '2025-12-17 10:44:52', '2025-12-17 10:44:52', NULL, NULL),
('71d3fbd3-5b31-42e1-bb87-bbc53459ac48', 63, 'Carlos', 'Richardson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('76f9b842-0692-40fb-9893-b336803841ec', 30, 'Nicole', 'Parker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('79927f79-10ca-488a-a34b-34608e3111f9', 31, 'April', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('7b331d60-6522-4a40-acec-940bbee81c89', 82, 'Amelia', 'Parker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('7b92d17d-f6ea-4b34-bdab-c184fc69cc31', 61, 'Kevin', 'Spencer', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('7f2db7f8-dabd-45c2-93ff-8f86796dc552', 73, 'Sydney', 'Mitchell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('7f782e61-5f5c-408b-ac05-9ed5c58698d6', 57, 'Alexia', 'Harper', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('7f9b83fe-3ee9-4a1a-977d-f772697511f3', 95, 'Agata', 'Ryan', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('82f55787-20ca-4552-9549-9f9fd4f24243', 100, 'Darcy', 'Phillips', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('832794de-0511-4d24-9aa1-1d20d6c9ff78', 103, 'Michael', 'Myers', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('83290a01-a6c3-4e36-802e-dec89b0a8c43', 99, 'Violet', 'Walker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('83710363-2633-4264-8987-5600e20c1254', 105, 'Alina', 'Craig', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('8490dc56-8e97-4278-b84a-aac06a4595eb', 50, 'Deanna', 'Fowler', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('8b6e6fe5-0ff8-4fe7-b0ee-1371ec349bbb', 119, 'Admin', 'Demo', NULL, NULL, NULL, NULL, NULL, '2025-12-17 10:39:05', '2025-12-17 10:39:05', NULL, NULL),
('8f4fe2e2-e42b-4bae-9953-6f72a9e6b1ea', 35, 'Stuart', 'Anderson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('91484a59-2820-4572-94a4-60329b5c898f', 21, 'Justin', 'Morrison', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9419f24d-9875-4a88-a059-616d5261c67e', 33, 'Alen', 'Foster', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9463d8c6-fbf8-48d3-aa49-7edf12b531f8', 1, 'ADMIN', 'ADMINSON', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9a9ba8e0-2ad6-4840-8755-2515765385f0', 86, 'Garry', 'Myers', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9c876b21-4e7f-4eb0-8f0c-ac2ca8c0bf34', 23, 'Honey', 'Edwards', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9cde0988-2517-4e85-bf51-e808beb2ee22', 71, 'Kellan', 'Edwards', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9cec3df4-b8c5-48e5-8b31-a6f15edd152e', 87, 'Rafael', 'Tucker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9d6ad805-dabc-487c-b6d4-095f3e7faccb', 53, 'Ellia', 'Martin', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9ed79eb6-91f0-4279-aa08-34cc7dd4528c', 80, 'Daisy', 'Baker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('9f189f5a-a1f7-484c-b50f-718f2bf89061', 96, 'Emily', 'Jones', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a198dd45-7df8-45a3-87c9-9dccdb500f26', 39, 'Alfred', 'Mason', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a1f7c2d2-ebbe-4bfa-8def-96b0aba7e543', 64, 'Alissa', 'Murray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a210715b-ab0c-49ab-b37f-54787f7bc76a', 59, 'Lucy', 'Montgomery', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a26a1ad6-fabb-491d-91b8-bf42e94ebfd1', 24, 'Alfred', 'Douglas', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a42443d3-70fe-47e7-a10b-49c3c7272e96', 12, 'Arthur', 'Hall', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a45b64c2-81d7-4887-afdb-17d88a69c8af', 97, 'Jordan', 'Hamilton', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a6f27d29-4a13-453c-a281-2e387a736868', 94, 'Elise', 'Murphy', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a703687c-fc58-4449-a400-0d0ae477ad52', 77, 'Eric', 'Johnston', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('a8803f2c-cec4-49ce-ac84-aa37a14ce458', 89, 'Jared', 'Morrison', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('ac6323d9-893a-4c0a-a733-fb8354a1b623', 67, 'Amber', 'Montgomery', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('b1208357-c1d3-4529-a803-bbc06cf08035', 120, 'Tester', '2', '/uploads/profile_pictures/04a27c19-28d2-44ea-878b-286e8c847868.png', NULL, NULL, NULL, NULL, '2025-12-17 10:39:45', '2025-12-17 10:39:45', NULL, NULL),
('b2ae7561-d56f-498a-9d69-cf194dde8a35', 27, 'Mike', 'Moore', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('b429f253-cee8-45ce-81b7-e5acf8f4eebb', 4, 'ARIF', 'TUPLE', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('b622405e-4ed5-4256-91de-8f3942e778ee', 26, 'Penelope', 'Thomas', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('bdf11e6d-f0df-4c19-940d-67347d395911', 85, 'Adelaide', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('be0267ae-304e-40a7-949a-50bbec15936e', 2, 'ALEKSANDRE', 'TEST', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('be8aefa6-78a6-49af-94b8-e240ad313c81', 107, 'test', 'test', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('bea6d221-5cb6-462f-b14d-66e36a056dbd', 15, 'Victoria', 'Morris', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('bf3f11b4-e104-4c29-a73a-b8139a7afc75', 47, 'Rubie', 'Morrison', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('c2bc6777-4f25-4e2b-bf67-86726508a709', 90, 'Garry', 'Jones', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('c6b62737-c60d-4a17-98d4-2af851a9279c', 18, 'Adison', 'Barnes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('c8633364-e226-4946-ae0c-2c33b7e4681e', 29, 'Catherine', 'Lloyd', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('cc20f470-d0fa-4e78-a1bb-d28df5a4f5a4', 128, 'mal', 'mal', NULL, NULL, NULL, NULL, NULL, '2026-01-20 09:01:56', '2026-01-20 09:01:56', NULL, NULL),
('cc59fea3-0f51-4734-8912-497ad38c2df1', 13, 'Amy', 'Higgins', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('cdd6f3ec-bb8e-4b29-9741-cd360a352181', 32, 'Spike', 'Farrell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('ce913a09-7bf9-45b0-a507-8e51d35d0be7', 126, 'kakakl', 'opop', '/uploads/profile_pictures/725c6601-c1c0-4a96-a102-5a7618e3547c.jpeg', NULL, NULL, NULL, NULL, '2026-01-13 11:41:10', '2026-01-13 11:41:10', NULL, NULL),
('cef8637f-5422-4089-9b2f-fb869408720f', 102, 'Michelle', 'Hawkins', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('cfb67e61-3de6-470f-b758-72862fa0cda2', 54, 'Ryan', 'Bailey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('d1c2de54-53ea-4d93-ad65-1ad338808a8b', 106, 'Nikola', 'Baretic', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('d44b4cdf-91b1-4d13-93db-0aff09c3b3e2', 84, 'Martin', 'Ryan', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('d57dc4f3-cb55-4016-890c-1d42fb397c5f', 76, 'Adele', 'Reed', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('d5ef263d-8c25-4432-984e-9e6cf79836e6', 19, 'Violet', 'Owens', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('dbd65d6b-925f-4c27-a7da-792494ca25c4', 62, 'Vanessa', 'Ferguson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('dbf85fbd-7a28-4574-bfa7-6517fd3f64b6', 48, 'Jordan', 'Andrews', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('ddb8147f-6323-4be0-b6a3-67e0b16f2a46', 101, 'Alexander', 'Mitchell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('e01d9e90-261e-4a75-95f9-31a3acd70758', 75, 'Tyler', 'Bennett', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('e0af6061-f210-491b-9205-b20b07520095', 46, 'Dexter', 'Martin', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('e2b4427d-b619-4fea-972d-68996aed4df7', 9, 'Frederick', 'Wilson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('e8d526f8-1274-4aca-afc6-bb9ecff78fda', 45, 'Steven', 'Crawford', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('eaa50618-cb38-42a3-9ed4-f5f04a6e8c01', 52, 'Stella', 'Bailey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('eb0a7e62-b629-4510-a91b-38ff24b640ac', 98, 'Maximilian', 'Johnson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('ec345aad-8c4c-464c-8267-d9ffe8da8990', 58, 'Dale', 'Miller', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('ee637bb3-8f78-4436-8d21-52c6f543070f', 110, 'Nikola', 'Batre', NULL, NULL, NULL, NULL, NULL, '2025-12-08 01:01:52', '2025-12-08 01:01:52', NULL, NULL),
('ee8aa2d6-8f66-456d-a4c4-4285f5b6c3ed', 56, 'Maya', 'Roberts', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('eecde76a-9fd1-4299-a898-f54fe6c2af80', 92, 'Abigail', 'Spencer', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('f25392bf-47c6-4039-91de-4462a2d5edfb', 43, 'Nicholas', 'Scott', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('f4343da9-11c0-40f9-9fe7-ad6efd1f492d', 8, 'Penelope', 'Farrell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('f5aa2129-f01c-45d5-9709-84c6e66c7bdf', 40, 'Adrian', 'Brown', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('faf42ca6-e476-4990-864f-968ea798484d', 116, 'aaaa', 'aaaaa', NULL, NULL, NULL, NULL, NULL, '2025-12-11 14:12:29', '2025-12-11 14:12:29', NULL, NULL),
('fb594dc6-c736-423d-ad0f-63ff7fefa338', 55, 'Kristian', 'Taylor', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('fd430601-9895-4cc7-90c1-67733be8a5a6', 41, 'Stella', 'Ross', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL),
('ffd2e4dd-d3d5-4681-bd6b-bf9f0d44ce15', 51, 'Adrianna', 'Tucker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_key` (`email`);

--
-- Indexes for table `application_cancellations`
--
ALTER TABLE `application_cancellations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_id` (`application_id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `attribute_code_key` (`name`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_application_fk` (`application_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chats_application_id_key` (`application_id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_chat_idx` (`chat_id`,`created_at`),
  ADD KEY `ix_msg_sender_profile` (`sender_profile_id`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_favorite` (`profile_id`,`listing_id`),
  ADD KEY `listing_id` (`listing_id`);

--
-- Indexes for table `legal_content`
--
ALTER TABLE `legal_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ix_listing_host_profile` (`host_profile_id`),
  ADD KEY `listings_city_idx` (`city`),
  ADD KEY `listings_host_status` (`status`),
  ADD KEY `listings_status_city` (`status`,`city`),
  ADD KEY `listings_status_idx` (`status`);

--
-- Indexes for table `listing_application`
--
ALTER TABLE `listing_application`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_active_app_per_user_listing` (`listing_id`,`active_applicant_id`),
  ADD KEY `ix_la_applicant_profile` (`applicant_profile_id`),
  ADD KEY `la_applicant_status_updated` (`applicant_id`,`status`,`updated_at`),
  ADD KEY `la_listing_status` (`listing_id`,`status`),
  ADD KEY `listing_applications_applicant_idx` (`applicant_id`),
  ADD KEY `listing_applications_listing_idx` (`listing_id`);

--
-- Indexes for table `listing_attribute`
--
ALTER TABLE `listing_attribute`
  ADD PRIMARY KEY (`listing_id`,`attribute_id`),
  ADD KEY `listing_attributes_attribute_id_fkey` (`attribute_id`);

--
-- Indexes for table `listing_availability`
--
ALTER TABLE `listing_availability`
  ADD PRIMARY KEY (`id`),
  ADD KEY `listing_availability_listing_id_fkey` (`listing_id`);

--
-- Indexes for table `listing_image`
--
ALTER TABLE `listing_image`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `listing_images_pos_uq` (`listing_id`,`position`);

--
-- Indexes for table `listing_service`
--
ALTER TABLE `listing_service`
  ADD PRIMARY KEY (`listing_id`,`service_id`),
  ADD KEY `listing_service_service_id_fkey` (`service_id`);

--
-- Indexes for table `listing_verification_document`
--
ALTER TABLE `listing_verification_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lvd_listing_idx` (`listing_id`);

--
-- Indexes for table `negotiation`
--
ALTER TABLE `negotiation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `proposer_profile_id` (`proposer_profile_id`),
  ADD KEY `idx_application` (`application_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_read` (`user_id`,`is_read`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_token` (`token`),
  ADD KEY `idx_expires` (`expires_at`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reporter_id` (`reporter_id`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_type_id` (`reported_type`,`reported_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_document`
--
ALTER TABLE `user_document`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_userdoc_account` (`account_id`),
  ADD KEY `fk_userdoc_document_type` (`document_type_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_type`
--
ALTER TABLE `document_type`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `legal_content`
--
ALTER TABLE `legal_content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_cancellations`
--
ALTER TABLE `application_cancellations`
  ADD CONSTRAINT `application_cancellations_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `listing_application` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_application_fk` FOREIGN KEY (`application_id`) REFERENCES `listing_application` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chats_application_id_fkey` FOREIGN KEY (`application_id`) REFERENCES `listing_application` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD CONSTRAINT `chat_messages_chat_id_fkey` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_msg_sender_profile` FOREIGN KEY (`sender_profile_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `favorite_ibfk_1` FOREIGN KEY (`profile_id`) REFERENCES `user_profile` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorite_ibfk_2` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `fk_listing_host_profile` FOREIGN KEY (`host_profile_id`) REFERENCES `user_profile` (`id`);

--
-- Constraints for table `listing_application`
--
ALTER TABLE `listing_application`
  ADD CONSTRAINT `fk_la_applicant_profile` FOREIGN KEY (`applicant_profile_id`) REFERENCES `user_profile` (`id`),
  ADD CONSTRAINT `listing_applications_applicant_id_fkey` FOREIGN KEY (`applicant_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listing_applications_listing_id_fkey` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_attribute`
--
ALTER TABLE `listing_attribute`
  ADD CONSTRAINT `listing_attributes_attribute_id_fkey` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`),
  ADD CONSTRAINT `listing_attributes_listing_id_fkey` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_availability`
--
ALTER TABLE `listing_availability`
  ADD CONSTRAINT `listing_availability_listing_id_fkey` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_image`
--
ALTER TABLE `listing_image`
  ADD CONSTRAINT `listing_images_listing_id_fkey` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_service`
--
ALTER TABLE `listing_service`
  ADD CONSTRAINT `listing_service_listing_id_fkey` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listing_service_service_id_fkey` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `listing_verification_document`
--
ALTER TABLE `listing_verification_document`
  ADD CONSTRAINT `listing_verification_documents_listing_id_fkey` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `negotiation`
--
ALTER TABLE `negotiation`
  ADD CONSTRAINT `negotiation_ibfk_1` FOREIGN KEY (`application_id`) REFERENCES `listing_application` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `negotiation_ibfk_2` FOREIGN KEY (`proposer_profile_id`) REFERENCES `user_profile` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD CONSTRAINT `password_resets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`reporter_id`) REFERENCES `user_profile` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `user_document`
--
ALTER TABLE `user_document`
  ADD CONSTRAINT `fk_userdoc_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_userdoc_document_type` FOREIGN KEY (`document_type_id`) REFERENCES `document_type` (`id`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `fk_profile_account` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
