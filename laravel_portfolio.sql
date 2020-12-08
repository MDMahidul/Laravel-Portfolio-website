-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2020 at 06:18 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_portfolio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `username`, `email`) VALUES
(1, 'admin', '1234', 'admin', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_mobile` varchar(255) NOT NULL,
  `contact_email` varchar(255) NOT NULL,
  `contact_msg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `contact_name`, `contact_mobile`, `contact_email`, `contact_msg`) VALUES
(2, 'mahidul', 'fff', 'dddd', 'ddd'),
(3, 'm1', 'm1', 'm1', 'm1'),
(4, 'm1', 'm1', 'm1', 'm1'),
(5, 'm1', 'm1', 'm1', 'm1'),
(8, 'mahidul', '12313', 'jdjdjd', 'dsdf');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_des` varchar(255) NOT NULL,
  `course_fee` varchar(255) NOT NULL,
  `course_totalenroll` varchar(255) NOT NULL,
  `course_totalclass` varchar(255) NOT NULL,
  `course_link` varchar(255) NOT NULL,
  `course_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_des`, `course_fee`, `course_totalenroll`, `course_totalclass`, `course_link`, `course_img`) VALUES
(1, 'লারাভেল এবং প্রোজেক্ট', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক', 'কোর্স ফি ৫০০ /-', 'মোট শিক্ষার্থী ২০০', 'মোট ক্লাস ১০২ টি', 'laravel.rabbil.com', 'images/laravel.jpg'),
(2, ' লারাভেল এবং প্রোজেক্ট', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক ', 'কোর্স ফি ৫০০ /-', 'মোট শিক্ষার্থী ২০০', 'মোট ক্লাস ১০০ টি', 'laravel.rabbil.com', 'images/android.jpg'),
(3, ' লারাভেল এবং প্রোজেক্ট', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক ', 'কোর্স ফি ৫০০ /-', 'মোট শিক্ষার্থী ২০০', 'মোট ক্লাস ১০০ টি', 'laravel.rabbil.com', 'images/react.jpg'),
(4, ' লারাভেল এবং প্রোজেক্ট', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক ', 'কোর্স ফি ৫০০ /-', 'মোট শিক্ষার্থী ২০০', 'মোট ক্লাস ১০০ টি', 'laravel.rabbil.com', 'images/android.jpg'),
(5, ' লারাভেল এবং প্রোজেক্ট', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক ', 'কোর্স ফি ৫০০ /-', 'মোট শিক্ষার্থী ২০০', 'মোট ক্লাস ১০০ টি', 'laravel.rabbil.com', 'images/react.jpg'),
(6, ' লারাভেল এবং প্রোজেক্ট', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক ', 'কোর্স ফি ৫০০ /-', 'মোট শিক্ষার্থী ২০০', 'মোট ক্লাস ১০০ টি', 'laravel.rabbil.com', 'images/android.jpg'),
(7, 'লারাভেল এবং প্রোজেক্ট 4', 'আইটি কোর্স, প্রজেক্ট ভিত্তিক', '420', '420', '420', 'Test 1', 'images/laravel.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_11_30_150910_admin_table', 1),
(2, '2020_12_01_095532_photo_table', 2),
(3, '2020_11_12_142804_visitor_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE `photo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`id`, `location`) VALUES
(92, 'http://127.0.0.1:8000/storage/BBB9Iwo7sCAaGLqgEQk3OZcx49K2pJhYaPnxUd4M.jpeg'),
(93, 'http://127.0.0.1:8000/storage/MGaR4ftR80E8k4yoyLkYkWEiUo6wBos2pA5ULlKB.jpeg'),
(94, 'http://127.0.0.1:8000/storage/VKSHFS20ftKvipQIbysMbnnq6UwswpQFsHlbTipq.jpeg'),
(95, 'http://127.0.0.1:8000/storage/NF33oa0B0en7bifpeanlH7VIcUb4LVE7ntEvD0dg.jpeg'),
(96, 'http://127.0.0.1:8000/storage/cb4J6Fm8zh12EOMmr6o7cwuvA8Q5zSiN0eCoEx6j.jpeg'),
(97, 'http://127.0.0.1:8000/storage/cq73I8hQiahzQ4OlcPqCyOk6BImRhTkfwnCMcX0X.jpeg'),
(99, 'http://127.0.0.1:8000/storage/BBB9Iwo7sCAaGLqgEQk3OZcx49K2pJhYaPnxUd4M.jpeg'),
(100, 'http://127.0.0.1:8000/storage/MGaR4ftR80E8k4yoyLkYkWEiUo6wBos2pA5ULlKB.jpeg'),
(101, 'http://127.0.0.1:8000/storage/VKSHFS20ftKvipQIbysMbnnq6UwswpQFsHlbTipq.jpeg'),
(102, 'http://127.0.0.1:8000/storage/NF33oa0B0en7bifpeanlH7VIcUb4LVE7ntEvD0dg.jpeg'),
(103, 'http://127.0.0.1:8000/storage/cb4J6Fm8zh12EOMmr6o7cwuvA8Q5zSiN0eCoEx6j.jpeg'),
(104, 'http://127.0.0.1:8000/storage/cq73I8hQiahzQ4OlcPqCyOk6BImRhTkfwnCMcX0X.jpeg'),
(105, 'http://127.0.0.1:8000/storage/6mQ7labaQOZWNJpk67g91z5tdpZP1734ZpbZPL8I.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_des` varchar(255) NOT NULL,
  `project_link` varchar(255) NOT NULL,
  `project_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `project_des`, `project_link`, `project_img`) VALUES
(1, 'আইটি কোর্স', 'মোবাইল  এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট ', 'codeselicon.com', 'images/poject.jpg'),
(2, 'আইটি কোর্স 2', 'মোবাইল  এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'codeselicon.com', 'images/poject.jpg'),
(3, 'আইটি কোর্স 3', 'মোবাইল  এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট ', 'codeselicon.com', 'images/poject.jpg'),
(4, 'আইটি কোর্স 4', 'মোবাইল  এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট ', 'codeselicon.com', 'images/poject.jpg'),
(5, 'আইটি কোর্স 5', 'মোবাইল  এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট ', 'codeselicon.com', 'images/poject.jpg'),
(6, 'আইটি কোর্স 6', 'মোবাইল  এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট ', 'codeselicon.com', 'images/poject.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(500) NOT NULL,
  `des` varchar(2000) NOT NULL,
  `img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `des`, `img`) VALUES
