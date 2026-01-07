-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 11, 2025 at 01:47 PM
-- Server version: 8.0.44
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nest-test-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` bigint UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected','suspended') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_status_until` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` enum('student','moderator','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'student',
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `status`, `email`, `password_hash`, `student_status_until`, `created_at`, `role`, `dob`) VALUES
(1, 'approved', 'ADMIN@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(2, 'approved', 'ONE@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(3, 'approved', 'THREE@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(4, 'approved', 'TWO@EXAMPLE.COM', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(5, 'approved', 'tony.murray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(7, 'approved', 'nicole.barnes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(8, 'approved', 'penelope.farrell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(9, 'approved', 'frederick.wilson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(10, 'approved', 'george.holmes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(11, 'approved', 'leonardo.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(12, 'approved', 'arthur.hall@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(13, 'approved', 'amy.higgins@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(14, 'approved', 'henry.murray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(15, 'approved', 'victoria.morris@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(16, 'approved', 'sophia.holmes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(17, 'approved', 'patrick.casey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(18, 'approved', 'adison.barnes@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(19, 'approved', 'violet.owens@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(20, 'approved', 'miranda.myers@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(21, 'approved', 'justin.morrison@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(22, 'approved', 'steven.craig@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(23, 'approved', 'honey.edwards@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(24, 'approved', 'alfred.douglas@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(25, 'approved', 'dainton.tucker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(26, 'approved', 'penelope.thomas@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(27, 'approved', 'mike.moore@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(28, 'approved', 'roman.wright@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(29, 'approved', 'catherine.lloyd@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(30, 'approved', 'nicole.parker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(31, 'approved', 'april.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(32, 'approved', 'spike.farrell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(33, 'approved', 'alen.foster@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(34, 'approved', 'elise.richardson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(35, 'approved', 'stuart.anderson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(36, 'approved', 'abraham.cole@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(37, 'approved', 'miranda.perry@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(38, 'approved', 'rafael.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(39, 'approved', 'alfred.mason@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(40, 'approved', 'adrian.brown@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(41, 'approved', 'stella.ross@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(42, 'approved', 'adam.gray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(43, 'approved', 'nicholas.scott@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(44, 'approved', 'marcus.roberts@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(45, 'approved', 'steven.crawford@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(46, 'approved', 'dexter.martin@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(47, 'approved', 'rubie.morrison@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(48, 'approved', 'jordan.andrews@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(49, 'approved', 'jacob.morgan@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(50, 'approved', 'deanna.fowler@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(51, 'approved', 'adrianna.tucker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(52, 'approved', 'stella.bailey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(53, 'approved', 'ellia.martin@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(54, 'approved', 'ryan.bailey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(55, 'approved', 'kristian.taylor@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(56, 'approved', 'maya.roberts@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(57, 'approved', 'alexia.harper@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(58, 'approved', 'dale.miller@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(59, 'approved', 'lucy.montgomery@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(60, 'approved', 'edward.moore@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(61, 'approved', 'kevin.spencer@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(62, 'approved', 'vanessa.ferguson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(63, 'approved', 'carlos.richardson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(64, 'approved', 'alissa.murray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(65, 'approved', 'adrian.wells@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(66, 'approved', 'kelsey.craig@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(67, 'approved', 'amber.montgomery@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(68, 'approved', 'ryan.cunningham@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(69, 'approved', 'lucy.chapman@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(70, 'approved', 'daisy.russell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(71, 'approved', 'kellan.edwards@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(72, 'approved', 'miley.warren@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(73, 'approved', 'sydney.mitchell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(74, 'approved', 'penelope.russell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(75, 'approved', 'tyler.bennett@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(76, 'approved', 'adele.reed@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(77, 'approved', 'eric.johnston@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(78, 'approved', 'deanna.phillips@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(79, 'approved', 'ryan.ross@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(80, 'approved', 'daisy.baker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(81, 'approved', 'reid.turner@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(82, 'approved', 'amelia.parker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(83, 'approved', 'miller.fowler@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(84, 'approved', 'martin.ryan@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(85, 'approved', 'adelaide.clark@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(86, 'approved', 'garry.myers@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(87, 'approved', 'rafael.tucker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(88, 'approved', 'aldus.casey@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(89, 'approved', 'jared.morrison@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(90, 'approved', 'garry.jones@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(91, 'approved', 'nicholas.alexander@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(92, 'approved', 'abigail.spencer@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(93, 'approved', 'lyndon.gray@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(94, 'approved', 'elise.murphy@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(95, 'approved', 'agata.ryan@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(96, 'approved', 'emily.jones@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(97, 'approved', 'jordan.hamilton@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(98, 'approved', 'maximilian.johnson@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(99, 'approved', 'violet.walker@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(100, 'approved', 'darcy.phillips@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(101, 'approved', 'alexander.mitchell@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(102, 'approved', 'michelle.hawkins@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(103, 'approved', 'michael.myers@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(104, 'approved', 'ted.fowler@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(105, 'approved', 'alina.craig@gmail.com', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(106, 'approved', 'nikolabaretic@eleve.isep.fr', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(107, 'approved', 'test@eleve.isep.fr', 'hash', NULL, '2025-12-07 17:55:16', 'student', NULL),
(108, 'pending', 'nikaosdk@gmail.com', '$2y$12$6KImNTywAO06w4VNGxqjfeOPhUSWy5W9bvZJ5Q6eheBjOpNzoFEGq', NULL, '2025-12-07 23:58:20', 'student', NULL),
(109, 'approved', 'nikola@ll.com', '$2y$12$0j06Aq62UoS1LRrdYEcuyu54SeKtQLw8jzMBWLZGq6GFuDkXR6Wju', '2026-04-25', '2025-12-08 00:46:23', 'student', NULL),
(110, 'pending', 'nikila@ll.com', '$2y$12$8nGFU4PIzgvUFZSH5aewGOczHP170lyyTeyVeZaSaceOLQ5pKZPjW', '2026-04-25', '2025-12-08 01:01:52', 'student', NULL),
(111, 'pending', 'nikaila@ll.com', '$2y$12$iA6zblThOGrBrfQoWiW1j.NtZ8KGNH2NegSmLAGmVgI.aWZ0n8bre', '2026-04-25', '2025-12-08 01:03:26', 'student', NULL),
(112, 'pending', 'nikola@gmail.com', '$2y$12$ERNQPPMDwTwCAvrObjA9bugSt6VJL4jKSfZvBsan0QDPWc/C6vA.y', '2026-01-31', '2025-12-09 21:57:18', 'student', NULL),
(113, 'approved', 'nikolanikola@gmail.com', '$2y$12$8PddFOdwezqnpVzhRMluBuCbXW4nA4bJYER8J3w06F1E5tD01RQ.a', '2026-04-18', '2025-12-10 10:15:40', 'student', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `id` smallint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
  `listing_review` text COLLATE utf8mb4_unicode_ci,
  `listing_rating` int DEFAULT NULL,
  `guest_review` text COLLATE utf8mb4_unicode_ci,
  `guest_rating` int DEFAULT NULL,
  `application_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci DEFAULT NULL
) ;

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
('2dd6d054-bfc5-11f0-a648-52f5d85831eb', '2dd478f4-bfc5-11f0-a648-52f5d85831eb', '2025-11-12 11:43:24', '2025-11-12 11:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `chat_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `sender_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ok','reported') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`id`, `chat_id`, `sender_id`, `sender_profile_id`, `content`, `status`, `created_at`) VALUES
('2dd9031a-bfc5-11f0-a648-52f5d85831eb', '2dd6d054-bfc5-11f0-a648-52f5d85831eb', 3, '236a8940-1475-48c4-a793-2e67c005bba8', 'Hello, is this still available?', 'ok', '2025-11-12 11:43:24');

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `id` smallint UNSIGNED NOT NULL,
  `document_type_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
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
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `host_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `room_type` enum('room','whole_apartment') COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_guests` int DEFAULT NULL,
  `host_role` enum('owner','renter') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published','paused','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `listing`
--

INSERT INTO `listing` (`id`, `host_profile_id`, `title`, `description`, `country`, `city`, `address_line`, `latitude`, `longitude`, `room_type`, `max_guests`, `host_role`, `status`, `created_at`, `updated_at`) VALUES
('229a6ed6-48cf-40f0-8fbe-9838cec23827', '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaaa test', 'korzo rijeka korzo rijeka korzo', 'Croatia', 'Rijeka', 'Korzo 1', 45.3258553, 14.443607, 'whole_apartment', 5, 'renter', 'published', '2025-12-10 10:57:28', '2025-12-10 10:58:39'),
('27275c1f-d439-4ca7-a1ff-9ea68853388f', '357e760a-d08c-4078-be80-b6d8c819f56a', 'test test', 'description description description jaajjaslaksksksdk', 'Croatia', 'Zagreb', 'Unska ulica 3', NULL, NULL, 'whole_apartment', 3, 'owner', 'published', '2025-12-10 10:31:14', '2025-12-10 10:45:18'),
('2a0687b5-f039-4509-9a84-6e16e297c64a', '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaaaaaa', 'ajsdajksd aj dka dkjadjka dska jkd', 'France', 'Paris', '5 Av. des Champs-Élysées', 48.8683306, 2.312152, 'whole_apartment', 5, 'renter', 'draft', '2025-12-10 11:36:49', '2025-12-10 11:36:49'),
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 'be0267ae-304e-40a7-949a-50bbec15936e', 'STUDIO NEAR CAMPUS', 'A BRIGHT SUNNY STUDIO APARTMENT PERFECT FOR A STUDENT. 10 MINUTES WALK FROM THE MAIN CAMPUS.', 'FRANCE', 'PARIS', '123 ISSY', 48.8566, 2.3522, 'room', 1, 'owner', 'published', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 'b429f253-cee8-45ce-81b7-e5acf8f4eebb', 'SHARED APARTMENT', 'A ROOM IN A 2 BEDROOM SHARED APARTMENT. CLOSE TO TRANSPORTATION', 'FRANCE', 'CALAIS', '456 RUE DE BAC', 50.9513, 1.8587, 'room', 2, 'renter', 'published', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 'be0267ae-304e-40a7-949a-50bbec15936e', 'DRAFT LISTING', 'THIS IS NOT FINISHED', 'GERMANY', 'BERLIN', NULL, NULL, NULL, 'whole_apartment', 4, 'owner', 'draft', '2025-11-12 11:43:24', '2025-11-12 11:43:24'),
('331d2b70-bfd0-11f0-a648-52f5d85831eb', '9463d8c6-fbf8-48d3-aa49-7edf12b531f8', 'ADMIN ADMINSON • Student Stay', 'Comfortable room hosted by ADMIN ADMINSON in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '101 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d44fc-bfd0-11f0-a648-52f5d85831eb', 'be0267ae-304e-40a7-949a-50bbec15936e', 'ALEKSANDRE TEST • Student Stay', 'Comfortable room hosted by ALEKSANDRE TEST in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '102 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d460a-bfd0-11f0-a648-52f5d85831eb', '236a8940-1475-48c4-a793-2e67c005bba8', 'SURESH TESTER • Student Stay', 'Comfortable apartment hosted by SURESH TESTER in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '103 GRAND PLACE', 50.8647, 4.3689, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d46a0-bfd0-11f0-a648-52f5d85831eb', 'b429f253-cee8-45ce-81b7-e5acf8f4eebb', 'ARIF TUPLE • Student Stay', 'Comfortable room hosted by ARIF TUPLE in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '104 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 1, 'owner', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d47cc-bfd0-11f0-a648-52f5d85831eb', '32bba3a2-6ecb-4411-9e9d-a56238de5cf4', 'TONY MURRAY • Student Stay', 'Comfortable room hosted by Tony Murray in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '105 RUE DES ECOLES', 48.8745, 2.3815, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4862-bfd0-11f0-a648-52f5d85831eb', '49b62029-c9fe-48c0-b81a-760f45372054', 'NICOLE BARNES • Student Stay', 'Comfortable room hosted by Nicole Barnes in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '107 KEIZERSGRACHT', 52.37, 4.9, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d48e4-bfd0-11f0-a648-52f5d85831eb', 'f4343da9-11c0-40f9-9fe7-ad6efd1f492d', 'PENELOPE FARRELL • Student Stay', 'Comfortable room hosted by Penelope Farrell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '108 GRAND PLACE', 50.8549, 4.3563, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4966-bfd0-11f0-a648-52f5d85831eb', 'e2b4427d-b619-4fea-972d-68996aed4df7', 'FREDERICK WILSON • Student Stay', 'Comfortable apartment hosted by Frederick Wilson in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '109 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'whole_apartment', 2, 'renter', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d49f2-bfd0-11f0-a648-52f5d85831eb', '20125d2e-2aa5-4d46-85d8-d0b7e295f270', 'GEORGE HOLMES • Student Stay', 'Comfortable room hosted by George Holmes in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '110 RUE DES ECOLES', 48.8647, 2.3689, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4a6a-bfd0-11f0-a648-52f5d85831eb', '63eca209-eb5c-4d42-b650-3d7526273b1a', 'LEONARDO CLARK • Student Stay', 'Comfortable room hosted by Leonardo Clark in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '111 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4aec-bfd0-11f0-a648-52f5d85831eb', 'a42443d3-70fe-47e7-a10b-49c3c7272e96', 'ARTHUR HALL • Student Stay', 'Comfortable apartment hosted by Arthur Hall in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '112 KEIZERSGRACHT', 52.3945, 4.9315, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4b6e-bfd0-11f0-a648-52f5d85831eb', 'cc59fea3-0f51-4734-8912-497ad38c2df1', 'AMY HIGGINS • Student Stay', 'Comfortable room hosted by Amy Higgins in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '113 GRAND PLACE', 50.8794, 4.3878, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4c18-bfd0-11f0-a648-52f5d85831eb', '179593fe-5eea-4740-bd77-549fc4a015ed', 'HENRY MURRAY • Student Stay', 'Comfortable room hosted by Henry Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '114 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4c9a-bfd0-11f0-a648-52f5d85831eb', 'bea6d221-5cb6-462f-b14d-66e36a056dbd', 'VICTORIA MORRIS • Student Stay', 'Comfortable apartment hosted by Victoria Morris in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '115 RUE DES ECOLES', 48.8549, 2.3563, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4d12-bfd0-11f0-a648-52f5d85831eb', '607876cd-dd91-4689-abf2-0a67dbba2915', 'SOPHIA HOLMES • Student Stay', 'Comfortable room hosted by Sophia Holmes in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '116 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 1, 'owner', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4d8a-bfd0-11f0-a648-52f5d85831eb', '6a1e0fb7-4c5f-46c5-877a-9e000a32f358', 'PATRICK CASEY • Student Stay', 'Comfortable room hosted by Patrick Casey in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '117 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4e0c-bfd0-11f0-a648-52f5d85831eb', 'c6b62737-c60d-4a17-98d4-2af851a9279c', 'ADISON BARNES • Student Stay', 'Comfortable apartment hosted by Adison Barnes in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '118 GRAND PLACE', 50.8696, 4.3752, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4e84-bfd0-11f0-a648-52f5d85831eb', 'd5ef263d-8c25-4432-984e-9e6cf79836e6', 'VIOLET OWENS • Student Stay', 'Comfortable room hosted by Violet Owens in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '119 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4efc-bfd0-11f0-a648-52f5d85831eb', '3cd1f40c-dc0f-4955-b473-2d84ab89b73f', 'MIRANDA MYERS • Student Stay', 'Comfortable room hosted by Miranda Myers in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '120 RUE DES ECOLES', 48.8794, 2.3878, 'room', 1, 'owner', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d4ff6-bfd0-11f0-a648-52f5d85831eb', '91484a59-2820-4572-94a4-60329b5c898f', 'JUSTIN MORRISON • Student Stay', 'Comfortable apartment hosted by Justin Morrison in BERLIN. Host account status: REJECTED.', 'GERMANY', 'BERLIN', '121 ALEXANDERPLATZ', 52.52, 13.405, 'whole_apartment', 2, 'renter', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5078-bfd0-11f0-a648-52f5d85831eb', '6c4807cc-f0e1-4aef-aff0-075c7c09b1dd', 'STEVEN CRAIG • Student Stay', 'Comfortable room hosted by Steven Craig in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '122 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d50f0-bfd0-11f0-a648-52f5d85831eb', '9c876b21-4e7f-4eb0-8f0c-ac2ca8c0bf34', 'HONEY EDWARDS • Student Stay', 'Comfortable room hosted by Honey Edwards in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '123 GRAND PLACE', 50.8598, 4.3626, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5172-bfd0-11f0-a648-52f5d85831eb', 'a26a1ad6-fabb-491d-91b8-bf42e94ebfd1', 'ALFRED DOUGLAS • Student Stay', 'Comfortable apartment hosted by Alfred Douglas in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '124 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5258-bfd0-11f0-a648-52f5d85831eb', '4741084c-90c6-4b0f-a6d5-811f13495825', 'DAINTON TUCKER • Student Stay', 'Comfortable room hosted by Dainton Tucker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '125 RUE DES ECOLES', 48.8696, 2.3752, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d52da-bfd0-11f0-a648-52f5d85831eb', 'b622405e-4ed5-4256-91de-8f3942e778ee', 'PENELOPE THOMAS • Student Stay', 'Comfortable room hosted by Penelope Thomas in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '126 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5352-bfd0-11f0-a648-52f5d85831eb', 'b2ae7561-d56f-498a-9d69-cf194dde8a35', 'MIKE MOORE • Student Stay', 'Comfortable apartment hosted by Mike Moore in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '127 KEIZERSGRACHT', 52.3994, 4.9378, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d53ca-bfd0-11f0-a648-52f5d85831eb', '0b23e575-89c4-46d0-bb77-91d3d7700365', 'ROMAN WRIGHT • Student Stay', 'Comfortable room hosted by Roman Wright in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '128 GRAND PLACE', 50.85, 4.35, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5442-bfd0-11f0-a648-52f5d85831eb', 'c8633364-e226-4946-ae0c-2c33b7e4681e', 'CATHERINE LLOYD • Student Stay', 'Comfortable room hosted by Catherine Lloyd in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '129 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 2, 'renter', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d54d8-bfd0-11f0-a648-52f5d85831eb', '76f9b842-0692-40fb-9893-b336803841ec', 'NICOLE PARKER • Student Stay', 'Comfortable apartment hosted by Nicole Parker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '130 RUE DES ECOLES', 48.8598, 2.3626, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d555a-bfd0-11f0-a648-52f5d85831eb', '79927f79-10ca-488a-a34b-34608e3111f9', 'APRIL CLARK • Student Stay', 'Comfortable room hosted by April Clark in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '131 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 4, 'renter', 'paused', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d55dc-bfd0-11f0-a648-52f5d85831eb', 'cdd6f3ec-bb8e-4b29-9741-cd360a352181', 'SPIKE FARRELL • Student Stay', 'Comfortable room hosted by Spike Farrell in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '132 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 1, 'owner', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d565e-bfd0-11f0-a648-52f5d85831eb', '9419f24d-9875-4a88-a059-616d5261c67e', 'ALEN FOSTER • Student Stay', 'Comfortable apartment hosted by Alen Foster in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '133 GRAND PLACE', 50.8745, 4.3815, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d56d6-bfd0-11f0-a648-52f5d85831eb', '627fe270-d240-4f20-a860-7fba390f562c', 'ELISE RICHARDSON • Student Stay', 'Comfortable room hosted by Elise Richardson in BARCELONA. Host account status: SUSPENDED.', 'SPAIN', 'BARCELONA', '134 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 3, 'owner', 'paused', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5758-bfd0-11f0-a648-52f5d85831eb', '8f4fe2e2-e42b-4bae-9953-6f72a9e6b1ea', 'STUART ANDERSON • Student Stay', 'Comfortable room hosted by Stuart Anderson in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '135 RUE DES ECOLES', 48.85, 2.35, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d57d0-bfd0-11f0-a648-52f5d85831eb', '37384438-14ac-4066-9bbe-d15934c64acf', 'ABRAHAM COLE • Student Stay', 'Comfortable apartment hosted by Abraham Cole in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '136 ALEXANDERPLATZ', 52.5249, 13.4113, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5848-bfd0-11f0-a648-52f5d85831eb', '34b2bb02-8adc-446c-b219-466627542292', 'MIRANDA PERRY • Student Stay', 'Comfortable room hosted by Miranda Perry in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '137 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d58c0-bfd0-11f0-a648-52f5d85831eb', '6aaa8d59-1799-4cf4-bbe7-9922f536bff5', 'RAFAEL CLARK • Student Stay', 'Comfortable room hosted by Rafael Clark in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '138 GRAND PLACE', 50.8647, 4.3689, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5942-bfd0-11f0-a648-52f5d85831eb', 'a198dd45-7df8-45a3-87c9-9dccdb500f26', 'ALFRED MASON • Student Stay', 'Comfortable apartment hosted by Alfred Mason in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '139 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d59ba-bfd0-11f0-a648-52f5d85831eb', 'f5aa2129-f01c-45d5-9709-84c6e66c7bdf', 'ADRIAN BROWN • Student Stay', 'Comfortable room hosted by Adrian Brown in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '140 RUE DES ECOLES', 48.8745, 2.3815, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5a82-bfd0-11f0-a648-52f5d85831eb', 'fd430601-9895-4cc7-90c1-67733be8a5a6', 'STELLA ROSS • Student Stay', 'Comfortable room hosted by Stella Ross in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '141 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 2, 'renter', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5b04-bfd0-11f0-a648-52f5d85831eb', '2a6621b7-a0d2-403b-ac83-3c8f3944bfbf', 'ADAM GRAY • Student Stay', 'Comfortable apartment hosted by Adam Gray in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '142 KEIZERSGRACHT', 52.37, 4.9, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5b86-bfd0-11f0-a648-52f5d85831eb', 'f25392bf-47c6-4039-91de-4462a2d5edfb', 'NICHOLAS SCOTT • Student Stay', 'Comfortable room hosted by Nicholas Scott in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '143 GRAND PLACE', 50.8549, 4.3563, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5bfe-bfd0-11f0-a648-52f5d85831eb', '13783aeb-eab3-4feb-8cc4-63088c54af33', 'MARCUS ROBERTS • Student Stay', 'Comfortable room hosted by Marcus Roberts in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '144 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5c80-bfd0-11f0-a648-52f5d85831eb', 'e8d526f8-1274-4aca-afc6-bb9ecff78fda', 'STEVEN CRAWFORD • Student Stay', 'Comfortable apartment hosted by Steven Crawford in PARIS. Host account status: PENDING.', 'FRANCE', 'PARIS', '145 RUE DES ECOLES', 48.8647, 2.3689, 'whole_apartment', 2, 'renter', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5cf8-bfd0-11f0-a648-52f5d85831eb', 'e0af6061-f210-491b-9205-b20b07520095', 'DEXTER MARTIN • Student Stay', 'Comfortable room hosted by Dexter Martin in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '146 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5d7a-bfd0-11f0-a648-52f5d85831eb', 'bf3f11b4-e104-4c29-a73a-b8139a7afc75', 'RUBIE MORRISON • Student Stay', 'Comfortable room hosted by Rubie Morrison in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '147 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5df2-bfd0-11f0-a648-52f5d85831eb', 'dbf85fbd-7a28-4574-bfa7-6517fd3f64b6', 'JORDAN ANDREWS • Student Stay', 'Comfortable apartment hosted by Jordan Andrews in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '148 GRAND PLACE', 50.8794, 4.3878, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5e74-bfd0-11f0-a648-52f5d85831eb', '42c9a0c7-be34-4375-a6ae-5006be89ea8f', 'JACOB MORGAN • Student Stay', 'Comfortable room hosted by Jacob Morgan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '149 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5eec-bfd0-11f0-a648-52f5d85831eb', '8490dc56-8e97-4278-b84a-aac06a4595eb', 'DEANNA FOWLER • Student Stay', 'Comfortable room hosted by Deanna Fowler in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '150 RUE DES ECOLES', 48.8549, 2.3563, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5f64-bfd0-11f0-a648-52f5d85831eb', 'ffd2e4dd-d3d5-4681-bd6b-bf9f0d44ce15', 'ADRIANNA TUCKER • Student Stay', 'Comfortable apartment hosted by Adrianna Tucker in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '151 ALEXANDERPLATZ', 52.5298, 13.4176, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d5fdc-bfd0-11f0-a648-52f5d85831eb', 'eaa50618-cb38-42a3-9ed4-f5f04a6e8c01', 'STELLA BAILEY • Student Stay', 'Comfortable room hosted by Stella Bailey in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '152 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 1, 'owner', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d605e-bfd0-11f0-a648-52f5d85831eb', '9d6ad805-dabc-487c-b6d4-095f3e7faccb', 'ELLIA MARTIN • Student Stay', 'Comfortable room hosted by Ellia Martin in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '153 GRAND PLACE', 50.8696, 4.3752, 'room', 2, 'renter', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d60e0-bfd0-11f0-a648-52f5d85831eb', 'cfb67e61-3de6-470f-b758-72862fa0cda2', 'RYAN BAILEY • Student Stay', 'Comfortable apartment hosted by Ryan Bailey in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '154 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'whole_apartment', 3, 'owner', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6158-bfd0-11f0-a648-52f5d85831eb', 'fb594dc6-c736-423d-ad0f-63ff7fefa338', 'KRISTIAN TAYLOR • Student Stay', 'Comfortable room hosted by Kristian Taylor in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '155 RUE DES ECOLES', 48.8794, 2.3878, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d61d0-bfd0-11f0-a648-52f5d85831eb', 'ee8aa2d6-8f66-456d-a4c4-4285f5b6c3ed', 'MAYA ROBERTS • Student Stay', 'Comfortable room hosted by Maya Roberts in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '156 ALEXANDERPLATZ', 52.52, 13.405, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6252-bfd0-11f0-a648-52f5d85831eb', '7f782e61-5f5c-408b-ac05-9ed5c58698d6', 'ALEXIA HARPER • Student Stay', 'Comfortable apartment hosted by Alexia Harper in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '157 KEIZERSGRACHT', 52.3749, 4.9063, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d62ca-bfd0-11f0-a648-52f5d85831eb', 'ec345aad-8c4c-464c-8267-d9ffe8da8990', 'DALE MILLER • Student Stay', 'Comfortable room hosted by Dale Miller in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '158 GRAND PLACE', 50.8598, 4.3626, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d634c-bfd0-11f0-a648-52f5d85831eb', 'a210715b-ab0c-49ab-b37f-54787f7bc76a', 'LUCY MONTGOMERY • Student Stay', 'Comfortable room hosted by Lucy Montgomery in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '159 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d63ce-bfd0-11f0-a648-52f5d85831eb', '40d6c7e2-37cb-437a-90c9-fbb4b2fb1661', 'EDWARD MOORE • Student Stay', 'Comfortable apartment hosted by Edward Moore in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '160 RUE DES ECOLES', 48.8696, 2.3752, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6a0e-bfd0-11f0-a648-52f5d85831eb', '7b92d17d-f6ea-4b34-bdab-c184fc69cc31', 'KEVIN SPENCER • Student Stay', 'Comfortable room hosted by Kevin Spencer in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '161 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6b62-bfd0-11f0-a648-52f5d85831eb', 'dbd65d6b-925f-4c27-a7da-792494ca25c4', 'VANESSA FERGUSON • Student Stay', 'Comfortable room hosted by Vanessa Ferguson in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '162 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6be4-bfd0-11f0-a648-52f5d85831eb', '71d3fbd3-5b31-42e1-bb87-bbc53459ac48', 'CARLOS RICHARDSON • Student Stay', 'Comfortable apartment hosted by Carlos Richardson in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '163 GRAND PLACE', 50.85, 4.35, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6c66-bfd0-11f0-a648-52f5d85831eb', 'a1f7c2d2-ebbe-4bfa-8def-96b0aba7e543', 'ALISSA MURRAY • Student Stay', 'Comfortable room hosted by Alissa Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '164 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6cde-bfd0-11f0-a648-52f5d85831eb', '6b1954e8-0dbf-4c68-b762-4d91e30a6cb9', 'ADRIAN WELLS • Student Stay', 'Comfortable room hosted by Adrian Wells in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '165 RUE DES ECOLES', 48.8598, 2.3626, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6d6a-bfd0-11f0-a648-52f5d85831eb', '4437f3e7-cfb9-4df0-8704-357504968741', 'KELSEY CRAIG • Student Stay', 'Comfortable apartment hosted by Kelsey Craig in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '166 ALEXANDERPLATZ', 52.5347, 13.4239, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6de2-bfd0-11f0-a648-52f5d85831eb', 'ac6323d9-893a-4c0a-a733-fb8354a1b623', 'AMBER MONTGOMERY • Student Stay', 'Comfortable room hosted by Amber Montgomery in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '167 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6e64-bfd0-11f0-a648-52f5d85831eb', '407b7b25-d201-4e49-8084-52f0a9ab633a', 'RYAN CUNNINGHAM • Student Stay', 'Comfortable room hosted by Ryan Cunningham in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '168 GRAND PLACE', 50.8745, 4.3815, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6edc-bfd0-11f0-a648-52f5d85831eb', '2ec08256-3c19-4a57-854b-b835880a963e', 'LUCY CHAPMAN • Student Stay', 'Comfortable apartment hosted by Lucy Chapman in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '169 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d6f5e-bfd0-11f0-a648-52f5d85831eb', '4454ecc1-cc49-419d-9c3c-75c9257b23ec', 'DAISY RUSSELL • Student Stay', 'Comfortable room hosted by Daisy Russell in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '170 RUE DES ECOLES', 48.85, 2.35, 'room', 3, 'owner', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7062-bfd0-11f0-a648-52f5d85831eb', '9cde0988-2517-4e85-bf51-e808beb2ee22', 'KELLAN EDWARDS • Student Stay', 'Comfortable room hosted by Kellan Edwards in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '171 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 4, 'renter', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d715c-bfd0-11f0-a648-52f5d85831eb', '6813fc4c-9e78-4bf8-a533-ddbef4846429', 'MILEY WARREN • Student Stay', 'Comfortable apartment hosted by Miley Warren in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '172 KEIZERSGRACHT', 52.3798, 4.9126, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d722e-bfd0-11f0-a648-52f5d85831eb', '7f2db7f8-dabd-45c2-93ff-8f86796dc552', 'SYDNEY MITCHELL • Student Stay', 'Comfortable room hosted by Sydney Mitchell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '173 GRAND PLACE', 50.8647, 4.3689, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d72f6-bfd0-11f0-a648-52f5d85831eb', '280988fa-8f35-48a1-b8f8-16d0c7cf2777', 'PENELOPE RUSSELL • Student Stay', 'Comfortable room hosted by Penelope Russell in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '174 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 3, 'owner', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7346-bfd0-11f0-a648-52f5d85831eb', 'e01d9e90-261e-4a75-95f9-31a3acd70758', 'TYLER BENNETT • Student Stay', 'Comfortable apartment hosted by Tyler Bennett in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '175 RUE DES ECOLES', 48.8745, 2.3815, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d73a0-bfd0-11f0-a648-52f5d85831eb', 'd57dc4f3-cb55-4016-890c-1d42fb397c5f', 'ADELE REED • Student Stay', 'Comfortable room hosted by Adele Reed in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '176 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 1, 'owner', 'paused', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d73f0-bfd0-11f0-a648-52f5d85831eb', 'a703687c-fc58-4449-a400-0d0ae477ad52', 'ERIC JOHNSTON • Student Stay', 'Comfortable room hosted by Eric Johnston in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '177 KEIZERSGRACHT', 52.37, 4.9, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7440-bfd0-11f0-a648-52f5d85831eb', '2027817b-9eb4-48d3-961a-808631ffc52c', 'DEANNA PHILLIPS • Student Stay', 'Comfortable apartment hosted by Deanna Phillips in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '178 GRAND PLACE', 50.8549, 4.3563, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d749a-bfd0-11f0-a648-52f5d85831eb', '3fb74c36-eb37-4d36-8bf7-38118ba0e12a', 'RYAN ROSS • Student Stay', 'Comfortable room hosted by Ryan Ross in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '179 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d74ea-bfd0-11f0-a648-52f5d85831eb', '9ed79eb6-91f0-4279-aa08-34cc7dd4528c', 'DAISY BAKER • Student Stay', 'Comfortable room hosted by Daisy Baker in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '180 RUE DES ECOLES', 48.8647, 2.3689, 'room', 1, 'owner', 'archived', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7544-bfd0-11f0-a648-52f5d85831eb', '687dad09-5a5b-475a-922c-21f90f99c50b', 'REID TURNER • Student Stay', 'Comfortable apartment hosted by Reid Turner in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '181 ALEXANDERPLATZ', 52.5396, 13.4302, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7594-bfd0-11f0-a648-52f5d85831eb', '7b331d60-6522-4a40-acec-940bbee81c89', 'AMELIA PARKER • Student Stay', 'Comfortable room hosted by Amelia Parker in AMSTERDAM. Host account status: PENDING.', 'NETHERLANDS', 'AMSTERDAM', '182 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 3, 'owner', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d75e4-bfd0-11f0-a648-52f5d85831eb', '6a8d2833-4280-4d20-9a24-8255123e8cda', 'MILLER FOWLER • Student Stay', 'Comfortable room hosted by Miller Fowler in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '183 GRAND PLACE', 50.8794, 4.3878, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d763e-bfd0-11f0-a648-52f5d85831eb', 'd44b4cdf-91b1-4d13-93db-0aff09c3b3e2', 'MARTIN RYAN • Student Stay', 'Comfortable apartment hosted by Martin Ryan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '184 AVINGUDA DIAGONAL', 41.39, 2.16, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d774c-bfd0-11f0-a648-52f5d85831eb', 'bdf11e6d-f0df-4c19-940d-67347d395911', 'ADELAIDE CLARK • Student Stay', 'Comfortable room hosted by Adelaide Clark in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '185 RUE DES ECOLES', 48.8549, 2.3563, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d779c-bfd0-11f0-a648-52f5d85831eb', '9a9ba8e0-2ad6-4840-8755-2515765385f0', 'GARRY MYERS • Student Stay', 'Comfortable room hosted by Garry Myers in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '186 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d77f6-bfd0-11f0-a648-52f5d85831eb', '9cec3df4-b8c5-48e5-8b31-a6f15edd152e', 'RAFAEL TUCKER • Student Stay', 'Comfortable apartment hosted by Rafael Tucker in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '187 KEIZERSGRACHT', 52.3847, 4.9189, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7846-bfd0-11f0-a648-52f5d85831eb', '45117b65-3d55-4b61-8feb-5ed7f4c654a9', 'ALDUS CASEY • Student Stay', 'Comfortable room hosted by Aldus Casey in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '188 GRAND PLACE', 50.8696, 4.3752, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7896-bfd0-11f0-a648-52f5d85831eb', 'a8803f2c-cec4-49ce-ac84-aa37a14ce458', 'JARED MORRISON • Student Stay', 'Comfortable room hosted by Jared Morrison in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '189 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d7fa8-bfd0-11f0-a648-52f5d85831eb', 'c2bc6777-4f25-4e2b-bf67-86726508a709', 'GARRY JONES • Student Stay', 'Comfortable apartment hosted by Garry Jones in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '190 RUE DES ECOLES', 48.8794, 2.3878, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8002-bfd0-11f0-a648-52f5d85831eb', '36ece217-9ef1-4f6d-9e05-27dfc17e2b15', 'NICHOLAS ALEXANDER • Student Stay', 'Comfortable room hosted by Nicholas Alexander in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '191 ALEXANDERPLATZ', 52.52, 13.405, 'room', 4, 'renter', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d805c-bfd0-11f0-a648-52f5d85831eb', 'eecde76a-9fd1-4299-a898-f54fe6c2af80', 'ABIGAIL SPENCER • Student Stay', 'Comfortable room hosted by Abigail Spencer in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '192 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d80b6-bfd0-11f0-a648-52f5d85831eb', '6701656c-5a89-4d41-9353-66880f3257f0', 'LYNDON GRAY • Student Stay', 'Comfortable apartment hosted by Lyndon Gray in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '193 GRAND PLACE', 50.8598, 4.3626, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8110-bfd0-11f0-a648-52f5d85831eb', 'a6f27d29-4a13-453c-a281-2e387a736868', 'ELISE MURPHY • Student Stay', 'Comfortable room hosted by Elise Murphy in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '194 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8160-bfd0-11f0-a648-52f5d85831eb', '7f9b83fe-3ee9-4a1a-977d-f772697511f3', 'AGATA RYAN • Student Stay', 'Comfortable room hosted by Agata Ryan in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '195 RUE DES ECOLES', 48.8696, 2.3752, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d81b0-bfd0-11f0-a648-52f5d85831eb', '9f189f5a-a1f7-484c-b50f-718f2bf89061', 'EMILY JONES • Student Stay', 'Comfortable apartment hosted by Emily Jones in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '196 ALEXANDERPLATZ', 52.5445, 13.4365, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d820a-bfd0-11f0-a648-52f5d85831eb', 'a45b64c2-81d7-4887-afdb-17d88a69c8af', 'JORDAN HAMILTON • Student Stay', 'Comfortable room hosted by Jordan Hamilton in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '197 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d825a-bfd0-11f0-a648-52f5d85831eb', 'eb0a7e62-b629-4510-a91b-38ff24b640ac', 'MAXIMILIAN JOHNSON • Student Stay', 'Comfortable room hosted by Maximilian Johnson in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '198 GRAND PLACE', 50.85, 4.35, 'room', 3, 'owner', 'draft', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d82b4-bfd0-11f0-a648-52f5d85831eb', '83290a01-a6c3-4e36-802e-dec89b0a8c43', 'VIOLET WALKER • Student Stay', 'Comfortable apartment hosted by Violet Walker in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '199 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8304-bfd0-11f0-a648-52f5d85831eb', '82f55787-20ca-4552-9549-9f9fd4f24243', 'DARCY PHILLIPS • Student Stay', 'Comfortable room hosted by Darcy Phillips in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '200 RUE DES ECOLES', 48.8598, 2.3626, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8390-bfd0-11f0-a648-52f5d85831eb', 'ddb8147f-6323-4be0-b6a3-67e0b16f2a46', 'ALEXANDER MITCHELL • Student Stay', 'Comfortable room hosted by Alexander Mitchell in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '201 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d83ea-bfd0-11f0-a648-52f5d85831eb', 'cef8637f-5422-4089-9b2f-fb869408720f', 'MICHELLE HAWKINS • Student Stay', 'Comfortable apartment hosted by Michelle Hawkins in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '202 KEIZERSGRACHT', 52.3896, 4.9252, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d8444-bfd0-11f0-a648-52f5d85831eb', '832794de-0511-4d24-9aa1-1d20d6c9ff78', 'MICHAEL MYERS • Student Stay', 'Comfortable room hosted by Michael Myers in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '203 GRAND PLACE', 50.8745, 4.3815, 'room', 4, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d849e-bfd0-11f0-a648-52f5d85831eb', '2f760c60-0317-4585-995c-e6f8a7d35530', 'TED FOWLER • Student Stay', 'Comfortable room hosted by Ted Fowler in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '204 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 1, 'owner', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('331d84ee-bfd0-11f0-a648-52f5d85831eb', '83710363-2633-4264-8987-5600e20c1254', 'ALINA CRAIG • Student Stay', 'Comfortable apartment hosted by Alina Craig in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '205 RUE DES ECOLES', 48.85, 2.35, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 13:02:18', '2025-11-12 13:02:18'),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', '357e760a-d08c-4078-be80-b6d8c819f56a', 'hahahahha', 'gagagaggagagaggagga. ga ag ga dga. aga ga gaga ag agaga agag ag', 'Croatia', 'Zagreb', 'Ulica kneza Mislava 1', NULL, NULL, 'whole_apartment', 1, 'renter', 'published', '2025-12-10 10:21:35', '2025-12-10 10:45:15'),
('55601440-a79d-4789-8c4b-28cf907d3cc8', '357e760a-d08c-4078-be80-b6d8c819f56a', 'Aahhahahahhahah', 'ajsdad said sad ks asks aka dosa dkksd', 'Croatia', 'Zagreb', 'Unska ulica 3', 45.800591, 15.9711207, 'whole_apartment', 3, 'renter', 'published', '2025-12-10 10:33:39', '2025-12-10 10:45:11'),
('5e122d82-bfd8-11f0-9b66-3c11a3fd0c43', '9463d8c6-fbf8-48d3-aa49-7edf12b531f8', 'ADMIN ADMINSON • Student Stay', 'Comfortable room hosted by ADMIN ADMINSON in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '101 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12300c-bfd8-11f0-9b66-3c11a3fd0c43', 'be0267ae-304e-40a7-949a-50bbec15936e', 'ALEKSANDRE TEST • Student Stay', 'Comfortable room hosted by ALEKSANDRE TEST in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '102 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1230ac-bfd8-11f0-9b66-3c11a3fd0c43', '236a8940-1475-48c4-a793-2e67c005bba8', 'SURESH TESTER • Student Stay', 'Comfortable apartment hosted by SURESH TESTER in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '103 GRAND PLACE', 50.8647, 4.3689, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12311a-bfd8-11f0-9b66-3c11a3fd0c43', 'b429f253-cee8-45ce-81b7-e5acf8f4eebb', 'ARIF TUPLE • Student Stay', 'Comfortable room hosted by ARIF TUPLE in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '104 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 1, 'owner', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123174-bfd8-11f0-9b66-3c11a3fd0c43', '32bba3a2-6ecb-4411-9e9d-a56238de5cf4', 'TONY MURRAY • Student Stay', 'Comfortable room hosted by Tony Murray in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '105 RUE DES ECOLES', 48.8745, 2.3815, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1231ec-bfd8-11f0-9b66-3c11a3fd0c43', '49b62029-c9fe-48c0-b81a-760f45372054', 'NICOLE BARNES • Student Stay', 'Comfortable room hosted by Nicole Barnes in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '107 KEIZERSGRACHT', 52.37, 4.9, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123264-bfd8-11f0-9b66-3c11a3fd0c43', 'f4343da9-11c0-40f9-9fe7-ad6efd1f492d', 'PENELOPE FARRELL • Student Stay', 'Comfortable room hosted by Penelope Farrell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '108 GRAND PLACE', 50.8549, 4.3563, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1232be-bfd8-11f0-9b66-3c11a3fd0c43', 'e2b4427d-b619-4fea-972d-68996aed4df7', 'FREDERICK WILSON • Student Stay', 'Comfortable apartment hosted by Frederick Wilson in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '109 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'whole_apartment', 2, 'renter', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123322-bfd8-11f0-9b66-3c11a3fd0c43', '20125d2e-2aa5-4d46-85d8-d0b7e295f270', 'GEORGE HOLMES • Student Stay', 'Comfortable room hosted by George Holmes in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '110 RUE DES ECOLES', 48.8647, 2.3689, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123372-bfd8-11f0-9b66-3c11a3fd0c43', '63eca209-eb5c-4d42-b650-3d7526273b1a', 'LEONARDO CLARK • Student Stay', 'Comfortable room hosted by Leonardo Clark in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '111 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1233cc-bfd8-11f0-9b66-3c11a3fd0c43', 'a42443d3-70fe-47e7-a10b-49c3c7272e96', 'ARTHUR HALL • Student Stay', 'Comfortable apartment hosted by Arthur Hall in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '112 KEIZERSGRACHT', 52.3945, 4.9315, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12341c-bfd8-11f0-9b66-3c11a3fd0c43', 'cc59fea3-0f51-4734-8912-497ad38c2df1', 'AMY HIGGINS • Student Stay', 'Comfortable room hosted by Amy Higgins in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '113 GRAND PLACE', 50.8794, 4.3878, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123476-bfd8-11f0-9b66-3c11a3fd0c43', '179593fe-5eea-4740-bd77-549fc4a015ed', 'HENRY MURRAY • Student Stay', 'Comfortable room hosted by Henry Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '114 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1234c6-bfd8-11f0-9b66-3c11a3fd0c43', 'bea6d221-5cb6-462f-b14d-66e36a056dbd', 'VICTORIA MORRIS • Student Stay', 'Comfortable apartment hosted by Victoria Morris in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '115 RUE DES ECOLES', 48.8549, 2.3563, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123516-bfd8-11f0-9b66-3c11a3fd0c43', '607876cd-dd91-4689-abf2-0a67dbba2915', 'SOPHIA HOLMES • Student Stay', 'Comfortable room hosted by Sophia Holmes in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '116 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 1, 'owner', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123566-bfd8-11f0-9b66-3c11a3fd0c43', '6a1e0fb7-4c5f-46c5-877a-9e000a32f358', 'PATRICK CASEY • Student Stay', 'Comfortable room hosted by Patrick Casey in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '117 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1235b6-bfd8-11f0-9b66-3c11a3fd0c43', 'c6b62737-c60d-4a17-98d4-2af851a9279c', 'ADISON BARNES • Student Stay', 'Comfortable apartment hosted by Adison Barnes in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '118 GRAND PLACE', 50.8696, 4.3752, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123610-bfd8-11f0-9b66-3c11a3fd0c43', 'd5ef263d-8c25-4432-984e-9e6cf79836e6', 'VIOLET OWENS • Student Stay', 'Comfortable room hosted by Violet Owens in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '119 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123660-bfd8-11f0-9b66-3c11a3fd0c43', '3cd1f40c-dc0f-4955-b473-2d84ab89b73f', 'MIRANDA MYERS • Student Stay', 'Comfortable room hosted by Miranda Myers in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '120 RUE DES ECOLES', 48.8794, 2.3878, 'room', 1, 'owner', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12370a-bfd8-11f0-9b66-3c11a3fd0c43', '91484a59-2820-4572-94a4-60329b5c898f', 'JUSTIN MORRISON • Student Stay', 'Comfortable apartment hosted by Justin Morrison in BERLIN. Host account status: REJECTED.', 'GERMANY', 'BERLIN', '121 ALEXANDERPLATZ', 52.52, 13.405, 'whole_apartment', 2, 'renter', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123764-bfd8-11f0-9b66-3c11a3fd0c43', '6c4807cc-f0e1-4aef-aff0-075c7c09b1dd', 'STEVEN CRAIG • Student Stay', 'Comfortable room hosted by Steven Craig in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '122 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1237be-bfd8-11f0-9b66-3c11a3fd0c43', '9c876b21-4e7f-4eb0-8f0c-ac2ca8c0bf34', 'HONEY EDWARDS • Student Stay', 'Comfortable room hosted by Honey Edwards in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '123 GRAND PLACE', 50.8598, 4.3626, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12380e-bfd8-11f0-9b66-3c11a3fd0c43', 'a26a1ad6-fabb-491d-91b8-bf42e94ebfd1', 'ALFRED DOUGLAS • Student Stay', 'Comfortable apartment hosted by Alfred Douglas in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '124 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12385e-bfd8-11f0-9b66-3c11a3fd0c43', '4741084c-90c6-4b0f-a6d5-811f13495825', 'DAINTON TUCKER • Student Stay', 'Comfortable room hosted by Dainton Tucker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '125 RUE DES ECOLES', 48.8696, 2.3752, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1238b8-bfd8-11f0-9b66-3c11a3fd0c43', 'b622405e-4ed5-4256-91de-8f3942e778ee', 'PENELOPE THOMAS • Student Stay', 'Comfortable room hosted by Penelope Thomas in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '126 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123908-bfd8-11f0-9b66-3c11a3fd0c43', 'b2ae7561-d56f-498a-9d69-cf194dde8a35', 'MIKE MOORE • Student Stay', 'Comfortable apartment hosted by Mike Moore in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '127 KEIZERSGRACHT', 52.3994, 4.9378, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123aa2-bfd8-11f0-9b66-3c11a3fd0c43', '0b23e575-89c4-46d0-bb77-91d3d7700365', 'ROMAN WRIGHT • Student Stay', 'Comfortable room hosted by Roman Wright in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '128 GRAND PLACE', 50.85, 4.35, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123b74-bfd8-11f0-9b66-3c11a3fd0c43', 'c8633364-e226-4946-ae0c-2c33b7e4681e', 'CATHERINE LLOYD • Student Stay', 'Comfortable room hosted by Catherine Lloyd in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '129 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 2, 'renter', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123c50-bfd8-11f0-9b66-3c11a3fd0c43', '76f9b842-0692-40fb-9893-b336803841ec', 'NICOLE PARKER • Student Stay', 'Comfortable apartment hosted by Nicole Parker in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '130 RUE DES ECOLES', 48.8598, 2.3626, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123d18-bfd8-11f0-9b66-3c11a3fd0c43', '79927f79-10ca-488a-a34b-34608e3111f9', 'APRIL CLARK • Student Stay', 'Comfortable room hosted by April Clark in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '131 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 4, 'renter', 'paused', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123dea-bfd8-11f0-9b66-3c11a3fd0c43', 'cdd6f3ec-bb8e-4b29-9741-cd360a352181', 'SPIKE FARRELL • Student Stay', 'Comfortable room hosted by Spike Farrell in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '132 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 1, 'owner', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123eb2-bfd8-11f0-9b66-3c11a3fd0c43', '9419f24d-9875-4a88-a059-616d5261c67e', 'ALEN FOSTER • Student Stay', 'Comfortable apartment hosted by Alen Foster in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '133 GRAND PLACE', 50.8745, 4.3815, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e123f84-bfd8-11f0-9b66-3c11a3fd0c43', '627fe270-d240-4f20-a860-7fba390f562c', 'ELISE RICHARDSON • Student Stay', 'Comfortable room hosted by Elise Richardson in BARCELONA. Host account status: SUSPENDED.', 'SPAIN', 'BARCELONA', '134 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 3, 'owner', 'paused', '2025-11-12 14:00:46', '2025-11-12 14:00:46');
INSERT INTO `listing` (`id`, `host_profile_id`, `title`, `description`, `country`, `city`, `address_line`, `latitude`, `longitude`, `room_type`, `max_guests`, `host_role`, `status`, `created_at`, `updated_at`) VALUES
('5e124056-bfd8-11f0-9b66-3c11a3fd0c43', '8f4fe2e2-e42b-4bae-9953-6f72a9e6b1ea', 'STUART ANDERSON • Student Stay', 'Comfortable room hosted by Stuart Anderson in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '135 RUE DES ECOLES', 48.85, 2.35, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124164-bfd8-11f0-9b66-3c11a3fd0c43', '37384438-14ac-4066-9bbe-d15934c64acf', 'ABRAHAM COLE • Student Stay', 'Comfortable apartment hosted by Abraham Cole in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '136 ALEXANDERPLATZ', 52.5249, 13.4113, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124240-bfd8-11f0-9b66-3c11a3fd0c43', '34b2bb02-8adc-446c-b219-466627542292', 'MIRANDA PERRY • Student Stay', 'Comfortable room hosted by Miranda Perry in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '137 KEIZERSGRACHT', 52.3798, 4.9126, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124308-bfd8-11f0-9b66-3c11a3fd0c43', '6aaa8d59-1799-4cf4-bbe7-9922f536bff5', 'RAFAEL CLARK • Student Stay', 'Comfortable room hosted by Rafael Clark in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '138 GRAND PLACE', 50.8647, 4.3689, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1243d0-bfd8-11f0-9b66-3c11a3fd0c43', 'a198dd45-7df8-45a3-87c9-9dccdb500f26', 'ALFRED MASON • Student Stay', 'Comfortable apartment hosted by Alfred Mason in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '139 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124498-bfd8-11f0-9b66-3c11a3fd0c43', 'f5aa2129-f01c-45d5-9709-84c6e66c7bdf', 'ADRIAN BROWN • Student Stay', 'Comfortable room hosted by Adrian Brown in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '140 RUE DES ECOLES', 48.8745, 2.3815, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124600-bfd8-11f0-9b66-3c11a3fd0c43', 'fd430601-9895-4cc7-90c1-67733be8a5a6', 'STELLA ROSS • Student Stay', 'Comfortable room hosted by Stella Ross in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '141 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 2, 'renter', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1246d2-bfd8-11f0-9b66-3c11a3fd0c43', '2a6621b7-a0d2-403b-ac83-3c8f3944bfbf', 'ADAM GRAY • Student Stay', 'Comfortable apartment hosted by Adam Gray in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '142 KEIZERSGRACHT', 52.37, 4.9, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12479a-bfd8-11f0-9b66-3c11a3fd0c43', 'f25392bf-47c6-4039-91de-4462a2d5edfb', 'NICHOLAS SCOTT • Student Stay', 'Comfortable room hosted by Nicholas Scott in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '143 GRAND PLACE', 50.8549, 4.3563, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124862-bfd8-11f0-9b66-3c11a3fd0c43', '13783aeb-eab3-4feb-8cc4-63088c54af33', 'MARCUS ROBERTS • Student Stay', 'Comfortable room hosted by Marcus Roberts in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '144 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12492a-bfd8-11f0-9b66-3c11a3fd0c43', 'e8d526f8-1274-4aca-afc6-bb9ecff78fda', 'STEVEN CRAWFORD • Student Stay', 'Comfortable apartment hosted by Steven Crawford in PARIS. Host account status: PENDING.', 'FRANCE', 'PARIS', '145 RUE DES ECOLES', 48.8647, 2.3689, 'whole_apartment', 2, 'renter', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1249fc-bfd8-11f0-9b66-3c11a3fd0c43', 'e0af6061-f210-491b-9205-b20b07520095', 'DEXTER MARTIN • Student Stay', 'Comfortable room hosted by Dexter Martin in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '146 ALEXANDERPLATZ', 52.5396, 13.4302, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124aba-bfd8-11f0-9b66-3c11a3fd0c43', 'bf3f11b4-e104-4c29-a73a-b8139a7afc75', 'RUBIE MORRISON • Student Stay', 'Comfortable room hosted by Rubie Morrison in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '147 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124b82-bfd8-11f0-9b66-3c11a3fd0c43', 'dbf85fbd-7a28-4574-bfa7-6517fd3f64b6', 'JORDAN ANDREWS • Student Stay', 'Comfortable apartment hosted by Jordan Andrews in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '148 GRAND PLACE', 50.8794, 4.3878, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124c4a-bfd8-11f0-9b66-3c11a3fd0c43', '42c9a0c7-be34-4375-a6ae-5006be89ea8f', 'JACOB MORGAN • Student Stay', 'Comfortable room hosted by Jacob Morgan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '149 AVINGUDA DIAGONAL', 41.39, 2.16, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124dc6-bfd8-11f0-9b66-3c11a3fd0c43', '8490dc56-8e97-4278-b84a-aac06a4595eb', 'DEANNA FOWLER • Student Stay', 'Comfortable room hosted by Deanna Fowler in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '150 RUE DES ECOLES', 48.8549, 2.3563, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e124ede-bfd8-11f0-9b66-3c11a3fd0c43', 'ffd2e4dd-d3d5-4681-bd6b-bf9f0d44ce15', 'ADRIANNA TUCKER • Student Stay', 'Comfortable apartment hosted by Adrianna Tucker in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '151 ALEXANDERPLATZ', 52.5298, 13.4176, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12503c-bfd8-11f0-9b66-3c11a3fd0c43', 'eaa50618-cb38-42a3-9ed4-f5f04a6e8c01', 'STELLA BAILEY • Student Stay', 'Comfortable room hosted by Stella Bailey in AMSTERDAM. Host account status: REJECTED.', 'NETHERLANDS', 'AMSTERDAM', '152 KEIZERSGRACHT', 52.3847, 4.9189, 'room', 1, 'owner', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e125118-bfd8-11f0-9b66-3c11a3fd0c43', '9d6ad805-dabc-487c-b6d4-095f3e7faccb', 'ELLIA MARTIN • Student Stay', 'Comfortable room hosted by Ellia Martin in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '153 GRAND PLACE', 50.8696, 4.3752, 'room', 2, 'renter', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1251e0-bfd8-11f0-9b66-3c11a3fd0c43', 'cfb67e61-3de6-470f-b758-72862fa0cda2', 'RYAN BAILEY • Student Stay', 'Comfortable apartment hosted by Ryan Bailey in BARCELONA. Host account status: PENDING.', 'SPAIN', 'BARCELONA', '154 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'whole_apartment', 3, 'owner', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1252b2-bfd8-11f0-9b66-3c11a3fd0c43', 'fb594dc6-c736-423d-ad0f-63ff7fefa338', 'KRISTIAN TAYLOR • Student Stay', 'Comfortable room hosted by Kristian Taylor in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '155 RUE DES ECOLES', 48.8794, 2.3878, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12538e-bfd8-11f0-9b66-3c11a3fd0c43', 'ee8aa2d6-8f66-456d-a4c4-4285f5b6c3ed', 'MAYA ROBERTS • Student Stay', 'Comfortable room hosted by Maya Roberts in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '156 ALEXANDERPLATZ', 52.52, 13.405, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1257f8-bfd8-11f0-9b66-3c11a3fd0c43', '7f782e61-5f5c-408b-ac05-9ed5c58698d6', 'ALEXIA HARPER • Student Stay', 'Comfortable apartment hosted by Alexia Harper in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '157 KEIZERSGRACHT', 52.3749, 4.9063, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12596a-bfd8-11f0-9b66-3c11a3fd0c43', 'ec345aad-8c4c-464c-8267-d9ffe8da8990', 'DALE MILLER • Student Stay', 'Comfortable room hosted by Dale Miller in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '158 GRAND PLACE', 50.8598, 4.3626, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e125a64-bfd8-11f0-9b66-3c11a3fd0c43', 'a210715b-ab0c-49ab-b37f-54787f7bc76a', 'LUCY MONTGOMERY • Student Stay', 'Comfortable room hosted by Lucy Montgomery in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '159 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e125b54-bfd8-11f0-9b66-3c11a3fd0c43', '40d6c7e2-37cb-437a-90c9-fbb4b2fb1661', 'EDWARD MOORE • Student Stay', 'Comfortable apartment hosted by Edward Moore in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '160 RUE DES ECOLES', 48.8696, 2.3752, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1262de-bfd8-11f0-9b66-3c11a3fd0c43', '7b92d17d-f6ea-4b34-bdab-c184fc69cc31', 'KEVIN SPENCER • Student Stay', 'Comfortable room hosted by Kevin Spencer in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '161 ALEXANDERPLATZ', 52.5445, 13.4365, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126568-bfd8-11f0-9b66-3c11a3fd0c43', 'dbd65d6b-925f-4c27-a7da-792494ca25c4', 'VANESSA FERGUSON • Student Stay', 'Comfortable room hosted by Vanessa Ferguson in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '162 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12664e-bfd8-11f0-9b66-3c11a3fd0c43', '71d3fbd3-5b31-42e1-bb87-bbc53459ac48', 'CARLOS RICHARDSON • Student Stay', 'Comfortable apartment hosted by Carlos Richardson in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '163 GRAND PLACE', 50.85, 4.35, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12678e-bfd8-11f0-9b66-3c11a3fd0c43', 'a1f7c2d2-ebbe-4bfa-8def-96b0aba7e543', 'ALISSA MURRAY • Student Stay', 'Comfortable room hosted by Alissa Murray in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '164 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12687e-bfd8-11f0-9b66-3c11a3fd0c43', '6b1954e8-0dbf-4c68-b762-4d91e30a6cb9', 'ADRIAN WELLS • Student Stay', 'Comfortable room hosted by Adrian Wells in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '165 RUE DES ECOLES', 48.8598, 2.3626, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12695a-bfd8-11f0-9b66-3c11a3fd0c43', '4437f3e7-cfb9-4df0-8704-357504968741', 'KELSEY CRAIG • Student Stay', 'Comfortable apartment hosted by Kelsey Craig in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '166 ALEXANDERPLATZ', 52.5347, 13.4239, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126a2c-bfd8-11f0-9b66-3c11a3fd0c43', 'ac6323d9-893a-4c0a-a733-fb8354a1b623', 'AMBER MONTGOMERY • Student Stay', 'Comfortable room hosted by Amber Montgomery in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '167 KEIZERSGRACHT', 52.3896, 4.9252, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126afe-bfd8-11f0-9b66-3c11a3fd0c43', '407b7b25-d201-4e49-8084-52f0a9ab633a', 'RYAN CUNNINGHAM • Student Stay', 'Comfortable room hosted by Ryan Cunningham in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '168 GRAND PLACE', 50.8745, 4.3815, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126bc6-bfd8-11f0-9b66-3c11a3fd0c43', '2ec08256-3c19-4a57-854b-b835880a963e', 'LUCY CHAPMAN • Student Stay', 'Comfortable apartment hosted by Lucy Chapman in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '169 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126c98-bfd8-11f0-9b66-3c11a3fd0c43', '4454ecc1-cc49-419d-9c3c-75c9257b23ec', 'DAISY RUSSELL • Student Stay', 'Comfortable room hosted by Daisy Russell in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '170 RUE DES ECOLES', 48.85, 2.35, 'room', 3, 'owner', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126d74-bfd8-11f0-9b66-3c11a3fd0c43', '9cde0988-2517-4e85-bf51-e808beb2ee22', 'KELLAN EDWARDS • Student Stay', 'Comfortable room hosted by Kellan Edwards in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '171 ALEXANDERPLATZ', 52.5249, 13.4113, 'room', 4, 'renter', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126e46-bfd8-11f0-9b66-3c11a3fd0c43', '6813fc4c-9e78-4bf8-a533-ddbef4846429', 'MILEY WARREN • Student Stay', 'Comfortable apartment hosted by Miley Warren in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '172 KEIZERSGRACHT', 52.3798, 4.9126, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e126f18-bfd8-11f0-9b66-3c11a3fd0c43', '7f2db7f8-dabd-45c2-93ff-8f86796dc552', 'SYDNEY MITCHELL • Student Stay', 'Comfortable room hosted by Sydney Mitchell in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '173 GRAND PLACE', 50.8647, 4.3689, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127116-bfd8-11f0-9b66-3c11a3fd0c43', '280988fa-8f35-48a1-b8f8-16d0c7cf2777', 'PENELOPE RUSSELL • Student Stay', 'Comfortable room hosted by Penelope Russell in BARCELONA. Host account status: REJECTED.', 'SPAIN', 'BARCELONA', '174 AVINGUDA DIAGONAL', 41.4096, 2.1852, 'room', 3, 'owner', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1271fc-bfd8-11f0-9b66-3c11a3fd0c43', 'e01d9e90-261e-4a75-95f9-31a3acd70758', 'TYLER BENNETT • Student Stay', 'Comfortable apartment hosted by Tyler Bennett in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '175 RUE DES ECOLES', 48.8745, 2.3815, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1272ce-bfd8-11f0-9b66-3c11a3fd0c43', 'd57dc4f3-cb55-4016-890c-1d42fb397c5f', 'ADELE REED • Student Stay', 'Comfortable room hosted by Adele Reed in BERLIN. Host account status: SUSPENDED.', 'GERMANY', 'BERLIN', '176 ALEXANDERPLATZ', 52.5494, 13.4428, 'room', 1, 'owner', 'paused', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1273a0-bfd8-11f0-9b66-3c11a3fd0c43', 'a703687c-fc58-4449-a400-0d0ae477ad52', 'ERIC JOHNSTON • Student Stay', 'Comfortable room hosted by Eric Johnston in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '177 KEIZERSGRACHT', 52.37, 4.9, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127468-bfd8-11f0-9b66-3c11a3fd0c43', '2027817b-9eb4-48d3-961a-808631ffc52c', 'DEANNA PHILLIPS • Student Stay', 'Comfortable apartment hosted by Deanna Phillips in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '178 GRAND PLACE', 50.8549, 4.3563, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127544-bfd8-11f0-9b66-3c11a3fd0c43', '3fb74c36-eb37-4d36-8bf7-38118ba0e12a', 'RYAN ROSS • Student Stay', 'Comfortable room hosted by Ryan Ross in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '179 AVINGUDA DIAGONAL', 41.3998, 2.1726, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12760c-bfd8-11f0-9b66-3c11a3fd0c43', '9ed79eb6-91f0-4279-aa08-34cc7dd4528c', 'DAISY BAKER • Student Stay', 'Comfortable room hosted by Daisy Baker in PARIS. Host account status: REJECTED.', 'FRANCE', 'PARIS', '180 RUE DES ECOLES', 48.8647, 2.3689, 'room', 1, 'owner', 'archived', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1276de-bfd8-11f0-9b66-3c11a3fd0c43', '687dad09-5a5b-475a-922c-21f90f99c50b', 'REID TURNER • Student Stay', 'Comfortable apartment hosted by Reid Turner in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '181 ALEXANDERPLATZ', 52.5396, 13.4302, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1277a6-bfd8-11f0-9b66-3c11a3fd0c43', '7b331d60-6522-4a40-acec-940bbee81c89', 'AMELIA PARKER • Student Stay', 'Comfortable room hosted by Amelia Parker in AMSTERDAM. Host account status: PENDING.', 'NETHERLANDS', 'AMSTERDAM', '182 KEIZERSGRACHT', 52.3945, 4.9315, 'room', 3, 'owner', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e12786e-bfd8-11f0-9b66-3c11a3fd0c43', '6a8d2833-4280-4d20-9a24-8255123e8cda', 'MILLER FOWLER • Student Stay', 'Comfortable room hosted by Miller Fowler in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '183 GRAND PLACE', 50.8794, 4.3878, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127936-bfd8-11f0-9b66-3c11a3fd0c43', 'd44b4cdf-91b1-4d13-93db-0aff09c3b3e2', 'MARTIN RYAN • Student Stay', 'Comfortable apartment hosted by Martin Ryan in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '184 AVINGUDA DIAGONAL', 41.39, 2.16, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127b48-bfd8-11f0-9b66-3c11a3fd0c43', 'bdf11e6d-f0df-4c19-940d-67347d395911', 'ADELAIDE CLARK • Student Stay', 'Comfortable room hosted by Adelaide Clark in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '185 RUE DES ECOLES', 48.8549, 2.3563, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127c10-bfd8-11f0-9b66-3c11a3fd0c43', '9a9ba8e0-2ad6-4840-8755-2515765385f0', 'GARRY MYERS • Student Stay', 'Comfortable room hosted by Garry Myers in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '186 ALEXANDERPLATZ', 52.5298, 13.4176, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127cd8-bfd8-11f0-9b66-3c11a3fd0c43', '9cec3df4-b8c5-48e5-8b31-a6f15edd152e', 'RAFAEL TUCKER • Student Stay', 'Comfortable apartment hosted by Rafael Tucker in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '187 KEIZERSGRACHT', 52.3847, 4.9189, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127daa-bfd8-11f0-9b66-3c11a3fd0c43', '45117b65-3d55-4b61-8feb-5ed7f4c654a9', 'ALDUS CASEY • Student Stay', 'Comfortable room hosted by Aldus Casey in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '188 GRAND PLACE', 50.8696, 4.3752, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e127e72-bfd8-11f0-9b66-3c11a3fd0c43', 'a8803f2c-cec4-49ce-ac84-aa37a14ce458', 'JARED MORRISON • Student Stay', 'Comfortable room hosted by Jared Morrison in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '189 AVINGUDA DIAGONAL', 41.4145, 2.1915, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1282fa-bfd8-11f0-9b66-3c11a3fd0c43', 'c2bc6777-4f25-4e2b-bf67-86726508a709', 'GARRY JONES • Student Stay', 'Comfortable apartment hosted by Garry Jones in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '190 RUE DES ECOLES', 48.8794, 2.3878, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1283e0-bfd8-11f0-9b66-3c11a3fd0c43', '36ece217-9ef1-4f6d-9e05-27dfc17e2b15', 'NICHOLAS ALEXANDER • Student Stay', 'Comfortable room hosted by Nicholas Alexander in BERLIN. Host account status: PENDING.', 'GERMANY', 'BERLIN', '191 ALEXANDERPLATZ', 52.52, 13.405, 'room', 4, 'renter', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1284b2-bfd8-11f0-9b66-3c11a3fd0c43', 'eecde76a-9fd1-4299-a898-f54fe6c2af80', 'ABIGAIL SPENCER • Student Stay', 'Comfortable room hosted by Abigail Spencer in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '192 KEIZERSGRACHT', 52.3749, 4.9063, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128584-bfd8-11f0-9b66-3c11a3fd0c43', '6701656c-5a89-4d41-9353-66880f3257f0', 'LYNDON GRAY • Student Stay', 'Comfortable apartment hosted by Lyndon Gray in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '193 GRAND PLACE', 50.8598, 4.3626, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128656-bfd8-11f0-9b66-3c11a3fd0c43', 'a6f27d29-4a13-453c-a281-2e387a736868', 'ELISE MURPHY • Student Stay', 'Comfortable room hosted by Elise Murphy in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '194 AVINGUDA DIAGONAL', 41.4047, 2.1789, 'room', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128728-bfd8-11f0-9b66-3c11a3fd0c43', '7f9b83fe-3ee9-4a1a-977d-f772697511f3', 'AGATA RYAN • Student Stay', 'Comfortable room hosted by Agata Ryan in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '195 RUE DES ECOLES', 48.8696, 2.3752, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1287e6-bfd8-11f0-9b66-3c11a3fd0c43', '9f189f5a-a1f7-484c-b50f-718f2bf89061', 'EMILY JONES • Student Stay', 'Comfortable apartment hosted by Emily Jones in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '196 ALEXANDERPLATZ', 52.5445, 13.4365, 'whole_apartment', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e1288b8-bfd8-11f0-9b66-3c11a3fd0c43', 'a45b64c2-81d7-4887-afdb-17d88a69c8af', 'JORDAN HAMILTON • Student Stay', 'Comfortable room hosted by Jordan Hamilton in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '197 KEIZERSGRACHT', 52.3994, 4.9378, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128980-bfd8-11f0-9b66-3c11a3fd0c43', 'eb0a7e62-b629-4510-a91b-38ff24b640ac', 'MAXIMILIAN JOHNSON • Student Stay', 'Comfortable room hosted by Maximilian Johnson in BRUSSELS. Host account status: PENDING.', 'BELGIUM', 'BRUSSELS', '198 GRAND PLACE', 50.85, 4.35, 'room', 3, 'owner', 'draft', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128a48-bfd8-11f0-9b66-3c11a3fd0c43', '83290a01-a6c3-4e36-802e-dec89b0a8c43', 'VIOLET WALKER • Student Stay', 'Comfortable apartment hosted by Violet Walker in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '199 AVINGUDA DIAGONAL', 41.3949, 2.1663, 'whole_apartment', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128b1a-bfd8-11f0-9b66-3c11a3fd0c43', '82f55787-20ca-4552-9549-9f9fd4f24243', 'DARCY PHILLIPS • Student Stay', 'Comfortable room hosted by Darcy Phillips in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '200 RUE DES ECOLES', 48.8598, 2.3626, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128be2-bfd8-11f0-9b66-3c11a3fd0c43', 'ddb8147f-6323-4be0-b6a3-67e0b16f2a46', 'ALEXANDER MITCHELL • Student Stay', 'Comfortable room hosted by Alexander Mitchell in BERLIN. Host account status: APPROVED.', 'GERMANY', 'BERLIN', '201 ALEXANDERPLATZ', 52.5347, 13.4239, 'room', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128caa-bfd8-11f0-9b66-3c11a3fd0c43', 'cef8637f-5422-4089-9b2f-fb869408720f', 'MICHELLE HAWKINS • Student Stay', 'Comfortable apartment hosted by Michelle Hawkins in AMSTERDAM. Host account status: APPROVED.', 'NETHERLANDS', 'AMSTERDAM', '202 KEIZERSGRACHT', 52.3896, 4.9252, 'whole_apartment', 3, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128d72-bfd8-11f0-9b66-3c11a3fd0c43', '832794de-0511-4d24-9aa1-1d20d6c9ff78', 'MICHAEL MYERS • Student Stay', 'Comfortable room hosted by Michael Myers in BRUSSELS. Host account status: APPROVED.', 'BELGIUM', 'BRUSSELS', '203 GRAND PLACE', 50.8745, 4.3815, 'room', 4, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128e3a-bfd8-11f0-9b66-3c11a3fd0c43', '2f760c60-0317-4585-995c-e6f8a7d35530', 'TED FOWLER • Student Stay', 'Comfortable room hosted by Ted Fowler in BARCELONA. Host account status: APPROVED.', 'SPAIN', 'BARCELONA', '204 AVINGUDA DIAGONAL', 41.4194, 2.1978, 'room', 1, 'owner', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('5e128f0c-bfd8-11f0-9b66-3c11a3fd0c43', '83710363-2633-4264-8987-5600e20c1254', 'ALINA CRAIG • Student Stay', 'Comfortable apartment hosted by Alina Craig in PARIS. Host account status: APPROVED.', 'FRANCE', 'PARIS', '205 RUE DES ECOLES', 48.85, 2.35, 'whole_apartment', 2, 'renter', 'published', '2025-11-12 14:00:46', '2025-11-12 14:00:46'),
('64b00d2d-0729-4ba8-82fd-3d14bd362508', '357e760a-d08c-4078-be80-b6d8c819f56a', 'aaaaaaa', 'asjdsajdjksahkjd jasdjkajkd aka. kajdnajdnsjk', 'France', 'Issy-les-Moulineaux', 'Rue de Vanves 10', 48.8245686, 2.2799111, 'whole_apartment', 5, 'renter', 'published', '2025-12-10 13:12:47', '2025-12-10 13:13:54'),
('cda005f3-1952-4154-8225-e37c8d127412', '357e760a-d08c-4078-be80-b6d8c819f56a', 'asasdadsdadsa', 'as dadsadsdadsadsdadsadsdadsad', 'Croatia', 'Rijeka', 'Zametskog korena 1', 45.3496439, 14.3923288, 'whole_apartment', 1, 'owner', 'published', '2025-12-10 10:35:53', '2025-12-10 10:45:22');

-- --------------------------------------------------------

--
-- Table structure for table `listing_application`
--

CREATE TABLE `listing_application` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `applicant_id` bigint UNSIGNED NOT NULL,
  `applicant_profile_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('pending','accepted','rejected','withdrawn','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `active_applicant_id` bigint GENERATED ALWAYS AS ((case when (`status` in (_utf8mb4'pending',_utf8mb4'accepted')) then `applicant_id` else NULL end)) VIRTUAL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_application`
--

INSERT INTO `listing_application` (`id`, `listing_id`, `applicant_id`, `applicant_profile_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
('2dd478f4-bfc5-11f0-a648-52f5d85831eb', '2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 3, '236a8940-1475-48c4-a793-2e67c005bba8', '2025-09-01', '2026-06-30', 'withdrawn', '2025-11-12 11:43:24', '2025-11-12 12:00:41');

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
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 2),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 2),
('55601440-a79d-4789-8c4b-28cf907d3cc8', 2),
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
('229a6ed6-48cf-40f0-8fbe-9838cec23827', 3),
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 3),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 3),
('55601440-a79d-4789-8c4b-28cf907d3cc8', 3),
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
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 4),
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
('27275c1f-d439-4ca7-a1ff-9ea68853388f', 5),
('2a0687b5-f039-4509-9a84-6e16e297c64a', 5),
('2dcca07a-bfc5-11f0-a648-52f5d85831eb', 5),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 5),
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
('64b00d2d-0729-4ba8-82fd-3d14bd362508', 5),
('2a0687b5-f039-4509-9a84-6e16e297c64a', 6),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 6),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 6),
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
('cda005f3-1952-4154-8225-e37c8d127412', 6);

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
('368a6c85-988e-45e3-aca9-9875e6686777', '27275c1f-d439-4ca7-a1ff-9ea68853388f', '2025-12-18', '2025-12-10 10:31:14', NULL),
('505d312c-c413-473c-87a7-200417efaebf', '55601440-a79d-4789-8c4b-28cf907d3cc8', '2025-12-19', '2025-12-10 10:33:39', NULL),
('a116593a-cf33-4cee-89b1-19b2c121f492', '229a6ed6-48cf-40f0-8fbe-9838cec23827', '2025-12-28', '2025-12-10 10:57:28', NULL),
('a827b496-9a01-412d-a25d-36d88740c511', '64b00d2d-0729-4ba8-82fd-3d14bd362508', '2025-12-25', '2025-12-10 13:12:47', NULL),
('b083d744-4e42-4907-bb3d-93ecf8f5c05f', '4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', '2025-12-16', '2025-12-10 10:21:35', NULL),
('cb89f5d2-5736-4aac-9a49-4a825f3114f3', 'cda005f3-1952-4154-8225-e37c8d127412', '2026-01-24', '2025-12-10 10:35:53', NULL),
('fb6cdefd-1697-47c2-8362-4c3adbcae17e', '2a0687b5-f039-4509-9a84-6e16e297c64a', '2025-12-11', '2025-12-10 11:36:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `listing_image`
--

CREATE TABLE `listing_image` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` smallint DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_image`
--

INSERT INTO `listing_image` (`id`, `listing_id`, `image`, `position`, `created_at`) VALUES
('02502cdc-bfcd-415b-976c-28279fd65511', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c9f75.png', 7, '2025-12-10 10:57:28'),
('0bef0313-7ef2-4d88-96b9-7da02b065730', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c8d3e.png', 3, '2025-12-10 10:57:28'),
('19676c07-ba2f-44fb-b62a-bf1d1ddfe7c3', '64b00d2d-0729-4ba8-82fd-3d14bd362508', 'uploads/images/64b00d2d-0729-4ba8-82fd-3d14bd362508_693971cfe89ab.png', 1, '2025-12-10 13:12:47'),
('2312fda7-d765-471d-a354-a94de22e9e81', '64b00d2d-0729-4ba8-82fd-3d14bd362508', 'uploads/images/64b00d2d-0729-4ba8-82fd-3d14bd362508_693971cfeb2bf.png', 4, '2025-12-10 13:12:47'),
('26d2c4df-d430-49af-bf29-f340d19f13ac', '4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 'uploads/images/4444e5f7-6e72-4527-8d27-0b3d2b04cbfa_693949af719bb.png', 0, '2025-12-10 10:21:35'),
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
('3ee29622-7cc4-4a62-9c6f-d5218699f6e6', '64b00d2d-0729-4ba8-82fd-3d14bd362508', 'uploads/images/64b00d2d-0729-4ba8-82fd-3d14bd362508_693971cfe7844.png', 0, '2025-12-10 13:12:47'),
('414ac4e7-b773-46b8-8294-9f6e44b56118', 'cda005f3-1952-4154-8225-e37c8d127412', 'uploads/images/cda005f3-1952-4154-8225-e37c8d127412_69394d091d90b.png', 2, '2025-12-10 10:35:53'),
('56ba207c-49b3-45cb-9091-116bd22f7c1f', 'cda005f3-1952-4154-8225-e37c8d127412', 'uploads/images/cda005f3-1952-4154-8225-e37c8d127412_69394d091c50b.png', 1, '2025-12-10 10:35:53'),
('5dab18b7-39d6-4f4c-bf40-5704159ba406', '27275c1f-d439-4ca7-a1ff-9ea68853388f', 'uploads/images/27275c1f-d439-4ca7-a1ff-9ea68853388f_69394bf25a64a.png', 1, '2025-12-10 10:31:14'),
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
('5ffad2e5-93f2-4df6-8aee-b1651e7b5acb', '55601440-a79d-4789-8c4b-28cf907d3cc8', 'uploads/images/55601440-a79d-4789-8c4b-28cf907d3cc8_69394c8316758.png', 0, '2025-12-10 10:33:39'),
('64438a40-7fe7-4cf7-a04f-7184c340ac51', '4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 'uploads/images/4444e5f7-6e72-4527-8d27-0b3d2b04cbfa_693949af72227.png', 3, '2025-12-10 10:21:35'),
('68866fe8-3fc9-411b-8b7c-6496dcb68523', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c9be2.png', 6, '2025-12-10 10:57:28'),
('6a6b2a2b-b6b4-4ef2-9c36-bc4167f6b408', '2a0687b5-f039-4509-9a84-6e16e297c64a', 'uploads/images/2a0687b5-f039-4509-9a84-6e16e297c64a_69395b51a02fb.png', 0, '2025-12-10 11:36:49'),
('6aeaa48c-bf5c-4fd0-8f09-eb293ace4e11', '55601440-a79d-4789-8c4b-28cf907d3cc8', 'uploads/images/55601440-a79d-4789-8c4b-28cf907d3cc8_69394c8318025.png', 2, '2025-12-10 10:33:39'),
('6de7f78a-a2c0-481b-82f1-6b302a427255', '27275c1f-d439-4ca7-a1ff-9ea68853388f', 'uploads/images/27275c1f-d439-4ca7-a1ff-9ea68853388f_69394bf259c01.png', 0, '2025-12-10 10:31:14'),
('71b1c580-0a1c-476b-baa6-bc3756e312a5', '27275c1f-d439-4ca7-a1ff-9ea68853388f', 'uploads/images/27275c1f-d439-4ca7-a1ff-9ea68853388f_69394bf25bc2f.png', 3, '2025-12-10 10:31:14'),
('77cc9425-9c96-4f48-b58f-ec9497edbddc', '55601440-a79d-4789-8c4b-28cf907d3cc8', 'uploads/images/55601440-a79d-4789-8c4b-28cf907d3cc8_69394c831765f.png', 1, '2025-12-10 10:33:39'),
('7d9a3d79-27ef-4ae8-874d-2f263ed02fc9', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c97c7.png', 5, '2025-12-10 10:57:28'),
('8a473a85-ec47-4003-b5f6-cb9aa13bc10a', '55601440-a79d-4789-8c4b-28cf907d3cc8', 'uploads/images/55601440-a79d-4789-8c4b-28cf907d3cc8_69394c8318b5e.png', 3, '2025-12-10 10:33:39'),
('9f502da5-8075-4e9e-9f9c-c296adee2e17', '64b00d2d-0729-4ba8-82fd-3d14bd362508', 'uploads/images/64b00d2d-0729-4ba8-82fd-3d14bd362508_693971cfea253.png', 3, '2025-12-10 13:12:47'),
('a4e9ca97-5d93-4a02-a014-088eace6566a', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c9324.png', 4, '2025-12-10 10:57:28'),
('a4fcf32e-26d6-4050-96b5-698c61d6dee7', '64b00d2d-0729-4ba8-82fd-3d14bd362508', 'uploads/images/64b00d2d-0729-4ba8-82fd-3d14bd362508_693971cfe9368.png', 2, '2025-12-10 13:12:47'),
('ab971d7a-a732-4818-8dd1-eae8fec265c1', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c8072.png', 0, '2025-12-10 10:57:28'),
('b01b9cd6-de61-4b39-b2c4-8a50733e4a71', '2a0687b5-f039-4509-9a84-6e16e297c64a', 'uploads/images/2a0687b5-f039-4509-9a84-6e16e297c64a_69395b51a0df1.png', 1, '2025-12-10 11:36:49'),
('b405a623-c42c-4249-9583-2e22f90b61ea', '2a0687b5-f039-4509-9a84-6e16e297c64a', 'uploads/images/2a0687b5-f039-4509-9a84-6e16e297c64a_69395b51a18d7.png', 2, '2025-12-10 11:36:49'),
('bb68bb51-f8b0-400c-84f7-6521e329a920', '27275c1f-d439-4ca7-a1ff-9ea68853388f', 'uploads/images/27275c1f-d439-4ca7-a1ff-9ea68853388f_69394bf25b461.png', 2, '2025-12-10 10:31:14'),
('c185735f-d379-443c-8d0f-dce4381d9aa4', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c8476.png', 1, '2025-12-10 10:57:28'),
('c8c87621-d731-438a-bfb1-7bb468c80c65', '4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 'uploads/images/4444e5f7-6e72-4527-8d27-0b3d2b04cbfa_693949af7246b.png', 4, '2025-12-10 10:21:35'),
('cabb643b-0c49-45aa-abb0-45d9a592e905', 'cda005f3-1952-4154-8225-e37c8d127412', 'uploads/images/cda005f3-1952-4154-8225-e37c8d127412_69394d091adea.png', 0, '2025-12-10 10:35:53'),
('dbf0f2a0-6a24-4d53-bbed-9ad5baccab22', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218c88ad.png', 2, '2025-12-10 10:57:28'),
('de3d23eb-48e4-4ae0-ac04-ed99b16677ae', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 'uploads/images/229a6ed6-48cf-40f0-8fbe-9838cec23827_69395218ca263.png', 8, '2025-12-10 10:57:28'),
('dfe696b1-8484-4295-8742-82ded1a83de4', '4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 'uploads/images/4444e5f7-6e72-4527-8d27-0b3d2b04cbfa_693949af72072.png', 2, '2025-12-10 10:21:35'),
('e5c66071-be78-4f35-9924-039c44a68bdb', '4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 'uploads/images/4444e5f7-6e72-4527-8d27-0b3d2b04cbfa_693949af71d8f.png', 1, '2025-12-10 10:21:35'),
('e79eeb45-d917-4d12-83a5-e65d4ab54ab5', '2a0687b5-f039-4509-9a84-6e16e297c64a', 'uploads/images/2a0687b5-f039-4509-9a84-6e16e297c64a_69395b51a3115.png', 4, '2025-12-10 11:36:49'),
('ee2eb4ee-9d7f-46c5-b28f-8d2dc2a2feba', '2a0687b5-f039-4509-9a84-6e16e297c64a', 'uploads/images/2a0687b5-f039-4509-9a84-6e16e297c64a_69395b51a247b.png', 3, '2025-12-10 11:36:49');

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
('229a6ed6-48cf-40f0-8fbe-9838cec23827', 1),
('27275c1f-d439-4ca7-a1ff-9ea68853388f', 1),
('2dcaeb54-bfc5-11f0-a648-52f5d85831eb', 1),
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
('64b00d2d-0729-4ba8-82fd-3d14bd362508', 1),
('27275c1f-d439-4ca7-a1ff-9ea68853388f', 2),
('2a0687b5-f039-4509-9a84-6e16e297c64a', 2),
('2dcbb778-bfc5-11f0-a648-52f5d85831eb', 2),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 2),
('55601440-a79d-4789-8c4b-28cf907d3cc8', 2),
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
('64b00d2d-0729-4ba8-82fd-3d14bd362508', 2),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 3),
('55601440-a79d-4789-8c4b-28cf907d3cc8', 3),
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
('229a6ed6-48cf-40f0-8fbe-9838cec23827', 5),
('27275c1f-d439-4ca7-a1ff-9ea68853388f', 5),
('2a0687b5-f039-4509-9a84-6e16e297c64a', 5),
('4444e5f7-6e72-4527-8d27-0b3d2b04cbfa', 5),
('55601440-a79d-4789-8c4b-28cf907d3cc8', 5),
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
('64b00d2d-0729-4ba8-82fd-3d14bd362508', 5),
('cda005f3-1952-4154-8225-e37c8d127412', 5);

-- --------------------------------------------------------

--
-- Table structure for table `listing_verification_document`
--

CREATE TABLE `listing_verification_document` (
  `id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL DEFAULT (uuid()),
  `listing_id` char(36) CHARACTER SET ascii COLLATE ascii_general_ci NOT NULL,
  `document_type_id` smallint DEFAULT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_verification_document`
--

INSERT INTO `listing_verification_document` (`id`, `listing_id`, `document_type_id`, `document`, `created_at`, `verified_at`) VALUES
('29ee1e1b-56c1-47cd-b9a6-f4bebfc2a1e5', '2a0687b5-f039-4509-9a84-6e16e297c64a', 5, 'uploads/verification_docs/2a0687b5-f039-4509-9a84-6e16e297c64a_verification_69395b51a3d3b.pdf', '2025-12-10 11:36:49', NULL),
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
('ee2481c2-755f-48e1-9ad9-9d238ef03788', '64b00d2d-0729-4ba8-82fd-3d14bd362508', 5, 'uploads/verification_docs/64b00d2d-0729-4ba8-82fd-3d14bd362508_verification_693971cfecc97.pdf', '2025-12-10 13:12:47', NULL),
('f4cc948d-2e22-4ad6-8bed-e827317768b7', '229a6ed6-48cf-40f0-8fbe-9838cec23827', 5, 'uploads/verification_docs/229a6ed6-48cf-40f0-8fbe-9838cec23827_verification_69395218ca4c0.pdf', '2025-12-10 10:57:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` smallint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci
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
  `document_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_document`
--

INSERT INTO `user_document` (`id`, `account_id`, `document_type_id`, `document_path`, `created_at`) VALUES
('05adc3fc-823c-43e8-b19e-02598a512c37', 113, 1, '/uploads/documents/id/af09866a-1970-45c4-979f-e9f8d5b7f915.png', '2025-12-10 10:15:40'),
('32641faf-efeb-4689-8b31-2efabf175435', 111, 2, '/uploads/documents/student/65535308-c4cf-48d3-b2b6-71b38ecd4613.png', '2025-12-08 01:03:26'),
('52ccaa3c-1eb5-43b6-b561-bfafaf7f6abf', 2, 2, 'user_docs/101001010101010.pdf', '2025-12-07 17:55:16'),
('5fd0a4b0-345e-401e-b123-f821d2ebda84', 111, 1, '/uploads/documents/id/97d0202e-7d54-4778-8bc6-043d2dd2ce30.png', '2025-12-08 01:03:26'),
('713acd02-6499-4137-ad11-3afe24d8df43', 112, 1, '/uploads/documents/id/9fcda375-ea85-45a0-ad74-f446d395a7af.png', '2025-12-09 21:57:18'),
('b18f7911-e0c7-49ba-a9a4-2bde740e046b', 112, 2, '/uploads/documents/student/d291f6e9-f442-4452-97e8-3021ea6c238c.png', '2025-12-09 21:57:18'),
('d396fb13-8232-4a17-86d9-3f8dd8074c8f', 4, 2, 'user_docs/0101010010110.jpg', '2025-12-07 17:55:16'),
('ebcf9172-dd65-414f-b0e2-1b364f6e4ca7', 3, 1, 'user_docs/110101001.png', '2025-12-07 17:55:16'),
('f9234066-32f5-410e-bfdf-9d4ea1d73c3d', 113, 2, '/uploads/documents/student/89868fa5-b367-42d3-a8e0-63d3f4ad3f3c.png', '2025-12-10 10:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` char(36) NOT NULL,
  `account_id` bigint UNSIGNED NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_picture` longblob,
  `phone` varchar(32) DEFAULT NULL,
  `bio` text,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `account_id`, `first_name`, `last_name`, `profile_picture`, `phone`, `bio`, `city`, `country`, `created_at`, `updated_at`) VALUES
('04cdf8c2-80fa-4eb5-9c44-d22e8c9d204b', 111, 'Nikola', 'Batre', NULL, NULL, NULL, NULL, NULL, '2025-12-08 01:03:26', '2025-12-08 01:03:26'),
('0b23e575-89c4-46d0-bb77-91d3d7700365', 28, 'Roman', 'Wright', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('13783aeb-eab3-4feb-8cc4-63088c54af33', 44, 'Marcus', 'Roberts', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('179593fe-5eea-4740-bd77-549fc4a015ed', 14, 'Henry', 'Murray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('20125d2e-2aa5-4d46-85d8-d0b7e295f270', 10, 'George', 'Holmes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('2027817b-9eb4-48d3-961a-808631ffc52c', 78, 'Deanna', 'Phillips', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('236a8940-1475-48c4-a793-2e67c005bba8', 3, 'SURESH', 'TESTER', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('280988fa-8f35-48a1-b8f8-16d0c7cf2777', 74, 'Penelope', 'Russell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('2a6621b7-a0d2-403b-ac83-3c8f3944bfbf', 42, 'Adam', 'Gray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('2a74da3b-389e-4d79-a1e2-d4d103226cfb', 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-07 23:58:20', '2025-12-07 23:58:20'),
('2ec08256-3c19-4a57-854b-b835880a963e', 69, 'Lucy', 'Chapman', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('2f760c60-0317-4585-995c-e6f8a7d35530', 104, 'Ted', 'Fowler', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('32bba3a2-6ecb-4411-9e9d-a56238de5cf4', 5, 'Tony', 'Murray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('332700ca-7bb8-42db-8894-999cc144375f', 109, 'Nikola', 'Batre', NULL, NULL, NULL, NULL, NULL, '2025-12-08 00:46:23', '2025-12-08 00:46:23'),
('34b2bb02-8adc-446c-b219-466627542292', 37, 'Miranda', 'Perry', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('357e760a-d08c-4078-be80-b6d8c819f56a', 113, 'Nikola', 'Bare', NULL, NULL, NULL, NULL, NULL, '2025-12-10 10:15:40', '2025-12-10 10:15:40'),
('36ece217-9ef1-4f6d-9e05-27dfc17e2b15', 91, 'Nicholas', 'Alexander', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('37384438-14ac-4066-9bbe-d15934c64acf', 36, 'Abraham', 'Cole', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('3cd1f40c-dc0f-4955-b473-2d84ab89b73f', 20, 'Miranda', 'Myers', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('3fb74c36-eb37-4d36-8bf7-38118ba0e12a', 79, 'Ryan', 'Ross', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('407b7b25-d201-4e49-8084-52f0a9ab633a', 68, 'Ryan', 'Cunningham', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('40d6c7e2-37cb-437a-90c9-fbb4b2fb1661', 60, 'Edward', 'Moore', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('42c9a0c7-be34-4375-a6ae-5006be89ea8f', 49, 'Jacob', 'Morgan', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('4437f3e7-cfb9-4df0-8704-357504968741', 66, 'Kelsey', 'Craig', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('4454ecc1-cc49-419d-9c3c-75c9257b23ec', 70, 'Daisy', 'Russell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('4475d178-1506-43bc-9d1f-0b5df1aacab0', 112, 'N', 'B', NULL, NULL, NULL, NULL, NULL, '2025-12-09 21:57:18', '2025-12-09 21:57:18'),
('45117b65-3d55-4b61-8feb-5ed7f4c654a9', 88, 'Aldus', 'Casey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('4741084c-90c6-4b0f-a6d5-811f13495825', 25, 'Dainton', 'Tucker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('49b62029-c9fe-48c0-b81a-760f45372054', 7, 'Nicole', 'Barnes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('607876cd-dd91-4689-abf2-0a67dbba2915', 16, 'Sophia', 'Holmes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('627fe270-d240-4f20-a860-7fba390f562c', 34, 'Elise', 'Richardson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('63eca209-eb5c-4d42-b650-3d7526273b1a', 11, 'Leonardo', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6701656c-5a89-4d41-9353-66880f3257f0', 93, 'Lyndon', 'Gray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6813fc4c-9e78-4bf8-a533-ddbef4846429', 72, 'Miley', 'Warren', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('687dad09-5a5b-475a-922c-21f90f99c50b', 81, 'Reid', 'Turner', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6a1e0fb7-4c5f-46c5-877a-9e000a32f358', 17, 'Patrick', 'Casey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6a8d2833-4280-4d20-9a24-8255123e8cda', 83, 'Miller', 'Fowler', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6aaa8d59-1799-4cf4-bbe7-9922f536bff5', 38, 'Rafael', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6b1954e8-0dbf-4c68-b762-4d91e30a6cb9', 65, 'Adrian', 'Wells', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('6c4807cc-f0e1-4aef-aff0-075c7c09b1dd', 22, 'Steven', 'Craig', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('71d3fbd3-5b31-42e1-bb87-bbc53459ac48', 63, 'Carlos', 'Richardson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('76f9b842-0692-40fb-9893-b336803841ec', 30, 'Nicole', 'Parker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('79927f79-10ca-488a-a34b-34608e3111f9', 31, 'April', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('7b331d60-6522-4a40-acec-940bbee81c89', 82, 'Amelia', 'Parker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('7b92d17d-f6ea-4b34-bdab-c184fc69cc31', 61, 'Kevin', 'Spencer', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('7f2db7f8-dabd-45c2-93ff-8f86796dc552', 73, 'Sydney', 'Mitchell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('7f782e61-5f5c-408b-ac05-9ed5c58698d6', 57, 'Alexia', 'Harper', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('7f9b83fe-3ee9-4a1a-977d-f772697511f3', 95, 'Agata', 'Ryan', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('82f55787-20ca-4552-9549-9f9fd4f24243', 100, 'Darcy', 'Phillips', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('832794de-0511-4d24-9aa1-1d20d6c9ff78', 103, 'Michael', 'Myers', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('83290a01-a6c3-4e36-802e-dec89b0a8c43', 99, 'Violet', 'Walker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('83710363-2633-4264-8987-5600e20c1254', 105, 'Alina', 'Craig', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('8490dc56-8e97-4278-b84a-aac06a4595eb', 50, 'Deanna', 'Fowler', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('8f4fe2e2-e42b-4bae-9953-6f72a9e6b1ea', 35, 'Stuart', 'Anderson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('91484a59-2820-4572-94a4-60329b5c898f', 21, 'Justin', 'Morrison', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9419f24d-9875-4a88-a059-616d5261c67e', 33, 'Alen', 'Foster', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9463d8c6-fbf8-48d3-aa49-7edf12b531f8', 1, 'ADMIN', 'ADMINSON', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9a9ba8e0-2ad6-4840-8755-2515765385f0', 86, 'Garry', 'Myers', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9c876b21-4e7f-4eb0-8f0c-ac2ca8c0bf34', 23, 'Honey', 'Edwards', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9cde0988-2517-4e85-bf51-e808beb2ee22', 71, 'Kellan', 'Edwards', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9cec3df4-b8c5-48e5-8b31-a6f15edd152e', 87, 'Rafael', 'Tucker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9d6ad805-dabc-487c-b6d4-095f3e7faccb', 53, 'Ellia', 'Martin', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9ed79eb6-91f0-4279-aa08-34cc7dd4528c', 80, 'Daisy', 'Baker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('9f189f5a-a1f7-484c-b50f-718f2bf89061', 96, 'Emily', 'Jones', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a198dd45-7df8-45a3-87c9-9dccdb500f26', 39, 'Alfred', 'Mason', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a1f7c2d2-ebbe-4bfa-8def-96b0aba7e543', 64, 'Alissa', 'Murray', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a210715b-ab0c-49ab-b37f-54787f7bc76a', 59, 'Lucy', 'Montgomery', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a26a1ad6-fabb-491d-91b8-bf42e94ebfd1', 24, 'Alfred', 'Douglas', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a42443d3-70fe-47e7-a10b-49c3c7272e96', 12, 'Arthur', 'Hall', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a45b64c2-81d7-4887-afdb-17d88a69c8af', 97, 'Jordan', 'Hamilton', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a6f27d29-4a13-453c-a281-2e387a736868', 94, 'Elise', 'Murphy', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a703687c-fc58-4449-a400-0d0ae477ad52', 77, 'Eric', 'Johnston', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('a8803f2c-cec4-49ce-ac84-aa37a14ce458', 89, 'Jared', 'Morrison', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('ac6323d9-893a-4c0a-a733-fb8354a1b623', 67, 'Amber', 'Montgomery', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('b2ae7561-d56f-498a-9d69-cf194dde8a35', 27, 'Mike', 'Moore', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('b429f253-cee8-45ce-81b7-e5acf8f4eebb', 4, 'ARIF', 'TUPLE', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('b622405e-4ed5-4256-91de-8f3942e778ee', 26, 'Penelope', 'Thomas', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('bdf11e6d-f0df-4c19-940d-67347d395911', 85, 'Adelaide', 'Clark', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('be0267ae-304e-40a7-949a-50bbec15936e', 2, 'ALEKSANDRE', 'TEST', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('be8aefa6-78a6-49af-94b8-e240ad313c81', 107, 'test', 'test', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('bea6d221-5cb6-462f-b14d-66e36a056dbd', 15, 'Victoria', 'Morris', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('bf3f11b4-e104-4c29-a73a-b8139a7afc75', 47, 'Rubie', 'Morrison', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('c2bc6777-4f25-4e2b-bf67-86726508a709', 90, 'Garry', 'Jones', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('c6b62737-c60d-4a17-98d4-2af851a9279c', 18, 'Adison', 'Barnes', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('c8633364-e226-4946-ae0c-2c33b7e4681e', 29, 'Catherine', 'Lloyd', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('cc59fea3-0f51-4734-8912-497ad38c2df1', 13, 'Amy', 'Higgins', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('cdd6f3ec-bb8e-4b29-9741-cd360a352181', 32, 'Spike', 'Farrell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('cef8637f-5422-4089-9b2f-fb869408720f', 102, 'Michelle', 'Hawkins', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('cfb67e61-3de6-470f-b758-72862fa0cda2', 54, 'Ryan', 'Bailey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('d1c2de54-53ea-4d93-ad65-1ad338808a8b', 106, 'Nikola', 'Baretic', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('d44b4cdf-91b1-4d13-93db-0aff09c3b3e2', 84, 'Martin', 'Ryan', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('d57dc4f3-cb55-4016-890c-1d42fb397c5f', 76, 'Adele', 'Reed', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('d5ef263d-8c25-4432-984e-9e6cf79836e6', 19, 'Violet', 'Owens', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('dbd65d6b-925f-4c27-a7da-792494ca25c4', 62, 'Vanessa', 'Ferguson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('dbf85fbd-7a28-4574-bfa7-6517fd3f64b6', 48, 'Jordan', 'Andrews', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('ddb8147f-6323-4be0-b6a3-67e0b16f2a46', 101, 'Alexander', 'Mitchell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('e01d9e90-261e-4a75-95f9-31a3acd70758', 75, 'Tyler', 'Bennett', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('e0af6061-f210-491b-9205-b20b07520095', 46, 'Dexter', 'Martin', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('e2b4427d-b619-4fea-972d-68996aed4df7', 9, 'Frederick', 'Wilson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('e8d526f8-1274-4aca-afc6-bb9ecff78fda', 45, 'Steven', 'Crawford', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('eaa50618-cb38-42a3-9ed4-f5f04a6e8c01', 52, 'Stella', 'Bailey', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('eb0a7e62-b629-4510-a91b-38ff24b640ac', 98, 'Maximilian', 'Johnson', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('ec345aad-8c4c-464c-8267-d9ffe8da8990', 58, 'Dale', 'Miller', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('ee637bb3-8f78-4436-8d21-52c6f543070f', 110, 'Nikola', 'Batre', NULL, NULL, NULL, NULL, NULL, '2025-12-08 01:01:52', '2025-12-08 01:01:52'),
('ee8aa2d6-8f66-456d-a4c4-4285f5b6c3ed', 56, 'Maya', 'Roberts', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('eecde76a-9fd1-4299-a898-f54fe6c2af80', 92, 'Abigail', 'Spencer', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('f25392bf-47c6-4039-91de-4462a2d5edfb', 43, 'Nicholas', 'Scott', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('f4343da9-11c0-40f9-9fe7-ad6efd1f492d', 8, 'Penelope', 'Farrell', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('f5aa2129-f01c-45d5-9709-84c6e66c7bdf', 40, 'Adrian', 'Brown', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('fb594dc6-c736-423d-ad0f-63ff7fefa338', 55, 'Kristian', 'Taylor', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('fd430601-9895-4cc7-90c1-67733be8a5a6', 41, 'Stella', 'Ross', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16'),
('ffd2e4dd-d3d5-4681-bd6b-bf9f0d44ce15', 51, 'Adrianna', 'Tucker', NULL, NULL, NULL, NULL, NULL, '2025-12-07 17:55:16', '2025-12-07 17:55:16');

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` smallint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

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
