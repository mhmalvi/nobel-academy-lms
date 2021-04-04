-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 04, 2021 at 11:41 AM
-- Server version: 5.7.33-log
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntanswed_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action_user` bigint(20) UNSIGNED DEFAULT NULL,
  `course_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `course_units` int(11) DEFAULT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci,
  `is_published` enum('y','n') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'n',
  `total_enrolled` int(11) NOT NULL DEFAULT '0',
  `total_teachers` int(11) NOT NULL DEFAULT '0',
  `total_files` int(11) NOT NULL DEFAULT '0',
  `course_thumbnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`action_user`, `course_code`, `course_name`, `course_category_id`, `course_units`, `descriptions`, `is_published`, `total_enrolled`, `total_teachers`, `total_files`, `course_thumbnail`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SHB50115', 'Diploma Of Beauty Therapy', 1, 25, '<p>This qualification reflects the role of individuals employed as beauty therapists to provide a broad range of beauty therapy treatments and services including facial treatments, body massage and treatments, hair removal, lash and brow treatments, nail and make-up services. This includes consultation with clients to provide beauty advice, recommend beauty treatments and services, and sell retail skin-care and cosmetic products. These individuals work relatively autonomously, and are accountable for personal outputs. Their work involves the self-directed application of knowledge and skills with substantial depth in some areas where judgement is required in planning and selecting appropriate equipment, services and techniques. Work is typically conducted in beauty salons and spas. No occupational licensing, certification or specific legislative requirements apply to this qualification at the time of publication.</p>', 'n', 0, 0, 0, 'SHB50115_090321.jpg', '2021-03-09 11:55:55', '2021-03-09 11:55:55', NULL),
(1, 'SHB30416', 'Certificate Iii In Hairdressing', 2, 28, '<p><span style=\"font-size: 14px;\">This qualification reflects the role of hairdressers who use a range of well-developed sales, consultation and technical skills and knowledge to provide a broad range of hairdressing services to clients. They use discretion and judgment to provide client services and take responsibility for the outcomes of their own work. This qualification provides a pathway to work as a hairdresser in any industry environment, usually a salon. No occupational licensing, certification or specific legislative requirements apply to this qualification at the time of publication.</span><br></p>', 'n', 0, 0, 0, 'SHB30416_100321.jpg', '2021-03-10 07:26:00', '2021-03-10 07:26:00', NULL),
(1, 'HLT52015', 'Diploma Of Remedial Massage', 1, 21, '<p><span style=\"font-size: 14px;\">This qualification reflects the role of remedial massage therapists who work with clients presenting with soft tissue dysfunction, musculoskeletal imbalance or restrictions in range of motion (ROM). Practitioners may be self-employed or work within a larger health service. To achieve this qualification, the candidate must have completed at least 200 hours of work as detailed in the Assessment Requirements of units of competency. No licensing, legislative, regulatory or certification requirements apply to this qualification at the time of publication.</span><br></p>', 'n', 0, 0, 0, 'HLT52015_100321.jpg', '2021-03-10 08:01:57', '2021-03-10 08:01:57', NULL),
(1, 'SHB40115', 'Certificate Iv In Beauty Therapy', 3, 19, '<p style=\"text-align: justify; \"><span style=\"font-size: 14px;\">This qualification reflects the role of individuals who work as beauty therapists to provide a range of beauty therapy treatments and services, including lash and brow treatments, nail services, make-up, massage and waxing. They communicate with clients to recommend treatments and services and sell retail skin care and cosmetic products. These individuals undertake work independently, with limited guidance from others, to perform routine and non-routine activities and solve non-routine problems. They apply and adapt technical skills and knowledge, and use judgment in the provision of beauty treatments and services. These individuals are responsible for their own outputs and provide limited guidance to others. Work is typically conducted in beauty salons and spas. No occupational licensing, certification or specific legislative requirements apply to this qualification at the time of publication.</span><br></p>', 'n', 0, 0, 0, 'SHB40115_100321.jpg', '2021-03-10 08:03:06', '2021-03-10 08:03:06', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_action_user_foreign` (`action_user`),
  ADD KEY `courses_course_category_id_foreign` (`course_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_action_user_foreign` FOREIGN KEY (`action_user`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `courses_course_category_id_foreign` FOREIGN KEY (`course_category_id`) REFERENCES `course_categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