(1, 'বিল গেটস D', 'মাইক্রোসফটের প্রতিষ্ঠাতা বিল গেটসের জীবন কেটেছে নানা ঘটনার মধ্য দিয়ে। হার্ভার্ড বিশ্ববিদ্যালয়ে লেখাপড়া শেষ না করেই মাইক্রোসফট প্রতিষ্ঠা করা', 'images/bill.jpg'),
(2, 'বিল গেটস ', 'মাইক্রোসফটের প্রতিষ্ঠাতা বিল গেটসের জীবন কেটেছে নানা ঘটনার মধ্য দিয়ে। হার্ভার্ড বিশ্ববিদ্যালয়ে লেখাপড়া শেষ না করেই মাইক্রোসফট প্রতিষ্ঠা করা', 'images/bill.jpg'),
(3, 'বিল গেটস ', 'মাইক্রোসফটের প্রতিষ্ঠাতা বিল গেটসের জীবন কেটেছে নানা ঘটনার মধ্য দিয়ে। হার্ভার্ড বিশ্ববিদ্যালয়ে লেখাপড়া শেষ না করেই মাইক্রোসফট প্রতিষ্ঠা করা', 'images/bill.jpg'),
(4, 'বিল গেটস ', 'মাইক্রোসফটের প্রতিষ্ঠাতা বিল গেটসের জীবন কেটেছে নানা ঘটনার মধ্য দিয়ে। হার্ভার্ড বিশ্ববিদ্যালয়ে লেখাপড়া শেষ না করেই মাইক্রোসফট প্রতিষ্ঠা করা', 'images/bill.jpg'),
(5, 'বিল গেটস v', 'মাইক্রোসফটের প্রতিষ্ঠাতা বিল গেটসের জীবন কেটেছে নানা ঘটনার মধ্য দিয়ে। হার্ভার্ড বিশ্ববিদ্যালয়ে লেখাপড়া শেষ না করেই মাইক্রোসফট প্রতিষ্ঠা করা', 'images/bill.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_des` varchar(255) NOT NULL,
  `service_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_des`, `service_img`) VALUES
(1, 'আইটি কোর্স U', 'মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'images/knowledge.svg'),
(3, 'সোর্স কোড D', 'মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'images/code.svg'),
(4, 'ইন্টারফেস U', 'মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'images/graphic.svg'),
(7, 'কাস্টম সার্ভিস', 'মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'images/custom.svg'),
(8, 'কাস্টম সার্ভিসup2', 'মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'images/custom.svg'),
(11, 'কাস্টম সার্ভিস up1', 'মোবাইল এবং ওয়েব এপ্লিকেশন ডেভেলপমেন্ট', 'images/custom.svg'),
(12, 'Test 20', 'Test Des 20', 'images/custom.svg');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `visit_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `ip_address`, `visit_time`) VALUES
(1, '127.0.0.1', '2020-12-07 11:06:40pm'),
(2, '127.0.0.1', '2020-12-07 11:07:55pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
